<?php
	include 'db_connect.php';
	if (isset($_POST['issue_id'])) {
		$issue_id = $_POST['issue_id'];
		// Delete sql
		$sql = "DELETE from book_issue where issue_id = '{$issue_id}' ";
		$result = mysqli_query($con,$sql);
		if($result){
			echo "<div class='alert alert-success alert' style='font-size: 18px; font-style:italic;'><button type='button' class='close' data-dismiss='alert'>&times;</button>Issue Book deleted successfully!</div>";
		}else{
			echo "<p style='color:red; margin: 10px 0'>Can't Book Issue Record.</p>";
		}
	}
	mysqli_close($con);
?>