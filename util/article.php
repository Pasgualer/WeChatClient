<?php  
	/**
	* 
	*/
	class article
	{

		private $article_id;
		private $title;
		private $discription = "discription";
		private $picurl;
		private $url;
			
		public function setArticle($article_id, $row)
		{
			$this->setTitle($row['title']);
			$this->setDiscription($row['discription']);
			$this->setPicurl($row['picurl']);
			$this->setUrl($row['url']);
			$this->setArticle_id($article_id);
		}


		public function getArticle_id()
		{
			return $this->article_id;
		}

		public function getTitle()
		{
			return $this->title;
		}

		public function getDiscription()
		{
			return $this->discription;
		}

		public function getPicurl()
		{
			return $this->picurl;
		}

		public function getUrl()
		{
			return $this->url;
		}



		public function setArticle_id($article_id)
		{
			$this->article_id = $article_id;
		}

		public function setTitle($title)
		{
			$this->title = $title;
		}

		public function setDiscription($discription)
		{
			$this->discription = $discription;
		}

		public function setPicurl($picurl)
		{
			$this->picurl = $picurl;
		}

		public function setUrl($url)
		{
			$this->url = $url;
		}


	}
?>