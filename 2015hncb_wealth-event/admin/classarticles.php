<?
/**
 * @package absolutengine
 */
/** Article class for handling all article-related functions
 */
class CArticles extends CEngine
{

   function CArticles()
   {
   $this->indent=""; $this->ID=""; $this->title=""; $this->beginning=""; $this->text="";
   $this->adate=""; $this->atime=""; $this->imagesetID=""; $this->filesetID="";
   $this->priority=""; $this->status=""; $this->articlenumber="";
   $this->CEngine();
   }

   /** Loop through the sections and generate a section list
    * @access public
    * @param int $type type of section list to be displayed - 0 public list, 1 links using UL, 2 dropdown menu using &nbsp, 3 checkboxes below each other;
    * @param boolean $order - 0 order by priority, 1 order alphabetically
    * @param boolean $override - override current section filtering 0 do nothing, 1 override and show
    * @param string $attribute - ID or class attribute
    */
   function LoopThroughSectionList($parentsectionID,$type=0,$order=0,$override=0,$attribute="")
   {
   if (!$order) $orderby="priority DESC";
   else $orderby="section";
   $this->DBQuery("SELECT * FROM ".$this->table[0]." WHERE parentsectionID='".$parentsectionID."' ORDER BY ".$orderby);
   $found=$this->rowsnumber;
   if ($found AND $type<2)
      {
      if (!$attribute) echo '<ul class="sectionlist">';
      else echo '<ul ',$attribute,'>';
      }
   elseif ($found AND $type>=2 AND $parentsectionID<>0)
      {
      $this->indent=$this->indent+4;
      }
   while ($this->DBGetRow())
         {
         $temp=$this->outcome;
         $sectionID=$this->access["ID"];
         $section=$this->access["section"];
         $filename=$this->access["filename"];
         if ($type<2) echo '<li>';
         if ($type==3) echo '<label></label>';
         if ($type==0)
            {
            echo '<a href="';
            if ($this->cleanurls==2 AND $filename) echo $filename;
            else echo 'showsection.php?sectionID=',$sectionID;
            echo '">',$section,'</a>';
            }
         elseif ($type==1)
            {
            echo '<a href="managersection.php?&username=',$this->username,'&session=',$this->session,'&sectionID=',$sectionID,'" title="ID: ',$sectionID,'">';
            echo $section;
            echo '</a>';
            $this->DBQuery("SELECT ID FROM ".$this->table[0]." WHERE parentsectionID='".$parentsectionID."' ORDER BY priority DESC LIMIT 1");
            $this->DBGetRow();
            if ($sectionID<>$this->access["ID"])
               {
               echo ' <a href="modify.php?command=32&username=',$this->username,'&session=',$this->session,'&sectionID=',$sectionID,'&direction=3"><img src="images/top.gif" class="noborder" alt=""></a>';
               echo ' <a href="modify.php?command=32&username=',$this->username,'&session=',$this->session,'&sectionID=',$sectionID,'&direction=1"><img src="images/up.gif" class="noborder" alt=""></a>';
               }
            $this->DBQuery("SELECT ID FROM ".$this->table[0]." WHERE parentsectionID='".$parentsectionID."' ORDER BY priority ASC LIMIT 1");
            $this->DBGetRow();
            if ($sectionID<>$this->access["ID"])
               {
               echo ' <a href="modify.php?command=32&username=',$this->username,'&session=',$this->session,'&sectionID=',$sectionID,'&direction=2"><img src="images/down.gif" class="noborder" alt=""></a>';
               echo ' <a href="modify.php?command=32&username=',$this->username,'&session=',$this->session,'&sectionID=',$sectionID,'&direction=4"><img src="images/bottom.gif" class="noborder" alt=""></a>';
               }
            echo ' <a href="modify.php?command=30&username=',$this->username,'&session=',$this->session,'&sectionID=',$sectionID,'" onclick="return confirm(\'',$this->textbasic[53],'\')"><img src="images/x.gif" class="noborder" alt=""></a>';
            }
         elseif ($type==2 AND ($sectionID<>$this->sectionID OR $override))
            {
            echo '<option value="',$sectionID,'"';
            if ($this->articleID)
               {
               $this->DBQuery("SELECT * FROM ".$this->table[9]." WHERE articleID='".$this->articleID."' AND sectionID='".$sectionID."'");
               if ($this->rowsnumber) echo ' selected="selected"';
               }
            elseif ($this->sectionID AND !is_array($this->sectionID))
               {
               $this->DBQuery("SELECT * FROM ".$this->table[0]." WHERE parentsectionID='".$sectionID."' AND ID='".$this->sectionID."'");
               if ($this->rowsnumber) echo ' selected="selected"';
               if ($override AND $sectionID==$this->sectionID) echo ' selected="selected"';
               }
            elseif ($this->sectionID AND is_array($this->sectionID))
               {
               foreach ($this->sectionID as $value)
                       {
                       if ($sectionID==$value) echo ' selected="selected"';
                       }
               }
            echo '>';
            for ($i=0;$i<$this->indent;$i++)
                {
                echo '&nbsp;';
                }
            echo $section;
            echo '</option>';
            }
         elseif ($type==3 AND $sectionID<>$this->sectionID)
            {
            for ($i=0;$i<$this->indent;$i++)
                {
                echo '&nbsp;';
                }
            echo '<input type="checkbox" name="sectionID[]" id="sectionID[',$sectionID,']" value="',$sectionID,'"';
            if ($this->articleID)
               {
               $this->DBQuery("SELECT * FROM ".$this->table[9]." WHERE articleID='".$this->articleID."' AND sectionID='".$sectionID."'");
               if ($this->rowsnumber) echo ' checked="checked"';
               }
            elseif ($this->sectionID AND !is_array($this->sectionID))
               {
               $this->DBQuery("SELECT * FROM ".$this->table[0]." WHERE parentsectionID='".$sectionID."' AND ID='".$this->sectionID."'");
               if ($this->rowsnumber) echo ' checked="checked"';
               }
            elseif ($this->sectionID AND is_array($this->sectionID))
               {
               foreach ($this->sectionID as $value)
                       {
                       if ($sectionID==$value) echo ' checked="checked"';
                       }
               }
            echo ' /><label for="sectionID[',$sectionID,']" class="nofloat">';
            echo $section;
            echo '</label><br class="clear" />';
            }
         $this->LoopThroughSectionList($sectionID,$type,$order,$override);
         if ($type<2) echo '</li>';
         $this->outcome=$temp;
         }
   if ($found AND $type<2)
      {
      echo '</ul>';
      }
   elseif ($found AND $type>=2)
      {
      $this->indent=$this->indent-4;
      }
   }

