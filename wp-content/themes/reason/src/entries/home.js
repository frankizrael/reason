import '../scss/home.scss';
import 'swiper/dist/css/swiper.css';
import Swiper from 'swiper';

var mySwiperInit = new Swiper('#home_slider .swiper-container', {
    speed: 400,
    pagination: {
        el: '#home_slider .swiper-pagination',
        clickable: true
    },
    loop: true,
    autoplay: 2500,
    slidesPerView: 1,
    effect: 'fade',
    fade: { crossFade: true }
});
$('.reason_list a').eq(0).addClass('active');
mySwiperInit.on('slideChange', function () {
  let $bullet = $('#home_slider .swiper-pagination .swiper-pagination-bullet');
  for (let i=0;i<$bullet.length;i++) {
    if ($bullet.eq(i).hasClass('swiper-pagination-bullet-active')) {
        $('.reason_list a').removeClass('active');
        $('.reason_list a').eq(i).addClass('active');
    }
  }
});
$('.reason_list a').on('click',function(){
    let $this = $(this);
    let indx = $this.attr('data');
    $('.reason_list a').removeClass('active');
    $this.addClass('active');
    $('#home_slider .swiper-pagination .swiper-pagination-bullet').eq(indx).trigger('click');
});