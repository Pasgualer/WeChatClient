<?php 
	require_once 'article.php';
	require_once 'MySqlutil.php';
	/**
	* 
	*/
	class articleutil
	{
		private $sqlname = "wechat_article";

		public function getSqlname()
		{
			return $this->sqlname;
		}

		public function setSqlname($sqlname)
		{
			$this->sqlname = $sqlname;
		}



		public function insert($article)
		{
			$mysql = new mysqlutil();

			$sql = sprintf("INSERT INTO %s (article_id, title, discription, picurl, url) 
							VALUES ('%s', '%s', '%s', '%s', '%s')", $this->sqlname, $article->getArticle_id(), $article->getTitle(), $article->getDiscription(), $article->getPicurl(), $article->getUrl());
			$ret = $mysql->sqlquery($sql);

			return $ret;
		}

		public function update($article)
		{
			$mysql = new mysqlutil();

			$sql = sprintf("UPDATE %s 
							SET title = '%s', discription = '%s', picurl = '%s', url = '%s'
							WHERE article_id = '%s'", $this->sqlname, $article->getTitle(), $article->getDiscription(), $article->getPicurl(), $article->getUrl(), $article->getArticle_id());
			$ret = $mysql->sqlquery($sql);

			return $ret;
		}

		public function readArticle($article_id)
		{
			$mysql = new mysqlutil();

			$article = new article();

			$sql = sprintf("SELECT title, discription, picurl, url
                            FROM %s
                            WHERE article_id = '%s'", $this->sqlname, $article_id);
			$ret = $mysql->sqlquery($sql);

			while ($row = mysql_fetch_array($ret)) 
			{
				$article->setArticle($article_id, $row);
			} 

			return $article;
		}

		public function readAll()
		{
			$mysql = new mysqlutil();

			// $sql = "SELECT article_id, title, discription, picurl, url
			// 		FROM wechat_article
			// 		ORDER BY article_id ASC";

			$sql = sprintf("SELECT article_id
							FROM '%s'
							ORDER BY article_id ASC", $this->sqlname);

			$ret = $mysql->sqlquery($sql);

			while ($row = mysql_fetch_array($ret)) 
			{
				$articleList[] = $this->readArticle($row['article_id']);
			}

			return $articleList;

		}

		public function delete()
		{

		}
	}
?>
