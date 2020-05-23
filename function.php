<?php 
function my_handle_attachment($file_handler,$post_id,$set_thu=false) {
  if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

  require_once(ABSPATH . "wp-admin" . '/includes/image.php');
  require_once(ABSPATH . "wp-admin" . '/includes/file.php');
  require_once(ABSPATH . "wp-admin" . '/includes/media.php');

  $attach_id = media_handle_upload( $file_handler, $post_id );

  if ( is_numeric( $attach_id ) ) {

    update_post_meta( $post_id, '_product_image_gallery', $attach_id );

  }
  return $attach_id;  
}
?>