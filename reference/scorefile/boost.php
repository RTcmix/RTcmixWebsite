<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - boost</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>boost</b> - convert linear pan amplitude to 'constant power' pan amplitude
</P>
<P>

<HR>
<h3>Synopsis</h3>
<P>
powerpan = <b>boost</b>(<i>linpan</i>)
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>boost</b> accepts a pan value (0.0-1.0) and returns the amplitude
scaling factor necessary to avoid a "hole in the middle" for a panned note.
In other words, for static-panned notes, it lets you convert the linear
panning law used by most instruments into a constant-power pan with
sqrt taper.
<p>
Examples of values returned by <b>boost</b>:
<pre>
   boost(0) => 1
   boost(1) => 1
   boost(0.25) => 1.265
   boost(0.5) => 1.414
</pre>

</P>
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><i>linpan</i>
<DD>
A pan value (0.0 - 1.0)
<P></P></DL>



<HR>
<h3>Examples</h3>
<pre>
   pan = 0.53
   powpan = boost(pan)
   STEREO(0, 0, 3.4, 1.0, powpan)
</pre>


<HR>
<h3>See Also</h3>
<p>
<a href="ampdb.php">ampdb</a>,
<a href="dbamp.php">dbamp</a>,
<a href="cpsmidi.php">cpsmidi</a>,
<a href="cpslet.php">cpslet</a>,
<a href="cpsoct.php">cpsoct</a>,
<a href="cpspch.php">cpspch</a>,
<a href="midipch.php">midipch</a>,
<a href="octcps.php">octcps</a>,
<a href="octlet.php">octlet</a>,
<a href="octmidi.php">octmidi</a>,
<a href="octpch.php">octpch</a>,
<a href="pchcps.php">pchcps</a>,
<a href="pchlet.php">pchlet</a>,
<a href="pchmidi.php">pchmidi</a>,
<a href="pchoct.php">pchoct</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

