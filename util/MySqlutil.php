<?php
class mysqlutil
{
	/*替换为你自己的数据库名*/
	const dbname = '';
	/*填入数据库连接信息*/
	const host = '';
	const port = ;
	const username = '';//用户AK
	const password = '';//用户SK
 	/*以上信息都可以在数据库详情页查找到*/
	private function sqlconnect()
	{
		/*接着调用mysql_connect()连接服务器*/
		$link = @mysql_connect(self:host.":"self:port,self::username,self::password,true);
		if(!$link) {
    		die("Connect Server Failed: " . mysql_error());
		}
		/*连接成功后立即调用mysql_select_db()选中需要连接的数据库*/
		if(!mysql_select_db(self::dbname,$link)) {
    		die("Select Database Failed: " . mysql_error($link));
		}
		/*至此连接已完全建立，就可对当前数据库进行相应的操作了*/
		return $link;
	}

	
	public function sqlquery($sql)
	{
		$link = $this->sqlconnect();
		$ret = mysql_query($sql, $link);
		if ($ret == false) {
			return "Mysql Query Failed: " . mysql_error($link);
		} else {
			//echo "Mysql Query Succeed<br />";
		}
		return $ret;
	}

	public function sqllength($sql)
	{
		$link = $this->sqlconnect();
		$ret = mysql_query($sql, $link);
		if ($ret == false) {
			return "Mysql Query Failed:  " . mysql_error($link);
		} else {
			$num_rows = mysql_num_rows($ret);
			return $num_rows;
		}
	}

	public function sqlfetchrow($sql)
	{
		$link = $this->sqlconnect();
		$ret = mysql_query($sql, $link);
		if ($ret == false) {
			return "Mysql Query Failed:  " . mysql_error($link);
		} else {
			$row = mysql_fetch_row($ret);
			mysql_free_result($ret);
			return $row;
		}
	}

	public function sqlfetcharray($sql)
	{
		$link = $this->sqlconnect();
		$ret = mysql_query($sql, $link);
		if ($ret == false) {
			return "Mysql Query Failed:  " . mysql_error($link);
		} else {
			$row = mysql_fetch_array($ret);
			mysql_free_result($ret);
			return $row;
		}
	}

	private function sqldisconnnect($link)
	{
		/*显式关闭连接，非必须*/
		mysql_close($link);
	}
}
?>