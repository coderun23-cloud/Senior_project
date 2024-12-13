<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
        }

        .registration-form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 600px;
            margin: 50px auto;
        }

        .registration-form h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .form-control {
            border-radius: 8px;
            box-shadow: none;
            margin-bottom: 15px;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .btn-primary {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            background-color: #007bff;
            border: none;
            font-size: 16px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-check-label {
            color: #555;
        }

        .image-upload {
            text-align: center;
            margin-bottom: 15px;
        }

        .image-upload input[type="file"] {
            display: none;
        }

        .image-upload img {
            max-width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-top: 10px;
        }

        .address-field {
            height: 120px;
            resize: none;
        }

        @media (max-width: 768px) {
            .registration-form {
                margin: 20px;
                padding: 20px;
            }

            .btn-primary {
                padding: 10px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="registration-form">
         
          @if (session()->has('alert'))
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
            {{ session()->get('alert') }}
        </div>
            @endif
            <h2>Customer Registration</h2>
            <form action="{{ route('register_form') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
            
                <div class="mb-3 image-upload">
                    <label for="image" class="form-label">Profile Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                    <div id="image-preview">
                        <img src="#" alt="Profile Image Preview" id="profile-img" style="display:none;">
                    </div>
                </div>
            
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required pattern="^\d{12}$" placeholder="e.g., 251XXXXXXXXX">
                </div>
            
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input class="form-control" id="address" name="address" type="text" required>
                </div>
            
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
            
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('profile-img');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
