<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="pragma" content="no-cache">

    <title>OpenTopo - 一个简单的网络模拟应用 </title>
    <meta name="description" content="Spirit8 is a Digital agency one page template built based on bootstrap framework. This template is design by Robert Berki and coded by Jenn Pereira. It is simple, mobile responsive, perfect for portfolio and agency websites. Get this for free exclusively at ThemeForces.com">
    <meta name="keywords" content="bootstrap theme, portfolio template, digital agency, onepage, mobile responsive, spirit8, free website, free theme, themeforces themes, themeforces wordpress themes, themeforces bootstrap theme">
    <meta name="author" content="Junkai Huang">

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css"  href="css/sources/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="css/sources/bootstrap-table.min.css">
    <link rel="stylesheet" href="css/sources/fileinput.min.css">
    <link rel="stylesheet" href="css/sources/jquery-confirm.min.css">
    <!-- Slider
    ================================================== -->
    <link href="css/sources/owl.carousel.css" rel="stylesheet" media="screen">
    <link href="css/sources/owl.theme.css" rel="stylesheet" media="screen">

    <!-- include CSS & JS files -->
    <!-- Stylesheet
    ================================================== -->
    <link rel="stylesheet" type="text/css"  href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/sources/responsive.css">
    <link rel="stylesheet" href="css/sources/buttons.css">

    <script type="text/javascript" src="js/sources/jquery-3.0.0.min.js"></script>

    <!--echart -->
    <script type="text/javascript" src="js/sources/echarts.js"></script>
    <script type="text/javascript" src="js/sources/dataTool.js"></script>


    <!-- Fonts -->
    <link href='http://fonts.useso.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.useso.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,700,300,600,800,400' rel='stylesheet' type='text/css'>


    <!-- IE  Brower -->
    <script type="text/javascript" src="js/sources/modernizr.custom.js"></script>

</head>
<body>
<!-- Navigation
==========================================-->
<nav id="tf-menu" class="navbar navbar-default navbar-fixed-top">
    <div class="container">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">OpenTopo</a>
        </div>


        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#ot-home" class="page-scroll">Home</a></li>
                <li><a href="#ot-settings" class="page-scroll">Settings</a></li>
                <li><a href="#ot-topology" class="page-scroll">Topology</a></li>
                <li><a href="#ot-routing" class="page-scroll"> Routing</a></li>
                <li><a href="#ot-save" class="page-scroll">Save</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Home Page
==========================================-->
<div id="ot-home" class="text-center">

    <div class="overlay">
        <div  class="content" >
            <h1>Welcome to <strong><span class="color">OpenTopo</span></strong></h1>
            <p   class="lead" style="margin-top: 15px">OpenTopo可以简单模拟一个真实的网络拓扑环境，还可以为你的云平台定制一套网络拓扑信息。</p>


        </div>
        <div style="margin-top: 150px">
            <a href="#ot-settings" class="fa fa-angle-down page-scroll"></a>
        </div>

    </div>
</div>

