  /**
 * Created by Junkai Huang on 2016/6/12.
 */
  function reload() {
    var myChart = echarts.init(document.getElementById('main'));

    myChart.showLoading();
    $.get('python/data/topology_data.json', function (data) {
    myChart.hideLoading();
    var option = {
        legend: {
            top:'10px',
            left:'10px',
            data: [{
                name:  'Network'
            },
                {
                name:  'Router'
            }]
        },
       tooltip: {
                formatter:'{b}<br />{c}'

       },
        series: [{
            type: 'graph',
            layout: 'force',
            symbolSize:25,
            roam:true,
            animationDuration:'3000',

            /*animationEasing:'cubiclnOut', */

            label: {
                normal: {
                    position: 'right',
                    formatter: '{b}'
                }
            },

            draggable: true,
            data: data.nodes.map(function (node, idx) {
                node.id = idx;
                return node;
            }),

            lineStyle:{
                normal:{
                    width:3,
                    curveness:0
                },
                emphasis:{
                    width:3,
                    color:'#FCAC45',
                    curveness:0
                }
            },
            categories: [
                {
                    name:"Router",
                    symbol:"circle",
                    symbolSize:10,
                             itemStyle: {
                         normal: {
                               brushType: "both",
                              color: "#D0D102",
                               strokeColor: "#5182ab",
                             }
                          }
                },
                    {
                    name:"Network",
                    symbol:"circle",
                    symbolSize:40,
                    itemStyle: {
                         normal: {
                               brushType: "both",
                              color: "#00A1CB",
                               strokeColor: "#5182ab",
                             }
                          }
                  }
            ],
            force: {
                // initLayout: 'circular'
                // gravity: 0
                // repulsion: 20,
                edgeLength: 80,
                repulsion: 400,
            },
            edges: data.links
        }]
    };
    myChart.setOption(option);
});
  }
