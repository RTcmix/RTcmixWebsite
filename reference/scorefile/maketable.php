<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - maketable</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>maketable</B> - general purpose table-creation command
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>
table = <b>maketable</b>(<i>"table_type"</i>, [<i>"optional specifiers",</i>] <i>table_size</i>, <i>arg1</i>[, <i>arg2</i>, ... ])
<p>
Parameters inside the [brackets] are optional.
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>maketable</b> can be used
for direct RTcmix Instrument envelope, waveform  and other
control purposes.  It returns
a table 'handle' which can be stored in a scorefile variable.  This
'table-handle' can generally operate like other RTcmix scorefile variables,
i.e. it can be treated arithmetically, a single table can 
control multiple aspects of an Instrument (without the annoyance of
maintaining the correct makegen "table slot number"), and the syntax of
the <b>maketable</b> command is fairly transparent for
understanding how a particular table is employed in Instrument
control.
<P>
<b>maketable</b> was introduced in RTcmix version 4.0, and
you may encounter some very old scores that use the
outdated
<a href="old/makegen.php">makegen</a>
system.  Many RTcmix instruments
maintain backwards-compatibility with this older system, but support
for the use of
<a href="old/makegen.php">makegen</a>
constructs was dropped several years ago.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><a name="item_table_type" class="internallink"><i>table_type</i></A><BR>
<DD>
This string value (i.e. enclosed in "double quotes" in the scorefile)
determines the kind of table that will be constructed.  This specifier
thus dictates how the rest of the arguments will be interpreted.
Most of the older
<a href="old/makegen.php">makegen</a>
table-creation functions are subsumed by the <i>"table_type"</i>.
<p>
See
<a href="#TABLE_TYPES">below</a>
for a listing of current table-construction specifiers.
<P></P>
<DT><a name="item_optional_specifiers" class="internallink"><i>optional_specifiers</i></A><BR>
<DD>
These optional arguments determine global characteristics of how tables
are constructed and subsequently accessed.  Presently there are two
sets of string specifiers:
<ul>
	<li><i>"norm"/"nonorm"</i> -- this option determines whether or
	not the table will be normalized; with <i>"norm"</i> specified
	the table contents will be scaled to fit within the range 0.0 -- 1.0
	or -1.0 -- 1.0.  <i>"nonorm"</i> will turn off this scaling, allowing
	direct values to be specified when the table is constructed.
	<br>
	<br>
	<i>"norm"</i> is the default.
	<br>
	<br>
	<li><i>"interp"/"interp2"/"nointerp"</i> -- this option dictates
	how values will be read from the table.  <i>"interp"</i> enables
	simple first-order linear interpolation, i.e. if a requested
	table value lies between two elements in the table, setting
	<i>"interp"</i> will generate an intermediate value based upon
	a linear interpolation of nearest sample values.  For example,
	if the value at table location 314.15 were requested, the value
	returned would be 0.15 between the value at location 314 and the
	value at location 315.  <i>"interp2"</i>
	uses a spline-interpolation scheme that may be more accurate
	for many curves, but more costly in terms of computation
	required.  <i>"nointerp"</i> turns off interpolation; the values
	returned from the table will be 'rounded-down' (truncated) to the
	nearest-lowest point in the table.  For example, if the table value
	at location 149.78 were requested, the <i>"nointerp"</i> option
	would return the value stored at location 149.
	<p>
	<ul><i>NOTE:  For instruments that directly access certain table-types,
		like
		</i><a href="/reference/instruments/WAVETABLE.php">WAVETABLE</a>'s<i>
		employment of the waveform function table, the </i>interp_type<i>
		will probably be ignored because the instrument itself has
		coded how it will interpolate an oscillator waveform.</i>
	</ul>
	<p>
	<i>"interp"</i> is the default.
</ul>

