<?php

require('../config.php');

if ($_GET['code']) {


    $token = $up_auth->getAccessToken($_GET['code']);

    file_put_contents('../token.txt', $token);


}



