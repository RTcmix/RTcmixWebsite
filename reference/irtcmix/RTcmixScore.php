<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - RTcmixScore</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h1>iRTcmix Class Reference - RTcmixScore</h1>


<i>[Note: This page is meant to serve as a reference, not as a teaching tool. If you are new to iRTcmix you should start with the <a href="/irtcmix/">demos on the iOS page</a> and the <a href="/tutorials">tutorials</a>.]</i>
<p><br />

The <i>RTcmixScore</i> class is a utility class used to store Minc-based RTcmix scores (see the <a href="/tutorials/standalone.php">RTcmix documentation</a>) and send them for parsing/scheduling to the RTcmix 'engine' using the <i>RTcmixPlayer</i> method <i>parseScoreWithRTcmixScore:</i>. Using this method allows you to have variable values that are managed in your iOS app. These stored values will then be updated in the score prior to being sent to the Minc parser. 
<p>


<h2>RTcmixScore Properties</h2>


<a name="mainScoreParameters"></a>
<h4>NSMutableDictionary *parameterValues</h4>

Stores the values that will replace the "%#" tokens before sending the main character score buffer to the RTcmix parse_score() function.

<a name="setupScoreParameters"></a>
<h4>NSMutableDictionary *parameterInlets</h4>

Stores the inlet number corresponding to any stored "%#" pfield variable.
	

<h2>RTcmixScore Methods</h2>

<a name="initWithScore"></a>
<h4>- (id)initWithScoreFile:(NSString *)score</h4>

Initializes an RTcmixScore object from a file.
<p>
params:
<ul>
	<li>(NSString *)score -- An NSString containing the pathname to the RTcmix scorefile.</li>
</ul>

<a name="initWithNSString"></a>
<h4>- (id)initWithNSString:(NSString *)score</h4>

Initializes an RTcmixScore object from a string.
<p>
params:
<ul>
	<li>(NSString *)score -- an NSString containing the text of the RTcmix score.</li>
</ul>

<h2>Replacing Variables with %#</h2>

Of special note is the "%#" variable used in iOS RTcmix scores. This variable is similar to the "$N" ($1, $2, ...) variables used to bring external values into the score prior to RTcmix parsing in the Max/MSP <a href="/rtcmix~/"><i>irtcmix~</i></a> object. <i>RTcmixScore</i> stores values in an NSMutableDictionary to be substituted in place of the "%#" tokens in the score before the RTcmix parse_score() function is called. Note that if you are not using this feature (i.e. you are sending static scores that are not programatically changed by your app), it will generally make more sense to store your score in an NSString and send to the parser using the <i>RTcmixPlayer</i> method <i>parseScoreWithNSString:</i> method.
<p>
Suppose we have a file in our bundle called "MyRTcmixScore.sco" contaning the following lines:

<pre>
	beepFrequency = %#
	beepDuration = %#
	beepAmplitude = %#
	
	WAVETABLE(0, beepDuration, beepAmplitude, beepFrequency)
</pre>

We find the path to the scorefile:

<pre>
	NSString *scorefilepath = [[NSBundle mainBundle] pathForResource:@"MyRTcmixScore" ofType:@"sco"];
</pre>

We then create an <i">RTcmixScore</i> object:

<pre>
	RTcmixScore *myscore = [[RTcmixScore alloc] initWithScore: scorefilepath];
</pre>

Now we have an <i>RTcmixScore</i> object named <i>myscore</i> that holds the text of the score as well as placeholder objects for any variable that has a value of "%#" in an NSMutableDictionary keyed to the variable names. Before sending the score to RTcmixPlayer for parsing, we must assign values to the variables. Since NSDictionary stores objects (i.e. not ints, floats, etc.), you must store any numbers in an NSNumber. NSStrings may also be used. 

<pre>
	NSNumber *beepFrequencyObject = [NSNumber numberWithFloat:262.626];
	NSNumber *beepDurationObject = [NSNumber numberWithFloat:2.5];
	NSNumber *beepAmplitudeObject = [NSNumber numberWithInt:26000];
</pre>

These objects can now then be sent to the RTcmixScore object <i>myscore</i> for storage in the <i>parameterValues</i> NSMutableDictionary. The dictionary keys are the variable names given in the RTcmix score.

<pre>
	[myscore.parameterValues setObject:beepFrequencyObject forKey:@"beepFrequency"];
	[myscore.parameterValues setObject:beepDurationObject forKey:@"beepDuration"];
	[myscore.parameterValues setObject:beepAmplitudeObject forKey:@"beepAmplitude"];
</pre>

Now, when you send <i>myscore</i> to <a href="RTcmixPlayer.php">RTcmixPlayer</a> through the <a href="RTcmixPlayer.html#parseScoreWithRTcmixScore">-parseScoreWithRTcmixScore:</a> method it will insert the proper values for all stored variables. After substitution from the elements in <i>parameterValues</i>, the scorefile that will be sent to the Minc parser will look like this:

<pre>
	beepFrequency = 262.626
	beepDuration = 2.5
	beepAmplitude = 26000
	
	WAVETABLE(0, beepDuration, beepAmplitude, beepFrequency)
</pre>

<h2>Using %# Replacement with PField Variables</h2>

PField variables are dynamic variables that may change value during score execution. See <a href="/tutorials/pfields.php">A Short Tour of PField Capabilities</a> for more a more detailed discusion. RTcmixScore is also able to store and modify these values. Starting with a similar score:

<pre>
	beepFrequency = makeconnection("inlet", 1, %#) 
	
	WAVETABLE(0, 1000, 26000, beepFrequency)
</pre>

First we find the path to the score file in the application bundle and initialize our score object (as we did above):

<pre>
	NSString *scorefilepath = [[NSBundle mainBundle] pathForResource:@"MyRTcmixScore" ofType:@"sco"];
	RTcmixScore *myscore = [[RTcmixScore alloc] initWithScore: scorefilepath];
</pre>

Now we may set the value of stored variables prior to parsing (again, as above): 
<pre>
	NSNumber *beepFrequencyObject = [NSNumber numberWithFloat:262.626];
	[myscore.parameterValues setObject:beepFrequencyObject forKey:@"beepFrequency"];
</pre>

After substitution from the elements in <i>parameterValues</i>, the scorefile that will be sent to the Minc parser will look like this:

<pre>
	beepFrequency = makeconnection("inlet", 1, 262.626) 
	
	WAVETABLE(0, 1000, 26000, beepFrequency)
</pre>

Since PField variables may be updated dynamically, we can send a message to change the value while the script is running. This is done by sending a message do the "inlet" of the variable. The inlet number corresponding to a PField variable is stored in RTcmixScore so you don't have to keep track of it. 

<pre>
	NSInteger myFreqInlet = [[self.parameterInlets objectForKey:@"beepFrequency"] integerValue];
</pre>

We can send a new value to the running score using the RTcmixPlayer <i>setInlet:withValue:</i> method:

<pre>
	[self.myrtcmixPlayer setInlet:myFreqInlet withValue:440.0];
</pre>


			
			
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
