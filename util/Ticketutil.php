<?php
	require_once 'MySqlutil.php';
class Ticket {

	private $openid;
	private $name;
	private $stucode;
	private $grade;
	private $status;//抢票状态
	private $level;//抢票等级，大众评委、VIP、普通票
	private $level1 = 15;
	private $level2 = 20;
	private $level3 = 80;
	private $name1 = "大众评委";
	private $name2 = "VIP票";
	private $name3 = "普通票";
	private $num = 115;
	private $numt = 50;
	private $num15 = 50;
	private $sqlname = "ticketxsfinal";
	private $userinfo = "userinfo";

	function getOpenId()
	{
		return $this->openid;
	}

	function getName()
	{
		return $this->name;
	}

	function getStucode()
	{
		return $this->stucode;
	}

	function getGrade()
	{

		$str = substr($this->stucode,0,4);
		switch ($str){
			case '2012':
				$grade = 2012;
				break;
			case '2013':
				$grade = 2013;
				break;
			case '2014':
				$grade = 2014;
				break;
			case '2015':
				$grade = 2015;
				break;
			default:
				$grade = 0;
				break;
		}
		$this->grade = $grade;
		return $grade;
	}

	function getSqlname()
	{
		return $this->sqlname;
	}

	function getNum()
	{
		return $this->num;
	}

	function getLevel()
	{
		return $this->level;
	}

	function setLevel($level)
	{
		$this->level = $level;
	}

	function setNum($num)
	{
		$this->num = $num;
	}
	
	function setSqlname($sqlname)
	{
		$this->sqlname = $sqlname;
	}

	function setOpenId($OpenId)
	{
		$this->openid = $OpenId;
	}

	function setName($Name)
	{
		$this->name = $Name;
	}

	function setStucode($Stucode)
	{
		$this->stucode = $Stucode;
	}

	function isfull()
	{
		$mysql = new mysqlutil();

		//总数限制
		$sql = sprintf("select * from %s", $this->sqlname);
		$row = $mysql->sqllength($sql);

		//echo $row."\n总数限制\n";
		// if ($row <= $this->level1) 
		// {
		// 	$this->setLevel(1);
		// 	return false;
		// }
		// if ($row <= $this->level1 + $this->level2)
		// {
		// 	$this->setLevel(2);
		// 	return false;
		// }
		// if ($row <= $this->level1 + $this->level2 + $this->level3)
		// {
		// 	$this->setLevel(3);
		// 	return false;
		// }
		if ($row >= $this->num) return true;
		// //老生限制
		// if ($this->grade <> 2015)
		// {
		// 	$sql = sprintf("select * from %s where grade<>%s", $this->sqlname,"2015");
		// 	$row = $mysql->sqllength($sql);
		// 	//echo $row."\n老生\n";

		// 	if ($row >= $this->numt) return true;
		// }
		// else 
		// {
		// 	$sql = sprintf("select * from %s where grade=%s", $this->sqlname,"2015");
		// 	$row = $mysql->sqllength($sql);
		// 	//echo $row."\n新生\n";

		// 	if ($row >= $this->num15) return true;
		// }
		return false;
	}

	function isalready()
	{

		$mysql = new mysqlutil();

		$sql = sprintf("select * from %s where openid='%s'", $this->sqlname, $this->openid);
		$row = $mysql->sqllength($sql);
		if ($row == 0) 
		{
			return 0;
		}
		else 
		{
			$sql = sprintf("select id from %s where openid='%s'", $this->sqlname, $this->openid);
			$row = $mysql->sqlfetchrow($sql);
			//return 1;
			if ($row[0] <= $this->level1) return 1;
			if ($row[0] <= $this->level1 + $this->level2) return 2;
			if ($row[0] <= $this->level1 + $this->level2 + $this->level3) return 3;
			return 0;
		}
	}


	function getStatus()
	{
		$no = $this->isalready();
		if ($no > 0) return "1";
		if ($this->isfull()) return "2"; 


		 
		$mysql = new mysqlutil();

		$date = date('y-m-d h:i:s',time());//2010-08-29 11:25:26

		$sql = sprintf("insert into %s (openid, CreateTime, name, grade, stucode) values ('%s', '%s', '%s', '%s', '%s')", $this->sqlname, $this->openid, $date, $this->name, $this->grade, $this->stucode);
		$mysql->sqlquery($sql);	


		return "0";
	}

	function check($openid)
	{
		$mysql = new mysqlutil();
		$sql = sprintf("select stucode from %s where openid='%s'", $this->sqlname, $openid);
		$row = $mysql->sqllength($sql);
		if ($row == 0) return 0;
		else 
		{
			$sql = sprintf("select id from %s where openid='%s'", $this->sqlname, $this->openid);
			$row = $mysql->sqlfetchrow($sql);
			//return 1;
			if ($row[0] <= $this->level1) return 1;
			if ($row[0] <= $this->level1 + $this->level2) return 2;
			if ($row[0] <= $this->level1 + $this->level2 + $this->level3) return 3;

		}
	}

	function insertuserinfo()
	{
		$mysql = new mysqlutil();
		$sql = sprintf("select stucode from %s where openid='%s'", $this->userinfo, $this->openid);
		$row = $mysql->sqllength($sql);
		if ($row == 0) 
		{
			$date = date('y-m-d h:i:s',time());//2010-08-29 11:25:26

			$sql = sprintf("insert into %s (openid, CreateTime, name, grade, stucode) values ('%s', '%s', '%s', '%s', '%s')", $this->userinfo, $this->openid, $date, $this->name, $this->grade, $this->stucode);
			$mysql->sqlquery($sql);	
			return 0;
		}
		else return 1;
	}
}

?>