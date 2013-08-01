<?php
require_once "vendor/autoload.php";
use MicrosoftNLB\NLBNode;

if (!isset($argv[1]))
{
	echo "usage php listnode.php hostname\n";
	echo "where hostname is a node in the cluster\n";
}
$host = $argv[1];

//connect to a single node in the cluster
$com = new COM(NLBNode::WMI($host));
$nodeInitial = new MicrosoftNLB\NLBNode($host,$com);

//get the peers and pack them into an array
$clusterNodes = $nodeInitial->peers();
$nodes = Array();
foreach ($clusterNodes as $wmiNode)
{
	$host = $wmiNode->ComputerName;
	$nodes[$host] = new NLBNode($host);
	$nodes[$host]->open();	//populate the WMI object
}

//now that we're aware of all the nodes in the cluster, do something like print their status
foreach ($nodes as $node)
{
	echo $node->ComputerName . "\t" . $node->StatusCode . "\n";
}