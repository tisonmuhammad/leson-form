<?php

// view depan user
function wpbt_coba_dashboard()
{

?>

<?php if ( is_user_logged_in() ) { ?>
                            
                            
<header class="sui-header">
    <h1 class="sui-header-title">
        <span style="font-weight: normal;">👋</span>
        <span class="day-message"></span>,
        <span style="color:#4687c6;">
            <?php echo wp_get_current_user()->display_name; ?>
        </span>
        <br>
        <small>Welcome back</small>
    </h1>
</header>

<div class="sui-box sui-summary">

	<div class="sui-summary-image-space" aria-hidden="true"></div>

	<div class="sui-summary-segment">

		<div class="sui-summary-details">

			<span class="sui-summary-large">97</span>
			<span class="sui-summary-sub">Total post</span>

			<span class="sui-summary-detail">December 12, 2022 at 1:46 am</span>
			<span class="sui-summary-sub">Last Submission</span>

		</div>

	</div>

	<div class="sui-summary-segment">

		<ul class="sui-list">

			<li>
				<span class="sui-list-label">Post Success</span>
				<span class="sui-list-detail">76</span>
			</li>

			<li>
				<span class="sui-list-label">Post Pedding</span>
				<span class="sui-list-detail">
                    <span class="sui-tag sui-tag-error">1</span>
                </span>
			</li>

		</ul>

	</div>

</div>

<div class="sui-row">

    <div class="sui-col-md-3">
        <div class="sui-box">
            <div class="sui-box-header">
                <h2 class="sui-box-title">Post Product Success</h2>
            </div>
            <div class="sui-box-body">
                <div class="sui-form-field">
                    <span class="sui-settings-label" style="margin-bottom: 10px;"></span>
                    <div class="sui-circle-score sui-circle-score-lg sui-grade-a" data-score="95"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="sui-col-md-3">
        <div class="sui-box">
            <div class="sui-box-header">
                <h2 class="sui-box-title">Post Product Pending</h2>
            </div>
            <div class="sui-box-body">
                <div class="sui-form-field">
                    <span class="sui-settings-label" style="margin-bottom: 10px;"></span>
                    <div class="sui-circle-score sui-circle-score-lg sui-grade-c" data-score="55"></div>
                </div>
            </div>
        </div>
    </div>

</div>

<article class="sui-box">
    <div class="sui-box-body">
        <div class="">

            Halaman dashboard<br><a href="<?php echo wp_logout_url(); ?>">Logout</a>

            <?php 
                global $wpdb;
                $rows = $wpdb->get_results( "SELECT * FROM {$wpdb->posts} WHERE post_type='post'" );
                
            ?>
            <?php } else { ?>
                Klik<a href="/login">Login </a>terlebih dahulu
            <?php } ?>
        </div>
    </div>
</article>

<?php } ?>