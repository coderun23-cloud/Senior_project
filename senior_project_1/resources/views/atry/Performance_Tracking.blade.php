<!DOCTYPE html>
<html lang="en">
  <head>
    @include('superadmin.css')
    <style>
     


      h1 {
        color: #000000;
        font-weight: bold;
        margin-top: 20px;
      }

      .alert-success {
        padding: 15px;
        background-color: #d4edda;
        color: #155724;
        margin-bottom: 20px;
        border-radius: 5px;
      }

      table {
        width: 100%;
        margin-top: 30px;
        border-collapse: collapse;
      }

      th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
      }

      th {
        background-color: #f8f9fa;
        color: #333;
      }

      tr:hover {
        background-color: #f1f1f1;
      }

      td {
        color: #333;
      }

      .form-container {
        margin-top: 50px;
        margin-bottom: 20px;
        display: flex;
        justify-content: flex-start;
      }

      select {
        padding: 10px;
        font-size: 14px;
        border-radius: 5px;
        border: 1px solid #ccc;
        outline: none;
        width: 200px;
      }

      select:focus {
        border-color: #0066cc;
      }

      option {
        font-size: 14px;
        padding: 10px;
      }

      td a {
        color: #007bff;
        text-decoration: none;
        padding: 5px 10px;
        background-color: #e7f1ff;
        border-radius: 5px;
        transition: background-color 0.3s;
      }

      td a:hover {
        background-color: #cce0ff;
      }

      /* Button Style for Role Filter */
      select {
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        padding: 8px;
        font-size: 14px;
        border-radius: 5px;
        cursor: pointer;
      }

      select:focus {
        border-color: #0056b3;
        box-shadow: 0 0 5px rgba(0, 86, 179, 0.4);
      }
       /* Modal Styles */
         /* Modal Background */
         .modal {
            display: none; 
            position: fixed;
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5); /* Darker background */
            transition: opacity 0.3s ease-in-out;
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 30px;
            border-radius: 8px;
            width: 60%;
            max-width: 500px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1), 0 6px 20px rgba(0,0,0,0.1);
            animation: modalSlideIn 0.5s ease-out;
        }

        /* Modal Content Animation */
        @keyframes modalSlideIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal h3 {
            font-size: 24px;
            color: #333;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .modal p {
            font-size: 18px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        /* Close Button */
        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 20px;
            cursor: pointer;
            transition: color 0.3s ease-in-out;
        }

        .close:hover,
        .close:focus {
            color: #000;
        }

        /* Button Styling */
        .view-button {
            color: #fff;
            background-color: #007bff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .view-button:hover {
            background-color: #0056b3;
        }

        /* Table Styling */
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

        /* Form and Filters Styling */
        .form-container {
            margin-bottom: 20px;
        }

        select {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-right: 10px;
            cursor: pointer;
            transition: border-color 0.3s ease-in-out;
        }

        select:focus {
            border-color: #007bff;
            outline: none;
        }
        
    </style>
  </head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <body>
    @include('superadmin.header')

    <!-- Sidebar Navigation-->
    @include('superadmin.sidebar')

    <div class="page-content" style="background-color: white;">
      <div class="container-fluid">
        <h1 style=" font-weight:bolder;text-align: center;font-size:30px;margin-top:20px;">PERFORMANCE TRACKING TABLE</h1>

        <!-- Filter for Admin or Meter Reader -->
       
        <div class="form-container" style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 30px; align-items: center;">
          <!-- Filter Form -->
          <form action="{{ url('Performance_Tracking') }}" method="GET" style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
        
            <!-- Role Filter -->
            <div>
              <label for="role" style="font-size: 16px; font-weight: bold; margin-right: 10px;">Filter by Role:</label>
              <select name="role" id="role" onchange="this.form.submit()"
                style="padding: 10px; font-size: 14px; border-radius: 5px; border: 1px solid #ccc; background-color: #f8f9fa;">
                <option value="">-- Select Role --</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="Meter Reader" {{ request('role') == 'meter_reader' ? 'selected' : '' }}>Meter Reader</option>
              </select>
            </div>
        
            <!-- Date Range Filter -->
           
        
           
        
            <!-- Apply Button -->
            <div>
          
            
            </div>
            
          </form>
        </div>
                
        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Performance</th>
           
            </tr>
          </thead>
   
          <tbody>
            @foreach($users as $index => $user)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td> <!-- Display role (Meter Reader, Admin, etc.) -->
                <td>
                  <button class="view-button" data-user-id="{{ $user->id }}" data-role="{{ $user->role }}">View Performance</button>
                </td>
              
                
              </tr>
            @endforeach
          </tbody>
          @if($users->isEmpty())
          <p style="text-align: center; font-size: 18px; color: #555; margin-top: 20px;">No users found matching the criteria.</p>
        @endif
        
        </table>
      </div>
    </div>
    
    <!-- Modal -->
    <div id="performanceModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3>Performance Details</h3>
            <p><strong>Number of Readings per Day:</strong> <span id="readings"></span></p>
            <p><strong>Number of Bills Generated:</strong> <span id="bills"></span></p>
            <p><strong>Number of Complaints Replied:</strong> <span id="complaints"></span></p>
        </div>
    </div>
    <script>

     document.addEventListener("DOMContentLoaded", function () {
    // Attach click event to the view performance buttons
    document.querySelectorAll(".view-button").forEach(button => {
        button.addEventListener("click", function () {
            const userId = this.getAttribute("data-user-id");
            const role = this.getAttribute("data-role");
            
            // Call showModal with the extracted values
            showModal(userId, role);
        });
    });
});

function showModal(userId, role) {
    // Get the modal
    var modal = document.getElementById('performanceModal');
    
    // Show modal
    modal.style.display = "block";

    // Clear existing content in modal
    document.getElementById('bills').textContent = '-';
    document.getElementById('complaints').textContent = '-';
    document.getElementById('readings').textContent = '-';

    // Fetch performance data based on role
    if (role === 'admin') {
        fetch(`/getAdminPerformance/${userId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('bills').textContent = data.bills || '-';
                document.getElementById('complaints').textContent = data.complaints || '-';
            });
    } else if (role === 'meter_reader') {
        fetch(`/getMeterReaderPerformance/${userId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('readings').textContent = data.readings || '-';
            });
    }
}

// Close Modal
function closeModal() {
    document.getElementById('performanceModal').style.display = "none";
}

    </script>
    @include('superadmin.footer')
  </body>
</html>