<P></P>
<DT><a name="item_table_size" class="internallink"><i>table_size</i></A><BR>
<DD>
The size of the table: how many numbers it stores.  For most interpolated
tables, you can use 1000 or 2000 here.  You might want to use more or
less, depending on the specific purpose.  (For example, you might want
50 (and only 50) random numbers, so you would use the
<a href="#random">random</a>
table type and set the
table size to 50.)  There is no requirement that this size be a power
of two.
<P></P>
<DT><a name="item_arg1_arg2_etc" class="internallink"><i>arg1, arg2, ...</i></A><BR>
<DD>
Any number of arguments that define the table.  These depend on the
table type.  See documentation for each type below.
<P>Note that the number of arguments used to define the table is independent
of the table size.  So, depending on the table type, you can create
a table with a size of 2000 using only one or two arguments.</P>
<P></P></DL>
<P>

<hr>
<h2><a name="TABLE_TYPES" class="internallink">Table Types</a></h2>
<DL>
<DT><a name="textfile" class="internallink"><i>textfile</i></A><BR>
<DD>
Fill a table with numbers read from a text file.  The syntax is:
<ul>
<pre>
table = maketable("textfile", size, "filename")
</pre>
</ul>
The function loads as many as <i>size</i> numbers into the table.  If there
are not that many numbers in the text file, it zeros out the extra
table values.  The function reports one warning if at least one piece
of text (delimited by whitespace) cannot be interpreted as a double.
This means the file may contain any number of free text comments
interspersed with the numbers, as long as the comments themselves
do not contain numbers!
<p>
<i>filename</i> should be a string (i.e. enclosed in quotes).  The filename
can be a relative pathname to the directory where the scorefile was
invoked, or it may be an absolute pathname within the filesystem.
<p>
This replaces the older makegen function
<a href="old/gen2.php">gen 2</a>, except that it does not return
the length of the table created.  This can be retrieved using the
new
<a href="tablelen.php">tablelen</a> scorefile command.

<P></P>
<DT><a name="soundfile" class="internallink"><i>soundfile</i></A><BR>
<DD>
Fill a table with numbers read from a sound file.  The syntax is:
<ul>
<pre>
table = maketable("soundfile", size, "filename"[, duration[, inskip[, inchan]]])
</pre>
</ul>
The <i>size</i> argument is ignored; set it to zero.
<p>
<i>filename</i> is obligatory.  As with the filename argument for
the 
<a href="#textfile">textfile</a>
table, it is a string that can be a relative or an
absolute pathname to a soundfile.  All of the supported RTcmix soundfile
types can be read (aiff, wav, NeXT, bsd, etc.).
<p>
The other arguments are optional, but if an
argument further to the right is given, all the ones to its left must also
be given.  These optional arguments are:
<ul>
	<li><i>filename</i> -- the name of a sound file in any of the header
	types RTcmix can
	read; data formats: 16bit signed int, 32bit float, 24bit
	3-byte signed int; either endian.
	<br>
	<br>
	<li><i>duration</i> -- duration (in seconds) to read from file.
	If negative, its
	absolute value is the number of sample frames to read.
	If <i>duration</i> is missing, or if it's zero, then the whole
	file is read.  Beware with large files -- there is no check
	on memory consumption!
	<br>
	<br>
	<li><i>inskip</i> -- time (in seconds) to skip before reading,
	or if negative,
	its absolute value is the number of sample frames to skip.
	If <i>inskip</i> is missing, it's assumed to be zero.
	<br>
	<br>
	<li><i>inchan</i> -- channel number to read (with zero as first channel).
	If <i>inchan</i> is missing all channels are read, with samples
	from each frame interleaved.
</ul>
This replaces the older makegen function
<a href="old/gen1.php">gen 1</a>, except that it does not normalize
the sample values.  The arguments are slightly different also,
and this does not return the number of frames read.  The number of
samples in the table (not frames!) can be retrieved using the new
<a href="tablelen.php">tablelen</a> scorefile command.

