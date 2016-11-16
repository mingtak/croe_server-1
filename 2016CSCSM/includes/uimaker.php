<?php
class UIMaker
{

	function Win($title) {
		echo "	<table width=\"99%\" cellspacing=\"1\" bgcolor=\"#AAAAAA\">\n";
		echo "		<tr width=\"100%\" height=\"22\" bgcolor=\"#000099\">\n";
		echo "			<td align=\"left\">\n";
		echo "				<table width=\"100%\" cellspacing=\"1\">\n";
		echo "					<tr>\n";
		echo "						<td width=\"16\">\n";
		echo "							<img src=\"" . IMAGES . "interface/tool1.gif\">\n";
		echo "						</td>\n";
		echo "						<td width=\"2\"></td>\n";
		echo "						<td align=\"left\" valign=\"bottom\">\n";
		echo "							<font color=\"#FFFFFF\">\n";
		echo "								".$title."\n";
		echo "							</font>\n";
		echo "						</td>\n";
		echo "					</tr>\n";
		echo "				</table>\n";
		echo "			</td>\n";
		echo "		</tr>\n";
		echo "		<tr bgcolor=\"#EEEEEE\">\n";
		echo "			<td valign=\"top\">\n";
	}

	function Dow() {
		echo "			</td>\n";
		echo "		</tr>\n";
		echo "	</table>\n";
	}

	function StatusBar($parameter) {
		$sizeof = count($parameter);
		echo "	<table width=\"100%\" bgcolor=\"#EEEEEE\">\n";
		echo "		<tr height=\"22\">\n";
		echo "			<td>\n";
		echo "				<table cellspacing=\"0\" cellpadding=\"0\">\n";
		echo "					<tr height=\"22\">\n";

		// Retrun Loop to Last2
		for ($i = 0; $i < ($sizeof-2); $i += 2) {
			echo "					<td><img src=\"".IMAGES."interface/folder1.gif\"></td><td width=\"5\"></td>";
			if ($parameter[$i+1]) {
				echo "					<td valign=\"bottom\" style=\"cursor: hand\" onClick=\"parent.main.location.href='". $parameter[$i+1] ."'\">". $parameter[$i] ."</td>";
			}
			else {
				echo "					<td valign=\"bottom\">". $parameter[$i] ."</td>";
			}
			echo "					<td width=\"20\" align=\"center\">&gt;</td>\n";
		}

		// Output Last2
		echo "				<td><img src=\"".IMAGES."interface/iepage.gif\"></td><td width=\"2\">";
		if ($parameter[$sizeof-1]) {
			echo "					<td valign=\"bottom\" style=\"cursor: hand\" onClick=\"parent.main.location.href='". $parameter[$sizeof-1] ."';\">". $parameter[$sizeof-2] ."</td>\n";
		}
		else {
			echo "					<td valign=\"bottom\">". $parameter[$sizeof-2] ."</td>\n";
		}

		echo "					</tr>\n";
		echo "				</table>\n";
		echo "			</td>\n";
		echo "			<td width=\"150\">\n";
		echo "				<table width=\"100%\" cellspacing=\"1\" bgcolor=\"#888888\">\n";
		echo "					<tr>\n";
		echo "						<td bgcolor=\"#FFFFFF\"";
		if ($_COOKIE['loginID'] == SYSOP && md5($_COOKIE['loginPW']) == SYSOPLOGIN)
		{
			echo " onClick=\"parent.main.location.href='". ADMINURL ."/revision.php';\" style=\"cursor: pointer\" onMouseOver=\"TdColor(this, '#C5F0FE')\" onMouseOut=\"TdColor(this, '#FFFFFF')\"";
		}
		echo ">\n";
		echo "							&nbsp;登入 ID：". $_COOKIE['loginID'] ."\n";
		echo "						</td>\n";
		echo "					</tr>\n";
		echo "				</table>\n";
		echo "			</td>\n";
		echo "		</tr>\n";
		echo "	</table>\n";
	}

