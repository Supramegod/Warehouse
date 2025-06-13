<?php

namespace App\Http\Controllers;
use App\Models\PenataanGudang;
use Illuminate\Http\Request;

class PenataanGudangController extends Controller
{
    public function getRackData()
    {
        // Fetch all barang data
        $barang = PenataanGudang::all();

        // Assign coordinates and sort
        $sortedBarang = $barang->map(function ($item) {
                // Assuming rak_shelf is a column in your Barang model
                $item->koordinat_x = 0; // Will be set in the view
                $item->koordinat_y = $item->rak_shelf;
                $item->koordinat_z = 1; // Default Z coordinate
                return $item;
            })
            ->sortBy('koordinat_x')  // Sort by X first
            ->sortBy('koordinat_y')  // Then sort by Y
            ->values()             // Reset array keys after sorting
            ->toArray();

        $groupedBarang = [];
        foreach ($sortedBarang as $item) {
            $groupedBarang[$item['koordinat_x']][$item['koordinat_y']][] = $item;
        }

        // Return the grouped data
        return $groupedBarang;
    }

    public function showDashboard(Request $request)
    {
        $z = $request->input('z', 1); // Ambil nilai z dari URL, default = 1
    $groupedBarang = $this->getRackData();

    return view('index', [
        'groupedBarang' => $groupedBarang,
        'z' => $z,
    ]);
    }
    
}
