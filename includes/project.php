<?php 

// Menu Project or Job

function ath_register_post_type( $post_type, $plural_name, $singular_name, $slug, $capability_type, $supports = [], $taxonomies = [], $public = true )
{
    $args = [
        'labels' => [
            'name'               => $singular_name,
            'singular_name'      => $singular_name,
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New '.$singular_name,
            'edit_item'          => 'Edit '.$singular_name,
            'new_item'           => 'New '.$singular_name,
            'all_items'          => 'All '.$plural_name,
            'view_item'          => 'View '.$singular_name,
            'search_items'       => 'Search '.$plural_name,
            'not_found'          => 'No '.$plural_name.' found',
            'not_found_in_trash' => 'No '.$plural_name.' found in Trash',
            'menu_name'          => $plural_name
        ],
        'label'           => $singular_name,
        'public'          => $public,
        'taxonomies'      => $taxonomies,
        'has_archive'     => true,
        'rewrite'         => [ 'slug' => $slug ],
        'capability_type' => $capability_type,
        'supports'        => array( 'title', 'author', 'thumbnail', 'attachment' ),
        'menu_position'      =>   21
    ];
    register_post_type( $post_type, $args );
}

function register_job_post_type()
{
    ath_register_post_type( 'job', 'Leson Project', 'Job', 'job', 'post', ['title', 'author', 'categori'] );
}

add_action( 'init', 'register_job_post_type' );

// load css into the admin pages
function css_style_custom() {
    wp_enqueue_style( 'style-admin-leson', plugin_dir_url( __FILE__ ) . 'css/style-admin-leson.css' );
}
add_action( 'admin_enqueue_scripts', 'css_style_custom' );

// FUNGSI MENU KATEGORI PROJEK POST
add_action('init', 'my_project_taxonomy');
function my_project_taxonomy()
{
    $args = array (
        'labels' => array(
            'name' => 'Categori',
            'singular_name' => 'Categori',
        ),

        'public' => true,
        'hierarchical' => true,
    );

    register_taxonomy('categori', array('job'), $args);
}

// FUNGSI TEMPLATE LAYOUT PROJEK POST
add_filter( 'single_template', 'load_projek_template' );
function load_projek_template( $template ) {
    global $post;

    if ( 'job' === $post->post_type && locate_template( array( 'detail-produk.php' ) ) !== $template ) {
        /*
         * This is a 'projek' post
         * AND a 'single projek template' is not found on
         * theme or child theme directories, so load it
         * from our plugin directory.
         */
        return plugin_dir_path( __FILE__ ) . '/templates/detail-produk.php';
    }

    return $template;
}


function save_job_data( $post_id, $post, $update )
{
    $meta_keys = [
        'long_description' => 'html',
        'short_description' => 'text',
        'txtDistributionCountries' => 'text',
        'ddlDistributionRegion' => 'select',
        'file_select_machin_cover_image01' => 'file',
        'file_select_machin_cover' => 'file',
        // 'file_select_machin_photo1' => 'file',
        // 'file_select_machin_photo2' => 'file',
        // 'file_select_machin_photo3' => 'file',
        // 'file_select_machin_photo4' => 'file',
        // 'file_select_machin_photo5' => 'file',
        // 'file_select_machin_additional' => 'file',

        'txtVideoLink' => 'text',
        'condition1' => 'checkbox',
        'condition2' => 'checkbox',
        'city'         => 'text',
        'country'      => 'text'
    ];

    foreach ($meta_keys as $meta_key => $type) {
        if ( isset( $_POST[ $meta_key ] ) ) {
            if ( $type === 'html' ) {
                $value = wp_kses_post( trim( $_POST[ $meta_key ] ) );
            } else {
                $value = sanitize_text_field( trim( $_POST[ $meta_key ] ) );
            }
            update_post_meta( $post_id, $meta_key, $value );
        }
    }

}
add_action( 'save_post_job', 'save_job_data', 10, 3 );


// content_projek
function content_projek()
{
    
    global $post;
        $long_description = get_post_meta( $post->ID, 'long_description', true );
        $setting = [
            'quicktags'     => false,
            'media_buttons' => false,
            'editor_height' => 120
        ];
        
        $short_description              = get_post_meta( $post->ID, 'short_description', true );
        $txtDistributionCountries       = get_post_meta( $post->ID, 'txtDistributionCountries', true );
        $ddlDistributionRegion          = get_post_meta( $post->ID, 'ddlDistributionRegion', true );
        $file_select_machin_cover_image01       = get_post_meta( $post->ID, '_image01', true );

        $url_image01                    = get_post_meta( $post->ID, 'file_select_machin_cover', true );

        // $poto_1                    = get_post_meta( $post->ID, 'poto_1', true );
        // $poto_2                    = get_post_meta( $post->ID, 'poto_2', true );
        // $poto_3                    = get_post_meta( $post->ID, 'poto_3', true );
        // $poto_4                    = get_post_meta( $post->ID, 'poto_4', true );
        $txtVideoLink                   = get_post_meta( $post->ID, 'txtVideoLink', true );
        $condition1                     = get_post_meta( $post->ID, 'condition1', true );
        $condition2                     = get_post_meta( $post->ID, 'condition2', true );
    ?>
        <div class="bt_metabox">
            <div class="bt_metabox_field hcf_field" style="border: 0px;">
                <label for="long_description">Long Description</label>
                <div class="s-full">
                    <?php
                        wp_editor( $long_description, 'long_description', $setting);
                    ?>
                </div>
            </div>
            <div class="bt_metabox_field card-alert-blue">
                <p>Please include in the description:</p>
                <ol>
                    <li>the general specifications;</li>
                    <li>the special features to mitigate plastic waste and/or marine plastic debris issues;</li>
                    <li>the advantages compared to similar products, services, or technologies;</li>
                    <li>the waste stream to which the product, service, or technology contribute (waste stream can include: household waste / business waste / industrial waste / construction waste / hazardous waste / medical waste / etc.);</li>
                    <li>the types of plastic that pertain to the product, service, or technology (types of plastic can include: thermosetting / MF / EP / PUR / UP / thermoplastics / PE(HD) / PE(LD) / PETP / PS / ABS / PC / PA / PP / etc.);</li>
                    <li>the types of plastic waste that pertain to the product, service, or technology (types of plastic waste can include: beverage containers, including PET bottle / expanded polystyrene (Styrofoam) / multilayer packaging / food packaging / plastic film / cutleries / food container / cotton buds / polybags and plant pot / slow release fertilizer / plastic bag / single-use medical devises / diapers and feminine hygiene product / straws / plates / cup for beverages / beverage stirrers / stick to be attached to support balloons / float for aquaculture / fishing net / fishing line / plastics in e-waste / plastics in ELV / etc.).</li>
                </ol>
            </div>

            <div class="bt_metabox_field hcf_field">
                <label for="short_description">Short Description</label>
                <textarea name="short_description" id="short_description" class="s-full" rows="2" cols="25" required=""><?php echo $short_description; ?></textarea>
            </div>

            <div class="bt_metabox_field hcf_field">
                <label for="txtDistributionCountries">Current Distribution Countries</label>
                <textarea name="txtDistributionCountries" id="txtDistributionCountries" class="s-full" rows="3" cols="80" required=""><?php echo $txtDistributionCountries; ?></textarea>
            </div>

            <div class="bt_metabox_field hcf_field">
                <label for="ddlDistributionRegion" class="product-row-title">Scope of a Possible Distribution Region</label>
                <select name="ddlDistributionRegion" id="ddlDistributionRegion" class="s-full">
                    <option value="" disabled selected>Please choose…</option>
                    <option value="Domestically (no international trade)" <?php if($ddlDistributionRegion == 'Domestically (no international trade)') echo 'selected'; ?>>Domestically (no international trade)</option>
                    <option value="Asian countries" <?php if($ddlDistributionRegion == 'Asian countries') echo 'selected'; ?>>Asian countries</option>
                    <option value="ASEAN countries" <?php if($ddlDistributionRegion == 'ASEAN countries') echo 'selected'; ?>>ASEAN countries</option>
                    <option value="ASEAN+3 countries" <?php if($ddlDistributionRegion == 'ASEAN+3 countries') echo 'selected'; ?>>ASEAN+3 countries</option>
                    <option value="East Asian countries" <?php if($ddlDistributionRegion == 'East Asian countries') echo 'selected'; ?>>East Asian countries</option>
                    <option value="OECD countries" <?php if($ddlDistributionRegion == 'OECD countries') echo 'selected'; ?>>OECD countries</option>
                    <option value="All over the world" <?php if($ddlDistributionRegion == 'All over the world') echo 'selected'; ?>>All over the world</option>
				</select>
            </div>

            <div class="bt_metabox_field hcf_field">
                <label for="txtVideoLink">Video Link</label>
                <input type="text" name="txtVideoLink" id="txtVideoLink" class="s-full" placeholder="Video Link" value="<?php echo $txtVideoLink; ?>" />
            </div>

            <div class="bt_metabox_field hcf_field" style="flex-direction: row;">
                <input type="checkbox" id="condition1" name="condition1" required style="margin-top:0px;" <?php if( $condition1 == true ) { ?>checked="checked"<?php } ?> />
                <label class="text-danger" for="condition1"> * On behalf of the company, I am taking responsibility and accountability for all responses written in the submission from. I guarantee that all responses contain no violation of any existing duty of confidentiality, contract, or intellectual property rights.</label>
            </div>

            <div class="bt_metabox_field hcf_field" style="flex-direction: row;">
                <input type="checkbox" id="condition2" name="condition2" required style="margin-top:0px;" <?php if( $condition2 == true ) { ?>checked="checked"<?php } ?> />
                <label class="text-danger" for="condition2"> * On behalf of the company, I agree that all responses written in the submission form can be published on the website upon screening and approval from RKC-MPD team</label>
            </div>
        </div>
    <?php
}


