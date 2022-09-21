<?php
function wpbt_coba_productadd()
{

?>

<?php
    //We have a function that checks it for us already, but just incase we will check again.
    if( !is_user_logged_in() )
    {
        exit;
    }

    $current_user = wp_get_current_user();
?>

<header class="sui-header">
    <h1 class="sui-header-title">
        <?php the_title(); ?>
    </h1>
</header>



<?php 
    $postTitle = $_POST['post_title'];
    $postlong = $_POST['long_description'];

    // $postshort = $_POST['short_description'];
    // $txtDistributionCountries = $_POST['txtDistributionCountries'];
    // $ddlDistributionRegion = $_POST['ddlDistributionRegion'];
    // $txtVideoLink = $_POST['txtVideoLink'];
    // $condition1 = $_POST['condition1'];
    // $condition2 = $_POST['condition2'];
    
    $submit = $_POST['submit'];

    if(isset($submit)){

        global $user_ID;

        $new_post = array(
            'post_title' => $postTitle,
            'post_content' => $postlong,
            'post_status' => 'pending',
            'post_date' => date('Y-m-d H:i:s'),
            'post_author' => $user_ID,
            'post_type' => 'job',
            'post_category' => array(0)
        );

        wp_insert_post($new_post);

        add_post_meta($post_id, "short_description",$_POST['short_description'], true);
        add_post_meta($post_id, "txtDistributionCountries", $_POST['txtDistributionCountries'], true);
        add_post_meta($post_id, "txtVideoLink", $_POST['txtVideoLink'], true);
        add_post_meta($post_id, "condition1", $_POST['condition1'], true);
        add_post_meta($post_id, "condition2", $_POST['condition2'], true);

        if(empty($_FILES['uploadfile']['name'])){
            add_post_meta($post_id, "gambar_utama", $_POST['gambar_utama'], true);
        }else{
            if(isset($_FILES['uploadfile']['name'])){
                if ( ! function_exists( 'wp_handle_upload' ) ) {
                    require_once( ABSPATH . 'wp-admin/includes/file.php' );
                }
                $uploadedfile = $_FILES['uploadfile'];
                $upload_overrides = array( 'test_form' => false );
                $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
                add_post_meta($post_id, "gambar_utama", $movefile['url'], true);
            }
        }
        if(empty($_FILES['poto_1']['name'])){
            add_post_meta($post_id, "poto_1", $_POST['poto_1'], true);
        }else{
            if(isset($_FILES['poto_1']['name'])){
                if ( ! function_exists( 'wp_handle_upload' ) ) {
                    require_once( ABSPATH . 'wp-admin/includes/file.php' );
                }
                $uploadedfile = $_FILES['poto_1'];
                $upload_overrides = array( 'test_form' => false );
                $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
                add_post_meta($post_id, "poto_1", $movefile['url'], true);
            }
        }
        // if(empty($_FILES['poto_2']['name'])){
        //     add_post_meta($post_id, "poto_2", $_POST['poto_2'], true);
        // }else{
        //     if(isset($_FILES['poto_2']['name'])){
        //         if ( ! function_exists( 'wp_handle_upload' ) ) {
        //             require_once( ABSPATH . 'wp-admin/includes/file.php' );
        //         }
        //         $uploadedfile = $_FILES['poto_2'];
        //         $upload_overrides = array( 'test_form' => false );
        //         $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
        //         add_post_meta($post_id, "poto_2", $movefile['url'], true);
        //     }
        // }

    }

?>

<form id="primaryPostForm" class="post-edit front-end-form" method="post" enctype="multipart/form-data">

    <div class="sui-row">

        <div class="sui-col-md-9">
            <div class="sui-box">
                <div class="sui-box-header">
                    <h2 class="sui-box-title">Product, Service, or Technology</h2>
                </div>

                <div class="sui-box-body">
                    
                    <div class="sui-box-settings-row">
                        <div class="sui-box-settings-col-2">
                            <div class="sui-form-field">
                                <label class="sui-label" for="post_title"><?php _e('Post Title:', 'framework') ?></label>

                                <input type="text" name="post_title" id="post_title" class="sui-form-control" required />

                                <span id="description-post_title" class="sui-description">Please provide a specific name of product, service, and/or technology offered by the company, which are relevant to mitigate marine plastic debris issues</span>
                            </div>
                        </div>
                    </div>

                    <div class="sui-box-settings-row">
                        <div class="sui-box-settings-col-2">
                            <div class="sui-form-field">
                                
                                <label class="sui-label" for="long_description"><?php _e('Long Description:', 'framework') ?></label>
                                    
                                <textarea name="long_description" id="long_description" rows="5" cols="30" class="sui-form-control" required ></textarea>

                                <span id="description-long_description" class="sui-description">Please provide here up to 500 words detailed description of the product, service, or technology</span>
                                
                                <style>
                                    .card-alert-blue {
                                        display: flex;
                                        align-items: flex-start;
                                        flex-direction: column;
                                        font-size: 13px;
                                        line-height: 1.5;
                                        border: 1px solid rgba(0, 0, 0, 0.2);
                                        padding: 16px;
                                        color: rgb(0, 70, 143);
                                        background: rgb(204, 229, 255);
                                        margin-bottom: 20px;
                                        border-radius: 6px;
                                    }
                                </style>
                                <div class="card-alert-blue">
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
                            </div>
                        </div>
                    </div>

                    <div class="sui-box-settings-row">
                        <div class="sui-box-settings-col-2">
                            <div class="sui-form-field">
                                
                                <label class="sui-label" for="short_description"><?php _e('Short Description:', 'framework') ?></label>
                                    
                                <textarea name="short_description" id="short_description" rows="3" cols="30" class="sui-form-control" required ></textarea>

                                <span id="description-short_description" class="sui-description">Please provide 2–3 short sentences that best describe the product, service, or technology. Please explain in a way that are easy to understand for all viewers.</span>
                            </div>
                        </div>
                    </div>

                    <div class="sui-box-settings-row">
                        <div class="sui-box-settings-col-2">
                            <div class="sui-form-field">
                                
                                <label class="sui-label" for="txtDistributionCountries"><?php _e('Current Distribution Countries:', 'framework') ?></label>
                                    
                                <textarea name="txtDistributionCountries" id="txtDistributionCountries" rows="3" cols="30" class="sui-form-control" required ></textarea>

                                <span id="description-txtDistributionCountries" class="sui-description">Please list the specific countries where the product, service, and/or technology are mainly supplied to</span>
                            </div>
                        </div>
                    </div>

                    <div class="sui-box-settings-row">
                        <div class="sui-box-settings-col-2">
                            <div class="sui-form-field">
                                
                                <label for="ddlDistributionRegion" class="sui-label">Scope of a Possible Distribution Region</label>
                                <select name="ddlDistributionRegion" id="ddlDistributionRegion" class="sui-select" data-search="true" required >
                                    <option value="" disabled selected>Please choose…</option>
                                    <option value="Domestically (no international trade)" <?php if($ddlDistributionRegion == 'Domestically (no international trade)') echo 'selected'; ?>>Domestically (no international trade)</option>
                                    <option value="Asian countries" <?php if($ddlDistributionRegion == 'Asian countries') echo 'selected'; ?>>Asian countries</option>
                                    <option value="ASEAN countries" <?php if($ddlDistributionRegion == 'ASEAN countries') echo 'selected'; ?>>ASEAN countries</option>
                                    <option value="ASEAN+3 countries" <?php if($ddlDistributionRegion == 'ASEAN+3 countries') echo 'selected'; ?>>ASEAN+3 countries</option>
                                    <option value="East Asian countries" <?php if($ddlDistributionRegion == 'East Asian countries') echo 'selected'; ?>>East Asian countries</option>
                                    <option value="OECD countries" <?php if($ddlDistributionRegion == 'OECD countries') echo 'selected'; ?>>OECD countries</option>
                                    <option value="All over the world" <?php if($ddlDistributionRegion == 'All over the world') echo 'selected'; ?>>All over the world</option>
                                </select>

                                <span id="description-ddlDistributionRegion" class="sui-description">Please provide the region where the product, service, or technology could be supplied to (in the future)</span>
                            </div>
                        </div>
                    </div>

                    <div class="sui-box-settings-row">
                        <div class="sui-box-settings-col-2">
                            <div class="sui-form-field">
                                
                                <label class="sui-label" for="txtVideoLink"><?php _e('Video Link:', 'framework') ?></label>
                                    
                                <input type="text" name="txtVideoLink" id="txtVideoLink" class="sui-form-control" />

                                <span id="description-txtVideoLink" class="sui-description">Please provide link of any relevant video about the product, service, or technology, if any</span>
                            </div>
                        </div>
                    </div>

                    <div class="sui-box-settings-row">
                        <div class="sui-box-settings-col-2">
                            <div class="sui-form-field">
                                
                                <label for="condition1" class="sui-checkbox">
                                    <input
                                        type="checkbox"
                                        id="condition1"
                                        aria-labelledby="label-condition1"
                                        name="condition1"
                                        required
                                    />
                                    <span aria-hidden="true"></span>
                                    <span id="label-condition1">
                                        <?php _e(' * On behalf of the company, I am taking responsibility and accountability for all responses written in the submission from. I guarantee that all responses contain no violation of any existing duty of confidentiality, contract, or intellectual property rights.', 'framework') ?>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="sui-box-settings-row">
                        <div class="sui-box-settings-col-2">
                            <div class="sui-form-field">
                                
                                <label for="condition2" class="sui-checkbox">
                                    <input
                                        type="checkbox"
                                        id="condition2"
                                        aria-labelledby="label-condition2"
                                        name="condition2"
                                        required
                                    />
                                    <span aria-hidden="true"></span>
                                    <span id="label-condition2">
                                        <?php _e(' * On behalf of the company, I agree that all responses written in the submission form can be published on the website upon screening and approval from RKC-MPD team:', 'framework') ?>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="sui-col-md-3">
            <div class="sui-box sui-box-sticky" style="top: 85px;">
                <div class="sui-box-body">
                    <!-- <input name="submit" type="submit" class="sui-button sui-button-lg" value="<?php _e('Add Post', '') ?>" style="width: 100%;" /> -->
                    <button name="submit" type="submit" class="sui-button sui-button-green sui-button-lg" value="" style="width: 100%;">
                        <span class="sui-icon-check" aria-hidden="true"></span>
                        <?php _e('Add Post', '') ?>
                    </button>
                </div>
            </div>

            <div class="sui-box ">
                
                <!-- Cover Photo -->
                <div class="sui-box-body">
                    <div class="sui-form-field">

                        <label class="sui-label" for="gambar_utama">Cover Photo</label>

                        <div class="sui-upload sui-file-upload sui-file-browser">

                            <input type='hidden' id="gambar_utama" class="form-control" name="gambar_utama" value="<?php echo get_post_meta($_GET['id'],'gambar_utama', true);?>" />

                            <input
                                id="gambar_utama"
                                type="file"
                                value=""
                                readonly="readonly"
                                name="uploadfile"
                            />

                            <div class="sui-upload-image" aria-hidden="true">
                                <div class="sui-image-mask"></div>
                                <div role="button"
                                    class="sui-image-preview"
                                    style="background-image: url('path-to-image/filename.png');">
                                </div>
                            </div>

                            <button class="sui-upload-button">
                                <span class="sui-icon-upload-cloud" aria-hidden="true"></span> Upload file
                            </button>

                            <div class="sui-upload-file">

                                <span>filename.png</span>

                                <button aria-label="Remove file">
                                    <span class="sui-icon-close" aria-hidden="true"></span>
                                </button>

                            </div>

                        </div>

                        <span class="sui-description">Please upload a high-resolution photo (.png or .jpeg) for the cover photo of the product, service, or technology, maximum 3 MB. Best dimensions are 522 pixels (width) x 400 pixels (height).</span>

                    </div>
                </div>

                <!-- Photo 2 -->
                <div class="sui-box-body">
                    <div class="sui-form-field">

                        <label class="sui-label" for="poto_1">Photo 2</label>

                        <div class="sui-upload sui-file-upload sui-file-browser">

                            <input type='hidden' id="poto_1" class="form-control" name="poto_1" value="<?php echo get_post_meta($_GET['id'],'poto_1', true);?>" />

                            <input
                                id="poto_1"
                                type="file"
                                value=""
                                readonly="readonly"
                                name="poto_1"
                            />

                            <div class="sui-upload-image" aria-hidden="true">
                                <div class="sui-image-mask"></div>
                                <div role="button"
                                    class="sui-image-preview"
                                    style="background-image: url('path-to-image/filename.png');">
                                </div>
                            </div>

                            <button class="sui-upload-button">
                                <span class="sui-icon-upload-cloud" aria-hidden="true"></span> Upload file
                            </button>

                            <div class="sui-upload-file">

                                <span>filename.png</span>

                                <button aria-label="Remove file">
                                    <span class="sui-icon-close" aria-hidden="true"></span>
                                </button>

                            </div>

                        </div>

                        <span class="sui-description">Please upload another high-resolution photo (.png or .jpeg) of the product, service, or technology, if any, maximum 3MB. Best dimensions are 522 pixels (width) x 400 pixels (height).</span>

                    </div>
                </div>
                
                <!-- Photo 3 -->
                <div class="sui-box-body">
                    <div class="sui-form-field">

                        <label class="sui-label" for="poto_2">Photo 3</label>

                        <div class="sui-upload sui-file-upload sui-file-browser">

                            <input
                                id="poto_2"
                                type="file"
                                value=""
                                readonly="readonly"
                                name="poto_2"
                            />

                            <div class="sui-upload-image" aria-hidden="true">
                                <div class="sui-image-mask"></div>
                                <div role="button"
                                    class="sui-image-preview"
                                    style="background-image: url('path-to-image/filename.png');">
                                </div>
                            </div>

                            <button class="sui-upload-button">
                                <span class="sui-icon-upload-cloud" aria-hidden="true"></span> Upload file
                            </button>

                            <div class="sui-upload-file">

                                <span>filename.png</span>

                                <button aria-label="Remove file">
                                    <span class="sui-icon-close" aria-hidden="true"></span>
                                </button>

                            </div>

                        </div>

                        <span class="sui-description">Please upload another high-resolution photo (.png or .jpeg) of the product, service, or technology, if any, maximum 3MB. Best dimensions are 522 pixels (width) x 400 pixels (height).</span>
                        
                    </div>
                </div>

                <!-- Photo 4 -->
                <div class="sui-box-body">
                    <div class="sui-form-field">

                        <label class="sui-label" for="poto_3">Photo 4</label>

                        <div class="sui-upload sui-file-upload sui-file-browser">

                            <input
                                id="poto_3"
                                type="file"
                                value=""
                                readonly="readonly"
                                name="poto_3"
                            />

                            <div class="sui-upload-image" aria-hidden="true">
                                <div class="sui-image-mask"></div>
                                <div role="button"
                                    class="sui-image-preview"
                                    style="background-image: url('path-to-image/filename.png');">
                                </div>
                            </div>

                            <button class="sui-upload-button">
                                <span class="sui-icon-upload-cloud" aria-hidden="true"></span> Upload file
                            </button>

                            <div class="sui-upload-file">

                                <span>filename.png</span>

                                <button aria-label="Remove file">
                                    <span class="sui-icon-close" aria-hidden="true"></span>
                                </button>

                            </div>

                        </div>

                        <span class="sui-description">Please upload another high-resolution photo (.png or .jpeg) of the product, service, or technology, if any, maximum 3MB. Best dimensions are 522 pixels (width) x 400 pixels (height).</span>

                    </div>
                </div>

                <!-- Photo 5 -->
                <div class="sui-box-body">
                    <div class="sui-form-field">

                        <label class="sui-label" for="poto_4">Photo 5</label>

                        <div class="sui-upload sui-file-upload sui-file-browser">

                            <input
                                id="poto_4"
                                type="file"
                                value=""
                                readonly="readonly"
                                name="poto_4"
                            />

                            <div class="sui-upload-image" aria-hidden="true">
                                <div class="sui-image-mask"></div>
                                <div role="button"
                                    class="sui-image-preview"
                                    style="background-image: url('path-to-image/filename.png');">
                                </div>
                            </div>

                            <button class="sui-upload-button">
                                <span class="sui-icon-upload-cloud" aria-hidden="true"></span> Upload file
                            </button>

                            <div class="sui-upload-file">

                                <span>filename.png</span>

                                <button aria-label="Remove file">
                                    <span class="sui-icon-close" aria-hidden="true"></span>
                                </button>

                            </div>

                        </div>

                        <span class="sui-description">Please upload another high-resolution photo (.png or .jpeg) of the product, service, or technology, if any, maximum 3MB. Best dimensions are 522 pixels (width) x 400 pixels (height).</span>

                    </div>
                </div>

                <!-- Photo 6 -->
                <div class="sui-box-body">
                    <div class="sui-form-field">

                        <label class="sui-label" for="poto_5">Photo 6</label>

                        <div class="sui-upload sui-file-upload sui-file-browser">

                            <input
                                id="poto_5"
                                type="file"
                                value=""
                                readonly="readonly"
                                name="poto_5"
                            />

                            <div class="sui-upload-image" aria-hidden="true">
                                <div class="sui-image-mask"></div>
                                <div role="button"
                                    class="sui-image-preview"
                                    style="background-image: url('path-to-image/filename.png');">
                                </div>
                            </div>

                            <button class="sui-upload-button">
                                <span class="sui-icon-upload-cloud" aria-hidden="true"></span> Upload file
                            </button>

                            <div class="sui-upload-file">

                                <span>filename.png</span>

                                <button aria-label="Remove file">
                                    <span class="sui-icon-close" aria-hidden="true"></span>
                                </button>

                            </div>

                        </div>
                        
                        <span class="sui-description">Please upload another high-resolution photo (.png or .jpeg) of the product, service, or technology, if any, maximum 3MB. Best dimensions are 522 pixels (width) x 400 pixels (height).</span>

                    </div>
                </div>

                <!-- Additional information -->
                <div class="sui-box-body">
                    <div class="sui-form-field">

                        <label class="sui-label" for="file_select_additional">Additional information</label>

                        <div class="sui-upload sui-file-upload sui-file-browser">

                            <input type="file" id="file_select_additional" value="" name="file_select_additional" readonly="readonly" />

                            <button class="sui-upload-button">
                                <span class="sui-icon-upload-cloud" aria-hidden="true"></span>
                                Upload file
                            </button>

                            <div class="sui-upload-file">

                                <span></span>

                                <button aria-label="Remove file">
                                    <span class="sui-icon-close" aria-hidden="true"></span>
                                </button>

                            </div>

                        </div>

                        <span class="sui-description">Please upload any relevant information (.pdf) about the product, service, or technology, if any. Maximum file size is 5 MB.</span>

                    </div>
                </div>

            </div>

        </div>

    </div>

</form>


<?php

}
