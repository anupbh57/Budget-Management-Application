
function switchListener(divId, blockA, blockB) {
    var isChecked = document.getElementById(divId).checked;
    console.log('clicked');
    if (isChecked == true) {
        document.getElementById(blockA).setAttribute('name', 'hidden');
        document.getElementById(blockB).setAttribute('name', 'selected');
        document.getElementById(blockA).style.display = 'none';
        document.getElementById(blockB).style.display = 'block';

    }
    else if (isChecked == false) {
        document.getElementById(blockA).setAttribute('name', 'selected');
        document.getElementById(blockB).setAttribute('name', 'hidden');
        document.getElementById(blockA).style.display = 'block';
        document.getElementById(blockB).style.display = 'none';

    }

    console.log(document.getElementById(blockA).getAttribute('name'));
    console.log(document.getElementById(blockB).getAttribute('name'));

}

function incEvent(divId) {
    var elmt = document.getElementById("input-area");
    $('html, body').animate({
        scrollTop: $("#input-area").offset().top
    }, 1000);
    var dv = '#' + divId;
    var isChecked = document.getElementById(divId).checked;
    if (isChecked == true) {
        $(dv).click();
    }
}

function expEvent(divId) {
    $('html, body').animate({
        scrollTop: $("#input-area").offset().top
    }, 1000);
    var isChecked = document.getElementById(divId).checked;
    var dv = '#' + divId;
    if (isChecked == true) {
        console.log('on display');
    }
    else {
        $(dv).click();
    }
}

function editData(rowId, typeId) {
    console.log('asda');

    $("#editmodal").modal();

    if (document.getElementById('table') != null) {
        
        var table = document.getElementById('table');
        var rows = table.getElementsByTagName('tr');
        var fid = '';
        var fdate = '';
        var ftitle = '';
        var famount = 0;
        var fdescription = '';
        var fcategory = '';
        for (var i = 1; i < rows.length; i++) {

            rows[i].i = i;
            rows[i].onclick = function () {
                fid = table.rows[this.i].cells[1].innerHTML;
                fdate = table.rows[this.i].cells[2].innerHTML;
                ftitle = table.rows[this.i].cells[3].innerHTML;
                famount = table.rows[this.i].cells[4].innerHTML;
                fdescription = table.rows[this.i].cells[5].innerHTML;
                fcategory = table.rows[this.i].cells[6].innerHTML;

                document.getElementById('fe-date').value = fdate;
                document.getElementById('fe-title').value = ftitle;
                document.getElementById('fe-amount').value = famount;
                document.getElementById('fe-description').value = fdescription;
                document.getElementById('rowid').value = rowId;

                var isChecked = document.getElementById('type-selector-ed').checked;
                if (typeId == 0) {
                    if (isChecked == true) {
                        $('#type-selector-ed').click();                        
                    }

                    document.getElementById('select-inc-ed').value = fcategory;
                    document.getElementById('select-inc-ed').setAttribute('name','selected');
                    document.getElementById('select-exp-ed').setAttribute('name','hidden');
                }
                else if (typeId == 1) {
                    if (isChecked == true) {
                    }
                    else {
                        $('#type-selector-ed').click();
                    }
                    document.getElementById('select-exp-ed').value = fcategory;
                    document.getElementById('select-exp-ed').setAttribute('name','selected');
                    document.getElementById('select-inc-ed').setAttribute('name','hidden');
                }
            };
        }

    }
    else {
    }
}

function deleteRow(rowId) {
    $("#deletemodal").modal();
    document.getElementById('delholder').value = rowId;
}

function dmaction() {
    document.getElementById("dmform").submit();
    $("#delsuccessmodal").modal();
}

function asd () {
    console.log('asdasd');
}


// ADMIN FUNCTIONS

function settingController(current, frm1, frm2) {
    var currentForm = document.getElementById(current).style.display;
    var secondForm = document.getElementById(frm1).style.display;
    var thirdForm = document.getElementById(frm2).style.display;

    document.getElementById(current).style.display = "block";
    document.getElementById(frm1).style.display = "none";
    document.getElementById(frm2).style.display = "none";
}

function logincontroller(frm1, frm2) {
    var secondForm = document.getElementById(frm1).style.display;
    var thirdForm = document.getElementById(frm2).style.display;
    $("#loginmodal").modal();
    setTimeout(function() {
        $('#loginmodal').modal('toggle');
        document.getElementById(frm1).style.display = "none"; 
        document.getElementById(frm2).style.display = "block";
    }, 1500);
    
}

