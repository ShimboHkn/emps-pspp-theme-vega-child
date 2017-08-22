<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div class="tml tml-register" id="theme-my-login<?php $template->the_instance(); ?>">
<?php $template->the_action_template_message( 'register' ); ?>
<?php $template->the_errors(); ?>
<form name="registerform" id="registerform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'register', 'login_post' ); ?>" method="post">
<?php if ( 'email' != $theme_my_login->get_option( 'login_type' ) ) : ?>
<p class="tml-user-login-wrap" style="display: none;">
<label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Username', 'theme-my-login' ); ?>  <span class="required">*</span></label>
<input type="hidden" name="user_login" id="user_login<?php $template->the_instance(); ?>" class="text" value="<?php echo date('ymd.His', strtotime('+ 9 hour')).'.'. sprintf("%03d", mt_rand (0, 999)); ?>" size="20" />
</p>
<?php endif; ?>

<p class="tml-user-email-wrap">
<label for="user_email<?php $template->the_instance(); ?>"><?php _e( 'E-mail', 'theme-my-login' ); ?>  <span class="required">*</span></label>
<input type="email" name="user_email" id="user_email<?php $template->the_instance(); ?>" class="text" value="<?php $template->the_posted_value( 'user_email' ); ?>" size="20" />
</p>

<?php do_action( 'register_form' ); ?>

