<?
@include("coreclass.php");
$ae=new CEngine();
$ae->RequestVariables(1);
$ae->EngineInitialize();
$ae->UserVerifySession();
// if Search submit button is pressed, redirect to related articles screen
if ($ae->command==15 AND $ae->submit==$ae->textbasic[112])
   {
   header("location: http://".$ae->server."/".$ae->path."admin/managerrelated.php?username=".$ae->username."&session=".$ae->session."&articleID=".$ae->articleID."&title=".$ae->title);
   exit;
   }
// Imageset: if Edit submit button is pressed, redirect to edit imageset screen
if ($ae->command==10 AND $ae->submit==$ae->textbasic[106])
   {
   if ($ae->imagesetID[0])
      {
      header("location: http://".$ae->server."/".$ae->path."admin/managerimage.php?username=".$ae->username."&session=".$ae->session."&imagesetID=".$ae->imagesetID[0]);
      exit;
      }
   else
      {
      header("location: http://".$ae->server."/".$ae->path."admin/managerimage.php?username=".$ae->username."&session=".$ae->session);
      exit;
      }
   }
// Fileset: if Edit submit button is pressed, redirect to edit fileset screen
if ($ae->command==6 AND $ae->submit==$ae->textbasic[106])
   {
   if ($ae->filesetID[0])
      {
      header("location: http://".$ae->server."/".$ae->path."admin/managerfile.php?username=".$ae->username."&session=".$ae->session."&filesetID=".$ae->filesetID[0]);
      exit;
      }
   else
      {
      header("location: http://".$ae->server."/".$ae->path."admin/managerfile.php?username=".$ae->username."&session=".$ae->session);
      exit;
      }
   }
// User: if Edit submit button is pressed, redirect to edit user screen
if ($ae->command==50 AND $ae->submit==$ae->textbasic[106])
   {
   header("location: http://".$ae->server."/".$ae->path."admin/edituser.php?username=".$ae->username."&session=".$ae->session."&userID=".$ae->userID);
   exit;
   }

$ae->DateConversion($ae->adate);
if ($ae->text) $ae->text=$ae->WYSIWYGtoXHTML($ae->text);




/*---------------------------------------------------
- EDITOR-LEVEL COMMANDS - starting from 1           -
---------------------------------------------------*/
if ($ae->command==1) // deletes the article
   {
   if ($ae->cleanurls==2) $ae->DeleteRewriteRule($ae->articleID);
   $ae->DBQuery("DELETE FROM ".$ae->table[3]." WHERE ID='".$ae->articleID."'");
   $ae->DBQuery("DELETE FROM ".$ae->table[4]." WHERE articleID='".$ae->articleID."'"); // deletes stats for the article
   $ae->SetHook("delete_article-articleID");
   }
if ($ae->command==2) // adds new article
   {
   $ae->CheckFormErrors("title","sectionID");
   $ae->filename=$ae->CreateCleanURL($ae->title);
   $exist=$ae->LookUpCleanURL($ae->filename);
   if ($exist)
      {
      $ae->AddFormError($ae->textwarning[17]);
      $ae->CheckFormErrors();
      }
   $ae->DBQuery("INSERT INTO ".$ae->table[3]." VALUES (NULL,'".$ae->title."','".$ae->beginning."','".$ae->text."','".$ae->authorID."','".$ae->adate."','".$ae->atime."','".$ae->imagesetID."','".$ae->filesetID."','".$ae->priority."','".$ae->status."','".$ae->filename."')");
   $ae->articleID=$ae->insertID;
   if (is_array($ae->sectionID))
      {
      foreach ($ae->sectionID as $key=>$value)
              {
              $ae->DBQuery("INSERT INTO ".$ae->table[9]." VALUES ('".$ae->articleID."','".$value."')");
              }
      }
   if ($ae->cleanurls==2) $ae->AddRewriteRule($ae->articleID);
   $ae->DBQuery("INSERT INTO ".$ae->table[4]." VALUES ('".$ae->articleID."',0)"); // creates stats for the article
   $ae->SetHook("add_article-articleID");
   }
