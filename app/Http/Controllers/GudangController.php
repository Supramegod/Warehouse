<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\PenataanGudang;
use App\Models\ExternalBarang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GudangController extends Controller
{
    public function index(Request $request)
{
    // Ambil nilai Z untuk tampilan
    $z = $request->input('z', 1);

    // Data penataan hanya untuk layer Z yang dipilih
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

    // Perhitungan okupansi harus dari semua data (tanpa filter Z)
    $totalSlot = 240; // misal tetap 80
    $slotTerisi = PenataanGudang::count(); // ambil total semua entri
    $persenOkupansi = ($slotTerisi / $totalSlot) * 100;

    // Data dari model Item
    $items = Item::paginate(5);
    $totalBarang = Item::sum('jumlah_barang');

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
