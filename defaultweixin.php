<?php

require 'weixin.class.php';

class DefaultWeixin extends wxmessage {



    public function processRequest($data) {
        // $input is the content that user inputs
        $input = $data->Content;       
        // deal with text msg from user
        if ($this->isTextMsg()) {
            $this->FromUserName = $data->FromUserName;
            $this->textutil($input); 
        }
        // deal with geographical location
        elseif ($this->isLocationMsg()) {
            //$this->fulinews();
        } elseif ($this->isImageMsg()) {
            $input = 'isImageMsg';
            $this->FromUserName = $data->FromUserName;
            $this->textutil($input);
            //$this->fulinews();
        } elseif ($this->isLinkMsg()) {
            //$this->fulinews();
        } elseif ($this->isEventMsg()) {
            $input = $data->Event;   //取出事件内容
            $eventKey = $data->EventKey; //取出事件标识
            $this->FromUserName = $data->FromUserName;
            $this->textutil($input);
        } else {
            
        }
    }





    private function textutil($input)
    {
        if ($this->checkstr($input,'主席'))
        {
            $this->yixieindex();
            return;
        }
        $this->reply($input)

    }

    private function checkstr($str,$needle){
        $tmparray = explode($needle,$str);
        if(count($tmparray)>1){
            return true;
        } else{
            return false;
        }
    } 


    private function reply($input)
    {
        $mysql = new mysqlutil();

        $sql = sprintf("select ReplyType, reply_id from wechat_rules where Content='%s'", $input);
        $ret = $mysql->sqlquery($sql);
        if ($row = mysql_fetch_array($ret))
        {
            $ReplyType = $row["ReplyType"];
            $reply_id = $row["reply_id"];
        }
        else 
        {
            $ReplyType = "text";
            $reply_id = "default";    
        }
        if ($ReplyType == "text") 
        {
            //sql
            $sql = sprintf("select Content from wechat_textMsg where text_id = '%s'", $reply_id);
            $ret = $mysql->sqlquery($sql);
            $row = mysql_fetch_array($ret);
            $text = $row["Content"];
            
            mysql_free_result($ret);

            //output
            $xml = $this->outputText($text);
            header('Content-Type: application/xml');
            echo $xml;
        } 
        else if ($ReplyType == "news") 
        {
            //sql
            $sql = sprintf("SELECT title, discription, picurl, url
                            FROM wechat_article, wechat_newsMsg
                            WHERE wechat_newsMsg.news_id = '%s' AND wechat_article.article_id = wechat_newsMsg.article_id 
                            ORDER BY wechat_newsMsg.articleNum ASC", $reply_id);
            $ret = $mysql->sqlquery($sql);
            while ($row = mysql_fetch_array($ret)) 
            {
                $posts[] = $row;
            }

            mysql_free_result($ret);

            $xml = $this->outputNews($posts);
            header('Content-Type: application/xml');
            echo $xml;

        }
        
    }





    /**
     * Pre processing，common usage:save the request into your database.
	 * Because weixin save your msgs only 5 days.
     * @return boolean
     */
    protected function beforeProcess($postData) {

        return true;
    }

    protected function afterProcess() {
    }

    public function errorHandler($errno, $error, $file = '', $line = 0) {
        $msg = sprintf('%s - %s - %s - %s', $errno, $error, $file, $line);
    }

    public function errorException(Exception $e) {
        $msg = sprintf('%s - %s - %s - %s', $e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
    }

    private function saveRequest($request) {
        
    }

}




