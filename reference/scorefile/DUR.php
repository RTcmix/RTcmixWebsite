<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - DUR</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>DUR</b> - return soundfile duration information
</P>
<P>

<HR>
<h3>Synopsis</h3>
<P>
duration = <b>DUR</b>()
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>DUR</b> returns the duration of the most recently
opened soundfile by the
<a href="rtinput.php">rtinput</a>
command.
</P>
<P>


<HR>
<h3>Examples</h3>
<pre>
   rtinput("somesoundfile")
   val = DUR()
</pre>


<HR>
<h3>See Also</h3>
<p>
<a href="CHANS.php">CHANS</a>,
<a href="PEAK.php">PEAK</a>,
<a href="SR.php">SR</a>,
<a href="filechans.php">filechans</a>,
<a href="filedur.php">filedur</a>,
<a href="filepeak.php">filepeak</a>,
<a href="filesr.php">filesr</a>,
<a href="rtinput.php">rtinput</a>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

