<?php 
      require_once('header.php'); 
      if (!isset($_SESSION['admin_name'])) {
            header("Location:$Base_url");
      }
?> <!-- Header -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard</title>
	<link rel="stylesheet" href="css/Customstyle.css">
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> -->
</head>
<body>
    <div id="admin-content">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<h2 class="admin-heading">Dashboard</h2>
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-lg-3 col-md-3 col-sm-3">
					<?php // Select author count
						$sql = "select count(*) as total_author from author";
						$result = mysqli_query($con,$sql); 
						if (mysqli_num_rows($result) > 0) {
							while ($row = mysqli_fetch_assoc($result)) {?> 
							<div class="card" style="width:17rem; margin: 0 auto;">
								<div class="card-body text-center">
									<p class="card-text" style="font-size: 25px;">
										<?php echo $row['total_author']; ?>
									</p>
									<h5 class="card-title mb-0">Authors Listed</h5>
								</div>
							</div>
					<?php }}?>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3">
					<?php // Select publisher count
						$sql = "SELECT COUNT(*) AS total_publisher from publisher";
						$result = mysqli_query($con,$sql);
						if (mysqli_num_rows($result) > 0) {
							while ($row = mysqli_fetch_assoc($result)) { ?>
							<div class="card" style="width:17rem; margin: 0 auto;">
								<div class="card-body text-center">
									<p class="card-text" style="font-size: 25px">
										<?php echo $row['total_publisher']; ?>
									</p>
									<h5 class="card-title mb-0">Publishers Listed</h5>
								</div>
							</div>
					<?php }}  ?>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3">
					<?php // Select categories count
						$sql = "SELECT COUNT(*) AS total_category from category";
						$result = mysqli_query($con,$sql);
						if (mysqli_num_rows($result) > 0) {
							while ($row = mysqli_fetch_assoc($result)) { ?>
							<div class="card"style="width:17rem; margin:0 auto">
								<div class="card-body text-center">
									<p class="card-text"style="font-size: 25px;">
										<?php echo $row['total_category']; ?>
									</p>
									<h5 class="card-title mb-0">Categories Listed</h5>
								</div>
							</div>
					<?php }} ?>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3">
					<?php // Select books count
						$sql = "select count(*) as total_book from book";
						$result = mysqli_query($con,$sql);
						if (mysqli_num_rows($result) > 0) {
							while ($row = mysqli_fetch_assoc($result)) { ?>
							<div class="card" style="width: 17rem; margin:0 auto">
								<div class="card-body text-center"  style="font-size: 25px;">
									<p class="card-text"style="font-size:25px;">
										<?php echo $row['total_book']; ?>
									</p>
									<h5 class="card-title mb-0">Books Listed</h5>
								</div>
							</div>
					<?php }} ?>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 my-3">
					<?php // Select Students count
						$sql = "SELECT count(*) as total_student from student";
						$result = mysqli_query($con,$sql);
						if (mysqli_num_rows($result) > 0) {
							while ($row = mysqli_fetch_assoc($result)) { ?>
							<div class="card" style="width: 17rem; margin:0 auto">
								<div class="card-body text-center">
									<p class="card-text"style="font-size: 25px;">
										<?php echo $row['total_student']; ?>
									</p>
									<h5 class="card-title mb-0">Students Listed</h5>
								</div>
							</div>
					<?php }} ?>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3  my-3">
					<?php // Select issue book count
						$sql ="SELECT count(*) as total_book_issue from book_issue";
						$result = mysqli_query($con,$sql);
						if (mysqli_num_rows($result) > 0) {
							while ($row = mysqli_fetch_assoc($result)) { ?>
							<div class="card" style="width: 17rem; margin: 0 auto;">
								<div class="card-body text-center">
									<p class="card-text" style="font-size: 25px;">
										<?php echo $row['total_book_issue']; ?>
									</p>
									<h5 class="card-title mb-0">Book Issued</h5>
								</div>
							</div>
					<?php }} ?>
				</div>
			</div>
		</div>
    </div>
<?php include 'footer.php'; ?>
</body>
</html>