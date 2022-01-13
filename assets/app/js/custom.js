/*
 * Welcome to your custom JavaScript file!
 */
import $ from "jquery";

$(document).ready(function(){
    /* auto-close error-flash-messages on login-page */
    window.setTimeout(function() {
        $("#login-error, #login-notice").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 6000);
});