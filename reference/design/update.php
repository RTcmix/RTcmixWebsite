<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - update</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<h3>update</h3>
<i>INSTRUMENT design -- retrieve PField values during sample computation</i>
<br>
<br>
The <b>update()</b> function is used to read data coming from
a
<a href="../interface/PField.php">PField</a>
variable or a table-handle
(see the
<a href="/reference/scorefile/maketable.php">maketable</a>
scorefile command) into an instrument.  Typically
<b>update()</b> is called in the <i>INSTRUMENT::run()</i>
member function inside the sample-computation loop.
It is usually placed within a conditional structure so
that it gets called at the reset rate set by the
<a href="/reference/scorefile/reset.php">reset</a>
scorefile command.
<p>
<b>update()</b> is new in RTcmix4.0, and is the mechanism
that allows Instrument parameters to be altered as a note is
being played.  See the source code for various instruments for
examples of how this function is employed.
<hr><h3>Usage</h3>
<ul>
<b>int update(</b><i>double p[], int nvalues</i><b>)</b>
<br>
<b>int update(</b><i>double p[], int nvalues, unsigned fields</i><b>)</b>
<br>
<br>
<dd>
<u><i>p[]</i></u> is an array of doubles that will be filled with
values coming from a PField variable or table-handle.  For example,
if the following scorefile invoked an Instrument note:
<ul>
<pre>
handle = maketable(...)
INSTRUMENT(0.0, 1.0, 2.0, handle, 4.0, ...)
</pre>
</ul>
then any data being changed through the variable <i>handle</i> when
the note was being executed would
appear as element 4 (<i>p[3]</i>) in the <i>p[]</i> array.
<br>
<u><i>nvalues</i></u> is the total number of values that will be scanned
into the <i>p[]</i> array.  Note that <i>p[]</i> has to be dimensioned
large enough to accommodate <i>nvalues</i>.
<br>
<u><i>fields</i></u> is an optional parameter (actually set to "0" if
it isn't present) that represents a bitmask to retrieve only specific
values into the <i>p[]</i> array.  In the example above, if the call
to <b>update()</b> in the Instrument was:
<ul>
<pre>
double p[5];
kp3 = 1 << 3;
update(p[], 5, kp3);
</pre>
</ul>
then only <i>p[3]</i> would be updated.  This results in an increase in
Instrument efficiency.  Note that only 31 bits are possible with this
scheme, however, so that the bitmask only supports the first 31 p-fields.
<p>
These versions of <b>update()</b> always returns 0 for some reason.
</dd>

<br>
<b>double update(</b><i>int index</i><b>)</b>
<br>
<b>double update(</b><i>int index, int totframes</i><b>)</b>
<br>
<br>
<dd>
<u><i>index</i></u> is the index of the p-field to retrieve.  If
<i>index</i> is 2, for example, then the current value for <i>p[2]</i>
will be returned as a double.
<br>
<u><i>totframes</i></u> is an optional argument
representing the total number of sample frames over
which this <b>update</b> will operate.  This is useful for tables
(control envelopes) that are intended only to span a portion of
an executing note.  An example of this might be a table to perform
a fade-out during the 'ring-down' portion of an Instrument employing
a feedback delay line.
<p>
To put it another way,
calling this version of <b>update</b> with the optional
<i>totframes</i> argument makes the pfield span the duration
corresponding to
<i>totframes</i> instead of
<a href="Instrument.php#nSamps">nSamps()</a>.
Note that it's much more efficient to grab
all the pfields using the first update method than to use this update method
multiple times, so try to avoid this method when you can use the other one.
</dd>


</ul>
<br>
<hr><h3>Examples</h3>
<ul>
<pre>
#include &lt;Instrument.h&gt;

int MYINSTRUMENT::init(float p[], int n_args)
{
	// assumes p[4] can be updated dynamically through a PField variable

	...

   branch = 0; // a MYINSTRUMENT class variable

	...
}

int MYINSTRUMENT::run()
{
   ...

   for (int i = 0; i < framesToRun(); i++) {
      if(--branch <= 0) {
         double p[7];
         update(p, 7); // 7 total values we're retrieving
         theparameter = p[4]; // possibly a new value
         branch = getSkip(); // so that we don't get called every sample
                             // getSkip() returns the number of samples
                             // for one cycle of the control rate
       }

   ...
   }
   ...
}

</pre>
</ul>
<br>
<hr><h3>See Also</h3>
<ul>
<li><a href="Instrument.php">Instrument</a>
</ul>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
