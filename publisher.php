<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Publisher</title>
      <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"> -->
	  
    <link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/jquery.dataTables.css">
            <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="css/Customstyle.css">

	<script type="text/javascript" src="js/popper.min.js"></script>

	<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>

	<script type="text/javascript" src="js/jquery.dataTables.min.js" defer></script>
</head>
<body>
<?php include 'header.php' ?>
    <div id="admin-content">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<h2 class="admin-heading">All Publisher</h2>
				</div>
				<div class="offset-md-7 col-md-2">
					<a class="btn btn-primary btn-sm" href="add-publisher.php">Add Publisher</a>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div id="success" class="message"></div>
					<div class="card" style="background: lightgray;">
						<div class="card-body">
							<?php
								$sql = "SELECT * from `publisher` order by `publisher_id` ";
								$result = mysqli_query($con,$sql);
							?>
							<table id="mytable" class="table table-bordered  table-sm">
								<thead class="" style="background: #eee0ee">
									<tr>
										<th>Sr no</th>
										<th>Publisher Name</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
								<?php
									if(mysqli_num_rows($result) > 0){
										$Sr_no = 0;
										while($row= mysqli_fetch_assoc($result)){  
											$Sr_no++;
								?>	
									<tr>
										<td><?php echo $Sr_no; ?></td>
										<td><?php echo $row['publisher_name']?></td>
										<td><a href="update-publisher.php?pid=<?php echo $row['publisher_id']; ?>" class="btn btn-primary btn-sm" id="pid" name="pid">Edit</a></td>
										<td><a href="javascript:void(0)" data-pid=<?php echo $row['publisher_id'];  ?> class="btn btn-danger delete_publisher btn-sm">Delete</a></td>
									</tr>
									<?php  }}else{ ?>
									<tr>
										<td colspan="4" class="text-center" style="font-size: 18px;">No Publisher found.</td>
									</tr>	
									<?php } ?>
								</tbody>	
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>

<script  type="text/javascript">
	$(document).ready(function() {
		$('#mytable').DataTable();
	});
	$(function(){
		$('.delete_publisher').click(function(){
			var publisher_id = $(this).data('pid');
			// alert(publisher_id);
			$.ajax({
				url: 'delete-publisher.php',
				type: 'POST',
				data: {publisher_id:publisher_id},
				success: function(result){
					$('#success').html(result);
					setTimeout(function(){ window.location.reload() }, 2000);
				}
			})
		})
	})
</script>
<?php include_once 'footer.php' ?>
</body>
</html>



