<?php
class NlbsNic
{
	private $properties = Array(
		''
	);
	private $methods = Array(
		'GetCompatibleAdapterGuids',
		'GetClusterConfiguration',
		'UpdateClusterConfiguration',
		'QueryConfigurationUpdateStatus',
		'ControlCluster',
		'GetClusterMembers',
		'RegisterManagementApplication',
		'UnregisterManagementApplication',
		'GetVersion',
		'GetClusterConfigurationEx',
		'UpdateClusterConfigurationEx',
		'QueryConfigurationUpdateStatusEx',
		'GetIPv6RoutePrefixes',
		'GetNetworkConfiguration',
		'SetIPv6NetworkPrefixLength'
	);
	private $obj;
	public function __construct($obj)
	{
		$this->obj = $obj;
	}
	public function __get($key)
	{
		if (in_array($key,$this->properties)) { return $this->obj->$key; }
	}
	public function __set($key,$value)
	{
		if (in_array($key,$this->properties)) { $this->obj->$key = $value; }
	}
	public function __call($key,$arguments)
	{
		if (in_array($key,$this->methods)) { return $this->obj->$key($arguments); }
	}
}