// Proper way to enqueue
// wp_register_script(
//   'my-upload',
//   WP_PLUGIN_URL.'/my-script.js',
//   array('jquery','media-upload','thickbox') /* dependencies */
// );
//
// wp_enqueue_script('my-upload');
  
// Long Description
// function long_description()
// {
//     global $post;

//     $long_description = get_post_meta( $post->ID, 'long_description', true );

//     $setting = [
//         'quicktags'     => false,
//         'media_buttons' => false,
//         'editor_height' => 120
//     ];
//     wp_editor( $long_description, 'long_description', $setting);
//     ?!-->
//         <p>Please include in the description:</p>
//         <ol>
//             <li>the general specifications;</li>
//             <li>the special features to mitigate plastic waste and/or marine plastic debris issues;</li>
//             <li>the advantages compared to similar products, services, or technologies;</li>
//             <li>the waste stream to which the product, service, or technology contribute (waste stream can include: household waste / business waste / industrial waste / construction waste / hazardous waste / medical waste / etc.);</li>
//             <li>the types of plastic that pertain to the product, service, or technology (types of plastic can include: thermosetting / MF / EP / PUR / UP / thermoplastics / PE(HD) / PE(LD) / PETP / PS / ABS / PC / PA / PP / etc.);</li>
//             <li>the types of plastic waste that pertain to the product, service, or technology (types of plastic waste can include: beverage containers, including PET bottle / expanded polystyrene (Styrofoam) / multilayer packaging / food packaging / plastic film / cutleries / food container / cotton buds / polybags and plant pot / slow release fertilizer / plastic bag / single-use medical devises / diapers and feminine hygiene product / straws / plates / cup for beverages / beverage stirrers / stick to be attached to support balloons / float for aquaculture / fishing net / fishing line / plastics in e-waste / plastics in ELV / etc.).</li>
//         </ol>
//     <?php
// }

// Short Description
// function short_description()
// {
//     global $post;
//         $short_description    = get_post_meta( $post->ID, 'short_description', true );
//     ?!-->
    
//         <textarea name="short_description" id="" class="s-full" rows="2" cols="25"><?php echo $short_description; ?!--></textarea>
//     <?php
// }

// Current Distribution Countries
// function txtDistributionCountries()
// {
//     global $post;
//         $txtDistributionCountries    = get_post_meta( $post->ID, 'txtDistributionCountries', true );
//     ?!-->
    
//         <textarea name="txtDistributionCountries" id="" class="s-full" rows="3" cols="80"><?php echo $txtDistributionCountries; ?--></textarea>
//     <?php
// }
function misha_include_myuploadscript() {
    /*
     * I recommend to add additional conditions just to not to load the scipts on each page
     * like:
     * if ( !in_array('post-new.php','post.php') ) return;
     */
    if ( ! did_action( 'wp_enqueue_media' ) ) {
        wp_enqueue_media();
    }
    // wp_enqueue_style( 'style-admin-leson', plugin_dir_url( __FILE__ ) . 'css/style-admin-leson.css' );
    wp_enqueue_script( 'myuploadscript', plugin_dir_url( __FILE__ ) . 'js/customscript.js', array('jquery'), null, false );
}

add_action( 'admin_enqueue_scripts', 'misha_include_myuploadscript' );

