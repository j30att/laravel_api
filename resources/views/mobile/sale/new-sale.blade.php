@extends('layouts.main')

@section('content')


    <div class="row">
        <div class="sale col-md-12">
            <div class="sale__title">
                Create new sale
                <a href="{{'sale'}}"><div class="goback goback_sale"></div></a>
            </div>
            <div class="events_and_by">
                <div class="events_and_by__title">
                    Event and buy-in
                </div>
                <label>Event</label>
                <select name="event" id="">
                    <option selected>Choose an event</option>
                </select>

                <label>Flight</label>
                <select name="flight" id="">
                    <option selected>Choose an flight</option>
                </select>

                <label>Buy-in</label>
                <input type="text" placeholder="Will be display after selection of flight">
                <div class="offer">
                    <div class="offer__title">Offer</div>
                    <div class="offer-wr">
                        <div>
                            <label >Share</label>
                            <input type="text" placeholder="0">
                        </div>
                        <div>
                            <label >Markup</label>
                            <input type="text" placeholder="1.0">
                        </div>
                        <div>
                            <label >Amount $</label>
                            <input type="text" placeholder="0">
                        </div>
                    </div>




                    <div class="creact_sale">
                        Create a Sale
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