if ($ae->command==3) // updates the article
   {
   $ae->filename=$ae->CreateCleanURL($ae->title);
   $ae->DBQuery("SELECT filename FROM ".$ae->table[3]." WHERE ID='".$ae->articleID."'");
   $ae->DBGetRow();
   if ($ae->access["filename"]<>$ae->filename)
      {
      $exist=$ae->LookUpCleanURL($ae->filename);
      if ($exist)
         {
         $ae->AddFormError($ae->textwarning[17]);
         $ae->CheckFormErrors();
         }
      }
   if ($ae->cleanurls==2) $ae->DeleteRewriteRule($ae->articleID);
   $ae->DBQuery("UPDATE ".$ae->table[3]." SET title='".$ae->title."',beginning='".$ae->beginning."',text='".$ae->text."',authorID='".$ae->authorID."',adate='".$ae->adate."',atime='".$ae->atime."',imagesetID='".$ae->imagesetID."',filesetID='".$ae->filesetID."',priority='".$ae->priority."',status='".$ae->status."',filename='".$ae->filename."' WHERE ID='".$ae->articleID."'");
   $ae->DBQuery("DELETE FROM ".$ae->table[9]." WHERE articleID='".$ae->articleID."'");
   if (is_array($ae->sectionID))
      {
      foreach ($ae->sectionID as $key=>$value)
              {
              $ae->DBQuery("INSERT INTO ".$ae->table[9]." VALUES ('".$ae->articleID."','".$value."')");
              }
      }
   if ($ae->cleanurls==2) $ae->AddRewriteRule($ae->articleID);
   $ae->SetHook("update_article-articleID");
   }
if ($ae->command==4) // updates user's own profile
   {
   if (!$ae->password) $ae->DisplayError(5);
   if ($ae->password<>$ae->password2) $ae->DisplayError(6);
   $ae->password=md5($ae->password);
   $ae->DBQuery("UPDATE ".$ae->table[5]." SET password='".$ae->password."',fullname='".$ae->fullname."',email='".$ae->email."',language='".$ae->language."',otherinfo='".$ae->otherinfo."' WHERE ID='".$ae->userID."'");
   if ($ae->file["name"])
      {
      $ae->DBQuery("SELECT photo FROM ".$ae->table[5]." WHERE ID='".$ae->userID."'");
      $ae->DBGetRow();
      $delfile=$ae->access["photo"];
      if ($delfile) $ae->DeleteImage($delfile,$ae->pathimages);
      $photo=$ae->SubmitImage($ae->file["tmp_name"],$ae->file["type"],0);
      $ae->DBQuery("UPDATE ".$ae->table[5]." SET photo='".$photo."' WHERE ID='".$ae->userID."'");
      }
   if ($ae->delete)
      {
      $ae->DBQuery("SELECT photo FROM ".$ae->table[5]." WHERE ID='".$ae->userID."'");
      $ae->DBGetRow();
      $delfile=$ae->access["photo"];
      $ae->DeleteImage($delfile,$ae->pathimages);
      $ae->DBQuery("UPDATE ".$ae->table[5]." SET photo='' WHERE ID='".$ae->userID."'");
      }
   $ae->SetHook("update_user-userID");
   }

// command=5 NOT USED

if ($ae->command==6) // deletes the file set
   {
   if (is_array($ae->filesetID))
      {
      foreach ($ae->filesetID as $value)
          {
          $ae->DBQuery("SELECT * FROM ".$ae->table[2]." WHERE filesetID='".$value."'");
          while ($ae->DBGetRow())
                {
                $filename=$ae->access["filename"];
                if ($filename) $ae->DeleteFile($filename);
                }
          $ae->DBQuery("DELETE FROM ".$ae->table[12]." WHERE ID='".$value."'");
          }
      }
   $ae->SetHook("delete_fileset-filesetID");
   }
