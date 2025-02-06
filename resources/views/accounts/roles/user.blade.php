<?php $countOfNonActualEvents = [];
$countOfActualEvents = []; ?>
@foreach ($seats as $seat)
    <?php
    $event = $events->find($seat->event_id);
    $date = DateTime::createFromFormat('d.m.y', $event->event_date);
    ?>
    @if (auth()->user()->id == $seat->user_id)
        @foreach ($masterclasses as $masterclass)
            @php
                $event->masterclass_id == $masterclass->id
                    ? ($date->format('d.m.Y') > date('d.m.Y', time() - 86400)
                        ? ($countOfActualEvents[] = '1')
                        : ($countOfNonActualEvents[] = '1'))
                    : '';
            @endphp
        @endforeach
    @endif
@endforeach
<div class="d-flex">
    <!-- Sidebar Menu -->
    <nav class="sidebar p-3" style="width: 250px; min-height: 100vh;">
        <ul class="nav flex-column">
            <li class="nav-item">
                <button class="nav-link w-100 text-start" onclick="showContent('finished')">Пройденные
                    мастер-классы</button>
            </li>
            <li class="nav-item">
                <button class="nav-link w-100 text-start" onclick="showContent('actual')">Записи на
                    мастер-классы</button>
            </li>
        </ul>
    </nav>

    <!-- Content Area -->
    <div class="content p-3 w-100">
        <!-- Finished Masterclasses -->
        <div id="finished" class="content-section" style="display: none;">
            @if ($countOfNonActualEvents)
                <h3>Пройденные мастер-классы ({{ count($countOfNonActualEvents) }})</h3>
                @foreach ($seats as $seat)
                    <?php
                    $event = $events->find($seat->event_id);
                    $date = DateTime::createFromFormat('d.m.y', $event->event_date);
                    ?>
                    @if (auth()->user()->id == $seat->user_id)
                        @foreach ($masterclasses as $masterclass)
                            @if ($event->masterclass_id == $masterclass->id && $date->format('d.m.Y') <= date('d.m.Y', time() - 86400))
                                <div class='border p-3 my-2 rounded'>
                                    <h4>{{ $masterclass->title }}</h4>
                                    <p>{{ $event->event_date . ' ' . $event->event_time }}</p>
                                    <p>Кабинет: {{ $event->cabinet_id }}, Место: {{ $seat->seat_num }}</p>
                                    <a href="{{ route('masterclass', ['id' => $masterclass->id, 'event_id' => $event->id]) }}"
                                        class="btn btn-primary">Подробнее</a>
                                </div>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @else
                <h3>Нет пройденных записей на мастер-классы</h3>
            @endif
        </div>

        <!-- Actual Masterclasses -->
        <div id="actual" class="content-section" style="display: block;">
            @if (count($countOfActualEvents))
                <h3>Записи на мастер-классы ({{ count($countOfActualEvents) }})</h3>
                @foreach ($seats as $seat)
                    <?php
                    $event = $events->find($seat->event_id);
                    $date = DateTime::createFromFormat('d.m.y', $event->event_date);
                    ?>
                    @if (auth()->user()->id == $seat->user_id)
                        @foreach ($masterclasses as $masterclass)
                            @if ($event->masterclass_id == $masterclass->id && $date->format('d.m.Y') > date('d.m.Y', time() - 86400))
                                <div class='border p-3 my-2 rounded'>
                                    <h4>{{ $masterclass->title }}</h4>
                                    <p>{{ $event->event_date . ' ' . $event->event_time }}</p>
                                    <p>Кабинет: {{ $event->cabinet_id }}, Место: {{ $seat->seat_num }}</p>
                                    <a href="{{ route('masterclass', ['id' => $masterclass->id, 'event_id' => $event->id]) }}"
                                        class="btn btn-primary">Подробнее</a>
                                    <button class="btn btn-danger cancel-button" data-event-id="{{ $seat->event_id }}"
                                        data-bs-toggle="modal" data-bs-target="#modalId">Отменить</button>
                                </div>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @else
                <h3>Нет актуальных записей на мастер-классы</h3>
            @endif
        </div>
    </div>
</div>
<div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Отмена записи
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('account.cancel') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="user_id" value='{{ auth()->user()->id }}'>
                        <input type="hidden" id="eventId" name="event_id" value=''>
                        Вы уверены?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Закрыть
                        </button>
                        <button type="submit" class="btn btn-primary">Отменить запись</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script>
    function showContent(section) {
        document.querySelectorAll('.content-section').forEach(el => el.style.display = 'none');
        document.getElementById(section).style.display = 'block';
    }
</script>
<script>
    $(document).ready(function() {
        $('.cancel-button').click(function() {
            var event_id = $(this).data('event-id');
            $('#eventId').val(event_id);

            console.log(event_id);
        });
    })
    var modalId = document.getElementById('modalId');

    modalId.addEventListener('show.bs.modal', function(event) {
        let button = event.relatedTarget;
        let recipient = button.getAttribute('data-bs-whatever');
        var isAnimating = false;
    });
</script>