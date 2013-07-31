<?php
class NLBNode
{
	private $properties = Array(
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
		'StatusCode',
		);
	private $methods = Array(
		'Disable',
		'DisableEx',
		'Drain',
		'DrainEx',
		'DrainStop',
		'Enable',
		'EnableEx',
		'Resume',
		'SetPowerState',
		'Start',
		'Stop',
		'Suspend',
	);
	private $hostname;
	private $com;
	private $node;
	public function open()
	{
		//re-query WMI to get the mode up to date info about the node
		$nodes = $this->com->ExecQuery("SELECT * FROM MicrosoftNLB_Node where ComputerName = '" . $this->hostname . "'");
		foreach ($nodes as $node)
		{
			$this->node = $node;
		}
	
	}
	public function getNode()
	{
		return $this->node;
	}
	public function __construct($hostname)
	{
		$this->hostname = $hostname;
		$this->com = new COM( 'winmgmts://' . $hostname . '/root/MicrosoftNLB' );
		$this->open();
	}
	public function __get($key)
	{
		if (in_array($key,$this->properties)) { return $this->node->$key; }
	}
	public function __set($key,$value)
	{
		if (in_array($key,$this->properties)) { $this->node->$key = $value; }
	}
	public function __call($key,$arguments)
	{
		if (in_array($key,$this->methods)) { return $this->node->$key($arguments); }
	}
}