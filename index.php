<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'includes/head.inc.php'; ?>
    <title>Drippeo - Home</title>
</head>
<body>

    <!--header-->
    <div class="container--header">
            <div class="hero"></div>
    <header>
        <div class="navWrapper" >
            <div class="logo"><h1>Drippeo.</h1></div>
                <div class="nav__btn">
                    <svg class="ham hamRotate hamB " viewBox="-10 -5 120 110" width="80" onclick="this.classList.toggle('active')">
                    <path class="line top whiteLines" d="m 70,33 h -40 c 0,0 -6,1.368796 -6,8.5 0,7.131204 6,8.5013 6,8.5013 l 20,-0.0013" />
                    <path class="line middle whiteLines" d="m 70,50 h -40" />
                    <path class="line bottom whiteLines" d="m 69.575405,67.073826 h -40 c -5.592752,0 -6.873604,-9.348582 1.371031,-9.348582 8.244634,0 19.053564,21.797129 19.053564,12.274756 l 0,-40" />
                    </svg>
                </div>
        <div class="clearfix"></div>

            <nav>
                <ul class="navUl" id="navUl">  
                    <li><a href="#overOns" class="navItem" >About us</a> </li>
                    <li><a href="#product" class="navItem" >Our product</a></li>
                    <li><a href="#contact" class="navItem" >Contact</a></li>
                    <li><a href="login.php" class="navItem">Login</a></li>
                </ul>
            </nav>
        </div>
 
        <div class="slogan">
            <p>Drip<span class="punt">.</span> Drop<span class="punt">.</span><br>Make it stop<span class="punt">.</span></p>
        </div>
        
        <hr class=dashboardline>

        <div class="dashboard--link">
            <a href="login.php">Let’s go to your own dashboard  <span class="pijl">→</span></a>
        </div>

        <div class="socials">
            <a href="#"><img src="images/facebook.png" alt=""></a>
            <a href="#"><img src="images/insta.png" alt=""></a>
            <a href="#contact"><img src="images/mail.png" alt=""></a>
        </div>

        <div class="scroll">
            <p>or scroll down for more</p>
            <hr>
        </div>
    </header>
</div>

<div class="info--index">
    <!--overOns-->
    <div class="overOns" id="overOns">
        <h2>About us<span class="punt">.</span>
            <hr>
        </h2>
        
            <p class="abouttekst"> Do you have any idea how much water you spend each day? I bet you don't. An average person has a usage of <span class="blue">114 liters a day</span>.
            <br><br>     
            <span class="titelabout">But hey, we're on a mission!</span>
            <br><br>
                 We all know economical and ecological thinking is becoming a real state of mind, but some people might need a helping hand.
                     And that's when Drippeo is there! It's an investment to save not only water but also money. Our software will understand after X number of times when you shower. If you shower every day at 7 pm and enter it, our software will understand that. 
                     And that's how you can save easily. On water, and money.
                </p>
                <div class="icon-div">
                <img src="images/icons/icon1.svg">
                <img src="images/icons/icon2.svg">
                <img src="images/icons/icon3.svg">
                <img src="images/icons/icon4.svg">
                <div><h4>Smart Technology</h4><p></p></div>
                <div><h4>Tips and Tricks</h4><p></p></div>
                <div><h4>Compare with others</h4><p></p></div>
                <div><h4>Charts</h4><p></p></div>
                
</div>
    </div>

    <!--product-->
    <img class="clearfix" src="images/phones.svg" alt="mockup" id="phoneimg">
    <div class="product" id="product">
    <img  src="images/phones.svg" alt="mockup" id="phoneimgBig">
        <h2>Our product<span class="punt">.</span>
                <hr>
        </h2>
            <p class="producttekst">
            A smart water meter that follows your consumption closely. Enter each device in your house with the necessary info and Drippeo will do the rest. 
            We compare your data with others and can thus determine what an average consumption is. After this we provide tailor-made tips and tricks and show you where you can save.
            <br><br>
            Our measurement is going to be correct. Up to the liter. But where the liters go is up to the user. That is part of the awareness. 
            We want the user to say <span class="vet">“yes, then I took a bath, then I used the washing machine. I really didn't know I used so much water, time to do something about that.”</span>

           <br><br> In combination with a very intelligent software.
            </p>
            
        </div>

    <!--contact-->
    <div class="contact" id="contact">
        <h2>Contact<span class="punt">.</span>
                <hr>
        </h2>
            <form class="contactForm">
                <div class="form__veld">
                    <input type="text" placeholder="E-mail" name="email" required class="inputField">
                </div>
                <div class="form__veld">
                        <input type="text" placeholder="What's your question about?" name="onderwerp" class="inputField">
                </div>
                <div class="form__veld">
                        <textarea type="text" placeholder="Write your message right here" name="bericht" class="inputField"></textarea>
                </div>
            </form>
            
    </div>

    <!--footer-->
    <footer class="indexFooter">
        <p>	&copy; 2019 Drippeo</p>
        <form>
            <input type="email" placeholder="Email" required>
            <button class="button">Sign up now</button>
        </form>
    </footer>
    </div>
    <script src="js/mobileNavigation.js">
        /****** smooth scroll ******/
		$(document).ready(function() {
			$("a").on('click', function(event) {

				if (this.hash !== "") {
					event.preventDefault();

					var hash = this.hash;

					$('html, body').animate({
						scrollTop: $(hash).offset().top
					}, 1500, function() {
						window.location.hash = hash;
					});
				}
			});
		});
    </script>
</body>
</html>