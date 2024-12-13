<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bill;
use App\Models\User;
use App\Models\Report;
use App\Models\Customer;
use App\Models\complaint;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\CustomerEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class AdminController extends Controller
{

    public function customer_status(Request $request)
    {
        $query = User::where('role', 'customer');
        
        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function($query) use ($searchTerm) {
                $query->where('name', 'like', "%$searchTerm%")
                    ->orWhere('email', 'like', "%$searchTerm%")
                    ->orWhere('phone_number', 'like', "%$searchTerm%");
            });
        }
    
        // Date range filter functionality
        if ($request->has('start_date') && $request->has('end_date') && $request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }
        
        $customers = $query->paginate(7);
    
        $notifications = Notification::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->take(5)
            ->get();
    
        return view('admin.customer_status', compact('customers', 'notifications'));
    }
    
    
   public function bill()
   {
       // Fetch all customers
       $customers = User::where('role', 'customer')->paginate(7);

       // Fetch notifications
       $notifications = Notification::where('user_id', Auth::id())
           ->orderByDesc('created_at')
           ->take(5) // Adjust the number to display
           ->get(); // Always returns a Collection

       return view('admin.bill', compact('customers', 'notifications'));
   }
   public function complaint(Request $request){
    $notifications = Notification::where('user_id', Auth::id())
    ->orderByDesc('created_at')
    ->take(5)
    ->get();

// Fetch complaints with search and date filter
$search = $request->input('search');
$from = $request->input('from');
$to = $request->input('to');

$complaints = Complaint::query()
    ->where(function ($query) use ($search) {
        if ($search) {
            $query->where('subject', 'LIKE', "%$search%")
                  ->orWhereHas('user', function ($subQuery) use ($search) {
                      $subQuery->where('name', 'LIKE', "%$search%");
                  });
        }
    })
    ->when($from, function ($query) use ($from) {
        $query->whereDate('created_at', '>=', $from);
    })
    ->when($to, function ($query) use ($to) {
        $query->whereDate('created_at', '<=', $to);
    })
    ->with('user') // Ensure user data is loaded
    ->orderBy('created_at', 'desc')
    ->paginate(7);

return view('admin.complaint', compact('notifications', 'complaints'));
   }
   public function message(Request $request){
    $notifications = Notification::where('user_id', Auth::id())
    ->orderByDesc('created_at')
    ->take(5)  // Adjust the number to display
    ->get();  // Always returns a Collection
    $user = auth()->user();

    // Start building the query for notifications
    $notificationsQuery = Notification::where('user_id', $user->id);

    // Filter by date if both start_date and end_date are provided
    if ($request->has('start_date') && $request->has('end_date')) {
        $start_date = Carbon::parse($request->input('start_date'))->startOfDay();
        $end_date = Carbon::parse($request->input('end_date'))->endOfDay();
        $notificationsQuery->whereBetween('sent_at', [$start_date, $end_date]);
    }

    // Get paginated notifications (this will automatically handle the count for you)
    $Notification = $notificationsQuery->latest()->paginate(5);
    return view('admin.message', compact('notifications','Notification'));
   }
   public function notification(Request $request){
    $notifications = Notification::where('user_id', Auth::id())
    ->orderByDesc('created_at')
    ->take(5)  // Adjust the number to display
    ->get();  // Always returns a Collection
    $query = Customer::query();

    // Apply date filters if provided
    if ($request->has('start_date') && $request->has('end_date')) {
        $query->whereBetween('created_at', [
            $request->input('start_date') . ' 00:00:00', 
            $request->input('end_date') . ' 23:59:59'
        ]);
    }

    // Get the filtered customers
    $customers = $query->paginate(5);
    return view('admin.notification',compact('notifications','customers'));
   }
   public function sendNotification(Request $request)
   {
       $request->validate([
           'user_email' => 'required|email|exists:users,email',
           'notification_type' => 'required|string',
           'message' => 'required|string',
       ]);
   
       // Find the customer by email
       $customer = User::where('email', $request->user_email)->first();
   
       // Save the notification
       $notification = CustomerEmail::create([
           'user_id' => $customer->id,
           'type' => $request->notification_type,
           'message' => $request->message,
       ]);
   
       // Send the email
       Mail::send('emails.customer', ['notification' => $notification], function ($message) use ($customer) {
           $message->to($customer->email)
               ->subject('New Notification');
       });
   
       return back()->with('success', 'Notification sent successfully!');
   }
   public function send_complaint(Request $request){
    $request->validate([
        'user_email' => 'required|email|exists:users,email',
       
        'message' => 'required|string',
    ]);

    // Find the customer by email
    $customer = User::where('email', $request->user_email)->first();

    // Save the notification
    $notification = CustomerEmail::create([
        'user_id' => $customer->id,
        'type' => 'response',
        'message' => $request->message,
    ]);

    // Send the email
    Mail::send('emails.customer', ['notification' => $notification], function ($message) use ($customer) {
        $message->to($customer->email)
            ->subject('New Notification');
    });

    return back()->with('success', 'Notification sent successfully!');

   }
   public function getBillDetails($customerId)
   {
       // Assuming you're using Eloquent and have a relationship with Bill
       $customer = User::find($customerId); // Replace with actual logic to fetch the customer
   
       if ($customer) {
           // Return customer details as JSON, including the email
           return response()->json([
               'customer_name' => $customer->name,
               'email' => $customer->email,
               'bill_amount' => $customer->bill->amount, // Assuming bill is a relationship
               'status' => $customer->bill->status,
               'created_at' => $customer->bill->created_at->toDateString(), // Or use your preferred format
           ]);
       } else {
           return response()->json(['error' => 'Customer not found'], 404);
       }
   }
   
   
   public function generate_bill($customerId)
   {
       // Find the customer
       $customer = User::findOrFail($customerId);
   
       // Check if a bill already exists for the customer in the current month
       $existingBill = Bill::where('user_id', $customerId)
                           ->whereYear('created_at', now()->year)
                           ->whereMonth('created_at', now()->month)
                           ->first();
   
       if ($existingBill) {
           return redirect()->back()->with('error', 'Bill already generated for this month.');
       }
   
       // Generate and save the bill
       $bill = Bill::create([
           'user_id' => $customerId,
           'amount' => $this->calculateBillAmount($customer), // Replace with actual logic
           'status' => 'unpaid',
           'meter_reading_id' => 1  // Example, replace with actual meter reading ID
       ]);
   
       return redirect()->back()->with('success', 'Bill generated successfully.');
   }
   
   
   // Example calculation logic (adjust as needed)
   private function calculateBillAmount($customer)
   {
       // Logic to calculate bill based on customer data, tariffs, etc.
       return 100; // Placeholder amount
   }
   
   public function reports(Request $request){
    $notifications = Notification::where('user_id', Auth::id())
    ->orderByDesc('created_at')
    ->take(5)  // Adjust the number to display
    ->get(); 
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
   
    return view('admin.report',compact('notifications','users','reports'));
   }
   public function getAllBills()
   {
       $bills = Bill::with('customer') // Assuming Bill has a relationship with Customer
                    ->orderBy('created_at', 'desc')
                    ->get(['id', 'amount', 'status', 'created_at', 'user_id']);
   
       return response()->json($bills);
   }
   
   public function generateReport(Request $request)
   {
       // Validate input data
       $request->validate([
           'report_type' => 'required|string',
           'target_user_id' => 'required|exists:users,id',
           'metrics' => 'required|string',
       ]);

       // Save the report to the database
       $report = new Report;
       $report->report_type = $request->report_type;
       $report->generated_by = auth()->user()->name;  // Assuming you're using auth to get the logged-in user
       $report->target_user_id = $request->target_user_id;
       $report->metrics = $request->metrics;
       $report->save();

       return back()->with('success', 'Report generated successfully.');
   }

   public function downloadReport($id)
   {
       $report = Report::findOrFail($id);
       
       // Assuming you want to download as PDF
       $pdf = PDF::loadView('reports.report_pdf', compact('report'));
       return $pdf->download('report_'.$report->id.'.pdf');
   }
}
