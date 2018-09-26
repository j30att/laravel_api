@extends('layouts.main')

@section('content')
    <div class="deskwr">
        <header class="header">
            <div class="logo">
                <img src="/images/desk/logo.png" alt="Logo">
            </div>
            <nav class="menu">
                <ul class="menu_list">
                    <li class="menu_item"><a href="#">Invest</a><div class="invest_count">2</div></li>
                    <li class="menu_item menu_item_active"><a href="#">Bids</a></li>
                    <li class="menu_item"><a href="#">Sale</a></li>
                    <li class="menu_item"><a href="#">Sale</a><span>$ 20,240.98</span></li>
                </ul>
            </nav>
            <div class="last_up">
                <div class="last_up__title">last updates</div>
                <div class="last_up__item">
                    <div class="last_up_marker"><img src="/images/desk/blue_circle.png" alt=""></div>
                    <div class="message">Your bid was accepted by Austin Vargas</div>

                </div>
                <div class="last_up__item">
                    <div class="last_up_marker"><img src="/images/desk/yellow_minus.png" alt=""></div>
                    <div class="message">Your bid was declined by Theodore Guerrero</div>

                </div>
                <div class="last_up__item">
                    <div class="last_up_marker"><img src="/images/desk/blue_circle.png" alt=""></div>
                    <div class="message">You sold 3% for Millions Russua (4% left)</div>

                </div>
                <div class="last_up__item">
                    <div class="last_up_marker"><img src="/images/desk/yellow_minus.png" alt=""></div>
                    <div class="message">New login attempt from a 73.223.92.66 (US)</div>

                </div>
            </div>
            <div class="profile_logout">
                <div class="profile_info">
                    <div class="pi_wr">
                        <div class="profile_img"><img src="/images/desk/players_img/profile_img_1.png" alt=""></div>
                        <div class="profile_name">James. Co</div>
                    </div>
                    <div class="logout"></div>
                </div>
            </div>
            <div class="heders_footer">
                <a href="#">Terms of Service</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Contact Us</a>
                <a href="#">English</a>
            </div>

        </header>
        <div class="main_content">
            <div class="bids_content_wr">
                <div class="bids_nav">
                    <ul class="bids_nav_list">
                        <li class="bids_nav_item"><a href="#">Matched</a></li>
                        <li class="bids_nav_item bids_nav_item_active"><a href="#">Unmatched</a></li>
                        <li class="bids_nav_item"><a href="#">Settled</a></li>
                        <li class="bids_nav_item"><a href="#">Canceled</a></li>
                    </ul>
                </div>
                <table class="bids_table">
                    <thead class="bids_table_head">
                        <td class="t_h_from">FROM</td>
                        <td>EVENT</td>
                        <td>buy in</td>
                        <td>GTE</td>
                        <td>Sale</td>
                        <td>BID</td>
                        <td>VALUE</td>
                        <td>T. until close</td>
                    </thead>
                    <tbody class="bids_table_body">

                    <tr>
                        <td class="t_from"><div class="t_from_img"><img src="/images/desk/players_img/profile_img_1.png" alt="profile photo"></div><span>Austin Vargas</span></td>
                        <td class="t_event">MILLIONS Russia, 1A</td>
                        <td class="t_buy_in">£1,000</td>
                        <td class="t_gte">£500,000</td>
                        <td class="t_sale">1.22</td>
                        <td class="t_bid">1.10</td>
                        <td class="t_value">$100</td>
                        <td class="t_close">2 days</td>
                    </tr>
                    <tr>
                        <td class="t_from"><div class="t_from_img"><img src="/images/desk/players_img/profile_img_1.png" alt="profile photo"></div><span>Theodore Guerrero</span></td>
                        <td class="t_event">Barrière Poker Tour</td>
                        <td class="t_buy_in">£5,000</td>
                        <td class="t_gte">£1,000,000</td>
                        <td class="t_sale">1.2</td>
                        <td class="t_bid">1.11</td>
                        <td class="t_value">$200</td>
                        <td class="t_close">10 days</td>
                    </tr>
                    <tr>
                        <td class="t_from"><div class="t_from_img"><img src="/images/desk/players_img/profile_img_3.png" alt="profile photo"></div><span>Mark Patterson</span></td>
                        <td class="t_event">WSOP International Circuit...</td>
                        <td class="t_buy_in">£1,000</td>
                        <td class="t_gte">£500,000</td>
                        <td class="t_sale">1.18</td>
                        <td class="t_bid">1.10</td>
                        <td class="t_value">$203</td>
                        <td class="t_close">10 days</td>
                    </tr>
                    <tr>
                        <td class="t_from"><div class="t_from_img"><img src="/images/desk/players_img/profile_img_4.png" alt="profile photo"></div><span>Theodore Curtis</span></td>
                        <td class="t_event">International Poker Cup</td>
                        <td class="t_buy_in">£5,000</td>
                        <td class="t_gte">£1,000,000</td>
                        <td class="t_sale">1.15</td>
                        <td class="t_bid">1.11</td>
                        <td class="t_value">$827</td>
                        <td class="t_close">11 days</td>
                    </tr>
                    <tr>
                        <td class="t_from"><div class="t_from_img"><img src="/images/desk/players_img/profile_img_5.png" alt="profile photo"></div><span>Mike Walters</span></td>
                        <td class="t_event">International Poker Cup</td>
                        <td class="t_buy_in">£5,000</td>
                        <td class="t_gte">£1,000,000</td>
                        <td class="t_sale">1.15</td>
                        <td class="t_bid">1.11</td>
                        <td class="t_value">$827</td>
                        <td class="t_close">14 days</td>
                    </tr>
                    <tr>
                        <td class="t_from"><div class="t_from_img"><img src="/images/desk/players_img/profile_img_6.png" alt="profile photo"></div><span>Joseph Padilla</span></td>
                        <td class="t_event">Barrière Poker Tour</td>
                        <td class="t_buy_in">£5,000</td>
                        <td class="t_gte">£1,000,000</td>
                        <td class="t_sale">1.15</td>
                        <td class="t_bid">1.11</td>
                        <td class="t_value">$827</td>
                        <td class="t_close">20 days</td>
                    </tr>
                    <tr>
                        <td class="t_from"><div class="t_from_img"><img src="/images/desk/players_img/profile_img_7.png" alt="profile photo"></div><span>Joe Ramos</span></td>
                        <td class="t_event">Barrière Poker Tour</td>
                        <td class="t_buy_in">£5,000</td>
                        <td class="t_gte">£1,000,000</td>
                        <td class="t_sale">1.15</td>
                        <td class="t_bid">1.11</td>
                        <td class="t_value">$827</td>
                        <td class="t_close">20 days</td>
                    </tr>
                    <tr>
                        <td class="t_from"><div class="t_from_img"><img src="/images/desk/players_img/profile_img_8.png" alt="profile photo"></div><span>Oscar Mendez</span></td>
                        <td class="t_event">Barrière Poker Tour</td>
                        <td class="t_buy_in">£5,000</td>
                        <td class="t_gte">£1,000,000</td>
                        <td class="t_sale">1.15</td>
                        <td class="t_bid">1.11</td>
                        <td class="t_value">$827</td>
                        <td class="t_close">20 days</td>
                    </tr>
                    <tr>
                        <td class="t_from"><div class="t_from_img"><img src="/images/desk/players_img/profile_img_9.png" alt="profile photo"></div><span>Noah Alexander</span></td>
                        <td class="t_event">MILLIONS Russia, 1A</td>
                        <td class="t_buy_in">£5,000</td>
                        <td class="t_gte">£1,000,000</td>
                        <td class="t_sale">1.15</td>
                        <td class="t_bid">1.11</td>
                        <td class="t_value">$827</td>
                        <td class="t_close">22 days</td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection



