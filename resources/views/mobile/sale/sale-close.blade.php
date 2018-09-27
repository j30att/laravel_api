@extends('layouts.main')

@section('content')


    <div class="row">

            <div class="sale__title col-md-12">
                Sales
                <a href="{{'sale'}}"><div class="goback goback_sale"></div></a>
            </div>
            <div class="sales_tabs">
                <a href="{{route('sale-active')}}">
                    <div class="sales_tabs__active">Active</div>
                </a>
                <a href="{{route('sale-close')}}">
                    <div class="sales_tabs__closed sales_selected">Closed</div>
                </a>
            </div>
        <div class="as__item-wr as__item-wr-active as__item-wr-closed">
            <div class="as__item__text">
                <div class="as__item__title">MILLIONS Russia, 1A </div><a href="#">Edit</a>
                <div class="loop_counter loop_counter_sale">
                    Second loop
                </div>
                <div class="as__item__by">Buy in $5,000 + $300</div>
            </div>
            <div class="as__item__tags as__item__tags-active">
                <div class="tags_closes">
                    <span>Closes</span><br>
                    73 days
                </div>
                <div class="tags_share">
                    <span>Share sold</span><br>
                    0% of 20%
                </div>
                <div class="tags_amount">
                    <span>Amount raised</span><br>
                    $0
                </div>
                <div class="tags_outcome">
                    <span>Outcome</span><br>
                    + £395
                </div>



            </div>
        </div>
        <div class="as__item-wr as__item-wr-active as__item-wr-closed">
            <div class="as__item__text">
                <div class="as__item__title">MILLIONS Russia, 1A </div><a href="#">Edit</a>
                <div class="loop_counter loop_counter_sale">
                    Second loop
                </div>
                <div class="as__item__by">Buy in $5,000 + $300</div>
            </div>
            <div class="as__item__tags as__item__tags-active">
                <div class="tags_closes">
                    <span>Closes</span><br>
                    73 days
                </div>
                <div class="tags_share">
                    <span>Share sold</span><br>
                    0% of 20%
                </div>
                <div class="tags_amount">
                    <span>Amount raised</span><br>
                    $0
                </div>
                <div class="tags_outcome">
                    <span>Outcome</span><br>
                    + £395
                </div>



            </div>
        </div>
        <div class="as__item-wr as__item-wr-active as__item-wr-closed">
            <div class="as__item__text">
                <div class="as__item__title">MILLIONS Russia, 1A </div><a href="#">Edit</a>
                <div class="loop_counter loop_counter_sale">
                    Second loop
                </div>
                <div class="as__item__by">Buy in $5,000 + $300</div>
            </div>
            <div class="as__item__tags as__item__tags-active">
                <div class="tags_closes">
                    <span>Closes</span><br>
                    73 days
                </div>
                <div class="tags_share">
                    <span>Share sold</span><br>
                    0% of 20%
                </div>
                <div class="tags_amount">
                    <span>Amount raised</span><br>
                    $0
                </div>
                <div class="tags_outcome">
                    <span>Outcome</span><br>
                    + £395
                </div>



            </div>
        </div>
        <div class="as__item-wr as__item-wr-active as__item-wr-closed">
            <div class="as__item__text">
                <div class="as__item__title">MILLIONS Russia, 1A </div><a href="#">Edit</a>
                <div class="loop_counter loop_counter_sale">
                    Second loop
                </div>
                <div class="as__item__by">Buy in $5,000 + $300</div>
            </div>
            <div class="as__item__tags as__item__tags-active">
                <div class="tags_closes">
                    <span>Closes</span><br>
                    73 days
                </div>
                <div class="tags_share">
                    <span>Share sold</span><br>
                    0% of 20%
                </div>
                <div class="tags_amount">
                    <span>Amount raised</span><br>
                    $0
                </div>
                <div class="tags_outcome">
                    <span>Outcome</span><br>
                    + £395
                </div>



            </div>
        </div>




            @include($_typeDevice.'.partial.footer-binds')

    </div>
@endsection

