(function ($) {
  var $window = $(window),
    $body = $("body"); // Breakpoints.
  // 	breakpoints({
  // 		xlarge:  [ '1281px',  '1680px' ],
  // 		large:   [ '981px',   '1280px' ],
  // 		medium:  [ '737px',   '980px'  ],
  // 		small:   [ null,      '736px'  ]
  // 	});
  // Play initial animations on page load.

  $window.on("load", function () {
    window.setTimeout(function () {
      $body.removeClass("is-preload");
    }, 100);
  }); // Dropdowns.

  $("#nav > ul").dropotron({
    mode: "fade",
    noOpenerFade: true,
    alignment: "center",
    detach: false,
  }); // Nav.
  // Title Bar.

  $(
    '<div id="titleBar">' +
      '<a href="#navPanel" class="toggle"></a>' +
      '<span class="title">' +
      $("#logo h1").html() +
      "</span>" +
      "</div>"
  ).appendTo($body); // Panel.

  $('<div id="navPanel">' + "<nav>" + $("#nav").navList() + "</nav>" + "</div>")
    .appendTo($body)
    .panel({
      delay: 500,
      hideOnClick: true,
      hideOnSwipe: true,
      resetScroll: true,
      resetForms: true,
      side: "left",
      target: $body,
      visibleClass: "navPanel-visible",
    });
})(jQuery);

(function ($) {
  "use strict";

  // Spinner
  var spinner = function () {
    setTimeout(function () {
      if ($("#spinner").length > 0) {
        $("#spinner").removeClass("show");
      }
    }, 1);
  };
  spinner();

  // Initiate the wowjs
  new WOW().init();

  // Fixed Navbar
  $(".fixed-top").css("top", $(".top-bar").height());
  $(window).scroll(function () {
    if ($(this).scrollTop()) {
      $(".fixed-top").addClass("bg-light").css("top", 0);
    } else {
      $(".fixed-top")
        .removeClass("bg-light")
        .css("top", $(".top-bar").height());
    }
  });

  // Back to top button
  $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
      $(".back-to-top").fadeIn("slow");
    } else {
      $(".back-to-top").fadeOut("slow");
    }
  });
  $(".back-to-top").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
    return false;
  });

  // Header carousel
  $(".header-carousel").owlCarousel({
    autoplay: false,
    smartSpeed: 1500,
    loop: true,
    nav: true,
    dots: false,
    items: 1,
    navText: [
      '<i class="bi bi-chevron-left"></i>',
      '<i class="bi bi-chevron-right"></i>',
    ],
  });

  // Facts counter
  $('[data-toggle="counter-up"]').counterUp({
    delay: 10,
    time: 2000,
  });

  // Testimonials carousel
  $(".testimonial-carousel").owlCarousel({
    autoplay: false,
    smartSpeed: 1000,
    margin: 25,
    loop: true,
    center: true,
    dots: false,
    nav: true,
    navText: [
      '<i class="bi bi-chevron-left"></i>',
      '<i class="bi bi-chevron-right"></i>',
    ],
    responsive: {
      0: {
        items: 1,
      },
      768: {
        items: 2,
      },
      992: {
        items: 3,
      },
    },
  });
})(jQuery);

function visibilityCheck() {
  $(".modal").each(function () {
    if ($(this).is(":visible")) {
      centerModal(this);
      if (!$(this).find(".same-height").hasClass("height-changed")) {
        $(".same-height").addClass("height-changed").matchHeight();
      }
    }
  });
}

function msieversion() {
  var ua = window.navigator.userAgent;
  var msie = ua.indexOf("MSIE ");
  var trident = ua.indexOf("Trident/");

  if (msie > 0) {
    // IE 10 or older => return version number
    return parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)), 10);
  }

  if (trident > 0) {
    // IE 11 (or newer) => return version number
    var rv = ua.indexOf("rv:");
    return parseInt(ua.substring(rv + 3, ua.indexOf(".", rv)), 10);
  }

  // other browser
  return false;
}