   /** Retrieve parent section for the section
    * @access public
    * @param int $sectionID ID of section
    * @return int $parentsectionID ID of parent section above section
    */
   function GetParentSection($sectionID=0)
   {
   if (!$sectionID) $sectionID=$this->sectionID;
   $this->DBQuery("SELECT parentsectionID FROM ".$this->table[0]." WHERE ID='".$sectionID."'");
   $this->DBGetRow();
   return $this->access["parentsectionID"];
   }

   function GetTopSection($sectionID=0)
   {
   if (!$sectionID) $sectionID=$this->sectionID;
   $this->DBQuery("SELECT parentsectionID FROM ".$this->table[0]." WHERE ID='".$sectionID."'");
   $this->DBGetRow();
   $parentsectionID=$this->access["parentsectionID"];
   if ($parentsectionID<>0)
      {
      $sectionID=$this->GetTopSection($parentsectionID);
      }
   return $sectionID;
   }

   /** Retrieve sections for the article
    * @access public
    * @param int $articleID ID of article
    */
   function GetArticleSections($articleID=0)
   {
   if (!$articleID) $articleID=$this->articleID;
   $this->DBQuery("SELECT sec.ID AS ID,section,parentsectionID,priority,filename FROM ".$this->table[9]." AS artsec LEFT JOIN ".$this->table[0]." AS sec ON artsec.sectionID=sec.ID WHERE artsec.articleID='".$articleID."'");
   }

