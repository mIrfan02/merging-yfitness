<!----Edit Icon----->
<i class="livicon" data-toggle="modal" data-target="#edit_{{ $record->id }}" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update category"></i>
<!----Edit Form----->
<div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="edit_{{ $record->id }}" role="dialog" 
    aria-labelledby="modalLabelfade" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form  action="{{ url('admin/settings/tutrial/edit/'.$record->id) }}" enctype="multipart/form-data" method="POST" class="form-horizontal">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="modalLabelfade">Update Tutrial</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="form-group {{ $errors->first('caption', 'has-error') }}">
                                <label for="caption" class="control-label">Caption *</label>
                                <textarea required name="caption" class="form-control" placeholder="Enter Caption Here">{{ $record->caption }}</textarea>
                            </div>
                            <div class="form-group {{ $errors->first('video', 'has-error') }}">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="max-width: 200px; max-height: 150px;">
                                        @if($record->video_url)
                                            <video width="200" height="150" controls>
                                                <source src="{{ url('/uploads/courses/'.$record->video_url) }}" type="video/mp4"> 
                                                    Your browser does not support the video tag.
                                            </video>
                                        @else
                                            <img src="http://placehold.it/200x150" alt="..." class="img-responsive"/>
                                        @endif
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                    <div>
                                        <span class="btn btn-primary btn-file">
                                            <span class="fileinput-new">Select Video MP4</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="video" id="video" />
                                        </span>
                                        <span class="btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</span>
                                    </div>
                                </div>
                                <span class="help-block">{{ $errors->first('pic', ':message') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Thumbnail:</label>
                            </div>
                            <div class="form-group {{ $errors->first('pic', 'has-error') }}">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="max-width: 200px; max-height: 150px;">
                                        @if($record->thumbnail)
                                            <img src="{{ url($record->thumbnail) }}" alt="img"
                                                 class="img-responsive"/>
                                        @else
                                            <img src="http://placehold.it/200x150" alt="..." class="img-responsive"/>
                                        @endif
                                       
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                    <div>
                                        <span class="btn btn-primary btn-file">
                                            <span class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="pic" id="pic" />
                                        </span>
                                        <span class="btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</span>
                                    </div>
                                </div>
                                <span class="help-block">{{ $errors->first('pic', ':message') }}</span>
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