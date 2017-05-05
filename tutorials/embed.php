<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Tutorials - Embedding</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h1>Using RTcmix Embedded Inside Another Application</h1>

One of the niftiest things about RTcmix is that almost the entire
language can be "embedded" within another C++ application.
Direct interfaces to RTcmix instruments can be designed
quite easily using graphical environments such as wxWindows,
X11/Motif, OpenGL, etc. or RTcmix can be used as a convenient way
to "auralize" data within an entirely different program, or
certain features of RTcmix (like the scheduler) can be imported
for totally twisted non-audio use, or... like, the sky's the limit.
Yeah.  That's it.  Imagination.
<p>
It is really simple to set this up.  To access and run RTcmix
from within another program, you need to make use of the
<a href="/reference/interface/RTcmix-embed.php">RTcmix object</a>.
To use this, you will need the statements
<pre>
       #define MAIN
       #include <globals.h>
       #include <RTcmix.h>
</pre>
in the file containing the <i>main()</i> entry point.
The "globals.h" file contains definitions of variables and
values that RTcmix needs.  The "RTcmix.h" file is included
for the defintion of the RTcmix object
as you would with any C++ object (we are assuming that the Makefile
is set appropriately to find the RTcmix.h file -- see the discussion
of Makefiles below).  The "#define MAIN" is needed by RTcmix to
be sure that certain variable definitions are appropriately included.
<p>
You will also need to put
<pre>
       #include <globals.h>
       #include <RTcmix.h>
</pre>
in any subsidiary files defining functions or objects that
make use of the RTcmix object, as you would expect (note that
the "#define MAIN" statement only goes in the same file where
<i>main()</i> is defined).
<p>
With these #include files set, creating the RTcmix object is
trivial:
<pre>
       RTcmix *rrr;

       rrr = new RTcmix();
</pre>
At this point, <i>rrr</i> references a fully-functioning
RTcmix.  The
<pre>
       rrr = new RTcmix();
</pre>
statement takes the place of the <i>rtsetparams</i> scorefile
command.  The <i>RTcmix()</i> constructor can set many of the
same parameters as <i>rtsetparams</i> -- sampling rate, number of
channels, etc. -- if so desired.
<p>
All scorefile commands can now be sent to the RTcmix object
using this syntax:
<pre>
       rrr->cmd("COMMAND", &nbsp NPARAMS, &nbsp p0, p1, p2, ...);
</pre>
where <i>COMMAND</i> is the name of the scorefile command,
<i>NPARAMS</i> is the number of parameters you are sending
the command, and the following <i>p0, p1, p2, ...</i> numbers
are the parameter values.  The only trickiness in this
vs. an actual scorefile command is that the p-fields should 
be floating-point values (for numerical parameters) or
"string" values (for strings, obviously).  <i>NPARAMS</i>
should be an integer.  Regular RTcmix scorefiles allow both
floating-point and integere p-fields, but the truth of the
matter is that they are all converted to floating-point
'inside' the language, so this really doesn't change
how a command will function.
<p>
For example, the WAVETABLE command we used in our first
<a href="standalone.php">simple standalone tutorial</a>
<pre>
       WAVETABLE(0, 3.5, 20000, 440.0)
</pre>
would be sent to RTcmix via the <i>rrr</i> object we created
like this:
<pre>
       rrr->cmd("WAVETABLE", 4, 0.0, 3.5, 20000.0, 440.0);
</pre>
The entire "greatmusic.score" scorefile:
<pre>
       rtsetparams(44100, 2)
       load("WAVETABLE")

       makegen(1, 24, 1000, 0,1, 3.5,1)
       makegen(2, 10, 1000, 1.0, 0.4, 0.2)

       WAVETABLE(0, 3.5, 20000, 440.0)
