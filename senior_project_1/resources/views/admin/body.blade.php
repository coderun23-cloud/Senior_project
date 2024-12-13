<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-xl-6 col-xxl-5 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card mb-4 rounded-lg">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Total Meters</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="home"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">2,382</h1>
                                    <div class="mb-0">
                                        <span class="text-danger">-3.65%</span>
                                        <span class="text-muted">Since last month</span>
                                    </div>
                                </div>
                            </div><br><br>
                            <div class="card mb-4 rounded-lg">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Registered Customers</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">14,212</h1>
                                    <div class="mb-0">
                                        <span class="text-success">5.25%</span>
                                        <span class="text-muted">Since last month</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card mb-4 rounded-lg">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Total Revenue</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="dollar-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">ETB 21,300</h1>
                                    <div class="mb-0">
                                        <span class="text-success">6.65%</span>
                                        <span class="text-muted">Since last month</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-4 rounded-lg">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Pending Payments</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="shopping-cart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">64</h1>
                                    <div class="mb-0">
                                        <span class="text-danger">-2.25%</span>
                                        <span class="text-muted">Since last month</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-xxl-7" id="chart">
                <div class="card flex-fill w-100 mb-4 rounded-lg">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Monthly Consumption</h5>
                    </div>
                    <div class="card-body py-3">
                        <div class="chart chart-sm">
                            <canvas id="chartjs-dashboard-line"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6 col-xxl-3 d-flex order-2 order-xxl-3">
                <div class="card flex-fill w-100 mb-4 rounded-lg">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Billing Payment Status</h5>
                    </div>
                    <div class="card-body d-flex">
                        <div class="align-self-center w-100">
                            <div class="py-3">
                                <div class="chart chart-xs">
                                    <canvas id="chartjs-dashboard-pie"></canvas>
                                </div>
                            </div>

                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td>Paid</td>
                                        <td class="text-end">4,306</td>
                                    </tr>
                                    <tr>
                                        <td>Unpaid</td>
                                        <td class="text-end">3,801</td>
                                    </tr>
                                    <tr>
                                        <td>Overdue</td>
                                        <td class="text-end">1,689</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
                <div class="card flex-fill w-100 mb-4 rounded-lg">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Meter Status</h5>
                    </div>
                    <div class="card-body px-4" id="map">
                        <div id="ethiopia_map" style="height: 350px;"></div>
                    </div>
                </div>
            </div>
            
            <!-- Include Leaflet.js CSS -->
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
            
            <!-- Include Leaflet.js JavaScript -->
            <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
            
            <script>
                // Initialize the map and set its view to Ethiopia's coordinates
                var map = L.map('ethiopia_map').setView([9.145, 40.4897], 6); // Coordinates for Ethiopia
            
                // Add a tile layer (this will use OpenStreetMap as the base layer)
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
            
                // Optional: Add a marker at a location (e.g., Addis Ababa)
                L.marker([9.03, 38.74]).addTo(map)
                    .bindPopup('Addis Ababa')
                    .openPopup();
            </script>
            
            <div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
                <div class="card flex-fill mb-4 rounded-lg">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Billing Calendar</h5>
                    </div>
                    <div class="card-body d-flex">
                        <div class="align-self-center w-100">
                            <div class="chart">
                                <div id="datetimepicker-dashboard"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-8 col-xxl-9 d-flex" id="table">
                <div class="card flex-fill mb-4 rounded-lg">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Recent Customers</h5>
                    </div>
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer Name</th>
                                <th class="d-none d-xl-table-cell">Email</th>
                                <th class="d-none d-xl-table-cell">Phone Number</th>
                                <th class="d-none d-md-table-cell">Registration Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user )
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->name}}</td>
                                <td class="d-none d-xl-table-cell">{{$user->email}}</td>
                                <td class="d-none d-xl-table-cell">{{$user->phone_number}}</td>
                                <td><span class="badge bg-secondary">{{$user->created_at->format('y-m-d')}}</span></td>
                            </tr>   
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-xxl-3 d-flex">
                <div class="card flex-fill w-100 mb-4 rounded-lg">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Monthly Revenue</h5>
                    </div>
                    <div class="card-body d-flex w-100">
                        <div class="align-self-center chart chart-lg">
                            <canvas id="chartjs-dashboard-bar"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<!-- Include necessary libraries for the datetime picker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script>
    // Initialize the calendar and set it to today's date
    $('#datetimepicker-dashboard').datepicker({
        format: 'yyyy-mm-dd', // Set the format for the date
        todayBtn: "linked",   // Highlight the "today" button
        autoclose: true,      // Close the calendar when a date is selected
        todayHighlight: true, // Highlight today's date
        setDate: new Date()   // Set the date to today's date
    });
</script>
