$(function () {
  var $body = $("body");
  // $('.toast').toast('show');
  //$("[data-toggle=tooltip").tooltip();
  var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
  );
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
  //Get the button:
mybutton = document.getElementById("btn-back-to-top");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};


  $(".nav-item.dropdown")
    .mouseenter(function () {
      $(this).addClass("show");
      $(this).children(".dropdown-menu").addClass("show");
      $(this).children(".dropdown-toggle").attr("aria-expanded", "true");
    })
    .mouseleave(function () {
      $(this).removeClass("show");
      $(this).children(".dropdown-menu").removeClass("show");
      $(this).children(".dropdown-toggle").attr("aria-expanded", "false");
    });

  $(".img-small").on("mouseenter click", function () {
    var src = $(this).data("src");
    $(".img-large").css("background-image", "url('" + src + "')");
  });

  var imgLarge = $(".img-large");

  imgLarge.mousemove(function (event) {
    var relX = event.pageX - $(this).offset().left;
    var relY = event.pageY - $(this).offset().top;
    var width = $(this).width();
    var height = $(this).height();
    var x = (relX / width) * 100;
    var y = (relY / height) * 100;
    $(this).css("background-position", x + "% " + y + "%");
  });

  imgLarge.mouseout(function () {
    $(this).css("background-position", "center");
  });

  $(window).resize(function () {
    setImgLarge();
    setImgSmall();
  });

  setImgLarge();
  setImgSmall();
});
//https://codepen.io/ahenriksen/pen/vYEmBWy
//Function that adds or subtracts quantity when a
// plus or minus button is clicked
$(".btn-buy").mousedown(function () {
  //reloadCart();
  var id = $("#" + $(this).attr("rel") + " input:checked").val();
  $.get("/bag/add", { id: id }, function () {
    openOffCanvas("/bag/offcanvas");
    reloadCart();
  });
});

// Cart Modification and update Prices

function setImgLarge() {
  var imgLarge = $(".img-large");
  var width = imgLarge.width();
  imgLarge.height((width * 2) / 3);
}

function setImgSmall() {
  var imgSmall = $(".img-small");
  var width = imgSmall.width();
  imgSmall.height(width);
}
function calculate() {
  $(".products").each(function () {
    var total = 0;
    $(this)
      .find(".product-count")
      .each(function () {
        var sum = $(this).val() * $(this).attr("data-price");
        total += sum;
        $(this).parents("li").find(".price").text(sum);
      });
    $(".amount").html(total);
    // reloadCart();
  });
}
function reloadCart() {
  $.get("/bag/block", function (data) {
    //$('#cart').after(data).remove();
  });
}
$(".offcanvas-body").on("click", ".plus-button, .minus-button", function () {
  // Get quanitity input values
  var qty = $(this).closest(".qty").find(".qty-input");
  var val = parseFloat(qty.val());
  var max = parseFloat(qty.attr("max"));
  var min = parseFloat(qty.attr("min"));
  var step = parseFloat(qty.attr("step"));

  // Check which button is clicked
  if ($(this).is(".plus-button")) {
    // Increase the value
    qty.val(val + step);
  } else {
    // Check if minimum button is clicked and that value is
    // >= to the minimum required
    if (min && min >= val) {
      // Do nothing because value is the minimum required
      qty.val(min);
    } else if (val > 0) {
      // Subtract the value
      qty.val(val - step);
    }
  }
  qty.trigger("change");
});
$(".offcanvas-body").on("change", ".product-count", function (e) {
  e.preventDefault();

  var a = $(this).attr("data-id");
  var b = $(this).val();
  $.get("/bag/set", { id: a, count: b }, function () {
    $('.product-count[data-id="' + a + '"]').val(b);

    calculate();
  });
});
$(".offcanvas-body").on("click", ".product-delete", function (e) {
  e.preventDefault();
  var id = $(this).attr("rel");
  $.get("/bag/del", { id: id }, function (data) {
    if (data) {
      $("#i" + id).fadeOut("normal", function () {
        $(this).remove();
        calculate();
      });
      //  reloadCart();
    }
  });
  //reloadCart();
  //calculate();

});
function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
//Get the button
let mybutton = document.getElementById("btn-back-to-top");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (
    document.body.scrollTop > 20 ||
    document.documentElement.scrollTop > 20
  ) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
// When the user clicks on the button, scroll to the top of the document
mybutton.addEventListener("click", backToTop);

function backToTop() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}