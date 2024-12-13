<!DOCTYPE html>
<html>
  <head> 
    @include('superadmin.css')
    <style>
      h1 {
        text-align: center;
        color: black;
        padding: 30px;
      }
      .filter-form {
        margin-bottom: 20px;
      }
      .filter-group {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        align-items: center;
        margin-bottom: 20px;
      }
      .filter-group .form-group {
        flex: 1;
        min-width: 200px;
      }
      .btn {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
      }
      .btn:hover {
        background-color: #0056b3;
      }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  </head>

  <body>
    @include('superadmin.header')
    @include('superadmin.sidebar')
    <div class="page-content" style="background-color: white;">
      <div class="container-fluid">
        <div class="text-end mb-4 mt-2" >
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createTariffModal">
                <i class="">+</i> Create New Tariff
            </button>
        </div>
          
          <h1 style="font-size: 30px; font-weight: bolder;">Tariff History</h1>
          @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
          @endif
        <!-- Filter Form -->
        <form method="GET" action="{{ url('history_tariff') }}" class="filter-form">
          <div class="filter-group">
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
            
            <!-- Apply Filters Button -->
            <div class="form-group">
              <button type="submit"  class="btn btn-primary btn-sm" style="padding: 10px; border-radius:5px;">Apply Filters</button>
              <a style="  text-decoration:none;padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;" href="{{url('/history_tariff')}}">Reset</a>
            </div>
          </div>
        </form>
     
      
        <!-- Tariff History Table -->
    <!-- Tariff History Table -->
<table class="table table-bordered mt-4">
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
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateTariffModal{{ $tariff->id }}">
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
            <div class="modal fade" id="updateTariffModal{{ $tariff->id }}" tabindex="-1" aria-labelledby="updateTariffModalLabel" aria-hidden="true">
                <div class="modal-dialog">
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


        <!-- Pagination -->
        <div class="pagination">
          {{ $tariffs->links() }}
        </div>
      </div>
    </div>
    <div class="modal fade" id="createTariffModal" tabindex="-1" aria-labelledby="createTariffModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content"style="background-color: white;">
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
                        <input type="date" id="effective-date" name="effective_date" class="form-control" required>
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

    @include('superadmin.footer')
  </body>
</html>
