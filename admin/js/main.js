$(document).ready(function(){

    // user dropdown
    $('.user-avatar').click(function(){
        $(this).children('.user-dropdown').toggleClass('show')
    })


    // sidebar dropdowns
    $('.dropdown').click(function(){
        $(this).parent().children('.sub-menu').slideToggle( 300 );
    })
})