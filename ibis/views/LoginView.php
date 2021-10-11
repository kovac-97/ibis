

    

<html>

<head>
<title>Alpha by HTML5 UP</title>
<link rel='stylesheet' href='./css/reset.css' type='text/css'>
<meta name='viewport' content='width=device-width'/>
</head>


<body>
    <!--Header-->
    <?php
    include '../views/HeaderView.php';
    ?>

    <!--Background image-->
    <div class="image">

        <div class="banner">
            <p class='title'>Alpha</p>
            <p class='paragraph'>Another fine responsive site template freebie by HTML5 UP</p>
            <div class="bannerNav">
                <a href='#'>Sign Up</a>
                <a href='#'>Learn More</a>
            </div>
        </div>

    </div>

    <!--Login form-->
    <div class="main">
        <p class="mainTitle">Welcome to <a href='#'>Alpha</a>!</p>
        <form id='login' class='auth' method='post' action='#'>
            <p class='authText'>E-mail</p>
            <input required name='email' placeholder="example@mail.com" type='text' pattern="[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" />
            <p class='authText'>Password</p>
            <input required name='password' placeholder="12345678" type='password' />
            <input type='submit' class='button loginButton' value='Log In'/>
            <img id='loginSpinner' class='spinner loginSpinner' src='./images/spinner.png' />
        </form>
        <p class="mainParagraph">Blandit varius ut praesent nascetur eu penatibus nisi risus faucibus nunc ornare adipiscing nunc adipiscing. Condimentum turpis massa.</p> 
        
    </div>

  <!--Sign Up modal-->
  <div class="modal">
        <div class="modal-content">
        <div class="close">&times;</div>
            <div class="signUpContainer">              
                <p class="mainTitle">Sign Up</p>
                <form id='signup' class='auth' method='post' action='#'>
                    <p class='authText'>First Name</p>
                    <input required name='firstName' placeholder="Jack" type='text'/>
                    <p class='authText'>Second Name</p>
                    <input required name='secondName' placeholder="Sparrow" type='text'/>    
                    <p class='authText'>E-mail</p>
                    <input required name='email' placeholder="worst.pirate.ever@tortuga.com" type='text' pattern="[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" />
                    <p class='authText'>Password</p>
                    <input required name='password' placeholder="wHy1stheRuM90ne?" type='password' />
                    <p class='authText'>Confirm Password</p>
                    <input required name='password-confirm' placeholder="wHy1stheRuM90ne?" type='password' />
                    <input type='submit' class='button loginButton' value='Sign Up'/>
                    <img id='signupSpinner' class='spinner loginSpinner' src='./images/spinner.png' />
                </form>
            </div>
    </div>
    </div>

  
  
    <!--Footer-->
    <div class="footer">
        <div class="iconBox">
            <a href='#'>    
                <img src="./images/icons/be.png"/>
            </a>
            <a href='#'>   
                <img src="./images/icons/twitter.png"/>
            </a>
            <a href='#'>   
                <img src="./images/icons/vimeo.png"/>
            </a>
            <a href='#'>   
                <img src="./images/icons/wordpress.png"/>
            </a>
            <a href='#'>   
                <img src="./images/icons/pinterest.png"/>
            </a>
            <a href='#'>   
                <img src="./images/icons/skype.png"/>
            </a>
        </div>

        <p class="copyright">
        &copy; Untitled. All rights reserved.
        Design:
        <a href="#">
        HTML5 UP
        </a>
        </p>
    </div> 

<script src='./js/script.js'></script>  
</body>


</html>    
