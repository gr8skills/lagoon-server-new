<div id="pageForm" class="row" style="display: none">
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
                <form id="pageCreationForm">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter page title" required>
                    </div>

                    <div class="form-group">
                        <label for="title">Page Banner:</label><br>
                        <input type="file"  id="image" style="display: none">
                        <button class="btn btn-info" id="imageSelectButton" type="button">
                            <i class="far fa-image mr-2"></i>Pick page image
                        </button><br/>
                        <span class="text-danger" id="selectedImageName">No image selected</span>
                    </div>

                    <div class="row">
                        <div class="col-3 d-none" id="statusSelector">
                            <div class="form-group">
                                <label for="exampleSelectRounded0">Publish status:</label>
                                <select class="custom-select" id="exampleSelectRounded0" name="published">
                                    <option value="1">Published</option>
                                    <option value="0">Unpublished</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <label for="summernote">Content</label>
                    <textarea id="summernote" name="content" required></textarea>

                    <div class="d-flex justify-content-between" id="actionBtns">
                        <div>
                            <button type="submit" class="btn btn-info mr-2" id="savePageBtn"><i class="fas fa-save mr-1"></i>Save & publish</button>
                            <button type="button" class="btn btn-warning" id="savePageDraftBtn"><i class="fas fa-file-alt mr-1"></i>Save as Draft</button>
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
