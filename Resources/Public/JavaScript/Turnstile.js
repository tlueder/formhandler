/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./Resources/Private/TypeScript/Turnstile.ts":
/*!***************************************************!*\
  !*** ./Resources/Private/TypeScript/Turnstile.ts ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\ndocument.addEventListener('DOMContentLoaded', function () {\n    var submitButton = document.querySelector(\"[type='submit']\");\n    var div = document.querySelector('#turnstileDiv');\n    var sitekey = div.dataset.sitekey;\n    submitButton.addEventListener('click', function (ev) {\n        ev.preventDefault();\n        turnstile.render(div, {\n            sitekey: sitekey,\n            callback: function (token) {\n                console.log(token);\n            },\n            theme: 'light',\n        });\n    });\n});\n\n\n\n//# sourceURL=webpack://formhandler/./Resources/Private/TypeScript/Turnstile.ts?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
/******/ 	
/************************************************************************/
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
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./Resources/Private/TypeScript/Turnstile.ts"](0, __webpack_exports__, __webpack_require__);
/******/ 	
/******/ })()
;