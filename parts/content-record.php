<?php
/**
* The template part for displaying the post entry in the recent posts on the front page (static)
*/
?>
<?php
$myID = get_current_user_id(); // 自分のIDを取得
global $wpdb;

// 進捗状況・メモをDBに保存
if($_POST['submit_time']) {
	if( $_POST['job_progress'] ) {
		$wpdb->update(
			$wpdb->prefix.'cf7dbplugin_submits',
			array( 'field_value' => $_POST['job_progress'] ),
			array( 'submit_time' => $_POST['submit_time'], 'field_name' => 'job-progress' ),
			array( '%s' )
		);
	}
	if( $_POST['job_retention'] ) {
		$wpdb->update(
			$wpdb->prefix.'cf7dbplugin_submits',
			array( 'field_value' => $_POST['job_retention'] ),
			array( 'submit_time' => $_POST['submit_time'], 'field_name' => 'job-retention' ),
			array( '%s' )
		);
	} else {
		$wpdb->update(
			$wpdb->prefix.'cf7dbplugin_submits',
			array( 'field_value' => 0 ),
			array( 'submit_time' => $_POST['submit_time'], 'field_name' => 'job-retention' ),
			array( '%s' )
		);
	}
	if( current_user_can('subscriber') ) {
		$wpdb->update(
			$wpdb->prefix.'cf7dbplugin_submits',
			array( 'field_value' => $_POST['job_note'] ),
			array( 'submit_time' => $_POST['submit_time'], 'field_name' => 'job-note-mem' ),
			array( '%s' )
		);
	}
	if( current_user_can('employer') ) {
		$wpdb->update(
			$wpdb->prefix.'cf7dbplugin_submits',
			array( 'field_value' => $_POST['job_note'] ),
			array( 'submit_time' => $_POST['submit_time'], 'field_name' => 'job-note-sch' ),
			array( '%s' )
		);
	}
}

// 非表示案件をDBに保存
$my_hide_nums = array();
$my_info = get_userdata($myID);
if( $my_info->hide_apply ) {
	$my_hide_nums = $my_info->hide_apply; // 自分のユーザーメタを取得
}
$hide_apply_num = 0;
if( isset($_POST['hide_apply']) ) {
	$hide_apply_num = $_POST['hide_apply'];
	// 自分のユーザーメタに$hide_apply_numを追加
	if( isset($_POST['checked']) && !in_array($hide_apply_num, $my_hide_nums) ) {
		$my_hide_nums[] = $hide_apply_num;
	}
	// 自分のユーザーメタから$hide_apply_numを削除
	if( !isset($_POST['checked']) && in_array($hide_apply_num, $my_hide_nums) ) {
		$new_hide_nums = array_diff($my_hide_nums, array($hide_apply_num)); //削除実行
		$my_hide_nums = array_values($new_hide_nums); //indexを詰める
	}
	update_user_meta($myID, 'hide_apply', $my_hide_nums);
}

// 絞り込み変数の設定
$selected_id = 0;
if( isset($_GET['select_apply']) ) $selected_id = $_GET['select_apply'];
//$selected_prog = '0';
//if( isset($_GET['select_progress']) ) $selected_prog = $_GET['select_progress'];

// 非表示案件をすべて表示の変数を設定
$show_all = 'off';
if( $_GET['show_all'] ) $show_all = $_GET['show_all'];
?>

<div id="job-apply-records" <?php post_class('job_records entry clearfix ' . $post_class); ?>>