<!-- Settings Page
==========================================-->
<div id="ot-settings" >
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <div class="about-text">
                    <div class="section-title">
                        <h2 >Settings</h2>
                        <hr>
                        <div class="clearfix"></div>
                    </div>
                    <p class="intro">制定网络拓扑的具体信息</p>
                    <ul class="about-list">
                        <li>
                            <span class="fa fa-dot-circle-o"></span>
                            <strong>网络</strong> - <em>网络拓扑中网络个数，上限为10</em>
                        </li>
                        <li>
                            <span class="fa fa-dot-circle-o"></span>
                            <strong>互联关系</strong> - <em>网络之间的连通关系，通过"1,2;2,3"的方式指定</em>
                        </li>
                        <li>
                            <span class="fa fa-dot-circle-o"></span>
                            <strong>自定义</strong> - <em>可以上传配置文件，查看<a href="python/data/input.json" target="_blank" >配置文件实例</a></em>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="span6">


                <form class="form-horizontal" action="php/controller.php" method="post">
                    <fieldset>

                        <div id="legend" class="">
                            <!-- <legend class="">表单名</legend> -->
                        </div>

                        <div class="input-group">
                            <label   style="padding-top: 60px" for="network">网络个数 </label>
                            <input type="text" id="network" name="network" class="form-control" placeholder="3" >

                            <label  style="padding-top: 20px" for="connect"> 互联关系 </label>
                            <input type="text"  id="connect" name="connect" class="form-control" placeholder="1,2;2,3" >

                        </div>



                    </fieldset>
                </form >
                <form action="php/init_file.php" method="post"  enctype="multipart/form-data">
                    <div class="container" style="padding-top: 20px;width: 540px;margin-left: 49%">
                        <label class="control-label">自定义</label>
                        <input id="input_file"  type="file" class="file"
                               data-show-preview="false"
                               data-max-file-count="4"
                               name="filename">

                        <div style="padding-top: 20px;margin-left: 300px">
                                <span class="button-wrap">
                                     <a onclick="sumbit_info()" id="submit" class="button button-pill ">提交</a>
                                </span>
                        </div>
<!--                        <span class="button-wrap">-->
<!--                                     <a onclick="show_info()" class="button button-pill " >Goto</a>-->
<!--                                </span>-->
                        
                        

                    </div>
                </form>

                <div class="text-center "   style="margin-top: 60px;">
                    <a onclick="reload()" href="#ot-topology" class="fa fa-angle-down page-scroll "></a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Transition_one Page
==========================================-->
<div id="ot-transition-one" class="text-center">
    <div class="overlay">
        <div class="container">
            <div class="section-title center">
                <h2>Transition_one</h2>
                <div class="line">
                    <hr>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Topology Section
==========================================-->
<div id="ot-topology" >
    <div class="container">
        <div class="section-title ">
            <h2>Topology </h2>
            <div class="line">
                <hr>
            </div>
            <div class="clearfix"></div>
            <!--
            <small><em>Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</em></small>
        -->
        </div>
        <div class="row" >
            <div class="col-md-8" id="main" style=" height:400px;max-height: 800px" >
            </div>
            <div class="col-md-4" id="main1"  style="height: 400px" >


                <form class="form-horizontal">
                    <fieldset>

                        <div id="legend1" class="">
                            <a style="font-family: 'Microsoft JhengHei UI Light';font-size: 40px">测试路径</a>
                        </div>

                        <div class="input-group">
                            <label   style="padding-top: 20px" for="source">出发节点 </label>
                            <input type="text" id="source" name="source" class="form-control" placeholder="" >

                            <label  style="padding-top: 20px" for="target"> 目的结点 </label>
                            <input type="text"  id="target" name="source" class="form-control" placeholder="" >

                        </div>
                        <div style="padding-top: 30px">
                            <a  onclick="generate_path()" class="button button-block button-rounded button-highlight button-large">Go</a>
                        </div>

                    </fieldset>

                </form>


            </div>

        </div>
        <div >
            <a onclick="reload()" class="button button-glow button-border button-rounded button-primary">刷新</a>
        </div>

        <div class="text-center" style="margin-top: 0px">
            <a href="#ot-routing" class="fa fa-angle-down page-scroll "></a>
        </div>


    </div>
</div>




