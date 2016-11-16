<?
/**
 * @package absolutengine
 */
/** Core engine class / base functions
 */
class CEngine extends CAuth
{

   /** Constructor
    * Set all variables
    */
   function CEngine()
   {
   $this->CAuth();
   if (!defined('TEMPDIR')) define('TEMPDIR','./');
   @include(TEMPDIR."variables.php");
   @include(TEMPDIR."settings.php");
   $this->server=$server;
   $this->path=$path;
   $this->pathimages=$pathimages;
   $this->pathfiles=$pathfiles;
   $this->timeout=$timeout;
   $this->dbserver=$dbserver;
   $this->dbuser=$dbuser;
   $this->dbpass=$dbpass;
   $this->dbname=$dbname;
   $this->tableprefix=$tableprefix;
   $this->tableprefixmod=$tableprefixmod;
   foreach ($table as $key=>$value)
           {
           $this->table[$key]=$this->tableprefix.$value;
           }
   $this->wysiwygeditor=$wysiwygeditor;
   $this->emailwebmaster=$emailwebmaster;
   $this->cleanurls=$cleanurls;
   $this->sizemaximages=$sizemaximages;
   $this->thumbwidth=$thumbwidth;
   $this->thumbheight=$thumbheight;
   $this->jpegquality=$jpegquality;
   $this->sizemaxfiles=$sizemaxfiles;
   $this->uploadforbid=$uploadforbid;
   $this->dateformat=$dateformat;
   $this->charset=$charset;
   $this->textbasic=$textbasic;
   $this->textwarning=$textwarning;
   // define non-existing variables
   $this->username=""; $this->action=""; $this->datefrom=""; $this->dateto="";
   $this->currentblogID="";
   $this->condition=""; $this->filtarticlenumber=""; $this->filttitle="";
   $this->filtuserID=""; $this->filtdatefrom=""; $this->filtdateto="";
   $this->sortby=""; $this->sortorder=""; $this->objectID=""; $this->command="";
   $this->articleID=""; $this->sectionID=""; $this->section=""; $this->moduleID="";
   $this->text=""; $this->adate=""; $this->filesetID=""; $this->uploadnumber="";
   $this->formerrors=""; $this->imagesetID=""; $this->beginning=""; $this->title="";
   $this->keyword="";
   $this->atime=""; $this->priority=""; $this->status=""; $this->filename="";
   $this->authorID=""; $this->author=""; $this->filtsectionID=""; $this->leavedb="";
   $this->hook=""; $this->GIFSupport=0; $this->JPGSupport=0; $this->PNGSupport=0;
   $this->_htaccessopen=0;
   // Checking for supported image types
   if (function_exists("imagetypes"))
      {
      $this->PrintDebugText("imagetypes(): TRUE");
      if (imagetypes() & IMG_GIF)
         {
         $this->GIFSupport=1;
         $this->PrintDebugText("GIF Support: ".$this->GIFSupport);
         }
      if (imagetypes() & IMG_JPG)
         {
         $this->JPGSupport=1;
         $this->PrintDebugText("JPG Support: ".$this->JPGSupport);
         }
      if (imagetypes() & IMG_PNG)
         {
         $this->PNGSupport=1;
         $this->PrintDebugText("PNG Support: ".$this->PNGSupport);
         }
      }
   else
      {
      $this->PrintDebugText("imagetypes(): FALSE (assuming full image support)");
      // Assuming full image support exists
      $this->GIFSupport=1;
      $this->JPGSupport=1;
      $this->PNGSupport=1;
      }
   // Check whether fmod function exists, if not create emulated fmod function
   if (!function_exists("fmod"))
      {
      $this->PrintDebugText("fmod(): FALSE (creating fmod function)");
      function fmod($x,$y)
      {
      $i = floor($x/$y);
      return $x - $i*$y;
      }
      }
   }

   /** Initialize engine
    * Connect to database and select user language
    */
   function EngineInitialize()
   {
   $this->DBConnect();
   $this->DBQuery("SELECT * FROM ".$this->table[5]." WHERE user='".$this->username."'");
   $this->DBGetRow();
   $languagedef=$this->access["language"];
   if (!$languagedef) $languagedef="EN";
   $languagedef=strtolower($languagedef);
   $file="variables-".$languagedef.".php";
   if ($file=="variables-en.php") $file="variables.php";
   if (file_exists(TEMPDIR.$file)) @include(TEMPDIR.$file); else @include(TEMPDIR.'variables.php');
   // Re-initialize variables to match user language
   $this->charset=$charset; $tempcharset=$this->charset;
   $this->textbasic=$textbasic;
   $this->textwarning=$textwarning;
   // Retrieve settings for modules
  /* $this->DBQuery("SELECT * FROM ".$this->table[8]." ORDER BY module");
   while ($this->DBGetRow())
         {
         $directory=$this->access["directory"];
         $messagename="text".$directory;
         $tablename="table".$directory;
         $variablename="var".$directory;
         $$messagename=""; $$tablename=""; $$variablename="";
         $file="variables-".$languagedef.".php";
         if ($file=="variables-en.php") $file="variables.php";
         if (file_exists(TEMPDIR.'modules/'.$directory.'/'.$file))
            {
            @include(TEMPDIR.'modules/'.$directory.'/'.$file);
            }
         elseif (file_exists(TEMPDIR.'modules/'.$directory.'/'.'variables.php'))
            {
            @include(TEMPDIR.'modules/'.$directory.'/'.'variables.php');
            }
         if ($charset<>$this->charset) $tempcharset=$charset;
         $this->$messagename=$$messagename;
         if (file_exists(TEMPDIR.'modules/'.$directory.'/'.'settings.php'))
            {
            @include(TEMPDIR.'modules/'.$directory.'/'.'settings.php');
            // Create object variables for DB tables
            
            if (is_array($$tablename))
               {
               foreach ($$tablename as $key=>$value)
                       {
                       $this->{$tablename}[$key]=$this->tableprefixmod.$value;
                       }
               }
            // Create object variables for additional settings variables
            if ( !get_magic_quotes_gpc())
            {
             if (is_array($$variablename))
               {
               foreach ($$variablename as $key=>$value)
                       {
                       $this->{$variablename}[$key]=addslashes($value);
                       }
               }
            }
            else
            {
              if (is_array($$variablename))
               {
               foreach ($$variablename as $key=>$value)
                       {
                       $this->{$variablename}[$key]=$value;
                       }
               }
            }
            }
            
         } */
   $this->charset=$tempcharset;
   }

   /** Display basic information about Absolut Engine
    * @access public
    */
   function EngineInfo()
   {
   echo '<p>';
   echo '<strong>Absolut Engine</strong> by <a href="mailto:dusoft@staznostiNOSPAM.sk">Daniel Duris</a><br />';
   echo '<strong>Author:</strong> Daniel Duris<br />';
   echo '<strong>Version:</strong> '.AE_VERSION.'<br />';
   echo '<strong>Download:</strong> <a href="http://www.absolutengine.com" title="Absolut Engine Content Management System">www.absolutengine.com</a><hr>';
   echo '<strong>Support, questions, ideas, comments and general info at author\'s email or:</strong><br />';
   echo '<a href="http://www.absolutengine.com/faq/" title="Absolut Engine FAQ, Forums, Support, Help, Bugs, To-Do, Proposals">Forums</a> on Absolut Engine.<br />';
   echo '</p>';
   }

   /** Print debug text
    * @access private
    * @param $text message to be printed
    */
   function PrintDebugText($text)
   {
   if (DEBUG===1) echo $text,'<br />';
   }

