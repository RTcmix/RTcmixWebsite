<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - filepeak</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>filepeak</b> - return soundfile peak amplitude information
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>
peakval = <b>filepeak</b>(<i>"filename"</i>[, <i>starttime</i>[, <i>endtime</i>[, <i>chan</i>]]]</i>)
<p>
Parameters inside the [brackets] are optional.
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>filepeak</b> returns the peak amplitude value for the soundfile
<i>filename</i>.  <i>filename</i> may be an absolute or
relative pathname to the soundfile.  This command does not
require that the soundfile be previously opened by the
<a href="rtinput.php">rtinput</a>
command.
<p>
The optional <i>starttime</i> parameter can be used to set
a starting point to scan for the peak amplitude.  Similarly,
the <i>endtime</i> optional parameter can set an endpoint
for the scan.  The optional <i>chan</i> parameter may be used
to specify which channel of a multi-channel soundfile to
scan, otherwise the peak among all channels will be returned.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><i>"filename"</i>
<DD>
A string representing the name of the soundfile to be queried.  It
may be an absolute or relative pathname to the soundfile.  If it is relative,
then it will be relative to the directory where the CMIX command
was invoked.
<P></P></DL>
<DL>
<DT><i>starttime</i>
<DD>
An optional parameter specifying the starting point (in seconds) to begin
the scan for a peak amplitude.
<P></P></DL>
<DL>
<DT><i>endtime</i>
<DD>
An optional parameter specifying the ending point (in seconds) to begin
the scan for a peak amplitude.
<P></P></DL>
<DL>
<DT><i>chan</i>
<DD>
An optional parameter specifying which channel to
scan for a peak amplitude (RTcmix begins numbering channels with "0").
<P></P></DL>
<P>


<HR>
<h3>Examples</h3>
<pre>
   peak = filepeak("somesoundfile")
   peak = filepeak("somesoundfile", 77.8, 98.2, 1))
</pre>


<HR>
<h3>See Also</h3>
<p>
<a href="CHANS.php">CHANS</a>,
<a href="DUR.php">DUR</a>,
<a href="PEAK.php">PEAK</a>,
<a href="SR.php">SR</a>,
<a href="filechans.php">filechans</a>,
<a href="filedur.php">filedur</a>,
<a href="filesr.php">filesr</a>,
<a href="rtinput.php">rtinput</a>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

