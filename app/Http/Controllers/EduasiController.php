<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Edukasi;
use App\Models\Training;

class EduasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexEdukasi()
    {
        return view('admin.edukasi.index',[
            'title' => 'Edukasi Posyandu',
            'edukasis' => Edukasi::all()
        ]);
    }
    
    public function indexTraining()
    {
        return view('admin.edukasi.training',[
            'title' => 'Data Training For Naive Bayes',
            'trainings' => Training::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeEdukasi(Request $request)
    {
        DB::table('edukasis')->insertOrIgnore([
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
            'link' => $request->link,
            'status' => 'Publish',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('edukasi')->with('success', 'Data Berhasil Ditambahkan!');
    }
    
    public function storeTraining(Request $request)
    {
        DB::table('trainings')->insertOrIgnore([
            'umur' => $request->usia,
            'berat_badan' => $request->bb,
            'tinggi_badan' => $request->tb,
            'lingkar_atas' => $request->la,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('training')->with('success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function showTraining(string $id)
    {
        return view('admin.edukasi.trainingEdit',[
            'title' => 'Data Training For Naive Bayes',
            'training' => Training::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateTraining(Request $request)
    {
        DB::table('trainings')
            ->where('id', $request->idTraining)
            ->update([
                'umur' => $request->usia,
                'berat_badan' => $request->bb,
                'tinggi_badan' => $request->tb,
                'lingkar_atas' => $request->la,
                'status' => $request->status,
                'updated_at' => now(),
            ]);

        return redirect()->route('training')->with('success', 'Data Berhasil Diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyEdukasi(string $id)
    {
        Edukasi::destroy($id);
        return redirect()->route('edukasi')->with('success', 'data was delete successfully!');
    }
    
    public function destroyTraining(string $id)
    {
        Training::destroy($id);
        return redirect()->route('training')->with('success', 'data was delete successfully!');
    }
}
