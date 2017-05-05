<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - RTcmixPlayer</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h1>iRTcmix Class Reference - RTcmixPlayer</h1>


<i>[Note: This page is meant to serve as a reference, not as a teaching tool. If you are new to iRTcmix you should start with the <a href="/irtcmix/">demos on the iOS page</a> and the <a href="/tutorials">tutorials</a>.]</i>
<p><br />


The <i>RTcmixPlayer</i> class acts as the interface to the RTcmix 'engine' that drives audio in iOS. It also handles the RTcmix-parsing of score texts with the concommitant scheduling and realization of audio events designated in RTcmix scores.

<h2>RTcmixPlayer Properties</h2>

<a name="sampleRate"></a>
<h4>CGFloat sampleRate</h4>

The RTcmixPlayer variable holding the audio sampling rate (the default is 44100.0).

<a name="vectorSize"></a>
<h4>NSInteger vectorSize</h4>

The size of the buffers used by RTcmix. This should be a power of 2 (the default is 512). Smaller values decrease responsive latency, while larger values allow for more efficient processing (i.e. you can do more) but increase responsive latency.

<a name="vectorSize"></a>
<h4>NSInteger numberOfChannels</h4>

The number of channels in the audio stream (the default is 2).

<a name="audioInputFlag"></a>
<h4>BOOL audioInputFlag</h4>

"YES" if audio input enabled, "NO" if output only.

<a name="audioInputFlag"></a>
<h4>BOOL shouldRunInBackground</h4>

"YES" if RTcmix is allowed to generate audio in the background, "NO" if not.

<a name="volume"></a>
<h4>CGFloat volume</h4>

The multiplier used to scale the RTcmix output volume (usually 0.0 - 1.0; the default is 1.0). (Warning: This is likely to be deprecated soon. You should use the <i>setVolumeLevel:</i> method instead of changing the <i>volume</i> property directly.)

<a name="scoreDict"></a>
<h4>NSMutableDictionary *scoreDict</h4>

A pointer to the dictionary used for storing and access RTcmix score objects.

	
<h2>RTcmixPlayer Methods</h2>


<h3>Initialization and Setup</h3>


<a name="scoreDict"></a>
<h4>+ (id)sharedManager</h4>

This is the method used to instantiate a new RTcmixPlayer object as a singleton for use in an iRTcmix application. This will guarantee that only one instance of the RTcmix engine and concomitant audio processing will be running throughout all coded objects in the app.

<a name="scoreDict"></a>
<h4>- (void)startAudio</h4>

This is used to start the RTcmix engine and audio conversion. If not set, the method will assign default values for these variables:

<pre>
	self.volume = 1.0;
	self.numberOfChannels = 2;
	self.sampleRate = 44100.0;
	self.vectorSize = 512;
</pre>


<a name="scoreDict"></a>
<h4>- (void)resetAudio</h4>

Used to halt current RTcmix processing and restart audio processing.


<h3>Audio Utility</h3>

<a name="scoreDict"></a>
<h4>- (void)pauseAudio</h4>

Temporarily halts the RemoteIO Audio Unit and RTcmix. Scheduled events and audio will not be removed from the conversion queue, and will be active if audio conversion is re-established. This is used for an incoming pre-emptive application (like a phone call).

<a name="scoreDict"></a>
<h4>- (void)resumeAudio</h4>

Restarts audio after the -pauseAudio method has been called. All prior property values and parameters are retained from the previously active Audio Session.

<a name="scoreDict"></a>
<h4>- (void)setVolumeLevel:(float)newvolume</h4>

Method to set the RTcmix multiplier volume for audio output (usually 0.0 - 1.0).
<p>
param:
<ul>
	<li>(float)newvolume -- a floating-point number for the multiplier value</li>
</ul>


<h3>Data and Communication</h3>


<a name="scoreDict"></a>
<h4>- (int)setSampleBuffer:(NSString *)bufferName withSoundFile:(NSString *)soundFilePath</h4>


This will load samples from an existing soundfile for access by RTcmix (using the rtinput("MMBUF", "name") score function) to use in input signal-processing operations. The buffer memory for the soundfile is allocated in this method.
<p>
note: at present, only loading of AIFF-type soundfiles into an internal buffer is supported.

params:
<ul>
	<li>(NSString *)bufferName -- the 'name' of the buffer, used in the RTcmix score - rtinput("MMBUF", "name") - to reference a buffer containing sound samples</li>
	<li>(NSString *)soundFilePath -- the path to the soundfile to be loaded into the buffer.</li>
</ul>


<a name="scoreDict"></a>
<h4>- (void)setInlet:(int)inlet withValue:(Float32)value</h4>

This creates an 'inlet' connection to RTcmix via the makeconnection("inlet", ...) score function. This allows dynamic updating of PFields in RTcmix Instruments.
<p>
params:
<ul>
	<li>(int) inlet -- an inlet index nunber set in the RTcmix score</li>
	<li>(Float32) value -- the initial value of the inlet</li>
</ul>


<h3>Score Methods</h3>

<a name="scoreDict"></a>
<h4>- (void)addScore:(NSString *)name withString:(NSString *)score</h4>

This method takes a the text of a Minc score and stores it as an RTcmixScore object in the RTcmixScore 'dictionary'. This allows for easy retrieval of this score during sound processing and synthesis. The "name" parameter is used as the key for retrieval from the RTcmixScore dictionary.
<p>
params:
<ul>
	<li>(NSString *)name -- key name used to reference the score</li>
	<li>(NSString *)score -- text (string) of a valid RTcmix (Minc) score</li>
