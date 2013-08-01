<?php
function __autoload($class_name) {
    include "Classes/" . $class_name . '.php';
}
error_reporting(E_ALL);

//connect to a single node in the cluster
$host = "WEB1.contoso.local";
$com = new COM(NLBNode::WMI($host));
$nodeInitial = new NLBNode($host,$com);

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