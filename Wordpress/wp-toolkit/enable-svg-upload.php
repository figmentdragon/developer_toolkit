<?php

if (!function_exists('mime_types')) {
  function mime_types($mimes)
  {
    $mimes['svg'] = 'image/svg+xml';

    return $mimes;
  }
}
add_filter('upload_mimes', 'mime_types', 99, 1);
