<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - Standalone</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h1>Standalone Commands and Functions</h1>

RTcmix includes several utility programs for working with soundfiles, printing information, etc.  These are "standalone" executables, designed to work as commands typed into a Terminal or Shell window.  For the commands to work it is assumed that your <i>$path</i> is set correctly so that the "RTcmix/bin" (or similar installed location for RTcmix commands) is searched (see the <a href="/rtcmix/">installation guide</a>).

<ul>
	<li><a href="CMIX.php">CMIX/PCMIX/PYCMIX</a> -- run RTcmix with the Minc, Perl, or Python parsers</li>
	<li><a href="F1F2I1I2.php">F1/F2/I1/I2</a> -- write a soundfile header</li>
	<li><a href="cmixplay.php">cmixplay/play</a> -- play a soundfile</li>
	<li><a href="cpspch.php">cpspch</a> -- print the frequency of an oct.pc representation</li>
	<li><a href="hist.php">hist</a> -- print an amplitude or FFT plot in ASCII representation</li>
	<li><a href="pchcps.php">pchcps</a> -- print the oct.pc representation of a frequency</li>
	<li><a href="resample.php">resample</a> -- convert sampling rate of soundfiles</li>
	<li><a href="rescale.php">rescale</a> -- convert floating-point soundfiles to 16-bit integer soundfiles; normalize amplitude</li>
	<li><a href="setup_rtcmixrc.php">setup_rtcmixrc</a> -- create a <i>.rtcmixrc</i> configuration file</li>
	<li><a href="sfcreate.php">sfcreate</a> -- create a soundfile header. or alter an existing one</li>
	<li><a href="sffixsize.php">sffixsize</a> -- update the soundfile size data in the soundfile header</li>
	<li><a href="sfhedit.php">sfhedit</a> -- edit soundfile header data</li>
	<li><a href="sfprint.php">sfprint</a> -- print soundfile header information</li>
	<li><a href="sfshrink.php">sfshrink</a> -- shrink (or extend) a soundfile</li>
	<li><a href="sndreverse.php">sndreverse</a> -- reverse (in time) a soundfile</li>
</ul>



<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
