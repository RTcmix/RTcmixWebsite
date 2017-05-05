<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - pchmidi</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>pchmidi</h3>
<i>convert midi note # to frequency (Hz)</i>
<br>
<br>
It apparently does convert a midi note number (from a byte) to frequency (Hz).
<hr>
<ul>
#include "ugens.h"
<p>
float freq;
unsigned char midinote
<p>
freq = pchmidi(midinote);
</ul>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
