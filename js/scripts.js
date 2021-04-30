$(document).ready(function() {

    //Hamburger
    $('.menu-ham').click(function () {
        $('.menu').animate({
            left:'0px', 
        }, 100)
        $('.menu').show();
    });
    
    $('.close-menu').click(function () {
        $('.menu').animate({
            left:'-180px',
        }, 100)
        $('.menu').hide();
    });

    //Show side menu on desktop even if it was closed on the phone
    const mediaQuery = window.matchMedia('(min-width: 480px)');

    mediaQuery.addEventListener( "change", (e) => {
        if (e.matches && document.getElementsByClassName("menu")[0].style.display == "none") {
            location.reload();
        }
    });
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
