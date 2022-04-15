<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data["judul"];?></title>
    <?php
    if (isset($data["css"])) {
      echo '<link rel="stylesheet" href="' .  BASEURL . '/css/' .$data['css'] .'.css">';
    }
    if (isset($data["scss"])) {
      echo '<link rel="stylesheet" href="' .  BASEURL . '/scss/' .$data['scss'] .'.scss">';
    }
    ?>
</head>
<body>
