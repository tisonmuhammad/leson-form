<?php
function wpbt_coba_productlist()
{
?>

<?php if ( is_user_logged_in() ) { ?>

<header class="sui-header" style="gap: 16px;">
    <h1 class="sui-header-title">
        <?php echo get_the_title(); ?>
    </h1>
    <span>
        <a href="<?php echo network_site_url( '/dashboard-members/add-product' ) ?>" class="sui-button sui-button-ghost">Add New</a>
    </span>
</header>
                    
<article class="sui-box">
    <div class="sui-box-body">
<table id="projectList" class="display responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th style="width:300px">Title</th>
            <th>Company</th>
            <th>Submit Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
<!--?php
    global $wpdb;
    $get_user_id= get_current_user_id();
    $result = $wpdb->get_results ( "SELECT * FROM wp_posts WHERE post_status='publish' and post_status='pending' and post_author=$get_user_id and post_type='projek'");
    // $result = $wpdb->get_results ( "SELECT * FROM wp_posts WHERE post_status='publish'" );

    // $result = $wpdb->get_results ( "SELECT * FROM wp_posts" );
    
    foreach ( $result as $print )   {

        echo '<tr>';
            echo '
                <td>
                    <div class="listNo listText">
                        ' . $print->ID.'
                    </div>
                </td>
            ';
            echo '
                <td style="width:300px">
                    <div class="listTitle listText listTextLong" style="width:300px;overflow: hidden;">
                        ' . $print->post_title.'
                    </div>
                </td>
            ';
            echo '
                <td>
                    <div class="listCompany listText">
                        ' . $print->post_title.'
                    </div>
                </td>
            ';
            echo '
                <td>
                    <div class="listSubmitDate listText">
                        ' . $print->post_date.'
                    </div>
                </td>
            ';
            echo '
                <td>
                    <div class="listStatuslistText listText">
                        ' . $print->post_status.'
                    </div>
                </td>
            ';
            echo '
                <td>
                    <div class="listAction listText">
                        <button class="sui-button sui-button-red">
                            <span class="sui-icon-trash" aria-hidden="true"></span> delete
                        </button>
                        <button class="sui-button sui-button-white">
                            <span class="sui-icon-pencil" aria-hidden="true"></span> edit
                        </button>
                    </div>
                </td>
            ';
        echo '</tr>';
    }
?-->
<?php
if ( is_user_logged_in() ) {
    $paged = (get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;
    $args = array(
        'post_type' => 'job',
        'post_status' => 'publish, pending',
        'posts_per_page' => 10,
        'paged' => $paged,
        'author' => get_current_user_id()
    );
    $arr_posts = new WP_Query( $args );
    if ( $arr_posts->have_posts() ) :
        while ( $arr_posts->have_posts() ) :
        $arr_posts->the_post();
        ?>
        <tr>
            <td></td>
            <td><?php the_title(); ?></td>
            <td><?php echo get_user_meta( wp_get_current_user()->ID, 'company_name', true );?></td>
            <td><?php echo get_the_date();?></td>
            <td><?php echo get_post_status();?></td>
            <!-- <td><a href="/dashboard-members/edit-product/?id=<?php echo get_the_ID();?>">Edit</a></td> -->
            <td><a href="<?php echo network_site_url( '/dashboard-members/edit-product/?id='.get_the_ID()) ?>">Edit</a></td>
        </tr>
        <?php
        endwhile;
        // wp_pagenavi(
        //     array(
        //         'query' => $arr_posts,
        //     )
        // );
    endif;
}
?>  
        <tr style="display:none;">
            <td>
                <div class="listNo listText"></div>
            </td>
            <td style="width:300px">
                <div class="listTitle listText listTextLong" style="width:300px;overflow: hidden;">
                    Using “bagasse material”, a more sustainable plant-based environmentally friendly material, for in-flight meal containers
                </div>
            </td>
            <td>
                <div class="listCompany listText">
                    ANA HOLDINGS INC
                </div>
            </td>
            <td>
                <div class="listSubmitDate listText">
                    2022/09/01 at 10:13 am
                </div>
            </td>
            <td>
                <div class="listStatuslistText">
                    Approved
                </div>
            </td>
            <td>
                <div class="listAction listText">
                    <button class="sui-button sui-button-red">
                        <span class="sui-icon-trash" aria-hidden="true"></span> delete
                    </button>
                    <button class="sui-button sui-button-white">
                        <span class="sui-icon-pencil" aria-hidden="true"></span> edit
                    </button>
                </div>
            </td>
        </tr>
    </tbody>
</table>
    </div>
</article>




<?php } else { ?>
Klik<a href="/login">Login </a>terlebih dahulu
<?php } ?>
        
    
<?php
}
?>
