<?php
	use Profiler\Personality\PersonalityFactory;
	require 'vendor/autoload.php';

	$school = (@$_GET['school']) ? $_GET['school'] : "";
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="static/css/style.css">
	<title>College Personality Profiler</title>
</head>

<body class="index">
	<div class="container">
		<header>
			<h1>College Personality Profiler</h1>
			<h2>We figure out what it's like to go to college so you don't have to. Yet.</h2>

			<form class="search" action="submit.php">
				<input class="collegename" 
					type="text" 
					placeholder="What college should I generate a personality for?"
					name="school"
					list="schools"
					value="<?php echo $school; ?>" />
				<input class="collegename-submit" type="submit" value="Search">

				<datalist id="schools">
					<option value="Washington University in St. Louis" />
					<option value="Harvard University" />
					<option value="Emory University"/>
					<option value="Massachusetts Institute of Technology"/>
					<option value="Northwestern University"/>
					<option value="University of Chicago"/>
					<option value="University of Georgia"/>
					<option value="University of Washington"/>
				</datalist>
			</form>
		</header>
	</div>
</body>
</html>