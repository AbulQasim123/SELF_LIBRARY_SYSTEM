<?php 
	include "header.php"; // header
	if (isset($_POST['return'])) {
		$issue_id = $_GET['iid'];
		$book_id = $_POST['book_id'];
		$date = date('Y-m-d');
			// Update book issue table
		$sql = "UPDATE book_issue SET issue_status = 'Y', return_day = '{$date}' WHERE issue_id = {$issue_id};";
			// Update book status in book table
		$sql .= "UPDATE book SET book_status = 'Y' WHERE book_id = {$book_id}";
		if (mysqli_multi_query($con,$sql)) {
			header("Location:$Base_url/book-issue.php"); // Redirect
		}
	}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Update Book Issue</title>
	<link rel="stylesheet" href="css/Customstyle.css">
</head>
<body>
	<div id="admin-content">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<h2 class="admin-heading">Update Book Issue</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card" style="background-color: #eee;">
						<div class="card-body">
							<?php
								// Get fine value form setting table 
								$query = "SELECT * from `setting` ";
								$q_result = mysqli_query($con,$query);
								if (mysqli_num_rows($q_result) > 0) {
									$fine = 0;
									while ($q_row = mysqli_fetch_assoc($q_result)) {
										$fine = $q_row['fine'];
									}
								}
									// Select Query
								$issue_id = $_GET['iid'];
									$sql = "SELECT book_issue.issue_id,book_issue.issue_name,book_issue.issue_book,book_issue.issue_status,book_issue.return_day,
									book_issue.issue_date,book_issue.return_date,student.student_id,student.student_phone,student.student_email,student.student_name,book.book_name FROM book_issue
									LEFT JOIN student ON book_issue.issue_name = student.student_id
									LEFT JOIN book ON book_issue.issue_book = book.book_id
									WHERE issue_id = {$issue_id}
									ORDER BY book_issue.issue_id DESC";
									$result = mysqli_query($con,$sql) or die("SQL Query Failed");
									if (mysqli_num_rows($result)) {
										while ($row = mysqli_fetch_assoc($result)) {
							?>
							<div class="table-responsive">
								<table class="table table-bordered table-sm" cellpadding="10px" width="90%" style="margin: 0 0 20px;">
									<tr>
										<th>student Name</th>
										<td><b><?php echo $row['student_name']; ?></b></td>
									</tr>
									<tr>
										<th>Book Name</th>
										<td><b><?php echo $row['book_name']; ?></b></td>
									</tr>
									<tr>
										<th>Phone</th>
										<td><b><?php echo $row['student_phone']; ?></b></td>
									</tr>
									<tr>
										<th>Email</th>
										<td><b><?php echo $row['student_email']; ?></b></td>
									</tr>
									<tr>
										<th>Issue Date</th>
										<td><b><?php echo date('d M, Y', strtotime($row['issue_date'])); ?></b></td>
									</tr>
									<tr>
										<th>Return Date</th>
										<td><b><?php echo date('d M, Y', strtotime($row['return_date'])); ?></b></td>
									</tr>
									<?php
										if ($row['issue_status'] == 'Y') {
									?>
									<tr>
										<th>Status</th>
										<td><b>Returned</b></td>
									</tr>
									<tr>
										<th>Returned On</th>
										<td>
											<b><?php echo date('d M, Y', strtotime($row['return_day']));?></b>
										</td>
									</tr>
									<?php }else{ ?>
										<tr>
											<th>Charge</th>
											<?php 
												$date1 = date_create(date('Y-m-d'));
												$date2 = date_create($row['return_date']);
												$diff = date_diff($date1,$date2);
												$days = $diff->format('%a');
											?>
											<td><b><?php echo 'Rs. ' .($fine* $days); ?></b></td>
										</tr>
									<?php } ?>
								</table>
								<?php if($row['issue_status'] == 'N'){ ?>
								<form action="" method="post" autocomplete="off">
									<input type="hidden" name="book_id" id="book_id" value="<?php echo $row['issue_book'] ?>">
									<input type="submit" value="Return Book" name="return" class="btn btn-success btn-sm">
									<a href="http://localhost/PHP-PRACTICAL/SELF_LIBRARY_SYSTEM/book-issue.php" class="btn btn-primary btn-sm">Back</a>
								</form>
								<?php }else{ ?>
									<a href="http://localhost/PHP-PRACTICAL/SELF_LIBRARY_SYSTEM/book-issue.php" class="btn btn-primary btn-sm">Back</a>
								<?php } ?>
							</div>
							<?php }} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

<?php include "footer.php" ?> <!-- footer -->
