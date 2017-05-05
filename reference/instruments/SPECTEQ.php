<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - SPECTEQ</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>SPECTEQ</b> -- FFT-based EQ
<br>
<i>in RTcmix/insts/jg/SPECTACLE</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>SPECTEQ</b>(outsk, insk, dur, amp, ringdowndur, fftsize, windowsize, windowtype, overlap[, inputchan, pan])
	<ul>
   This instrument has no pfield-enabled parameters.
   Parameters after the [bracket] are optional and
   default to 0 unless otherwise noted.
   </ul>
	<hr>
	<br>

NOTE:  This is an older RTcmix instrument, the newer
<a href="SPECTEQ2.php">SPECTEQ2</a>
instrument is probably better to use.
<br>
<br>
<br>

<pre>
   p0  = output start time (seconds)
   p1  = input start time (seconds)
   p2  = input duration (seconds)
   p3  = amplitude multiplier (relative multiplier of input signal)
   p4  = ring-down duration (seconds, can be 0)
   p5  = FFT length (samples, power of 2, usually 1024)
   p6  = window length (samplse, power of 2, usually FFT length * 2)
   p7  = window type (0: Hamming, 1: Hanning, 2: Rectangle, 3: Triangle, 4: Blackman, 5: Kaiser)
   p8  = overlap - how much FFT windows overlap (samples, any power of 2)
         1: no overlap, 2: hopsize=FFTlen/2, 4: hopsize=FFTlen/4, etc.
         2 or 4 is usually fine; 1 is fluttery; the higher the more CPU time
   p9  = input channel [optional, default is 0]
   p10 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]


   Because this instrument has not been updated for pfield control,
   the older <a href="/reference/scorefile/makegen.php">makegen</a> control envelope sysystem should be used:

   Function table 1 is the input amplitude, spanning just the input duration.
   Function table 2 is the output amplitude, spanning the entire note, including ring-down duration.
   Function table 3 is the EQ table (i.e., amplitude scaling of each band),
      in dB (0 dB means no change, + dB boost, - dB cut).

   Author:  John Gibson
</pre>
<br>
<hr>
<br>


<b>SPECTEQ</b> is an FFT-based EQ/filter,
part of the
<a href="SPECTACLE.php">SPECTACLE</a>
family of fft-based fun things.
<p>
NOTE:  This is an older RTcmix instrument, the newer
<a href="SPECTEQ2.php">SPECTEQ2</a>
instrument is probably better to use.

<h3>Usage Notes</h3>

<b>SPECTEQ</b> allows you to directly control the amplitude of
each band of an FFT analysis, thus giving you control over the shape
of the resynthesized spectrum.  This is a very powerful EQ/filter
tool.
<p>
The parameters are very similar to the
<a href="SPECTACLE.php">SPECTACLE</a>
instrument, see the
<a href="SPECTACLE.php#usage_notes">SPECTACLE Usage Notes</a>
for more information.
<p>
The main thing is to set up function table 3 as the EQ curve.
Think of it as an x-axis map of all the frequency bands of the FFT.
The y values are then the amount of boost or cut for each FFT band
(in relative dB -- 0 dB means no change, + dB boost, - dB cut).
<p>
<b>SPECTEQ</b> can produce either mono or stereo output.

<h3>Sample Scores</h3>

very basic:
<pre>
   rtsetparams(44100, 2)
   load("SPECTEQ")
   
   rtinput("mysound.snd")
   
   inchan = 0
   inskip = 0
   indur = DUR()
   ringdur = 0
   amp = 5
   fftlen = 1024           /* yielding 512 frequency bands */
   winlen = fftlen * 2     /* the standard window length is twice FFT size */
   overlap = 2             /* 2 hops per fftlen (4 per window) */
   wintype = 0             /* use Hamming window */

   /* input envelope (covering <indur>) */
   makegen(1, 18, 1000, 0,0, 1,1, 19,1, 20,0)

   /* output envelope (covering <indur> + <ringdur>) */
   copygen(2, 1)

   nyquist = SR()/2
   /* EQ curve: -90 dB at 0 Hz, ramping up to -10 dB at 400 Hz, etc. */
   makegen(3, 18, nyquist/10,
          0,   -90,
        300,   -90,
        400,   -10,
        800,   -20,
       1000,   -90,
       2000,   -90,
       5000,   0,
    nyquist,   -40)

   /* do it for the left chan! */
   start = 0
   SPECTEQ(start, inskip, indur, amp, ringdur, fftlen, winlen, wintype, overlap, inchan, pctleft=1)

   /* do it for the right chan! */
   SPECTEQ(start, inskip, indur, amp, ringdur, fftlen, winlen, wintype, overlap, inchan, pctleft=0)
</pre>
<br>

<hr>
<h3>See Also</h3>

<a href="CONVOLVE1.php">CONVOLVE1</a>,
<a href="LPCPLAY.php">LPCPLAY</a>,
<a href="PVOC.php">PVOC</a>,
<a href="SPECTACLE.php">SPECTACLE</a>,
<a href="SPECTACLE2.php">SPECTACLE2</a>,
<a href="SPECTEQ2.php">SPECTEQ2</a>,
<a href="TVSPECTACLE.php">TVSPECTACLE</a>,
<a href="VOCODE2.php">VOCODE2</a>,
<a href="VOCODE3.php">VOCODE3</a>,
<a href="VOCODESYNTH.php">VOCODESYNTH</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>


