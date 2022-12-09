<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:users-read'])->only('index');
        $this->middleware(['permission:users-create'])->only(['create', 'store']);
        $this->middleware(['permission:users-update'])->only(['edit', 'update']);
        $this->middleware(['permission:users-delete'])->only('destroy');
    } //end of constructor

    public function index()
    {
        $users = User::whereRoleIs(['admin', 'user'])->latest()->paginate(9);
        return view('users.index', compact('users'));
    } //end of index


    public function create()
    {
        $roles = Role::where('name', '!=', 'super_admin')->get();
        return view('users.create', compact('roles'));
    } //end of create


    public function store(StoreUserRequest $request)
    {
        $user = User::create($this->getUserData($request));
        $this->syncRolesAndPermissions($user, $request);
        session()->flash('success', __('User created successfully'));
        return redirect()->route('users.index');
    } //end of store


    public function getUserData($request)
    {
        $user_data = $request->except(['permissions', 'role', 'password']);
        $password = Hash::make($request->password);
        $user_data['password'] = $password;
        return $user_data;
    } //end of getUserData


    public function syncRolesAndPermissions($user, $request)
    {
        $user->syncRoles([$request->role]);
        $user->syncPermissions($request->permissions);
    } //end of syncRolesAndPermissions


    public function edit(User $user)
    {
        $roles = Role::where('name', '!=', 'super_admin')->get();
        return view('users.edit', compact('user', 'roles'));
    } //end of edit


    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($this->getUserData($request));
        $this->syncRolesAndPermissions($user, $request);
        session()->flash('success', __('User updated successfully'));
        return redirect()->route('users.index');
    } //end of update


    public function destroy(User $user)
    {
        $user->detachRoles($user->getRoles());
        $user->detachPermissions($user->allPermissions());
        //end of detaching roles and permissions

        $user->delete();
        session()->flash('success', __('User Deleted Successfully'));
        return redirect()->route('users.index');
    } //end of destroy
}
