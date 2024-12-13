<!DOCTYPE html>
<html lang="en">
@include('admin.css')
<style>
    /* General Styles */
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f3f4f6;
        margin: 0;
        padding: 0;
        color: #ecf0f1;  /* Light color text */
    }

    /* Header Section */
    h1 {
        text-align: center;
        font-size: 2.5rem;
        color: #000000;  /* Light text for header */
        margin-bottom: 1rem;
    }

    h1 i {
        color: #3498db;  /* Blue icon color */
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
        border: 1px solid #7f8c8d;  /* Lighter gray for borders */
        border-radius: 6px;
        font-size: 1rem;
        width: 300px;
        outline: none;
        transition: border-color 0.3s ease;
    }

    .filter-form input:focus,
    .filter-form select:focus {
         /* Dark Blue for table background */
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

    .filter-form button:hover {
        background-color: #2980b9;  /* Darker blue on hover */
    }

    .filter-form a {
        color: #fff;
        text-decoration: none;
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
        background-color: #34495e;  /* Dark Blue for table background */
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

      
        /* Light border for table rows */
    }

    .static-table tr:hover {
        background-color: #2c3e50;  /* Darker hover effect */
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
        border: 1px solid #7f8c8d;
        border-radius: 5px;
        color: #3498db;  /* Blue for pagination links */
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

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<body>
    <div class="wrapper">
        @include('admin.sidebar')
        <div class="main" >
            @include('admin.header')

            <br>
            <h1 style="font-weight: bolder;">
                <i class="fas fa-users"></i>Customers List
            </h1>
            <br>
            <!-- Filter Section -->
      <!-- Filter Section -->
<div class="filter-form">
    <form method="GET" action="{{ url('customer_status') }}">
        <input type="text" name="search" class="search-input" placeholder="Search by Name, Phone, Email" value="{{ request('search') }}">
        <button class="btn btn-secondary" type="submit">Search</button>
        
        <span style="font-weight: bolder">From:</span> 
        <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}">
        
        <span style="font-weight: bolder">To:</span> 
        <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}">
        
        <button class="btn btn-secondary" type="submit">Filter</button>
        <button class="btn btn-secondary">
            <a style="color: white;" href="{{ url('customer_status') }}">Reset</a>
        </button>
    </form>
</div>


            <!-- Static Table -->
            <table class="static-table" style="height: 400px; margin-bottom:4rem;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $customer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone_number }}</td>
                            <td>{{ $customer->address ?? 'Not Available' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No Customer found matching the criteria.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <nav class="pagination">
                @if ($customers->onFirstPage())
                    <span class="disabled">Previous</span>
                @else
                    <a href="{{ $customers->previousPageUrl() }}">Previous</a>
                @endif

                @foreach ($customers->getUrlRange(1, $customers->lastPage()) as $page => $url)
                    <a href="{{ $url }}" class="{{ $page == $customers->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                @endforeach

                @if ($customers->hasMorePages())
                    <a href="{{ $customers->nextPageUrl() }}">Next</a>
                @else
                    <span class="disabled">Next</span>
                @endif
            </nav>

            @include('admin.footer')
        </div>
    </div>
</body>
</html>
