<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Standalone RTcmix</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h1>Standalone RTcmix</h1>

This page describes procedures for use of RTcmix in the command line environment. RTcmix compiles and runs on most Unix-like systems, including various flavors of Linux, Mac OSX, IRIX, and FreeBSD. RTcmix is also available to run in Max and Pd via the <a href="/rtcmix~/">rtcmix~ object</a> and the <a href="/irtcmix/">iRTcmix library</a> is available to use in iOS apps (iPhone, iPad, iPod Touch).


<h2>Getting RTcmix</h2>

Getting RTcmix is <i>so easy!</i>  There are currently three
<i>so easy!</i> ways to download and install RTcmix:


<h3><i>1. Do It All At Once</i></h3>

<a href="ftp://presto.music.virginia.edu/pub/rtcmix/snapshots.daily/RTcmix-all.tar.gz
">Download the most recent RTcmix distribution</a>,
all packages included(v 4.0.x, 2.5 Mbytes/50 Mbytes installed).

<ul>
	<li>If the download procedure doesn't automatically unpack the <i>RTcmix-all.tar.gz</i> file into an "RTcmix-all-XXXXXX/" (where "XXXXXX" is a date number) directory, use these commands in a terminal window:
	
	<pre>
	gunzip RTcmix-all.tar.gz
	tar -xvf RTcmix-all.tar</pre>
	
	in the directory where the <i>RTcmix-all.tar.gz</i> file is located. Many contemporary file browsers also allow you to double-click on the <i>RTcmix-all.tar.gz</i> file to unpack it.</li><br />


	<li>Move this "RTcmix-all-XXXXXX" directory to the location where you would like
	it installed (we recommend "/usr/local/src/RTcmix-all/"
	or "/usr/local/src/RTcmix/").</li><br />
	
	<li>In this "RTcmix/" directory, type the command:
	
	<pre>
	./configure</pre>
	
	There are options you may wish to use with the <i>configure</i> command for your installation -- Perl, Python, X-windows, fftw-lib, etc. See the <a href="INSTALL.php">INSTALL</a> file in the "RTcmix/" directory for a discussion of these.</li><br />

	<li>After running the <i>configure</i> command (with any appropriate
	options), then type (in that same "RTcmix/" directory):
	
	<pre>
	make; make install</pre></li>
</ul>

RTcmix should compile, install, and off you go!

<h3><i>2. Do It With the Most Recent "Snapshots"</i></h3>

Periodic archives of the ever-improving RTcmix source code are made and kept at the <a href="http://www.virginia.edu/music/VCCM/">University of Virginia Computer Music Center</a>.
<p>

<a href="ftp://presto.music.virginia.edu/pub/rtcmix/snapshots.daily/">download</a> an archive made within the past 24 hours<br />
<a href="ftp://presto.music.virginia.edu/pub/rtcmix/snapshots.weekly/">download</a> an archive made within the past week<br />
<a href="ftp://presto.music.virginia.edu/pub/rtcmix/snapshots.monthly/">download</a> an archive made within the past month

