<?php
      include 'db_connect.php';
      if(isset($_POST['category_id'])){
            $category_id = $_POST['category_id'];
                  // check category name is used in table book
            $check_sql = "SELECT * from `book` where `book_category` = '{$category_id}' ";
            $result = mysqli_query($con,$check_sql);
            if (mysqli_num_rows($result) > 0) {
                  echo "<div class='alert alert-danger alert' style='font-size: 18px; font-style:italic;'><button type='button' class='close' data-dismiss='alert'>&times;</button>Can't delete Category record, this Category is used in book!</div>";
            }else{
                  // Excute delete query 
                  $del_query = "DELETE from `category` where `category_id` = '{$category_id}' ";
                  if (mysqli_query($con,$del_query)) {
                        echo "<div class='alert alert-success alert' style='font-size: 18px; font-style:italic;'><button type='button' class='close' data-dismiss='alert'>&times;</button>Category deleted successfully!</div>";
                  }else{
                        echo "<div class='alert alert-danger alert' style='font-size: 18px; font-style:italic;'><button type='button' class='close' data-dismiss='alert'>&times;</button>Somethings went wrong!</div>";
                  }
            }
      }
?>

