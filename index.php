<?php
	use Profiler\Personality\PersonalityFactory;
	
	require_once("includes/header.php"); // TODO refactor
?>

<body>
	<div class="container">
		<?php
			$school = (@$_GET['school']) ? $_GET['school'] : "N/A";
		?>
		<form>
			<input type="text" name="school" list="schools" value="<?php echo $school; ?>"/>
			<input type="submit" value="Search">

			<datalist id="schools">
				<option value="Washington University in St. Louis" />
				<option value="Harvard University" />
			</datalist>
		</form>

		<?php 
			$profile = PersonalityFactory::createProfileBySchoolName($school);
		?>
	</div>
</body>