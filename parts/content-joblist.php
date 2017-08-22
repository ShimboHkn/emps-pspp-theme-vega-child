<?php
/**
 * The template for displaying "Message" page content.
 */
if ( is_page('bookmark') ) {
	$myID = get_current_user_id(); // 自分のIDを取得
	if ( $myID && get_user_meta($myID, 'job_bookmarks', true) ) {
		$jobBms = get_user_meta($myID, 'job_bookmarks', true);
	} else {
		$jobBms = array(NULL);
	}
	$p_in = $jobBms;
	$ppp = -1;
} elseif ( is_front_page() ) {
	$p_in = array();
	$ppp = 10;
} else {
	$p_in = array();
	$ppp = 20;
}
$args = array(
	'post_type' => 'job_listing',
	'post_status' => 'publish',
	'post__in' => $p_in,
	'order' => 'DESC',
	'orderby' => 'date',
	'posts_per_page' => $ppp,
);
// ページを判別して$slugに代入
if ( is_page('bookmark') ) {
	$slug = 'bookmark';
} elseif ( is_page('whatsnew') ) {
	$slug = 'whatsnew';
}
query_posts( $args );
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		$post_id = $post->ID;
?>
<div class="joblisting-content">
<article class="job-detail clearfix<?php if (get_post_meta($post_id, '_featured', true)) echo ' featured'; ?>">
<div class="job-head">
<h3 class="job-title"><?php the_title(); ?></h3>
</div>
<div class="job-body">
<a href="<?php the_permalink(); ?>" class="job-link clearfix">
<nav class="btn job-link-btn">詳細を表示</nav>
<h5 class="school-name"><?php the_author(); ?></h5>
<div class="job-content"><?php the_content(); ?></div>
</a>
<table id="job-main-spec" class="job-spec">
<tr>
<th class="job-listing-category">教科</th><td class="job-listing-category"><?php the_terms($post_id, 'job_listing_category', '', '、', ''); ?></td>
<th class="job-listing-type">雇用形態</th><td class="job-listing-type"><?php the_terms($post_id, 'job_listing_type', '', '、', ''); ?></td>
</tr>
<tr>
<th class="job-listing-area">勤務地</th><td class="job-listing-area"><?php echo get_post_meta($post_id, '_job_location', true); ?></td>
<th class="job-listing-arrivalday">着任時期</th><td class="job-listing-arrivalday"><?php echo get_post_meta($post_id, '_job_arrivalday', true); ?></td>
</tr>
<tr>
<th class="job-listing-expires">応募締切</th><td class="job-listing-expires"><?php
	$job_expires = get_post_meta($post_id, '_job_expires', true);
		if ( !$job_expires ) {
			echo '-';
		} else {
			echo date("Y年m月d日",strtotime($job_expires));
		}
?></td>
<th class="job-listing-class">学校種別</th><td class="job-listing-class"><?php the_terms($post_id, 'job_listing_class', '', '、', ''); ?></td>
</tr>
</table>
</div><!-- end .job-body -->
</article>
</div>
<?php
	endwhile;
else :
?>

<br>
<p><?php
	if ( $slug == 'bookmark' ) {
		echo '求人ブックマークに登録されている求人はありません。';
	} elseif ( $slug == 'whatsnew' ) {
		echo '現在、表示できる新着求人はありません。';
	} else {
		echo '現在、表示できる求人はありません。';
	}
?></p>

<?php
endif;
wp_reset_query();
?>
