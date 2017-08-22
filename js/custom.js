// 求人詳細のタブ表示
jQuery(function(){
	//クリックしたときのファンクションをまとめて指定
	jQuery('#tab-menu li').click(function() {
		if(jQuery(this).not('active')){
			//.index()を使いクリックされたタブが何番目かを調べ、indexという変数に代入します。
			var index = jQuery('#tab-menu li').index(this);
			//コンテンツを一度すべて非表示にし、
			jQuery('#tab-box div').css('display','none');
			//クリックされたタブと同じ順番のコンテンツを表示します。
			jQuery('#tab-box div').eq(index).css('display','block');
			//一度タブについているクラスactiveを消し、
			jQuery('#tab-menu li').removeClass('active');
			//クリックされたタブのみにクラスactiveをつけます。
			jQuery(this).addClass('active');
		}
	});
});

// 求人の登録「募集締切日」に初期値を追加
jQuery(document).ready(function(){
	jQuery('#page-9 .fieldset-job_expires').find('input#job_expires').attr('value', '2017-01-01');
});

// 求人の編集フォームに文言を追加
jQuery(document).ready(function(){
	jQuery('#submit-job-form').prepend('<p style="border-bottom:1px solid #E9E9E9; margin-bottom:14px;">＊「（任意）」の記述のある項目以外はすべて<strong>必須項目</strong>となっていますので、ご記入をお願いいたします。</p>');
});

// DatePicker
jQuery(function() {
	jQuery("#job_expires").datepicker();
	jQuery("#apply_date").datepicker();
});

// メッセージの宛先プルダウンを選択時にSubmitを実行
jQuery(document).ready(function(){
	jQuery('#compid').change(function() {
		jQuery('#change-comp').submit();
	});
});

// 新規会員登録時のメールアドレスをログインID（input hidden）に代入
jQuery(document).ready(function(){
	jQuery('#user_email').change(function() {
		var email = jQuery(this).val().replace( /@/g , "-" ) ;
//		jQuery('#user_login').val("user-"+email);
	});
});

// ＦＡＱのアコーデオン
jQuery(document).ready(function() {
	jQuery('h3.faq-cat-title').click(function() {
		jQuery(this).find('span').toggleClass('none');
		jQuery(this).parent('.faq-cat').find('dl.faq-item-list').animate(
	    {height: "toggle", opacity: "toggle"},
	    "normal"
		);
	});
});

// 応募履歴（進捗状況・メモ）のアコーデオン
jQuery(document).ready(function() {
	jQuery('.recruit-note-head').click(function() {
		jQuery(this).find('.togglebtn').toggleClass('none');
		jQuery(this).parent('.recruit-note').find('.recruit-note-memo').animate(
	    {height: "toggle", opacity: "toggle"},
	    "fast"
		);
	});
});

// 退会会員の削除フォームのアコーデオン
jQuery(document).ready(function() {
	jQuery('p.deleat-member').click(function() {
		jQuery(this).parent('#deleat-comp').find('p.select-box').animate(
	    {height: "toggle", opacity: "toggle"},
	    "normal"
		);
	});
});

// フォームの全サブミットボタンのクラスに"btn btn-sub"を追加
jQuery(document).ready(function() {
	jQuery('input[type="submit"], input[type="reset"], input[type="button"], button').addClass("btn").toggleClass("btn-sub");
	jQuery('button.wp-generate-pw').removeClass("btn").removeClass("btn-sub"); // パスワード生成ボタン
	jQuery('button.navbar-toggle').removeClass("btn").removeClass("btn-sub"); // レスポンシブレイアウト（スマホ用）のメニューボタン
});

// 郵便番号から住所を自動入力
jQuery(document).ready(function() {
	jQuery('#user_addr_zip').attr("onKeyUp", "AjaxZip3.zip2addr(this,'','user_addr_pref','user_addr_other');").attr("placeholder", "半角英数（住所が自動入力されます）");
	jQuery('#user_tel').attr("placeholder", "半角英数");
});