<ul>
	<li>These archives will contain the latest additions and updates to RTcmix. However, because the language is constantly being extended, parts of these may be a little unstable.
	<p>
	You will also notice that each of the above archive directories contain several separate <i>.tar.gz</i> files.  The file named

	<pre>
	RTcmix-NNNNNN.tar.gz</pre>

	(where <i>NNNNNN</i> is a <i>mmddyy</i> date) is the main "core" of RTcmix.  The other files such as:

	<pre>
	imbed-NNNNNN.tar.gz
	std-NNNNNN.tar.gz
	jg-NNNNNN.tar.gz
	stk-NNNNNN.tar.gz</pre>

	(and possibly additional ones) are 'packages' of RTcmix instruments and applications that you will probably also want in your RTcmix distribution. The main download <i>RTcmix-4.0.1.tar.gz</i>i in download method #1 above contains all of these packages.  The reason we decided to enable these packages was so that independent developers could contribute new instruments, etc. to RTcmix that wouldn't require the rebuilding or substantial modification of the entire system.</li><br />
	 
	<li>If the download procedure doesn't automatically unpack the <i>RTcmix-NNNNNN.tar.gz</i> file into an "RTcmix/" directory, say:
	
	<pre>
	gunzip RTcmix-NNNNNN.tar.gz
	tar -xvf RTcmix-NNNNNN.tar</pre>
	
	in the directory where the <i>RTcmix-NNNNNN.tar.gz</i> file is located. Some file browsers allow you to simply double-click on the file to unpack it.</li><br />

	<li>Move this "RTcmix/" directory to the location where you would like it installed (we recommend "/usr/local/src/RTcmix").</li><br />
	
	<li>At this point, you have a basic RTcmix with all functions and objects for development ready-to-go, but only two instruments <a href="/reference/instruments/MIX.php">MIX</a> and <a href="/reference/instruments/WAVETABLE.php">WAVETABLE</a> are included.  You can choose to add additional packages by downloading them and unpacking them in the "RTcmix/" directory. Packages containing RTcmix instruments and associated code subdirectories should go in the "RTcmix/insts" directory and standalone applications and environments should go in the "RTcmix/apps" directory.
	<p>
	Here is a listing of the contents (as of July, 2005) of a few of these packages:
	
	<ul>
		<li>"RTcmix/insts/std" (file <i>std-NNNNNN.tar.gz</i>) -- <a href="insts.std.listing.php">listing</a></li>
		<li>"RTcmix/insts/jg" (file <i>jg-NNNNNN.tar.gz</i>) -- <a href="insts.jg.listing.php">listing</a></li>
		<li>"RTcmix/insts/stk" (file <i>stk-NNNNNN.tar.gz</i>) -- <a href="insts.stk.listing.php">listing</a></li>
		<li>"RTcmix/apps/imbed" (file <i>imbed-NNNNNN.tar.gz</i>) -- <a href="imbed.listing.php">listing</a></li>
	</ul></li><br />
	
	<li>After putting in place any of these additional packages you want, go to the main "RTcmix/" directory and type:
	
	<pre>
	./configure</pre>

	with any of the configuration options discussed above.  Then type:
	
	<pre>
	make; make install</pre>
	
	and RTcmix should build and install correctly.  The <i>configure</i> and subsuquent build with <i>make; make install</i> should be done anytime you add a new package to RTcmix.
</ul>

<h3>3. Get the Most Up-To-Date Version via CVS</h3>

Contact <a href="http://people.virginia.edu/~djt7p/">Dave Topper</a> [topper-at-virginia-dot-edu] to get CVS access to the RTcmix repository. You should probably know what you're doing for this option.
<br /><br />

<h2>A Note on the command path</h2>

All RTcmix executable commands, including the <i>CMIX</i> command, are placed in the "RTcmix/bin" directory.  To access these commands, you can copy/move them to a directory like "/usr/local/bin" or "/usr/bin". These directories are probably already on your <i>command search path</i>. To see your command search path, type the command:

	<pre>
	echo $path</pre>
	
or

	<pre>
	echo $PATH</pre>
	
and you should see a listing of all directories that are searched for executable commands.
<p>
You can also simply add the "RTcmix/bin" directory to your command search path.  You will probably need to edit or create a ".tcshrc: or ".cshrc" or equivalent shell initialization file to do this.  An example of a line in a ".tcshrc" that accomplishes this is:

	<pre>
	set path=(~/bin $path /usr/local/bin /usr/local/src/RTcmix/bin ".")</pre>

Once you do this, you will need to start a new Terminal or Shell window (or use the unix <i>source</i> command) to reflect the change you have made.  See the documentation for "tcsh" or "csh" or "bash" for more information.
<p>
If all else fails, you can type the whole pathname as a prefix to the RTcmix executable command you want:

	<pre>
	/usr/local/src/RTcmix/bin/CMIX
	/usr/local/src/RTcmix/bin/sfprint somefile.aiff
	/usr/local/src/RTcmix/bin/cpspch 8.07 </pre>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
