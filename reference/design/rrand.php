<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - rrand/srrand</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>rrand/srrand</h3>
<i>pseudo-random number generator</i>
<br>
<br>
<ul>
<i>[note:  These older random number generators have been superceded
by the
<a href="Orand.php">Orand</a>
object.]</i>
</ul>

<h3>Synopsis</h3>
<UL>
     #include &lt;ugens.h&gt;<BR>
<BR>
     srrand(x)<BR>
     unsigned x;<BR>
<BR>

     float rrand();<BR>
<BR>
</UL>
<h3>Description</h3>

     <B>rrand() </B>is a modification of the unix rand generator which
     will return a floating point value between -1 and +1.  It is
     seeded with<B> srrand(x)</B> where x is any value range 0 to 1.


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
