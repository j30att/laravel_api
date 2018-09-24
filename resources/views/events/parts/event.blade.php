<div class="event-item">
                    <div class="event-item-wr">
                        <div class="event-item__img">
                            <img src="/images/event.png" alt="">
                        </div>
                        <div class="event-item__text">
                            <div class="event-item__title">{{str_limit($event->title, 20, ' (...)')}}</div>
                            <div class="event-item__summa">£{{$event->fund}} GTD</div>
                            <div class="event-item__date">{{$event->formatted_data}}</div>
                        </div>

                    </div>
</div>
