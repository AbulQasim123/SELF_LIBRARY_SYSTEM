<?php
      session_start();
      require_once('db_connect.php'); // db Configuration
      if (!isset($_SESSION['admin_name'])) { //check session is exists
           header("Location:$Base_url");
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Library System</title>
	<!-- <link rel="stylesheet" href="css/Customstyle.css"> -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="js/popper.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>
	<div id="header"> <!-- Header -->
		<div class="container">
			<div class="row">
				<div class="offset-md-2 col-md-4">
					<div class="logo">
						<a href="javascript:void(0)"><img src="images/library.png" alt="Image not found"></a>
					</div>
				</div>
				<div class="offset-md-2 col-md-2">
					<div class="dropdown">
						<button class="btn btn-primary dropdown-toggle" type="button" id="" data-toggle="dropdown">
							<?php echo "Hi " .$_SESSION['admin_name']; ?>
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="change-password.php">Change Password</a>
							<a class="dropdown-item" href="logout.php">Logout</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- /Header -->

<!--       
    <div id="menubar"> 
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="menu">
						<li><a href="dashboard.php">Dashboard</a></li>
						<li><a href="author.php">Authors</a></li>
						<li><a href="publisher.php">Publishers</a></li>
						<li><a href="category.php">Categories</a></li>
						<li><a href="book.php">Books</a></li>
						<li><a href="student.php">Students</a></li>
						<li><a href="book-issue.php">Book Issue</a></li>
						<li><a href="reports.php">Reports</a></li>
						<li><a href="setting.php">Setting</a></li>
					</ul>
				</div>
			</div>
		</div>
    </div> -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
    	<span class="navbar-toggler-icon"></span>
  	</button>

  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
  	<ul class="navbar-nav" style="margin: 0 auto;">
		<li class="nav-item"><a class="nav-link text-white" href="dashboard.php">Dashboard</a></li>
		<li class="nav-item"><a class="nav-link text-white" href="author.php">Authors</a></li>
		<li class="nav-item"><a class="nav-link text-white" href="publisher.php">Publishers</a></li>
		<li class="nav-item"><a class="nav-link text-white" href="category.php">Categories</a></li>
		<li class="nav-item"><a class="nav-link text-white" href="book.php">Books</a></li>
		<li class="nav-item"><a class="nav-link text-white" href="student.php">Students</a></li>
		<li class="nav-item"><a class="nav-link text-white" href="book-issue.php">Book Issue</a></li>
		<li class="nav-item"><a class="nav-link text-white" href="reports.php">Reports</a></li>
		<li class="nav-item"><a class="nav-link text-white" href="setting.php">Setting</a></li>
	</ul>
	<form class="form-inline">
		<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
		<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  	</form>
  </div>
</nav>
    
</body>
</html>