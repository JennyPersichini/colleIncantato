<?php

require_once __DIR__ . '/helpers/auth.php';

requireLogin();

$user = currentUser();

include 'header.php';

?>