<P></P>
<DT><a name="literal" class="internallink"><i>literal</i></A><BR>
<DD>
Fill a table with just the values specified as arguments.  The syntax is:
<ul>
<pre>
table = maketable("literal", "nonorm", size, n1, n2, n3, n4 ...)
</pre>
</ul>
<i>n1, n2, n3,</i> etc. are the numbers that go into the table.  The
"nonorm" tag is recommended, unless you want the numbers to be
normalized to [-1.0, 1.0] or [0.0, 1.0] (if no negative values are present).
<p>
The function loads as many as <i>size</i> numbers into the table.  If there
are not that many number arguments, it sets the extra table values to zero.
If <i>size</i> is zero, the table will be sized to fit the number arguments
exactly.  If one (or more) of the <i>n1, n2, ...</i> variables is
an array created in the scripting language, then the array will be
'unpacked' into the table sequentially.
<p>
This replaces the older makegen function
<a href="old/gen2.php">gen 2</a>, except that
it has the option to size the table to fit the number of arguments.
It also does not return the number of elements in the table.
This value can be retrieved using the new
<a href="tablelen.php">tablelen</a> scorefile command.

<P></P>
<DT><a name="datafile" class="internallink"><i>datafile</i></A><BR>
<DD>
Fill a table with numbers read from a data file.  The syntax is:
<ul>
<pre>
table = maketable("datafile", size, "filename"[, number_type])
</pre>
</ul>
The function loads as many as <i>size</i> numbers into the table.
This is very similar in function to the
<a href="#textfile">textfile</a>
table type discribed above, except that the file contains 'raw'
binary data, not text-formatted data.  If there
are not that many numbers in the file, it zeros out the extra table values.
If <i>size</i> is zero, the table will be sized to fit the data exactly.  Be
careful if you use this option with a very large file: you may run out
of memory!
<p>
<i>number_type</i> can be any of <i>"float"</i> (the default),
<i>"double", "int", "int64", "int32", "int16"</i> or <i>"byte"</i>.
This just means that with the
<i>"double"</i> type, for example, every 8 bytes will be interpreted as one
floating point number; with the <i>"int16"</i> type, every 2 bytes will be
interpreted as one integer; and so on.
<i>"int"</i> is <i>"int32"</i> on a 32-bit
platform and <i>"int64"</i> on a 64-bit platform.  No byte-swapping is done.
<p>
This replaces the older makegen function
<a href="old/gen3.php">gen 3</a>, except that
it has choices for the type of number, it has the option to
size the table to fit the data, and it does not return the number of
elements in the array.
This value can be retrieved using the new
<a href="tablelen.php">tablelen</a> scorefile command.

<P></P>
<DT><a name="curve" class="internallink"><i>curve</i></A><BR>
<DD>
Fill a table with line or curve segments, defined by
<time, value, curvature> arguments.  The syntax is:
<ul>
<pre>
table = maketable("curve", size, time1, value1, curvature1, 
   [ timeN-1, valueN-1, curvatureN-1, ] timeN, valueN)
</pre>
</ul>
<i>curvature</i> controls the curvature of the each line segment from 
<i>valueN</i> to <i>valueN+1</i> over the interval <i>timeN</i> to
<i>timeN+1</i>.  The values for <i>curvature</i> are:
<ul>
	<li><i>curvature = 0</i> -- makes a straight line
	<br>
	<br>
	<li><i>curvature < 0</i> -- makes a logarithmic (convex) curve;
		larger negative values make "sharper" curves
	<br>
	<br>
	<li><i>curvature > 0</i> -- makes a logarithmic (concave) curve;
		larger values make "sharper" curves
</ul>
The code was derived from <i>gen4</i> from the UCSD Carl package,
described in F.R. Moore, <i><u>Elements of Computer Music</i></u>.
<p>
This replaces the older makegen function
<a href="old/gen4.php">gen 4</a>.  Like gen 4, the time values specified
in the table are relative to the actual duration that the table is
being used.  If the duration is equal to the last time point in the
table, then the time values will align.  Otherwise the table will be
'stretched' or 'compressed' to function in the total duration it
is actually used.

<P></P>
<DT><a name="expbrk" class="internallink"><i>expbrk</i></A><BR>
<DD>
Fill a table using an exponential break-point function.
The syntax is:
<ul>
<pre>
table = maketable("expbrk", size, value1, npoints1, [ valueN-1, npointsN-1, ] valueN)
</pre>
</ul>
This table type fills the table with exponential line-segments
in the same way that the older makegen function
<a href="old/gen5.php">gen 5</a> did.  All values must be > 0.  The
<i>npointsN</i> arguments specify how many table elements are to
be used in constructing the curve from one value to the next.  All
of the <i>npointsN</i> values should probably add up to equal the
<i>size</i> of the table.  If the <i>npointsN</i> values are less
than the <i>size</i> of the table, then the last value will be
repeated to fill the remaining table elements.

