<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 mb-2 text-center">
            <a href="<?= base_url() ?>">
                <img width="200px"  src="<?= site_url('assets/img/healthdocs_logo.png') ?>"  alt="healthdocs_logo">
            </a>
        </div>
        <div class="col-md-7">
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