$(document).ready(function () {
    let el = $('.btn-danger');
    el.on('click', function () {
        let id = $(this).data('id_car');
        console.log(id);
        $('#id_car').val(id);
        let form = $('#car_delete');
        form.submit();
    });
});