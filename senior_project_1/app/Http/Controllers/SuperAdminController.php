<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Report;
use App\Models\Tariff;
use Illuminate\Support\Str;
use App\Mail\AccountDeleted;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Mail\UserPasswordMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NewNotification;

class SuperAdminController extends Controller
{
   
    public function tariff(){
        return view('superadmin.tariff');
    }
    public function store(Request $request)
    {
        $request->validate([
            'tariff_name' => 'required|string|max:255',
            'unit_range' => 'required|string|max:255',
            'price_per_unit' => 'required|numeric',
            'effective_date' => 'required|date',
        ]);

        Tariff::create($request->all());

        return redirect('/history_tariff')->with('success', 'Tariff generated successfully!');
    }
    public function history_tariff(Request $request)
    {
        $query = Tariff::query();
    
        // Filter by Tariff Name
        if ($request->filled('tariff_name')) {
            $query->where('tariff_name', 'like', '%' . $request->tariff_name . '%');
        }
    
        // Filter by Date Range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('effective_date', [$request->start_date, $request->end_date]);
        }
    
        // Filter by Unit Range
        if ($request->filled('unit_min') && $request->filled('unit_max')) {
            $query->where(function ($q) use ($request) {
                $q->whereRaw("CAST(SUBSTRING_INDEX(unit_range, '-', 1) AS UNSIGNED) >= ?", [$request->unit_min])
                  ->whereRaw("CAST(SUBSTRING_INDEX(unit_range, '-', -1) AS UNSIGNED) <= ?", [$request->unit_max]);
            });
        }
    
        $tariffs = $query->paginate(6);
        $index = ($tariffs->currentPage() - 1) * $tariffs->perPage() + 1;
    
        return view('superadmin.history_tariff', compact('tariffs', 'index'));
    }
    
    public function add_user(Request $request){
        $query = User::query()->whereIn('role', ['Meter_Reader', 'admin']);
    
        // Apply role filter if selected
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }
    
        // Apply date range filter if both start_date and end_date are provided
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }
    
        // Search by name, email, or phone
        if ($request->filled('search')) {
            $query->where(function ($subquery) use ($request) {
                $subquery->where('name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('phone_number', 'LIKE', '%' . $request->search . '%'); // Assuming phone exists in User table
            });
        }
    
        $users = $query->paginate(6); // Paginate the results
        return view('superadmin.user',compact('users'));

    }
    public function store_user(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'role' => 'required|string',
        ]);
    
        // Check if email or phone number already exists
        $existingUser = User::where('email', $request->email)
            ->orWhere('phone_number', $request->phone_number)
            ->first();
    
        if ($existingUser) {
            // Return back with a warning message
            return redirect()->back()->withErrors([
                'email' => 'The email or phone number already exists.',
            ])->withInput();
        }
    
        // Generate a random password
        $generatedPassword = Str::random(12);
    
        // Create the user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($generatedPassword); // Hash password
        $user->phone_number = $request->phone_number;
        $user->role = $request->role;
        $user->address=$request->address;
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $user->image = $request->file('image')->store('images');
        }
    
        $user->save();
    
        // Send an email with the password
        Mail::to($user->email)->send(new UserPasswordMail($user, $generatedPassword));
    
        return redirect()->back()->with('success', 'User created and email sent successfully.');
    }
    public function Notification(Request $request){
        $query = Notification::query();

        // Apply role filter
        if ($request->filled('role')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('role', $request->role);
            });
        }
    
        // Apply "Sent At" filter
        if ($request->filled('sent_at')) {
            $query->whereDate('sent_at', $request->sent_at);
        }
    
        $notifications = $query->with('user')->get();
        return view('superadmin.Notification',compact('notifications'));
    }
    public function send_mail(Request $request)
    {
        $request->validate([
            'user_email' => 'required|email',
            'notification_type' => 'required|string',
            'message' => 'required|string',
        ]);
    
        // Find the user by email
        $user = User::where('email', $request->user_email)->first();
    
        if (!$user) {
            return redirect()->back()->withErrors(['user_email' => 'User not found']);
        }
    
        // Create a new notification
        $notification = Notification::create([
            'user_id' => $user->id,
            'notification_type' => $request->notification_type,
            'message' => $request->message,
            'sent_at' => now(),
            'is_read' => false,
        ]);
    
        // Send email notification to the user (Admin or Meter Reader)
        $user->notify(new NewNotification($notification));
    
        return redirect('/Notification')->with('success', 'Notification created and email sent!');
    }
    public function Performance_Tracking(Request $request)
    {
        $query = User::query()->whereIn('role', ['meter reader', 'admin']);
    
        // Apply role filter if selected
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }
    
        // Apply date range filter if both start_date and end_date are provided
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }
    
        // Search by name, email, or phone
        if ($request->filled('search')) {
            $query->where(function ($subquery) use ($request) {
                $subquery->where('name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('phone_number', 'LIKE', '%' . $request->search . '%'); // Assuming phone exists in User table
            });
        }
    
        $users = $query->paginate(10); // Paginate the results
    
        return view('superadmin.performance_tracking', compact('users'));
    }
    public function getAdminPerformance($id)
{
    // Fetch admin performance data
    $user = User::findOrFail($id);
    $bills = $user->bills()->count(); // Assuming a `bills` relationship exists
    $complaints = $user->complaints()->count(); // Assuming a `complaints` relationship exists
    
    return response()->json([
        'bills' => $bills,
        'complaints' => $complaints
    ]);
}

