
<!--- Name: Bryce Huston
      ID: 30003673
      Date: 19-09-2019
      Task: Final Project
--->

<?php
$host = "localhost";
$dbName = "web_project";
$dbUser = "root";
$dbPassword = "";
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbName;charset$charset";
$options = [
  PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE=> PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES=> false,
];
try {
    $pdo = new PDO($dsn, $dbUser, $dbPassword, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
