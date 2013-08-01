<?php
class MicrosoftNLB_NodeSetting
{
	private $properties = Array(
		'AdapterGuid',
		'AliveMessagePeriod',
		'AliveMessageTolerance',
		'Caption',
		'ClusterModeOnStart',
		'ClusterModeSuspendOnStart',
		'DedicatedIPAddress',
		'DedicatedIPAddresses',
		'DedicatedNetworkMask',
		'DedicatedNetworkMasks',
		'Description',
		'DescriptorsPerAlloc',
		'FilterIcmp',
		'HostPriority',
		'IpSecDescriptorTimeout',
		'MaskSourceMAC',
		'MaxConnectionDescriptors',
		'MaxDescriptorsPerAlloc',
		'Name',
		'NumActions',
		'NumAliveMessages',
		'NumberOfRules',
		'NumPackets',
		'PersistSuspendOnReboot',
		'RemoteControlUDPPort',
		'SettingID',
		'TcpDescriptorTimeout'
	);
	private $methods = Array(
		'GetPortRule',
		'GetPortRuleEx',
		'LoadAllSettings',
		'SetDefaults'
	);
	protected $obj;
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