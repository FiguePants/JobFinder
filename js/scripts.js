/*!
* Start Bootstrap - Modern Business v5.0.5 (https://startbootstrap.com/template-overviews/modern-business)
* Copyright 2013-2021 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-modern-business/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project

$('#navid').load('./nav.html');

$('#footerid').load('./footer.html');

$(document).ready(function() {
    //    $('#jquery_result').show( 'display', 'block' );

    $("#btn-favoris").on('click', function() {
        let idpost = $("#id-post").val();
        let idperson = $("#id-person").val();
        let checked = 0;
        if($('#btn-favoris > button').hasClass('checked')){
            checked = 1;  
        }
        $.ajax({
            url: "script.php",
            type: "POST",
            data: {idpost: idpost, idperson: idperson, checked: checked},
            success: function(response, textStatus, xhr) {
                let html = '';
                if( xhr.status == 200 ) {
                    if(checked){
                        html = '<button class="btn btn-danger float-end " name="favoris"><i class="bi bi-heart"></i></i></button>';
                    }
                    else{
                        html = '<button class="btn btn-danger float-end checked" name="favoris"><i class="bi bi-heart-fill"></i></i></button>';
                    }
                } else {
                    html = 'Error! Status: ' + xhr.status;
                }
                $('#btn-favoris').html(html);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#btn-favoris').html('Error: ' + xhr.status);
                console.log(thrownError);
            }
        });
    });
});
    
  