if ($ae->command==7) // submits the file set
   {
   $ae->filename=$ae->file["name"][0];
   $ae->CheckFormErrors("description","filename");
   if (!$ae->filesetID)
      {
      $ae->DBQuery("INSERT INTO ".$ae->table[12]." VALUES (NULL,'".$ae->description."','".$ae->currentuserID."')");
      $ae->filesetID=$ae->insertID;
      }
   for ($i=0;$i<$ae->uploadnumber;$i++)
       {
       if (!empty($ae->file["name"][$i]))
          {
          $filename[$i]=$ae->SubmitFile($ae->file["name"][$i],$ae->file["tmp_name"][$i],$ae->file["size"][$i]);
          $ae->DBQuery("INSERT INTO ".$ae->table[2]." VALUES (NULL,'".$ae->filesetID."','".$filename[$i]."')");
          }
       }
   $ae->SetHook("add_fileset-filesetID");
   }
if ($ae->command==10) // deletes the image set
   {
   if (is_array($ae->imagesetID))
      {
      foreach ($ae->imagesetID as $value)
          {
          $ae->DBQuery("SELECT * FROM ".$ae->table[1]." WHERE imagesetID='".$value."'");
          while ($ae->DBGetRow())
                {
                $filename=$ae->access["filename"];
                if ($filename) $ae->DeleteImage($filename,$ae->pathimages);
                }
          $ae->DBQuery("DELETE FROM ".$ae->table[13]." WHERE ID='".$value."'");
          }
      }
   $ae->SetHook("delete_imageset-imagesetID");
   }
if ($ae->command==11) // submits the image set
   {
   $ae->filename=$ae->file["name"][0];
   $ae->CheckFormErrors("description","filename");
   $ae->DBQuery("INSERT INTO ".$ae->table[13]." VALUES (NULL,'".$ae->description."','".$ae->currentuserID."')");
   $ae->imagesetID=$ae->insertID;
   for ($i=0;$i<$ae->uploadnumber;$i++)
       {
       if (!empty($ae->file["name"][$i]))
          {
          $filename[$i]=$ae->SubmitImage($ae->file["name"][$i],$ae->file["tmp_name"][$i],$ae->file["type"][$i],$ae->file["size"][$i]);
          $ae->DBQuery("INSERT INTO ".$ae->table[1]." VALUES (NULL,'".$ae->imagesetID."','".$filename[$i]."','".$ae->filedescription[$i]."')");
          }
       }
   $ae->SetHook("add_imageset-imagesetID");
   }
if ($ae->command==12) // edits the image set
   {
   $ae->CheckFormErrors("description");
   $filenumber=0;
   for ($i=0;$i<$ae->uploadnumber;$i++)
       {
       if (!empty($ae->filedescription[$i]))
          {
          $ae->DBQuery("SELECT ID FROM ".$ae->table[1]." WHERE imagesetID='".$ae->imagesetID."' ORDER BY filename LIMIT ".$i.",1");
          $ae->DBGetRow();
          $imageID=$ae->access["ID"];
          $ae->DBQuery("UPDATE ".$ae->table[1]." SET description='".$ae->filedescription[$i]."' WHERE ID='".$imageID."'");
          }
       if (!empty($ae->file["name"][$i]))
          {
          if ($i+1<=$filenumber)
             {
             $ae->DBQuery("SELECT ID,filename FROM ".$ae->table[1]." WHERE imagesetID='".$ae->imagesetID."' ORDER BY filename LIMIT ".$i.",1");
             $ae->DBGetRow();
             $delID=$ae->access["ID"];
             $delfile=$ae->access["filename"];
             if ($delfile)
                {
                $ae->DeleteImage($delfile,$ae->pathimages);
                }
             $filename[$i]=$ae->SubmitImage($ae->file["name"][$i],$ae->file["tmp_name"][$i],$ae->file["type"][$i],$ae->file["size"][$i]);
             $ae->DBQuery("UPDATE ".$ae->table[1]." SET filename='".$filename[$i]."',description='".$ae->filedescription[$i]."' WHERE ID='".$delID."'");
             }
          else
             {
             if ($delfile)
                {
                $ae->DeleteImage($delfile,$ae->pathimages);
                }
             $filename[$i]=$ae->SubmitImage($ae->file["name"][$i],$ae->file["tmp_name"][$i],$ae->file["type"][$i],$ae->file["size"][$i]);
             $ae->DBQuery("INSERT INTO ".$ae->table[1]." VALUES (NULL,'".$ae->imagesetID."','".$filename[$i]."','".$ae->filedescription[$i]."')");
             }
          }
       }
   for ($i=0;$i<$ae->uploadnumber;$i++)
       {
       if (empty($ae->file["name"][$i]) AND !empty($ae->delete[$i]))
              {
              $ae->DBQuery("SELECT filename FROM ".$ae->table[1]." WHERE ID='".$ae->delete[$i]."'");
              $ae->DBGetRow();
              $delfile=$ae->access["filename"];
              $ae->DeleteImage($delfile,$ae->pathimages);
              $ae->DBQuery("DELETE FROM ".$ae->table[1]." WHERE ID='".$ae->delete[$i]."'");
              $filenumber++;
              }
       }
   if ($ae->uploadnumber==$filenumber)
       {
       $ae->DBQuery("DELETE FROM ".$ae->table[13]." WHERE ID='".$ae->imagesetID."'");
       }
   $ae->SetHook("update_imageset-imagesetID");
   }
