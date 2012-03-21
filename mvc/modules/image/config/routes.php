<?php

// Administration Routes.
$route['image/admin/gallery/([^/\d]+)'] = 'admin/$1_gallery';
$route['image/admin/gallery/([^/]+)/([^/]+)'] = 'admin/$1_gallery/$2';