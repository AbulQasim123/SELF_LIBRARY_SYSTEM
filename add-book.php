<?php 
    include 'header.php';
	if (isset($_POST['insert'])) {
		$error = "";
		if (empty($_POST['book_name']) || empty($_POST['category']) || empty($_POST['author']) || empty($_POST['publisher'])){
			$error .= '<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button>All Field are required ?</div>';
		}else{
				// validate input 
			$book_name = mysqli_real_escape_string($con,$_POST['book_name']);
			$category = mysqli_real_escape_string($con,$_POST['category']);
			$author = mysqli_real_escape_string($con,$_POST['author']);
			$publisher = mysqli_real_escape_string($con,$_POST['publisher']);
				// Query for check book name exist or not 
			$check_sql = "SELECT `book_name` from `book` where `book_name` = '{$book_name}' ";
			$result = mysqli_query($con,$check_sql);
			if (mysqli_num_rows($result) > 0) {
				$error .= '<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button>Book name is already exist!</div>';
			}else{
				// insert into book 
				$insert_sql = "INSERT into `book` (`book_name`,`book_category`,`book_author`,`book_publisher`,`book_status`) values ('{$book_name}','{$category}','{$author}','{$publisher}','Y') ";
				if (mysqli_query($con,$insert_sql)) {
					header("Location:$Base_url/book.php");
				}
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Add book</title>
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
					<h2 class="admin-heading" style="width: 35%;">Add Book</h2>
				</div>
				<div class="col-md-6">
					<a href="book.php" class="add-new btn btn-primary btn-sm float-right">All book</a>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card" style="background: lightgray;">
						<div class="card-body">
							<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
								<div class="form-group">
									<label for="book_name">Book Name</label>
									<input type="text" name="book_name" id="book_name" class="form-control" placeholder="Enter Book Name">
								</div>
								<div class="form-group">
									<label for="category">category</label>
									<select name="category" id="category" class="form-control">
										<option value="">Select Category</option>
										<?php 
											$sql = "SELECT * from `category`";
											$result = mysqli_query($con,$sql) or die("SQL Query Failed");
											if(mysqli_num_rows($result) > 0){
												while ($row = mysqli_fetch_assoc($result)) {
													echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
												}
											}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="author">Author</label>
									<select name="author" id="author" class="form-control">
										<option value="">Select Author</option>
										<?php 
											$sql = "SELECT * from `author`";
											$result = mysqli_query($con,$sql) or die("SQL Query Failed");
											if(mysqli_num_rows($result) > 0){
												while ($row = mysqli_fetch_assoc($result)) {
													echo "<option value='{$row['author_id']}'>{$row['author_name']}</option>";
												}
											}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="publisher">Publishers</label>
									<select name="publisher" id="publisher" class="form-control">
										<option value="">Select Publisher</option>
										<?php 
											$sql = "SELECT * from `publisher`";
											$result = mysqli_query($con,$sql) or die("SQL Query Failed");
											if(mysqli_num_rows($result) > 0){
												while ($row = mysqli_fetch_assoc($result)) {
													echo "<option value='{$row['publisher_id']}'>{$row['publisher_name']}</option>";
												}
											}
										?>
									</select>
								</div>
								<input type="submit" name="insert" id="insert" class="btn btn-primary btn-sm" value="Add">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>
</body>
</html>