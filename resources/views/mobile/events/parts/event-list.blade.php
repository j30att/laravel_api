

<div class="selected_event_info event_item">

    <div class="event_list-wr" ng-click="EvntsLstCtrl.openDetail({{$event->id}})">


        <div class="event-item__title">{{$event->title}}</div>
        <div class="event-item__summa">£{{$event->fund}} GTD</div>
        <div class="event-item__date">{{$event->formatted_data}}</div>
    </div>
    <a href="{{route('event', ['id'=>$event->id])}}">
        <div class="see_more"></div>
    </a>

</div>
<div ng-if="EvntsLstCtrl.showDetail({{$event->id}})">
    <span><a href="{{route('event', ['id'=>$event->id])}}">See info</a></span>

    ХУУУУУУУУУУУУУУУУУУУУУУУУУУУУУУУУУУУУУУУУУУУУУУУУУУУУУЙ
    {{--

    <div class="event-item__summa">£1,000,000 GTD</div>
    <div class="event-item__date">3 - 14 Aug, 2018</div>
--}}

    <div class="event_main-wr">
        <span>Events List</span>
    </div>
</div>










