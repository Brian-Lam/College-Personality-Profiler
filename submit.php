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
		echo "\tschoolInfo[\"ethnicities\"][\"white\"] = ".$ethnicities[0].";\n";
		echo "\tschoolInfo[\"ethnicities\"][\"black\"] = ".$ethnicities[1].";\n";
		echo "\tschoolInfo[\"ethnicities\"][\"hispanic\"] = ".$ethnicities[2].";\n";
		echo "\tschoolInfo[\"ethnicities\"][\"asian\"] = ".$ethnicities[3].";\n";
		echo "\tschoolInfo[\"ethnicities\"][\"pacific islander\"] = ".$ethnicities[4].";\n";
		echo "\tschoolInfo[\"ethnicities\"][\"other\"] = ".$ethnicities[5].";\n";
	?>

	schoolInfo["residency"] = <?php
		echo "new Array();\n";
		$res = $personality->getResidency();
		echo "\tschoolInfo[\"residency\"][\"inState\"] = ".$res[0].";\n";
		echo "\tschoolInfo[\"residency\"][\"outState\"] = ".$res[1].";\n";
		echo "\tschoolInfo[\"residency\"][\"foreign\"] = ".$res[2].";\n";
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

	window.onload = function() {
		var intro = document.getElementById("introQuote");
		var weather = document.getElementById("weatherQuote");

		var greetings = ["Hey!, I go to ", "Hi!  I'm a student at ", "Yo dawg!  I attend "];

		// intro.innerHTML = greetings[Math.floor(Math.random() * greetings.length)];
		// weather.innerHTML = "c";
	}
	
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
					<option value="Emory University"/>
					<option value="Massachusetts Institute of Technology"/>
					<option value="Northwestern University"/>
					<option value="University of Chicago"/>
					<option value="University of Georgia"/>
					<option value="University of Washington"/>
				</datalist>
			</form>

			<h1 class="college"><?php echo $_GET["school"]; ?></h1>
		</header>

		<section>
			<blockquote id="introQuote">
				<p class="triangle-border left"> 
					<strong>Hi!</strong> I go to <strong>WashU</strong>, but you might know it is as <strong>Washington University in St. Louis</strong>.
				</p>
			</blockquote>
			<p class="map">
				[Map Embed]
			</p>
			<p class="picture">
				<img width="250" height="250" class="instagrampreview" src="<?php echo $personality->getInstagramUrl(); ?>">
			</p>
		</section>

		<section>
			<h2 class="location">Location</h2>

			<blockquote id="weatherQuote">
				<p class="triangle-border left"> 
					Wear snow boots!
				</p>
			</blockquote>

			It's in the midwest - in <strong>St. Louis, Missouri</strong>, to be precise - so (of course) the weather is absolutely terrible. 
			It rains a ton. It snows a ton. And it gets really hot in the summer.
		</section>

		<p>The typical student who goes to <?php echo $schoolname ?> will be living near the following coordinates:</p>
		Latitude: <?php echo $personality->getLatitude(); ?> <br>
		Longitude <?php echo $personality->getLongitude(); ?> <br>
		<p>Here's a photo of what's happening around campus: </p>
		<p></p>
	</div>	
</body>
</html>