<?php
// 求人タイトルで募集を絞り込む
if( current_user_can('employer') ) :
?>
<div class="select-apply"><form method="get" id="select-apply-form">
<p>応募履歴フィルター<!--（非表示を除く）-->：
<select name="select_apply" class="select_apply" onchange="jQuery(function(){jQuery('#select-apply-form').submit();});">
<option value="0"<?php if( $selected_id == 0 ) echo ' selected="selected"'; ?>>フィルターなし</option>
<?php
	$rows = $wpdb->get_results( "SELECT submit_time, field_value FROM {$wpdb->prefix}cf7dbplugin_submits WHERE field_order = 13" );
	$rows = array_reverse($rows);
	$jtitle = '';
	foreach ($rows as $row) {
		$submit_time = $row->submit_time;
		$employer_id = $row->field_value;
		if( $employer_id == $myID) {
			$jtrow = $wpdb->get_row( "SELECT field_value FROM {$wpdb->prefix}cf7dbplugin_submits WHERE field_name = 'recruit-title' AND submit_time = $submit_time" );
			$pidrow = $wpdb->get_row( "SELECT field_value FROM {$wpdb->prefix}cf7dbplugin_submits WHERE field_name = 'post-id' AND submit_time = $submit_time" );
			$jt = $jtrow->field_value;
			$pid = $pidrow->field_value;
			if( $jtitle != $jt ) {
?>
<option value="<?php echo $pid; ?>"<?php if( $selected_id == $pid ) echo ' selected="selected"'; ?>><?php echo $jt; ?></option>
<?php
			}
			$jtitle = $jt;
		}
	}
	if( $jtitle != '' ) {
?>
<option value="" disabled="disabled">----</option>
<option value="9"<?php if( $selected_id == 9 ) echo ' selected="selected"'; ?>>保留</option>
<?php
	}
?>
</select>
<?php /*
<select name="select_progress" class="select_progress" onchange="jQuery(function(){jQuery('#select-apply-form').submit();});">
<option value="0"<?php if( $selected_prog == 0 ) echo ' selected="selected"'; ?>>進捗フィルター</option>
<option value="1"<?php if( $selected_prog == 1 ) echo ' selected="selected"'; ?>>選考中</option>
<option value="2"<?php if( $selected_prog == 2 ) echo ' selected="selected"'; ?>>１次選考通過</option>
<option value="3"<?php if( $selected_prog == 3 ) echo ' selected="selected"'; ?>>２次選考通過</option>
<option value="10"<?php if( $selected_prog == 10 ) echo ' selected="selected"'; ?>>不採用</option>
<option value="11"<?php if( $selected_prog == 11 ) echo ' selected="selected"'; ?>>採用</option>
<option value="9"<?php if( $selected_prog == 9 ) echo ' selected="selected"'; ?>>保留</option>
</select>
*/ ?>
<!--<input type="submit" value="絞り込む" style="display:inline-block;">--></p>
</form></div><!-- end .select-apply -->
<?php
endif;

// 会員ユーザと学校ユーザで振り分け
if( current_user_can('subscriber') ) {
	$forder = 1; // 選択するDBの行（自分のID）を設定
	$info_title = 'あなたの情報';
} elseif( current_user_can('employer') ) {
	$forder = 13; // 選択するDBの行（自分のID）を設定
	$info_title = '応募者の情報';
}

// 応募履歴の書き出し
$myrows = $wpdb->get_results( "SELECT submit_time, field_value FROM {$wpdb->prefix}cf7dbplugin_submits WHERE field_order = $forder" );
$myrows = array_reverse($myrows);
$rec_job_title = '';

foreach ($myrows as $myrow) :
	$rec_stime = $myrow->submit_time;
	$rec_stime_short = str_replace(".", "", $rec_stime);
	$rec_applicant_id = $myrow->field_value;
	if( $rec_applicant_id == $myID) :
		$apply_array = array();
		for( $i = 0; $i <= 21; $i++ ) { // 項目を増減した際には"$i<="の数値も要変更
			$approw = $wpdb->get_row( "SELECT field_value FROM {$wpdb->prefix}cf7dbplugin_submits WHERE field_order = $i AND submit_time = $rec_stime" );
			$apply_array[] = $approw->field_value;
		}
		$rec_job_title =$apply_array[0];
		$rec_member_id =$apply_array[1];
		$rec_my_email =$apply_array[2];
		$rec_apply_info = array(
			array('name', '名前', $apply_array[3]),
			array('kana', 'フリガナ', $apply_array[4]),
			array('gender', '性別', $apply_array[5]),
			array('birth', '生年月日', $apply_array[6]),
			array('addr_pref', '住所', $apply_array[7].$apply_array[8]),
			array('occupation', '現在状況', $apply_array[9]),
			array('university', '出身大学', $apply_array[10]),
			array('grad_school', '大学院',$apply_array[11]),
			array('lisence', '教員免許',$apply_array[12]),
		);
		$rec_school_id = $apply_array[13];
		$rec_school_name = $apply_array[14];
		$rec_school_email = $apply_array[15];
		$rec_message = $apply_array[16];
		$rec_progress = $apply_array[17];
		$rec_retention = $apply_array[18];
		$rec_jobnote_mem = $apply_array[19];
		$rec_jobnote_sch = $apply_array[20];
		$rec_post_id = $apply_array[21];
