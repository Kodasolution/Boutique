<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Classes\Services\UserService;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function login()
    {
        return view('admin.login.index');
    }
    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard-ecommerces');
        }
        return redirect()->route('admin.login')->withSuccess('Login details are not valid');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('admin.login');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service = new UserService();
        $user = $service->getAllUser();
        return view('admin.users.index', compact('user'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'confirm_password' => ['same:password'],
            'phone' => 'required'
        ]);
        // dd($data);
        $value = [];
        $value['firstName'] = $request->firstName;
        $value['lastName'] = $request->lastName;
        $value['email'] = $request->email;
        $value['password'] = Hash::make($request->password);
        $value['phone'] = $request->phone;
        $value['status'] = $request->status;
        $value['role'] = $request->role;
        // dd($value);
        $service = new UserService();
        $result =  $service->createUser($value);
        return back()->with('success', $result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => ['required', Rule::unique('users')->ignore($user->id)],
            'phone' => 'required'
        ]);
        $value = [];
        $value['firstName'] = $request->firstName;
        $value['lastName'] = $request->lastName;
        $value['email'] = $request->email;
        $value['password'] = Hash::make($request->password);
        $value['phone'] = $request->phone;
        $value['status'] = $request->status;
        $value['role'] = $request->role;
        $service = new UserService();
        $result =  $service->updateUser($user, $value);
        return back()->with('success', $result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
