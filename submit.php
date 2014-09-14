<?php
	use Profiler\Personality\PersonalityFactory;
	require 'vendor/autoload.php';

	$school =  $_GET["school"];
	$personality = PersonalityFactory::createProfileBySchoolName($school);	
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="static/css/style.css">
</head>
<body class="submit">
	<!-- TODO autoget FB cover -->
	<header style="background-image: url(<?php echo $personality->getCoverPhotoUrl(); ?>);">
		<div class="container">
			<h1>College Personality Profiler</h1>
			<h2>Because you don't go to college. Yet.</h2>

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
					<option value="Massachusettes Institute of Technology"/>
					<option value="Northwestern University"/>
					<option value="University of Chicago"/>
					<option value="University of Georgia"/>
					<option value="University of Washington"/>
				</datalist>
			</form>

			<h1 class="college"><?php echo $_GET["school"]; ?></h1>
		</div>
	</header>

	<section>
		<div class="container">
			<blockquote>
			<!-- TODO autoget school nickname -->
				<strong>Hi!</strong> I go to <strong><?php echo $school ?></strong>, but you might know it is as <strong><?php echo $personality->getNickname(); ?></strong>.
			</blockquote>

			<img width="250" height="250" class="instagrampreview" src="<?php echo $personality->getInstagramUrl(); ?>">
		</div>
	</section>

	<section>
		<div class="container">
			<h2>Location</h2>

			<p><!-- TODO autoget location --><!-- TODO generate weather copy -->
				It's in <strong><?php echo $personality->getAddress(); ?></strong>. 
				It rains <?php echo $personality->rainQuantifier(); ?>. It snows <?php echo $personality->rainQuantifier(); ?>. And it gets really hot in the summer. We have a <?php echo $personality->getTempFluctuation(); ?> degree fluctuation in the average temperature between summer and winter!
			</p>

			<blockquote>
				<?php echo $personality->snowPhrase(); ?>
			</blockquote>
		</div>
	</section>

	<section>
		<div class="container">
			<h2 id="sizeanddiversity">Size and Diversity</h2>

			<blockquote>
			<p><?php echo $personality->diversityPhrase(); ?></p>
			</blockquote>

			<p>I had a great freshman year, although one or two of my friends left. Speaking of friends, <strong>most of my friends are <?php echo $personality->mostFriends(); ?></strong>, but I know several Asian people and a couple black people.</p>

			<p>Nevertheless, we are a really queer-friendly school—we&#8217;re all very accepting.</p>

			<p>There are about <?php echo intval($personality->getUndergrads() / 4) ?> students in my grade, so I see the same faces around a lot, but I don&#8217;t know everyone. About half the people I see every day are men, half women.</p>

			<p>Most of the people I know are from out of state.<?php
				$r = $personality->getForeign();
				// echo $personality->getForeign();
				// echo "\n";
				// echo $personality->getUndergrads();
				if($r > 5) {
					$r = round(100 / $r);
					echo " About 1 in " . $r . "of my friends is from outside the US, too.";
				}
			?></p>

			<!-- <p>I might have seen {your FB friends who attend this school} around campus.</p> -->

			<p>About a third of my friends get scholarship money, which is helpful because it costs about <strong>$40,000 a year</strong> to go here otherwise. Everyone who needed financial aid got it, though.</p>
		</div>
	</section>

	<section>
		<div class="container">
			<h2 id="academics">Academics</h2>

			<blockquote>
			<p>Wash U students are <em>really</em> smart.</p>
			</blockquote>

			<p>I got a <strong><?php echo $personality->getACT(); ?></strong> on my ACT and a <strong><?php echo $personality->getSAT()[0] + $personality->getSAT()[1] + $personality->getSAT()[2]; ?></strong> my SAT.</p>

			<p>I don&#8217;t know anyone who graduated in the bottom half of their class, and <strong>most of my friends were in the top 10%</strong>.</p>

			<p>We have very few &#8220;standard&#8221; classes that everyone takes, but a lot of people are majoring in the social sciences, engineering, and business.</p>
		</div>
	</section>

	<section>
		<div class="container">
			<h2 id="extracurriculars">Extracurriculars</h2>

			<p>Greek life&#8217;s not that big here. About <strong>1 in <?php echo intval(1 / $personality->getFrat()); ?> of my male friends joined fraternities</strong>, and <strong>1 in <?php echo intval(1 / $personality->getSoro()); ?> of my female friends joined sororities</strong>.</p>

			<p>Very few people care about sports, even though our women&#8217;s soccer team, men&#8217;s basketball team, and women&#8217;s basketball team are the best D3 teams in the Midwest.</p>

			<p>In fact, so few people attend our games, we don&#8217;t even have some attendances recorded!</p>

			<blockquote>
			<p>You might be surprised that we don&#8217;t have a yearbook.</p>
			</blockquote>
		</div>
	</section>

	<section>
		<div class="container">
			<h2 id="campuslife">Campus Life</h2>

			<blockquote>
			<p>People here cuss like ducking sailors.</p>
			</blockquote>

			<p>We&#8217;re generally happy here, and pretty upbeat.</p>

			<p>The student health center here provides free condoms and pregnancy testing, as well as free STI screening.</p>
		</div>
	</section>

	<script>

	var schoolInfo = new Array();
	schoolInfo["name"] = <?php echo "\"".$_GET["school"]."\""; ?>;
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

		var greetings = ["Hey!  I go to ", "Hi!  I'm a student at ", "Hello!  I attend ", "What's up? I go to "];
		intro.innerHTML = greetings[Math.floor(Math.random() * greetings.length)] + schoolInfo["name"];
	}
	
	</script>
</body>
</html>
