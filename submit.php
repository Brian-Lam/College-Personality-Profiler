<?php
	use Profiler\PersonalityFactory;
	require 'vendor/autoload.php';
	
	require_once("includes/header.php"); // TODO refactor
?>
<head>
		<link rel="stylesheet" type="text/css" href="static/css/style.css">
</head>

	<h1 class="title"> College Personality Profiler</h1>

<?php
	$schoolname =  $_GET["school"];
	echo $schoolname;
?>
