$(document).ready(function() {

    jQuery.validator.addMethod("mail_validation", function(value, element) {
        return this.optional( element ) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@(?:\S{1,63})$/.test(value);
    }, 'Please enter a valid email address.');

    jQuery.validator.addMethod("password_validation", function(value, element) {
        return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/.test(value);
    }, 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.');


    $("#sign_up_form").validate({
        rules: {
            user_name: {
                required: true,
                minlength: 3
            },
            user_email: {
                required: true,
                email: true,
                mail_validation: true
            },
            user_password: {
                required: true,
                minlength: 6,
                password_validation: true
            },
            user_phone: {
                required: true,
                number: true,
                minlength: 8,
                maxlength: 12
            },
        },

        messages: {
            user_name: {
                required: "Please enter your user name",
                minlength: "Your user name must consist of at least 3 characters",
            },
            user_email: {
                required: "Please enter your email",
                email: "Please enter a valid email address"
            },
            user_password: {
                required: "Please enter your password",
                minlength: "Your password must consist of at least 6 characters"
            },
            user_phone: {
                required: "Please enter your phone number",
                number: "Please enter a valid phone number",
                minlength: "Your phone number must consist of at least 8 characters",
                maxlength: "Your phone number must consist of at most 12 characters"
            },
        }
    });
});

$('#edit-password').change(function() {
    const newPasswordField = document.getElementById("new-password");
    if ($(this).is(':checked')) {
        newPasswordField.disabled = false;
        newPasswordField.required = true;
    } else {
        newPasswordField.disabled = true;
        newPasswordField.required = false;
        newPasswordField.value = "";
    }
});

$('#delete-account-check').change(function() {
    const deleteButton = document.getElementById("delete-button");
    if ($(this).is(':checked')) {
        deleteButton.disabled = false;
    } else {
        deleteButton.disabled = true;
    }
});

$('#update_button').click(function() {
    var userData = $('#edit-form').serialize();

    $.ajax({
        url: '../PHP/update_user.php',
        type: 'POST',
        data: userData,

        success: function(response) {

            if (response == "1") {
                alertify.success("User updated successfully");
                $('#user-table').load('../NAV/user.php #user-table');
                $('#edit-modal').modal("hide");
                document.getElementById("current-password").value = "";
                return;
            } else if (response == "2") {
                alertify.error("Incorrect password");
                document.getElementById("current-password").value = "";
            }
        }
    })
});