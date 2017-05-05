<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - WAVY</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>WAVY</b> -- dual-oscillator wavetable combination instrument
<br>
<i>in RTcmix/insts/jg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>WAVY</b>(outsk, dur, AMP, FREQA, FREQB, PHASEB, WAVETABLEA, WAVETABLEB, expr[, PAN])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = amplitude (absolute, for 16-bit soundfiles: 0-32768)
   p3 = oscil A frequency (Hz or oct.pc)
   p4 = oscil B frequency (Hz or oct.pc; if zero, same as A)
   p5 = phase offset for second oscillator (0-1)
   p6 = oscil A wavetable reference
   p7 = oscil B wavetable reference (if zero, same as A)
   p8 = combination expression ("a + b", "a - b", "a * b", etc.; see the <a href="#usage_notes">Usage Notes</a> below)
   p9 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0.5]

   p2 (amplitude), p3, (oscil A freq), p4 (oscil B freq) and p5 (phase oscil B), and
   p9 (pan) can receive dynamic updates from a table or real-time control source.

   p6 (oscil A wavetable) and p7 (oscil B wavetable) should be references to
   pfield table-handles.

   Author:  John Gibson, 6/15/05
</pre>
<br>
<hr>
<br>


The <b>WAVY</b> instrument combines the outputs of two oscillators (both
accessing the same wavetable) according to a mathematical expression given
in the <i>expr</i> parameter.


<a name="usage_notes"></a>
<h3>Usage Notes</h3>

<b>WAVY</b> allows you to use most any mathematical expression to
combine the two oscillator streams.  "a" represents the output of the
first oscillator, "b", the second one.  Some general examples:
<dd>
<pre>
expr = "(a ^ 5) * .5"
expr = "a - b"
expr = "if (abs(a) < .5, a ^ .1, a * (b - 1))"

(etc.)
</pre>
</dd>
The complete list of possibilities
is given below.  The parser library is written by Juha Nieminen and Joel
Yliluoma.  (More at: 
<a href="http://iki.fi/warp/FunctionParser"3>fparser library</a>).
If you create a very complicated expression, using trig functions, etc.,
then <b>WAVY</b> will not run very quickly.
<p>
<b>WAVY</b> interprets the <i>a</i> and the <i>b</i> variables in these
expressions to refer to the sample values coming from each oscillator.
This allows for a wide range of modulation effects, including
'waveshaping'-type and AM-type sounds.
<p>
Bear in mind, however, that sample values (i.e. the instantaneous
sampled amplitude) of a signal are being used.  For example, you
may think this equation
<dd>
<pre>
expr = "a * b"
</pre>
</dd>
for <i>expr</i>
would produce a frequency modulation kind of effect.  Instead,
the above equation produces simple amplitude modulation
between the two oscillators.
<p>
The frequencies of the two oscillators can be set independently (<i>freqA</i>
and <i>freqB</i>), and the phase of oscillator B can be offset relative
to oscillator A (the <i>phaseB</i> p-field).
<p>
This is the listing (taken from the 
<a href="http://iki.fi/warp/FunctionParser">fparser</a>
library) of the kinds of expressions that can be used
by <b>WAVY</b> in combining the two oscillators:
<br>
<br>
<pre>
  The function string understood by the class is very similar to the C-syntax.
  Arithmetic float expressions can be created from float literals, variables
  or functions using the following operators in this order of precedence:

   ()             expressions in parentheses first
   -A             unary minus
   A^B            exponentiation (A raised to the power B)
   A*B  A/B  A%B  multiplication, division and modulo
   A+B  A-B       addition and subtraction
   A=B  A&lt;B  A&gt;B  comparison between A and B (result is either 0 or 1)
   A&B            result is 1 if int(A) and int(B) differ from 0, else 0.
   A|B            result is 1 if int(A) or int(B) differ from 0, else 0.

  Since the unary minus has higher precedence than any other operator, for
  example the following expression is valid: x*-y
  Note that the '=' comparison can be inaccurate due to floating point
  precision problems (eg. "sqrt(100)=10" probably returns 0, not 1).

  The class supports these functions:

  abs(A)    : Absolute value of A. If A is negative, returns -A otherwise
              returns A.
  acos(A)   : Arc-cosine of A. Returns the angle, measured in radians,
              whose cosine is A.
  acosh(A)  : Same as acos() but for hyperbolic cosine.
  asin(A)   : Arc-sine of A. Returns the angle, measured in radians, whose
              sine is A.
  asinh(A)  : Same as asin() but for hyperbolic sine.
  atan(A)   : Arc-tangent of (A). Returns the angle, measured in radians,
              whose tangent is (A).
  atan2(A,B): Arc-tangent of A/B. The two main differences to atan() is
              that it will return the right angle depending on the signs of
              A and B (atan() can only return values betwen -pi/2 and pi/2),
              and that the return value of pi/2 and -pi/2 are possible.
  atanh(A)  : Same as atan() but for hyperbolic tangent.
  ceil(A)   : Ceiling of A. Returns the smallest integer greater than A.
              Rounds up to the next higher integer.
  cos(A)    : Cosine of A. Returns the cosine of the angle A, where A is
              measured in radians.
  cosh(A)   : Same as cos() but for hyperbolic cosine.
  cot(A)    : Cotangent of A (equivalent to 1/tan(A)).
  csc(A)    : Cosecant of A (equivalent to 1/sin(A)).
  eval(...) : This a recursive call to the function to be evaluated. The
              number of parameters must be the same as the number of parameters
              taken by the function. Usually called inside if() to avoid
              infinite recursion.
  exp(A)    : Exponential of A. Returns the value of e raised to the power
              A where e is the base of the natural logarithm, i.e. the
              non-repeating value approximately equal to 2.71828182846.
  floor(A)  : Floor of A. Returns the largest integer less than A. Rounds
              down to the next lower integer.
  if(A,B,C) : If int(A) differs from 0, the return value of this function is B,
              else C. Only the parameter which needs to be evaluated is
              evaluated, the other parameter is skipped; this makes it safe to
              use eval() in them.
  int(A)    : Rounds A to the closest integer. 0.5 is rounded to 1.
  log(A)    : Natural (base e) logarithm of A.
  log10(A)  : Base 10 logarithm of A.
  max(A,B)  : If A&gt;B, the result is A, else B.
  min(A,B)  : If A&lt;B, the result is A, else B.
  sec(A)    : Secant of A (equivalent to 1/cos(A)).
  sin(A)    : Sine of A. Returns the sine of the angle A, where A is
              measured in radians.
  sinh(A)   : Same as sin() but for hyperbolic sine.
  sqrt(A)   : Square root of A. Returns the value whose square is A.
  tan(A)    : Tangent of A. Returns the tangent of the angle A, where A
              is measured in radians.
  tanh(A)   : Same as tan() but for hyperbolic tangent.


  Examples of function string understood by the class:

  "1+2"
  "x-1"
  "-sin(sqrt(x^2+y^2))"
  "sqrt(XCoord*XCoord + YCoord*YCoord)"

  An example of a recursive function is the factorial function:

  "if(n&gt;1, n*eval(n-1), 1)"

  Note that a recursive call has some overhead, which makes it a bit slower
  than any other operation. It may be a good idea to avoid recursive functions
  in very time-critical applications. Recursion also takes some memory, so
  extremely deep recursions should be avoided (eg. millions of nested recursive
  calls).

  Also note that the if() function is the only place where making a recursive
  call is safe. In any other place it will cause an infinite recursion (which
  will make the program eventually run out of memory).
