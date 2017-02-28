function addNameFieldError(error) {
    $('#nameEnterField').val('');
    $('#nameEnterField').addClass('redBorder');
    $('#nameEnterField').attr('placeholder', error);
}

function validateNameField() {
    var name = $('#nameEnterField').val();
    if(name.length < 1) {
        addNameFieldError("Must be entered");
    }
    if(name.length >= 10) {
        addNameFieldError("Fewer than 100 characters");
    }
}

$(document).ready(function() {
    $('#scanButton').click(function() {
        window.open('server/scan.php');
    });

    $('#newUserNameForm').submit(function(event) {
        validateNameField();
        event.preventDefault();
        return false;
    });
});
