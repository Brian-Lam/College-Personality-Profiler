<?php
	use Profiler\Personality\PersonalityFactory;
	require 'vendor/autoload.php';

	$school =  $_GET["school"];
	$personality = PersonalityFactory::createProfileBySchoolName($school);	
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="static/css/style.css">
	<script>

	var schoolInfo = new Array();
	schoolInfo["longitude"] = <?php echo $personality->getLongitude() ?>;
	schoolInfo["latitude"] = <?php echo $personality->getLatitude() ?>;

	schoolInfo["percentMale"] = <?php echo $personality->getPercentMale() ?>;

	schoolInfo["ethnicities"] = <?php
		echo "new Array();\n";
		$ethnicities = $personality->getEthnicities();
		echo "\tschoolInfo[\"sat\"][\"white\"] = ".$ethnicities[0].";\n";
		echo "\tschoolInfo[\"sat\"][\"black\"] = ".$ethnicities[1].";\n";
		echo "\tschoolInfo[\"sat\"][\"hispanic\"] = ".$ethnicities[2].";\n";
		echo "\tschoolInfo[\"sat\"][\"asian\"] = ".$ethnicities[3].";\n";
		echo "\tschoolInfo[\"sat\"][\"pacific islander\"] = ".$ethnicities[4].";\n";
		echo "\tschoolInfo[\"sat\"][\"other\"] = ".$ethnicities[5].";\n";
	?>

	schoolInfo["residency"] = <?php
		echo "new Array();\n";
		$res = $personality->getResidency();
		echo "\tschoolInfo[\"sat\"][\"inState\"] = ".$res[0].";\n";
		echo "\tschoolInfo[\"sat\"][\"outState\"] = ".$res[1].";\n";
		echo "\tschoolInfo[\"sat\"][\"foreign\"] = ".$res[2].";\n";
	?>

	schoolInfo["diversity"] = <?php echo $personality->getDiversity() ?>;

	schoolInfo["undergrads"] = <?php echo $personality->getUndergrads() ?>;

	schoolInfo["act"] = <?php echo $personality->getACT() ?>;

	schoolInfo["sat"] = <?php
		echo "new Array();\n";
		$sat = $personality->getSAT();
		echo "\tschoolInfo[\"sat\"][\"reading\"] = ".$sat[0].";\n";
		echo "\tschoolInfo[\"sat\"][\"math\"] = ".$sat[1].";\n";
		echo "\tschoolInfo[\"sat\"][\"writing\"] = ".$sat[2].";\n";
	?>

	
	
	</script>
</head>
<body class="submit">
	<div class="container">
		<header>
			<h1>College Personality Profiler</h1>
			<h2>We figure out what it's like to go to college so you don't have to. Yet.</h2>

			<form class="search" action="submit.php">
				<span>
					<input class="collegename" 
						type="text" 
						placeholder="What college should I generate a personality for?"
						name="school"
						list="schools"
						value="<?php echo $school; ?>" />
				</span>
				<input class="collegename-submit" type="submit" value="Search">

				<datalist id="schools">
					<option value="Washington University in St. Louis" />
					<option value="Harvard University" />
					<!-- TODO add all universities -->
				</datalist>
			</form>

			<h1 class="college"><?php echo $_GET["school"]; ?></h1>
		</header>

		<section>
			<blockquote>
				<strong>Hi!</strong> I go to <strong>WashU</strong>, but you might know it is as <strong>Washington University in St. Louis</strong>.
			</blockquote>

			[Map Embed]

			<img width="250" height="250" class="instagrampreview" src="<?php echo $personality->getInstagramUrl(); ?>">
			<img width="250" height="250" class="instagrampreview" src="<?php echo $personality->getInstagramUrl(); ?>">
			<img width="250" height="250" class="instagrampreview" src="<?php echo $personality->getInstagramUrl(); ?>">
		</section>

		<section>
			<h2>Location</h2>

			<blockquote>
				Wear snow boots!
			</blockquote>

			It's in the midwest - in <strong>St. Louis, Missouri</strong>, to be precise - so (of course) the weather is absolutely terrible. 
			It rains a ton. It snows a ton. And it gets really hot in the summer.
		</section>



		<h1>OLD DELETE FROM HERE ON</h1>
		<div class="upperPictureBlock">
			<h2 class="collegeNameHeader"><?php 
				echo $_GET["school"];
			?></h2><hr>
			<h1 class="title"> College Personality Profiler </h1>
				<!--college search bar in center of page-->
				<div style="margin: 0 auto" align=center> 
					<form action="submit.php">
						<input class="collegename" type="text" placeholder="What college should I generate a personality for?" name="school" list="schools" value=
						<input class="collegename-submit" type="submit" value="Search">

						<datalist id="schools">
							<option value="Washington University in St. Louis" />
							<option value="Harvard University" />
						</datalist>
					</form>
				</div>
		</div>
		<div class="lowerBlock">
			<p class="triangle-border left"> 
				Hi there I'm from WashU and I'm a Unicorn.
			</p>
			<p class="collegeDescription"> 
				Oh hey there. I'm a student from WashU ;). I'm super smart, I sing in an acapella group, and I've been hacking for 40 hours at WUHack. My blood basically consists of caffeine right now. <br> <br>
			</p>
			<h2 class="location"> Location: St. Louis</h2> <hr>
			<p class="triangle-border left"> 
				hello there...
			</p>
		</div>

		<p>The typical student who goes to <?php echo $schoolname ?> will be living near the following coordinates:</p>
		Latitude: <?php echo $personality->getLatitude(); ?> <br>
		Longitude <?php echo $personality->getLongitude(); ?> <br>
		<p>Here's a photo of what's happening around campus: </p>
		<p></p>
	</div>	
</body>
</html>