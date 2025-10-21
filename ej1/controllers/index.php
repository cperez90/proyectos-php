<?php

$_SESSION['name'] = 'Ale';

view("index.view.php", [
    'heading' => 'Home'
]);