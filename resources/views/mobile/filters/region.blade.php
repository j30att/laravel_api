@extends('layouts.main')

@section('content')


    <div class="row">
        <div class="filter-region-wr col-md-12">
            <div class="region_title">
                Choose regions
                <a href="#"><div class="goback"></div></a>
            </div>
            <input type="search" placeholder="Search region">

            <div class="check-box check-box_location">
                <input type="checkbox" id="australia">
                <label for="australia">Australia</label>
            </div>
            <div class="check-box check-box_location">
                <input type="checkbox" id="bahamas">
                <label for="bahamas">Bahamas</label>
            </div>
            <div class="check-box check-box_location">
                <input type="checkbox" id="belarus">
                <label for="belarus">Belarus</label>
            </div>
            <div class="check-box check-box_location">
                <input type="checkbox" id="ireland">
                <label for="ireland">Ireland</label>
            </div>
            <div class="check-box check-box_location">
                <input type="checkbox" id="russia">
                <label for="russia">Russia</label>
            </div>
        </div>
    </div>
@endsection

