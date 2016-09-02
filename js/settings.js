/**
 * Created by Administrator on 2016/6/25.
 */
var xmlHttp

function sumbit_info()
{

        $.ajax({
        url: "php/controller.php",
        type: "POST",
        data:{
            network: $("#network").val(),
            connect: $("#connect").val()
        },
        //dataType: "json",
        error: function(){
            alert('Error loading XML document');
        },
        success: function(){
            $.confirm({
                animationBounce: 2,
                animation: 'zoom',
                title: '信息',
                content: '信息提交成功!请滑动页面到下方查看信息',
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
