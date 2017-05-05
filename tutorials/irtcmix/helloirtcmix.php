<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Tutorials - Hello iRTcmix</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h1>iRTcmix Tutorials - Hello iRTcmix</h1>


Welcome to the wonderful world of iOS programming using iRTcmix! This tutorial is intended as a basic introduction to building an iOS application with iRTcmix. We will be using the code in the simple "Hello iRTcmix" application included in the "iRTcmix Basics" demo distribution on the <a href="/irtcmix/">iRTcmix page</a>. 
<p>
Although the "Hello iRTcmix" app is fully-coded in the distribution, we will take you through the steps we used to create the application, including how we use the <i>RTcmixPlayer</i> and <i>RTcmixScore</i> classes to start the RTcmix engine and parse the RTcmix score. Essentially we will be guiding you through the software coding involved to build the working "Hello iRTcmix" app. We will be starting from the basic set-up of the XCode project, with all the appropriate files and settings.
<p>
This tutorial is intended to be useful to programmers of all skill levels. However, some familiarity with XCode, the iOS SDK, and the Objective-C programming language is necessary. If you have yet to dabble in iOS programming you should head to your friendly neighborhood (or internet) bookstore and get a beginners guide to iOS programming. You don't need to master the SDK to get started with iRTcmix, but it will help to have a basic understanding of the principles of iOS programming. We also assume familiarity with RTcmix and digital music synthesis/processing in general.
<p>
Also, you will need to register with the <a href="https://developer.apple.com">Apple Developer Program</a> in order to get started programming for iOS. Registration is free, but in order to test your programs on a device, you will need to subscribe to the $99/year program. Until then, you are limited to testing in the simulator that runs on the Mac. 


<h2>Setting up an Xcode Project</h2>


The first thing you need to do is set up an Xcode project that has all the necessary files and settings. Instructions can be found on the <a href="/tutorials/irtcmix/projectsetup.php">iRTcmix Xcode Project Setup Guide</a> page. After you have followed the instructions there to set up a blank project you will be ready to follow the tutorial below.


<h2>Configuring the ViewController</h2>

We are adopting the model-view-controller approach to programming an app, and we want to keep the logic and data for the program concentrated in one place. The iRTcmix-provided <i>RTcmixPlayer</i> and <i>RTcmixScore</i> classes already have the logic and data for audio production and score-parsing built into them. We'll trace the flow of control from a user-initiated event to the parsing/sending of a score to the RTcmix engine for audio realization. Two different methods for reading an RTcmix score are included in this demo.
<p>
When XCode builds a simple 'Single View Application' the ViewController class will look something like this: 
<p>

<i>ViewController.h:</i>

<pre>
	#import &lt;UIKit/UIKit.h&gt;

	@interface ViewController : UIViewController

	@end
</pre>

<i>ViewController.m:</i>

<pre>
	#import "ViewController.h"

	@implementation ViewController

	... followed by several methods for potential use in our app ...
</pre>

First of all, let's add the code to allow the ViewController to address the <i>RTcmixPlayer</i> and <i>RTcmixScore</i>
classes. We will be using these to control our audio system and manage our RTcmix score data. In the <i>ViewController.h</i> file, we make the following modifications:

<pre>
	#import &lt;UIKit/UIKit.h&gt;
	#import "RTcmixPlayer.h"
	#import "RTcmixScore.h"

	@interface ViewController : UIViewController

	@property (nonatomic, strong)	RTcmixPlayer	*rtcmixManager;
	@property (nonatomic, strong)	RTcmixScore	*beepScore;
</pre>

The

<pre>
	#import "RTcmixPlayer.h"
	#import "RTcmixScore.h"
</pre>

statements bring in the header files so that the ViewController "knows" about the actions possible with the <i>RTcmixPlayer</i> and <i>RTcmixScore</i> classes. We then declare two properties to access those classes (<i>*rtcmixManager</i> and <i>*beepScore</i>).
<p>
While we're at it, we'll add three method declarations that we will use for connecting to buttons on the interface (using the Interface Builder). These are declared as IBAction methods -- that's how XCode determines that they can be used for interface events:

<pre>
	-(IBAction)goPlingScore; // executes an RTcmix score
	-(IBAction)goBeepScore; // executes an RTcmix score
	-(IBAction)flush; // clears all running scores
</pre>

Our finished <i>ViewController.h</i> file now looks like this:

