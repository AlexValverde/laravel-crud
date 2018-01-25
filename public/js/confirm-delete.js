/**
 * Created by alex on 1/20/2018.
 */
$(document).ready(function(){

    <!-- Dialog show event handler -->
    $('#confirmDelete').on('show.bs.modal', function (e) {
        console.log('show.bs.modal');
        var message = $(e.relatedTarget).attr('data-message');
        $(this).find('.modal-body p').text(message);
        var title = $(e.relatedTarget).attr('data-title');
        $(this).find('.modal-title').text(title);

        // Pass form reference to modal for submission on yes/ok
        var form = $(e.relatedTarget).closest('form');
        $(this).find('.modal-footer #confirm').data('form', form);
    });

    <!-- Form confirm (yes/ok) handler, submits form -->
    $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
        $('#form-actions').submit();
    });
});