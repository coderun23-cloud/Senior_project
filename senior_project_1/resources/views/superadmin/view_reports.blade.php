<!DOCTYPE html>
<html lang="en">
@include('superadmin.css')
<style>
	/* General Styles */
	body {
		font-family: 'Roboto', sans-serif;
		background-color: #fff;
		color: #2c3e50;
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
		color: rgb(1, 102, 1);
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
		background-color: #f9f9f9;
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
		color: #2c3e50;
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

	/* List Styles */
	.report-list {
		display: flex;
		flex-direction: column;
		gap: 15px;
		margin: 0 auto;
		width: 80%;
	}

	.report-item {
		background-color: #ffffff;
		color: #000000;
		padding: 25px;
		border-radius: 8px;
		box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
	}

	.report-item h5 {
		margin: 0;
		font-size: 1.25rem;
		font-weight: bolder;
	}

	.report-item p {
		margin: 5px 0;
		font-size: 1rem;
		padding: 10px;
	}

	.report-item .view-full-btn {
		background-color: green;
		color: #fff;
		padding: 10px 20px;
		text-decoration: none;
		border-radius: 6px;
		font-size: 1rem;
		transition: background-color 0.3s ease;
	}

	.report-item .full-details {
		display: none;
		margin-top: 15px;
		padding: 10px;
		background-color: #f9f9f9;
		border-radius: 6px;
	}

	.report-item .full-details p {
		font-size: 1rem;
		line-height: 1.5;
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
		color: #2c3e50;
		text-decoration: none;
		transition: background-color 0.3s ease, color 0.3s ease;
	}

	.pagination a:hover {
		background-color: #34495e;
		color: #fff;
	}

	.pagination .active {
		background-color: rgb(59, 79, 255);
		color: #fff;
		pointer-events: none;
	}

	.pagination .disabled {
		color: #aaa;
		background-color: #f1f1f1;
		pointer-events: none;
	}

	.report-item h4 {
		font-weight: bold;
	}

	/* Responsive Design */
	@media (max-width: 768px) {
		.filter-form input,
		.filter-form select,
		.filter-form button {
			width: 100%;
			margin: 5px;
		}

		.report-item h5,
		.report-item p {
			font-size: 0.9rem;
		}
	}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<body>
	<div class="wrapper">
		@include('superadmin.sidebar')
		<div class="main">
			@include('superadmin.header')
			<br>
			<!-- Filter Form -->
			<h1 style="font-weight: bolder;"><i class="fas fa-file-alt me-2" style="margin-right: 15px;"></i>Report List</h1><br>

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
					
					<button type="submit" class="btn btn-secondary" style="background-color: green;">Apply Filter</button>
					<button class="btn btn-secondary"><a style="color: white;text-decoration:none;" href="{{url('reports')}}">Reset</a></button>
				</form>
			</div>

			<div class="report-list">
				@foreach ($reports as $report)
				<div class="report-item">
					<h4>Report Type: {{ $report->report_type }}</h4>
					<p class="text-muted">Generated by: {{ $report->generated_by }}</p>
					

					<!-- Initially hide the metrics -->
				
					<!-- Button to View Full Details -->
					<a href="javascript:void(0);" class="view-full-btn" onclick="toggleDetails({{ $report->id }})">View Full</a>

					<!-- Full Report Details (Hidden by default) -->
					<div class="full-details" id="full-details-{{ $report->id }}">
						<p><strong>Metrics:</strong> {{ $report->metrics }}</p>
						<p><strong>Created At:</strong> {{ $report->created_at->format('Y-m-d H:i:s') }}</p>
					</div>
				</div>
				@endforeach
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
			
			<br><br><br>
			@include('superadmin.footer')
		</div>
	</div>

	<script>
		// Function to toggle the full report details and show the metrics
		function toggleDetails(reportId) {
			var detailsElement = document.getElementById('full-details-' + reportId);
			var metricsElement = document.getElementById('metrics-' + reportId);

			// Toggle full details visibility
			if (detailsElement.style.display === "none" || detailsElement.style.display === "") {
				detailsElement.style.display = "block";
				metricsElement.style.display = "block"; // Show metrics when full details are shown
			} else {
				detailsElement.style.display = "none";
				metricsElement.style.display = "none"; // Hide metrics when full details are hidden
			}
		}
	</script>
</body>
</html>
