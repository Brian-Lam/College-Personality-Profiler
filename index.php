<?php
	use Profiler\Personality\PersonalityFactory;

	require_once("includes/header.php"); // TODO refactor
?>

<body>		
	<div class="container">

		<?php
			$school = (@$_GET['school']) ? $_GET['school'] : "";
		?>
	
	<div class="text-intro">
			The College Personality Profiler aggregates public information posted within school communities and analyzes them to determine what the average student there would be like. 
	</div>
		<form action="submit.php">
			<div class="formwrap">
				<input class="collegename" type="text" placeholder="What college should I generate a personality for?" name="school" list="schools" value="<?php echo $school; ?>" />
				<input class="collegename-submit" type="submit" value="Search">
			</div>

			<datalist id="schools">
				<option value="Washington University in St. Louis" />
				<option value="Harvard University" />
				<option value="University of Illinois - Urbana Champagne" />
				<option value="Yale University" />
			</datalist>
		</form>
	</div>

<?php
	$command = escapeshellcmd('python src/Profiler/YikYak/example.py');
	$output = shell_exec($command);
	echo $output;
?>

</body>