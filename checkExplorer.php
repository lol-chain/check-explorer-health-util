<?php

include_once("./checkRPC.php");
include_once("./checkExp.php");

$res_EXP = checkExplorer();
$res_RPC = checkRPC();

if(intVal($res_EXP) == intVal($res_RPC)){
	echo 'MATCH';
}
