<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Mail\Welcome;
use App\Mail\Verification;
class EmailVerifyController extends Controller
{
    public function index() {
        return view('auth.passwords.verify');
    }

    public function resent() {
        if(auth()->user() == null){
            return redirect()->route('login');
        }
        if(!auth()->user()->verify){

            $data['verification_code'] = str_random(30);
            auth()->user()->verification_code = $data['verification_code'] ;
            auth()->user()->save();
            $data['name'] = auth()->user()->name;
            $data['email'] = auth()->user()->email;
            // dd( $data['verification_code']);

            Mail::to(auth()->user()->email)->send(new Verification($data));
        }
        return redirect()->route('login')
        ->with('info', 'Correo de verificado reenviado');
    }
    public function verifyCode($code, Request $request)
    {
        $user = User::where('verification_code',$code)->first();
        // dd($request->session('info'));
       if(!$user){
            auth()->logout();
           return redirect()->route('login')
           ->withErrors(['error'=> 'Error: codigo de verificación no encontrado']);
        //    ->with('error', 'Error: codigo de verificación no encontrado');
        }
        
       $user->verify = TRUE;
       $user->verification_code = null;
       $user->save();
       Mail::to($user->email)->send(new Welcome($user));
       return redirect()
            ->route('web.perfil')
            ->with('info', 'Correo verificado!');
               
    }
}