   /** Save temporary data to table temporary
    * @param string $tempstring temporary data
    * @return integer $objectID ID of inserted element/object
    */
   function SaveTempData($tempstring)
   {
   $this->DBQuery("INSERT INTO ".$this->table[11]." VALUES (NULL,'".$tempstring."')");
   return $this->insertID;
   }

   /** Redirect user on error back to form page (e.g. missing form field etc.)
    * @access public
    * @param integer $objectID ID of temporary object to put into URL
    */
   function RedirectOnError($objectID)
   {
   $referer=$_SERVER["HTTP_REFERER"];
   if (strpos($referer,"?")===FALSE) $char="?";
   else $char="&";
   $referer=ereg_replace($char."objectID=[0-9]{1,}","",$referer);
   header("location: ".$referer.$char."objectID=".$objectID);
   exit;
   }

   /** Add form error to queue
    * @param string variable name
    * @access private
    */
   function AddFormError($message)
   {
   if (!$this->formerrors) $this->formerrors=" ";
   else $this->formerrors.=", ";
   $this->formerrors.=$message;
   }

   /** Check for form errors (if manadatory fields have been filled)
    * @param mixed ,...
    * unlimited number of parameters available, parameters should contain variable name
    * to check (e.g. title, sectionID, etc...)
    */
   function CheckFormErrors()
   {
   $number=func_num_args();
   if ($number)
      {
      $arguments=func_get_args();
      foreach ($arguments as $value)
              {
              $this->$value;
              if (!$this->$value)
                 {
                 $this->AddFormError($value." ".$this->textbasic[50]);
                 }
              }
      }
   if ($this->formerrors)
      {
      $this->formerrors.=".";
      if (!$this->objectID)
         {
         $this->aecopy=$this->SerializeObject($this);
         $temparray=array($this->formerrors,$this->aecopy);
         $tempstring=implode("|",$temparray);
         $this->objectID=$this->SaveTempData($tempstring);
         }
      else $objectID=$this->objectID;
      $this->RedirectOnError($this->objectID);
      }
   }

   /** Display error message and optionally stop execution of the script
    * @param boolean $stop 0 to continue with script execution, otherwise 1 to stop/exit
    * @param string $required "title,sectionID" - comma delimited list of mandatory fields
    * @param string moduledir - when called from module, state module directory
    */
   function DisplayError($errorcode=0,$stop=0,$moduledir="")
   {
   if (!$this->objectID AND !$stop) return 0;
   if ($this->objectID)
      {
      $this->DBQuery("SELECT tempstring FROM ".$this->table[11]." WHERE ID='".$this->objectID."'");
      $this->DBGetRow();
      $temparray=explode("|",$this->access["tempstring"]);
      $missingfields=$temparray[0];
      $objectcopy=$this->UnserializeObject($temparray[1]);
      }
   elseif ($stop)
      {
      header('Content-Type: text/html; charset=utf-8');
      @include(TEMPDIR."header.php");
      }
   echo '<p class="error"><span>!</span>';
   if (!$moduledir)
      {
      echo $this->textwarning[$errorcode];
      }
   else
      {
      $variablename="text".$moduledir;
      echo $this->{$variablename}[$errorcode];
      }
   if ($this->objectID) echo $missingfields;
   echo '<br class="clear" /></p>';
   if ($stop)
      {
      @include(TEMPDIR."footer.php");
      exit;
      }
   $this->DBQuery("DELETE FROM ".$this->table[11]." WHERE ID='".$this->objectID."'");
   if ($this->rowsnumber) return $objectcopy;
   }

   /** Perform date conversion from custom date format (set in settings.php) to MySQL date format and back
    * @access public
    * @param string $adate date to be converted
    * @param integer $direction to DB = 1, to form = 2
    */
   function DateConversion($adate,$direction=1)
   {
   if (!$adate) return;
   $this->dateformat=strtoupper($this->dateformat); // Makes sure it's UPPERCASE
   if ($direction==1)
      {
      for ($i=32;$i<48;$i++)
      {
      $delimiter=strpos($this->dateformat,chr($i));
      if ($delimiter) break;
      }
      $delimiter=chr($i); // Get the delimiter used
      $formatparts=explode($delimiter,$this->dateformat);
      $adateparts=explode($delimiter,$adate);
      for ($i=0;$i<=2;$i++)
          {
          if ($formatparts[$i]=="DD") $day=sprintf("%02d",$adateparts[$i]);
          if ($formatparts[$i]=="MM") $month=sprintf("%02d",$adateparts[$i]);
          if ($formatparts[$i]=="YYYY") $year=$adateparts[$i];
          }
      $day=trim($day);
      $month=trim($month);
      $year=trim($year);
      $adate="$year-$month-$day";
      }
   else
      {
      $year=strval(substr($adate,0,4));
      $month=strval(substr($adate,5,2));
      $day=strval(substr($adate,8,2));
      $adate=str_replace("DD",$day,$this->dateformat);
      $adate=str_replace("MM",$month,$adate);
      $adate=str_replace("YYYY",$year,$adate);
      }
   return $this->adate=$adate;
   }

   /** Check for file handling error and stop the script on failure
    */
   function FileError()
   {
   if (!$this->error)
   {
    $this->DisplayError(22,1);
   }  
    
    
   }

   /** Generate filename for file upload purposes
    * if filename exists, add -X, where X is previous existinf file number
    * @param string $filename original filename
    * @param string $path filepath (relative to admin/ directory)
    * @return string $filename generated filename
    */
   function GenerateFilename($filename,$path)
   {
   //echo 'the check path=>' . $path;
   $testnumber=0;
   $fileparts=explode(".",$filename);
   $filename=$fileparts[0];
   $extension=strtolower($fileparts[1]);
   $filename=ereg_replace('&#([0-9]{1,10});','',$filename);
//   $filename=strtr($filename," ¡¬ƒ«…ÀÕŒ”‘÷⁄‹›ﬂ·‚‰ÁÈÎÌÓÛÙˆ˙¸˝√„•π∆Ê»ËœÔ– ÍÃÏ≈Âºæ£≥—Ò“Ú’ı¿‡ÿ?ú™?öﬁ?ùŸ˘€?üØ??,"-AAACEEIIOOOUUYsaaaceeiiooouuyAaAaCcCcDdDdEeEeLlLlLlNnNnOoRrRrSsSsSsTtTtUuUuZzZzZz");
   for ($i=0;$i<strlen($filename);$i++)
       {
       if (ord($filename[$i])<32 OR (ord($filename[$i])>=33 AND ord($filename[$i])<=44) OR (ord($filename[$i])>=46 AND ord($filename[$i])<=47) OR (ord($filename[$i])>=58 AND ord($filename[$i])<=64) OR (ord($filename[$i])>=91 AND ord($filename[$i])<=94) OR ord($filename[$i])==96 OR ord($filename[$i])>122)
          {
          $filename=substr($filename,0,$i).substr($filename,$i+1,strlen($filename));
          }
       }
   $filename=str_replace('---','-',$filename);
   $filename=str_replace('--','-',$filename);
   $filename=strtolower($filename);
   $filename.=".".$extension;
   while (file_exists($path.$filename))
         {
         $filename=$fileparts[0]."-".$testnumber.".".$extension;
         $testnumber++;
         }
   return $filename;
   }

