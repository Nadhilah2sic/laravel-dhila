<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Http\UserController;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataUser'] = User::all();
        return view('admin.user.index',$data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $request->validate([
        'name' => 'required',
        'Email'  => 'required',
        'Password'   => 'required',

        ]);



        $data['name'] = $request->name;
        $data['Email'] = $request->Email;
        $data['Password'] = $request->Password;

        User::create($data);

        return redirect()->route('User.index')->with('success','Penambahan Data Berhasil!');
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
         $data['dataPelanggan'] = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.edit', $data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $request->validate([
        'first_name' => 'required',
        'last_name'  => 'required',
        'birthday'   => 'required|date',
        'gender'     => 'required|in:Male,Female',
        'email'      => 'required|email',
        'phone'      => 'required|numeric',
        ]);


        $pelanggan_id = $id;
        $pelanggan = Pelanggan::findOrFail($pelanggan_id);


        $pelanggan->first_name = $request->first_name;
        $pelanggan->last_name = $request->last_name;
        $pelanggan->birthday = $request->birthday;
        $pelanggan->gender = $request->gender;
        $pelanggan->email = $request->email;
        $pelanggan->phone = $request->phone;


        $pelanggan->save();
        return redirect()->route('pelanggan.index')->with('success', 'Perubahan Data Berhasil!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);


        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Data berhasil dihapus');
    }
}





