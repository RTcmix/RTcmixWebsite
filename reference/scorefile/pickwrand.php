<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - pickwrand</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>pickwrand</b> - return a weighted random choice from a set of numbers</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>
value = <b>pickwrand</b>(<i>number1</i>, <i>probability1</i>
[, <i>number2</i>, <i>probability2</i>, ... <i>numberN</i>, <i>probabilityN</i> ])
<p>
Parameters inside the [brackets] are optional.
</P>
<P>


<HR>
<h3>Description</h3>
<P>
Call <b>pickwrand</b> to choose randomly among several numbers that you
specify, with a probability for each number.
<p>
It's a good idea to call
<A HREF="srand.php">srand</A>
once to seed the random
number generator before using <b>pickwrand</b>.  Otherwise, a seed of
1 will be used.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><A NAME="item_number"><i>number</i></A><BR>
<DD>
<DT><A NAME="item_probability"><i>probability</i></A><BR>
<DD>
There can be as many <i>number</i>, <i>probability</i> pairs as you like,
as long as there is at least one pair.
<p>
A <i>probability</i> argument determines how likely it is that <b>pickwrand</b>
will choose the corresponding <i>number</i> argument.  The higher the
<i>probability</i>, the more likely.
<p>
The total probability is the sum of all the <i>probability</i> arguments.
<P></P></DL>
<P>


<HR>
<h3>RETURN VALUE</h3>
<P>
One of the <i>number</i> arguments to <b>pickwrand</b>, selected randomly
in accordance with the given probabilities.
<P>


<HR>
<h3>Examples</h3>
<PRE>
   srand(0)
   while (outskip &lt; ending_time) {
      stereo_loc = pickwrand(0.0, 10,  0.5, 80,  1.0, 10)
      WAVETABLE(outskip, dur, amp, frequency, stereo_loc)
      outskip = outskip + 0.2
   }
</PRE>
<p>
plays
<A HREF="/reference/instruments/WAVETABLE.php">WAVETABLE</A>
notes, panning them in accordance with
the following probabilities: 10% of the notes will pan to hard left,
10% of the notes will pan to hard right, and 80% of the notes will
pan to the center.
<P>


<HR>
<h3>See Also</h3>
<P>
<A HREF="irand.php">irand</A>,
<A HREF="srand.php">srand</A>,
<A HREF="trand.php">trand</A>,
<A HREF="random.php">random</A>,
<A HREF="rand.php">rand</A>,
<A HREF="pickrand.php">pickrand</A>,
<A HREF="spray_init.php">spray_init</A>,
<A HREF="get_spray.php">get_spray</A>,
<A HREF="maketable.php#random">maketable("random")</A>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
