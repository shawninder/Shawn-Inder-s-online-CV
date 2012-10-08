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

	include("setLang.php");	// After this, $_SESSION['lang'] should be set to 'en' or 'fr'
	include($_SESSION['lang'] . ".php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html version="-//W3C//DTD XHTML 1.1//EN"
	xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo($_SESSION['lang']); ?>"
	lang="<?php echo($_SESSION['lang']); ?>"
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xsi:schemaLocation="http://www.w3.org/1999/xhtml
		http://www.w3.org/MarkUp/SCHEMA/xhtml11.xsd"
>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<title><?php echo($ls_title); ?></title>
		
		<?php
			if (!$serverProblems) {
				include("DB.php");
			}
			
			function addEvaluation($nbStars, $starWord, $description)
			{
				$nb = ($nbStars)?$nbStars:0;
				return("<img src=\"images/stars_" . $nb . ".png\" alt=\"" . $nb . " " . $starWord . ": " . $description . "\" title=\"" . $description . "\" />");
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
			<h1>CV: <a class="emailLink" href="mailto:shawninder@gmail.com" title="<?php echo($ls_sendMeMail); ?>">Shawn Inder</a><span class="printOnly"> (shawninder@gmail.com)</span></h1>
			<p class="printOnly"><?php echo($ls_visitMySite); ?> <a href="http://shawninder.99k.org">shawninder.99k.org</a></p>
			<img src="images/ubc.jpg" id="headerBackground" alt="<?php echo($ls_ubcAlt); ?>" title="<?php echo($ls_ubcTitle); ?>" />
		</div>
		
		<div id="theRest">
			<img src="images/canoe.jpg" alt="<?php echo($ls_canoeAlt); ?>" class="background" title="<?php echo($ls_canoeTitle); ?>" />
			<?php
				if (isset($fourOfour) && $fourOfour == 1)
				{
					echo("<h1 class=\"dissmissable\">" . $ls_404 . "</h1>");
				}
				if (isset($serverProblems) && $serverProblems === 1) {
					echo("<h1 class=\"dissmissable\">" . $ls_serverProblems . "</h1>");
				} else {
			
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
										$endDate = ($experience['eEndDate'] && $experience['eEndDate'] != "0000-00-00")?substr($experience['eEndDate'], 0, strpos($experience['eEndDate'], "-")):$ls_now;
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
											WHERE ERM.experience = " . $experience['eID'] . "
											ORDER BY RE.id";
										$referrals = mysql_query($sql_getReferrals);
										$nbReferrals = $referrals?mysql_num_rows($referrals):0;
								
										$sql_getLinks = "
											SELECT
												url,
												title,
												text
											FROM
												experience_link
											WHERE experience = " . $experience['eID'];
										$links = mysql_query($sql_getLinks);
										$nbLinks = $links?mysql_num_rows($links):0;
								
										$str .= ($spacing . "<li id=\"experience_" . $experience['eID'] . "\" class=\"experience\">");
										$str .= ($spacing . "\t<h3 class=\"header\">");
										$str .= ($spacing . "\t\t<a class=\"position\" href=\"index.php?eid=" . $experience['eID'] . "&lang=" . $_SESSION['lang'] . "\" title=\"" . $ls_positionTitle . $experience['eTitle'] . "\">");
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
												$str .= ($spacing . "\t\t\t\t\t<span class=\"signature\"> - <a href=\"mailto:" . $referral['authorEmail'] . "\" title=\"" . $ls_sendMail . $referral['authorFirstName'] . " " . $referral['authorLastName'] . "\" class=\"emailLink\">" . $referral['authorFirstName'] . " " . $referral['authorLastName'] . "</a></span>");
												$str .= ($spacing . "\t\t\t\t</li>");
												$first = false;
											}
											$str .= ($spacing . "\t\t\t</ul>");
											$str .= ($spacing . "\t\t\t<button class=\"next hidden-accessible\"></button>");
											$str .= ($spacing . "\t\t</div>");
										}
										mysql_free_result($referrals);
									
										$str .= ($spacing . "\t\t<p class=\"seeOtherColumn");
										if(!isset($_GET['eid']))
										{
											$str .= " hidden-accessible";
										}
										$str .= ("\">" . $ls_skillsPerfected . " <img src=\"images/supportingSkill.png\" alt=\"" . $ls_seeOtherColumn . "\" /></p>");
									
										// Links
										if($nbLinks > 0)
										{
											$str .= ($spacing . "\t\t<ul class=\"linkList\">");
											while($link = mysql_fetch_array($links))
											{
												$str .= ($spacing . "\t\t\t<li><a href=\"" . $link['url'] . "\" title=\"" . $link['title'] . "\" target=\"_blank\">" . $link['text'] . "</a></li>");
											}
											mysql_free_result($links);
											$str .= ($spacing . "\t\t</ul>");
										}
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
										if($experience['oUrl'] != "")
										{
											$str .= ($spacing . "\t\t<a href=\"" . $experience['oUrl'] . "\" title=\"" . $ls_visit . $experience['oUrl'] . "\" target=\"_blank\">" . $experience['oName'] . "</a>, " . $experience['oLocation']);
										} else {
											$str .= ($spacing . "\t\t" . $experience['oName'] . ", " . $experience['oLocation']);
										}
										$str .= ($spacing . "\t</p>");
										$str .= ($spacing . "</li>");
									}
									mysql_free_result($experiences);
							
									echo($str . "\n");
								?>
							</ul>
						<?php
						if(isset($_GET['eid']) || isset($_GET['sid']))
							{
								echo('<a href="index.php?lang=' . $_SESSION['lang'] . '" title="' . $ls_seeAllExperiences . '" class="seeAll">' . $ls_backToAllExperiences . '</a>');
							}
							$str = "";
							$spacing = "\n\t\t\t\t";
							if(!isset($_GET['static']) || $_GET['static'] != 1)
							{
								$str .= ($spacing . "</div>");
								$str .= ($spacing . "<div class=\"skillList rightHalf\">");
							}
							echo($str . "\n");
						?>
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
										$str .= ($spacing . "\t\t<a class=\"skillName\" href=\"index.php?sid=" . $skill['id'] . "&lang=" . $_SESSION['lang'] . "\" title=\"" . $ls_skillTitle . $skill['name'] . "\">");
										$str .= ($skill['shortName'] != "")?$skill['shortName']:$skill['name'];
										$str .= " <span class=\"stars\">" . addEvaluation($skill['stars'], $ls_stars, $skill['selfEvaluation']) . "</span>";
										$str .= "</a>";
										$str .= ($spacing . "\t\t<span style=\"display: block; clear: both;\"></span>");
										$str .= ($spacing . "\t</h3>");
										$str .= ($spacing . "\t<div class=\"allEyesOnly" . ((isset($_GET['eid']))?" dontShow":"") . "\">");
										$str .= ($spacing . "\t\t<p>" . $skill['history'] . "</p>");
										$str .= ($spacing . "\t\t<p class=\"seeOtherColumn");
										if(!isset($_GET['sid']))
										{
											$str .= " hidden-accessible";
										}
										$str .= ("\"><img src=\"images/supportingExperience.png\" alt=\"" . $ls_seeOtherColumn . "\" /> " . $ls_pertinentExperiences . "</p>");
										$str .= ($spacing . "\t</div>");
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
					if(isset($_GET['eid']) || isset($_GET['sid']))
					{
						echo('<a href="index.php?lang=' . $_SESSION['lang'] . '" title="' . $ls_seeAllSkills . '" class="seeAll">' . $ls_backToAllSkills . '</a>');
					}
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
		<?php
			}
		?>		
		<ul id="moreOptionsMenu">
			<?php
				// TODO Why do I need this?
				if (!$serverProblems) {
					if($_SESSION['lang'] == "fr")
					{
						echo('<li><a href="index.php?lang=en" title="Get the english version of this website" xml:lang="en">English Version</a></li>');
					}
					else
					{
						echo('<li><a href="index.php?lang=fr" title="Accéder à la version française du site web" xml:lang="fr">Version Française</a></li>');
					}
				}
			?>
			<li>
				<!--<a id="downloadLink" href="download.php" title="Download a static version of my CV in the format of your choice">Download CV</a>-->
				<a href="CV.pdf.php?lang=<?php echo($_SESSION['lang']); ?>" title="<?php echo($ls_downloadTitle); ?>"><?php echo($ls_download); ?></a>
				<!--<div id="downloadMenu">
					<ul>
						<?php
							/*
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
							*/
						?>
					</ul>-->
					<div style="clear: both;"></div>
				</div>
			</li>
			<?php
				// TODO Why do I need this?
				if (!$serverProblems) {
			?>
			<li>
				<ul>
					<li><a class="emailLink" href="mailto:shawninder@gmail.com" title="<?php echo($ls_sendMeMail); ?>">shawninder@gmail.com</a></li>
					<li>514-903-9082</li>
				</ul>
			</li>
			<?php
				}
			?>
		</ul>
	</body>
</html>

