@extends('layouts.main')

@section('content')


    <div class="row">
        <div class="single__header">
            <div class="single__title">Millions Russia</div>
            <div class="single__date">3 - 14 Aug, 2018</div>
            <a href="{{route('all-events')}}">
                <div class="goback"></div>
            </a>
        </div>
        <div class="subevents_all-wr col-md-12">
            <div class="subevents_all">
                <div class="main_event subevent_item">Main event</div>
                @foreach($subevents as $subevent)
                <div class="subevent_item">{{$subevent->title}}</div>
                @endforeach
            </div>
        </div>
        <div class="main_event_info">
            <div class="fund_info">
                Buy in £1,000,000 • £500,000 GTE
            </div>
            <div class="date_info">
                3 - 14 Aug, 2018
            </div>
            <div class="location_info">
                Casino Sochi, Sochi, Russia
            </div>

        </div>
        <div class="single_page_players">
            <div class="single_page_players_item">

                <div class="binds-item-wr">
                    <div class="binds-item__profile_info">
                        <div class="profile__photo">
                            <img src="/images/pl_2.png" alt="">
                        </div>
                        <div class="profile_text">
                            <div class="profile__name">
                                Louise Romero
                            </div>
                            <div class="profile__country">
                                MILLIONS Russia, 1A
                            </div>

                        </div>

                    </div>

                    <div class="binds-item__game_info">
                        <div class="geme__text">
                            <div class="by_in">
                                Buy in £ <span>1,000,000</span>
                            </div>
                            <div class="gte">
                                £ <span>1,000,000</span> GTE
                            </div>
                        </div>
                        <div class="game_atrs">
                            <div class="game_atrs__markup">
                                <span>Markup</span><br>
                                1.20
                            </div>
                            <div class="game_atrs__value">
                                <span>Share</span><br>
                                20%
                            </div>
                            <div class="game_atrs__date_start">
                                <span>Time</span><br>
                                < 18 days
                            </div>
                        </div>
                    </div>
                </div>
                <div class="binds-item-wr">
                    <div class="binds-item__profile_info">
                        <div class="profile__photo">
                            <img src="/images/pl_3.png" alt="">
                        </div>
                        <div class="profile_text">
                            <div class="profile__name">
                                Adam McGee
                            </div>
                            <div class="profile__country">
                                MILLIONS Russia, 1A
                            </div>

                        </div>

                    </div>

                    <div class="binds-item__game_info">
                        <div class="geme__text">
                            <div class="by_in">
                                Buy in £ <span>1,000,000</span>
                            </div>
                            <div class="gte">
                                £ <span>1,000,000</span> GTE
                            </div>
                        </div>
                        <div class="game_atrs">
                            <div class="game_atrs__markup">
                                <span>Markup</span><br>
                                1.20
                            </div>
                            <div class="game_atrs__value">
                                <span>Share</span><br>
                                20%
                            </div>
                            <div class="game_atrs__date_start">
                                <span>Time</span><br>
                                < 18 days
                            </div>
                        </div>
                    </div>
                </div>
                <div class="binds-item-wr">
                    <div class="binds-item__profile_info">
                        <div class="profile__photo">
                            <img src="/images/pl_4.png" alt="">
                        </div>
                        <div class="profile_text">
                            <div class="profile__name">
                                Louise Romero
                            </div>
                            <div class="profile__country">
                                Hyper-Turbo Deep Stack
                            </div>

                        </div>

                    </div>

                    <div class="binds-item__game_info">
                        <div class="geme__text">
                            <div class="by_in">
                                Buy in £ <span>1,000,000</span>
                            </div>
                            <div class="gte">
                                £ <span>1,000,000</span> GTE
                            </div>
                        </div>
                        <div class="game_atrs">
                            <div class="game_atrs__markup">
                                <span>Markup</span><br>
                                1.20
                            </div>
                            <div class="game_atrs__value">
                                <span>Share</span><br>
                                20%
                            </div>
                            <div class="game_atrs__date_start">
                                <span>Time</span><br>
                                < 18 days
                            </div>
                        </div>
                    </div>
                </div>
                <div class="binds-item-wr">
                    <div class="binds-item__profile_info">
                        <div class="profile__photo">
                            <img src="/images/pl_2.png" alt="">
                        </div>
                        <div class="profile_text">
                            <div class="profile__name">
                                Louise Romero
                            </div>
                            <div class="profile__country">
                                MILLIONS Russia, 1A
                            </div>

                        </div>

                    </div>

                    <div class="binds-item__game_info">
                        <div class="geme__text">
                            <div class="by_in">
                                Buy in £ <span>1,000,000</span>
                            </div>
                            <div class="gte">
                                £ <span>1,000,000</span> GTE
                            </div>
                        </div>
                        <div class="game_atrs">
                            <div class="game_atrs__markup">
                                <span>Markup</span><br>
                                1.20
                            </div>
                            <div class="game_atrs__value">
                                <span>Share</span><br>
                                20%
                            </div>
                            <div class="game_atrs__date_start">
                                <span>Time</span><br>
                                < 18 days
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>


        @include('partial.footer-binds')

    </div>

    </div>
@endsection

