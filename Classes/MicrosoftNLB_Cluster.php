<?php
class MicrosoftNLB_Cluster
{
	private $properties = Array(
		'Caption',
		'ClusterState',
		'CreationClassName',
		'Description',
		'InstallDate',
		'Interconnect',
		'InterconnectAddress',
		'MaxNumberOfNodes',
		'Name',
		'NameFormat',
		'PrimaryOwnerContact',
		'PrimaryOwnerName',
		'Roles',
		'Status',
		'Types'
	);
	private $methods = Array(
		'Disable',
		'Enable',
		'Drain',
		'DrainStop',
		'Resume',
		'Start',
		'Stop',
		'Suspend'
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