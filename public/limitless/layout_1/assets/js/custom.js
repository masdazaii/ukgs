/* ------------------------------------------------------------------------------
 *
 *  # Custom JS code
 *
 *  Place here all your custom js. Make sure it's loaded after app.js
 *
 * ---------------------------------------------------------------------------- */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
});
