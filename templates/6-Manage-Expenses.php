<?php 
	include_once "../init.php";

	// User login checker
	if ($getFromU->loggedIn() === false) {
        header('Location: ../index.php');
	}

	include_once 'skeleton.php'; 

	// Deletes expense record
	if(isset($_POST['delrec']))
	{
		$getFromE->delexp($_POST['ID']);
		echo "<script>
				Swal.fire({
					title: 'Done!',
					text: 'Record deleted successfully',
					icon: 'success',
					confirmButtonText: 'Close'
				})
				</script>";
	}

	
?>

<div class="wrapper">
        <div class="row">
           <div class="col-12">
               <div class="card">
			   <div class="counter bg-tan">
                   <div class="card-header">
                        
                        <i class="fas fa-ellipsis-h"></i>
                        <h3 style="font-family:'Source Sans Pro'; font-size: 1.5em;">
                            Expenses
                        </h3>
                   </div>
                   <div class="card-content">
                   <table>
							<thead>
								<tr>
									<th>#</th>
									<th>Item</th>
									<th>Cost</th>
									<th>Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
										$totexp = $getFromE->allexp($_SESSION['UserId']);
										if($totexp !== NULL)
										{
											$len = count($totexp);
											for ($x = 1; $x <= $len; $x++) {
											echo "<tr>
												<td>".$x."</td>
												<td>".$totexp[$x-1]->Item."</td>
												<td>"." ".$totexp[$x-1]->Cost."</td>
												<td>".date("d-m-Y",strtotime($totexp[$x-1]->Date))."</td>	
												<td><form style='margin-block-end: 0;' action='' method='post'><input style='display:none;' name='ID' value=".$totexp[$x-1]->ID."></input><button type='submit' name='delrec' class='btn btn-default' style='background:none; color:#8f8f8f; font-size:1em;'>
												<i class='far fa-trash-alt' style='color:red;'></i></button></form></td>
											</tr>";	
											}
										}
									?>
							</tbody>
						</table>
                   </div>
               </div>
           </div>
        </div>
</div>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="icon" href="static/images/th.jpeg" sizes="16x16" type="image/png">

 <!-- include the styles.css file -->
    <link rel="stylesheet" href="../static/css/styles.css">

</head>