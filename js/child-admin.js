jQuery(document).ready(function($) {      
    var page_template = $('#page_template').val();
    child_show_meta_boxes (page_template);

    $('#page_template').change(function(){
        var page_template = $(this).val();
        child_show_meta_boxes(page_template);
    });

    function child_show_meta_boxes(page_template) {
        if(page_template == 'page-template/price-page.php') {
            $('#_mosacademy_child_price_details').show();
        } else {
           $('#_mosacademy_child_price_details').hide();
        }
    }
}); 
