<?

// This file opens a MySQL connection to the database you created in cPanel

// define database values
$databaseServer = "64.225.102.54"; // My IP number from my own cPanel.
$databaseName = "ekristco_castaway"; // The database name given to me by the cPanel Wizard.

$databaseUser = "ekristco_castawayadmin";

$databasePassword = "FQMqN15)]K7G";  // A randomly generated password.
$databaseTable = "";  // main table name

/*
Available columns in each of the 3 tables:
- id: integer, auto-incremented unique identifier
- name: varchar, name of the recipe
- sequence: integer, step in the process
- content: varchar, contents of this text
- timestamp: timestamp, auto-updated value
*/

// attempt DB connection and die() if it fails
$db = new mysqli($databaseServer, $databaseUser, $databasePassword, $databaseName);
if ($db->connect_error) die("Database connection failed: " . $db->connect_error);

/*

Now you can set strings of SQL and submit them like this:

$sql = "SELECT * FROM $databaseTable"; 
$result = $db->query($sql);
if (!$result) die("Error: " . $sql . "<br>" . $db->error);

*/