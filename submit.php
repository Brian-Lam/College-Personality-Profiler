<?php
	use Profiler\Personality\PersonalityFactory;
	
	require_once("includes/header.php"); // TODO refactor

	$schoolname =  $_GET["school"];
	$personality = PersonalityFactory::createProfileBySchoolName($schoolname);
?>
