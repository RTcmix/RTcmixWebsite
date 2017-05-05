<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - MMESH2D</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>MMESH2D</b> -- 2-dimensional 'mesh' physical model
<br>
<i>in RTcmix/insts/stk</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>MMESH2D</b>(outsk, dur, AMP, nxpoints, nypoints, xpos, ypos, decay, strike[, PAN])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>


<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = amplitude (absolute, for 16-bit soundfiles: 0-32768)
   p3 = # of X points (2-12)
   p4 = # of Y points (2-12)
   p5 = xpos (0.0-1.0)
   p6 = ypos (0.0-1.0)
   p7 = decay value (0.0-1.0)
   p8 = strike energy (0.0-1.0)
   p9 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0.5]

   p2 (amplitude) and p9 (pan) can receive dynamic updates from a table or
   real-time control source

   Author:  Brad Garton, based on code from the <a href="http://www.cs.princeton.edu/~prc/NewWork.php#STK">Synthesis ToolKit</a>
</pre>
<br>
<hr>
<br>


<b>MMESH2D</b> is the "Mesh2D" physical model in Perry Cook and Gary Scavone's
<a href="http://www.cs.princeton.edu/~prc/NewWork.php#STK">STK</a>,
the Synthesis ToolKit.

<h3>Usage Notes</h3>

<b>MMESH2D</b>
creates some interestingly bizarre sounds.  It's sort of like
tapping on a flexible metal sheet.  What fun!
<p>
Here's what was written in the original source code:
<ul>
    This class implements a rectilinear,
    two-dimensional digital waveguide mesh
    structure.  For details, see Van Duyne and
    Smith, "Physical Modeling with the 2-D Digital
    Waveguide Mesh", <u>Proceedings of the 1993
    International Computer Music Conference</u>.
</ul>
The 'mesh' is defined by p3 ("nxpoints") and p4 ("nypoints").  The
modeled mesh is then 'struck' at the position specified by
p5 ("xpos") and p6 ("ypos").
<p>
Sometimes the amplitude is very small and has to be boosted.
<p>
<b>MMESH2D</b> can produce other mono or stereo output.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("MMESH2D")

   MMESH2D(0, 4.5, 3*30000, 12, 11, 0.8, 0.9, 1.0, 1.0, 0.5)

   amp = 30000
   ampenv = maketable("line", 1000, 0,0, 4,1, 5,0)
   pan = makeLFO("tri", 0.5, 0.0, 1.0)
   MMESH2D(5, 4.5, amp*ampenv*100, 10, 11, 0.7, 0.1, 1.0, 1.0, pan)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("MMESH2D")

   srand()

   st = 0
   for (i = 0; i < 150; i = i+1)
   {
      nx = irand(2, 12)
      ny = irand(2, 12)
      MMESH2D(st, 0.5, 17000, nx, ny, random(), random(), random(), random(), random())
      st = st + 0.1
   }
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="AMINST.php">AMINST</a>,
<a href="FMINST.php">FMINST</a>,
<a href="MBANDEDWG.php">MBANDEDWG</a>,
<a href="MBOWED.php">MBOWED</a>,
<a href="MMODALBAR.php">MMODALBAR</a>,
<a href="MSHAKERS.php">MSHAKERS</a>,
<a href="STRUM.php">STRUM</a>,
<a href="STRUM2.php">STRUM2</a>,
<a href="STRUMFB.php">STRUMFB</a>,
<a href="WIGGLE.php">WIGGLE</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

