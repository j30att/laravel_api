<div class="event-item">
    <div class="event-item-wr">
        <a href="{{route('event', ['id'=>$event->id])}}">
            <div class="event-item__img">
                <img src="/images/event.png" alt="">
            </div>
        </a>
        <div class="event-item__text">
            <a href="{{route('event', ['id'=>$event->id])}}">
                <div class="event-item__title">{{str_limit($event->title, 20)}}</div>
            </a>
            <div class="event-item__summa">£{{$event->fund}} GTD</div>

            <div class="event-item__date">{{$event->formatted_data}}</div>
        </div>

    </div>
</div>
