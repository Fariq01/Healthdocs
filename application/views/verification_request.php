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
            <?php } else if ($this->session->flashdata('error_message') != null) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('error_message') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>
            <table id="dataTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Submited</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="col-md-3"></div>
    </div>
<div>
<div class="modal" id="seeDocumentModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Verification Document</h5>
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="documentVerification" style="height: 450px;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="acceptVerificationModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Accept Verification</h5>
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('account/accept_verification') ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" id="acceptVerificationId" name="verification_id">
                    <h6>Are you sure?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-success">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="declineVerificationModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Decline Verification</h5>
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('account/decline_verification') ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" id="declineVerificationId" name="verification_id">
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
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "ajax": "<?= base_url('account/json_verification_request') ?>",
            "columns" : [
                {"data": "username"},     
                {"data": "verification_time_submited"},
                {
                    "data": "verification_id",
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<button class="btn btn-secondary mr-3" data-toggle="modal" data-target="#seeDocumentModal" data-document="'+row.document+'">See Document</button>';
                            data += '<button class="btn btn-success mr-3" data-toggle="modal" data-target="#acceptVerificationModal" data-verification-id="'+row.verification_id+'">Accept</button>';
                            data += '<button class="btn btn-danger" data-toggle="modal" data-target="#declineVerificationModal" data-verification-id="'+row.verification_id+'">Decline</button>';
                        }
                        return data;
                    }
                }, 
            ]
        })
        $('#acceptVerificationModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var verification_id = button.data('verification-id');
            $('#acceptVerificationId').val(verification_id);
        })
        $('#declineVerificationModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var verification_id = button.data('verification-id');
            $('#declineVerificationId').val(verification_id);
        })
        $('#seeDocumentModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var document = button.data('document');
            PDFObject.embed("<?= base_url('assets/documents/') ?>"+document, "#documentVerification");
        })
    });
    
</script>
</body>
</html>
