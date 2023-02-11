<?php
      include_once 'db_connect.php';
      session_start();
      session_unset();
      session_destroy();
      header("Location:$Base_url");
?>