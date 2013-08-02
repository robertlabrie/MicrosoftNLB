<?php
require_once "../vendor/autoload.php";
use MicrosoftNLB\NLBNode;

if (!isset($argv[1]))
{
	echo "usage php nodecontrol.php hostname option\n";
	echo "where hostname is a node in the cluster\n";
	echo "and option is start or stop\n";
}
$host = $argv[1];

//connect to a single node in the cluster
$com = new COM(NLBNode::WMI($host));
$node = new MicrosoftNLB\NLBNode($host,$com);

echo $node->ComputerName . ": StatusCode=" . $node->StatusCode . "\n";
if ($argv[2] == 'start')
{
	$node->Start();
}
if ($argv[2] == 'stop')
{
	$node->Stop();
}

//now refresh the node state
$node->open();

//and print the status again
echo $node->ComputerName . ": StatusCode=" . $node->StatusCode . "\n";
