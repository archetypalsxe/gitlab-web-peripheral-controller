/**
 * An error to the field where you enter your name
 */
function addNameFieldError(error) {
    $('#nameEnterField').val('');
    $('#nameEnterField').addClass('redBorder');
    $('#nameEnterField').attr('placeholder', error);
}

/**
 * Validate that a name field was filled out correctly and add an error on the
 * page if necessary
 *
 * @return bool
 */
function validateNameField() {
    var name = $('#nameEnterField').val();
    if(name.length < 1) {
        addNameFieldError("Must be entered");
        return false;
    }
    if(name.length >= 10) {
        addNameFieldError("Fewer than 100 characters");
        return false;
    }

    return true;
}

/**
 * Send the selection that the user has made to the backend to be saved and
 * handled
 */
function sendNameField() {
    var name = $('#nameEnterField').val();
    $.ajax({
        method: "POST",
        url: 'ajaxHandler.php',
        data: {
            handler: "saveName",
            name: name
        }
    })
    .done(function(data) {
        var parsedData = $.parseJSON(data);
        console.log(parsedData);
    });
}

/**
 * Process the user's entry for their name
 */
function processNameField() {
    if(validateNameField()) {
        this.sendNameField();
    }
}

/**
 * Actions to perform when the page loads to get it ready
 */
$(document).ready(function() {
    $('#scanButton').click(function() {
        window.open('server/scan.php');
    });

    $('#newUserNameForm').submit(function(event) {
        processNameField();
        event.preventDefault();
        return false;
    });
});
