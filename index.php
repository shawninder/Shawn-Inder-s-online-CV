<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html version="-//W3C//DTD XHTML 1.1//EN"
	xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr"
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xsi:schemaLocation="http://www.w3.org/1999/xhtml
		http://www.w3.org/MarkUp/SCHEMA/xhtml11.xsd"
>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<title>Shawn Inder's Online Résumé</title>
		
		<?php include("DB.php"); ?>
		
		<link type="text/css" href="css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
		<link type="text/css" href="css/header.css" rel="stylesheet" />
		<link type="text/css" href="css/tabs.css" rel="stylesheet" />
		<link type="text/css" href="css/interactive.css" rel="stylesheet" />
		<link type="text/css" href="css/experiences.css" rel="stylesheet" />
		<link type="text/css" href="css/skills.css" rel="stylesheet" />
		<link type="text/css" href="css/lists.css" rel="stylesheet" />
		
		<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript" src="js/jquery.easing.3.1.js"></script>
		<script type="text/javascript" src="js/jquery.cycle.all.latest.js"></script>
		<script type="text/javascript">
			function log() {
				window.console && console.log && console.log('[cycle] ' + Array.prototype.join.call(arguments,' '));
			}
			function adjustPrevNextButtons(isNext, zeroBasedSlideIndex, slideElement)
			{
				$('.current', $(slideElement).parent().parent()).text(zeroBasedSlideIndex + 1);
			}
			function onAfter(currSlideElement, nextSlideElement, options, forwardFlag)
			{
				if(options.slideCount > 1)
				{
					$('.prev', $(currSlideElement).parent().parent()).removeClass("ui-helper-hidden-accessible");
					$('.next', $(currSlideElement).parent().parent()).removeClass("ui-helper-hidden-accessible");
				}
			}
			$(document).ready(function()
			{
				$('body').tabs();
				
				$('.slideshow').each(function() {
					var parent = $(this).parent();
					$(this).cycle({
						fx: 'scrollHorz',
						easing: 'easeInOutCirc',
						prev: $('.prev', parent),
						next: $('.next', parent),
						timeout: 0,
						nowrap: 1,
						onPrevNextEvent: adjustPrevNextButtons,
						after: onAfter
					});
				});
				
				var expanders = $('.expander');
				expanders.each(function()
				{
					$('.ui-widget-content', $(this).parent()).toggle();
					$(this).click(function()
					{
						$('.ui-widget-content', $(this).parent()).toggle("blind", {"easing":"easeInOutCirc"}, "normal");
						$('.expander-icon', $(this)).toggleClass("ui-icon-plusthick")
																				.toggleClass("ui-icon-minusthick");
					});
				});
			});
		</script>
	</head>
	<body>
		<div id="header">
			<h1>Shawn Inder's Online Résumé</h1>
			<a href="mailto:shawninder@gmail.com" title="Write me an e-mail">shawninder@gmail.com</a>
		</div>
		<ul>
			<li><a href="#interactive">Interactive</a></li>
			<li><a href="#download">Download</a></li>
			<li><a href="#print">Print</a></li>
		</ul>

		<div id="interactive">
			<div id="container">
				<div id="experiences" class="half">
					<h2><a class="resetter">Experience</a></h2>
					<ul id="ui-widget skills-list">
						<?php
							$sql_getExperiences = "
								SELECT
									E.id AS eid,
									position,
									startDate,
									endDate,
									logoPath,
									name,
									url,
									description, 
									location,
									jobDescription
								FROM
									Experiences AS E
									INNER JOIN Organizations AS O
										ON O.id = E.organization
								ORDER BY
									startDate DESC;";
							$experiences = mysql_query($sql_getExperiences);
							while($experience = mysql_fetch_array($experiences))
							{
								$endDate = ($experience['endDate'])?$experience['endDate']:"now";
								$sql_getReferrals = "
									SELECT
										RE.title AS title,
										RE.body AS excerpt,
										firstName,
										lastName
									FROM
										Referrals AS R
										INNER JOIN experience_referral_matrix AS ERM
											ON ERM.referral = R.id
										INNER JOIN Referral_excerpts AS RE
											ON RE.referral = R.id
										INNER JOIN Persons AS P
											ON P.id = R.author
									WHERE ERM.experience = " . $experience['eid'];
								$referrals = mysql_query($sql_getReferrals);
								echo("<li id=\"experience_" . $experience['eid'] . "\">
												<h3 class=\"ui-widget-header ui-corner-top ui-state-default expander\"><span class=\"ui-icon ui-icon-plusthick expander-icon\"></span>" . $experience['position'] . " <span class=\"dates\">(" . $experience['startDate'] . " » " . $endDate . ")</span><div style=\"clear: both;\"></div></h3>
												<div class=\"ui-widget-content\">
													<img class=\"profile_pic\" src=\"" . $experience['logoPath'] . "\" alt=\"" . $experience['name'] . "\" />
													<p>" . $experience['jobDescription'] . "</p>");
								$nbReferrals = mysql_num_rows($referrals);
								if($nbReferrals > 1)
								{
									echo("	<h4>Feedback
														(<span class=\"current\">1</span>/<span class=\"total\">" . $nbReferrals . "</span>)
														<a class=\"prev ui-helper-hidden-accessible ui-state-default\" title=\"Previous referral\">
															<span class=\"ui-icon ui-icon-circle-triangle-w\">Prev</span>
														</a>
														<a class=\"next ui-helper-hidden-accessible ui-state-default\" title=\"Next referral\">
															<span class=\"ui-icon ui-icon-circle-triangle-e\">Next</span>
														</a>
													</h4>
													<ul class=\"referrals slideshow\">");
									while($referral = mysql_fetch_array($referrals))
									{
										echo("	<li>
															<h5>" . $referral['title'] . "</h5>
															<q>" . $referral['excerpt'] . "</q>
															 - " . $referral['firstName'] . " " . $referral['lastName'] . "
														</li>");
									}
									echo("	</ul>");
								}
								echo("	</div>
												<p class=\"ui-widget-footer ui-corner-bottom\">
													<a href=\"" . $experience['url'] . "\" title=\"" . $experience['description'] . "\">" . $experience['name'] . "</a>, " . $experience['location'] . "
												</p>
											</li>");
							}
						?>
					</ul>
				</div>
				<div id="skills" class="half">
					<h2><a class="resetter">Technical Skills</a></h2>
					<ul class="ui-widget skills-list">
						<?php
							$sql_getLanguages = "
								SELECT
									id,
									shortName,
									name,
									comment,
									selfEvaluation
								FROM
									Languages
								ORDER BY
									isHuman DESC,
									selfEvaluation DESC;";
							$languages = mysql_query($sql_getLanguages);
							while($language = mysql_fetch_array($languages))
							{
								echo("<li id=\"language_" . $language['id'] . "\">");
								echo("	<h3 class=\"ui-widget-header ui-corner-all ui-state-default expander\" title=\"" . $language['name'] . "\">
													<span class=\"ui-icon ui-icon-plusthick expander-icon\">Expand section</span>");
								echo(($language['shortName'] != "")?$language['shortName']:$language['name']);
								echo("		<span class=\"selfEvaluation\">(" . $language['selfEvaluation'] . ")</span>
													<div style=\"clear: both;\"></div>
												</h3>
												<div class=\"ui-widget-content\">" . $language['comment'] . "</div>
											</li>");
							}
						?>
					</ul>
				</div>
			</div>
		</div>
		<div id="download">
			<ul>
				<li><a href="cv.pdf" title="Download my résumé as PDF">PDF</a></li>
				<li><a href="cv.doc" title="Download my résumé as a Word document">Word</a></li>
				<li><a href="cv.rtf" title="Download my résumé as RTF">RTF</a></li>
			</ul>
		</div>
		<div id="print">
			<p>Coming soon</p>
		</div>
		<div style="clear: both;"> </div>
	</body>
</html>

