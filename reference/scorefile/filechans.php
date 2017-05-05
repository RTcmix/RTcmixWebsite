<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - filechans</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>filechans</b> - return soundfile channel information
</P>
<P>

<HR>
<h3>Synopsis</h3>
<P>
nchans = <b>filechans</b>(<i>"filename"</i>)
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>filechans</b> simply returns the number of channels
of the soundfile
<i>filename</i>.  <i>filename</i> may be an absolute or
relative pathname to the soundfile.  This command does not
require that the soundfile be previously opened by the
<a href="rtinput.php">rtinput</a>
command.
</P>
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
<P>


<HR>
<h3>Examples</h3>
<pre>
   nchannels = filechans("somesoundfile")
</pre>


<HR>
<h3>See Also</h3>
<p>
<a href="CHANS.php">CHANS</a>,
<a href="DUR.php">DUR</a>,
<a href="PEAK.php">PEAK</a>,
<a href="SR.php">SR</a>,
<a href="filedur.php">filedur</a>,
<a href="filepeak.php">filepeak</a>,
<a href="filesr.php">filesr</a>,
<a href="rtinput.php">rtinput</a>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

