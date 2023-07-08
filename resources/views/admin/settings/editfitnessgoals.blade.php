<!----Edit Icon----->
<i class="livicon" data-toggle="modal" data-target="#edit_category_{{ $category->id }}" data-name="edit" data-size="18"
    data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update category"></i>

<!----Edit Form----->
<div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="edit_category_{{ $category->id }}" role="dialog"
    aria-labelledby="modalLabelfade" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ url('admin/settings/fitnessgoals/edit/' . $category->id) }}" method="POST"
                enctype="multipart/form-data" class="form-horizontal">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="modalLabelfade">Update Fitness Category</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="form-group {{ $errors->first('institute_name', 'has-error') }}">
                                <label for="institute_name" class="control-label">Category Name *</label>
                                <div>
                                    <input id="title" required name="title" type="text" placeholder="Name"
                                        class="form-control required" value="{{ $category->name }}" />

                                    {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image" class="control-label">Image</label>
                                <div>
                                    <img id="category_image_{{ $category->id }}" src="{{ asset($category->img) }}"
                                        alt="Fitness Goal Image" style="max-width: 200px;">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="new_image" class="control-label">Update Image</label>
                                <div>
                                    <input type="file" name="new_image" id="new_image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <input type="submit" class="btn btn-success" value="Update">
                    <button class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function updateImage(categoryId) {
        const newImageInput = document.getElementById('new_image');
        const categoryImage = document.getElementById('category_image_' + categoryId);

        if (newImageInput.files && newImageInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                categoryImage.src = e.target.result;
            };

            reader.readAsDataURL(newImageInput.files[0]);
        }
    }
</script>
