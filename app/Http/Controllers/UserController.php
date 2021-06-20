<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;

class UserController extends Controller
{
    private $param;
    
    public function index(Request $request)
    {
        $this->param['title'] = 'List User';
        $this->param['pageTitle'] = 'User';
        $this->param['btn']['text'] = 'Tambah Data';
        $this->param['btn']['link'] = route('user.create');

        try {
            $keyword = $request->get('keyword');
            if ($keyword) {
                $user = User::where('nama', 'LIKE', "%$keyword%")->orWhere('email', 'LIKE', "%$keyword%")->paginate(10);
            }
            else{
                $user = User::paginate(10);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withStatus('Terjadi Kesalahan');
        }
                
        return \view('user.list-user', ['user' => $user], $this->param);
    }

    public function create()
    {
        $this->param['title'] = 'Tambah User';
        $this->param['pageTitle'] = 'User';
        $this->param['btn']['text'] = 'Lihat Data';
        $this->param['btn']['link'] = route('user.index');

        return \view('user.tambah-user', $this->param);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users',
        ]);
        try{
    
            $newUser = new User;
    
            // $newUser->nama = $request->get('nama');
            $newUser->email = $request->get('email');
            $newUser->password = \Hash::make('password');
    
            $newUser->save();
    
            return redirect()->back()->withStatus('Data berhasil ditambahkan.');
        }
        catch(\Exception $e){
            return redirect()->back()->withError('Terjadi kesalahan. : '. $e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError('Terjadi kesalahan pada database : '. $e->getMessage());
        }
    }

    public function edit($id)
    {
        try{
            $this->param['title'] = 'Edit User';
            $this->param['pageTitle'] = 'User';
            $this->param['btn']['text'] = 'Lihat Data';
            $this->param['btn']['link'] = route('user.index');
            $this->param['user'] = User::find($id);

            return \view('user.edit-user', $this->param);
        }
        catch(\Exception $e){
            return redirect()->back()->withError('Terjadi kesalahan : '. $e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError('Terjadi kesalahan pada database : '. $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $isUnique = $user->email == $request->email ? '' : '|unique:users';

        $validatedData = $request->validate([
            'nama' => 'required',
            'email' => 'required|email'.$isUnique,
        ]);
        try{

            $user->nama = $request->get('nama');
            $user->email = $request->get('email');
            $user->save();

            return redirect()->back()->withStatus('Data berhasil diperbarui.');
        }
        catch(\Exception $e){
            return redirect()->back()->withError('Terjadi kesalahan : '. $e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError('Terjadi kesalahan pada database : '. $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $member = User::findOrFail($id);

            $member->delete();

            return redirect()->route('user.index')->withStatus('Data berhasil dihapus.');
        }
        catch(\Exception $e){
            return redirect()->route('user.index')->withError('Terjadi kesalahan : '. $e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('user.index')->withError('Terjadi kesalahan pada database : '. $e->getMessage());
        }
        
    }

    public function ubahPassword()
    {
        $this->param['title'] = 'Ubah Password';
        $this->param['pageTitle'] = 'User';
        // $this->param['btn']['text'] = 'Lihat Data';
        // $this->param['btn']['link'] = route('user.index');

        return view('user.ubah-password', $this->param);
    }

    public function savePassword(Request $request, $id)
    {
        $user = User::find($id);

        $validatedData = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ]);
        try{
            if (\Hash::check($request->get('old_password'), $user->password)) {
                $user->password = \Hash::make($request->get('new_password'));
                $user->save();
                return redirect()->back()->withStatus('Data berhasil diperbarui.');
            }
            else{
                return redirect()->back()->withError('Password lama tidak sesuai.');
            }

        }
        catch(\Exception $e){
            return redirect()->back()->withError('Terjadi kesalahan : '. $e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError('Terjadi kesalahan pada database : '. $e->getMessage());
        }
    }
}
