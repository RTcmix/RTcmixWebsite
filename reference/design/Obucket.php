<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - Obucket</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>Obucket</h3>
<i>INSTRUMENT design -- arbitrary buffering object
</i>
<br>
<br>
The <b>Obucket</b> object keeps a private buffer of floating-point
numbers, and a 'call-back' function can be registered that will be
invoked when the buffer is filled.  One floating-point number at a
time can be added to the internal buffer, and when <b>Obucket</b>
sees that the buffer is full, it calls the 'call-back'
function with the buffer, its length and a user-supplied context
as arguments.  This
is useful for instruments that must process in blocks whose size has no
clear and predictable relationship to the RTcmix buffer size (for example,
instruments that do FFT-based processing).
<hr>
<h3>Constructors</h3>
<ul>
<b>Obucket(</b><i>int len, ProcessFunction callback, void *context</i><b>)</b>
<br>
<br>
<dd>
<u><i>len</i></u> is the length of the buffer used by <b>Obucket</b>.
<br>
<u><i>callback</i></u> is the function to be called when the buffer is
filled.  <i>ProcessFunction</i> is defined as follows:
<pre>
   typedef void (*ProcessFunction)(const float *buf, const int len,
                                                     void *context);
</pre>
<u><i>context</i></u> is a pointer to any user-created data that
the <i>callback</i> needs to function properly.
</dd>
<br>
<br>
</ul>

<hr>
<h3>Access Methods</h3>
<ul>

<b>bool Obucket::drop(</b><i>float item</i><b>)</b>
<br>
<br>
<dd>
puts <i>item</i> into the internal private buffer.  If the buffer is
then made full, it invokes the <i>ProcessFunction</i> callback
defined in the constructor and returns TRUE, otherwise it store the
<i>item</i> and returns FALSE.  It will also reset the internal
pointer to the beginning of the buffer so that the whole process
of filling may be repeated.  Typically <i>item</i> will be a sound
sample.
</dd>

<br>
<br>
<b>void Obucket::flush(</b><i>float defaultval</i><b>)</b>
<br>
<br>
<dd>
fills the entire internal private buffer with <i>defaultval</i>
and resets the internal buffer pointer to the beginning of the buffer.
If <i>defaultval</i> is not given, then 0.0 is used.
</dd>

<br>
<br>
<b>void Obucket::clear(</b><i>float defaultval</i><b>)</b>
<br>
<br>
<dd>
fills the entire internal private buffer with <i>defaultval</i> but
does not reset the internal buffer pointer to the beginning of the buffer.
If <i>defaultval</i> is not given, then 0.0 is used.
</dd>

</ul>
<br>
<hr><h3>Examples</h3>
<ul>
<pre>
#include &lt;Ougens.h&gt;

Obucket *theBucket;

// the following function would be defined to operate on the buffer
// passed in by theBucket.
// It's best to do this as a member function of the MYINSTRUMENT
// object, but in that case it needs a static member function
// wrapper.  See the source code for CONVOLVE1.cpp (in RTcmix/insts/jg)
// for how this works.
void dostuff(const float buf[], const int len, void *obj);

int MYINSTRUMENT::init(float p[], int n_args)
{

	...

	theBucket = new Obucket(nelements, dostuff, (void *) this);

	...

}

int MYINSTRUMENT::run()
{
	float out[2];
	float sample;

	...

	for (i = 0; i < framesToRun(); i++)
	{
		sample = someSampleGeneratingProcess();
		theBucket->drop(sample);
	}

	...

}
</pre>
</ul>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
