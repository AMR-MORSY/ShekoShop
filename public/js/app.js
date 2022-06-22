/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/***/ (() => {

////////////////////////////////////////////////////////////////
var x = document.querySelectorAll(".nav-item");

var _loop = function _loop(i) {
  x[i].addEventListener("mouseover", function () {
    var linko = $(".nav-item > a").eq(i).text();

    if (linko == "+ Hambozo") {
      $("#links").slideDown("slow", "linear");
      $("#Profile").css("display", "none");
      $("#search").css("display", "none");
      $("#Hambozo").css("display", "block");
    }

    if (linko == "+ Profile") {
      $("#Hambozo").css("display", "none");
      $("#links").slideDown("slow", "linear");
      $("#search").css("display", "none");
      $("#Profile").slideDown("slow", "linear");
    }
  });
};

for (var i = 0; i < x.length; i++) {
  _loop(i);
} ////////////////////////////////////////////////
//small menue button actions/////


$(".menue-btn").on("click", function () {
  if (!$(".menue-btn").hasClass("open")) {
    $(".menue-btn").addClass("open");
    $("#small-menue").slideDown("slow", "linear");
    $(".navig-item").each(function () {
      $(this).addClass("animate__slideInLeft");
    });
  } else {
    $(".menue-btn").removeClass("open");
    $("#small-menue").slideUp("slow", "linear");
    $(".navig-item").each(function () {
      $(this).removeClass("animate__slideInLeft");
    });
    $("#sliding-canvas").animate({
      left: "100%"
    }, "fast", "linear");
    $("#sliding-canvas").animate({
      right: "-100%"
    }, "fast", "linear");
    $("#sliding-convas-shop").animate({
      left: "100%"
    }, "slow", "linear");
    $("#sliding-convas-shop").animate({
      right: "-100%"
    }, "slow", "linear");
  }
}); /////////////

function addSlidingCanvascontent(header) {
  $("#sliding-convas-header").text(header);
  var blog = ["NEWS", "NOTEBOOK"];
  var about = ["WHO WE ARE", "FAQ", "CONTACTS", "MEET THE TEAM", "FAN PAG"];
  var collections = ["Spring/Summer", "Ready-to-Wear", "Last Chance", "View All"];
  var sale = ["One Piece", "Tops", "bottoms", "view All"];
  var allStyles = ["One Piece", "Dresses", "Tops", "Shirts", "Bottoms", "Skirts"];

  if (header == "BLOG") {
    for (var _i = 0; _i < blog.length; _i++) {
      $(".sliding-convas-paragraph").eq(_i).text(blog[_i]);
      $("#sliding-canvas").animate({
        left: "0"
      }, "slow", "linear");
      $("#sliding-canvas").animate({
        right: "0"
      }, "slow", "linear");
    }
  } else if (header == "ABOUT") {
    for (var _i2 = 0; _i2 < blog.length; _i2++) {
      $(".sliding-convas-paragraph").eq(_i2).text(about[_i2]);
      $("#sliding-canvas").animate({
        left: "0"
      }, "slow", "linear");
      $("#sliding-canvas").animate({
        right: "0"
      }, "slow", "linear");
    }
  } else if (header == "SHOP") {
    $("#sliding-convas-shop").animate({
      left: "0"
    }, "slow", "linear");
    $("#sliding-convas-shop").animate({
      right: "0"
    }, "slow", "linear");
  } else if (header == "COLLECTIONS") {
    for (var _i3 = 0; _i3 < collections.length; _i3++) {
      $(".sliding-convas-paragraph").eq(_i3).text(collections[_i3]);
      $("#sliding-canvas").animate({
        left: "0"
      }, "slow", "linear");
      $("#sliding-canvas").animate({
        right: "0"
      }, "slow", "linear");
    }
  } else if (header == "ALL STYLES") {
    for (var _i4 = 0; _i4 < allStyles.length; _i4++) {
      $(".sliding-convas-paragraph").eq(_i4).text(allStyles[_i4]);
      $("#sliding-canvas").animate({
        left: "0"
      }, "slow", "linear");
      $("#sliding-canvas").animate({
        right: "0"
      }, "slow", "linear");
    }
  } else if (header == "SALE") {
    for (var _i5 = 0; _i5 < sale.length; _i5++) {
      $(".sliding-convas-psaleraph").eq(_i5).text(sale[_i5]);
      $("#sliding-canvas").animate({
        left: "0"
      }, "slow", "linear");
      $("#sliding-canvas").animate({
        right: "0"
      }, "slow", "linear");
    }
  }
}

var z = document.querySelectorAll(".navig-item i");

var _loop2 = function _loop2(_i6) {
  z[_i6].addEventListener("click", function () {
    var header = $(".navig-item > p").eq(_i6).text();
    console.log(header);
    addSlidingCanvascontent(header);
  });
};

for (var _i6 = 0; _i6 < z.length; _i6++) {
  _loop2(_i6);
} //
///search icon action/////////////////


$(".search-icon").on("click", function () {
  $("#search").slideDown("slow", "linear");
  $("#search-caption").addClass("animate__slideInUp");
  $("#search-input").addClass("animate__slideInUp");
});
$(document).ready(function () {
  $(".first-caption").css("display", "block");
  $(".first-caption").addClass("animate__slideInUp");
  $("#intro-image").addClass("scalling-image");
});
$("#links").on("mouseleave", function () {
  $("#links").slideUp("slow", "linear");
});

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/app": 0,
/******/ 			"css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/js/app.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/sass/app.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;