<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule; 

class adminController extends Controller
{
    protected $url;
    public function __construct() {
        $user = Auth::user();
        $this->url = "http://{$user->cnpj}.ddns.net:8098/api/svrpista/";
    }
    public function createUser()
    {
        return view("user.create");
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if (!$user) {
            return redirect()->route('show.user')->with('error', 'Erro ao Excluir o usuário');
        }
        $user->delete();
        return redirect()->route('show.user')->with('sucess', 'Usuário excluido com sucesso');
    }

    public function show()
    {
        $atualUser = auth()->user();
        $users = User::where('id', '!=', $atualUser->id)
            ->where('cnpj', '=', $atualUser->cnpj)
            ->get();

        return view('admin/user.show', ['users' => $users]);
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', ['user' => $user]);
    }

    public function showCompany()
    {
        $user = auth()->user();
        try {
            $url = $this->url."empresa";
            $response = getResponse($url,$user->token); 
            $empresa = json_decode($response, false);
            return view("admin/Empresa.show", ["empresa" => $empresa]);
        } catch (Exception $e) {
            return redirect()->route('home')->with('Error', $e->getMessage());
        }
    }
}