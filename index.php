<?php
	use Profiler\Personality\PersonalityFactory;
	<?php require 'vendor/autoload.php'; ?>
?>
<head>
		<link rel="stylesheet" type="text/css" href="static/css/style.css">
</head>
	<h1 class="title"> College Personality Profiler</h1>
<body>
	<div class="container">

		<?php
			$school = (@$_GET['school']) ? $_GET['school'] : "";
		?>
		<!--college search bar in center of page-->
		<form action="submit.php">
			<input class="collegename" type="text" placeholder="What college should I generate a personality for?" name="school" list="schools" value="<?php echo $school; ?>" />
			<input class="collegename-submit" type="submit" value="Search">

			<datalist id="schools">
				<option value="Washington University in St. Louis" />
				<option value="Harvard University" />
			</datalist>
		</form>

		<?php 
			$profile = PersonalityFactory::createProfileBySchoolName($school);
		?>
	


</body>