?>

<article class="apply-record apply-<?php echo $rec_post_id; ?><?php
		// フィルタでの表示・非表示の振り分け
		if( $selected_id == 9 ) {
			if( $rec_retention != 9 ) echo ' unselected';
		} else {
			if( $selected_id != 0 && $selected_id != $rec_post_id ) echo ' unselected';
		}

		// if( $selected_prog != 0 && $selected_prog != 9 && $selected_prog != $rec_progress ) echo ' unselected';

		if( $show_all == 'on' ) echo ' show-all';
		if( in_array($rec_stime_short, $my_hide_nums) ) echo ' hide-apply';
?> clearfix">
<div class="job-records-head">
<h3 class="job-apply-date"><?php echo gmdate('Y年m月d日 (H:i)', strtotime('+9 hour' ,$rec_stime)); ?></h3>
<div class="hide-apply"><form method="post" id="hide-apply-<?php echo $rec_stime_short; ?>">
<input type="hidden" name="hide_apply" value="<?php echo $rec_stime_short; ?>" style="display:none;">
<label for="hbtn-<?php echo $rec_stime_short; ?>"><input type="checkbox" name="checked" value="checked" id="hbtn-<?php echo $rec_stime_short; ?>"<?php if( in_array($rec_stime_short, $my_hide_nums) ) echo ' checked="checked"'; ?> onchange="jQuery(function(){
	if(jQuery('input#hbtn-<?php echo $rec_stime_short; ?>').prop('checked')) {
		jQuery(this).prop('checked',false);
	} else {
		jQuery(this).prop('checked',true);
	}
	jQuery('#hide-apply-<?php echo $rec_stime_short; ?>').submit();
});"> 非表示</label>
</form></div>
</div>
<div class="job-records-body">
<h4 class="job-title"><span class="subtitle">求人タイトル</span><a href="<?php echo get_permalink($rec_post_id); ?>"><?php echo $rec_job_title; ?></a></h4>
<?php if( current_user_can('subscriber') ) : ?>
<h5 class="job-school"><span class="subtitle">学校名</span><?php echo $rec_school_name; ?></h5>
<?php endif; ?>
<h5 class="infotitle"><span class="subtitle"><?php echo $info_title; ?></span></h5>
<table class="job-apply-myinfo">
<?php
		foreach( $rec_apply_info as $value ) :
?>
<tr class="<?php echo $value[0] ?>"><th><?php echo $value[1] ?>：</th><td><?php echo $value[2] ?></td></tr>
<?php
		endforeach;
?>
</table>
<h4 class="messagetitle"><span class="subtitle">通信欄</span></h4>
<table class="job-apply-message">
<tr><td class="apply-message-body"><?php echo wpautop($rec_message); ?></td></tr>
</table>

<div class="btn-emessage">
<?php
		if( current_user_can('subscriber') ) {
			$compid = $rec_school_id;
		} else {
			$compid = $rec_member_id;
		}
?>
<form action="<?php bloginfo('url') ?>/profile/exchange/" method="post" accept-charset="utf-8">
<input type="hidden" name="compid" value="<?php echo $compid; ?>" class="hidden">
<input type="submit" name="submit" value="<?php echo EXCHANGE_NAME; ?>を送る" class="submit btn-sub">
</form>
</div>
</div><!-- end .job-records-body -->
<div class="job-records-footer">
<form method="post" class="job-progress">
<?php
		if( current_user_can('subscriber') ) {
			$job_note = $rec_jobnote_mem;
		} else {
			$job_note_title = '進捗状況／';
			$job_note = $rec_jobnote_sch;
			$job_note_div = '</div>'."\n".'<div class="recruit-note-submit">'."\n";
		}
