<?php
namespace App\Classes\Services;



use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function getAllUser()
    {
        $user = User::orderBy('id', 'desc')->paginate(15);
        return $user;
    }

    public function createUser(array $data)
    {
        User::create([
            "firstName" => $data['firstName'],
            "lastName" => $data['lastName'],
            "email" => $data['email'],
            "phone" => $data['phone'],
            "password" => $data['password'],
            "status" => $data['status'],
            "role" => $data['role']
        ]);
        $msg = "user is created successfully";
        return $msg;
    }
    public function login(array $data)
    {
        if (Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ])) {
            return true;
        } else {
            return false;
        }
    }
    public function updateUser(User $user, array $data)
    {
        $user->update([
            "firstName" => $data['firstName'],
            "lastName" => $data['lastName'],
            "email" => $data['email'],
            "phone" => $data['phone'],
            "password" => $data['password'],
            "status" => $data['status'],
            "role" => $data['role']
        ]);
        $msg = "user is update successfully";
        return $msg;
    }
}
