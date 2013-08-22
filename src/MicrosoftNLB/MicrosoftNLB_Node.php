<?php
namespace MicrosoftNLB;
class MicrosoftNLB_Node
{
	protected $properties = Array(
		'Caption',
		'ComputerName',
		'CreationClassName',
		'DedicatedIPAddress',
		'Description',
		'HostPriority',
		'InitialLoadInfo',
		'InstallDate',
		'LastLoadInfo',
		'Name',
		'NameFormat',
		'PowerManagementCapabilities',
		'PowerManagementSupported',
		'PowerState',
		'PrimaryOwnerContact',
		'PrimaryOwnerName',
		'ResetCapability',
		'Roles',
		'Status',
		'StatusCode'
	);
	private $methods = Array(
		'SetPowerState',
		'Disable',
		'Enable',
		'Drain',
		'DisableEx',
		'EnableEx',
		'DrainEx',
		'DrainStop',
		'Resume',
		'Start',
		'Stop',
		'Suspend'
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