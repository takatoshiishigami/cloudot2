<?php


/* 
 * AutoPagerizeの無効化
 */

function remove_hentry( $classes ) {
  $classes = array_diff($classes, array('hentry'));
  return $classes;
}
add_filter('post_class', 'remove_hentry');

/*
 * カスタム投稿タイプの設定
 */

add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'updates', /* post-type */
		array(
			'labels' => array(
			'name' => __( 'お知らせ' ),
			'singular_name' => __( 'お知らせ' )
		),
		'public' => true,
		'menu_position' =>5,
    'has_archive' => true,
    'rewrite' => array('slug' => 'お知らせ'),
    'supports' => array('title','editor','thumbnail',
                        'excerpt','author','revisions')
    )
	);
  register_taxonomy(
      'update-type', /* タクソノミーの名前 */
      'updates', /* books投稿で設定する */
      array(
        'hierarchical' => false, /* 親子関係が必要なければ false */
        'update_count_callback' => '_update_post_term_count',
        'label' => 'お知らせの種類',
        'singular_label' => 'お知らせの種類',
        'public' => true,
        'show_ui' => true
      )
  );
}


?>