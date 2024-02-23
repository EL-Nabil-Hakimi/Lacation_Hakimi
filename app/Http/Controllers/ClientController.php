<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    //Affichage des pages

    public function index()
    {
        return view('Client.index');
    }

    public function about()
    {
        return view('Client.about');
    }
    public function cars()
    {
        return view('Client.cars');
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

}
