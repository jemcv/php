<?php
require_once '../../config/config.php';
require_once '../models/User.php';

class UserController
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            try {
                $user = new User($this->db);
                $email = $this->validateEmail();

                if ($user->emailExists($email)) {
                    $this->sendResponse('Email already exists.', 409);
                    return;
                }

                $user->first_name = $this->sanitizeInput('first_name');
                $user->last_name = $this->sanitizeInput('last_name');
                $user->middle_name = $this->sanitizeInput('middle_name');
                $user->email = $email;
                $user->phone_number = $this->sanitizeInput('phone_number');
                $user->profile_image = $this->handleFileUpload($_FILES['profile_image']);

                if ($user->create()) {
                    $_SESSION['registration_success'] = true;
                    $_SESSION['user_data'] = [
                        'first_name' => $user->first_name,
                        'last_name' => $user->last_name,
                        'middle_name' => $user->middle_name,
                        'email' => $user->email,
                        'phone_number' => $user->phone_number,
                        'profile_image' => $user->profile_image
                    ];
                    $this->sendResponse('User registered successfully.', 201);
                } else {
                    $this->sendResponse('Failed to register user.', 500);
                }
            } catch (Exception $e) {
                $this->sendResponse($e->getMessage(), 400);
            }
        }
    }

    private function sanitizeInput($field)
    {
        return filter_var($_POST[$field] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    private function validateEmail()
    {
        $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
        if (!$email) {
            throw new Exception('Invalid email address.');
        }
        return $email;
    }

    private function handleFileUpload($file)
    {
        $target_dir = "../../public/uploads/";
        $unique_id = uniqid(); 
        $target_file = $target_dir . $unique_id . '_' . basename($file["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            throw new Exception('File is not an image.');
        }

        if ($file["size"] > 2 * 1024 * 1024) {
            throw new Exception('Sorry, your file is too large.');
        }

        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            throw new Exception('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
        }

        if (!move_uploaded_file($file["tmp_name"], $target_file)) {
            throw new Exception('Sorry, there was an error uploading your file.');
        }

        return basename($target_file);
    }

    private function sendResponse($message, $statusCode = 200)
    {
        http_response_code($statusCode);
        echo json_encode(['message' => $message]);
        exit();
    }
}

$controller = new UserController($conn);
$controller->register();