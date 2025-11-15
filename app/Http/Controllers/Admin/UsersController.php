<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $data = User::orderBy('id', 'desc')->paginate(5);
        return view('admin.users.index', compact('data'));
    }

    public function create()
    {
        $action = route('admin.users.store');
        return view('admin.users.create_update', compact('action'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.users.index');
    }

    public function edit($id)
    {
        $record = User::findOrFail($id);
        $action = route('admin.users.update', $id);

        return view('admin.users.create_update', compact('record', 'action'));
    }

    public function update(Request $request, $id)
    {
        $record = User::findOrFail($id);

        $request->validate([
            'name'  => 'required',
            'email' => "required|email|unique:users,email,{$id}"
        ]);

        $record->name = $request->name;
        $record->email = $request->email;

        if ($request->password) {
            $record->password = Hash::make($request->password);
        }

        $record->save();

        return redirect()->route('admin.users.index');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.users.index');
    }
}
