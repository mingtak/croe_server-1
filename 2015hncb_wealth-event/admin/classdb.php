<?
/**
 * @package absolutengine
 */
/** Class for accessing the MySQL database
 */
class CDatabase
{

   function CDatabase()
   {
   // do nothing
   }

   /** Connects to the database
    * @access public
    */
   function DBConnect()
   {
   @$this->connection=mysql_connect($this->dbserver,$this->dbuser,$this->dbpass);
   if (!$this->connection) $this->DisplayError(3);
   mysql_select_db($this->dbname);
   //mysql_query("SET NAMES 'big5'");

   }

   /** Queries the database
    * @access public
    * @param string query SQL query to execute
    * when INSERT command is used, $this->insertID is set to ID of inserted element
    * when SELECT command is used, $this->rowsnumber is set to number of returned rows
    * when UPDATE/DELETE command is used, $this->rowsnumber is set to number of affected rows
    */
   function DBQuery($query)
   {
   @$this->outcome=mysql_query($query,$this->connection);
   $errormessage=mysql_error();
   if ($errormessage=="") $errormessage="SUCCESS";
   $this->PrintDebugText($errormessage." for ".$query);
   if (!$this->outcome)
      {
      echo  $errormessage." for ".$query;
      $this->DisplayError(2,1);
      }
   $this->insertID=mysql_insert_id(); // gets insertID to use later
   if (substr($query,0,6)=="SELECT") $this->rowsnumber=mysql_num_rows($this->outcome); // gets number of rows selected to use later
   else $this->rowsnumber=mysql_affected_rows(); // gets number of rows affected to use later
   }
   
   
   /** Alias function to DBGetRow() for backward compatibility
    * @access public
    * @deprecated since 1.70
    * @see DBGetRow()
    */
   function DBAccess()
   {
   return $this->DBGetRow();
   }

   /** Retrieve one row from query
    * @access public
    * @see DBQuery()
    */
   function DBGetRow()
   {
   return $this->access=mysql_fetch_array($this->outcome);
   }
  
}

?>