   /** Upload file
    * @param string $file original filename of the file to be uploaded
    * @param string $filenametmp temporary filename created by server during upload
    * @param integer $size size in bytes for maxsize check
    * @return string $filename filename created by engine from original filename
    */
   function SubmitFile($file,$filenametmp,$size)
   {
   $extforbid=explode(",",$this->uploadforbid);
   $fileparts=explode(".",$file);
   $filename=$fileparts[0];
   $extension=$fileparts[1];
   for ($i=0;$i<count($extforbid);$i++)
       {
       if ($extforbid[$i]==$extension)
        {
         $this->DisplayError(21,1);
         //echo 'extension not allowed=>' . $extension;
        } 
       }
   if ($size>$this->sizemaxfiles)
    {
      $this->DisplayError(23,1);
      echo 'size not allowed' ;
    } 
   $filename=$this->GenerateFilename($file,$this->pathfiles);
   //echo 'new file name=>' . $this->pathfiles.$filename;
   //echo ' |tmpfilename=>' . $filenametmp .'<br>'; 
   @$this->error=copy($filenametmp,$this->pathfiles.$filename);
   $this->FileError();
   return $this->filename=$filename;
   }

   /** Delete a file
    * @param $file filename
    */
   function DeleteFile($file)
   {
   if (file_exists($this->pathfiles.$file))
      {
      @$this->error=unlink($this->pathfiles.$file);
      $this->FileError();
      }
   }

   /** Upload image, create thumbnail from image
    * @param string $file original filename of the file to be uploaded
    * @param string $filenametmp temporary filename created by server during upload
    * @param string $filetype filetype of image (GIF/PNG/JPEG)
    * @param integer $size size in bytes for maxsize check
    * @return string $filename filename created by engine from original filename
    */
   function SubmitImage($file,$filenametmp,$filetype,$size,$path="")
   {
   if (!$path) $path=$this->pathimages;
   if ($filetype=="image/gif" AND !$this->GIFSupport)
      {
      $this->DisplayError(24,1);
      }
   elseif (($filetype=="image/jpeg" OR $filetype=="image/pjpeg") AND !$this->JPGSupport)
      {
      $this->DisplayError(24,1);
      }
   elseif ($filetype=="image/png" AND !$this->PNGSupport)
      {
      $this->DisplayError(24,1);
      }
   if ($filetype=="image/gif") $extension=".gif";
   elseif ($filetype=="image/jpeg" OR $filetype=="image/pjpeg") $extension=".jpg";
   elseif ($filetype=="image/png") $extension=".png";
   else $this->DisplayError(20,1);
   if ($size>$this->sizemaxfiles) $this->DisplayError(20,1);
   $filename=$this->GenerateFilename($file,$path);
   @$this->error=copy($filenametmp,$path.$filename);
   $this->FileError();
   if ($extension==".gif") $image=imagecreatefromgif($path.$filename);
   if ($extension==".jpg") $image=imagecreatefromjpeg($path.$filename);
   if ($extension==".png") $image=imagecreatefrompng($path.$filename);
   $width=imagesx($image); $height=imagesy($image);
   $thumbw=$width; $thumbh=$height;
   if ($width>$this->thumbwidth OR $height>$this->thumbheight)
      {
      $ratiow=1; $ratioh=1;
      if ($width>$this->thumbwidth) $ratiow=$thumbw/$this->thumbwidth;
      if ($height>$this->thumbheight) $ratioh=$thumbh/$this->thumbheight;
      if ($ratiow>$ratioh)
         {
         $thumbw=$thumbw/$ratiow;
         $thumbh=$thumbh/$ratiow;
         }
      elseif ($ratioh>$ratiow)
             {
             $thumbw=$thumbw/$ratioh;
             $thumbh=$thumbh/$ratioh;
             }
      elseif ($ratioh==$ratiow)
         {
         $thumbw=$thumbw/$ratiow;
         $thumbh=$thumbh/$ratioh;
         }
      }
   $image2=imagecreatetruecolor($thumbw,$thumbh);
   imagecopyresampled($image2,$image,0,0,0,0,$thumbw,$thumbh,$width,$height);
   $thumbnail=$this->GetThumbnailName($filename);
   if ($extension==".gif")
      {
      $this->error=imagegif($image2,$path.$thumbnail);
      $this->FileError();
      }
   if ($extension==".jpg")
      {
      $this->error=imagejpeg($image2,$path.$thumbnail,$this->jpegquality);
      $this->FileError();
      }
   if ($extension==".png")
      {
      $this->error=imagepng($image2,$path.$thumbnail);
      $this->FileError();
      }
   imagedestroy($image);
   imagedestroy($image2);
   return $filename;
   }

   /** Delete image and its thumbnail
    * @param string $file image filename
    */
   function DeleteImage($file,$path)
   {
   if (file_exists($path.$file))
      {
      @$this->error=unlink($path.$file);
      $this->FileError();
      }
   $fileparts=explode(".",$file);
   $filename=$fileparts[0];
   $extension=$fileparts[1];
   $thumbnail=$this->GetThumbnailName($file);
   if (file_exists($path.$thumbnail))
      {
      @$this->error=unlink($path.$thumbnail);
      $this->FileError();
      }
   }

   /** Create thumbnail name from image name
    * @param string $file image name
    * @return string $thumbnail thumbnail name
    */
   function GetThumbnailName($file)
   {
   $fileparts=explode(".",$file);
   $filename=$fileparts[0];
   $extension=$fileparts[1];
   $thumbnail=$filename."a".".".$extension;
   return $thumbnail;
   }

   /** Create array of system message translations available
    * @access private
    */
   function RequestLanguageVersions()
   {
   $i=0;
   @$dirhandle=opendir(".");
   while (@$languageversion=readdir($dirhandle))
         {
         if (substr($languageversion,0,9)=="variables")
            {
            $languageversion=substr($languageversion,10,2);
            if ($languageversion=="ph")
               {
               $languageversion="en";
               }
            $languagearray[$i]=strtoupper($languageversion);
            }
         ++$i;
         }
   @closedir($dirhandle);
   sort($languagearray);
   reset($languagearray);
   return $this->languagearray=$languagearray;
   }

   /** Genereates physical files from articles if $cleanurls set to 1
    * @deprecated from v1.71 DO NOT USE! This function is obsolete and will be deleted in next version
    * If you server support Apache mod_rewrite module, use $cleanurls=2 instead!
    * @todo prepare some static URL schema use - $cleanurls=3 in future
    */
   function GeneratePhysicalFile($articleID)
   {
   $content=join('',file('../showarticle.php'));
   $content=str_replace('$aepublic->articleID',$articleID,$content);
   $this->filename=str_replace('.php','',$this->filename);
   if (!$this->filename)
      {
      $this->filename=$this->title;
      }
   $this->filename=ereg_replace('&#([0-9]{1,10});','',$this->filename);
//   $this->filename=strtr($this->filename," ¡¬ƒ«…ÀÕŒ”‘÷⁄‹›ﬂ·‚‰ÁÈÎÌÓÛÙˆ˙¸˝√„•π∆Ê»ËœÔ– ÍÃÏ≈Âºæ£≥—Ò“Ú’ı¿‡ÿ?ú™?öﬁ?ùŸ˘€?üØ??,"-AAACEEIIOOOUUYsaaaceeiiooouuyAaAaCcCcDdDdEeEeLlLlLlNnNnOoRrRrSsSsSsTtTtUuUuZzZzZz");
   for ($i=0;$i<strlen($this->filename);$i++)
       {
       if (ord($this->filename[$i])<32 OR (ord($this->filename[$i])>=33 AND ord($this->filename[$i])<=44) OR (ord($this->filename[$i])>=46 AND ord($this->filename[$i])<=47) OR (ord($this->filename[$i])>=58 AND ord($this->filename[$i])<=64) OR (ord($this->filename[$i])>=91 AND ord($this->filename[$i])<=94) OR ord($this->filename[$i])==96 OR ord($this->filename[$i])>122)
          {
          $this->filename=substr($this->filename,0,$i).substr($this->filename,$i+1,strlen($this->filename));
          }
       }
   $this->filename=str_replace('---','-',$this->filename);
   $this->filename=str_replace('--','-',$this->filename);
   $this->filename.=".php";
   $this->filename=strtolower($this->filename);
   @$this->error=$handle=fopen('../'.$this->filename,'wb');
   $this->FileError();
   @$this->error=fwrite($handle,$content);
   $this->FileError();
   @$this->error=fclose($handle);
   $this->FileError();
   }

