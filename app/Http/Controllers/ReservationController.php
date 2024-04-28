<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class ReservationController extends Controller
{


    public function index()
    {
        $reservations = Reservation::with('car')->with('user')
       ->where('user_id' , session()->get('user_id'))->orderBy('updated_at' , 'desc')->latest()->paginate(5);
        if (session()->has('user_id') && session()->get('role_id') == 3) {
            $user_id = session('user_id');
            $user = User::with('client')->where('id', $user_id)->get();
            // dd($user);  
            return view('Client.reservations', compact('user' , 'reservations'));
        }
        else{
        return view('Client.reservations' , compact('reservations'));
        }
    }
    
    public function addreservation(Request $request, $id)
    {
        

        $request->validate([
            'date_debut' => 'required',
            'date_fin' => 'required',
        ]);

       
    if($request->date_debut > $request->date_fin){
        return response()->json(['error' => 'The start date must be less than the end date']);
    }
    
        if(session()->get('role_id') == 3){
            $checkcar = Reservation::where('date_fin', '>', $request->date_debut)
                ->where('date_debut', '<', $request->date_fin)
                ->where('car_id', $id)
                ->where('accepte' , 1)
                ->orWhere('accepte' , 3)
                ->orWhere('accepte' , null)
                ->orderBy('updated_at' , 'DESC')
                ->first();
                
            if($checkcar == null || $checkcar != null && $checkcar->accepte == 5){

                if($checkcar != null && $checkcar->accepte == 5){
                    $checkcar->accepte = 6;
                    $checkcar->save();
                }
                 

                $reservation  = new Reservation();
                $reservation->user_id = session()->get('user_id');
                $reservation->car_id = $id;
                $reservation->date_debut = $request->date_debut;
                $reservation->date_fin = $request->date_fin;
                $reservation->save();
    
                return response()->json(['success' => 'Reservation added successfully']);
            }
            else{
                return response()->json(['error' => 'This car is already reserved on this date']);
            }
        }
        else{
            return response()->json(['error' => 'You cannot reserve any car because you are not a client']);
        }
    }
    
    public function AdminReservation()
    {
        $reservations = Reservation::with('car')->with('user')->orderBy('updated_at' , 'DESC')->paginate(5);
        // dd($reservations);
        return view('admin.layout.reservation' , compact('reservations'));
    }

    public function StatuCar($id , $status)
    {
        $reservation = Reservation::findOrFail($id);
        if($status == 3){
            $car = Car::findOrFail($reservation->car_id);
            $car->accepte = 3;
            $car->disponibilite = null;
            $car->save();    
        }
        if($status == 4){
            $car = Car::findOrFail($reservation->car_id);
            $car->accepte = 1;
            $car->disponibilite = 1;
            $car->save();    
        }

        $reservation->accepte = $status;
        $reservation->save();

        
        

        return redirect()->back()->with('success', 'The status is changed with successfully');
    }

    public function downloadReservation($id)
    {
        $res = Reservation::with('car')->with('user')->where('id', $id)->get();

        $date1 = Carbon::parse($res[0]->date_debut);
        $date2 = Carbon::parse($res[0]->date_fin);
        $totalDays = $date1->diffInDays($date2);
        $totalCost = $totalDays * $res[0]->car->prix_par_jour;
        $image = asset('images/cars/'.$res[0]->car->image);

        $htmlContent = view('Client.tecket' ,compact('res' , 'totalDays' , 'totalCost' , 'image'))->render();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($htmlContent);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        return $dompdf->stream('document.pdf');
    }

    
}
