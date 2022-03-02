<div id="newEventForm" class="row" style="display: none">
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
                <form id="newEventCreationForm">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter title"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="image">Event Image</label><br>
                        <input type="file" accept="image/*" name="image" id="image" style="display: none">
                        <button type="button" class="btn btn-info" id="imageTrigger"><i class="far fa-image mr-2"></i>Pick event image</button><br>
                        <span class="d-none" id="selectedImage"></span>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Date and time:</label>

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

                        <div class="col-3 d-none" id="statusSelector">
                            <div class="form-group">
                                <label for="exampleSelectRounded0">Publish status</label>
                                <select class="custom-select" id="exampleSelectRounded0" name="published">
                                    <option value="1">Published</option>
                                    <option value="0">Unpublished</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <textarea id="summernote" name="content" required></textarea>

                    <div class="d-flex justify-content-between" id="actionBtns">
                        <div>
                            <button type="submit" class="btn btn-info mr-2" id="saveEventPostBtn"><i
                                    class="fas fa-save mr-1"></i>Save & publish
                            </button>
                            <button type="button" class="btn btn-warning" id="saveEventPostDraftBtn"><i
                                    class="fas fa-file-alt mr-1"></i>Save as Draft
                            </button>
                        </div>

                        <button class="btn btn-danger btn-sm" type="button" id="cancelBtnBottom">
                            <i class="far fa-times-circle mr-1"></i>
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
