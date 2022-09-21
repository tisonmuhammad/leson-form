jQuery(function($){
    /*
     * Select/Upload image(s) event
     */
    $('body').on('click', '.misha_upload_image_button1', function(e){
        e.preventDefault();

            var button = $(this),
                custom_uploader1 = wp.media({
            title: 'Insert image cover',
            library : {
                // uncomment the next line if you want to attach image to the current post
                // uploadedTo : wp.media.view.settings.post.id, 
                type : 'image'
            },
            button: {
                text: 'Choose image' // button label text
            },
            multiple: false // for multiple image selection set to true
        }).on('select', function() { // it also has "open" and "close" events
            var attachment1 = custom_uploader1.state().get('selection').first().toJSON();
    
            $(button).removeClass('button-upload1').html('<img class="true_pre_image" src="' + attachment1.url + '" style="" />').next().val(attachment1.id).next().show();
            
            /* if you sen multiple to true, here is some code for getting the image IDs
            var attachments = frame.state().get('selection'),
                attachment_ids = new Array(),
                i = 0;
            attachments.each(function(attachment) {
                attachment_ids[i] = attachment['id'];
                console.log( attachment );
                i++;
            });
            */
        })
        .open();
    });
    /*
     * Remove image event
     */
    $('body').on('click', '.misha_remove_image_button1', function(){
        $(this).hide().prev().val('').prev().addClass('button-upload1').html('');
        return false;
    });

    // #2
    $('body').on('click', '.misha_upload_image_button2', function(e){
        e.preventDefault();
            var button = $(this),
                custom_uploader2 = wp.media({
            title: 'Insert image photo 2',
            library : {
                type : 'image'
            },
            button: {
                text: 'Choose image' // button label text
            },
            multiple: false
        }).on('select', function() {
            var attachment2= custom_uploader2.state().get('selection').first().toJSON();
            $(button).removeClass('button-upload2').html('<img class="true_pre_image" src="' + attachment2.url + '" style="" />').next().val(attachment2.id).next().show();
        })
        .open();
    });
    $('body').on('click', '.misha_remove_image_button2', function(){
        $(this).hide().prev().val('').prev().addClass('button-upload2').html('');
        return false;
    });

    // #3
    $('body').on('click', '.misha_upload_image_button3', function(e){
        e.preventDefault();
            var button = $(this),
                custom_uploader3 = wp.media({
            title: 'Insert image photo 3',
            library : {
                type : 'image'
            },
            button: {
                text: 'Choose image' // button label text
            },
            multiple: false
        }).on('select', function() {
            var attachment3= custom_uploader3.state().get('selection').first().toJSON();
            $(button).removeClass('button-upload3').html('<img class="true_pre_image" src="' + attachment3.url + '" style="" />').next().val(attachment3.id).next().show();
        })
        .open();
    });
    $('body').on('click', '.misha_remove_image_button3', function(){
        $(this).hide().prev().val('').prev().addClass('button-upload3').html('');
        return false;
    });

    // #4
    $('body').on('click', '.misha_upload_image_button4', function(e){
        e.preventDefault();
            var button = $(this),
                custom_uploader4 = wp.media({
            title: 'Insert image photo 4',
            library : {
                type : 'image'
            },
            button: {
                text: 'Choose image' // button label text
            },
            multiple: false
        }).on('select', function() {
            var attachment4= custom_uploader4.state().get('selection').first().toJSON();
            $(button).removeClass('button-upload4').html('<img class="true_pre_image" src="' + attachment4.url + '" style="" />').next().val(attachment4.id).next().show();
        })
        .open();
    });
    $('body').on('click', '.misha_remove_image_button4', function(){
        $(this).hide().prev().val('').prev().addClass('button-upload4').html('');
        return false;
    });

    // #5
    $('body').on('click', '.misha_upload_image_button5', function(e){
        e.preventDefault();
            var button = $(this),
                custom_uploader5 = wp.media({
            title: 'Insert image photo 5',
            library : {
                type : 'image'
            },
            button: {
                text: 'Choose image' // button label text
            },
            multiple: false
        }).on('select', function() {
            var attachment5= custom_uploader5.state().get('selection').first().toJSON();
            $(button).removeClass('button-upload5').html('<img class="true_pre_image" src="' + attachment5.url + '" style="" />').next().val(attachment5.id).next().show();
        })
        .open();
    });
    $('body').on('click', '.misha_remove_image_button5', function(){
        $(this).hide().prev().val('').prev().addClass('button-upload5').html('');
        return false;
    });

    // #6
    $('body').on('click', '.misha_upload_image_button6', function(e){
        e.preventDefault();
            var button = $(this),
                custom_uploader6 = wp.media({
            title: 'Insert image photo 6',
            library : {
                type : 'image'
            },
            button: {
                text: 'Choose image' // button label text
            },
            multiple: false
        }).on('select', function() {
            var attachment6= custom_uploader6.state().get('selection').first().toJSON();
            $(button).removeClass('button-upload6').html('<img class="true_pre_image" src="' + attachment6.url + '" style="" />').next().val(attachment6.id).next().show();
        })
        .open();
    });
    $('body').on('click', '.misha_remove_image_button6', function(){
        $(this).hide().prev().val('').prev().addClass('button-upload6').html('');
        return false;
    });

    // #7
    $('body').on('click', '.misha_upload_image_button7', function(e){
        e.preventDefault();
            var button = $(this),
                custom_uploader7 = wp.media({
            title: 'Insert image Additional information',
            library : {
                type : 'image'
            },
            button: {
                text: 'Choose image' // button label text
            },
            multiple: false
        }).on('select', function() {
            var attachment7= custom_uploader7.state().get('selection').first().toJSON();
            $(button).removeClass('button-upload7').html('<img class="true_pre_image" src="' + attachment7.url + '" style="" />').next().val(attachment7.id).next().show();
        })
        .open();
    });
    $('body').on('click', '.misha_remove_image_button7', function(){
        $(this).hide().prev().val('').prev().addClass('button-upload7').html('');
        return false;
    });

});
