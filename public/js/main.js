$(document).ready(function(){

     $('#hero-area-slider').owlCarousel({
         loop: true,
         nav: true,
        //  mouseDrag: false,
         items:1,
         dots: false,
         margin: 0,
         navText: [
             '<i class="fa fa-angle-left" aria-hidden="true"></i>',
             '<i class="fa fa-angle-right" aria-hidden="true"></i>'
         ],
         navContainer: '#hero-area-nav',
     });

    $('#tenaga-pendidik-slider').owlCarousel({
        loop: true,
        nav: true,
        //  mouseDrag: false,
        // items: 3,
        dots: false,
        margin: 20,
        navText: [
            '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            '<i class="fa fa-angle-right" aria-hidden="true"></i>'
        ],
        navContainer: '#slider-tools-1',
        responsive: {
            // breakpoint from 0 up
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1200: {
                items: 3
            }
        }
    });

    $('#alumni-slider').owlCarousel({
        loop: true,
        nav: true,
        //  mouseDrag: false,
        items: 2,
        dots: false,
        margin: 20,
        navText: [
            '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            '<i class="fa fa-angle-right" aria-hidden="true"></i>'
        ],
        navContainer: '#slider-tools-2',
        responsive: {
            // breakpoint from 0 up
            0: {
                items: 1
            },
            800: {
                items: 2
            }
        }
    });

     $('#galeri-slider').owlCarousel({
         loop: true,
         nav: true,
         //  mouseDrag: false,
         items: 3,
         dots: false,
         margin: 20,
         navText: [
             '<i class="fa fa-angle-left" aria-hidden="true"></i>',
             '<i class="fa fa-angle-right" aria-hidden="true"></i>'
         ],
         navContainer: '#slider-tools-3',
         responsive: {
             // breakpoint from 0 up
             0: {
                items: 1
            },
            600: {
                items: 2
            },
            1200: {
                items: 3
            }
         }
     });

     $('#pengumuman-slider').owlCarousel({
         loop: true,
         nav: true,
         //  mouseDrag: false,
         items: 1,
         dots: false,
         margin: 20,
         navText: [
             '<i class="fa fa-angle-left" aria-hidden="true"></i>',
             '<i class="fa fa-angle-right" aria-hidden="true"></i>'
         ],
         navContainer: '#pengumuman-nav'
     });

     $('#agenda-slider').owlCarousel({
         loop: true,
         nav: true,
         //  mouseDrag: false,
         items: 1,
         dots: false,
         margin: 20,
         navText: [
             '<i class="fa fa-angle-left" aria-hidden="true"></i>',
             '<i class="fa fa-angle-right" aria-hidden="true"></i>'
         ],
         navContainer: '#agenda-nav'
     });


});

//  scroll 
$(document).scroll(function () {
    var y = $(this).scrollTop();
    if(y > 700) {
        // console.log(y);
         $('#scroll-to-top a').show();
        //  $('.scroll-to-top a').fadeIn();
        } else {
        $('#scroll-to-top a').hide();
        // $(".scroll-to-top a").fadeOut();
    }
});

