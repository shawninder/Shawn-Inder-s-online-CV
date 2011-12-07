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
		<script type="text/javascript" src="js/jquery.cycle.all.latest.js"></script>
		<script type="text/javascript">
			function log() {
				window.console && console.log && console.log('[log] ' + Array.prototype.join.call(arguments,' '));
				return true;
			}
			
			// TODO: I shouldn't need resizeSlideshow, cycle should take care of this. Is this a problem in my code or a corner case cycle should know about?
			function resizeSlideshow(currSlideElement, nextSlideElement, ifBigger)
			{
				var curr = $(currSlideElement);
				var next = $(nextSlideElement);
				if(curr && next)
				{
					var nextH = next.height();
					var currH = curr.height();
					if(((nextH > currH) && ifBigger) || ((nextH < currH) && !ifBigger))
					{
						next.parent().animate(
							{
								height: nextH
							},
							'fast',
							'easeInOutCirc');
					}
				}
			}
			function onBefore(currSlideElement, nextSlideElement, options, forwardFlag)
			{
				resizeSlideshow(currSlideElement, nextSlideElement, 1);
			}
			function onAfter(currSlideElement, nextSlideElement, options, forwardFlag)
			{
				resizeSlideshow(currSlideElement, nextSlideElement, 0);
				
				var index = options.currSlide;
				if(index == 0)
				{
					$('.prev', $(currSlideElement).parent().parent()).addClass("hidden-accessible");
				}
				else
				{
					$('.prev', $(currSlideElement).parent().parent()).removeClass("hidden-accessible");
				}
				if(index == options.slideCount - 1)
				{
					$('.next', $(currSlideElement).parent().parent()).addClass("hidden-accessible");
				}
				else
				{
					$('.next', $(currSlideElement).parent().parent()).removeClass("hidden-accessible");
				}
			}
			
			function crumbs(column, text)
			{
				if(!column)
				{
					crumbs('Job');
					crumbs('Skill');
				}
				else
				{
					var breadcrumbs = $('.breadcrumbs', $('#' + column.toLowerCase() + 'List'));
					if(!text)
					{
						// Back to default
						breadcrumbs.text(column + "s");
					}
					else
					{
						breadcrumbs.html('<a onclick="allEyesOff($(\'.allEyes\'));">' + column + 's</a> >> ' + text);					
					}
				}
			}
			

			function getOthers(element)
			{
				var supportingIDs = element.data('linkedTo'), nbSupportingIDs = supportingIDs.length;

				var elements = (element.attr('id').match(/skill/))?$('ul', $('#jobList')).children():$('ul', $('#skillList')).children();
				
				var supportingElements, nonSupportingElements;

				elements.each(function()
				{
					var self = $(this);
					var found = false;
					for(var i = 0; !found && (i < nbSupportingIDs); ++i)
					{
						if(supportingIDs[i] == self.attr('id'))
						{
							found = true;
						}
					}
					if(found)
					{
						supportingElements = (supportingElements)?supportingElements.add(self):self;
					}
					else
					{
						nonSupportingElements = (nonSupportingElements)?nonSupportingElements.add(self):self;
					}
				});
				return ({supporting: supportingElements, nonSupporting: nonSupportingElements});
			}
			
			function allSupportsToMini()
			{
				return $('.supportParagraph:visible').toggle("blind", {"easing":"easeInOutCirc"}, "normal", function()
				{
					$(this).parent().removeClass('support');
					$(this).data('state', 'mini');
				});
			}
			
			function allBackgroundsToMini()
			{
				return $('.background').toggle("fade", {"easing":"easeInOutCirc"}, "slow", function()
				{
					$(this).removeClass('background').data('state', 'mini');
				});
			}
			
			function toggleAllEyes(element)
			{
				return $('.allEyesOnly', element).toggle("blind", {"easing":"easeInOutCirc"}, "slow");
			}
			
			function miniToBackground(elements)
			{
				return elements.toggle("fade", {"easing":"easeInOutCirc"}, "slow", function()
				{
					$(this).addClass('background').data('state', 'background');
				});
			}
			
			function miniToSupport(elements, supportSubject)
			{
				elements.addClass('support');
				return $('.' + supportSubject, elements).toggle("blind", {"easing":"easeInOutCirc"}, "fast", function()
				{
					$(this).parent().data('state', 'support');
				});
			}
			
			function supportToMini(elements)
			{
				return $('.supportParagraph:visible', elements).toggle("blind", {"easing":"easeInOutCirc"}, "fast", function()
				{
					$(this).parent().removeClass('support').data('state', 'mini');
				});
			}
			
			function backgroundToMini(elements)
			{
				return elements.toggle("fade", {"easing":"easeInOutCirc"}, "slow", function()
				{
					$(this).removeClass('background').data('state', 'mini');
				});
			}
			
			function updateBreadcrumbs(allEyesElement)
			{
				if(allEyesElement)
				{
					if(allEyesElement.attr('id').match(/skill/))
					{
						var text = $('.skillName', allEyesElement).text();
						crumbs('Skill', text);
						crumbs('Job', 'perfecting ' + text);
					}
					else
					{
						var text = $('.position', allEyesElement).text();
						crumbs('Job', text);
						crumbs('Skill', 'perfected as ' + text);
					}
				}
				else
				{
					crumbs();
				}
			}
			
			function allEyesOn(element)
			{
				var deferredObject = $.Deferred();
				var others = getOthers(element);
				var otherAllEyes = $('.allEyes');
				// Wave 1
				$.when(
					allEyesOff($('.allEyes'))).done(function()
				{
					// Wave 2
					$.when(
						element.addClass('allEyes')).done(function()
					{
						// Wave 3
						$.when(
							toggleAllEyes(element)).done(function()
							{
								$.when(
									miniToBackground(others.nonSupporting),
									updateBreadcrumbs(element)).done(function()
								{
									// Wave 4
									$.when(
										miniToSupport(others.supporting, element.attr('id'))).done(function()
									{
										// Done
										$.when(element.data('state', 'allEyes')).done(function()
										{
											deferredObject.resolve();
										});
									});
								});
							});
					});
				});
				return deferredObject.promise();
			}
			
			function allEyesOff(element)
			{
				var deferredObject = $.Deferred();
				if(element.length != 0)
				{
					var others = getOthers(element);
					// Wave 1
					$.when(
						toggleAllEyes(element),
						supportToMini(others.supporting),
						updateBreadcrumbs()).done(function()
					{
						// Wave 2
						$.when(
							backgroundToMini(others.nonSupporting),
							element.removeClass('allEyes')).done(function()
						{
							// Done
							$.when(
								element.data('state', 'mini')).done(function()
							{
								deferredObject.resolve();
							});
						});
					});
				}
				else
				{
					deferredObject.resolve();
				}
				
				return deferredObject.promise();
			}
			
			function clickOnElementHeader(element)
			{
				switch(element.data('state'))
				{
					case 'background':
						// Background being invisible, it should be impossible to get here.
						log("Problems afoot! How did you click on a background element?");
						break;
					case 'allEyes':
						if(!window.preventAction)
						{
							window.preventAction = true;
							$.when(allEyesOff(element)).done(function()
							{
								window.preventAction = false;
							});
						}
						break;
					case 'mini':
					case 'support':
					default:
						// No state is assumed to be mini
						if(!window.preventAction)
						{
							window.preventAction = true;
							$.when(allEyesOn(element)).done(function()
							{
								window.preventAction = false;
							});
						}
						break;
				}
			}
			
			function getLinkInfo()
			{
				$.ajax({
					type: "GET",
					url: "linkInfo.php"
				}).done(function(msg)
				{
					var data = $.parseJSON(msg), dataLength = data.length;
					for(var i = 0; i < dataLength; ++i)
					{
						var skillID = "skill_" + data[i].skill;
						var jobID = "job_" + data[i].job;
						var skillDescription = "<p class=\"supportParagraph " + skillID + "\">" + data[i].description + "</p>";
						var jobDescription = "<p class=\"supportParagraph " + jobID + "\">" + data[i].description + "</p>";
						var skillElement = $('#' + skillID);
						var jobElement = $('#' + jobID);
						$('.allEyesOnly', skillElement).after(jobDescription);
						$('.allEyesOnly', jobElement).after(skillDescription);
						
						if(skillElement.data('linkedTo'))
						{
							skillElement.data('linkedTo').push(jobID);
						}
						else
						{
							skillElement.data('linkedTo', new Array(jobID));
						}
						
						if(jobElement.data('linkedTo'))
						{
							jobElement.data('linkedTo').push(skillID);
						}
						else
						{
							jobElement.data('linkedTo', new Array(skillID));
						}
					}
					
					$('.supportParagraph').toggle();
				});
			}

			$(document).ready(function()
			{
				$('.slideshow').each(function() {
					var slideshow = $(this);
					var nbSlides = slideshow.children().length;
					if(nbSlides > 1)
					{
						$('.prev', slideshow.parent()).removeClass("hidden-accessible");
						$('.next', slideshow.parent()).removeClass("hidden-accessible");
					}
					var parent = slideshow.parent();
					if(slideshow.hasClass('referralList'))
					{
						slideshow.height($(slideshow.children().get()[0]).height());
					}
					slideshow.cycle({
						fx: 'scrollHorz',
						easing: 'easeInOutCirc',
						timeout: 0,
						nowrap: 1,
						prev: $('.prev', parent),
						next: $('.next', parent),
						before: onBefore,
						after: onAfter
					});
				});

				// TODO: Remove the need for this
				window.preventAction = false;
				
				$('.job .header').add($('.skill .header')).each(function()
				{
					var element = $(this).parent();
					
					// Hide allEyesOnly content
					$('.allEyesOnly', element).toggle();
					
					$(this).click(function()
					{
						clickOnElementHeader(element);
					});
				});
				
				getLinkInfo();
			});
		</script>
	</head>
	<body>
		<div id="header">
			<h1>iCV: <a class="emailLink" href="mailto:shawninder@gmail.com" title="Write me an e-mail">Shawn Inder</a></h1>
		</div>
		
		<!--<div class=\"slideshowWrapper\">
			<span class=\"prev hidden-accessible\"><img src=\"images/prev.png\" alt=\"Previous\" /></span>
			<ul class="slideshow">
				<li><img class="PortraitPicture" src="images/shawn.jpg" alt="A picture of Shawn Inder" /></li>
			</ul>
			<img class=\"next hidden-accessible\" src=\"images/next.png\" alt=\"Next\" />
		</div>-->

		<div id="interactiveCV">
			<div id="CVcontainer">
				<div id="jobList" class="half">
					<h2 class="breadcrumbs jobCrumbs">Jobs</h2>
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
								$endDate = ($job['jEndDate'])?$job['jEndDate']:"now";
								
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
										P.firstName as authorFirstName,
										P.lastName as authorLastName
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
												<h3 class=\"header\"><span class=\"position\">" . $job['jTitle'] . "</span> <span class=\"dates\">(" . $job['jStartDate'] . " » " . $endDate . ")</span><div style=\"clear: both;\"></div></h3>
												<div class=\"allEyesOnly\">");

								// Images
								if($nbImages > 0)
								{
									echo("	<div class=\"slideshowWrapper\">
														<span class=\"prev hidden-accessible\">
															<img src=\"images/prev.png\" alt=\"Previous\" />
														</span>
														<ul class=\"slideshow pictureList\">");
									while($image = mysql_fetch_array($images))
									{
										echo("		<li><img class=\"profilePicture\" src=\"" . $image['src'] . "\" alt=\"" . $image['description'] . "\" /></li>");
									}
									echo("		</ul>
														<span class=\"next hidden-accessible\">
															<img src=\"images/next.png\" alt=\"Next\" />
														</span>
													</div>");
								}
													
								// Job description
								echo("		<p class=\"jobDescription\">" . $job['jDescription'] . "</p>");
								
								// Referrals
								if($nbReferrals > 0)
								{
									echo("	<div class=\"slideshowWrapper\">
														<span class=\"prev hidden-accessible\">
															<img src=\"images/prev.png\" alt=\"Previous\" />
														</span>
														<ul class=\"slideshow referralList\">");
									while($referral = mysql_fetch_array($referrals))
									{
										echo("		<li>
																<q>" . $referral['excerpt'] . "</q>
																<span class=\"signature\"> - " . $referral['authorFirstName'] . " " . $referral['authorLastName'] . "</span>
															</li>");
									}
									echo("		</ul>
														<span class=\"next hidden-accessible\">
															<img src=\"images/next.png\" alt=\"Next\" />
														</span>
													</div>");
								}
								
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
												<p class=\"footer\">" . $job['oName'] . ", " . $job['oLocation'] . "</p>
											</li>");
							}
						?>
					</ul>
				</div>
				<div id="skillList" class="half">
					<h2 class="breadcrumbs skillCrumbs">Skills</h2>
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
													<div style=\"clear: both;\"></div>
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
	</body>
</html>