</ul>

<a name="scoreDict"></a>
<h4>- (void)parseScoreWithRTcmixScore:(RTcmixScore *)score</h4>

This method takes a valid RTcmixScore (see the <a href="RTcmixScore.php">documentation for the RTcmixScore class</a>) and calls the RTcmix parse_score() function to parse and schedule (using the RTcmix Minc parser) the instruments and notes of the score.
<p>
params:
<ul>
	<li>(RTcmixScore *)score -- a valid RTcmixScore object reference</li>
</ul>

<a name="scoreDict"></a>
<h4>- (void)parseScoreWithNSString:(NSString *)score</h4>

This method takes a the text of a Minc score (as an NSString) and calls the RTcmix parse_score() function to parse and schedule the instruments and notes of the score.
<p>
params:
<ul>
	<li>(NSString *)score -- text (string) of a valid RTcmix (Minc) score</li>
</ul>

<a name="scoreDict"></a>
<h4>- (void)flushAllScripts</h4>

This calls the RTcmix flush_sched() function to remove all scheduled events from the RTcmix queue. The RTcmix engine continues to run after this is invoked, however. All symbols and allocated memory by the RTcmix Minc parser remain active.


<h3>Delegate Methods</h3>

Three methods are designated as 'delegate' methods for the RTcmixPlayer object. This means that they are intended to be coded (if needed) by in the implementing application in the class chosen as the <i>RTcmixPlayerDelegate</i>. These methods are how you may receive communicate back to your application from RTcmix.

<a name="scoreDict"></a>
<h4>- (void)maxBang</h4>

The method called when the RTcmix MAXBANG() instrument generates 'bangs.'

<a name="scoreDict"></a>
<h4>- (void)maxMessage:(NSArray *)message</h4>

The method called when the RTcmix MAXMESSAGE() instrument generates messages to return data from RTcmix.
<p>
param:
<ul>
	<li>(NSArray *)message - the array returned by RTcmix</li>
</ul>


<a name="scoreDict"></a>
<h4>- (void)maxError:(NSString *)error</h4>

This method allows RTcmix reporting and error messages to be displayed (see the RTcmix documentation for the <a href="/reference/scorefile/print_on.php">print_on()</a> scorefile command).
<p>
param:
<ul>
	<li>(NSArray *)error - the message returned by RTcmix</li>
</ul>



<h2>Basic Implementation</h2>


To access the functionality of the RTcmixPlayer class, you might define an RTcmixPlayer property of your ViewController called *rtcmixManager:

<pre>
	#import "RTcmixPlayer.h"

	@interface myViewController : UIViewController

	@property (nonatomic, strong) RTcmixPlayer *rtcmixManager;
</pre>

Then the underlying RTcmix engine could be instantiated and started with the following code:

<pre>
	self.rtcmixManager = [RTcmixPlayer sharedManager];
	[self.rtcmixManager startAudio];
</pre>

Typically this code would be located in the -viewDidLoad method of your ViewController; it will be called when the application is loaded on the iDevice.
<p>
Note the initialization of the RTcmixManager property (self.rtcmixManager) using the sharedManager method.  The RTcmixManager is being used as a 'singleton' object, with the RTcmixPlayer class defining a set of 'singleton' methods for this kind of use.  That way a number of different ViewControllers (for more complex applications) all have access to the same underlying audio engine.
<p>

Next you will need a score to send to RTcmix for parsing. The simplest way is to send an NSString to the <i>parseScoreWithNSString:</i>
method as in this example with a one line RTcmix score:
<pre>
	[self.rtcmixManager parseScoreWithNSString:@"WAVETABLE(0, 2, 24000, 262.626)"]
</pre>


You may also use the <a href="RTcmixScore.php">RTcmixScore class</a>. First, create a RTcmixScore object for storage in RTcmixPlayer:

<pre>
	NSString *myScorePath = [[NSBundle mainBundle] pathForResource:@"MyScoreFile" ofType:@"sco"];
	NSString *myScoreText = [NSString stringWithContentsOfFile:mainScorePath encoding:NSUTF8StringEncoding error:nil];
	[self.rtcmixManager addScore:@"MyScore" withString:myScoreText];
</pre>

Then use the <i>parseScoreWithRTcmixScore:</i> method to send the score to RTcmix:

<pre>
      [self.rtcmixManager parseScoreWithRTcmixScore:helloScore];
</pre>

<p>
There are a number of other methods for connecting interface elements with the RTcmix audio model, including -setInlet, -maxBang, -setSampleBuffer, etc. These methods reflect the structure of the max/msp rtcmix~ object for making the interface-to-RTcmix connection.  This is also why several of the methods are named "max"-something -- it has nothing to do with the maximum value of a parameter.  See the <a href="/irtcmix/">demo projects</a> for examples of how these methods are used.
<p>
The RTcmixPlayer class has methods to control audio playback in certain situations (-pauseAudio, -resumeAudio, -setVolumeLevel, etc.).  Along with these methods are instance variables that cab set or report the characteristics of the audio being produced (sampleRate, vectorSize, numberOfChannels, etc.).  The RTcmixPlayer also instantiates the low-level callbacks necessary for audio production (-rtcmixPerformCallback) and for servicing interruptions and property-value changes (-interruptionListenerCallback, -propListenerCallback).
			
			
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
