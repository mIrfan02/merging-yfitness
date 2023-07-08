@php
    $x = 1;
@endphp
<a data-toggle="modal" data-href="#responsive" href="#activities_{{ $course->id }}">
    <span class="fa fa-eye"></span> View
</a>
<div class="modal fade in" id="activities_{{ $course->id }}" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Activities</h4>
            </div>
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-1">Sr No#</div>
                    <div class="col-md-1"><b>Week</b></div>
                    <div class="col-md-1"><b>Day</b></div>
                    <div class="col-md-6"><b>Detail</b></div>
                    <div class="col-md-2"><b>Image</b></div>
                    <div class="col-md-1"><b>Actions</b></div>
                </div>
            </div>
            <div class="modal-body">
                @if(count($course->DayActivity))
                    @foreach($course->DayActivity as $activity)
                        <div class="row">
                            <div class="col-md-1"><strong>{{ $x }}</strong></div>
                            <div class="col-md-1">{{ $activity->week }}</div>
                            <div class="col-md-1">{{ $activity->day }}</div>
                            <div class="col-md-6">{{ $activity->detail }}</div>
                            <div class="col-md-2">
                                @if($activity->image)
                                    <img src="{{ url('/uploads/courses/'.$activity->image) }}" width="50" class="img-thumbnail">
                                @endif
                            </div>
                            <div class="col-md-1">
                                <a href="#editActivity{{ $activity->id }}" data-toggle="modal"><i class="fa fa-edit"></i></a>
                                <!-- Modal -->
                                <div class="modal fade" id="editActivity{{ $activity->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Activity - {{ $activity->id }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <form action="{{ route('admin.course.dayactivity.update', $activity->id) }}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Week</label>
                                                        <input type="number" name="week" class="form-control" value="{{ $activity->week }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Day</label>
                                                        <input type="number" name="day" class="form-control" value="{{ $activity->day }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Image</label>
                                                        <input type="file" name="image" class="form-control">
                                                        <img src="{{ asset('uploads/courses/'.$activity->image) }}" width="80">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Detail</label>
                                                        <input type="text" name="detail" class="form-control" value="{{ $activity->detail }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                        @php
                            $x++;
                        @endphp
                    @endforeach
                @else
                    <div class="row">
                        <div class="col-md-12"><h3>Activity Not Found</h3></div>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
            </div>
        </div>
    </div>
</div>