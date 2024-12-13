<!DOCTYPE html>
<html>
  <head> 
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


/* Close Button */
.close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 20px;
    font-weight: bold;
    color: #555;
    cursor: pointer;
}

.close:hover {
    color: #000;
}

/* Modal Title */


.form-group label {
    font-size: 14px;
    color: #555;
    margin-bottom: 5px;
    display: block;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
    color: #333;
}

.form-control:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

.file-input {
    border: none;
    padding: 0;
}

.btn-submit {
    background-color: #007bff;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.btn-submit:hover {
    background-color: #0056b3;
}

/* Trigger Button */
.open-modal-btn {
    background-color: #28a745;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    margin: 10px 0;
}

.open-modal-btn:hover {
    background-color: #218838;
}

/* Animations */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
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
        .add-user-button {
  padding: 10px 20px;
  background-color: #28a745;
  color: white;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
  margin-bottom: 20px;
}

.add-user-button:hover {
  background-color: #218838;
}
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    z-index: 1000;
     /* Enable flexbox */
    justify-content: center; /* Center horizontally */
    align-items: center;
}

/* Modal Content */
.modal-content {
    background: #fff;
    border-radius: 10px;
    padding: 20px 30px;
    width: 400px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    animation: fadeIn 0.3s ease-in-out;
    position: relative;
}

/* Close Button */
.close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 20px;
    font-weight: bold;
    color: #555;
    cursor: pointer;
}

.close:hover {
    color: #000;
}

/* Modal Title */
.modal-title {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 20px;
    text-align: center;
    color: #333;
}

/* Form */
.modal-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.form-group label {
    font-size: 14px;
    color: #555;
    margin-bottom: 5px;
    display: block;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
    color: #333;
}

.form-control:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

.file-input {
    border: none;
    padding: 0;
}

.btn-submit {
    background-color: #007bff;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.btn-submit:hover {
    background-color: #0056b3;
}

/* Trigger Button */
.open-modal-btn {
    background-color: #28a745;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    margin: 10px 0;
}

.open-modal-btn:hover {
    background-color: #218838;
}

/* Animations */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}
.table{
    height: 70vh;
}

      .sidebar-nav-item {
      margin-bottom: 15px; /* Adds space between each sidebar item */
  }
  
  .sidebar-nav-link {
      display: flex;
      align-items: center;
      padding: 10px 15px; /* Adds padding to the links for better spacing */
  }
  
  .sidebar-nav-link i {
      margin-right: 10px; /* Adds space between the icon and the text */
  }
  
input{
  height: 50px;
  width: 150px;
  border-radius: 5px;
}
  </style>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

   @include('superadmin.css')

  </head>
  <body>
  @include('superadmin.header')
 
      <!-- Sidebar Navigation-->
      <div class="">
   @include('superadmin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="wrapper">
   
      <div class="flex flex-col md:flex-row">
      <div style=" padding: 20px;"> <!-- Aded padding for better spacing -->
        <button class="" onclick="openAddUserModal()" style="padding: 10px 20px; background-color:green; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">+ Add User</button>
        <h1 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: bolder; text-align: center; font-size: 36px; color: #333;">
          <i class="fas fa-users" style="margin-right: 15px; color: green;"></i>
          ALL USERS
        </h1>
        <!-- Filter for Admin or Meter Reader -->
        <div class="form-container" style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 30px; align-items: center;">
          <!-- Filter Form -->
          <form action="{{ url('add_user') }}" method="GET" style="display: flex; flex-wrap: wrap; gap: 15px; align-items: center; width: 100%;">
      
            <!-- Role Filter -->
            <div>
              <label for="role" style="font-size: 16px; font-weight: bold; margin-right: 10px;">Filter by Role:</label>
              <select name="role" id="role" onchange="this.form.submit()" style="padding: 10px; font-size: 14px; border-radius: 5px; border: 1px solid #ccc; background-color: #f8f9fa; width: 200px;">
                <option value="">-- Select Role --</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="Meter Reader" {{ request('role') == 'Meter Reader' ? 'selected' : '' }}>Meter Reader</option>
              </select>
            </div>
      
            <!-- Date Range Filter -->
            <div>
              <label for="start_date" style="font-size: 16px; font-weight: bold; margin-right: 10px;">From:</label>
              <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" style="padding: 10px; font-size: 14px; border-radius: 5px; border: 1px solid #ccc; background-color: #f8f9fa;">
              
              <label for="end_date" style="font-size: 16px; font-weight: bold; margin-left: 10px; margin-right: 10px;">To:</label>
              <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" style="padding: 10px; font-size: 14px; border-radius: 5px; border: 1px solid #ccc; background-color: #f8f9fa;">
            </div>
      
            <!-- Search by Name, Phone Number, or Email -->
            <div style="flex: 1; margin-bottom: 12px;">
              <label for="search" style="font-size: 16px; font-weight: bold; margin-right: 10px;">Search:</label>
              <input type="text" name="search" id="search" placeholder="Enter name, email, or phone number" value="{{ request('search') }}" style="padding: 10px; font-size: 14px; width: 100%; border-radius: 5px; border: 1px solid #ccc; background-color: #f8f9fa;">
            </div>
      
            <!-- Apply Button -->
            <div style="display: flex; align-items: center; gap: 10px;">
              <button type="submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">Apply Filters</button>
              <a style="text-decoration: none; padding: 10px 20px;  background-color: #6c757d;color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;" href="{{ url('/add_user') }}">Reset</a>
            </div>
      
          </form>
        </div>
      
        @if(session('success'))
          <div class="alert alert-success alert-dismissible">{{ session('success') }}</div>
        @endif
      </div>
    
      
      <div class="table" style=" overflow-x: auto;"> <!-- Added margin-left and overflow-x for responsiveness -->
        <table style="width: 100%; border-collapse: collapse;">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Phone Number</th>
              <th>Action</th>
            </tr>
          </thead>
      
          <tbody>
            @foreach($users as $index => $user)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>{{$user->phone_number}}</td>
                <td>
                  <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background: none; border: none; color: red; cursor: pointer;">
                      <i class="fa fa-trash" aria-hidden="true" style="font-size: 18px;"></i>
                    </button>
                  </form>
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
      </div>
      @include('superadmin.footer')
      <div id="addUserModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddUserModal()">&times;</span>
            <h3 class="modal-title">Add New User</h3>
            <form action="{{ url('user_store') }}" method="POST" enctype="multipart/form-data" class="modal-form">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="" disabled selected>Select role</option>
                        <option value="admin">Admin</option>
                        <option value="Meter Reader">Meter Reader</option>
                    </select>
                </div>
                  <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control" required>
                            </div>
                <div class="form-group">
                    <label for="photo">Photo:</label>
                    <input type="file" name="photo" id="photo" class="form-control file-input" accept="image/*" required>
                </div>
               <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" name="password" id="password" class="form-control" value="{{ Str::random(12) }}" readonly>
                            </div>
                <button type="submit" class="btn-submit">Add User</button>
            </form>
        </div>
    </div>
    
    
      <script>
        function closeAddUserModal() {
            document.getElementById('addUserModal').style.display = "none";
        }
    
        function openAddUserModal() {
            document.getElementById('addUserModal').style.display = "flex";
        }
    </script>
  </body>
</html>