<?php
add_image_size( 'logo', 240, 75);
add_image_size( 'logo_2x', 480, 150);
add_image_size( 'feature-banner', 1200, 480, true );

function cc_mime_types($mimes) {
 $mimes['svg'] = 'image/svg+xml';
 return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


?>