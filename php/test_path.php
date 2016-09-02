<?php
/**
 * Created by PhpStorm.
 * User: Junkai Huang
 * Date: 2016/6/26
 * Time: 2:33
 */

// $output = shell_exec('python D:\phpStudy\WWW\opentopo\python\simple_topo.py');
//passthru('python D:\phpStudy\WWW\opentopo\python\simple_topo.py ');
//http://localhost/opentopo/php/controller.php?network=5&connect= (1,2),(2,3),(3,4),(4,5),(5,3),(2,4)
//session_start();

$source = $_POST['source'];
$target = $_POST['target'];
if (!empty($source)) {
    $source = trim($source);
    $target = trim($target);
    $myfile = fopen("log.txt", "w") or die("Unable to open file!");
//    fwrite($myfile, " " . $_SESSION['network']);
//    fwrite($myfile, " " . $_SESSION['connect']);
    //    $a = arrayg();
//    exec('python ./some.py '.$k, $a);
//    echo $a[0];
    //  passthru('python D:\phpStudy\WWW\opentopo\python\simple_topo.py '.$network.' '.$connect.' '.$source.' '.$target);
    //$output = array();
    exec('python D:\phpStudy\WWW\opentopo\python\generate_optimal_path.py  '.$source.' '.$target);
    //fwrite($myfile, " ".$output);
    fclose($myfile);
    //echo '<script languae="JavaScript">;alert("这是";location.href="index.htm";</script>;';
    //echo '<script language="JavaScript">;alert("这是");</script>;';

    $filename = 'path_data.json';
    $json_string = file_get_contents($filename);

    echo  json_decode($json_string);

//
}