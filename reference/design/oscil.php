<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - oscil/oscili/osciln/oscilni</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>oscil/oscili/osciln/oscilni</h3>
<i>wavetable oscillators</i>
<br>
<br>
<ul>
<i>[note:  These are older oscillator unit-generators.  They have
been generally superceded by the
<a href="Ooscil.php">Ooscil and Ooscili</a> objects.]</i>
</ul>

<h3>Synopsis</h3>
<UL>
     #include "ugens.h"<BR>
<BR>
     oscil(amp,si,farray,len,phs)<BR>
     float amp,si,*farray,*phs;<BR>
     int len;<BR>
<BR></UL>
<h3>Description</h3>

     The units <B>oscil</B>, and <B>oscili</B>, are, respectively, a simple
     table-lookup oscillator and an interpolating version of the
     same.  The others <B>osciln</B> and <B>oscilni</B> are designed for frequency modulation and will accept negative sampling incre-
     ments.  The arguments <i>amp</i> and <i>si</i> are the amplitude and sampling increments, The argument <i>farray</i> is the address of the
     table from which to fetch values.  In case this table was
     created with a makegen command a call to <i>floc</i> will return
     this address.  The <i>phs</i> argument is passed as an address
     since it must be updated continuously by the <B>oscil</B> call.
     Thus <i>phs</i> should be declared as float in the calling routine,
     and passed to <B>oscil</B> as <i>&amp;phs</i>. Note that if it is declared as
     <i>*phs</i> in the calling routine space will not actually be allocated for it and an error will result.  The various oscils
     return floating point values and are declared as floats in
     the above mentioned include file.  The argument len is the
     size of the table passed to oscil and if this table was
     created by a call to makegen the routine fsize will find you
     this quantity.

<h3>See Also</h3>

<a href="floc.php">floc</a>,
<a href="fsize.php">fsize</a>.

<h3>Bugs</h3>

     These units dutifully keep the phase pointer within range by
     subtracting the length from the phase until in range, so if
     the phase pointer is uninitialized, and perhaps huge,
     several years may pass while .123456e+38 is reduced to less
     than 512, for example.   Also, as mentioned above make sure
     that <i>phs</i> is declared as float <i>phs</i>; not float <i>*phs</i>; and
     passed as <i>&amp;phs</i>.

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
