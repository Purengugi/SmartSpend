<?php 
    include_once "../init.php";

    // User login check
    if ($getFromU->loggedIn() === false) {
        header('Location: ../index.php');
    }

    include_once 'skeleton.php'; 	

    // Gathering all user data
    $userobj = $getFromU->userData($_SESSION['UserId']);
    $fullname = $userobj->Full_Name;
    $usr_name = $userobj->Username;
    $emailid = $userobj->Email;
    $JoinDate = $userobj->RegDate;
    $picture = $userobj->Photo;

    // Handle profile update
    $updateError = "";
    if(isset($_POST['update_profile'])) {
        // Validate and process profile update
        $new_fullname = $getFromU->checkInput($_POST['full_name']);
        $new_username = $getFromU->checkInput($_POST['username']); 
        $new_email = $getFromU->checkInput($_POST['email']);

        // Profile image handling
        $target = $picture; // Default to existing picture
        if(!empty($_FILES['inpFile']['name'])) {
            // Ensure the upload directory exists
            $upload_dir = '../static/profileImages/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            $profileImageName = time() .'_'. $_FILES['inpFile']['name'];
            $target = $upload_dir . $profileImageName;
            
            move_uploaded_file($_FILES['inpFile']['tmp_name'], $target);
        }

        // Validation
        if (strlen($new_fullname) > 30 || (strlen($new_fullname)) < 2) {
            $updateError = "Name must be between 2-30 characters";
        } 
        elseif (strlen($new_username) > 30 || (strlen($new_username)) < 2) {
            $updateError = "Username must be between 2-30 characters";
        }
        elseif (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
            $updateError = "Invalid email format";
        }
        else {
            // Attempt to update
            try {
                $update = $getFromU->update('user', $_SESSION['UserId'], array(
                    'Full_Name' => $new_fullname, 
                    'Username' => $new_username, 
                    'Email' => $new_email,
                    'Photo' => $target
                ));

                if($update !== false) {
                    // Prepare success message
                    $_SESSION['profile_update_success'] = true;
                    
                    // Refresh user data
                    $userobj = $getFromU->userData($_SESSION['UserId']);
                    $fullname = $userobj->Full_Name;
                    $usr_name = $userobj->Username;
                    $emailid = $userobj->Email;
                    $picture = $userobj->Photo;
                }
            } catch (Exception $e) {
                $updateError = "Update failed: " . $e->getMessage();
                error_log("Profile Update Error: " . $e->getMessage());
            }
        }
    }