   /** Deletes physical files from articles if $cleanurls set to 1
    * @deprecated from v1.71 DO NOT USE! This function is obsolete and will be deleted in next version
    * If you server support Apache mod_rewrite module, use $cleanurls=2 instead!
    * @todo prepare some static URL schema use - $cleanurls=3 in future
    */
   function DeletePhysicalFile($articleID)
   {
   $this->DBQuery("SELECT filename FROM ".$this->table[3]." WHERE ID='".$articleID."'");
   $this->DBGetRow();
   $filename=$this->access["filename"];
   if ($filename AND file_exists('../'.$filename))
      {
      @$this->error=unlink('../'.$filename);
      $this->FileError();
      }
   }
   function utf8_substr($StrInput,$strStart,$strLen)
  {
    //πÔ¶r¶Í∞µURL Eecode
  $StrInput = mb_substr($StrInput,$strStart,mb_strlen($StrInput));
  $iString = urlencode($StrInput);
  $lstrResult="";
  $istrLen = 0;
  $k = 0;
  do{
    $lstrChar = substr($iString, $k, 1);
    if($lstrChar == "%"){
    $ThisChr = hexdec(substr($iString, $k+1, 2));
    if($ThisChr >= 128){
      if($istrLen+3 < $strLen){
        $lstrResult .= urldecode(substr($iString, $k, 9));
        $k = $k + 9;
        $istrLen+=3;
      }else{
        $k = $k + 9;
        $istrLen+=3;
      }
    }else{
      $lstrResult .= urldecode(substr($iString, $k, 3));
      $k = $k + 3;
      $istrLen+=2;
    }
    }else{
      $lstrResult .= urldecode(substr($iString, $k, 1));
      $k = $k + 1;
      $istrLen++;
    }
  }while ($k < strlen($iString) && $istrLen < $strLen);
  return $lstrResult;
}

   /** Insert clean URL in clean URLs pool
    * @access public
    * @return void
    */
   function InsertCleanURL($url)
   {
   if (!$this->cleanurls) return;
   $this->DBQuery("INSERT INTO ".$this->table[10]." VALUES ('".$url."')");
   }

   /** Delete clean URL from clean URLs pool
    * @access public
    * @return void
    */
   function DeleteCleanURL($url)
   {
   if (!$this->cleanurls) return;
   $this->DBQuery("DELETE FROM ".$this->table[10]." WHERE cleanurl='".$url."'");
   }

   /** Look into clean URLs pool to check if URL exists
    * @access public
    * @return FALSE if URL is not found
    * @return TRUE if URL exists -> show error? (leave it to the module/system to decide what to do)
    */
   function LookUpCleanURL($url)
   {
   $this->DBQuery("SELECT cleanurl FROM ".$this->table[10]." WHERE cleanurl='".$url."'");
   if ($this->rowsnumber) return TRUE;
   else return FALSE;
   }

   /** Display parts of the pages (boxes) that should be added to the currently visited page
    *  Modules are able to insert their parts (forms, boxes, DB listings) into other parts of the system
    */
   function DisplayEngineModuleParts()
   {
   /*global $ae;
   $condition="";
   $path=pathinfo($_SERVER["PHP_SELF"]);
   $file=$path["basename"];
   $directory=str_replace("/".$this->path."admin/","",$path["dirname"]);
   if (strpos($directory,"modules")!==FALSE)
      {
      $directory=str_replace("modules/","",$directory);
      $condition="WHERE directory<>'".$directory."'";
      }
   $this->DBQuery("SELECT directory FROM ".$this->table[8]." ".$condition." ORDER BY module");
   while ($this->DBGetRow())
      {
      $directory=$this->access["directory"];
      if (file_exists(TEMPDIR.'modules/'.$directory.'/'.$file))
         {
         @include(TEMPDIR.'modules/'.$directory.'/coreclass.php');
         @include(TEMPDIR.'modules/'.$directory.'/'.$file);
         }
      }
     */ 
   }

   /** Set hook
    * @access public
    * @param string $hook hook to set
    */
   function SetHook($hook)
   {
   $this->hook=$hook;
   }

   /** Execute currently set hook
    * @access public
    * @see SetHook()
    */
   function ExecuteHook()
   {
   if (!$this->hook) return;
   $elementpart=explode("-",$this->hook);
   $hook=$elementpart[0];
   $element=$elementpart[1];
   $this->DBQuery("SELECT * FROM ".$this->table[14]." WHERE hook='".$hook."'");
   if ($this->rowsnumber)
      {
      $this->DBGetRow();
      $action=trim($this->access["action"]);
      if ($action)
         {
         if (strpos($action,"?")!==FALSE) $character="&";
         else $character="?";
         header("location: http://".$this->server."/".$this->path."admin/".$action.$character."username=".$this->username."&currentblogID=".$this->currentblogID."&session=".$this->session."&".$element."=".$this->$element);
         exit;
         }
      }
   }

   /** Create clean URL based on input string
    * @param string $input string to create valid clean URL from
    * @return string valid clean URL
    * @return void when clean URL feature is disabled
    */
   function CreateCleanURL($input)
   {
   if (!$this->cleanurls) return;
   if ($this->filename) $input=$this->filename;
   // drop any HTML entities
   $input=ereg_replace('&#([0-9]{1,10});','',$input);
   // do conversion of common characters
//   $input=strtr($input," ¡¬ƒ«…ÀÕŒ”‘÷⁄‹›ﬂ·‚‰ÁÈÎÌÓÛÙˆ˙¸˝√„•π∆Ê»ËœÔ– ÍÃÏ≈Âºæ£≥—Ò“Ú’ı¿‡ÿ?ú™?öﬁ?ùŸ˘€?üØ??,"-AAACEEIIOOOUUYsaaaceeiiooouuyAaAaCcCcDdDdEeEeLlLlLlNnNnOoRrRrSsSsSsTtTtUuUuZzZzZz");
   for ($i=0;$i<strlen($input);$i++)
       {
       if (ord($input[$i])<32 OR (ord($input[$i])>=33 AND ord($input[$i])<=44) OR ord($input[$i])==47 OR (ord($input[$i])>=58 AND ord($input[$i])<=64) OR (ord($input[$i])>=91 AND ord($input[$i])<=94) OR ord($input[$i])==96 OR ord($input[$i])>122)
          {
          $input=substr($input,0,$i).substr($input,$i+1,strlen($input));
          $i--;
          }
       }
   $input=str_replace('---','-',$input);
   $input=str_replace('--','-',$input);
   $input=strtolower($input);
   return $input;
   }

   /** Open and read .htaccess file for further processing by AddRewriteRule, DeleteRewriteRule etc.
    *  if $cleanurls is set to 2
    * @return void
    */
   function ReadHtaccess()
   {
   if (!$this->cleanurls) return;
   if (strpos($_SERVER["PHP_SELF"],"modules")!==FALSE) $modulecall=1;
   $this->_htaccessopen=1;
   if ($modulecall) $path="../../../";
   else $path="../";
   $this->_content=join('',file($path.'.htaccess'));
   @$this->error=$this->_handle=fopen($path.'.htaccess','wb');
   $this->FileError();
   }

