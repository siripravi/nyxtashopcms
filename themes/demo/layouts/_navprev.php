<nav class="navbar navbar-expand-lg navbar-light" data-aos="fade-down">
  <h1>
    <a class="navbar-brand text-white" href="index.html" data-aos="zoom-in">
      Bakery Delights
    </a>
  </h1>
  <button class="navbar-toggler ml-md-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-lg-auto text-center">
      <li class="nav-item">
        <a class="page-scroll" href="/">Home</a>
      </li>
      <?php if (null === Yii::$app->getRequest()->getQueryParam('slug')) :

      ?>
        <li class="nav-item  mr-lg-3 mt-lg-0 mt-3">
          <a class="page-scroll" href="#menu">Menu</a>
        </li>

        <li class="nav-item  mr-lg-3 mt-lg-0 mt-3" data-aos="zoom-in">
          <a class="page-scroll" href="#about">About</a>
        </li>
        <li class="nav-item  mr-lg-3 mt-lg-0 mt-3" data-aos="zoom-in">
          <a class="page-scroll" href="#contact">Contact Us</a>
        </li>
        <li class="nav-item  mr-lg-3 mt-lg-0 mt-3" data-aos="zoom-in">
          <a class="page-scroll" href="#portfolio">Portfolio</a>
        </li>
        <li class="nav-item  mr-lg-3 mt-lg-0 mt-3" data-aos="zoom-in">
          <a class="page-scroll" href="#chef">Team</a>
        </li>
      <?php else : ?>
        <!--?php echo (Yii::$app->getRequest()->getQueryParam('slug'));  ?-->
        <!-- other pages nav -->
        <li class="nav-item  mr-lg-3 mt-lg-0 mt-3" data-aos="zoom-in">
          <a class="page-scroll" href="/catalog">Menu</a>
          <ul>
            <li class="nav-item  mr-lg-3 mt-lg-0 mt-3" data-aos="zoom-in">
              <a class="page-scroll" href="/products/cakes">Cakes</a>
            </li>
            <li class="nav-item  mr-lg-3 mt-lg-0 mt-3" data-aos="zoom-in">
              <a class="page-scroll" href="/products/cupcakes">Cup Cakes</a>
            </li>
          </ul>
        </li>
      <?php endif; ?>

    </ul>

</nav>