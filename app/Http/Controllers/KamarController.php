<?php

namespace App\Http\Controllers;

use App\Models\LogM;
use Illuminate\Http\Request;
use App\Models\KamarM;
use Illuminate\Support\Facades\Auth;
use Spatie\Glide\GlideImage;

use PDF;

class KamarController extends Controller
{
    public function index()
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Berada di Halaman Kamar'
        ]);
        
        $kamarM = KamarM::search(request('search'))->paginate(10);
        $vcari = request('search');
        return view('kamar_index', compact('kamarM', 'vcari'));
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
            'activity' => 'User berada di halaman create Kamar'
        ]);

        $subtitle = "Tambah Kamar";
        return view('kamar_create', compact('subtitle'));
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
        'activity' => 'User Menginput Kamar'
    ]);

    $request->validate([
        'foto_kamar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'no_kamar' => 'required|unique:kamar,no_kamar',
        'tipe_kamar' => 'required',
        'harga' => 'required',
        'fasilitas' => 'required',
    ]);

    $kamar = new KamarM;
    $kamar->no_kamar = $request->input('no_kamar');
    $kamar->tipe_kamar = $request->input('tipe_kamar');
    $kamar->harga = $request->input('harga');
    $kamar->fasilitas = $request->input('fasilitas');

    if ($request->hasFile('foto_kamar')) {
        $image = $request->file('foto_kamar');
        $imagePath = $image->store('img', 'public');

        // Mengurangi resolusi gambar
        $img = \Image::make(public_path("storage/{$imagePath}"));
        $img->resize(800, 600); // Sesuaikan dengan ukuran yang diinginkan
        $img->save(public_path("storage/{$imagePath}"));

        $kamar->foto_kamar = $imagePath;
    }

    $kamar->save();

    return redirect()->route('kamar.index')->with('success', 'Kamar berhasil ditambahkan');
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
            'activity' => 'User Berada di halaman edit Kamar'
        ]);

        $subtitle = "Edit Kamar";
        $data = KamarM::find($id);
        return view('kamar_edit', compact('subtitle', 'data'));
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
            'activity' => 'User Mengedit Kamar'
        ]);

        $request->validate([
            // 'no_kamar' => 'required|unique:kamar,no_kamar',
            'tipe_kamar' => 'required',
            'harga' => 'required',
            'fasilitas' => 'required',
        ]);


        $kamar = KamarM::find($id);
        $kamar->no_kamar = $request->input('no_kamar');
        $kamar->tipe_kamar = $request->input('tipe_kamar');
        $kamar->harga = $request->input('harga');
        $kamar->fasilitas = $request->input('fasilitas');

        if ($request->hasFile('foto_kamar')) {
            $imagePath = $request->file('foto_kamar')->store('img', 'public');
            $kamar->foto_kamar = $imagePath;
        }
        
        $kamar -> save();
        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil diperbaharui');
    }

    public function allpdf(){

        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mengunduh Daftar kamar'
        ]);
        
        $kamarM = kamarM::all();
        
        // return view('transaksi_pdf', compact('transaksiM'));
       
        $pdf = PDF::loadview('kamar_pdf', ['kamarM' => $kamarM]);
        return $pdf->stream('Daftar Kamar.pdf');
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
            'activity' => 'User Menghapus Kamar'
        ]);

        KamarM::where('id', $id)->delete();
        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil dihapus');
    }
}
