$(document).ready(function () {
    let el = $('.btn-danger');
    el.on('click', function () {
        let id = $(this).data('id_salon');
        console.log(id);
        $('#id_salon').val(id);
        let form = $('#salon_delete');
        form.submit();
    });
});