<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - evp/evset</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>evp/evset</h3>
<i>envelope/control function initialization and generator</i>
<br>
<br>
<ul>
<i>[note:  This is an older envelope unit-generators.  It has
been generally superceded by using the
<a href="Ooscili.php">Ooscili</a>
or
<a href="Ooscil.php">Ooscil</a>
objects to read a function table slot for a control
function/envelope for exactly one cyle through the note.</i>
</ul>

<h3>Synopsis</h3>
<UL>
     #include &lt;ugens.h&gt;<BR>

<BR>
     float evp(nsample,f1,f2,envals)<BR>
     long nsample;<BR>
     float *f1,*f2,*envals;<BR>

<BR>
     evset(dur,rise,dec,nfrise,envals)<BR>
     float dur,rise,dec,*envals;<BR>
     int nfrise;<BR>
<BR>
</UL>

<h3>Description</h3>

    <B>evp()</B> is an envelope generator which can be called at arbitrary times since it looks up its position according to the
     ratio between <i>nsample</i> and the total number of expected samples.  Thus it can be called at arbitrary times, as in a
     control loop, without any extra footwork.  <i>nsample</i> is the
     number of the current sample, with the first sample counting
     from 0.  This is typically returned by the
<a href="Instrument.php#currentFrame">currentFrame</a> function.
   <i>f1</i> and <i>f2</i> are the pointers to the function arrays used for
     rise and decay, respectively.  These are set
by
<A HREF="floc.php">floc</A>.
    <i>envals</i> is a 5-location array of floats for bookkeeping purposes.  <B>evset()</B> is the initialization routine and asks for
     the<i>duration, rise,</i> and <i>decay</i> time in seconds.  If <i>rise</i> or
    <i>decay</i> are negative numbers they are interpreted as a fraction of the duration.  <i>nfrise</i> is the number of the rise
     function.  The size of the rise and decay functions must be
     the same.  The decay function is sampled backwards.<P>

<h3>See Also</h3>

<A HREF="floc.php">floc</A>,
<A HREF="fsize.php">fsize</A>.

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
