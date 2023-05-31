<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Http\Resources\MahasiswaResource;
use App\Http\Requests\StoreMahasiswaRequests;
use App\Http\Requests\UpdateMahasiswaRequest;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource:.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return MahasiswaResource::collection(Mahasiswa::all());
        return MahasiswaResource::collection(Mahasiswa::paginate(2));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMahasiswaRequests $request)
    {
        //
        // return response()->json('hello');
        return new MahasiswaResource(Mahasiswa::create([
            'Nim'=>$request->Nim,
            'Nama'=>$request->Nama,
            'Jurusan'=>$request->Jurusan,
            'No_Handphone'=>$request->No_Handphone,
            'kelas_id'=>$request->kelas_id,
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa )
    {
        //
        return new MahasiswaResource($mahasiswa);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMahasiswaRequest $request, Mahasiswa $mahasiswa)
    {
        //
        $mahasiswa->update([
            'Nim'=>$request->Nim,
            'Nama'=>$request->Nama,
            'Jurusan'=>$request->Jurusan,
            'No_Handhpone'=>$request->No_Handhpone,
            'kelas_id'=>$request->kelas_id,
        ]);
        return new MahasiswaResource($mahasiswa);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return response()->noContent();
    }
}