if ($ae->command==13) // edits the file set
   {
   $ae->CheckFormErrors("description");
   $filenumber=0;
   for ($i=0;$i<$ae->uploadnumber;$i++)
       {
       if (!empty($ae->file["name"][$i]))
          {
          if ($i+1<=$filenumber)
             {
             $ae->DBQuery("SELECT ID,filename FROM ".$ae->table[2]." WHERE filesetID='".$ae->filesetID."' ORDER BY filename LIMIT ".$i.",1");
             $ae->DBGetRow();
             $delID=$ae->access["ID"];
             $delfile=$ae->access["filename"];
             if ($delfile)
                {
                $ae->DeleteFile($delfile);
                $ae->DBQuery("DELETE FROM ".$ae->table[2]." WHERE filename='".$delfile."'");
                }
             $filename[$i]=$ae->SubmitFile($ae->file["name"][$i],$ae->file["tmp_name"][$i],$i);
             $ae->DBQuery("UPDATE ".$ae->table[2]." filename='".$filename[$i]."' WHERE ID='".$delID."'");
             }
          else
             {
             if ($delfile)
                {
                $ae->DeleteFile($delfile);
                }
             $filename[$i]=$ae->SubmitFile($ae->file["name"][$i],$ae->file["tmp_name"][$i],$i);
             $ae->DBQuery("INSERT INTO ".$ae->table[2]." VALUES (NULL,'".$ae->filesetID."','".$filename[$i]."')");
             }
          }
       }
   for ($i=0;$i<$ae->uploadnumber;$i++)
       {
       if (empty($ae->file["name"][$i]) AND !empty($ae->delete[$i]))
              {
              $ae->DBQuery("SELECT filename FROM ".$ae->table[2]." WHERE ID='".$ae->delete[$i]."'");
              $ae->DBGetRow();
              $delfile=$ae->access["filename"];
              $ae->DeleteFile($delfile);
              $ae->DBQuery("DELETE FROM ".$ae->table[2]." WHERE ID='".$ae->delete[$i]."'");
              $filenumber++;
              }
       }
   if ($ae->uploadnumber==$filenumber)
       {
       $ae->DBQuery("DELETE FROM ".$ae->table[12]." WHERE ID='".$ae->filesetID."'");
       }
   $ae->SetHook("update_fileset-filesetID");
   }
if ($ae->command==14) // deletes related articles
   {
   if (is_array($ae->relatedID))
      {
      foreach ($ae->relatedID as $value)
              {
              $ae->DBQuery("DELETE FROM ".$ae->table[7]." WHERE articleID='".$ae->articleID."' AND relatedID='".$value."'");
              }
      }
   $ae->SetHook("delete_relatedarticle-relatedID");
   }
