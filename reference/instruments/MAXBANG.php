<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - MAXBANG</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>MAXBANG</b> -- utility instrument used to generate a 'bang'
<br>
<i>in rtcmix~/iRTcmix: RTcmix/insts/maxmsp</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>MAXBANG</b>(time)
	<ul>
   This instrument has no pfield-enabled parameters.
	</ul>
	<hr>
	<br>

<pre>
   p0 = time to generate the bang (seconds)

   Author Brad Garton, 1/2004
</pre>
<br>
<hr>
<br>

<b>MAXBANG</b>
sends a 'bang' out the right outlet of the
<a href="http://rtcmix.org/rtcmix~/">rtcmix~</a>
object.  It can also be used in
<a href="http://rtcmix.org/iRTcmix/">iRTcmix</a>
for iOS.

<h3>Usage Notes</h3>

<b>MAXBANG</b> works by setting a flag when the <b>MAXBANG</b> note
is scheduled.  An internal function, check_bang(), determines if the
flag has been set.  If it has, it produces a 'bang' at the right outlet
of the Max/MSP
<a href="http://rtcmix.org/rtcmix~/">rtcmix~</a>
object.
<p>
<b>MAXBANG</b> can also be used in
<a href="http://rtcmix.org/iRTcmix/">iRTcmix</a>
for timing and scheduling purposes (the check_bang() function is called
directly in the application developer code).
<p>
<b>MAXBANG</b> is limited by the vector or buffer size, so it is not
sample-accurate.  Scheduling more then one 'bang' within a vector or
buffer will only result in one 'bang' at the vector/buffer boundary.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 1)
   load("MAXBANG")      // note:  the "load" is not necessary in rtcmix~/iRTcmix

   // send a bang 1.5 seconds after receiving this score
   MAXBANG(1.5)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="MAXMESSAGE.php">MAXMESSAGE</a>,
<a href="http://rtcmix.org/rtcmix~/">rtcmix~</a>,
<a href="http://rtcmix.org/iRTcmix/">iRTcmix</a>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
