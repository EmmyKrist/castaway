<?


require 'database.php';

$requestedID = filter_var(htmlspecialchars($_GET["id"]), FILTER_SANITIZE_STRING);

$requestedList = filter_var(htmlspecialchars($_GET["list"]), FILTER_SANITIZE_STRING);

$sql = "SELECT * FROM $requestedList
WHERE name='$requestedID'
ORDER BY sequence";
$requestedOutput = $db->query($sql);
if (!$requestedOutput) die("List Error: " . $sql . "<br>" . $db->error);

$requestedJSON = "0";

if ($requestedOutput->num_rows > 0) {
$outputArray = [];
while( $row = $requestedOutput->fetch_assoc() ) {
$outputArray[] = $row;
}
$requestedJSON = json_encode($outputArray);
}

echo $requestedJSON;


