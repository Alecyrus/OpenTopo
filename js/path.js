/**
 * Created by Administrator on 2016/6/26.
 */
var xmlHttp

function generate_path()
{

    $.ajax({
        url: "php/test_path.php",
        type: "POST",
        data:{
            source: $("#source").val(),
            target: $("#target").val()
        },
        //dataType: "json",
        error: function(){
            alert('Error loading XML document');
        },
        success: function(data){
            //alert(data);
            $.dialog({
                animationBounce: 2,
                animation: 'zoom',
                title: '测试结果',
                content: data,
            });

        }
    });
    // $.post(
    //     "php/controller.php",
    //     {
    //         network: $("#network").val(),
    //         connect: $("#connect").val()
    //     },
    //     function (data) {
    //
    //     }
    // ).error(function () {
    //     $("#submit_info").setText("成功")
    // })
}
