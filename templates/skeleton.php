<?php
    include_once "../init.php";
    
    $pic = $getFromU->Photofetch($_SESSION['UserId']);
    $pic = '"'. $pic . '"';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../static/images/th.jpeg" sizes="16x16" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../static/js/jquery-3.3.1.slim.min.js"></script>
    <script src="../static/js/yearpicker.js" async></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="..static/css/styles.css">

    <title>SmartSpend</title>
    
</head>

<body class="overlay-scrollbar sidebar-expand">
    <!-- Navbar -->
    <div class="navbar">
        <!-- nav-left -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class='nav-link'>
                    <i class="fas fa-bars" onclick="collapseSidebar()"></i>
                </a>
            </li>
            <li class="nav-item">
                <img src="../static/images/th.jpeg" alt="" class="logo">
            </li>
        </ul>

        <!-- end nav left  -->
        
        
    </div>
    <!-- end navbar -->
    <!-- sidebar -->
    <div class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="sidebar-nav-item">
                <a href="3-Dashboard.php" class="sidebar-nav-link">
                    <div>
                    <p><i class="fas fa-tasks"></i></p>
                    </div>
                    <span>
                        Dashboard
                    </span>
                </a>
            </li>
            <li class="sidebar-nav-item">
                <a href="4-Set-Budget.php" class="sidebar-nav-link">
                    <div>
                    <p><i class="fas fa-tasks"></i></p>
                    </div>
                    <span>
                        Set Budget 
                    </span>
                </a>
            </li>
            <li class="sidebar-nav-item" id="Expense" onclick="open1()">
                <a href="#" class="sidebar-nav-link">
                    <div>
                    <p><i class="fas fa-tasks"></i></p>
                    </div>
                    <span>
                        Expenses
                    </span>
                </a>
            </li>
            <li class="sidebar-nav-item" style="display: none;">
                <a href="5-Add-Expenses.php" class="sidebar-nav-link">
                    <div>
                    <p><i class="fas fa-arrow-right"></i></p>
                    </div>
                    <span>
                        Add Expenses
                    </span>
                </a>
            </li>
            <li class="sidebar-nav-item" style="display: none">
                <a href="6-Manage-Expense.php" class="sidebar-nav-link" style="display: none">
                    <div>
                    <p><i class="fas fa-arrow-right"></i></p>
                    </div>
                    <span>
                        Manage Expenses
                    </span>
                </a>
            </li>
            <li class="sidebar-nav-item" id="ER" onclick="open2()">
                <a href="#" class="sidebar-nav-link">
                    <div>
                    <p><i class="fas fa-tasks"></i></p>
                    </div>
                    <span>
                        Expense Report
                    </span>
                </a>
            </li>
            <li class="sidebar-nav-item" style="display:none;">
                <a href="7-Datewise.php" class="sidebar-nav-link">
                    <div>
                    <p><i class="fas fa-arrow-right"></i></p>
                    </div>
                    <span>
                        Datewise Report
                    </span>
                </a>
            </li>
            <li class="sidebar-nav-item" style="display: none;">
                <a href="8-Monthly.php" class="sidebar-nav-link">
                    <div>
                    <p><i class="fas fa-arrow-right"></i></p>
                    </div>
                    <span>
                        Monthly Report
                    </span>
                </a>
            </li>
            <li class="sidebar-nav-item" style="display:none;">
                <a href="9-Yearly.php" class="sidebar-nav-link">
                    <div>
                    <p><i class="fas fa-arrow-right"></i></p>
                    </div>
                    <span>
                        Yearly Report
                    </span>
                </a>
            </li>

            <li class="sidebar-nav-item" style="display:none;">
                <a href="9-Yearly.php" class="sidebar-nav-link">
                    <div>
                    <p><i class="fas fa-arrow-right"></i></p>
                    </div>
                    <span>
                        Yearly Report
                    </span>
                </a>
            </li></br>
            <!-- Add these new items -->
            <li class="sidebar-nav-item">
                <a href="10-Profile.php" class="sidebar-nav-link">
                    <div>
                    <p><i class="fas fa-cog"></i></p>
                    </div>
                    <span>
                        Profile Settings
                    </span>
                </a>
            </li>
            <li class="sidebar-nav-item">
                <a href="logout.php" class="sidebar-nav-link">
                    <div>
                    <p><i class="fas fa-sign-out-alt"></i></p>
                    </div>
                    <span>
                        Logout
                    </span>
                </a>
            </li>

        </ul>
    </div>
    <!-- end sidebar-->
    <!-- Main Content -->
    <!-- end main content -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="../static/js/skeleton.js"></script>
</body>
