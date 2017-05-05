<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - Offt</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>Offt</h3>
<i>INSTRUMENT design -- Fast Fourier Transform (FFT) object
</i>
<br>
<br>
<b>Offt</b> is a utility object that encapsulates several
Fast Fourier Transform (FFT) operations for use by RTcmix instruments.
These include the allocation of a buffer for the transformation 
of samples as well as functions to perform a forward- (real-to-complex)
or backward- (complex-to-real; inverse) transform on the data in
the buffer.
<p>
Using the <b>Offt</b> object requires a little basic knowledge
of how the Fast Fourier Transform operates.  Julius O. Smith has
a
<a href="http://ccrma.stanford.edu/~jos/mdft/Fast_Fourier_Transform_FFT.php#18450">good math tutorial</a>
about the FFT, and the
<a href="http://www.fftw.org/">FFTW page</a>
is probably the best source of FFT information currently on the web.
<p>
The specific FFT code used by the <b>Offt</b> object depends
upon how RTcmix was compiled.  The default compilation uses
older code written by Laurent de Soras (available at
<a href="http://musicdsp.org/">musicdsp.org</a>
and other places).  If RTcmix was compiled using the "--with-fftw"
flag during configuration, then the
<a href="http://www.fftw.org/">FFTW v. 3</a>
library is used. <i>[note:  the FFTW library needs to be compiled with the
"--enable-float" flag to work in this object.]</i>
<hr>
<h3>Constructors</h3>
<ul>
<b>Offt(</b><i>int fftsize[, unsigned int flags]</i><b>)</b>
<br>
<br>
<dd>
<u><i>fftsize</i></u> is the length of the buffer used by <b>Offt</b> to
communicate data in and out of the object.  Note that the
number of FFT points will be half the size of the buffer.  This
is because the FFT operation is done 'in place' and the buffer is used
to hold two values for each FFT data point.  The <i>fftsize</i> should
be a power of 2.
<br>
<u><i>flags</i></u> is an optional parameter for use with the
FFTW library.  It should be set to the token <i>kRealToComplex</i>
or <i>kComplexToReal</i> depending upon whether a forwards or
inverse FFT is desired.  Both flags may be set simultaneously
if both forward and inverse FFTs will be performed on the buffer.
These flags are defined in RTcmix/genlib/Offt.h as:
<pre>
   enum {
      kRealToComplex = 1,
      kComplexToReal = 2
   };
</pre>

</dd>
<br>
<br>
</ul>

<hr>
<h3>Access Methods</h3>
<ul>

<b>float* Offt::getbuf()</b>
<br>
<br>
<dd>
returns a pointer to the buffer used by <b>Offt</b> for the transform.
This buffer is used both as a holder for sound samples going
"in" to the FFT and coming "out" of the FFT.  It is also used
to hold spectral information once the FFT has been performed on
incoming sound samples.
</dd>

<br>
<br>
<b>void Offt::r2c()</b>
<br>
<br>
<dd>
takes a buffer filled with <i>fftsize</i> (set in the
constructor) real-valued
samples (i.e. time-domain sound samples) and transforms it into
<i>fftsize</i>/2 complex numbers, expressed as pairs
of consecutive floats representing the real and imaginary
parts of the frequencies that are integer multiples of the
fundamental analysis frequency.  These values
in the range [0, Nyquist) -- that
is, up to, but not including Nyquist.  The real parts have even
indices into the buffer; the imaginary parts have odd indices.  The one
wrinkle is that what would be the imaginary portion of 0 Hz -- in
other words buf[1] -- is replaced by the real value of Nyquist.
So the imaginary parts of DC and Nyquist are missing.  (This is
the same format used in earlier cmix FFT routines.)
<b>r2c()</b> is also referred to as the "forward" FFT.
The values in the buffer may be accessed using the <b>getbuf()</b>
method described above.
</dd>

<br>
<br>
<b>void Offt::c2r()</b>
<br>
<br>
<dd>
takes a buffer filled with <i>fftsize</i>/2 complex numbers
representing the spectrum of a signal and transforms it
into a buffer filled with <i>fftsize</i> real-valued sound
samples.  This is the inverse of the <b>r2c()</b> operation
described above, and is in fact often called the "inverse"
FFT.  The values in the buffer may be accessed using the <b>getbuf()</b>
method described above.
</dd>

</ul>
<br>
<hr><h3>Examples</h3>
<ul>
<pre>
#include &lt;Ougens.h&gt;

Offt *theFFT;
int fftsize;
float *fftbuf;

int MYINSTRUMENT::init(float p[], int n_args)
{

	...

	fftsize = 1024;
	theFFT = new Offt(fftsize);
	fftbuf = theFFT->getbuf();

	...

}

int MYINSTRUMENT::run()
{
	float out[2];
	int i;

	...

	// let's assume RTBUFSAMPS is equal to fftsize for this example
	// the best way to deal with fftbuf vs RTBUFSAMPS diffs is to
	// use the Obucket object
	for (i = 0; i < framesToRun(); i++) // read 'em in
	{
		fftbuf[i] = someSampleGeneratingProcess();
	}

	theFFT->r2c();
	// now do weird stuff to the buffer...
	...
	theFFT->c2r();

	for (i = 0; i < framesToRun(); i++)  // write 'em out
	{
		out[0] = fftbuf[i];
		rtaddout(out);
		increment);
	}

	...

}
</pre>
</ul>

<br>
<hr><h3>See Also</h3>
<ul>
<a href="Obucket.php">Obucket</a>
</ul>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
