<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Month-wise Report</title>
</head>
<body>
    <div id="admin-content">
		<div class="container">
			<div class="row">
				<div class="offset-md-3 col-md-6">
					<h2 class="admin-heading text-center">Month wise Book issue Report</h2>
				</div>
			</div>
			<div class="row">
				<div class="offset-md-4 col-md-4">
					<form style="background: lightgrey; padding: 25px; box-shadow: 0 4px 5px rgba(0,0,0,0.5);" class="mb-5" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" autocomplete="off">
						<div class="form-group">
							<label for="month" class="font-weight-bold">Search Report</label>
							<input type="month" name="month" id="month" class="form-control" value="<?php echo date('Y-m') ?>">
							<input type="submit" value="Search" class="btn my-2 btn-danger btn-sm" name="search">
							<a href="reports.php" class="btn btn-secondary btn-sm">Back</a>
						</div>
					</form>
				</div>
			</div>
			<?php
				if(isset($_POST['search'])){
					$error = '';
					if (empty($_POST['month'])) {
						$error .=  "<div style='font-style: italic; font-size: 18px; width: 350px; margin: 0 auto;' class='alert text-center alert-danger alert-sm'><button class='close' data-dismiss='alert'>&times;</button>Please Select Date!</div>";
					}else{
						$month = mysqli_real_escape_string($con,$_POST['month']);
						$sql = "SELECT book_issue.issue_id,book_issue.issue_name,book_issue.issue_book,book_issue.issue_status,
						book_issue.issue_date,book_issue.return_date,student.student_id,student.student_phone,student.student_email,student.student_name,book.book_name FROM book_issue
						LEFT JOIN student ON book_issue.issue_name = student.student_id
						LEFT JOIN book ON book_issue.issue_book = book.book_id
						WHERE DATE_FORMAT(book_issue.issue_date,'%Y-%m') = '{$month}'
						ORDER BY book_issue.issue_id DESC";
						$result = mysqli_query($con,$sql);
						if (mysqli_num_rows($result)) {
			?>
			<div class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-sm">
							<thead class="thead-dark">
								<tr>
									<th>Sr no</th>
									<th>Student Name</th>
									<th>Book Name</th>
									<th>Phone</th>
									<th>Email</th>
									<th>Issue Date</th>
									<th>Return Date</th>
								</tr>
								<tbody>
									<?php 
										$Sr_no =0;
										while ($row = mysqli_fetch_assoc($result)) {
											$Sr_no ++;
											if (date('Y-m-d') > $row['return_date'] && $row['issue_status'] == 'N') {
												$over = 'style="background-color: rgba(255,0,0,0.2)"';
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
										<td><?php echo date('d F, Y', strtotime($row['issue_date'])); ?></td>
										<td><?php echo date('d F, Y', strtotime($row['return_date'])); ?></td>
									</tr>
									<?php } ?>
								</tbody>
							</thead>
						</table>
					</div>
				</div>
			</div>
			<?php 	
					}else{
						echo '<h4 class="text-center text-danger">No Report found.</h4>';
					}
				}
				}
			?>
		</div>
		<?php
			if (isset($error)) {
				echo $error;
			}
		?>
	</div>
</body>
</html>
<?php include 'footer.php'; ?>