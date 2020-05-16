<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthDocs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.min.css') ?>">
    <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js"></script>
    <style>
        .btn-search:hover{
            background-color: #d9534f;
        }
        .nav-link{
            color: #292b2c !important;
        }
        .nav-link:hover{
            color: #d9534f !important;
        }
        .logo{
            margin-top: 150px;
        }
        a.custom-card,
        a.custom-card:hover {
            color: inherit;
            text-decoration: none;
        }
        .dropdown-item.active, .dropdown-item:active {
            color: black;
            background-color: #f9f9f9;
        }
    </style>
    <script>
        $(document).ready(function(){
            // Form Validation
            var forms = document.getElementsByClassName('clean-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                }, false);
            });

            var forms1 = document.getElementsByClassName('not-clean-validation');
            var validation1 = Array.prototype.filter.call(forms1, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        });
        
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('home/about_us') ?>">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('search/latest_questions') ?>">Latest Questions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('search/trending_questions') ?>">Trending Questions</a>
                </li>
            </ul>
            <button class="btn btn-success mr-3" data-toggle="modal" data-target="#askQuestionModal">Ask Question</button>
            <div class="dropdown">
                <a data-toggle="dropdown">
                    <img class="rounded-circle" src=<?= base_url('assets/img/').$this->session->userdata('profile_picture') ?> width="40" alt="profile_picture">
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="<?= base_url('account/settings') ?>">Account Settings</a>
                    <a class="dropdown-item" href="<?= base_url('account/my_question') ?>">My Question</a>
                    <?php if($this->session->userdata('role') == 'admin') { ?>
                        <a class="dropdown-item" href="<?= base_url('account/verification_request') ?>">Verification Request</a>
                    <?php } ?>
                    <a class="dropdown-item text-danger" href="<?= base_url('auth/signout') ?>">Sign out</a>
                </div>
            </div>
        </div>
    </nav>

<!-- Modal -->
<div class="modal" id="askQuestionModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ask Question</h5>
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="clean-validation" action="<?= base_url('question/create') ?>" method="post" novalidate>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control"  name="title" placeholder="Question Title" required></input>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="5" name="content" placeholder="Your Question" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Ask</button>
                </div>
            </form>
        </div>
    </div>
</div>
