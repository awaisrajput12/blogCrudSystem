<?php
// Start the session at the very beginning of the script
session_start();

// Include database connection (ensure this file exists and is configured correctly)
require_once './config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $username = trim($_POST['username']);
    $cnic = trim($_POST['cnic']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Set default role to user
    $role = 'user';

    // Validate inputs
    $errors = [];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // Validate password length
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    // Validate CNIC format (XXXXX-XXXXXXX-X)
    $cnic = str_replace('-', '', $cnic); // Remove any existing dashes
    if (!preg_match('/^\d{13}$/', $cnic)) {
        $errors[] = "CNIC must be 13 digits.";
    } else {
        // Format CNIC with dashes
        $cnic = substr($cnic, 0, 5) . '-' . substr($cnic, 5, 7) . '-' . substr($cnic, 12, 1);
    }

    // Validate phone number (11 digits)
    if (!preg_match('/^\d{11}$/', $phone)) {
        $errors[] = "Phone number must be 11 digits.";
    }

    // Validate username (alphanumeric with underscores)
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $errors[] = "Username can only contain letters, numbers, and underscores.";
    }

    // Check if username already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $errors[] = "Username already taken.";
    }
    $stmt->close();

    // Check if CNIC already registered
    $stmt = $conn->prepare("SELECT id FROM users WHERE cnic = ?");
    $stmt->bind_param("s", $cnic);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $errors[] = "CNIC already registered.";
    }
    $stmt->close();

    // Check if phone already registered
    $stmt = $conn->prepare("SELECT id FROM users WHERE phone = ?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $errors[] = "Phone number already registered.";
    }
    $stmt->close();

    // Handle avatar upload
    $avatarPath = null;
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $detectedType = finfo_file($fileInfo, $_FILES['avatar']['tmp_name']);

        if (in_array($detectedType, $allowedTypes)) {
            $uploadDir = 'uploads/avatars/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
            $filename = uniqid('avatar_') . '.' . $extension;
            $destination = $uploadDir . $filename;

            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $destination)) {
                $avatarPath = $destination;
            } else {
                $errors[] = "Failed to upload avatar.";
            }
        } else {
            $errors[] = "Invalid file type for avatar. Only JPEG, PNG, and GIF are allowed.";
        }
    }

    // If no errors, proceed with registration
    if (empty($errors)) {
        // Hash the password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into database
        try {
            $stmt = $conn->prepare("INSERT INTO users (username, cnic, phone, password, role, avatar) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $username, $cnic, $phone, $passwordHash, $role, $avatarPath);
            $stmt->execute();

            $_SESSION['success'] = "Registration successful! You can now login.";

            // Redirect to login page
            header("Location: login.php");
            exit();
        } catch (Exception $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
    }

    // If there are errors, store them in session
    if (!empty($errors)) {
        $_SESSION['error'] = implode("<br>", $errors);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Pro</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .avatar-container {
            position: relative;
            display: inline-block;
        }

        .avatar-overlay {
            position: absolute;
            bottom: 0;
            right: 0;
            background-color: rgba(59, 130, 246, 0.8);
            color: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
        }


        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }
    </style>
</head>

<body class="d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-body p-5">
                        <h2 class="card-title text-center mb-4">Create Account</h2>

                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['error'];
                                                            unset($_SESSION['error']); ?></div>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['success'])): ?>
                            <div class="alert alert-success"><?php echo $_SESSION['success'];
                                                                unset($_SESSION['success']); ?></div>
                        <?php endif; ?>

                        <form id="registrationForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                            <!-- Avatar Upload -->
                            <div class="text-center mb-4">
                                <div class="avatar-container mx-auto">
                                    <img id="avatarPreview" src="https://via.placeholder.com/150"
                                        class="rounded-circle border" width="150" height="150">
                                    <input type="file" id="avatar" name="avatar" accept="image/*" class="d-none">
                                    <label for="avatar" class="avatar-overlay">
                                        <i class="fas fa-camera"></i>
                                    </label>
                                </div>
                                <div id="avatarError" class="invalid-feedback d-block"></div>
                            </div>

                            <!-- Username -->
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>

                            <!-- CNIC -->
                            <div class="mb-3">
                                <label for="cnic" class="form-label">CNIC Number</label>
                                <input type="text" class="form-control" id="cnic" name="cnic" placeholder="XXXXX-XXXXXXX-X" required>
                            </div>

                            <!-- Phone -->
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                                <small class="text-muted">Must be 11 digits</small>
                            </div>

                            <!-- Password Field with Show/Hide Toggle -->
                            <div class="mb-3 password-container">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <span class="toggle-password" onclick="togglePasswordVisibility()">
                                        <i class="fas fa-eye-slash" id="toggleIcon"></i>
                                    </span>
                                </div>
                                <small class="text-muted">Minimum 8 characters</small>
                            </div>

                            <!-- Confirm Password Field with Show/Hide Toggle -->
                            <div class="mb-4 password-container">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required>
                                    <span class="toggle-password" onclick="togglePasswordVisibility()">
                                        <i class="fas fa-eye-slash" id="toggleIcon"></i>
                                    </span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2">
                                <i class="fas fa-user-plus me-2"></i> Create Account
                            </button>

                            <div class="text-center mt-3">
                                <p class="text-muted">Already have an account? <a href="login.php">Login</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <?php include "./includes/js.php" ?>
    <!-- script js  -->
    <script>
        // Avatar Preview
        document.getElementById('avatar').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('avatarPreview').src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // CNIC formatting
        document.getElementById('cnic').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, ''); // Remove all non-digits
            if (value.length > 0) {
                value = value.substring(0, 13); // Limit to 13 digits
                if (value.length > 5) {
                    value = value.substring(0, 5) + '-' + value.substring(5);
                }
                if (value.length > 13) {
                    value = value.substring(0, 13) + '-' + value.substring(13);
                }
            }
            e.target.value = value;
        });

        // Form validation
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
                return false;
            }

            if (password.length < 8) {
                e.preventDefault();
                alert('Password must be at least 8 characters long!');
                return false;
            }

            return true;
        });

        // password icon
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        }
    </script>

</body>

</html>