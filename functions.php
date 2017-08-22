<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
	function chld_thm_cfg_parent_css() {
		wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'animate-css' ) );
		wp_enqueue_script( 'jquery_ui', 'http://code.jquery.com/ui/1.10.0/jquery-ui.js', array(), false, true );
		wp_enqueue_script( 'datepicker_ja', get_bloginfo( 'stylesheet_directory') . '/js/datepicker-ja.js', array(), false, true );
		wp_enqueue_script( 'ajaxzip3', 'https://ajaxzip3.github.io/ajaxzip3.js', array(), false, true );
		wp_enqueue_script( 'custom_js', get_bloginfo( 'stylesheet_directory') . '/js/custom.js', array(), false, true );
	}
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

if ( !function_exists( 'child_theme_configurator_css' ) ):
	function child_theme_configurator_css() {
		wp_enqueue_style( 'chld_thm_cfg_separate', trailingslashit( get_stylesheet_directory_uri() ) . 'ctc-style.css', array( 'chld_thm_cfg_parent','vega-wp-style','vega-wp-color' ) );
	}
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css' );

// END ENQUEUE PARENT ACTION


// サイト全体で使う変数の定義
define(TOPICS_ID, 70); // 「お知らせ」ページのID
define(EXCHANGE_ID, 111); // 「メッセージ」ページのID
define(EXCHANGE_NAME, 'Ｅメッセージ'); // 「メッセージ」の名称

// wp_footerにjavascriptを読み込む
function my_load_widget_scripts() {
	//wp_enqueue_script( 'jquery_jpostal', '//jpostal-1006.appspot.com/jquery.jpostal.js', array(), false, true );
}
add_action('wp_footer', 'my_load_widget_scripts');


// 管理ページにCSSを読み込む
function my_admin_style(){
//	wp_enqueue_style( 'edge_admin_style', get_template_directory_uri().'/style.css' );
}
add_action( 'admin_enqueue_scripts', 'my_admin_style' );

// カスタムフィールド・カスタムタクソノミー・都道府県市区町村リストの読み込み
require_once('lib/custom_field.php');
require_once('lib/custom_post_taxonomy.php');
require_once('lib/preflist.php');

// 個別の求人情報編集画面内の不要項目の削除
function remove_post_metaboxes() {
  remove_meta_box('postcustom', 'job_listing', 'normal'); // カスタムフィールド
  remove_meta_box('postexcerpt', 'job_listing', 'normal'); // 抜粋
  remove_meta_box('commentstatusdiv', 'job_listing', 'normal'); // コメント設定
  remove_meta_box('trackbacksdiv', 'job_listing', 'normal'); // トラックバック設定
  //remove_meta_box('revisionsdiv', 'job_listing', 'normal'); // リビジョン表示
  remove_meta_box('formatdiv', 'job_listing', 'normal'); // フォーマット設定
  remove_meta_box('slugdiv', 'job_listing', 'normal'); // スラッグ設定
  //remove_meta_box('authordiv', 'job_listing', 'normal'); // 投稿者
  //remove_meta_box('categorydiv', 'job_listing', 'normal'); // カテゴリー
  //remove_meta_box('tagsdiv-post_tag', 'job_listing', 'normal'); // タグ
}
add_action('admin_menu', 'remove_post_metaboxes');

// body_class に権限グループを追加
function my_class_names( $classes ) {
	global $current_user;
	get_currentuserinfo();
	$userlevel = $current_user->user_level; // ログインしているユーザーの権限レベルを取得
//	$user = $current_user->capabilities;
	if($userlevel == '') $userlevel = 99;
	$classes[] = 'user-level-' . $userlevel;
	$cname = '';
	if(current_user_can('subscriber')){
		$cname = 'subscriber';
	}elseif(current_user_can('contributor')){
		$cname = 'contributor';
	}elseif(current_user_can('author')){
		$cname = 'author';
	}elseif(current_user_can('editor')){
		$cname = 'editor';
	}elseif(current_user_can('administrator')){
		$cname = 'administrator';
	}elseif(current_user_can('employer')){
		$cname = 'employer';
	};
	$classes[] = $cname;
	return $classes;
}
add_filter( 'body_class', 'my_class_names' );




