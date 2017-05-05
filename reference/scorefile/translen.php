<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - translen</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>translen</b> - return the projected duration of a transposed (interpolated) sound
</P>
<P>


<HR>
<h3>Synopsis</h3>
val = <b>translen</b>(<i>original_length, tranposition_interval</i>)
<P>


<HR>
<h3>Description</h3>
<P>
<b>translen</b> returns the duration of a transposed (pitch-shifting
via interpolation -- see the
<a href="/reference/instruments/TRANS.php">TRANS</a> or
<a href="/reference/instruments/TRANS3.php">TRANS3</a>
instruments) sound given the <i>original_length</i> (in seconds)
and <i>transposition_interval</i> (in octave.pitch-class
notation -- i.e. -0.07
will shift downwards by a perfect fifth).
<p>
For example, if you transpose a sound down an octave (-1.00) with
<a href="/reference/instruments/TRANS.php">TRANS</a>,
it will create two seconds of output for every one second
of input.  The duration that you pass to
<a href="/reference/instruments/TRANS.php">TRANS</a>
is the duration
of the output.  You use <b>translen</b> if you want to consume a
particular duration of the input sound, regardless of the duration
of the resulting output.  Say you had a one-second recording of
someone saying "RTcmix rocks!"  If you want to transpose this down
an octave, you could do it two ways:
<p>
<pre>
   duration = 1
   TRANS(start, inskip, duration, amp, transp)
</pre>
<p>
...or...
<p>
<pre>
   duration = 1
   TRANS(start, inskip, translen(duration, transp), amp, transp)
</pre>
<p>
The first example would give you one second of output, but it would 
truncate the sentence in the middle, after a half second of sound
is consumed.  The second example gives you the entire sentence, with
the <b>translen</b> call telling
<a href="/reference/instruments/TRANS.php">TRANS</a>
to run for two seconds
in order to consume the entire input sound.
<p>
If you were to transpose the sound up an octave instead, then passing
a duration of one to
<a href="/reference/instruments/TRANS.php">TRANS</a>
would give you a one-second sound,
but the second half of that sound would be silent, since it takes only
a half second to play the entire sentence when transposed up an octave.
Using <b>translen</b> here with a one-second duration argument would
cause
<a href="/reference/instruments/TRANS.php">TRANS</a>
to run for a half second, ensuring that any envelope
table will span the sentence, rather than having the sentence end in
the middle of the envelope, causing a click.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><A NAME="original_length"><i>original_length</i></A><BR>
<DD>
The original (untransposed) length in seconds of the input sound.
<P></P></DL>
<DL>
<DT><A NAME="tranposition_interval"><i>tranposition_interval</i></A><BR>
<DD>
The amount of transposition in octave.pitch-class notation
(see the
<a href="pchcps.php">pchcps</a>
convertor for an explanation of this notation).
<P></P></DL>

<HR>
<h3>Examples</h3>
<pre>
   newlength = translen(7.8, -0.05)
</pre>
(and see the
<a href="#DESCRIPTION">DESCRIPTION</a>
section above for additional examples.)
<P>


<HR>
<h3>See Also</h3>
<p>
<A HREF="DUR.php">DUR</A>,
<A HREF="filedur.php">filedur</A>,
<a href="/reference/instruments/TRANS.php">TRANS</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

