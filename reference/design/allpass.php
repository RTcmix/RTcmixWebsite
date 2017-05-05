<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - allpass/comb/combset</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>allpass/comb/combset</h3>
<i>short feedback delay lines</i>
<br>
<br>

<ul>
<i>[note:  </i><b>comb</b><i> and </i><b>combset</b><i>
are older comb filter unit-generators.  They have
been generally superceded by the
<a href="Ocomb.php">Ocomb</a>
and
<a href="Ocombi.php">Ocombi</a>
objects.]</i>
</ul>

<h3>Synopsis</h3>
<UL>
     #include &lt;ugens.h&gt;<BR>
<BR>
     float comb(sample,array)<BR>
     float sample, *array;<BR>
<BR>

     float allpass(sample,array)<BR>
     float sample, *array;<BR>
<BR>

     float combset(loopt,reverbtime,init,array)<BR>
     float loopt,reverbtime,*array;<BR>
<BR></UL>
<h3>Description</h3>

     This is a feedback loop which will store and feedback the
     signal continuously. Older inputs will decay over a specified reverberation time.  Any frequencies in the input signal whose length in samples is close to an integral multiple
     of the number of samples in the loop will be resonated since
     there will be less cancellation.  This loop must first be
     initialized with a call to <B>combset()</B>. which intializes an
     array for use with a <B>comb()</B> or an  <B>allpass() </B>filter.<P>

    <B> Loopt </B>is 1/hz, which is set to the 'fundamental' of the
     comb.  The number of samples in the loop is <B>loopt *
     samplingrate.</B><P>

    <B>Reverbtime</B> is the length of time old samples take to decay
     60 db.<P>

    <B> init </B> is a flag which, if FALSE, forces the loop to be filled
     with zeroes.  Setting <B>init</B> to TRUE will cause the contents
     of the array loop to be unaltered.  Note that this will contain garbage unless it has been previously used by another
     filter.<P>

     <B>Array </B>is the address of a floating point array which must be
     dimensioned to 2+number_of_samples_in_loop, which is found
     by loopt*sampling_rate.<P>

     <B>allpass()</B> is initialized in the same way as the comb filter
     but has a feature which cancels the frequency response of
     the filter and theoretically passes all frequencies at equal
     amplitude.
<ul>
<i>[note:  Because of the integer length of the delay-line
used, <b>comb</b> will not accurately reproduce higher frequencies
(the short delay-length will 'quantize' the frequency resolution).
For an accurate high-frequency comb, use the
<a href="hcomb.php">hcomb</a>
comb filter.]</i>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
