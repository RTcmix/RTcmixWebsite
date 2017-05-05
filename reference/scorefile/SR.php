<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - SR</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>SR</b> - return sampling rate information
</P>
<P>

<HR>
<h3>Synopsis</h3>
<P>
samprate = <b>SR</b>()
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>SR</b> returns the sampling rate of the most recently
opened soundfile by the
<a href="rtinput.php">rtinput</a>
command, or the sampling rate of the input audio device.
</P>
<P>


<HR>
<h3>Examples</h3>
<pre>
   rtinput("somesoundfile")
   srate = SR()
</pre>


<HR>
<h3>See Also</h3>
<p>
<a href="CHANS.php">CHANS</a>,
<a href="DUR.php">DUR</a>,
<a href="PEAK.php">PEAK</a>,
<a href="filechans.php">filechans</a>,
<a href="filedur.php">filedur</a>,
<a href="filepeak.php">filepeak</a>,
<a href="filesr.php">filesr</a>,
<a href="rtinput.php">rtinput</a>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

