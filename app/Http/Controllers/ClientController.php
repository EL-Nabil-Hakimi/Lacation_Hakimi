<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Client;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        if (session()->has('user_id') && session()->get('role_id') == 3) {
            $user_id = session('user_id');
            $user = User::with('client')->where('id', $user_id)->get();
            // dd($user);  
            return view('Client.index', compact('cars', 'user'));
        }
        
        return view('Client.index' , compact('cars'));
    }

    public function about()
    {

        if (session()->has('user_id') && session()->get('role_id') == 3) {
            $user_id = session('user_id');
            $user = User::with('client')->where('id', $user_id)->get();
            // dd($user);  
            return view('Client.about', compact('user'));
        }
        
        return view('Client.about');
    }
    public function cars()
    {



        $cars = Car::with('marque')->with('model')->where('accepte' , 1)->where('disponibilite' , 1)->latest()->paginate(9);
        $count_cars = $cars->count();

        $c_cars = intval($count_cars / 9);

        if (session()->has('user_id') && session()->get('role_id') == 3) {
            $user_id = session('user_id');
            $user = User::with('client')->where('id', $user_id)->get();
            // dd($user);  
            return view('Client.cars', compact('user' , 'cars' , 'c_cars'));
        }

        return view('Client.cars' , compact('cars' , 'c_cars'));
    }

    public function car_single($id)
    {
        $car = Car::with('marque')->with('model')->where('accepte' , 1)->where('id'  , $id)->get();

        $related_cars = Car::with('marque')->with('model')->where('company_id' , $car[0]->marque->id)->where('id' ,'!=', $car[0]->id)->get();

        // dd($related_cars);
        
        if (session()->has('user_id') && session()->get('role_id') == 3) {
            $user_id = session('user_id');
            $user = User::with('client')->where('id', $user_id)->get();
            // dd($user);  
            return view('Client.single-car', compact('user' , 'car' , 'related_cars'));
        }

        return view('Client.single-car' , compact('car' , 'related_cars'));
    }

    public function blog()
    {


        if (session()->has('user_id') && session()->get('role_id') == 3) {
            $user_id = session('user_id');
            $user = User::with('client')->where('id', $user_id)->get();
            // dd($user);  
            return view('Client.blog', compact('user'));
        }

        return view('Client.blog');
    }

    public function contact()
    {
        if (session()->has('user_id') && session()->get('role_id') == 3) {
            $user_id = session('user_id');
            $user = User::with('client')->where('id', $user_id)->get();
            // dd($user);  
            return view('Client.contact', compact('user'));
        }
        
        return view('Client.contact');
    }

    public function services()
        {

            if (session()->has('user_id') && session()->get('role_id') == 3) {
                $user_id = session('user_id');
                $user = User::with('client')->where('id', $user_id)->get();
                // dd($user);  
                return view('Client.services', compact('user'));
            }
            
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
        $infos = User::with(['car', 'reservation' => function ($query) {
            $query->orderBy('updated_at', 'DESC');
        }])
        ->where('id', $id)
        ->get();
    
        // Pagination should be applied to the reservation relationship, not $infos
        // You can access the reservation relationship using $infos[0]->reservation
        $reservations = $infos[0]->reservation()->paginate(10);
    
        $role_id = session()->get('role_id');
        return view('admin.layout.profileusershow', compact('infos', 'reservations', 'role_id'));
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

    public function updateinfouser(Request $request){
        
        $validator = Validator::make($request->all() , [
            'cin' => 'required|unique:clients,cin,'.$request->user_id,
            'nom' => 'required',
            'prenom' => 'required',
            'phone' => 'required',
            'adresse' => 'required',
            'permi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
            'v_permi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
            // 'email' => 'required|email|unique:users,email,'.$request->id,
        ], );
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $newEmail = $request->email;
        $user = User::find($request->id);
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
        
        $id = $request->user_id;
        $client = Client::findOrFail($id);
        $client->nom = $request->nom;
        $client->cin = $request->cin;
        $client->prenom = $request->prenom;
        $client->phone = $request->phone;
        $client->adresse = $request->adresse;
        $client->accepte = null;
    
        if($request->hasFile('permi')){
            $image = $request->file('permi');
            $image_name = "images/" . uniqid() .".".$image->getClientOriginalExtension();
            $image->move(public_path('images'),  $image_name);
            $client->permi = $image_name;
        }
        if($request->hasFile('v_permi')){
            $image = $request->file('v_permi');
            $image_name = "images/" . uniqid() .".".$image->getClientOriginalExtension();
            $image->move(public_path('images'),  $image_name);
            $client->v_permi = $image_name;
        }
        
        $client->save();
    
        return redirect()->back()->with('success', 'Client mis à jour avec succès.');
    }
    

    public function profile_client($id)
    {


        $user = User::with('client')->where('id', $id)->get();
        if($user->isEmpty()){
            return redirect()->to('/profile/'.session('user_id'));
        }

        if( session()->get('user_id') == $user[0]->id){
            return view('Client.profile', compact('user'));
            
        }
        else{
           return redirect()->to('/profile/'.session('user_id'));
        }
    }



    public function searchcarforclient(Request $request)
    {   

        // dd($request->all());

      

        $cars = Car::with('marque', 'model')
                ->where('accepte', 1)
                ->where('disponibilite', 1)
                ->where(function ($query) use ($request) {
                    $query->where('company_id', $request->marque_id)
                        ->orWhere('model_id', $request->car_model);
                })
                ->whereNotIn('id', function ($query) use ($request) {
                    $formattedDateStart = \Carbon\Carbon::parse($request->date_start)->format('Y-m-d H:i:s');
                    $formattedDateEnd = \Carbon\Carbon::parse($request->date_end)->format('Y-m-d H:i:s');
                    $query->select('car_id')
                        ->from('reservations')
                        ->where(function ($query) use ($formattedDateStart, $formattedDateEnd) {
                            $query->where('date_debut', '<=', $formattedDateEnd)
                                    ->where('date_fin', '>=', $formattedDateStart);
                        });
                })
                ->paginate(9);
    
                
    
        $count_cars = $cars->count();

        $c_cars = intval($count_cars / 9);

        if (session()->has('user_id') && session()->get('role_id') == 3) {
            $user_id = session('user_id');
            $user = User::with('client')->where('id', $user_id)->get();
            // dd($user);  
            return view('Client.cars', compact('user' , 'cars' , 'c_cars'));
        }

        return view('Client.cars' , compact('cars' , 'c_cars'));
    }


    
}