<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name'          =>  'required',
                'email'         =>  'required|email|unique:users',
                'hobbies'       =>  'required|array',
                'hobbies.*'     =>  'string|max:50'
            ],
            [
                'name.required'         =>  'Correct Name is required.',
                'email.required'         =>  'Email Address is required.',
                'hobbies.required'    => 'Atleast 1 Hobby are required.'
            ]
        );

        $name = $request->input('name');
        $email = $request->input('email');
        $hobbiesArray = $request->input('hobbies');
        $hobbiesString = implode(', ', $hobbiesArray);

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->hobbies = $hobbiesString;

        $user->save();

        return redirect()->route('user.index')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name'          =>  'required',
                'email'         =>  'required|email|unique:users,email,' . $id,
                'hobbies'       =>  'required|array',
                'hobbies.*'     =>  'string|max:50'
            ],
            [
                'name.required'         =>  'Correct Name is required.',
                'email.required'         =>  'Email Address is required.',
                'hobbies.required'    => 'Atleast 1 Hobby are required.'
            ]
        );

        $name = $request->input('name');
        $email = $request->input('email');
        $hobbiesArray = $request->input('hobbies');
        $hobbiesString = implode(', ', $hobbiesArray);

        $user = User::findOrFail($id);
        $user->name = $name;
        $user->email = $email;
        $user->hobbies = $hobbiesString;

        $user->save();

        return redirect()->route('user.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully!');
    }
}
