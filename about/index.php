<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - About</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h1>About RTcmix</h1>

RTcmix compiles and runs on most Unix-like systems, including various flavors of Linux, Mac OSX, IRIX, FreeBSD.  A windows port is available making use of the max/msp <a href="/rtcmix~/">rtcmix~</a> object.

<p>
RTcmix currently includes the following components:
<ul>
	
	<li>a library of low-level C/C++ functions and objects for performing most contemporary digital audio and signal-processing tasks
	<li>a substantial set of pre-coded "instruments" instantiating a variety of DSP and sound-synthesis algorithms (click <a href="/reference/instruments/">here</a> for a list) 
	<li>a fully-featured command-parsing langauge to allow easy incorporation of algorthmic control procedures in sound generation 
	<li>an option to allow the perl or python programming languages to be used as the control/command-parsing environment for RTcmix 
	<li>a robust and sample-accurate scheduler for timing and arbitrary event-scheduling 
	<li>an 'embedded' RTcmix object and associated library to enable the entire RTcmix language (scheduler too!) to be compiled and used seamlessly within other C/C++ applications 
	<li>a TCP/IP socket interface for external control of RTcmix from other processes or machines 
	<li>the physical model and PhISEM routines from Perry Cook and Gary Scavone's <a href="http://www-ccrma.stanford.edu/software/stk/">Synthesis ToolKit (STK)</a> as well as affiliated RTcmix instruments using the stk routines 
	<li>the ability to read/write most contemporary soundfile formats by via Bill Schottstaedt's <a href="http://www-ccrma.stanford.edu/software/snd/snd/sndlib.html" >sndlib</a> 
	<li>a package of examples showing RTcmix use with MIDI, X11/motif, wxWindows, Lisp, Open Sound Control (OSC), OpenGL, etc. 
	<li>a set of command-line utility programs for playing and manipulating soundfiles 
	<li>a Max/MSP <a href="/rtcmix~/">rtcmix~</a> object, available for both Mac OSX and Windows XP versions of max/msp 
	<br><br> 
	<i>recently completed:</i>
	<br> 
	<li>VST plugin authoring capability (via max/msp "pluggo") 
	<li>dynamic p-field modification (in version 4.0) 
	<br><br> 
	<i>almost completed:</i>
	<br> 
	<li>"pull"-model for audio i/o (JACK, PortAudio, etc.)
</ul>

RTcmix is derived from the original CMIX</a> language, developed at Princeton University by <a href="http://paul.mycpanel.princeton.edu">Paul Lansky</a>.

<h2>Contributors</h2>

<li><a href="http://bradgarton.com">Brad Garton</a>
<li><a href="http://www.davetopper.com">Dave Topper</a>
<li><a href="http://john-gibson.com">John Gibson</a>
<li><a href="http://music.columbia.edu/~doug">Doug Scott</a>
<li><a href="http://www.lukedubois.com">Luke DuBois</a>
<li><a href="http://www.marahelmuth.com">Mara Helmuth</a>
<li><a href="http://music.columbia.edu/~chris">Chris Bailey</a>
<li><a href="http://music.columbia.edu/~stanko">Stanko Juzbasic</a>
<li><a href="http://ico.bukvic.net">Ico Bukvic</a>
<li><a href="http://joel.matthysmusic.com">Joel Matthys</a>
<li><a href="http://damonholzborn.com">Damon Holzborn</a>

<h2>The Ancient History of RTcmix</h2>

Luke Dubois wrote a <a href="http://music.columbia.edu/cmix/history.html">brief history of RTcmix</a> back in the mid-1990's, quoting from an earlier brief history of CMIX written by Brad Garton (me!). The histories are in fact still historical, but a few recent (c. 2000-2003) RTcmix events worth noting -- if you are the kind that likes noting these things.
<p>
With the demise of SGI machines as a semi-platform-of-choice for the computer music community, RTcmix went into a period of 'underground' usage.  As noted in Luke's document, it was ported to Linux and was further developed by a core group of RTcmix users who also adopted Linux for musical work.  Dave Topper and John Gibson at the University of Virginia (John is presently at Indiana University) and Doug Scott (formerly of SGI, now with Beatnik) in particular added extensive new features to the language and greatly expanded RTcmix capabilities -- perl/python interface, instrument interconnecting ability, much larger instrument base, etc.
<p>
But by and large, not too many new users began working with RTcmix, primarily because we never took the time to create a coherent body of documentation.  Luke, followed with additional work by Dave and John, added to the tiny existing RTcmix documentation (and much of their work has been incorporated into these web pages), but to use RTcmix you sort-of had to know how to use it already.
<p>
I was still using RTcmix a fair amount in my own musical work, but I also began to look at other languages (like <a href="http://www.softsynth.com/jsyn/">JSyn</a>, <a href="http://www.cycling74.com/products/maxmsp.html">Max/MSP</a> and <a href="http://www.audiosynth.com/">SuperCollider</a>). One of the things I didn't like about these languages was the difficulty in incorporating them into C/C++ applications with a high degree of data-sharing.  I also rediscovered how much I enjoy the straightforward algorthmic processing capabilities of RTcmix.  So, with help from Doug/Dave/John, I wrote an 'embedded' RTcmix object to facilitate the C/C++ connection, and decided to get our documentation house in order so that others who might want a language like RTcmix could gain entry.
<p>
I had noticed that many of our students at Columbia were adopting <a href="http://www.cycling74.com/products/maxmsp.html">Max/MSP</a> as a base for their computer music operations.  The Max/MSP <a href="/rtcmix~/">rtcmix~</a> object was created to bring the Joy of RTcmix to this environment.  The recent Windows XP port of this object allowed us to build an executable RTcmix for Windows without too much additional pain.
<p>
That's the story so far.  With a solid Linux version and an equally solid port to Mac OSX (and the hybrid RTcmix-Max/MSP Windows version), we believe that RTcmix should be attractive for other programmers-musicians-audio people. Please browse through the documentation here (especially the <a href="/tutorials/">tutorials</a>), <a href="/rtcmix/">download</a> and try a few instruments, join the <a href="https://lists.columbia.edu/mailman/listinfo/rtcmix-discuss">RTcmix discussion list</a>, etc.
<p>
We hope you find the language useful!
<p>
Brad Garton


	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
