@extends('layouts.main')

@section('content')


    <div class="row">
        <div class="sale_main-wr col-md-12">
            <div class="logo_img">
                LOGO
                <img src="/" alt="">
            </div>
            <a href="{{route('new-sale')}}">
            <div class="creact_sale">
                Create a Sale
            </div>
            </a>
            <div class="tabs-wr__title sale_tabs__title">
                <div class="tabs-wr__title-name">Active Sales</div>
                <div class="see_all"><a href="#">See All</a></div>
            </div>
            <div class="active_sale-wr">

                <div class="active_sale">
                    <div class="as__item-wr">
                        <div class="as__item__text">
                            <div class="as__item__title">MILLIONS Russia, 1A</div>
                            <div class="as__item__by">Buy in $5,000 + $300</div>
                        </div>
                        <div class="as__item__tags">
                            <div class="tags_closes">
                                <span>Closes</span><br>
                                73 days
                            </div>
                            <div class="tags_markup">
                                <span>Markup</span><br>
                                1.20
                            </div>
                            <div class="tags_share">
                                <span>Share sold</span><br>
                                0% of 20%
                            </div>
                            <div class="tags_amount">
                                <span>Amount raised</span><br>
                                $400 of $1,000
                            </div>
                        </div>
                    </div>
                    <div class="as__item-wr">
                        <div class="as__item__text">
                            <div class="as__item__title">MILLIONS Russia, 1A</div>
                            <div class="as__item__by">Buy in $5,000 + $300</div>
                        </div>
                        <div class="as__item__tags">
                            <div class="tags_closes">
                                <span>Closes</span><br>
                                73 days
                            </div>
                            <div class="tags_markup">
                                <span>Markup</span><br>
                                1.20
                            </div>
                            <div class="tags_share">
                                <span>Share sold</span><br>
                                0% of 20%
                            </div>
                            <div class="tags_amount">
                                <span>Amount raised</span><br>
                                $400 of $1,000
                            </div>
                        </div>
                    </div>
                    <div class="as__item-wr">
                        <div class="as__item__text">
                            <div class="as__item__title">MILLIONS Russia, 1A</div>
                            <div class="as__item__by">Buy in $5,000 + $300</div>
                        </div>
                        <div class="as__item__tags">
                            <div class="tags_closes">
                                <span>Closes</span><br>
                                73 days
                            </div>
                            <div class="tags_markup">
                                <span>Markup</span><br>
                                1.20
                            </div>
                            <div class="tags_share">
                                <span>Share sold</span><br>
                                0% of 20%
                            </div>
                            <div class="tags_amount">
                                <span>Amount raised</span><br>
                                $400 of $1,000
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="tabs-wr__title sale_tabs__title">
                <div class="tabs-wr__title-name">Closed Sales</div>
                <div class="see_all"><a href="#">See All</a></div>
            </div>
            <div class="active_sale-wr active_sale-wr_close">

                <div class="active_sale">
                    <div class="as__item-wr">
                        <div class="as__item__text">
                            <div class="as__item__title">MILLIONS Russia, 1A</div>
                            <div class="as__item__by">Buy in $5,000 + $300</div>
                        </div>
                        <div class="as__item__tags">
                            <div class="tags_closes">
                                <span>Closes</span><br>
                                73 days
                            </div>
                            <div class="tags_markup">
                                <span>Markup</span><br>
                                1.20
                            </div>
                            <div class="tags_share">
                                <span>Share sold</span><br>
                                0% of 20%
                            </div>
                            <div class="tags_amount">
                                <span>Amount raised</span><br>
                                $400 of $1,000
                            </div>
                        </div>
                    </div>
                    <div class="as__item-wr">
                        <div class="as__item__text">
                            <div class="as__item__title">MILLIONS Russia, 1A</div>
                            <div class="as__item__by">Buy in $5,000 + $300</div>
                        </div>
                        <div class="as__item__tags">
                            <div class="tags_closes">
                                <span>Closes</span><br>
                                73 days
                            </div>
                            <div class="tags_markup">
                                <span>Markup</span><br>
                                1.20
                            </div>
                            <div class="tags_share">
                                <span>Share sold</span><br>
                                0% of 20%
                            </div>
                            <div class="tags_amount">
                                <span>Amount raised</span><br>
                                $400 of $1,000
                            </div>
                        </div>
                    </div>
                    <div class="as__item-wr">
                        <div class="as__item__text">
                            <div class="as__item__title">MILLIONS Russia, 1A</div>
                            <div class="as__item__by">Buy in $5,000 + $300</div>
                        </div>
                        <div class="as__item__tags">
                            <div class="tags_closes">
                                <span>Closes</span><br>
                                73 days
                            </div>
                            <div class="tags_markup">
                                <span>Markup</span><br>
                                1.20
                            </div>
                            <div class="tags_share">
                                <span>Share sold</span><br>
                                0% of 20%
                            </div>
                            <div class="tags_amount">
                                <span>Amount raised</span><br>
                                $400 of $1,000
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            @include('partial.footer-binds')
        </div>
    </div>
@endsection

