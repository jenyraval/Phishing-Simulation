# Phishing-Simulation
Phishing Simulation mainly aims to increase phishing awareness by providing an intuitive tutorial and customized assessment (without any actual setup - no domain, no infrastructure, no actual email address) to assess people's action on any given situation and gives ability to understand what is the current awareness posture

## What?

 - One of the objective of organizations carrying out red team assessment is to know the weakness in the IT ecosystem which includes people and network. Organization takes every effort to improve there perimeter security and patch the vulnerabilities found but the people remains the weakest link. Phishing plays vital role in understanding the security-awareness of employee. 
- Phishing Simulation enables user to understand it without actually performing the 'live' phishing attack, by leveraging the engaging and intuitive training sessions.
- Tool will give you a customized environment to design your test as per your requirements which make questions tailor-made for every organization and unique for each person, close to real-time phishing attack, targeted and difficult to answer, but all of this without any actual setup. Once test is designed all the targeted audience can take the assessment and submit there answers. We will have a analysis at the end of campaign to understand the current awareness posture.
- All it takes is just one click! So this will make us think twice before we do that one click.

## Why?

- While doing red team assessment it is a daunting task to set up entire phishing campaign. Decide a domain, buy it, setup a phishing website, design an email and choose target audience track the clicks to only know who all clicked them and there awareness.
- This will need time and expertise to set-up. 
- Tool will help you do all this for you just with few clicks (And those clicks are legit and helps you :))
- People are the most unpredictable one's and this tool will help you to know them and pattern of there clicks.

## Features and How to use

Tool have mainly 2 modules:
1. Admin Module : Which has access to setup test and view analysis, can be accessed at at http://localhost/AdminPanel/login.php, default login credentials are admin/admin
2. Client Module : Which only has access to tutorial and assessment, cane be accessed at http://localhost/phishClient/
 - Tutorial (Client Module)
	- This will have a tutorial book which introduces phishing and the general techniques used which will create awareness and educate.
- Assessment (Client Module)
	- This will include various questions which can be phishing emails or phishing site or scenario and user will have to choose there action whether they will click it, ignore it or report it. 
	- Questions will be different for each user even under a same test code.
	- Questions will have a fair mix of positive and negative questions.
	- To pass the test all answers has to be right because all it takes is just one click!
 - Set up test (Admin Module)
    - Tool will ask for some basic information from you here. To name a few,
		 - Domain Name : Here you will enter your legit domain and tool will create a set of look-a-like domains that adversaries can use to attack you.You can choose one of them which will be used during your phishing simulation assessment.
		 - URL : Here you will enter your popularly used websites URI, and we will be creating a similar looking phishing website which will be shown under your chosen look-a-like domain to create real life scenario also known as 'Typosquatting' during assessment.
		- Test Code: You can create a test code for each department and create different test config for them so everyone gets a different phishing sites making assessment even harder. Even under the same test set of questions will be different for each employee.  
		- Preview: You can preview the look and feel of the phishing webpage which we have created look-a-like to your original site.
		- Email Id: Here you should add an official email id which is generally used for mass communication and we will generate more such combination of email-ids and use them during assessment.
- Analysis (Admin Module)
	- This will have a graph of analysis of different scenarios based on the pattern in which employees has answered the questions.
	- This will help to know the current awareness posture of organization.
	
## Benefits
- This will eliminate the need to set up entire phishing campaign manually and 'live' phishing environment.
- Assessment is customized, which will make it targeted attack for target user. 
- An intuitive and interactive interface to exercise the entire process.
- No need to have pen-tester or consultant to carryout phishing campaign, you can do it yourself with few clicks. 
- Know your people and make them aware.

## Installation Guidelines

### Docker
To be updated soon

### Manual Installation on Windows

1. Download XAMPP from - https://www.apachefriends.org/download.html and follow installation flow on the screen.It will install webserver and MySQL for you.
2. If you do not want to go with XAMPP, any webserver you may have and independent installation of MySQL should suffice.
3. Once you have completed Step 1 or Step 2 depending on your choice, on XAMPP control panel start 'Apache' and 'MySQL' service.
4. Open http://localhost/phpmyadmin/ or http://IP/phpmyadmin/ on the browser.
5. Click on 'Databases' create database with name 'phishadmin'
6. Click on 'Import' and import the file attached here with code, under /sql/ folder phishadmin.sql, and you are done with setup. Refer section 'How to use' for usability.
