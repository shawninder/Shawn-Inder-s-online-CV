<?php
	include("DB.php");
	$jsonStr = "[";
	$sql_getLinkInfo = "SELECT
												skill,
												experience,
												description
											FROM
												experience_skill_matrix
											ORDER BY
												skill,
												experience";
	$results = mysql_query($sql_getLinkInfo);
	while($result = mysql_fetch_array($results))
	{
		$jsonStr .= ("{
										\"skill\":\"" . $result['skill'] . "\",
										\"experience\":\"" . $result['experience'] . "\",
										\"description\":\"" . $result['description'] . "\"
									}, ");
	}
	$jsonStr = substr($jsonStr, 0, -2) . "]";
	echo $jsonStr;
?>