<pre>
	#import &lt;UIKit/UIKit.h&gt;
	#import "RTcmixPlayer.h"
	#import "RTcmixScore.h"

	@interface ViewController : UIViewController

	@property (nonatomic, strong)	RTcmixPlayer	*rtcmixManager;
	@property (nonatomic, strong)	RTcmixScore	*beepScore;

	-(IBAction)goPlingScore; // executes an RTcmix score
	-(IBAction)goBeepScore; // executes an RTcmix score
	-(IBAction)flush; // clears all running scores

	@end
</pre>

In the corresponding <i>ViewController.m</i> file, we modify the code to look like this:

<pre>
	#import "ViewController.h"

	@interface ViewController ()

	@end

	@implementation ViewController

	-(IBAction)goPlingScore {
		// method 1 to play a score - parseScoreWithRTcmixScore:
		[self.rtcmixManager parseScoreWithRTcmixScore:self.beepScore];
	}

	-(IBAction)goBeepScore {
		// method 2 to play a score - parseScoreWithNSString:
		[self.rtcmixManager parseScoreWithNSString:@"WAVETABLE(0, 5, 24000, 440, .5)"];
	}

	-(IBAction)flush {
		// stop all running scores
		[self.rtcmixManager flushAllScripts];
	}
</pre>

This codes the IBaction method calls (<i>-goPlingScore</i>, <i>-goBeepScore</i> and <i>-flush</i>) that we have added to our <i>ViewController</i> class.


<h2>Using the RTcmixPlayer and RTcmixScore Classes</h2>

In order to use the <i>rtcmixManager</i> property in our <i>ViewController</i> class, we need to set it up and make any necessary initializations and variable assignments. We do this by adding functionality to the XCode-generated <i>-viewDidLoad</i> method. This method gets called right after the application interface is loaded onto the iDevice, so it is appropriate that we use it to instantiate and start our RTcmix capabilities.
<p>
The <i>-viewDidLoad</i> method generated by XCode looks like this:

<pre>
	- (void)viewDidLoad
	{
		[super viewDidLoad];
		// Do any additional setup after loading the view, typically from a nib.
	}
</pre>

Our modified <i>-viewDidLoad</i> is this:

<pre>
	- (void)viewDidLoad
	{
		[super viewDidLoad];

		// initialize the RTcmixPlayer and start audio.
		self.rtcmixManager = [RTcmixPlayer sharedManager];
		[self.rtcmixManager startAudio];

		// load the score from the file HelloiRTcmix.sco and assign it to beepScore
		NSString *scorePath = [[NSBundle mainBundle] pathForResource:@"HelloiRTcmix" ofType:@"sco"];
		NSString *scoreText = [NSString stringWithContentsOfFile:scorePath encoding:NSUTF8StringEncoding error:nil];
		[self.rtcmixManager addScore:@"helloScore" withString:scoreText];
	
		self.beepScore = [self.rtcmixManager.scoreDict objectForKey:@"helloScore"];
	}
</pre>

The initial

<pre>
	[super viewDidLoad];
</pre>

statement invokes all the functionality of the "superclass" (in this case a 'UIViewController') to do all the actions necessary for iOS to run our application. We then add the following two lines:

<pre>
	self.rtcmixManager = [RTcmixPlayer sharedManager];
	[self.rtcmixManager startAudio];
</pre>

which assigns an instance of the <i>RTcmixPlayer</i> class to the property we declared (<i>rtcmixManager</i>). It initialized this using the <i>-sharedManager</i> method, which uses the singleton design pattern to ensure that that only one instance of the <i>RTcmixPlayer</i> class will be created in our application. This can be important in more complex RTcmix applications.
<p>
Once <i>rtcmixManager</i> has been assigned, we use the <i>-startAudio</i> method available from the <i>RTcmixPlayer</i> class to, well, start the audio.
<p>
The next three lines of code:

<pre>
	NSString *scorePath = [[NSBundle mainBundle] pathForResource:@"HelloiRTcmix" ofType:@"sco"];
	NSString *scoreText = [NSString stringWithContentsOfFile:scorePath encoding:NSUTF8StringEncoding error:nil];
	[self.rtcmixManager addScore:@"helloScore" withString:scoreText];
</pre>

are used to load and set up an RTcmix scorefile from the disk. In the Supporting Files folder of the "Hello iRTcmix" XCode project, there is a file called <i>HelloiRTcmix.sco</i> containing the following RTcmix score:

