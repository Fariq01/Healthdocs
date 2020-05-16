<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthDocs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= site_url('assets/fontawesome/css/all.min.css') ?>">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="border rounded p-3" style="width: 300px">
        <form class="signin-validation" action="<?= site_url('auth/signin') ?>" method="post" novalidate> 
            <div class="text-center mb-3">
                <a href="<?= base_url() ?>">
                    <img width="200px"  class="img-fluid" src="<?= site_url('assets/img/healthdocs_logo.png') ?>"  alt="healthdocs_logo">
                </a>
                <h4>Sign in</h4>
            </div>
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
            <div class="form-group">
                <label for="username">Username</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">@</div>
                    </div>
                    <input type="text" class="form-control" name="username" required>
                    <div class="invalid-feedback">
                        Please enter your username!
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <input id="input-password" type="password" class="form-control hide-password" name="password" required>
                    <div class="input-group-append">
                        <button id="btn-password" type="button" class="btn btn-outline-secondary rounded-right"><i class="fas fa-eye"></i></button>
                    </div>
                    <div class="invalid-feedback">
                        Please enter your password!
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-danger">Sign in</button>
                <a class="btn btn-secondary" href="<?= base_url('auth/signup') ?>">Sign up</a>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function(){
            // Form Validation
            var forms = document.getElementsByClassName('signin-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });

            // Show & Hide Password
            $("#btn-password").click(function(){
                if ($("#input-password").hasClass('hide-password')) {
                    $("#input-password").attr("type", "text");
                    $('#input-password').toggleClass('hide-password');
                    $('#btn-password i').toggleClass('fa-eye');
                    $('#btn-password i').toggleClass('fa-eye-slash');
                } else {
                    $("#input-password").attr("type", "password");
                    $('#input-password').toggleClass('hide-password');
                    $('#btn-password i').toggleClass('fa-eye-slash');
                    $('#btn-password i').toggleClass('fa-eye');
                }
            });
        });
    </script>
</body>
</html>