<P></P>
<DT><a name="line" class="internallink"><i>line</i></A><BR>
<DD>
Create a function table comprising straight line segments, specified by
using any number of [time, value] pairs.  The syntax is:
<ul>
<pre>
table = maketable("line", size, time1, value1, [ timeN-1, valueN-1, ] timeN, valueN)
</pre>
</ul>
This is like the
<a href="#curve">curve</a>
syntax, except that straight
line-segments are used to interpolate values over the time between the
<i>valueN</i> points and the <i>curvature</i> values are therefore absent.
Values can cross 0, and can indeed be 0.  Times
will be scaled by actual duration of use.
<p>
This is nearly identical to several older makegen functions that
are heavily used in RTcmix,
<a href="old/gen6.php">gen 6</a>,
<a href="old/gen18.php">gen 18</a> and
<a href="old/gen24.php">gen 24</a>.
There are some subtle internal differences in the <i>line</i> table type
and these older makegen functions mainly having to do with how the final
point in the table is reached -- see the code if this is of concern.

<P></P>
<DT><a name="linebrk" class="internallink"><i>linebrk</i></A><BR>
<DD>
Fill a table using a linear break-point function.
The syntax is:
<ul>
<pre>
table = maketable("linebrk", size, value1, npoints1, [ valueN-1, npointsN-1, ] valueN)
</pre>
</ul>
This table type fills the table with straight line-segments.  The endpoints
of the line segments are defined by each <i>valueN</i> to
<i>valueN+1</i>arguments, and the 'length' is determined by each
<i>npointsN</i> argument between the two endpoints.  This is very similar
to how the
<a href="#expbrk">expbrk</a>
table type works, except (of course) that lines are used to 'connect the
dots' instead of exponential segments.  It is also identical in
functionality to the older makegen
<a href="old/gen7.php">gen 7</a>
function table routine.  Crossing 0 and values of 0 are permitted.
All of the <i>npointsN</i> values should probably add up to equal the
<i>size</i> of the table.  If the <i>npointsN</i> values are less
than the <i>size</i> of the table, then the last value will be
repeated to fill the remaining table elements.

<P></P>
<DT><a name="spline" class="internallink"><i>spline</i></A><BR>
<DD>
Fill a table with a spline curve, defined by at least three  [time, value]
points.
The curve travels smoothly between the points, and all points lie on the
curve.  The syntax is:
<ul>
<pre>
table = maketable("spline", size, ["closed",] curvature, time1, value1, 
   time2, value2, [ timeN-1, valueN-1, ] timeN, valueN)
</pre>
</ul>
The <i>curvature</i> argument controls the character of the slope
between points.  A value of 0 will produce a relatively 'flat' curve
connecting the points, higher values will produce more pronounced
curved excursions.
<p>
The optional specifier <i>"closed"</i> is another way of affecting
the curvature.
This interacts with the <i>curvature</i> value.  To see the resulting
shape of the curve, use the
<a href="plottable.php">plottable</a>
command.  Note that it is possible that the curve will loop outside of the
area you expect,
especially if the <i>"nonorm"</i> optional
specifier is used.
<p>
Adapted from <i>cspline</i> in the UCSD Carl package, 
described in F.R. Moore, <i><u>Elements of Computer Music</i></u>.

<P></P>
<DT><a name="wave3" class="internallink"><i>wave3</i></A><BR>
<DD>
Fill a table with one cycle of a waveform, composed of any number of
partials.  The partials are specified by a multiplier of the fundamental,
amplitude and phase.  The syntax is:
<ul>
<pre>
table = maketable("wave3", size, partial_multiplier1, amplitude1, phase1
   [, ... partial_multiplierN, amplitudeN, phaseN])
