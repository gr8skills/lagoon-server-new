<div id="announcementForm" class="row" style="display: none">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="m-0">&nbsp;</h4>
                    <button class="btn btn-sm btn-danger" id="cancelBtn">
                        <i class="far fa-times-circle mr-1"></i>
                        Cancel
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form id="announcementCreationForm">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" required>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="priority">Priority</label>
                                <select class="custom-select" id="priority" name="priority">
                                    <option value="2">Normal</option>
                                    <option value="1">Urgent</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="date">Deadline:</label>

                                <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                    <input type="text" id="date" class="form-control datetimepicker-input" name="date"
                                           data-target="#reservationdatetime" required/>
                                    <div class="input-group-append" data-target="#reservationdatetime"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <label for="summernote">Content</label>
                    <textarea id="summernote" name="content" required></textarea>

                    <div class="d-flex justify-content-between" id="actionBtns">
                        <div>
                            <button type="submit" class="btn btn-info mr-2" id="saveAnnouncementPostBtn"><i class="fas fa-save mr-1"></i>Save</button>
                        </div>

                        <button class="btn btn-danger btn-sm" id="cancelBtnBottom">
                            <i class="far fa-times-circle mr-1"></i>
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
