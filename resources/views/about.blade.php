@extends('layouts.main')

@section('title')
<title>О нас</title>
@endsection

@section('content')
<!-- Section for Company Overview -->
<section class="container py-5">
    <div class="row justify-content-center text-center">
        <h2 class="russo-one-regular mb-4" style="font-size: 2.5rem; color: #979797;">О нас</h2>
        <div class="col-lg-8">
            <p class="fs-4 text-muted">
            В "Креативном просторе" мы верим, что знания должны быть доступными, а делиться ими должно быть легко и удобно. Мы создали пространство, где лекторы, тренеры и эксперты могут найти идеальную площадку для проведения лекций, мастер-классов и семинаров, а слушатели – быстро и просто записаться на интересующие их мероприятия.
            </p>
            <p class="fs-4 text-muted">
                Наша миссия - соединять тех, кто хочет делиться знаниями, с теми, кто стремится к развитию и обучению. Мы стремимся создать комфортную и эффективную среду для обмена опытом, профессионального роста и личностного развития.
            </p>
        </div>
    </div>
</section>

<!-- Section for Contact Information -->
<section class="container py-5 ">
    <div class="row justify-content-center text-center">
        <h2 class="russo-one-regular mb-4" style="font-size: 2.5rem; color: #979797;">Контакты</h2>
        <div class="col-lg-6">
            <ul class="list-unstyled fs-4 text-muted">
                <li><strong>Администрация:</strong> 68-07-73</li>
                <li><strong>E-mail:</strong> <a href="mailto:masterlector@mail.ru" class="text-decoration-none">info@creativeprostor.ru</a></li>
                <li><strong>Адрес:</strong> 27 Северная, 69</li>
            </ul>
            <div class="d-flex justify-content-center mt-4">
                <a href="https://vk.com/omsktec" class="me-3">
                    <img src="{{asset('build/images/vk.png')}}" alt="VK" height="50px">
                </a>
                <a href="https://ok.ru/group/53402328629468" class="me-3">
                    <img src="{{asset('build/images/ok.png')}}" alt="OK" height="50px">
                </a>
                <a href="https://t.me/omskkitec" class="me-3">
                    <img src="{{asset('build/images/tg.png')}}" alt="Telegram" height="50px">
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Section for Map -->
<section class="container py-5">
    <div class="row justify-content-center text-center">
        <h2 class="russo-one-regular mb-4" style="font-size: 2.5rem; color: #979797;">Наши координаты</h2>
        <div class="col-lg-8">
            <div style="max-width: 100%; height: 500px; margin: 0 auto;">
                <script type="text/javascript" charset="utf-8" async id="Map"
                    src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A523ae156b24e4059e0db2107ef31dceaf87274b00d05c571b4f763377202c33e&amp;width=100%&amp;height=100%&amp;lang=ru_RU&amp;scroll=true"
                    style="width: 100%; height: 100%;"></script>
            </div>
        </div>
    </div>
</section>
@endsection
