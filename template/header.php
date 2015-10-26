<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

<?php
  echo '<title>Link Repository - ' . $page_title . '</title>';
?>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="style/main.css" />
<?php  echo $page_style; //to get specific tyle of the page ?>
  
 
</head>
<script src="scripts/jquery-1.11.3.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<body>
<div class="container">
<?php
  error_reporting(0);
  echo '<div id="siteTitle" class="page-header"><a href="dashboard.php">Link Repository </a>- ' . $page_title . '</div>';
?>
