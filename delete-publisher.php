<?php
      include 'db_connect.php';
      if (isset($_POST['publisher_id'])) {
            $publisher_id = $_POST['publisher_id'];
                  // check publisher name is used in books table
            $check_publisher =  "SELECT * from `book` where `book_publisher` = '{$publisher_id}' ";
            $result = mysqli_query($con,$check_publisher);
            if (mysqli_num_rows($result) > 0) {
                  echo "<div class='alert alert-danger alert' style='font-size: 18px; font-style:italic;'><button type='button' class='close' data-dismiss='alert'>&times;</button>Can't delete publisher record, this publisher is used in book!</div>";
            }else{
                  // Excute Delete query 
                  $del_sql = "DELETE from `publisher` where `publisher_id` = '{$publisher_id}' ";
                  if(mysqli_query($con,$del_sql)){
                        echo "<div class='alert alert-success' style='font-size: 18px; font-style:italic;'><button type='button' class='close' data-dismiss='alert'>&times;</button>Publisher deleted successfully.<div>";
                  }else{
                        echo "<div class='alert alert-danger' style='font-size: 18px; font-style:italic;'><button type='button' class='close' data-dismiss='alert'>&times;</button>Somethings Went Wrong!</div>";
                  }
            }
      }
?>