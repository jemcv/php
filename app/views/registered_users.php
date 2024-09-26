<?php
require_once '../../config/config.php';
require_once '../models/User.php';

class UserController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function listUsers() {
        $query = "SELECT first_name, middle_name, last_name, email, profile_image, phone_number, created_at FROM users";
        $result = $this->db->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

$controller = new UserController($conn);
$users = $controller->listUsers();
?>
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
            background-repeat: repeat;
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
    <title>Registered Users</title>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mt-5">
            <h1>Registered Users</h1>
            <a href="register.php" class="btn btn-primary">Register Another User</a>
        </div>
        <table class="table table-striped table-dark">
            <thead class="bg-light-opacity">
                <tr>
                    <th>First Name</th>
                    <th> Middle Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Profile Image</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($users): ?>
                    <?php foreach ($users as $user): ?>
                        <tr class="bg-light-opacity">
                            <td><?php echo htmlspecialchars($user['first_name']); ?></td>
                            <td><?php echo htmlspecialchars($user['middle_name'])?></td>
                            <td><?php echo htmlspecialchars($user['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['phone_number']) ?></td>
                            <td>
                                <img src="../../public/uploads/<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile Image" style="max-width: 100px;">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr class="bg-light-opacity">
                        <td colspan="4">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>