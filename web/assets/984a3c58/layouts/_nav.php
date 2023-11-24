<?php

use luya\helpers\Html;
use luya\cms\models\NavItem;

?>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">
            <img src="img/logo.png" alt="">
            <img src="img/logo-2.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="my_toggle_menu">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="dropdown submenu active">
                    <a class="dropdown-toggle" href="index.php" role="button" aria-haspopup="true" aria-expanded="false">Home</a>
                </li>
                <li><a href="/products/cakes">Our Cakes</a></li>
                <li class="dropdown submenu">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Cake Category</a>
                    <ul class="dropdown-menu">
                        <li><a href="category-details.php?catname=Eggless Cake">Eggless Cake</a></li>
                        <li><a href="category-details.php?catname=Kids Cake">Kids Cake</a></li>
                        <li><a href="category-details.php?catname=Photo Cake">Photo Cake</a></li>
                        <li><a href="category-details.php?catname=Premium Cake">Premium Cake</a></li>
                        <li><a href="category-details.php?catname=Cup Cake">Cup Cake</a></li>
                        <li><a href="category-details.php?catname=First Birthday Cake">First Birthday Cake</a></li>
                        <li><a href="category-details.php?catname=Midnight Cake">Midnight Cake</a></li>
                        <li><a href="category-details.php?catname=First Anniversary Cake">First Anniversary Cake</a>
                        </li>
                        <li><a href="category-details.php?catname=abc">abc</a></li>
                    </ul>
                </li>
                <li><a href="about-us.php">About Us</a></li>
            </ul>
            <ul class="navbar-nav justify-content-end">
                <li><a href="registration.php">Sign up</a></li>
                <li><a href="login.php">Sign in</a></li>
                <li><a href="track-order.php">Track Order</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </div>
    </nav>
</div>