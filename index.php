<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'includes/head.inc.php'; ?>
    <title>Drippeo</title>
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
                    <li><a href="#contact" class="navItem" > Contact</a></li>
                    <li><a href="login.php" class="navItem"> Login</a></li>
                </ul>
            </nav>
        </div>
 
        <div class="slogan">
            <p>Drip<span class="punt">.</span> Drop<span class="punt">.</span> <br>Make it stop<span class="punt">.</span></p>
        </div>
        
        <div class="dashboard--link">

            <a href="login.php">Let’s go to your own dashboard</a>
        </div>
<div class="scroll">
    <p>scroll</p>
    <hr>
</div>




    </header>


</div>
    <!--overOns-->
    <div class="overOns " id="overOns">
        <h2>About us <span class="punt">.</span>
            <hr>
        </h2>
        
            <p> The problem is that we keep spending water without considering 
                the impact on nature and its wealth. There are parts of the world that suffer from water shortage.
                 If we continue to use water as we do today, there is a risk that we will have a water <b> shortage of 40% by 2030.</b> </p>
            <h3>Our mission</h3>
            <p>We want people to be more aware of how much water they use. 
            Show them what they can do and confront them with the use of others who do better.
            Everybody should use water more economically. </p>
        
    </div>

    <!--product-->
    <div class="product" id="product">
        <h2>Our product <span class="punt">.</span>
                <hr>
        </h2>
            <p>The drippeo watermeter is placed on the water pipe. 
            It will measure the flowing water and display the information on your app. 
            Just one simple placement that measures everything. </p>
            <p>Drippeo shows you how much you consume and when, each day, week, month or year. 
            Saving has never been easier. With a few small adjustments you can help the world and your wallet.</p>
    <img class="clearfix" src="images/MockUp.jpg" alt="mockup">
        </div>

    <!--contact-->
    <div class="contact" id="contact">
        <h2>Contact <span class="punt">.</span>
                <hr>
        </h2>
            <form>
                <div class="form__veld">
                    <label for="email">Email</label>
                    <input type="text" placeholder="Email" name="email" required>
                </div>
                <div class="form__veld">
                        <label for="email">Onderwerp</label>
                        <input type="text" placeholder="Onderwerp" name="onderwerp">
                </div>
                <div class="form__veld">
                        <label for="email">Bericht</label>
                        <textarea type="text" placeholder="Typ hier u bericht" name="bericht"></textarea>
                </div>
            </form>

    </div>

    <!--footer-->
    <footer>
        <p>	&copy; 2019 Drippeo</p>
        <form>
            <input type="email" placeholder="Email" required>
            <button class="button">Sign up now</button>
        </form>
    </footer>
    <script src="js/mobileNavigation.js"></script>
</body>
</html>