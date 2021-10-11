
<?php
require_once('../models/Modal.php');
$modals=Modal::GetModals();
?>
    

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

    <!--Main title and scrolling images-->
    <div class="main">
        <p class="mainTitle">Introducing the ultimate mobile app for doing stuff with your phone</p>
        <p class="mainParagraph">Blandit varius ut praesent nascetur eu penatibus nisi risus faucibus nunc ornare adipiscing nunc adipiscing. Condimentum turpis massa.</p> 
        <img src="./images/prva.jpg" class="slide mainImage">
        <img src="./images/druga.jpg" class="slide invisibleImage">
        <img src="./images/treca.jpg" class="slide invisibleImage">
    </div>

    <!--Home icons-->
   <div class="itemContainer">
        <div class="row">
            <div class="item noborder">
            <img class="itemIcon" src="./images/home.png"/>
            <p class="itemTitle">Magna etiam</p>
            <p class="itemParagraph">
                Integer volutpat ante et accumsan commophasellus 
                sed aliquam feugiat lorem aliquet ut enim rutrum
                phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
            </div>

            <div class="item">
            <img class="itemIcon" src="./images/home.png"/>
            <p class="itemTitle">Ipsum dolor</p>
            <p class="itemParagraph">
                Integer volutpat ante et accumsan commophasellus 
                sed aliquam feugiat lorem aliquet ut enim rutrum
                phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
            </div>
        </div>
        <div class="row">
            <div class="item">
            <img class="itemIcon" src="./images/home.png"/>
            <p class="itemTitle">Sed feugiat</p>
            <p class="itemParagraph">
                Integer volutpat ante et accumsan commophasellus 
                sed aliquam feugiat lorem aliquet ut enim rutrum
                phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
            </div>

            <div class="item">
            <img class="itemIcon" src="./images/home.png"/>
            <p class="itemTitle">Enim phasellus</p>
            <p class="itemParagraph">
                Integer volutpat ante et accumsan commophasellus 
                sed aliquam feugiat lorem aliquet ut enim rutrum
                phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
            </div>
        </div>


   </div>

    <!--Images with modals-->
    <div class="row imgRow">
  
        <div class="imgContainer">
            <img class="filteredImage" src="<?=$modals[0]->url?>"/>
            <p class="itemTitle"><?=$modals[0]->title?></p>
            <p class="itemParagraph">
            <?=$modals[0]->text?>.
            </p>         
            <a class='imgButton'>Learn More</a>                
        </div>
        
        <div class="imgContainer">
            <img class="filteredImage" src="<?=$modals[1]->url?>"/>
            <p class="itemTitle"><?=$modals[1]->title?></p>
            <p class="itemParagraph">
            <?=$modals[1]->text?>.
            </p>         
            <a class='imgButton'>Learn More</a>                
        </div>


        

    </div>

    <!--Modals-->
    <div id="<?=$modals[0]->id?>" class="modal">
        <div class="modal-content">
            <div class="close">&times;</div>
            <div class='modalContainer'>
            <img class="modalImage" src="<?=$modals[0]->url?>"/>
            <p class="itemTitle modalText"><?=$modals[0]->title?></p>
            <p class="itemParagraph modalText">
            <?=$modals[0]->text?>    
            </p>                
            </div>
        </div>
    </div>

    <div id="<?=$modals[1]->id?>" class="modal">
        <div class="modal-content">
            <div class="close">&times;</div>
            <div class='modalContainer'>
            <img class="modalImage" src="<?=$modals[1]->url?>"/>
            <p class="itemTitle modalText"><?=$modals[1]->title?></p>
            <p class="itemParagraph modalText">
            <?=$modals[1]->text?>
            </p>                
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
