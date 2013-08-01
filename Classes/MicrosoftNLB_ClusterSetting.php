<?php
class MicrosoftNLB_ClusterSetting
{
	private $properties = Array(
		'AdapterGuid',
		'BDAReverseHash',
		'BDATeamActive',
		'BDATeamId',
		'BDATeamMaster',
		'Caption',
		'ClusterIPAddress',
		'ClusterIPToMulticastIP',
		'ClusterMACAddress',
		'ClusterName',
		'ClusterNetworkMask',
		'Description',
		'IdentityHeartbeatEnabled',
		'IgmpSupport',
		'MulticastIPAddress',
		'MulticastSupportEnabled',
		'Name',
		'RemoteControlEnabled',
		'SettingID',
		'UnicastInterHostCommSupportEnabled'
	);
	private $methods = Array(
		'SetPassword',
		'LoadAllSettings',
		'SetDefaults',
		'AccessNLBRegParam'
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