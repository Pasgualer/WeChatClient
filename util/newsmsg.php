<?php  
	/**
	* 
	*/
	class newsmsg
	{
		private $news_id;
		private $articleNum;
		private $article_id;

		public function setNewsmsg($news_id, $articleNum, $article_id)
		{
			$this->setNewsmsg($news_id);
			$this->setArticleNum($articleNum);
			$this->setArticle_id($article_id);
		}



		public function getNews_id()
		{
			return $this->news_id;
		}

		public function getArticleNum()
		{
			return $this->articleNum;
		}

		public function getArticle_id()
		{
			return $this->article_id;
		}



		public function setNews_id($news_id)
		{
			$this->news_id = $news_id;
		}

		public function setArticleNum($articleNum)
		{
			$this->articleNum = $articleNum;
		}

		public function setArticle_id($article_id)
		{
			$this->article_id = $article_id;
		}
	}
?>