if ($ae->command==15) // adds related articles
   {
   $ae->CheckFormErrors("articleID","relatedID");
   if (is_array($ae->relatedID))
      {
      foreach ($ae->relatedID as $value)
              {
              $ae->DBQuery("SELECT * FROM ".$ae->table[7]." WHERE articleID='".$ae->articleID."' AND relatedID='".$value."'");
              if (!$ae->rowsnumber AND $ae->articleID<>$value) $ae->DBQuery("INSERT INTO ".$ae->table[7]." VALUES ('".$ae->articleID."','".$value."')");
              }
      }
   $ae->SetHook("add_relatedarticle-articleID");
   }


/*---------------------------------------------------
- EDITOR-IN-CHIEF-LEVEL COMMANDS - starting from 30 -
---------------------------------------------------*/
if ($ae->command==30) // deletes the section
   {
   if ($ae->cleanurls==2) $ae->DeleteRewriteRule($ae->sectionID,$ae->table[0],"showsection.php?sectionID");
   $ae->DBQuery("DELETE FROM ".$ae->table[0]." WHERE ID='".$ae->sectionID."'");
   $ae->DBQuery("SELECT MIN(priority) FROM ".$ae->table[0]." WHERE parentsectionID='0'");
   $ae->DBGetRow();
   $priority=$ae->access["MIN(priority)"]-1;
   $ae->DBQuery("SELECT * FROM ".$ae->table[0]." WHERE parentsectionID='".$ae->sectionID."'");
   while ($ae->DBGetRow())
         {
         $temp=$ae->outcome;
         $sectionID=$ae->access["ID"];
         $ae->DBQuery("UPDATE ".$ae->table[0]." SET parentsectionID='0',priority='".$priority."' WHERE ID='".$sectionID."'");
         $priority--;
         $ae->outcome=$temp;
         }
   $ae->SetHook("delete_section-sectionID");
   }
if ($ae->command==31) // adds new section
   {
   $ae->filename=$ae->CreateCleanURL($ae->section);
   $exist=$ae->LookUpCleanURL($ae->filename);
   if ($exist)
      {
      $ae->AddFormError($ae->textwarning[17]);
      $ae->CheckFormErrors();
      }
   $ae->DBQuery("SELECT MIN(priority) FROM ".$ae->table[0]." WHERE parentsectionID='".$ae->parentsectionID."'");
   $ae->DBGetRow();
   $ae->priority=$ae->access["MIN(priority)"]-1;
   $ae->DBQuery("INSERT INTO ".$ae->table[0]." VALUES(NULL,'".$ae->section."','".$ae->parentsectionID."','".$ae->articleID."','".$ae->priority."','".$ae->filename."')");
   $sectionID=$ae->insertID;
   if ($ae->cleanurls==2) $ae->AddRewriteRule($sectionID,"showsection.php?sectionID");
   $ae->SetHook("add_section-sectionID");
   }
