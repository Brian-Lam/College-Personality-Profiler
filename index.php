<?php
	use Profiler\Personality\PersonalityFactory;
	
	require_once("includes/header.php"); // TODO refactor
?>

<body>
	<div class="container">
		<form>
			<input type="text"></input>
			<input type="submit" value="Search">
		</form>
	<?php
		$school = "Washington University in St. Louis";
		$profile = PersonalityFactory::createProfileBySchoolName($school)
	?>
	</div>
</body>