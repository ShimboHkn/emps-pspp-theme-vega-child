<?php
/*
カスタムフィールド関連
*/

// 【学校ユーザー用】求人登録フォーム項目
function custom_submit_job_form_fields( $fields ) {
	// 1
	$fields['job']['job_title'] = array(
		'label' => '求人タイトル',
		'type' => 'text',
		'required' => true,
		'placeholder' => '',
		'priority' => 1,
	);

	// 2
	$fields['job']['job_image'] = array(
		'label' => 'イメージ画像',
		'type' => 'file',
		'required' => false,
		'placeholder' => '',
		'priority' => 2,
	);

	$fields['job']['job_description'] = array(
		'label' => '募集内容',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 3,
	);

	$fields['job']['job_category']['label'] = '求人教科';
	$fields['job']['job_category']['type'] = 'term-select';
	$fields['job']['job_category']['placeholder'] = '教科を選択してください';
	$fields['job']['job_category']['priority'] = 4;

	$fields['job']['job_type']['label'] = '雇用形態';
	$fields['job']['job_type']['type'] = 'term-select';
	$fields['job']['job_type']['placeholder'] = '雇用形態を選択してください';
	$fields['job']['job_type']['priority'] = 5;

	$fields['job']['job_location1'] = array(
		'label' => '勤務地（都道府県）',
		'type' => 'text',
		'required' => true,
		'placeholder' => '',
		'priority' => 8,
	);

	$fields['job']['job_arrivalday'] = array(
		'label' => '着任時期',
		'type' => 'text',
		'required' => true,
		'placeholder' => '',
		'priority' => 9,
	);

	$fields['job']['job_expires'] = array(
		'label' => '募集締切日',
		'type' => 'text',
		'required' => true,
		'placeholder' => '例：2020-03-01（年-月-日すべて半角英数字）',
		'priority' => 11,
	);

	$fields['job']['job_class'] = array(
		'label' => '学校種別',
		'type' => 'term-select',
		'taxonomy' => 'job_listing_class',
		'required' => true,
		'placeholder' => '学校種別を選択してください',
		'priority' => 12,
	);

/* ******** */

	$fields['job']['job_noses'] = array(
		'label' => '募集人数',
		'type' => 'text',
		'required' => true,
		'placeholder' => '',
		'priority' => 21,
	);

	$fields['job']['job_skill'] = array(
		'label' => '生かせる経験・スキル',
		'type' => 'text',
		'required' => false,
		'placeholder' => '',
		'priority' => 22,
	);

	$fields['job']['job_requirements'] = array(
		'label' => '応募資格',
		'type' => 'textarea',
		'required' => true,
		'placeholder' => '',
		'priority' => 23,
	);

	$fields['job']['job_papers'] = array(
		'label' => '応募書類',
		'type' => 'textarea',
		'required' => true,
		'placeholder' => '',
		'priority' => 24,
	);

	$fields['job']['job_method'] = array(
		'label' => '応募方法',
		'type' => 'textarea',
		'required' => true,
		'placeholder' => '',
		'priority' => 25,
	);

	$fields['job']['job_recruit_info'] = array(
		'label' => '選考方法',
		'type' => 'textarea',
		'required' => true,
		'placeholder' => '',
		'priority' => 31,
	);

	$fields['job']['job_apptargets'] = array(
		'label' => '応募先',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 33,
	);

	$fields['job']['job_detail'] = array(
		'label' => '仕事内容',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 34,
	);

	$fields['job']['job_place'] = array(
		'label' => '勤務場所',
		'type' => 'textarea',
		'required' => true,
		'placeholder' => '',
		'priority' => 35,
	);

	$fields['job']['job_time'] = array(
		'label' => '勤務時間',
		'type'  => 'textarea',
		'required' => true,
		'placeholder' => '',
		'priority' => 36,
	);

	$fields['job']['job_holiday'] = array(
		'label' => '休日・休暇',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 37,
	);

	$fields['job']['job_salary'] = array(
		'label' => '給与',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 40,
	);

	$fields['job']['job_conditions'] = array(
		'label' => '待遇・福利厚生',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 41,
	);

	$fields['job']['job_insurance'] = array(
		'label' => '社会保険',
		'type' => 'text',
		'required' => false,
		'placeholder' => '',
		'priority' => 42,
	);

	$fields['job']['job_charge'] = array(
		'label' => '採用担当者',
		'type' => 'text',
		'required' => false,
		'placeholder' => '',
		'priority' => 51,
	);

	$fields['job']['application']['priority'] = 99;



/* ******** */

	//Company Detail
	$fields['company']['company_educational'] = array(
		'label' => '学校法人名',
		'type' => 'text',
		'required' => true,
		'placeholder' => '',
		'priority' => 1
	);

	$fields['company']['company_name'] = array(
		'label' => '学校名',
		'type' => 'text',
		'required' => true,
		'placeholder' => '',
		'priority' => 2
	);

	$fields['company']['company_type'] = array(
		'label' => '校種',
		'type' => 'text',
		'required' => true,
		'placeholder' => '',
		'priority' => 3
	);

	$fields['company']['company_birth'] = array(
		'label' => '創立年月日',
		'type' => 'text',
		'required' => false,
		'placeholder' => '',
		'priority' => 4
	);

/*	$fields['company']['company_logo'] = array(
		'label' => '学校イメージ画像',
		'type' => 'none',
		'required' => false,
		'placeholder' => '',
		'priority' => 5
	);*/

	$fields['company']['company_tagline'] = array(
		'label' => '学校の説明',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 10
	);

	$fields['company']['company_policy'] = array(
		'label' => '教育方針',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 11
	);

	$fields['company']['company_director'] = array(
		'label' => '理事長名',
		'type' => 'text',
		'required' => false,
		'placeholder' => '',
		'priority' => 14
	);

	$fields['company']['company_chief'] = array(
		'label' => '校長名',
		'type' => 'text',
		'required' => true,
		'placeholder' => '',
		'priority' => 15
	);

	$fields['company']['company_location'] = array(
		'label' => '所在地',
		'type' => 'textarea',
		'required' => true,
		'placeholder' => '',
		'priority' => 20
	);

	$fields['company']['company_phone'] = array(
		'label' => '電話番号',
		'type' => 'text',
		'required' => false,
		'placeholder' => '',
		'description' => '',
		'priority' => 21
	);

	$fields['company']['company_fax'] = array(
		'label' => 'FAX番号',
		'type' => 'text',
		'required' => false,
		'placeholder' => '',
		'description' => '',
		'priority' => 22
	);

	$fields['company']['company_contact'] = array(
		'label' => 'メールアドレス',
		'type' => 'text',
		'required' => true,
		'placeholder' => '',
		'description' => '',
		'priority' => 23
	);

	$fields['company']['company_website']['label'] = 'ホームページ';
	$fields['company']['company_website']['priority'] = 24;

	$fields['company']['company_capital'] = array(
		'label' => '生徒数',
		'type' => 'text',
		'required' => false,
		'placeholder' => '',
		'priority' => 26
	);

	$fields['company']['company_employee'] = array(
		'label' => '教職員数',
		'type' => 'text',
		'required' => false,
		'placeholder' => '',
		'priority' => 27
	);

	$fields['company']['company_subject'] = array(
		'label' => '学科',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 31
	);

	$fields['company']['company_course'] = array(
		'label' => 'コース',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 32
	);

	$fields['company']['company_highgrade'] = array(
		'label' => '主な進学実績',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 33
	);

	$fields['company']['company_club'] = array(
		'label' => '主な部活動実績',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 34
	);

	$fields['company']['company_relation'] = array(
		'label' => '関連校',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 40
	);

	unset( $fields['job']['job_location'] );
	unset( $fields['company']['company_logo'] );
	unset( $fields['company']['company_video'] );
	unset( $fields['company']['company_twitter'] );
	return $fields;
}
add_filter( 'submit_job_form_fields', 'custom_submit_job_form_fields' );



