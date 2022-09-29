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

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _modules_TurnstileForm__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/TurnstileForm */ \"./Resources/Private/TypeScript/modules/TurnstileForm.ts\");\n\ndocument.addEventListener('DOMContentLoaded', function () {\n    var _a;\n    if (typeof turnstile === 'undefined') {\n        (_a = document.querySelector('#turnstilScript')) === null || _a === void 0 ? void 0 : _a.addEventListener('load', function () {\n            runInit();\n        });\n    }\n    else {\n        // fallback if user returns to page\n        runInit();\n    }\n    function runInit() {\n        var forms = document.querySelectorAll('form');\n        if (forms !== null) {\n            new _modules_TurnstileForm__WEBPACK_IMPORTED_MODULE_0__.TurnstileForm(forms);\n        }\n    }\n});\n\n\n//# sourceURL=webpack://formhandler/./Resources/Private/TypeScript/Turnstile.ts?");

/***/ }),

/***/ "./Resources/Private/TypeScript/modules/TurnstileForm.ts":
/*!***************************************************************!*\
  !*** ./Resources/Private/TypeScript/modules/TurnstileForm.ts ***!
  \***************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"TurnstileForm\": () => (/* binding */ TurnstileForm)\n/* harmony export */ });\nvar TurnstileForm = /** @class */ (function () {\n    function TurnstileForm(container) {\n        var _this = this;\n        container.forEach(function (container) {\n            var captchaDiv = container.querySelector('#turnstileDiv');\n            var sitekey = String(captchaDiv === null || captchaDiv === void 0 ? void 0 : captchaDiv.dataset.sitekey);\n            if (!captchaDiv || !sitekey) {\n                return;\n            }\n            _this.initCaptcha(captchaDiv, sitekey);\n        });\n    }\n    TurnstileForm.prototype.initCaptcha = function (captchaDiv, sitekey) {\n        turnstile.render(captchaDiv, {\n            sitekey: sitekey,\n            callback: function () {\n                var captchaInput = captchaDiv.querySelector('input');\n                captchaInput.setAttribute('name', 'formhandler[Turnstile]');\n            },\n            theme: 'light',\n        });\n    };\n    return TurnstileForm;\n}());\n\n\n\n//# sourceURL=webpack://formhandler/./Resources/Private/TypeScript/modules/TurnstileForm.ts?");

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
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
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
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./Resources/Private/TypeScript/Turnstile.ts");
/******/ 	
/******/ })()
;