window.setInterval(visibilityCheck, 500);

function handleResize() {
  var h = $(window).height();
  $(".intro-box").css({ height: h + "px" });
  if ($(window).width() > 992) {
    if (h > 500) {
      $(".hero .wrapper").css({ height: h + "px" });
    }
  }

  if ($(window).width() > 768) {
    if (
      $(".about-section .gallery").outerHeight() +
        $(".about-section .slogan-wrapper").outerHeight() !=
      $(".about-section").outerHeight()
    ) {
      var parentHeight = $(".about-section").outerHeight();

      var gallery_height = parseInt(parentHeight) * (60 / 100);
      var slogan_height = parseInt(parentHeight) * (40 / 100);

      $(".about-section .gallery").outerHeight(gallery_height);
      $(".about-section .slogan-wrapper").outerHeight(slogan_height);
    }

    $(".about-section .about").outerHeight($(".about-section").outerHeight());
  }
}

function centerModal(elem) {
  if (!msieversion()) {
    $(elem).css("display", "block");
    var $dialog = $(elem).find(".modal-dialog");
    if ($(window).height() > $dialog.height()) {
      var offset = ($(window).height() - $dialog.height()) / 2;
      // Center modal vertically in window
      if (offset > 0) {
        $dialog.css("margin-top", offset);
      }
    }

    //$('.same-height').matchHeight();
  }
}
jQuery(function ($) {
  handleResize();
  $(window).resize(function () {
    handleResize();
  });
  toggle_menu();
  var intro_margin = ($(window).height() - $(".intro-box .inner").height()) / 2;
  if (intro_margin > 0) {
    $(".intro-box .inner").css("margin-top", intro_margin);
  }

  if ($(".intro-box .inner").is(":visible")) {
    jQuery("#menu-icon").hide();
    $("html,body").animate({ scrollTop: 0 }, 500);
  } else {
  }
  var hero_inner_margin =
    ($(".hero").height() - $(".hero .wrapper .inner").height()) / 2;
  if (hero_inner_margin > 0) {
    $(".hero .wrapper .inner").css("top", hero_inner_margin);
  }

  jQuery("#menu-icon").click(function (e) {
    e.preventDefault();
    jQuery("#slide-menu").addClass("animate").toggleClass("open");
    if ($(window).width() > 769) {
      //jQuery('#slide-menu').css('top', jQuery(document).scrollTop());
    }
    if (jQuery("#slide-menu").hasClass("open")) {
      jQuery(".fade-all").fadeIn();
    } else {
      jQuery(".fade-all").fadeOut();
    }
  });

  jQuery("#slide-menu .menu-close").click(function (e) {
    e.preventDefault();
    jQuery("#slide-menu").removeClass("open");
    if ($(window).width() > 769) {
      //jQuery('#slide-menu').css('top', 'auto');
    }

    jQuery(".fade-all").fadeOut();
  });

  jQuery(".menu-icon-mobile, .menu-close-mobile").click(function (e) {
    e.preventDefault();
    jQuery("#slide-menu").addClass("animate").toggleClass("open");
    jQuery(".fade-all").fadeOut();
  });

  $(".to-top").click(function (e) {
    e.preventDefault();
    $("html,body").animate({ scrollTop: 0 }, 1200);
    return false;
  });

  $("a[data-scrollto]").click(function (e) {
    e.preventDefault();
    var destination = $("." + $(this).data("scrollto"));
    $("#slide-menu").addClass("fixed");
    $("#slide-menu").removeClass("animate");

    $("html,body").animate(
      { scrollTop: destination.offset().top },
      1200,
      function () {}
    );
    if ($(window).width() <= 769) {
      $("#slide-menu").removeClass("fixed open");
    }
  });

  $("body").on("click", ".wholesale_modal .show_forgot", function (e) {
    e.preventDefault();
    $(".wholesale_modal .add_code").slideUp();
    $(".wholesale_modal .forgot").slideDown();
  });

  $("body").on("click", ".wholesale_modal .close_forgot", function (e) {
    e.preventDefault();
    $(".wholesale_modal .add_code").slideDown();
    $(".wholesale_modal .forgot").slideUp();
  });

  $("body").on("click", ".item .up-down .up", function (e) {
    var $input = $(this).parents(".name-quantity").find(".quantity_input");
    $input.val(+$input.val() + 1);
    quantity = $input.val();
    change_quantity(e, this, quantity);
  });

  $("body").on("click", ".item .up-down .down", function (e) {
    e.preventDefault();
    var $input = $(this).parents(".name-quantity").find(".quantity_input");
    if ($input.val() > 0) {
      $input.val(+$input.val() - 1);
    }
    quantity = $input.val();
    change_quantity(e, this, quantity);
  });

  $("body").on("change", ".item .quantity_input", function (e) {
    quantity = $(this).val();
    change_quantity(e, this, quantity);
  });

  function change_quantity(e, elem, quantity) {
    e.preventDefault();
    $(".hloading").show();

    var productid = $(elem).data("product-id");
    $.ajax({
      url: site_url + "set/set-quantity/" + productid,
      type: "POST",
      data: { quantity: quantity },
      dataType: "json",
      element: elem,
      success: function (data, element) {
        var item = $('[data-product-id="' + productid + '"]').parent(".item");
        $(this.element)
          .parents(".cart-items")
          .find(".total .amount span")
          .html(data.total);
        item.find(".quantity_input").val(quantity);
        item.find(".price").html("$" + data.product_price);
        $(".checkout").find(".total .amount span").html(data.total);
        $(".cart-items").find(".total .amount span").html(data.total);
        $("input#card_amount").val(data.total);
        $(".hloading").hide();
      },
    });
  }

  $(".modal").on("shown.bs.modal", centerModal);
  $(window).on("resize", function () {
    //$('.modal:visible').each(centerModal);
  });

  $("body").on(
    "click",
    ".cart-items .floater .icon, .floater .close-cart",
    function (e) {
      e.preventDefault();
      $(".floater .close-cart").fadeToggle();
      $(".cart-items .cart").slideToggle();
    }
  );

  $("#dynamic_content").on(
    "click",
    ".product-detail .instructions a",
    function (e) {
      e.preventDefault();
      $(".product-detail .instructions .instruction_form").slideDown();
    }
  );

  $("#dynamic_content").on(
    "click",
    ".product-detail .instructions .button",
    function (e) {
      e.preventDefault();
      $(".product-detail .instructions .instruction_form").slideUp();
    }
  );

  $(".gallery-section .button").click(function (e) {
    e.preventDefault();
    $(".fullscreen-slider").fadeIn();
  });

  $(".fullscreen-slider .close_slider").click(function (e) {
    e.preventDefault();
    $(".fullscreen-slider").fadeOut();
  });

  $("body").on(
    "click",
    ".datepicker-main-wrapper .datepicker-nav.month .next",
    function (e) {
      e.preventDefault();
      $(".ui-datepicker-month option:selected")
        .next()
        .attr("selected", "selected")
        .change();
    }
  );
  $("body").on(
    "click",
    ".datepicker-main-wrapper .datepicker-nav.month .prev",
    function (e) {
      e.preventDefault();
      $(".ui-datepicker-month option:selected")
        .prev()
        .attr("selected", "selected")
        .change();
    }
  );

  $("body").on(
    "click",
    ".datepicker-main-wrapper .datepicker-nav.year .next",
    function (e) {
      e.preventDefault();
      $(".ui-datepicker-year option:selected")
        .next()
        .attr("selected", "selected")
        .change();
    }
  );

  $("body").on(
    "click",
    ".datepicker-main-wrapper .datepicker-nav.year .prev",
    function (e) {
      e.preventDefault();
      $(".ui-datepicker-year option:selected")
        .prev()
        .attr("selected", "selected")
        .change();
    }
  );

  $(".become-client .datepicker-main-wrapper").on(
    "click",
    ".set-date",
    function (e) {
      e.preventDefault();
      var dateAsObject = $(".become-client .datepicker_selector").datepicker(
        "getDate"
      ); //the getDate method
      dateAsObject = $.datepicker.formatDate(
        "MM dd, yy",
        new Date(dateAsObject)
      );
      $("#pickup_date").val(dateAsObject);
      $("#pickup_time").val(
        $(".become-client .ui-timepicker-select option:selected").html()
      );

      $(".selected-date .date").html(dateAsObject);
      $(".selected-date .time").html(
        $(".ui-timepicker-select option:selected").html()
      );
    }
  );

  $("body").on("click", ".checkout .change_date", function (e) {
    e.preventDefault();
    loaddatepicker();
    $(".checkout .datepicker_selector").datepicker("setDate", new Date());
    $(".checkout .details .inner").slideUp();
    $(".checkout .details .datepicker").slideDown();
  });

  $("body").on("click", ".checkout .ui-datepicker-calendar td a", function (e) {
    $(".checkout .ui-datepicker-calendar td a").removeClass("ui-state-active");
    $(this).addClass("ui-state-active");
  });

  $("body").on("click", ".checkout .set-date", function (e) {
    e.preventDefault();
    $(".hloading").show();

    var dateAsObject = $(this)
      .parents(".checkout")
      .find(".datepicker_selector")
      .datepicker("getDate"); //the getDate method
    pickup_date = $.datepicker.formatDate("MM dd, yy", new Date(dateAsObject));
    pickup_time = $(this)
      .parents(".checkout")
      .find(".ui-timepicker-select option:selected")
      .html();

    $(this).parents(".checkout").find("#pickup_date").val(pickup_date);
    $(this).parents(".checkout").find("#pickup_time").val(pickup_time);

    $(this).parents(".checkout").find(".selected-date .date").html(pickup_date);
    $(this).parents(".checkout").find(".selected-date .time").html(pickup_time);

    $.ajax({
      url: site_url + "set/set-pickup-date/",
      data: { pickup_date: pickup_date, pickup_time: pickup_time },
      type: "POST",
    }).done(function (data) {
      $(".checkout .details .inner").slideDown();
      $(".checkout .details .datepicker").slideUp();
      $(".hloading").hide();
    });
  });

  $(".datepicker-main-wrapper").on(
    "click",
    ".become-client .calendar .submit",
    function (e) {
      $(".hloading").show();
      e.preventDefault();
      var dateAsObject = $(".datepicker_selector").datepicker("getDate"); //the getDate method
      pickup_date = $.datepicker.formatDate(
        "MM dd, yy",
        new Date(dateAsObject)
      );
      pickup_time = $(
        ".become-client .ui-timepicker-select option:selected"
      ).html();
      $("#pickup_date").val(pickup_date);
      $("#pickup_time").val(pickup_time);

      $.ajax({
        url: site_url + "set/set-pickup-date/",
        data: { pickup_date: pickup_date, pickup_time: pickup_time },
        type: "POST",
      }).done(function (data) {
        load_modals();
        $(".hloading").hide();
      });
    }
  );

  $(".checkout .proceed_to_pay").click(function (e) {
    e.preventDefault();
    $(".checkout .details").slideUp("slow");
    $(".checkout .details.payment").slideDown("slow");
  });

  $(".cart-items-wrapper .checkout-btn").click(function (e) {
    e.preventDefault();
    $(".checkout .details").show();
    $(".checkout .details.payment").hide();
  });

  $(
    ".about-section .gallery,.about-section .slogan-wrapper, .about-section .about"
  )
    .mouseenter(function (e) {
      $(this).find(".bg").addClass("hover");
    })
    .mouseleave(function (e) {
      $(this).find(".bg").removeClass("hover");
    });
});

