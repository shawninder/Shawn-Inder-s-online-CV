function log() {
	window.console && console.log && console.log('[log] ' + Array.prototype.join.call(arguments,' '));
	return true;
}

function getOthers(element)
{
	var supportingIDs = element.data('linkedTo'), nbSupportingIDs = (supportingIDs)?supportingIDs.length:0;
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
	return $('.allEyesOnly', element).toggle('blind', {easing:"easeInOutCirc"}, 100);
}

function miniToBackground(elements)
{
	if(elements)
	{
		return elements.toggle('fade', 500, function()
		{
			$(this).addClass('background').data('state', 'background');
		});
	}
	else
	{
		return $(this).addClass('background').data('state', 'background');
	}
}

function miniToSupport(elements, supportSubject)
{
	if(elements)
	{
		elements.addClass('support');
		return $('.' + supportSubject, elements).toggle("blind", {"easing":"easeInOutCirc"}, 100, function()
		{
			$(this).parent().data('state', 'support');
		});
	}
	else
	{
		return $(this).parent().data('state', 'support');
	}
}

function supportToMini(elements)
{
	if(elements)
	{
		return $('.supportParagraph:visible', elements).toggle("blind", {"easing":"easeInOutCirc"}, 100, function()
		{
			$(this).parent().removeClass('support').data('state', 'mini');
		});
	}
	else
	{
		return $(this).parent().removeClass('support').data('state', 'mini');
	}
}

function backgroundToMini(elements)
{
	if(elements)
	{
		return elements.toggle("fade", {"easing":"easeInOutCirc"}, 500, function()
		{
			$(this).removeClass('background').data('state', 'mini');
		});
	}
	else
	{
		return $(this).removeClass('background').data('state', 'mini');
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
		var breadcrumbs = $('.' + column.toLowerCase() + 'Crumbs');
		if(!text)
		{
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
	element.addClass('pendingAllEyes');
	$.when(allEyesOff($('.allEyes'))).done(function()
	{
		element.addClass('allEyes').removeClass('pendingAllEyes');
		// Wave 2
		$.when(toggleAllEyes(element),
			miniToBackground(others.nonSupporting)).done(function()
		{
			updateBreadcrumbs(element);
			// Wave 3
			$.when(miniToSupport(others.supporting, element.attr('id'))).done(function()
			{
				// Done
				element.data('state', 'allEyes');
				deferredObject.resolve();
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
			element.removeClass('allEyes');
			updateBreadcrumbs();
			// Wave 2
			$.when(
				backgroundToMini(others.nonSupporting).delay(200)).done(function()
			{
				// Done
				element.data('state', 'mini');
				deferredObject.resolve();
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

function afterSliding(slideshow)
{
	var currSlide = slideshow.data('currSlide');
	if(currSlide.prev().length == 0)
	{
		$('.prev', slideshow.parent()).addClass("hidden-accessible");
	}
	else
	{
		$('.prev', slideshow.parent()).removeClass("hidden-accessible");
	}
	if(currSlide.next().length == 0)
	{
		$('.next', slideshow.parent()).addClass("hidden-accessible");
	}
	else
	{
		$('.next', slideshow.parent()).removeClass("hidden-accessible");
	}
}

function prevSlide(slideshow)
{
	var currSlide = slideshow.data('currSlide');
	if(currSlide.prev().length != 0)
	{
		slideshow.data('currSlide', currSlide.toggle().prev().toggle());
	}
	afterSliding(slideshow);
}

function nextSlide(slideshow)
{
	var currSlide = slideshow.data('currSlide');
	if(currSlide.next().length != 0)
	{
		slideshow.data('currSlide', currSlide.toggle().next().toggle());
	}
	afterSliding(slideshow);
}

$(document).ready(function()
{
	$('.slideshow').each(function() {
		var slideshow = $(this);
		var slides = slideshow.children();
		var nbSlides = slides.length;
		
		if(nbSlides > 1)
		{
			slides.not(slides.first()).toggle();
			slideshow.data('currSlide', slides.first());
			var parent = slideshow.parent();
			$('.prev', parent).click(function()
				{
					prevSlide(slideshow);
				});
			$('.next', parent).click(function()
				{
					nextSlide(slideshow);
				});
			afterSliding(slideshow);
		}
	});

	window.preventAction = false;
	
	$('.job .header').add($('.skill .header')).each(function()
	{
		var element = $(this).parent();
		
		$('.allEyesOnly', element).toggle();
		
		$(this).click(function()
		{
			clickOnElementHeader(element);
		});
	});
	
	getLinkInfo();
});
