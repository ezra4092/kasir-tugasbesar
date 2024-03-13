<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Login extends Controller
{
    public function index() {

        if ($user = Auth::user()) {
            if  ($user->level == 'admin'){
            return redirect()->intended('admin');
        } elseif ($user->level == 'petugas'){
            return redirect()->intended('petugas');
        }

    }
    return view('login');
}

    public function proses(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $kredensial = $request->only('username', 'password');
        if (Auth::attempt($kredensial)){
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->level == 'admin'){
                return redirect()->intended('admin');
            } elseif ($user->level == 'petugas'){
                return redirect()->intended('petugas');
            } else {
                return redirect()->to(url('/'))->with(['error' => true]);
            }
        }
        return redirect()->to(url('/'))->with(['error' => true]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function edit($id){
        $data = [
            'title' => 'Kasir Dapur Bunda',
            'active' => 'Kasir',
            'kasir' => User::find($id)
        ];
        return view('reset', $data);
    }

    public function reset(Request $request, $id) {
        $pembayaran = User::find($id);
        $pembayaran->update($request->except(['_token'], '_method'));

        return redirect()->to(url('/'))->with('dataEdit', 'Data Berhasil Di Edit');
    }


}
