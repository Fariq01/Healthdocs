<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-7">
            <?php if ($this->session->flashdata('success_message') != null) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('success_message') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } else if ($this->session->flashdata('error_message') != null) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('error_message') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>
            <div class="card my-2">
                <div class="card-header">Account Settings</div>
                <div class="card-body">
                    <div class="form-group">
                        <?php if($this->session->userdata('is_verified') == 0){ ?>
                            <?php if($this->session->userdata('verification_status') == 'pending'){ ?>
                                <a data-toggle="modal" data-target="#pendingVerificationAccountModal">
                            <?php }else if($this->session->userdata('verification_status') == 'declined'){ ?>
                                <a data-toggle="modal" data-target="#declinedVerificationAccountModal">
                            <?php }else{ ?>
                                <a data-toggle="modal" data-target="#requestVerificationAccountModal">
                            <?php } ?>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="Non-Verified Account" disabled>
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary">Verify Now</button>
                                        </div>
                                    </div>
                                </a>
                        <?php }else{ ?>
                            <h5 class="text-success">Verified Account <i class="fas fa-check-circle"></i></h5>
                        <?php } ?>
                    </div>
                    <hr class="solid">
                    <label for="profile_picture">Profile picture</label>
                    <div class="mb-3 text-center">
                        <img class="rounded-circle" src="<?= base_url('assets/img/').$account['profile_picture'] ?>" width="150" alt="profile_picture">
                    </div>
                    <form class="clean-validation" action="<?= base_url('account/upload_profile') ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="hidden" name="username" value="<?= $account['username'] ?>">
                                <input type="file" class="custom-file-input" name="profile_picture" required>
                                <label class="custom-file-label" for="customFile">Profile Picture</label>
                            </div>
                            <div class="ml-3 input-group-append">
                                <button class="btn btn-secondary" type="submit">Change</button>
                            </div>
                        </div>
                    </form>
                    <hr class="solid">
                    <form class="not-clean-validation" action="<?= base_url('account/edit') ?>" method="post" novalidate>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="first_name">First name</label>
                                <input type="text" class="form-control" name="first_name" value="<?= $account['first_name'] ?>" required>
                                <div class="invalid-feedback">
                                    Please enter your first name!
                                </div>
                            </div><div class="form-group col-md-6">
                                <label for="last_name">Last name</label>
                                <input type="text" class="form-control" name="last_name" value="<?= $account['last_name'] ?>" required>
                                <div class="invalid-feedback">
                                    Please enter your last name!
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">@</div>
                                </div>
                                <input type="username" class="form-control" name="username" value="<?= $account['username'] ?>" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="<?= $account['email'] ?>" required>
                                <div class="invalid-feedback">
                                    Please enter your email!
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input id="input-password" type="password" class="form-control hide-password" name="password" required>
                                    <div class="input-group-append">
                                        <button id="btn-password" type="button" class="btn btn-outline-secondary"><i class="fas fa-eye"></i></button>
                                    </div>
                                    <div class="ml-3 input-group-append">
                                        <button class="btn btn-success  rounded-right" type="submit">Edit</button>
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter your password!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr class="solid">
                    <form class="not-clean-validation" action="<?= base_url('account/change_password') ?>" method="post" novalidate>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="password">Old password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control input-password hide-password" name="old_password" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-password btn-outline-secondary"><i class="fas fa-eye"></i></button>
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter your old password!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-7">
                                <label for="password">New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control input-password hide-password" name="new_password" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-password btn-outline-secondary"><i class="fas fa-eye"></i></button>
                                    </div>
                                    <div class="ml-3 input-group-append">
                                        <button class="btn btn-secondary  rounded-right" type="submit">Change Password</button>
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter your new password!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr class="solid">
                    <a data-toggle="modal" data-target="#deleteAccountModal">
                        <div class="input-group">
                            <input type="text" class="form-control" value="Delete Account" disabled>
                            <div class="input-group-append">
                                <button class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<div class="modal" id="deleteAccountModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Account</h5>
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('account/delete') ?>">
                <div class="modal-body">
                    <h6>Are you sure?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="requestVerificationAccountModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Account Verification</h5>
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="clean-validation" action="<?= base_url('account/upload_verification') ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate>
                <div class="modal-body">
                    <label for="verification_document">Upload your certificate (.pdf file)</label>
                    <input type="hidden" name="username" value="<?= $account['username'] ?>">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="verification_document" required>
                        <label class="custom-file-label" for="customFile">Document</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="pendingVerificationAccountModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pending Account Verification</h5>
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span class="text-success">Your verification request have been submited, please wait for 3x24 work hours!</span>   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="declinedVerificationAccountModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Declined  Account Verification</h5>
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="clean-validation" action="<?= base_url('account/upload_verification') ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate>
                <div class="modal-body">
                    <span class="text-danger">Sorry we can't accept your verification request, please try again!</span>
                    <hr class="solid">
                    <label for="verification_document">Upload your certificate (.pdf file)</label>
                    <input type="hidden" name="username" value="<?= $account['username'] ?>">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="verification_document" required>
                        <label class="custom-file-label" for="customFile">Document</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    // Show & Hide Password
    $(".btn-password").click(function(){
                if ($(".input-password").hasClass('hide-password')) {
                    $(".input-password").attr("type", "text");
                    $('.input-password').toggleClass('hide-password');
                    $('.btn-password i').toggleClass('fa-eye');
                    $('.btn-password i').toggleClass('fa-eye-slash');
                } else {
                    $(".input-password").attr("type", "password");
                    $('.input-password').toggleClass('hide-password');
                    $('.btn-password i').toggleClass('fa-eye-slash');
                    $('.btn-password i').toggleClass('fa-eye');
                }
            });
</script>
</body>
</html>