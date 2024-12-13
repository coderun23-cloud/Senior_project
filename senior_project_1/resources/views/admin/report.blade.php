<!DOCTYPE html>
<html lang="en">
@include('admin.css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
	/* General Styles */
	body {
		font-family: 'Roboto', sans-serif;
		background-color: #2c3e50;
		color: #ecf0f1;
		margin: 0;
		padding: 0;
	}
  
	/* Header Section */
	h1 {
		text-align: center;
		font-size: 2.5rem;
		color: #000000;
		margin-bottom: 1rem;
	}
  
	h1 i {
	  color: #3498db;
	  margin-right: 0.5rem;
	}
  
	/* Filter Section */
	.filter-form {
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
		gap: 15px;
	   
		padding: 15px;
		border-radius: 8px;
		box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
		margin-bottom: 20px;
	}
  
	.filter-form input,
	.filter-form select {
		padding: 10px 15px;
		border: 1px solid #ccc;
		border-radius: 6px;
		font-size: 1rem;
		width: 300px;
		outline: none;
		transition: border-color 0.3s ease;
		color: #000000;
	}
  
	.filter-form input:focus,
	.filter-form select:focus {
	
  }
  
	.filter-form button {
		padding: 10px 25px;
		color: #fff;
		border: none;
		border-radius: 6px;
		font-size: 1rem;
		cursor: pointer;
		transition: background-color 0.3s ease;
	}
	
	/* Table Styles */
	.static-table {
		  width: 100%;
		  max-width: 90%;
		  margin: 0 auto;
		  border-collapse: collapse;
		  background-color: #34495e;  /* Dark Blue for table background */
		  border-radius: 8px;
		  overflow: hidden;
		  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
	  }
  
	.static-table th {
	  background-color: #34495e;
	  color: #fff;
		padding: 15px;
		font-size: 1rem;
		text-align: left;
	}
  
	.static-table td {
		  padding: 15px;
		  font-size: 0.95rem;
		  color: #000000;  /* Light text color for table cells */
		  border-bottom: none; 
		  background-color: #f3f4f6;
	  }
  
	.static-table tr:hover {
		background-color: #3e4c59;
	}
  
	.static-table tbody tr:last-child td {
		border-bottom: none;
	}
  
	/* Pagination Styles */
	.pagination {
		display: flex;
		justify-content: center;
		gap: 10px;
		margin-top: 20px;
	}
  
	.pagination a,
	.pagination span {
		padding: 10px 15px;
		font-size: 1rem;
		border: 1px solid #ddd;
		border-radius: 5px;
		color: #000000;
		text-decoration: none;
		transition: background-color 0.3s ease, color 0.3s ease;
	}
  
	.pagination a:hover {
		  background-color: #34495e;
  
		color: #fff;
	}
  
	.pagination .active {
		  background-color: #34495e;
  
		color: #fff;
		pointer-events: none;
	}
  
	.pagination .disabled {
		color: #aaa;
		background-color: #f1f1f1;
		pointer-events: none;
	}
  
	/* Responsive Design */
	@media (max-width: 768px) {
		.filter-form input,
		.filter-form select,
		.filter-form button {
			width: 100%;
			margin: 5px;
		}
  
		.static-table th,
		.static-table td {
			padding: 10px;
			font-size: 0.9rem;
		}
	}
</style>
<body>
    <div class="wrapper">
        @include('admin.sidebar')
        <div class="main">
            @include('admin.header')
			<br>
            <h1 style="font-weight: bolder;"><i class="fas fa-file-alt me-2" style="margin-right: 15px;"></i>Report List</h1><br>
			<div class="container mt-4">
                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#generateReportModal">
                    Generate Report
                </button>
            </div>
            <!-- Filter Form -->
            <div class="container mt-4">
                <form class="filter-form" method="GET" action="{{ url('reports') }}">
                    @csrf
                    <select name="report_type" class="form-select">
                        <option value="">Select Report Type</option>
                        <option value="monthly_consumption">Monthly Consumption</option>
                        <option value="billing_status">Billing Status</option>
                        <option value="customer_growth">Customer Growth</option>
                    </select>
                    
                    <input type="date" name="start_date" class="form-control" placeholder="Start Date">
                    <input type="date" name="end_date" class="form-control" placeholder="End Date">
                    
                    <button type="submit" class="btn btn-secondary">Filter</button>
					<button class="btn btn-secondary"><a style="color: white;text-decoration:none;" href="{{url('reports')}}">Reset</a></button>
                </form>
            </div>

            <!-- Button to trigger the modal -->
         

            <!-- Modal for Report Generation -->
            <div class="modal fade" id="generateReportModal" tabindex="-1" aria-labelledby="generateReportModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="generateReportModalLabel">Create New Report</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ url('reports') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="report_type" class="form-label">Report Type</label>
                                    <select id="report_type" name="report_type" class="form-select">
                                        <option value="monthly_consumption">Monthly Consumption</option>
                                        <option value="billing_status">Billing Status</option>
                                        <option value="customer_growth">Customer Growth</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="target_user_id" class="form-label">Target User</label>
                                    <select id="target_user_id" name="target_user_id" class="form-select">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="metrics" class="form-label">Metrics</label>
                                    <textarea id="metrics" name="metrics" class="form-control" rows="3" placeholder="Enter metrics for the report"></textarea>
                                </div>

                                <button type="submit" class="btn btn-secondary">Generate Report</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Display Success Message -->
            @if (session('success'))
                <div class="alert alert-success mt-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Existing Reports Table -->
            <br>
            <div class="card-body">
                @if($reports->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        No reports have been generated yet.
                    </div>
                @else
                    <table class="static-table" id="customerTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Report Type</th>
                                <th>Generated By</th>
                                <th>Target User</th>
                                <th>Metrics</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $report)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $report->report_type }}</td>
                                <td>{{ $report->generated_by }}</td>
                                <td>{{ $report->targetUser->name }}</td>
                                <td>{{ $report->metrics }}</td>
                                <td>{{ $report->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <a href="{{ route('download.report', $report->id) }}" class="btn btn-secondary">Download</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
			<nav class="pagination">
				@if ($reports->onFirstPage())
					<span class="disabled">Previous</span>
				@else
					<a href="{{ $reports->previousPageUrl() }}">Previous</a>
				@endif
  
				@foreach ($reports->getUrlRange(1, $reports->lastPage()) as $page => $url)
					<a href="{{ $url }}" class="{{ $page == $reports->currentPage() ? 'active' : '' }}">{{ $page }}</a>
				@endforeach
  
				@if ($reports->hasMorePages())
					<a href="{{ $reports->nextPageUrl() }}">Next</a>
				@else
					<span class="disabled">Next</span>
				@endif
			</nav>
  <br>
  <br>
  <br>
            @include('admin.footer')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