public function getMeterReaderPerformance($id)
{
    // Fetch meter reader performance data
    $user = User::findOrFail($id);
    $readings = $user->readings()->count(); // Assuming a `readings` relationship exists
    
    return response()->json([
        'readings' => $readings
    ]);
}
public function destroy($id)
{
    $user = User::find($id);

    if ($user) {
        // Delete the user
        $user->delete();

        // Send email notification
        Mail::to($user->email)->send(new AccountDeleted($user));

        return redirect()->back()->with('success', 'User deleted and email sent successfully.');
    }

    return redirect()->back()->with('error', 'User not found.');
}



// Update the existing tariff
public function update_tariff(Request $request, $id)
{
    // Validate the form data
    $validated = $request->validate([
        'tariff_name' => 'required|string|max:255',
        'unit_range' => 'required|string|max:255',
        'price_per_unit' => 'required|numeric',
        'effective_date' => 'required|date',
    ]);

    // Find the tariff and update it
    $tariff = Tariff::findOrFail($id);
    $tariff->update($validated);

    return redirect()->back()->with('success', 'Tariff updated successfully.');
}

// Delete the specified tariff
public function destroy_tariff($id)
{
    // Find the tariff and delete it
    $tariff = Tariff::findOrFail($id);
    $tariff->delete();

    return redirect()->back()->with('success', 'Tariff deleted successfully.');
}
public function search(Request $request)
{
    $category = $request->input('category', 'all');
    $query = $request->input('query', '');

    $results = [];

    if (!empty($query)) {
        if ($category === 'all' || $category === 'tariffs') {
            $results['tariffs'] = Tariff::where('tariff_name', 'like', "%$query%")->get();
        }
        if ($category === 'all' || $category === 'users') {
            $results['users'] = User::where('name', 'like', "%$query%")->orWhere('email', 'like', "%$query%")->get();
        }
      
        if ($category === 'all' || $category === 'notifications') {
            $results['notifications'] = Notification::where('title', 'like', "%$query%")->orWhere('message', 'like', "%$query%")->get();
        }
    }

    return view('superadmin.search', compact('results', 'query', 'category'));
}
public function view_reports(Request $request){
    $users = User::where('role','superadmin')->get(); // You can add filtering here if needed
  
    $query = Report::query();

    if ($request->has('report_type') && $request->report_type != '') {
        $query->where('report_type', $request->report_type);
    }

    if ($request->has('start_date') && $request->start_date != '') {
        $query->whereDate('created_at', '>=', $request->start_date);
    }

    if ($request->has('end_date') && $request->end_date != '') {
        $query->whereDate('created_at', '<=', $request->end_date);
    }

    $reports = $query->paginate(6);
        
    // Return the view and pass the $users variable
   
    return view('superadmin.view_reports',compact('users','reports'));
   
}
}

 

    

