<?php

namespace App\Http\Controllers;

use App\Models\originating;
use App\Models\service;
use App\Models\sid;
use App\Models\terminating;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class sidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        for ($i=1; $i <= 12; $i++) {
            $bulan[] = Carbon::create()->month($i)->format('F');
        }
        $originating = originating::orderBy('name')->get();
        $terminating = terminating::orderBy('name')->get();
        $service = service::orderBy('name')->get();
        return view('sid',[
            'originating' => $originating,
            'terminating' => $terminating,
            'service' => $service,
            'bulan' => $bulan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = sid::where('status', 'selesai')->paginate(5);
        return view('sidValidate',[
            'tittle' => 'Sid',
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'originating'=>'required',
            'service'=>'required',
            'terminating'=>'required',
            'bulan'=>'required',
            'tahun'=>'required',
        ]);
        $kodeOriginating = originating::where('name', $request->originating)->select('kode')->first();
        $kodeTerminating = terminating::where('name', $request->terminating)->select('kode')->first();
        $kodeService = service::where('name', $request->service)->select('kode')->first();
        $kodeTahun = substr($request->tahun, -2);
        $bulanRegister = Carbon::now()->month;
        $tahunRegister = Carbon::now()->year;
        $register = sid::whereMonth('created_at', $bulanRegister)->whereYear('created_at', $tahunRegister)->count();
        if (!$register) {
            $register = 1;
        } else {
            $register += 1;
        }
        $id = $kodeOriginating->kode . $kodeTerminating->kode  . $kodeService->kode .$register. $request->bulan . $kodeTahun;
        $bulan = Carbon::create()->month(intval($request->bulan))->format('F');
        try {
            DB::beginTransaction();
            $sid = new sid();
            $sid->id = strval($id);
            $sid->originating = $request->originating;
            $sid->terminating = $request->terminating;
            $sid->service = $request->service;
            $sid->register = $register;
            $sid->bulan = $bulan;
            $sid->tahun = $request->tahun;
            $sid->save();
            DB::commit();
            return back()->with('success', 'SID berhasil di tambah');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors('SID gagal di tambah');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $data = sid::where('status', 'pending')->paginate(5);
        return view('sidDisplay',[
            'tittle' => 'Sid',
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = sid::where('id', $id)->first();
        return view('sidValidation', [
            'tittle' => 'Validation Sid',
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'status'=> 'required'
        ]);

        try {
            DB::beginTransaction();
            sid::where('id',$id)->update($data);
            DB::commit();
            return redirect('/admin/sid')->with('success', 'Berhasil validasi data');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('/admin/sid')->withErrors('Gagal Validasi data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        sid::where('id',$id)->delete();
        return redirect('admin/sid')->with('success', 'berhasil hapus data');
    }
}
