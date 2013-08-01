<?php
class MicrosoftNLB_PortRuleEx
{
	private $properties = Array(
		'AdapterGuid',
		'Affinity',
		'ClientStickinessTimeout',
		'EndPort',
		'EqualLoad',
		'FilteringMode',
		'LoadWeight',
		'Name',
		'PortState',
		'Priority',
		'Protocol',
		'StartPort',
		'VirtualIpAddress'
	);
	private $methods = Array(
		'SetDefaults'
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