jQuery(document).scroll(function () {
  if ($(window).width() > 769) {
    $("#slide-menu").removeClass("open");
    jQuery(".fade-all").fadeOut();
  }

  toggle_menu();
});

function toggle_menu() {
  if ($(window).width() > 769) {
    if ($(window).scrollTop() > $(".hero").height() / 4) {
      $("#slide-menu").addClass("slidein animate");
    } else {
      $("#slide-menu").removeClass("slidein");
    }
  }
}

function get_products(elem, category) {
  $(".hloading").show();
  if (!category) {
    var category = $(elem).data("category");
  }
  $.ajax({
    url: site_url + "get/products/" + category,
    type: "GET",
  }).done(function (data) {
    $("#dynamic_content")
      .hide()
      .html(data)
      .show("slide", { direction: "left" }, 300);
    if ($(window).width() <= 768) {
      var mobile_menu_height = $(".mobile_menu").outerHeight();
      $("html,body").animate(
        { scrollTop: $("#product-list").offset().top - mobile_menu_height },
        1
      );
    } else {
      $("html,body").animate({ scrollTop: $(".types").offset().top }, 500);
    }

    $("#slide-menu").removeClass("open");
    $(".hloading").hide();
  });
}

function get_products_home() {
  $(".hloading").show();
  $.ajax({
    url: site_url + "get/home-products/",
    type: "GET",
  }).done(function (data) {
    $("#dynamic_content")
      .hide()
      .html(data)
      .show("slide", { direction: "left" }, 300);
    $(".hloading").hide();
  });
}

