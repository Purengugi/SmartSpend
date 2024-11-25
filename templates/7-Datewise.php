<?php 
    include_once "../init.php";

    // User login check
    if ($getFromU->loggedIn() === false) {
        header('Location: ../index.php');
    }

    include_once 'skeleton.php';   	

    // Checks if form is submitted and redirects
    if(isset($_POST['datewise']))
    {
        header("Location: 7-Datewise-Detailed.php");
    }
?>

<div class="wrapper">
        <div class="row">
            <div class="col-12 col-m-12 col-sm-12" >
                <div class="card">
                <div class="counter bg-tan">
                    <div class="counter" style="width: 185vh; display: flex; align-items: center; justify-content: center;">
                    
                    <form action="7-Datewise-Detailed.php" method="post" onsubmit = "return validate()" id="datewiseform">
                    <h1 style="font-family: 'Source Sans Pro'; color: #000000;">Datewise Expense Report</h1></br>
								<div class="form-send">
									<label style="font-family: 'Source Sans Pro'; font-size: 1.3em; ">From:</label><br><br>
									<input class="text-input" type="date" value="" name="dtfrom" id="dtwisefrom" required="true" style="width: 100%; max-width: 100%; padding-top: 8px; "><br>
                                    <br><br>
                                </div>
                                <div clas="form-send">
									<label style="font-family: 'Source Sans Pro'; font-size: 1.3em; ">To:</label><br><br>
									<input class="text-input" type="date" value="" name="dtto" id="dtwiseto" required="true" style="width: 100%; max-width: 100%; padding-top: 8px; ">
                                    <br>
                                    <br>
                                    <small style="font-size:1.01em;"></small>
                                </div>
																
								<div><br>
									<button type="submit" class="pressbutton" name="datewise" >Submit</button>
								</div>								
								
								</div>
								
							</form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <script src="../static/js/7-Datewise.js"></script>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="icon" href="static/images/th.jpeg" sizes="16x16" type="image/png">

 <!-- include the styles.css file -->
    <link rel="stylesheet" href="../static/css/styles.css">

</head>
