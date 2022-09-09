<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

class InfoUserController extends Controller
{

    public function create()
    {
        return view('laravel-examples/user-profile');
    }

    public function store(Request $request)
    {

        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone'     => ['max:50'],
            'location' => ['max:70'],
            'about_me'    => ['max:150'],
        ]);
        if ($request->get('email') != Auth::user()->email) {
            if (env('IS_DEMO') && Auth::user()->id == 1) {
                return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t change the email address.']);
            }
        } else {
            $attribute = request()->validate([
                'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            ]);
        }


        User::where('id', Auth::user()->id)
            ->update([
                'name'    => $attributes['name'],
                'email' => $attribute['email'],
                'phone'     => $attributes['phone'],
                'location' => $attributes['location'],
                'about_me'    => $attributes["about_me"],
            ]);


        return redirect('/user-profile')->with('success', 'Profile updated successfully');
    }

    public function listUsers()
    {
        $users = User::where('role_id', 2)->whereIn('status', ['active', 'inactive'])->with('role')->get();
        return view('pages/users/user-management')->with('users', $users);
    }

    public function deletedUsers(){

        $users = User::where('role_id', 2)->whereIn('status', ['deleted'])->with('role')->get();
        return view('pages/users/deleted-users')->with('users', $users);
    }

    public function createUser(Request $request)
    {
        $fields = $request->validate([
            "name" => 'required',
            "email" => 'required',
            "password" => 'required',
            "cPassword" => 'required',
        ]);

        if ($fields['password'] == $fields['cPassword']) {
            if ($this->checkEmail($fields['email'])) {
                $fields += [
                    "role_id" => 2
                ];
                try {
                    //code...
                    User::create($fields);
                    return redirect()->back()->with('success', 'User created successfully');
                } catch (\Throwable $th) {
                    //throw $th;
                    return redirect()->back()->with('error', 'Server Error');
                }
            } else {
                return redirect()->back()->with('error', 'This email already exist');
            }
        } else {
            return redirect()->back()->with('error', 'The 2 passwords does not correspond');
        }
    }

    public function checkEmail($email)
    {
        if (User::where('email', '=', $email)->count() > 0) {
            return false;
        } else {
            return true;
        }
    }



    public function suspendUser($id)
    {
        try {
            //code...
            $user = User::find($id);
            if ($user) {
                $user->status = 'inactive';
                $user->save();
                return redirect()->back()->with('success', 'User suspended successful');
            } else {
                return redirect()->back()->with('error', 'this user does not exist');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function activateUser($id)
    {
        try {
            //code...
            $user = User::find($id);
            if ($user) {
                $user->status = 'active';
                $user->save();
                return redirect()->back()->with('success', 'user activated successful');
            } else {
                return redirect()->back()->with('error', 'this user does not exist');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function deleteUser($id)
    {
        try {
            //code...
            $user = User::find($id);
            if ($user) {
                $user->status = 'deleted';
                $user->save();
                return redirect()->back()->with('success', 'User deleted successful');
            } else {
                return redirect()->back()->with('error', 'this user does not exist');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function viewUser($id){
        $user = User::with('role')->find($id);
        // dd($user);
        if ($user) {
            return view('laravel-examples/view-user')
            ->with('user', $user);
        }else{
            return redirect()->route('dashboard')->with('error', 'this user does not exist');
        }
    }
}