?>
<div class="recruit-note">
<div class="recruit-note-head">
<h4 class="recruit-note-title"><?php if($job_note_title) echo $job_note_title; ?>メモを<span class="togglebtn">開く <span class="marker">▼</span></span><span class="togglebtn none">閉じる <span class="marker">▲</span></span></h4>
</div>
<div class="recruit-note-body">
<?php
		if( current_user_can('employer') ) {
?>
<div class="recruit-note-progress">
<div class="recruit-note-body-content"><div class="recruit-note-body-content-inner">
<ul class="job-progress-list">
<li><label for="jp1-<?php echo $rec_stime_short; ?>"><input type="radio" name="job_progress" value="1" id="jp1-<?php echo $rec_stime_short; ?>"<?php if($rec_progress == 1) echo ' checked="checked"'; ?>> 選考中</label></li>
<li><label for="jp2-<?php echo $rec_stime_short; ?>"><input type="radio" name="job_progress" value="2" id="jp2-<?php echo $rec_stime_short; ?>"<?php if($rec_progress == 2) echo ' checked="checked"'; ?>> １次選考通過</label></li>
<li><label for="jp3-<?php echo $rec_stime_short; ?>"><input type="radio" name="job_progress" value="3" id="jp3-<?php echo $rec_stime_short; ?>"<?php if($rec_progress == 3) echo ' checked="checked"'; ?>> ２次選考通過</label></li>
<li><label for="jpacc-<?php echo $rec_stime_short; ?>"><input type="radio" name="job_progress" value="11" id="jpacc-<?php echo $rec_stime_short; ?>"<?php if($rec_progress == 11) echo ' checked="checked"'; ?>> 採用</label></li>
<li><label for="jprej-<?php echo $rec_stime_short; ?>"><input type="radio" name="job_progress" value="10" id="jprej-<?php echo $rec_stime_short; ?>"<?php if($rec_progress == 10) echo ' checked="checked"'; ?>> 不採用</label></li>
</ul>
<ul class="job-retention-list">
<li><label for="jr-<?php echo $rec_stime_short; ?>"><input type="checkbox" name="job_retention" value="9" id="jr-<?php echo $rec_stime_short; ?>"<?php if($rec_retention == 9) echo ' checked="checked"'; ?>> 保留</label></li>
</ul>
</div></div>
</div><!-- end .recruit-note-progress -->
<?php
		}
?>
<div class="recruit-note-memo">
<h5>応募メモ：</h5>
<textarea name="job_note" rows="10"><?php if($job_note) echo str_replace ( '\\' , '', $job_note ); ?></textarea>
<?php if($job_note_div) echo $job_note_div; ?>
<input type="hidden" name="submit_time" value="<?php echo $rec_stime; ?>">
<input type="hidden" name="select_apply" value="<?php echo $selected_id; ?>">
<input type="submit" value="保存" class="submit" />
</div>
</div><!-- end .recruit-note-body -->
</div><!-- end .recruit-note -->
</form>
</div><!-- end .job-records-footer -->
</article>

<?php
	endif; // if( $rec_applicant_id == $myID )
endforeach;
?>
<br />
<?php
if($rec_job_title) :
?>
<?php
	if( $show_all == 'on' ) {
		$show_all_val = 'off';
		$submit_val = '非表示案件を隠す';
	} else {
		$show_all_val = 'on';
		$submit_val = '非表示案件を表示する';
	}
?>
<form method="get" id="hide-all">
<input type="hidden" name="select_apply" value="<?php echo $selected_id; ?>" class="select_apply">
<input type="hidden" name="select_progress" value="<?php echo $selected_prog; ?>" class="select_progress">
<input type="hidden" name="show_all" value="<?php echo $show_all_val; ?>" class="show-apply">
<input type="submit" value="<?php echo $submit_val; ?>" class="submit" style="display:inline-block; margin:0;">
</form>
<?php
else :
?>
<div class="job-body">
<?php
	if( current_user_can('employer') ) :
?>
<p>まだ応募はありません。</p>
<?php
	else :
?>
<p>応募履歴はありません。<br />
求人への応募は、各求人の詳細ページから行うことができます。</p>
<p><a href="<?php bloginfo( 'url' ); ?>/whatsnew/" class="btn">新着求人</a>　<a href="<?php bloginfo( 'url' ); ?>/job-search/" class="btn">求人検索</a></p>
<?php
	endif;
?>
</div>
<?php
endif;
?><p></p>

</div><!-- end #job-apply-records -->
