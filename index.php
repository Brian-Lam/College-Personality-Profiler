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
		<div class="upperEmptyPictureBlock">
			<h1 class="title" style="font-size:40px"> College Personality Profiler <br> <h4 style="text-align:center">Get an insight into the life of an average college student...</h4></h1> 
			<div style="margin: 0 auto" align=center> 
				<!--college search bar in center of page-->
				<form action="submit.php">
					<input class="collegename" type="text" placeholder="What college should I generate a personality for?" name="school" list="schools" value="<?php echo $school; ?>" />
					<input class="collegename-submit" type="submit" value="Search">

					<datalist id="schools">
						<option value="Washington University in St. Louis" />
						<option value="Harvard University" />
					</datalist>
				</form>
			</div>
		</div>
		<div class="lowerBlock">
		</div>
	</div>
</body>