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
		
		<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript" src="js/jquery.easing.3.1.js"></script>
		<script type="text/javascript" src="js/myScripts.js"></script>
	</head>
	<body>
		<div id="header">
			<h1>iCV: <a class="emailLink" href="mailto:shawninder@gmail.com" title="Send me an e-mail">Shawn Inder</a></h1>
		</div>

		<div class="interactiveCV">
			<div class="CVcontainer">
				<div class="leftHalf">
					<h2 class="breadcrumbs jobCrumbs">Jobs</h2>
				</div>
				<div class="rightHalf">
					<h2 class="breadcrumbs skillCrumbs">Skills</h2>
				</div>
			</div>
		</div>
		
		<div class="interactiveCV">
			<div class="CVcontainer">
				<div class="jobList leftHalf">
					<ul>
						<?php
							$sql_getJobs = "
								SELECT
									J.id AS jID,
									J.title AS jTitle,
									J.startDate AS jStartDate,
									J.endDate AS jEndDate,
									O.name AS oName,
									O.location AS oLocation,
									O.url AS oUrl,
									J.Description AS jDescription
								FROM
									Jobs AS J
									INNER JOIN Organizations AS O
										ON O.id = J.organization
								ORDER BY
									jStartDate DESC;";
							$jobs = mysql_query($sql_getJobs);
							while($job = mysql_fetch_array($jobs))
							{
								$startDate = substr($job['jStartDate'], 0, strpos($job['jStartDate'], "-"));
								$endDate = ($job['jEndDate'])?substr($job['jEndDate'], 0, strpos($job['jEndDate'], "-")):"now";
								
								$sql_getImages = "
									SELECT
										src,
										description
									FROM
										job_images
									WHERE job = " . $job['jID'];
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
										INNER JOIN job_referral_matrix AS JRM
											ON JRM.referral = R.id
										INNER JOIN Referral_excerpts AS RE
											ON RE.referral = R.id
										INNER JOIN Persons AS P
											ON P.id = R.author
									WHERE JRM.job = " . $job['jID'];
								$referrals = mysql_query($sql_getReferrals);
								$nbReferrals = $referrals?mysql_num_rows($referrals):0;
								
								$sql_getLinks = "
									SELECT
										url,
										title,
										text
									FROM
										job_link_matrix
									WHERE job = " . $job['jID'];
								$links = mysql_query($sql_getLinks);
								$nbLinks = $links?mysql_num_rows($links):0;
								
								echo("<li id=\"job_" . $job['jID'] . "\" class=\"job\">
												<h3 class=\"header\"><span class=\"position\">" . $job['jTitle'] . "</span> <span class=\"dates\">(" . $startDate . " » " . $endDate . ")</span><span style=\"display: block; clear: both;\"></span></h3>
												<div class=\"allEyesOnly\">");

								// Images
								if($nbImages > 0)
								{
									echo("	<div class=\"slideshowWrapper\">
														<span class=\"prev hidden-accessible\"></span>
														<ul class=\"slideshow pictureList\">");
									while($image = mysql_fetch_array($images))
									{
										echo("		<li><img class=\"profilePicture\" src=\"" . $image['src'] . "\" alt=\"" . $image['description'] . "\" /></li>");
									}
									echo("		</ul>
														<span class=\"next hidden-accessible\"></span>
													</div>");
								}
										
								// Referrals
								if($nbReferrals > 0)
								{
									echo("	<div class=\"slideshowWrapper\">
														<span class=\"prev hidden-accessible\"></span>
														<ul class=\"slideshow referralList\">");
									while($referral = mysql_fetch_array($referrals))
									{
										echo("		<li>
																<q>" . $referral['excerpt'] . "</q>
																<span class=\"signature\"> - <a href=\"mailto:" . $referral['authorEmail'] . "\" title=\"Send an e-mail to " . $referral['authorFirstName'] . " " . $referral['authorLastName'] . "\" class=\"emailLink\">" . $referral['authorFirstName'] . " " . $referral['authorLastName'] . "</a></span>
															</li>");
									}
									echo("		</ul>
														<span class=\"next hidden-accessible\"></span>
													</div>");
								}
								
								// Job description
								echo("		<p class=\"jobDescription\">" . $job['jDescription'] . "</p>");
								
								// Links
								if($nbLinks > 0)
								{
									echo("	<ul class=\"linkList\">");
									while($link = mysql_fetch_array($links))
									{
										echo("	<li><a href=\"" . $link['url'] . "\" title=\"" . $link['title'] . "\">" . $link['text'] . "</a></li>");
									}
									echo("	</ul>");
								}
								// Footer
								echo("	</div>
												<p class=\"footer\"><a href=\"" . $job['oUrl'] . "\" title=\"Visit " . $job['oUrl'] . "\">" . $job['oName'] . "</a>, " . $job['oLocation'] . "</p>
											</li>");
							}
						?>
					</ul>
				</div>
				<div class="skillList rightHalf">
					<ul>
						<?php
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
									stars DESC;";
							$skills = mysql_query($sql_getSkills);
							while($skill = mysql_fetch_array($skills))
							{
								echo("<li id=\"skill_" . $skill['id'] . "\" class=\"skill\">
												<h3 class=\"header\" title=\"" . $skill['name'] . "\">
													<span class=\"skillName\">");
								echo(				($skill['shortName'] != "")?$skill['shortName']:$skill['name']);
								echo("		</span>
													<span class=\"stars\">" . addEvaluation($skill['stars'], $skill['selfEvaluation']) . "</span>
													<span style=\"display: block; clear: both;\"></span>
												</h3>
												<div class=\"allEyesOnly\"><p>" . $skill['history'] . "</p></div>
											</li>");
						}
						?>
					</ul>
				</div>
			</div>
		</div>
		<div style="clear: both;"> </div>
		<ul id="moreOptionsMenu">
			<li><a>Version Française</a></li>
			<li><a>Print current view</a></li>
			<li><a>Download CV</a></li>
		</ul>
		<div><img src="images/tyingCanoe.jpg" alt="A picture of me" class="background" title="Background Image: Me canoeing near Vancouver!" /></div>
		<div id="preload">
			<img src="images/prevON.png" />
			<img src="images/nextON.png" />
		</div>
	</body>
</html>

