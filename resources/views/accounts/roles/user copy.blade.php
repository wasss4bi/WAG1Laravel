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


@if (count($countOfNonActualEvents) !== 0 || count($countOfActualEvents) !== 0)
    <a class="custom-button fs-3 custom-button-click w-100 d-flex mt-5 justify-content-between px-md-5 px-3"
        data-bs-toggle="collapse" href="#myMasterclasss" aria-expanded="false" aria-controls="myMasterclasss">
        <span class="d-flex custom-button-pointer align-items-center">►</span>Мои записи<span class="d-flex"></span>
    </a>
@else
    <div class="custom-button fs-3 bg-secondary w-100 d-flex mt-5 justify-content-between px-5">
        <span class="d-flex ">►</span>Мои записи<span class="d-flex"></span>
    </div>
@endif


<div class="collapse px-md-5 px-0" id="myMasterclasss">
    @if (count($countOfNonActualEvents) !== 0)
        <a class="custom-button fs-3 custom-button-click w-100 d-flex mt-5 justify-content-between px-md-5 px-3"
            data-bs-toggle="collapse" href="#myFinishedMasterclasss" aria-expanded="false"
            aria-controls="myFinishedMasterclasss">
            <span class="d-flex custom-button-pointer align-items-center ">►</span>Пройденные мастер-классы<span
                class="d-flex align-items-center">{{ count($countOfNonActualEvents) }}</span>
        </a>
    @else
        <div class="custom-button fs-3 bg-secondary w-100 d-flex mt-5 justify-content-between px-5">
            <span class="d-flex">►</span>Пройденные мастер-классы<span
                class="d-flex align-items-center">{{ count($countOfNonActualEvents) }}</span>
        </div>
    @endif
    <div class="collapse px-md-5 px-0" id="myFinishedMasterclasss">
        @foreach ($seats as $seat)
            <?php
            $event = $events->find($seat->event_id);
            $date = DateTime::createFromFormat('d.m.y', $event->event_date);
            ?>
            @if (auth()->user()->id == $seat->user_id)
                @foreach ($masterclasses as $masterclass)
                    @if ($event->masterclass_id == $masterclass->id && $date->format('d.m.Y') <= date('d.m.Y', time() - 86400))
                        <span></span>
                        <div
                            class='text-light fs-5 my-3 ms-2 justify-content-center align-items-center d-flex border-end border-start border-2 rounded-4 flex-wrap flex-columnn px-3'>
                            <div
                                class='d-flex fs-3 text-black russo-one-regular justify-content-center text-center w-100'>
                                {{ $masterclass->title }}</div>
                            <div
                                class="d-flex flex-wrap custom-button-dark russo-one-regular align-items-center justify-content-center w-100">
                                <div class='d-flex fs-5 align-items-center me-1'>
                                    {{ $event->event_date . ' ' . $event->event_time }}</div>
                                <div class="d-flex fs-5 align-items-center">
                                    {{ ' каб: ' . $event->cabinet_id . ' ' . 'место: ' . $seat->seat_num . ' ' }}</div>
                            </div>
                            <div class="d-flex w-100">
                                <a class='d-flex fw-bolder fs-4 custom-button w-100 justify-content-center '
                                    style="height:50px;"
                                    href="{{ route('masterclass', ['id' => $masterclass->id, 'event_id' => $event->id]) }}">Подробнее</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        @endforeach
    </div>

    @if (count($countOfActualEvents) !== 0)
        <a class="custom-button fs-3 custom-button-click w-100 d-flex mt-5 justify-content-between px-md-5 px-3"
            data-bs-toggle="collapse" href="#myActualMasterclasss" role="button" aria-expanded="false"
            aria-controls="myActualMasterclasss">
            <span class="d-flex custom-button-pointer align-items-center">►</span>Записи на мастер-классы<span
                class='d-flex align-items-center'>{{ count($countOfActualEvents) }}</span>
        </a>
    @else
        <div class="custom-button fs-3 bg-secondary w-100 d-flex mt-5 justify-content-between px-5">
            <span class="d-flex">►</span>Записи на мастер-классы<span
                class='d-flex align-items-center'>{{ count($countOfActualEvents) }}</span>
        </div>
    @endif

    <div class="collapse w-100 justify-items-between px-md-5 px-0" id="myActualMasterclasss">

        @foreach ($seats as $seat)
            <?php
            $event = $events->find($seat->event_id);
            $date = DateTime::createFromFormat('d.m.y', $event->event_date);
            ?>
            @if (auth()->user()->id == $seat->user_id)
                @foreach ($masterclasses as $masterclass)
                    @if ($event->masterclass_id == $masterclass->id && $date->format('d.m.Y') > date('d.m.Y', time() - 86400))
                        <div
                            class='text-light my-3 ms-2 justify-content-center align-items-center d-flex border-end border-start border-2 rounded-4 flex-wrap  flex-column px-3'>
                            <div
                                class='d-flex text-black fs-3 russo-one-regular justify-content-center text-center w-100'>
                                {{ $masterclass->title }}</div>
                            <div
                                class="d-flex flex-wrap custom-button-dark russo-one-regular align-items-center justify-content-center w-100">
                                <div class='d-flex fs-5 align-items-center me-1'>
                                    {{ $event->event_date . ' ' . $event->event_time }}</div>
                                <div class="d-flex fs-5 align-items-center">
                                    {{ ' каб: ' . $event->cabinet_id . ' ' . 'место: ' . $seat->seat_num . ' ' }}</div>
                            </div>
                            <div class="d-flex w-100">
                                <a class='d-flex w-50 custom-button text-center justify-content-center fs-4 align-items-center '
                                    style="height:50px;"
                                    href="{{ route('masterclass', ['id' => $masterclass->id, 'event_id' => $event->id]) }}">Подробнее</a>
                                <button type="button"
                                    class="cancel-button w-50 btn btn-danger justify-content-center rounded-4 fs-4 align-items-center fw-bolder"
                                    style="height:50px;" data-event-id="{{ $seat->event_id }}" data-bs-toggle="modal"
                                    data-bs-target="#modalId">Отменить</button>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        @endforeach
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
</div>


<script>
    $(document).ready(function() {

        console.log('fasd');
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