   /** Write content to and close .htaccess file
    *  if $cleanurls is set to 2
    * @return void
    */
   function WriteHtaccess()
   {
   @$this->error=fwrite($this->_handle,$this->_content);
   $this->FileError();
   @$this->error=fclose($this->_handle);
   $this->FileError();
   $this->_htaccessopen=0;
   }

   /** Generate .htaccess file (with new rules) if $cleanurls is set to 2
    * @param integer $elementID ID of element
    * @param string $type = "file.php?elementID=" // e.g. showcar.php?carID=
    * @param string $prefix string to prefix clean URL with
    * @param string $suffix string to suffix clean URL with
    * @return void when clean URL feature is disabled
    * @todo !!!! test whether syndication is enabled and section is part of the central website
    * @todo if not return and do not create rule!!!
    */
   function AddRewriteRule($elementID,$type="showarticle.php?articleID",$prefix="",$suffix="")
   {
   if (!$this->cleanurls) return;
   // find whether ReadHtaccess has been called before
   $internal=0;
   if (!$this->_htaccessopen)
      {
      $internal=1; // ReadHtaccess has been called internally
      $this->ReadHtaccess();
      }
   // !!!! test whether syndication is enabled and section is part of the central website
   // if not return and do not create rule!!!
   // if path is set, add path to rewrite rule
   $this->_content.="\r\nRewriteRule ^".$prefix.$this->filename.$suffix."[/]*$ /".$this->path.$type."=".$elementID;
   $this->_content=str_replace("\r\n\r\n","\r\n",$this->_content);
   $this->_content=str_replace("\n\n","\n",$this->_content);
   if ($internal)
      {
      $this->InsertCleanURL($prefix.$this->filename.$suffix);
      $this->WriteHtaccess();
      }
   }

   /** Delete rewrite rule for element
    * @param integer $elementID ID of element to be deleted
    * @param string $table table where to search for the filename, if empty article table is assumed
    * @param string $type "file.php?elementID=" // e.g. showcar.php?carID=
    * @param string $prefix string to prefix clean URL with
    * @param string $suffix string to suffix clean URL with
    * @return void
    */
   function DeleteRewriteRule($elementID,$table="",$type="showarticle.php?articleID",$prefix="",$suffix="")
   {
   if (!$this->cleanurls) return;
   // find whether ReadHtaccess has been called before
   $internal=0;
   if (!$this->_htaccessopen)
      {
      $internal=1; // ReadHtaccess has been called internally
      $this->ReadHtaccess();
      }
   if (!$table) $table=$this->tableprefix."articles";
   $this->DBQuery("SELECT filename FROM ".$table." WHERE ID='".$elementID."'");
   $this->DBGetRow();
   $filename=$this->access["filename"];
   $this->_content=str_replace("RewriteRule ^".$prefix.$filename.$suffix."[/]*$ /".$this->path.$type."=".$elementID,"",$this->_content);
   $this->_content=str_replace("\r\n\r\n","\r\n",$this->_content);
   $this->_content=str_replace("\n\n","\n",$this->_content);
   if ($internal)
      {
      $this->DeleteCleanURL($prefix.$filename.$suffix);
      $this->WriteHtaccess();
      }
   }

   /** Serialize object for saving to database
    * used for keeping serialized copy of object for checking errors
    * when form error is encountered, use header to send back
    *
    */
   function SerializeObject($object)
   {
   // TO-DO: should we walk through variables in object and addslashes() them or base64 encode them?
   /*
   foreach ($_GET as $key=>$value)
           {
           $this->$key=$_GET[$key];
           if (!is_array($_GET[$key])) $this->$key=stripslashes($_GET[$key]);
           }
   */
   unset($object->username); unset($object->session); unset($object->access);
   unset($object->currentblogID);
   unset($object->server); unset($object->path); unset($object->pathimages);
   unset($object->pathfiles); unset($object->timeout); unset($object->dbserver);
   unset($object->dbuser); unset($object->dbpass); unset($object->dbname);
   unset($object->tableprefixmod); unset($object->table); unset($object->emailwebmaster);
   unset($object->cleanurls); unset($object->sizemaximages); unset($object->thumbwidth);
   unset($object->thumbheight); unset($object->jpegquality); unset($object->sizemaxfiles);
   unset($object->uploadforbid); unset($object->dateformat); unset($object->charset);
   unset($object->textbasic); unset($object->textwarning); unset($object->JPGSupport);
   unset($object->GIFSupport); unset($object->PNGSupport); unset($object->rowsnumber);
   unset($object->outcome); unset($object->insertID); unset($object->currentuserID);
   unset($object->currentblogID);
   unset($object->currentuserposition);
/*   $this->DBQuery("SELECT * FROM ".$this->table[8]." ORDER BY module");
   while ($this->DBGetRow())
         {
         $tablename="table".$this->access["directory"];
         $varname="var".$this->access["directory"];
         $textname="text".$this->access["directory"];
         unset($object->$tablename);
         unset($object->$varname);
         unset($object->$textname);
         }
  */
   return serialize($object);
   }

   /** Serialize object for saving to database
    * used for keeping serialized copy of object for checking errors
    * when form error is encountered, use header to send back
    *
    */
   function UnserializeObject($object)
   {
   return unserialize($object);
   }

