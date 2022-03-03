<div class="modal fade" id="deleteModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title">Delete <span id="modalTitle"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-times-circle error-icon"></i>
                </div>
                <div class="d-flex flex-column align-items-center py-2" style="font-size: 1.2rem">
                    Are you sure you want to delete <span id="modalPrompt"></span>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times mr-1"></i>Close</button>
                <button type="button" class="btn btn-danger" id="modalDeleteBtn"><i class="fas fa-check mr-1"></i>Ok</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