?>   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="static/images/th.jpeg" sizes="16x16" type="image/png/jpg/jpeg/webp/svg">
    <link rel="stylesheet" href="../static/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        .profile-container {
            max-width: 185vh;
            margin: 2rem auto;
            background: linear-gradient(145deg, #ffffff, #f5f5f5);
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            padding: 2rem;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .profile-header h1 {
            font-family: 'Source Sans Pro', sans-serif;
            color: #2c3e50;
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }

        .profile-header h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: #3498db;
            border-radius: 2px;
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

        .profile-form div {
            margin-bottom: 1.5rem;
        }

        .profile-form p {
            color: #7f8c8d;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .text-input {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            background: white;
            transition: all 0.3s ease;
            font-size: 1rem;
            color: #2c3e50;
        }

        .text-input:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52,152,219,0.2);
        }

        .text-input[readonly] {
            background: #f8f9fa;
            cursor: not-allowed;
        }

        .editable-input {
            border: 2px solid #3498db;
        }

        .pressbutton, .save-button {
            background: #3498db;
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
            display: block;
        }

        .pressbutton:hover, .save-button:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52,152,219,0.3);
        }

        .error-message {
            color: red;
            font-size: 0.9rem;
            margin-top: 0.5rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="row">
            <div class="counter bg-tan">
                <div class="col-12 col-m-12 col-sm-12">
                    <div class="profile-container" style="height: 85vh; width: 185vh; display: flex; align-items: center; justify-content: center;">
                        <form action="10-Profile.php" method="post" enctype="multipart/form-data" id="profileForm">
                            <h1 style="font-family: 'Source Sans Pro'; color: #000000;">Profile</h1>
                            
                            <div class="image-preview" id="imagePreview">
                                <img src="<?php echo !empty($picture) ? $picture : '../static/images/userlogo.png'; ?>" 
                                     class="image-preview__image" 
                                     id="profileDisplay"
                                     alt="Profile Picture">
                            </div>
                            
                            <label for="imageUpload" class="user-pic-btn" id="photoBtnToggle">Add Photo</label>
                            <input type="file" name="inpFile" id="imageUpload" accept="image/*" style="display: none">

                            <div>
                            </br> <p>Full Name</p>
                                <input type="text" 
                                       class="text-input" 
                                       name="full_name" 
                                       id="fullname" 
                                       value="<?php echo $fullname; ?>" 
                                       readonly>
                            </div>

                            <div>
                            </br> <p>User Name</p>
                                <input type="text" 
                                       class="text-input" 
                                       name="username" 
                                       id="username" 
                                       value="<?php echo $usr_name; ?>" 
                                       readonly>
                            </div>

                            <div>
                            </br> <p>Email Id</p>
                                <input type="email" 
                                       class="text-input" 
                                       name="email" 
                                       id="email" 
                                       value="<?php echo $emailid; ?>" 
                                       readonly>
                            </div>

                            <div>
                            </br><p>Registration Date</p>
                                <input type="datetime" 
                                       class="text-input" 
                                       value="<?php echo $JoinDate; ?>" 
                                       readonly>
                            </div></br>

                            <?php if (!empty($updateError)): ?>
                                <div class="error-message">
                                    <?php echo $updateError; ?>
                                </div>
                            <?php endif; ?>

                            <div style="display: flex; gap: 10px;">
                            </br><button type="button" class="pressbutton" id="editToggle">Edit Profile</button>
                                <button type="submit" name="update_profile" class="save-button" id="saveProfile" style="display: none;">Save Profile</button>
                            </div>

                            <div>
                                <a href="11-changepass.php">
                                </br><button type="button" class="pressbutton">Change Password</button>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if(isset($_SESSION['profile_update_success']) && $_SESSION['profile_update_success']): ?>
                Swal.fire({
                    title: 'Success!',
                    text: 'Profile updated successfully',
                    icon: 'success',
                    confirmButtonText: 'Done'
                });
                <?php 
                // Unset the session variable 
                unset($_SESSION['profile_update_success']); 
                ?>
            <?php endif; ?>

            const editToggle = document.getElementById('editToggle');
            const saveProfile = document.getElementById('saveProfile');
            const inputs = document.querySelectorAll('input[readonly]');
            const photoBtnToggle = document.getElementById('photoBtnToggle');
            const imageUpload = document.getElementById('imageUpload');

            // Image Preview
            const previewContainer = document.getElementById("imagePreview");
            const previewImage = previewContainer.querySelector(".image-preview__image");

            imageUpload.addEventListener("change", function () {
                const file = this.files[0];

                if (file) {
                    const reader = new FileReader();

                    reader.addEventListener("load", function () {
                        previewImage.setAttribute("src", this.result);
                    });
                    reader.readAsDataURL(file);
                }
            });

            editToggle.addEventListener('click', function() {
                inputs.forEach(input => {
                    if (input.id === 'fullname' || input.id === 'email' || input.id === 'username') {
                        input.removeAttribute('readonly');
                        input.classList.add('editable-input');
                    }
                });
                
                photoBtnToggle.style.display = 'inline-block';
                imageUpload.style.display = 'none';
                
                editToggle.style.display = 'none';
                saveProfile.style.display = 'block';
            });
        });
    </script>
</body>
</html>