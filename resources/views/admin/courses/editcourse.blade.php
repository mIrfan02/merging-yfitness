<!----Edit Icon----->
<i class="livicon" data-toggle="modal" data-target="#edit_{{ $course->id }}" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update category"></i>
<!----Edit Form----->
<div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="edit_{{ $course->id }}" role="dialog" 
    aria-labelledby="modalLabelfade" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form  action="{{ url('admin/courses/edit/'.$course->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="modalLabelfade">Update Course Category</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">

                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <!-- <div class="form-group {{ $errors->first('category', 'has-error') }}">
                                <label for="category" class="control-label">Category *</label>
                                {!! Form::select('category', \App\CourseCategory::selectbox(), null,['class' => 'form-control select2', 'id' => 'category']) !!}

                                    {!! $errors->first('category', '<span class="help-block">:message</span>') !!}
                            </div> -->
                            <div class="form-group {{ $errors->first('category', 'has-error') }}">
                                <label for="category" class="control-label">Parent Category *</label>
                                @if(isset($course->ParentCategories->parent_cat_id))
                                    {!! Form::select('parent_category', \App\FitnessGoals::selectbox(),$course->ParentCategories->parent_cat_id,['class' => 'form-control select2', 'id' => 'category']) !!}
                                @else
                                    {!! Form::select('parent_category', \App\FitnessGoals::selectbox(),null,['class' => 'form-control select2', 'id' => 'category']) !!}
                                @endif

                                    {!! $errors->first('category', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->first('category', 'has-error') }}">
                                <label for="category" class="control-label">Category *</label>
                                @if(isset($course->ParentCategories->cat_id))
                                    {!! Form::select('category', \App\CourseCategory::selectbox(), $course->CourseCategories->cat_id,['class' => 'form-control select2', 'id' => 'category']) !!}
                                @else
                                    {!! Form::select('category', \App\CourseCategory::selectbox(),null,['class' => 'form-control select2', 'id' => 'category']) !!}
                                @endif

                                    {!! $errors->first('category', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->first('category', 'has-error') }}">
                                <label for="category" class="control-label">Trainer *</label>
                                {!! Form::select('trainer_id', \App\User::trainerselectbox(), $course->trainer_id,['class' => 'form-control select2', 'id' => 'trainer_id']) !!}

                                    {!! $errors->first('trainer_id', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->first('institute_name', 'has-error') }}">
                                <label for="institute_name" class="control-label">Title *</label>
                                <input id="title" required name="title" type="text" value="{{ $course->title }}" 
                                           placeholder="Title" class="form-control required"
                                           value="{!! old('title') !!}"/>

                                    {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group">
                                <label for="description" class="control-label">Descripton <small>(brief intro) *</small></label>
                                <textarea name="description" placeholder="Enter Description" required id="description" class="form-control resize_vertical" rows="4" placeholder="Enter Description">{{ $course->description }}</textarea>
                                {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->first('address', 'has-error') }}">
                                <label class="control-label">Video MP4:</label>
                            </div>
                            <div class="form-group {{ $errors->first('pic', 'has-error') }}">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="max-width: 200px; max-height: 150px;">
                                        @if($course->video)
                                            <video width="200" height="150" controls>
                                                <source src="{{ url('/uploads/courses/'.$course->video) }}" type="video/mp4"> 
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
                            <div class="form-group {{ $errors->first('address', 'has-error') }}">
                                <label class="control-label">Avatar:</label>
                            </div>
                            <div class="form-group {{ $errors->first('pic', 'has-error') }}">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="max-width: 200px; max-height: 150px;">
                                        @if($course->image)
                                            <img src="{{ url('/uploads/courses/'.$course->image) }}" alt="img"
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
                            <div class="form-group {{ $errors->first('contact', 'has-error') }}">
                                <label for="contact" class="control-label">Days of Completion *</label>
                                <select class="form-control" name="dayscompletion">
                                    @for($x = 1; $x <= 30; $x++)
                                        <option @if($x == $course->daystocompletion) selected @endif value="{{ $x }}">{{ $x }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group {{ $errors->first('contact', 'has-error') }}">
                                <label for="contact" class="control-label">Weeks of Completion *</label>
                                <input type="number" name="total_weeks" placeholder="Enter number of week" value="{{ $course->total_weeks }}"  class="form-control" required>
                            </div>
                            <div class="form-group {{ $errors->first('contact', 'has-error') }}">
                                <label for="contact" class="control-label">Days of Week *</label>
                                <select class="form-control" name="week_a_days">
                                    @for($x = 1; $x <= 7; $x++)
                                        <option @if($x == $course->week_a_days) selected @endif value="{{ $x }}">{{ $x }}</option>
                                    @endfor
                                </select>
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