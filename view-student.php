<?php
    include 'db_connect.php';
	if(isset($_POST['student_id'])){
		$student_id = $_POST['student_id'];
		$sql = "SELECT * from `student`  where `student_id` = '{$student_id}' ";
		$result = mysqli_query($con,$sql);
		$output = '';
		if(mysqli_num_rows($result) > 0){
			while ($row = mysqli_fetch_assoc($result)) {
				$output .= "<table id='modal_table' class='table text-center table-bordered table-hover table-sm'></tr>
								<th>Student Name</th>
								<td><b>{$row['student_name']}</b></td>
							</tr>
							</tr>
								<th>Address</th>
								<td><b>{$row['student_address']}</b></td>
							</tr>
							</tr>
								<th>Gender</th>
								<td><b>{$row['student_gender']}</b></td>
							</tr>
							</tr>
								<th>Class</th>
								<td><b>{$row['student_class']}</b></td>
							</tr>
							</tr>
								<th>Agee</th>
								<td><b>{$row['student_age']}</b></td>
							</tr>
							</tr>
								<th>Phone</th>
								<td><b>{$row['student_phone']}</b></td>
							</tr>
							</tr>
								<th>Email</th>
								<td><b>{$row['student_email']}</b></td>
							</tr>";
			}
		}else{
			$output .= "<tr><td>No record found.</td></tr></table>";
		}
		echo $output;
	}
?>