</pre>
</ul>
The <i>partial_multiplier</i> adds a component to the waveform being
constructed in the table.  The fundamental frequency that the
<i>partial_multiplier</i> uses for the multiplication is set so that
exactly one cycle of the fundamental will fit into the table.  The
<i>amplitude</i> and <i>phase</i> arguments that follow the
<i>partial_multiplier</i> then set the amplitude and phase
of that partial.  The <i>partial_multiplier</i> does not have
to be an integer (i.e. it can be fractional, like 1.78), but a
fractionally-specified component of the waveform will be truncated to
fit into the table determined by the basic fundamental frequency.
<p>
<i>amplitude</i> generally operates on a scale of 0.0 -- 1.0,
but values higher than 1.0 are allowed.  The default action will
rescale the resulting waveform to -1.0 -- 1.0.  Negative amplitudes
are also allowed, but this is identical to a positive amplitude with
a 180-degree phase shift.
<p>
The <i>phase</i> argument is in degrees, 0.0 -- 360.0.  Negative
phases and values > 360 are allowed, but they are equivalent to
corresponding phases between 0.0 -- 360.0.
<p>
What does all this mean?  For example, the following use
of <strong>maketable</strong>:
<ul>
<pre>
table = maketable("wave3", 1000, 1, 1, 0)
</pre>
</ul>
will create a single cyle of a sine wave (the fundamental frequency
multiplied by 1.0, relative amplitude of 1.0, and phase shift of 0.0)
and store it -- in digital form of course! -- in a 1000-point table.
Changing the above scorefile command to this:
<ul>
<pre>
table = maketable("wave3", 1000, 1, 1, 90)
</pre>
</ul>
will create a cosine wave -- the sine wave is shifted in phase by
90 degrees in the table.  This specification:
<ul>
<pre>
table = maketable("wave3", 1000, 2, 1, 0)
</pre>
</ul>
builds a waveform in the table that has two complete cycles of a sine
wave; the <i>partial_multiplier</i> causes a partial to be
built that is twice the fundamental frequency.  And the following:
<ul>
<pre>
table = maketable("wave3", 1000, 3.14, 1, 0)
</pre>
</ul>
will place exactly 3.14 cycles of a sine wave into the table.  These
specifications can be mixed:
<ul>
<pre>
table = maketable("wave3", 1000, 1, 1, 0, 2, 0.4, 90, 3.14, 0.01, 0)
</pre>
</ul>
creates a waveform with the fundamental at relative amplitude 1, the
second harmonic with an amplitude of 0.4 and a 90-degree phase shift,
and a part-component of 3.14 with an amplitude of 0.01 also included.
<p>
Most instruments that rely upon constructed wavetable 
(such as
<a href="/reference/instruments/WAVETABLE.php">WAVETABLE</a> or
<a href="/reference/instruments/FMINST.php">FMINST</a>)
in RTcmix 4.0
have been modified to include an optional parameter that will
allow the <strong>maketable</strong> waveform to be used.  If this
parameter is present, any makegen-constructed wavetables will be
ignored.
<p>
See the older makegen routine
<a href="old/gen9.php">gen 9</a>
for more examples of how this waveform-constructing scheme works, as
well as some plot images to show the effects of different
[partial, amplitude, phase] combinations.

