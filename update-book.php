<?php
	include 'header.php';
	if (isset($_POST['update'])) {
		$error = "";
		if (empty($_POST['book_name']) || empty($_POST['category']) || empty($_POST['author']) || empty($_POST['publisher'])){
			$error .= '<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button>All Field are required ?</div>';
		}else{
				// validate input 
			$book_id = mysqli_real_escape_string($con,$_POST['book_id']);
			$book_name = mysqli_real_escape_string($con,$_POST['book_name']);
			$book_category = mysqli_real_escape_string($con,$_POST['category']);
			$book_author = mysqli_real_escape_string($con,$_POST['author']);
			$book_publisher = mysqli_real_escape_string($con,$_POST['publisher']);
				// update query
			$update_sql = "UPDATE book SET book_name = '{$book_name}', book_category = '{$book_category}', book_author = '{$book_author}', book_publisher = '{$book_publisher}' WHERE book_id = '{$book_id}'";
			if (mysqli_query($con,$update_sql)) {
				header("Location:$Base_url/book.php");
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
    <title>Update Book</title>
</head>
<body>
    <div id="admin-content">
		<div class="container">
			<?php 
				if(isset($error)){
					echo $error;
				}
			?>
			<div class="row">
				<div class="col-md-3">
					<h2 class="admin-heading">Update Book</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card" style="background-color: lightgray;">
						<div class="card-body">
							<?php
								$update_id = $_GET['bid'];
								$sql = "SELECT book.book_id, book.book_name, book.book_category, book.book_author, book.book_publisher,
								category.category_name, author.author_name, publisher.publisher_name FROM book
								LEFT JOIN category ON book.book_category = category.category_id
								LEFT JOIN author ON book.book_author  = author.author_id
								LEFT JOIN publisher ON book.book_publisher = publisher.publisher_id
								WHERE book.book_id = {$update_id}";
								$result = mysqli_query($con,$sql);
								if (mysqli_num_rows($result)) {
									while ($row = mysqli_fetch_assoc($result)) {
								?>
							<form action="" method="POST" autocomplete="off">
								<div class="form-group">
									<input type="hidden" name="book_id" id="book_id" value="<?php echo $row['book_id']; ?>">
								</div>
								<div class="form-group">
									<label for="update_name">Update Name</label>
									<input type="text" name="book_name" id="book_name" class="form-control" placeholder="Enter Book Name" value="<?php echo $row['book_name']; ?>">
								</div>
								<div class="form-group">
									<label for="category">Category</label>
									<select name="category" id="category" required class="form-control">
										<option disabled>Select Category</option>
										<?php 
											$sql1 = "SELECT * from `category`";
											$result1 = mysqli_query($con,$sql1) or die("SQL query failed.");
											if (mysqli_num_rows($result) > 0) {
												while ($row1= mysqli_fetch_assoc($result1)) {
													if ($row['category'] == $row1['category_id']) {
														$selected = "Selected";
													}else{
														$selected = "";
													}
													echo "<option {$selected} value=".$row1['category_id'].">".$row1['category_name']."</option>";
												}
											}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="author">Author</label>
									<select name="author" id="author" required class="form-control">
										<option disabled>Select Author</option>
										<?php 
											$sql1 = "SELECT * from `author` ";
											$result1 = mysqli_query($con,$sql1) or die("SQL Query Failed");
											if (mysqli_num_rows($result1) > 0) {
												while($row1 = mysqli_fetch_assoc($result1)){
													if ($row['author'] == $row1['author_id']) {
														$selected = "Selected";
													}else{
														$selected = "";
													}
													echo "<option {$selected} value=".$row1['author_id'].">".$row1['author_name']."</option>";
												}
											}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="publisher">Publisher</label>
									<select name="publisher" id="publisher" required class="form-control">
										<option disabled>Select Publisher</option>
										<?php 
											$sql3 = "SELECT * from `publisher`";
											$result3 = mysqli_query($con,$sql3);
											if (mysqli_num_rows($result3) > 0) {
												while ($row3 = mysqli_fetch_assoc($result3)) {
													if ($row['publisher'] == $row3['publisher_id']) {
														$selected = "Selected";
													}else{
														$selected = "";
													}
													echo "<option {$selected} value=".$row3['publisher_id'].">".$row3['publisher_name']."</option>";
												}
											}
										?>
									</select>
								</div>
								<input type="submit" value="Update" id="update" name="update" class="btn btn-primary btn-sm">
								<a href="http://localhost/PHP-PRACTICAL/SELF_LIBRARY_SYSTEM/book.php" class="btn btn-primary btn-sm">Back</a>
							</form>
							<?php } } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
	<?php include 'footer.php'; ?>
</body>
</html>