@if($category->status == 1)
    <a href="{{ url('admin/settings/fitnessgoals/status/'.$category->id.'/0') }}" onClick="javascript: return confirm('Are you sure want to inactivate this record?');">
        <i class="livicon" data-name="unlock" data-size="18" data-loop="true" data-c="#acf6ac" data-hc="#acf6ac" title="Go to inactive >>"></i>
    </a>
@else
    <a href="{{ url('admin/settings/fitnessgoals/status/'.$category->id.'/1') }}" onClick="javascript: return confirm('Are you sure want to activate this record?');">
        <i class="livicon" data-name="lock" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="Go to active >>"></i>
    </a>
@endif
