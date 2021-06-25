/* Make the "select" input selected when updating */
$(document).ready(function() {

  const selectObj = document.querySelector('#cat');
    ind = selectObj.dataset.selected;
    console.log(ind);
    selectObj.options[ind].selected = true;
});


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

/* Redirect when clicking on the pencil to edit */
function redirectIt(obj){
  var goToLink = obj.getAttribute("href");
  window.location.href=goToLink;
}

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


/* Change the accordion arrows when opening and closing the accordion on the File_Event_type page */
$(document).ready(function() {
  
    $("a.accordion-toggle.collapsed").click(function(){
      $("i.fas.fa-angle-right::before").toggle();
      $("i.fas.fa-angle-down::before").toggle();
    }); 
});


/*------------------------------------------------------*/
function check() {
    /*var y = document.forms["myForm"]["img"].value;
    if(y==0){
        alert("Please upload a picture of the waste");
        return false;
    }*/
    var z = document.forms["myForm"]["location"].value;
    if(z==""){
      alert("Please enter location");
        return false;
    }
}

/**/



