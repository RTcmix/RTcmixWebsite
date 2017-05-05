<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - Orand</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<h3>Orand</h3>
<i>INSTRUMENT design -- pseudo-random number generator object</i>
<br>
<br>
The <b>Orand</b> object can be used to generate streams of
pseudo-random numbers.  The generating algorthm can be seeded
by a particular seed value or can be set by the system clock,
thus creating a different sequence of random numbers for every
run of the algorithm.
<p>
It brings together and can be used to replace a number of
older pseudo-random number functions scattered throughout
cmix/RTcmix, including the
<a href="rrand.php">rrand,</a>
<a href="srrand.php">srrand,</a> and
<a href="crandom.php">crandom</a>
functions.
<p>
The pseudo-random number generator used in the RTcmix distribution
isn't the latest and greatest, but it seems to do the job well
enough for us flaky musicians.
<hr><h3>Constructors</h3>
<ul>
<b>Orand()</b>
<br>
<br>
<dd>
creates a new pseudo-random number generator with a default seed value
of 1.
</dd>
<br>
<br>
<b>Orand(</b><i>int seed</i><b>)</b>
<br>
<br>
<dd>
<u><i>seed</i></u> is the seed value for the pseudo-random number generator
created.
</dd>
<br>
<br>
</ul>
<hr>
<h3>Access Methods</h3>
<ul>
<b>void Orand::seed(</b><i>int seed</i><b>)</b>
<br>
<br>
<dd>
starts a new random sequence using <i>seed</i> as the base.
Different values of <i>seed</i> will result in different pseudo-random
number sequences.  The same value will yield the same sequence each
time.
</dd>
<br>
<br>
<b>void Orand::timeseed()</b>
<br>
<br>
<dd>
will seed the pseudo-random number generator
using the system clock to generate the seed value.
</dd>
<br>
<br>
<b>float Orand::random()</b>
<br>
<br>
<dd>
returns a floating-point pseudo-random number between 0.0 and 1.0.
The sequence of random values depends on the setting of the seed value.
</dd>
<br>
<br>
<b>float Orand::rand()</b>
<br>
<br>
<dd>
returns a floating-point pseudo-random number between -1.0 and 1.0.
The sequence of random values depends on the setting of the seed value.
</dd>
<br>
<br>
<b>float Orand::range(</b><i>float lo, float hi</i><b>)</b>
<br>
<br>
<dd>
returns a floating-point pseudo-random number between
<i>lo</i> and <i>hi</i>.
The sequence of random values depends on the setting of the seed value.
</dd>
</ul
<br>
<hr><h3>Examples</h3>
<ul>
<pre>
#include &lt;Ougens.h&gt;

Orand *theNoise;

// this instrument will generate noise
int MYINSTRUMENT::init(float p[], int n_args)
{

	...

	theNoise = new Orand();
	theNoise->timeseed();

	...

}

int MYINSTRUMENT::run()
{
	float out[2];

	...

	for (i = 0; i < framesToRun(); i++)
	{
		out[0] = theNoise->rand();
	}

	...

}
</pre>
</ul>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
