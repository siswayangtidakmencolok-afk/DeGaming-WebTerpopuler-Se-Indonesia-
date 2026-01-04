<?php
// router.php - Custom router untuk PHP built-in server

// === DEBUG ===
error_log("=== ROUTER DEBUG ===");
error_log("REQUEST_URI: " . $_SERVER['REQUEST_URI']);

$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request_uri = trim($request_uri, '/');

// Serve static files (CSS, JS, images)
if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js|ico|svg|woff|woff2|ttf)$/', $request_uri)) {
  return false;
}

// Parse route dari URL
if (!empty($request_uri)) {
  $_GET['x'] = $request_uri;
} else {
  $_GET['x'] = 'home';
}

// Load index.php
require_once 'index.php';