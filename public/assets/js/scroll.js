
var scrollIconDown = document.getElementById('scroll-icon-down');
var scrollIconUp = document.getElementById('scroll-icon-up');
var scrollToTop = document.getElementById('scroll-to-top');

/*
var end = document.getElementById('end');

scrollIconDown.addEventListener('click', function (e) {
    e.preventDefault();
    end.scrollIntoView({ behavior: 'smooth' });
    scrollIconDown.classList.add('hidden');
    scrollIconUp.classList.remove('hidden');
});
*/

scrollIconDown.addEventListener('click', function (e) {
    e.preventDefault();
    var pageHeight = document.body.scrollHeight;
    window.scrollTo({ top: pageHeight, behavior: 'smooth' });
    scrollIconDown.classList.add('hidden');
    scrollIconUp.classList.remove('hidden');
});

scrollIconUp.addEventListener('click', function (e) {
    e.preventDefault();
    window.scrollTo({ top: 0, behavior: 'smooth' });
    scrollIconUp.classList.add('hidden');
    scrollIconDown.classList.remove('hidden');
});

window.addEventListener('scroll', function () {
    if (window.scrollY > 500) {
        scrollToTop.classList.add('visible');
    } else {
        scrollToTop.classList.remove('visible');
    }
});