<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthDocs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.min.css') ?>">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
    </script>
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
            <a class="btn btn-success mr-3" id="askQuestion" href="<?= base_url('auth/must_signin') ?>">Ask Question</button>
            <a class="btn btn-danger mr-3" href="<?= base_url('auth/signin') ?>">Sign in</a>
            <a class="btn btn-secondary" href="<?= base_url('auth/signup') ?>">Sign up</a>
        </div>
    </nav>
