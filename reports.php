<?php
	include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reports</title>
</head>
<body>
	<div class="" id="admin-content">
		<div class="container">
			<div class="row">
				<div class="offset-md-4 col-md-4">
					<h2 class="admin-heading text-center">Reports</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="card">
						<div class="card-body text-center">
							<a href="date-report.php" class="card-link"><h5 class="card-title text-info mb-0">Date Wise Report</h5></a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
						<div class="card-body text-center">
							<a href="month-report.php" class="card-link"><h5 class="card-title text-info mb-0">Month Wise Report</h5></a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
						<div class="card-body text-center">
							<a href="not-returned.php" class="card-link"><h5 class="card-title text-info mb-0">Not Returned</h5></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php include 'footer.php'; ?>