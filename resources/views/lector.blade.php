@extends('layouts.main')
@section('title')
    <title>Создание мастер-класса</title>
@endsection
@section('content')
    <div class="row">
        <div class="col-9">
            @php
                $masterclasses_times = [];
                $array = [];
                $event_times = $events->where('cabinet_id', $cabinet_id)->all();
                foreach ($event_times as $event) {
                    if ($masterclasses->find($event->masterclass_id)->status == 1) {
                        $correct_date = preg_replace('/\./', '^', $event->event_date);
                        $array[] = "rent_$correct_date" . "_$event->event_time";
                    }
                }
                $masterclasses_times[] = $array;
            @endphp
            <input class="form-control" type="hidden" id="masterclasses-times" name='masterclasses-times'
                data-masterclasses-times="{{ json_encode($masterclasses_times) }}"
                value="{{ json_encode($masterclasses_times) }}">
            <form class='mt-5' method='post' action='{{ route('lector.create') }}' enctype='multipart/form-data'>
                @csrf
                <input class="form-control" type="hidden" id="masterclass_img_main" name='masterclass_lector_id'
                    value="{{ auth()->user()->id }}">
                <input class="form-control" type="hidden" id="cabinet_id" name='cabinet_id' value="{{ $cabinet_id }}">
                <div class="mb-3">
                    <label for="masterclass_img_main" class="form-label">Главное изображение</label>
                    <input class="form-control" type="file" id="masterclass_img_main"
                        accept="image/png, image/jpg, image/jpeg" name='img_main' required>
                </div>
                <div class="mb-3">
                    <span>Название мастер-класса</span>
                    <input maxlength="60" type="text" class="form-control" id="masterclass_title"
                        aria-describedby="masterclass_title" name='masterclass_title' required>
                </div>
                <div class="mb-3">
                    <span>Описание</span>
                    <textarea class="form-control" id="masterclass_description" name='masterclass_description' required></textarea>
                </div>


        </div>
        <div class="col-3 mt-5">
            <div class="mb-3">
                <span>Цена</span>
                <input type='number' class="form-control" id="masterclass_price" name='masterclass_price' required>
            </div>
            <span class="d-flex">Только для лиц, достигших 18-ти лет?</span>
            <div class="mb-3 d-flex align-items-center ">
                <input class="d-flex form-check-input custom-radio" type="radio" name="age_restriction" value='0'
                    id="" checked />
                <label class="d-flex form-check-label me-5" for="no"> Нет </label>
                <input class="d-flex form-check-input custom-radio" type="radio" name="age_restriction" value='1'
                    id="" />
                <label class="d-flex form-check-label" for="yes">
                    Да
                </label>
            </div>
            <div class="mb-3">
                <span>Загрузите изображения для галереи</span>
                <input class="form-control" type="file" id="masterclassgallery" name='img_gallery[]'
                    accept="image/png, image/jpg, image/jpeg" multiple>
            </div>
        </div>
    </div>

    <table class="table justify-content-center table-fs">
        <thead>
            <tr class=''>
                <th scope="col" class='px-1'></th>
                @for ($k = 0; $k < count($dates); $k++)
                    <th class='text-center p-0 pe-1' scope="col">{{ $dates[$k] }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>

            @for ($i = 0; $i < 7; $i++)
                <tr>
                    <th scope="row" class='text-center p-0 justify-content-center d-flex py-1'>
                        {{ date('d.m', time() + 86400 * $i) }}</th>
                    @for ($j = 0; $j < count($dates); $j++)
                        <td class='p-0 justify-content-center text-center'>
                            <input type="checkbox" class=" form-check-input d-flex p-2  mx-auto p-md-3"
                                name="rent_{{ date('d^m^y', time() + 86400 * $i) . '_' . $dates[$j] }}">
                        </td>
                        </td>
                    @endfor
                </tr>
            @endfor
        </tbody>
    </table>
    <button type="submit" class="custom-button">Создать</button>
    </form>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            /* Получаю данные из input с type='hidden', хранящей все времена проведения мастер-классов */
            var mcsTimes = $('#masterclasses-times').data('masterclasses-times');
            // Перебор объекта JSON
            var rentList = [];
            console.log(mcsTimes.length);
            for (var i = 0; i < mcsTimes.length; i++) {
                $.each(mcsTimes[i], function(key, value) {
                    rentList.push(value);
                });
            }
            $('input[type="checkbox"]').each(function() {
                var checkboxName = $(this).attr('name');
                if (rentList.includes(checkboxName)) {
                    // Если значение атрибута name чекбокса есть в rentList, добавляем класс .bg-secondary и устанавливаем атрибут disabled
                    $(this).addClass('bg-secondary').prop('disabled', true);
                }
            });
        });
    </script>
@endsection
