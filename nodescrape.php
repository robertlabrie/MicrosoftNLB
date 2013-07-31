<?php
include_once("./Classes/NLBNode.php");
error_reporting(E_ALL);
$host = "10.10.10.11";

$obj = new COM(NLBNode::WMI($host));

$nodes = $obj->ExecQuery("SELECT * FROM MicrosoftNLB_Node");
$i = 0;
foreach ($nodes as $node)
{
	
	//echo $node->ComputerName . "\t" . $node->DedicatedIPAddress . "\t" . $node->StatusCode . "\n";
	$oNode[$i] = new NLBNode(new COM(NLBNode::WMI($node->ComputerName)), $node->ComputerName);
	//$n = $oNode[$i]->getNode();
	//$n->Stop();
	echo $oNode[$i]->ComputerName . "\t" . $oNode[$i]->DedicatedIPAddress . "\t" . $oNode[$i]->StatusCode . "\n";
	//$oNode[$i]->Start();
	//$oNode[$i]->Start();
	$oNode[$i]->open();
	echo $oNode[$i]->ComputerName . "\t" . $oNode[$i]->DedicatedIPAddress . "\t" . $oNode[$i]->StatusCode . "\n";
	$i++;
}

