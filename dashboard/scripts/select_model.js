
$(document).ready(function(){

    $('#mark_select').change(function(){
        $.ajax({
            url: '/admin/addItem/select_mark',
            type: 'post',

            dataType: 'html',
            data: {'id':$('select[name=marks_id]').val(), '_token': $('input[name=_token]').val()},

            success:function(data){

                $("select").removeData('#model_select');
                $('#model_select_contenir select').find('option').remove();

                if($('#model_select_contenir').css('display') == 'none'){
                    $('#model_select_contenir').show('slow');
                }


                $('#model_select').append(data);
                console.log(data);

            },


            error: function(xhr,textStatus,thrownError){
                alert('ÚÐÑÇ íæÌÏ ÎØÃ');
            }
        });
    });
});

//        $(document).ready(function(){
//            $('#mark_select').change(function(){
//                $.ajax({
//                    url: '/admin/addItem/select_mark',
//                    type: 'POST',
//                    cache: true,
//                    dataType: 'json',
//                    data: {'id':$('select[name=markes_id]').val(), '_token': $('input[name=_token]').val()},
//
//                    success: function(data){
//
////                        $('#model_select').append(data);
//
//                        alert(JSON.stringify(data))
//
//                    },
//
//
//                    error: function(xhr,textStatus,thrownError){
//                        alert('ÚÐÑÇ íæÌÏ ÎØÃ');
//                    }
//                });
//            });
//});
