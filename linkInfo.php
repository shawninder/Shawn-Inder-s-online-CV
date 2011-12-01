<?php
	include("DB.php");
	$jsonStr = "[";
	$sql_getLinkInfo = "SELECT
												skill,
												job,
												description
											FROM
												job_skill_matrix
											ORDER BY
												skill,
												job";
	$results = mysql_query($sql_getLinkInfo);
	while($result = mysql_fetch_array($results))
	{
		$jsonStr .= ("{
										\"skill\":\"" . $result['skill'] . "\",
										\"job\":\"" . $result['job'] . "\",
										\"description\":\"" . $result['description'] . "\"
									}, ");
	}
	$jsonStr = substr($jsonStr, 0, -2) . "]";
	echo $jsonStr;
?>
