<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - resonz/rszset</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>resonz/rszset</h3>
<i>simple biquad IIR filter and initialization</i>
<br>
<br>
<i>[note:  This is older code, although it should work fine.  There are
many more filter programs to be found in the "objlib" (in the insts.jg
package) and "stklib" (in the insts.stk package) that implement a much
wider range of filter types.  Also see the instruments based on
these filters, such as
<a href="/reference/instruments/BUTTER.php">BUTTER</a>,
<a href="/reference/instruments/MOOGVCF.php">MOOGVCF</a>,
<a href="/reference/instruments/ELL.php">ELL</a> and
<a href="/reference/instruments/MBLOWBOTL.php">MBLOWBOTL</a>.
The
<a href="Oreson.php">Oreson</a>,
<a href="Oonepole.php">Oonepole</a>
and
<a href="Oequalizer.php">Oequalizer</a>
objects may also be useful.]</i>

<h3>Synopsis</h3>

     #include &lt;ugens.h&gt;<BR>
<BR>
     float resonz(sample,array)<BR>
     float sample, *array;<BR>
<BR>

     rszset(cf,bw,xinit,q)<BR>
     float cf,bw,xinit,*q;<BR>

<h3>Description</h3>

    <B>resonz()</B> is a simple biquad IIR filter.  It is initialized
     by a call to <B>rszset()</B> in which the arguments are: <i>cf</i>, the
     center frequency, in hz; <i>bw</i>, the distance in hz, between
     the half-power points on the bell-shaped curve;
     the value <i>xinit</i> which if 0, cases the initial conditions of the filter to be set to 0 (this should be
     set to 1 when reinitializing the filter in the midst of performance), and 
	<i>q</i> which is a bookkeeping array of 5 locations.<P>
<h3>See Also</h3>
<A href="reson.php">reson/rsnset</a>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
