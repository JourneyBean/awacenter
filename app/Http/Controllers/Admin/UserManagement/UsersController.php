<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Date;
use Inertia\Inertia;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Jetstream\DeleteUser;
use App\Actions\Jetstream\DeleteTeam;

class UsersController extends Controller
{
    public static function getUsers() {
        $users = User::all();
        return $users;
    }

    public function createUser(Request $request) {
        $input = $request->input();
        $input['password_confirmation'] = $input['password'];
        $input['terms'] = true;
        $c = new CreateNewUser;
        $c->create($input);

        return Redirect::back()->with([
            'status' => 'success', // no need to handle errors
        ]);
    }

    public function updateUser(Request $request) {
        $request->validate([
            'id' => 'required|exists:users',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => ['nullable', Rules\Password::defaults()],
            'verified' => 'required|boolean',
            'admin' => 'required|boolean',
            'enabled' => 'required|boolean',
        ]);
        
        $user = User::where('id', $request->id)->first();
        if ($user->name != $request->name) $user->name = $request->name;
        if ($user->email != $request->email) $user->email = $request->email;
        if ($request->password) $user->password = Hash::make($request->password);
        if (!$user->email_verified_at != !$request->verified) $user->email_verified_at = $request->verified?Date::now():null;
        $user->admin = $request->admin;
        $user->enabled = $request->enabled;
        
        $user->save();
        
        return Redirect::back()->with([
            'status' => 'success',
        ]);
    }

    public function deleteUser(Request $request) {
        $request->validate([
            'id' => 'required|exists:users',
        ]);

        // $user = User::where(['id'=>$request->id])->sole();
        $d = new DeleteUser(new DeleteTeam());
        $d->delete(User::where(['id'=>$request->id])->sole());
        return Redirect::back()->with([
            'status' => 'success',
        ]);
    }

}
