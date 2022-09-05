<?php

include_once("./checkRPC.php");
include_once("./checkExp.php");

$res_EXP = checkExplorer();
$res_RPC = checkRPC();

if(intVal($res_EXP) == intVal($res_RPC)){
	echo 'MATCH';
        $date = date('Y/m/d H:i:s');
        $txt = "EXPLORER IN SYNC: @ " . $date . " ";
        $myfile = file_put_contents('explorer_synced_logs.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
} else {
        echo 'EXPLORER NOT IN SYNC... RETRYING IN 10 SECONDS';
	sleep(10);
	$res_EXP2 = checkExplorer();
	$res_RPC2 = checkRPC();
	if(intVal($res_EXP2) == intVal($res_RPC2)){
        	echo 'MATCH-SECOND-ATTEMPT';
	} else {
                echo 'EXPLORER NOT IN SYNC... RETRYING IN 10 SECONDS';
		sleep(10);
		$res_EXP3 = checkExplorer();
        	$res_RPC3 = checkRPC();
        	if(intVal($res_EXP3) == intVal($res_RPC3)){
                	echo 'MATCH-THIRD-ATTEMPT';
		} else {
                        echo 'EXPLORER NOT IN SYNC... RETRYING IN 10 SECONDS';
			sleep(10);
			$res_EXP4 = checkExplorer();
        		$res_RPC4 = checkRPC();
        		if(intVal($res_EXP4) == intVal($res_RPC4)){
                		echo 'MATCH-FOURTH-ATTEMPT';
			} else {
				echo 'EXPLORER NOT IN SYNC... RETRYING IN 10 SECONDS';
				sleep(10);
				$res_EXP5 = checkExplorer();
                        	$res_RPC5 = checkRPC();
                        	if(intVal($res_EXP5) == intVal($res_RPC5)){
                                	echo 'MATCH-FIFTH-ATTEMPT';
				} else {
					$date = date('Y/m/d H:i:s');
					$txt = "EXPLORER NOT IN SYNC: REBOOTING @ " . $date . " ";
					$myfile = file_put_contents('explorer_sync_logs.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
					echo 'REBOOTING EXPLORER';
				}
			}
		}
	}
}
