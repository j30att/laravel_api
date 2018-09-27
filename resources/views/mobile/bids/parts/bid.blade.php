<div class="binds-item"
     ng-class="{
     'binds-item__matched':bidsResponse.status === 1,
     'binds-item__unmatched':bidsResponse.status === 2,
     'binds-item__settled':bidsResponse.status === 3,
     'binds-item__canceled':bidsResponse.status === 4,
      }"
     ng-repeat="bidsResponse in FltrBdsRspnsCtrl.bids">

    <div class="binds-item-wr">
        <div class="binds-item__profile_info">
            <div class="profile__photo">
                <img src="/images/players.png" alt="">
            </div>
            <div class="profile_text">
                <div class="profile__name" ng-bind="bidsResponse.investor.name">

                </div>
                <div class="profile__country">
                    MILLIONS Russia, 1A
                </div>

            </div>

        </div>
        <div class="loop_counter">
            Second loop
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
                    <span>Markup</span>
                    1.20
                </div>
                <div class="game_atrs__value">
                    <span>Value</span>
                    £2,404.08
                </div>
                <div class="game_atrs__date_start">
                    <span>Date of Start</span><br>
                    1 Sep
                </div>
            </div>
        </div>
    </div>
</div>