<?php
$g['clusterip'] = "10.10.10.50";
$g['testurl'] = "/nlb/nlb.php";
$g['interval'] = 3;
$g['loglevel'] = Array("D","I","N","E");
require_once "../vendor/autoload.php";
use MicrosoftNLB\NLBNode;

$loop = React\EventLoop\Factory::create();

$clusterNode = new NLBNode($g['clusterip']);

$nodes = $clusterNode->peers();
$i = 0;
foreach ($nodes as $node)
{
	$i++;
	$n = new NLBNode($node->ComputerName);
	$g['nodes'][$i] = &$n;
	dbprint("I","$i:" . $n->ComputerName . ":starting");
	$loop->addPeriodicTimer($g['interval'], function ($timer) use ($g,$i,$n) {
		$n->ch = curl_init();
		nodeCheck($g,$i,$n);
	});

}
$loop->run();
function nodeCheck($g,$index,&$node)
{
	//refresh the node status from WMI
	dbprint("D","$index:WMI node status checking");
	$status = $node->open();
	dbprint("D","$index:WMI node status: $status");
	//if not successful, give up
	if (!$status)
	{
		dbprint("E","$index:" . $node->ComputerName . ":failed to refresh");
		return;
	}
	//some helper vars
	$compname = $node->ComputerName;
	dbprint("I","$index:status " . $node->StatusCode);
	//check to see if the node is in load
	if (!$node->available())
	{
		dbprint("I","$index:$compname:not in load");
		return;
	}
	
	//Setup cURL
	$url = "http://" . $node->ComputerName . $g['testurl'];
	$ch = $node->ch;
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	
	//do the check
	dbprint("I","$index:checking $url");
	$working = false;
	$data = curl_exec($ch);
	$res = curl_getinfo($ch);
	if ($res['http_code'] == '200') { $working = true; }
	dbprint("I","$index:status $working (" . $res['http_code'] . ")");
	
	//if it's in load but not working, a good time to remove it from load right?
	if (!$working)
	{
		try
		{
			dbprint("N","$index:http failure - stopping node");
			$node->Stop();
		}
		catch (Exception $c)
		{
			dbprint("E","$index:WMI error while stopping node");
		}
	}
}

function dbprint($level,$msg)
{
	echo "$level:$msg\n";
}