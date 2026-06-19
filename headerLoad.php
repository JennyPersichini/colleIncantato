<?php

require_once __DIR__ . '/helpers/auth.php';

startSession();

if (currentUser()) {

    include 'headerUtente.php';

} else {

    include 'header.php';

}