<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('User/Index', [
            'daftarJabatan' => Jabatan::all(),
            'users'         => User::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create([
            ...$request->all(),
            ...$request->validate([
                'name'      => 'required|string|max:255',
                'email'     => 'required|email|unique:users,email',
                'password'  => 'required|string|min:8',
                'jabatan'   => 'required'
            ])            
        ]);

        return back()->with('success', 'User baru berhasil ditambahkan');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password'  => 'nullable|string|min:8',
            'jabatan'   => 'required'
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return back()->with('success', $user->name . ' berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
