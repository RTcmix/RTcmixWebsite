<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - hpluck/hplset</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>hpluck/hplset</h3>
<i>Karplus-Strong ("plucked string") generator/filter and initialization</i>
<br>
<br>

<h3>Synopsis</h3>
<UL>
     #include &lt;ugens.h&gt;<BR>
<BR>
     float hpluck(sample,array)<BR>
     float sample, *array;<BR>
<BR>
     hplset(&xlp,&dur,&dynam,&plamp,&seed,&sr,&array)<BR>
     float xlp,dur,dynam,plamp,seed,sr,array;<BR>
<BR></UL>
<h3>Description</h3>

     <B>hpluck()</B> is an implementation of the Karplus-Strong plucked
     string algorithm described in the <I>Computer Music Journal</I>,
     vol. 7 no. 3, pp. 43-55.  Basically it fills a table array
     with random numbers on initialization and applies a low-pass
     filter to the table during performance.  The signal thus
     begins with a burst of noise and dies away to a sine wave.
     This sounds remarkably liked a plucked string.  This unit
     must first be initialized with a call to <B>hplset()</B>. which
     (groan) is still in Fortran, so the name must be followed by
     the underscore and all arguments must be passed by address.
     The value <i>xlp</i> is the loop time (1/hz), <i>dur</i> the expected
     duration of the note, <i>dynam</i>, specified in hz is a brightness factor,  <i>plamp</i> is the overall amplitude of the result,
     <i>seed</i>, is a random seed value for the initial table, <i>sr</i>
     is the sampling rate and <i>array</i> which must be dimensioned
     at least at (9+xlp*sr).  The arguments for <B>hpluck()</B> itself
     are the loaded <i>array</i> and an arbitrary input signal, which
     will be effected with a comb-like output.  The relation
     between the input signal and the pluck can be manipulated by
     tinkering with the amplitude of the input signal and plamp.
     If <i>plamp</i> is set to 0, the whole effect of the pluck will
     be on the input signal, and if the input signal is 0, the
     result will be normal plucked string synthesis.  We find
     that since the plucked signal dies away to dcbias that it is
     usually necessary to add an envelope to avoid a thump at the
     end of the note.  The strength of the initial pluck can then
     be tinkered with by manipulating the <i>dur</i> argument, which
     calculates coefficients to bring the signal to dcbias in
     that amount of time.<P>

<h3>See Also</h3>
The source code for the
<a href="/reference/instruments/STRUM.php">STRUM</a>
instrument contains much better plucked-string algorithms.  This
ugen is pretty ancient (note the reference to Fortran above).

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
