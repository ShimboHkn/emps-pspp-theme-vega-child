<?php
global $post;
global $post_author;
$post_author = $post->post_author;
$post_id = $post->ID;
?>
<div class="single-job-listing" itemscope itemtype="http://schema.org/JobPosting">
<meta itemprop="title" content="<?php echo esc_attr( $post->post_title ); ?>" />

<?php
if ( get_option( 'job_manager_hide_expired_content', 1 ) && 'expired' === $post->post_status ) :
?>
<div class="job-manager-info"><?php _e( 'This listing has expired.', 'wp-job-manager' ); ?></div>
<?php
else :

/**
* single_job_listing_start hook
*
* @hooked job_listing_meta_display - 20
* @hooked job_listing_company_display - 30
*/
	do_action( 'single_job_listing_start' );
?>

<article class="job-detail clearfix">
<div class="job-head">
<h3 class="school-name"><?php the_author(); ?></h3>
<!--<h5 class="job-title"><?php the_title(); ?></h5>-->
</div>
<div class="job-body">
<div class="job-content">
<?php
	$job_image = get_post_meta($post_id, '_job_image', true);
	if( $job_image ) :
?>
<div class="job_image">
<p class="image"><img src="<?php echo $job_image; ?>" alt="" width="50%" height="auto"></p>
</div>
<?php
	endif;
?>
<?php the_content(); ?>
</div>

<div class="job_description" itemprop="description">
<?php //echo apply_filters( 'the_job_description', get_the_content() ); ?>
<table id="job-main-spec" class="job-spec">
<?php
	$custom_fields = get_post_custom();
?>
<tr>
<th class="job-listing-category">教科</th><td class="job-listing-category"><?php the_terms( $post_id, 'job_listing_category', '', '、', ''); ?></td>
<?php
	$slugs = wp_get_post_terms( $post_id, 'job_listing_type', array( 'orderby' => 'name', 'order' => 'ASC', 'fields' => 'slugs' ) );
	$slug = '';
	foreach($slugs as $slgname) :
		$slug .= ' ' . $slgname;
	endforeach;
?>
<th class="job-listing-type">雇用形態</th><td class="job-listing-type"><!--<span class="job-type<?php echo $slug; ?>">--><?php the_terms($post_id, 'job_listing_type', '', '、', ''); ?><!--</span>--></td>
</tr>
<tr>
<th class="job-listing-area">勤務地</th><td class="job-listing-area"><?php echo get_post_meta($post_id, '_job_location', true); ?></td>
<th class="job-listing-arrivalday">着任時期</th><td class="job-listing-arrivalday"><?php echo get_post_meta($post_id, '_job_arrivalday', true); ?></td>
</tr>
<tr>
<th class="job-listing-expires">応募締切</th><td class="job-listing-expires"><?php
		$job_expires = get_post_meta($post_id, '_job_expires', true);
		if ( !$job_expires || preg_match('/^20[0-9]{2}-01-01/', $job_expires) ) {
			echo '-';
		} else {
			echo date("Y年m月d日",strtotime($job_expires));
		}
?></td>
<th class="job-listing-class">学校種別</th><td class="job-listing-class"><?php the_terms($post_id, 'job_listing_class', '', '、', ''); ?></td>
</tr>
</table>
</div><!-- /.job_description -->

<div id="tab-menu" class="tabs">

<ul class="tab-title-list">
<li class="tab-title tab-title-jobinfo active"><a href="javascript:;">求人情報</a></li>
<li class="tab-title tab-title-schoolinfo"><a href="javascript:;">学校情報</a></li>
</ul>

<div id="tab-box" class="tab-content">
<div class="job-detail active">
<table class="job-spec job-spec-sub">
<?php
	$job_listingdata = array(
		'job_noses'=>'募集人数',
		'job_skill'=>'生かせる経験・スキル',
		'job_requirements'=>'応募資格',
		'job_papers'=>'応募書類',
		'job_method'=>'応募方法',
		'job_recruit_info'=>'選考方法',
		'job_apptargets'=>'応募先',
		'job_detail'=>'仕事内容',
		'job_place'=>'勤務場所',
		'job_time'=>'勤務時間',
		'job_holiday'=>'休日・休暇',
		'job_salary'=>'給与',
		'job_conditions'=>'待遇・福利厚生',
		'job_insurance'=>'社会保険',
		'job_charge'=>'採用担当者',
//		'application'=>'応募先メールアドレス',
	);
	foreach($job_listingdata as $key => $value) :
		$key_name = '_'.$key;
		$key_value = nl2br(get_post_meta($post_id, $key_name, true));

		if( $key_value || current_user_can('employer') || current_user_can('administrator') ) :
?>
<tr><th><?php echo $value; ?></th><td><?php echo $key_value; ?></td></tr>
<?php
		endif;
endforeach;
?>
</table>
</div>

<div class="school-detail">
<table class="school-spec">
<?php
	$conpany_listingdata = array(
		'company_educational'=>'学校法人名',
		'company_name'=>'学校名',
		'company_type'=>'校種',
		'company_birth'=>'創立年月日',
		'company_tagline'=>'学校説明',
		'company_policy'=>'教育方針',
		'company_director'=>'理事長名',
		'company_chief'=>'校長名',
		'company_location'=>'所在地',
		'company_phone'=>'電話番号',
		'company_fax'=>'FAX番号',
		'company_contact'=>'代表メールアドレス',
		'company_website'=>'学校HP',
		'company_capital'=>'生徒数',
		'company_employee'=>'教職員数',
		'company_subject'=>'学科',
		'company_course'=>'コース',
		'company_highgrade'=>'主な進学実績',
		'company_club'=>'主な部活動実績',
		'company_relation'=>'関連校',
	);
	foreach($conpany_listingdata as $key => $value) :
		$key_name = '_'.$key;
		$key_value = nl2br(get_post_meta($post_id, $key_name, true));

		if( $key_value || current_user_can('employer') || current_user_can('administrator') ) :
