/* import './bootstrap'; */
console.log('bambam');
function imgSizing(className, sizeX, sizeY) {
    var imgElements = document.querySelectorAll(className);
    imgElements.forEach(function (sizeImg) {
        var sizeImgX = parseFloat(window.getComputedStyle(sizeImg).getPropertyValue('width')) / sizeX;
        var sizeImgY = sizeImgX * sizeY;
        sizeImg.style.height = sizeImgY + 'px';
    });
}
function resize(className, sizeX, sizeY) {
    window.addEventListener('resize', function () { imgSizing(className, sizeX, sizeY); });
    window.addEventListener('load', function () { imgSizing(className, sizeX, sizeY); });
    $('.carousel-control-prev, .carousel-control-next, .collapse-img-sizing, .carouselIndicator').click(function () {
        imgSizing(className, sizeX, sizeY);
    });
    imgSizing(className, sizeX, sizeY);
}
document.addEventListener('DOMContentLoaded', function () {
    resize('.class', 10, 6);
    resize('.img-sizing', 16, 9);
})

var isAnimating = false;


$('.custom-button-click').click(function () {
    var pointer = $(this).find('.custom-button-pointer');

    if (!isAnimating) {
        isAnimating = true;

        if (pointer.hasClass('rotate-90')) {
            pointer.addClass('rotate-0');
            pointer.removeClass('rotate-90');
        } else {
            pointer.removeClass('rotate-0');
            pointer.addClass('rotate-90');
        }

        setTimeout(function () {
            isAnimating = false;
        }, 350);
    }
});

document.addEventListener('DOMContentLoaded', function () {
    var replyButtons = document.querySelectorAll('.reply-btn');

    replyButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var username = this.parentNode.querySelector('.user-name').textContent.trim(); // Убираем пробелы в начале и в конце имени пользователя
            var reviewTextarea = document.getElementById('review');

            reviewTextarea.value = `${username}, `; // Убираем пробел после имени пользователя
            reviewTextarea.focus();
        });
    });
});
