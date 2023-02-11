<?php
	include 'header.php';
	if (isset($_POST['add'])) {
		$error = '';
			// Get return day form setting table
		$sql = "SELECT * from `setting`";
		$result = mysqli_query($con,$sql);
		if (mysqli_num_rows($result) > 0) {
			$return_days = 0;
			while ($row = mysqli_fetch_assoc($result)) {
				$return_days = $row['return_days'];
			}
		}
			// if form submit
		if (empty($_POST['std_name']) || empty($_POST['book_name'])) {
			$error .= '<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button>All Field are required ?</div>';
		}else{
			// validate input
			$issue_name = mysqli_real_escape_string($con,$_POST['std_name']);
			$issue_book = mysqli_real_escape_string($con,$_POST['book_name']);
			$issue_date = date('Y-m-d');
			$return_date = date('Y-m-d', strtotime("+".$return_days." Days"));
						
			$insert_sql = "INSERT INTO book_issue(issue_name,issue_book,issue_date,return_date,issue_status) VALUES ('{$issue_name}','{$issue_book}','{$issue_date}','$return_date','N')";
			
			if (mysqli_query($con,$insert_sql)) {
				$update_sql = "UPDATE `book` set `book_status` = 'N' where `book_id` = '$issue_book' ";
				mysqli_query($con,$update_sql);
				header("Location:$Base_url/book-issue.php");
			}else{
				$error .= '<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button>Something went wrong</div>';
			}
		}
	}

	// if(isset($_POST['add'])){
	// 	// --------------------
	// 	// get return days from settings table
	// 	$sql = "SELECT * FROM setting";
	// 	$result = mysqli_query($con, $sql);
	// 	if(mysqli_num_rows($result) > 0){
	// 	  $return_days = 0;
	// 	  while($row = mysqli_fetch_assoc($result)){
	// 		$return_days = $row['return_days'];
	// 	  }
	// 	}
	// 	// --------------------
	// 	if(empty($_POST['std_name']) || empty($_POST['book_name'])){
	// 	  echo "<div class='alert alert-danger'>Please Fill All the Fields.</div>";
	// 	}else{
	// 	  // validate inputs
	// 	  $issue_name = mysqli_real_escape_string($con, $_POST['std_name']);
	// 	  $issue_book = mysqli_real_escape_string($con, $_POST['book_name']);
	// 	  $issue_date = date('Y-m-d');
	// 	  $return_date = date('Y-m-d',strtotime("+".$return_days." days"));
	// 	  //insert query
	// 	  $sql = "INSERT INTO book_issue(issue_name,issue_book,issue_date,return_date,issue_status) VALUES ('{$issue_name}','{$issue_book}','{$issue_date}','$return_date','N')";
	// 	  if(mysqli_query($con, $sql)){
	// 		$update = "UPDATE book SET book_status = 'N' WHERE book_id = {$issue_book}";
	// 		$result = mysqli_query($con, $update);
	// 		header("$base_url/book-issue.php"); //redirect
	// 	  }else{
	// 		echo "<div class='alert alert-danger'>Query failed.</div>";
	// 	  }
	// 	}
	//   }
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Add Book Issue</title>
      <link rel="stylesheet" href="css/Customstyle.css">
</head>
<body>
    <div id="admin-content">
		<div class="container">
			<?php 
				if (isset($error)) {
					echo $error;
				}
			?>
			<div class="row">
				<div class="col-md-6">
					<h2 class="admin-heading" style="width: 43%;">Add Book Issue</h2>
				</div>
				<div class="col-md-6">
					<a href="book.php" class="add-new float-right btn btn-primary btn-sm">All Issue List</a>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card" style="background-color: #eee;">
						<div class="card-body">
							<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
								<div class="form-group">
									<label for="std_name">Student Name</label>
									<select name="std_name" id="std_name" class="form-control">
										<option value="">Select Name</option>
										<?php  
											$sql = "SELECT * from `student`";
											$result = mysqli_query($con,$sql);
											if (mysqli_num_rows($result) > 0) {
												while ($row = mysqli_fetch_assoc($result)) {
													echo "<option value='{$row['student_id']}'>{$row['student_name']}</option>";
												}
											}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="book_name">Book Name</label>
									<select name="book_name" id="book_name" class="form-control">
										<option value="">Select Name</option>
										<?php 
											$sql1 = "SELECT * from `book` where book_status = 'Y' ";
											$result = mysqli_query($con,$sql1);
											if (mysqli_num_rows($result) > 0) {
												while ($row = mysqli_fetch_assoc($result)) {
													echo "<option value='{$row['book_id']}'>{$row['book_name']}</option>";
												}
											}
										?>
									</select>
								</div>
								<input type="submit" value="Add" name="add" id="add" class="btn btn-primary btn-sm">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
	<?php include 'footer.php';?>
</body>
</html>