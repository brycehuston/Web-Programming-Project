<!DOCTYPE html>
<html lang="en" dir="ltr">

<!--- Name: Bryce Huston
      ID: 30003673
      Date: 19-09-2019
      Task: Final Project
--->

  <head>
    <meta charset="utf-8">
    <title>Results</title>
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
// Sam Berg - 30000316 - 17/09/2019
//get all of the form data
$title = $_POST['title'];
$genre = $_POST['genre'];
$rating = $_POST['rating'];
$year = $_POST['year'];

// Setup the string ready for concatenation
$query = "SELECT * FROM `movies` WHERE";

// If the title exists, add the result to the query
if (empty($title)) {

} else {
    $query .= ' Title ="' . $title . '" AND';
}

// If the genre exists
if (empty($genre)) {

} else {
    // If the genre follows the regex convention
    if (!preg_match("#^[a-zA-Z-/]*$#", $genre)) {
        echo "Only letters, slashes and dashes can be used for
        ratings. <p><a href='index.html'>Go Back</a></p>";
        return;
    }
    $query .= ' Genre ="' . $genre . '" AND';
}

// If the rating exists
if (empty($rating)) {

} else {
    // If the rating follows the regex convention
    if (!preg_match("#^[a-zA-Z0-9-]*$#", $rating)) {
        echo "Only letters, numbers and dashes can be used for
        ratings. <p><a href='index.html'>Go Back</a></p>";
        return;
    }
    $query .= ' Rating ="' . $rating . '" AND';
}

// If the year exists
if (empty($year)) {

} else {
    // If the name follows the regex convention
    if (!preg_match("#^[0-9]*$#", $year)) {
        echo "Only numbers can be used for release
        years. <p><a href='index.html'>Go Back</a></p>";
        return;
    }
    $query .= ' Year ="' . $year . '" AND';
}

// Stops the query having a comma at the end
// If no comma was found that means no data was given
if (substr($query, -1) == "D") {
    $query = substr_replace($query, "", -1);
	$query = substr_replace($query, "", -1);
	$query = substr_replace($query, ";", -1);
} else {
    echo "No data was
    input. <p><a href='index.html'>Go Back</a></p>";
    return;
}

// Debugging the statement
//echo $query."<br />\n";

//Get connection script
require"connect.php";
// Prepare the sql statement to avoid injections
try {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    // Setup the searches SQL
    $searchquery = 'UPDATE `movies` SET searches = searches + 1 WHERE ID = :id;';
    $stmtt = $pdo->prepare($searchquery);
    // Loop all values and display them
    while ($row = $stmt->fetch()) {
        // Display all the data
        echo "<tr><td>" . $row["Title"] . "</td><td>" .
        $row["Studio"] . "</td><td>" .
        $row["Status"] . "</td><td>" .
        $row["Sound"] . "</td><td>" .
        $row["Versions"] . "</td><td>" .
        $row["RecRetPrice"] . "</td><td>" .
        $row["Rating"] . "</td><td>" .
        $row["Year"] . "</td><td>" .
        $row["Genre"] . "</td><td>" .
        $row["Aspect"] . "</td><td>";
        // Add 1 to the search field
        $stmtt->bindValue(':id', $row['ID']);
        $stmtt->execute();
    }
} catch (Exception $e) {
    echo "No results were found.";
}
        echo "</table>";
echo "<p><a href='index.html'>Go Back</a></p>";
}
?>
