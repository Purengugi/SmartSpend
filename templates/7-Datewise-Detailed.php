<?php 
    include_once '../init.php'; 

    // User login check
    if ($getFromU->loggedIn() === false) {
        header('Location: ../index.php');
    }

    include_once 'skeleton.php';
?>

<div class="wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="counter bg-tan">
                <div class="card-header">
                    <h4 style="font-family:'Source Sans Pro'; font-size: 1.3em; text-align: center">
                        Expenses incurred between <?php echo date("d-m-Y", strtotime($_POST['dtfrom'])) ?> and <?php echo date("d-m-Y", strtotime($_POST['dtto'])) ?>
                    </h4>
                </div>
                <div class="card-content">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Desc.</th>
                                <th>Cost</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id="chart-facilitate">
                            <?php
                                $dtexp = $getFromE->dtwise($_SESSION['UserId'], $_POST['dtfrom'], $_POST['dtto']);
                                if ($dtexp !== NULL) {
                                    $len = count($dtexp);
                                    for ($x = 1; $x <= $len; $x++) {
                                        
                                        $formattedCost = " " . number_format($dtexp[$x - 1]->Cost, 0); // Rounds to the nearest integer
                                        echo "<tr>
                                            <td>" . $x . "</td>
                                            <td>" . $dtexp[$x - 1]->Item . "</td>
                                            <td>" . $formattedCost . "</td>
                                            <td>" . date("d-m-Y", strtotime($dtexp[$x - 1]->Date)) . "</td>
                                        </tr>";
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-m-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            Expense Graph
                        </h3>
						<div class="card-content">
							<canvas id="myChart" ></canvas>
						</div>
                    </div>
                </div>
            </div>
    </div>
</div>
<script src="../static/js/7-Datewise-Detailed.js"></script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="icon" href="static/images/th.jpeg" sizes="16x16" type="image/png">

 <!-- include the styles.css file -->
    <link rel="stylesheet" href="../static/css/styles.css">

</head>