// 求人登録フォーム各項目の保存
function frontend_add_job_manager_job_listing_data_field_save( $job_id, $values ) {
	update_post_meta( $job_id, '_job_image', $values['job']['job_image'] );

	update_post_meta( $job_id, '_job_location', $values['job']['job_location1'] );
	update_post_meta( $job_id, '_job_arrivalday', $values['job']['job_arrivalday'] ); // new
	update_post_meta( $job_id, '_job_expires', $values['job']['job_expires'] );
	update_post_meta( $job_id, '_job_class', $values['job']['job_class'] );

	update_post_meta( $job_id, '_job_noses', $values['job']['job_noses'] ); // new
	update_post_meta( $job_id, '_job_skill', $values['job']['job_skill'] ); // new
	update_post_meta( $job_id, '_job_requirements', $values['job']['job_requirements'] );
	update_post_meta( $job_id, '_job_papers', $values['job']['job_papers'] ); // new
	update_post_meta( $job_id, '_job_method', $values['job']['job_method'] ); // new
	update_post_meta( $job_id, '_job_recruit_info', $values['job']['job_recruit_info'] );
	update_post_meta( $job_id, '_job_apptargets', $values['job']['job_apptargets'] ); // new
	update_post_meta( $job_id, '_job_detail', $values['job']['job_detail'] ); // new
	update_post_meta( $job_id, '_job_place', $values['job']['job_place'] ); // new
	update_post_meta( $job_id, '_job_time', $values['job']['job_time'] );
	update_post_meta( $job_id, '_job_holiday', $values['job']['job_holiday'] );
	update_post_meta( $job_id, '_job_salary', $values['job']['job_salary'] );
	update_post_meta( $job_id, '_job_conditions', $values['job']['job_conditions'] );
	update_post_meta( $job_id, '_job_insurance', $values['job']['job_insurance'] ); // new
	update_post_meta( $job_id, '_job_charge', $values['job']['job_charge'] );

	update_post_meta( $job_id, '_job_', $values['job']['job_'] );


	update_post_meta( $job_id, '_company_educational', $values['company']['company_educational'] );
	update_post_meta( $job_id, '_company_name', $values['company']['company_name'] );
	update_post_meta( $job_id, '_company_type', $values['company']['company_type'] );
	update_post_meta( $job_id, '_company_birth', $values['company']['company_birth'] );
	update_post_meta( $job_id, '_company_logo', $values['company']['company_logo'] );
	update_post_meta( $job_id, '_company_tagline', $values['company']['company_tagline'] );
	update_post_meta( $job_id, '_company_policy', $values['company']['company_policy'] );
	update_post_meta( $job_id, '_company_director', $values['company']['company_director'] );
	update_post_meta( $job_id, '_company_chief', $values['company']['company_chief'] );
	update_post_meta( $job_id, '_company_location', $values['company']['company_location'] );
	update_post_meta( $job_id, '_company_phone', $values['company']['company_phone'] );
	update_post_meta( $job_id, '_company_fax', $values['company']['company_fax'] );
	update_post_meta( $job_id, '_company_contact', $values['company']['company_contact'] );
	update_post_meta( $job_id, '_company_website', $values['company']['company_website'] );
	update_post_meta( $job_id, '_company_capital', $values['company']['company_capital'] );
	update_post_meta( $job_id, '_company_employee', $values['company']['company_employee'] );

	update_post_meta( $job_id, '_company_subject', $values['company']['company_subject'] );
	update_post_meta( $job_id, '_company_course', $values['company']['company_course'] );
	update_post_meta( $job_id, '_company_highgrade', $values['company']['company_highgrade'] );
	update_post_meta( $job_id, '_company_club', $values['company']['company_club'] );
	update_post_meta( $job_id, '_company_relation', $values['company']['company_relation'] );

	update_post_meta( $job_id, '_company_form', $values['company']['company_form'] );

/*
	$terms = get_term_by( 'name',$values['job']['job_location1'], 'area' );
	wp_set_post_terms( $job_id, $terms->term_id, 'area' );
	wp_set_post_terms( $job_id, $values['job']['conditions'], 'conditions' );
*/
}
add_action( 'job_manager_update_job_data', 'frontend_add_job_manager_job_listing_data_field_save', 10, 2 );

