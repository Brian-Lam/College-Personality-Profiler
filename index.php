<?php require_once("header.php")
?>

<body>
	<div class="container">
		<form>
			<input type="text"></input>
			<input type="submit" value="Search">
		</form>
	<?php
		$xml = file_get_contents("https://graph.facebook.com/search?q=query&type=user");
		//$xml = file_get_contents("http://google.com");
		echo $xml;
	?>
	</div>
</body>