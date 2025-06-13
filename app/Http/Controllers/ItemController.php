<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Imports\ItemsImport;
use App\Exports\ItemsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\PenataanGudang;

class ItemController extends Controller
{
    public function store(Request $request)
    {
        // validasi
        $request->validate([
            'jenis_barang' => 'required',
            'nama_barang' => 'required',
            'text_id' => 'required',
            'jumlah_barang' => 'required|numeric',
            'Berat_barang' => 'required|numeric',
        ]);

        // simpan data ke DB
        Item::create([
            'jenis_barang' => $request->jenis_barang,
            'nama_barang' => $request->nama_barang,
            'text_id' => $request->text_id,
            'jumlah_barang' => $request->jumlah_barang,
            'Berat_barang' => $request->Berat_barang,
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }
   // app/Http/Controllers/WarehouseController.php

public function tampilItems()
{
    $items = Item::paginate(10); // sesuaikan dengan model kamu
    $totalBarang = Item::sum('Jumlah_barang');

    return view('tables', compact('items', 'totalBarang'));
}

public function tampilPenataan()
{
    $penataan = PenataanGudang::paginate(10); // sesuaikan dengan model kamu
    $totalPenataan = PenataanGudang::count();

    return view('hasil', compact('penataan', 'totalPenataan'));
}

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            $import = new ItemsImport;
            Excel::import($import, $request->file('excel_file'));
            
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diimport',
                'count' => count(Excel::toArray($import, $request->file('excel_file'))[0]) - 1 // Menghitung jumlah baris (dikurangi header)
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Download Excel template
     */
    public function downloadTemplate()
    {
        return Excel::download(new ItemsExport, 'template_barang.xlsx');
    }
    
}