// 【管理者用】求人情報編集画面への項目出力
function custom_job_manager_job_listing_data_fields( $fields ) {
	$fields['_featured']['label'] = '注目の求人';
	$fields['_featured']['priority'] = 1;

	$fields['_filled']['label'] = '募集の終了';
	$fields['_filled']['description'] = '募集を終了すると、この求人に応募できなくなります。';
	$fields['_filled']['priority'] = 2;

	$fields['_job_image'] = array(
		'label' => 'イメージ画像',
		'type' => 'file',
		'required' => false,
		'polaceholder' => '',
		'priority' => 8,
	);

	$fields['_job_category']['label'] = '教科';
	$fields['_job_category']['type'] = 'term-select';
	$fields['_job_category']['placeholder'] = '教科を選択してください';
	$fields['_job_category']['priority'] = 11;

	$fields['_job_type']['type'] = 'term-select';
	$fields['_job_type']['placeholder'] = '雇用形態を選択してください';
	$fields['_job_type']['priority'] = 12;

	$fields['_job_location'] = array(
		'label' => '勤務地（都道府県）',
		'type' => 'text',
		'required' => true,
		'placeholder' => '',
		'priority' => 13
	);

//	$fields['_job_location']['type'] = 'none';

	$fields['_job_arrivalday'] = array(
		'label' => '着任時期',
		'type' => 'text',
		'required' => true,
		'placeholder' => '',
		'priority' => 16
	);

	$fields['_job_expires'] = array(
		'label' => '募集締切日',
		'type' => 'text',
		'required' => true,
		'placeholder' => '例：2017-01-01（年-月-日すべて半角英数字）',
		'priority' => 18
	);

	$fields['_job_noses'] = array(
		'label' => '募集人数',
		'type' => 'text',
		'required' => true,
		'placeholder' => '',
		'priority' => 20
	);

	$fields['_job_skill'] = array(
		'label' => '生かせる経験・スキル',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 30
	);

	$fields['_job_requirements'] = array(
		'label' => '応募資格',
		'type' => 'textarea',
		'required' => true,
		'placeholder' => '',
		'priority' => 32
	);

	$fields['_job_papers'] = array(
		'label' => '応募書類',
		'type' => 'textarea',
		'required' => true,
		'placeholder' => '',
		'priority' => 33
	);

	$fields['_job_method'] = array(
		'label' => '応募方法',
		'type' => 'textarea',
		'required' => true,
		'placeholder' => '',
		'priority' => 34
	);

	$fields['_job_recruit_info'] = array(
		'label' => '選考方法',
		'type' => 'textarea',
		'required' => true,
		'placeholder' => '',
		'priority' => 36,
	);

	$fields['_job_apptargets'] = array(
		'label' => '応募先',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 37,
	);
	$fields['_job_detail'] = array(
		'label' => '仕事内容',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 40,
	);

	$fields['_job_place'] = array(
		'label' => '勤務場所',
		'type' => 'textarea',
		'required' => true,
		'placeholder' => '',
		'priority' => 41,
	);

	$fields['_job_time'] = array(
		'label' => '勤務時間',
		'type'  => 'textarea',
		'required' => true,
		'placeholder' => '',
		'priority' => 44,
	);

	$fields['_job_holiday'] = array(
		'label' => '休日・休暇',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 45
	);

	$fields['_job_salary'] = array(
		'label' => '給与',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 46
	);

	$fields['_job_conditions'] = array(
		'label' => '待遇・福利厚生',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 48
	);

	$fields['_job_insurance'] = array(
		'label' => '社会保険',
		'type' => 'text',
		'required' => false,
		'placeholder' => '',
		'priority' => 50,
	);

	$fields['_job_charge'] = array(
		'label' => '採用担当者',
		'type' => 'text',
		'required' => false,
		'placeholder' => '',
		'priority' => 55
	);

	$fields['_application']['label'] = '応募先メールアドレス';
	$fields['_application']['priority'] = 56;

    //Company Detail
	$fields['_company_educational'] = array(
		'label' => '学校法人名',
		'type' => 'text',
		'required' => true,
		'placeholder' => '',
		'priority' => 70
	);

	$fields['_company_name'] = array(
		'label' => '学校名',
		'type' => 'text',
		'required' => true,
		'placeholder' => '',
		'priority' => 71
	);

	$fields['_company_type'] = array(
		'label' => '校種',
		'type' => 'text',
		'required' => true,
		'placeholder' => '',
		'priority' => 72
	);

    $fields['_company_birth'] = array(
		'label' => '創立年月日',
		'type' => 'text',
		'required' => false,
		'placeholder' => '',
		'priority' => 74
	);

/*	$fields['_company_logo'] = array(
		'label' => '学校イメージ画像',
		'type' => 'file',
		'required' => false,
		'polaceholder' => '',
		'priority' => 76,
	);*/

	$fields['_company_tagline'] = array(
		'label' => '学校の説明',
		'type' => 'textarea',
		'required' => false,
		'polaceholder' => '',
		'priority' => 77
	);

	$fields['_company_policy'] = array(
		'label' => '教育方針',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 78
	);

    $fields['_company_director'] = array(
		'label' => '理事長名',
		'type' => 'text',
		'required' => false,
		'placeholder' => '',
		'priority' => 80
	);

    $fields['_company_chief'] = array(
		'label' => '校長名',
		'type' => 'text',
		'required' => false,
		'placeholder' => '',
		'priority' => 81
	);

    $fields['_company_location'] = array(
		'label' => '所在地',
		'type' => 'textarea',
		'required' => true,
		'placeholder' => '',
		'priority' => 84
	);

    $fields['_company_phone'] = array(
		'label' => '電話番号',
		'type' => 'text',
		'required' => true,
		'placeholder' => '',
		'priority' => 86
	);

    $fields['_company_fax'] = array(
		'label' => 'FAX番号',
		'type' => 'text',
		'required' => true,
		'placeholder' => '',
		'priority' => 87
	);

    $fields['_company_contact'] = array(
		'label' => '代表メールアドレス',
		'type' => 'text',
		'required' => false,
		'placeholder' => 'aaa',
		'priority' => 88
	);

    $fields['_company_website']['label'] = 'ホームページ';
    $fields['_company_website']['priority'] = 90;

    $fields['_company_capital'] = array(
		'label' => '生徒数',
		'type' => 'text',
		'required' => false,
		'placeholder' => '',
		'priority' => 94
	);

    $fields['_company_employee'] = array(
		'label' => '教職員数',
		'type' => 'text',
		'required' => false,
		'placeholder' => '',
		'priority' => 95
	);

	$fields['_company_subject'] = array(
		'label' => '学科',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 100
	);

	$fields['_company_course'] = array(
		'label' => 'コース',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 101
	);

	$fields['_company_highgrade'] = array(
		'label' => '主な進学実績',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 104
	);

	$fields['_company_club'] = array(
		'label' => '主な部活動実績',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 105
	);

	$fields['_company_relation'] = array(
		'label' => '関連校',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 110
	);

//		unset( $fields['_job_location'] );
		unset( $fields['_company_video'] );
		unset( $fields['_company_twitter']);

		return $fields;
}
add_filter( 'job_manager_job_listing_data_fields', 'custom_job_manager_job_listing_data_fields' );

