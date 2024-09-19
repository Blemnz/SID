<?php

namespace App\Http\Controllers;

use App\Models\service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class serviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = service::all();
        return view('service',[
            'tittle' => 'Service',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('serviceCreate',[
            'tittle' => 'Service Create',
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
            'name' => 'required|unique:services,name',
            'kode' => 'required|unique:services,kode'
        ]);

        try {
            DB::beginTransaction();
            $originating = new service();
            $originating->name = $request->name;
            $originating->kode = $request->kode;
            $originating->save();
            DB::commit();
            return redirect('/admin/service')->with('succsess', 'Berhasil menambahkan data');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect('/admin/service')->withErrors('gagal menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = service::where('id', $id)->first();
        return view('serviceEdit',[
            'tittle' => 'Service Edit',
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
            service::where('id', $id)->update($data);
            DB::commit();
            return redirect('/admin/service')->with('success', 'berhasil edit data');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect('/admin/service')->withErrors('gagal edit data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            service::where('id', $id)->delete();
            DB::commit();
            return redirect('/admin/service')->with('success', 'Berhasil hapus data');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('/admin/service')->withErrors('gagal menghapus data');
        }
    }
}
