<?php 
    include_once "../init.php";
    include_once '../connection.php';
    
    // User login check
    if (isset($_SESSION['UserId'])) {
      header('Location: 3-Dashboard.php');
    }


    if(isset($_POST['register']))
    {
        // Storing image path in database
        if(empty($_FILES['inpFile']['name']))
        {
            $target = '../static/images/userlogo.png';
        }
        else
        {
            // Unique profile image name for each user
            $profileImageName = time() .'_'. $_FILES['inpFile']['name'];
            $target = '../static/profileImages/' . $profileImageName;
        }
        

        $fullname = $_POST['full_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $signupError = "";

        // Form validation
        $email = $getFromU->checkInput($email);
        $fullname = $getFromU->checkInput($fullname);
        $username = $getFromU->checkInput($username);
        $password = $getFromU->checkInput($password);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            $signupError = "Invalid email";
        } 
        elseif (strlen($fullname) > 30 || (strlen($fullname)) < 2) 
        {
            $signupError = "Name must be between 2-30 characters";
        } 
        elseif (strlen($username) > 30 || (strlen($username)) < 3) 
        {
            $signupError = "Username must be between 3-30 characters";
        } 
        elseif (strlen($password) < 6) 
        {
            $signupError = "Password too short";
        }
        elseif (strlen($password) >30) 
        {
            $signupError = "Password too long";
        }
        else 
        {
            if ($getFromU->checkEmail($email) === true) 
            {
                $signupError = "Email already registered";
            } 
        
            if ($getFromU->checkUsername($username) === true) 
            {
                $signupError = "Username already exists";
            }
            else 
            {
                move_uploaded_file($_FILES['inpFile']['tmp_name'], $target);
                $user_id = $getFromU->create('user', array('Email' => $email,'Password' => md5($password), 'Full_Name' => $fullname, 'Username' => $username, 'Photo' =>$target, 'RegDate' => date("Y-m-d H:i:s")));
                $_SESSION['UserId'] = $user_id; 
                $_SESSION['swal'] = "<script>
                    Swal.fire({
                        title: 'Yay!',
                        text: 'Congrats! You are now a registered user',
                        icon: 'success',
                        confirmButtonText: 'Done'
                    })
                    </script>";
                header('Location: 3-Dashboard.php');
            }
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../static/images/th.jpeg" sizes="16x16" type="image/png">
    <link rel="stylesheet" href="../static/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <title>SmartSpend</title>    

<style>
        .profile-container {
            max-width: 185vh;
            margin: 2rem auto;
            background: linear-gradient(145deg, #ffffff, #f5f5f5);
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            padding: 2rem;
        }

        .image-preview {
            width: 200px;
            height: 200px;
            margin: 0 auto 2rem;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid #fff;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .image-preview:hover {
            transform: scale(1.05);
        }

        .image-preview__image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }

        .image-preview__default-text {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }

        .image-preview__default-text img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-pic-btn {
            display: inline-block;
            background: #3498db;
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 25px;
            transition: all 0.3s ease;
            margin-bottom: 2rem;
            cursor: pointer;
            font-family: 'Source Sans Pro', sans-serif;
            text-align: center;
        }

        .user-pic-btn:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52,152,219,0.3);
        }
    </style>
</head>



<body>

    <div class="container">
        
        <div class="img-container">
            <h1>Create Your Account!</h1>
            <img src="../static/images/OIP.jpg" alt="">    
        </div>

        <form action="2-sign-up.php" method="post" id="form" onsubmit = "return validate()" enctype="multipart/form-data">
            
        <form class="profile-form">
                            <div class="image-preview" id="imagePreview">
                                <img src="" class="image-preview__image" id="profileDisplay">
                                <span class="image-preview__default-text">
                                    <img src="../static/images/userlogo.png" alt="">
                                </span>
                            </div>
                            
                            <label for="imageUpload" class="user-pic-btn">Add Photo</label></br>
                            <input type="file" name="inpFile" id="imageUpload" accept="image/*" style="display: none">
            
            <!-- User details -->
            <div class="group">
                <div class="form-control">
                    <i class="fa fa-user u1" aria-hidden="true"></i>
                    <input class="fname" onkeypress="return (event.charCode > 64 && 
                        event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" type="text" name="full_name" id="fullname" minlength="2" maxlength="30" placeholder="Full Name" required>
                    <br>
                    <small></small>
                </div>

                <div class="form-control">
                    <i class="fa fa-envelope u2" aria-hidden="true"></i>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <br>
                    <small></small>
                </div>
                

                <div class="form-control">
                    <i class="fa fa-user-plus u3" aria-hidden="true"></i>
                    <input type="text" name="username" id="username" placeholder="Username" minlength="3" maxlength="30" required>
                    <br>
                    <small></small>
                    <span id="uname_response" style="font-family: 'Source Sans Pro'; font-size:0.8em ; color:red; font-weight:bold"></span>
                </div>
                
                <div class="form-control">
                    <i class="fa fa-key u4" aria-hidden="true"></i>
                    <input type="password" name="password" id="password" placeholder="Password" minlength="6" maxlength="30" autocomplete="on" required>
                    <br>
                    <small></small>
                </div>

                <div class="form-control">   
                    <i class="fa fa-key u4" aria-hidden="true"></i>
                    <input type="password" name="password_confirm" id="confirmpassword" minlength="6" maxlength="30" placeholder="Confirm Password" autocomplete="on" required>
                    <br>
                    <small></small>
                </div>
                
            </div>
            <button type="submit" value="Submit" name="register">Complete</button>
            <br>
            <?php  
                if (isset($signupError)) {
                    $font = "Source Sans Pro";
                    echo '<div style="color: red;font-family:'.$font.';">'.$signupError.'</div>';
                }
	        ?>
        </form>

    </div>
    
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script>
        const inpFile = document.getElementById("imageUpload");
        const previewContainer = document.getElementById("imagePreview");
        const previewImage = previewContainer.querySelector(".image-preview__image");
        const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");

        inpFile.addEventListener("change", function() {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                previewDefaultText.style.display = "none";
                previewImage.style.display = "block";

                reader.addEventListener("load", function() {
                    previewImage.setAttribute("src", this.result);
                });

                reader.readAsDataURL(file);
            } else {
                previewDefaultText.style.display = "flex";
                previewImage.style.display = "none";
                previewImage.setAttribute("src", "");
            }
        });
    </script>
</body>
</html>