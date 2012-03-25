<?php

require_once('fpdf17/fpdf.php');

include("setLang.php");	// After this, $_SESSION['lang'] should be set to 'en' or 'fr'
include($_SESSION['lang'] . ".php");
require_once('DB.php');

class CV extends FPDF
{
	function setTitleStyles()
	{
		$this->SetTextColor(0, 0, 0);
		$this->SetFont('Courier', 'B', 18);
	}
	
	function setLinkStyles()
	{
		$this->SetTextColor(0, 0, 255);
		$this->SetFont('', 'U');
	}
	
	function setHeaderStyles()
	{
		$this->SetTextColor(0, 0, 0);
		$this->SetFont('Helvetica', 'BU', 12);
	}
	
	function setNameStyles()
	{
		$this->SetTextColor(0, 0, 0);
		$this->SetFont('Helvetica', 'B', 12);
	}
	
	function setDefaultStyles()
	{
		$this->SetTextColor(0, 0, 0);
		$this->SetFont('Times', '', 12);
	}
	
	function setNoteStyles()
	{
		$this->SetTextColor(0, 0, 0);
		$this->SetFont('Times', '', 10);
	}
	
	function setQuoteStyles()
	{
		$this->SetTextColor(0, 0, 0);
		$this->SetFont('Times', 'I', 10);
	}
	
	function writeLanguage($name)
	{
		$this->setDefaultStyles();
		$this->Cell(10);
		$this->Write($this->nLh, iconv('UTF-8', 'windows-1252', $name));
		$this->Ln();
	}
	
	function writeExperience(
		$title,
		$dateStr,
		$description,
		$organization,
		$organizationUrl,
		$organizationLocation,
		$imageSrc,
		$excerpt,
		$author,
		$authorMail)
	{
		$this->setNameStyles();
		$this->Write($this->hLh, iconv('UTF-8', 'windows-1252', $title) . "    " . $dateStr);
		$this->Ln();
		$this->setDefaultStyles();
		$this->Write($this->nLh, iconv('UTF-8', 'windows-1252', $description));
		$this->Ln();
		$this->setLinkStyles();
		$this->Write($this->nLh, iconv('UTF-8', 'windows-1252', $organization), $organizationUrl);
		$this->setDefaultStyles();
		$this->Write($this->nLh, ", " . iconv('UTF-8', 'windows-1252', $organizationLocation));
		$this->Ln();
	}
	
	function writeSkill($name, $history)
	{
		$this->setNameStyles();
		$this->Write($this->nLh, iconv('UTF-8', 'windows-1252', $name));
		$this->setDefaultStyles();
		$this->Write($this->nLh, " : " . iconv('UTF-8', 'windows-1252', $history));
		$this->Ln(10);
	}
	
	function writeFeedback($name, $quote)
	{
		$this->setNameStyles();
		$this->Write($this->nLh, iconv('UTF-8', 'windows-1252', $name));
		$this->setQuoteStyles();
		$this->Write($this->nLh, " : " . iconv('UTF-8', 'windows-1252', $quote));
		$this->Ln(10);
	}
	
	public $hLh = 12;
	public $nLh = 5;
}

$cv = new CV();
$cv->AddPage();
$cv->setTitleStyles();
$cv->Write($cv->hLh, 'CV: ');
$cv->setLinkStyles();
$cv->Write($cv->hLh, 'Shawn Inder');
$cv->Ln();

$cv->setNoteStyles();
$cv->Cell(15);
$cv->Write($cv->nLh, '#: 514-903-9082'); 
$cv->Ln();
$cv->setLinkStyles();
$cv->Cell(15);
$cv->Write($cv->nLh, 'shawninder@gmail.com', 'mailto:shawninder@gmail.com');
$cv->Ln();
$cv->Cell(15);
$cv->Write($cv->nLh, 'http://shawninder.99k.org', 'http://shawninder.99k.org?lang=' . $_SESSION['lang']);
$cv->Ln(10);

$cv->setHeaderStyles();
$cv->Write($cv->hLh, $ls_spokenLanguages);
$cv->Ln();

// Languages
$sql_getLanguages = "
	SELECT
		name
	FROM
		Languages;";
$languages = mysql_query($sql_getLanguages);
while($language = mysql_fetch_array($languages))
{
	$cv->writeLanguage($language['name']);
}

$cv->setHeaderStyles();
$cv->Write($cv->hLh, $ls_experiences);
$cv->Ln();

$nbExperiences = ($_SESSION['lang'] == 'en')?6:5;

// Experiences
$sql_getExperiences = "
	SELECT
		E.id AS eID,
		E.title AS eTitle,
		E.startDate AS eStartDate,
		E.endDate AS eEndDate,
		O.name AS oName,
		O.location AS oLocation,
		O.url AS oUrl,
		E.Description AS eDescription
	FROM
		Experiences AS E
		INNER JOIN Organizations AS O
			ON O.id = E.organization
	ORDER BY
		eStartDate DESC
	LIMIT " . $nbExperiences . ";";
