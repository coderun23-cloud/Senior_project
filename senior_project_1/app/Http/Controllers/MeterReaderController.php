<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Report;
use App\Models\Reading;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeterReaderController extends Controller
{
    //
    public function readings(){
        $notifications = Notification::where('user_id', Auth::id())
        ->orderByDesc('created_at')
        ->take(3)  
        ->get();  
        return view('meterreader.readings',compact('notifications'));
    }
    public function service_cutoff(){
        $notifications = Notification::where('user_id', Auth::id())
        ->orderByDesc('created_at')
        ->take(3)  
        ->get(); 
        return view('meterreader.service_cutoff',compact('notifications'));
    }
    public function manual_reading(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'reading_type' => 'required|string',
            
        ]);
    
        // Find the customer by name
        $customer = User::where('name', $validated['customer_name'])->first();
    
        if (!$customer) {
            return redirect()->back()->with('alert', 'User cannot be found');
        }
    
        // Save the bill (reading) to the database
        $reading = new Reading();
        $reading->customer_id = $customer->id; // Store the customer ID
        $reading->amount = $validated['amount'];
        $reading->reading_type = 'manual'; // 'scanning' is passed in the form or use the default
        $reading->reading_date = now(); // Use the submitted date
        $reading->meter_reader_id = Auth::id(); // Store the logged-in meter reader's ID
        $reading->save();
    
        return redirect()->back()->with('success', 'Reading registered successfully');
    }
     // Store the bill data in the database
     public function store(Request $request){

            $validated = $request->validate([
                'customer_name' => 'required|string|max:255',  // Validate customer name
                'scanned_amount' => 'required|numeric',  // Validate amount
            ]);

            // Check if the customer exists in the users table
            $user = User::where('name', $validated['customer_name'])->first();

            if (!$user) {
                // If the user doesn't exist, return an error response
            return redirect()->back()->with('alert', 'User cannot be found');
            }

            // If the customer exists, save the reading to the database
            $reading = new Reading();
            $reading->customer_id = $user->id;  // Link the reading to the user
            $reading->amount = $validated['scanned_amount'];
            $reading->reading_type = 'scanning';  // Set the reading type (scanned)
            $reading->reading_date = now();  // Use the current date for the reading
            $reading->meter_reader_id = Auth::id();  // Store the logged-in meter reader's ID
            $reading->save();

            // Return a success response
            return redirect()->back()->with('success', 'Reading registered successfully');
        }

        public function notification_reader(Request $request){
            $notifications = Notification::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->take(3)  
            ->get(); 
             // Start query to get messages
    $query = Notification::where('user_id', auth()->id());

    // Apply date filters if provided
  if ($request->has('start_date') && $request->has('end_date')) {
        $start_date = Carbon::parse($request->input('start_date'))->startOfDay();
        $end_date = Carbon::parse($request->input('end_date'))->endOfDay();
        $query->whereBetween('sent_at', [$start_date, $end_date]);
    }
    // Get the filtered messages
    $messages = $query->get();

 
            return view('meterreader.notification',compact('notifications','messages'));
        }
        public function reports_reader(Request $request)
        {
            // Get notifications for the logged-in user
            $notifications = Notification::where('user_id', Auth::id())
                ->orderByDesc('created_at')
                ->take(3)
                ->get(); 
            
            // Get users with role 'superadmin' (if needed for filtering)
            $users = User::where('role', 'superadmin')->get();
            
            $query = Report::where('user_id',Auth::id());

            // Filter by report type
            if ($request->has('report_type') && $request->report_type != '') {
                $query->where('report_type', $request->report_type);
            }
        
            // Filter by start date
            if ($request->has('start_date') && $request->start_date != '') {
                $query->whereDate('created_at', '>=', $request->start_date);
            }
        
            // Filter by end date
            if ($request->has('end_date') && $request->end_date != '') {
                $query->whereDate('created_at', '<=', $request->end_date);
            }
        
            // Get the filtered reports
            $reports = $query->paginate(10);
            // Return view with the relevant data
            return view('meterreader.report', compact('notifications', 'users', 'reports'));
        }
        
        public function generateReportReader(Request $request)
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
       $report->user_id=Auth::id();
       $report->save();

       return back()->with('success', 'Report generated successfully.');
   }
   public function updateReport(Request $request, $id)
{
    // Validate the input data
    $validated = $request->validate([
        'report_type' => 'required|string',
        'target_user_id' => 'required|exists:users,id',
        'metrics' => 'required|string',
    ]);

    // Find the report and update it with validated data
    $report = Report::findOrFail($id);
    $report->update([
        'report_type' => $validated['report_type'],
        'target_user_id' => $validated['target_user_id'],
        'generated_by' => auth()->user()->name, // Assuming you're using auth to get the logged-in user
        'user_id' => Auth::id(),
        'metrics' => $validated['metrics'],
    ]);

    return redirect()->back()->with('success', 'Report updated successfully.');
}

public function deleteReport($id)
{
    // Find and delete the report
    $report = Report::findOrFail($id);
    $report->delete();

    return back()->with('success', 'Report deleted successfully.');
}

}

