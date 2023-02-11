<?php 
    include_once 'db_connect.php';
	if (isset($_POST['book_id'])) {
		$book_id = $_POST['book_id'];
		$check_sql = "SELECT * from `book_issue` where `issue_book` = '{$book_id}' ";
		$result = mysqli_query($con,$check_sql);
		if (mysqli_num_rows($result) > 0) {
			echo "<div class='alert alert-danger alert' style='font-size: 18px; font-style:italic;'><button type='button' class='close' data-dismiss='alert'>&times;</button>Can't delete Book record, this book is used in book issue!</div>";
		}else{
			// Delete query
			$sql = "DELETE from `book` where `book_id` = '{$book_id}' ";
			if (mysqli_query($con,$sql)) {
				echo "<div class='alert alert-success alert' style='font-size: 18px; font-style:italic;'><button type='button' class='close' data-dismiss='alert'>&times;</button>Book record deleted successfully.</div>";
			}else{
				echo "<div class='alert alert-danger alert' style='font-size: 18px; font-style:italic;'><button type='button' class='close' data-dismiss='alert'>&times;</button>Something Went Wrong!</div>";
			}
		}
	}
?>