<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassMail;
use App\Models\Client;
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

   
    public function signUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:users,name', 'regex:/^[a-zA-Z]+\.[a-zA-Z]+|[a-zA-Z]+\.[a-zA-Z]$/'],
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'c_password' => 'required|same:password',
        ], [
            'name.unique' => 'Le nom d\'utilisateur est déjà pris.',
            'name.required' => 'Le champ nom d\'utilisateur est obligatoire.',
            'name.regex' => 'Le champ nom d\'utilisateur doit être au format "Prénom.Nom" et ne doit pas contenir d\'espace.',
            'email.required' => 'Le champ email est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.unique' => 'L\'adresse email est déjà utilisée.',
            'password.required' => 'Le champ mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'c_password.required' => 'Le champ de confirmation du mot de passe est obligatoire.',
            'c_password.same' => 'La confirmation du mot de passe ne correspond pas au mot de passe.',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }
    
        $user = new User();
        $user->name = $request->name. '.' . mt_rand(1000, 9999);
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = 3; 
        $user->save();
        try{
            $client = new Client();
            $client->user_id = $user->id;
            $client->image = 'images/profile_default.png';
            $client->save(); 
                
            return response()->json(['success' => true], 200);
        }       
   
        catch(\Exception $e){
            $user->delete();
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);

        }
       
    }


    public function SignIn(Request $request)
    {   

        
        $validator = Validator::make($request->all(), [
            'name' => ['required',  'regex:/^([a-zA-Z]+\.[a-zA-Z]+)|([a-zA-Z]+\.[a-zA-Z]+\.[0-9]+)$/'],            'password' => 'required|string',
        ], [
            'name.required' => 'Le champ nom d\'utilisateur est obligatoire.',
            'name.exists' => 'Le nom d\'utilisateur n\'existe pas.',
            'name.regex' => 'Le champ nom d\'utilisateur doit être au format "Prénom.Nom.0000" et ne doit pas contenir d\'espace.',
            'password.required' => 'Le champ mot de passe est important.',
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
        if($user->ban != null){
            return back()->with('msg', 'Vous êtes banni. Vous ne pouvez pas vous connecter.');
        }
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
        public function modifiermotdepass(Request $request){
            $validator = Validator::make($request->all(), [
                'oldmdp' => 'required|string',
                'newmdp' => 'required|string|min:8',
            ], [
                'oldmdp.required' => 'Le champ ancien mot de passe est requis.',
                'newmdp.required' => 'Le champ nouveau mot de passe est requis.',
                'newmdp.min' => 'Le mot de passe doit avoir au moins :min caractères.',
            ]);

            $user = User::findOrFail($request->id);

            if($user && Hash::check($request->oldmdp, $user->password)){
                    $user->password = Hash::make($request->newmdp);
                    $user->update();
                    return redirect()->back()->with("msgss" , "Le Mot De pass a ete changer avec succes");
                    
            }

            else{
                return redirect()->back()->with("msgss" , "L'ancein Mot de pass incorrect");

            }
        }
  


        public function ban($id)
        {
            $user = User::findOrFail($id);
            $user->ban = 1; 
            $user->save();
            return redirect()->back()->with('success', 'Utilisateur bloque avec succès.');
        }
        public function restore($id)
        {
            $user = User::findOrFail($id);
            $user->ban = null; 
            $user->save();
            return redirect()->back()->with('success', 'Utilisateur debloque avec succès.');
        }
    

}