@extends($_typeDevice.'.layouts.main')

@section('content')


    <div class="row col-md-12">
       <div class="place_a_bit">
           <div class="place_a_bit__title">
               Place a bid
               <div class="pab__close">
                   X
               </div>
           </div>
           <div class="binds-item-wr">
               <div class="binds-item__profile_info">
                   <div class="profile__photo">
                       <img src="/images/pl_5.png" alt="">
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
                           20%</div>
                       <div class="game_atrs__date_start">
                           <span>Value</span><br>
                           1.20</div>
                   </div>
               </div>
           </div>
           <div class="highest_bids">
               <div class="highest_bids__title">
                   HIGHEST BIDS
               </div>
               <div class="block_1">
                   <input type="text" placeholder="1">
                   <input type="text" placeholder="1.53%">
                   <input type="text" placeholder="$1,182.22">
               </div>
               <div class="block_2">
                   <input type="text" placeholder="1.09" id="123">
                   <input type="text" placeholder="0.53%">
                   <input type="text" placeholder="$442">
               </div>
           </div>
           <div class="matched_bid">
               <div class="matched_bid__title">
                   MATCHED BID
               </div>
               <div class="block_1">
                   <input type="text" placeholder="1">
                   <input type="text" placeholder="1.53%">
                   <input type="text" placeholder="$1,182.22">
               </div>

           </div>
           <div class="add_bid">
               Add new bid
           </div>
       </div>
    
    </div>
@endsection