function misha_image_uploader_field1( $name1, $value1 = '') {
    $image1 = ' button-upload1">';
    $image_size1 = 'full'; // it would be better to use thumbnail size here (150x150 or so)
    $display1 = 'none'; // display state ot the "Remove image" button

    if ( $image_attributes1 = wp_get_attachment_image_src( $value1, $image_size1 ) ) {

        // $image_attributes[0] - image URL
        // $image_attributes[1] - image width
        // $image_attributes[2] - image height

        $image1 = '"><img src="' . $image_attributes1[0] . '" class="true_pre_image" style="" />';
        $display1 = 'inline-block';
    }

    return '
    <div class="bt_metabox_field hcf_box_3">
        <div class="bt_metabox_field hcf_field t-center">
            <label for="">Cover Photo</label>
            <button class="image-select image-select__preview--no-preview misha_upload_image_button1' . $image1 . '<span class="screen-reader-text">Select image</span></button>
            <input type="hidden" name="' . $name1 . '" id="' . $name1 . '" value="' . $value1 . '" />
            <button type="button" class="misha_remove_image_button1" style="display:inline-block;display:' . $display1 . '">Remove image</button>
        </div>
    ';
}
function misha_image_uploader_field2( $name2, $value2 = '') {
    $image2 = ' button-upload2">';
    $image_size2 = 'full'; // it would be better to use thumbnail size here (150x150 or so)
    $display2 = 'none'; // display state ot the "Remove image" button

    if ( $image_attributes2 = wp_get_attachment_image_src( $value2, $image_size2 ) ) {

        $image2 = '"><img src="' . $image_attributes2[0] . '" class="true_pre_image" style="" />';
        $display2 = 'inline-block';
    }

    return '
        <div class="bt_metabox_field hcf_field t-center">
            <label for="">Photo 2</label>
            <button class="image-select image-select__preview--no-preview misha_upload_image_button2' . $image2 . '<span class="screen-reader-text">Select image</span></button>
            <input type="hidden" name="' . $name2 . '" id="' . $name2 . '" value="' . $value2 . '" />
            <button type="button" class="misha_remove_image_button2" style="display:inline-block;display:' . $display2 . '">Remove image</button>
        </div>
    ';
}
function misha_image_uploader_field3( $name3, $value3 = '') {
    $image3 = ' button-upload4">';
    $image_size3 = 'full'; // it would be better to use thumbnail size here (150x150 or so)
    $display3 = 'none'; // display state ot the "Remove image" button

    if ( $image_attributes3 = wp_get_attachment_image_src( $value3, $image_size3 ) ) {

        $image3 = '"><img src="' . $image_attributes3[0] . '" class="true_pre_image" style="" />';
        $display3 = 'inline-block';
    }

    return '
        <div class="bt_metabox_field hcf_field t-center">
            <label for="">Photo 3</label>
            <button class="image-select image-select__preview--no-preview misha_upload_image_button3' . $image3 . '<span class="screen-reader-text">Select image</span></button>
            <input type="hidden" name="' . $name3 . '" id="' . $name3 . '" value="' . $value3 . '" />
            <button type="button" class="misha_remove_image_button3" style="display:inline-block;display:' . $display3 . '">Remove image</button>
        </div>
    </div>
    ';
}
function misha_image_uploader_field4( $name4, $value4 = '') {
    $image4 = ' button-upload4">';
    $image_size4 = 'full'; // it would be better to use thumbnail size here (150x150 or so)
    $display4 = 'none'; // display state ot the "Remove image" button

    if ( $image_attributes4 = wp_get_attachment_image_src( $value4, $image_size4 ) ) {

        $image4 = '"><img src="' . $image_attributes4[0] . '" class="true_pre_image" style="" />';
        $display4 = 'inline-block';
    }

    return '
    <div class="bt_metabox_field hcf_box_3">
        <div class="bt_metabox_field hcf_field t-center">
            <label for="">Photo 4</label>
            <button class="image-select image-select__preview--no-preview misha_upload_image_button4' . $image4 . '<span class="screen-reader-text">Select image</span></button>
            <input type="hidden" name="' . $name4 . '" id="' . $name4 . '" value="' . $value4 . '" />
            <button type="button" class="misha_remove_image_button4" style="display:inline-block;display:' . $display4 . '">Remove image</button>
        </div>
    ';
}
function misha_image_uploader_field5( $name5, $value5 = '') {
    $image5 = ' button-upload5">';
    $image_size5 = 'full'; // it would be better to use thumbnail size here (150x150 or so)
    $display5 = 'none'; // display state ot the "Remove image" button

    if ( $image_attributes5 = wp_get_attachment_image_src( $value5, $image_size5 ) ) {

        $image5 = '"><img src="' . $image_attributes5[0] . '" class="true_pre_image" style="" />';
        $display5 = 'inline-block';
    }

    return '
        <div class="bt_metabox_field hcf_field t-center">
            <label for="">Photo 5</label>
            <button class="image-select image-select__preview--no-preview misha_upload_image_button5' . $image5 . '<span class="screen-reader-text">Select image</span></button>
            <input type="hidden" name="' . $name5 . '" id="' . $name5 . '" value="' . $value5 . '" />
            <button type="button" class="misha_remove_image_button5" style="display:inline-block;display:' . $display5 . '">Remove image</button>
        </div>
    ';
}
function misha_image_uploader_field6( $name6, $value6 = '') {
    $image6 = ' button-upload6">';
    $image_size6 = 'full'; // it would be better to use thumbnail size here (150x150 or so)
    $display6 = 'none'; // display state ot the "Remove image" button

    if ( $image_attributes6 = wp_get_attachment_image_src( $value6, $image_size6 ) ) {

        $image6 = '"><img src="' . $image_attributes6[0] . '" class="true_pre_image" style="" />';
        $display6 = 'inline-block';
    }

    return '
        <div class="bt_metabox_field hcf_field t-center">
            <label for="">Photo 6</label>
            <button class="image-select image-select__preview--no-preview misha_upload_image_button6' . $image6 . '<span class="screen-reader-text">Select image</span></button>
            <input type="hidden" name="' . $name6 . '" id="' . $name6 . '" value="' . $value6 . '" />
            <button type="button" class="misha_remove_image_button6" style="display:inline-block;display:' . $display6 . '">Remove image</button>
        </div>
    </div>
    ';
}
function misha_image_uploader_field7( $name7, $value7 = '') {
    $image7 = ' button-upload7">';
    $image_size7 = 'full'; // it would be better to use thumbnail size here (150x150 or so)
    $display7 = 'none'; // display state ot the "Remove image" button

    if ( $image_attributes7 = wp_get_attachment_image_src( $value7, $image_size7 ) ) {

        $image7 = '"><img src="' . $image_attributes7[0] . '" class="true_pre_image" style="" />';
        $display7 = 'inline-block';
    }

    return '
    <div class="bt_metabox_field hcf_box_3">
        <div class="bt_metabox_field hcf_field t-center">
            <label for="">Additional information</label>
            <button class="image-select image-select__preview--no-preview misha_upload_image_button7' . $image7 . '<span class="screen-reader-text">Select image</span></button>
            <input type="hidden" name="' . $name7 . '" id="' . $name7 . '" value="' . $value7 . '" />
            <button type="button" class="misha_remove_image_button7" style="display:inline-block;display:' . $display7 . '">Remove image</button>
        </div>
    </div>
    ';
}

/*
 * Add a meta box
 */
add_action( 'admin_menu', 'misha_meta_box_add' );

function misha_meta_box_add() {
    add_meta_box('mishadiv', // meta box ID
        'Upload image', // meta box title
        'misha_print_box', // callback function that prints the meta box HTML 
        'job', // post type where to add it
        'normal', // priority
        'high' ); // position
}

/*
 * Meta Box HTML
 */
function misha_print_box( $post ) {
    $meta_keys = [
        'gambar_utama' => 'text',
        'poto_1' => 'text',
        'poto_2' => 'text',
        'poto_3' => 'text',
        'poto_4' => 'text',
        'poto_5' => 'text',
        'poto_additional' => 'text',
    ];
    // $meta_key = 'gambar_utama';
    // $meta_key = 'poto_1';
    // $meta_key = 'poto_2';
    // $meta_key = 'poto_3';
    // $meta_key = 'poto_4';
    // $meta_key = 'poto_5';
    // $meta_key = 'poto_additional';

    // $short_description              = get_post_meta( $post->ID, 'short_description', true );
    // echo misha_image_uploader_field1( $meta_key, get_post_meta($post->ID, $meta_key, true) );
    echo misha_image_uploader_field1( 'gambar_utama', get_post_meta($post->ID, 'gambar_utama', true) );
    echo misha_image_uploader_field2( 'poto_1', get_post_meta($post->ID, 'poto_1', true) );
    echo misha_image_uploader_field3( 'poto_2', get_post_meta($post->ID, 'poto_2', true) );
    echo misha_image_uploader_field4( 'poto_3', get_post_meta($post->ID, 'poto_3', true) );
    echo misha_image_uploader_field5( 'poto_4', get_post_meta($post->ID, 'poto_4', true) );
    echo misha_image_uploader_field6( 'poto_5', get_post_meta($post->ID, 'poto_5', true) );
    echo misha_image_uploader_field7( 'poto_additional', get_post_meta($post->ID, 'poto_additional', true) );
}

