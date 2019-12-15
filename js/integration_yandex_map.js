ymaps.ready(init);
function init() {
    var myMap = new ymaps.Map("map", {
        center: [48.6420799, 44.4225162],
        zoom: 17
    }, {
        searchControlProvider: 'yandex#search'
    });
    myMap.geoObjects
        .add(new ymaps.Placemark([48.641927, 44.422385], {
            balloonContent: '<strong>ВолГУ</strong>',
            iconCaption: 'Туто я провожу свои лучшие годы жизни'
        }, {
            preset: 'islands#greenDotIconWithCaption'
        }));
}