function get_product_detail(elem, productid) {
  $(".hloading").show();
  if ($("#dynamic_content").outerHeight() > 0) {
    $("#dynamic_content").height($("#dynamic_content").outerHeight());
  }

  $("#dynamic_content .products").hide();
  $(".product-detail").fadeOut().remove();
  if (!productid) {
    var productid = $(elem).data("productid");
  }
  $.ajax({
    url: site_url + "get/product/" + productid,
    type: "GET",
  }).done(function (data) {
    $("#dynamic_content")
      .html("")
      .hide()
      .append(data)
      .show("slide", { direction: "left" }, 300, function () {
        $("#dynamic_content").css("height", "auto");
        if (!$(".intro-box .inner").is(":visible")) {
          if (!$(".mobile_menu").is(":visible") || $(window).width() > 540) {
            $("html,body").animate(
              { scrollTop: $(".product-detail").offset().top },
              500
            );
          } else {
            var scrolltop =
              $(".product-detail").offset().top -
              $(".mobile_menu").outerHeight();
            $("html,body").animate({ scrollTop: scrolltop }, 500);
          }
        }
        $(".hloading").hide();
      });
  });
}

function get_categories() {
  $(".hloading").show();
  $.ajax({
    url: site_url + "get/categories/",
    type: "GET",
  }).done(function (data) {
    $(".home > .categories").fadeTo(300, 0).html(data).fadeIn().fadeTo(300, 1);
    $(".hloading").hide();
  });
}

