<?php
namespace App\Services;

use App\Models\Item;
use App\Models\PenataanGudang;

class GeneticAlgorithmService
{
    protected $rakCount = 240;
    protected $slotPerRak = 16;
    protected $populationSize = 40;
    protected $generations = 100;
    protected $mutationRate = 0.01;
    protected $maxItemsPerSlot = 40;
    protected $items = [];

    // Berat maksimum per level rak (z = 1 bawah, 2 tengah, 3 atas)
    protected $maxWeightPerLevel = [
        1 => 2000000,  // bawah
        2 => 1500000,  // tengah
        3 => 1000000,  // atas
    ];

    public function run()
    {
        $this->items = Item::all()->toArray();

      foreach ($this->items as &$item) {
                    $item['jumlah'] = $item['jumlah_barang']; // ambil dari kolom jumlah_barang // sudah ada langsung di DB
                    $item['tanggal_masuk'] = $item['created_at'];  // tetap sama
                }   

        $population = $this->generatePopulation(count($this->items), $this->items);

        for ($gen = 0; $gen < $this->generations; $gen++) {
            $population = $this->evolve($population, $this->items);
        }

        $best = $this->getBestIndividual($population, $this->items);

        PenataanGudang::truncate();
        $usedPositions = [];

      foreach ($best as $i => $pos) {
            $item = $this->items[$i];
            $jumlah = $item['jumlah'];
            $splitCount = ceil($jumlah / $this->maxItemsPerSlot);

            [$minX, $maxX] = $this->getXRangeForJenis($item['jenis_barang']);

            // Berat per item langsung dari data
            $beratPerItem = $item['Berat_Barang'];

            for ($s = 0; $s < $splitCount; $s++) {
                while (true) {
                    $key = "{$pos['x']}-{$pos['y']}-{$pos['z']}";
                    if (!isset($usedPositions[$key]) && $pos['x'] >= $minX && $pos['x'] <= $maxX) {
                        $usedPositions[$key] = true;
                        break;
                    }
                    $pos['x'] = rand($minX, $maxX);
                    $pos['y'] = rand(0, 3);
                    $pos['z'] = rand(1, 3);
                }

                $level = match ($pos['z']) {
                    1 => 'Bawah',
                    2 => 'Tengah',
                    3 => 'Atas',
                    default => 'Tengah',
                };

                $jumlahPerPalet = min($this->maxItemsPerSlot, $jumlah - ($s * $this->maxItemsPerSlot));
                $beratPerPalet = $beratPerItem * $jumlahPerPalet;

                PenataanGudang::create([
                    'nama_barang' => $item['nama_barang'],
                    'jenis_barang' => $item['jenis_barang'],
                    'jumlah' => $jumlahPerPalet,
                    'berat' => $beratPerPalet,
                    'koordinat_x' => $pos['x'],
                    'koordinat_y' => $pos['y'],
                    'koordinat_z' => $pos['z'],
                    'level_rak' => $level,
                    'text_id' => $item['text_id'],
                ]);
            }
        }
    }

    protected function getXRangeForJenis($jenis)
    {
        return match ($jenis) {
            'Obat Nyamuk Bakar' => [0, 4],
            'Obat Nyamuk Spray' => [5, 9],
            'Obat Nyamuk Elektrik' => [10, 14],
            'Obat Nyamuk Oles' => [15, 19],
            default => [0, 19],
        };
    }

    protected function generatePopulation($size, $items)
    {
        $population = [];

        for ($i = 0; $i < $this->populationSize; $i++) {
            $individual = [];

            foreach ($items as $item) {
                [$minX, $maxX] = $this->getXRangeForJenis($item['jenis_barang']);
                $individual[] = [
                    'x' => rand($minX, $maxX),
                    'y' => rand(0, 3),
                    'z' => rand(1, 3),
                ];
            }

            $population[] = $individual;
        }

        return $population;
    }

    protected function evolve($population, $items)
    {
        $newPopulation = [];

        usort($population, function ($a, $b) use ($items) {
            return $this->evaluateFitness($b, $items) <=> $this->evaluateFitness($a, $items);
        });

        $newPopulation[] = $population[0];
        $newPopulation[] = $population[1];

        while (count($newPopulation) < $this->populationSize) {
            $parent1 = $population[rand(0, 9)];
            $parent2 = $population[rand(0, 9)];
            $child = $this->crossover($parent1, $parent2);

            if (rand() / getrandmax() < $this->mutationRate) {
                $child = $this->mutate($child);
            }

            $newPopulation[] = $child;
        }

        return $newPopulation;
    }

    protected function crossover($parent1, $parent2)
    {
        $point = rand(0, count($parent1) - 1);
        $child = array_merge(array_slice($parent1, 0, $point), array_slice($parent2, $point));

        foreach ($child as $i => &$pos) {
            $jenis = $this->items[$i]['jenis_barang'];
            [$minX, $maxX] = $this->getXRangeForJenis($jenis);
            if ($pos['x'] < $minX || $pos['x'] > $maxX) {
                $pos['x'] = rand($minX, $maxX);
            }
        }

        return $child;
    }

    protected function mutate($individual)
    {
        $index = array_rand($individual);
        $item = $this->items[$index];
        [$minX, $maxX] = $this->getXRangeForJenis($item['jenis_barang']);

        $individual[$index] = [
            'x' => rand($minX, $maxX),
            'y' => rand(0, 3),
            'z' => rand(1, 3),
        ];

        return $individual;
    }

    protected function evaluateFitness($individual, $items)
    {
        $score = 0;
        $weightMap = [];

        foreach ($individual as $i => $pos) {
            $item = $items[$i];
            $berat = $item['Berat_Barang'];
            $tanggalMasuk = strtotime($item['tanggal_masuk']);

            $rakKey = $pos['x'] . '-' . $pos['z'];
            if (!isset($weightMap[$rakKey])) {
                $weightMap[$rakKey] = 0;
            }
            $weightMap[$rakKey] += $berat;

            $maxWeight = $this->maxWeightPerLevel[$pos['z']] ?? 15000;
            if ($weightMap[$rakKey] > $maxWeight) {
                $score -= ($weightMap[$rakKey] - $maxWeight) / 1000;
            }

            if ($berat > 5000 && $pos['z'] != 1) {
                $score -= 10;
            }

            $fifoWeight = (strtotime('now') - $tanggalMasuk) / (86400 * 30);
            $score += max(0, $fifoWeight - $pos['y']);

            [$minX, $maxX] = $this->getXRangeForJenis($item['jenis_barang']);
            if ($pos['x'] < $minX || $pos['x'] > $maxX) {
                $score -= 1000;
            }
        }

        return $score;
    }

    protected function getBestIndividual($population, $items)
    {
        usort($population, function ($a, $b) use ($items) {
            return $this->evaluateFitness($b, $items) <=> $this->evaluateFitness($a, $items);
        });

        return $population[0];
    }
}
