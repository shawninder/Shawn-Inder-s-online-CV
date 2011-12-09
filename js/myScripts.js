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

function getOthers(element)
{
	var supportingIDs = element.data('linkedTo'), nbSupportingIDs = supportingIDs.length;

	var elements = (element.attr('id').match(/skill/))?$('ul', $('.jobList')).children():$('ul', $('.skillList')).children();
	
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

function crumbs(column, text)
{
	if(!column)
	{
		crumbs('Job');
		crumbs('Skill');
	}
	else
	{
		var breadcrumbs = $('.' + column.toLowerCase() + 'Crumbs');
		if(!text)
		{
			// Back to default
			breadcrumbs.text(column + "s");
		}
		else
		{
			breadcrumbs.html('<a onclick="actIfOk(allEyesOff, $(\'.allEyes\'));">' + column + 's</a> >> ' + text);					
		}
	}
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
						miniToBackground(others.nonSupporting)).done(function()
					{
						// Wave 4
						$.when(
							miniToSupport(others.supporting, element.attr('id')),
							updateBreadcrumbs(element)).done(function()
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
			supportToMini(others.supporting)).done(function()
		{
			// Wave 2
			$.when(
				backgroundToMini(others.nonSupporting),
				updateBreadcrumbs(),
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

function actIfOk(f, arg)
{
	if(!window.preventAction)
	{
		window.preventAction = true;
		$.when(f(arg)).done(function()
		{
			window.preventAction = false;
		});
	}
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
			actIfOk(allEyesOff, element);
			break;
		case 'mini':
		case 'support':
		default:
			// No state is assumed to be mini
			actIfOk(allEyesOn, element);
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