?>
<tr><th><?php echo $value; ?></th><td><?php echo $key_value; ?></td></tr>
<?php
		endif;
	endforeach;
?>
</table>
</div>
</div><!-- /#tab-box.tab-content -->

</div><!-- /#tab-menu.tabs -->

<div id="job-bookmark">
<?php
	// 求人ブックマーク登録／削除
	$myID = get_current_user_id(); // 自分のIDを取得
	$jobBms = array();
	if( get_user_meta($myID, 'job_bookmarks') ) {
		$jobBms = get_user_meta($myID, 'job_bookmarks', true);
	}
	//echo $post_id;
	// 求人IDを自分のユーザメタに追加
	if( $_GET['job_bookmark'] ) {
		$jobBm = $_GET['job_bookmark']; // 追加する求人IDを取得
		if( !in_array($jobBm, $jobBms) ) {
			$jobBms[] = $jobBm;
			update_user_meta($myID, 'job_bookmarks', $jobBms);
		}
	}
	// 求人IDを自分のユーザメタから削除
	if( $_GET['job_unbookmark'] ) {
		$jobUBm = $_GET['job_unbookmark']; // 削除する求人IDを取得
		if( in_array($jobUBm, $jobBms) ) {
			$results = array_diff($jobBms, array($jobUBm)); //削除実行
			$results = array_values($results); //indexを詰める
			update_user_meta($myID, 'job_bookmarks', $results);
		}
	}
	$addtxt = '★ 求人ブックマークに追加';
	$deltxt = '☆ 求人ブックマークから削除';
	if(is_user_logged_in()) :
		if( !in_array($post_id, $jobBms) || $_GET['job_unbookmark'] ) :
//		if( in_array($post_id, $jobBms) || in_array($post_id, $results) ) :
?>
<form id="job-bookmark" method="get">
<input type="hidden" name="job_bookmark" value="<?php echo $post_id; ?>">
<input type="submit" class="application_button button" value="<?php echo $addtxt; ?>" />
</form>
<?php
		else :
?>
<form id="job-unbookmark" method="get">
<input type="hidden" name="job_unbookmark" value="<?php echo $post_id; ?>">
<input type="submit" class="application_button button" value="<?php echo $deltxt; ?>" />
</form>
<?php
		endif;
	else :
?>
<div class="required_login"><form>
<p><input type="button" class="application_button button desabled" value="<?php echo $addtxt; ?>" style="margin-bottom: 0;" /><br />
<span class="button-note">＊求人ブックマークを使用するには、<a href="http://ist-global.sakura.ne.jp/emps_jobs/login/">ログイン</a>または<a href="http://ist-global.sakura.ne.jp/emps_jobs/register/">会員登録</a>が必要です。</span></p>
</form></div>
<?php
	endif;
?>
</div><!-- /#job-bookmark -->
</div><!-- /.job-body -->
<?php //comments_template(); ?>
</article>

<?php
	if(is_user_logged_in()) {
		if ( candidates_can_apply() && current_user_can('subscriber') ) {
			$rows = $wpdb->get_results( "SELECT submit_time FROM {$wpdb->prefix}cf7dbplugin_submits WHERE field_order = 21 AND field_value = $post_id" );
			if( isset($rows) ) {
				$rec_appid = array();
				foreach( $rows as $row ) {
					$rec_stime = $row->submit_time;
					$approw = $wpdb->get_row( "SELECT field_value FROM {$wpdb->prefix}cf7dbplugin_submits WHERE field_order = 1 AND submit_time = $rec_stime" );
					$rec_appid[] = $approw->field_value;
				}
				if( in_array($myID, $rec_appid) ) {
?>
<div class="required_login"><form>
<p><input type="button" class="application_button button desabled" value="この求人に応募する" style="margin-bottom: 0;" /><br />
<span class="button-note">＊この求人にはすでに応募しています。応募内容は<a href="<?php bloginfo('url') ?>/profile/record/"><strong>応募履歴</strong>ページ</a>でご確認ください。</span></p>
<br />
<?php //echo do_shortcode('[theme-my-login]') . "\n"; ?>
</form></div>
<?php
				} else {
					get_job_manager_template( 'job-application.php' );
				}
			}
		}
	} else {
?>
<div class="required_login"><form>
<p><input type="button" class="application_button button desabled" value="この求人に応募する" style="margin-bottom: 0;" /><br />
<span class="button-note">＊求人に応募するには、<a href="http://ist-global.sakura.ne.jp/emps_jobs/login/">ログイン</a>または<a href="http://ist-global.sakura.ne.jp/emps_jobs/register/">会員登録</a>が必要です。</span></p>
<br />
<?php //echo do_shortcode('[theme-my-login]') . "\n"; ?>
</form></div>
<?php
	}

/**
* single_job_listing_end hook
*/
	do_action( 'single_job_listing_end' );
endif;
?>
</div>
