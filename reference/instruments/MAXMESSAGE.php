<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - MAXMESSAGE</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>MAXMESSAGE</b> -- utility instrument used to output values
<br>
<i>in rtcmix~/iRTcmix: RTcmix/insts/maxmsp</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>MAXMESSAGE</b>(time, val1, val2, ... valn)
	<ul>
   This instrument has no pfield-enabled parameters.
	</ul>
	<hr>
	<br>

<pre>
   p0 = time to send out the values (seconds)
   p1-pn = the values to be sent

   Author Brad Garton, 1/2004
</pre>
<br>
<hr>
<br>

<b>MAXMESSAGE</b>
will send a list of values out the right outlet of the
<a href="http://rtcmix.org/rtcmix~/">rtcmix~</a>
object.  It can also be used in
<a href="http://rtcmix.org/iRTcmix/">iRTcmix</a>
for iOS.

<h3>Usage Notes</h3>

<b>MAXMESSAGE</b> works by setting a flag when the <b>MAXMESSAGE</b> note
is scheduled.  An internal function, check_vals(), determines if the
flag has been set.  If it has, it sends a list of the values set in
the <b>MAXMESSAGE</b> note pfields out the right outlet of the Max/MSP
<a href="http://rtcmix.org/rtcmix~/">rtcmix~</a>
object.
<p>
<b>MAXMESSAGE</b> can also be used in
<a href="http://rtcmix.org/iRTcmix/">iRTcmix</a>.
(the check_vals() function is called
directly in the application developer code).
<p>
<b>MAXMESSAGE</b> is limited by the vector or buffer size, so it is not
sample-accurate.  Scheduling more then one <b>MAXMESSAGE</b>
within a vector or buffer will only send out the values in the
most-recently-scheduled <b>MAXMESSAGE</b> note.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 1)
   load("MAXMESSAGE")      // note:  the "load" is not necessary in rtcmix~/iRTcmix

   // send a list of values immediately after receiving this score
   MAXMESSAGE(0, 1.414, 7.8, 97)
</pre>
<br>


<hr>
<h3>See Also</h3>
<br>
<a href="MAXBANG.php">MAXBANG</a>,
<a href="http://rtcmix.org/rtcmix~/">rtcmix~</a>,
<a href="http://rtcmix.org/iRTcmix/">iRTcmix</a>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