/*
 * Save Meta Box data
 */
add_action('save_post', 'misha_save');

function misha_save( $post_id ) {
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
        return $post_id;

    $meta_keys = [
        'gambar_utama' => 'text',
        'poto_1' => 'text',
        'poto_2' => 'text',
        'poto_3' => 'text',
        'poto_4' => 'text',
        'poto_5' => 'text',
        'poto_additional' => 'text',
    ];
    // $meta_key = 'gambar_utama';
    // $meta_key = 'poto_1';
    // $meta_key = 'poto_2';
    // $meta_key = 'poto_3';
    // $meta_key = 'poto_4';
    // $meta_key = 'poto_5';
    // $meta_key = 'poto_additional';

    update_post_meta( $post_id, 'gambar_utama', $_POST['gambar_utama'] );
    update_post_meta( $post_id, 'poto_1', $_POST['poto_1'] );
    update_post_meta( $post_id, 'poto_2', $_POST['poto_2'] );
    update_post_meta( $post_id, 'poto_3', $_POST['poto_3'] );
    update_post_meta( $post_id, 'poto_4', $_POST['poto_4'] );
    update_post_meta( $post_id, 'poto_5', $_POST['poto_5'] );
    update_post_meta( $post_id, 'poto_additional', $_POST['poto_additional'] );
    // update_post_meta( $post_id, $meta_key, $_POST[$meta_key] );

    // if you would like to attach the uploaded image to this post, uncomment the line:
    // wp_update_post( array( 'ID' => $_POST[$meta_key], 'post_parent' => $post_id ) );
    // wp_update_post( array( 'ID' => $_POST['gambar_utama'], 'post_parent' => $post_id ) );
    // wp_update_post( array( 'ID' => $_POST['poto_1'], 'post_parent' => $post_id ) );
    // wp_update_post( array( 'ID' => $_POST['poto_2'], 'post_parent' => $post_id ) );
    // wp_update_post( array( 'ID' => $_POST['poto_3'], 'post_parent' => $post_id ) );
    // wp_update_post( array( 'ID' => $_POST['poto_4'], 'post_parent' => $post_id ) );
    // wp_update_post( array( 'ID' => $_POST['poto_5'], 'post_parent' => $post_id ) );
    // wp_update_post( array( 'ID' => $_POST['poto_additional'], 'post_parent' => $post_id ) );

    return $post_id;
}

function location()
{
    global $post;
        $city    = get_post_meta( $post->ID, 'city', true );
        $country = get_post_meta( $post->ID, 'country', true );
    ?>
        <input type="text" name="city" class="regular-text" placeholder="City" value="<?php echo $city; ?>" /><br>
        <input type="text" name="country" class="regular-text" placeholder="Country" value="<?php echo $country; ?>" />
    <?php
}


function adds_job_meta_boxes() 
{
    add_meta_box( 'job_content_projek', 'Product, Service, or Technology', 'content_projek', 'job', 'normal', 'default' );
    // add_meta_box( 'job_long_description', 'Long Description', 'long_description', 'job', 'normal', 'default' );
    // add_meta_box( 'job_short_description', 'Short Description', 'short_description', 'job', 'normal', 'default' );
    // add_meta_box( 'job_txtDistributionCountries', 'Current Distribution Countries', 'txtDistributionCountries', 'job', 'normal', 'default' );
    add_meta_box( 'job_location', 'Location', 'location', 'job', 'normal', 'default' );
}

add_action( 'add_meta_boxes', 'adds_job_meta_boxes' );


