<?php
	include("DB.php");
	$jsonStr = "[";
	$sql_getLinkInfo = "SELECT
												language,
												experience,
												description
											FROM
												language_experience_matrix
											ORDER BY
												language,
												experience";
	$results = mysql_query($sql_getLinkInfo);
	while($result = mysql_fetch_array($results))
	{
		$jsonStr .= ("{
										\"language\":\"" . $result['language'] . "\",
										\"experience\":\"" . $result['experience'] . "\",
										\"description\":\"" . $result['description'] . "\"
									}, ");
	}
	$jsonStr = substr($jsonStr, 0, -2) . "]";
	echo $jsonStr;
?>
