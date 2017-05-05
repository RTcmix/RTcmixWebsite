<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - DUMP</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>DUMP</b> -- print PField variable data (utility instrument)
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>DUMP</b>(outsk, dur, AMP[, TABLE])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>
	<hr>
	<br>
	<br>

<pre>
   p0 = output start time
   p1 = duration
   p2 = amp
   p3 = fixed table [optional]

   p2 (amplitude) can receive dynamic updates from a table or real-time
   control source.  This is the parameter whose values will print (unless
   the optional p3 parameter is present).
</pre>
<br>
<hr>
<br>


<b>DUMP</b>
is a "utility" instrument that can be used to debug PField variables
representing table data or control input streams.  If p3 is not present,
the values coming through the "amp" PField (p2) will be printed.
How often printing occurs is determined by the
<a href="/reference/scorefile/control_rate.php">control_rate</a>
setting in the scorefile.  If p3 is present, all of the values
in the table represented by p3 will print at each
<a href="/reference/scorefile/control_rate.php">control_rate</a>
interval.

<h3>Usage Notes</h3>

This can generate a <u>huge</u> amount of printed data.  It is best
when debugging table values (p3) to use small table sizes, since the
entire table is printed at each interval.

<h3>Sample Scores</h3>

very basic:
<pre>
   rtsetparams(44100, 1)
   load("DUMP")

   ampenv = maketable("line", 1000, 0,0, 1,1, 2,0)
   DUMP(0, 2, ampenv)
</pre>
<br>
<br>
more advanced:
<pre>
   rtsetparams(44100, 1)
   load("DUMP")

   control_rate(100)

   amp = maketable("line", 1000, 0,0, 1,1, 2,0)
   amp = makefilter(amp, "fitrange", -100, 300)

   DUMP(0, dur, amp)
</pre>
<br>

<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="/reference/scorefile/makemonitor.php">makemonitor</a>,
<a href="/reference/scorefile/dumptable.php">dumptable</a>,
<a href="/reference/scorefile/plottable.php">plottable</a>,
<a href="/reference/scorefile/control_rate.php">control_rate</a>,
<a href="/reference/scorefile/print.php">print</a>,
<a href="/reference/scorefile/printf.php">printf</a>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