</pre>
in an embedded application would be:
<pre>
       RTcmix *rrr;

       rrr = new RTcmix(44100.0, 2); // not completely necessary -- this is the default
       sleep(1);

       rrr->cmd("load", 1, "WAVETABLE");

       rrr->cmd("makegen", 7, 1.0, 24.0, 1000.0, 0.0, 1.0, 3.5, 1.0);
       rrr->cmd("makegen", 6, 2.0, 10.0, 1000.0, 1.0, 0.4, 0.2);

       rrr->cmd("WAVETABLE", 4, 0.0, 3.5, 20000.0, 440.0);
</pre>
The <i>sleep(1)</i> is sometimes needed to allow the computer to fully
instantiate the RTcmix thread.  On faster machines this isn't necessary.
<p>
The only part of RTcmix that the RTcmix object does <i>not</i>
handle is the Minc (or perl, python, etc.) "front-end" parsing
language.  Thus no <i>for</i> loops, or <i>if-then-else</i>
constructions can be sent to the RTcmix object.  We assume that
 the embedded context will allow you to do any of this -- the
application in which the RTcmix object functions <u>becomes</u>
the interface/parser.  It would be somewhat silly to build and
send a loop construct from within C++ when you could just do it
in C++, right?


<h2>The RTcmix Object Return Value</h2>

When the RTcmix object completes the execution of a command,
what does it return?  If the command was an RTcmix instrument,
it returns an <i>Instrument *</i> pointer that can be recast
to a specific type of instrument.  Otherwise the value
it returns is rather meaningless and must be retrieved in a
different way (see below).
<p>
The reason that this <i>Instrument *</i> pointer is important
is that it gives the embedding application a way to interact
directly with each RTcmix note that gets scheduled.  Suppose
you wanted to change the frequency of an executing WAVETABLE
note dynamically, perhaps tracking the movement of an interface
slider or some other changing data object.  By designing
and adding a method for WAVETABLE like:
<pre>
       WAVETABLE::changeFrequency(double freq)
</pre>
you can use the returned <i>Instrument *</i> pointer to access
it. <i>[note: we won't be discussing RTcmix instrument design
here, please see the
<a href="instrument_design.php">instrument design</a>
tutorial.]</i>  To accomplish this, you will need to
declare a <i>WAVETABLE *</i> pointer (including the appropriate
"WAVETABLE.h" for the required C++ object definition):
<pre>
       #include <globals.h>
       #include <RTcmix.h>
       #include "WAVETABLE.h"

       // ... all of the RTcmix set-up and use for RTcmix *rrr ...

       RTcmix *rrr;
       WAVETABLE *theWave;

       rrr = new RTcmix();
       sleep(1);

       rrr->cmd("load", 1, "WAVETABLE");

       rrr->cmd("makegen", 7, 1.0, 24.0, 1000.0, 0.0, 1.0, 3.5, 1.0);
       rrr->cmd("makegen", 6, 2.0, 10.0, 1000.0, 1.0, 0.4, 0.2);

       theWave = (WAVETABLE *)rrr->cmd("WAVETABLE", 4, 0.0, 999.0, 20000.0, 440.0);
