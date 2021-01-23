// this is a javascript file using jQuery to help with event listeners for my login page.
$(document).ready(function(){
    var limit = 3;
    $('input.dog').on('change', function(evt) {
        if($('input.dog:checked').length == limit) {
            setTimeout(nextPrev(1), 3000);
        }
        if($('input.dog:checked').length > limit) {
            this.checked = false;
        }
    }); 
    $('input.cat').on('change', function(evt) {
        if($('input.cat:checked').length == limit) {
            setTimeout(nextPrev(1), 3000);
        }
        if($('input.cat:checked').length > limit) {
            this.checked = false;
            nextPrev(1);
        }
    }); 
    $('input.fish').on('change', function(evt) {
        if($('input.fish:checked').length == limit) {
            setTimeout(nextPrev(1), 3000);
        }
        if($('input.fish:checked').length > limit) {
            this.checked = false;
            nextPrev(1);
        }
    }); 

});