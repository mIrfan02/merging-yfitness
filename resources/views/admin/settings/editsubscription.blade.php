<!----Edit Icon----->
<i class="livicon" data-toggle="modal" data-target="#edit_category_{{ $record->id }}" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update category"></i>
<!----Edit Form----->
<div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="edit_category_{{ $record->id }}" role="dialog" 
    aria-labelledby="modalLabelfade" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form  action="{{ url('admin/settings/subscriptions/edit/'.$record->id) }}" method="POST" class="form-horizontal">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="modalLabelfade">Update Equipment</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="form-group {{ $errors->first('caption', 'has-error') }}">
                                <label for="caption" class="control-label">Title *</label>
                                <input type="text" name="title" value="{{ $record->title }}" class="form-control" placeholder="Enter Title">
                            </div>
                            <div class="form-group {{ $errors->first('video_url', 'has-error') }}">
                                <label for="video_url" class="control-label">Per Month Fee</label>
                                <input type="text" name="per_month_fee" value="{{ $record->per_month_fee }}" class="form-control" placeholder="10">
                            </div>
                            <div class="form-group {{ $errors->first('video_url', 'has-error') }}">
                                <label for="video_url" class="control-label">Total Fee</label>
                                <input type="text" name="total_fee" value="{{ $record->total_fee }}" class="form-control" placeholder="70">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn  btn-success" value="Update">
                    <button class="btn  btn-primary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>