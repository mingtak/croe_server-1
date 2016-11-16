<?php
include('__include.php');
									/******************************************************************/
									// Paging unit
									/******************************************************************/
									$_dataPerPage = 20;
									$_pageNo = (empty($_GET['page'])) ? 1 : $_GET['page'];
									$_queryCount = $DB->Num($DB->Query("SELECT * FROM hn_fundBenefit order by hn_fundBenefit_FundID"));
                  $dbQuery = $DB->Query("SELECT * FROM hn_fundBenefit order by hn_fundBenefit_FundID");
                   $rows = array();
									while ($dbArray = $DB->Arrays($dbQuery))
									{
										$rows[]=array(
											'fundID'=>$dbArray['hn_fundBenefit_fundID'],
											'fundType'=>$dbArray['hn_fundBenefit_fundType'],
											'fundName'=>$dbArray['hn_fundBenefit_fundName'].$dbArray['hn_fundBenefit_fundWarn'] ,
											'fundRisk'=>$dbArray['hn_fundBenefit_fundRisk'],
											'fundHnID'=>$dbArray['hn_fundBenefit_fundHnID'],
											'fundIntr'=>$dbArray['hn_fundBenefit_fundIntr'],
											'fundCurrency'=>$dbArray['hn_fundBenefit_fundCurrency'],
											'fundLink'=>$dbArray['hn_fundBenefit_fundLink']
										) ;
										//echo <br>.   $dbArray['fundName'];
									}
									echo json_encode($rows);
									$DB->Close();
									
?>                                    
