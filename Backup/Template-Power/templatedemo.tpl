<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Template Demo</title>
	<style>
		#groen{
			background-color: green;
		}
		#rood{
			background-color: red;
		}
	</style>
</head>
<body>
	<h1>So long, {NAAM}!</h1>

	<!-- START BLOCK : baas -->
	<div id="groen">
		<p>Hallo {NAAM}, jij bent echt een eindbaas!</p>
	</div>
	<!-- END BLOCK : baas -->

	<!-- START BLOCK : geenbaas -->
	<div id="groen">
		<p>Jammer joh {NAAM}, jij bent geeneens een baas >:')</p>
	</div>
	<!-- END BLOCK : geenbaas -->

</body>
</html>