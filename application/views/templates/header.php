<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="author" content="Minrose" />
  <meta name="description" content="header page" />
  <title><?= $title; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
  <!-- new datatables -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
  <link href="<?= base_url('assets/') ?>css/style.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  <?php

  if (isset($css)) {
    echo '<link href="' . base_url('assets/css/') . $css . '.css" rel="stylesheet" />';
  }
  if (isset($scss)) {
    echo '<link href="' . base_url('assets/scss/') . $scss . '.scss" rel="stylesheet" />';
  }
  if (isset($less)) {
    echo '<link href="' . base_url('assets/less/') . $less . '.less" rel="stylesheet" />';
  }

  ?>
</head>

<body class="sb-nav-fixed">