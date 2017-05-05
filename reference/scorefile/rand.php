<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - rand</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>rand</b> - return a random number between -1 and 1
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>value = <b>rand</b>()
</P>
<P>


<HR>
<h3>Description</h3>
<P>
Call <b>rand</b> to get a random number between -1 and 1, inclusive.
<P>
It's a good idea to call
<A HREF="srand.php">srand</A>
once to seed the random
number generator before using <b>rand</b>.  Otherwise, a seed of
1 will be used.
<P>
There are no arguments to <b>rand</b>.
<P>


<HR>
<h3>Examples</h3>
<PRE>
   srand(1)
   for (i = 0; i < 20; i = i + 1) {
      randval = rand() * 10
      print(randval)
   }
</PRE>
<P>
prints 20 random numbers having values between -10 and 10.
<P>
The following complete CMIX script plays repeated notes of the same
pitch.  The attack times of the notes vary randomly from an even
grid whose lines are spaced 0.14 seconds apart, and the amplitudes
range from 400 to 3600.
<PRE>
   rtsetparams(44100, 1)
   load("WAVETABLE")

   ampenv = maketable("line", 1000, 0,0, 1,0, 20,1, 40,0)
   wavetable = maketable("wave", 1000, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1)

   srand(0)
   smear = 0.12
   amp = 2000
   dur = 0.06
   for (start = smear; start < 10; start = start + 0.14) {
      randval = rand()
      st = start + (randval * smear)
      randval = rand()
      a = amp + (randval * (amp * 0.8))
      WAVETABLE(st, dur, a*ampenv, freq = 1200, 0, wavetable)
   }
</PRE>
<P>
The basic strategy is to multiply the return value of <b>rand</b>,
which falls between -1 and 1, by some factor that modifies this
range.  You could randomize the frequency in the same manner.
<P>

<HR>
<h3>See Also</h3>
<P>
<A HREF="irand.php">irand</A>,
<A HREF="srand.php">srand</A>,
<A HREF="trand.php">trand</A>,
<A HREF="random.php">random</A>,
<A HREF="pickrand.php">pickrand</A>,
<A HREF="pickwrand.php">pickwrand</A>,
<A HREF="spray_init.php">spray_init</A>,
<A HREF="get_spray.php">get_spray</A>,
<A HREF="maketable.php#random">maketable("random")</A>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

