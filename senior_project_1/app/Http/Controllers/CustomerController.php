<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\User;
use App\Models\Customer;
use App\Models\complaint;
use Illuminate\Http\Request;
use App\Models\CustomerEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// Make sure you have a Mailable class
class CustomerController extends Controller
{
    //


    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Save the user to the database (create new user with email, password and role)
        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'customer', // Default role
        ]);

        // Prepare customer profile data
        $profileData = [
            'name' => $validated['full_name'],
            'address' => $validated['address'] ?? null,
            'phone_number' => $validated['phone_number'] ?? null,
        ];

        // Handle profile picture upload
        if ($request->hasFile('image')) {
            $profileData['image'] = $request->file('image')->store('profiles', 'public');
        }

        // Save the customer profile
        Customer::create($profileData);

        // Redirect to the customer index page with a success message
        return redirect('/index')->with('success', 'Customer created successfully.');
    }
    

        public function notifications()
        {
           $notifications=CustomerEmail::where('user_id',Auth::id())->get();
            return view('customer.notifications', compact('notifications'));
        }
        public function complaint_service(){
            $data = Complaint::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
       return view('customer.complaint_service',compact('data'));
        }
        public function store_complaint(Request $request)
        {
            $request->validate([
                'subject' => 'required|string|max:255',
                'description' => 'required|string|max:1000',
            ]);
    
            // Create the complaint
            $complaint = complaint::create([
                'user_id' => Auth::id(), // Get the currently logged-in user's ID
                'subject' => $request->subject,
                'description' => $request->description,
                'status' => 'Pending', // Default status
            ]);
    
            if ($complaint) {
                return redirect()->back()->with('success', 'Your complaint has been submitted successfully.');
            }
    
            return redirect()->back()->with('error', 'There was an issue submitting your complaint. Please try again.');
        }
        public function profile_show(){
           
            return view('customer.profile');
        }
        

        public function bill(Request $request)
        {
            $query = Bill::query()->where('user_id', auth()->id());
        
            // Filter by date
            if ($request->filled('from')) {
                $query->whereDate('created_at', '>=', $request->from);
            }
        
            if ($request->filled('to')) {
                $query->whereDate('created_at', '<=', $request->to);
            }
        
            // Filter by amount
            if ($request->filled('amount')) {
                $query->where('amount', $request->amount);
            }
        
            // Filter by status
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }
        
            // Paginate results
            $bills = $query->orderBy('created_at', 'desc')->paginate(10);
        
            return view('customer.bill', compact('bills'));
        }
        

}
        
    

    

