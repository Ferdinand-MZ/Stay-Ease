<?php

namespace App\Http\Controllers;

use App\Models\LogM;
use App\Models\TamuM;
use PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TamuController extends Controller
{
    //
    public function index()
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User berada di halaman Tamu'
        ]);
        
        $tamuM = TamuM::search(request('search'))->paginate(10);
        $vcari = request('search');
        return view('tamu_index', compact('tamuM', 'vcari'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User berada di halaman Create Tamu'
        ]);

        $subtitle = "Tambah Tamu";
        return view('tamu_create', compact('subtitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Menginput Tamu'
        ]);

        $request->validate([
            'nama_tamu' => 'required',
            'no_ktp' => 'required|size:16',
            'tgl_lahir' => 'required',
            'no_hp' => 'required',
            'jk' => 'required',
        ]);
        TamuM::create($request->post());
        return redirect()->route('tamu.index')->with('success', 'Tamu berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User berada di halaman Edit Tamu'
        ]);

        $subtitle = "Edit Tamu";
        $data = TamuM::find($id);
        return view('tamu_edit', compact('subtitle', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mengedit Tamu'
        ]);

        $request->validate([
            'nama_tamu' => 'required',
            'no_ktp' => 'required',
            'tgl_lahir' => 'required',
            'no_hp' => 'required',
            'jk' => 'required',
        ]);

     $data = request()->except(['_token', '_method', 'submit']);

     TamuM::where('id', $id)->update($data);
     return redirect()->route('tamu.index')->with('success', 'Tamu berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Menghapus Tamu'
        ]);

        TamuM::where('id', $id)->delete();
        return redirect()->route('tamu.index')->with('success', 'Tamu berhasil dihapus');
    }

    public function allpdf(){

        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mengunduh Daftar Tamu'
        ]);
        
        $tamuM = TamuM::all();
        
        
        // return view('transaksi_pdf', compact('transaksiM'));
       
        $pdf = PDF::loadview('tamu_pdf', ['tamuM' => $tamuM]);
        return $pdf->stream('Daftar Tamu.pdf');
    }
}
