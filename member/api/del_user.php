<?php
session_start();
if(!(isset($_SESSION['user']) && isset($_SESSION['alert']))){
    header("location:../index.php");
    exit();
}
//一定要加exit
//沒加的話會變成你雖然把他導走了，但下面的程式還是繼續執行


$dsn="mysql:host=localhost;charset=utf8;dbname=member_test";
$pdo=new PDO($dsn,'root','');

$user_id=$pdo->query("select `id` from `account` where `account`='{$_SESSION['user']}'")->fetchColumn();

// $sql_account="DELETE FROM `account` where `account`='{$_SESSION['user']}'";
// $sql_member="DELETE FROM `member` where `id`=?";
$sql_account="DELETE FROM `account` where `id`='{$user_id}'";
$sql_member="DELETE FROM `member` where `id`='{$user_id}'";


$pdo->exec($sql_account);
$pdo->exec($sql_member);
//記得他的session跟cookie也一起刪掉
unset($_SESSION['user']);
header("location:../index.php");

?>