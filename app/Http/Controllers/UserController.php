<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $search = $request->input('search');

        $query = User::query();
        if ($search) {
            $query->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
        }
        
        $user = $query->orderBy('name', 'asc')->paginate(10);
        
        return view('member.author', compact('user'));
    }

    public function store(Request $request)
    {
         User::create([
            'name' => $request->name,
            'email' => $request->email,
            'slug' => Str::slug($request->name),
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('user.index')->with('success', 'Users added successfully');
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->slug = Str::slug($request->name);
        
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password); 
        }
    
        $user->role = $request->role;
    
        $user->save();
        return redirect()->route('user.index')->with('success', 'User updated successfully!');
    }

    public function profile(){
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }
        return view('users', compact('user'));
    }


    public function updateprofile(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->input('name');

        if ($request->input('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();
        return redirect()->back()->with('success', 'User updated successfully!');
    }
    
   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findorfail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User Berhasil Dihapus');
    }
}
