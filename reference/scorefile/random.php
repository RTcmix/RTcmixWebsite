<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - random</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>random</b> - return a random number between 0 and 1
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>
value = <b>random</b>()
</P>
<P>


<HR>
<h3>Description</h3>
<P>
Call <b>random</b> to get a random number between 0 and 1, inclusive.
<P>
It's a good idea to call 
<A HREF="srand.php">srand</A>
once to seed the random
number generator before using <b>random</b>.  Otherwise, a seed of
1 will be used.
<P>There are no arguments to <b>random</b>.
<P>


<HR>
<h3>Examples</h3>
<PRE>
   srand(1)
   for (i = 0; i &lt; 10; i = i + 1) {
      randval = random() * 1000
      print(randval)
   }
</PRE>
<P>
prints 10 random numbers having values between 0 and 1000,
inclusive.
<P>
The following complete CMIX script plays repeated notes of the same
pitch, sprayed randomly across the stereo field.  This is easy
to do, because the <i>stereo_loc</i> argument to most instruments
has the same range as the value returned by <b>random</b>.
<PRE>
   rtsetparams(44100, 2)
   load("WAVETABLE")

   reset(20000)   /* short notes need high control rate */
   ampenv = maketable("line", 1000, 0,0, 1,0, 10,1, 40,0)
   wavetable = maketable("wave", 1000, 1, 1, 1, 1, 1, 1, 0.5)

   srand(10)
   amp = 8000
   freq = 80
   dur = 0.04
   for (start = 0; start < 8; start = start + 0.11) {
      stereo_loc = random()
      WAVETABLE(start, dur, amp, freq, stereo_loc, wavetable)
   }
</PRE>
<P>

<HR>
<h3>See Also</h3>
<P>
<A HREF="irand.php">irand</A>,
<A HREF="srand.php">srand</A>,
<A HREF="trand.php">trand</A>,
<A HREF="rand.php">rand</A>,
<A HREF="pickrand.php">pickrand</A>,
<A HREF="pickwrand.php">pickwrand</A>,
<A HREF="spray_init.php">spray_init</A>,
<A HREF="get_spray.php">get_spray</A>,
<A HREF="maketable.php#random">maketable("random")</A>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