   /** Retrieves section
    * @access public
    */
   function GetSection($settings)
   {
   $this->DBQuery("SELECT * FROM ".$this->table[0]." WHERE ID='".$settings["sectionID"]."'");
   }

   /** Print section name
    * @access public
    */
   function GetSectionName()
   {
   echo $this->access["section"];
   }

   /** Print section name
    * @access public
    * @deprecated from v1.71 DO NOT USE! This function is obsolete and will be deleted in next version
    * Function has been replaced by GetSectionName()
    * @see GetSectionName()
    */
   function GetArticleSection()
   {
   $this->GetSectionName();
   }

   /** Return section ID
    * @access public
    */
   function GetSectionID()
   {
   return $this->access["ID"];
   }

   /** Return parent sectionID of section
    * @access public
    */
   function GetParentSectionID()
   {
   return $this->access["ID"];
   }

   /** Return articleID describing section
    * @access public
    */
   function GetSectionArticleID()
   {
   return $this->access["articleID"];
   }

   /** Return filename of section
    * @access public
    */
   function GetSectionFilename()
   {
   return $this->access["filename"];
   }

   /** Return priority of section
    * @access public
    */
   function GetSectionPriority()
   {
   return $this->access["priority"];
   }

   /** Retrieve articles from database
    * @access public
    * function accepts two styles of parameters due to backward compatibility
    * OLD STYLE (v1.70) is deprecated, use only new style with $settings array
    * @param array $settings array of parameters, see below:
    * "articlenumber"=>int number of articles to list
    * "offset"=>int offset to show articles from
    * "fromdate"=>string articles to be shown from date (date format in settings.php)
    * "todate"=>string articles to be shown up to date (date format as in settings.php)
    * "authorID"=>string articles written by author ID (comma delimited list for multiple values)
    * "sectionID"=>string articles in section ID (comma delimited list for multiple values)
    * "priority"=>boolean 0,1
    * "status"=>boolean 0,1
    * "articleID"=>int ID of article to be displayed
    * "order"=>string use MySQL format ("adate DESC, atime DESC, priority DESC" etc.)
    * EXCLUSION: !X = !4 - will exclude author/section with ID 4 if used in authorID or sectionID
    *
    * This will list latest 10 articles with priority 1
    * <code>
    * <?
    * $settings=array(
    *                "articlenumber"=>10,
    *                "priority"=>1
    *                );
    * $aepublic->GetArchive($settings);
    * .
    * .
    * .
    * ?>
    * </code>
    * This will list 10 articles starting from 5th result from January 1st 2004 to January 31st 2004 in section 5 and 14
    * Please note that date format matches date format in settings.php, for the example below it is "DD.MM.YYYY" - you always need to match date format as set in settings.php!
    * <code>
    * <?
    * $settings=array(
    *                "articlenumber"=>10,
    *                "offset"=>5,
    *                "fromdate"=>"01.01.2004",
    *                "todate"=>"31.01.2004",
    *                "sectionID"=>"5,14"
    *                );
    * $aepublic->GetArchive($settings);
    * .
    * .
    * .
    * ?>
    * </code>
    * This will list latest 50 articles written by authors with ID 2 and 10 and put under section ID 5 and 8, but NOT section ID 7
    * Result is sorted by from the oldest to the newest articles
    * <code>
    * <?
    * $settings=array(
    *                "articlenumber"=>50,
    *                "authorID"=>"2,10",
    *                "sectionID"=>"5,8,!7",
    *                "order"=>"adate ASC, atime ASC"
    *                );
    * $aepublic->GetArchive($settings);
    * .
    * .
    * .
    * ?>
    * </code>
    */
   function GetArchive($settings=10,$adate=0,$sectionID="all",$authorID="all",$priority="all",$articleID=0)
   {
   $condition="1"; $join="";
   // Due to backward compatiblity issues, we need to test and retrieve number of parameters
   $number=func_num_args();
   // if old style is used
   if (is_int($settings) OR $number>1)
      {
      if (!$adate) $condition.=" AND adate<='".date("Y-m-d")."'";
      if ($settings==="all") $settings=999999999;
      if ($sectionID<>"all") $condition.=" AND sec.sectionID='".$sectionID."'";
      if ($authorID<>"all") $condition.=" AND authorID='".$authorID."'";
      if ($priority<>"all") $condition.=" AND art.priority='".$priority."'";
      $condition.=" AND art.status='1'";
      if ($articleID) $condition=" art.ID='".$articleID."'";
      $order="adate DESC, atime DESC, priority DESC";
      $limit=$settings;
      }
   // if new style is used
   elseif (is_array($settings))
      {
      if (isset($settings["fromdate"])) $condition.=" AND art.adate>='".$this->DateConversion($settings["fromdate"])."'";
      if (isset($settings["todate"])) $condition.=" AND art.adate<='".$this->DateConversion($settings["todate"])."'";
      else $condition.=" AND art.adate<='".date("Y-m-d")."'";
      // multiple authorID can be entered separated by commas
      if (isset($settings["authorID"]))
         {
         $joinnumber="";
         $authors=explode(",",$settings["authorID"]);
         if (is_array($authors))
            {
            foreach ($authors as $authorID)
                    {
                    if (strpos($authorID,"!")===FALSE)
                       {
                       $condition.=" AND art".$joinnumber.".authorID='".$authorID."'";
                       }
                    else
                       {
                       $authorID=str_replace("!","",$authorID);
                       $condition.=" AND art".$joinnumber.".authorID<>'".$authorID."'";
                       }
                    if (!$joinnumber)
                       {
                       $joinnumber=2;
                       }
                    else
                       {
                       $join.=" LEFT JOIN ae_articlesections AS sec".$joinnumber." ON art.ID=sec".$joinnumber.".articleID";
                       $joinnumber++;
                       }
                    }
            }
         }
      // multiple sectionID can be entered separated by commas
      if (isset($settings["sectionID"]))
         {
         $joinnumber="";
         $sections=explode(",",$settings["sectionID"]);
         foreach ($sections as $sectionID)
                 {
                 if (strpos($sectionID,"!")===FALSE)
                    {
                    $condition.=" AND sec".$joinnumber.".sectionID='".$sectionID."'";
                    }
                 else
                    {
                    $sectionID=str_replace("!","",$sectionID);
                    $condition.=" AND sec".$joinnumber.".sectionID<>'".$sectionID."'";
                    }
                 if (!$joinnumber)
                       {
                       $joinnumber=2;
                       }
                    else
                      {
                       $join.=" LEFT JOIN ".$this->table[0]." AS sec".$joinnumber." ON art.ID=sec".$joinnumber.".articleID";
                       $joinnumber++;
                       }
                 }
         }
      if (isset($settings["priority"])) $condition.=" AND art.priority='".$settings["priority"]."'";
      if (isset($settings["status"])) $condition.=" AND art.status='".$settings["status"]."'";
      else $condition.=" AND art.status='1'";
      if (isset($settings["order"])) $order=$settings["order"];
      else $order="adate DESC, atime DESC, priority DESC";
      if (isset($settings["articlenumber"])) $limit=$settings["articlenumber"];
      else $limit=9999999;
      if (isset($settings["offset"]) AND isset($settings["articlenumber"])) $limit=$settings["offset"].",".$settings["articlenumber"];
      if (isset($settings["articleID"])) $condition=" art.ID='".$settings["articleID"]."'";
      }
   $this->DBQuery("SELECT * FROM ".$this->table[3]." AS art LEFT JOIN ".$this->table[9]." AS sec ON art.ID=sec.articleID ".$join." WHERE ".$condition." GROUP BY art.ID ORDER BY ".$order." LIMIT ".$limit);
   }

