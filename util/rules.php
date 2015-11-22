<?php  
	/**
	* 
	*/
	class rules 
	{

		private $content;
		private $isInclude;
		private $type;
		private $reply_id;
		private $tag;

		public function setRules($content, $row)
		{
			$this->setContent($content);
			$this->isInclude = $row['isInclude'];
			$this->type = $row['type'];
			$this->reply_id = $row['reply_id'];
			$this->tag = $row['tag'];
		}



		public function getContent()
		{
			return $this->content;
		}

		public function getIsInclude()
		{
			return $this->isInclude;
		}

		public function getType()
		{
			return $this->type;
		}

		public function getReply_id()
		{
			return $this->reply_id;
		}

		public function getTag()
		{
			return $this->tag;
		}


		public function setContent($content)
		{
			$this->content = $content;
		}

		public function setIsInclude($isInclude)
		{
			$this->isInclude = $isInclude;
		}

		public function setType($type)
		{
			$this->type = $type;
		}

		public function setReply_id($reply_id)
		{
			$this->reply_id = $reply_id;
		}

		public function setTag($tag)
		{
			$this->tag = $tag;
		}
	}
?>