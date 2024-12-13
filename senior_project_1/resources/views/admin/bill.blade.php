<!DOCTYPE html>
<html lang="en">
@include('admin.css')
<style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f3f4f6;
        margin: 0;
        padding: 0;
        color: #ffffff;
    }

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
        color: #ffffff;
        padding: 15px;
        font-size: 1rem;
        text-align: left;
    }

    .static-table td {
        padding: 15px;
        font-size: 0.95rem;
        color: #000000;
        border-bottom: 1px solid #444;
        background-color: #f3f4f6;
    }

    .static-table tr:hover {
        background-color: #2c3e50;
    }

    .btn {
        border-radius: 6px;
        font-size: 0.95rem;
        padding: 10px 15px;
        text-align: center;
        cursor: pointer;
    }

    .btn-success {
        background-color: #3498db;
        color: #fff;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-success:hover {
        background-color: #2980b9;
    }

    .btn-primary {
        background-color: #2980b9;
        color: #fff;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        opacity: 0.8;
    }

    .modal-content {
        background-color: #2c3e50;
        border-radius: 8px;
        color: #ffffff;
    }

    .modal-header {
        background-color: #34495e;
        color: #fff;
        border-bottom: none;
    }

    .modal-footer {
        background-color: #34495e;
        border-top: none;
    }

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
        color: #3498db;
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
        background-color: #ffffff;
        pointer-events: none;
    }

    @media (max-width: 768px) {
        .static-table th,
        .static-table td {
            font-size: 0.9rem;
            padding: 10px;
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

            <div class="container mt-4">
                <h1 style="font-weight: bolder;">
                    <i class="far fa-money-bill-alt"></i> Customers Bill List
                </h1>
                <br>
                @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<button 
    class="btn btn-secondary mb-3" 
    id="show-all-bills-btn" 
    data-bs-toggle="modal" 
    data-bs-target="#showBillsModal">
    Show All Generated Bills
</button>


                
                    <table class="static-table" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer Name</th>
                                <th>Generate Bill</th>
                                <th>View Details</th>
                                 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>
                                        <form action="{{ url('generate_bill', $customer->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary generate-bill-btn">
                                                Generate Bill
                                            </button>
                                        </form>
                                    </td>
                                  
                                    <td>
                                        <button 
                                            class="btn btn-secondary btn-sm view-details-btn" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#updateTariffModal" 
                                            data-name="{{ $customer->name }}" 
                                            data-email="{{ $customer->email }}" 
                                            data-id="{{ $customer->id }}">
                                            View Details
                                        </button>
                                    </td>
                              
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                
             
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
                </nav><br><br><br>
            </div>


            <div class="modal fade" id="updateTariffModal" tabindex="-1" aria-labelledby="updateTariffModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateTariffModalLabel">Bill Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="customer-name">Customer Name</label>
                                <input type="text" id="customer-name" class="form-control" readonly>
                            </div>
                            <div class="form-group mt-3">
                                <label for="customer-email">Customer Email</label>
                                <input type="text" id="customer-email" class="form-control" readonly>
                            </div>
                            <div class="form-group mt-3">
                                <label for="bill-amount">Bill Amount</label>
                                <input type="text" id="bill-amount" class="form-control" value="120" readonly>
                            </div>
                            <div class="form-group mt-3">
                                <label for="bill-amount">Meter Reading</label>
                                <input type="text" id="bill-amount" class="form-control" value="320kmh" readonly>
                            </div>
                            <div class="form-group mt-3">
                                <label for="bill-amount">Tariff Type</label>
                                <input type="text" id="bill-amount" class="form-control" value="standard" readonly>
                            </div>
                            <input type="hidden" id="customer-id">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="showBillsModal" tabindex="-1" aria-labelledby="showBillsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="showBillsModalLabel">Generated Bills</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="bills-container">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Customer Name</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Generated At</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bills-list">
                                        <!-- Bills will be dynamically inserted here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            

            @include('admin.footer')
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const viewDetailButtons = document.querySelectorAll(".view-details-btn");
            const modalName = document.getElementById("customer-name");
            const modalEmail = document.getElementById("customer-email");
            const modalId = document.getElementById("customer-id");

            viewDetailButtons.forEach(button => {
                button.addEventListener("click", function () {
                    const name = this.dataset.name;
                    const email = this.dataset.email;
                    const id = this.dataset.id;

                    modalName.value = name;
                    modalEmail.value = email;
                    modalId.value = id;
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
    const showAllBillsButton = document.getElementById("show-all-bills-btn");
    const billsList = document.getElementById("bills-list");

    showAllBillsButton.addEventListener("click", async function () {
        // Clear previous bills
        billsList.innerHTML = "<tr><td colspan='5'>Loading...</td></tr>";

        try {
            const response = await fetch(`/get_all_bills`);
            const bills = await response.json();

            if (bills.length > 0) {
                billsList.innerHTML = bills.map((bill, index) => `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${bill.customer?.name || 'Unknown Customer'}</td>
                        <td>${bill.amount}</td>
                        <td>${bill.status}</td>
                        <td>${bill.created_at}</td>
                    </tr>
                `).join('');
            } else {
                billsList.innerHTML = "<tr><td colspan='5'>No bills found.</td></tr>";
            }
        } catch (error) {
            console.error('Error fetching bills:', error);
            billsList.innerHTML = "<tr><td colspan='5'>Failed to load bills.</td></tr>";
        }
    });
});
    </script>
</body>
