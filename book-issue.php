<?php include 'header.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Book Issue</title>
	<link rel="stylesheet" href="css/Customstyle.css">
	<link rel="stylesheet" href="css/jquery.dataTables.css">
	<script type="text/javascript" src="js/jquery.dataTables.min.js" defer></script>
</head>
<body>
	<div id="admin-content">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h2 class="admin-heading" style="width: 45%;">All Book Issue</h2>
				</div>
				<div class="col-md-6">
					<a href="add-book-issue.php" class="add-new float-right btn btn-primary btn-sm">Add Book Issue</a>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div id="success" class="message"></div>
					<div class="card" style="background-color: lightgray;">
						<div class="card-body">
							<?php 
									//select query
								$sql = "SELECT book_issue.issue_id,book_issue.issue_status,book_issue.issue_name,book_issue.issue_book,
								book_issue.issue_date,book_issue.return_date,student.student_id,student.student_phone,student.student_email,student.student_name,book.book_name FROM book_issue
								LEFT JOIN student ON book_issue.issue_name = student.student_id
								LEFT JOIN book ON book_issue.issue_book = book.book_id
								ORDER BY book_issue.issue_id DESC";
								$result = mysqli_query($con,$sql) or die("SQL Query Failed");
							?>
							<div class="table-responsive">
								<table id="my_table" class="table table-bordered table-sm">
									<thead style="background: #eee0ee">
										<tr>
											<th>Sr no</th>
											<th>Student Name</th>
											<th>Book Name</th>
											<th>Phone</th>
											<th>Email</th>
											<th>Issue Date</th>
											<th>Return Date</th>
											<th>Status</th>
											<th>Edit</th>
											<th>Delete</th>
										</tr>
										<tbody>
											<?php 
												if (mysqli_num_rows($result) > 0) {
													$Sr_no = 0;
													while ($row = mysqli_fetch_assoc($result)) {
														$Sr_no ++;
														if ((date('Y-m-d') > $row['return_date']) && $row['issue_status'] == 'N') {
															$over = 'style="background:rgba(255,0,0,0.2)"';
														}else{
															$over = '';
														}
											?>
											<tr <?php echo $over; ?>>
												<td><?php echo $Sr_no; ?></td>
												<td><?php echo $row['student_name']; ?></td>
												<td><?php echo $row['book_name']; ?></td>
												<td><?php echo $row['student_phone']; ?></td>
												<td><?php echo $row['student_email']; ?></td>
												<td><?php echo date('d M, Y', strtotime($row['issue_date'])) ?></td>
												<td><?php echo date('d M, Y', strtotime($row['return_date'])) ?></td>
												<td>
													<?php 
														if ($row['issue_status'] == 'Y') {
															echo "<span class='badge badge-pill badge-success'>Returned</span>";
														}else{
															echo "<span class='badge badge-pill badge-danger'>Issued</span>";
														}
													?>
												</td>
												<td>
													<a href="update-book-issue.php?iid=<?php echo $row['issue_id'] ?>" class="btn btn-primary btn-sm">Edit</a>
												</td>
												<td>
													<button data-iid="<?php echo $row['issue_id']?>" class="btn btn-danger delete-issue-book btn-sm">Delete</button>
												</td>
											</tr>
											<?php }}else{ ?>
											<tr>
												<td colspan="10">No Book Issue Found.</td>
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
<?php include 'footer.php' ?>
<script>
	$(document).ready(function(){
		$('#my_table').DataTable();
	})
	$('.delete-issue-book').on('click', function(){
		var issue_id = $(this).data('iid');
		// alert(issue_id);
		$.ajax({
			url: 'delete-issue-book.php',
			type: 'POST',
			data: {issue_id:issue_id},
			success: function(result){
				$('#success').html(result);
				setTimeout(() => {
					window.location.reload();
				}, 3000);
			}
		})
	})
</script>
</body>
</html>