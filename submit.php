<?php
	use Profiler\PersonalityFactory;
	require 'vendor/autoload.php';
	
	require_once("includes/header.php"); // TODO refactor
?>
<head>
		<link rel="stylesheet" type="text/css" href="static/css/style.css">
</head>
<body>
	<div class="container">
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
	</div>	
</body>