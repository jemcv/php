<?php
session_start();
if (!isset($_SESSION['registration_success']) || $_SESSION['registration_success'] !== true) {
    header('Location: register.php');
    exit();
}

$user_data = $_SESSION['user_data'] ?? [];
unset($_SESSION['registration_success']);
unset($_SESSION['user_data']);

$first_name = htmlspecialchars($user_data['first_name'] ?? '');
$last_name = htmlspecialchars($user_data['last_name'] ?? '');
$middle_name = htmlspecialchars($user_data['middle_name'] ?? '');
$email = htmlspecialchars($user_data['email'] ?? '');
$phone_number = htmlspecialchars($user_data['phone_number'] ?? '');
$profile_image = htmlspecialchars($user_data['profile_image'] ?? '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
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
        .centered-container {
            height: 100vh;
        }
        .bg-light-opacity {
            background-color: #1E1F21;
            border: 1px solid white;
        }
    </style>
    <title>Registration Successful</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center centered-container">
        <div class="bg-light-opacity p-5 rounded">
            <h1>Registration Successful</h1>
            <p>First Name: <?php echo $first_name; ?></p>
            <p>Last Name: <?php echo $last_name; ?></p>
            <p>Middle Name: <?php echo $middle_name; ?></p>
            <p>Email: <?php echo $email; ?></p>
            <p>Phone Number: <?php echo $phone_number; ?></p>
            <p>Profile Image:</p>
            <img src="../../public/uploads/<?php echo $profile_image; ?>" alt="Profile Image" style="max-width: 200px;">
            <br><br>
            <div class="d-flex">
                <a href="register.php" class="btn btn-primary">Back to Registration</a>
                <a href="registered_users.php" class="btn btn-secondary ms-2">View List of Users</a>
            </div>
        </div>
    </div>
</body>
</html>