if ($ae->command==32) // changes position (priority) of section in a tree
   {
   $ae->DBQuery("SELECT * FROM ".$ae->table[0]." WHERE ID='".$ae->sectionID."'");
   $ae->DBGetRow();
   $parentsectionID=$ae->access["parentsectionID"];
   // up and down
   if ($ae->direction==1 OR $ae->direction==2)
      {
      $ae->DBQuery("SELECT * FROM ".$ae->table[0]." WHERE parentsectionID='".$parentsectionID."' ORDER BY priority DESC");
      while ($ae->DBGetRow())
            {
            $sectionID=$ae->access["ID"];
            $priority=$ae->access["priority"];
            if ($ae->direction==1 AND $sectionID==$ae->sectionID)
               {
               $ae->DBQuery("UPDATE ".$ae->table[0]." SET priority='".$previouspriority."' WHERE ID='".$ae->sectionID."'");
               $ae->DBQuery("UPDATE ".$ae->table[0]." SET priority='".$priority."' WHERE ID='".$previoussectionID."'");
               break;
               }
            if ($ae->direction==2 AND $previoussectionID==$ae->sectionID)
               {
               $ae->DBQuery("UPDATE ".$ae->table[0]." SET priority='".$priority."' WHERE ID='".$ae->sectionID."'");
               $ae->DBQuery("UPDATE ".$ae->table[0]." SET priority='".$previouspriority."' WHERE ID='".$sectionID."'");
               break;
               }
            $previouspriority=$priority;
            $previoussectionID=$sectionID;
            }
      }
   // top
   if ($ae->direction==3)
      {
      $ae->DBQuery("SELECT MAX(priority) FROM ".$ae->table[0]." WHERE parentsectionID='".$parentsectionID."'");
      $ae->DBGetRow();
      $maxpriority=$ae->access["MAX(priority)"];
      $ae->DBQuery("SELECT priority FROM ".$ae->table[0]." WHERE ID='".$ae->sectionID."'");
      $ae->DBGetRow();
      $priority=$ae->access["priority"];
      $ae->DBQuery("UPDATE ".$ae->table[0]." SET priority=priority-1 WHERE parentsectionID='".$parentsectionID."' AND priority>'".$priority."'");
      $ae->DBQuery("UPDATE ".$ae->table[0]." SET priority='".$maxpriority."' WHERE ID='".$ae->sectionID."'");
      }
   // bottom
   if ($ae->direction==4)
      {
      $ae->DBQuery("SELECT MIN(priority) FROM ".$ae->table[0]." WHERE parentsectionID='".$parentsectionID."'");
      $ae->DBGetRow();
      $minpriority=$ae->access["MIN(priority)"];
      $ae->DBQuery("SELECT priority FROM ".$ae->table[0]." WHERE ID='".$ae->sectionID."'");
      $ae->DBGetRow();
      $priority=$ae->access["priority"];
      $ae->DBQuery("UPDATE ".$ae->table[0]." SET priority=priority+1 WHERE parentsectionID='".$parentsectionID."' AND priority<'".$priority."'");
      $ae->DBQuery("UPDATE ".$ae->table[0]." SET priority='".$minpriority."' WHERE ID='".$ae->sectionID."'");
      }
   $ae->SetHook("update_section-sectionID");
   }
if ($ae->command==33) // modifies section
   {
   if ($ae->parentsectionID==$ae->sectionID) $ae->AddFormError($ae->textwarning[16]);
   $ae->filename=$ae->CreateCleanURL($ae->title);
   $ae->DBQuery("SELECT filename FROM ".$ae->table[0]." WHERE ID='".$ae->sectionID."'");
   $ae->DBGetRow();
   if ($ae->access["filename"]<>$ae->filename)
      {
      $exist=$ae->LookUpCleanURL($ae->filename);
      if ($exist)
         {
         $ae->AddFormError($ae->textwarning[17]);
         }
      }
   $ae->CheckFormErrors();
   if ($ae->cleanurls==2) $ae->DeleteRewriteRule($ae->sectionID,$ae->table[0],"showsection.php?sectionID");
   $ae->DBQuery("SELECT ID FROM ".$ae->table[0]." WHERE ID='".$ae->sectionID."' AND parentsectionID='".$ae->parentsectionID."'");
   if (!$ae->rowsnumber)
      {
      $ae->DBQuery("SELECT MIN(priority) FROM ".$ae->table[0]." WHERE parentsectionID='".$ae->parentsectionID."'");
      $ae->DBGetRow();
      $ae->priority=$ae->access["MIN(priority)"]-1;
      $ae->DBQuery("UPDATE ".$ae->table[0]." SET section='".$ae->section."',parentsectionID='".$ae->parentsectionID."',articleID='".$ae->articleID."',filename='".$ae->filename."',priority='".$ae->priority."' WHERE ID='".$ae->sectionID."'");
      }
   else
      {
      $ae->DBQuery("UPDATE ".$ae->table[0]." SET section='".$ae->section."',parentsectionID='".$ae->parentsectionID."',articleID='".$ae->articleID."',filename='".$ae->filename."' WHERE ID='".$ae->sectionID."'");
      }
   $result=$ae->AddRewriteRule($ae->sectionID,"showsection.php?sectionID");
   $ae->SetHook("update_section-sectionID");
   }
