<?php

namespace App\Http\Controllers;

use App\Models\originating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class originatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = originating::all();
        return view('originating',[
            'tittle' => 'originating',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('originatingCreate',[
            'tittle' => 'Originaing Create',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('name', $request->name);
        Session::flash('kode', $request->kode);
        $request->validate([
            'name' => 'required|unique:originatings,name',
            'kode' => 'required|unique:originatings,kode'
        ]);

        try {
            DB::beginTransaction();
            $originating = new originating();
            $originating->name = $request->name;
            $originating->kode = $request->kode;
            $originating->save();
            DB::commit();
            return redirect('/admin/originating')->with('succsess', 'Berhasil menambahkan data');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect('/admin/originating')->withErrors('gagal menambahkan data');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = originating::where('id', $id)->first();
        return view('originatingEdit',[
            'tittle' => 'Originating Edit',
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'kode' => 'required',
        ]);

        try {
            DB::beginTransaction();
            originating::where('id', $id)->update($data);
            DB::commit();
            return redirect('/admin/originating')->with('success', 'berhasil edit data');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect('/admin/originating')->withErrors('gagal edit data');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            originating::where('id', $id)->delete();
            DB::commit();
            return redirect('/admin/originating')->with('success', 'Berhasil hapus data');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('/admin/originating')->withErrors('gagal menghapus data');
        }
    }
}
