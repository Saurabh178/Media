$(document).ready(function() {
    
    //on click sign up, hide log in and show sign up form
    $("#signup").click(function() {
        $("#first_form").slideUp("slow",function() {
            $("#second_form").slideDown("slow");
        });
    });
    
    //on click sign in, hide sign up and show log in form
    $("#signin").click(function() {
        $("#second_form").slideUp("slow",function() {
            $("#first_form").slideDown("slow");
        });
    });
});