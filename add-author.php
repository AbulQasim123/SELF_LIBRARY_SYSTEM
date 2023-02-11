<?php
 	include "header.php" ;
	$error = '';
	if (isset($_POST['submit'])) {
		$author_name = mysqli_real_escape_string($con, $_POST['author_name']);
		if (isset($author_name)) {
			if (empty($author_name)) {
				$error .= '<div class="alert alert-danger alert-dismissable"><button class="close" data-dismiss="alert">&times;</button>Author Name is required ?</div>';
			}else{
				$check_sql = "SELECT * from `author`  where `author_name`  = '{$author_name}' "; // check author name exist or not
				$result = mysqli_query($con,$check_sql);
				if(mysqli_num_rows($result) > 0){
					// insert author name into table
					$error .= '<div class="alert alert-danger alert-dismissable"><button class="close" data-dismiss="alert">&times;</button>Author Name is Already exist !</div>';
				}else{
					$insert_sql = "INSERT into author (author_name) values ('{$author_name}') ";
					if (mysqli_query($con,$insert_sql)) {
						header("Location:$Base_url/author.php"); // redirect
					}
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
	<title>Add author</title>
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
					<h2 class="admin-heading" style="width: 47%;">Add Author</h2>
				</div>
				<div class="col-md-6">
					<a class="add-new btn btn-primary btn-sm float-right"  href="author.php">All Authors</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card" style="background: lightgrey">
						<div class="card-body">
							<form action="" method="POST">
								<div class="form-group">
									<label for="author_name">Author Name</label>
									<input type="text" class="form-control" id="author_name" name="author_name" placeholder="Author Name">
								</div>
								<input type="submit" class="btn btn-primary btn-sm" value="Add" name="submit" id="submit">
							</form>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div> 
</body>
</html>
<?php include "footer.php" ?> <!--- footer -->