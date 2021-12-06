function validator() {
    if (dateValidate('f-date') == true && titleValidate('f-title') == true && amountValidate('f-amount') == true) {
        document.getElementById("f-form").submit();
        $("#successmodal").modal();
    }
    else {
        console.log('oops');
    }
}
//Field Checks
//Date Check
function edValidator() {
    if (dateValidate('fe-date') == true && titleValidate('fe-title') == true && amountValidate('fe-amount') == true) {
        document.getElementById("fe-form").submit();
        $('#editmodal').modal('hide');
        $("#edsuccessmodal").modal();
    }
    else {
        console.log('oops');
    }
}
function dateValidate(div) {
    if (isValidDate(div) == true) {
        console.log('date in correct format');
        return true;
    }
    else {
        console.log('date is not in correct format');
        indicator(div);
        return false;
    }
}

function titleValidate(div) {
    var data = document.getElementById(div).value;
    if (emptyFieldCheck(data) == false) {
        console.log('title is populated');
        return true;

        if (numberCheck(data) == false) {
            console.log('title has no numbers');
            return true;
        }
        else {
            console.log('title has numbers');
            indicator('f-title');
            return false;
        }

        if (specialCharactersCheck(data) == false) {
            console.log('title has no special characters');
            return true;
        }
        else {
            console.log('title has special characters');
            indicator('f-title');
            return false;
        }
    }
    else {
        console.log('title is empty');
        indicator(div);
        return false;
    }



}

function amountValidate(div) {
    var data = document.getElementById(div).value;
    if (emptyFieldCheck(data) == false) {
        console.log('amount is populated');

        if (numberCheck(data) == true) {
            console.log('amount has numbers');
            return true;
        }
        else {
            console.log('amount has no numbers');
            indicator(div);
            return false;
        }

        if (specialCharactersCheck(data) == false) {
            console.log('amount has no special characters');
            return true;
        }
        else {
            console.log('title has special characters');
            indicator(div);
            return false;
        }
    }
    else {
        console.log('amount is empty');
        indicator(div);
        return false;
    }
}

//Plugin Functions

function isValidDate(div) {
    var dateString = document.getElementById(div).value;
    // First check for the pattern
    var regex_date = /^\d{4}\-\d{1,2}\-\d{1,2}$/;

    if (!regex_date.test(dateString)) {
        return false;
    }

    // Parse the date parts to integers
    var parts = dateString.split("-");
    var day = parseInt(parts[2], 10);
    var month = parseInt(parts[1], 10);
    var year = parseInt(parts[0], 10);

    // Check the ranges of month and year
    if (year < 1000 || year > 3000 || month == 0 || month > 12) {
        return false;
    }

    var monthLength = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

    // Adjust for leap years
    if (year % 400 == 0 || (year % 100 != 0 && year % 4 == 0)) {
        monthLength[1] = 29;
    }

    // Check the range of the day
    return day > 0 && day <= monthLength[month - 1];
}

function numberCheck(inputData) {
    if (/\d/.test(inputData) == true) {
        return true;
    }
    else {
        return false;
    }
}

function emptyFieldCheck(inputData) {  //Check if field is empty
    if (inputData.length == 0) {
        return true
    }
    else {
        console.log("Not Empty");
        console.log(inputData, "is populated");
        return false
    }
    return result;
}

function numberCheck(inputData) {
    if (/\d/.test(inputData) == true) {
        return true;
    }
    else {
        return false;
    }
}

function specialCharactersCheck(inputData) {
    var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,<>\/?]+/;
    if (format.test(inputData)) {
        return true;
    } else {
        return false;
    }
}



function indicator(id) {
    document.getElementById(id).style.borderColor = 'rgb(248, 79, 79)';
}
