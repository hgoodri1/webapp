<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Books Unlimited Webapp</title>
    <meta charset="UTF-8" />
    <script src="http://code.jquery.com/jquery-3.1.1.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
  </head>
  <body>
    <div id="Content">
        <header>
            <span>Books Unlimited Webapp</span>
            <nav id="Menu">
              <ul>
                <li><a href="index.php">Home</a></li>
                <!--UNCOMMENT THE LINES BELOW IN MODULE 3-->
                <li><a href="authors.php">Authors</a></li>
                <li><a href="publishers.php">Publishers</a></li>
                <li><a href="books.php">Books</a></li>
                <!--UNCOMMENT THE LINE BELOW IN MODULE 4-->
                <li><a href="dashboard.php">Dashboard</a></li>
              </ul>
            </nav>
        </header>
        <div id="PageContent">
