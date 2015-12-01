<?php 
	require_once 'textmsg.php';
	require_once 'MySqlutil.php';
	/**
	* 
	*/
	class textmsgutil
	{
		private $sqlname = "wechat_textMsg";

		public function getSqlname()
		{
			return $this->sqlname;
		}

		public function setSqlname($sqlname)
		{
			$this->sqlname = $sqlname;
		}



		public function insert($textmsg)
		{
			$mysql = new mysqlutil();

			$sql = sprintf("INSERT INTO %s (text_id, Content) 
							VALUES ('%s', '%s')", $this->sqlname, $textmsg->getText_id(), $textmsg->getContent());
			$ret = $mysql->sqlquery($sql);

			return $ret;
		}

		public function update($textmsg)
		{
			$mysql = new mysqlutil();

			$sql = sprintf("UPDATE %s 
							SET Content = '%s'
							WHERE text_id = '%s'", $this->sqlname, $textmsg->getContent(), $textmsg->getText_id());
			$ret = $mysql->sqlquery($sql);

			return $ret;
		}

		public function readTextmsg($text_id)
		{
			$mysql = new mysqlutil();

			$textmsg = new textmsg();

			$sql = sprintf("SELECT Content
                            FROM %s
                            WHERE text_id = '%s'", $this->sqlname, $text_id);
			$ret = $mysql->sqlquery($sql);

			while ($row = mysql_fetch_array($ret)) 
			{
				$textmsg->setTextmsg($text_id, $row);
			} 

			return $textmsg;
		}

		public function readAll()
		{
			$mysql = new mysqlutil();

			$sql = sprintf("SELECT text_id
							FROM %s
							ORDER BY text_id ASC", $this->sqlname);


			$ret = $mysql->sqlquery($sql);

			while ($row = mysql_fetch_array($ret)) 
			{
				$textmsgList[] = $this->readTextmsg($row['text_id']);
			} 

			return $textmsgList;
		}

		public function delete()
		{
			$mysql = new mysqlutil();

			$textmsg = new textmsg();

			$sql = sprintf("DELETE *
                            FROM %s
                            WHERE text_id = '%s'", $this->sqlname, $text_id);
			$ret = $mysql->sqlquery($sql);

			return $ret;
		}
	}
?>