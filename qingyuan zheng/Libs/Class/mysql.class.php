<?php
/**  
* blog database 
*/
!defined('BLOG_BOOK') && exit('FORBIDDEN');
class mysql{
	var $query_num = 0;
	var $link;
	
	function mysql($dbhost, $dbuser, $dbpw, $dbname, $pconnect = 0) {
		$this->connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect);
	}

	function connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect = 0) {
        global $dbcharset;
	    $this->link = mysqli_connect($dbhost, $dbuser, $dbpw, $dbname);
	}

	function select_db($dbname) {
		$this->dbname = $dbname;
		if (!@mysqli_select_db($dbname, $this->link)){
			$this->halt('Cannot use database '.$dbname);
		}
	}

	function server_info() {
		return mysqli_get_server_info($this->link);
	}
	
	function version() {
		return mysqli_get_server_info($this->link);
	}
	
	
	function insert($tableName, $column = array()) {
         $columnName = "";
         $columnValue = "";
         foreach ($column as $key => $value) {
             $columnName .= $key . ",";
             $columnValue .= "'" . $value . "',";
         }
         $columnName = substr($columnName, 0, strlen($columnName) - 1);
         $columnValue = substr($columnValue, 0, strlen($columnValue) - 1);
         $sql = "INSERT INTO $tableName($columnName) VALUES($columnValue)";
		//echo $sql;
         $r = $this->query($sql);
		 return $r;
     }
	 
	function update($tableName, $column = array(), $where = "") {
         $updateValue = "";
         foreach ($column as $key => $value) {
             $updateValue .= $key . "='" . $value . "',";
         }
         $updateValue = substr($updateValue, 0, strlen($updateValue) - 1);
         $sql = "UPDATE $tableName SET $updateValue";
         $sql .= $where ? " WHERE $where" : null;
		
         $this->query($sql);
     }
	 function delete($tableName, $where = ""){
         $sql = "DELETE FROM $tableName";
         $sql .= $where ? " WHERE $where" : null;
         $this->query($sql);
     }
	 function select($tableName, $columnName = "*", $where = "") {
         $sql = "SELECT " . $columnName . " FROM " . $tableName;
         $sql .= $where ? " WHERE " . $where : null;
         $this->query($sql);
     }
	 function get_all($sql,$result_type = MYSQLI_ASSOC) {
        $query = $this->query($sql);
        $i = 0;
        $rt = array();
        while($row =& mysqli_fetch_array($query,$result_type)) {
            $rt[$i]=$row;
            $i++;
        }
        //$this->write_log("get all records ".$sql);
        return $rt;
    }


    function fetchRow($query){
        return mysqli_fetch_assoc($query);
    }
	
	function query($sql) {
        //$this->write_log("search ".$sql);
		mysqli_query($this->link,"set names utf8");
        $query = mysqli_query($this->link,$sql);
        //if(!$query) $this->halt('Query Error: ' . $sql);
        return $query;
    }
	//
    function getOne($sql, $limited = false){
        if ($limited == true){
            $sql = trim($sql . ' LIMIT 1');
        }

        $res = $this->query($sql);
        if ($res !== false){
            $row = mysqli_fetch_row($res);

            if ($row !== false){
                return $row[0];
            }else{
                return '';
            }
        }else{
            return false;
        }
    }
	
	
	function fetch_array($query, $result_type = MYSQLI_ASSOC) {
        return mysqli_fetch_array($query, $result_type);
    }
	
	//output
	function fetch_first($sql) {
		$res=$this->query($sql);
		return $this->fetch_array($res,MYSQLI_ASSOC);
	}
	
	// the first data
	function get_one($sql, $result_type = MYSQLI_ASSOC){
		$result = $this->query($sql);
		$record = $this->fetch_array($result, $result_type);
		return $record;
	}

    function getRow($sql, $limited = false){
        if ($limited == true){
            $sql = trim($sql . 'LIMIT 1');
        }

        $res = $this->query($sql);
        if ($res !== false){
            return mysqli_fetch_assoc($res);
        }else{
            return false;
        }
    }

    
    //get the search number  
	function affected_rows() {
		return mysqli_affected_rows($this->link);
	}
	//
	function fetch_row($query) {
		return mysqli_fetch_row($query);
	}
	// results number 
	function num_rows($query) {
		return mysqli_num_rows($query);
	}
	// 
	function num_fields($query) {
		return mysqli_num_fields($query);
	}
	// return results
	function result($query, $row) {
		$query = mysqli_result($query, $row);
		return $query;
	}
	//
	function free_result($query) {
		return mysqli_free_result($query);
	}
	//
	function insert_id() {
		return ($id = mysqli_insert_id($this->link)) >= 0 ? $id : $this->result($this->query("SELECT last_insert_id()"), 0);
	}


	function close() {
		return mysqli_close($this->link);
	}

    function error() {
        return (($this->link) ? mysqli_error($this->link) : mysqli_error());
    }
    //
    function errno() {
        return intval(($this->link) ? mysqli_errno($this->link) : mysqli_errno());
    }

	function halt($msg = '') {
        global $charset;
		$msg = "<html>\n<head>\n";
		$msg .= "<meta content=\"text/html; charset=$charset\" http-equiv=\"Content-Type\">\n";
		$msg .= "<style type=\"text/css\">\n";
		$msg .=  "body,p,pre {\n";
		$msg .=  "font:12px Verdana;\n";
		$msg .=  "}\n";
		$msg .=  "</style>\n";
		$msg .= "</head>\n";
		$msg .= "<body bgcolor=\"#FFFFFF\" text=\"#000000\" link=\"#006699\" vlink=\"#5493B4\">\n";
		$msg .= "<b>BLOG error</b>: ".htmlspecialchars($this->error())."\n<br />";
		$msg .= "<b>error number</b>: ".$this->errno()."\n<br />";
		$msg .= "<b>Date</b>: ".date("Y-m-d @ H:i")."\n<br />";
		$msg .= "<b>Script File</b>: http://".$_SERVER['HTTP_HOST'].getenv("REQUEST_URI")."\n<br />";

		$msg .= "</body>\n</html>";
		echo $msg;
		exit;
	}
}
?>