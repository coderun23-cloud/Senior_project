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
    }

    .filter-form input:focus,
    .filter-form select:focus {
        border-color: #27ae60;
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
      background-color: #2c3e50;
        color: #ffffff;
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
        background-color: #f9f9f9;
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
        color: #27ae60;
        text-decoration: none;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .pagination a:hover {
      background-color: #2c3e50;
        color: #fff;
    }

    .pagination .active {
      background-color: #2c3e50;
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
        <div class="main">
            @include('admin.header')
<br>
<h1 style="font-weight: bolder;">
                <i class="fas fa-envelope header-icon"></i>Total Messages Received
            </h1><br>

            <!-- Filter Form -->
            <div class="filter-form">
           
              <form method="GET" action="{{ url('message') }}">
                  <span style="font-weight: bolder">From:</span> <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}">
                 <span style="font-weight: bolder">To:</span> <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}">
                  <button class="btn btn-secondary" type="submit">Filter</button>
               
              </form>
              <button style="margin-top:2px;" class="btn btn-secondary">
                <a style="color: white;" href="{{ url('message') }}">Reset</a>
            </button>
          </div>

            <!-- Messages Table -->
            <table class="static-table" id="customerTable"style="height: 400px; margin-bottom:4rem;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Notification Type</th>
                        <th>Message</th>
                        <th>Sent At</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($Notification as $notification)
                      <tr class="@if($notification->notification_type == 'alert') alert-notification @elseif($notification->notification_type == 'message') message-notification @endif">
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $notification->notification_type }}</td>
                          <td>{{ $notification->message }}</td>
                          <td>{{ \Carbon\Carbon::parse($notification->sent_at)->format('d-m-y') }}</td>
                      </tr>
                  @endforeach
              
                  @if($Notification->isEmpty())
                      <tr>
                          <td colspan="5" class="text-center">No Messages found.</td>
                      </tr>
                  @endif
              </tbody>
              
            </table>

          

            <!-- Pagination -->
            <nav>
                <ul class="pagination">
                    @if ($Notification->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">Previous</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $Notification->previousPageUrl() }}" rel="prev">Previous</a>
                        </li>
                    @endif

                    @foreach ($Notification->getUrlRange(1, $Notification->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $Notification->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    @if ($Notification->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $Notification->nextPageUrl() }}" rel="next">Next</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">Next</span>
                        </li>
                    @endif
                </ul>
            </nav>

            @include('admin.footer')
        </div>
    </div>
    
</body>

</html>
