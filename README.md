### PHP User Registration System

A simple PHP application for user registration following MVC-like architecture.

https://github.com/user-attachments/assets/89e4c705-a7de-4f15-8977-d2d7eb7c0ad8

### Prerequisites

- XAMPP (or similar PHP development environment)
- Git
- Web browser

### Installation

1. Start the XAMPP server.

2. Navigate to the `htdocs` directory:
    ```
    cd /path/to/xampp/htdocs
    ```

3. Clone the repository:
    ```
    git clone https://github.com/jemcv/php.git
    ```

4. Navigate to the project directory:
    ```
    cd php
    ```

### Usage

Open your web browser and navigate to:
```
http://localhost/php
```

### Project Structure

```
php/
├── app/
│   ├── controllers/
│   │   └── UserController.php
│   ├── models/
│   │   └── User.php
│   └── views/
│       └── register.php
├── config/
│   └── config.php
├── public/
│   ├── index.php
│   └── uploads/
├── README.md
└── .htaccess
```

### Directory Explanation

- `app/`: Core application files
  - `controllers/`: Handles application logic
  - `models/`: Interacts with the database
  - `views/`: Contains user interface files
- `config/`: Configuration files
- `public/`: Publicly accessible files
  - `uploads/`: Stores user-uploaded files
- `.htaccess`: Server configuration
