<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Student</title>
	<link rel="stylesheet" href="css/jquery.dataTables.css">
	<script type="text/javascript" src="js/jquery.dataTables.min.js" defer></script>
	<style>
		.modal-header, h4, .close {
			background-color: lightslategrey;
			color:white !important;
			text-align: center;
			font-size: 30px;
		}
		.modal-footer {
			background-color: #f9f9f9;
		}
	</style>
</head>
<body>
	<?php include 'header.php'; ?>
    <div id="admin-content">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<h2 class="admin-heading" style="width: 40%;">All Student</h2>
				</div>
				<div class="col-lg-6">
					<a href="add-student.php" class="add-new btn float-right btn-primary " style="border: 1px solid #eee000; border-radius: 10px;">Add Student</a>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div id="success" class="success"></div>
					<div class="card" style="background-color: lightgray;">
						<div class="card-body">
							<?php 
								$sql= "SELECT * from `student` order by `student_id` desc";
								$result = mysqli_query($con,$sql);
							?>
							<div class="table-responsive">
								<table class="table table-bordered table-sm" id="mytable">
									<thead style="background: #eee0ee">
										<tr>
											<th>Sr no</th>
											<th>Student Name</th>
											<th>Student Gender</th>
											<th>Student Phone</th>
											<th>Student Email</th>
											<th>View</th>
											<th>Edit</th>
											<th>Delete</th>
										</tr>
										<tbody>
											<?php 
												if (mysqli_num_rows($result) > 0) {
													$Sr_no = 0;
													while ($row = mysqli_fetch_assoc($result)) {
														$Sr_no++;
											?>
											<tr>
												<td><?php echo $Sr_no; ?></td>
												<td><?php echo $row['student_name']; ?></td>
												<td><?php echo $row['student_gender']; ?></td>
												<td><?php echo $row['student_phone']; ?></td>
												<td><?php echo $row['student_email']; ?></td>
												<td class="view">
													<button type="button" class="btn btn-info btn-sm view-btn" data-sid="<?php echo $row['student_id']; ?>" >View</button>
												</td>
												<td class="edit">
													<a href="update-student.php?sid=<?php echo $row['student_id']; ?>" class="btn btn-primary btn-sm">Edit</a>
												</td>
												<td class="delete">
													<a data-sid="<?php echo $row['student_id']; ?>" href="javascript:void(0)" class="btn btn-danger delete-student btn-sm">Delelte</a>
												</td>
											</tr>
											<?php  } }else{ ?>
											<tr>
												<td colspan="8">No Student Found.</td>
											</tr>
											<?php } ?>
										</tbody>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Bootstrap modal -->
<div class="modal fade" id="mymodal" role="dialog">
	<div class="modal-dialog modal-lg">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Student Detail</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div id="modal-body" class="modal-body" style="background-color: #eee">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


	<?php include 'footer.php'; ?>
	<script>
		$(document).ready(function(){
			$('#mytable').DataTable();
				// show student detail in modal
			$('.view-btn').on('click', function(){
				var student_id = $(this).data('sid');
				// alert(student_id);
				$.ajax({
					url: 'view-student.php',
					type: 'POST',
					data: {student_id:student_id},
					success: function(result){
						$('#mymodal').modal('show');
						$('#modal-body').html(result);
					}
				})
			})
			// $('#close-btn').on('click', function(){
			// 	$('#modal').hide();
			// })
				// Hide modal

				// Delete student record
			$('.delete-student').on('click', function(){
				var stu_id = $(this).data('sid');
				// alert(stu_id);
				$.ajax({
					url: 'delete-student.php',
					type: 'POST',
					data: {stu_id:stu_id},
					success: function(result){
						$('#success').html(result);
						setTimeout(() => {
							window.location.reload();
						}, 3000);
					}
				})
			})
		})
		
	</script>
</body>
</html>