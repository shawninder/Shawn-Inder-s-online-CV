<?php
	// Redirect to home page if more than one parameter is passed
	$nbParams = 0;
	$nbParams += (isset($_GET['eid']))?1:0;
	$nbParams += (isset($_GET['sid']))?1:0;
	$nbParams += (isset($_GET['static']))?1:0;
	if($nbParams > 1)
	{
		header('Location: http://shawninder.99k.org');
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html version="-//W3C//DTD XHTML 1.1//EN"
	xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr"
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xsi:schemaLocation="http://www.w3.org/1999/xhtml
		http://www.w3.org/MarkUp/SCHEMA/xhtml11.xsd"
>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<title>Shawn Inder's Interactive C.V.</title>
		
		<?php
			include("DB.php");
			
			function addEvaluation($nbStars, $description)
			{
				$nb = ($nbStars)?$nbStars:0;
				return("<img src=\"images/stars_" . $nb . ".png\" alt=\"" . $nbStars . " stars: " . $description . "\" title=\"" . $description . "\" />");
			}
		?>

		<!-- Using WebPutty -->
		<link rel="stylesheet" type="text/css" href="http://www.webputty.net/css/agtzfmNzc2ZpZGRsZXIMCxIEUGFnZRjVuysM" />
		<script type="text/javascript">(function(w,d){if(w.location!=w.parent.location||w.location.search.indexOf('__preview_css__')>-1){var t=d.createElement('script');t.type='text/javascript';t.async=true;t.src='http://www.webputty.net/js/agtzfmNzc2ZpZGRsZXIMCxIEUGFnZRjVuysM';(d.body||d.documentElement).appendChild(t);}})(window,document);</script>
		<!-- WebPutty end -->
		
		<?php
			$str = "";
			$spacing = "\n\t\t";
			if(!isset($_GET['eid']) && !isset($_GET['sid']) && !isset($_GET['static']))
			{
				$str .= ($spacing . "<script type=\"text/javascript\" src=\"js/jquery-1.6.2.min.js\"></script>");
				$str .= ($spacing . "<script type=\"text/javascript\" src=\"js/jquery-ui-1.8.16.custom.min.js\"></script>");
				$str .= ($spacing . "<script type=\"text/javascript\" src=\"js/jquery.easing.3.1.js\"></script>");
				$str .= ($spacing . "<script type=\"text/javascript\" src=\"js/myScripts.js\"></script>");
			}
			echo($str . "\n");
		?>
	</head>
	<body>
		<div id="header">
			<h1>CV: <a class="emailLink" href="mailto:shawninder@gmail.com" title="Send me an e-mail">Shawn Inder</a><span class="printOnly"> (shawninder@gmail.com)</span></h1>
			<p class="printOnly">Visit my website for more details: <a href="http://shawninder.99k.org">shawninder.99k.org</a></p>
			<img src="images/ubc.jpg" id="headerBackground" alt="University of British Colombia" title="In the background: University of British Columbia" />
		</div>
		
		<div id="theRest">
			<img src="images/canoe.jpg" alt="A picture of me" class="background" title="Background Image: Canoeing near Vancouver!" />
			<?php
				$str = "";
				$spacing = "\n\t\t";
				if(!isset($_GET['static']) || $_GET['static'] != 1)
				{
					$str .= ($spacing . "<div class=\"columnsWrapper\">");
					$str .= ($spacing . "\t<div class=\"columnsInnerWrapper\">");
					$str .= ($spacing . "\t\t<div class=\"experienceList leftHalf\">");
				}
				echo($str . "\n");
			?>
						<h2 class="breadcrumbs experienceCrumbs">
							<?php
								$str = "";
								$spacing = "\n\t\t\t\t\t\t";
								if(isset($_GET['eid']))
								{
									$str .= ($spacing . "<a href=\"index.php\" title=\"See all experiences\">Experiences</a> >> Zoom in on an experience");
								}
								else if(isset($_GET['sid']))
								{
									$str .= ($spacing . "<a href=\"index.php\" title=\"See all experiences\">Experiences</a> >> Perfecting this skill");
								}
								else
								{
									$str .= ($spacing . "Experiences");
								}
								echo($str . "\n");
							?>
						</h2>
						<ul>
							<?php
								$str = "";
								$spacing = "\n\t\t\t\t\t\t";
						
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
									" . ((isset($_GET['sid']))?" INNER JOIN experience_skill_matrix AS ESM ON ESM.experience = E.id AND ESM.skill = '" . $_GET['sid'] . "' ":" ") . "
									" . ((isset($_GET['eid']))?" WHERE E.id = '" . $_GET['eid'] . "' ":" ") . "
									ORDER BY
										eStartDate DESC;";
								$experiences = mysql_query($sql_getExperiences);
								while($experience = mysql_fetch_array($experiences))
								{
									$startDate = substr($experience['eStartDate'], 0, strpos($experience['eStartDate'], "-"));
									$endDate = ($experience['eEndDate'])?substr($experience['eEndDate'], 0, strpos($experience['eEndDate'], "-")):"now";
									$dateStr = ($startDate == $endDate)?"(" . $startDate . ")":"(" . $startDate . " » " . $endDate . ")";
								
									$sql_getImages = "
										SELECT
											src,
											description
										FROM
											experience_images
										WHERE experience = " . $experience['eID'];
									$images = mysql_query($sql_getImages);
									$nbImages = $images?mysql_num_rows($images):0;

									$sql_getReferrals = "
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
										WHERE ERM.experience = " . $experience['eID'];
									$referrals = mysql_query($sql_getReferrals);
									$nbReferrals = $referrals?mysql_num_rows($referrals):0;
								
									/*$sql_getLinks = "
										SELECT
											url,
											title,
											text
										FROM
											experience_link_matrix
										WHERE experience = " . $experience['eID'];
									$links = mysql_query($sql_getLinks);
									$nbLinks = $links?mysql_num_rows($links):0;*/
								
									$str .= ($spacing . "<li id=\"experience_" . $experience['eID'] . "\" class=\"experience\">");
									$str .= ($spacing . "\t<h3 class=\"header\">");
									$str .= ($spacing . "\t\t<a class=\"position\" href=\"index.php?eid=" . $experience['eID'] . "\" title=\"More information about my time as a " . $experience['eTitle'] . "\">");
									$str .= ("<span class=\"onlyPosition\">" . $experience['eTitle'] . "</span>");
									$str .= (" <span class=\"dates\">" . $dateStr . "</span>");
									$str .= ("</a>");
									$str .= ($spacing . "\t\t<span style=\"display: block; clear: both;\"></span>");
									$str .= ($spacing . "\t</h3>");
									$str .= ($spacing . "\t<div class=\"allEyesOnly" . ((isset($_GET['sid']))?" dontShow":"") . "\">");

									// Images
									if($nbImages > 0)
									{
										$str .= ($spacing . "\t\t<div class=\"slideshowWrapper\">");
										$str .= ($spacing . "\t\t\t<span class=\"prev hidden-accessible\"></span>");
										$str .= ($spacing . "\t\t\t<ul class=\"slideshow pictureList\">");
										while($image = mysql_fetch_array($images))
										{
											$str .= ($spacing . "\t\t\t\t<li><img class=\"profilePicture\" src=\"" . $image['src'] . "\" alt=\"" . $image['description'] . "\" /></li>");
										}
										$str .= ($spacing . "\t\t\t</ul>");
										$str .= ($spacing . "\t\t\t<span class=\"next hidden-accessible\"></span>");
										$str .= ($spacing . "\t\t</div>");
									}
									mysql_free_result($images);

									// Experience description
									$str .= ($spacing . "\t\t<p class=\"experienceDescription\">" . $experience['eDescription'] . "<div style=\"clear: both;\"></div></p>");
										
									// Referrals
									if($nbReferrals > 0)
									{
										$str .= ($spacing . "\t\t<div class=\"slideshowWrapper\">");
										$str .= ($spacing . "\t\t\t<button class=\"prev hidden-accessible\"></button>");
										$str .= ($spacing . "\t\t\t<ul class=\"slideshow referralList\">");
										$first = true;
										while($referral = mysql_fetch_array($referrals))
										{
											$str .= ($spacing . "\t\t\t\t<li" . (($first)?" class=\"firstReferral\"":"") . ">");
											$str .= ($spacing . "\t\t\t\t\t<q>" . $referral['excerpt'] . "</q>");
											$str .= ($spacing . "\t\t\t\t\t<span class=\"signature\"> - <a href=\"mailto:" . $referral['authorEmail'] . "\" title=\"Send an e-mail to " . $referral['authorFirstName'] . " " . $referral['authorLastName'] . "\" class=\"emailLink\">" . $referral['authorFirstName'] . " " . $referral['authorLastName'] . "</a></span>");
											$str .= ($spacing . "\t\t\t\t</li>");
											$first = false;
										}
										$str .= ($spacing . "\t\t\t</ul>");
										$str .= ($spacing . "\t\t\t<button class=\"next hidden-accessible\"></button>");
										$str .= ($spacing . "\t\t</div>");
									}
									mysql_free_result($referrals);
									
									$str .= ($spacing . "\t\t<p class=\"seeOtherColumn\">Skills perfected <img src=\"images/supportingSkill.png\" alt=\"See other column\" /></p>");
								
									// Links
									/*if($nbLinks > 0)
									{
										$str .= ($spacing . "\t\t<ul class=\"linkList\">");
										while($link = mysql_fetch_array($links))
										{
											$str .= ($spacing . "\t\t\t<li><a href=\"" . $link['url'] . "\" title=\"" . $link['title'] . "\">" . $link['text'] . "</a></li>");
										}
										$str .= ($spacing . "\t\t</ul>");
									}*/
									$str .= ($spacing . "\t</div>");
								
									if(isset($_GET['sid']))
									{
										$sql_getLinkInfo = "SELECT
													description
												FROM
													experience_skill_matrix
												WHERE experience = '" . $experience['eID'] . "'
													AND skill = '" . $_GET['sid'] . "'
												ORDER BY
													skill,
													experience\n";
										$linkInfo = mysql_query($sql_getLinkInfo);
										if(mysql_num_rows($linkInfo) > 0)
										{
											while($supportParagraph = mysql_fetch_array($linkInfo))
											{
												$str .= ($spacing . "\t<p class=\"supportParagraph\">" . $supportParagraph['description'] . "</p>");
											}
										}
										mysql_free_result($linkInfo);
									}
								
									// Footer
									$str .= ($spacing . "\t<p class=\"footer\">");
									$str .= ($spacing . "\t\t<a href=\"" . $experience['oUrl'] . "\" title=\"Visit " . $experience['oUrl'] . "\">" . $experience['oName'] . "</a>, " . $experience['oLocation']);
									$str .= ($spacing . "\t</p>");
									$str .= ($spacing . "</li>");
								}
								mysql_free_result($experiences);
							
								echo($str . "\n");
							?>
						</ul>
					<?php
						$str = "";
						$spacing = "\n\t\t\t\t";
						if(!isset($_GET['static']) || $_GET['static'] != 1)
						{
							$str .= ($spacing . "</div>");
							$str .= ($spacing . "<div class=\"skillList rightHalf\">");
						}
						echo($str . "\n");
					?>
						<h2 class="breadcrumbs skillCrumbs">
							<?php
								$str = "";
								$spacing = "\n\t\t\t\t\t\t";
								if(isset($_GET['sid']))
								{
									$str .= ($spacing . "<a href=\"index.php\" title=\"See all skills\">Skills</a> >> Zoom in on a skill");
								}
								else if(isset($_GET['eid']))
								{
									$str .= ($spacing . "<a href=\"index.php\" title=\"See all skills\">Skills</a> >> Perfected during this experience");
								}
								else
								{
									$str .= ($spacing . "Skills");
								}
								echo($str . "\n");
							?>
						</h2>
						<ul>
							<?php
								$str = "";
								$spacing = "\n\t\t\t\t\t\t";
						
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
									" . ((isset($_GET['eid']))?" INNER JOIN experience_skill_matrix AS ESM ON ESM.skill = id AND ESM.experience = '" . $_GET['eid'] . "' ":" ") . "
									" . ((isset($_GET['sid']))?" WHERE id = '" . $_GET['sid'] . "' ":" ") . "
									ORDER BY
										stars DESC;";
								$skills = mysql_query($sql_getSkills);
								while($skill = mysql_fetch_array($skills))
								{
									$str .= ($spacing . "<li id=\"skill_" . $skill['id'] . "\" class=\"skill\">");
									$str .= ($spacing . "\t<h3 class=\"header\" title=\"" . $skill['name'] . "\">");
									$str .= ($spacing . "\t\t<a class=\"skillName\" href=\"index.php?sid=" . $skill['id'] . "\" title=\"More information about my knowledge of " . $skill['name'] . "\">");
									$str .= ($skill['shortName'] != "")?$skill['shortName']:$skill['name'];
									$str .= " <span class=\"stars\">" . addEvaluation($skill['stars'], $skill['selfEvaluation']) . "</span>";
									$str .= "</a>";
									$str .= ($spacing . "\t\t<span style=\"display: block; clear: both;\"></span>");
									$str .= ($spacing . "\t</h3>");
									$str .= ($spacing . "\t<div class=\"allEyesOnly" . ((isset($_GET['eid']))?" dontShow":"") . "\"><p>" . $skill['history'] . "</p><p class=\"seeOtherColumn\"><img src=\"images/supportingExperience.png\" alt=\"See other column\" /> Pertinent experiences</p></div>");
									if(isset($_GET['eid']))
									{
										$sql_getLinkInfo = "SELECT
													description
												FROM
													experience_skill_matrix
												WHERE experience = '" . $_GET['eid'] . "'
													AND skill = '" . $skill['id'] . "'
												ORDER BY
													skill,
													experience\n";
										$linkInfo = mysql_query($sql_getLinkInfo);
										if(mysql_num_rows($linkInfo) > 0)
										{
											while($supportParagraph = mysql_fetch_array($linkInfo))
											{
												$str .= ($spacing . "\t<p class=\"supportParagraph\">" . $supportParagraph['description'] . "</p>");
											}
										}
										mysql_free_result($linkInfo);
									}
									$str .= ($spacing . "</li>");
								}
								mysql_free_result($skills);
								echo($str . "\n");
							?>
						</ul>
			<?php
				$str = "";
				$spacing = "\n\t\t";
				if(!isset($_GET['static']) || $_GET['static'] != 1)
				{
					$str .= ($spacing . "\t\t</div>");
					$str .= ($spacing . "\t</div>");
					$str .= ($spacing . "</div>");
				}
				echo($str . "\n");
			?>
			<div style="clear: both;"> </div>
			<?php $preloadAlt = "I'm just preloading the hovered version of the Previous icon here, please ignore this."; ?>
			<div id="preload">
				<img src="images/prev.png" alt="<?php echo($preloadAlt); ?>" />
				<img src="images/prevON.png" alt="<?php echo($preloadAlt); ?>" />
				<img src="images/next.png" alt="<?php echo($preloadAlt); ?>" />
				<img src="images/nextON.png" alt="<?php echo($preloadAlt); ?>" />
				<img src="images/supportingSkill.png" alt="<?php echo($preloadAlt); ?>" />
				<img src="images/supportingExperience.png" alt="<?php echo($preloadAlt); ?>" />
				<img src="images/birdExpandON.png" alt="<?php echo($preloadAlt); ?>" />
				<img src="images/birdContractON.png" alt="<?php echo($preloadAlt); ?>" />
			</div>
		</div>
		<ul id="moreOptionsMenu">
				<li><a href="french.php" title="Accéder à la version française du site web" xml:lang="fr" onclick="alert('Désolé!\nJe n\'ai pas encore traduit mes textes en français.'); return false;">Version Française</a></li>
				<li>
					<!--<a id="downloadLink" href="download.php" title="Download a static version of my CV in the format of your choice">Download CV</a>-->
					<a href="CV.pdf.php" title="Download my CV as a PDF file">Download</a>
					<div id="downloadMenu">
						<ul>
							<?php
								function addFormatIfExists($format)
								{
									$fileName = "CV." . $format . ".php";
									if(file_exists($fileName))
									{
										$str = "";
										$spacing = "\n\t\t\t\t\t";
										$str .= ($spacing . "<li><a href=\"" . $fileName . "\" title=\"Download my CV as a " . $format . " file\">as " . $format . "</a></li>");
										echo($str . "\n");
									}
								}
								addFormatIfExists('pdf');
								addFormatIfExists('doc');
								addFormatIfExists('rtf');
								addFormatIfExists('txt');
							?>
						</ul>
						<div style="clear: both;"></div>
					</div>
				</li>
			</ul>
	</body>
</html>

