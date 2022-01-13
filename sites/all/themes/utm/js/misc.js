(function($, Drupal, window, document){
	'use strict';
	Drupal.behaviors.my_custom_behavior = {
		attach: function(context, settings){



//nav



			$('#btn-map').click(function(){
				$(this).toggleClass('on');
				$('body').toggleClass('overlay-map-on');
			});
			$('#btn-nav').click(function(){
				$(this).toggleClass('on');
				$('body').toggleClass('overlay-nav-on');
			});



//swiper



			var swiper = {};
			function carousel_build(swiper_id){
				swiper[swiper_id] = new Swiper('.swiper-container.'+swiper_id,{
					slidesPerView: 'auto',
					loop: false,
					grabCursor: true,
					navigation: {
						nextEl: '.swiper-btn.next.'+swiper_id,
						prevEl: '.swiper-btn.prev.'+swiper_id,
					},
					pagination: {
						el: '.swiper-pagination.'+swiper_id,
						type: 'progressbar',
					},
				});
				swiper[swiper_id].on('slideChangeTransitionEnd', function(){
					var has_video = $('.swiper-container.'+swiper_id).find('.swiper-slide-active').find('video');
					if(has_video.length > 0){
						has_video.attr('autoplay', 'autoplay').trigger('play');
					} else{
						$('.swiper-container.'+swiper_id).find('video').trigger('pause').removeAttr('autoplay');
					}
				});
			}
			function carousel(){
				if($('.swiper-container').length > 0){
					$('.swiper-container').each(function(index){
						carousel_build($(this).attr('data-id'));
					});
				}
			}
			carousel();



//lazy load fx



			$('.lazy-load[data-uri]').each(function(){
				var e = $(this);
				var n = new Image();
				n.src = e.attr('data-uri');
				n.onload = function(){
					e.find('.outer').css('background-image', 'url('+n.src+')');
					e.find('.inner .reg>div').html('<img src="'+n.src+'"/>');
					if(e.is('[data-uri-mob]')){
						var s = new Image();
						s.onload = function(){
							e.find('.inner .mob>div').html('<img src="'+s.src+'"/>');
						}
						s.onerror = function(){
							e.find('.inner .mob>div').html('<img src="'+n.src+'"/>');
						}
						s.src = e.attr('data-uri-mob');
					}
					e.addClass('loaded');
				}
				n.onerror = function(){
					e.addClass('failed');
				}
			});
			$('.block-header[data-uri]').each(function(){
				var e = $(this);
				var n = new Image();
				n.src = e.attr('data-uri');
				n.onload = function(){
					e.css('background-image', 'url('+n.src+')').addClass('loaded');
				}
			});



//fold fx



			$('.fold a').click(function(){
				var e = $(this).siblings('.fold-toggle');
				if(e.hasClass('fold-toggle-hidden')){
					e.slide_down_transition();
					$(this).addClass('on');
				} else{
					e.slide_up_transition();
					$(this).removeClass('on');
				}
			});
			$.fn.slide_up_transition = function(){
				return this.each(function(){
					var $el = $(this);
					$el.css('max-height', '0');
					$el.addClass('fold-toggle-hidden');
				});
			};
			$.fn.slide_down_transition = function(){
				return this.each(function(){
					var $el = $(this);
					$el.removeClass('fold-toggle-hidden');
					$el.css('max-height', 'none');
					var height = $el.outerHeight();
					$el.css('max-height', '0');
					setTimeout(function(){
						$el.css({
							'max-height': height
						});
					}, 1);
				});
			};



//update lang menu



			if($('article').attr('data-nl')){
				$('#menu-lang').find('a.nl').attr('href', $('article').attr('data-nl'));
			}
			if($('article').attr('data-en')){
				$('#menu-lang').find('a.en').attr('href', $('article').attr('data-en'));
			}



//index quick search



			$('input[name="index-search"]').keyup(function(e){
				var d = $(this).parent('div');
				var v = $(this).val();
				if(e.keyCode == 13){
					$(this).blur();
				} else{
					if(v.length > 0){
						d.find('.index').each(function(){
							$(this).toggleClass('hide', (~$(this).text().toLowerCase().indexOf(v.toLowerCase()) ? false : true));
						});
						d.find('.index-section').each(function(){
							$(this).toggleClass('hide', ($(this).find('.index:not(.hide)').length > 0 ? false : true));
						});
						d.find('.index-no-result').toggleClass('show', (d.find('.index:not(.hide)').length > 0 ? false : true));
					} else{
						d.find('.index-section,.index').removeClass('hide');
					}
				}
			});



//story overlay



			var save_path = false;
			function slides_preload(){
				$('#pop .slide-load[data-uri]').each(function(){
					var e = $(this);
					var n = new Image();
					n.src = e.attr('data-uri');
					n.onload = function(){
						e.css('background-image', 'url('+n.src+')').addClass('loaded');
					}
				});
			}
			function node_pop_end(){
				$('body').removeClass('overlay-pop-on');
				history.pushState(null, null, (save_path ? save_path : base_path));
				setTimeout(function(){
					$('#pop').html('');
				}, 600);
			}
			function node_pop(t, n){
				$('body').addClass('overlay-pop-on');
				setTimeout(function(){
					window.xhr = $.get(base_path+'pop/'+t+'/'+n).done(function(data){
						$('#pop').html(data);
						var new_swiper = $('#pop').find('.swiper-container').attr('data-id');
						carousel_build(new_swiper);
						slides_preload();
						$('body').addClass('overlay-pop-on');
					}).fail(function(){
						node_pop_end();
					});
				}, 600);
			}
			$(document).on('click', 'a[data-pop][data-nid]', function(e){
				e.preventDefault();
				if(typeof(history.pushState) != 'undefined'){
					save_path = window.location.pathname;
					history.pushState(null, null, $(this).attr('href'));
					node_pop($(this).attr('data-pop'), $(this).attr('data-nid'));
				} else{
					window.location.href = $(this).attr('href');
				}
			});
			$(document).on('click', 'a.pop-end', function(){
				node_pop_end();
			});
			$(window).bind('popstate', function(){
				window.location.href = window.location.href;
			});



//message fx



			if($('.messages').length > 0){
				var msg_hide = setTimeout(function(){
					$('.messages').addClass('hide');
				}, 8000);
			}
		}
	};
})(jQuery, Drupal, this, this.document);