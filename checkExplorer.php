<?php

include_once("./checkRPC.php");
include_once("./checkExp.php");

$start_command = "./exe_start.sh";
$stop_command = "./exe_stop.sh";

#devTests for proof of work
# stop explorer
#echo shell_exec(escapeshellarg($stop_command));
# wait 5 seconds
#sleep(5);
# start explorer
#echo shell_exec(escapeshellarg($start_command)); 
# wait 20 seconds
#sleep(20);
$res_EXP = checkExplorer();
$res_RPC = checkRPC();
# check if res(EXP||RPC) == Integers
# handle res(EXP||RPC) != Integers
# type checks
$res_EXP_type = gettype($res_EXP);
$res_RPC_type = gettype($res_RPC);
if($res_RPC_type != $res_EXP_type){
	echo $res_RPC_type;
	echo $res_EXP_type;
	echo 'Mismatched response in comparison';
	if($res_RPC_type != 'integer' && $res_EXP_type == 'integer' && is_int($res_EXP_type)){
		echo 'Explorer status: OK';
		echo 'RPC status: Offline';
		$date = date('Y/m/d H:i:s');
		$txt = "RPC NOT IN SYNC: @ " . $date . " ";
		$myfile = file_put_contents('rpc_notsynced_logs.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
		return $txt;		
	}
	if($res_EXP_type != 'integer' && $res_RPC_type == 'integer' && is_int($res_RPC_type)){
	         echo 'RPC status: OK';
	         echo 'Explorer status: Offline';
	         $date = date('Y/m/d H:i:s');
	         $txt = "Explorer NOT IN SYNC: @ " . $date . " ";
	         $myfile = file_put_contents('explorer_notsynced_logs.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
	         return $txt;
	}
}
# enforce integer types
echo "Proceeding comparison of block numbers...";
# proceed to check EXP(explorer) && RPC(testnet.kekchain.com)
if(is_int($res_EXP) && is_int($res_RPC) && intVal($res_EXP) == intVal($res_RPC)){
	echo 'MATCH';
        $date = date('Y/m/d H:i:s');
        $txt = "EXPLORER IN SYNC: @ " . $date . " ";
        $myfile = file_put_contents('explorer_synced_logs.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
	return $txt;
} else {
	if(intVal($res_EXP) > intVal($res_RPC)){
		echo 'EXPLORER IS ON MAIN CHAIN';
		echo 'RPC SEEMS DELAYED! POSSIBLE CHAIN FORK || ALT-CHAIN DETECTED!';
		$date = date('Y/m/d H:i:s');
		$txt = "RPC NOT IN SYNC: @ " . $date . " ";
		$myfile = file_put_contents('rpc_notsynced_logs.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
		return $txt;
	}
        echo 'EXPLORER NOT IN SYNC... RETRYING IN 5 SECONDS';
	sleep(5);
	$res_EXP2 = checkExplorer();
	$res_RPC2 = checkRPC();
	if(intVal($res_EXP2) == intVal($res_RPC2)){
		echo 'MATCH-SECOND-ATTEMPT';
		$date = date('Y/m/d H:i:s');
		$txt = "EXPLORER IN SYNC: @ " . $date . " ";
		$myfile = file_put_contents('explorer_synced_logs.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
	} else {
                echo 'EXPLORER NOT IN SYNC... RETRYING IN 5 SECONDS';
		sleep(5);
		$res_EXP3 = checkExplorer();
        	$res_RPC3 = checkRPC();
        	if(intVal($res_EXP3) == intVal($res_RPC3)){
			echo 'MATCH-THIRD-ATTEMPT';
			$date = date('Y/m/d H:i:s');
			$txt = "EXPLORER IN SYNC: @ " . $date . " ";
			$myfile = file_put_contents('explorer_synced_logs.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
		} else {
                        echo 'EXPLORER NOT IN SYNC... RETRYING IN 5 SECONDS';
			sleep(5);
			$res_EXP4 = checkExplorer();
        		$res_RPC4 = checkRPC();
        		if(intVal($res_EXP4) == intVal($res_RPC4)){
				echo 'MATCH-FOURTH-ATTEMPT';
				$date = date('Y/m/d H:i:s');
				$txt = "EXPLORER IN SYNC: @ " . $date . " ";
				$myfile = file_put_contents('explorer_synced_logs.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
			} else {
				echo 'EXPLORER NOT IN SYNC... RETRYING IN 5 SECONDS';
				sleep(5);
				$res_EXP5 = checkExplorer();
                        	$res_RPC5 = checkRPC();
                        	if(intVal($res_EXP5) == intVal($res_RPC5)){
					echo 'MATCH-FIFTH-ATTEMPT';
					$date = date('Y/m/d H:i:s');
					$txt = "EXPLORER IN SYNC: @ " . $date . " ";
					$myfile = file_put_contents('explorer_synced_logs.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
				} else {
					$date = date('Y/m/d H:i:s');
					$txt = "EXPLORER NOT IN SYNC: REBOOTING @ " . $date . " ";
					$myfile = file_put_contents('explorer_notsynced_logs.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
					echo 'REBOOTING EXPLORER';
					echo shell_exec(escapeshellarg($stop_command));
					sleep(5);
					echo 'EXPLORER STOPPED';
					sleep(20);
					echo shell_exec(escapeshellarg($start_command));
					echo 'EXPLORER STARTED';
				}
			}
		}
	}
}