function update_contents() {
  var url = window.location.hash.substring(2);
  var urlsplit = url.split("/");

  var category = urlsplit[1];
  var productid = urlsplit[2];
  var home = urlsplit[0];

  if (productid) {
    get_product_detail("", productid);
  } else if (category) {
    get_products("", category);
  } else if (home == "home" || home == "products") {
    get_products_home();
  } else if (home == "") {
    get_products_home();
    document.location.hash = "!home";
  }
}

function update_cart(reload_modals) {
  $(".hloading").show();
  $.ajax({
    url: site_url + "set/updated-cart/",
    type: "GET",
  }).done(function (data) {
    $(".cart-main-wrapper").hide().html(data).fadeIn();
    $(".hloading").hide();
  });

  if (reload_modals != false) {
    load_modals();
  }
}

function clear_cart() {
  $(".hloading").show();
  $.ajax({
    url: site_url + "set/clear-cart/",
    type: "GET",
  }).done(function (data) {
    $(".cart-main-wrapper").fadeOut();
    $(".hloading").hide();
  });
}

function loaddatepicker() {
  var fullmonth_array = $.datepicker.regional["en"].monthNames;
  $(".datepicker_selector").datetimepicker({
    minDate: "+1D",
    minTime: "8:00 am",
    maxTime: "5:00 pm",
    changeMonth: true,
    changeYear: true,
    monthNamesShort: fullmonth_array,
    controlType: "select",
    dateFormat: "dd/mm/yy",
    timeFormat: "hTT",
  });
}