   /** Search articles in database
    * @access public
    * function accepts two styles of parameters due to backward compatibility
    * OLD STYLE (v1.70) is deprecated, use only new style with $settings array
    * @param array $settings array of parameters, see below:
    * "query"=>string text to find
    * "searchin"=>string where the search should be made: title,beginning,text (comma delimited list for multiple values)
    * "style"=>string should the search be fulltext (fulltext) or just free match (anypart)
    * "articlenumber"=>int number of articles to list
    * "offset"=>int offset to show articles from
    * "fromdate"=>string articles to be shown from date (date format in settings.php)
    * "todate"=>string articles to be shown up to date (date format as in settings.php)
    * "authorID"=>string articles written by author ID (comma delimited list for multiple values)
    * "sectionID"=>string articles in section ID (comma delimited list for multiple values)
    * "priority"=>boolean 0,1
    * "status"=>boolean 0,1
    * "articleID"=>int ID of article to be displayed
    * "order"=>string use MySQL format ("adate DESC, atime DESC, priority DESC" etc.)
    * EXCLUSION: !X = !4 - will exclude author/section with ID 4 if used in authorID or sectionID
    */
   function SearchArchive($settings,$articlenumber=10,$adate=0)
   {
   $condition="1"; $join="";
   // Due to backward compatiblity issues, we need to test and retrieve number of parameters
   $number=func_num_args();
   // if old style is used
   if (is_string($settings) OR $number>1)
      {
      $condition="(title LIKE '%".$settings."%' OR beginning LIKE '%".$settings."%' OR text LIKE '%".$settings."%')";
      if (!$adate) $condition.=" AND adate<='".date("Y-m-d")."'";
      if ($articlenumber==="all") $articlenumber=999999999;
      $order="priority DESC, adate DESC, atime DESC";
      $limit=$articlenumber;
      }
   // if new style is used
   elseif (is_array($settings))
      {
      $condition.=" AND (0";
      if (isset($settings["searchin"]))
         {
         $searchins=explode(",",$settings["searchin"]);
         foreach ($searchins as $searchin)
                 {
                 if (strpos($searchin,"!")===FALSE)
                    {
                    if ($settings["style"]=="anypart") $condition.=" OR art.".$searchin." LIKE '%".$settings["query"]."%'";
                    elseif ($settings["style"]=="fulltext") $condition.=" OR MATCH(art.".$searchin.") AGAINST ('".$settings["query"]."')";
                    }
                 else
                    {
                    $searchin=str_replace("!","",$searchin);
                    if ($settings["style"]=="anypart") $condition.=" OR art.".$searchin." LIKE '%".$settings["query"]."%'";
                    elseif ($settings["style"]=="fulltext") $condition.=" OR MATCH(art.".$searchin.") AGAINST (-'".$settings["query"]."')";
                    }
                 }
         }
      $condition.=") ";
      if (isset($settings["fromdate"])) $condition.=" AND art.adate>='".$this->DateConversion($settings["fromdate"])."'";
      if (isset($settings["todate"])) $condition.=" AND art.adate<='".$this->DateConversion($settings["todate"])."'";
      else $condition.=" AND art.adate<='".date("Y-m-d")."'";
      // multiple authorID can be entered separated by commas
      if (isset($settings["authorID"]))
         {
         $joinnumber="";
         $authors=explode(",",$settings["authorID"]);
         if (is_array($authors))
            {
            foreach ($authors as $authorID)
                    {
                    if (strpos($authorID,"!")===FALSE)
                       {
                       $condition.=" AND art".$joinnumber.".authorID='".$authorID."'";
                       }
                    else
                       {
                       $authorID=str_replace("!","",$authorID);
                       $condition.=" AND art".$joinnumber.".authorID<>'".$authorID."'";
                       }
                    if (!$joinnumber)
                       {
                       $joinnumber=2;
                       }
                    else
                       {
                       $join.=" LEFT JOIN ae_articlesections AS sec".$joinnumber." ON art.ID=sec".$joinnumber.".articleID";
                       $joinnumber++;
                       }
                    }
            }
         }
      // multiple sectionID can be entered separated by commas
      if (isset($settings["sectionID"]))
         {
         $joinnumber="";
         $sections=explode(",",$settings["sectionID"]);
         foreach ($sections as $sectionID)
                 {
                 if (strpos($sectionID,"!")===FALSE)
                    {
                    $condition.=" AND sec".$joinnumber.".sectionID='".$sectionID."'";
                    }
                 else
                    {
                    $sectionID=str_replace("!","",$sectionID);
                    $condition.=" AND sec".$joinnumber.".sectionID<>'".$sectionID."'";
                    }
                 if (!$joinnumber)
                       {
                       $joinnumber=2;
                       }
                    else
                       {
                       $join.=" LEFT JOIN ae_articlesections AS sec".$joinnumber." ON art.ID=sec".$joinnumber.".articleID";
                       $joinnumber++;
                       }
                 }
         }
      if (isset($settings["priority"])) $condition.=" AND art.priority='".$settings["priority"]."'";
      if (isset($settings["status"])) $condition.=" AND art.status='".$settings["status"]."'";
      else $condition.=" AND art.status='1'";
      if (isset($settings["order"])) $order=$settings["order"];
      else $order="adate DESC, atime DESC, priority DESC";
      if (isset($settings["articlenumber"])) $limit=$settings["articlenumber"];
      else $limit=9999999;
      if (isset($settings["offset"]) AND isset($settings["articlenumber"])) $limit=$settings["offset"].",".$settings["articlenumber"];
      if (isset($settings["articleID"])) $condition=" art.ID='".$settings["articleID"]."'";
      }
   $this->DBQuery("SELECT * FROM ".$this->table[3]." AS art LEFT JOIN ".$this->table[9]." AS sec ON art.ID=sec.articleID ".$join." WHERE ".$condition." GROUP BY art.ID ORDER BY ".$order." LIMIT ".$limit);
   }

