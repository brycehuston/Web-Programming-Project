<!DOCTYPE html>
<html lang="en" dir="ltr">

<!--- Name: Bryce Huston
      ID: 30003673
      Date: 19-09-2019
      Task: Final Project
--->

  <head>
    <meta charset="utf-8">
    <title>Top 10 Searches</title>
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
    <link rel="shortcut icon" type="image/png" href="img/favicon.png">
    <style type="text/css">
      table, td {
        border: 1px solid black;
        border-collapse: collapse;
        width: 100%;
        color: #d96459;
        font-family: monospace;
        font-size: 25px;
        text-align: Left;
      }
      th {
        background-color: #d96459;
        color: white;
      }
      tr:nth-child(even) {background-color: #f2f2f2}
    </style>
  </head>
  <body>
    <table>
      <tr>
        <th>Searches</th>
        <th>Title</th>
        <th>Studio</th>
        <th>Status</th>
        <th>Sound</th>
        <th>Versions</th>
        <th>RecRetPrice</th>
        <th>Rating</th>
        <th>Year</th>
        <th>Genre</th>
        <th>Aspect</th>
      </tr>
<?php
{
//Get connection script
require"connect.php";
$query = "SELECT * FROM `movies` ORDER BY `movies`.`searches` DESC";
// Prepare the sql statement to avoid injections
try {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    // Loop all values and display them
    for ($i = 0; $i < 10; $i++) {
        $row = $stmt->fetch();
        // Display all the data
        echo "<tr><td>" . $row["searches"] . "</td><td>" .
        $row["Title"] . "</td><td>" .
        $row["Studio"] . "</td><td>" .
        $row["Status"] . "</td><td>" .
        $row["Sound"] . "</td><td>" .
        $row["Versions"] . "</td><td>" .
        $row["RecRetPrice"] . "</td><td>" .
        $row["Rating"] . "</td><td>" .
        $row["Year"] . "</td><td>" .
        $row["Genre"] . "</td><td>" .
        $row["Aspect"] . "</td><td>";
    }
} catch (Exception $e) {
    echo "No results were found.";
}
        echo "</table>";
echo "<p><a href='index.html'>Go Back</a></p>";
}
?>
