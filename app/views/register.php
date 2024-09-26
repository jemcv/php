<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Roboto', sans-serif;
            color: white;
        }
        body {
            background-image: url('https://w.wallhaven.cc/full/nr/wallhaven-nrxrgj.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
        }
        .form-group.required .control-label:after {
            content: " *";
            color: red;
        }
        .centered-container {
            height: 100vh;
        }
        .bg-light-opacity {
            background-color: #1E1F21;
            border: 1px solid white;
        }
    </style>
    <title>User Registration</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center centered-container">
        <div class="bg-light-opacity p-5 rounded">
            <h2>User Registration</h2>
            <form action="../../app/controllers/UserController.php" method="POST" enctype="multipart/form-data" id="registerForm">
                <div class="form-group required">
                    <label for="first_name" class="control-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your first name" required>
                </div>
                <div class="form-group required">
                    <label for="last_name" class="control-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter your last name" required>
                </div>
                <div class="form-group">
                    <label for="middle_name" class="control-label">Middle Name</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Enter your middle name (optional)">
                </div>
                <div class="form-group required">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" required>
                </div>
                <div class="form-group required">
                    <label for="phone_number" class="control-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter your phone number" required>
                </div>
                <div class="form-group required">
                    <label for="profile_image" class="control-label">Profile Image</label>
                    <input type="file" class="form-control" id="profile_image" name="profile_image" required>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $('#registerForm').on('submit', function(e) {
        e.preventDefault();

        var fileInput = $('#profile_image')[0];
        var file = fileInput.files[0];

        if (file.size > 2 * 1024 * 1024) {
            alert('File size exceeds 2MB.');
            return;
        }

        var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (file && !allowedTypes.includes(file.type)) {
            alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
            return;
        }

        var formData = new FormData(this);

        $.ajax({
            url: '/php/app/controllers/UserController.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log('Raw response:', response);
                try {
                    var res = JSON.parse(response);
                    if (res.message === 'User registered successfully.') {
                        window.location.href = 'success.php';
                    } else if (res.message === 'Email already exists.') {
                        alert('This email is already registered. Please use a different email.');
                    } else {
                        alert(res.message);
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    alert('An error occurred while processing your request.');
                }
            },
            error: function(xhr) {
                console.log('Raw error response:', xhr.responseText);
                try {
                    var res = JSON.parse(xhr.responseText);
                    alert(res.message);
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    alert('An error occurred while processing your request.');
                }
            }
        });
    });
});
</script>
</html>