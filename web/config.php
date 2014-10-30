<?php

require($_SERVER['DOCUMENT_ROOT'].'/credentials.php');
require($_SERVER['DOCUMENT_ROOT'].'/../vendor/autoload.php');
require($_SERVER['DOCUMENT_ROOT'].'/../src/up.php');


$up_auth = new UpAuth(UP_CLIENT_ID, UP_CLIENT_SECRET);

$up_auth_url = $up_auth->getAuthUrl(array(UpAuth::SCOPE_MOVE_READ), 'http://up/access/');

