<?php
require '../database/database.php';

$pdo = Database::connect();
$sql = 'SELECT * FROM mc_schools ORDER BY school_name ASC';
echo "<select class='form-control' name='school' id='school_id'>";
foreach ($pdo->query($sql) as $row) {
	echo "<option style='background-color: yellow; color: red;' value='" . $row['id'] . " '> " . $row['school_name'] . "</option>";
}
echo "</select>";

Database::disconnect();
?>