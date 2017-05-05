<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - REV</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>REV</b> -- several basic reverberators
<br>
<i>in RTcmix/insts/jg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>REV</b>(outsk, insk, dur, AMP, rvbtype, rvbtime, RVBAMT[, inputchan])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = input duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = reverb type (integer, use  1: PRCRev, 2: JCRev, 3: NRev; see <a href="#usage_notes">Usage Notes</a> below)
   p5 = reverb time (seconds)
   p6 = reverb amount (0: dry --> 1: wet)
   p7 = input channel  [optional; default is 0]

   p3 (amplitude) and p6 (reverb amount) can receive dynamic updates from
   a table or real-time control source.

   Author:  John Gibson, 7/19/99; rev for v4, 7/21/04
   based on several reverberators from the STK package (by Perry Cook, Gary Scavone, and Tim Stilson)

</pre>
<br>
<hr>
<br>

<b>REV</b> processes input audio through a choice of three different
reverb types (all from
<a href="http://www-ccrma.stanford.edu/">CCRMA</a>
st Stanford University).


<a name="usage_notes"></a>
<h3>Usage Notes</h3>


The reverberators in <b>REV</b> all have characteristic 'sounds', for
more general reverberation the
<a href="FREEVERB.php">FREEVERB</a>
or
<a href="GVERB.php">GVERB</a>
instruments are probably better.  There are also a number of excellent
room-simulator instruments (listed under the
<a href="#see_also">See Also</a>
section below).  The <b>REV</b> algorithms are very efficient, though.
<p>
The reverb types are:
<br>
<pre>
     (1) PRCRev (Perry R. Cook)
           2 allpass units in series followed by 2 comb filters in parallel.

     (2) JCRev (John Chowning)
           3 allpass filters in series, followed by 4 comb filters in
           parallel, a lowpass filter, and two decorrelation delay lines
           in parallel at the output.

     (3) NRev (Michael McNabb)
           6 comb filters in parallel, followed by 3 allpass filters, a
           lowpass filter, and another allpass in series, followed by 2
           allpass filters in parallel with corresponding right and left
           outputs.
</pre>
<p>
<b>REV</b> can produce either mono or stereo output.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("REV")
   
   rtinput("mysound.aif")

   outskip = 0
   inskip = 0
   dur = DUR()
   amp = 0.7
   rvbtype = 3
   rvbtime = 0.3
   rvbpct = 0.3
   inchan = 0

   ampenv = maketable("line", 1000, 0,0, 1,1, dur-1,1, dur,0)

   REV(outskip, inskip, dur, amp*ampenv, rvbtype, rvbtime, rvbpct, inchan)
</pre>
<br>


<hr>
<br>
<a name="see_also"></a>
<h3>See Also</h3>

<a href="DMOVE.php">DMOVE</a>,
<a href="FREEVERB.php">FREEVERB</a>,
<a href="GVERB.php">GVERB</a>,
<a href="MMOVE.php">MMOVE</a>,
<a href="MOVE.php">MOVE</a>,
<a href="MPLACE.php">MPLACE</a>,
<a href="MROOM.php">MROOM</a>,
<a href="PLACE.php">PLACE</a>,
<a href="REVERBIT.php">REVERBIT</a>,
<a href="ROOM.php">ROOM</a>,
<a href="SROOM.php">SROOM</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
