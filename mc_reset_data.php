<?php 
include '../database/database.php';

// ------------------------------------------------
// delete all teams and schools
// ------------------------------------------------

$deleteAll = 1; // "1" means delete all

// connect
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// delete teams
$sql = "DELETE FROM mc_teams  WHERE ?";
$q = $pdo->prepare($sql);
$q->execute(array($deleteAll));

// delete schools
$sql = "DELETE FROM mc_schools  WHERE ?";
$q = $pdo->prepare($sql);
$q->execute(array($deleteAll));

// disconnect
Database::disconnect();

	
// ------------------------------------------------
// insert baseline records 
// ------------------------------------------------

// connect
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// insert 8 schools
$school_name = "Atlanta Alternative HS";
$sql = "INSERT INTO mc_schools (school_name) values(?)";
$q = $pdo->prepare($sql);
$q->execute(array($school_name));
$school_name = "Boston Business HS";
$sql = "INSERT INTO mc_schools (school_name) values(?)";
$q = $pdo->prepare($sql);
$q->execute(array($school_name));
$school_name = "Chicago Creative HS";
$sql = "INSERT INTO mc_schools (school_name) values(?)";
$q = $pdo->prepare($sql);
$q->execute(array($school_name));
$school_name = "Detroit Dynamic HS";
$sql = "INSERT INTO mc_schools (school_name) values(?)";
$q = $pdo->prepare($sql);
$q->execute(array($school_name));
$school_name = "Evansville Eastern HS";
$sql = "INSERT INTO mc_schools (school_name) values(?)";
$q = $pdo->prepare($sql);
$q->execute(array($school_name));
$school_name = "Fairmont First HS";
$sql = "INSERT INTO mc_schools (school_name) values(?)";
$q = $pdo->prepare($sql);
$q->execute(array($school_name));
$school_name = "Galveston Grand HS";
$sql = "INSERT INTO mc_schools (school_name) values(?)";
$q = $pdo->prepare($sql);
$q->execute(array($school_name));
$school_name = "Harrisburg Home HS";
$sql = "INSERT INTO mc_schools (school_name) values(?)";
$q = $pdo->prepare($sql);
$q->execute(array($school_name));

// put team id numbers into an array
$schools = array();
$schoolcount = 0;
$sql = "SELECT * FROM mc_schools"; 
foreach ($pdo->query($sql) as $row) {
	$t = array($row['id'], 
		$row['school_name']
	);
	array_push($schools, $t);
	$schoolcount++;
}

// insert 16 teams
$team_number = 1;
$index = 0;
// insert 4 teams
$team = "Able Attorneys";
$school = $schools[$index++][0];
$sql = "INSERT INTO mc_teams (team_name,team_school,team_number) values(?, ?, ?)";
$q = $pdo->prepare($sql);
$q->execute(array($team,$school,$team_number++));
$team = "Brilliant Barristers";
$school = $schools[$index++][0];
$sql = "INSERT INTO mc_teams (team_name,team_school,team_number) values(?, ?, ?)";
$q = $pdo->prepare($sql);
$q->execute(array($team,$school,$team_number++));
$team = "Creative Counselors";
$school = $schools[$index++][0];
$sql = "INSERT INTO mc_teams (team_name,team_school,team_number) values(?, ?, ?)";
$q = $pdo->prepare($sql);
$q->execute(array($team,$school,$team_number++));
$team = "Determined Defenders";
$school = $schools[$index++][0];
$sql = "INSERT INTO mc_teams (team_name,team_school,team_number) values(?, ?, ?)";
$q = $pdo->prepare($sql);
$q->execute(array($team,$school,$team_number++));

// insert 4 more teams, all same school as team7
$team = "Effective Esquires";
$school = $schools[$index++][0];
$sql = "INSERT INTO mc_teams (team_name,team_school,team_number) values(?, ?, ?)";
$q = $pdo->prepare($sql);
$q->execute(array($team,$school,$team_number++));
$team = "Feud Fixers";
$school = $schools[$index++][0];
$sql = "INSERT INTO mc_teams (team_name,team_school,team_number) values(?, ?, ?)";
$q = $pdo->prepare($sql);
$q->execute(array($team,$school,$team_number++));
$team = "Gifted Gabbers";
$school = $schools[$index++][0];
$sql = "INSERT INTO mc_teams (team_name,team_school,team_number) values(?, ?, ?)";
$q = $pdo->prepare($sql);
$q->execute(array($team,$school,$team_number++));
$team = "Honorable Haranguers";
$school = $schools[$index][0];
$sql = "INSERT INTO mc_teams (team_name,team_school,team_number) values(?, ?, ?)";
$q = $pdo->prepare($sql);
$q->execute(array($team,$school,$team_number++));

// insert 4 more teams from first 4 schools
$index = 0;
$team = "Inventive Impresarios";
$school = $schools[$index++][0];
$sql = "INSERT INTO mc_teams (team_name,team_school,team_number) values(?, ?, ?)";
$q = $pdo->prepare($sql);
$q->execute(array($team,$school,$team_number++));
$team = "Jubilant Jurists";
$school = $schools[$index++][0];
$sql = "INSERT INTO mc_teams (team_name,team_school,team_number) values(?, ?, ?)";
$q = $pdo->prepare($sql);
$q->execute(array($team,$school,$team_number++));
$team = "Knowledgeable Kibitzers";
$school = $schools[$index++][0];
$sql = "INSERT INTO mc_teams (team_name,team_school,team_number) values(?, ?, ?)";
$q = $pdo->prepare($sql);
$q->execute(array($team,$school,$team_number++));
$team = "Lucky Lawyers";
$school = $schools[$index++][0];
$sql = "INSERT INTO mc_teams (team_name,team_school,team_number) values(?, ?, ?)";
$q = $pdo->prepare($sql);
$q->execute(array($team,$school,$team_number++));

// insert 4 more teams from last 4 schools
$team = "Moderate Musers";
$school = $schools[$index++][0];
$sql = "INSERT INTO mc_teams (team_name,team_school,team_number) values(?, ?, ?)";
$q = $pdo->prepare($sql);
$q->execute(array($team,$school,$team_number++));
$team = "Nonchalant Negotiators";
$school = $schools[$index++][0];
$sql = "INSERT INTO mc_teams (team_name,team_school,team_number) values(?, ?, ?)";
$q = $pdo->prepare($sql);
$q->execute(array($team,$school,$team_number++));
$team = "Onerous Orators";
$school = $schools[$index++][0];
$sql = "INSERT INTO mc_teams (team_name,team_school,team_number) values(?, ?, ?)";
$q = $pdo->prepare($sql);
$q->execute(array($team,$school,$team_number++));
$team = "Professional Practitioners";
$school = $schools[$index++][0];
$sql = "INSERT INTO mc_teams (team_name,team_school,team_number) values(?, ?, ?)";
$q = $pdo->prepare($sql);
$q->execute(array($team,$school,$team_number++));

// disconnect
Database::disconnect();

// ------------------------------------------------
// return to teams menu list
// ------------------------------------------------
header("Location: mc_teams.php");
?>