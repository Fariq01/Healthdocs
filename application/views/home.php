<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center logo">
                <a href="<?= base_url() ?>">
                    <img src="<?= site_url('assets/img/healthdocs_logo.png') ?>" class="img-fluid" alt="healthdocs_logo">
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 mt-3">
                <form class="clean-validation" action="<?= base_url('search') ?>" method="get" novalidate>
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" required>
                        <div class="input-group-append">
                            <button class="btn btn-secondary btn-search" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>