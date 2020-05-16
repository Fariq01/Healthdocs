<div class='container-fluid'>
    <div class="row mt-2">
        <div class="col-md-2"></div>
        <div class="col-md-7">
            <table id="dataTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Views</th>
                        <th>Created</th>
                        <th>Edited</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="col-md-3"></div>
    </div>
<div>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "ajax": "<?= base_url('account/json_my_question') ?>",
            "columns" : [
                {"data": "title"},     
                {"data": "views"},
                {"data": "question_time_created"},
                {"data": "question_time_edited"},
                {
                    "data": "slug",
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<a class="btn btn-danger" href="http://localhost/healthdocs/question/post/' + data + '">See Question</button>';
                        }
                        return data;
                    }
                }, 
            ]
        })
    } );
</script>
</body>
</html>
