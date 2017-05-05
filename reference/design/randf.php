<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - randf</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>randf</h3>
<i>1/f pseudo-random number generator?</i>
<br>
<br>
This looks like it's trying to make some kind of 1/f noise (or equivalent
random-wolk thing), but I'll be blamed if I can say fer sure.
<p>
If I were you, I'd use the
<a href="Orand.php">Orand</a>
object instead.
<p>
From the source code:
<hr>
float randf(float *oldval, float factor)

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
