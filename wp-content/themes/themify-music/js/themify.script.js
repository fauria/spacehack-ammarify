;// Themify Theme Scripts - http://themify.me/

// Initialize object literals
var FixedHeader = {},
	ThemifyEqualHeight = {},
	ThemifyTabs = {},
	ThemifyShortest = {},
	ThemifySlider = {},
	ThemifyVideo = {},
	ThemifyParallax = {};

/////////////////////////////////////////////
// jQuery functions					
/////////////////////////////////////////////
(function($){

	// Test if touch event exists //////////////////////////////
	function is_touch_device() {
		return $('body').hasClass('istouch');
	}

	// Fixed Header /////////////////////////
	FixedHeader = {
		init: function() {
			if( '' != themifyScript.fixedHeader ) {
				var cons = is_touch_device() ? 10 : parseInt( themifyScript.fixedHeaderHeightCons );
				FixedHeader.headerHeight = $('#headerwrap').height() - cons;
				this.activate();
				$(window).on('scroll touchstart.touchScroll touchmove.touchScroll', this.activate);
			}
		},
		activate: function() {
			var $window = $(window),
				scrollTop = $window.scrollTop();
			if( scrollTop > FixedHeader.headerHeight ) {
				FixedHeader.scrollEnabled();
			} else {
				FixedHeader.scrollDisabled();
			}
		},
		scrollDisabled: function() {
			$('#headerwrap').removeClass('fixed-header');
			$('#header').removeClass('header-on-scroll');
			$('body').removeClass('fixed-header-on');
		},
		scrollEnabled: function() {
			$('#headerwrap').addClass('fixed-header');
			$('#header').addClass('header-on-scroll');
			$('body').addClass('fixed-header-on');
		}
	};

	// Equal height for Content and Sidebar ////////////////////////
	ThemifyEqualHeight = {
		$content: $('#content'),
		$sidebar: $('#sidebar'),
		contentMarginTop: 10,
		smallScreen: 0,
		resizeRefresh: 0,

		init: function( smallScreen, resizeRefresh ) {
			this.smallScreen = parseInt( smallScreen, 10 );
			this.resizeRefresh = parseInt( resizeRefresh, 10 );

			this.contentMarginTop = parseInt( this.$content.css( 'margin-top' ).replace(/-/, '').replace(/px/, ''), 10 );

			var didResize = false;

			if ( ! this.isSmallScreen() ) {
				this.setHeights();
			}

			$(window).resize(function() {
				didResize = true;
			});

			setInterval(function() {
				if ( didResize ) {
					didResize = false;
					if ( ! ThemifyEqualHeight.isSmallScreen() ) {
						ThemifyEqualHeight.setHeights();
					} else {
						ThemifyEqualHeight.$content.css( 'height', 'auto' );
						ThemifyEqualHeight.$sidebar.css( 'height', 'auto' );
					}
				}
			}, ThemifyEqualHeight.resizeRefresh);
		},

		isSmallScreen: function() {
			return $(window).width() <= this.smallScreen;
		},

		setHeights: function() {
			if ( Math.floor( this.$content.innerHeight() ) - this.contentMarginTop > Math.floor( this.$sidebar.innerHeight() ) ) {
				this.$sidebar.innerHeight( Math.floor( this.$content.innerHeight() ) );
			} else {
				this.$content.innerHeight( Math.floor( this.$sidebar.innerHeight() ) + this.contentMarginTop );
			}
		}
	};

	ThemifyTabs = {
		init: function( tabset, suffix ) {
			$( tabset ).each(function(){
				var $tabset = $(this);

				$('.htab-link:first', $tabset).addClass('current');
				$('.btab-panel:first', $tabset).show();

				$( $tabset ).on( 'click', '.htab-link', function(e){
					e.preventDefault();

					var $a = $(this),
						tab = '.' + $a.data('tab') + suffix,
						$tab = $( tab, $tabset );

					$( '.htab-link', $tabset ).removeClass('current');
					$a.addClass('current');

					$( '.btab-panel', $tabset ).hide();
					$tab.show();

					$(document.body).trigger( 'themify-tab-switched', $tab );
				});
			});
		}
	};

	ThemifyShortest = {
		init: function($context, area) {
			this.setShortest( $context, area );
			$(window).on('resize', function(){
				ThemifyShortest.setShortest( $context, area );
			});
		},

		setShortest: function($context, area) {
			var imgs = $('img', $context),
				shortestImg = 999999;

			imgs.each(function () {
				var $img = $(this),
					imgHeight = $img.outerHeight();
				shortestImg = shortestImg <= imgHeight ? shortestImg : imgHeight;
			});

			imgs.each(function () {
				var $img = $(this),
					imgHeight = $img.outerHeight();
				$img.css('marginTop', -Math.abs(imgHeight - shortestImg)/2);
			});

			if ( 600 >= $(window).width() ) {
				$context.css('height', '');
			} else {
				$context.height(shortestImg);	
			}
			
			if ( 'video' == area ) {
				$('.slideshow, .caroufredsel_wrapper, .carousel-prev, .carousel-next', $context).height(shortestImg);
			} else {
				$('.post-image', $context).height(shortestImg);
			}
		}
	};

	ThemifySlider = {
		recalcHeight: function(items, $obj) {
			var heights = [], height;
			$.each( items, function() {
				heights.push( $(this).outerHeight(true) );
			});
			height = Math.max.apply( Math, heights );
			$obj.closest('.carousel-wrap').find( '.caroufredsel_wrapper, .slideshow' ).each(function(){
				$(this).outerHeight( height );
			});
		},
		didResize: false,
		// Initialize carousels
		create: function(obj) {
			var self = this;
			obj.each(function() {
				var $this = $(this),
					$sliderWrapper = $this.closest('.loops-wrapper.slider');
				// Start Carousel
				$this.carouFredSel({
					responsive : true,
					prev : $this.data('slidernav') && 'yes' == $this.data('slidernav') ? '#' + $this.data('id') + ' .carousel-prev' : '',
					next: $this.data('slidernav') && 'yes' == $this.data('slidernav') ? '#' + $this.data('id') + ' .carousel-next' : '',
					pagination : {
						container : $this.data('pager') && 'yes' == $this.data('pager') ? '#' + $this.data('id') + ' .carousel-pager' : ''
					},
					circular : true,
					infinite : true,
					swipe: true,
					scroll : {
						items : $this.data('scroll')? parseInt( $this.data('scroll'), 10 ) : 1,
						fx : $this.data('effect'),
						duration : parseInt($this.data('speed')),
						onBefore: function() {
							var pos = $(this).triggerHandler( 'currentPosition' );
							$('#' + $this.data('thumbsid') + ' a').removeClass( 'selected' );
							$('#' + $this.data('thumbsid') + ' a.itm'+pos).addClass( 'selected' );
							var page = Math.floor( pos / 3 );
							$('#' + $this.data('thumbsid')).trigger( 'slideToPage', page );
						}
					},
					auto : {
						play : !!('off' != $this.data('autoplay')),
						timeoutDuration : 'off' != $this.data('autoplay') ? parseInt($this.data('autoplay')) : 0
					},
					items : {
						visible : {
							min : 1,
							max : $this.data('visible')? parseInt( $this.data('visible'), 10 ) : 1
						},
						width : 222,
						height: 'variable'
					},
					onCreate : function( items ) {

						$(window).resize(function() {
							self.didResize = true;
						});
						setInterval(function() {
							if ( self.didResize ) {
								self.didResize = false;
								self.recalcHeight(items.items, $this);
							}
						}, 250);

						$this.closest('.slideshow-wrap').css({
							'visibility' : 'visible',
							'height' : 'auto'
						});
						$this.closest('.loops-wrapper.slider').css({
							'visibility' : 'visible',
							'height' : 'auto'
						});

						if ( $sliderWrapper.hasClass('video') ) {
							ThemifyShortest.init( $this );
						}
						if ( $this.data('slidernav') && 'yes' != $this.data('slidernav') ) {
							$('#' + $this.data('id') + ' .carousel-next').remove();
							$('#' + $this.data('id') + ' .carousel-prev').remove();
						}
						$(window).resize();
						$('.slideshow-slider-loader', $this.closest('.slider')).remove(); // remove slider loader
					}
				});
				// End Carousel

			});
		},

		isSmallScreen: function() {
			return $(window).width() <= 905;
		},

		// Initialize carousels
		createGallery: function(obj) {

			var waitForFinalEvent = (function () {
				var timers = {};
				return function (callback, ms, uniqueId) {
					if (timers[uniqueId]) {
						clearTimeout (timers[uniqueId]);
					}
					timers[uniqueId] = setTimeout(callback, ms);
				};
			})();

			$(window).resize(function () {
				waitForFinalEvent(function(){
					obj.each(function() {
						if ( ThemifySlider.isSmallScreen() ) {
							$(this).trigger('configuration', {
									items : {
										visible : {
											min : 1,
											max : 1
										},
										width : 400,
										height: 'variable'
									}
								},
								null,
								true
							);
							$('.type-gallery', $(this)).css({
								'opacity': 1,
								'margin': 0,
								'left': 'auto'
							});
							$(this).trigger('prev');
						} else {
							$(this).trigger('configuration', {
									items : {
										visible : {
											min : 3,
											max : 3
										},
										width : 400,
										height: 'variable'
									}
								},
								null,
								true
							);
							$(this).trigger('next');
							$(this ).delay(500).trigger('next');
						}
					});
				}, 1000, 'themifyuniqueidresize');
			});

			obj.each(function() {
				var $this = $(this),
					$sliderWrapper = $this.closest( '.loops-wrapper.slider' ),
					$builderRow = $this.closest( '.themify_builder_row' ),
					isFirstColor = 1,
					thisSpeed =  parseInt($this.data('speed'), 10 ),
					sliderWidth = $sliderWrapper.width(),
					leftCSS = {
						'width': Math.floor( sliderWidth / 1.5 ),
						'marginLeft':  0,
						'marginRight': -Math.floor( sliderWidth / 2.6 ),
						'opacity': 0.5
					},
					bigCSS = {
						'width': Math.floor( sliderWidth / 1.2 ),
						'marginLeft':  -Math.floor( sliderWidth / 5 ),
						'marginRight': -Math.floor( sliderWidth / 5 ),
						'opacity': 1
					},
					rightCSS = {
						'width': Math.floor( sliderWidth / 1.5 ),
						'marginLeft':  0,
						'marginRight': 0,
						'opacity': 0.5
					},
					aniOpts = {
						queue: false,
						duration: thisSpeed/1.5
					},
					aniOptsBig =  {
						queue: false,
						duration: thisSpeed
					}
					;

				$this.carouFredSel({
					responsive : true,
					prev : '#' + $this.data('id') + ' .carousel-prev',
					next : '#' + $this.data('id') + ' .carousel-next',
					pagination : {
						container : '#' + $this.data('id') + ' .carousel-pager'
					},
					circular : true,
					infinite : true,
					swipe: true,
					scroll : {
						items : 1,
						fx : 'scroll',
						duration : thisSpeed,
						onBefore : function( items ) {
							var newItems = items.items.visible;
							if ( ! ThemifySlider.isSmallScreen() ) {
								sliderWidth = $sliderWrapper.width();
								leftCSS = {
									'width': Math.floor( sliderWidth / 1.5 ),
									'marginLeft':  0,
									'marginRight': -Math.floor( sliderWidth / 3 ),
									'opacity': 0.5
								};
								bigCSS = {
									'width': Math.floor( sliderWidth / 1.2 ),
									'marginLeft':  -Math.floor( sliderWidth / 4.5 ),
									'marginRight': -Math.floor( sliderWidth / 5 ),
									'left': -Math.floor( sliderWidth / 32 ),
									'opacity': 1
								};
								rightCSS = {
									'width': Math.floor( sliderWidth / 1.5 ),
									'marginLeft':  0,
									'marginRight': 0,
									'opacity': 0.5
								};

								newItems.eq(0)
									.addClass('gallerySlide')
									.removeClass('galleryBigSlide')
									.animate(leftCSS, aniOpts);

								newItems.eq(1)
									.addClass('galleryBigSlide')
									.removeClass('gallerySlide')
									.animate(bigCSS, aniOptsBig);

								newItems.eq(2)
									.addClass('gallerySlide')
									.removeClass('galleryBigSlide')
									.animate(rightCSS, aniOpts);
							}

						},
						onAfter : function( items ) {
							var newItems = items.items.visible;
							var $first = $('.post-image img', newItems.filter(':visible').eq(1));
							$sliderWrapper.css( 'background-color', $first.data('color') );
							$builderRow.css( 'background-color', $first.data('color') );
						}
					},
					auto : {
						play : !!('off' != $this.data('autoplay')),
						timeoutDuration : 'off' != $this.data('autoplay') ? parseInt($this.data('autoplay')) : 0
					},
					items : {
						visible : {
							min : ! ThemifySlider.isSmallScreen() ? 3 : 1,
							max : ! ThemifySlider.isSmallScreen() ? 3 : 1
						},
						width : 400,
						height: 'variable'
					},
					onCreate : function(items) {
						items = items.items;
						if ( ! ThemifySlider.isSmallScreen() ) {
							items.addClass('gallerySlide').removeClass('galleryBigSlide').css({
								'width': '',
								'marginLeft': '',
								'marginRight': ''
							});

							items.eq(0).animate(leftCSS, aniOpts);

							items.eq(1).addClass('galleryBigSlide').removeClass('gallerySlide').animate(bigCSS, aniOptsBig);

							items.eq(2).animate(rightCSS, aniOpts);
						}
						$( '.post-image img', $this ).each(function(){
							var $img = $(this),
								src = $img.attr('src' ),
								imageURL = '';
							if ( src.match(/(img\.php)/) ) {
								src = src.split('?src=');
								src = src[1].split('&');
								imageURL = src[0];
							} else {
								imageURL = src;
							}
							RGBaster.colors( imageURL, function(data){
								$img.attr('data-color', data.dominant);

								if ( 0 == isFirstColor && 'undefined' != typeof data.dominant ) {
									isFirstColor = false;
									$sliderWrapper.css( 'background-color', data.dominant );
									$builderRow.css( 'background-color', data.dominant );
								}
								isFirstColor--;
							});
						});

						$this.closest('.slideshow-wrap').css({
							'visibility' : 'visible',
							'height' : 'auto'
						});
						$this.closest('.loops-wrapper.slider').css({
							'visibility' : 'visible',
							'height' : 'auto'
						});
						$('.carousel-next, .carousel-prev', $this.closest('.slideshow-wrap')).empty().show();
						$('.carousel-pager', $this.closest('.slideshow-wrap')).remove();
						
						$('.slideshow-slider-loader', $this.closest('.slider')).remove(); // remove slider loader
					}
				});
			});
		}
	};


	ThemifyVideo = {
		video: [],
		didResize: false,
		ratio: themifyScript.videoRatio,

		init: function( $object ) {
			$object.on('loadeddata', function(e){
				var $video = $(this),
					height = Math.floor( $video.width() / ThemifyVideo.ratio ),
					css = 'width: 100%; height: ' + height + 'px !important;';

				$video.css( 'cssText', css);
				$video.closest('.mejs-container').css( 'cssText', css );

				$('.mejs-layer', $video.closest('.mejs-inner') ).each(function(){
					var $el = $(this);
					$el.attr( 'style', $el.attr('style').replace(/height:(.*?);/, 'height:' + height + 'px !important;') );
				});

				ThemifyVideo.video['#'+$video.attr('id')] = $video;
			});

			this.setHeight();

		},

		onResize: function ( c, t ) {
			onresize = function () {
				clearTimeout( t );
				t = setTimeout( c, 100 );
			};
			return c;
		},

		setHeight: function() {

			this.onResize(function(){

				for( var object in ThemifyVideo.video ) {
					var $video = ThemifyVideo.video[object],
						height = Math.floor( $video.width() / ThemifyVideo.ratio ),
						css = 'width: 100%; height: ' + height + 'px !important;';

					$video.css( 'cssText', css);
					$video.closest('.mejs-container').css( 'cssText', css );

					$('.mejs-layer', $video.closest('.mejs-inner') ).each(function(){
						var $el = $(this);
						$el.attr( 'style', $el.attr('style').replace(/height:(.*?);/, 'height:' + height + 'px !important;') );
					});
				}

			});
		}
	};

	ThemifyParallax = {
		init: function(){
			this.sliderWrapper = ['.single #pagewrap .featured-area'];
			this.lastScrollPoint = 0;

			if(!themifyScript.parallaxHeader) return;
			this.onLoaded();
		},

		onLoaded: function(){
			var self = ThemifyParallax, resizeId;
			$('body').addClass('parallax-header');

			$.each(self.sliderWrapper, function(i,v){
				if($(v).length > 0)	{
					var $layoutWrap = $('#layout');
					$layoutWrap.css('marginTop', $(v).height() );
					$(v).css('top', $('#headerwrap').height());
					
					$(window).on('scroll', function(){
						self.transition(v);
					}).on('touchmove.touchScroll', function(){
						self.transition(v);
					}).on('resize', function(){
						clearTimeout(resizeId);
						resizeId = setTimeout(function(){
							$layoutWrap.css('marginTop', $(v).height() );
							$(v).css('top', $('#headerwrap').height());
						}, 500);
					}).on('orientationchange', function(){
						self.transition(v);
					});
				}
			});

			setTimeout(function(){
				$(window).resize();
			}, 500);
		},

		transition: function(obj){
			var self = ThemifyParallax, $obj = $(obj), $window = $(window), 
				scrollTop = $window.scrollTop(),
				activePoint = Math.ceil($window.height() / 2), n;
			
			if ( scrollTop > activePoint ) {
				n = Math.ceil( scrollTop + (self.lastScrollPoint - scrollTop) / 2);
			} else {
				n = Math.ceil(scrollTop);
				self.lastScrollPoint = scrollTop;
			}
			$obj.css({
				'-webkit-transform' : 'translateY(-'+n+'px)',
				'-moz-transform' : 'translateY(-'+n+'px)',
				'-o-transform' : 'translateY(-'+n+'px)',
				'-ms-transform' : 'translateY(-'+n+'px)',
				'transform' : 'translateY(-'+n+'px)'
			});
		}
	};

	function addClickEventSongTitle() {
		// Bind event so when title is clicked, the song is played.
		$('body').on('click', '.track-title', function(e){
			e.preventDefault();
			$(this).closest('.track').find('.mejs-playpause-button').trigger('click');
		});
	}

	function addPlaylistScrollable() {
		var maxH = ( $(window).height() * 70 ) / 100;
		$('body').find('.album-lightbox .album-container').css({ maxHeight: maxH });
		$('body').find('.album-lightbox .album-playlist').css({ maxHeight: maxH });
	}

	// Set full-height rows to viewport height
	var ThemifyFullHeight = {
		didResize: false,
		selector: '',
		init: function( selector ){
			this.selector = selector;
			$(window).resize(function() {
				ThemifyFullHeight.didResize = true;
			});
			setInterval(function() {
				if ( ThemifyFullHeight.didResize ) {
					ThemifyFullHeight.didResize = false;
					ThemifyFullHeight.resize();
				}
			}, 250);
		},
		resize: function() {
			$(this.selector).each(function(){
				$(this).css({
					'height': $(window).height()
				});
			});
		}
	};

	// DOCUMENT READY
	$(document).ready(function() {

		var $body = $('body');

		// Set full-height rows to viewport height
		if ( navigator.userAgent.match(/(iPad)/g) ) {
			ThemifyFullHeight.init( '.themify_builder_row.full-height' );
		}

		// Scroll to row when a menu item is clicked.
		if ( 'undefined' !== typeof $.fn.themifyScrollHighlight ) {
			$body.themifyScrollHighlight();
		}

		// Set shortest height
		$('.loops-wrapper.video:not(.slider)').not('.list-post, .list-thumb-image, .list-large-image').each(function(){
			ThemifyShortest.init( $(this), 'grids' );
		});

		/////////////////////////////////////////////
		// Scroll to top
		/////////////////////////////////////////////
		$('.back-top a').click(function() {
			$('body,html').animate({ scrollTop: 0 }, 800);
			return false;
		});

		/////////////////////////////////////////////
		// Toggle main nav on mobile
		/////////////////////////////////////////////
		$('#menu-icon').themifySideMenu({
			close: '#menu-icon-close'
		});
                
                var $overlay = $( '<div class="body-overlay">' );
                $body.append( $overlay ).on( 'sidemenushow.themify', function () {
                    $overlay.addClass( 'body-overlay-on' );
                } ).on( 'sidemenuhide.themify', function () {
                    $overlay.removeClass( 'body-overlay-on' );
                } ).on( 'click.themify touchend.themify', '.body-overlay', function () {
                    $( '#menu-icon' ).themifySideMenu( 'hide' );
                } ); 
                
		if ( $(window).width() < 780 ) {
			$('#main-nav').addClass('scroll-nav');
		}

		// Reset slide nav width
		$(window).resize(function(){
		    var viewport = $(window).width();
		    if (viewport > 780) {
		        $('body').removeAttr('style');
			    $('#main-nav').removeClass('scroll-nav');
		    } else {
			    $('#main-nav').addClass('scroll-nav');
		    }
                    if( $( '#menu-icon' ).is(':visible') && $('#mobile-menu').hasClass('sidemenu-on')){
                        $overlay.addClass( 'body-overlay-on' );
                    }
                    else{
                         $overlay.removeClass( 'body-overlay-on' );
                    }
		});

		// Initialize Tabs for Widget ///////////////
		ThemifyTabs.init( '.event-posts', '-events' );

		// Initialize video aspect ratio
		ThemifyVideo.init( $( 'video.wp-video-shortcode' ) );

	});

	// WINDOW LOAD
	$(window).load(function() {
		var $body = $('body');

		// Carousel initialization //////////////////
                var carouselCallBack = function( $context ) {
                    $context = $context || $body;
                    ThemifySlider.create( $( '.loops-wrapper.album .slideshow', $context ) );
                    ThemifySlider.create( $( '.loops-wrapper.press .slideshow', $context ) );
                    ThemifySlider.create( $( '.loops-wrapper.event .slideshow', $context ) );
                    ThemifySlider.create( $( '.loops-wrapper.video .slideshow', $context ) );
                    ThemifySlider.createGallery( $( '.loops-wrapper.gallery .slideshow', $context ) );
                };
                var carouselInit = function( $context ) {
                    if(!$.fn.carouFredSel){
                       Themify.LoadAsync(themify_vars.url+'/js/carousel.js',function(){
                           carouselCallBack($context);
                       });
                    }
                    else{
                       carouselCallBack($context);
                    }    
                };
                if($('.loops-wrapper .slideshow').length>0){
                   carouselInit();
                }
                $body.on('builder_toggle_frontend', function(event, is_edit){
                    carouselInit($(this));
                }).on('builder_load_module_partial', function(event, $newElems){
                    carouselInit($newElems);
                });
		/////////////////////////////////////////////
		// Single Gallery Post Type
		/////////////////////////////////////////////
		if ( $('body.single-gallery').length > 0 && 'undefined' !== typeof $.fn.masonry ) {
			$('.masonry').masonry({
				'itemSelector': '.item'
			});
		}

		// Initialize internal Like button ////////////////
		$(document).on('click', '.likeit', function(e) {
			e.preventDefault();
			var $self = $(this),
				post_id = $self.data('postid');
			$.post(
				themifyScript.ajax_url,
				{
					action: 'themify_likeit',
					nonce : themifyScript.ajax_nonce,
					post_id: post_id
				},
				function(response) {
					data = $.parseJSON(response);
					if( 'new' == data.status ) {
						$('.count', $self).fadeOut('slow', function(){
							$(this).text(data.likers).fadeIn('slow');
						});
						$(this).addClass('likeit_done');
					}
				}
			);
		});

		// Set content and sidebar equal height ///////////
		ThemifyEqualHeight.init(themifyScript.smallScreen, themifyScript.resizeRefresh);

		// Parallax Header ///////////
		if ( 'undefined' !== typeof ThemifyParallax ) {
			ThemifyParallax.init();
		}

		// Fixed header ///////////////////////////////////
		FixedHeader.init();

		// Add click event to song title in playlist //////
		addClickEventSongTitle();

		// make gallery overlay clickable
		$body.on( 'click', '.loops-wrapper.grid4.gallery .post-image + .post-content, .loops-wrapper.grid3.gallery .post-image + .post-content, .loops-wrapper.grid2.gallery .post-image + .post-content', function(e){
			if( $( e.target ).is( 'a' ) || $( e.target ).parent().is( 'a' ) ) return;
			var $link = $( this ).find( '.post-title a' );
			if( $link.length > 0 && ! $link.hasClass( 'themify_lightbox' ) &&  ! $link.hasClass( 'themify-lightbox' ) ) {
				window.location = $link.attr( 'href' );
			}
		});

		// Trigger video lightbox when overlay is clicked
		$('.loops-wrapper.video.grid4, .loops-wrapper.video.grid3, .loops-wrapper.video.grid2, .loops-wrapper.video.slider').each(function(){
			var $self = $(this);
			$self.find('.post-content').prepend('<div class="js-click"></div>');
			$self.find('.js-click').each(function(){
				$(this).on('click', function(e){
					e.preventDefault();
					$(this).closest('article').find('.themify_lightbox').trigger('click');
				});
			});
		});
		if ( $('.wp-audio-shortcode').length > 0 ) {
			$('.wp-audio-shortcode').on('play playing', function(e){
				var $this = $(this);
				$this.closest('.mejs-inner').find('.mejs-currenttime').addClass('visible-currenttime');
			} );
		}

		if ( themifyScript.albumLightbox && 'true' == themifyScript.albumLightbox ) {
			// Trigger album lightbox when overlay is clicked
			$('.loops-wrapper.album.grid4, .loops-wrapper.album.grid3, .loops-wrapper.album.grid2, .loops-wrapper.album.slider').each(function(){
				$(this).find('.post-content').each(function(){
					$(this).on('click', function(){
						$(this).prev().find('.themify-lightbox').trigger('click');
					});
					$(this).find('.album-title-link').on('click', function(e){
						e.stopPropagation();
					});
				});
			});

			// Themibox - Themify Lightbox ////////////////////
			if ( 'undefined' !== typeof Themibox ) {
				if ( ! $body.hasClass('single-album') ) {
					Themibox.init();
				}
				$body.on('themiboxloaded', function(){
					if ( 'undefined' != typeof mejs ) {
						// add mime-type aliases to MediaElement plugin support
						mejs.plugins.silverlight[0].types.push('video/x-ms-wmv');
						mejs.plugins.silverlight[0].types.push('audio/x-ms-wma');

						var settings = {};

						if ( $( document.body ).hasClass( 'mce-content-body' ) ) {
							return;
						}

						if ( typeof _wpmejsSettings !== 'undefined' ) {
							settings.pluginPath = _wpmejsSettings.pluginPath;
						}

						settings.success = function (mejs) {
							var autoplay = mejs.attributes.autoplay && 'false' !== mejs.attributes.autoplay;
							if ( 'flash' === mejs.pluginType && autoplay ) {
								mejs.addEventListener( 'canplay', function () {
									mejs.play();
								}, false );
							}
						};

						$('.wp-audio-shortcode, .wp-video-shortcode').filter(function(){
							return $(this).closest('.module-audio').length <= 0;
						}).mediaelementplayer( settings );
					}

					// make playlist scrollable
					addPlaylistScrollable();
					var resizeId;
					$(window).on('resize.playlistScrollable', function(){
						clearTimeout(resizeId);
						resizeId = setTimeout(addPlaylistScrollable, 500);
					});
				}).on( 'themiboxclosed', function(){
					$(window).off('resize.playlistScrollable');
				});
			}
		}

		// Fixed audio player
		var $footerPlayer = $('#footer-player');
		if ( $footerPlayer.length > 0 ) {
			// Toggle player
			$footerPlayer.on('click', '.button-switch-player', function(e){
				e.preventDefault();
				$(this).closest('#footer-player').toggleClass('collapsed');
			});

			// Wrap volume/mute/volume slider in div to move them
			$footerPlayer.find('.mejs-volume-button, .mejs-horizontal-volume-slider').wrapAll('<div class="themify-player-volume" />');

			// Start playing footer player when it's ready
			if ( themifyScript.autoplay && 'autoplay' == themifyScript.autoplay ) {
				$footerPlayer.find('audio').on( 'canplay', function () {
					$(this).trigger('play');
				});
			}
		}

		// EDGE MENU //
		jQuery(function ($) {
			$("#main-nav li").on('mouseenter mouseleave', function (e) {
				if ($('ul', this).length) {
					var elm = $('ul:first', this);
					var off = elm.offset();
					var l = off.left;
					var w = elm.width();
					var docW = $(window).width();
					var isEntirelyVisible = (l + w <= docW);

					if (!isEntirelyVisible) {
						$(this).addClass('edge');
					} else {
						$(this).removeClass('edge');
					}

				}
			});
		});
		
	});
	
})(jQuery);
