<?php
      include 'db_connect.php';
      if (isset($_POST['author_id'])) {
            $author_id = $_POST['author_id'];
                   //check author name is used in books table
            $sql = "SELECT * from `book` where `book_author` = '{$author_id}' ";
            $result = mysqli_query($con,$sql);
            if (mysqli_num_rows($result) > 0) {
                  echo "<div class='alert alert-danger alert' style='font-size: 18px; font-style:italic;'><button type='button' class='close' data-dismiss='alert'>&times;</button>Can't delete author record, this author is used in book!</div>";
            }else{
                  // Delete Query 
                  $del_query = "DELETE from `author` where `author_id` = '{$author_id}' ";
                  if (mysqli_query($con,$del_query)) {
                        echo "<div class='alert alert-success' style='font-size: 18px; font-style:italic;'><button type='button' class='close' data-dismiss='alert'>&times;</button>Author deleted successfully.<div>";
                  }else{
                        echo "<div class='alert alert-danger' style='font-size: 18px; font-style:italic;'><button type='button' class='close' data-dismiss='alert'>&times;</button>Somethings Went Wrong!</div>";
                  }
            }
      }
?>