// https://wpjobmanager.com/document/tutorial-adding-a-salary-field-for-jobs/



// 追加項目表示用関数
function the_job_category( $post = null ) {
	if ( $job_category = get_the_job_category( $post ) ) {
		echo apply_filters( 'the_content', $job_category );
	}
}
function get_the_job_category( $post = null ) {
	$post = get_post( $post );
	if ( $post->post_type !== 'job_listing' ) {
		return;
	}

	$types = wp_get_post_terms( $post->ID, 'job_listing_category' );

	if ( $types ) {
		$type = current( $types );
	} else {
		$type = false;
		return;
	}

	return $type->name;
}
function get_the_job_categories( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ){
		return;
	}

	$types = wp_get_post_terms( $post->ID, 'job_listing_category', array('orderby' => 'order') );

	foreach( $types as $type ){
		$names[] = $type->name;
	}

	if($names){
		return $names;
	}else{
		return;
	}
}

function the_job_time( $post = null ) {
	if( $job_time = get_the_job_time( $post ) ) {
		echo apply_filters( 'the_content', $job_time );
	}
}
function get_the_job_time( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ) {
		return;
	}
	$times = get_post_meta( $post->ID, '_job_time', true );
	return $times;
}

function the_job_locations( $post = null ) {
	if( $job_location = get_the_job_locations( $post ) ) {
		echo apply_filters( 'the_content', $job_location );
	}
}
function get_the_job_locations( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ) {
		return;
	}
	$location = get_post_meta( $post->ID, '_job_location1', true ).get_post_meta( $post->ID, '_job_location2', true );
	return $location;
}
function the_job_location_list( $post = null ) {
	if( $job_location_list = get_the_job_location_list( $post ) ) {
		echo apply_filters( 'the_content', $job_location_list );
	}
}
function get_the_job_location_list( $pos = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ) {
		return;
	}
	$job_location_list = get_post_meta( $post->ID, '_job_location_list', true );
	return $job_location_list;
}
function the_job_salary( $post = null ) {
	$post = get_post( $post );
	if( $job_salary = get_the_job_salary( $post ) ) {
		echo apply_filters( 'the_content', $job_salary );
	}
}
function get_the_job_salary( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ) {
		return;
	}
	$salary = get_post_meta( $post->ID, '_job_salary', true );
	return $salary;
}
function the_job_conditions( $post = null ) {
	$post = get_post( $post );
	if( $job_conditions = get_the_job_conditions( $post ) ) {
		echo apply_filters( 'the_content', $job_conditions );
	}
}
function get_the_job_conditions( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ) {
		return;
	}
	$job_conditions = get_post_meta( $post->ID, '_job_conditions', true );
	return $job_conditions;
}
function the_job_holiday( $post = null ) {
	$post = get_post( $post );
	if( $job_holiday = get_the_job_holiday( $post ) ) {
		echo apply_filters( 'the_content', $job_holiday );
	}
}
function get_the_job_holiday( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ) {
		return;
	}
	$job_holiday = get_post_meta( $post->ID, '_job_holiday', true );
	return $job_holiday;
}
function the_job_requirements( $post = null ) {
	$post = get_post( $post );
	if( $job_requirements = get_the_job_requirements( $post ) ) {
		echo apply_filters( 'the_content', $job_requirements );
	}
}
function get_the_job_requirements( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ){
		return;
	}
	$job_requirements = get_post_meta( $post->ID, '_job_requirements', true );
	return $job_requirements;
}
function the_job_recruit_info( $post = null ) {
	$post = get_post( $post );
	if( $recruit_info = get_the_job_recruit_info( $post ) ) {
		echo apply_filters( 'the_content', $recruit_info );
	}
}
function get_the_job_recruit_info( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ) {
		return;
	}
	$recruit_info = get_post_meta( $post->ID, '_job_recruit_info', true );
	return $recruit_info;
}
function the_job_image( $post = null ) {
	$post = get_post( $post );
	if( $job_image = get_the_job_image_url( $post ) ) {
		echo '<img src="'.$job_image.'">';
	}
}
function get_the_job_image_url( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ) {
		return;
	}
	$job_image = get_post_meta( $post->ID, '_job_image', true );
	return $job_image;
}

