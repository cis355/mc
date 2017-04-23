<?php 
define("PRO",1);
define("CON",2);
define("NOT-SET",0);
include '../database/database.php';

// ------------------------------------------------
// create an array of teams
// ------------------------------------------------
$pdo = Database::connect();
$sql = "SELECT * FROM mc_teams";
$teams = array();
$teamcount = 0;
foreach ($pdo->query($sql) as $row) {
	$t = array($row['id'], 
		$row['team_name'],
		$row['team_school'],
		$row['classroom1'],
		$row['side1'],
		$row['competitor1'],
		$row['classroom2'],
		$row['side2'],
		$row['competitor2'],
		$row['classroom3'],
		$row['side3'],
		$row['competitor3'],
	); 
	array_push($teams, $t);
	$teamcount++;
}
Database::disconnect();

// ------------------------------------------------
// update database with zeroes
// ------------------------------------------------

$pdo = Database::connect();

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

for($i=0; $i < $teamcount; $i++) {
	$sql = "UPDATE mc_teams set classroom1 = ?, side1 = ?, competitor1 = ?, classroom2 = ?, side2 = ?, competitor2 = ?, classroom3 = ?, side3 = ?, competitor3 = ? WHERE id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array(0,0,0,0,0,0,0,0,0,$teams[$i][0]));
}
Database::disconnect();
header("Location: mc_teams.php");
?>