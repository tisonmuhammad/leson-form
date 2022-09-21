<div class="hcf_box">
    <style scoped>
        .hcf_box{
            display: grid;
            /* grid-template-columns: max-content 1fr; */
            grid-row-gap: 10px;
            grid-column-gap: 20px;
        }
        .hcf_box_3 {
            display: flex;
            grid-row-gap: 10px;
            grid-column-gap: 20px;
        }
        .hcf_field {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 100%;
        }
        .s-full {
            width: 100%;
        }
        .t-center {
            text-align: center;
        }
    </style>
    <div class="meta-options hcf_field">
        <label for="short_description">Short Description</label>
        <textarea name="short_description" id="" class="s-full" cols="30" rows="10"><?php echo get_post_meta($_GET['id'],'short_description', true);?></textarea>
    </div>
    <div class="meta-options hcf_field">
        <label for="long_description">Long Description</label>
        <textarea name="long_description" id="" class="s-full" cols="30" rows="10"><?php echo get_post_meta($_GET['id'],'long_description', true);?></textarea>
    </div>

    <div class="meta-options hcf_field">
        <label for="current_distribution_countries">Current Distribution Countries</label>
        <select name="current_distribution_countries" id="" class="s-full">
            <option value="<?php echo get_post_meta($_GET['id'],'current_distribution_countries', true);?>"><?php echo get_post_meta($_GET['id'],'current_distribution_countries', true);?></option>
            <option value="Domestically (no international trade)">Domestically (no international trade)</option>
            <option value="Asian countries">Asian countries</option>
            <option value="ASEAN countries">ASEAN countries</option>
            <option value="ASEAN +3">ASEAN +3</option>
            <option value="East Asian countries">East Asian countries</option>
            <option value="OECD countries">OECD countries</option>
            <option value="All over the world">All over the world</option>
        </select>
    </div>
    <div class="meta-options hcf_field">
        <label for="hcf_author">Scope of a Possible Distribution Countries</label>
        <input id="hcf_author" type="text" name="hcf_author" class="s-full">
    </div>

    <div class="hcf_box_3">
        <div class="meta-options hcf_field t-center">
            <label>Gambar Utama</label>
            <img class="gambar-utama" src="<?php echo get_post_meta($_GET['id'],'gambar_utama', true);?>" alt="">
            <input type='hidden' id="file" class="form-control" name="gambar_utama" value="<?php echo get_post_meta($_GET['id'],'gambar_utama', true);?>" />
            <input type='file' id="file" class="form-control" name="uploadfile" />
        </div>
        <div class="meta-options hcf_field t-center">
            <label>Poto 1</label>
            <img class="gambar-utama" src="<?php echo get_post_meta($_GET['id'],'poto_1', true);?>" alt="">
            <input type='hidden' id="file" class="form-control" name="poto_1" value="<?php echo get_post_meta($_GET['id'],'poto_1', true);?>" />
            <input type='file' id="file" class="form-control" name="poto_1" />
        </div>
        <div class="meta-options hcf_field t-center">
            <label>Poto 2</label>
            <img class="gambar-utama" src="<?php echo get_post_meta($_GET['id'],'poto_2', true);?>" alt="">
            <input type='hidden' id="file" class="form-control" name="poto_2" value="<?php echo get_post_meta($_GET['id'],'poto_2', true);?>" />
            <input type='file' id="file" class="form-control" name="poto_2" />
        </div>
    </div>
    <div class="hcf_box_3">
        <div class="meta-options hcf_field">
            <label>Poto 3</label>
            <img class="gambar-utama" src="<?php echo get_post_meta($_GET['id'],'poto_3', true);?>" alt="">
            <input type='hidden' id="file" class="form-control" name="poto_3" value="<?php echo get_post_meta($_GET['id'],'poto_3', true);?>" />
            <input type='file' id="file" class="form-control" name="poto_3" />
        </div>
        <div class="meta-options hcf_field">
            <label>Poto 4</label>
            <img class="gambar-utama" src="<?php echo get_post_meta($_GET['id'],'poto_4', true);?>" alt="">
            <input type='hidden' id="file" class="form-control" name="poto_4" value="<?php echo get_post_meta($_GET['id'],'poto_4', true);?>" />
            <input type='file' id="file" class="form-control" name="poto_4" />
        </div>
        <div class="meta-options hcf_field">
            <label>Poto 5</label>
            <img class="gambar-utama" src="<?php echo get_post_meta($_GET['id'],'poto_5', true);?>" alt="">
            <input type='hidden' id="file" class="form-control" name="poto_5" value="<?php echo get_post_meta($_GET['id'],'poto_5', true);?>" />
            <input type='file' id="file" class="form-control" name="poto_5" />
        </div>
    </div>
    <div class="meta-options hcf_field">
        <label for="hcf_author">Additional information</label>
        <input id="hcf_author" type="text" name="hcf_author" class="s-full">
    </div>
    <div class="meta-options hcf_field">
        <label>Video Link</label>
        <input type="text" name="video_link" id="" value="<?php echo get_post_meta($_GET['id'],'video_link', true);?>">
    </div>
    <div class="meta-options hcf_field" style="flex-direction: row;">
        <input type="checkbox" id="condition1" class="required" name="condition1" required="" style="margin-top:0px;">
        <label class="text-danger" for="condition1"> * On behalf of the company, I am taking responsibility and accountability for all responses written in the submission from. I guarantee that all responses contain no violation of any existing duty of confidentiality, contract, or intellectual property rights.</label>
    </div>
    <div class="meta-options hcf_field" style="flex-direction: row;">
        <input type="checkbox" id="condition2" class="required" name="condition2" required="" style="margin-top:0px;">
        <label class="text-danger" for="condition2"> * On behalf of the company, I agree that all responses written in the submission form can be published on the website upon screening and approval from RKC-MPD team</label>
    </div>
</div>