<P></P>
<DT><a name="wave" class="internallink"><i>wave</i></A><BR>
<DD>
Fill a table with one cycle of a waveform, composed of any number of harmonic
partials.  The partials are specified by a positional parameter
corresponding to the relative amplitude of each partial included in the
waveform construction.
The syntax is:
<ul>
<pre>
table = maketable("wave", size, partial1_amp [, partial2_amp, ... , partialN_amp])
</pre>
</ul>
<ul>or</ul>
<ul>
<pre>
table = maketable("wave", size, "wave_string")
</pre>
</ul>
In the first use,
each <i>partialN_amp</i> relative amplitude will contribute the <i>Nth</i>
harmonic at the specified amplitude to the composite waveform stored
in the table.  The phase of each harmonic is 0.0.  Obviously non-harmonic
(non-integer multiples of the fundamental) partials are not specifiable.
<i>size</i> is the number of points allocated for the table.
<p>
For example:
<ul>
<pre>
table = maketable("wave", 2000, 1)
</pre>
</ul>
will build a 2000-element table containing a single cycle of a
sine wave (harmonic 1 at amplitude 1),
<ul>
<pre>
table = maketable("wave", 2000, 0, 0, 1)
</pre>
</ul>
will build a table containing three cycles of a sine wave (harmonic
3 at amplitude 1), and
<ul>
<pre>
table = maketable("wave", 2000, 1.0, 0.5, 0.1)
</pre>
</ul>
will create a composite waveform with the amplitudes 1.0, 0.5, and 0.1 of the
first, second and third harmonics (respectively).
<p>
The second use of the <i>wave</i> table type allows for specifying the
waveform to be constructed by name.  The following string values for
the <i>waveform_string</i> parameter are valid:
<ul>
<pre>
<i>"sine"</i>    -- create a sine waveform
<i>"saw"</i>     -- create a sawtooth wavefrom, going 'down' from 1.0 to -1.0
<i>"sawX"</i>    -- create a sawtooth waveform like <i>saw</i> using only the first <i>X</i> harmonics
<i>"sawdown"</i> -- create a sawtooth wavefrom, going 'down' from 1.0 to -1.0 (identical to <i>saw</i>)
<i>"sawup"</i>   -- create a sawtooth wavefrom, going 'up' from -1.0 to 1.0
<i>"square"</i>  -- create a square wavefrom
<i>"squareX"</i> -- create a square waveform like <i>square</i> using only the first <i>X</i> harmonics
<i>"tri"</i>     -- create a triangular wavefrom
<i>"triX"</i>    -- create a triangular waveform like <i>tri</i> using only the first <i>X</i> harmonics
<i>"buzz"</i>    -- create a pulse waveform
<i>"buzzX"</i>   -- create a pulse waveform like <i>pulse</i> using only the first <i>X</i> harmonics
</pre></ul>
<p>
If the second <i>waveform_string</i> specifying method is used
for the <i>wave</i> table type, the wavetable
values will be normalized to fit between +1.0 and -1.0
<p>
Similar to the way that the
<a href="#wave3">wave3</a>
table type works, the constructed table can be used by
instruments such as
<a href="/reference/instruments/WAVETABLE.php">WAVETABLE</a> or
<a href="/reference/instruments/FMINST.php">FMINST</a>).
In RTcmix 4.0, most of these 
have been modified to include an optional parameter that will
allow the <b>maketable</b> waveform to be used.  If this
parameter is present, any makegen-constructed wavetables will be
ignored.
<p>
The constructed wavetable will usually be used in its normalized
form, i.e. the waveform will travel between -1.0 and 1.0.
<p>
See the older makegen routine
<a href="old/gen10.php">gen 10</a>
for more examples of how this waveform-constructing scheme operates.

<P></P>
<DT><a name="cheby" class="internallink"><i>cheby</i></A><BR>
<DD>
Fill a table with a curve computed using
<a href="http://math.fullerton.edu/mathews/n2003/ChebyshevPolyMod.html">Chebyshev polynomials</a>.
These curves have the property that when used as a transfer function, the
polynomial coefficients determine the harmonic content of the resulting
signal for a given index value.  This is very useful for instruments
like
<a href="/reference/instruments/WAVESHAPE.php">WAVESHAPE</a>),
for it allows the used to specify the harmonics that will occur
in the output sound.
The syntax is:
<ul>
<pre>
table = maketable("cheby", size, index, harmonic1[, ... harmonicN])
</pre>
</ul>
The <i>harmonicN</i> arguments determine the relative amplitude of
that harmonic in the output spectrum when the table-lookup index is
at the value <i>index</i>.
<p>
Although this sounds complicated, it is actually very easy to use.
See the older makegen routine
<a href="old/gen17.php">gen 17</a>
for more explanation and examples of how to use Chebyshev polynomials
in waveshaping.  <i>"cheby"</i> is functionally equivalent to this
gen routine.

