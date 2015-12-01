<?php 
	require_once 'newsmsg.php';
	require_once 'MySqlutil.php';
	/**
	* 
	*/
	class newsmsgutil 
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
		



		public function insert($newsmsg)
		{
			$mysql = new mysqlutil();

			$sql = sprintf("INSERT INTO %s (news_id, articleNum, article_id) 
							VALUES ", $this->sqlname);

			$str = sprintf("('%s', '%s', '%s')", $newsmsg->getNews_id(), 1, $newsmsg->getArticle_id()[0]);

			$sql = $sql.$str;

			for ($i = 1; $i < $newsmsg->getArticleNum; $i++)
			{
				$str = sprintf(", ('%s', '%s', '%s')", $newsmsg->getNews_id(), $i + 1, $newsmsg->getArticle_id[$i]);

				$sql = $sql.$str;
			}


			// $sql = sprintf("INSERT INTO %s (news_id, articleNum, article_id) 
							// VALUES ('%s', '%s', '%s')", $this->sqlname, $textmsg->getText_id(), $textmsg->getContent());
			$ret = $mysql->sqlquery($sql);

			return $ret;
		}

		public function update($newsmsg)
		{
			$mysql = new mysqlutil();

			$sql = sprintf("UPDATE %s ", $this->sqlname);

			for ($i = 0; $i < $newsmsg->getArticleNum(); $i++)
			{
				$str = sprintf("SET articleNum = '%s', article_id = '%s'
								WHERE news_id = '%s'", $newsmsg->getArticleNum(), $newsmsg->getArticle_id()[$i], $newsmsg->getNews_id());
				$sql = $sql.$str;
			}

			$ret = $mysql->sqlquery($sql);

			return $ret;
		}

		public function readNewsmsg($news_id)
		{
			$mysql = new mysqlutil();

			$newsmsg = new newsmsg();

			$sql = sprintf("SELECT article_id
                            FROM %s
                            WHERE news_id = '%s'
                            ORDER BY articleNum ASC", $this->sqlname, $news_id);
			$ret = $mysql->sqlquery($sql);

			while ($row = mysql_fetch_array($ret)) 
			{
				$article_id[] = $row['article_id'];
			} 

			$newsmsg->setArticle_id($article_id);

			return $newsmsg;
		}

		public function readAll()
		{
			$mysql = new mysqlutil();

			$sql = sprintf("SELECT news_id
							FROM %s
							ORDER BY news_id ASC", $this->sqlname);

			$ret = $mysql->sqlquery($sql);

			while ($row = mysql_fetch_array($ret)) 
			{
				$newsmsgList[] = $this->readNewsmsg($row['news_id']);
			}

			return $newsmsgList;
		}

		public function delete()
		{
			$mysql = new mysqlutil();

			$newsmsg = new newsmsg();

			$sql = sprintf("DELETE *
                            FROM %s
                            WHERE news_id = '%s'", $this->sqlname, $news_id);
			$ret = $mysql->sqlquery($sql);
			return $ret;
		}
	}
?>