<?php

include('config.php');

if (!file_exists('token.txt')) {
    ?>
    <a href="<?php echo $up_auth_url; ?>">Auth</a>

<?php
}


$token = file_get_contents('token.txt');

echo $token;


$up = new Up($token);

echo '<pre>';
print_r($up->getMoves());
echo '</pre>';