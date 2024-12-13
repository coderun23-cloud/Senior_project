
<!DOCTYPE html>
<html lang="en">
@include('superadmin.css')
<style>

    /* Reset any unwanted styling on the pagination links */

.filter-form {
    display: flex;
    flex-wrap: wrap; /* Allows wrapping for smaller screens */
    align-items: center; /* Aligns items vertically */
    gap: 10px; /* Adds space between filter fields */
  }




  .form-group input {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    width: 270px;
    height: 50px; /* Uniform input width */
  }


  /* Button container styling */
  

  .btn {
    cursor: pointer;
    text-align: center;
    border: none;
    border-radius: 5px;
    padding: 10px 15px;
    font-size: 14px;
    transition: background-color 0.3s;
    
  }

  .btn-primary {
    background-color: green;
    color: white;
  }

  .btn-primary:hover {
    background-color: #bdbdbd;
  }

  .reset-btn {
    background-color: #6c757d;
    color: white;
    text-decoration: none;
    padding: 10px 15px;
    border-radius: 5px;
  }

  .reset-btn:hover {
    background-color: #5a6268;
    color: #cdcdcd;
  }
  table {
       width: 100%;
       margin-top: 20px;
       border-collapse: collapse;
       font-size: 16px;
       color: #333;
   }

   table th, table td {
       padding: 10px;
       text-align: left;
       border-bottom: 1px solid #ddd;
   }

   table th {
       background-color: #f4f4f4;
       font-weight: bold;
   }
  

</style>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<body>
	<div class="wrapper">
@include('superadmin.sidebar')
		<div class="main">
