
/* Open the side navigation if the screen width turns to be more than 536px, if less - hide */
$(document).ready(function() {

  const mediaQuery = window.matchMedia('(min-width: 536px)');

  mediaQuery.addEventListener( "change", (e) => {
      if (e.matches) {
        openNav();
      }
      else {
        closeNav();
      }
  });
});

/* Disable href when clicking on side menu link to open an accordion */
$(document).ready(function() {
    var currLink = $("#hasSubmenu").attr("href");
    
    $(".accordion li i.fa-chevron-down").click(function(){
      $("#hasSubmenu").attr("href", "javascript:");
    });  

    $(".accordion .down").click(function(){
      $("#hasSubmenu").attr("href", currLink);
    }); 
});

/* Set the width of the side navigation to 180px and the left margin of the page content to 180px */
function openNav() {
  document.getElementById("mySidenav").style.width = "180px";
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

/* Side menu accordion */
$(function() {
  var Accordion = function(el, multiple) {
  this.el = el || {};
  this.multiple = multiple || false;
  
  var links = this.el.find('.link');
  
  links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
  }
  
  Accordion.prototype.dropdown = function(e) {
  var $el = e.data.el;
  $this = $(this),
  $next = $this.next();
  
  $next.slideToggle();
  $this.parent().toggleClass('open');
  
  if (!e.data.multiple) {
  $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
  };
  }
  
  var accordion = new Accordion($('#accordion'), false);
});

/*------------------------------------------------------*/
function check() {
    var y = document.forms["myForm"]["img"].value;
    if(y==0){
        alert("Please upload a picture of the waste");
        return false;
    }
    var z = document.forms["myForm"]["location"].value;
    if(z==""){
      alert("Please enter location");
        return false;
    }
}
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(Accepted);
  } else { 
    var x = document.getElementById("locationNotaccepted");
    x.innerHTML = " "+"location is not supported by this browser.";
  }
}

function Accepted(position) {
    var y= document.getElementById("locationText");
    y.innerHTML = " "+ position.coords.latitude + 
    "  " + position.coords.longitude;
    var x = document.getElementById("locationAccepted");
  x.innerHTML = "the location succesfully accepted";
}
/**/
