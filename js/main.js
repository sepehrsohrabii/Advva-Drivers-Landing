$(document).ready(function() {
/* How it works section */
$(".option").click(function(){
  $(".option").removeClass("active");
  $(this).addClass("active");
  
});
/* gallery section */
console.clear();

let ww = window.innerWidth;
let wh = window.innerHeight;

const isFirefox = navigator.userAgent.indexOf("Firefox") > -1;
const isWindows = navigator.appVersion.indexOf("Win") != -1;

const mouseMultiplier = 0.6;
const firefoxMultiplier = 20;

const multipliers = {
	mouse: isWindows ? mouseMultiplier * 2 : mouseMultiplier,
	firefox: isWindows ? firefoxMultiplier * 2 : firefoxMultiplier
};

/** CORE **/
class Core {
	constructor() {
		this.tx = 0;
		this.ty = 0;
		this.cx = 0;
		this.cy = 0;

		this.diff = 0;

		this.wheel = { x: 0, y: 0 };
		this.on = { x: 0, y: 0 };
		this.max = { x: 0, y: 0 };

		this.isDragging = false;

		this.tl = gsap.timeline({ paused: true });

		this.el = document.querySelector(".js-grid");

		/** GL specifics **/
		this.scene = new THREE.Scene();

		this.camera = new THREE.OrthographicCamera(
			ww / -2,
			ww / 2,
			wh / 2,
			wh / -2,
			1,
			1000
		);
		this.camera.lookAt(this.scene.position);
		this.camera.position.z = 1;

		this.renderer = new THREE.WebGLRenderer({ antialias: true });
		this.renderer.setSize(ww, wh);
		this.renderer.setPixelRatio(
			gsap.utils.clamp(1, 1.5, window.devicePixelRatio)
		);

		document.getElementById('mycanvas').appendChild(this.renderer.domElement);
		/** Gl specifics end **/

		this.addPlanes();
		this.addEvents();
		this.resize();
	}

	addEvents() {
		gsap.ticker.add(this.tick);

		window.addEventListener("mousemove", this.onMouseMove);
		window.addEventListener("mousedown", this.onMouseDown);
		window.addEventListener("mouseup", this.onMouseUp);
		window.addEventListener("wheel", this.onWheel);
	}

	addPlanes() {
		const planes = [...document.querySelectorAll(".js-plane")];

		this.planes = planes.map((el, i) => {
			const plane = new Plane();
			plane.init(el, i);

			this.scene.add(plane);

			return plane;
		});
	}

	tick = () => {
		const xDiff = this.tx - this.cx;
		const yDiff = this.ty - this.cy;

		this.cx += xDiff * 0.085;
		this.cx = Math.round(this.cx * 100) / 100;

		this.cy += yDiff * 0.085;
		this.cy = Math.round(this.cy * 100) / 100;

		this.diff = Math.max(Math.abs(yDiff * 0.0001), Math.abs(xDiff * 0.0001));

		this.planes.length &&
			this.planes.forEach((plane) =>
				plane.update(this.cx, this.cy, this.max, this.diff)
			);

		this.renderer.render(this.scene, this.camera);
	};

	onMouseMove = ({ clientX, clientY }) => {
		if (!this.isDragging) return;

		this.tx = this.on.x + clientX * 2.5;
		this.ty = this.on.y - clientY * 2.5;
	};

	onMouseDown = ({ clientX, clientY }) => {
		if (this.isDragging) return;

		this.isDragging = true;

		this.on.x = this.tx - clientX * 2.5;
		this.on.y = this.ty + clientY * 2.5;
	};

	onMouseUp = ({ clientX, clientY }) => {
		if (!this.isDragging) return;

		this.isDragging = false;
	};

	onWheel = (e) => {
		const { mouse, firefox } = multipliers;

		this.wheel.x = e.wheelDeltaX || e.deltaX * -1;
		this.wheel.y = e.wheelDeltaY || e.deltaY * -1;

		if (isFirefox && e.deltaMode === 1) {
			this.wheel.x *= firefox;
			this.wheel.y *= firefox;
		}

		this.wheel.y *= mouse;
		this.wheel.x *= mouse;

		this.tx += this.wheel.x;
		this.ty -= this.wheel.y;
	};

	resize = () => {
		ww = window.innerHeight;
		wh = window.innerWidth;

		const { bottom, right } = this.el.getBoundingClientRect();

		this.max.x = right;
		this.max.y = bottom;
	};
}

/** PLANE **/
const loader = new THREE.TextureLoader();

const vertexShader = `
precision mediump float;

uniform float u_diff;

varying vec2 vUv;

void main(){
  vec3 pos = position;
  
  pos.y *= 1. - u_diff;
  pos.x *= 1. - u_diff;

  vUv = uv;
  gl_Position = projectionMatrix * modelViewMatrix * vec4(pos, 1.);;
}
`;

const fragmentShader = `
precision mediump float;

uniform vec2 u_res;
uniform vec2 u_size;

uniform sampler2D u_texture;

vec2 cover(vec2 screenSize, vec2 imageSize, vec2 uv) {
  float screenRatio = screenSize.x / screenSize.y;
  float imageRatio = imageSize.x / imageSize.y;

  vec2 newSize = screenRatio < imageRatio 
      ? vec2(imageSize.x * (screenSize.y / imageSize.y), screenSize.y)
      : vec2(screenSize.x, imageSize.y * (screenSize.x / imageSize.x));
  vec2 newOffset = (screenRatio < imageRatio 
      ? vec2((newSize.x - screenSize.x) / 2.0, 0.0) 
      : vec2(0.0, (newSize.y - screenSize.y) / 2.0)) / newSize;

  return uv * screenSize / newSize + newOffset;
}

varying vec2 vUv;

void main() {
    vec2 uv = vUv;

    vec2 uvCover = cover(u_res, u_size, uv);
    vec4 texture = texture2D(u_texture, uvCover);
	
    gl_FragColor = texture;
}
`;

const geometry = new THREE.PlaneBufferGeometry(1, 1, 1, 1);
const material = new THREE.ShaderMaterial({
	fragmentShader,
	vertexShader
});

class Plane extends THREE.Object3D {
	init(el, i) {
		this.el = el;

		this.x = 0;
		this.y = 0;

		this.my = 1 - (i % 5) * 0.1;

		this.geometry = geometry;
		this.material = material.clone();

		this.material.uniforms = {
			u_texture: { value: 0 },
			u_res: { value: new THREE.Vector2(1, 1) },
			u_size: { value: new THREE.Vector2(1, 1) },
			u_diff: { value: 0 }
		};

		this.texture = loader.load(this.el.dataset.src, (texture) => {
			texture.minFilter = THREE.LinearFilter;
			texture.generateMipmaps = false;

			const { naturalWidth, naturalHeight } = texture.image;
			const { u_size, u_texture } = this.material.uniforms;

			u_texture.value = texture;
			u_size.value.x = naturalWidth;
			u_size.value.y = naturalHeight;
		});

		this.mesh = new THREE.Mesh(this.geometry, this.material);
		this.add(this.mesh);

		this.resize();
	}

	update = (x, y, max, diff) => {
		const { right, bottom } = this.rect;
		const { u_diff } = this.material.uniforms;

		this.y =
			gsap.utils.wrap(-(max.y - bottom), bottom, y * this.my) - this.yOffset;

		this.x = gsap.utils.wrap(-(max.x - right), right, x) - this.xOffset;

		u_diff.value = diff;

		this.position.x = this.x;
		this.position.y = this.y;
	};

	resize() {
		this.rect = this.el.getBoundingClientRect();

		const { left, top, width, height } = this.rect;
		const { u_res, u_toRes, u_pos, u_offset } = this.material.uniforms;

		this.xOffset = left + width / 2 - ww / 2;
		this.yOffset = top + height / 2 - wh / 2;

		this.position.x = this.xOffset;
		this.position.y = this.yOffset;

		u_res.value.x = width;
		u_res.value.y = height;

		this.mesh.scale.set(width, height, 1);
	}
}

new Core();


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


