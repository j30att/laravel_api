@extends('layouts.main')

@section('content')


    <div class="row">
        <div class="filter-region-wr col-md-12">
            <div class="region_title">
                Choose event
                <a href="#"><div class="goback"></div></a>
            </div>
            <input type="search" placeholder="Search region">

            <div class="check-box check-box_location">
                <input type="checkbox" id="millions">
                <label for="millions">Millions</label>
            </div>
            <div class="check-box check-box_location">
                <input type="checkbox" id="eapt">
                <label for="eapt">EAPT</label>
            </div>
            <div class="check-box check-box_location">
                <input type="checkbox" id="grandPrix">
                <label for="grandPrix">Grand Prix</label>
            </div>
            <div class="check-box check-box_location">
                <input type="checkbox" id="anMill">
                <label for="anMill">Another millions</label>
            </div>
            <div class="check-box check-box_location">
                <input type="checkbox" id="other">
                <label for="other">Other</label>
            </div>
        </div>
    </div>
@endsection

