$(document).ready(function() {
/* Form Section */
const form = document.getElementById('form');
const steps = document.querySelectorAll('#steps span');
form.addEventListener('slide.bs.carousel', function (e) {
  steps.forEach((step, index) => {
    if(e.to >= index){
      step.classList.add('activate');
    }else{
      step.classList.remove('activate');
    }
  });
});
/* gallery section */
const galleryRows = document.querySelectorAll('.gallery-row');


galleryRows.forEach((el, index) => {
  
  let direction;
  
  if(index%2 == 1) {
    direction = '50%';
  }
  else {
    direction = '-50%';
  }
  
  gsap.to(el, {
    x: direction,
    scrollTrigger: {
      trigger: el,
      start: '30% bottom',
      end: () => '200px 50%',
      scrub: 1,
      markers: false,
      invalidateOnRefresh: true,
      anticipatePin: 1,
      pin: false
    }
})
});
  /* navbar-new - START */
  const html = document.documentElement;
  const toggle = document.getElementById("toggle");
  const circle = document.getElementById("bg-circle");
  const navlinks = document.getElementById("navlinks")
  const circleWidth = circle.clientWidth;

  // Math calcul to get Height, Width, Diagonal and Circle Radius

  const getVpdr = () => {
    const vph = Math.pow(html.offsetHeight, 2); // Height
    const vpw = Math.pow(html.offsetWidth, 2); // Width
    const vpd = Math.sqrt(vph + vpw); // Diagonal
    return vpd * 2 / circleWidth; // Circle radius
  };

  const openNavbar = () => {
    const openTimeline = new TimelineMax();
    openTimeline.to(".navbar-new", 0, { display: "flex" });
    openTimeline.to("#bg-circle", 1.5, { scale: getVpdr(), ease: Expo.easeInOut });
    openTimeline.staggerFromTo(".navbar-new ul li", 0.5, { y: 25, opacity: 0 }, { y: 0, opacity: 1 }, 0.1, 1);
  };

  const closeNavbar = () => {
    const closeTimeline = new TimelineMax();
    closeTimeline.staggerFromTo(".navbar-new ul li", 0.5, { y: 0, opacity: 1, delay: 0.5 }, { y: 25, opacity: 0 }, -0.1);
    closeTimeline.to("#bg-circle", 1, { scale: 0, ease: Expo.easeInOut, delay: -0.5 });
    closeTimeline.to(".navbar-new", 0, { display: "none" });
  };

  let isOpen = false;

  toggle.onclick = function () {
    if (isOpen) {
      this.classList.remove("active");
      closeNavbar();
    } else {
      this.classList.add("active");
      openNavbar();
    }
    isOpen = !isOpen;
  };
  circle.onclick = function () {
    if (isOpen) {
      toggle.classList.remove("active");
      closeNavbar();
    } else {
      toggle.classList.add("active");
      closeNavbar();
    }
    isOpen = !isOpen;
  };
  navlinks.onclick = function () {
    if (isOpen) {
      toggle.classList.remove("active");
      closeNavbar();
    } else {
      toggle.classList.add("active");
      closeNavbar();
    }
    isOpen = !isOpen;
  }


  // On windows resize, recalcule circle radius and update

  window.onresize = () => {
    if (isOpen) {
      gsap.to("#bg-circle", 1, { scale: getVpdr(), ease: Expo.easeInOut });
    }
  };
  /* Navabr - END */
/* LazyLoad - START */
  gsap.registerPlugin(ScrollTrigger);
  gsap.from(".section-1", {
    scrollTrigger: {
      trigger: ".section-1",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    y: -100,
    opacity: 0,
    duration: 0.5,
  });
  gsap.from(".section-2", {
    scrollTrigger: {
      trigger: ".section-2",
      toggleActions: "play reverse play reverse",
    },
    opacity: 0,
    duration: 2
  });
  gsap.from(".section-3", {
    scrollTrigger: {
      trigger: ".section-3",
      toggleActions: "play reverse play reverse",
    },
    opacity: 0,
    duration: 2
  });
  gsap.from(".section-4", {
    scrollTrigger: {
      trigger: ".section-4",
      toggleActions: "play reverse play reverse",
    },
    opacity: 0,
    duration: 2
  });
  gsap.from(".section-5", {
    scrollTrigger: {
      trigger: ".section-5",
      toggleActions: "play reverse play reverse",
    },
    opacity: 0,
    duration: 2
  });
  gsap.from(".section-6", {
    scrollTrigger: {
      trigger: ".section-6",
      toggleActions: "play reverse play reverse",
    },
    opacity: 0,
    duration: 2
  });
  gsap.from(".section-7", {
    scrollTrigger: {
      trigger: ".section-7",
      toggleActions: "play reverse play reverse",
    },
    opacity: 0,
    duration: 2
  });
  gsap.from(".section-8", {
    scrollTrigger: {
      trigger: ".section-8",
      toggleActions: "play reverse play reverse",
    },
    opacity: 0,
    duration: 2
  });
  gsap.from(".section-9", {
    scrollTrigger: {
      trigger: ".section-9",
      toggleActions: "play reverse play reverse",
    },
    opacity: 0,
    duration: 2
  });
  gsap.from(".section-10", {
    scrollTrigger: {
      trigger: ".section-10",
      toggleActions: "play reverse play reverse",
    },
    opacity: 0,
    duration: 2
  });
  gsap.from(".section-11", {
    scrollTrigger: {
      trigger: ".section-11",
      toggleActions: "play reverse play reverse",
    },
    opacity: 0,
    duration: 2
  });
  gsap.from(".section-12", {
    scrollTrigger: {
      trigger: ".section-12",
      toggleActions: "play reverse play reverse",
    },
    opacity: 0,
    duration: 2
  });
  gsap.from(".section-13", {
    scrollTrigger: {
      trigger: ".section-13",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    y: -100,
    
    duration: 2
  });
  gsap.from(".section-14", {
    scrollTrigger: {
      trigger: ".section-14",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    y: -100,
    duration: 2
  });
  gsap.from(".section-15", {
    scrollTrigger: {
      trigger: ".section-15",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    y: -100,
    duration: 2
  });
  gsap.from(".section-16", {
    scrollTrigger: {
      trigger: ".section-16",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    y: -50,
    duration: 2
  });
  gsap.from(".section-17", {
    scrollTrigger: {
      trigger: ".section-17",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    y: -50,
    duration: 2
  });
  gsap.from(".section-18", {
    scrollTrigger: {
      trigger: ".section-18",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    y: -50,
    duration: 2
  });
  gsap.from(".section-19", {
    scrollTrigger: {
      trigger: ".section-19",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    scale: 0.5,
    y: -100,
    duration: 2
  });
  gsap.from(".section-20", {
    scrollTrigger: {
      trigger: ".section-20",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    y: -100,
    duration: 2
  });
  gsap.from(".section-21", {
    scrollTrigger: {
      trigger: ".section-21",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    scale: 0.8,
    duration: 2
  });
  gsap.from(".section-22", {
    scrollTrigger: {
      trigger: ".section-22",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    scale: 0.8,
    duration: 2
  });
  gsap.from(".section-23", {
    scrollTrigger: {
      trigger: ".section-23",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    scale: 0.8,
    duration: 2
  });
  gsap.from(".section-24", {
    scrollTrigger: {
      trigger: ".section-24",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    scale: 0.8,
    duration: 2
  });
  gsap.from(".section-25", {
    scrollTrigger: {
      trigger: ".section-25",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    y: -100,
    duration: 2
  });
  gsap.from(".section-26", {
    scrollTrigger: {
      trigger: ".section-26",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    x: -50,
    duration: 2
  });
  gsap.from(".section-27", {
    scrollTrigger: {
      trigger: ".section-27",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    x: 400,
    duration: 2
  });
  gsap.from(".section-28", {
    scrollTrigger: {
      trigger: ".section-28",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    y: -50,
    duration: 2
  });
  gsap.from(".section-29", {
    scrollTrigger: {
      trigger: ".section-29",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    y: -50,
    duration: 2
  });
  gsap.from(".section-30", {
    scrollTrigger: {
      trigger: ".section-30",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    x: -50,
    duration: 2
  });
  gsap.from(".section-31", {
    scrollTrigger: {
      trigger: ".section-31",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    y: -50,
    duration: 2
  });
  gsap.from(".section-32", {
    scrollTrigger: {
      trigger: ".section-32",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    y: +50,
    duration: 2
  });
  gsap.from(".section-33", {
    scrollTrigger: {
      trigger: ".section-33",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    x: -50,
    duration: 2
  });
  gsap.from(".section-34", {
    scrollTrigger: {
      trigger: ".section-34",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    x: +50,
    duration: 2
  });
  gsap.from(".section-35", {
    scrollTrigger: {
      trigger: ".section-35",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    y: -50,
    duration: 2
  });
  gsap.from(".section-36", {
    scrollTrigger: {
      trigger: ".section-36",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    y: -50,
    duration: 2
  });
  gsap.from(".section-37", {
    scrollTrigger: {
      trigger: ".section-37",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    y: -50,
    duration: 2
  });
  /*
  gsap.from(".section-38", {
    scrollTrigger: {
      trigger: ".section-38",
      toggleActions: "play reverse play reverse",
      scrub: 1,
    },
    scale: 0.5,
    duration: 2
  }); */
/* LazyLoad - END */



});

/* circular scroll to top - start */
(function($) { "use strict";
$(document).ready(function(){"use strict";

  //Scroll back to top
  
  var progressPath = document.querySelector('.progress-wrap path');
  var pathLength = progressPath.getTotalLength();
  progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
  progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
  progressPath.style.strokeDashoffset = pathLength;
  progressPath.getBoundingClientRect();
  progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';		
  var updateProgress = function () {
    var scroll = $(window).scrollTop();
    var height = $(document).height() - $(window).height();
    var progress = pathLength - (scroll * pathLength / height);
    progressPath.style.strokeDashoffset = progress;
  }
  updateProgress();
  $(window).scroll(updateProgress);	
  var offset = 50;
  var duration = 550;
  jQuery(window).on('scroll', function() {
    if (jQuery(this).scrollTop() > offset) {
      jQuery('.progress-wrap').addClass('active-progress');
    } else {
      jQuery('.progress-wrap').removeClass('active-progress');
    }
  });				
  jQuery('.progress-wrap').on('click', function(event) {
    event.preventDefault();
    jQuery('html, body').animate({scrollTop: 0}, duration);
    return false;
  })
  
  
});

})(jQuery);


