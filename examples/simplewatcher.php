<?php
$g['clusterip'] = "10.10.10.50";
$g['testurl'] = "/nlb/nlb.php";
$g['interval'] = 3;
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
	echo "$i:I:"  $n->ComputerName . ":starting\n";
	$loop->addPeriodicTimer($g['interval'], function ($timer) use ($g,$i,$n) {
		nodeCheck($g,$i,$n);
	});

}
$loop->run();
function nodeCheck($g,$index,&$node)
{
	$status = $node->open();	//refresh the node status from WMI
	if (!$status)
	{
		echo "$index:E:" . $node->ComputerName . ":failed to get status\n";
	}
	$url = "http://" . $node->ComputerName . $g['testurl'];
	return;
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);

	echo "$index:I: checking $url\n";
	$working = false;
	$data = curl_exec($ch);
	$res = curl_getinfo($ch);
	if ($res['http_code'] == '200') { $working = true; }
	
	if (!$working)
	{
		//echo "$index:E:
	}

	
}