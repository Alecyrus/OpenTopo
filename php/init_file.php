<?php
/**
 * Created by PhpStorm.
 * User: Junkai Huang
 * Date: 2016/6/26
 * Time: 17:12
 */

//上传文件
$tmparr = $_FILES['filename'];
if($tmparr['name']==''){
    echo "<script>alert('请添加上传文件');history.go(-1);</script>";
}
$finalfile="../python/media/";
//储存文件，有新文件上传会把旧同名文件覆盖，如果想要在服务器端保留所有上传的文件可以在$finalfile变量的名字前加上时间戳
move_uploaded_file($tmparr["tmp_name"],'D:/phpStudy/WWW/opentopo/python/media/input.json');

exec('python D:\phpStudy\WWW\opentopo\python\simple_topo.py 2');

echo "<script>
window.location='../index.php';
confirm('success');

</script>";

