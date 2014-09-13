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

<?php
		include("twitteroauth-master/connect.php");
		include("twitteroauth-master/twitteroauth/twitteroauth.php");
		function getConnectionWithAccessToken($oauth_token, $oauth_token_secret) {
		  $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
		  return $connection;
		}
		 
		$connection = getConnectionWithAccessToken("53207076-VqragtGcaPWoldCNrfbnwwWG4dUnP0BbeKcW4xt8m", "OdeBMzodirvxoDrgkKJxNvkEBeB87TUCkamvMpqyULsgq");
		$content = $connection->get("https://api.twitter.com/1.1/geo/search.json?accuracy=3000&lat=38.6480&long=-90.3050");

		print_r($content);
	?>
	</div>
</body>