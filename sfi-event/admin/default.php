<?php
include_once ("check.php");
include_once (PAGES . "back_top.php");

$loginAccess = explode(",", $_COOKIE['loginAccess']);
?>

<body topmargin="0" leftmargin="0">

<div align="center"><center>
	<?php echo $UI->StatusBar(array('系統首頁', '', '系統歡迎頁面', 'default.php'))?>
	<br>
	<?php echo $UI->Win("系統首頁")?>
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr><td height="5"></td></tr>
			<tr height="40">
				<td width="10"></td>
				<td>
					<table width="100%">
						<tr>
							<td align="center">
								「<?php echo SYSTITLE?>」系統登入成功！
							</td>
						</tr>
					</table>
				</td>
				<td width="10"></td>
			</tr>
			<tr><td width="100%" height="5" colspan="3"></td></tr>
			<tr><td width="100%" height="1" colspan="3" bgcolor="#AAAAAA"></td></tr>
			<tr><td width="100%" height="1" colspan="3" bgcolor="#FFFFFF"></td></tr>
			<tr><td width="100%" height="5" colspan="3"></td></tr>
			<tr>
				<td width="10"></td>
				<td>
					<table width="100%">
						<tr><td height="10"></td></tr>
						<tr><td>您的登入 ID 為：「<?php echo $_COOKIE['loginID']?>」您目前可使用的權限如下：</td></tr>
						<tr><td height="10"></td></tr>
						<tr>
							<td>
								<table width="80%" cellspacing="1" bgcolor="#6A6A6A">
									<?php
									//$DB->Connect();
									$DB->Select(DATABASE);

									$pages = $DB->Query("SELECT ".TABLE_PAGE."No, ".TABLE_PAGE."Name, ".TABLE_PAGE."Intro FROM ". TABLE_PAGE ." WHERE ".TABLE_PAGE."Index = '0' ORDER BY ".TABLE_PAGE."Sort");
									$num = 1;
									while ($page = $DB->Body($pages)) {
										list ($pageNo,$pageName,$pageIntro) = $page;
										if (checkID( $_COOKIE['loginID'],  $_COOKIE['loginPW']) || (in_Array($pageNo, $loginAccess))) {
									?>
									<tr height="23">
										<td width="30%" bgcolor="#CCCCCC">
											&nbsp;<?php echo $num?>. <?php echo $pageName?>
										</td>
										<td width="70%" bgcolor="#FFFFFF">
											&nbsp;<?php echo $pageIntro?>
										</td>
									</tr>
									<?php
											$num++;
										}
									}

									//$DB->Close();
									?>
								</table>
							</td>
						</tr>
						<tr><td height="10"></td></tr>
					</table>
				</td>
				<td width="10"></td>
			</tr>
			<?php if (checkID( $_COOKIE['loginID'],  $_COOKIE['loginPW'])) {?>
			<tr><td width="100%" height="5" colspan="3"></td></tr>
			<tr><td width="100%" height="1" colspan="3" bgcolor="#AAAAAA"></td></tr>
			<tr><td width="100%" height="1" colspan="3" bgcolor="#FFFFFF"></td></tr>
			<tr><td width="100%" height="5" colspan="3"></td></tr>
			<tr>
				<td width="10"></td>
				<td align="center">
					System Infromation:
					<?php echo SYSNAME?>
					<?php echo VERSION?>
					<?php echo BUILD?>
					&nbsp;&nbsp;
					Update History
				</td>
				<td width="10"></td>
			</tr>
			<tr height="40">
				<td width="10"></td>
				<td align="center">
					<!--如在使用本系統時，發現問題及系統錯誤、程式Bug等，請與 <a href="mailto: allan@allan.tw">allan@allan.tw</a> 聯絡-->
				</td>
				<td width="10"></td>
			</tr>
			<?php } ?>
			<tr><td height="5"></td></tr>
		</table>
	<?php echo $UI->Dow()?>
</center></div>

</body>
</html>