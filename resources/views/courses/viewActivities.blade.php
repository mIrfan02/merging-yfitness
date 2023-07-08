@php
    $activities = \App\CourseDayActivity::where('course_id',$course->id)->where('week',$x)->where('day',$y)->get();
    $x = 1;
@endphp
<a data-toggle="modal" class="btn btn-success" data-href="#responsive" href="#activities_{{ $x.$y }}">
    <span class="fa fa-eye"></span> View
</a>
<div class="modal fade in" id="activities_{{ $x.$y }}" tabindex="-1" role="dialog" aria-hidden="false">
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
                    <div class="col-md-7"><b>Detail</b></div>
                    <div class="col-md-2"><b>Image</b></div>
                </div>
            </div>
            <div class="modal-body">
                @if(count($activities))
                    @foreach($activities as $activity)
                        <div class="row">
                            <div class="col-md-1"><strong>{{ $x }}</strong></div>
                            <div class="col-md-1">{{ $activity->week }}</div>
                            <div class="col-md-1">{{ $activity->day }}</div>
                            <div class="col-md-7">{{ $activity->detail }}</div>
                            <div class="col-md-2">
                                @if($activity->image)
                                    <img src="{{ url('/uploads/courses/'.$activity->image) }}" width="50" class="img-thumbnail">
                                @endif
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