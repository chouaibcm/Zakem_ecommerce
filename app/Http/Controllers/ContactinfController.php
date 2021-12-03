<?php

namespace App\Http\Controllers;

use App\Contactinf;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ContactinfController extends Controller
{
    public function index()
    {
        $main_sidebar=8; 
        $contactinf=Contactinf::first();
        return view('backend.settings.contactinf.index',compact('contactinf','main_sidebar'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Contactinf $contactinf)
    {
        //
    }

    public function edit(Contactinf $contactinf)
    {
        //
    }

    public function update(Request $request)
    {       
        $contactinf=Contactinf::first();
        //// logo1 image with update
        if ($request->logo1){
            // delete the old image
              if($contactinf->logo1){
                $path=public_path('uploads/logo/' . $contactinf->logo1);
                unlink($path);  
              }    
                    // put new image logo
            Image::make($request->logo1)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/logo/' . $request->logo1->hashName()));
            $contactinf->update([
                $contactinf->logo1 = $request->logo1->hashName(),
                ]); 
        }
        //// logo1 image with update
        if ($request->logo2){
            // delete the old image
            if($contactinf->logo2){
                $path=public_path('uploads/logo/' . $contactinf->logo2);
                    unlink($path);  
              }      
                    // put new image logo
            Image::make($request->logo2)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/logo/' . $request->logo2->hashName()));
            $contactinf->update([
                $contactinf->logo2 = $request->logo2->hashName(),
                ]); 
        }


        $contactinf->update([
            $contactinf->address=$request->address,
            $contactinf->phone=$request->phone,
            $contactinf->email=$request->email,
        ]);
        
        toastr()->success(trans('messages.Update'));
        return redirect()->route('contact.index');
    }

    public function destroy(Contactinf $contactinf)
    {
        //
    }
}
