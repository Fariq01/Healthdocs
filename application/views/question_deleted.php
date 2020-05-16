
<div class='container-fluid'>
    <div class="row mt-2">
        <div class="col-md-2"></div>
        <div class="col-md-7">
            <?php if ($this->session->flashdata('success_message') != null) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('success_message') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>
            <div class="card mb-2">
                <div class="card-header">Question</div>
                <div class="card-body">
                    <h5 class="card-title">[deleted]</h5>
                    <div class="d-flex flex-row">
                        <img class="rounded-circle" src="<?= base_url('assets/img/default_profile_picture.png') ?>" width="48" alt="default_user_image">
                        <div class="mt-2 ml-2">
                                <h6 class="card-subtitle mb-2">[deleted]</h6>
                            <h6 class="card-subtitle mb-2 text-muted">@[deleted]</h6>
                        </div>
                    </div>
                    <div class="d-flex flex-row">
                        <div style="width: 48px;"></div>
                        <p class="card-text mb-2 ml-2">[deleted]</p>
                    </div>
                    <div class="text-right">
                    <p class="card-subtitle text-muted">Deleted at <?= date("d-M-Y") ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
        </div>
    </div>
<div>
</body>
</html>