<P></P>
<DT><a name="random" class="internallink"><i>random</i></A><BR>
<DD>
Fill a table with random (pseudorandom) numbers.  The syntax
(with one exception) is:
<ul>
<pre>
table = maketable("random", size, type, min, max[, seed])
</pre>
</ul>
The random numbers filling the table will be between the <i>min</i>
value and the <i>max</i> value.  Both of these are required arguments.
The table can be filled with random numbers using different
random-number distributions, as specified by the <i>type</i>.
The different <i>types</i> are (either the string specifiers
or the numeric specifiers may be used):
<ul>
	<li><i>0/"even"/"linear"</i> -- randomly select numbers between
		<i>min</i> and <i>max</i>.
	<br>
	<br>
	<li><i>1/"low"</i> -- randomly select numbers between
		<i>min</i> and <i>max</i>, but with a higher probability
		of choosing numbers nearer the <i>min</i> value.
	<br>
	<br>
	<li><i>2/"high"</i> -- randomly select numbers between
		<i>min</i> and <i>max</i>, but with a higher probability
		of choosing numbers nearer the <i>max</i> value.
	<br>
	<br>
	<li><i>3/"triangle"</i> -- randomly select numbers between
		<i>min</i> and <i>max</i>, but with the probability of
		choosing a value determined by a triangular curve with the
		apex at the midpoint between the <i>min</i> and <i>max</i>
		values.  In other words, numbers near either <i>min</i> or
		<i>max</i> will have a very low probability of being in the
		table, but numbers half-way between will have a high
		probability of being chosen.
	<br>
	<br>
	<li><i>4/"gaussian"</i> -- randomly select numbers between
		<i>min</i> and <i>max</i>, but with the probability of
		choosing a value determined using a
<a href="http://mathworld.wolfram.com/NormalDistribution.html">Gaussian</a>
		('normal'; 'bell curve') probability distribution with the
		apex at the midpoint between the <i>min</i> and <i>max</i>
		values.  Similar to how the <i>"triangle"</i> specifier operates.
	<br>
	<br>
	<li><i>5/"cauchy"</i> -- randomly select numbers between
		<i>min</i> and <i>max</i>, but with the probability of
		choosing a value determined using a
<a href="http://www.itl.nist.gov/div898/handbook/eda/section3/eda3663.htm">Cauchy</a>
		function with the
		apex at the midpoint between the <i>min</i> and <i>max</i>
		values.  Similar to how the <i>"triangle"</i> and <i>"gaussian"</i>
		specifiers operate.
	<br>
	<br>
	<li><i>6/"prob"</i> -- Mara Helmuth's configurable probability
		distribution.  This has a slightly different syntax:
<ul>
<pre>
table = maketable("random", size, "prob", min, max, mid, tight[, seed])
</pre>
</ul>
<ul>
		<i>min</i> and <i>max</i> set the range within which the
		random numbers fall, as before.  <i>mid</i> sets the mid-point
		of the range, which is used when <i>tight</i> is not 1.
		<i>tight</i> governs the degree to which the random numbers
		adhere either to the mid-point set by <i>mid</i> or to
		the extremes of the range set by <i>min</i> and <i>max</i>:
<pre>
tight         effect
---------------------------------------------------------------
0             only the <i>min</i> and <i>max</i> values appear
1             even distribution
> 1           numbers cluster ever more tightly around <i>mid</i>
100           almost all numbers are equal to <i>mid</i>
</pre>
</ul>
<br>
For all of the above, if the optional <i>seed</i> argument is 0, then
the 'seed' for the psuedorandom number algorithm comes from the microsecond
system clock, otherwise the value of <i>seed</i>
is used as the 'seed'.  Different <i>seed</i> values will generate
different sequences of random numbers.
If no <i>seed</i> argument is present, the 'seed' used is 1.
<p>
Note that if you don't give the <i>"nonorm"</i> optional specifier
argument after <i>"random"</i>, then the
table will be normalized, thus disregarding your <i>min</i> and
<i>max</i> values.
<p>
This table type is similar in function to the older makegen routine
<a href="old/gen20.php">gen 20</a>.
The original version of <i>gen 20</i> was written by Luke Dubois;
later additions and this adaptation by John Gibson.  Some distribution
equations were adapted from Dodge and Jerse, <i><u>Computer Music</i></u>.

