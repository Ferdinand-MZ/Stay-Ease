<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\LogM;
use PDF;
use Illuminate\Support\Facades\Auth;

class UsersR extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User berada di Halaman User'
        ]);

        $subtitle = "Daftar Produk";
        $usersM = User::all();
        $usersM = User::search(request('search'))->paginate(10);
        $vcari = request('search');
        return view('users_index', compact('subtitle', 'usersM', 'vcari'));
    }

    public function profile()
    {

        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User berada di halaman Profile'
        ]);

    // Get the currently logged-in user
    $user = Auth::user();

    // Pass the user data to the view
    return view('profile', compact('user'));
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
            'activity' => 'User berada di halaman Create User'
        ]);

        $subtitle = "Tambah Data Pengguna";
        return view('users_create', compact('subtitle'));
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
            'activity' => 'User menginput User baru'
        ]);

        $request->validate([
            'pfp' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
            'role' => 'required',
        ]);

        $user = new User([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        if ($request->hasFile('pfp')) {
            $imagePath = $request->file('pfp')->store('img', 'public');
            $user->pfp = $imagePath;
        }

        $user->save();

        return redirect()->route( 'users.index' )->with('success', 'Pengguna Berhasil Ditambahkan' );
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
            'activity' => 'User berada di halaman Edit user'
        ]);

        $subtitle = "Edit Data Pengguna";
        $data = User::find($id);
        return view('users_edit', compact('subtitle', 'data'));
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
            'activity' => 'User mengedit User'
        ]);

        $request->validate([
            'pfp' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required',
        ]);
    
        $user = User::find($id);
    
        if ($request->hasFile('pfp')) {
            $imagePath = $request->file('pfp')->store('img', 'public');
            $user->pfp = $imagePath;
        }
    
        // Update other fields
        $user->name = $request->input('name');
        
        $user->save();
    
        return redirect()->route('users.index')->with('success', 'Data Pengguna berhasil diperbaharui');
    }

    public function custom(Request $request, $id)
    {

        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User sedang mengedit profile'
        ]);

        // Memeriksa apakah id yang diberikan sesuai dengan id user yang sedang aktif
    if ($id != auth()->user()->id) {
        // Jika tidak sesuai, mungkin Anda ingin menangani ini sesuai kebutuhan Anda, misalnya, dengan mengarahkan pengguna ke halaman lain atau menampilkan pesan kesalahan.
        abort(403, 'Unauthorized access'); 
    }

        $request->validate([
            'pfp' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required',
        ]);
    
        $user = User::find($id);
    
        if ($request->hasFile('pfp')) {
            $imagePath = $request->file('pfp')->store('img', 'public');
            $user->pfp = $imagePath;
        }
    
        // Update other fields
        $user->name = $request->input('name');
        
        $user->save();
    
        return redirect('/dashboard')->with('success', 'DataMu berhasil diperbaharui');
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
            'activity' => 'User menghapus user'
        ]);

        LogM::where('id_user', $id)->delete();

        User::where('id', $id)->delete();
        return redirect()->route( 'users.index' )->
        with( 'success', 'Pengguna Berhasil Dihapus' );
    }

    public function delete($id)
    {

        if ($id != auth()->user()->id) {
            // Jika tidak sesuai, mungkin Anda ingin menangani ini sesuai kebutuhan Anda, misalnya, dengan mengarahkan pengguna ke halaman lain atau menampilkan pesan kesalahan.
            abort(403, 'Unauthorized access'); 
        }

        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User menghapus akunnya'
        ]);

        LogM::where('id_user', $id)->delete();

        User::where('id', $id)->delete();
        return redirect()->route('logout');
    }

    public function changepassword($id){

        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User mengganti password user'
        ]);

        $subtitle="Edit Kata Sandi Pengguna";
        $users = User::find($id);
        return view('users_changepassword', compact('subtitle', 'users'));
    }

    public function profilepassword($id){

        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User mengganti password profile'
        ]);

        $subtitle = "Edit Kata Sandi Pengguna";
        
        // Memeriksa apakah id yang diberikan sesuai dengan id user yang sedang aktif
        if ($id != auth()->user()->id) {
            // Jika tidak sesuai, mungkin Anda ingin menangani ini sesuai kebutuhan Anda, misalnya, dengan mengarahkan pengguna ke halaman lain atau menampilkan pesan kesalahan.
            abort(403, 'Unauthorized access'); 
        }
    
        $users = User::find($id);
    
        return view('users_profilepassword', compact('subtitle','users'));
    }

    public function allpdf(){

        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mengunduh Daftar Tamu'
        ]);
        
        $userM = User::all();
        // return view('transaksi_pdf', compact('transaksiM'));
       
        $pdf = PDF::loadview('users_pdf', ['userM' => $userM]);
        return $pdf->stream('Daftar Tamu.pdf');
    }

    // public function change(Request $request, $id){
    //     $request->validate([
    //         'password_new' => 'required',
    //         'password_confirm' => 'required|same:password_new',
    //     ]);
    //     $users = User::where("id", $id)->first();   
    //     $users->update([
    //         'password' => Hash::make($request->password_new),
    //     ]);
    //     return redirect()->route('users.index')
    //     ->with('success', 'Kata Sandi berhasil diperbaharui !');
    // }
}