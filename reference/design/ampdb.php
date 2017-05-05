<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - ampdb/dbamp/cpsoct/cpspch/octcps/octpch/pchcps/pchoct/boost</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>ampdb/dbamp/cpsoct/cpspch/octcps/octpch/pchcps/pchoct/boost</h3>
<i>convert various formats of notation and amplitude</i>
<br>

<h3>Synopsis</h3>
<UL>
     #include "ugens.h"<BR>
<BR>
	float frequency, octpc, linoct, amp, decibel;
<br>
     frequency = cpsoct(linoct);<BR><BR>

     frequency = cpspch(octpch);<BR><BR>

     linoct = octcps(frequency);<BR><BR>

     linoct = octpch(frequency);<BR><BR>

     octpc = pchcps(frequency);<BR><BR>

     frequency = pchoct(linoct);<BR><BR>

     amp = ampdb(decibel);<BR><BR>

     decibel = dbamp(amp);<BR><BR>

     amp = boost(decibel);<BR><BR></UL>

<h3>Description</h3>

     These are functions which convert values between linear
     octaves, octave.pitch-class, cycles per second, and sampling
     increment.  There are also two amplitude conversion routines.<P>
<UL>

<B>cpsoct(oct)</B>
     - convert linear octaves to cycles per second.<BR>

<B>
cpspch(pch)</B>
     - convert octave.pitch-class to cycles per second.<BR>


<B>octcps(cps)</B>
     - convert cycles per second to linear octaves.<BR>


<B>octpch(pch)</B>
     - convert octave.pitch-class to linear octaves.<BR>


<B>pchcps(cps)</B>
     convert cycles per second to octave.pitch-class.<BR>


<B>pchoct(oct)</B>
     - convert linear octaves to octave.pitch-class.<BR>


<B>ampdb(db)</B>
     - convert amp in decibels to a real amplitude.<BR>


<B>dbamp(amp)</B>
     - convert real amplitude to an amp in decibels.<BR>


<B>boost(db)</B>
     - converts an amplitude in decibels to an amplitude multiplier. It simply returns 10 ** (db/20).<br>
</ul>
<br>
See also the
<a href="/reference/scorefile/cpspch.php">cpspch</a> and
<a href="/reference/scorefile/pchcps.php">pchcps</a> (etc...)
scorefile commands for more information about these representations.

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
