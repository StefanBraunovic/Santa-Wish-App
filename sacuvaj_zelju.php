<?php
require('./validation.php');
$greske = validation();

$new_folder = './zelje_db';
if (count($greske) === 0) {

    $new_file = $new_folder . '/' . uniqid() . '.txt';
    $h = fopen($new_file, 'w');
    fwrite($h, json_encode(create_wish($_POST)));
    fclose($h);

    header('Location: ./zelja_poslata.html');
    exit();
} else {
    echo json_encode($_POST);
    header(
        'Location: ./index.html'
            . '?query=' . json_encode($_POST)
            . '&errors=' . json_encode($greske)
    );
}
