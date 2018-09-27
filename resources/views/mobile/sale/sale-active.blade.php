@extends('layouts.main')

@section('content')


    <div class="row">

            <div class="sale__title col-md-12">
                Sales
                <a href="{{'sale'}}"><div class="goback goback_sale"></div></a>
            </div>
            <div class="sales_tabs">
                <a href="{{route('sale-active')}}">
                    <div class="sales_tabs__active sales_selected">Active</div>
                </a>
                <a href="{{route('sale-close')}}">
                <div class="sales_tabs__closed">Closed</div>
                </a>
            </div>
        <div class="as__item-wr as__item-wr-active">
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
                <div class="tags_markup">
                    <span>Markup</span><br>
                    1.20
                </div>
                <div class="tags_average">
                    <span>Average markup</span><br>
                    0
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
        <div class="as__item-wr as__item-wr-active">
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
                <div class="tags_markup">
                    <span>Markup</span><br>
                    1.20
                </div>
                <div class="tags_average">
                    <span>Average markup</span><br>
                    0
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
        <div class="as__item-wr as__item-wr-active">
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
                <div class="tags_markup">
                    <span>Markup</span><br>
                    1.20
                </div>
                <div class="tags_average">
                    <span>Average markup</span><br>
                    0
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
        <div class="as__item-wr as__item-wr-active">
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
                <div class="tags_markup">
                    <span>Markup</span><br>
                    1.20
                </div>
                <div class="tags_average">
                    <span>Average markup</span><br>
                    0
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



            @include($_typeDevice.'.partial.footer-binds')

    </div>
@endsection

