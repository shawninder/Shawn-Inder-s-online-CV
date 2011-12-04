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
						breadcrumbs.html('<a onclick="allToMini();">' + column + 's</a> >> ' + text);					
					}
				}
			}
			
			function toMini(element)
			{
				elementObject = $('#' + element);
				switch( elementObject.data('state') )
				{
					case 'allEyes':
						$('.allEyesOnly', elementObject).toggle("blind", {"easing":"easeInOutCirc"}, "normal", function()
						{
							$('#' + element).removeClass('allEyes');
						});
						crumbs();
						/*$('.expander-icon', elementObject).toggleClass("ui-icon-plusthick")
																							.toggleClass("ui-icon-minusthick");*/
						break;
					case 'referred':
						elementObject.removeClass('referred');
						$('.linkDescription:visible', elementObject).toggle("blind", {"easing":"easeInOutCirc"}, "normal");
							break;
					case 'background':
						elementObject.toggle();
						break;
					case 'mini':
					default:
						break;
				}
				elementObject.data('state', 'mini');
			}
			
			function manyToMini(elements)
			{
				var nbElements = elements.length;
				for(var i = 0; i < nbElements; ++i)
				{
					toMini(elements[i]);
				}
			}
			
			function allToMini()
			{
				var elements = new Array();
				$('.job').add($('.skill')).each(function()
				{
					elements.push($(this).attr('id'));
				});
				manyToMini(elements);
			}
			
			function toReferred(element, referredBy)
			{
				elementObject = $('#' + element);
				switch( elementObject.data('state') )
				{
					case 'allEyes':
					case 'referred':
					case 'background':
						toMini(element);
					case 'mini':
					default:
						elementObject.addClass('referred');
						if(referredBy.match(/skill/))
						{
							$('#skillDescription_' + referredBy, elementObject).toggle("blind", {"easing":"easeInOutCirc"}, "normal");
						}
						else
						{
							$('#jobDescription_' + referredBy, elementObject).toggle("blind", {"easing":"easeInOutCirc"}, "normal");
						}
						break;
				}
				elementObject.data('state', 'referred');
			}
			
			function manyToReferred(elements, referredBy)
			{
				var nbElements = elements.length;
				for(var i = 0; i < nbElements; ++i)
				{
					toReferred(elements[i], referredBy);
				}
			}
			
			function toBackground(element)
			{
				element.toggle();
				element.data('state','background');
			}
			
			function toBackgroundBut(exceptions, referredBy)
			{
				var elements;
				if(referredBy.match(/skill/))
				{
					var elements = $('ul', $('#jobList')).children();
				}
				else
				{
					var elements = $('ul', $('#skillList')).children();
				}
				var nbExceptions = exceptions.length;
				elements.each(function()
				{
					var found = false;
					for(var i = 0; !found && (i < nbExceptions); ++i)
					{
						if(exceptions[i] == $(this).attr('id'))
						{
							found = true;
						}
					}
					if(!found)
					{
						toBackground($(this));
					}
				});
			}
			
			function allToBackground(referredBy)
			{
				var elements;
				if(referredBy.match(/skill/))
				{
					var elements = $('ul', $('#jobList')).children();
				}
				else
				{
					var elements = $('ul', $('#skillList')).children();
				}
				elements.each(function()
				{
					toBackground($(this));
				});
			}
			
			function toAllEyes(element)
			{
				var elementID = element.attr('id');
				allToMini();
				
				// Make this element allEyes
				element.addClass('allEyes');
				$('.allEyesOnly', element).toggle("blind", {"easing":"easeInOutCirc"}, "normal");
				/*$('.expander-icon', element).toggleClass("ui-icon-plusthick")
																		.toggleClass("ui-icon-minusthick");*/

				// Make linked elements 'referred'
				var links = element.data('linkedTo');
				if(links)
				{
					manyToReferred(links, elementID);
				}
				
				if(links)
				{
					toBackgroundBut(links, elementID);
				}
				else
				{
					allToBackground(elementID);
				}
				
				if(elementID.match(/skill/))
				{
					var text = $('.skillName', element).text();
					crumbs('Skill', text);
					crumbs('Job', 'perfecting ' + text);
				}
				else
				{
					var text = $('.position', element).text();
					crumbs('Job', text);
					crumbs('Skill', 'perfected as ' + text);
				}
				
				// Done
				element.data('state', 'allEyes');
			}
			
			function getLinkInfo()
			{
				$.ajax({
					type: "GET",
					url: "linkInfo.php"
				}).done(function(msg)
				{
					var data = $.parseJSON(msg);
					var dataLength = data.length;
					for(var i = 0; i < dataLength; ++i)
					{
						var skill = data[i].skill;
						var skillID = "skill_" + skill;
						var job = data[i].job;
						var jobID = "job_" + job;
						var skillDescription = "<p id=\"skillDescription_" + skillID + "\" class=\"linkDescription\">" + data[i].description + "</p>";
						var jobDescription = "<p id=\"jobDescription_" + jobID + "\" class=\"linkDescription\">" + data[i].description + "</p>";
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
							var newData = new Array(jobID);
							skillElement.data('linkedTo', newData);
						}
						
						if(jobElement.data('linkedTo'))
						{
							jobElement.data('linkedTo').push(skillID);
						}
						else
						{
							var newData = new Array(skillID);
							jobElement.data('linkedTo', newData);
						}
					}
					$('.linkDescription').toggle();
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

				var expanders = $('.job .header').add($('.skill .header'));
				expanders.each(function()
				{
					var element = $(this).parent();
					var elementID = element.attr('id');
					$('.allEyesOnly', element).toggle();
					$(this).click(function()
					{
						switch( element.data('state') )
						{
							case 'allEyes':
								allToMini();
								break;
							case 'background':
							case 'mini':
							case 'referred':
							default:
								toAllEyes(element);
								break;
						}
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
		
		<ul id="moreOptions">
			<li><a>Version Française</a></li>
			<li><a>Print current view</a></li>
			<li><a>Download CV</a></li>
		</ul>
		
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
					<h2 class="breadcrumbs">Jobs</h2>
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
					<h2 class="breadcrumbs">Skills</h2>
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
	</body>
</html>