/* ********************************************** */
/* "Job Listing" */
/* ********************************************** */
// 都道府県がどの地方に分類されるかの配列
global $area_list;
$area_list = array(
  '東北' => array( '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県' ),
  '関東' => array( '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県' ),
  '東海' => array( '静岡県', '愛知県', '岐阜県', '三重県' ),
  '甲信越' => array( '新潟県', '山梨県', '長野県' ),
  '北陸' => array( '富山県', '石川県', '福井県' ),
  '関西' => array( '京都府', '大阪府', '奈良県', '兵庫県', '滋賀県', '和歌山県' ),
  '中国' => array( '岡山県', '広島県', '山口県', '鳥取県', '島根県' ),
  '四国' => array( '香川県', '愛媛県', '徳島県', '高知県' ),
  '九州' => array( '福岡県', '長崎県', '大分県', '熊本県', '佐賀県', '宮崎県', '鹿児島県' ),
);

function edit_job_listing() {
	add_post_type_support( 'job_listing', 'author' );
}
add_action( 'init', 'edit_job_listing' );




/* ********************************************** */
/* 絞り込み検索をプラグインを使わずに実装 */
/* ********************************************** */

// 検索ボタンが押されたら、必ず検索結果ページを表示する

// カスタム投稿タイプ（求人情報）でコメントを使えるようにする
function edit_post_type() {
	register_post_type( 'job_listing',
		array(
			'labels' => array(
				'name' => '求人',
				'singular_name' => '求人',
				'menu_name' => '求人一覧',
//				'name_admin_bar' => '',
//				'add_new' => '',
				'add_new_item' => '新規求人を追加',
				'new_item' => '新規求人',
				'edit_item' => '求人の編集',
//				'view_item' => '',
//				'all_items' => '',
//				'search_items' => '',
//				'parent_item_colon' => '',
				'not_found' => '求人は見つかりませんでした',
				'not_found_in_trash' => 'ゴミ箱に求人はありません'
			),
			'public' => true,
			'rewrite' => array( 'slug' => 'job-offer' ),
			'supports' => array('trackbacks','comments')
		)
	);
}
add_action( 'init', 'edit_post_type' );


/* ********************************************** */
/* ショートコード ShortCode */
/* ********************************************** */
// ウィジェットでショートコードを使えるようにする
add_filter('widget_text', 'do_shortcode' );

// サイトURLを表示
function get_siteurl() {
	$siteURL = get_bloginfo('url');
	return $siteURL;
}
add_shortcode('siteurl', 'get_siteurl');

// サイト名を表示
function get_sitename() {
	$siteName = get_bloginfo('name');
	return $siteName;
}
add_shortcode('sitename', 'get_sitename');

// サイトメールを表示
function get_sitemail() {
	$siteName = get_bloginfo('admin_email');
	return $siteName;
}
add_shortcode('sitemail', 'get_sitemail');

// ユーザー名（表示名）を取得
function get_myname() {
	$myid = get_current_user_id();
	$myname = get_userdata($myid)->display_name;
	return $myname;
}
add_shortcode('myname', 'get_myname');

/* ********************************************** */
/* "Wp Job Manager" */
/* ********************************************** */

if ( ! function_exists( 'get_job_listing_post_statuses' ) ) {
	function get_job_listing_post_statuses() {
		return apply_filters( 'job_listing_post_statuses', array(
			'draft'           => _x( '下書き', 'post status', 'wp-job-manager' ),
			'expired'         => _x( '期限切れ', 'post status', 'wp-job-manager' ),
			'preview'         => _x( 'プレビュー', 'post status', 'wp-job-manager' ),
			'pending'         => _x( '承認待ち', 'post status', 'wp-job-manager' ),
			'pending_payment' => _x( '入金待ち', 'post status', 'wp-job-manager' ),
			'publish'         => _x( 'アクティブ', 'post status', 'wp-job-manager' ),
		) );
	}
}

