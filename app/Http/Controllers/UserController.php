<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_users'])->only('index');
    }
    public function index()
    {
        $main_sidebar=7;
        $users=User::where('user_role','admin')->get();
        return view('backend/users/index', compact('users','main_sidebar'));
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate( [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        if($request->image){            
            Image::make($request->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_img/' . $request->image->hashName()));
        }
        
        $user = new user();        
        $user->name = $request->name;
        $user->email= $request->email;
        $user->user_role= 'admin';
        $user->password=bcrypt($request->password);
        if($request->image){ 
            $user->image = $request->image->hashName();}
        $user->save();
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);

        toastr()->success(trans('messages.success'));
        return redirect()->route('users.index');

    }

    public function show()
    {
        //
    }

    public function edit()
    {
        //
    }

    public function update(Request $request)
    {
        $request->validate( [
            'name' => 'required',
            'email' => 'required',
        ]);

        $user=User::findOrFail($request->id);

        if ($request->image) {
            if($user->image != 'default.png'){
                $path=public_path('uploads/user_img/' . $user->image);
                    unlink($path);  
            }
        if($request->image){            
            Image::make($request->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_img/' . $request->image->hashName()));
        }
        }
        
        $user->update([
            $user->name = $request->name,
            $user->email= $request->email,
          ]);
          if($request->image){ 
            $user->update([
            $user->image = $request->image->hashName(),
            ]);    
         }
        $user->syncPermissions($request->permissions);

        toastr()->success(trans('messages.Update'));
        return redirect()->route('users.index');

    }

    public function destroy(Request $request)
    {
        $user=User::findOrFail($request->id);
        if($user->image != 'default.png'){
            $path=public_path('uploads/user_img/' . $user->image);
                unlink($path);  
        }
        $user->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('users.index');

    }
    // =============================== clients part ==========================================
    
    public function client_index()
    {
        $main_sidebar=5;
        $users=User::where('user_role','client')->orderBy('id', 'DESC')->get();
        return view('backend/clients/index', compact('users','main_sidebar'));
    }
    
    public function client_show(Request $request)
    {
        $main_sidebar=5;
        $user= User::findOrFail($request->id);
        $orders=$user->orders;
        return view('backend/clients/show', compact('user','main_sidebar','orders'));
    }
    public function client_edit(Request $request)
    {
        $main_sidebar=5;
        $user= User::findOrFail($request->id);
        return view('backend/clients/edit', compact('user','main_sidebar'));
    }
    public function client_destroy(Request $request)
    {
        $main_sidebar=5;
        $user= User::findOrFail($request->id);
        $user->delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('clients.index');
    }

}
