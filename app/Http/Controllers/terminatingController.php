<?php

namespace App\Http\Controllers;

use App\Models\terminating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class terminatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = terminating::all();
        return view('terminating',[
            'tittle' => 'terminating',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('terminatingCreate',[
            'tittle' => 'Terminating Create',
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
            'name' => 'required|unique:terminatings,name',
            'kode' => 'required|unique:terminatings,kode'
        ]);

        try {
            DB::beginTransaction();
            $terminating = new terminating();
            $terminating->name = $request->name;
            $terminating->kode = $request->kode;
            $terminating->save();
            DB::commit();
            return redirect('/admin/terminating')->with('succsess', 'Berhasil menambahkan data');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect('/admin/terminating')->withErrors('gagal menambahkan data');
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
        $data = terminating::where('id', $id)->first();
        return view('terminatingEdit',[
            'tittle' => 'Terminating Edit',
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
            terminating::where('id', $id)->update($data);
            DB::commit();
            return redirect('/admin/terminating')->with('success', 'berhasil edit data');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect('/admin/terminating')->withErrors('gagal edit data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            terminating::where('id', $id)->delete();
            DB::commit();
            return redirect('/admin/terminating')->with('success', 'Berhasil hapus data');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('/admin/terminating')->withErrors('gagal menghapus data');
        }
    }
}
