<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\PenataanGudang;
use App\Models\ExternalBarang;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function index(Request $request)
    {
        // Z-layer dari penataan gudang
        $z = $request->input('z', 1);

        $data = PenataanGudang::where('koordinat_z', $z)->get();

        $groupedBarang = [];

        foreach ($data as $item) {
            $x = $item->koordinat_x;
            $y = $item->koordinat_y;
            $zVal = $item->koordinat_z;

            $groupedBarang[$x][$y][$zVal][] = [
                'nama_barang' => $item->nama_barang,
                'jenis_barang' => $item->jenis_barang,
                'jumlah' => $item->jumlah
            ];
        }

        $totalSlot = 80;
        $slotTerisi = $data->count();
        $persenOkupansi = ($slotTerisi / $totalSlot) * 100;

        // Data dari model Item (yang sebelumnya di ItemController)
        $items = Item::paginate(5); // pagination
        $totalBarang = Item::sum('jumlah_barang'); // total

        // Gabung semuanya ke view
        return view('index', compact(
            'groupedBarang',
            'persenOkupansi',
            'slotTerisi',
            'totalSlot',
            'z',
            'items',
            'totalBarang'
        ));
    }

    public function ambilDataLuar()
    {
        $dataBarang = ExternalBarang::all();
        return response()->json($dataBarang);
    }

    public function testExternalDb()
    {
        try {
            $data = ExternalBarang::take(5)->get();
            return response()->json(['status' => 'success', 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    
}
