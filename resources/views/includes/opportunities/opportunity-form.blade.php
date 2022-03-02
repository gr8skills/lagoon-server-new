<div id="opportunityForm" class="row" style="display: none">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="m-0">&nbsp;</h4>
                    <button class="btn btn-sm btn-danger" id="cancelBtn" type="button">
                        <i class="far fa-times-circle mr-1"></i>
                        Cancel
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form id="opportunityCreationForm">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter title"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="image">Image <span class="text-muted">(optional)</span></label><br>
                        <input type="file" accept="image/*" name="image" id="image" style="display: none">
                        <button type="button" class="btn btn-info" id="imageTrigger"><i class="far fa-image mr-2"></i>Pick
                            image
                        </button>
                        <br>
                        <span class="text-muted" id="selectedImage">No image selected</span>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="institution">Institution <span class="text-muted">(optional)</span></label>
                                <input type="text" id="institution" class="form-control" name="institution"/>

                            </div>
                        </div>

                        <div class="col-3" id="statusSelector">
                            <div class="form-group">
                                <label for="exampleSelectRounded0">Publish status</label>
                                <select class="custom-select" id="exampleSelectRounded0" name="published">
                                    <option value="1">Active</option>
                                    <option value="0" selected>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <textarea id="summernote" name="content" required></textarea>

                    <div class="d-flex justify-content-between" id="actionBtns">
                        <div>
                            <button type="submit" class="btn btn-info mr-2" id="saveButton"><i
                                    class="fas fa-save mr-1"></i>Save
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