   /** Retrieve article content
    * @access public
    */
   function GetArticle()
   {
   $this->articleID=$this->access["ID"];
   $this->title=stripslashes($this->access["title"]);
   $this->beginning=stripslashes($this->access["beginning"]);
   $this->summary=stripslashes($this->access["text"]);
   $this->summary=str_replace("<br>","\n",$this->summary);
   $this->summary=str_replace("<br/>","\n",$this->summary);
   $this->summary=str_replace("<br />","\n",$this->summary);
   $this->summary=str_replace("\n"," ",$this->summary);
   $this->summary=strip_tags($this->summary);
   @$dotposition=strpos($this->summary,". ",180);
   if ($dotposition===FALSE) $dotposition=300;
   $this->summary=substr($this->summary,0,$dotposition+1);
   $this->text=stripslashes($this->access["text"]);
   $this->authorID=$this->access["authorID"];
   $this->adate=$this->access["adate"];
   $this->adate=$this->DateConversion($this->adate,2);
   $this->atime=$this->access["atime"];
   $this->imagesetID=$this->access["imagesetID"];
   $this->filesetID=$this->access["filesetID"];
   $this->priority=$this->access["priority"];
   $this->status=$this->access["status"];
   $this->filename=$this->access["filename"];
   }

   /** Update number of views for article
    * @access public
    * @param int $articleID
    */
   function UpdateArticleStats($articleID=0)
   {
   if (!$articleID) $articleID=$this->articleID;
   $this->DBQuery("UPDATE ".$this->table[4]." SET views=views+1 WHERE articleID='".$articleID."'");
   }

