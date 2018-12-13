var selector = document.getElementById("phone");
var im = new Inputmask("+9 999 999-99-99");
if (selector) {
    im.mask(selector);
}


//option
var options = $("#customer_id option");
var array_option = new Array();
for(var i=0; i<options.length; i++)  {
    array_option.push(options[i].text);
}

$("#customer_search").autocomplete({
    source: array_option,
    minLength: 3,
    select: function(event, ui){
        $("#customer_id option").each(function(){
            this.selected = (this.text == ui.item.value);
        });
    },
});


$(".ajax_post_link_delete").on('click', function() {
    var elem = $(this);
    $.ajax({
        method: "POST",
        url: elem.data( "url" ),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json'
    }).done(function( data ) {
        if (data.result == 'success'){
            elem.parents(".ajax_post_block").remove();
        }
    });
});

$(".copy_finished_at").on('click', function() {
    $('#delivery_at').val($('#finished_at').val());
});