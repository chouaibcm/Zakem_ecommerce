<?php

namespace App\Http\Controllers;

use App\Socialmedia;
use Illuminate\Http\Request;

class SocialmediaController extends Controller
{
    public function index()
    {
        $main_sidebar=8; 
        $socialmedia=Socialmedia::first();
        return view('backend.settings.socialmedia.index',compact('socialmedia','main_sidebar'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Socialmedia $socialmedia)
    {
        //
    }

    public function edit(Socialmedia $socialmedia)
    {
        //
    }

    public function update(Request $request, Socialmedia $socialmedia)
    {
        //
    }

    public function destroy(Socialmedia $socialmedia)
    {
        //
    }
}
