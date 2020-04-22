<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - rtcmix~</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<h1>rtcmix~</h1>

<table border="0" cellspacing="6" cellpadding="6" width="250" align="right">
	<tr>
		<td bgcolor="dddddd">
			<i>rtcmix~</i> is also available for the <a href="http://puredata.info">Pd</a>
				visual programming language, ported by <a href="http://joel.matthysmusic.com">Joel Matthys</a>
			<ul>
				<li><a href="http://puredata.info/Members/jwmatthys/">Binaries for OSX and Linux</a></li>
				<li><a href="https://github.com/jwmatthys/rtcmix-in-pd">source files</a></li>
			</ul>
		</td>
	</tr>
</table>

RTcmix is a complete sound synthesis and signal processing language, including a robust scheduler and large set of pre-compiled "instruments". The rtcmix~ object completely encapsulates RTcmix within the <a href="http://cycling74.com/products/max/">Max/MSP</a> real-time music environment, extending the capabilities of Max/MSP.

<ul>
	<li>Download (32 bit): <a href="/rtcmix~/downloads/RTcmix-2.00.zip">RTcmix-2.00.zip</a></li>
	<li>Download (64 bit): <a href="/rtcmix~/downloads/RTcmix-2.099-64.zip">RTcmix-2.099-64.zip</a></li>
</ul>

Current versions are available for Max 5 (and above) for Mac OS X. Older versions are available <a href="/rtcmix~/archives.php">in the archives</a>.

<h3>Installation Instructions for Max 7 and 8</h3>

The archive will unpack to a folder titled "RTcmix-2.0xx" (with "-64" appended if it is the 64-bit version). Move this entire folder intact to the "/Users/Shared/Max 7/Library"  or "/Users/Shared/Max 8/Library"  folder. Restart Max/MSP and the new [rtcmix~] object should show in the Max console as:

	<pre>
   RTcmix music language, v. 2.0xx (RTcmix-maxmsp-4.3.1)
   </pre>

   <p>
   <i>NOTE: Be sure to remove any of your older RTcmix or RTcmix-help folders from these folders:</i>

	<pre>
    /Users/Shared/Max 7/Library 
    /Users/Shared/Max 8/Library
	</pre>

<h3>Installation Instructions for Max 5 and 6</h3>

This archive will unpack into a single "RTcmix-2.00/" folder. Inside this folder are two sub-folders, "RTcmix/" and "RTcmix-help-2.9/" You will need to place them somewhere on the Max5 search path. We recommend putting the "RTcmix/" folder in:

	<pre>
   /Applications/Max 6/Cycling '74/msp-externals/</pre>
   
and the "RTcmix-help-2.9/" folder in:

	<pre>
   /Applications/Max5/Cycling '74/msp-help/</pre>

Move the entire "RTcmix/" and "RTcmix-help/" folders intact -- do not take the <i>rtcmix.mxo</i> object or <i>rtcmix~.maxhelp</i> patches out of the folders!
<p>
<i>NOTE:  Be sure to remove any existing "RTcmix/" folders, "RTcmix-help/" folders, or </i>rtcmix~<i> objects from the search path.</i>
<p>

<h2>Features</h2>

<ul>
	<li>The rtcmix~ object can load, parse and run existing <i>RTcmix</i> scorefiles.  A set of internal buffers and buffer-editing routines are included with the object.</li><br />

	<li>A large set of mathematical and data-manipulation/storage routines are available with the rtcmix~ object, including the ability to define and use arbitrary new operations.</li><br />

	<li>rtcmix~ enables the Max/MSP user to write procedural code for particular algorithmic operations.  For example, a valid <i>RTcmix</i> script executing in the rtcmix~ object might be something like:
	
	<li>Approximately 120 existing <i>RTcmix</i> synthesis and signal-processing instruments are currently accessible in the rtcmix~ object, including a set of FFT/PVOC-based spectral manipulation tools, real-time Linear Prediction Coding (LPC) analysis/resynthesis, and most of the <a href="http://www-ccrma.stanford.edu/software/stk/">Synthesis ToolKit (STK)</a> physical models created by Perry Cook and Gary Scavone.</li>

	<pre>
	for (time = 0; time < 14.9; time = time + 0.35) {
		USE_AN_INSTRUMENT(time, p1, p2, p3...)
	}</pre></li>

	<li>In a similar fashion, the rtcmix~ object can schedule Max/MSP messages and events.  The following rtcmix~ script will produce 100 'bangs' randomly spaced in a 7-second interval:

	<pre>
	for (i = 0; i < 100; i = i+1) {
		bangtime = irand(0.0, 7.0)
		MAXBANG(bangtime)
	}</pre></li>

	<li>rtcmix~ provides an easy framework for linkage between Max/MSP and arbitrary C/C++ functions and objects, including separately-compiled mach-o C/C++ code.</li><br />
</ul>

<h2>Final Words on This Web Page</h2>

RTcmix was originally written by Brad Garton and Dave Topper, adding real-time capabilities to the cmix music-programming language developed by Paul Lansky.  John Gibson, Doug Scott (and others) added significant extensions to the package.
<p>
The rtcmix~ object was written by Brad Garton with much advice and assistance from Dan Trueman and Luke DuBois (Dan wrote the internal buffer script-editing code).  Joshua Kit Clayton was an invaluable resource, as always. Thanks guys!
<p>
I hope this may be useful for others; I'm having a blast with it.  Let me know what you think!
<p>
Brad Garton
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