   /** Return ID of article
    * @access public
    * @return int articleID ID of article
    */
   function GetArticleID()
   {
   return $this->articleID;
   }

   /** Print title of article
    * @access public
    */
   function GetArticleTitle()
   {
   echo $this->title;
   }

   /** Print beginning of article
    * @deprecated from v1.71
    * @access public
    * Beginning will not be supported in future
    * @see GetArticleSummary()
    * @see GetArticleText()
    */
   function GetArticleBeginning()
   {
   $this->beginning=nl2br($this->beginning);
   echo $this->beginning;
   }

   /** Print summary for article (e.g. first few sentences of the text)
    * @access public
    * Use instead of GetArticleBeginning()
    * Function searches first 180 characters of text of the article for a dot.
    * If found it then creates summary text (few sentences) until that position
    * If not found, it takes first 300 characters of text as a summary
    * @todo: Allow for changing the length of summary as well as symbol that is being searched for
    */
   function GetArticleSummary()
   {
   echo $this->summary;
   }

   /** Print text of article
    * @access public
    */
   function GetArticleText()
   {
   echo $this->text;
   }

   /** Print date of publishing of article
    * @access public
    */
   function GetArticleDate()
   {
   echo $this->adate;
   }

   /** Print time of publishing of article
    * @access public
    */
   function GetArticleTime()
   {
   echo $this->atime;
   }

