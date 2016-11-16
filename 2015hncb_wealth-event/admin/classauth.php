<?
/**
 * @package absolutengine
 */
/** Authetication class for login and session purposes
 */
class CAuth extends CDatabase
{

   function CAuth()
   {
   $this->CDatabase();
   $this->user=""; $this->pass=""; $this->session="";
   }

   /** Log user in
    * @access public
    * @param string $user username
    * @param string $pass password
    */
   function UserLogin($user="",$pass="")
   {
   if (!$this->user OR !$this->pass)
      {
      
      //header("location: http://".$this->server."/".$this->path."admin/index.php");
      echo '<script> alert("±b¸¹©Î±K½X¿ù»~!"); top.history.go(-2); </script>';
      exit;
      }
   $this->DBQuery("SELECT * FROM ".$this->table[5]." WHERE user='".$this->user."'");
   $this->DBGetRow();
   $currentuserID=$this->access["ID"];
   $username=$this->access["user"];
   $currentblogID=$this->access["blogIDList"];
   if  ($currentblogID="all" && $this->blogID !="0")
      $currentblogID=$this->blogID;
   $position= $this->access["position"];
   
   if ($this->user==$this->access["user"] AND md5($this->pass)==$this->access["password"])
      {
       if ($position>=4)
       {
        
        if (strpos( ",," . $currentblogID . "," , "," . $this->blogID. "," )==false)
        {
           //header("location: http://".$this->server."/".$this->path."admin/index.php");
           echo '<script> alert("±b¸¹©Î±K½X¿ù»~!"); top.history.go(-2); </script>';
           exit;
        }
        
       }
       {
          $currentblogID=$this->blogID;
          $this->DBQuery("SELECT * FROM ".$this->table[6]." WHERE userID='".$currentuserID."'");
          $this->DBGetRow();
          if ($this->rowsnumber) $this->DBQuery("DELETE FROM ".$this->table[6]." WHERE userID='".$currentuserID."'");
          $loginID=md5(uniqid($username));
          $currenttime=time();
          $this->DBQuery("INSERT INTO ".$this->table[6]." VALUES ('".$currentuserID."','".$loginID."','".$currenttime."')");
          header("location: http://".$this->server."/".$this->path."admin/admin.php?username=$username&session=$loginID&currentblogID=$currentblogID");
       }
      
      }
   else
    {
      echo '<script> alert("±b¸¹©Î±K½X¿ù»~!"); top.history.go(-2); </script>';
      //$this->DisplayError(1,1);
    }
    
   }

   /**  Verify user session
    * @access public
    */
   function UserVerifySession()
   {
   $currenttime=time();
   // delete users that have timeouted
   $this->DBQuery("DELETE FROM ".$this->table[6]." WHERE logtime+'".$this->timeout."'<'".$currenttime."'");
   unset($loginID);
   $this->DBQuery("SELECT ID,position FROM ".$this->table[5]." WHERE user='".$this->username."'");
   $this->DBGetRow();
   $this->currentuserID=$this->access["ID"];
   $this->currentuserposition=$this->access["position"];
   if (!$this->session) $this->session="*@#$!(&^";
   $this->DBQuery("SELECT loginID FROM ".$this->table[6]." WHERE userID='".$this->currentuserID."' AND loginID='".$this->session."'");
   $this->DBGetRow();
   $loginID=$this->access["loginID"];
   if ($this->session<>$loginID OR !$this->username OR !$this->session) $this->DisplayError(15,1);
   else
      {
      // write current time to login table, so user won't be timed out
      $this->DBQuery("UPDATE ".$this->table[6]." SET logtime='".$currenttime."' WHERE userID='".$this->currentuserID."'");
      }
   }

   /** Verify user level / position
    * @access public
    * @param $int level user level/positon
    */
   function UserVerifyLevel($level=1)
   {
   if ($level==1 AND $this->currentuserposition<>1) $this->DisplayError(12,1);
   if ($level==2 AND $this->currentuserposition>2) $this->DisplayError(13,1);
   if ($level==3 AND $this->currentuserposition>3) $this->DisplayError(15,1);
   if ($level==4 AND $this->currentuserposition>4) $this->DisplayError(1,1);
   if ($level==5 AND $this->currentuserposition>5) $this->DisplayError(1,1);
   }

   /** Log user out
    * @access public
    */
   function UserLogout()
   {
   $this->DBQuery("DELETE FROM ".$this->table[6]." WHERE userID='".$this->currentuserID."'");
   header("location: http://".$this->server."/".$this->path."admin/index.php");
   }

}

?>