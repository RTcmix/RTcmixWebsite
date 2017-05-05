<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - irand</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>irand</b> - return a random number within a specified range
</P>
<P>

<HR>
<h3>Synopsis</h3>
<P>
value = <b>irand</b>([<i>minimum</i>,] <i>maximum</i>)
<p>
Parameters inside the [brackets] are optional.
</P>
<P>


<HR>
<h3>Description</h3>
<P>
Call <b>irand</b> to get a random number that falls within the
range specified by the arguments.
<P>
It's a good idea to call
<A HREF="srand.php">srand</A>
once to seed the random
number generator before using <b>irand</b>.  Otherwise, a seed of
1 will be used.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><i>minimum</i> [optional], <i>maximum</i></A><BR>
<DD>
These arguments define the range within which falls
the random value returned by <b>irand</b>.
If <i>minimum</i> is not present, <b>irand</b> will return
a value between 0.0 and <i>maximum</i>.  The bounds are inclusive.
<P></P></DL>
<P>


<HR>
<h3>Examples</h3>
<pre>
   srand(0)
   min = -30
   max = 10
   for (i = 0; i < 20; i = i + 1) {
      randval = irand(min, max)
      print(randval)
   }
</pre>
<P>


<HR>
<h3>See Also</h3>
<P>
<A HREF="srand.php">srand</A>,
<A HREF="trand.php">trand</A>,
<A HREF="random.php">random</A>,
<A HREF="rand.php">rand</A>,
<A HREF="pickrand.php">pickrand</A>,
<A HREF="pickwrand.php">pickwrand</A>,
<A HREF="spray_init.php">spray_init</A>,
<A HREF="get_spray.php">get_spray</A>,
<A HREF="maketable.php#random">maketable("random")</A>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

