<?php
namespace MicrosoftNLB;
use MicrosoftNLB\MicrosoftNLB_Node;
class NLBNode extends MicrosoftNLB_Node
{
	private $com;
	private $host;
	
	//override the constructor to take an optional WMI object
	public function __construct($host,$com = null)
	{
		if (!$com) { $com = new \COM(NLBNode::WMI($host)); }
		$this->com = $com;
		$this->host = $host;
		$this->open();	//open the object
	}

	/**
	Run the WQL to get a single WMI object representing this node, then set it back to $this->obj for usage
	**/
	public function open()
	{
		try
		{
			$nodes = $this->com->ExecQuery("SELECT * FROM MicrosoftNLB_Node where ComputerName = '" . $this->host . "'");
			if (!$nodes) { return false; }
			foreach ($nodes as $node)
			{
				$this->obj = $node;
			}
		}
		catch (Exception $e)
		{
			return false;
		}
		return true;
	
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