<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneticAlgorithmController extends Controller
{
    // Konfigurasi awal
    private $warehouseSize = 690; // ukuran gudang dalam m²
    private $barang = [
        ['nama' => 'Obat Nyamuk Bakar', 'size' => 5],
        ['nama' => 'Obat Nyamuk Elektrik', 'size' => 3],
        ['nama' => 'Obat Nyamuk Oles', 'size' => 2],
        ['nama' => 'Obat Nyamuk Spray', 'size' => 4],
    ];
    private $populationSize = 10;
    private $maxGeneration = 100;
    private $mutationRate = 0.1;

    public function index()
    {
        $bestSolution = $this->geneticAlgorithm();
        return view('genetic.result', compact('bestSolution'));
    }

    private function geneticAlgorithm()
    {
        // Step 1: Inisialisasi populasi
        $population = $this->initializePopulation();

        for ($generation = 0; $generation < $this->maxGeneration; $generation++) {
            // Step 2: Hitung fitness
            $population = $this->calculateFitness($population);

            // Step 3: Seleksi
            $population = $this->selection($population);

            // Step 4: Crossover
            $population = $this->crossover($population);

            // Step 5: Mutasi
            $population = $this->mutation($population);
        }

        // Ambil solusi terbaik
        $population = $this->calculateFitness($population);
        usort($population, fn($a, $b) => $b['fitness'] <=> $a['fitness']);
        return $population[0];
    }

    private function initializePopulation()
    {
        $population = [];
        for ($i = 0; $i < $this->populationSize; $i++) {
            $chromosome = [];
            foreach ($this->barang as $item) {
                $chromosome[] = rand(0, floor($this->warehouseSize / $item['size']));
            }
            $population[] = ['chromosome' => $chromosome, 'fitness' => 0];
        }
        return $population;
    }

    private function calculateFitness($population)
    {
        foreach ($population as &$individual) {
            $totalArea = 0;
            foreach ($individual['chromosome'] as $key => $jumlah) {
                $totalArea += $jumlah * $this->barang[$key]['size'];
            }
            // Fitness: semakin mendekati ukuran gudang, semakin baik
            $individual['fitness'] = $totalArea <= $this->warehouseSize ? $totalArea : 0;
        }
        return $population;
    }

    private function selection($population)
    {
        // Seleksi dengan elitism (ambil 50% terbaik)
        usort($population, fn($a, $b) => $b['fitness'] <=> $a['fitness']);
        return array_slice($population, 0, ceil($this->populationSize / 2));
    }

    private function crossover($population)
    {
        $newPopulation = [];
        while (count($newPopulation) < $this->populationSize) {
            $parent1 = $population[array_rand($population)];
            $parent2 = $population[array_rand($population)];

            $child = [];
            foreach ($parent1['chromosome'] as $key => $gene) {
                $child[] = rand(0, 1) ? $gene : $parent2['chromosome'][$key];
            }
            $newPopulation[] = ['chromosome' => $child, 'fitness' => 0];
        }
        return $newPopulation;
    }

    private function mutation($population)
    {
        foreach ($population as &$individual) {
            if (rand() / getrandmax() < $this->mutationRate) {
                $key = array_rand($individual['chromosome']);
                $individual['chromosome'][$key] = rand(0, floor($this->warehouseSize / $this->barang[$key]['size']));
            }
        }
        return $population;
    }
}
