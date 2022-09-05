<?php
function checkExplorer() { 
	$url = "https://testnet-explorer.kekchain.com/api/eth-rpc";

        $data = array(
                "jsonrpc" => "2.0",
                "method" => "eth_blockNumber",
                "params" => array(),
                "id" => "0"
        );

        $json_encoded_data = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_encoded_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($json_encoded_data))
        );

        $result = json_decode(curl_exec($ch));
        curl_close($ch);

        $parsed = hexdec($result->result);
	echo $parsed;
	return $parsed;
}
//$res = checkExplorer();