   /** Cleans up the HTML code created by WYSIWYG editor (Richt text editor)
    * Tries to make the code XHTML 1.0 Strict (web standards compliant)
    * @return string cleaned & formatted code
    */
   function WYSIWYGtoXHTML($text)
   {
   $text=stripslashes($text);
   $length=strlen($text);
   // Make HTML tags lowercase
   for ($i=0;$i<$length;$i++)
       {
       if ($text[$i]=="<")
          {
          while ($text[$i]<>">")
                {
                if (substr($text,$i,4)=="href" OR substr($text,$i,4)=="HREF")
                   {
                   $text=substr_replace($text,'href',$i,4);
                   $i=$i+6;
                   while ($text[$i]<>'"')
                         {
                         $i++;
                         }
                   continue;
                   }
                if (substr($text,$i,5)=="title" OR substr($text,$i,5)=="TITLE")
                   {
                   $text=substr_replace($text,'title',$i,5);
                   $i=$i+7;
                   while ($text[$i]<>'"')
                         {
                         $i++;
                         }
                   continue;
                   }
                if (substr($text,$i,3)=="alt" OR substr($text,$i,3)=="ALT")
                   {
                   $text=substr_replace($text,'alt',$i,3);
                   $i=$i+5;
                   while ($text[$i]<>'"')
                         {
                         $i++;
                         }
                   continue;
                   }
                if (substr($text,$i,8)=="longdesc" OR substr($text,$i,8)=="LONGDESC")
                   {
                   $text=substr_replace($text,'longdesc',$i,8);
                   $i=$i+10;
                   while ($text[$i]<>'"')
                         {
                         $i++;
                         }
                   continue;
                   }
                /** BUGGY - memery being exhausted sometimes when using:
                 * $text[$i]=strtolower($text[$i]);
                 * HACK for the strtolower
                 */
                if (ord($text[$i])>=65 AND ord($text[$i])<=90) $text[$i]=chr(ord($text[$i])+32);
                $i++;
                }
          }
       }
   $conversiontable=array(
                         '<br>'=>'<br />',
                         '<hr>'=>'<hr />',
                         '<b>'=>'<strong>',
                         '</b>'=>'</strong>',
                         '<i>'=>'<em>',
                         '</i>'=>'</em>',
                         '<u>'=>'<span style="text-decoration: underline;">',
                         '</u>'=>'</span>',
                         '<font'=>'<span',
                         '</font>'=>'</span>',
                         'size="1"'=>'style="font-size: xx-small;"',
                         'size="2"'=>'style="font-size: x-small;"',
                         'size="3"'=>'style="font-size: small;"',
                         'size="4"'=>'style="font-size: medium;"',
                         'size="5"'=>'style="font-size: large;"',
                         'size="6"'=>'style="font-size: x-large;"',
                         'size="7"'=>'style="font-size: xx-large;"',
                         '&nbsp;'=>' ',
                         ' class="msonormal"'=>'',
                         ' class="sonormal"'=>'',
                         '<?xml:namespace prefix ="o" ns =""urn:schemas-microsoft-com:office:office"" />'=>'',
                         '<o:p>'=>'',
                         '</o:p>'=>''
                         );
   // Pre-processing - add quotes to enclose attributes in HTML tags (only IE)
   // change HTML tags as per conversion table
   $browser=$_SERVER['HTTP_USER_AGENT'];
   if (strpos($browser,'MSIE')===TRUE) $text=ereg_replace('=([^\ |^>]+)','="\\1"',$text);
   while (eregi('&nbsp;&nbsp;',$text))
         {
         $text=ereg_replace('&nbsp;&nbsp;','&nbsp;',$text);
         }
   $text=strtr($text,$conversiontable);
   // Processing - change few tags with values
   $text=ereg_replace('<img ([^>]+)>','<img \\1 />',$text);
   $text=ereg_replace(' valign="([^"]+)"','',$text);
   $text=ereg_replace('align="([^"]+)"','style="text-align: \\1;"',$text);
   $text=ereg_replace('face="([^"]+)"','style="font-family: \\1;"',$text);
   $text=ereg_replace('color="([^"]+)"','style="color: \\1;"',$text);
   $text=ereg_replace('border="([^"]+)"','style="border: \\1px;"',$text);
   $text=ereg_replace('cellpadding="([^"]+)"','style="padding: \\1px;"',$text);
   $text=ereg_replace(' cellspacing="([^"]+)"','',$text);
   $text=ereg_replace(' lang="([^"]+)"','',$text);
   $text=ereg_replace(' style="mso-([^"]+)"','',$text);
   $text=str_replace('<b style="">','<strong>',$text);
   // Post-processing - redundant tag attributes are joined into one tag
   // comment tags, empty paragraphs and span tags are removed
   $text=ereg_replace('<!--([^>]+)>','',$text);
   while (eregi('<span style="font-weight: bold;">([^<]+)</span>',$text))
         {
         $text=ereg_replace('<span style="font-weight: bold;">([^<]+)</span>','<strong>\\1</strong>',$text);
         }
   while (eregi('style="([^"]+)" style="([^"]+)"',$text))
         {
         $text=ereg_replace('style="([^"]+)" style="([^"]+)"','style="\\1 \\2"',$text);
         }
   while (eregi('<span style="([^"]+)"><span style="([^"]+)">([^<]+)</span></span>',$text))
         {
         $text=ereg_replace('<span style="([^"]+)"><span style="([^"]+)">([^<]+)</span></span>','<span style="\\1 \\2">\\3</span>',$text);
         }
   // while (eregi('style="\s([A-Za-z]+)\s"'
   $text=ereg_replace('style="\s([A-Za-z]+)\s"','\\1',$text);
   $text=ereg_replace('<span>([^>]+)</span>','\\1',$text);
   $text=ereg_replace('<span></span>','',$text);
   $text=ereg_replace('<span>[ ]{1,}</span>','',$text);
   $text=ereg_replace('<span[^>]+></span>','',$text);
   $text=ereg_replace('<span[^>]+>[ ]{1,}</span>','',$text);
   // NEXT LINE IS BUGGY - CHECK!!!!!
   //$text=ereg_replace('<span[^>]+>(.[^<]+)</span>','\\1',$text);
   while (eregi('<p[^>]+></p>',$text))
         {
         $text=ereg_replace('<p[^>]+></p>','',$text);
         }
   $text=ereg_replace('<p[^>]+>[ ]{1,}</p>','',$text);
   /** UNFINISHED: Post-processing - double breaks are converted to paragraphs
    * @todo: complete paragraph counting with stack and jumps
    * $text=str_replace('<br /><br />','</p><p>',$text);
    * paragraph counting is done to ensure both opening and closing tags are present
   /*
   $parcount=0;
   for ($i=0;$i<$length;$i++)
       {
       if ($text[$i]=="<")
          {
          if ($text[$i+1]=='p' AND $text[$i+2]=='>') $parcount++;
          if ($text[$i+1]=='/' AND $text[$i+2]=='p') $parcount--;
          $i=$i+2;
          }
       if ($parcount<0)
          {
          // find position where opening paragraph tag should be inserted
          }
       }
   */
   $text=addslashes($text);
   return $text;
   }

   /** Searches for modules available in the system
    * @access private
    * @param array $requestedmodules requested modules for (un)installation (directory name)
    * if empty, then traverse the module directory to fetch all modules
    * @return array
    */
   function RetrieveModules($requestedmodules="")
   {
  /* $modules=array();
   if (!$requestedmodules)
      {
      @$dirhandle=opendir('modules/');
      while ((@$moduledir=readdir($dirhandle))!==false)
            {
            if ($moduledir=='.' OR $moduledir=='..') continue;
            if (file_exists('modules/'.$moduledir.'/module.xml'))
               {
               @$moduleinfo=join('',file('modules/'.$moduledir.'/module.xml'));
               eregi("[^<]+<name>([^<]+)</name>",$moduleinfo,$regs);
               $name=trim($regs[1]);
               $regs[1]="";
               eregi("[^<]+<minversion>([^<]+)</minversion>",$moduleinfo,$regs);
               $minversion=$regs[1];
               $regs[1]="";
               eregi("[^<]+<author>([^<]+)</author>",$moduleinfo,$regs);
               $author=$regs[1];
               $regs[1]="";
               eregi("[^<]+<website>([^<]+)</website>",$moduleinfo,$regs);
               $website=$regs[1];
               $regs[1]="";
               eregi("[^<]+<description>([^<]+)</description>",$moduleinfo,$regs);
               $description=$regs[1];
               }
               else continue;
           if ($minversion>AE_VERSION) continue;
           $guestmodify=0;
           if (file_exists('modules/'.$moduledir.'/'.'menu1.php')) $menu[1]=1; else $menu[1]=0;
           if (file_exists('modules/'.$moduledir.'/'.'menu2.php')) $menu[2]=1; else $menu[2]=0;
           if (file_exists('modules/'.$moduledir.'/'.'menu3.php')) $menu[3]=1; else $menu[3]=0;
           if (file_exists('modules/'.$moduledir.'/'.'menu4.php')) $menu[4]=1; else $menu[4]=0;
           if (file_exists('modules/'.$moduledir.'/'.'menu5.php')) $menu[5]=1; else $menu[5]=0;
           if (file_exists('modules/'.$moduledir.'/'.'guestmodify.php')) $guestmodify=1;
           $modules[]=array("name"=>$name,"minversion"=>$minversion,"author"=>$author,"website"=>$website,"description"=>$description,"moduledir"=>$moduledir,"menu1"=>$menu[1],"menu2"=>$menu[2],"menu3"=>$menu[3],"menu4"=>$menu[4],"menu5"=>$menu[5],"guestmodify"=>$guestmodify);
           }
      }
   else
      {
      foreach ($requestedmodules as $moduledir)
              {
              if (file_exists('modules/'.$moduledir.'/module.xml'))
                 {
                 @$moduleinfo=join('',file('modules/'.$moduledir.'/module.xml'));
                 eregi("[^<]+<name>([^<]+)</name>",$moduleinfo,$regs);
                 $name=trim($regs[1]);
                 $regs[1]="";
                 eregi("[^<]+<minversion>([^<]+)</minversion>",$moduleinfo,$regs);
                 $minversion=$regs[1];
                 $regs[1]="";
                 eregi("[^<]+<author>([^<]+)</author>",$moduleinfo,$regs);
                 $author=$regs[1];
                 $regs[1]="";
                 eregi("[^<]+<website>([^<]+)</website>",$moduleinfo,$regs);
                 $website=$regs[1];
                 $regs[1]="";
                 eregi("[^<]+<description>([^<]+)</description>",$moduleinfo,$regs);
                 $description=$regs[1];
                 }
              else continue;
              if ($minversion>AE_VERSION) continue;
              $guestmodify=0;
              if (file_exists('modules/'.$moduledir.'/'.'menu1.php')) $menu[1]=1; else $menu[1]=0;
              if (file_exists('modules/'.$moduledir.'/'.'menu2.php')) $menu[2]=1; else $menu[2]=0;
              if (file_exists('modules/'.$moduledir.'/'.'menu3.php')) $menu[3]=1; else $menu[3]=0;
              if (file_exists('modules/'.$moduledir.'/'.'menu4.php')) $menu[4]=1; else $menu[4]=0;
              if (file_exists('modules/'.$moduledir.'/'.'menu5.php')) $menu[5]=1; else $menu[5]=0;
              if (file_exists('modules/'.$moduledir.'/'.'guestmodify.php')) $guestmodify=1;
              $modules[]=array("name"=>$name,"minversion"=>$minversion,"author"=>$author,"website"=>$website,"description"=>$description,"moduledir"=>$moduledir,"menu1"=>$menu[1],"menu2"=>$menu[2],"menu3"=>$menu[3],"menu4"=>$menu[4],"menu5"=>$menu[5],"guestmodify"=>$guestmodify);
              }
      }
    */
   return $modules;
   }