$experiences = mysql_query($sql_getExperiences);
while($experience = mysql_fetch_array($experiences))
{
	// Date
	$startDate = substr($experience['eStartDate'], 0, strpos($experience['eStartDate'], "-"));
	$endDate = ($experience['eEndDate'] && $experience['eEndDate'] != "0000-00-00")?substr($experience['eEndDate'], 0, strpos($experience['eEndDate'], "-")):$ls_now;
	$dateStr = ($startDate == $endDate)?"(" . $startDate . ")":"(" . $startDate . iconv('UTF-8', 'windows-1252', " » ") . $endDate . ")";

	// Image
	$sql_getImage = "
		SELECT
			src,
			description
		FROM
			experience_images
		WHERE experience = " . $experience['eID'] . "
		LIMIT 1";
	$images = mysql_query($sql_getImage);
	$nbImages = $images?mysql_num_rows($images):0;

	$imageSrc = "";
	if($nbImages > 0)
	{
		$image = mysql_fetch_array($images);
		$imageSrc = $image['src'];
	}

	// Referral
	$sql_getReferral = "
		SELECT
			RE.body AS excerpt,
			P.firstName AS authorFirstName,
			P.lastName AS authorLastName,
			P.email AS authorEmail
		FROM
			Referrals AS R
			INNER JOIN experience_referral_matrix AS ERM
				ON ERM.referral = R.id
			INNER JOIN Referral_excerpts AS RE
				ON RE.referral = R.id
			INNER JOIN Persons AS P
				ON P.id = R.author
		WHERE ERM.experience = " . $experience['eID'] . "
		LIMIT 1";
	$referrals = mysql_query($sql_getReferral);
	$nbReferrals = $referrals?mysql_num_rows($referrals):0;

	$referralExcerpt = "";
	$referralAuthor = "";
	$referralAuthorEmail = "";
	if($nbReferrals > 0)
	{
		$referral = mysql_fetch_array($referrals);
		$referralExcerpt = $referral['excerpt'];
		$referralAuthor = $referral['authorFirstName'] . " " . $referral['authorLastName'];
		$referralAuthorEmail = $referral['authorEmail'];
	}

	$cv->writeExperience(
		$experience['eTitle'],
		$dateStr,
		$experience['eDescription'],
		$experience['oName'],
		$experience['oUrl'],
		$experience['oLocation'],
		$imageSrc,
		$referralExcerpt,
		$referralAuthor,
		$referralAuthorEmail);

	// Links
	/*$sql_getLinks = "
		SELECT
			url,
			title,
			text
		FROM
			experience_link_matrix
		WHERE experience = " . $experience['eID'];
	$links = mysql_query($sql_getLinks);
	$nbLinks = $links?mysql_num_rows($links):0;

	if($nbLinks > 0)
	{
		while($link = mysql_fetch_array($links))
		{
			$cv->Write($cv->nLh, $link['text'], $link['url']);
			$cv->Ln();
		}
	}*/
}

$cv->AddPage();
$cv->setHeaderStyles();
$cv->Write($cv->hLh, $ls_skills);
$cv->Ln();

$nbSkills = ($_SESSION['lang'] == 'en')?13:8;
$sql_getSkills = "
	SELECT
		id,
		shortName,
		name,
		history,
		stars,
		selfEvaluation
	FROM
		Skills
	ORDER BY
		stars DESC
	LIMIT " . $nbSkills . ";";
$skills = mysql_query($sql_getSkills);
while($skill = mysql_fetch_array($skills))
{
	$skillName = ($skill['shortName'] != "")?$skill['shortName']:$skill['name'];
	$cv->writeSkill($skillName, $skill['history']);
}

$cv->setHeaderStyles();
$cv->Write($cv->hLh, $ls_personalSkills);
$cv->Ln();

if($_SESSION['lang'] == "fr")
{
	$cv->writeFeedback("Livre la marchandise", "Il est exceptionnel de voir la rapidité avec laquelle Shawn est devenu un membre productif de notre équipe. En deux semaines, il avait déjà terminé le développement de notre premier produit.");
	$cv->writeFeedback("Esprit d'équipe", "Pour complémenter ses abiletés techniques et intuitives, Shawn, a facilement intégré notre groupe, entre autre en participant à des partie de cartes et de haki sur l'heure du dîner.");
	$cv->writeFeedback("Penser avant d'agir", "Il s'est montré attentif à nos besoins et a su trouver des failles dans mon raisonnement et apporter des corrections avant le début des travaux malgré qu'il n'était pas familier avec notre entreprise, diminuant ainsi le nombre d'heures nécessaires pour ce projet.");
	$cv->writeFeedback("Pensée positive", "Son attitude ne laissait aucune place à l'échec.");
}
else
{
	$cv->writeFeedback("Get's Things Done", "It was exceptional how quickly Shawn became a contributing member of our team. Within a matter of two weeks, he had already largely completed the development of our first product.");
	$cv->writeFeedback("Team Spirit", "Complementing Shawn's technical and intuitive abilities, he easily socially integrated within our group, including joining colleagues for lunch time card games and hacky.");
	$cv->writeFeedback("Forward Thinking", "He was able to listen carefully to our needs [and] even though he did not know our business very well, he found a few glitches in my reasoning and was able to make corrections before the work was started, lowering the amount of hours needed for this project.");
	$cv->writeFeedback("Positive Thinking", "He had an attitude which left no space for failure.");
}

$cv->Output();

?>