<!-- ▼▼▼ 追加ここから ▼▼▼ -->
<p>
<label for="last_name<?php $template->the_instance(); ?>">お名前（姓と名の間にスペース）  <span class="required">*</span></label>
<input type="text" name="last_name" id="last_name<?php $template->the_instance(); ?>" class="text" value="<?php $template->the_posted_value( 'last_name' ); ?>" size="40" />
</p>
<p>
<label for="user_name_kana<?php $template->the_instance(); ?>">フリガナ（姓と名の間にスペース）  <span class="required">*</span></label>
<input type="text" name="user_name_kana" id="user_name_kana<?php $template->the_instance(); ?>" class="text" value="<?php $template->the_posted_value( 'user_name_kana' ); ?>" size="40" />
</p>
<p>
<label for="user_sex<?php $template->the_instance(); ?>_m">性別 <span class="required">*</span></label>
<label class="user_sex male"><input type="radio" name="user_sex" id="user_sex<?php $template->the_instance(); ?>_m" class="radio" value="男性"<?php if ( $_POST['user_sex'] == '男性' ) echo ' checked="checked"'; ?> /> 男性</label>
<label class="user_sex female"><input type="radio" name="user_sex" id="user_sex<?php $template->the_instance(); ?>_f" class="radio" value="女性"<?php if ( $_POST['user_sex'] == '女性' ) echo ' checked="checked"'; ?> /> 女性</label>
</p>
<p>
<label for="user_birth<?php $template->the_instance(); ?>">生年月日 <span class="required">*</span></label>
<input type="text" name="user_birth" id="user_birth<?php $template->the_instance(); ?>" class="text" value="<?php $template->the_posted_value( 'user_birth' ); ?>" size="40" />
</p>
<p>
<label for="user_tel<?php $template->the_instance(); ?>">電話番号（例：033-123-4567）  <span class="required">*</span></label>
<input type="tel" name="user_tel" id="user_tel<?php $template->the_instance(); ?>" class="text" value="<?php $template->the_posted_value( 'user_tel' ); ?>" size="20" />
</p>
<p>
<label for="user_addr_zip<?php $template->the_instance(); ?>">郵便番号（例：100-0001）</label>
<input type="text" name="user_addr_zip" id="user_addr_zip<?php $template->the_instance(); ?>" class="text" value="<?php $template->the_posted_value( 'user_addr_zip' ); ?>" size="20" />
</p>
<p>
<label for="user_addr_pref<?php $template->the_instance(); ?>">住所１（都道府県） <span class="required">*</span></label>
<select name="user_addr_pref" id="user_addr_pref<?php $template->the_instance(); ?>">
<option value="">　選択して下さい ▽</option>
<?php
$addr_pref = $_POST['user_addr_pref'];
$prefArr["北海道・東北地方"] = array("北海道","青森県","岩手県","秋田県","宮城県","山形県","福島県");
$prefArr["関東地方"] = array("栃木県","群馬県","茨城県","埼玉県","東京都","千葉県","神奈川県");
$prefArr["中部地方"] = array("山梨県","長野県","新潟県","富山県","石川県","福井県","静岡県","岐阜県","愛知県");
$prefArr["近畿地方"] = array("三重県","滋賀県","京都府","大阪府","兵庫県","奈良県","和歌山県");
$prefArr["四国地方"] = array("徳島県","香川県","愛媛県","高知県");
$prefArr["中国地方"] = array("鳥取県","島根県","岡山県","広島県","山口県");
$prefArr["九州・沖縄地方"] = array("福岡県","佐賀県","長崎県","大分県","熊本県","宮崎県","鹿児島県","沖縄県");
foreach ( $prefArr as $prefGrp => $prefs):
?>
<optgroup label="<?php echo $prefGrp ?>">
<?php foreach ( $prefs as $pref): ?>
<option value="<?php echo $pref ?>"<?php if ( $addr_pref == $pref) echo ' selected="selected"' ?>><?php echo $pref ?></option>
<?php endforeach ?>
</optgroup>
<?php endforeach ?>
</select>
</p>
<p>
<label for="user_addr<?php $template->the_instance(); ?>">住所２（市区町村番地：建物名、部屋番号もご入力ください） <span class="required">*</span></label>
<input type="text" name="user_addr_other" id="user_addr_other<?php $template->the_instance(); ?>" class="text" value="<?php $template->the_posted_value( 'user_addr_other' ); ?>" size="60" />
</p>
<p>
<label for="user_occupation<?php $template->the_instance(); ?>">現在状況 <span class="required">*</span></label>
<select name="user_occupation" id="user_occupation<?php $template->the_instance(); ?>" class="select" value="<?php $template->the_posted_value( 'user_occupation' ); ?>">
<option value="" selected>　選択してください ▽</option>
<?php
$user_ocp = $_POST['user_occupation'];
$occu = array("大学生・短大生","大学院生","フリーター","派遣社員","契約社員","正社員","非常勤教員","主婦・主夫","その他",);
?>
<?php foreach ($occu as $value) : ?>
<option value="<?php echo $value; ?>"<?php if ( $user_ocp == $value) echo ' selected="selected"' ?>><?php echo $value; ?></option>
<?php endforeach; ?>
</select>
</p>
<p>
<label for="user_university<?php $template->the_instance(); ?>">出身大学（学部、学科までご入力ください） <span class="required">*</span></label>
<input type="text" name="user_university" id="user_university<?php $template->the_instance(); ?>" class="text" value="<?php $template->the_posted_value( 'user_university' ); ?>" size="20" />
</p>
<p>
<label for="user_grad_school<?php $template->the_instance(); ?>">大学院（専攻までご入力ください）</label>
<input type="text" name="user_grad_school" id="user_grad_school<?php $template->the_instance(); ?>" class="text" value="<?php $template->the_posted_value( 'user_grad_school' ); ?>" size="20" />
</p>
<p>
<label for="user_license<?php $template->the_instance(); ?>">教員免許（例：小学校１種（算数）、中学校２種（数学）） <span class="required">*</span></label>
<textarea name="user_license" id="user_license<?php $template->the_instance(); ?>" class="textarea" size="20"><?php if($_POST['user_license']) echo $_POST['user_license']; ?></textarea>
</p>
<div class="tos">
<h3 class="tos-title">会員規約：</h3>
<div class="tos-content">
<?php echo get_post(84)->post_content; ?>
</div><!-- /.tos-content -->
</div><!-- /.tos -->
<p>
<label for="user_confirm<?php $template->the_instance(); ?>">
<input type="checkbox" name="user_confirm" id="user_confirm<?php $template->the_instance(); ?>" class="checkbox" value="会員規約に同意"<?php if ( '会員規約に同意' == $_POST['user_confirm']) echo ' checked="checked"' ?> /> 会員規約に同意 <span class="required">*</span></label>
</p>

<!-- ▲▲▲ 追加ここまで ▲▲▲ -->




<p class="tml-registration-confirmation" id="reg_passmail<?php $template->the_instance(); ?>"><?php echo apply_filters( 'tml_register_passmail_template_message', __( 'Registration confirmation will be e-mailed to you.', 'theme-my-login' ) ); ?></p>

<p class="tml-submit-wrap">
<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="仮登録<?php //esc_attr_e( 'Register', 'theme-my-login' ); ?>" />
<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'register' ); ?>" />
<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
<input type="hidden" name="action" value="register" />
</p>
</form>

<?php //$template->the_action_links( array( 'register' => false ) ); ?>
</div><!-- /#theme-my-login -->
