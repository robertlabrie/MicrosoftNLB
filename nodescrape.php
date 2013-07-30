<?php
include_once("./Classes/NLBNode.php");
error_reporting(E_ALL);
$host = "10.10.10.11";

$obj = new COM( 'winmgmts://' . $host . '/root/MicrosoftNLB' );

$nodes = $obj->ExecQuery("SELECT * FROM MicrosoftNLB_Node");
$i = 0;
foreach ($nodes as $node)
{
	
	//echo $node->ComputerName . "\t" . $node->DedicatedIPAddress . "\t" . $node->StatusCode . "\n";
	$oNode[$i] = new NLBNode($node->ComputerName);
	//$n = $oNode[$i]->getNode();
	//$n->Stop();
	echo $oNode[$i]->ComputerName . "\t" . $oNode[$i]->DedicatedIPAddress . "\t" . $oNode[$i]->StatusCode . "\n";
	//$oNode[$i]->Start();
	$oNode[$i]->Stop();
	$oNode[$i]->refresh();
	echo $oNode[$i]->ComputerName . "\t" . $oNode[$i]->DedicatedIPAddress . "\t" . $oNode[$i]->StatusCode . "\n";
	$i++;
}

