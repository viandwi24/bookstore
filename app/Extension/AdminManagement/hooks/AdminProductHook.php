<?php
// define
define('EXTENSION_NAME', 'AdminManagement');
define('EXTENSION_PRIORITY', 10);

// product_index - filter
$ext->addFilter('admin_product_index_list', function ($data) {
    return $data;
}, EXTENSION_PRIORITY);

// product_index - action
$ext->addAction('admin_product_create', function () {
    die('1234');
}, EXTENSION_PRIORITY);