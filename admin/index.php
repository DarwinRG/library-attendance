<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['admin'])){
    header('location:home.php');
    exit();
}

// Handle login directly in this file
if(isset($_POST['login'])){
    include '../conn.php';
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Use prepared statement to prevent SQL injection
    $sql = "SELECT * FROM admin WHERE username = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        $error = 'Database error: ' . $conn->error;
    } else {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows < 1){
            $error = 'Cannot find account with the username';
        }
        else{
            $row = $result->fetch_assoc();
            
            // Check if password matches
            if($password == $row['password']){
                $_SESSION['admin'] = $row['id'];
                $_SESSION['success'] = 'Login successful';
                
                // Handle remember me functionality
                if(isset($_POST['remember'])){
                    setcookie('admin_remember', $row['id'], time() + (30 * 24 * 60 * 60), '/');
                }
                
                // Clear any previous errors
                unset($_SESSION['error']);
                
                header('location: home.php');
                exit();
            }
            else{
                $error = 'Incorrect password';
            }
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Login - PanpacificU Library System</title>
    
    <!-- Material Design Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }
        
        /* Animated background elements */
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="10" cy="60" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="90" cy="40" r="0.5" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            animation: float 20s ease-in-out infinite;
            z-index: 1;
        }
        
        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, -30px) rotate(120deg); }
            66% { transform: translate(-20px, 20px) rotate(240deg); }
        }
        
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            padding: 50px 40px;
            width: 100%;
            max-width: 450px;
            position: relative;
            z-index: 10;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4285f4, #34a853, #fbbc05, #ea4335);
            border-radius: 24px 24px 0 0;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .login-logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #4285f4, #34a853);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 10px 25px rgba(66, 133, 244, 0.3);
        }
        
        .login-logo .material-icons {
            font-size: 40px;
            color: white;
        }
        
        .login-title {
            color: #1a1a1a;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .login-subtitle {
            color: #666;
            font-size: 16px;
            font-weight: 400;
        }
        
        .form-group {
            margin-bottom: 24px;
            position: relative;
        }
        
        .form-label {
            color: #333;
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
        }
        
        .input-group {
            position: relative;
        }
        
        .form-control {
            width: 100%;
            padding: 16px 20px 16px 50px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #fafafa;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #4285f4;
            background: white;
            box-shadow: 0 0 0 3px rgba(66, 133, 244, 0.1);
        }
        
        .form-control::placeholder {
            color: #999;
        }
        
        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            font-size: 20px;
            z-index: 5;
        }
        
        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            font-size: 20px;
            z-index: 5;
            transition: color 0.3s ease;
        }
        
        .password-toggle:hover {
            color: #4285f4;
        }
        
        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
        }
        
        .form-check-input {
            margin-right: 8px;
            width: 18px;
            height: 18px;
        }
        
        .form-check-label {
            color: #666;
            font-size: 14px;
            cursor: pointer;
        }
        
        .btn-login {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #4285f4, #34a853);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(66, 133, 244, 0.3);
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(66, 133, 244, 0.4);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin: 20px 0;
            border: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .alert-danger {
            background: #ffebee;
            color: #c62828;
            border-left: 4px solid #f44336;
        }
        
        .alert-success {
            background: #e8f5e8;
            color: #2e7d32;
            border-left: 4px solid #4caf50;
        }
        
        .back-to-home {
            text-align: center;
            margin-top: 30px;
        }
        
        .back-to-home a {
            color: #666;
            text-decoration: none;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: color 0.3s ease;
        }
        
        .back-to-home a:hover {
            color: #4285f4;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }
            
            .login-container {
                padding: 40px 30px;
                border-radius: 20px;
            }
            
            .login-title {
                font-size: 24px;
            }
            
            .form-control {
                padding: 14px 16px 14px 45px;
                font-size: 16px;
            }
            
            .input-icon {
                left: 14px;
                font-size: 18px;
            }
        }
        
        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
            }
            
            .login-title {
                font-size: 22px;
            }
            
            .form-control {
                padding: 12px 14px 12px 40px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="login-logo">
                <span class="material-icons">admin_panel_settings</span>
            </div>
            <h1 class="login-title">Admin Login</h1>
            <p class="login-subtitle">Sign in to access the admin panel</p>
        </div>

        <?php if(isset($error)): ?>
            <div class="alert alert-danger">
                <span class="material-icons">error</span>
                <span><?php echo $error; ?></span>
            </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <span class="material-icons">check_circle</span>
                <span><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></span>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <div class="input-group">
                    <span class="material-icons input-icon">person</span>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" value="admin" required autofocus>
                </div>
            </div>
            
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="material-icons input-icon">lock</span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" value="admin123" required>
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        <span class="material-icons" id="passwordIcon">visibility</span>
                    </button>
                </div>
            </div>
            
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                <label class="form-check-label" for="rememberMe">
                    Remember me for 30 days
                </label>
            </div>
            
            <button type="submit" class="btn-login" name="login">
                <span class="material-icons">login</span>
                <span>Sign In</span>
            </button>
        </form>
        
        <div class="back-to-home">
            <a href="../index.php">
                <span class="material-icons">arrow_back</span>
                Back to Library System
            </a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('passwordIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.textContent = 'visibility_off';
            } else {
                passwordInput.type = 'password';
                passwordIcon.textContent = 'visibility';
            }
        }
    </script>
</body>
</html>