</pre>
At this point, <i>theWave</i> can now be used to change the frequency
of the note (notice that we set the duration to 999.0 seconds so that
it will be making sound continuously:
<pre>
       theWave->changeFrequency(314.78);
       theWave->changeFrequency(249.0);

       // etc.
</pre>
There are, however, some RTcmix scorefile commands (such as <i>cpspch</i>
that return numerical values instead of <i>Instrument *</i> pointers.
We decided not to figure out how to handle multiple return types,
but instead wrote a <i>cmdval()</i> method for the RTcmix object.
This method works the same way that <i>cmd()</i> does, except that
it returns a floating-point value after it executes.
<pre>
       RTcmix *rrr;
       float freq;

       rrr = new RTcmix();

       freq = rrr->cmdval("cpspch", 1, 8.09);
</pre>
will assign the value "440.0" to the <i>freq</i> variable.
<p>
With <i>cmd()</i> and <i>cmdval</i>, you can make use of all
that the RTcmix object has to offer.  We have added a few 'shortcuts'
that can make your programming life a teeny bit easier.  For instance,
<pre>
       rrr->printOn();
</pre>
and
<pre>
       rrr->printOff();
</pre>
will turn on and off <u>all</u> RTcmix output.  You may
want to place the <i>printOff()</i> command
directly after the <i>new RTcmix()</i>
constructor to prevent RTcmix printing output from within
an application.
<p>
RTcmix commands that have no arguments may be called without
the <i>NPARAMS</I>:
<pre>
       avar = rrr->cmd("random");
</pre>
Also note that <i>cmdval()</i> is not necessary for this 0-pfield
scorefile command.

<h2>A note about RTcmix instrument loading</h2>

A little discussion of the <i>load</i> scorefile command in an
embedded application is necessary, though.  When you bundle
a finished RTcmix-embedding application, you will need to
include the dynamic library files for the instruments you
use (like "libWAVETABLE.so").  These are found in the "shlib/"
subdirectory of RTcmix, or (as in the case of the <i>changeFrequency()</i>
method added to WAVETABLE above) you will want to include an
instrument library that you have compiled.  Looking closely
at the documentation for the
<a href="/reference/scorefile/load.php">load</a>
scorefile command, notice that it can use absolute or relative
pathnames to find the dynamic library for loading.  If you had
created a "libMYWAVETABLE.so" instrument library, then you could
simply keep it in the same directory with your finished RTcmix-embedding
app, and call the <i>load</i> command like this:
<pre>
       rrr->cmd("load", 1, "./libMYWAVETABLE.so");
</pre>
and it should work just fine.  Alternatively, you could build an
installer that would place "libMYWAVETABLE.so" into some common
directory, like "/usr/local/lib" and use:
<pre>
       rrr->cmd("load", 1, "/usr/local/lib/libMYWAVETABLE.so");
</pre>
<i>load</i> should also work fine in this case.


<h2>An additional utility function</h2>

Including the RTcmix object in your application also loads
in a function that isn't part of the RTcmix object 'proper', but
is very useful for digital audio applications.
The function
<a href="/reference/interface/RTtimeit.php">RTtimeit()</a>
will allow you to easily set up a fairly well-timed, repeating
call to another function.  The <i>RTtimeit()</i> function
takes two arguments, the first is a floating-point number that
is the number of seconds between each call to the second argument,
a pionter to a void-returning function.
<p>
As a demonstration of this, suppose you wrote a function
called <i>gonotes()</i> that generated a burst of 8 notes,
and you wanted this burst to occur every 2.4 seconds.  In
your embedding application the <i>gonotes()</i> function
would be declared:
<pre>
       void *gonotes();
</pre>
and the <i>RTtimeit()</i> call to make <i>gonotoes()</i> fire
every 2,4 seconds would be:
<pre>
	RTtimeit(2.4, (sig_t)gonotes);
</pre>
The <i>RTtimeit()</i> can be called with a different timing value for
<i>gonotes()</i> at any point, including within the <i>gonotes()</i>
function itself.  Setting the timing value in <i>RTtimeit()</i> to
0.0 should turn off the repeating function calls.  <i>[note:
</i>RTtimeit()<i> uses the Unix SIGALRM signal, and will 'wake up'
any processes also using SIGALRM (like </i>sleep()<i>.  You may need
to place </i>sleep()<i>'s in a </i>while<i> loop.  See the
"RTcmix/imbed/arpeggiate" program for an example of this.]</i>

<h2>Makefiles and Embedded <i>RTcmix</i></h2>

Although Makefiles can be weird and esoteric things, creating
one to compile an embedded RTcmix application shouldn't
be too difficult... assuming, of course, that you have a Makefile
that will indeed build the application itself (i.e. without the
RTcmix addition).
<p>
Here is a Makefile to compiled a C++/OpenGL program
called "fredspace", with no RTcmix inclusions:
<pre>
       XINCS = -I/usr/X11R6/include/
       XFLAGS =  -L/usr/X11R6/lib/ -lXext -lX11 -lGL -lGLU -lm -laux

       fredspace: fredspace.o
              g++ -o fredspace fredspace.o $(XFLAGS)

       fredspace.o: fredspace.C
              g++ -c fredspace.c $(XINCS)
</pre>
If we modify the "fredspace.C" program to use the RTcmix object,
we only need a few changes to the Makefile to compile it:
<pre>
       include /usr/local/src/RTcmix/makefile.conf

       XINCS = -I/usr/X11R6/include/
       XFLAGS =  -L/usr/X11R6/lib/ -lXext -lX11 -lGL -lGLU -lm -laux

       # So main() will declare RTcmix globals
       GLOBALS = $(ARCHFLAGS) -I$(CMIXDIR)/H
       IMBCMIXOBJS += $(PROFILE_O)

       fredspace: fredspace.o
              g++ -o fredspace fredspace.o $(GLOBALS) $(DYN) $(XFLAGS) $(IMBCMIXOBJS) $(LDFLAGS)

       fredspace.o: fredspace.C
              g++ $(GLOBALS) -c fredspace.c $(XINCS)
</pre>
The first change to the Makefile, the line:
<pre>
       include /usr/local/src/RTcmix/makefile.conf
</pre>
will set up the Makefile with compiler flags and definitions that
are specific to your operating system and RTcmix.  We are assuming here
that RTcmix is installed in "/usr/local/src/RTcmix".
The file "makefile.conf" in the top-level RTcmix directory contains these
defintions. etc.
<p>
The Makefile lines:
<pre>
       # So main() will declare RTcmix globals
       GLOBALS = $(ARCHFLAGS) -I$(CMIXDIR)/H
       IMBCMIXOBJS += $(PROFILE_O)
</pre>
are probably somewhat redundant, but they guarantee that appropriate
compiled information is set for the Makefile.
<p>
Finally, including the Makefile variables <i>$(GLOBALS) $(DYN) 
$(IMBCMIXOBJS)</i> and <i>$(LDFLAGS)</i> in the main
<i>fredspace</i> target and including <i>$(GLOBALS)</i>
in the <i>fredspace.o</i> object target
should allow the compiler/linker to find all of the library
and header files it needs to build the application successfully.
<i>[note:  Except for </i>$(GLOBALS)<i>, all of the Makefile
target flags listed are from the RTcmix file "makefile.conf".]</i>
<p>
This approach to creating a Makefile is pretty generic, "old-style"
Unix, but it shouldn't be too difficult to use this as a guide to
set up various compiler-environments and project-builder applications
for embedded RTcmix applications.  In addition to some of the
specific flags and #defines found in the "makefile.conf"
file, it will be important to put the "RTcmix/H" directory
on the search path for header files, and the "RTcmix/lib"
directory in the search path for the "genlib.a" library.
Also, the files "RTcmix/sys/cmix.o" and "RTcmix/Minc/inbRTcmix.o"
will need to be linked in order to build the final executable
application.


<h2>A note about compiling RTcmix for embedded use</h2>

In certain circumstances, it isn't good to have RTcmix exit when
a scorefile error occurs.  In the main "RTcmix/makefile.conf" file,
the following entry can be modified:
<pre>
	# Comment this out to set the die() function so that it will not exit on
	# encountering an error (you may want to do this if you are using
	# RTcmix in the context of another application where you don't want
	# to terminate the application because of an RTcmix error
	CMIX_FLAGS += -DEXIT_ON_ERROR
</pre>
by commenting out the <i>CMIX_FLAGS</i> line:
<pre>
	#CMIX_FLAGS += -DEXIT_ON_ERROR
</pre>
Recompiling RTcmix will set it so that instruments returning the value
<i>DONT_SCHEDULE</i> (defined in "RTcmix/rtstuff/rtdefs.h")
from their <i>::init()</i> member functions will <u>not</u>
be placed on the execution queue, and print a warning message without
exiting.  This will keep RTcmix from halting the execution of the
calling application.


<br>
<br>
<br>
Brad Garton
<br>
August, 2003
<br>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

<br>
<br>
<br>
<br>
<br>
<br>
</body>
</html>
