<?php
	use Profiler\Personality\PersonalityFactory;

	require_once("includes/header.php"); // TODO refactor

	$schoolname =  $_GET["school"];
	$personality = PersonalityFactory::createProfileBySchoolName($schoolname);
?>

<body>
	<div class="container">
		<p>The typical student who goes to <?php echo $schoolname ?> will be living near the following coordinates:</p>
		Latitude: <?php echo $personality->getLatitude(); ?> <br>
		Longitude <?php echo $personality->getLongitude(); ?> <br>
		<p>Here's a photo of what's happening around campus: </p>
		<p><img class="instagrampreview" src="<?php echo $personality->getInstagramUrl(); ?>"></p>
	</div>

	
</body>
