<?php 
include_once "init.php";

// User login check
if (isset($_SESSION['UserId'])) {
    header('Location: templates/3-Dashboard.php');
}

// Validate credentials and log the user in
if (isset($_POST['login']) && !empty($_POST)) {
    $password = $_POST['password'];
    $username = $_POST['username'];
    
    if(!empty($username) || !empty($password)) {
        $username = $getFromU->checkInput($username);
        $password = $getFromU->checkInput($password);
        if($getFromU->login($username, $password) === false) {
            $error = "The username or password is incorrect";
        }
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="static/images/th.jpeg" sizes="16x16" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>SmartSpend</title>
    <style>
        :root {
            --primary-tan: #D2B48C;
            --light-tan: #E8DCC4;
            --dark-tan: #B38B6D;
            --white: #FFFFFF;
            --text-dark: #2D2D2D;
            --text-light: #666666;
            --error-red: #FF5757;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: var(--white);
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .login-section {
            flex: 1;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .info-section {
            flex: 1;
            background: var(--primary-tan);
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .info-content {
            position: relative;
            z-index: 2;
            color: var(--white);
            max-width: 500px;
            margin: 0 auto;
        }

        .logo {
            font-size: 2rem;
            color: var(--dark-tan);
            margin-bottom: 2rem;
            font-weight: 600;
        }

        .login-form {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.05);
        }

        .form-title {
            font-size: 1.5rem;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1.25rem;
            position: relative;
        }

        .form-group i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 2px solid var(--light-tan);
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: var(--primary-tan);
            outline: none;
        }

        .login-btn {
            width: 100%;
            padding: 0.75rem;
            background: var(--primary-tan);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .login-btn:hover {
            background: var(--dark-tan);
        }

        .signup-link {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--text-light);
        }

        .signup-link a {
            color: var(--dark-tan);
            text-decoration: none;
            font-weight: 500;
        }

        .error-message {
            color: var(--error-red);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            text-align: center;
        }

        .features-list {
            margin-top: 2rem;
            list-style: none;
        }

        .features-list li {
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            color: var(--white);
        }

        .features-list li i {
            margin-right: 0.75rem;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            
            .info-section {
                padding: 3rem 1.5rem;
            }
            
            .login-section {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>

<body>
<div class="container">
        <section class="login-section">
            <div class="logo">
               SmartSpend
            </div>
            
            <form class="login-form" action="index.php" method="post" onsubmit="return validate()" id="form1">
                <h2 class="form-title">Welcome Back</h2>
                
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-input" name="username" placeholder="Username" id="user1" required>
                </div>

                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" class="form-input" name="password" placeholder="Password" id="pass1" autocomplete="on" required>
                </div>

                <?php if (isset($error)): ?>
                    <div class="error-message"><?php echo $error; ?></div>
                <?php endif; ?>

                <button type="submit" class="login-btn" name="login">Sign In</button>

                <div class="signup-link">
                    Don't have an account? 
                    <a href="templates/2-sign-up.php">Sign Up Now</a>
                </div>
            </form>
        </section>

        <section class="info-section">
            <div class="info-content">
                <h1>Smart Money Management Starts Here</h1>
                <p style="margin: 1rem 0">Take control of your finances with SmartSpend's comprehensive expense tracking and budgeting tools.</p>
                
                <ul class="features-list">
                    <li><i class="fas fa-chart-line"></i> Track expenses in real-time</li>
                    <li><i class="fas fa-wallet"></i> Set and manage budgets</li>
                    <li><i class="fas fa-calendar-alt"></i> View detailed reports</li>
                    <li><i class="fas fa-bell"></i> Get spending alerts</li>
                    <li><i class="fas fa-mobile-alt"></i> Access anywhere, anytime</li></br>

                    <p style="margin: 1rem 0">For any inquiries contact:<b> +254712345678 </b> </p>

                </ul>
            </div>
        </section>
    </div>

    <script src="static/js/index.js"></script>
</body>
</html>
