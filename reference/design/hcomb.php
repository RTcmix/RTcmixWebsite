<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - hcomb</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>hcomb</h3>
<i>interpolating comb filter</i>
<br>
<br>

<h3>Synopsis</h3>
<UL>
     #include &lt;ugens.h&gt;<BR>
<BR>
     float hcomb(sample,array)<BR>
     float sample, *array;<BR>
<BR>
     hcmbst(&loopt,&xinit,&array,&sr)<BR>
     float loopt,*array,sr,xinit;<BR>
<BR></UL>
<h3>Description</h3>

    <B>hcomb()</B> is a feedback loop which will store and feedback the
     signal continuously. Older inputs will decay over a specified reverberation time.  Any frequencies in the input signal whose length in samples is close to an integral number
     of the number of samples in the loop will be resonated since
     there will be less cancellation.  This represents an
     improvement over
<A HREF="comb.php">comb</A>
in that the quantization of looptime
     as it becomes shorter due to the integer sample length of
     the loop is compensated for so that it may be precisely
     tuned, even up to Nyquist.  This loop must first be initialized with a call to <B>hcombset()</B>. which intializes an array for
     use with an <B>hcomb()</B>  filter. Note that this is a fortran sub-
     routine and thus must contain arguments passed by address,
     and the underscore following its name.
<P>
     <i>loopt</i> is equal to 1/hz and <i>array</i> must be dimensioned at
     (loopt * sr + 9).
<ul>
<i>[note:  it's not clear that the <b>hcmbset</b> function actually
exists....]</i>
</ul>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
