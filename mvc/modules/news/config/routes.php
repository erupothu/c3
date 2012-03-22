<?php

$route['news'] = 'news';
$route['news/category/([^/]+)'] = 'news/category/$1';
$route['news/([^/]+|(^category))'] = 'news/view/$1';