   /** Install hooks for the module entered, if no module, then core hooks ???
    * @access private
    * @param string module module directory
    * @return boolean true on success
    */
   function InstallHooks($moduledir="")
   {
   /*
   if ($moduledir) $moduledirfull="modules/".$moduledir."/";
   if (file_exists(TEMPDIR.$moduledirfull."hooks.txt"))
      {
      @$hooks=file(TEMPDIR.$moduledirfull."hooks.txt");
      foreach ($hooks as $value)
              {
              $temp=explode(" ",$value);
              // Hook module on the hook
              if (strpos($temp[0],"*")===FALSE)
                 {
                 $this->DBQuery("SELECT * FROM ".$this->table[14]." WHERE hook='".$temp[0]."'");
                 // If hook is already active, find alternative hook
                 // (last hook related to original hook)
                 if ($this->rowsnumber)
                    {
                    // Find action (add/update/delete) in case, when more hooks available
                    $action=explode("_",$temp[0]);
                    $action=$action[0];
                    while ($this->DBGetRow())
                          {
                          $tempmoduledir=$this->access["moduledir"];
                          $this->DBQuery("SELECT hook FROM ".$this->table[15]." WHERE moduledir='".$tempmoduledir."' AND hook LIKE '%".$action."%'");
                          // If required action does not exist, try to find first available
                          if (!$this->rowsnumber) $this->DBQuery("SELECT hook FROM ".$this->table[15]." WHERE moduledir='".$tempmoduledir."'");
                          $this->DBGetRow();
                          $hook=$this->access["hook"];
                          $this->DBQuery("SELECT * FROM ".$this->table[14]." WHERE hook='".$hook."'");
                          }
                    $this->DBQuery("INSERT INTO ".$this->table[14]." VALUES ('".$moduledir."','".$hook."','".$temp[1]."')");
                    }
                 // Hook is not active, continue and create active hook
                 else
                    {
                    $this->DBQuery("INSERT INTO ".$this->table[14]." VALUES ('".$moduledir."','".$temp[0]."','".$temp[1]."')");
                    }
                 }
              // Module offers new public hooks (when * asterisk is the 0th char)
              else
                 {
                 $temp[0]=str_replace("*","",$temp[0]);
                 $this->DBQuery("INSERT INTO ".$this->table[15]." VALUES ('".$moduledir."','".$temp[0]."','".$temp[1]."')");
                 }
               }
      }
    */
   return TRUE;
   }

   /** Uninstall hooks for the module entered, if no module, then core hooks ???
    * @access private
    * @param string module module directory
    * @return boolean true on success
    */
   function UninstallHooks($moduledir="")
   {
   /*if ($moduledir) $moduledirfull="modules/".$moduledir."/";
   $this->DBQuery("SELECT hook FROM ".$this->table[15]." WHERE moduledir='".$moduledir."'");
   while ($this->DBGetRow())
         {
         $temp=$this->outcome;
         $hook=$this->access["hook"];
         $action=explode("_",$temp[0]);
         $action=$action[0];
         // find, if there is module hooked on module being unistalled
         $this->DBQuery("SELECT moduledir FROM ".$this->table[14]." WHERE hook='".$hook."'");
         $this->DBGetRow();
         $tempmoduledir=$this->access["moduledir"]; // da nam seo
         // check whether module is related to module uninstalled or original hook
         if (file_exists(TEMPDIR."modules/".$tempmoduledir."/hooks.txt"))
            {
            @$temphooks=join('',file(TEMPDIR."modules/".$tempmoduledir."/hooks.txt"));
            // if there is no direct relation between modules
            // move last module close to original hook
            if (strpos($temphooks,$hook)===FALSE)
               {
               $this->DBQuery("SELECT hook FROM ".$this->table[14]." WHERE moduledir='".$moduledir."' AND hook LIKE '%".$action."%'");
               $this->DBGetRow();
               $hook=$this->access["hook"];
               $this->DBQuery("UPDATE ".$this->table[14]." SET hook='".$hook."' WHERE moduledir='".$tempmoduledir."'");
               }
            // if direct hook exists, delete it
            else
               {
               $this->DBQuery("DELETE FROM ".$this->table[14]." WHERE moduledir='".$tempmoduledir."'");
               }
            }
         $this->outcome=$temp;
         }
   $this->DBQuery("DELETE FROM ".$this->table[14]." WHERE moduledir='".$moduledir."'");
   $this->DBQuery("DELETE FROM ".$this->table[15]." WHERE moduledir='".$moduledir."'");
   */
   return TRUE;
   }

   /** Install system.sql for the module entered, if no module, then core system.sql
    * @access private
    * @param string module module directory
    * @return boolean true on success
    */
   function InstallSQL($moduledir="")
   {
   if ($moduledir) $moduledirfull="modules/".$moduledir."/";
   @include(TEMPDIR.$moduledirfull."settings.php");
   $tablename="table".$moduledir;
   if (is_array($$tablename))
      {
      foreach ($$tablename as $value)
              {
              if (!$moduledir) $value=$this->tableprefix.$value;
              else $value=$this->tableprefixmod.$value;
              $this->DBQuery("DROP TABLE IF EXISTS ".$value);
              }
      }
   if (file_exists(TEMPDIR.$moduledirfull."system.sql")) @$sql=join('',file(TEMPDIR.$moduledirfull."system.sql"));
   $sql=explode(";",$sql);
   if (is_array($sql))
      {
      foreach ($sql as $value)
              {
              $value=trim($value);
              if ($value) $this->DBQuery($value);
              }
      }
   return TRUE;
   }

