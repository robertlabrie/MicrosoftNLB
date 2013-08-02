<?php
/******************************/
/* user configuration block   */
$host = "WEB1.contoso.local";
$interval = 5;

/******************************/
require_once "../vendor/autoload.php";
use MicrosoftNLB\NLBNode;
$loop = React\EventLoop\Factory::create();

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

$loop->addPeriodicTimer($interval, function ($timer) {
	$nodes = $GLOBALS["nodes"];
	foreach ($nodes as $node)
	{
		$node->open();
		echo $node->ComputerName . "\t" . $node->StatusCode . "\n";
	}
});
$loop->run();
