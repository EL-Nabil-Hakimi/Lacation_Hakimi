<?php

namespace App\Http\Controllers;

use App\Models\manager;
use App\Models\Roles;
use App\Models\User;
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
            'name' => $request->prenom . '.' . $request->nom,
        ]);
    
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:users,name', 'regex:/^[a-zA-Z]+\.[a-zA-Z]+$/'],
            'email' => 'required|email|unique:users,email',
        ], [
            'name.unique' => 'Le nom d\'utilisateur est déjà pris.',
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
        $user->name = $request->name;    
        $user->email = $request->email;    
        $user->password = Hash::make($request->cin.$request);    
        $user->role_id = $request->role_id;   
        $user->save();
        
        if ($user) {
            Manager::create([
                'cin' => $request->cin,
                'image' => 'profile_default.png', 
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'phone' => $request->phone,
                'user_id' => $user->id,
            ]);
    
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
            'name' => $request->prenom . '.' . $request->nom,
        ]);
    
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:users,name,' . $request->id, 'regex:/^[a-zA-Z]+\.[a-zA-Z]+$/'],
            'email' => 'required|email|unique:users,email,' . $request->id,
        ], [
            'name.unique' => 'Le nom d\'utilisateur est déjà pris.',
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
    
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->save();
    
        $manager = Manager::where('user_id', $request->id)->first();
        if (!$manager) {
            return redirect()->back()->withErrors(['error' => 'Manager non trouvé.'])->withInput();
        }
    
        $manager->cin = $request->cin;
        $manager->nom = $request->nom;
        $manager->prenom = $request->prenom;
        $manager->phone = $request->phone;
        $manager->save();
    
        return redirect()->back()->with('success', 'Manager mis à jour avec succès.');
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
