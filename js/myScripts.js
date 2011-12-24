function log() {
	window.console && console.log && console.log('[log] ' + Array.prototype.join.call(arguments,' '));
	return true;
}

function getOthers(element)
{
	var supportingIDs = element.data('linkedTo'), nbSupportingIDs = (supportingIDs)?supportingIDs.length:0;
	var elements = (element.attr('id').match(/skill/))?$('ul', $('.experienceList')).children():$('ul', $('.skillList')).children();
	
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
	return $('.supportParagraph:visible').toggle('blind', {'easing':'easeInOutCirc'}, 'fast', function()
	{
		$(this).parent().removeClass('support');
		$(this).data('state', 'mini');
	});
}

function allBackgroundsToMini()
{
	return $('.background').toggle().removeClass('background').data('state', 'mini');
}

function toggleAllEyes(element)
{
	return $('.allEyesOnly', element).toggle('blind', {easing:'easeInOutCirc'}, 'fast');
}

function miniToBackground(elements)
{
	if(elements)
	{
		return elements.toggle('fade', {easing: 'easeInOutCirc'}, 'fast', function()
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
		return $('.' + supportSubject, elements).toggle('blind', {easing:'easeInOutCirc'}, 'fast', function()
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
		return $('.supportParagraph:visible', elements).toggle('blind', {easing:'easeInOutCirc'}, 'fast', function()
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
	return elements.toggle().removeClass('background').data('state', 'mini');
}

function crumbs(column, text)
{
	if(!column)
	{
		crumbs('Experience');
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
			breadcrumbs.html('<a href="index.php" onclick="actIfOk(allEyesOff, $(\'.allEyes\')); return false;">' + column + 's</a> >> ' + text);					
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
			crumbs('Experience', 'perfecting ' + text);
		}
		else
		{
			var text = $('.position', allEyesElement).text();
			crumbs('Experience', text);
			crumbs('Skill', 'perfected as ' + text);
		}
	}
	else
	{
		crumbs();
	}
}

function prepareSlideshows(element)
{
	$('.slideshow', element).each(function() {
		var slideshow = $(this);
		var slides = slideshow.children();
		var nbSlides = slides.length;
		
		if(nbSlides > 1)
		{
			slides.not(slides.first()).hide();
			slides.first().show();
			slideshow.data('currSlide', slides.first());
			afterSliding(slideshow);
		}
	});
}

function allEyesOn(element)
{
	var deferredObject = $.Deferred();
	var others = getOthers(element);
	var otherAllEyes = $('.allEyes');
	// Wave 1
	element.addClass('pendingAllEyes');
	$.when(allEyesOff(otherAllEyes)).done(function()
	{
		element.addClass('allEyes').removeClass('pendingAllEyes');
		// Wave 2
		$.when(toggleAllEyes(element),
			miniToBackground(others.nonSupporting).delay('fast')).done(function()
		{
			prepareSlideshows(element);
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
			supportToMini(others.supporting).delay('fast')).done(function()
		{
			element.removeClass('allEyes');
			updateBreadcrumbs();
			// Wave 2
			$.when(
				backgroundToMini(others.nonSupporting).delay('fast')).done(function()
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
			var experienceID = "experience_" + data[i].experience;
			var skillDescription = "<p class=\"supportParagraph " + skillID + "\">" + data[i].description + "</p>";
			var experienceDescription = "<p class=\"supportParagraph " + experienceID + "\">" + data[i].description + "</p>";
			var skillElement = $('#' + skillID);
			var experienceElement = $('#' + experienceID);
			$('.allEyesOnly', skillElement).after(experienceDescription);
			$('.allEyesOnly', experienceElement).after(skillDescription);
			
			if(skillElement.data('linkedTo'))
			{
				skillElement.data('linkedTo').push(experienceID);
			}
			else
			{
				skillElement.data('linkedTo', new Array(experienceID));
			}
			
			if(experienceElement.data('linkedTo'))
			{
				experienceElement.data('linkedTo').push(skillID);
			}
			else
			{
				experienceElement.data('linkedTo', new Array(skillID));
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

function changeSlides(slideshow, currSlide, nextSlide, slideOutDir, slideInDir)
{
	if(nextSlide.length != 0)
	{
		$.when(currSlide.toggle(),
			nextSlide.toggle()).done(function()
		{
			slideshow.data('currSlide', nextSlide);
			afterSliding(slideshow);
		});
	}
}

function prevSlide(slideshow)
{
	var currSlide = slideshow.data('currSlide');
	var nextSlide = currSlide.prev();
	changeSlides(slideshow, currSlide, nextSlide, 'right', 'left');
}

function nextSlide(slideshow)
{
	var currSlide = slideshow.data('currSlide');
	var nextSlide = currSlide.next();
	changeSlides(slideshow, currSlide, nextSlide, 'left', 'right');
}

$(document).ready(function()
{
	window.dontTouchDownloadMenu = false;
	window.preventAction = true;
	var downloadLink = $('#downloadLink');
	var downloadMenu = $('#downloadMenu');
	downloadMenu.hide();
	downloadLink.attr('title', '').click(function(event)
	{
		event.stopPropagation();
		return false;
	}).hover(function()
	{
		downloadMenu.show();
	}, function()
	{
		setTimeout(function()
		{
			if(!window.dontTouchDownloadMenu)
			{
				downloadMenu.hide();
			}
		}, 200);
	});
	downloadMenu.hover(function()
	{
		window.dontTouchDownloadMenu = true;
	}, function()
	{
		setTimeout(function()
		{
			if(!window.dontTouchDownloadMenu)
			{
				downloadMenu.hide();
			}
		}, 200);
		window.dontTouchDownloadMenu = false;
	});
	$('.slideshow').each(function() {
		var slideshow = $(this);
		var slides = slideshow.children();
		var nbSlides = slides.length;
		
		if(nbSlides > 1)
		{
			slideshow.height(Math.max.apply(Math, slides.map(function(){
				return $(this).height();
			}).get()));
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
	
	$('.experience .header a').add($('.skill .header a')).each(function()
	{
		var element = $(this).parent().parent();
		
		$(this).click(function()
		{
			clickOnElementHeader(element);
			$(this).blur();
			return false;
		});
		
		$('.allEyesOnly', element).toggle();
		
		$(this).addClass('scriptEnabled');
	});
	
	getLinkInfo();
	window.preventAction = false;
});