	function page_bar($linkPath) {
		global $_queryCount, $_pageNo, $_pageFirst, $_pageLast, $_pageTotal;
?>
			<table>
				<tr>
					<td width="100%" align="center">				　
						<font color="#7E7E7E">
							目前共有 <font color="red"><?php echo number_format($_queryCount)?></font> 筆資料 │ 
							共有 <font color="red"><?php echo $_pageTotal?></font> 頁 │ 
							目前在第 <font color="red"><?php echo $_pageNo?></font> 頁 │ 
							<br>
					<?php
					if ($_pageNo != 1) {
						echo "<a href=\"".getenv('PHP_SELF')."?page=1" . $linkPath . "\">↑第一頁</a>│";
					}
					else {
						echo "<font color=\"#BBBBBB\">↑第一頁</font>│\n";
					}

					if ($_pageNo != 1) {
						echo "<a href=\"".getenv('PHP_SELF')."?page=" . ($_pageNo-1) . $linkPath . "\">&lt;&lt; 上一頁</a>\n";
					}
					else {
						echo "<font color=\"#BBBBBB\">&lt;&lt; 上一頁</font>\n";
					}

					echo "&nbsp;&nbsp;\n";

					if ($_pageFirst > 1) {
						$prepage = $_pageFirst - 1;
						$pi = $prepage - 9;
						echo "<a href=\"".getenv('PHP_SELF')."?page=".$prepage . $linkPath . "\">". $pi . "-" . $prepage ."</a>&nbsp;|&nbsp;";
					}
					
					for($ibar = $_pageFirst; $ibar <= $_pageLast; $ibar++) {
						if ($ibar != $_pageNo) {
							echo "<a href=\"".getenv('PHP_SELF')."?page=".$ibar . $linkPath . "\">". $ibar ."</a>";
						}
						else {
							echo " ". $ibar ." ";
						}
						if ($ibar < $_pageLast) {
							echo " &nbsp;|&nbsp; ";
						}
					}

					if ($_pageLast < $_pageTotal) {
						$nextpage = $_pageLast + 1;
						$pi = $nextpage + 9;
						echo " &nbsp;|&nbsp;<a href=\"".getenv('PHP_SELF')."?page=".$nextpage . $linkPath . "\">". $nextpage . "-" . $pi ."</a>";
					}

					echo "&nbsp;&nbsp;\n";

					if ($_pageNo != $_pageTotal) {
						echo "<a href=\"".getenv('PHP_SELF')."?page=" . ($_pageNo+1) . $linkPath . "\">下一頁 &gt;&gt;</a>\n";
					}
					else {
						echo "<font color=\"#BBBBBB\">下一頁 &gt;&gt;</font>\n";
					}

					if ($_pageNo != $_pageTotal) {
						echo "│<a href=\"".getenv('PHP_SELF')."?page=" . $_pageTotal . $linkPath . "\">最末頁↓</a>";
					}
					else {
						echo "│<font color=\"#BBBBBB\">最末頁↓</font>\n";
					}
					?>
						</font>
					</td>
				</tr>
			</table>
<?php
	}

	function fieldTitle($fieldTitle)
	{
		$returnValue = true;
		global $_sortArray, $_sortBy, $_orderBy, $_fieldData, $_pageNo, $_srchBar;

		if (in_array($fieldTitle, $_sortArray))
		{
			if ($_orderBy == 'ASC')
			{
				$returnValue = '<span style="cursor: pointer" onClick="location.href=\'?page='. $_pageNo .'&sort='. $fieldTitle .'&order=DESC'. $_srchBar .'\';">';
				$returnValue .= $_fieldData[$fieldTitle];
				if ($_sortBy == $fieldTitle)
				{
					$returnValue .= ' <img src="'. IMAGES . 'interface/sortup.gif">';
				}
				$returnValue .= '</span>';
			}
			else
			{
				$returnValue = '<span style="cursor: pointer" onClick="location.href=\'?page='. $_pageNo .'&sort='. $fieldTitle .'&order=ASC'. $_srchBar .'\';">';
				$returnValue .= $_fieldData[$fieldTitle];
				if ($_sortBy == $fieldTitle)
				{
					$returnValue .= ' <img src="'. IMAGES . 'interface/sortdown.gif">';
				}
				$returnValue .= '</span>';
			}
		}
		else
		{
			$returnValue =  $_fieldData[$fieldTitle];
		}

		return $returnValue;
	}

}

$UI = new UIMaker;
?>