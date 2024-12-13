<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(){
        return view('home.home');
    }

    public function index(){
        if (Auth::id()) {
            $role = Auth()->user()->role;

            if ($role == 'superadmin') {
                $users = User::select('name', 'role', 'email', 'phone_number')->get();
                // Pass the users data to the view
                return view('superadmin.index', compact('users'));

            } elseif ($role == 'admin') {
                $notifications = Notification::where('user_id', Auth::id())
                    ->orderByDesc('created_at')
                    ->take(5)  // Adjust the number to display
                    ->get();  // Always returns a Collection
                $users = User::where('role', 'customer')->get();
                return view('admin.index', compact('notifications', 'users'));

            } elseif ($role == 'customer') {  // Use == to check equality
                return view('customer.index');

            } elseif ($role == 'Meter_Reader') {  // Use == to check equality
                $notifications = Notification::where('user_id', Auth::id())
                    ->orderByDesc('created_at')
                    ->take(5)  // Adjust the number to display
                    ->get();  // Always returns a Collection
                    $users = User::where('role', 'customer')->get();
                return view('meterreader.index', compact('notifications','users'));
            }
        } else {
            return redirect()->back();
        }
    }
}