   /** Return filename of article
    * @access public
    * @return string filename filename of article
    */
   function GetArticleFilename()
   {
   return $this->filename;
   }

   /** Retrieve information about author
    * @access public
    * @param int $authorID ID of author
    */
   function GetArticleAuthor($authorID=0)
   {
   if (!$authorID) $authorID=$this->authorID;
   $temp=$this->outcome;
   $this->DBQuery("SELECT fullname,email,otherinfo,photo FROM ".$this->table[5]." WHERE ID='".$authorID."'");
   $this->DBGetRow();
   $this->author=$this->access["fullname"];
   $this->email=$this->access["email"];
   $this->otherinfo=$this->access["otherinfo"];
   $this->photo=$this->access["photo"];
   $this->outcome=$temp;
   }

   /** Return ID of author
    * @access public
    */
   function GetAuthorID()
   {
   return $this->authorID;
   }

   /** Print name of author
    * @access public
    */
   function GetAuthorName()
   {
   echo $this->author;
   }

   /** Print email of author
    * @access public
    */
   function GetAuthorEmail()
   {
   echo $this->email;
   }

   /** Print extended information about author
    * @access public
    */
   function GetAuthorInfo()
   {
   echo $this->otherinfo;
   }

   /** Retrieve image set / DEPRECATED
    * @access public
    * @deprecated from v1.71 DO NOT USE! This function is obsolete and will be deleted in next version
    * Function has been replaced by GetArticleImageSet()
    * @see GetArticleImageSet()
    */
   function GetArticleImages($before="",$after="",$number=10,$link=0,$imagenumber=0)
   {
   $temp=$this->outcome;
   $this->GetArticleImageSet();
   $i=0;
   while ($this->DBGetRow())
         {
         if ($i==$number) break;
         if (!$link) echo $before,'<img src="',$this->pathimages,$this->GetImageThumbnail(),'" alt="',$this->access["description"],'" />',$after;
         elseif ($link==1 AND !$this->cleanurls) echo $before,'<a href="showarticle.php?articleID=',$this->GetArticleID(),'"><img src="',$this->pathimages,$this->GetImageThumbnail(),'" alt="',$this->access["description"],'" /></a>',$after;
         elseif ($link==1 AND $this->cleanurls) echo $before,'<a href="',$this->access["filename"],'"><img src="',$this->pathimages,$this->GetImageThumbnail(),'" alt="',$this->access["description"],'" /></a>',$after;
         elseif ($link==2) echo $before,'<a href="',$this->pathimages,$this->access["filename"],'"><img src="',$this->pathimages,$this->GetImageThumbnail(),'" alt="',$this->access["description"],'" /></a>',$after;
         $i++;
         }
   $this->outcome=$temp;
   }

