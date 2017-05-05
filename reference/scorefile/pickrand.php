<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - pickrand</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>pickrand</b> - return a random choice from a specified set of numbers
</P>
<P>



<HR>
<h3>Synopsis</h3>
<P>
value = <b>pickrand</b>(<i>number1</i> [, <i>number2</i>, ... <i>numberN</i> ])
<p>
Parameters inside the [brackets] are optional.
<P>


<HR>
<h3>Description</h3>
<P>
Call <b>pickrand</b> to choose randomly among several numbers that you
specify as its arguments.
<p>
It's a good idea to call
<A HREF="srand.php">srand</A>
once to seed the random
number generator before using <b>pickrand</b>.  Otherwise, a seed of
1 will be used.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><A NAME="item_number"><i>number1, number2, ... numberN</i></A><BR>
<DD>
There can be any number of numerical arguments to <b>pickrand</b>, as
long as there is at least one.
<P></P></DL>
<P>

<HR>
<h3>RETURN VALUE</h3>
<P>
One of the arguments to <b>pickrand</b>, selected randomly.
<P>


<HR>
<h3>Examples</h3>
<PRE>
   srand(1)
   for (i = 0; i &lt; 10; i = i + 1) {
      pitch = pickrand(8.00, 8.02, 8.04, 8.05, 8.07, 8.09, 8.11)
      print(pitch)
   }
</PRE>
<p>
prints 10 pitches from a C major scale, selected randomly.  There's no
guarantee that this will print each of the arguments at least once.  Use
the spray mechanism for that
(<A HREF="spray_init.php">spray_init</A>,
<A HREF="get_spray.php">get_spray</A>).
<P>


<HR>
<h3>See Also</h3>
<P>
<A HREF="irand.php">irand</A>,
<A HREF="srand.php">srand</A>,
<A HREF="trand.php">trand</A>,
<A HREF="random.php">random</A>,
<A HREF="rand.php">rand</A>,
<A HREF="pickwrand.php">pickwrand</A>,
<A HREF="spray_init.php">spray_init</A>,
<A HREF="get_spray.php">get_spray</A>,
<A HREF="maketable.php#random">maketable("random")</A>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

