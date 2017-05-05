<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - buzz/bbuzz</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>buzz/bbuzz</h3>
<i>buzz (pulse) oscillators</i>
<br>
<br>

<h3>Synopsis</h3>
<UL>
     #include "ugens.h"<BR>
<BR>
     float buzz(amp,si,hn,f,phs)<BR>
     float amp,si,hn,*f,*phs;<BR>
<BR>
     float bbuzz(amp,si,hn,f,phs,a,alen)<BR>
     float amp,si,hn,*f,*phs,*a;<BR>
<BR></UL>
<h3>Description</h3>

     The units<B> buzz,</B> and<B> bbuzz,</B> return a pulse-like signal in
     which there are <B>"hn"</B> harmonics of equal amplitude.  The peak
     amplitude of the signal will be <B>"amp."</B> The argument <B>"hn"</B> must
     have no fractional part.  <B>"si"</B> is the sampling increment, <B>"f"</B> is
     the address of a 1024 location array created with
makegen
     and containing one complete cycle of a sine wave.  (see
     
<a href="floc.php">floc</a>)
<B>"phs"</B> is the address of a phase counter and must be
     initialized at 0.  <B>bbuzz()</B> will compute a block of samples
     with one call.  The argument <B>"a"</B>, points to an array of floats
     with <B>"alen"</B> arguments, which will be filled by the call.  The
     <B>"phs"</B> pointer will be updated accordingly.
<P>

<h3>See Also</h3>

<A HREF="floc.php">floc</A>,
<A HREF= "fsize.php">fsize</A>.

<h3>Bugs</h3>

     Not much protection against uninitialized phase pointers or
     <B>hn</B> arguments with fractional parts.  <B>bbuzz()</B> doesn't return
     anything, it just fills the array.<P>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
