<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Tutorials - Python</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h1>Using Python as the <i>RTcmix</i> Command-Language Interface</h1>


Very similar to the
<a href="perl.php">Perl</a>
front-end procedure for RTcmix, you will need to
configure RTcmix using the <i>--with-python</i> configuration
flag (see the
<a href="/rtcmix/">installation guide</a>
for information about this).
Once you do this and (re-)compile RTcmix, you're set to go with a Python
front-end.  As with Perl, this can be used in place of the default
scorefile language
<a href="/reference/scorefile/Minc.php">Minc</a>.
You will need to use the 
<a href="/reference/interface/PYCMIX.php">PYCMIX</a>
command instead of
<a href="/reference/interface/CMIX.php">CMIX</a>
to start RTcmix.


<h2>Using Python/RTcmix</h2>

This works a lot like the Perl RTcmix, but the following note
is in the "RTcmix/Python" directory:
<pre><ul>
-  Namespace clashes with Python builtin functions:

      abs
      input
      max
      open
      pow
      round

   The cmix ones seem to have priority (because they were loaded
   most recently?).
  
- The ability to kill the job and still see peak stats doesn't work,
  though it does work in PYCMIX.  Python is nuking our signal handler
  (sigint_handler in main.C) somehow?  Strange, because supposedly
  the interpreter is destroyed before we start playing score, by
  parse_score in Minc/parse_with_python.c.  The comments in parse_score
  imply that this used to work with Python 1.x.

- To build python on OS X, see http://www.zope.org/Members/jens/docs/zope_osx
</pre></ul>

<h2>Sample Scorefiles</h2>

Python script showing the RTcmix ability to chain several
instruments together:
<pre><ul>
# Quick translation of sample_scos_3.0/LONGCHAIN_1.sco to Python, for testing.

# This score makes a wavetable synth riff and feeds it through 3 effects
# in series: flange -> delay -> reverb

from rtcmix import *

print_off()
rtsetparams(44100, 2)
load("WAVETABLE")
load("FLANGE")
load("JDELAY")
load("REVERBIT")

bus_config("WAVETABLE", "aux 0-1 out")
bus_config("FLANGE", "aux 0-1 in", "aux 10-11 out")
bus_config("JDELAY", "aux 10-11 in", "aux 4-5 out")
bus_config("REVERBIT", "aux 4-5 in", "out 0-1")

totdur = 30
masteramp = 1.0
atk = 2; dcy = 4

notes = [5.00, 5.001, 5.02, 5.03, 5.05, 5.07, 5.069, 5.10, 6.00]
numnotes = len(notes)

transposition = 2.00    # try 7.00 also, for some cool aliasing...
srand(2)


# ---------------------------------------------------------------- synth ---
notedur = .10
incr = notedur + .015

maxampdb = 92
minampdb = 75
ampdiff = maxampdb - minampdb

control_rate(20000)         # need high control rate for short synth notes
setline(0,0, 1,1, 20,0)
makegen(2, 10, 10000, 1, .9, .7, .5, .3, .2, .1, .05, .02)

st = 0
while st < totdur:
   slot = int(random() * numnotes * .999999)
   pitch = pchoct(octpch(notes[slot]) + octpch(transposition))
   amp = ampdb(minampdb + (ampdiff * random()))
   pctleft = random()
   WAVETABLE(st, notedur, amp, pitch, pctleft)
   st = st + incr


# for the rest
control_rate(500)
amp = masteramp

# --------------------------------------------------------------- flange ---
resonance = 0.3
lowpitch = 5.00
moddepth = 90
modspeed = 0.08
wetdrymix = 0.5
flangetype = 0

gensize = 100000
makegen(2,10,gensize, 1)

maxdelay = 1.0 / cpspch(lowpitch)

setline(0,1,1,1)

st = 0; insk = 0; inchan = 0; pctleft = 1
FLANGE(st, insk, totdur, amp, resonance, maxdelay, moddepth,
       modspeed, wetdrymix, flangetype, inchan, pctleft)

lowpitch = lowpitch + .07
maxdelay = 1.0 / cpspch(lowpitch)

makegen(2,9,gensize, 1,1,-180)

st = 0; insk = 0; inchan = 1; pctleft = 0
FLANGE(st, insk, totdur, amp, resonance, maxdelay, moddepth,
       modspeed, wetdrymix, flangetype, inchan, pctleft)


# ---------------------------------------------------------------- delay ---
deltime = notedur * 2.2
regen = 0.70
wetdry = 0.12
cutoff = 0
ringdur = 2.0

setline(0,0, atk,1, totdur-dcy,1, totdur,0)

st = 0; insk = 0; inchan = 0; pctleft = 1
JDELAY(st, insk, totdur, amp, deltime, regen, ringdur, cutoff,
       wetdry, inchan, pctleft)
st = 0.02; inchan = 1; pctleft = 0
JDELAY(st, insk, totdur, amp, deltime, regen, ringdur, cutoff,
       wetdry, inchan, pctleft)


# --------------------------------------------------------------- reverb ---
revtime = 1.0
revpct = .3
rtchandel = .05
cf = 0

setline(0,1, 1,1)

st = 0; insk = 0
REVERBIT(st, insk, totdur+ringdur, amp, revtime, revpct, rtchandel, cf)



# john gibson, 13-feb-01
</pre></ul>



<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