if ($ae->command==35) // prioritize article
   {
   $ae->UserVerifyLevel(2);
   $ae->DBQuery("UPDATE ".$ae->table[3]." SET priority=1 WHERE ID='".$ae->articleID."'");
   }
if ($ae->command==36) // deprioritize article
   {
   $ae->UserVerifyLevel(2);
   $ae->DBQuery("UPDATE ".$ae->table[3]." SET priority=0 WHERE ID='".$ae->articleID."'");
   }
if ($ae->command==37) // publish article
   {
   $ae->UserVerifyLevel(2);
   $ae->DBQuery("UPDATE ".$ae->table[3]." SET status=1 WHERE ID='".$ae->articleID."'");
   $ae->SetHook("publish_article-articleID");
   }
if ($ae->command==38) // put article on hold
   {
   $ae->UserVerifyLevel(2);
   $ae->DBQuery("UPDATE ".$ae->table[3]." SET status=0 WHERE ID='".$ae->articleID."'");
   $ae->SetHook("unpublish_article-articleID");
   }

/*---------------------------------------------------
- ADMIN-LEVEL COMMANDS - starting from 50           -
---------------------------------------------------*/
if ($ae->command==50) // deletes a user
   {
   $ae->UserVerifyLevel();
   if ($ae->userID<>1)  // security feature - user admin cannot be deleted
      {
      $ae->DBQuery("SELECT photo FROM ".$ae->table[5]." WHERE ID='".$ae->userID."'");
      $ae->DBGetRow();
      $delfile=$ae->access["photo"];
      if ($delfile) $ae->DeleteImage($delfile,$ae->pathimages);
      $ae->DBQuery("DELETE FROM ".$ae->table[5]." WHERE ID='".$ae->userID."'");
      }
   $ae->SetHook("delete_user-userID");
   }
if ($ae->command==51) // adds a new user
   {
   $ae->UserVerifyLevel();
   $ae->CheckFormErrors("user","password","password2");
   $ae->DBQuery("SELECT user FROM ".$ae->table[5]." WHERE user='".$ae->user."'");
   if ($ae->rowsnumber) $ae->AddFormError($ae->textwarning[4]);
   if ($ae->password<>$ae->password2) $ae->AddFormError($ae->textwarning[6]);
   $ae->CheckFormErrors();
   $ae->password=md5($ae->password);
   $ae->DBQuery("INSERT INTO ".$ae->table[5]." VALUES (NULL,'".$ae->user."','".$ae->password."','".$ae->fullname."','".$ae->position."','".$ae->email."','".$ae->language."','','".$ae->otherinfo."')");
   if ($ae->file["name"])
      {
      $photo=$ae->SubmitImage($ae->file["name"],$ae->file["tmp_name"],$ae->file["type"],$ae->file["size"]);
      $ae->DBQuery("UPDATE ".$ae->table[5]." SET photo='".$photo."' WHERE ID='".$ae->insertID."'");
      }
   $ae->SetHook("add_user-userID");
   }
if ($ae->command==52) // updates user's profile including a position
   {
   $ae->UserVerifyLevel();
   if (!$ae->password AND !$ae->password2) // leaves password unchanged
      {
      $ae->DBQuery("UPDATE ".$ae->table[5]." SET fullname='".$ae->fullname."',position='".$ae->position."',email='".$ae->email."',language='".$ae->language."',otherinfo='".$ae->otherinfo."' WHERE ID='".$ae->userID."'");
      }
   else // changes everything including password
      {
      if (!$ae->password) $ae->DisplayError(5);
      if ($ae->password<>$ae->password2) $ae->DisplayError(6);
      $ae->password=md5($ae->password);
      $ae->DBQuery("UPDATE ".$ae->table[5]." SET password='".$ae->password."',fullname='".$ae->fullname."',position='".$ae->position."',email='".$ae->email."',language='".$ae->language."',otherinfo='".$ae->otherinfo."' WHERE ID='".$ae->userID."'");
      }
   if ($ae->file["name"])
      {
      $ae->DBQuery("SELECT photo FROM ".$ae->table[5]." WHERE ID='".$ae->userID."'");
      $ae->DBGetRow();
      $delfile=$ae->access["photo"];
      if ($delfile) $ae->DeleteImage($delfile,$ae->pathimages);
      $photo=$ae->SubmitImage($ae->file["name"],$ae->file["tmp_name"],$ae->file["type"],$ae->file["size"]);
      $ae->DBQuery("UPDATE ".$ae->table[5]." SET photo='".$photo."' WHERE ID='".$ae->userID."'");
      }
   if ($ae->delete)
      {
      $ae->DBQuery("SELECT photo FROM ".$ae->table[5]." WHERE ID='".$ae->userID."'");
      $ae->DBGetRow();
      $delfile=$ae->access["photo"];
      $ae->DeleteImage($delfile,$ae->pathimages);
      $ae->DBQuery("UPDATE ".$ae->table[5]." SET photo='' WHERE ID='".$ae->userID."'");
      }
   $ae->SetHook("update_user-userID");
   }