/* ********************************************** */
/* "Theme My Login" */
/* ********************************************** */

//ユーザープロフィールの項目の追加と削除
function my_user_meta($contactmethods) {

	//不要な項目の削除
	unset($contactmethods['first_name']);
	unset($contactmethods['website']);
	unset($contactmethods['aim']);
	unset($contactmethods['jabber']);
	unset($contactmethods['yim']);
	unset($contactmethods['googleplus']);

	//項目の追加
//	$contactmethods['last_name'] = 'お名前';
	$contactmethods['user_name_kana'] = 'フリガナ';
	$contactmethods['user_sex'] = '性別';
	$contactmethods['user_birth'] = '生年月日';
	$contactmethods['user_tel'] = '電話番号';
	$contactmethods['user_addr_zip'] = '郵便番号';
	$contactmethods['user_addr_pref'] = '住所１（都道府県）';
	$contactmethods['user_addr_other'] = '住所２（地区町村番地）';
	$contactmethods['user_occupation'] = '現在状況';
	$contactmethods['user_university'] = '出身大学';
	$contactmethods['user_grad_school'] = '大学院';
	$contactmethods['user_license'] = '教員免許';
	$contactmethods['user_confirm'] = '会員規約に同意';
	return $contactmethods;
}
add_filter('user_contactmethods', 'my_user_meta', 10, 1);

// ユーザープロフィール項目の登録時の保存
function tml_user_register( $user_id ) {
	if ( !empty( $_POST['last_name'] ) ) wp_update_user( array('ID'=>$user_id, 'user_nicename'=>$_POST['last_name'], 'display_name'=>$_POST['last_name']) );
	if ( !empty( $_POST['last_name'] ) ) update_user_meta( $user_id, 'last_name', $_POST['last_name'] );
	if ( !empty( $_POST['user_name_kana'] ) ) update_user_meta( $user_id, 'user_name_kana', $_POST['user_name_kana'] );
	if ( !empty( $_POST['user_sex'] ) ) update_user_meta( $user_id, 'user_sex' , $_POST['user_sex'] );
	if ( !empty( $_POST['user_birth'] ) ) update_user_meta( $user_id, 'user_birth', $_POST['user_birth'] );
	if ( !empty( $_POST['user_tel'] ) ) update_user_meta( $user_id, 'user_tel', $_POST['user_tel'] );
	if ( !empty( $_POST['user_addr_zip'] ) ) update_user_meta( $user_id, 'user_addr_zip', $_POST['user_addr_zip'] );
	if ( !empty( $_POST['user_addr_pref'] ) ) update_user_meta( $user_id, 'user_addr_pref', $_POST['user_addr_pref'] );
	if ( !empty( $_POST['user_addr_other'] ) ) update_user_meta( $user_id, 'user_addr_other', $_POST['user_addr_other'] );
	if ( !empty( $_POST['user_occupation'] ) ) update_user_meta( $user_id, 'user_occupation', $_POST['user_occupation'] );
	if ( !empty( $_POST['user_university'] ) ) update_user_meta( $user_id, 'user_university', $_POST['user_university'] );
	if ( !empty( $_POST['user_grad_school'] ) ) update_user_meta( $user_id, 'user_grad_school', $_POST['user_grad_school'] );
	if ( !empty( $_POST['user_license'] ) ) update_user_meta( $user_id, 'user_license', $_POST['user_license'] );
	if ( !empty( $_POST['user_confirm'] ) ) update_user_meta( $user_id, 'user_confirm', $_POST['user_confirm'] );
}
add_action( 'user_register', 'tml_user_register' );

