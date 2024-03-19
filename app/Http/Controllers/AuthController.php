<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    protected $user;
    public function __construct(){

        $this->user = new User();
        
    }
    public function login(){
        
        return view('Auth.login');
    }

   
public function SignUp(Request $request)
{
    $validator = Validator::make($request->all(), [

        'name' => ['required', 'unique:Users,name', 'regex:/^([a-zA-Z]+\.[a-zA-Z]+)|([a-zA-Z]+\.[a-zA-Z]+\.[0-9]+)$/'],
        'email' => 'required|email|unique:Users,email',
        'password' => 'required|string|min:8',
        'c_password' => 'required|same:password',
        ],[
            'name.unique' => 'user name est déjà pris',

            'name.required' => 'Le champ nom d\'utilisateur est obligatoire.',
            'name.regex' => 'Le champ nom d\'utilisateur doit être au format "Prénom.Nom" et ne doit pas contenir d\'espace.',
            'email.required' => 'Le champ email est important',
            'email.email' => 'Veuillez entrer une adresse email valide',
            'email.unique' => 'L\'email est déjà pris',
            'password.required' => 'Le champ mot de passe est important',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères',
            'c_password.required' => 'Le champ de confirmation du mot de passe est important',
            'c_password.same' => 'La confirmation du mot de passe ne correspond pas au mot de passe',
        ]);

    if ($validator->fails()) {
        return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
    }

    $password = $request->password;
    $c_password = $request->c_password;
    if($c_password == $password){
        $role = 2 ;                        
        $user = $this->user;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $role;    
        $user->save();
    }
     return response()->json(['success' => true], 200);
} 


    public function SignIn(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'exists:Users,name', 'regex:/^[a-zA-Z]+\.[a-zA-Z]+$/'],
            'password' => 'required|string|min:8',
        ], [
            'name.required' => 'Le champ nom d\'utilisateur est obligatoire.',
            'name.exists' => 'Le nom d\'utilisateur n\'existe pas.',
            'name.regex' => 'Le champ nom d\'utilisateur doit être au format "Prénom.Nom" et ne doit pas contenir d\'espace.',
            'password.required' => 'Le champ mot de passe est important.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
        ]);
        
        

        if ($validator->fails()) {
            return redirect()->to('/login')
                ->withErrors($validator)
                ->withInput();
        }
            

        $name = $request->name;
        $password = $request->password;
        $user = $this->user;
        $user = $user->where('name', $name)->first();
        if ($user != null && Hash::check($password , $user->password)) 
        {

            Session::put('user_id', $user->id);
            session::put('role_id', $user->role_id);

            $role_id = $user->role_id ;
            if($role_id == 1){
                return redirect()->to('/dashboardpage');
            }
            if($role_id == 2){
                return redirect()->to('/eventpageorg');
            }
            else {                
                return redirect()->to('/index');    
            }
            
        } else {
            return redirect()->to('/login')
                    ->withErrors(['name' => 'Nom d\'utilisateur ou mot de passe incorrect'])
                    ->withInput();
        }
    }

    public function checkemail(Request $request)
    {
        $checkemail = $this->user->where('email', $request->email)->first();
    
        if (!empty($checkemail)) {
            $checkemail->remember_token = Str::random(60);
            $checkemail->save();
    
            Mail::to($checkemail->email)->send(new ForgotPassMail($checkemail));
            
            return back()->with('msg', 'Veuillez vérifier votre e-mail pour le lien de réinitialisation du mot de passe.');
        } else {
            return redirect()->back()->with('msg', 'L\'email n\'existe pas.');
        }
    }


    public function pass($token)
    {
        $checktoken = $this->user->where('remember_token'  , $token)->first();
        if(!empty($checktoken)){
            
            return view('Auth.changepass' , compact('checktoken'));
        }

        else{
            abort(403);
        }
    }

    public function ResetPass($token , Request $request)
    {


        $this->validate($request, [
            'pass' => 'required|string|min:8',
        ],[
            'pass.required' => 'Le champ mot de passe est important',
            'pass.min' => 'Le mot de passe doit contenir au moins 8 caractères',
        ]);                     
        

             $checktoken = $this->user->where('remember_token', $token)->first();

            if(!empty($checktoken) && $request->pass == $request->c_pass){
                    
                $checktoken->remember_token = Str::random(60);
                $checktoken->password = Hash::make($request->pass);
                $checktoken->save();
                return redirect('/login')->with("msgss" , "Le Mot De pass a ete changer avec succes");
            }

            else{
                abort(403);
            }
        
    }

  

}