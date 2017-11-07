<?php
  require_once 'dbconnect.php';
  require_once  'show_events.php';
  $category=$_REQUEST['category'];
  $city=$_REQUEST['city'];
   echo $category;
   echo $city;
  $show->show_by_category($category,$city);
  ?>