// 新規ユーザー登録時のバリデート
function tml_registration_errors( $errors ) {
	$tel_format="/^[0-9]{2,3}\-[0-9]{3,4}\-[0-9]{3,4}$/";

	if ( empty( $_POST['last_name'] ) ) $errors->add( 'empty_last_name', '<strong>エラー</strong>: お名前を入力してください');
	if ( empty( $_POST['user_name_kana'] ) ) $errors->add( 'empty_user_name_kana', '<strong>エラー</strong>: お名前フリガナを入力してください' );
	if ( empty( $_POST['user_sex'] ) ) $errors->add( 'empty_user_sex', '<strong>エラー</strong>: 性別を選択してください' );
	if ( empty( $_POST['user_birth'] ) ) $errors->add( 'empty_user_birth', '<strong>エラー</strong>: 生年月日を入力してください' );
	if ( empty( $_POST['user_tel'] ) ) {
		//電話番号が入力されていな場合のエラー
		$errors->add( 'empty_user_tel', '<strong>エラー</strong>: 電話番号を入力してください' );
	} else {
		//電話番号は入力されているが書式が間違っている場合のエラー
		if ( !preg_match($tel_format, $_POST["user_tel"]) ) {
			$errors->add( 'error_user_tel', '<strong>エラー</strong>: 電話番号の書式が間違っています' );
		}
	}
	if ( empty( $_POST['user_addr_pref'] ) ) $errors->add( 'empty_user_addr_pref', '<strong>エラー</strong>: 住所（都道府県）を選択してください' );
	if ( empty( $_POST['user_addr_other'] ) ) $errors->add( 'empty_user_addr_other', '<strong>エラー</strong>: 住所（地区町村番地）を入力してください' );
	if ( empty( $_POST['user_occupation'] ) ) $errors->add( 'empty_user_occupation', '<strong>エラー</strong>: 現在状況を選択してください' );
	if ( empty( $_POST['user_university'] ) ) $errors->add( 'empty_user_university', '<strong>エラー</strong>: 出身大学を入力してください' );
	if ( empty( $_POST['user_license'] ) ) $errors->add( 'empty_user_license', '<strong>エラー</strong>: 教員免許を入力してください' );
	if ( empty( $_POST['user_confirm'] ) ) $errors->add( 'empty_user_confirm', '<strong>エラー</strong>: 会員規約に同意をチェックしてください' );
	return $errors;
}
add_filter( 'registration_errors', 'tml_registration_errors' );


/* ********************************************** */
/* Contact Form 7 */
/* ********************************************** */
// 求人応募フォーム ＜hidden項目＞
function apply_form_tag_filter($tag){
	if ( ! is_array( $tag ) ) {
		return $tag;
	}
	$name = $tag['name'];

	if(is_user_logged_in()){
		$user = wp_get_current_user();
		global $post;
		$school = get_userdata($post->post_author);

		if($name == 'applicant-id')
			$tag['values'] = (array) $user->get('ID');
		else if($name == 'applicant-email')
			$tag['values'] = (array) $user->get('user_email');
		else if($name == 'applicant-name')
			$tag['values'] = (array) $user->get('last_name');
		else if($name == 'applicant-name-kana')
			$tag['values'] = (array) $user->get('user_name_kana');
		else if($name == 'applicant-gender')
			$tag['values'] = (array) $user->get('user_sex');
		else if($name == 'applicant-birth')
			$tag['values'] = (array) $user->get('user_birth');
		else if($name == 'applicant-addr-pref')
			$tag['values'] = (array) $user->get('user_addr_pref');
		else if($name == 'applicant-addr-other')
			$tag['values'] = (array) $user->get('user_addr_other');
		else if($name == 'applicant-occupation')
			$tag['values'] = (array) $user->get('user_occupation');
		else if($name == 'applicant-university')
			$tag['values'] = (array) $user->get('user_university');
		else if($name == 'applicant-grad-school')
			$tag['values'] = (array) $user->get('user_grad_school');
		else if($name == 'applicant-lisence')
			$tag['values'] = (array) $user->get('user_lisence');

		else if($name == 'recruit-title')
			$tag['values'] = (array) $post->post_title;
		else if($name == 'school-id')
			$tag['values'] = (array) $school->ID;
		else if($name == 'school-name')
			$tag['values'] = (array) $school->nickname;
		else if($name == 'school-email')
			$tag['values'] = (array) $school->user_email;

		else if($name == 'post-id')
			$tag['values'] = (array) $post->ID;
	}
	return $tag;
}
add_filter('wpcf7_form_tag', 'apply_form_tag_filter', 11);

