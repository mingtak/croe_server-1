<?php
include('__include.php');
									/******************************************************************/
									// Paging unit
									/******************************************************************/
									$_dataPerPage = 20;
									$_pageNo = (empty($_GET['page'])) ? 1 : $_GET['page'];
									$_queryCount = $DB->Num($DB->Query("SELECT * FROM hn_fundMonth order by FundID"));
                  $dbQuery = $DB->Query("SELECT * FROM hn_fundMonth order by FundID");
                   $rows = array();
									while ($dbArray = $DB->Arrays($dbQuery))
									{
									    $rows[] = $dbArray;
//										echo '<br>'.   $dbArray['fundName'];
									}
									echo json_encode($rows);
									$DB->Close();
									
?>                                    