<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - get_spray</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>get_spray</b> - retrieve an integer from a spray table
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>
integer_value = <b>get_spray</b>(<i>spray_table_number</i>)
</P>
<P>


<HR>
<h3>Description</h3>
<P>
Call <b>get_spray</b> from a script to get a number from a spray table
initialized by
<A HREF="spray_init.php">spray_init</A>.
The table contains integers
from zero to one less than the table size.  Repeatedly calling
<b>get_spray</b> reads the table in a random order, but in such a way
that no number appears twice before all the other numbers have
appeared once.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><A NAME="item_spray_table_number"><i>spray_table_number</i></A><BR>
<DD>
The numeric ID for the spray table.  You can have as many as
32 spray tables, numbered from 0 to 31.
<P></P></DL>
<P>


<HR>
<h3>Examples</h3>
<P>
This complete score plays two randomly generated twelve-tone rows,
one after the other, in an appropriately irritating way.  Each
pitch appears exactly once during the first 12 notes, and once
again during the second 12 notes.</P>
<pre>
   rtsetparams(44100, 1)
   load("WAVETABLE")

   amp = 20000
   ampenv = maketable("line", 1000, 0,0, 1,1, 10,0)

   /* make sawtooth wave */
   sawtable = maketable("wave", 1000, 1, 1/2, 1/3, 1/4, 1/5, 1/6, 1/7, 1/8, 1/9)

   seed = 0
   spray_init(0, 12, seed) /* make spray table 0 with 12 elements */

   for (i = 0; i < 24; i = i + 1) {
      val = get_spray(0)   /* access spray table 0 */
      pitch = 8 + (val * 0.01)  /* convert to oct.pc */
      st = i * 0.25
      WAVETABLE(st, dur = 0.25, amp*ampenv, pitch, 0, sawtable)
   }
</pre>
<br>
<br>
This complete score shows how to make a sound pan randomly to specific
locations (rather than to just any random location).  The sound will
pan to each location once, in a random order, then pan to each location
once more, in a random order, etc., for 10 seconds.  Note that this
does not mean there will be no direct repetitions of a location, since
this can occur when starting to read the table for a second time, for
example.  (The last value returned during the first read could be the
value returned at the start of the second read.)
<pre>
   rtsetparams(44100, 2)
   load("WAVETABLE")

   amp = 20000
   ampenv = maketable("curve", 1000, 0,0,0, 1,1,-5, 30,0)

   sawtable = maketable("wave", 1000, 1, .3, .1)  /* dull sawtooth */

   seed = 1
   spray_init(0, 3, seed) /* make spray table 0 with 3 elements */

   /* make array containing 3 pan locations */
   panarr = { 0.0, 0.5, 1.0 }

   dur = 0.2
   pitch = 8.00
   for (st = 0; st < 10; st = st + 0.25) {
      /* use spray value as index into the pan array */
      index = get_spray(0)       /* access spray table 0 */
      pan = panarr[index]
      WAVETABLE(st, dur, amp*ampenv, pitch, pan, sawtable)
   }
</pre>
<P>


<HR>
<h3>See Also</h3>
<p>
<A HREF="irand.php">irand</A>,
<A HREF="pickrand.php">pickrand</A>,
<A HREF="pickwrand.php">pickwrand</A>,
<A HREF="rand.php">rand</A>,
<A HREF="random.php">random</A>,
<A HREF="spray_init.php">spray_init</A>,
<A HREF="srand.php">srand</A>,
<A HREF="trand.php">irand</A>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