   /** Uninstall database tables for the module entered, if no module, then core tables
    * @access private
    * @param string module module directory
    * @return boolean true on success
    */
   function UninstallSQL($moduledir="")
   {
   if ($moduledir) $moduledirfull="modules/".$moduledir."/";
   @include(TEMPDIR.$moduledirfull."settings.php");
   $tablename="table".$moduledir;
   if (is_array($$tablename))
      {
      foreach ($$tablename as $value)
              {
              if (!$moduledir ) $value=$this->tableprefix.$value;
              else $value=$this->tableprefixmod.$value;
              $this->DBQuery("DROP TABLE IF EXISTS ".$value);
              }
      }
   return TRUE;
   }



   // Sets variables received through POST/GET/COOKIE (forms and links mostly)
   // Add slashes if $mode=1, strip slashes when $mode=0 (by default)
   function RequestVariables($mode=0)
   {
   // Strip slashes
   if ($mode==0)
      {
      if (!ini_get('magic_quotes_gpc'))
         {
         foreach ($_COOKIE as $key=>$value)
                 {
                 if (!is_array($value))
                    {
                    $this->$key=stripslashes($value);
                    }
                 else
                    {
                    foreach ($value as $keyarr=>$valuearr)
                            {
                            if (!is_array($valuearr))
                               {
                               $this->{$key}[$keyarr]=stripslashes($valuearr);
                               }
                            else
                               {
                               foreach ($valuearr as $keyarr2=>$valuearr2)
                                       {
                                       $this->{$key}[$keyarr][$keyarr2]=stripslashes($valuearr2);
                                       }
                               }
                            }
                    }
                 }
         foreach ($_GET as $key=>$value)
                 {
                 if (!is_array($value))
                    {
                    $this->$key=stripslashes($value);
                    }
                 else
                    {
                    foreach ($value as $keyarr=>$valuearr)
                            {
                            if (!is_array($valuearr))
                               {
                               $this->{$key}[$keyarr]=stripslashes($valuearr);
                               }
                            else
                               {
                               foreach ($valuearr as $keyarr2=>$valuearr2)
                                       {
                                       $this->{$key}[$keyarr][$keyarr2]=stripslashes($valuearr2);
                                       }
                               }
                            }
                    }
                 }
         foreach ($_POST as $key=>$value)
                 {
                 if (!is_array($value))
                    {
                    $this->$key=stripslashes($value);
                    }
                 else
                    {
                    foreach ($value as $keyarr=>$valuearr)
                            {
                            if (!is_array($valuearr))
                               {
                               $this->{$key}[$keyarr]=stripslashes($valuearr);
                               }
                            else
                               {
                               foreach ($valuearr as $keyarr2=>$valuearr2)
                                       {
                                       $this->{$key}[$keyarr][$keyarr2]=stripslashes($valuearr2);
                                       }
                               }
                            }
                    }
                 }
         }
      else
         {
         foreach ($_COOKIE as $key=>$value)
                 {
                 $this->$key=$_COOKIE[$key];
                 }
         foreach ($_GET as $key=>$value)
                 {
                 $this->$key=$_GET[$key];
                 }
         foreach ($_POST as $key=>$value)
                 {
                 $this->$key=$_POST[$key];
                 }
         }
      }
   // Add slashes
   if ($mode==1)
      {
      if (!ini_get('magic_quotes_gpc'))
         {
         foreach ($_COOKIE as $key=>$value)
                 {
                 if (!is_array($value))
                    {
                    $this->$key=addslashes($value);
                    }
                 else
                    {
                    foreach ($value as $keyarr=>$valuearr)
                            {
                            if (!is_array($valuearr))
                               {
                               $this->{$key}[$keyarr]=addslashes($valuearr);
                               }
                            else
                               {
                               foreach ($valuearr as $keyarr2=>$valuearr2)
                                       {
                                       $this->{$key}[$keyarr][$keyarr2]=addslashes($valuearr2);
                                       }
                               }
                            }
                    }
                 }
         foreach ($_POST as $key=>$value)
                 {
                 if (!is_array($value))
                    {
                    $this->$key=addslashes($value);
                    }
                 else
                    {
                    foreach ($value as $keyarr=>$valuearr)
                            {
                            if (!is_array($valuearr))
                               {
                               $this->{$key}[$keyarr]=addslashes($valuearr);
                               }
                            else
                               {
                               foreach ($valuearr as $keyarr2=>$valuearr2)
                                       {
                                       $this->{$key}[$keyarr][$keyarr2]=addslashes($valuearr2);
                                       }
                               }
                            }
                    }
                 }
         foreach ($_GET as $key=>$value)
                 {
                 if (!is_array($value))
                    {
                    $this->$key=addslashes($value);
                    }
                 else
                    {
                    foreach ($value as $keyarr=>$valuearr)
                            {
                            if (!is_array($valuearr))
                               {
                               $this->{$key}[$keyarr]=addslashes($valuearr);
                               }
                            else
                               {
                               foreach ($valuearr as $keyarr2=>$valuearr2)
                                       {
                                       $this->{$key}[$keyarr][$keyarr2]=addslashes($valuearr2);
                                       }
                               }
                            }
                    }
                 }
         }
      else
         {
         foreach ($_COOKIE as $key=>$value)
                 {
                 $this->$key=$_COOKIE[$key];
                 }
         foreach ($_POST as $key=>$value)
                 {
                 $this->$key=$_POST[$key];
                 }
         foreach ($_GET as $key=>$value)
                 {
                 $this->$key=$_GET[$key];
                 }
         }
      foreach ($_FILES as $key=>$value)
              {
              $this->$key=$_FILES[$key];
              }
      }
   }

/* ****************************************************************************************
*******************************************************************************************
******************************** FUNCTIONS FOR PUBLIC PAGES *******************************
*******************************************************************************************
**************************************************************************************** */

   // Initializes variables for use in public pages
   function PublicInitialize()
   {
   $this->DBConnect();
   $this->pathimages=str_replace("../","",$this->pathimages);
   $this->pathfiles=str_replace("../","",$this->pathfiles);
   /*$this->DBQuery("SELECT * FROM ".$this->table[8]." ORDER BY module");
   while ($this->DBGetRow())
         {
         $directory=$this->access["directory"];
         $variablename="var".$directory;
         $tablename="table".$directory;
         $file="variables.php";
         if (file_exists(TEMPDIR.'modules/'.$directory.'/'.$file))
            {
            @include(TEMPDIR.'modules/'.$directory.'/'.$file);
            }
         elseif (file_exists(TEMPDIR.'modules/'.$directory.'/'.'variables.php'))
            {
            @include(TEMPDIR.'modules/'.directory.'/'.'variables.php');
            }
         $this->charset=$charset;
         if (file_exists(TEMPDIR.'modules/'.$directory.'/'.'settings.php'))
            {
            @include(TEMPDIR.'modules/'.$directory.'/'.'settings.php');
            if (isset($$tablename) AND is_array($$tablename))
               {
               foreach ($$tablename as $key=>$value)
                       {
                       $this->{$tablename}[$key]=$this->tableprefixmod.$value;
                       }
               }
            if (isset($$variablename) AND is_array($$variablename))
               {
               foreach ($$variablename as $key=>$value)
                       {
                       $this->{$variablename}[$key]=$value;
                       }
               }
            }
         }
         */
   }

}

?>
