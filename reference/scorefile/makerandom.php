<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - makerandom</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>makerandom</b> - set up a periodic random-number generator for control purposes,
using a <i>pfield-handle</i> connect to an Instrument parameter
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>
pfield-handle = <b>makerandom</b>(<i>"type"</i>, <i>frequency</i>, <i>min</i>, <i>max</i>[, seed])
<p>
Parameters inside the [brackets] are optional.
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>makerandom</b>
returns a <i>pfield-handle</i> that will deliver data periodically 
from an internal RTcmix random-number generator.  The period is determined
by the <i>frequency</i> argument, and the random numbers will lie
within the range set by the <i>min</i> and <i>max</i> arguments.
The random-numbers will be generated according the the random-number
distribution specified in the <i>"type"</i> string argument.  These
distributions are identical to the ones decribed in the
<a href="maketable.php#random">maketable "random"</a>
table construction command.  The
optional <i>seed</i> argument allows the user to specify a particular
seed value for the psuedorandom algorithm used by the random-number
generator. The active control rate (set via 
<a href="/reference/scorefile/reset.php">control_rate</a>) must be the 
same for makerandom and the instrument that uses the makerandom pfield-handle.
<p>
Many of the arguments for <b>makerandom</b> may themselves
also be pfield-handles.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><a name="type" class="internallink"><i>type</i></A><BR>
<DD>
This string value (i.e. enclosed in "double quotes" in the scorefile)
determines the type of random-number distribution to use in generating
the periodic values.  The different types currently supported are:
<ul>
	<li><i>"even"/"linear"</i> -- randomly select numbers between
		<i>min</i> and <i>max</i>.
	<br>
	<br>
	<li><i>"low"</i> -- randomly select numbers between
		<i>min</i> and <i>max</i>, but with a higher probability
		of choosing numbers nearer the <i>min</i> value.
	<br>
	<br>
	<li><i>"high"</i> -- randomly select numbers between
		<i>min</i> and <i>max</i>, but with a higher probability
		of choosing numbers nearer the <i>max</i> value.
	<br>
	<br>
	<li><i>"triangle"</i> -- randomly select numbers between
		<i>min</i> and <i>max</i>, but with the probability of
		choosing a value determined by a triangular curve with the
		apex at the midpoint between the <i>min</i> and <i>max</i>
		values.  In other words, numbers near either <i>min</i> or
		<i>max</i> will have a very low probability of being generated,
		but numbers half-way between will have a high
		probability of being chosen.
	<br>
	<br>
	<li><i>"gaussian"</i> -- randomly select numbers between
		<i>min</i> and <i>max</i>, but with the probability of
		choosing a value determined using a
<a href="http://mathworld.wolfram.com/NormalDistribution.html">Gaussian</a>
		('normal'; 'bell curve') probability distribution with the
		apex at the midpoint between the <i>min</i> and <i>max</i>
		values.  Similar to how the <i>"triangle"</i> specifier operates.
	<br>
	<br>
	<li><i>"cauchy"</i> -- randomly select numbers between
		<i>min</i> and <i>max</i>, but with the probability of
		choosing a value determined using a
<a href="http://www.itl.nist.gov/div898/handbook/eda/section3/eda3663.htm">Cauchy</a>
		function with the
		apex at the midpoint between the <i>min</i> and <i>max</i>
		values.  Similar to how the <i>"triangle"</i> and <i>"gaussian"</i>
		specifiers operate.
	<br>
	<br>
	<li><i>"prob"</i> -- Mara Helmuth's configurable probability
		distribution.  This has a slightly different syntax:
<ul>
<pre>
makerandom("prob", frequency, min, max, mid, tight[, seed])
</pre>
</ul>
<ul>
		<i>min</i> and <i>max</i> set the range within which the
		random numbers fall, as before.  <i>mid</i> sets the mid-point
		of the range, which is used when <i>tight</i> is not 1.
		<i>tight</i> governs the degree to which the random numbers
		adhere either to the mid-point set by <i>mid</i> or to
		the extremes of the range set by <i>min</i> and <i>max</i>:
<pre>
tight         effect
---------------------------------------------------------------
0             only the <i>min</i> and <i>max</i> values appear
1             even distribution
> 1           numbers cluster ever more tightly around <i>mid</i>
100           almost all numbers are equal to <i>mid</i>
</pre>
</ul>
<P></P></DL>

<DT><a name="frequency" class="internallink"><i>frequency</i></A><BR>
<DD>
The frequency (in Hz) determines the rate at which random values will
be generetated through the <i>pfield-handle</i>
This should be less than the
<a href="reset.php">reset</a>
rate.
<P></P></DL>

<DT><a name="min" class="internallink"><i>min</i></A><BR>
<DT><a name="max" class="internallink"><i>max</i></A><BR>
<DD>
These two arguments define the range of random values that will be produced
by the random-number generator through the <i>pfield-handle</i>.
<i>min</i> will set
the minimum value of the range, and <i>max</i>
will set the upper bound.
<P></P></DL>

<DT><a name="seed" class="internallink"><i>seed</i></A><BR>
<DD>
This optional argument sets the 'seed' (or initial value) for the
pseudorandom number algorithm used by RTcmix.  Each seed value
will generate a unique sequence of "random" numbers.
If the <i>seed</i> argument is 0, then the 'seed' for the psuedorandom number
algorithm comes from the microsecond system clock, otherwise the value
of <i>seed</i> is used as the 'seed'.
If no seed argument is present, the 'seed' used is 0 (i.e. the 'seed'
will come from the system clock).
<P></P></DL>
</DD>
<P>

<HR>
<h3>Examples</h3>
<PRE>
   pitch1 = makerandom("low", 10, 8.00, 8.11)
   pitch2 = makerandom("high", 15, 8.00, 8.11)
	wave = maketable("wave", 1000, 1.0, 0.2, 0.1)
	WAVETABLE(0, 4.9, 15000, pitch1, 0.0, wave)
	WAVETABLE(0, 4.9, 15000, pitch2, 1.0, wave)
</pre>
This scorefile uses two random-number PField generators, one
operating at 10 Hz (10 values/second) and the other at
15 Hz (15 values/second) to control the pitch of two
<a href="/reference/instruments/WAVETABLE.php">WAVETABLE</a>
notes, one in the left channel and one in the right.  The pitch
(in octave.pitch-class notation) is coming directly
from the random-number <i>pfield-handles, pitch1</i> and <i>pitch2</i>.
The range of these random-number generators is set to produce
values within the octave 8.00 to 8.11 (middle "C" to the "B"
above middle "C").
<P>

<HR>
<h3>See Also</h3>
<p>
<a href="maketable.php">maketable</a>,
<a href="makeconnection.php">makeconnection</a>,
<a href="makeLFO.php">makeLFO</a>,
<a href="makefilter.php">makefilter</a>,
<a href="makeconverter.php">makeconverter</a>,
<a href="makemonitor.php">makemonitor</a>,
<A HREF="irand.php">irand</A>,
<A HREF="srand.php">srand</A>,
<A HREF="trand.php">trand</A>,
<A HREF="random.php">random</A>,
<A HREF="rand.php">rand</A>,
<A HREF="pickrand.php">pickrand</A>,
<A HREF="pickwrand.php">pickwrand</A>,
<A HREF="spray_init.php">spray_init</A>,
<A HREF="get_spray.php">get_spray</A>,
<p>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