function the_job_charge( $post = null ) {
	$post = get_post( $post );
	if( $job_charge = get_the_job_charge( $post ) ) {
		echo apply_filters( 'the_content', $job_charge );
	}
}
function get_the_job_charge( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ) {
		return;
	}
	$job_charge = get_post_meta( $post->ID, '_job_charge', true );
	return $job_charge;
}
function the_company_type( $post = null ) {
	$post = get_post( $post );
	if( $company_type = get_the_company_type( $post ) ) {
		echo apply_filters( 'the_content', $company_type );
	}
}
function get_the_company_type( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ) {
		return;
	}
	$company_type = get_post_meta( $post->ID, '_company_type', true );
	if($company_type == '') $company_type = '-';
	return $company_type;
}
function the_company_form( $post = null ) {
	$post = get_post( $post );
	if( $company_form = get_the_company_form( $post ) ) {
		echo apply_filters( 'the_content', $company_form );
	}
}
function get_the_company_form( $post = nyll ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ){
		return;
	}
	$company_form = get_post_meta( $post->ID, '_company_form', true );
	if($company_form == '') $company_form = '-';
	return $company_form;
}
function the_company_chief( $post = null ) {
	$post = get_post( $post );
	if( $company_chief = get_the_company_chief( $post ) ) {
		echo apply_filters( 'the_content', $company_chief );
	}
}
function get_the_company_chief( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ) {
		return;
	}
	$company_chief = get_post_meta( $post->ID, '_company_chief', true );
	if($company_chief == '') $company_chief = '-';
	return $company_chief;
}
function the_company_birth( $post = null ) {
	$post = get_post( $post );
	if( $company_birth = get_the_company_birth( $post ) ) {
		echo apply_filters( 'the_content', $company_birth );
	}
}
function get_the_company_birth( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing') {
		return;
	}
	$company_birth = get_post_meta( $post->ID, '_company_birth', true );
	if($company_birth == '') $company_birth = '-';
	return $company_birth;
}
function the_company_capital( $post = null ) {
	$post = get_post( $post );
	if( $company_capital = get_the_company_capital( $post ) ) {
		echo apply_filters( 'the_content', $company_capital );
	}
}
function get_the_company_capital( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ) {
		return;
	}
	$company_capital = get_post_meta( $post->ID, '_company_capital', true );
	if($company_capital == '') $company_capital = '-';
	return $company_capital;
}
function the_company_employee( $post = null ) {
	$post = get_post( $post );
	if( $company_employee = get_the_company_employee( $post ) ) {
		echo apply_filters( 'the_content', $company_employee );
	}
}
function get_the_company_employee( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ) {
		return;
	}
	$company_employee = get_post_meta( $post->ID, '_company_employee', true );
	if($company_employee == '') $company_employee = '-';
	return $company_employee;
}
function the_company_location( $post = null ) {
	$post = get_post( $post );
	if( $company_location = get_the_company_location( $post ) ) {
		echo apply_filters( 'the_content', $company_location );
	}
}
function get_the_company_location ( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ) {
		return;
	}
	$company_location = get_post_meta( $post->ID, '_company_location', true );
	return $company_location;
}
function the_company_contact( $post = null ) {
	$post = get_post( $post );
	if( $company_contact = get_the_company_contact( $post ) ) {
		echo apply_filters( 'the_content', $company_contact );
	}
}
function get_the_company_contact( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ) {
		return;
	}
	$company_contact = get_post_meta( $post->ID, '_company_contact', true );
	return $company_contact;
}

?>
