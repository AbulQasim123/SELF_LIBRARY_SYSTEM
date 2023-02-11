<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Not Returned</title>
</head>
<body>
    <div id="admin-content">
		<div class="container">
			<div class="row">
				<div class="offset-md-3 col-md-6">
					<h2 class="admin-heading text-center">Not Returned Books</h2>
				</div>
			</div>
			<?php 
				// $date = date('Y-m-d');
				// Select query
				$sql = "SELECT book_issue.issue_id,book_issue.issue_name,book_issue.issue_book,book_issue.issue_status,
				book_issue.issue_date,book_issue.return_date,student.student_id,student.student_phone,student.student_email,student.student_name,book.book_name FROM book_issue
				LEFT JOIN student ON book_issue.issue_name = student.student_id
				LEFT JOIN book ON book_issue.issue_book = book.book_id
				ORDER BY book_issue.issue_id DESC";
				$result = mysqli_query($con,$sql);
				if (mysqli_num_rows($result) > 0) {
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
									<th>Issue date</th>
									<th>Return Date</th>
									<th>Over Days</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$sr_no = 0;
									while($row = mysqli_fetch_assoc($result)){
										$sr_no++;
										if (date('Y-m-d',) > $row['issue_date'] && $row['issue_status'] == 'N') {
											$over = 'style="background-color: rgba(255,0,0,0.2)"';
										}else{
											$over = '';
										}
								?>
								<tr <?php echo $over; ?>>
									<td><?php echo $sr_no; ?></td>
									<td><?php echo $row['student_name']; ?></td>
									<td><?php echo $row['book_name']; ?></td>
									<td><?php echo $row['student_phone']; ?></td>
									<td><?php echo $row['student_email']; ?></td>
									<td><?php echo date('d M,Y', strtotime($row['issue_date'])); ?></td>
									<td><?php echo date('d M, Y', strtotime($row['return_date'])); ?></td>
									<td>
										<?php 
											$date1 = date_create(date('Y-m-d'));
											$date2 = date_create($row['return_date']);
											if($date1 > $date2){
												$date_diff = date_diff($date1,$date2);
												echo $days = $date_diff->format('%a days');
											}else{
												echo '0 days';
											}
										?>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						<a href="reports.php" class="btn btn-secondary btn-sm">Back</a>
					</div>
				</div>
			</div>
			<?php }else{ echo '<h4 class="text-center text-danger">No Returned found.</h4>'; } ?>
		</div>
	</div>
<?php include 'footer.php'; ?>
</body>
</html>