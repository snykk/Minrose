<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>404 Error</title>
        <link href="<?= base_url("assets/css/style.css"); ?>" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="layoutError">
            <div id="layoutError_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="text-center mt-4">
                                    <img class="mb-4 img-error" src="<?= base_url("/assets/img/error/error-404.svg")?>" />
                                    <p class="lead">This requested URL was not found on this server.</p>
                                    <a href="<?= base_url("auth")?>">
                                        <i class="fas fa-arrow-left me-1"></i>
                                        Back to Page
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutError_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-center small">
                        Copyright &copy; Minrose <?= date('Y'); ?>
                    </div>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>
