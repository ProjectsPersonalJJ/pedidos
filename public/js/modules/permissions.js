//let form = $('#formCreateUser');
//let loading = $('#fade-loading');
//const fade = new FadeLoading(loading); //Class
//let submit = form.find('button[type="submit"]');
function getPermissions(element) {
    let token = $('input[name="_token"]').val();
    $.ajax({
        url: "/permissions",
        type: 'GET',
        headers: {
            "X-CSRF-TOKEN": token
        },
        dataType: 'json',
        data: { document: $(element).val() },
        beforeSend: () => {
            //fade.fade_loading_open();
        }
    }).done((data) => {
        printPermissions(data);
    }).always(() => {
        //fade.fade_loading_close();
    });
}

function printPermissions(data) {
    $('#modalPermissions').modal('show');
    $.each(data.response, function (index1, value1) {
        con=0;
        $.each(value1.options, function (index2, value2) {
            if(value2==1){
                $('#'+index1+'Create').prop('checked', true);
                con++;
            }else if(value2==2){
                $('#'+index1+'Read').prop('checked', true);
                con++;
            }else if(value2==3){
                $('#'+index1+'Update').prop('checked', true);
                con++;
            }else if(value2==4){
                $('#'+index1+'Delete').prop('checked', true);
                con++;
            }
            if(con==4){
                $('#'+index1+'All').prop('checked', true);
            }
        });
    });
}

//$(document).ready(function(){
    $('.allCheckBox').click(function(){
        value=$('.allCheckBox').val();
        if($('.'+value+' input').prop('checked')){
            $('.'+value+' input').prop('checked', false);
        }else{
            $('.'+value+' input').prop('checked', true);
        }
        
    });
//});