   /** Replace image tags / DEPRECATED
    * @access public
    * @deprecated from v1.71 DO NOT USE! This function is obsolete and will be deleted in next version
    * Function does not have replacement for now - SORRY
    * @todo Possibly some sophisticated image replacing in future
    */
   function ReplaceImageTags($replace=0,$link=1)
   {
   }

   /** Replace file tags / DEPRECATED
    * @access public
    * @deprecated from v1.71 DO NOT USE! This function is obsolete and will be deleted in next version
    * Function does not have replacement for now - SORRY
    * @todo Possibly some sophisticated image replacing in future
    */
   function ReplaceFileTags($replace=0)
   {
   }

   /** Retrieve image set
    * @access public
    * @param int imagesetID ID of image set
    */
   function GetArticleImageSet($imagesetID=0)
   {
   if (!$imagesetID) $imagesetID=$this->imagesetID;
   $this->DBQuery("SELECT sets.description AS setdescription,filename,images.description AS description,authorID FROM ".$this->table[1]." AS images LEFT JOIN ".$this->table[13]." AS sets ON images.imagesetID=sets.ID WHERE sets.ID='".$imagesetID."' ORDER BY images.ID");
   }

   /** Return imagename
    * @access public
    */
   function GetImageName()
   {
   return $this->access["filename"];
   }

   /** Return thumbnail name for image
    * @access public
    */
   function GetImageThumbnail()
   {
   return $this->GetThumbnailName($this->access["filename"]);
   }

   /** Return image description
    * @access public
    */
   function GetImageDescription()
   {
   return $this->access["description"];
   }

   /** Return imageset description
    * @access public
    */
   function GetImageSetDescription()
   {
   return $this->access["setdescription"];
   }

   /** Retrieve file set / DEPRECATED
    * @access public
    * @deprecated from v1.71 DO NOT USE! This function is obsolete and will be deleted in next version
    * Function has been replaced by GetArticleFileSet()
    * @see GetArticleFileSet()
    */
   function GetArticleFiles()
   {
   $temp=$this->outcome;
   $this->GetArticleFileSet();
   $this->outcome=$temp;
   }

   /** Retrieve file set
    * @access public
    * @param int filesetID ID of file set
    */
   function GetArticleFileSet($filesetID=0)
   {
   if (!$filesetID) $filesetID=$this->filesetID;
   $this->DBQuery("SELECT sets.description AS setdescription,filename,authorID FROM ".$this->table[2]." AS files LEFT JOIN "s->access["ID"];
   $this->DBQuery("SELECT sectionID FROM ".$this->table[3]." AS articles LEFT JOIN ".$this->table[9]." AS articlesections ON articles.ID=articlesections.articleID WHERE articles.ID='".$articleID."'");
   while ($this->DBGetRow())
         {
         $temp=$this->outcome;
         $sectionID=$this->access["sectionID"];
         $articletopsectionID=$this->GetTopSection($sectionID);
         if ($topsectionID==$articletopsectionID)
            {
            $this->outcome=$temp;
            return 1;
            }
         $this->outcome=$temp;
         }
   return 0;
   }

   /** Retrieve related articles for article $articleID
    * @access public
    */
   function GetRelatedArchive($articleID)
   {
   $this->DBQuery("SELECT DISTINCT rel.relatedID AS articleID,art.* FROM ".$this->table[7]." AS rel LEFT JOIN ".$this->table[3]." AS art ON relatedID=art.ID LEFT JOIN ".$this->table[9]." AS sec ON art.ID=sec.articleID WHERE rel.articleID='".$articleID."'");
   }

   /** Get related article / DEPRECATED
    * @access public
    * @deprecated from v1.71 DO NOT USE! This function is obsolete and will be deleted in next version
    * Function has been replaced by GetArticle()
    * @see GetArticle()
    */
   function GetRelatedArticle()
   {
   $this->GetArticle();
   }

}

?>