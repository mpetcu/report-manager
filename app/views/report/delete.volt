<div class="modal fade" id="delModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel"><span class="glyphicon glyphicon-trash"></span> Are you sure you want to delete report?</h4>
            </div>
            {{ form(url('report/delete', ['id': report.getId()]), "method":"post", "autocomplete" : "off") }}
            <div class="modal-body">
                <div>
                    <i>Report:</i> <strong>{{ report.name }}</strong><br/>
                    <i>Database:</i> {{ report.getDb().name }}
                </div>
                <div class="sqlError">
                    <strong>Attention:</strong><br/>
                    Generated report data will also be deleted.<br/>
                    Operation can't be undone!
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" name="confirm" value="Yes, delete it" class="btn btn-danger pull-right" />
                <input type="button" value="No, keep it" data-dismiss="modal" class="btn btn-default pull-right btn-mrg-right" />
            </div>
            <script>
                $(function() {
                    $('#delModal').modal('show');
                });
            </script>
            </form>
        </div>
    </div>
</div>
