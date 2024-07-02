<?
////////////////////////////////////////////////////////////////
// ���α׷���	: db_conn.php
// ����			: ����Ÿ���̽� ���� ���ȭ
// �ۼ���		: ��ȣ��
// �� ��		: (��)���÷�
// �� ��		: 2006�� 5�� 8�� ������
///////////////////////////////////////////////////////////////
/*
���α׷� ����
2006-05-08 : ���� �߰�(��ȣ��)
*/

class MySQL
{
	var $conn		=	null;
	var $connected	=	0	;
	var $query		=	''	;
	var $stmt				;
	var $pstmt				;
	var $result_set			;
	var $reference	=	0	;
	var $host		=	null;
	var $port		=	null;
	var $name		=	null;
	var $id			=	null;
	var $pw			=	null;

	function db_connect($owner)
	{
		if(0==$this->reference)
		{
			$this->host = $owner[1]?$owner[0].":".$owner[1] : $owner[0];
			$this->conn = $this->connect($this->host, $owner[3], $owner[4]);
			$this->select_db($owner[2]);
			$this->reference++;
		}
	}

	function db_disconnect()
	{
		$this->reference--;
		if(0==$this->reference)
		{
			if(is_resource($this->result_set)) $this->free_result(); 
			$this->close();
		}
	}

	function connect($host_name, $user, $password)
	{
		$this->conn = @mysql_connect($host_name, $user, $password) or $this->error('���� ����ڰ� ���� ���� ������ �������� �ʽ��ϴ�!',$this->_error());
		return $this->conn;
	}

	function pconnect($host_name, $user, $password)
	{
		$this->conn = @mysql_pconnect($host_name, $user, $password) or $this->error('���� ����ڰ� ���� ���� ������ �������� �ʽ��ϴ�!',$this->_error());
		return $this->conn;
	}

	function close()
	{
		return @mysql_close($this->conn);
	}

	function select_db($db_name)
	{
		$r = @mysql_select_db($db_name) or $this->error('�����ͺ��̽��� ���� �Ҽ� �����ϴ�!',$this->_error());
		return $r;
	}

	function create_db($db_name)
	{
		$r = @mysql_create_db($db_name) or $this->error('�����ͺ��̽��� ���� �Ҽ� �����ϴ�!',$this->_error());
		return $r; 
	}

	function drop_db($db_name)
	{
		$r = @mysql_drop_db($db_name) or $this->error('�����ͺ��̽��� ���� �Ҽ� �����ϴ�!',$this->_error());
		return $r; 
	}

	function ping($conn)
	{
		return @mysql_ping($conn);
	}

	function articles($query)
	{
		$this->result_set = $this->query($query);
		return $this->num_rows();
	}

	function query($query)
	{
		//$this->result_set = @mysql_query($query) or $this->error('�߸��� ���ǹ��� ���� �Ҽ� �����ϴ�!',$this->_error().$query);
		$this->result_set = @mysql_query($query);
		return $this->result_set;
	}

	function unbuffered_query($query,$result_mode=1)
	{
		$result_mode = $result_mode ? "MYSQL_USE_RESULT" : "MYSQL_STORE_RESULT";
		$this->result_set = @mysql_unbuffered_query($query,$result_mode) or $this->error('���ǹ��� ���� �Ҽ� �����ϴ�!',$this->_error());
		return $this->result_set;
	}

	function last_id()
	{
		return @mysql_insert_id();
	}

	function num_max($table_name, $fields)
	{
		$query = "select if(isnull(max($fields)),'1',max($fields)+1) as max_result from $table_name";
		$r = $this->fetch_array($query);
		return $r[max_result];
	}

	function db_query($db_name, $query)
	{
		$this->result_set = mysql_db_query($db_name, $query);
		return $this->result_set;
	}

	function lock($table_name, $mode="read")
	{
		$query = "lock tables ". $table_name ." ". $mode;
		$this->query($query);
	}

	function unlock()
	{
		$query = "unlock tables";
		$this->query($query);
	}

	function result($row, $fields)
	{
		if($this->num_rows()) $r = @mysql_result($this->result_set, $row, $fields);
		else $r = 0;
		return $r;
	}

	function free_result()
	{
		return @mysql_free_result($this->result_set);
	}

	function fetch_array($query)
	{
		$this->result_set = $this->query($query);
		$r =  @mysql_fetch_array($this->result_set);
		return $r;
	}

	function fetch_array2($query)
	{
		$r = array();
		$this->result_set = $this->query($query);
		for($m=0; $m < $this->num_rows(); $m++)
		{
			for($k=0; $k < $this->num_fields(); $k++)
			{
				$r[$m][$this->field_name($k)] = $this->result($m,$this->field_name($k));
			}
		}
		return $r;
	}

	function fetch_row($query)
	{
		$this->result_set = $this->query($query);
		$r = @mysql_fetch_row($this->result_set);
		return $r;
	}

	function fetch_row2($query)
	{
		$r = array();
		$this->result_set = $this->query($query);
		for($m=0; $m < $this->num_rows($rs); $m++)
		{
			for($k=0; $k < $this->num_fields($rs); $k++)
			{
				$r[$m] = $this->result($m,$this->field_name($k));
			}
		}
		return $r;
	}

	function fetch_assoc($query)
	{
		$this->result_set = $this->query($query);
		$r = @mysql_fetch_assoc($this->result_set) or $this->error('�ý��� �������� ����� �����Ҽ� �����ϴ�!',$this->_error());
		return $r;
	}

	function fetch_object($query)
	{
		$this->result_set = $this->query($query);
		$r =  @mysql_fetch_object($this->result_set) or $this->error('�ý��� �������� ����� �����Ҽ� �����ϴ�!',$this->_error());
		return $r;
	}

	function field_name($field_index)
	{
		return @mysql_field_name($this->result_set,$field_index);
	}

	function num_rows()
	{
		return @mysql_num_rows($this->result_set);
	}

	function is_rows()
	{
		return $this->num_rows();
	}

	function affected_rows()
	{
		return @mysql_affected_rows();
	}

	function is_affected()
	{
		return $this->affected_rows();
	}

	function num_fields()
	{
		return @mysql_num_fields($this->result_set);
	}

	function is_fields()
	{
		return $this->num_fields();
	}

	function is_tables($table_name,$owner)
	{
		$tables = array();
		$this->result_set = @mysql_list_tables($owner[2]);
		while ($r = mysql_fetch_row($this->result_set)) $tables[] = $r[0];
		return (in_array($table_name, $tables));
	}

	function safestr($str)
	{
		return @mysql_escape_string($str);
	}

	function _error()
	{
		return mysql_errno() . ": " . mysql_error();
	}

	function error($msg, $hmsg='')
	{
		echo "<!--
			$msg
			$hmsg
			-->";
		exit;
	}
}
?>