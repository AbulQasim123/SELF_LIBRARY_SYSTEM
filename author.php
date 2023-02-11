<?php include "header.php" ?> <!--- header -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Author</title>
	<link rel="stylesheet" href="css/jquery.dataTables.css">
	<script type="text/javascript" src="js/jquery.dataTables.min.js" defer></script>
</head>
<body>
	<div id="admin-content">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<h2 class="admin-heading">All Authors</h2>
				</div>
				<div class="offset-md-7 col-md-2">
					<a class="add-new btn btn-primary btn-sm" href="add-author.php">Add Author</a>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div id="success" class="message"></div>
					<div class="card" style="background: lightgray;">
						<div class="card-body">
							<?php

								$sql = "SELECT * from `author` order by `author_id` ";
								$result = mysqli_query($con,$sql);
							?>
							<table id="mytable" class="table table-bordered  table-sm">
								<thead class="" style="background: #eee0ee">
									<tr>
										<th>Sr no</th>
										<th>Author Name</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
								<?php
									if(mysqli_num_rows($result) > 0){
										$Sr_no = 0;
										while($row= mysqli_fetch_assoc($result)){  
											$Sr_no ++;
								?>	
									<tr>
										<td><?php echo $Sr_no; ?></td>
										<td><?php echo $row['author_name']?></td>
										<td><a href="update-author.php?aid=<?php echo $row['author_id']; ?>" class="btn btn-primary btn-sm" id="a_id" name="a_id">Edit</a></td>
										<td><a href="javascript:void(0)" data-aid=<?php echo $row['author_id'];  ?> class="btn btn-danger delete_author btn-sm">Delete</a></td>
									</tr>
									<?php  }}else{ ?>
									<tr>
										<td colspan="4" class="text-center" style="font-size: 18px;">No Author found.</td>
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
<script type="text/javascript">
	$(document).ready(function() {
		$('#mytable').DataTable();
	});
	$(function(){
		$('.delete_author').click(function(){
			var author_id = $(this).data('aid');
			// alert(author_id);
			$.ajax({
				url: "delete-author.php",
				type: "POST",
				data: {author_id:author_id},
				success: function(result){
					$('#success').html(result);
					setTimeout(function(){ window.location.reload() },2000)
				}
			})
		})
	})
</script> 
<?php include "footer.php" ?> <!--- footer -->
</body>
</html>