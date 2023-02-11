<?php include 'header.php' ?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Books</title>
	<link rel="stylesheet" href="css/jquery.dataTables.css">
    <script type="text/javascript" src="js/jquery.dataTables.min.js" defer></script>
</head>
<body>
    
	<div id="admin-content">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<h2 class="admin-heading">All Books</h2>
				</div>
				<div class="offset-md-7 col-md-2">
					<a href="add-book.php" class="btn btn-primary btn-sm">Add Book</a>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div id="success" class="message"></div>
					<div class="card" style="background-color: lightgray;">
						<div class="card-body">
							<?php 
								// $sql = "SELECT * from `Book` order by `book_id` desc ";
								$sql = "SELECT book.book_id, book.book_status, book.book_name, book.book_category, book.book_author, book.book_publisher,
										category.category_name, author.author_name, publisher.publisher_name FROM book
										LEFT JOIN category ON book.book_category = category.category_id
										LEFT JOIN author ON book.book_author  = author.author_id
										LEFT JOIN publisher ON book.book_publisher = publisher.publisher_id
										ORDER BY book.book_id";
								$result = mysqli_query($con,$sql);
							?>
							<div class="table-responsive">
								<table id="mytable" class="table table-borderd table-sm">
									<thead style="background: #eee0ee">
										<tr>	
											<th>S.No</th>
											<th>Book Name</th>
											<th>Category</th>
											<th>Author</th>
											<th>Publisher</th>
											<th>Status</th>
											<th>Edit</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody>
										<?php
											if (mysqli_num_rows($result) > 0) {
												$Sr_no = 0; 
												while($row = mysqli_fetch_assoc($result)){
													$Sr_no++;
										?>
										<tr>
											<td><?php echo $Sr_no; ?></td>
											<td><?php echo $row['book_name']; ?></td>
											<td><?php echo $row['category_name']; ?></td>
											<td><?php echo $row['author_name']; ?></td>
											<td><?php echo $row['publisher_name']; ?></td>
											<td><?php
													if($row['book_status'] == 'Y'){
														echo "<span class='badge badge-pill badge-success'>Available</span>";
													}else{
														echo "<span class='badge badge-pill badge-danger'>Issued</span>";
													}
												?>
											</td>
											<td><a href="update-book.php?bid=<?php echo $row['book_id']?>" class="btn btn-primary btn-sm" id="bid" name="bid">Edit</a></td>
											<td><a href="javascript:void(0)" data-bid="<?php echo $row['book_id'] ?>" class="btn btn-danger delete-book btn-sm">Delete</a></td>
										</tr>
										<?php } }else{ ?>
										<tr>
											<td colspan="8" class="text-center" style="font-size: 18px;">No Books Found </td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function(){
			$('#mytable').DataTable();
		})
		$(function(){
			$('.delete-book').click(function(){
				var book_id = $(this).data('bid');
				// alert(book_id);
				$.ajax({
					url: "delete-book.php",
					type: "POST",
					data: {book_id:book_id},
					success: function(result){
						$('#success').html(result);
						setTimeout(() => {
							window.location.reload();
						}, 3000);
					}
				})
			})
		})
	</script>
	<?php include 'footer.php' ?> 
</body>
</html>