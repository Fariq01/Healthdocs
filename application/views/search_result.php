    <div class="container-fluid">
        <div class="row justify-content-end">
            <div class="col-md-10">
                <p class="d-inline">Result for: <?= $search_question.' ('.$num_results.' results)' ?></p>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-2"></div>
            <div class="col-md-7">
                <?php foreach($results as $r) { ?>
                    <a href="<?= base_url('question/post/').$r['slug'] ?>" class="custom-card">
                        <div class="card mb-2">
                        <div class="card-body">
                            <h5 class="card-title"><?= $r['title'] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">@<?= $r['username'] ?></h6>
                            <p class="card-text"><?= $r['content'] ?></p>
                            <h7 class="card-subtitle text-muted"><i class="fas fa-eye"></i> <?= $r['views'].' - '.date("d-M-Y", strtotime($r['question_time_created'])) ?></h7>
                        </div>
                    </a>
                </div>
                <?php } ?>
                <?= $this->pagination->create_links() ?>
            </div>
            <div class="col-md-3">
            </div>
        </div>
    </div>
</body>
</html>