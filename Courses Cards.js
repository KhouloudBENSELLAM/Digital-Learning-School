const courses = document.querySelectorAll('.slider .course');
let counter = 0;

function left() {
    if (counter == 0) {
        counter = courses.length / 3 - 1;
    } else {
        counter--;
    }
    scroll();
}

function right() {
    if (counter == courses.length / 3 - 1) {
        counter = 0;
    } else {
        counter++;
    }
    scroll();
}

function scroll() {
    courses.forEach(function(item) {
        item.style.transform = `translateX(-${counter * 1110}px)`;
    });
}

document.addEventListener('DOMContentLoaded', () => {
    scroll();
});