function load_modals() {
  $(".hloading").show();
  $.ajax({
    url: site_url + "get/load-modals/",
    type: "GET",
  }).done(function (data) {
    $(".modals-main-wrapper").html(data);
    $(".hloading").hide();
  });
}

$(window).on("hashchange", function (e) {
  update_contents();
});

jQuery(document).ready(function ($) {
  var url = window.location.hash.substring(2);
  var urlsplit = url.split("/");

  var category = urlsplit[1];
  var productid = urlsplit[2];
  var home = urlsplit[0];

  if (!$(".intro-box .inner").is(":visible")) {
    if (productid) {
      $("html,body").animate({ scrollTop: $(".types").offset().top }, 500);
    } else if (category) {
      $("html,body").animate({ scrollTop: $(".types").offset().top }, 500);
    } else if (home == "products") {
      $("html,body").animate({ scrollTop: $(".types").offset().top }, 500);
    }
  }

  update_contents();
  update_cart();
  loaddatepicker();

  $("#dynamic_content").on(
    "click",
    ".product-detail .buy-button",
    function (e) {
      $(".hloading").show();
      e.preventDefault();
      var url = window.location.hash.substring(2);
      var urlsplit = url.split("/");
      var productid = urlsplit[2];
      if (productid) {
        var quantity = $(".product-detail #quantity").val();
        var decoration = $(".product-detail #decoration").val();
        var special_instructions = $(
          ".product-detail #special_instructions"
        ).val();
        var size_id = $(".product-detail .size_id_field").val();
        $.ajax({
          url: site_url + "set/buy/",
          data: {
            product_id: productid,
            size_id: size_id,
            quantity: quantity,
            decoration_id: decoration,
            special_instructions: special_instructions,
          },
          type: "POST",
        }).done(function (data) {
          if (data == "1") {
            update_cart();
          }
          $(".hloading").hide();
        });
      }
    }
  );

  $("body").on("click", ".wholesale_modal .submit", function (e) {
    e.preventDefault();
    var user_code = $(".wholesale_modal #user_code").val();
    var remember_me = $(".wholesale_modal #remember_me:checked").val();
    if (user_code) {
      $.ajax({
        url: site_url + "set/get-wholesale-user-info/",
        data: { user_code: user_code, remember_me: remember_me },
        type: "POST",
        dataType: "json",
      }).done(function (data) {
        if (data) {
          $("#checkout_wholesale_modal").modal("hide");
          $("#payment_modal_logged").modal("show");

          $(".user_company").html(data.company_name);
          $(".user_name").html(data.contact_name);
          $(".user_address").html(data.address_line_1);
          $(".user_city").html(data.city);
          $(".user_zip").html(data.zip_code);
          $(".user_phone").html(data.phone_number);
          $(".user_fax").html(data.fax);
          $(".user_email").html(data.contact_email);
        } else {
          alert("Wrong Code");
        }
      });
    }
  });

  $("body").on(
    "click",
    "#payment_modal_logged .payment_info .submit",
    function (e) {
      e.preventDefault();

      //put here code to handle submit order
      $.ajax({
        url: site_url + "set/send-wholesale-order/",
        type: "GET",
      }).done(function (data) {
        $("#payment_modal_logged").modal("hide");
        $("#thanks_modal").modal("show");
      });
    }
  );

  $("body").on("click", ".cart-items .cart .button.cart-btn", function (e) {
    e.preventDefault();
    clear_cart();
  });
  $("body").on(
    "click",
    ".cart-items .item .remove-item, .checkout .item .remove-item",
    function (e) {
      e.preventDefault();

      $(".hloading").show();
      var productid = $(this).data("product-id");

      if (productid) {
        var elem = $(this);
        $.ajax({
          url: site_url + "set/remove-item/" + productid,
          type: "GET",
          element: elem,
          dataType: "json",
          success: function (data, element) {
            $(this.element)
              .closest(".item")
              .fadeOut("slow", function () {
                $(this.element).closest(".item").remove();

                if (data.total_items == "0") {
                  $(".cart-main-wrapper").fadeOut();
                  $(".checkout .total .amount span").html("0");
                  $("#checkout_modal").modal("hide");
                  $(".modal-backdrop").hide();
                  load_modals();
                } else {
                  $(".checkout .total .amount span").html("sdfsdfsdfsdfsdfsdf");
                  $(
                    ".cart-items .total .amount span, .checkout .total .amount span"
                  ).html(data.total);
                  $(".cart-items .total_items").html(data.total_items);
                  if ($(".modal").is(":visible")) {
                    update_cart(false);
                  } else {
                    load_modals();
                  }
                }
              });
            $(".hloading").hide();
          },
        });
      }
    }
  );

  /*$('#dynamic_content').on('click','.product-detail .back', function(e){
      e.preventDefault();
      $('.hloading').show(); 
      history.back(1);
      var url = window.location.hash.substring(2);
      var urlsplit = url.split("/");

      var category = urlsplit[1];
      if(category){
           $('#dynamic_content .carousel-products').show("slide", { direction: "left" }, 300);
      }else{
        $('#dynamic_content .home-products').show("slide", { direction: "left" }, 300);
      }


      $('.product-detail, #related_items').fadeOut().remove();
      
      $('.hloading').hide(); 

      return false;
    });*/

  $("#dynamic_content").on("change", ".product-detail #size", function (e) {
    e.preventDefault();
    $(".hloading").show();
    var url = window.location.hash.substring(2);
    var urlsplit = url.split("/");
    var productid = urlsplit[2];
    var size_id = $(".product-detail #size").val();
    if (productid) {
      $.ajax({
        url: site_url + "get/get-price/" + productid,
        type: "POST",
        data: { size_id: size_id },
        dataType: "json",
        success: function (data) {
          console.log(data);
          $(".product-detail .price").html(data.value);
          $(".hloading").hide();
        },
      });
    }
  });

  $(".intro-box .button.closeme").click(function (e) {
    e.preventDefault();
    $(".intro-box, .intro-box-bg").fadeOut(500, function () {
      $(this).remove();
    });
    $("#menu-icon").fadeIn();
  });

  $(".intro-box .button.submit").click(function (e) {
    e.preventDefault();
    $(".hloading").show();
    var language = $(".intro-box .language:checked").val();
    var business_type = $(".intro-box .business_type_input:checked").val();
    $.ajax({
      url: site_url + "get/set-user-type/",
      data: {
        language: language,
        business_type: business_type,
        specify_business: 1,
      },
      type: "POST",
    }).done(function (data) {
      if (language) {
        location.reload();
      } else {
        $(".become-client-wrapper").hide().html(data).slideDown();
        $(".intro-box, .intro-box-bg").fadeOut(500, function () {
          $(this).remove();
        });
        $("#menu-icon").fadeIn();
        loaddatepicker();
        document.location.hash = "!home";
        update_contents();
        load_modals();
        get_categories();
      }
    });
  });

  $('#slide-menu input[type="radio"]').change(function (e) {
    e.preventDefault();
    var language = $("#slide-menu .language:checked").val();
    var business_type = $("#slide-menu .business_type_input:checked").val();
    if (!!language || !!business_type) {
      $(".hloading").show();
      $.ajax({
        url: site_url + "get/set-user-type/",
        data: {
          language: language,
          business_type: business_type,
          specify_business: 1,
        },
        type: "POST",
      }).done(function (data) {
        $(".become-client-wrapper").hide().html(data).slideDown();
        if (language) {
          location.reload();
        } else {
          loaddatepicker();
          document.location.hash = "!home";

          update_contents();
          update_cart();
          get_categories();
        }
      });
    }
  });

  $(".become-client-wrapper").on("click", ".form .btn", function (e) {
    e.preventDefault();
    var email = $('.become-client-wrapper .form input[type="text"]').val();

    if (email == "") {
      alert("Please enter Your email.");
      return false;
    }

    $(".hloading").show();
    $.ajax({
      url: site_url + "set/apply-for-wholesale/",
      data: { email: email },
      type: "POST",
    }).done(function (data) {
      $("#checkout_wholesale_modal").modal("hide");
      $("#thanks_reg_modal").modal("show");
      $(".hloading").hide();
    });
  });

  $("body").on(
    "click",
    "#checkout_wholesale_modal .apply .submit",
    function (e) {
      e.preventDefault();
      var email = $(
        '#checkout_wholesale_modal .apply input[type="text"]'
      ).val();

      if (email == "") {
        alert("Please enter Your email.");
        return false;
      }

      $(".hloading").show();
      $.ajax({
        url: site_url + "set/apply-for-wholesale/",
        data: { email: email },
        type: "POST",
      }).done(function (data) {
        $("#checkout_wholesale_modal").modal("hide");
        $("#thanks_reg_modal").modal("show");
        $(".hloading").hide();
      });
    }
  );

  $("body").on(
    "click",
    "#checkout_wholesale_modal .forgot .submit",
    function (e) {
      e.preventDefault();
      var email = $(
        '#checkout_wholesale_modal .forgot input[type="text"]'
      ).val();

      $(".hloading").show();
      $.ajax({
        url: site_url + "set/forgot-code/",
        data: { email: email },
        type: "POST",
      }).done(function (data) {
        $(".hloading").hide();
        $(".modal").modal("hide");
        $("#forgot_modal").modal("show");
      });
    }
  );

  $("body").on("click", ".checkout .details .proceed_to_pay", function (e) {
    e.preventDefault();

    var first_name = $(".checkout .details .first_name").val();
    var last_name = $(".checkout .details .last_name").val();
    var email_address = $(".checkout .details .email_address").val();
    var phone_number = $(".checkout .details .phone_number").val();
    var pickup_time = $(".checkout #pickup_time").val();
    var pickup_date = $(".checkout #pickup_date").val();

    if (first_name == "") {
      alert("Please enter Your Firstname.");
      return false;
    }
    if (last_name == "") {
      alert("Please enter Your Lastname.");
      return false;
    }
    if (email_address == "") {
      alert("Please enter Your Email.");
      return false;
    }
    if (phone_number == "") {
      alert("Please enter Your Phone Number.");
      return false;
    }

    $(".hloading").show();
    $.ajax({
      url: site_url + "set/pay-retailer/",
      data: {
        first_name: first_name,
        last_name: last_name,
        email_address: email_address,
        phone_number: phone_number,
        pickup_time: pickup_time,
        pickup_date: pickup_date,
      },
      type: "POST",
    }).done(function (data) {
      $(".hloading").hide();
      $(".modal").modal("hide");
      $("#payment_modal").modal("show");
    });
  });
});
