<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - </title>

	<link rel="stylesheet" type="text/css" href="/includes/style.css">

</head>
<body>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>Minc</h3>
<i>default scorefile parsing/interface language for RTcmix</i>
<br>
<br>
<b>Minc</b> is the default 'interface' for RTcmix, invoking the command
<pre>
       CMIX < some_score.file
</pre>
will use <b>Minc</b> to parse the score and make the appropriate function
calls to run RTcmix.  There are other options, including the ability
to run RTcmix from
<a href="/tutorials/perl.php">perl</a>,
<a href="/tutorials/python.php">python</a>,
<a href="/tutorials/embed.php">embedded</a>
within another application, or through a
<a href="/tutorials/socket.php">TCP/IP socket</a>.
<b>Minc</b> is also used to parse buffer-scripts in the Max/MSP
<a href="/rtcmix~/">rtcmix~</a>
object and in the
<a href="/iRTcmix/">iRTcmix</a>
package for iOS devices.
<p>
<b>Minc</b> takes most of its functionality from the "C" programming
language, including
flow-of-control features such as <i>for</i> and <i>while</i>
loops, <i>if</i> decision-constructs, etc.  See the
<a href="/tutorials/standalone.php">RTcmix tutorial</a>
(especially the later sections about algorithmic composition)
for examples of <b>Minc</b> use.  The biggest differences between
<b>Minc</b> and "C" is the lack of pre- and post-fix operators in
<b>Minc</b> (i.e. "i++" or "--counter") and the absence of semicolons
as line/statement terminators (note:  semicolons are still required in
"for(...)" statements).  Semicolons <i>may</i> be used at the end of
<b>Minc</b> lines, but they are not required (they are simply ignored).
<p>
Some other useful features of <b>Minc</b>:
<ul>
<li>Combination assignment operators are supported.  This means that
expressions such as:
<pre>
   for (i = 0; i < 7; i += 2) { ...
</pre>
and
<pre>
   while (asympt > 0.001) { asympt *= 0.5; ...}
</pre>
will be parsed correctly.
<br>
<br>
<br>


<li>The <b>Minc</b> array facility is very useful.
The following are acceptable <b>Minc</b> constructions:
<pre>
   a = { 1, 2, 3, 4, 5 }
   INSTRUMENT(a[3], a[0], ...)

   b = {} // note that "b" is dimensioned by use
   for (i = 0; i < 10; i += 1)
      b[i] = i * 3
</pre>
<b>Minc</b> arrays can also contain 'mixed' data types:
<pre>
   afloat = 1.2345
   astring = "hey hey!"
   b = { 123, afloat, "ho ho", astring }
</pre>
Arrays can also contain
<a href="/reference/instruments/pfield-enabled.php">pfield-handle</a>
handles for tables, etc.:
<pre>
   e = {}
   x = 1
   for (i = 0; i < 10; i += 1) {
      e[i] = maketable("random", 1000, "linear", min=x, max=x*2, seed=x*3)
      x *= 2
   }
</pre>
Arrays can be passed into
<a href="maketable.php">maketable</a>
consructions:
<pre>
   d = { 0,0, 1,1, 3,1, 5.5,0 }
   env = maketable("line", 1000, d)
</pre>
Array elements may also include other arrays.  However, to access
the sub-arrays, a 'temp' array variable is necessary:
<pre>
   arr1 = { 1, 2, 3, 4, 5, 6, 7 }
   arr2 = { 77, 87, 97, 107 }
   superarr = { arr1, arr2 }

   temparr = superarr[0]
   for (i = 0; i < len(arr1); i += 1) {
      print(temparr[i])
   }
</pre>
'temparr' in the above code temporarily represents the 'arr1' array.
Note that arrays of different lengths may be stored in a 'super' array.
<p>
The <a href="len.php">len</a>
built-in function is used to determine the length of an array
(as well as lengths of other <b>Minc</b> data-types).
<p>
Arrays can be concatenated using the '+' operator:
<pre>
	first = { 1, 2, 3 }
	second = { 4, 5, 6 }
	third = first + second
	print(third)
	[1, 2, 3, 4, 5, 6]
</pre>
<p>
All the elements of an array can be modified via operators +, -, *, and / followed a float variable:
<pre>
	arr = { 1, 2, 3 }
	arr = arr + 10
	print(arr)
	[11, 12, 13]
	arr = arr * 100
	print(arr)
	[1100, 1200, 1300]
</pre>

<li>Comments may be included in <b>Minc</b> scripts using "C"
comment syntax:
<pre>
   /* a comment may be between two slash-asterisk markers */

   /* and it
      may also span several lines
   */

   // anything after two backslashes on a line will be construed as a comment
</pre>
<br>


<li>Actions are performed by <b>Minc</b> functions or
operators ("+", "-", "*", "/", "^", etc.).  Functions may be
Instruments or built-in functions used to perform scorefile calculations.
Return values are assigned to <b>Minc</b> variables with the "="
assignment operator:
<pre>
   aval = somecalculation(anotherval, something_else)

   thisone = thatone + those

   ANINSTRUMENT(with, many, different, parameters)
</pre>
In addition, operations and functions may be embedded (or 'nested'):
<pre>
   INSTRUMENT(somefunction(var1, var2), val^3.2, aval, 3.1654, func1(func2(array[3])))
</pre>
<br>

<li>Several "C" conditional-branching
statements are included in <b>Minc</b> ("if-then-else", "while").
The standard "C" comparison operators ("==", "&&", "||", "!=", ">",
"<", etc.) are used for the conditional comparison.  Using parantheses
to group and determine precedence of evaluation is also supported:
<pre>
   if ((val > 2.0) && < (val2 != 0)) { ... }
</pre>
Note that the "do-until" and "switch" statements are not supported in <b>Minc</b>.
<br>
<br>
<br>

<li> <b>Minc</b> supports the ability to create custom functions right in your score.
	The format for these functions is nearly identical to that used to define functions
	in the C programming language:

<pre>
return_type function_name(arg0_type arg0_name, arg1_type arg1_name, ..., argN_type, argN_name)
{
    &lt;function body&gt;
}
</pre>
<br>

Rules:<br><br>

<ul>
	<li>The return_type and the argument types must be either float, string, handle (the type for tables, etc.), or list (the type for MinC arrays).</li>
	<li>The function can have any number of arguments, including zero.</li>
	<li>It must return a value of one type or another.  Use a dummy zero if nothing else.  The type of the variable returned must match <return_type>.</li>
	<li>Use the 'return' keyword to mark the place where the value should be returned.  There can be more than one such place (e.g. inside if() blocks).</li>
	<li>The arguments passed to the function must match the declared types (i.e., no type conversion supported).</li>
	<li>If the score provides fewer arguments that the function expects, the remainder will be set to 0 (or NULL).  This is legal but you will get a friendly warning.</li>
	<li>There can only be one function defined with any given function name.</li>
	<li>Functions can call other functions, including themselves (recursively).</li>
	<li>A function must be defined before (i.e., above) the place where it is first used (except when it is calling itself).</li>
	<li>Functions can be defined in a separate file which is "include"d by a score.  This makes it easy to create and re-use function "libraries"!</li>
	<li>The body of a function may contain any legal Minc score commands.</li>
	<li>Variable visibility rules.  These are a bit complicated.
		<ul>
			<li>Any variable declared globally in the main score (outside of any function) is visible inside the body of all functions.</li>
			<li>This is true even if that global variable is declared after the function is declared in the score, as long as it is declared before the function is called.</li>
			<li>Any variable declared inside a function is not visible outside of the function.</li>
		</ul></li>
</ul>

<br>
<br>

<li>All <b>Minc</b> numerical values are floating-point, although
care is taken to prevent round-off errors from causing problems
for counting variables that would normally use integers.  The
<a href="trunc.php">trunc</a>
and
<a href="round.php">round</a>
built-in functions can be used to guarantee a correct 'integer'
value.
<br>
<br>

<li><b>Minc</b> can also handle character-strings and the
<a href="/reference/instruments/pfield-enabled.php">pfield-handle</a>
variables (obviously!), including operations performed
on those types.  The
<a href="stringify.php">stringify</a>
function can be used to coerce a <b>Minc</b> string into a
floating-point value that RTcmix instruments may use internally.
<br>
<br>

<li>The
<a href="index_command.php">index</a>
and the
<a href="type.php">type</a>
commands are also very useful with <b>Minc</b> variables and
arrays.  The
<a href="type.php">type</a>
command can determine the <b>Minc</b> data-type of a particular
variable, and the
<a href="index_command.php">index</a>
can retrieve items at a particular index within an array.  Also
be awafe that
<b>Minc</b> lists will also be 'unpacked' properly
in many scorefile commands, such as the
<a href="print.php">print</a>
and
<a href="maketable.php#literal">maketable("literal"...)</a>
commands.
<pre>
   a = { 1, 2, 3, 4, 5, 6 }
   print(a)  // print can handle arrays

   foo = "foo"; bar = "bar"
   afloat = 1.2345; astring = "blah"
   b = { 123, afloat, "blabber", astring, a, foo + bar } // an array can embed other arrays
      // also note the string concat with '+' operator

   numitems = len(b) // get length of array
   printf("array b: %d items: %l\n", numitems, b)  // printf for ints and lists (i.e., arrays)
   printf("afloat=%f, astring=%s\n", afloat, astring) // printf for floats and strings

   idx = index(b, 345) // Return a zero-based index into array (arg 1) of item (arg 2)
   print(idx)
</pre>
<br>

<li>The
<a href="include.php">include</a>
command can be used to embed one (or more) <b>Minc</b> scorefiles within
another.
<br>
<br>

<li>When <b>Minc</b> encounters a parsing error, it generally exits
(RTcmix) or returns a FATAL_ERROR value (embedded apps like
<a href="http://rtcmix.org/rtcmix~/">rtcmix~</a>
or
<a href="http://rtcmix.org/iRTcmix/">iRTcmix</a>)
with an attempt to identify the number of the line with the syntax
error.  Line numbers are cumulative, however, so for embedded apps
the reported line may be radically different from the line in the
sent scorefile.
<br>
<br>

<li>The original <b>Minc</b> parser was coded by Lars Graf.  Additional
modifications were made by John Gibson, Doug Scott and others.
</ul>


<br>
<hr>
<br>
The following is from the original cmix <b>Minc</b> documentation.  Some
is a bit dated, but the basic concepts are still valid.  For a more
complete and current grammar, see the RTcmix/src/parser/minc/minc.y file:
<br>
<br>
<br>

<ul>
     <B>Minc</B> (<b>M</b>inc <b>i</b>s <b>n</b>ot <b>c</b>)
is the data specification language for
     cmix.  It was written by Lars Graf. <B> Minc</B> <i>almost</i> follows a
     C-like syntax. Arithmetic, conditional and logical expressions are permitted, as well as looping.  Any statment of
     the form      <B> foo(val,num, etc) </B>results in the execution of
     <B>foo()</B> if it is a cmix procedure and declared as such, either
     in the user's profile.c or in cmix's ug_intro.c.  If it is
     neither the evaluated terms within parentheses will simply
     be printed and returned.  The arguments within the
     parentheses are passed to the cmix procedure in its float *p
     array.  All variables must be declared as float. The sign ;
     has the meaning 'clear out any syntax errors'.  cmix routines
     such as open,  input,  output which have a file name as a
     first argument, must pass that argument between " signs.
<P>

    <B>Minc</B>, has two modes of operation: batch and interactive (the
     default).  The only difference between them is that loops
     cannot be executed in interactive mode.  To run in batch
     mode a -b flag must be specified on the Cmix command line,
     and all data must be entered either by redirecting input
     from a file, or by typing all data followed by a &lt;cntrl-D&gt;.
     Comments are inclosed by /* and */ as in C.  Any user function which returns a value can return that value to Minc if
     it is declared as a type double and introduced in the
     profile.c file.
<P>


     The following is Lars Graf's formal statement of the
     language:<P><PRE>
     Order of precedents:

     ||
     &&
     =  !=
     &lt; &gt;  &lt;= &gt;=
     + -
     * /
     **  ^


     CASTS

     Syntax:

     prg: stml

     stml :        stmt
          |   stml  stmt
          |   stmt ;
          |   stml  stmt ;

     stmt:         float idl           /* declare ids */
          |   id  = exp
          |   IF bexp stmt
          |   IF bexp stmt ELSE stmt
          |   WHILE bexp stmt
          |   FOR ( stmt , bexp , stmt ) stmt
          |   id ( expl )     /* a call to a cmix function  */
          |   { stml }


     idl:     id              /* like: fnct_name(arg1,arg2,arg3) */
          |   idl , id

     id:   any letter/digit/"_" combination, but start with letter

     expl:       exp
          |   exp ',' expl
          |   or no function argument

     bexp:         exp
          |   ! bexp
          |   bexp &&  bexp
          |   bexp ||  bexp
          |   bexp = bexp   /* note the comparison of booleans */
          |   exp < exp
          |   exp > exp
          |   exp != exp
          |   exp <= exp
          |   exp >= exp
          |   TRUE
          |   FALSE

     exp:     exp ** exp
          |   - exp
          |   exp * exp
          |   exp / exp
          |   exp + exp
          |   exp - exp
          |   ( bexp )
          |   any number: e.g. 34 -645.34 234.E23  ...


     Note:

     1)  Semicolon and <crt> are optional.

     2)  '=' is used for assignments and boolean expressions.

     3)  False = 0; True = 1(or nonzero).




     Samples:

     /*  this is a legal comment  */

     float foo,x;

     if i=3 && foo&gt;4  say_mumble( foo**i , i-foo*3)
          else mumble_foo()


     while x=3 {

          this_is_a_cmix_function_call()
          x= 5 * (foo=i)     /* this is slime */

     while true nested_loops_are_possible()
     }


     for (x=1, x &lt;= 10,x=x+1) dispatch(x)


     Minc also has the following facilities:

     1)  function calls can return values

          e.g.      i = rand(j)

          NOTE:  those are calls to your own C-functions.
                 You may adjust your dispatcher and your functions accordingly
                 The function must be introduced in the profile, and must
                 be of type double.

     2)  assignment statements have the value of the assignment.

          e.g.      i = j = 5
                 while (i=j) == 5  { mumblings .. }

     3)  strings can be passed as arguments.

          e.g.      file_id = open("name of file",2)
                    printf("some string %f %f0,i,j)
               /* of course, the dispatcher has to know about printf */

          NOTE:   the string pointer is passed as a double; to convert
               back, you have to first cast it into an integer, and then
               you have to cast the integer into a char*.

     4)  use '=' for assigment; and '==' as the booleam equal operator.


     Here is a simple example file:

     open("sf/bigsound",0,0)
     open("sf/bigmix",1,2)
     sfclean(1)
     float a,b,c,d
     a=2 b=3 c=28000 d=-4
     sound(a,b,c,1,22*19,d=d-a)
     sound(a=a+2, b+.1, 99, d=d-a+2)
</PRE>
</ul>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
