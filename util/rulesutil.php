<?php 
	require_once 'rules.php';
	require_once 'MySqlutil.php';
	/**
	* 
	*/
	class rulesutil
	{
		private $sqlname = "wechat_rules";

		public function getSqlname()
		{
			return $this->sqlname;
		}

		public function setSqlname($sqlname)
		{
			$this->sqlname = $sqlname;
		}



		public function insert($rules)
		{
			$mysql = new mysqlutil();

			$sql = sprintf("INSERT INTO %s (Content, isInclude, type, reply_id, tag) 
							VALUES ('%s', '%s', '%s', '%s', '%s')", $this->sqlname, $rules->getContent(), $rules->getIsInclude(), $rules->getType(), $rules->getReply_id(), $rules->getTag());
			$ret = $mysql->sqlquery($sql);

			return $ret;
		}

		public function update($rules)
		{
			$mysql = new mysqlutil();

			$sql = sprintf("UPDATE %s 
							SET isInclude = '%s', type = '%s', reply_id = '%s', tag = '%s'
							WHERE Content = '%s'", $this->sqlname, $rules->getIsInclude(), $rules->getType(), $rules->getReply_id(), $rules->getContent(), $rules->getTag());
			$ret = $mysql->sqlquery($sql);

			return $ret;
		}

		public function readRules($content)
		{
			$mysql = new mysqlutil();

			$rules = new rules();

			$sql = sprintf("SELECT isInclude, type, reply_id, tag
                            FROM %s
                            WHERE Content = '%s'", $this->sqlname, $content);
			$ret = $mysql->sqlquery($sql);

			while ($row = mysql_fetch_array($ret)) 
			{
				$rules->setRules($content, $row);
			} 

			return $rules;
		}

		public function readAll()
		{
			$mysql = new mysqlutil();

			$sql = sprintf("SELECT Content
							FROM %s
							ORDER BY tag ASC", $this->sqlname);


			$ret = $mysql->sqlquery($sql);

			while ($row = mysql_fetch_array($ret)) 
			{
				$rulsList[] = $this->readRules($row['Content']);
			} 

			return $rulesList;
		}

		public function delete()
		{
			$mysql = new mysqlutil();

			$rules = new rules();

			$sql = sprintf("DELETE *
                            FROM %s
                            WHERE Content = '%s'", $this->sqlname, $content);
			$ret = $mysql->sqlquery($sql);

			return $ret;
		}
	}
?>