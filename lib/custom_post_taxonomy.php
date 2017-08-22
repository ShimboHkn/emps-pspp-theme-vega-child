<?php
/*
カスタム投稿タイプ・カスタムタクソノミー
*/

// 教科カスタムタクソノミー追加
function jobcategory_init() {
	register_taxonomy(
		'job_listing_category',
		'job_listing',
		array(
			'hierarchical' => true,
			'label' => __( '教科' ),
			'rewrite' => array( 'slug' => 'jobcategory' ),
		)
	);
}
add_action( 'init', 'jobcategory_init' );

// 雇用形態カスタムタクソノミーの表示名変更
function jobtype_init() {
	register_taxonomy(
		'job_listing_type',
		'job_listing',
		array(
			'hierarchical' => true,
			'label' => __( '雇用形態' ),
			'rewrite' => array( 'slug' => 'jobtype' ),
		)
	);
}
add_action( 'init', 'jobtype_init' );
/*
// 勤務地カスタムタクソノミーの追加
function jobarea_init() {
	register_taxonomy(
		'job_listing_area',
		'job_listing',
		array(
			'hierarchical' => true,
			'label' => __( '勤務地（都道府県）' ),
			'rewrite' => array( 'slug' => 'jobarea' ),
		)
	);
}
add_action( 'init', 'jobarea_init' );
*/
// 学校種別カスタムタクソノミーの追加
function jobclass_init() {
	register_taxonomy(
		'job_listing_class',
		'job_listing',
		array(
			'hierarchical' => true,
			'label' => __( '学校種別' ),
			'rewrite' => array( 'slug' => 'jobclass' ),
		)
	);
}
add_action( 'init', 'jobclass_init' );



?>