<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - midipch</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>midipch</h3>
<i>convert frequency (Hz) to midi note #</i>
<br>
<br>
It apparently does convert frequency (Hz) to a midi note number.
<hr>
<ul>
#include "ugens.h"
<p>
float freq;
float midinote
<p>
midinote = midipch(freq);
</ul>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