<!-- Transition_two Section
==========================================-->
<div id="ot-transition_two" class="text-center">
    <div class="overlay">
        <div class="container">

            <div class="section-title center">
                <h2>Transition_two</h2>
                <div class="line">
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Routing Section
==========================================-->
<div id="ot-routing" >
    <div class="container" > <!-- Container -->
        <div class="section-title ">
            <h2>Routing</h2>
            <div class="line">
                <hr>
            </div>
            <div class="clearfix"></div>
            <!--
            <small><em>Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</em></small>
        -->
        </div>
        <div class="row" style="padding-top: 0px">

            <div class="col-md-3"id="main4"  style=" height: 400px;padding-left: 0px" >
                <div class="input-group" style="padding-top: 60px">
                    <label   style="padding-top: 60px" for="network">输入路由序号 </label>
                    <input type="text" id="choose" class="form-control" placeholder=""  >
                </div>
                <button onclick="routing()" id="reload_data" class="button button-pill button-primary" style="margin: 50px;margin-left: 100px">提交</button>
            </div>

            <div class="col-md-9"id="main2" style=" height:400px;padding-left: 30px" >
                <table id="table"
                       data-height="460"
                       data-side-pagination="server"
                       data-pagination="true">
                    <thead>
                    <tr>
                        <th data-field="destination">Destination</th>
                        <th data-field="nexthop">Nexthop</th>
                        <th data-field="metric">Metric</th>
                    </tr>
                    </thead>

                </table>

            </div>

        </div>
        <div class="text-center" style="margin-top: 100px;margin-bottom: 0px">
            <a href="#ot-save" class="fa fa-angle-down page-scroll "></a>
        </div>
    </div>


</div>
</div>

<!-- Transition_three Section
==========================================-->
<div id="ot-transition_three" class="text-center">
    <div class="overlay">
        <div class="container">
            <div class="section-title center">
                <h2>Transition_three</h2>
                <div class="line">
                    <hr>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Save Section
==========================================-->
<div id="ot-save" class="text-center">
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="section-title center">
                    <h2 >Save As Json File</h2>
                    <div class="line">
                        <hr>
                    </div>
                    <div class="clearfix"></div>

                    <small style="font-family: 'Microsoft JhengHei UI'">可以选择将生成网络拓扑模板信息保存为Json格式文件，可以用于OpenStack平台网络拓扑的并行创建，以及其他网络模拟分析软件，比如Gephi等等。</small>

                </div>
                <div class="row">
                    <div clas="col-md-12" >
                        <a href="python/data/entire_topology.json"
                           style="width: 200px;margin-top:80px;margin-bottom: 60px"
                           class="button button-glow button-rounded button-highlight">点击查看</a>

                    </div>
                </div>
            </div
        </div>

    </div>
</div>

<nav id="footer">
    <div class="container">
        <div class="pull-left fnav">
            <p>  Copyright © 2016. Designed by <a href="http://alecyrus.com/">Junkai Huang</a></p>
        </div>
        <div class="pull-right fnav">
            <ul class="footer-social">
                <li><a href="http://alecyrus.com/OpenTopo-Linux/"><i class="fa fa-github"></i></a></li>
                <li><a href="https://plus.google.com/u/0/108584696439489093003"><i class="fa fa-google-plus"></i></a></li>
            </ul>
        </div>
    </div>
</nav>




<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="js/sources/bootstrap.js"></script>
<script type="text/javascript" src="js/sources/fileinput.min.js"></script>
<script type="text/javascript" src="js/sources/zh.js"></script>
<script type="text/javascript" src="js/sources/SmoothScroll.js"></script>
<script type="text/javascript" src="js/sources/jquery.isotope.js"></script>


<script src="js/sources/owl.carousel.js"></script>


<script src="js/sources/bootstrap-table.min.js"></script>
<script src="js/sources/typewriter.js"></script>
<script src="js/sources/jquery-confirm.min.js"></script>
<!-- Javascripts
================================================== -->
<script type="text/javascript" src="js/main.js"></script>

<!-- generate the topology -->
<script type="text/javascript" src="js/topology.js"></script>
<script type="text/javascript" src="js/routing.js">  </script>
<script type="text/javascript" src="js/settings.js">  </script>
<script type="text/javascript" src="js/path.js">  </script>
<script type="text/javascript" src="js/file_upload.js"></script>
<script type="text/javascript" src="js/dialog.js"></script>



</body>
</html>