<?php  
	/**
	* 
	*/
	class textmsg 
	{

		private $text_id;
		private $content;

		public function setTextmsg($text_id, $row)
		{
			$this->setText_id($text_id);
			$this->setContent($row['content']);
		}

		public function getText_id()
		{
			return $this->text_id;
		}

		public function getContent()
		{
			return $this->content;
		}


		public function setText_id($text_id)
		{
			$this->text_id = $text_id;
		}

		public function setContent($content)
		{
			$this->content = $content;
		}

	}
?>