<?php
namespace MicrosoftNLB;
class NLBNode extends MicrosoftNLB_Node
{
	private $com;
	private $host;
	private $open;
	public $scrap;
	public $ch;
	public $statusOffline = Array("0","1005","1009","1013");
	public $statusOnline = Array("1006","1007","1008");
	//override the constructor to take an optional WMI object
	public function __construct($host,$com = null)
	{
		if (!$com) { $com = new \COM(NLBNode::WMI($host)); }
		$this->com = $com;
		$this->host = $host;
		$this->open();	//open the object
	}

	/**
	 * Run the WQL to get a single WMI object representing this node, then set it back to $this->obj for usage
	 **/
	public function open()
	{
		$this->open = true;
		try
		{
			$nodes = $this->com->ExecQuery("SELECT * FROM MicrosoftNLB_Node where ComputerName = '" . $this->host . "'");
		}
		catch (\Exception $e)
		{
			$this->open = false;
		}
		if ($this->open)
		{
			if (!$nodes) { return false; }
			foreach ($nodes as $node)
			{
				$this->obj = $node;
			}
		}
		return $this->open;
	
	}
	public function isOpen() { return $this->open; }
	public function available()
	{
		return in_array($this->StatusCode,$this->statusOnline);
	}
	public function peers()
	{
	
		$nodes = $this->com->ExecQuery("SELECT * FROM MicrosoftNLB_Node");
		return $nodes;
	}
	public static function WMI($host)
	{
		 return 'winmgmts://' . $host . '/root/MicrosoftNLB';
	}
	public function getNode()
	{
		return $this->node;
	}
}