</pre>
<br>
Note that <b>WAVY</b> scorefiles use small letters <i>a</i> and <i>b</i>
for the expression.
<p>
<b>WAVY</b> can produce both mono and stereo output.

<h3>Sample Scores</h3>

very basic:
<pre>
   rtsetparams(44100, 2, 256)
   load("WAVY")

   dur = 60

   amp = 20000
   env = maketable("line", 1000, 0,0, .1,1, dur-.1,1, dur,0)

   expr = "a - b"

   wavetA = maketable("wave", 5000, "sine")
   wavetB = maketable("wave", 5000, "tri")

   freqA = cpspch(8.00)
   freqB = makeconnection("mouse", "y", min=100, max=2000, dflt=freqA, lag=80, "freqB")

   phase_offset = makeconnection("mouse", "x", min=0, max=1, dflt=0, lag=80, "phase offset")

   WAVY(0, dur, amp * env, freqA, freqB, phase_offset, wavetA, wavetB, expr)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2, 256)
   load("WAVY")

   dur = 30
   amp = 20000
   env = maketable("line", 1000, 0,0, .1,1, dur-.1,1, dur,0)
   freqA = cpspch(6.00)

   expr = "a * b"

   // try one of these
   wavet = maketable("random", 100, "even", min=-1, max=1, seed=1)
   //wavet = maketable("wave", 5000, "saw")
   //wavet = maketable("wave", 1000, "sine")

   freqB1 = makeconnection("mouse", "x", min=100, max=1000, default=149.0, lag=70, "freqB1")
   freqB2 = makeconnection("mouse", "y", min=100, max=1000, default=149.0, lag=70, "freqB2")
   
   WAVY(start=0, dur, amp * env, freqA, freqB1, 0, wavet, 0, expr, pan=.6)
   WAVY(start=0, dur, amp * env, freqA * 1.01, freqB2, 0, wavet, 0, expr, pan=.4)
</pre>
<br>
<br>

fun stuff!
<pre>
   rtsetparams(44100, 2, 256)
   load("WAVY")

   // set to true (or 1) to let you muck around (blindly) with the waveform
   wavedraw = false

   dur = 60
   amp = 15000
   env = maketable("line", 1000, 0,0, .1,1, dur-.1,1, dur,0)
   pitch = 6.00

   low = 0.01
   high = 0.99
   lfreq = 0.1
   phase_offset1 = makeLFO("tri", lfreq, min=low, max=high)

   // try one of these
   //expr = "(a ^ 5) * .5"
   //expr = "a - b"
   expr = "if (abs(a) < .5, a ^ .1, a * (b - 1))"

   // try one of these
   //wavet = maketable("random", 100, "even", min=-1, max=1, seed=1)
   wavet = maketable("wave", 5000, "saw")

   if (wavedraw) {
      index = makeconnection("mouse", "x", min=0, max=1, dflt=0, lag=80, "index")
      value = makeconnection("mouse", "y", min=-1, max=1, dflt=0, lag=80, "value")
      wavet = modtable(wavet, "draw", index, value, .1)
   }

   WAVY(start=0, dur, amp * env, pitch, 0, phase_offset1, wavet, 0, expr, pan=.6)

   // need a separate LFO instance for this
   phase_offset2 = makeLFO("tri", lfreq + 0.02, min=low, max=high)

   pitch += 0.001
   WAVY(start=0, dur, amp * env, pitch, 0, phase_offset2, wavet, 0, expr, pan=.4)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="AMINST.php">AMINST</a>,
<a href="FMINST.php">FMINST</a>,
<a href="HALFWAVE.php">HALFWAVE</a>,
<a href="MULTIWAVE.php">MULTIWAVE</a>,
<a href="SYNC.php">SYNC</a>,
<a href="VWAVE.php">VWAVE</a>,
<a href="WAVESHAPE.php">WAVESHAPE</a>,
<a href="WAVETABLE.php">WAVETABLE</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

