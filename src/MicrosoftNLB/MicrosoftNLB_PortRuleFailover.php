<?php
namespace MicrosoftNLB;
class MicrosoftNLB_PortRuleFailover
{
	protected $properties = Array(
		'AdapterGuid',
		'Caption',
		'Description',
		'EndPort',
		'Name',
		'Priority',
		'Protocol',
		'SettingID',
		'StartPort'
	);
	private $methods = Array(
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