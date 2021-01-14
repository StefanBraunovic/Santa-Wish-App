<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sve zelje</title>
    <link rel="stylesheet" href="./css/style.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <div class="container  table mt-3 " id="tabela">
        <h1>Sve Zelje </h1>
        <table class="table table-danger ">
            <thead>
                <tr>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Grad</th>
                    <th>Zelja</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $wishes = './zelje_db';

                if (!is_dir($wishes) || count(scandir($wishes)) === 2) {
                    echo '<h2 >Nema poslatih zelja</h2>';
                    exit();
                }

                $wishes_arr = scandir($wishes);
                foreach ($wishes_arr as $wish_url) {
                    if ($wish_url === '.' || $wish_url === '..') {
                        continue;
                    }

                    $filename = $wishes . '/' . $wish_url;
                    $o = fopen($filename, 'r');
                    $json_entry = fgets($o);
                    fclose($o);

                    $wish = json_decode($json_entry, true);
                    echo '<tr>';
                    foreach ($wish as $w) {
                        echo '<td scope="row">' . $w . '</td>';
                    }
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"></script>

</html>