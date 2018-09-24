@extends('layouts.main')

@section('content')


    <div class="row">
        <div class="selected_event">
            <a href="{{route('events')}}">
            <div class="goback gb_white"></div>
            </a>
            <div class="open_event"></div>
            <img src="/images/select_event_bg.png" alt="">
        </div>
                <div class="all_events-wr col-md-12">
                    <div class="selected_event_info event_item">
                        <span><a href="{{'single-events'}}">See info</a></span>
                        <div class="event-item__title">Millions Russia</div>
                        <div class="event-item__summa">£1,000,000 GTD</div>
                        <div class="event-item__date">3 - 14 Aug, 2018</div>

                    </div>

                    <div class="event_main-wr">
                        <span>Events List</span>

                        @foreach($eventList as $event)
                            @include('events.parts.event-list', ['event' => $event])
                        @endforeach
                    </div>
                </div>




                <div class="footer_binds">
                    <div class="footer_binds__item item_invest"><div class="footer_binds__img"><img src="/images/g@3x_INVEST.png" alt=""></div>invest</div>
                    <div class="footer_binds__item item_invest_bids"><div class="footer_binds__img"><img src="/images/b@3x_BIDS.png" alt=""></div>bids</div>
                    <div class="footer_binds__item item_invest_sale"><div class="footer_binds__img"><img src="/images/g_2@3x_SALE.png" alt=""></div>sale</div>
                    <div class="footer_binds__item item_invest_wallet"><div class="footer_binds__img"><img src="/images/g_3@3x_WALLET.png" alt=""></div>wallet</div>
                </div>
            </div>

        </div>
@endsection