<pre>
	pitches = { 7.00, 7.02, 7.05, 7.07, 7.10, 8.00, 8.07 }
	pitchArraySize = len(pitches)

	for (time = 0; time < 5; time = time+0.12) 
	{
		index = trand(0, pitchArraySize)
		note = pitches[index]
		STRUM2(time, .36, 16000, note, 1, 1.0, random())
	}	
</pre>

You should copy this file into your project by dragging it from the "Hello iRTcmix" project into the "Supporting Files" group of your project. Make sure to check the box to "Copy items into destination group's folder (if needed)". 
<p>
This is a fairly simple algorithmic RTcmix scorefile. We invoke it with our <i>-goPlingScore</i> method. To access the score, however, we need to find it in the Application bundle (on the "disk") and load it into memory. The

<pre>
	NSString *scorePath = [[NSBundle mainBundle] pathForResource:@"HelloiRTcmix" ofType:@"sco"];
</pre>

sets the <i>*scorePath</i> property to reference the "HelloiRTcmix.sco" in the Application bundle. The next line of code:

<pre>
	NSString *scoreText = [NSString stringWithContentsOfFile:scorePath encoding:NSUTF8StringEncoding error:nil];
</pre>

loads the text of the <i>HelloiRTcmix.sco</i> file into memory and sets the <i>*scoreText</i> property to reference it. We then add this text to our main rtcmixManager variable:

<pre>
	[self.rtcmixManager addScore:@"helloScore" withString:scoreText];
</pre>

which then allows us to reference the score via an <i>RTcmixScore</i> object that we have designated as our <i>beepScore</i> variable:

<pre>
	self.beepScore = [self.rtcmixManager.scoreDict objectForKey:@"helloScore"];
</pre>

Why do we have this complexity for scorefile loading? For very simple scores, we don't really need to do this score-loading and score-reencoding and score-adding operation (see the <i>-goBeepScore</i> method, discussed below). However, the <i>RTcmixScore</i> class has added functionality for RTcmix scores that use data coming from the application itself; i.e. 'outside' RTcmix. Several of the other demos included in the "iRTcmix_Demos" distribution show these capabilities.
<p>
Our final <i>-viewDidLoad</i> method then looks like this:

<pre>
	- (void)viewDidLoad
	{
		[super viewDidLoad];

		// initialize the RTcmixPlayer and start audio.
		self.rtcmixManager = [RTcmixPlayer sharedManager];
		[self.rtcmixManager startAudio];

		// load the score from the file HelloiRTcmix.sco and assign it to beepScore
		NSString *scorePath = [[NSBundle mainBundle] pathForResource:@"HelloiRTcmix" ofType:@"sco"];
		NSString *scoreText = [NSString stringWithContentsOfFile:scorePath encoding:NSUTF8StringEncoding error:nil];
		[self.rtcmixManager addScore:@"helloScore" withString:scoreText];
	
		self.beepScore = [self.rtcmixManager.scoreDict objectForKey:@"helloScore"];
	}
</pre>

Once the initializations are done in the <i>-viewDidLoad</i> method, using them from our interface is quite easy. The IBAction methods we coded are almost self-explanatory:

<pre>
	-(IBAction)goPlingScore {
		// method 1 to play a score - parseScoreWithRTcmixScore:
		[self.rtcmixManager parseScoreWithRTcmixScore:self.beepScore];
	}
</pre>

Invoking the <i>-goPlingScore</i> method calls the <i>-parseScoreWithRTcmixScore</i> method on our <i>rtcmixManager</i>, which both parses the score and then sends it to the RTcmix engine for realization into audio. This will happen every time this method is called. The <i>-goBeepScore</i> method is even simpler:

<pre>
	-(IBAction)goBeepScore {
		// method 2 to play a score - parseScoreWithNSString:
		[self.rtcmixManager parseScoreWithNSString:@"WAVETABLE(0, 5, 24000, 440, .5)"];
	}
</pre>

as it shows how to use an RTcmix score directly as text in the application.
<p>
The <i>-flush</i> IBAction method calls the <i>-flushAllScripts</i> method on the rtcmixManager:

<pre>
	-(IBAction)flush {
		// stop all running scores
		[self.rtcmixManager flushAllScripts];
	}
</pre>

which removes all currently-scheduled RTcmix events from the audio processing queue.
<p>
How do you then call our <i>ViewController</i> interface methods? That's when XCode is actually fun -- click on the <i>ViewController.xib</i> file and connect the actions of the interface elements to the appropriate <i>ViewController</i> interface method. So easy!
<p>
Build and Run, and it should just go! 

		
			
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
