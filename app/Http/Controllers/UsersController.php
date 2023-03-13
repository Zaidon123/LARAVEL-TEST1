<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function register(Request $request)
    {
        try {
            $data = $request->only('name', 'email', 'password', 'password_confirmation', 'address', 'phone', 'skills', 'about', 'photo');
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'phone' => ['required', 'numeric'],
                'skills' => ['string', 'max:255'],
                'about' => ['string', 'max:255'],
                'photo' => ['file', 'mimes:png,gif,jpg,jpeg'],
            ], $data);
            $data['uniqueId'] = Str::random(20);
            $data['password'] = Hash::make($data['password']);
            if ($request->hasFile('photo')) {
                $data['photo'] = ((new UserService())->saveFile('photo', '/user', $request->allFiles()));
            }
            if (!((new UserService())->save($data))) {
                throw new \Exception('the data dose not saved');
            }
            $user = ((new UserService())->getFirst(['uniqueId' => $data['uniqueId']]));
            $user->assignRole('student');
            if (!Auth::attempt([
                'email' => $data['email'],
                'password' => $data["password_confirmation"]
            ])) {
                throw new \Exception('error password or email');
            }
            return \response()->json([
                'error' => 0,
                'token' => \auth()->user()->createToken($request->ip())->plainTextToken,
                'msg' => 'save successfully',
            ]);
        } catch (\Exception $e) {
            return \response()->json([
                'error' => 1,
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function login(Request $request)
    {
        try {
            $data = $request->only('email', 'password');
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:8'],
            ], $data);
            if (!Auth::attempt([
                'email' => $data['email'],
                'password' => $data['password']
            ])) {
                throw new \Exception('error password or email');
            }
            return \response()->json([
                'error' => 0,
                'token' => \auth()->user()->createToken($request->ip())->plainTextToken,
                'msg' => 'successfully',
            ]);
        } catch (\Exception $e) {
            return \response()->json([
                'error' => 1,
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function view(Request $request)
    {
        try {
            $data = $request->only('search');
            $request->validate([
                'search' => ['string']
            ], $data);
            $users = (new UserService())->getListQuery();
            if ($request->has('search')) {
                $users = (new UserService())->getListQuery(['name' => $data['search']]);
            }
            return response()->json([
                'error' => 0,
                'user' => $users->get(),
            ]);
        } catch (\Exception $e) {
            return \response()->json([
                'error' => 1,
                'Section' => $e->getMessage()
            ]);
        }
    }

    public function profile()
    {
        return response()->json([
            'error' => 0,
            'user name ' => \auth()->user()
        ]);
    }

    public function logout()
    {
        try {
            \auth()->user()->tokens()->delete();
            return response()->json([
                'error' => 0,
                'msg' => 'successful logout'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 1,
                'msg' => 'error logout'
            ]);
        }
    }

    public function ChangePassword(Request $request)
    {
        try {
            $data = $request->only('old_password', 'password', 'password_confirmation');
            $request->validate([
                'old_password' => ['required', 'string', 'min:8'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ], $data);
            if (!(password_verify($data['old_password'], \auth()->user()->password))) {
                throw new \Exception('wrong password');
            }
            $data['password'] = Hash::make($data['password']);
            if (!((new UserService())->update(['password' => $data['password']], ['uniqueId' => \auth()->user()->uniqueId]))) {
                throw new \Exception('the password dose not save');
            }
            return \response()->json([
                'error' => 0,
                'msg' => 'done',
            ]);
        } catch (\Exception $e) {
            return \response()->json([
                'error' => 1,
                'msg' => $e->getMessage()
            ]);
        }
    }

}
