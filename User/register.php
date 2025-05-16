<?php
require_once 'db.php'; // Database connection using PDO

// Initialize variables
$name = $email = $phone = $address = $password = '';
$errors = ['name' => '', 'email' => '', 'phone' => '', 'address' => '', 'password' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnRegister'])) {
    // Validate name
    $name = trim($_POST['name'] ?? '');
    if (empty($name)) {
        $errors['name'] = 'Please enter your full name';
    } elseif (!preg_match('/^[A-Za-z\s]+$/', $name)) {
        $errors['name'] = 'Name must only contain letters and spaces';
    }

    // Validate phone
    $phone = trim($_POST['phone'] ?? '');
    if (empty($phone)) {
        $errors['phone'] = 'Please enter your phone number';
    } elseif (!preg_match('/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/', $phone)) {
        $errors['phone'] = 'Please provide a valid phone number';
    }

    // Validate email
    $email = trim($_POST['email'] ?? '');
    if (empty($email)) {
        $errors['email'] = 'Please enter your email';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address';
    }

    // Validate address
    $address = trim($_POST['address'] ?? '');
    if (empty($address)) {
        $errors['address'] = 'Please enter your address';
    }

    // Validate password
    $password = $_POST['password'] ?? '';
    if (empty($password)) {
        $errors['password'] = 'Please enter a password';
    } elseif (strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters long';
    }

    // Check for existing email or phone if no validation errors
    if (!array_filter($errors)) {
        try {
            // Check if email exists
            $stmt = $pdo->prepare("SELECT email FROM adopters WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->rowCount() > 0) {
                $errors['email'] = 'Email already registered';
            }

            // Check if phone exists
            $stmt = $pdo->prepare("SELECT phone FROM adopters WHERE phone = ?");
            $stmt->execute([$phone]);
            if ($stmt->rowCount() > 0) {
                $errors['phone'] = 'Phone number already registered';
            }

            // Register user if no duplicates found
            if (!array_filter($errors)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO adopters (name, email, phone, address, password_hash) VALUES (?, ?, ?, ?, ?)");
                
                if ($stmt->execute([$name, $email, $phone, $address, $hashed_password])) {
                    header('Location: login.php?registered=1');
                    exit;
                } else {
                    $errors['general'] = 'Registration failed. Please try again.';
                }
            }
        } catch (PDOException $e) {
            $errors['general'] = 'Database error: ' . $e->getMessage();
        }
    }
}
?>
<!-- Make sure this is saved as a `.php` file and you're using Bootstrap 5 and Bootstrap Icons -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  
  <!-- Custom Style to make form more compact -->
  <style>
    .card {
      border-radius: 1rem;
    }
    .form-control::placeholder {
      font-size: 0.9rem;
    }
    .form-icon {
      position: absolute;
      top: 50%;
      left: 10px;
      transform: translateY(-50%);
      color: #6c757d;
    }
    .form-group {
      position: relative;
    }
    .form-control {
      padding-left: 2.5rem;
    }
    .back-arrow {
      font-size: 1.2rem;
      color: #333;
      text-decoration: none;
    }
    .back-arrow:hover {
      color: #007bff;
    }
  </style>
</head>
<body class="bg-light">

  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <a href="index.php" class="back-arrow mb-3 d-block"><i class="bi bi-arrow-left-circle-fill"></i> Cancel</a>
        <div class="card shadow-sm">
          <div class="card-body p-4">
            <h4 class="text-center mb-3">Register</h4>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" novalidate>
              
              <!-- Name -->
              <div class="mb-3 form-group">
                <i class="bi bi-person-fill form-icon"></i>
                <input type="text" class="form-control <?php echo (!empty($errName)) ? 'is-invalid' : ''; ?>" 
                       name="name" placeholder="Full Name" value="<?php echo $name; ?>">
                <div class="invalid-feedback"><?php echo $errName; ?></div>
              </div>

              <!-- Phone -->
              <div class="mb-3 form-group">
                <i class="bi bi-telephone-fill form-icon"></i>
                <input type="text" class="form-control <?php echo (!empty($errPhone)) ? 'is-invalid' : ''; ?>" 
                       name="phone" placeholder="Phone Number" value="<?php echo $phone; ?>">
                <div class="invalid-feedback"><?php echo $errPhone; ?></div>
              </div>

              <!-- Email -->
              <div class="mb-3 form-group">
                <i class="bi bi-envelope-fill form-icon"></i>
                <input type="email" class="form-control <?php echo (!empty($errEmail)) ? 'is-invalid' : ''; ?>" 
                       name="email" placeholder="Email" value="<?php echo $email; ?>">
                <div class="invalid-feedback"><?php echo $errEmail; ?></div>
              </div>

              <!-- Address -->
              <div class="mb-3 form-group">
                <i class="bi bi-geo-alt-fill form-icon"></i>
                <textarea class="form-control <?php echo (!empty($errAddress)) ? 'is-invalid' : ''; ?>" 
                          name="address" rows="2" placeholder="Address"><?php echo $address; ?></textarea>
                <div class="invalid-feedback"><?php echo $errAddress; ?></div>
              </div>

              <!-- Password -->
              <div class="mb-3 form-group">
                <i class="bi bi-lock-fill form-icon"></i>
                <input type="password" class="form-control <?php echo (!empty($errPassword)) ? 'is-invalid' : ''; ?>" 
                       name="password" placeholder="Password">
                <div class="invalid-feedback"><?php echo $errPassword; ?></div>
              </div>

              <button type="submit" name="btnRegister" class="btn btn-primary w-100">Register</button>
            </form>

            <div class="mt-3 text-center">
              <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>