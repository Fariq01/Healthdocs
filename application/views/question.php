<div class="container-fluid">
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
            <?php } else if ($this->session->flashdata('error_message') != null) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('error_message') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>
            <div class="card mb-2">
                <div class="card-header">Question</div>
                <div class="card-body">
                    <h5 class="card-title"><?= $question['title'] ?></h5>
                    <div class="d-flex flex-row">
                        <img class="rounded-circle" src="<?= base_url('assets/img/').$question['profile_picture'] ?>" width="48" alt="profile_picture">
                        <div class="mt-2 ml-2">
                                <h6 class="card-subtitle mb-2"><?= $question['first_name'].' '.$question['last_name'] ?></h6>
                                <h6 class="card-subtitle mb-2 text-muted">@<?= $question['username'] ?> <?php if($question['is_verified'] == 1) { ?><i class="fas fa-check-circle text-success"></i><?php } ?></h6>
                        </div>
                    </div>
                    <div class="d-flex flex-row">
                        <div style="width: 48px;"></div>
                        <p class="card-text mb-2 ml-2"><?= $question['content'] ?></p>
                    </div>
                    <div class="d-flex flex-row mt-2 mb-2 justify-content-end">
                        <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#answerModal">Answer</button>
                        <?php if($question['username'] == $this->session->userdata('username') || $this->session->userdata('role') == 'admin') { ?>
                            <button class="btn btn-success mr-2" data-toggle="modal" data-target="#editQuestionModal">Edit</button>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteQuestionModal">Delete</button>
                        <?php } ?>
                    </div>
                    <div class="text-right">
                        <?php if($question['question_time_edited'] == null) { ?>
                            <p class="card-subtitle text-muted">Asked at <?= date("d-M-Y", strtotime($question['question_time_created'])) ?></p>
                        <?php } else { ?>
                            <p class="card-subtitle text-muted">Edited at <?= date("d-M-Y", strtotime($question['question_time_edited'])) ?></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php if(in_array(1, array_column($answer, 'is_verified'))){ ?>
                <div class="card mb-2">
                    <div class="card-header">Verified Answer <i class="fas fa-check-circle text-success"></i></div>
                    <div class="card-body">
                        <?php foreach($answer as $va) { ?>
                            <?php if ($va['is_verified'] == 1) { ?>
                                <div class="border-bottom mb-2">
                                    <div class="d-flex flex-row">
                                        <img class="rounded-circle" src="<?= base_url('assets/img/').$va['profile_picture'] ?>" width="48" alt="profile_picture">
                                        <div class="mt-2 ml-2">
                                            <h6 class="card-subtitle mb-2"><?= $va['first_name'].' '. $va['last_name'] ?></h6>
                                            <h6 class="card-subtitle mb-2 text-muted">@<?= $va['username'] ?> <i class="fas fa-check-circle text-success"></i></h6>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row">
                                        <div style="width: 48px;"></div>
                                        <p class="card-text ml-2"><?= $va['content'] ?>.</p>
                                    </div>
                                    <div class="d-flex flex-row mt-2 mb-2 justify-content-end">
                                        <?php if($va['username'] == $this->session->userdata('username') || $this->session->userdata('role') == 'admin') { ?>
                                            <button class="btn btn-success mr-2" data-toggle="modal" data-target="#editAnswerModal" data-answer-id="<?= $va['answer_id'] ?>" data-content="<?= $va['content'] ?>">Edit</button>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteAnswerModal"  data-answer-id="<?= $va['answer_id'] ?>">Delete</button>
                                        <?php } ?>
                                    </div>
                                    <?php if($va['answer_time_edited'] == null) { ?>
                                        <p class="card-subtitle text-muted text-right mb-2">Answered at <?= date("d-M-Y", strtotime($va['answer_time_created'])) ?></p>
                                    <?php } else { ?>
                                        <p class="card-subtitle text-muted text-right mb-2">Edited at <?= date("d-M-Y", strtotime($va['answer_time_edited'])) ?></p>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <?php if(in_array(0, array_column($answer, 'is_verified'))){ ?>
                <div class="card mb-2">
                    <div class="card-header">User Answer</div>
                    <div class="card-body">
                        <?php foreach($answer as $ua) { ?>
                            <?php if($ua['is_verified'] == 0) { ?>
                                <div class="border-bottom mb-2">
                                    <div class="d-flex flex-row">
                                        <img class="rounded-circle" src="<?= base_url('assets/img/').$ua['profile_picture'] ?>" width="48" alt="profile_picture">
                                        <div class="mt-2 ml-2">
                                            <h6 class="card-subtitle mb-2"><?= $ua['first_name'].' '. $ua['last_name'] ?></h6>
                                            <h6 class="card-subtitle mb-2 text-muted">@<?= $ua['username'] ?></h6>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row">
                                        <div style="width: 48px;"></div>
                                        <p class="card-text ml-2"><?= $ua['content'] ?>.</p>
                                    </div>
                                    <div class="d-flex flex-row mt-2 mb-2 justify-content-end">
                                        <?php if($ua['username'] == $this->session->userdata('username') || $this->session->userdata('role') == 'admin') { ?>
                                            <button class="btn btn-success mr-2" data-toggle="modal" data-target="#editAnswerModal" data-answer-id="<?= $ua['answer_id'] ?>" data-content="<?= $ua['content'] ?>">Edit</button>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteAnswerModal" data-answer-id="<?= $ua['answer_id'] ?>">Delete</button>
                                        <?php } ?>
                                    </div>
                                    <?php if($ua['answer_time_edited'] == null) { ?>
                                        <p class="card-subtitle text-muted text-right mb-2">Answered at <?= date("d-M-Y", strtotime($ua['answer_time_created'])) ?></p>
                                    <?php } else { ?>
                                        <p class="card-subtitle text-muted text-right mb-2">Edited at <?= date("d-M-Y", strtotime($ua['answer_time_edited'])) ?></p>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="col-md-3">
        </div>
    </div>
    <div>
<!-- Modal -->
<div class="modal" id="editQuestionModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Question</h5>
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="clean-validation" action="<?= base_url('question/edit') ?>" method="post" novalidate>
                <div class="modal-body">
                    <input type="hidden" name="question_id" value="<?= $question['question_id'] ?>">
                    <div class="form-group">
                        <input type="text" class="form-control"  name="title" placeholder="Question Title" value="<?= $question['title'] ?>" required></input>
                    </div>
                    <div class="form-group">
                        <textarea id="editQuestionContent"class="form-control" rows="5" name="content" placeholder="Your Question" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="deleteQuestionModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Question</h5>
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('question/delete') ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="question_id" value="<?= $question['question_id'] ?>">
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
<div class="modal" id="answerModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Answer</h5>
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="clean-validation" action="<?= base_url('answer/create') ?>" method="post" novalidate>
                <div class="modal-body">
                    <input type="hidden" name="question_id" value="<?= $question['question_id'] ?>">
                    <div class="form-group">
                        <textarea id="editQuestionContent"class="form-control" rows="5" name="content" placeholder="Your Answer" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Answer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="editAnswerModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Answer</h5>
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="clean-validation" action="<?= base_url('answer/edit') ?>" method="post" novalidate>
                <div class="modal-body">
                <input type="hidden" name="question_id" value="<?= $question['question_id'] ?>">
                    <input type="hidden" id="editAnswerId" name="answer_id">
                    <div class="form-group">
                        <textarea id="editAnswerContent"class="form-control" rows="5" name="content" placeholder="Your Answer" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="deleteAnswerModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Answer</h5>
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('answer/delete') ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="question_id" value="<?= $question['question_id'] ?>">
                    <input type="hidden" id="deleteAnswerId" name="answer_id">
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
<script>
    document.getElementById("editQuestionContent").value = '<?= $question['content'] ?>';
    $(document).ready(function(){
        $('#deleteAnswerModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var answer_id = button.data('answer-id');
            $('#deleteAnswerId').val(answer_id);
        })
        $('#editAnswerModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var answer_id = button.data('answer-id');
            var content = button.data('content');
            $('#editAnswerId').val(answer_id);
            $('#editAnswerContent').val(content);
        })
    });
</script>
</body>
</html>
