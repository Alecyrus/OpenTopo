/**
 * Created by Junkai Huang on 2016/6/14.
 */
function routing() {
    $.getJSON('python/data/routing_data.json',function (data) {

        try {
            console.log(data['routing'][$("#choose").val()-1]['routes']);
        }
        catch (err)
        {
            $.alert({
                title: 'Error',
                content: '检查输入格式是否正确，或者输入所对应的路由节点不存在',
                confirm: function(){
                    $.alert('请重新输入!'); // shorthand.
                }
            });
        }
        

         $(function () {
             var $vall = $('#table')
             $vall.bootstrapTable('destroy'
             );
             $vall.bootstrapTable({
                 data: data['routing'][$("#choose").val()-1]['routes']}
             );
        });

            // $("#table").bootstrapTable('load', data['routing'][$("#choose").val()-1]['routes']);
    });
    
}


