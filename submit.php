<?php
	use Profiler\PersonalityFactory;
	require_once("includes/header.php"); // TODO refactor

	$schoolname =  $_GET["school"];
	echo $schoolname;

	$query = "https://maps.googleapis.com/maps/api/geocode/json?address=" . $schoolname;
?>
