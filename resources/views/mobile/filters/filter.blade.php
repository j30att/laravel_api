@extends($_typeDevice.'.layouts.main')

@section('content')


    <div class="row">
        <div class="filter-wr">
            <div class="filter_title">
                Filter
                <div class="filter_close">X</div>
            </div>
        <div class="selects_filters col-md-12">
            <label>Event</label>
            <select name="event" id="">
                <option selected>All</option>
            </select>

            <label>Regions</label>
            <select name="event" id="">
                <option selected>Worldwide</option>
            </select>
        </div>
            <div class="button_filters col-md-12">
                <div class="filter__save">Save filter</div>
                <div class="filter__clear">Clear all</div>
            </div>
        </div>
    </div>
@endsection