// 求人応募フォーム ＜ユーザー情報表示＞
function the_apply_form(){
	$user = wp_get_current_user();
	$my_ID = $user->get('ID');
	$my_name = $user->get('last_name');
	$my_email = $user->get('email');
	global $post_author;
	$sch_email = get_userdata($post_author)->get('email');
	$sch_name = get_userdata($post_author)->get('nickname');
	$sch_ID = get_userdata($post_author)->get('ID');

	$user_array = array(
		array('my_name', 'お名前', $my_name),
		array('my_name_kana', 'フリガナ', $user->get('user_name_kana')),
		array('my_sex', '性別', $user->get('user_sex')),
		array('my_birth', '生年月日', $user->get('user_birth')),
		array('my_addr_pref', '都道府県', $user->get('user_addr_pref')),
		array('my_addr', '市区町村番地', $user->get('user_addr_other')),
		array('my_occupation', '現在状況', $user->get('user_occupation')),
		array('my_university', '出身大学', $user->get('user_university')),
		array('my_grad_school', '大学院', $user->get('user_grad_school')),
		array('my_lisence', '教員免許', $user->get('user_license'))
	);
	$output = '<table class="user-info">
';
	foreach($user_array as $value) :
		$output .= '<tr class="'.$value[0].'"><th>'.$value[1].'：</th><td>'.$value[2].'</td></tr>'."\n";
	endforeach;
		$output .= '</table>
';
	return $output;
}
wpcf7_add_shortcode("apply_form","the_apply_form");


/* ********************************************** */
/* コメント */
/* ********************************************** */

// コメント項目のカスタマイズ（URLの入力フィールドを削除）
function remove_comment_url_fields($fields) {
	unset($fields['url']);
	return $fields;
}
add_filter('comment_form_default_fields', 'remove_comment_url_fields');

// コメント送信後のリダイレクト処理
function custom_comment_post_redirect() {
	$myID = get_current_user_id(); // 自分のIDを取得
	$compID = wp_filter_nohtml_kses($_POST['recipient_id']);
	if( isset($compID) ) {
		$redirect_to = get_bloginfo('url').'/profile/exchange/?comp='.$compID.'&src='.$myID.'&entr='.mt_rand(11, 9879);
		return $redirect_to;
	}
}
add_filter( 'comment_post_redirect', 'custom_comment_post_redirect' );

// コメント通知
// メールヘッダをカスタマイズ
function filter_comment_notification_headers( $message_headers, $comment_comment_id ) {
	$message_headers= 'From: '.get_bloginfo('name').' <no-reply@'.preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])).'>';
	return $message_headers;
};
add_filter( 'comment_notification_headers', 'filter_comment_notification_headers', 10, 2 );
// 件名をカスタマイズ
function custom_comment_notification_subject() {
	$myID = get_current_user_id(); // 自分のIDを取得
	$myName = get_userdata($myID)->last_name;
	$output = '['.get_bloginfo('name').'] '.$myName.'さんが'.EXCHANGE_NAME.'を書き込みました';
	return $output;
}
add_filter( 'comment_notification_subject', 'custom_comment_notification_subject' );
// 本文をカスタマイズ
function custom_comment_notification_text() {
	$myID = get_current_user_id(); // 自分のIDを取得
	$compID = wp_filter_nohtml_kses($_POST['recipient_id']); // 宛先のIDを取得
	if( isset($compID) ) {
		$myName = get_userdata($myID)->last_name;
		$compName = get_userdata($compID)->last_name;
		$adminMail = get_bloginfo('admin_email');
		$blogNamne = get_bloginfo('blogname');
		$siteUrl = get_bloginfo('url');
		$theTitle = get_the_title(EXCHANGE_ID);
		$output = $compName.'様'."\r\n".
		$myName.'さんから'.EXCHANGE_NAME.'がありました。'."\r\n".
		"\r\n".
		EXCHANGE_NAME.'の内容の確認と返信は、'."\r\n".
		get_permalink(EXCHANGE_ID).'?comp='.$compID.'&src='.$myID.'&entr='.mt_rand(11, 9879)."\r\n".
		'から行うことができます（ログインした状態で開いてください）。'."\r\n".
		"\r\n".
		$blogNamne.' <'.$adminMail.'>'."\r\n".
		"\r\n".
		'--------'."\r\n".
		'＊このメールは '.$blogNamne.' ('.$siteUrl.') の「マイページ>'.$theTitle.'」から自動送信されました。'."\r\n".
		'＊このメールに返信することはできません。'."\r\n";
		return $output;
	}
}
add_filter( 'comment_notification_text', 'custom_comment_notification_text' );
// 宛先に相手のアドレスを追加
function add_comment_notification_recipients($emails, $comment_id) {
	$compID = wp_filter_nohtml_kses($_POST['recipient_id']); // 宛先のIDを取得
	if( isset($compID) ) {
		$emails[] = get_userdata($compID)->user_email;
	}
	return $emails;
}
add_filter( 'comment_notification_recipients', 'add_comment_notification_recipients', 10, 2 );

