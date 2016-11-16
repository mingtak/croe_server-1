<?php
define('TEMPDIR','./admin/');
require(TEMPDIR."endechn.php");
require(TEMPDIR."coreclass.php");

$url='http://wonder.ielife.net/r_prize.asp?par=';
$data = $_GET['par'] ;
if ($data=='') 
	$data = $_POST['par'] ;
//76C7kejCkGpgv619m0x55fqVdIk0iR2azjvPoNll4mzEoExRk4f70n7Mx3qooWrvy4nOv1mUkvovsGgm9zxjmgrjq5l3rd5mxuqrfNte
//echo ' Data=>'. $data . '<=' . strlen($data) . '<br>';
//$dataenc=trans_encrypt($data);
//echo 'Encode Data =>' . $dataenc . '<=' . strlen($dataenc) . '<br>';
//echo 'par=' . $data. '<br>';
//echo 'Decode Data =>' . trans_decrypt($data) . '<=' . strlen(trans_decrypt($data)) . '<br>';
//session_start();
	
	$aepublic=new CEngine();
	$aepublic->PublicInitialize();
	$aepublic->RequestVariables();
	$prizeList="ABCZ";
	$errorMsg = "";
	
	if (  isset($aepublic->par) && $aepublic->par != "") {  
  
		$data=trans_decrypt($data);
	//	echo $data;
		$recno=floor(strlen($data)/10);
		$usedrec="";
		$freerec="" ;   
		
		for ($i=0;$i<$recno;$i++){
				$SeqID=substr($data,$i*10,10);
				//echo 'SeqID=' .$SeqID.'<br>';
				$sql="SELECT * FROM HNCr_SeqDB WHERE HNCr_SeqDB_SeqID='" . $SeqID .  "'";
				//echo 'sql=' .$sql.'<br>';
				$aepublic->DBQuery($sql);
				if ($aepublic->DBGetRow()) {
					$Date=$aepublic->access["HNCr_SeqDB_Date"];
					$Date = date('Ymd',strtotime($Date));
					$Prize=$aepublic->access["HNCr_SeqDB_Prize"];
					$PrizeSeqId=$aepublic->access["HNCr_SeqDB_PrizeSeqID"];
					if ($Prize=="" ||$Prize==" ")
					{
		//				$freerec=$freerec.$SeqID;	
						$Prize="Y";
					}
					if ($Prize!="A" )
					{
		//				$freerec=$freerec.$SeqID;	
						$PrizeSeqId="0000000000";
					}
					$usedrec=$usedrec . $SeqID . $Date . $Prize . $PrizeSeqId;
				//echo $url. trans_encrypt($usedrec);	
					//if( httpGet($url . trans_encrypt($usedrec) )=="0000")
					//		$usedrec=$usedrec.$SeqID;	
					//	else
					//		httpGet($url . trans_encrypt($usedrec) );
				
				}else{
					echo '-1';
					exit;
				}
		
			//search rec in data base  if this record used return the status by call ret.asp else 
		}
		echo trans_encrypt($usedrec);	
		exit ;
		//echo '0000';
	}


?>