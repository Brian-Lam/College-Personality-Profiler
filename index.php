<?php
	use Profiler\Personality\PersonalityFactory;

	require_once("includes/header.php"); // TODO refactor
?>

<body>
	<div class="container">

		<?php
			$school = (@$_GET['school']) ? $_GET['school'] : "";
		?>

		<form action="submit.php">
			<input class="collegename" type="text" placeholder="What college should I generate a personality for?" name="school" list="schools" value="<?php echo $school; ?>" />
			<input class="collegename-submit" type="submit" value="Search">

			<datalist id="schools">
				<option value="Washington University in St. Louis" />
				<option value="Harvard University" />
				<option value="University of Illinois - Urbana Champagne" />
				<option value="Yale University" />
			</datalist>
		</form>

	</div>
</body>