<P></P>
<DT><a name="window" class="internallink"><i>window</i></A><BR>
<DD>
Fill a table using a
<a href="http://en.wikipedia.org/wiki/Window_function/">window</a>
function curve.  The syntax is:
<ul>
<pre>
table = maketable("window", size, type)
</pre>
</ul>
Window functions are used for many signal-processing operations.  Using
this <b>maketable</b>, two common window types can be constructed.  The
<i>type</i> specifier determines the kind of window function to use:
<ul>
	<li><i>1/"hanning"</i> -- this will build a
	<a href="http://www.mathworks.com/access/helpdesk/help/toolbox/signal/hann.html">hanning</a>
	window function in the table.
	<br>
	<br>
	<li><i>2/"hamming"</i> -- this will build a
	<a href="http://www.mathworks.com/access/helpdesk/help/toolbox/signal/hamming.html">hamming</a>
	window function in the table.
</ul>
Either the numeric specifier or the string specifier may be used.
This table type is similar in function to the older makegen routine
<a href="old/gen25.php">gen 25</a>.


<P></P></DL>
<P>
<HR>
<h3>Examples</h3>
<PRE>
   ampenv = maketable("line", 1000, 0,0, 1,1)
</pre>
<P>The <i>ampenv</i> table-handle variable will reference a table
containing a straight line from 0 to 1; the table will
have 1000 elements.</P>
<PRE>
   wave = maketable("wave", "nonorm", 2000, 0.5)</PRE>
<P>The <i>wave</i> table-handle variable will reference a table
containing a sine wave at half amplitude, ranging from
-0.5 to 0.5.  The <i>"nonorm"</i> optional specifier prevents the
table from being normalized (scaled to fall between -1 and 1).  The table
will have 2000 elements.</P>
<p>
The following score shows how the table-handle can be used arithmetically
to operate upon other parameters in an instrument (in this case the
<a href="/reference/instruments/WAVETABLE.php">WAVETABLE</a>
instrument):
<pre>
   env = maketable("line", 1000, 0,0, 1,1, 3,1, 4,0)
   penv = maketable("line", 1000, 0,1, 1,1, 2,2, 3,2, 8,.15)
   vib = maketable("wave3", "nonorm", 1000, 4.0*10, 4, 0)
   pan = maketable("line", 100, 0,0, 1,1, 2,0.5)
   wavt = maketable("wave", 4000, 1, 0.5, 0.3, 0.2, 0.1, 0.1)

   WAVETABLE(0, 4.0, 20000 * env, (440.0 * penv) + vib, pan, wavt)
</pre>
<P>

<HR>
<h3>NOTES</h3>
<p>
The table-handle variables can be re-used during score parsing, i.e.
<pre>
   for (st = 0; st < 10; st = st+1) {
      amp = maketable("curve", 1000, 0, 0, -2.0,  2.5, 1, 1.4, 3.5, 0)
      wave = maketable("wave", 1000, random(), random(), random())
      WAVETABLE(st, 3.5, 10000 * amp, irand(100.0, 1000.0), random(), wave)
   }
</pre>
Be aware, though that
memory for these tables is allocated for each use.  This is a potential
small memory leak for algorthmic processes that define a large number of
new tables over a long period of time.
<P>


<HR>
<h3>See Also</h3>
<p>
<a href="makeconnection.php">makeconnection</a>,
<a href="makemonitor.php">makemonitor</a>,
<a href="modtable.php">modtable</a>,
<a href="makefilter.php">makefilter</a>,
<a href="makeconverter.php">makeconverter</a>,
<a href="tablelen.php">tablelen</a>,
<a href="copytable.php">copytable</a>,
<a href="samptable.php">samptable</a>,
<a href="dumptable.php">dumptable</a>,
<a href="plottable.php">plottable</a>,
<a href="mul.php">mul</a>,
<a href="div.php">div</a>,
<a href="sub.php">sub</a>,
<a href="add.php">add</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

