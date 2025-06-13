<?php
namespace App\Observers;

use App\Models\Item;
use App\Services\GeneticAlgorithmService;

class BarangObserver
{
    public function created(Item $item)
    {
        // Tambahin ini bro!
        $gaService = new GeneticAlgorithmService();

        // Panggil GA service
         $gaService->run();
    }
}
