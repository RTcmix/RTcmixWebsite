<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Standalone RTcmix</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h1>Standalone RTcmix</h1>


<p>RTcmix is availble to run as a standalone app on Mac OS X and Windows and in the command line environments of most Unix-like systems, including Mac OS X and various flavors of Linux, IRIX, and FreeBSD. RTcmix is also available to run in Max and Pd via the <a href="/rtcmix~/">rtcmix~ object</a> and the <a href="/irtcmix/">iRTcmix library</a> is available to use in iOS apps (iPhone, iPad, iPod Touch).</p>

<br><hr>

<h2>RTcmix Standalone Apps</h2>

<p>John Gibson has created two apps that will let you run RTcmix scores without having to learn Unix shell commands. They are available to <a href="https://cecm.indiana.edu/rtcmix/rtcmix-app.html">download for Mac and PC</a>.</p>


<br><hr>

<h2>RTcmix on the Command Line</h2>


The RTcmix source code lives on GitHub. There are two ways to download it.

<ol>
	<li>Go to the <a href="https://github.com/RTcmix/RTcmix/releases">RTcmix Releases page</a>, and download the most recent (or other) release, using the "Source code (zip)" or "Source code (tar.gz)" buttons. Unpack this archive, if necessary, by double-clicking its icon. This should produce a folder called "RTcmix-4.3.1" (or a similar version number). Then move this folder into the place where you keep RTcmix source code. The usual place for such things is /usr/local/src, but it can be anywhere.<br /><br /><b>-OR-</b></li><br />
	<li>Assuming you are conversant with git, navigate to a directory where you would like the source code to live, and give this command in the shell:
	<pre>
git clone https://github.com/RTcmix/RTcmix</pre></li>
</ol>

<h2>Compiling RTcmix</h2>

In the RTcmix source code directory ("RTcmix/"), type the shell command:

	<pre>
	./configure</pre>
	
There are options you may wish to use with the configure command for your installation -- Perl, Python, X-Windows, fftw-lib, etc. See the INSTALL file in the "RTcmix/" directory for a discussion of these.
<p>
After running the configure command (with any appropriate options), then type (in that same "RTcmix/" directory):

	<pre>
	make && make install</pre>

RTcmix should compile, install, and off you go!


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
