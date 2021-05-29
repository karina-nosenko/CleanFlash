
/* Open the side navigation if the screen width turns to be more than 480px, if less - hide */
$(document).ready(function() {

  const mediaQuery = window.matchMedia('(min-width: 480px)');

  mediaQuery.addEventListener( "change", (e) => {
      if (e.matches) {
        openNav();
      }
      else {
        closeNav();
      }
  });
});


/* Set the width of the side navigation to 180px and the left margin of the page content to 180px */
function openNav() {
  document.getElementById("mySidenav").style.width = "180px";
  /*document.getElementById("main").style.marginLeft = "180px";*/
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  /*document.getElementById("main").style.marginLeft = "0";*/
}

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