@include('superadmin.header')
<div class="flex flex-col md:flex-row">
  <div style=" padding: 20px;"> <!-- Aded padding for better spacing -->
    <div class="text-end mb-0 "> <!-- Adjusted the margin-top <-->
      
      <button style="background-color:color: green;" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createTariffModal" style=" font-size: 16px;">
        <i style="color: white;" class="fas fa-plus"></i> Create New Tariff
      </button>
    </div>
        <h1 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: bolder; text-align: center; font-size: 36px; color: #333;">
      <i class="fas fa-tag" style="margin-right: 15px;color: green;"></i>Tariff History
    </h1><br><br>
 
    <!-- Filter for Admin or Meter Reader -->
    <div class="form-container" style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 30px; align-items: center;">
      <!-- Filter Form -->
      <form method="GET" action="{{ url('history_tariff') }}" class="filter-form">
        <!-- Search by Tariff Name -->
        <div class="form-group">
          <label for="tariff-name">Search by Tariff Name</label>
          <input type="text" id="tariff-name" name="tariff_name" value="{{ request('tariff_name') }}" placeholder="Enter tariff name">
        </div>
      
        <!-- Date Range Filter -->
        <div class="form-group">
          <label for="start-date">Effective Date From</label>
          <input type="date" id="start-date" name="start_date" value="{{ request('start_date') }}">
        </div>
        <div class="form-group">
          <label for="end-date">To</label>
          <input type="date" id="end-date" name="end_date" value="{{ request('end_date') }}">
        </div>
      
        <!-- Unit Range Filter -->
        <div class="form-group">
          <label for="unit-range-min">Unit Range (kWh)</label>
          <input type="number" id="unit-range-min" name="unit_min" value="{{ request('unit_min') }}" placeholder="Min">
          <input type="number" id="unit-range-max" name="unit_max" value="{{ request('unit_max') }}" placeholder="Max" style="margin-top: 8px;">
        </div>
      
        <!-- Buttons -->
        <div class="form-group" style="margin-right: 0px;">
          <button type="submit" class="btn btn-primary " style="background-color: green;">Apply Filters</button>
          <a  href="{{ url('/history_tariff') }}" class="reset-btn">Reset</a>
        </div>
      </form>
    </div>
  
    @if(session('success'))
      <div class="alert alert-success alert-dismissible">{{ session('success') }}</div>
    @endif
  </div>

  <div class="table" style=" overflow-x: auto;">
  <table class="table table-bordered mt-4" >
    <thead>
        <tr>
            <th>#</th>
            <th>Tariff Name</th>
            <th>Unit Ranges</th>
            <th>Price Per Unit</th>
            <th>Effective Date</th>
            <th>Created Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($tariffs as $tariff)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $tariff->tariff_name }}</td>
                <td>{{ $tariff->unit_range }}</td>
                <td>{{ $tariff->price_per_unit }}</td>
                <td>{{ $tariff->effective_date }}</td>
                <td>{{ $tariff->created_at->format('Y-m-d') }}</td>
                <td>
                    <!-- Update Button -->
                    <button style="background-color: green;" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateTariffModal{{ $tariff->id }}">
                        Update
                    </button>
  
                    <!-- Delete Button -->
                    <form action="{{ route('tariffs.destroy', $tariff->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this tariff?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
  
            <!-- Update Tariff Modal -->
            <div  class="modal fade" id="updateTariffModal{{ $tariff->id }}" tabindex="-1" aria-labelledby="updateTariffModalLabel" aria-hidden="true">
                <div class="modal-dialog"style="background-color: white;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateTariffModalLabel">Update Tariff</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('tariffs.update', $tariff->id) }}">
                                @csrf
                                @method('PUT')
                                <!-- Tariff Name -->
                                <div class="form-group">
                                    <label for="tariff-name-{{ $tariff->id }}">Tariff Name</label>
                                    <input type="text" id="tariff-name-{{ $tariff->id }}" name="tariff_name" class="form-control" value="{{ $tariff->tariff_name }}" required>
                                </div>
  
                                <!-- Unit Range -->
                                <div class="form-group">
                                    <label for="unit-range-{{ $tariff->id }}">Unit Range (kWh)</label>
                                    <input type="text" id="unit-range-{{ $tariff->id }}" name="unit_range" class="form-control" value="{{ $tariff->unit_range }}" required>
                                </div>
  
                                <!-- Price Per Unit -->
                                <div class="form-group">
                                    <label for="price-per-unit-{{ $tariff->id }}">Price Per Unit ($)</label>
                                    <input type="number" id="price-per-unit-{{ $tariff->id }}" name="price_per_unit" class="form-control" value="{{ $tariff->price_per_unit }}" step="0.01" required>
                                </div>
  
                                <!-- Effective Date -->
                                <div class="form-group">
                                    <label for="effective-date-{{ $tariff->id }}">Effective Date</label>
                                    <input type="date" id="effective-date-{{ $tariff->id }}" name="effective_date" class="form-control" value="{{ $tariff->effective_date }}" required>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Tariff</button>
                        </div>
                            </form>
                    </div>
                </div>
            </div>
        @empty
            <tr>
                <td colspan="7" class="text-center">No tariffs found matching the criteria.</td>
            </tr>
        @endforelse
    </tbody>
  </table>
  </div>
  <nav>
    <ul class="pagination">
      @if ($tariffs->onFirstPage())
        <li class="page-item disabled">
          <span class="page-link">Previous</span>
        </li>
      @else
        <li class="page-item">
          <a class="page-link" href="{{ $tariffs->previousPageUrl() }}" rel="prev">Previous</a>
        </li>
      @endif
  
      @foreach ($tariffs->getUrlRange(1, $tariffs->lastPage()) as $page => $url)
        <li class="page-item {{ $page == $tariffs->currentPage() ? 'active' : '' }}">
          <a class="page-link" href="{{ $url }}">{{ $page }}</a>
        </li>
      @endforeach
  
      @if ($tariffs->hasMorePages())
        <li class="page-item">
          <a class="page-link" href="{{ $tariffs->nextPageUrl() }}" rel="next">Next</a>
        </li>
      @else
        <li class="page-item disabled">
          <span class="page-link">Next</span>
        </li>
      @endif
    </ul>
  </nav>
  </div>
  @include('superadmin.footer')

  </div>

	
	</div>


  <div class="modal fade" id="createTariffModal" tabindex="-1" aria-labelledby="createTariffModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: white;">
            <div class="modal-header">
                <h5 class="modal-title" id="createTariffModalLabel">Generate New Tariff</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('tariffs.store') }}">
                    @csrf
                    <!-- Tariff Name -->
                    <div class="form-group">
                        <label for="tariff-name">Tariff Name</label>
                        <input type="text" id="tariff-name" name="tariff_name" class="form-control" placeholder="Enter tariff name" required>
                    </div>

                    <!-- Unit Range -->
                    <div class="form-group">
                        <label for="unit-range">Unit Range (kWh)</label>
                        <input type="text" id="unit-range" name="unit_range" class="form-control" placeholder="e.g., 0-100" required>
                    </div>

                    <!-- Price Per Unit -->
                    <div class="form-group">
                        <label for="price-per-unit">Price Per Unit ($)</label>
                        <input type="number" id="price-per-unit" name="price_per_unit" class="form-control" placeholder="Enter price per unit" step="0.01" required>
                    </div>

                    <!-- Effective Date -->
                    <div class="form-group">
                        <label for="effective-date">Effective Date</label>
                        <input type="date" id="effective_date" name="effective_date" class="form-control" required min="2024-12-04">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Generate Tariff</button>
            </div>
                </form>
        </div>
    </div>
</div>

<script>
  $(function() {
      var dtToday = new Date();

      var month = dtToday.getMonth() + 1;
      var day = dtToday.getDate();
      var year = dtToday.getFullYear();

      // Ensuring month and day are two digits
      if (month < 10) month = '0' + month.toString();
      if (day < 10) day = '0' + day.toString();

      // Format date in YYYY-MM-DD
      var maxDate = year + '-' + month + '-' + day;

      // Set the minimum selectable date
      $('#effective_date').attr('min', maxDate);
  });
</script>

</body>

</html>