// ADD Custom Field Edit Profile
add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );
add_action( 'user_registration_edit_profile_form', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
    <hr style="margin-top: 3rem;">
    
    <!-- Contact Details -->
    <h2 style="margin-top:1.5rem;"><?php _e("Contact Details", "blank"); ?></h2>
    <!-- First Contact Person -->
    <h4><?php _e("First Contact Person", "blank"); ?></h4>
    <table class="form-table">
        <tr>
            <th><label for="first_contact_title"><?php _e("Title"); ?></label></th>
            <td>
                <select name="first_contact_title" id="first_contact_title">
                    <option value="" disabled selected>Please choose title</option>
                    <option value="Mr" <?php selected( 'Mr', get_the_author_meta( 'first_contact_title', $user->ID ) ); ?> >Mr</option>
                    <option value="Mrs" <?php selected( 'Mrs', get_the_author_meta( 'first_contact_title', $user->ID ) ); ?> >Mrs</option>
                    <option value="Ms" <?php selected( 'Ms', get_the_author_meta( 'first_contact_title', $user->ID ) ); ?> >Ms</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="first_contact_name"><?php _e("Name"); ?></label></th>
            <td>
                <input type="text" name="first_contact_name" id="first_contact_name" value="<?php echo esc_attr( get_the_author_meta( 'first_contact_name', $user->ID ) ); ?>" class="regular-text" /><br />
                <p class="description"><?php _e("Please appoint a contact person from the company who will handle this application and directly communicate with us. The name of this person will not be disclosed."); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="first_contact_email"><?php _e("Email"); ?></label></th>
            <td>
                <input type="email" name="first_contact_email" id="first_contact_email" value="<?php echo esc_attr( get_the_author_meta( 'first_contact_email', $user->ID ) ); ?>" class="regular-text" /><br />
                <p class="description"><?php _e("Please provide an email address of the appointed contact person. This email will not be disclosed."); ?></p>
            </td>
        </tr>
    </table>
    <!-- Second Contact Person -->
    <h4><?php _e("Second Contact Person", "blank"); ?></h4>
    <table class="form-table">
        <tr>
            <th><label for="second_contact_title"><?php _e("Title"); ?></label></th>
            <td>
                <select name="second_contact_title" id="second_contact_title">
                    <option value="" disabled selected>Please choose title</option>
                    <option value="Mr" <?php selected( 'Mr', get_the_author_meta( 'second_contact_title', $user->ID ) ); ?> >Mr</option>
                    <option value="Mrs" <?php selected( 'Mrs', get_the_author_meta( 'second_contact_title', $user->ID ) ); ?> >Mrs</option>
                    <option value="Ms" <?php selected( 'Ms', get_the_author_meta( 'second_contact_title', $user->ID ) ); ?> >Ms</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="second_contact_name"><?php _e("Name"); ?></label></th>
            <td>
                <input type="text" name="second_contact_name" id="second_contact_name" value="<?php echo esc_attr( get_the_author_meta( 'second_contact_name', $user->ID ) ); ?>" class="regular-text" /><br />
                <p class="description"><?php _e("Please appoint a contact person from your company, if any, whose name will be shown on the website."); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="second_contact_email"><?php _e("Email"); ?></label></th>
            <td>
                <input type="email" name="second_contact_email" id="second_contact_email" value="<?php echo esc_attr( get_the_author_meta( 'second_contact_email', $user->ID ) ); ?>" class="regular-text" /><br />
                <p class="description"><?php _e("Please provide an email address of the appointed contact person or the corporate media contact. Please be aware that this email will be shown on the website."); ?></p>
            </td>
        </tr>
    </table>

    <!-- Company Details -->
    <h2><?php _e("Company Details", "blank"); ?></h2>
    <table class="form-table" role="presentation">
        <tr>
            <th><label for="company_name"><?php _e("Company Name"); ?></label></th>
            <td>
                <input type="text" name="company_name" id="company_name" value="<?php echo esc_attr( get_the_author_meta( 'company_name', $user->ID ) ); ?>" class="regular-text" /><br />
                <p class="description"><?php _e("Please provide the full name of the company."); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="company_city"><?php _e("Company Headquarter"); ?></label></th>
            <td>
                <input type="text" name="company_city" id="company_city" value="<?php echo esc_attr( get_the_author_meta( 'company_city', $user->ID ) ); ?>" class="regular-text" /><br />
                <p class="description"><?php _e("Please provide where the company headquarter is located, including the city and country names."); ?></p>
            <!-- </td> -->
                <br>
                <label for="company_country"><?php _e("Company Country"); ?></label>
                <br>
            <!-- <td> -->
                <select name="company_country" id="company_country">
                    <option value="" disabled selected>Please select choose country</option>
                    <option value="Afghanistan, Islamic Emirate of" <?php selected( 'Afghanistan, Islamic Emirate of', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Afghanistan, Islamic Emirate of</option>
                    <option value="Albania" <?php selected( 'Albania', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Albania</option>
                    <option value="Algeria" <?php selected( 'Algeria', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Algeria</option>
                    <option value="American Samoa" <?php selected( 'American Samoa', get_the_author_meta( 'company_country', $user->ID ) ); ?> >American Samoa</option>
                    <option value="Andorra" <?php selected( 'Andorra', get_the_author_meta( 'company_country', $user->ID ) ); ?> >AndorrA</option>
                    <option value="Angola" <?php selected( 'Angola', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Angola</option>
                    <option value="Anguilla" <?php selected( 'Anguilla', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Anguilla</option>
                    <option value="Antarctica" <?php selected( 'Antarctica', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Antarctica</option>
                    <option value="Antigua and Barbuda" <?php selected( 'Antigua and Barbuda', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Antigua and Barbuda</option>
                    <option value="Argentina" <?php selected( 'Argentina', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Argentina</option>
                    <option value="Armenia" <?php selected( 'Armenia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Armenia</option>
                    <option value="Aruba" <?php selected( 'Aruba', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Aruba</option>
                    <option value="Australia" <?php selected( 'Australia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Australia</option>
                    <option value="Austria" <?php selected( 'Austria', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Austria</option>
                    <option value="Azerbaijan" <?php selected( 'Azerbaijan', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Azerbaijan</option>
                    <option value="Bahamas" <?php selected( 'Bahamas', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Bahamas</option>
                    <option value="Bahrain" <?php selected( 'Bahrain', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Bahrain</option>
                    <option value="Bangladesh" <?php selected( 'Bangladesh', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Bangladesh</option>
                    <option value="Barbados" <?php selected( 'Barbados', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Barbados</option>
                    <option value="Belarus" <?php selected( 'Belarus', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Belarus</option>
                    <option value="Belgium" <?php selected( 'Belgium', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Belgium</option>
                    <option value="Belize" <?php selected( 'Belize', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Belize</option>
                    <option value="Benin" <?php selected( 'Benin', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Benin</option>
                    <option value="Bermuda" <?php selected( 'Bermuda', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Bermuda</option>
                    <option value="Bhutan" <?php selected( 'Bhutan', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Bhutan</option>
                    <option value="Bolivia" <?php selected( 'Bolivia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Bolivia</option>
                    <option value="Bosnia and Herzegovina" <?php selected( 'Bosnia and Herzegovina', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Bosnia and Herzegovina</option>
                    <option value="Botswana" <?php selected( 'Botswana', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Botswana</option>
                    <option value="Bouvet Island" <?php selected( 'Botswana', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Bouvet Island</option>
                    <option value="Brazil" <?php selected( 'Brazil', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Brazil</option>
                    <option value="British Indian Ocean Territory" <?php selected( 'British Indian Ocean Territory', get_the_author_meta( 'company_country', $user->ID ) ); ?> >British Indian Ocean Territory</option>
                    <option value="Brunei Darussalam" <?php selected( 'Brunei Darussalam', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Brunei Darussalam</option>
                    <option value="Bulgaria" <?php selected( 'Bulgaria', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Bulgaria</option>
                    <option value="Burkina Faso" <?php selected( 'Burkina Faso', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Burkina Faso</option>
                    <option value="Burundi" <?php selected( 'Burundi', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Burundi</option>
                    <option value="Cambodia" <?php selected( 'Cambodia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Cambodia</option>
                    <option value="Cameroon" <?php selected( 'Cameroon', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Cameroon</option>
                    <option value="Canada" <?php selected( 'Canada', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Canada</option>
                    <option value="Cape Verde" <?php selected( 'Cape Verde', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Cape Verde</option>
                    <option value="Cayman Islands" <?php selected( 'Cayman Islands', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Cayman Islands</option>
                    <option value="Central African Republic" <?php selected( 'Central African Republic', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Central African Republic</option>
                    <option value="Chad" <?php selected( 'Chad', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Chad</option>
                    <option value="Chile" <?php selected( 'Chile', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Chile</option>
                    <option value="People's Republic of Tiongkok" <?php selected( "People's Republic of Tiongkok", get_the_author_meta( 'company_country', $user->ID ) ); ?> >People's Republic of Tiongkok</option>
                    <option value="Christmas Island" <?php selected( 'Christmas Island', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Christmas Island</option>
                    <option value="Cocos (Keeling) Islands" <?php selected( 'Cocos (Keeling) Islands', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Cocos (Keeling) Islands</option>
                    <option value="Colombia" <?php selected( 'Colombia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Colombia</option>
                    <option value="Comoros" <?php selected( 'Comoros', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Comoros</option>
                    <option value="Congo" <?php selected( 'Congo', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Congo</option>
                    <option value="Democratic Republic of the Congo" <?php selected( 'Democratic Republic of the Congo', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Democratic Republic of the Congo</option>
                    <option value="Cook Islands" <?php selected( 'Cook Islands', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Cook Islands</option>
                    <option value="Costa Rica" <?php selected( 'Costa Rica', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Costa Rica</option>
                    <option value="Côte d'Ivoire" <?php selected( "Côte d'Ivoire", get_the_author_meta( 'company_country', $user->ID ) ); ?> >Côte d'Ivoire</option>
                    <option value="Croatia" <?php selected( 'Croatia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Croatia</option>
                    <option value="Cuba" <?php selected( 'Cuba', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Cuba</option>
                    <option value="Cyprus" <?php selected( 'Cyprus', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Cyprus</option>
                    <option value="Czech Republic" <?php selected( 'Czech Republic', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Czech Republic</option>
                    <option value="Denmark" <?php selected( 'Denmark', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Denmark</option>
                    <option value="Djibouti" <?php selected( 'Djibouti', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Djibouti</option>
                    <option value="Dominica" <?php selected( 'Dominica', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Dominica</option>
                    <option value="Dominican Republic" <?php selected( 'Dominican Republic', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Dominican Republic</option>
                    <option value="Ecuador" <?php selected( 'Ecuador', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Ecuador</option>
                    <option value="Egypt" <?php selected( 'Egypt', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Egypt</option>
                    <option value="El Salvador" <?php selected( 'El Salvador', get_the_author_meta( 'company_country', $user->ID ) ); ?> >El Salvador</option>
                    <option value="Equatorial Guinea" <?php selected( 'Equatorial Guinea', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Equatorial Guinea</option>
                    <option value="Eritrea" <?php selected( 'Eritrea', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Eritrea</option>
                    <option value="Estonia" <?php selected( 'Estonia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Estonia</option>
                    <option value="Ethiopia" <?php selected( 'Ethiopia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Ethiopia</option>
                    <option value="Falkland Islands (Malvinas)" <?php selected( 'Falkland Islands (Malvinas)', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Falkland Islands (Malvinas)</option>
                    <option value="Faroe Islands" <?php selected( 'Faroe Islands', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Faroe Islands</option>
                    <option value="Fiji" <?php selected( 'Fiji', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Fiji</option>
                    <option value="Finland" <?php selected( 'Finland', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Finland</option>
                    <option value="France" <?php selected( 'France', get_the_author_meta( 'company_country', $user->ID ) ); ?> >France</option>
                    <option value="French Guiana" <?php selected( 'French Guiana', get_the_author_meta( 'company_country', $user->ID ) ); ?> >French Guiana</option>
                    <option value="French Polynesia" <?php selected( 'French Polynesia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >French Polynesia</option>
                    <option value="French Southern and Antarctic Lands" <?php selected( 'French Southern and Antarctic Lands', get_the_author_meta( 'company_country', $user->ID ) ); ?> >French Southern and Antarctic Lands</option>
                    <option value="Gabon" <?php selected( 'Gabon', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Gabon</option>
                    <option value="Gambia" <?php selected( 'Gambia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Gambia</option>
                    <option value="Georgia" <?php selected( 'Georgia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Georgia</option>
                    <option value="Germany" <?php selected( 'Germany', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Germany</option>
                    <option value="Ghana" <?php selected( 'Ghana', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Ghana</option>
                    <option value="Gibraltar" <?php selected( 'Gibraltar', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Gibraltar</option>
                    <option value="Greece" <?php selected( 'Greece', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Greece</option>
                    <option value="Greenland" <?php selected( 'Greenland', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Greenland</option>
                    <option value="Grenada" <?php selected( 'Grenada', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Grenada</option>
                    <option value="Guadeloupe" <?php selected( 'Guadeloupe', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Guadeloupe</option>
                    <option value="Guam" <?php selected( 'Guam', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Guam</option>
                    <option value="Guatemala" <?php selected( 'Guatemala', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Guatemala</option>
                    <option value="Guernsey" <?php selected( 'Guernsey', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Guernsey</option>
                    <option value="Guinea" <?php selected( 'Guinea', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Guinea</option>
                    <option value="Guinea-Bissau" <?php selected( 'Guinea-Bissau', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Guinea-Bissau</option>
                    <option value="Guyana" <?php selected( 'Guyana', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Guyana</option>
                    <option value="Haiti" <?php selected( 'Haiti', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Haiti</option>
                    <option value="Heard Island and McDonald Islands" <?php selected( 'Heard Island and McDonald Islands', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Heard Island and McDonald Islands</option>
                    <option value="Vatican City" <?php selected( 'Vatican City', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Vatican City</option>
                    <option value="Honduras" <?php selected( 'Honduras', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Honduras</option>
                    <option value="Hong Kong, Province of China" <?php selected( 'Hong Kong, Province of China', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Hong Kong, Province of China</option>
                    <option value="Hungary" <?php selected( 'Hungary', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Hungary</option>
                    <option value="Iceland" <?php selected( 'Iceland', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Iceland</option>
                    <option value="India" <?php selected( 'India', get_the_author_meta( 'company_country', $user->ID ) ); ?> >India</option>
                    <option value="Indonesia" <?php selected( 'Indonesia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Indonesia</option>
                    <option value="Islamic Republic of Iran" <?php selected( 'Islamic Republic of Iran', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Islamic Republic of Iran</option>
                    <option value="Iraq" <?php selected( 'Iraq', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Iraq</option>
                    <option value="Ireland" <?php selected( 'Ireland', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Ireland</option>
                    <option value="Isle of Man" <?php selected( 'Isle of Man', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Isle of Man</option>
                    <option value="Zionist Israel" <?php selected( 'Zionist Israel', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Zionist Israel</option>
                    <option value="Italy" <?php selected( 'Italy', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Italy</option>
                    <option value="Jamaica" <?php selected( 'Jamaica', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Jamaica</option>
                    <option value="Japan" <?php selected( 'Japan', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Japan</option>
                    <option value="Jersey" <?php selected( 'Jersey', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Jersey</option>
                    <option value="Jordan" <?php selected( 'Jordan', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Jordan</option>
                    <option value="Kazakhstan" <?php selected( 'Kazakhstan', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Kazakhstan</option>
                    <option value="Kenya" <?php selected( 'Kenya', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Kenya</option>
                    <option value="Kiribati" <?php selected( 'Kiribati', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Kiribati</option>
                    <option value="North Korea, Democratic People's Republic of Korea" <?php selected( "North Korea, Democratic People's Republic of Korea", get_the_author_meta( 'company_country', $user->ID ) ); ?> >North Korea, Democratic People's Republic of Korea</option>
                    <option value="South Korea, Republic of Korea" <?php selected( 'South Korea, Republic of Korea', get_the_author_meta( 'company_country', $user->ID ) ); ?> >South Korea, Republic of Korea</option>
                    <option value="Kuwait" <?php selected( 'Kuwait', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Kuwait</option>
                    <option value="Kyrgyzstan" <?php selected( 'Kyrgyzstan', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Kyrgyzstan</option>
                    <option value="Laos, Lao People'S Democratic Republic" <?php selected( "Laos, Lao People'S Democratic Republic", get_the_author_meta( 'company_country', $user->ID ) ); ?> >Laos, Lao People'S Democratic Republic</option>
                    <option value="Åland Islands" <?php selected( 'Åland Islands', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Åland Islands</option>
                    <option value="Latvia" <?php selected( 'Latvia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Latvia</option>
                    <option value="Lebanon" <?php selected( 'Lebanon', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Lebanon</option>
                    <option value="Lesotho" <?php selected( 'Lesotho', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Lesotho</option>
                    <option value="Liberia" <?php selected( 'Liberia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Liberia</option>
                    <option value="Libya" <?php selected( 'Libya', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Libya</option>
                    <option value="Liechtenstein" <?php selected( 'Liechtenstein', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Liechtenstein</option>
                    <option value="Lithuania" <?php selected( 'Lithuania', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Lithuania</option>
                    <option value="Luxembourg" <?php selected( 'Luxembourg', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Luxembourg</option>
                    <option value="Macao" <?php selected( 'Macao', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Macao</option>
                    <option value="North Macedonia" <?php selected( 'North Macedonia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >North Macedonia</option>
                    <option value="Madagascar" <?php selected( 'Madagascar', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Madagascar</option>
                    <option value="Malawi" <?php selected( 'Malawi', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Malawi</option>
                    <option value="Malaysia" <?php selected( 'Malaysia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Malaysia</option>
                    <option value="Maldives" <?php selected( 'Maldives', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Maldives</option>
                    <option value="Mali" <?php selected( 'Mali', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Mali</option>
                    <option value="Malta" <?php selected( 'Malta', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Malta</option>
                    <option value="Marshall Islands" <?php selected( 'Marshall Islands', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Marshall Islands</option>
                    <option value="Martinique" <?php selected( 'Martinique', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Martinique</option>
                    <option value="Mauritania" <?php selected( 'Mauritania', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Mauritania</option>
                    <option value="Mauritius" <?php selected( 'Mauritius', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Mauritius</option>
                    <option value="Mayotte" <?php selected( 'Mayotte', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Mayotte</option>
                    <option value="Mexico" <?php selected( 'Mexico', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Mexico</option>
                    <option value="Micronesia" <?php selected( 'Micronesia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Micronesia</option>
                    <option value="Moldova" <?php selected( 'Moldova', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Moldova</option>
                    <option value="Monaco" <?php selected( 'Monaco', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Monaco</option>
                    <option value="Mongolia" <?php selected( 'Mongolia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Mongolia</option>
                    <option value="Montenegro" <?php selected( 'Montenegro', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Montenegro</option>
                    <option value="Montserrat" <?php selected( 'Montserrat', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Montserrat</option>
                    <option value="Morocco" <?php selected( 'Morocco', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Morocco</option>
                    <option value="Mozambique" <?php selected( 'Mozambique', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Mozambique</option>
                    <option value="Myanmar" <?php selected( 'Myanmar', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Myanmar</option>
                    <option value="Namibia" <?php selected( 'Namibia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Namibia</option>
                    <option value="Nauru" <?php selected( 'Nauru', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Nauru</option>
                    <option value="Nepal" <?php selected( 'Nepal', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Nepal</option>
                    <option value="Netherlands" <?php selected( 'Netherlands', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Netherlands</option>
                    <option value="Netherlands Antilles" <?php selected( 'Netherlands Antilles', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Netherlands Antilles</option>
                    <option value="New Caledonia" <?php selected( 'New Caledonia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >New Caledonia</option>
                    <option value="New Zealand" <?php selected( 'New Zealand', get_the_author_meta( 'company_country', $user->ID ) ); ?> >New Zealand</option>
                    <option value="Nicaragua" <?php selected( 'Nicaragua', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Nicaragua</option>
                    <option value="Niger" <?php selected( 'Niger', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Niger</option>
                    <option value="Nigeria" <?php selected( 'Nigeria', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Nigeria</option>
                    <option value="Niue" <?php selected( 'Niue', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Niue</option>
                    <option value="Norfolk Island" <?php selected( 'Norfolk Island', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Norfolk Island</option>
                    <option value="Northern Mariana Islands" <?php selected( 'Northern Mariana Islands', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Northern Mariana Islands</option>
                    <option value="Norway" <?php selected( 'Norway', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Norway</option>
                    <option value="Oman" <?php selected( 'Oman', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Oman</option>
                    <option value="Pakistan" <?php selected( 'Pakistan', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Pakistan</option>
                    <option value="Palau" <?php selected( 'Palau', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Palau</option>
                    <option value="Palestine" <?php selected( 'Palestine', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Palestine</option>
                    <option value="Panama" <?php selected( 'Panama', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Panama</option>
                    <option value="Papua New Guinea" <?php selected( 'Papua New Guinea', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Papua New Guinea</option>
                    <option value="Paraguay" <?php selected( 'Paraguay', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Paraguay</option>
                    <option value="Peru" <?php selected( 'Peru', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Peru</option>
                    <option value="Philippines" <?php selected( 'Philippines', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Philippines</option>
                    <option value="Pitcairn Islands" <?php selected( 'Pitcairn Islands', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Pitcairn Islands</option>
                    <option value="Poland" <?php selected( 'Poland', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Poland</option>
                    <option value="Portugal" <?php selected( 'Portugal', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Portugal</option>
                    <option value="Puerto Rico" <?php selected( 'Puerto Rico', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Puerto Rico</option>
                    <option value="Qatar" <?php selected( 'Qatar', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Qatar</option>
                    <option value="Reunion" <?php selected( 'Reunion', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Reunion</option>
                    <option value="Romania" <?php selected( 'Romania', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Romania</option>
                    <option value="Russian Federation" <?php selected( 'Russian Federation', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Russian Federation</option>
                    <option value="Rwanda" <?php selected( 'Rwanda', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Rwanda</option>
                    <option value="Saint Helena" <?php selected( 'Saint Helena', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Saint Helena</option>
                    <option value="Saint Kitts and Nevis" <?php selected( 'Saint Kitts and Nevis', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Saint Kitts and Nevis</option>
                    <option value="Saint Lucia" <?php selected( 'Saint Lucia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Saint Lucia</option>
                    <option value="Saint Pierre and Miquelon" <?php selected( 'Saint Pierre and Miquelon', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Saint Pierre and Miquelon</option>
                    <option value="Saint Vincent and the Grenadines" <?php selected( 'Saint Vincent and the Grenadines', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Saint Vincent and the Grenadines</option>
                    <option value="Samoa" <?php selected( 'Samoa', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Samoa</option>
                    <option value="San Marino" <?php selected( 'San Marino', get_the_author_meta( 'company_country', $user->ID ) ); ?> >San Marino</option>
                    <option value="São Tomé and Príncipe" <?php selected( 'São Tomé and Príncipe', get_the_author_meta( 'company_country', $user->ID ) ); ?> >São Tomé and Príncipe</option>
                    <option value="Saudi Arabia" <?php selected( 'Saudi Arabia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Saudi Arabia</option>
                    <option value="Senegal" <?php selected( 'Senegal', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Senegal</option>
                    <option value="Serbia" <?php selected( 'Serbia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Serbia</option>
                    <option value="Seychelles" <?php selected( 'Seychelles', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Seychelles</option>
                    <option value="Sierra Leone" <?php selected( 'Sierra Leone', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Sierra Leone</option>
                    <option value="Singapore" <?php selected( 'Singapore', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Singapore</option>
                    <option value="Slovakia" <?php selected( 'Slovakia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Slovakia</option>
                    <option value="Slovenia" <?php selected( 'Slovenia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Slovenia</option>
                    <option value="Solomon Islands" <?php selected( 'Solomon Islands', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Solomon Islands</option>
                    <option value="Somalia" <?php selected( 'Somalia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Somalia</option>
                    <option value="South Africa" <?php selected( 'South Africa', get_the_author_meta( 'company_country', $user->ID ) ); ?> >South Africa</option>
                    <option value="South Georgia and the South Sandwich Islands" <?php selected( 'South Georgia and the South Sandwich Islands', get_the_author_meta( 'company_country', $user->ID ) ); ?> >South Georgia and the South Sandwich Islands</option>
                    <option value="Spain" <?php selected( 'Spain', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Spain</option>
                    <option value="Sri Lanka" <?php selected( 'Sri Lanka', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Sri Lanka</option>
                    <option value="Sudan" <?php selected( 'Sudan', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Sudan</option>
                    <option value="Suriname" <?php selected( 'Suriname', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Suriname</option>
                    <option value="Svalbard and Jan Mayen" <?php selected( 'Svalbard and Jan Mayen', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Svalbard and Jan Mayen</option>
                    <option value="Swaziland" <?php selected( 'Swaziland', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Swaziland</option>
                    <option value="Sweden" <?php selected( 'Sweden', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Sweden</option>
                    <option value="Switzerland" <?php selected( 'Switzerland', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Switzerland</option>
                    <option value="Syrian Arab Republic" <?php selected( 'Syrian Arab Republic', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Syrian Arab Republic</option>
                    <option value="Taiwan, Province of China" <?php selected( 'Taiwan, Province of China', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Taiwan, Province of China</option>
                    <option value="Tajikistan" <?php selected( 'Tajikistan', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Tajikistan</option>
                    <option value="Tanzania, United Republic of" <?php selected( 'Tanzania, United Republic of', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Tanzania, United Republic of</option>
                    <option value="Thailand" <?php selected( 'Thailand', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Thailand</option>
                    <option value="Timor-Leste" <?php selected( 'Timor-Leste', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Timor-Leste</option>
                    <option value="Togo" <?php selected( 'Togo', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Togo</option>
                    <option value="Tokelau" <?php selected( 'Tokelau', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Tokelau</option>
                    <option value="Tonga" <?php selected( 'Tonga', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Tonga</option>
                    <option value="Trinidad and Tobago" <?php selected( 'Trinidad and Tobago', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Trinidad and Tobago</option>
                    <option value="Tunisia" <?php selected( 'Tunisia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Tunisia</option>
                    <option value="Turkiye" <?php selected( 'Turkiye', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Turkiye</option>
                    <option value="Turkmenistan" <?php selected( 'Turkmenistan', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Turkmenistan</option>
                    <option value="Turks and Caicos Islands" <?php selected( 'Turks and Caicos Islands', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Turks and Caicos Islands</option>
                    <option value="Tuvalu" <?php selected( 'Tuvalu', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Tuvalu</option>
                    <option value="Uganda" <?php selected( 'Uganda', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Uganda</option>
                    <option value="Ukraine" <?php selected( 'Ukraine', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Ukraine</option>
                    <option value="United Arab Emirates" <?php selected( 'United Arab Emirates', get_the_author_meta( 'company_country', $user->ID ) ); ?> >United Arab Emirates</option>
                    <option value="United Kingdom" <?php selected( 'United Kingdom', get_the_author_meta( 'company_country', $user->ID ) ); ?> >United Kingdom</option>
                    <option value="United States" <?php selected( 'United States', get_the_author_meta( 'company_country', $user->ID ) ); ?> >United States</option>
                    <option value="United States Minor Outlying Islands" <?php selected( 'United States Minor Outlying Islands', get_the_author_meta( 'company_country', $user->ID ) ); ?> >United States Minor Outlying Islands</option>
                    <option value="Uruguay" <?php selected( 'Uruguay', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Uruguay</option>
                    <option value="Uzbekistan" <?php selected( 'Uzbekistan', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Uzbekistan</option>
                    <option value="Vanuatu" <?php selected( 'Vanuatu', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Vanuatu</option>
                    <option value="Venezuela" <?php selected( 'Venezuela', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Venezuela</option>
                    <option value="Viet Nam" <?php selected( 'Viet Nam', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Viet Nam</option>
                    <option value="British Virgin Islands" <?php selected( 'British Virgin Islands', get_the_author_meta( 'company_country', $user->ID ) ); ?> >British Virgin Islands</option>
                    <option value="U.S. Virgin Islands" <?php selected( 'U.S. Virgin Islands', get_the_author_meta( 'company_country', $user->ID ) ); ?> >U.S. Virgin Islands</option>
                    <option value="Wallis and Futuna" <?php selected( 'Wallis and Futuna', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Wallis and Futuna</option>
                    <option value="Western Sahara" <?php selected( 'Western Sahara', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Western Sahara</option>
                    <option value="Yemen" <?php selected( 'Yemen', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Yemen</option>
                    <option value="Zambia" <?php selected( 'Zambia', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Zambia</option>
                    <option value="Zimbabwe" <?php selected( 'Zimbabwe', get_the_author_meta( 'company_country', $user->ID ) ); ?> >Zimbabwe</option>
                </select>
                <p class="description"><?php _e("Please select headquarter is located country names."); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="company_profile"><?php _e("Company Profile"); ?></label></th>
            <td>
                <textarea name="company_profile" id="company_profile" rows="5" cols="30"><?php echo esc_attr( get_the_author_meta( 'company_profile', $user->ID ) ); ?></textarea>
                <!-- <input type="text" name="company_profile" id="company_profile" value="<!?php echo esc_attr( get_the_author_meta( 'company_profile', $user->ID ) ); ?>" class="regular-text" /><br /> -->
                <p class="description"><?php _e("Please explain the company profile in a brief and concise paragraph, including the business sector, the key visions and/or values, and the latest initiative to mitigate plastic waste and/or marine plastic debris issues."); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="website"><?php _e("Company Website"); ?></label></th>
            <td>
                <input type="text" name="website" id="website" value="<?php echo esc_attr( get_the_author_meta( 'website', $user->ID ) ); ?>" class="regular-text" /><br />
                <p class="description"><?php _e("Please provide a link to the company website."); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for=""><?php _e("Company Social Media"); ?></label></th>
        </tr>
        <tr>
            <th><label for="company_linkedin"><?php _e("LinkedIn Company URL"); ?></label></th>
            <td>
                <input type="text" name="company_linkedin" id="company_linkedin" placeholder="https://www.linkedin.com/company/example/" value="<?php echo esc_attr( get_the_author_meta( 'company_linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
                <p class="description"><?php _e("Please provide a link to official LinkedIn account of the company, if any."); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="company_facebook"><?php _e("FaceBook Company URL"); ?></label></th>
            <td>
                <input type="text" name="company_facebook" id="company_facebook" placeholder="https://www.facebook.com/example/" value="<?php echo esc_attr( get_the_author_meta( 'company_facebook', $user->ID ) ); ?>" class="regular-text" /><br />
                <p class="description"><?php _e("Please provide a link to official Facebook account of the company, if any."); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="company_instagram"><?php _e("Instagram Company URL"); ?></label></th>
            <td>
                <input type="text" name="company_instagram" id="company_instagram" placeholder="https://www.instagram.com/example/" value="<?php echo esc_attr( get_the_author_meta( 'company_instagram', $user->ID ) ); ?>" class="regular-text" /><br />
                <p class="description"><?php _e("Please provide a link to official Instagram account of the company, if any."); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="company_twitter"><?php _e("Twitter Company URL"); ?></label></th>
            <td>
                <input type="text" name="company_twitter" id="company_twitter" placeholder="https://www.twitter.com/example/" value="<?php echo esc_attr( get_the_author_meta( 'company_twitter', $user->ID ) ); ?>" class="regular-text" /><br />
                <p class="description"><?php _e("Please provide a link to official Twitter account of the company, if any."); ?></p>
            </td>
        </tr>
    </table>

    <!-- Extra profile information -->
    <h2><?php _e("Extra profile information", "blank"); ?></h2>
    <table class="form-table">
        <tr>
            <th><label for="address"><?php _e("Address"); ?></label></th>
            <td>
                <input type="text" name="address" id="address" value="<?php echo esc_attr( get_the_author_meta( 'address', $user->ID ) ); ?>" class="regular-text" /><br />
                <p class="description"><?php _e("Please enter your address."); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="city"><?php _e("City"); ?></label></th>
            <td>
                <input type="text" name="city" id="city" value="<?php echo esc_attr( get_the_author_meta( 'city', $user->ID ) ); ?>" class="regular-text" /><br />
                <p class="description"><?php _e("Please enter your city."); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="postalcode"><?php _e("Postal Code"); ?></label></th>
            <td>
                <input type="text" name="postalcode" id="postalcode" value="<?php echo esc_attr( get_the_author_meta( 'postalcode', $user->ID ) ); ?>" class="regular-text" /><br />
                <p class="description"><?php _e("Please enter your postal code."); ?></p>
            </td>
        </tr>
    </table>

    <hr style="margin-bottom: 3rem;">
<?php }