// hiddenフィールドの値をコメントメタに保存
function add_comment_meta_values($comment_id) {
	if(isset($_POST['recipient_id'])) {
		$recipient_id = wp_filter_nohtml_kses($_POST['recipient_id']);
		add_comment_meta($comment_id, 'recipient_id', $recipient_id, false);
//		$compID = $recipient_id;
	}
	if(isset($_POST['recipient_login'])) {
		$recipient_login = wp_filter_nohtml_kses($_POST['recipient_login']);
		add_comment_meta($comment_id, 'recipient_login', $recipient_login, false);
	}
	if(isset($_POST['recipient_email'])) {
		$recipient_email = wp_filter_nohtml_kses($_POST['recipient_email']);
		add_comment_meta($comment_id, 'recipient_email', $recipient_email, false);
	}
}
add_action ('comment_post', 'add_comment_meta_values', 1);

// hiddenフィールドの値を（相手のIDを自分の、自分のIDを相手の）ユーザーメタに保存
function add_user_meta_values($comment_id) {
	$myID = get_current_user_id(); // 自分のIDを取得
	$recID = wp_filter_nohtml_kses($_POST['recipient_id']); // 宛先のIDを取得
	if( isset($recID) ) {
		// 相手のIDを自分のユーザメタに追加
		if( get_user_meta($myID, 'destination_ids') ) {
			$my_compIDs = get_user_meta($myID, 'destination_ids', true);
		} else {
			$my_compIDs = array();
		}
		if( !in_array($recID, $my_compIDs) ) {
			$my_compIDs[] = $recID;
		}
		update_user_meta($myID, 'destination_ids', $my_compIDs);
		// 自分のIDを相手のユーザーメタに追加
		if( get_user_meta($recID, 'destination_ids') ) {
			$rec_compIDs = get_user_meta($recID, 'destination_ids', true);
		} else {
			$rec_compIDs = array();
		}
		if( !in_array($myID, $rec_compIDs) ) {
			$rec_compIDs[] = $myID;
		}
		update_user_meta($recID, 'destination_ids', $rec_compIDs);
	}
}
add_filter('comment_post', 'add_user_meta_values');

// 一覧ページに項目（メッセージの相手）を追加
function manage_comment_columns($columns) {
	$columns['recipient'] = "相手";
	return $columns;
}
add_filter( 'manage_edit-comments_columns', 'manage_comment_columns' );
function add_comment_columns($column_name, $comment_id) {
	if( $column_name == 'recipient' ) {
		$repID = get_comment_meta( $comment_id, 'recipient_id', true );
		$repEmail = get_comment_meta( $comment_id, 'recipient_email', true );
		$repName = get_user_meta($repID, 'last_name', true).'<br /><a href="mailto:'.$repEmail.'">'.$repEmail.'</a>';
		echo $repName;
	}
}
add_action( 'manage_comments_custom_column', 'add_comment_columns',null, 2);

/* ********************************************** */
/* フッタ */
/* ********************************************** */


