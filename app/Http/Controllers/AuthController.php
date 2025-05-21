<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showRegisterForm() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2,
            'is_approved' => false,
        ]);

        return redirect('/login')->with('success', 'Registration submitted. Wait for approval.');
    }

    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        echo '<pre>';print_r($user);exit;
        // dd($user);

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        if ($user->role_id == 2 && !$user->is_approved) {
            return back()->withErrors(['email' => 'Your account is pending approval by the admin.']);
        }

        Auth::login($user);

        return $user->role_id == 1
            ? redirect('/admin/dashboard')
            : redirect('/customer/dashboard');
    }

    public function logout() {
        Auth::logout();
        return redirect('/login')->with('success', 'Logged out successfully');
    }

    public function adminDashboard() {
        $customers = User::where('role_id', 2)->get();
        return view('admin.dashboard', compact('customers'));
    }

    public function customerDashboard() {
        return view('customer.dashboard');
    }

    public function toggleApproval($id)
    {
        $customer = User::findOrFail($id);
        $customer->is_approved = !$customer->is_approved;
        $customer->save();

        return response()->json(['is_approved' => $customer->is_approved]);
    }



}
