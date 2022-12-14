jQuery(document).ready(function(){


    // jQuery("#select2-order_status-container").click(function(){
	// 	jQuery("p").load("info.html");
	// });

    // jQuery("body").hide();

    jQuery("select#order_status").on('change', function(){
        let status = jQuery(this).val();

        if( status == 'wc-refunded' ){
            jQuery('.refund-reason').show();
        }else {
            jQuery('.refund-reason').hide();
        }
    });
    let status = jQuery("select#order_status").val();
    if( status == 'wc-refunded' ){
        jQuery('.refund-reason').show();
    }

});