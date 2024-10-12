<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade

class AdminController extends Controller
{
    // Show admin dashboard with user management
    public function index()
    {
        // Ensure only admins can access this section
        if (Auth::check() && Auth::user()->role === 'admin') {
            // Fetch all users to display on the admin dashboard
            $users = User::all();
            return view('admin.dashboard', compact('users'));
        }

        // Redirect non-admins to the client dashboard
        return redirect('/client/dashboard')->with('error', 'Access denied.');
    }

    // Method to change user roles between admin and client
    public function changeRole(Request $request, $id)
    {
        // Prevent admin from changing their own role
        if (Auth::user()->id == $id) {
            return redirect()->back()->with('error', 'You cannot change your own role.');
        }

        // Find the user and toggle their role
        $user = User::findOrFail($id);
        $user->role = $user->role === 'client' ? 'admin' : 'client';
        $user->save();

        return redirect()->back()->with('success', 'User role updated successfully.');
    }
}
