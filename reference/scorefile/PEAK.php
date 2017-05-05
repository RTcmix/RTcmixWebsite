<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - PEAK/RIGHT_PEAK/LEFT_PEAK</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>PEAK/RIGHT_PEAK/LEFT_PEAK</b> - return amplitude peak information
</P>
<P>

<HR>
<h3>Synopsis</h3>
<P>
val = <b>PEAK</b>()
<br>
val = <b>LEFT_PEAK</b>()
<br>
val = <b>RIGHT_PEAK</b>()
<br>
val = <b>PEAK</b>(<i>start, end</i>)
<br>
val = <b>LEFT_PEAK</b>(<i>start, end</i>)
<br>
val = <b>RIGHT_PEAK</b>(<i>start, end</i>)
</P>
<P>


<HR>
<h3>Description</h3>
<P>
These commands operate upon the most recently opened input
soundfile by the
<a href="rtinput.php">rtinput</a> command.
<b>PEAK</b> returns the overall peak for both channels, <b>RIGHT_PEAK</b>
and <b>LEFT_PEAK</b> return the peak amplitudes for the left (channel 0)
and right (channel 1) channels, respectively.
The optional <i>start</i> and <i>end</i> parameters
are starting and ending times to scan the soundfile (in seconds).
<p>
These routines will attempt to read the peak amplitude(s) stored in
the soundfile header.  If this is not possible, then the soundfile
itself will be scanned.  They do not work on a real-time audio input
device.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><i>start</i>
<DD>
The number of seconds to skip before starting the peak amplitude scan
<P></P></DL>
<DL>
<DT><i>end</i>
<DD>
The endpoint (in seconds) to stop the peak amplitude scan
<P></P></DL>
<P>


<HR>
<h3>Examples</h3>
<pre>
   rtinput("somesoundfile")
   peakval = PEAK()

   rtinput("someothersoundfile")
   lpeakval = LEFT_PEAK(3.4, 7.8)
</pre>


<HR>
<h3>See Also</h3>
<p>
<a href="CHANS.php">CHANS</a>,
<a href="DUR.php">DUR</a>,
<a href="SR.php">SR</a>,
<a href="filechans.php">filechans</a>,
<a href="filedur.php">filedur</a>,
<a href="filepeak.php">filepeak</a>,
<a href="filesr.php">filesr</a>,
<a href="rtinput.php">rtinput</a>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

