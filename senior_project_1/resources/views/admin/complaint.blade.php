<!DOCTYPE html>
<html lang="en">
@include('admin.css')
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

      
        /* Light border for table rows */
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<body>
    <div class="wrapper">
        @include('admin.sidebar')
        <div class="main">
            @include('admin.header')

            <br>
            <h1 style="font-weight: bolder;"><i class="fas fa-exclamation-triangle" style="margin-right: 15px;"></i>Complaint List</h1><br>
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <!-- Filter Section -->
            <div class="filter-form">
                <!-- Search Form -->
                <form method="GET" action="{{ url('complaint') }}" >
                    <input type="text"  name="search" class="search-input" placeholder="Search complaints by subject, customer name" value="{{ request('search') }}">
                    <button  class="bnt btn-secondary" type="submit">Search</button>
              
                    <label for="from">From:</label>
                    <input type="date" name="from" id="from" value="{{ request('from') }}">
                    
                    <label for="to">To:</label>
                    <input type="date" name="to" id="to" value="{{ request('to') }}">
                    
                    <button  class="bnt btn-secondary"type="submit">Filter</button>
                    <button class="bnt btn-secondary"><a style="color:white;text-decoration:none;" href="{{url('complaint')}}">Reset</a></button>
                </form>
            </div>
<br>
            <!-- Complaints Table -->
            <table class="static-table" id="customerTable" style="margin-bottom:8rem;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>Submitted At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($complaints as $complaint)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $complaint->user->name }}</td>
                            <td>{{ $complaint->subject }}</td>
                            <td>{{ $complaint->description }}</td>
                            <td>{{ $complaint->created_at->format('Y-m-d H:i:s') }}</td>
                            <td> <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#createNotificationModal" onclick="fillEmail('{{ $complaint->user->email }}')">
                              <i style="color: white;" class="fas fa-mail"></i> Send Respond
                          </button>  </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No complaints found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <nav class="pagination">
              @if ($complaints->onFirstPage())
                  <span class="disabled">Previous</span>
              @else
                  <a href="{{ $complaints->previousPageUrl() }}">Previous</a>
              @endif

              @foreach ($complaints->getUrlRange(1, $complaints->lastPage()) as $page => $url)
                  <a href="{{ $url }}" class="{{ $page == $complaints->currentPage() ? 'active' : '' }}">{{ $page }}</a>
              @endforeach

              @if ($complaints->hasMorePages())
                  <a href="{{ $complaints->nextPageUrl() }}">Next</a>
              @else
                  <span class="disabled">Next</span>
              @endif
          </nav>
<br>
<br>
<br>
    <!-- Modal to send notification -->
    <div class="modal fade" id="createNotificationModal" tabindex="-1" aria-labelledby="createNotificationModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="createNotificationModalLabel">Response</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="{{ url('send_complaint') }}" method="POST">
                      @csrf
                      <div class="form-group">
                          <label for="user_email">User Email (Receiver)</label>
                          <input type="email" name="user_email" id="user_email" class="form-control" required>
                      </div>

                      <div class="form-group">
                          <label for="message">Response</label>
                          <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
                      </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Send Respond</button>
              </div>
                  </form>
          </div>
      </div>
  </div>

          @include('admin.footer')
      </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // JavaScript function to fill the email

        // JavaScript function to fill the email field in the modal
        function fillEmail(email) {
            document.getElementById('user_email').value = email;
        }
    </script>
</body>
</html>
