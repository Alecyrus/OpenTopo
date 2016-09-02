<?php
/**
 * Created by PhpStorm.
 * User: Junkai Huang
 * Date: 2016/6/25
 * Time: 15:29
 */

    // $output = shell_exec('python D:\phpStudy\WWW\opentopo\python\simple_topo.py');
    //passthru('python D:\phpStudy\WWW\opentopo\python\simple_topo.py ');
    //http://localhost/opentopo/php/controller.php?network=5&connect= (1,2),(2,3),(3,4),(4,5),(5,3),(2,4)


    session_start();
    $network = $_POST['network'];
    $connect = $_POST['connect'];
    if (!empty($network))
    {
        $network = trim($network);
        $connect = trim($connect);
        $_SESSION["network"]=$network;
        $_SESSION["connect"]=$connect;


        echo $network;
        echo $connect;
        $myfile = fopen("log.txt", "w") or die("Unable to open file!");
        fwrite($myfile, " ".$network);
        fwrite($myfile, " ".$connect);
        fclose($myfile);
    //    $a = array();
    //    exec('python ./some.py '.$k, $a);
    //    echo $a[0];
        passthru('python D:\phpStudy\WWW\opentopo\python\simple_topo.py 1 -n '.$network.' -c '.$connect);
        //exec('python D:\phpStudy\WWW\opentopo\python\simple_topo.py 1 '.$network.' '.$connect.' 0 0 ');

    }
