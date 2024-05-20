<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class userController extends Controller
{
    public function createUser(){
        return view("user.create");
    }
    public function destroy($id){
        $user = User::findOrFail($id);
        if(!$user){
            return redirect()->route('show.user')->with('error','Erro ao Excluir o usuário');
        }
        $user->delete();
        return redirect()->route('show.user')->with('sucess','Usuário excluido com sucesso');
    }
    public function storeUser(Request $request){
        $user = new User();

        Log::info("---Cadastro de produto-----");
        Log::info($request->all());
        Log::info("---- Cadastrado por: ".Auth::user()->name."-----");

        try {
            $validate = Validator::make($request->all(),[
                'email' =>'required|unique:users|email:rfc,dns',
                'password'=> 'required|min:8',
                'confirmePassword'=> 'required|same:password',
            ],[
                'email.required' => 'O campo E-mail é obrigatório.',
                'email.unique' => 'Este endereço de e-mail já está em uso.',
                'email.email' => 'Por favor, insira um endereço de e-mail válido.', // Mensagem padrão para o email:rfc,dns
                'password.required' => 'O campo Senha é obrigatório.',
                'password.min' => 'A senha deve ter no mínimo :min caracteres.',
                'confirmePassword.required' => 'Por favor, confirme sua senha.',
                'confirmePassword.same' => 'As senhas informadas não coincidem.',
            ]);

           if($validate->fails()){
            return redirect()->back()->withErrors($validate);
            
           }
           $user->create([
            'name' => $request->input('name'), 
            'password' => $request->input('password'),
            'email' => $request->input('email'),
            'email_verified_at'=>now(),
            'role' => $request->input('role')
        ]);
        $user->save();
        return redirect()->back()->with('success', 'Usuário criado com sucesso!');

        } catch(Exception $e) {
            Log::warning("Erro ao cadastrar novo usuário [ ... ] Erro: ".$e->getMessage());
            return redirect()
                ->back()
                ->withErrors($e->getMessage())
            ->withInput();

        }
    }

    public function show(){
        $atualUser = auth()->id();
        $users = User::where('id', '!=', $atualUser)->get(); 
        
        return view('user.show',['users'=>$users]);
    }
    public function edit($id){
        $user = User::find($id);
        return view('user.edit',['user'=>$user]);
    }
    public function editUser(Request $request,$id){

        Log::info("---Atualização de usuário-----");
        Log::info($request->all());
        Log::info("---- Atualizado por: ".Auth::user()->name."-----");

        try {
            $validate = Validator::make($request->all(),[
                'id' => 'exists:users,id',
                'email' =>'required|email:rfc,dns',
                'password' => 'nullable|min:8',
                'confirmePassword'=> 'nullable|same:password',
            ],[
                'id.exists'=>'Esse usuario não existe no sistema',
                'email.required' => 'O campo E-mail é obrigatório.',
                'email.email' => 'Por favor, insira um endereço de e-mail válido.', 
                'password.min' => 'A senha deve ter no mínimo :min caracteres.',
                'confirmePassword.same' => 'As senhas informadas não coincidem.',
            ]);

           if($validate->fails()){
            return redirect()->back()->withErrors($validate);
           }
           $user = User::find($id);
           $data = $this->verificaCampos($request);
           $user->update($data);
     
        $user->save();
        return redirect()->route('show.user')->with('success', 'Usuário atualizado com sucesso!');

        } catch(Exception $e) {
            Log::warning("Erro ao atualizar o usuário [ ... ] Erro: ".$e->getMessage());
            return redirect()
                ->back()
                ->withErrors($e->getMessage())
            ->withInput();

        }
    }
    public function verificaCampos($request){
        $data = [
            'email_verified_at' => now(),
        ];

        $request->filled('name') ? $data['name'] = $request->input('name') : "";
        $request->filled('password') ? $data['password'] = bcrypt($request->input('password')) : "";
        $request->filled('email') ? $data['email'] = $request->input('email') : "";
        $request->filled('role') && $request->input('role') !== 'Selecione o tipo de usuário' ? $data['role'] = $request->input('role') : "";

        return $data;

    }
}