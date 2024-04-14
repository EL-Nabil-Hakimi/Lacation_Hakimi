<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //Affichage des pages
    protected $user ;
    public function __construct(){
        $this->user = new User();
    }

    public function index()
    {

        $cars = Car::with('marque')->with('model')->where('accepte' , 1)->where('disponibilite' , 1)->paginate(9);

        return view('Client.index' , compact('cars'));
    }

    public function about()
    {
        return view('Client.about');
    }
    public function cars()
    {

        $cars = Car::with('marque')->with('model')->where('accepte' , 1)->where('disponibilite' , 1)->latest()->paginate(9);
        $count_cars = $cars->count();

        $c_cars = intval($count_cars / 9);

        return view('Client.cars' , compact('cars' , 'c_cars'));
    }

    public function car_single($id)
    {
        $car = Car::with('marque')->with('model')->where('accepte' , 1)->where('id'  , $id)->get();

        $related_cars = Car::with('marque')->with('model')->where('company_id' , $car[0]->marque->id)->where('id' ,'!=', $car[0]->id)->get();

        // dd($related_cars); 

        return view('Client.single-car' , compact('car' , 'related_cars'));
    }

    public function blog()
    {
        return view('Client.blog');
    }

    public function contact()
    {
        return view('Client.contact');
    }

    public function services()
        {
            return view('Client.services');
        }


    //    partie d'admine
    
    public function dashboard(){

        $clients = $this->user->with('client')->where('role_id' , 3)->latest()->get();
        // foreach($clients as $client){
        //     dd($client->client->image);
        // }
        return view('admin.layout.client' , compact('clients'));
    }

    public function profileusershow($id){
            $user = $this->user->with('client')->where('id',$id)->get();
            $role_id = 3;
            return view('admin.layout.profileusershow' , compact('user' , 'role_id'));
    }

    public function profileuser($id){
      
        $user = User::with('client')->where('id' , $id)->get();

        return view('admin.layout.profileuser' , compact('user'));
        // return response()->json($user);
    }

    public function changephotouser(Request $request , $id){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $client = Client::findOrFail($id);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            $image_name = "images/" . uniqid() .".".$image->getClientOriginalExtension();
            
            $image->move(public_path('images'),  $image_name);
            
            $client->image = $image_name;
            
            $client->save();

            return redirect()->back()->with('success', 'Photo de profil mis à jour avec succès.');
        }
        else{
            return redirect()->back()->with('error', 'Photo de profil est pas compatible.');
        }
    }

    public function updateinfo(Request $request){
        $request->validate([
            'email' => 'required|email|unique:users,email,'.$request->user_id,
            'permi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
            'nom' => 'required',
            'prenom' => 'required',
            'phone' => 'required',
            'adresse' => 'required',
            'cin' => 'required',
        ], [
            'email.unique' => 'Cet email est déjà utilisé.'
        ]);
    
        $user_id = $request->user_id;
        $newEmail = $request->email;
        $user = User::find($user_id);
        if($user && $user->email !== $newEmail){
            $checkEmail = User::where('email', $newEmail)->first();
            if($checkEmail){
                return redirect()->back()->with('error', 'Email existe déjà.');
            }
            else {   
               $user->email = $newEmail;
               $user->save();
            }
        }
        
        $id = $request->id;
        $client = Client::findOrFail($id);
        $client->nom = $request->nom;
        $client->cin = $request->cin;
        $client->prenom = $request->prenom;
        $client->phone = $request->phone;
        $client->adresse = $request->adresse;
    
        if($request->hasFile('permi')){
            $image = $request->file('permi');
            $image_name = "images/" . uniqid() .".".$image->getClientOriginalExtension();
            $image->move(public_path('images'),  $image_name);
            $client->permi = $image_name;
        }
        $client->save();
    
        return redirect()->back()->with('success', 'Client mis à jour avec succès.');
    }
    
}