if ($ae->command==53) // uninstalls module
   {
   $ae->UserVerifyLevel();
   $modules=$ae->RetrieveModules($ae->modules);
   if (is_array($modules))
      {
      foreach ($modules as $value)
           {
           if (!$ae->leavedb) $ae->UninstallSQL($value["moduledir"]);
           $ae->UninstallHooks($value["moduledir"]);
           $ae->DBQuery("DELETE FROM ".$ae->table[8]." WHERE directory='".$value["moduledir"]."'");
           }
      }
   $ae->SetHook("delete_module-moduleID");
   }
if ($ae->command==54) // installs module
   {
   $ae->UserVerifyLevel();
   $modules=$ae->RetrieveModules($ae->modules);
   if (is_array($modules))
      {
      foreach ($modules as $value)
              {
              if (!$ae->leavedb) $ae->InstallSQL($value["moduledir"]);
              $ae->InstallHooks($value["moduledir"]);
              $ae->DBQuery("DELETE FROM ".$ae->table[8]." WHERE directory='".$value["moduledir"]."'");
              $ae->DBQuery("INSERT INTO ".$ae->table[8]." VALUES (NULL,'".$value["name"]."','".$value["minversion"]."','".$value["author"]."','".$value["website"]."','".$value["description"]."','".$value["moduledir"]."','".$value["menu1"]."','".$value["menu2"]."','".$value["menu3"]."','".$value["menu4"]."','".$value["menu5"]."','".$value["guestmodify"]."')");
              }
      }
   $ae->SetHook("add_module-moduleID");
   }

/*---------------------------------------------------
- REDIRECTION PART                                  -
---------------------------------------------------*/
$ae->ExecuteHook();
header("location: http://".$ae->server."/".$ae->path."admin/admin.php?username=".$ae->username."&session=".$ae->session);
if (($ae->command==2 OR $ae->command==3) AND $ae->action==2) header("location: http://".$ae->server."/".$ae->path."admin/editarticle.php?username=".$ae->username."&session=".$ae->session."&articleID=".$ae->articleID."&action=preview");
if ($ae->command==6 OR $ae->command==7 OR $ae->command==13) header("location: http://".$ae->server."/".$ae->path."admin/managerfile.php?username=".$ae->username."&session=".$ae->session);
if ($ae->command==30 OR $ae->command==31 OR $ae->command==32 OR $ae->command==33) header("location: http://".$ae->server."/".$ae->path."admin/managersection.php?username=".$ae->username."&session=".$ae->session);
if ($ae->command>=10 AND $ae->command<=12) header("location: http://".$ae->server."/".$ae->path."admin/managerimage.php?username=".$ae->username."&session=".$ae->session);
if ($ae->command==14 OR $ae->command==15) header("location: http://".$ae->server."/".$ae->path."admin/managerrelated.php?username=".$ae->username."&session=".$ae->session."&articleID=".$ae->articleID);
if ($ae->command==53 OR $ae->command==54) header("location: http://".$ae->server."/".$ae->path."admin/managermodule.php?username=".$ae->username."&session=".$ae->session);
?>