$(document).ready(function(){

  $('.photoswipe-wrapper').each(function() {
    $(this).find('a').each(function() {
      $(this).attr('data-size', $(this).find('img').get(0).naturalWidth + 'x' + $(this).find('img').get(0).naturalHeight);
    });
  });

  var initPhotoSwipeFromDOM = function(gallerySelector) {

  // parse slide data (url, title, size ...) from DOM elements
  // (children of gallerySelector)
  var parseThumbnailElements = function(el) {
    var thumbElements = $(el).find('.photoswipe-item:not(.isotope-hidden)').get(),
    numNodes = thumbElements.length,
    items = [],
    figureEl,
    linkEl,
    size,
    item;

    for (var i = 0; i < numNodes; i++) {

      figureEl = thumbElements[i]; // <figure> element

      // include only element nodes
      if (figureEl.nodeType !== 1) {
        continue;
      }

      linkEl = figureEl.children[0]; // <a> element

      size = linkEl.getAttribute('data-size').split('x');

      // create slide object
      if ($(linkEl).data('type') == 'video') {
        item = {
          html: $(linkEl).data('video')
        };
      } else {
       var $link = $(this).find('.g-link'),
       item = {
        src: linkEl.getAttribute('href'),
        // w: parseInt(size[0], 10),
        // h: parseInt(size[1], 10),
        w: linkEl.getAttribute('data-width'),
        h: linkEl.getAttribute('data-height'),
        title: linkEl.getAttribute('data-caption')
      };

    }

    if (figureEl.children.length > 1) {
        // <figcaption> content
        item.title = $(figureEl).find('.caption').html();
      }

      if (linkEl.children.length > 0) {
        // <img> thumbnail element, retrieving thumbnail url
        item.msrc = linkEl.children[0].getAttribute('src');
      }

      item.el = figureEl; // save link to element for getThumbBoundsFn
      items.push(item);
    }

    return items;
  };

  // find nearest parent element
  var closest = function closest(el, fn) {
    return el && (fn(el) ? el : closest(el.parentNode, fn));
  };

  function hasClass(element, cls) {
    return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
  }

  // triggers when user clicks on thumbnail
  var onThumbnailsClick = function(e) {
    e = e || window.event;
    e.preventDefault ? e.preventDefault() : e.returnValue = false;

    var eTarget = e.target || e.srcElement;

    // find root element of slide
    var clickedListItem = closest(eTarget, function(el) {
      return (hasClass(el, 'photoswipe-item'));
    });

    if (!clickedListItem) {
      return;
    }

    // find index of clicked item by looping through all child nodes
    // alternatively, you may define index via data- attribute
    var clickedGallery = clickedListItem.closest('.photoswipe-wrapper'),
    childNodes = $(clickedListItem.closest('.photoswipe-wrapper')).find('.photoswipe-item:not(.isotope-hidden)').get(),
    numChildNodes = childNodes.length,
    nodeIndex = 0,
    index;

    for (var i = 0; i < numChildNodes; i++) {
      if (childNodes[i].nodeType !== 1) {
        continue;
      }

      if (childNodes[i] === clickedListItem) {
        index = nodeIndex;
        break;
      }
      nodeIndex++;
    }

    if (index >= 0) {
      // open PhotoSwipe if valid index found
      openPhotoSwipe(index, clickedGallery);
    }
    return false;
  };

  // parse picture index and gallery index from URL (#&pid=1&gid=2)
  var photoswipeParseHash = function() {
    var hash = window.location.hash.substring(1),
    params = {};

    if (hash.length < 5) {
      return params;
    }

    var vars = hash.split('&');
    for (var i = 0; i < vars.length; i++) {
      if (!vars[i]) {
        continue;
      }
      var pair = vars[i].split('=');
      if (pair.length < 2) {
        continue;
      }
      params[pair[0]] = pair[1];
    }

    if (params.gid) {
      params.gid = parseInt(params.gid, 10);
    }

    return params;
  };

  var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
    var pswpElement = document.querySelectorAll('.pswp')[0],
    gallery,
    options,
    items;

    items = parseThumbnailElements(galleryElement);

    // define options (if needed)
    options = {

      closeOnScroll: false,

      // define gallery index (for URL)
      galleryUID: galleryElement.getAttribute('data-pswp-uid'),

      getThumbBoundsFn: function(index) {
        // See Options -> getThumbBoundsFn section of documentation for more info
        var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
        pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
        rect = thumbnail.getBoundingClientRect();

        return {
          x: rect.left,
          y: rect.top + pageYScroll,
          w: rect.width
        };
      }

    };

    // PhotoSwipe opened from URL
    if (fromURL) {
      if (options.galleryPIDs) {
        // parse real index when custom PIDs are used
        // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
        for (var j = 0; j < items.length; j++) {
          if (items[j].pid == index) {
            options.index = j;
            break;
          }
        }
      } else {
        // in URL indexes start from 1
        options.index = parseInt(index, 10) - 1;
      }
    } else {
      options.index = parseInt(index, 10);
    }

    // exit if index not found
    if (isNaN(options.index)) {
      return;
    }

    if (disableAnimation) {
      options.showAnimationDuration = 0;
    }

    // Pass data to PhotoSwipe and initialize it
    gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
    gallery.init();

    gallery.listen('beforeChange', function() {
      var currItem = $(gallery.currItem.container);
      $('.pswp__video').removeClass('active');
      var currItemIframe = currItem.find('.pswp__video').addClass('active');
      $('.pswp__video').each(function() {
        if (!$(this).hasClass('active')) {
          $(this).attr('src', $(this).attr('src'));
        }
      });
    });

    gallery.listen('close', function() {
      $('.pswp__video').each(function() {
        $(this).attr('src', $(this).attr('src'));
      });
    });

  };

  // loop through all gallery elements and bind events
  var galleryElements = document.querySelectorAll(gallerySelector);

  for (var i = 0, l = galleryElements.length; i < l; i++) {
    galleryElements[i].setAttribute('data-pswp-uid', i + 1);
    galleryElements[i].onclick = onThumbnailsClick;
  }

  // Parse URL and open gallery if it contains #&pid=3&gid=1
  var hashData = photoswipeParseHash();
  if (hashData.pid && hashData.gid) {
    openPhotoSwipe(hashData.pid, galleryElements[hashData.gid - 1], true, true);
  }

};

// execute above function

initPhotoSwipeFromDOM('.photoswipe-wrapper');



})