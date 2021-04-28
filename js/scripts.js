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
        if (e.matches) {
            $('.menu').show();
        }
    });
});

