<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\manager;
use App\Models\Roles;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ManagerController extends Controller
{

    //
    protected $manager;
    protected $user;
    protected $role;
    public function __construct(){
        $this->manager = new Manager();
        $this->user = new User();
        $this->role = new Roles();
    }
    public function index()
    {   
        

        $managers = $this->user->with('manager')->with('role')
                                    ->whereNotIn('role_id', [1, 3])
                                    ->latest()->get();
                                    $roles =  $this->role->all();
        // dd($managers[0]->ban);
        return view('admin.layout.managers', compact('managers' , 'roles'));
    }

    public function create(Request $request)
    {

        $request->merge([
            'name' => $request->prenom . '.' . $request->nom ,
        ]);
    
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:users,name',],
            'email' => ['required', 'email', 'unique:users,email' , 
            'cin' => 'required' , 'unique:managers,cin'],
        ], [
            'name.unique' => 'Le nom d\'utilisateur est déjà pris.',
            'cin.unique' => 'Le cin d\'utilisateur est déjà pris.',
            'name.required' => 'Le champ nom d\'utilisateur est obligatoire.',
            'name.regex' => 'Le nom d\'utilisateur doit être au format "Prénom.Nom" sans espace.',
            'email.required' => 'Le champ email est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.unique' => 'Cette adresse email est déjà associée à un compte.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $user = new User;    
        $user->name = $request->name. '.' . mt_rand(1000, 9999);    
        $user->email = $request->email;    
        $user->password = Hash::make($request->cin);    
        $user->role_id = $request->role_id;   
        $user->save();
        if ($user) {
         
            try{
            Manager::create([
                'cin' => $request->cin,
                'image' => 'images/profile_default.png', 
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'phone' => $request->phone,
                'adresse' => $request->adresse,
                'user_id' => $user->id,
            ]);
        }
        catch(Exception $e){
                User::where('id', $user->id)->delete();
                return redirect()->back();
        }
    
            return redirect()->back()->with('success', 'Manager ajouté avec succès.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Une erreur est survenue lors de la création de l\'utilisateur.'])->withInput();
        }
    }

    public function update(Request $request)
    {               
        if($request->role_id == 0){
            return redirect()->back()->with('errormsg' , 'le role est vide !!');
        }

        $request->merge([
            'name' => $request->prenom . '.' . $request->nom ,
        ]);
    
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:users,name,' . $request->id, 'regex:/^[a-zA-Z]+\.[a-zA-Z]+$/'],
            'email' => 'required|email|unique:users,email,' . $request->id,
            'cin' => 'required' , 'unique:managers,cin',

        ], [

            'name.unique' => 'Le nom d\'utilisateur est déjà pris.',
            'cin.unique' => 'Le Cin d\'utilisateur est déjà pris.',
            'name.required' => 'Le champ nom d\'utilisateur est obligatoire.',
            'name.regex' => 'Le nom d\'utilisateur doit être au format "Prénom.Nom" sans espace.',
            'email.required' => 'Le champ email est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.unique' => 'Cette adresse email est déjà associée à un compte.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $user = User::find($request->id);

        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'Utilisateur non trouvé.'])->withInput();
        }
    
        $user->name = $request->name. '.' . mt_rand(1000, 9999);
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->update();
    
        $manager = Manager::where('user_id', $request->id)->
                orWhere('cin' , $request->cin)->first();
        if (!$manager) {
            return redirect()->back()->withErrors(['error' => 'Manager non trouvé.'])->withInput();
        }
    
        $manager->cin = $request->cin;
        $manager->nom = $request->nom;
        $manager->prenom = $request->prenom;
        $manager->phone = $request->phone;
        $manager->adresse = $request->adresse;
        
        $manager->adresse = $request->adresse;
        $manager->update();
    
        return redirect()->back()->with('success', 'Manager mis à jour avec succès.');
    }
    

   
    
    public function profilepage(){
        $user_id = 14;
        $user = User::with('manager')->where('id' , $user_id)->with('role')->get();
        $roles = Roles::all();
        return view('admin.layout.profile' , compact('user' , 'roles'));
        // return response()->json($user);
    }

    public function profileshow(Request $request){
        $id = $request->user;
        $user = User::with('manager')->where('id' , $id)->with('role')->get();
        $roles = Roles::all();
        return view('admin.layout.profileshow' , compact('user' , 'roles'));
        // return response()->json($user);

    }
    
    public function changephoto(Request $request , $id){

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $manager = Manager::findOrFail($id);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            $image_name = "images/" . uniqid() .".".$image->getClientOriginalExtension();
            
            $image->move(public_path('images'),  $image_name);
            
            $manager->image = $image_name;
            
            $manager->save();
            return redirect()->back()->with('success', 'Photo de profil mis à jour avec succès.');
        }
        else{
            return redirect()->back()->with('success', 'Photo de profil est pas compatible.');
        }
    }

    public function accepteuser($id){
        $user = Client::findOrFail($id);
        $user->accepte = 1;
        $user->save();
        return redirect()->back()->with('success', 'Utilisateur comfirmé avec succès.');
    }

    public function refuseuser($id){
        $user = Client::findOrFail($id);
        $user->accepte = -1;
        $user->save();
        return redirect()->back()->with('success', 'Utilisateur refusé avec succès.');
    }

   }
