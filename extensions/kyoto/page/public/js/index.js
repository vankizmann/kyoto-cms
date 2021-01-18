/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/dist/index.js?!./resources/js/pages/KyoPages2.vue?vue&type=script&lang=js":
/*!***************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--0!./node_modules/vue-loader/dist??ref--8-0!./resources/js/pages/KyoPages2.vue?vue&type=script&lang=js ***!
  \***************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony default export */ __webpack_exports__[\"default\"] = ({\n  name: 'KyoPages',\n  localized: true,\n  urls: {\n    index: '/{locale}/kyoto/page/http/controllers/page/index',\n    \"delete\": '/{locale}/kyoto/page/http/controllers/page/delete'\n  },\n  defaults: function defaults() {\n    var query = {\n      page: 1,\n      limit: 25,\n      prop: 'updated_at',\n      dir: 'asc',\n      filter: [],\n      search: '',\n      columns: ['title', 'content']\n    };\n    return {\n      query: query\n    };\n  },\n  \"extends\": window.KyoIndex\n});\n\n//# sourceURL=webpack:///./resources/js/pages/KyoPages2.vue?./node_modules/babel-loader/lib??ref--0!./node_modules/vue-loader/dist??ref--8-0");

/***/ }),

/***/ "./node_modules/vue-loader/dist/templateLoader.js?!./node_modules/vue-loader/dist/index.js?!./resources/js/pages/KyoPages2.vue?vue&type=template&id=7c630b54":
/*!**************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/dist/templateLoader.js??ref--5!./node_modules/vue-loader/dist??ref--8-0!./resources/js/pages/KyoPages2.vue?vue&type=template&id=7c630b54 ***!
  \**************************************************************************************************************************************************************************/
/*! exports provided: render */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"render\", function() { return render; });\n/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ \"vue\");\n/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue__WEBPACK_IMPORTED_MODULE_0__);\n\n\nconst _hoisted_1 = { class: \"grid grid--col\" }\n\nfunction render(_ctx, _cache, $props, $setup, $data, $options) {\n  const _component_KyoTitlebarSearch = Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"resolveComponent\"])(\"KyoTitlebarSearch\")\n  const _component_NButton = Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"resolveComponent\"])(\"NButton\")\n  const _component_KyoTitlebar = Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"resolveComponent\"])(\"KyoTitlebar\")\n  const _component_NTableColumn = Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"resolveComponent\"])(\"NTableColumn\")\n  const _component_router_link = Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"resolveComponent\"])(\"router-link\")\n  const _component_KyoDatatable = Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"resolveComponent\"])(\"KyoDatatable\")\n  const _component_NLoader = Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"resolveComponent\"])(\"NLoader\")\n\n  return (Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"openBlock\"])(), Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"createBlock\"])(_component_NLoader, {\n    visible: _ctx.load,\n    class: \"full-height-child\"\n  }, {\n    default: Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"withCtx\"])(() => [\n      Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"createVNode\"])(\"div\", _hoisted_1, [\n        Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"createVNode\"])(_component_KyoTitlebar, {\n          class: \"col--flex-0-0\",\n          onDelete: _ctx.deleteItems\n        }, {\n          search: Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"withCtx\"])(() => [\n            Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"createVNode\"])(_component_KyoTitlebarSearch, {\n              modelValue: _ctx.query.search,\n              \"onUpdate:modelValue\": _cache[1] || (_cache[1] = $event => (_ctx.query.search = $event))\n            }, null, 8 /* PROPS */, [\"modelValue\"])\n          ]),\n          action: Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"withCtx\"])(() => [\n            Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"createVNode\"])(_component_NButton, {\n              type: \"primary\",\n              onClick: _cache[2] || (_cache[2] = $event => (_ctx.$router.push({ name: 'KyoPageCreate' })))\n            }, {\n              default: Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"withCtx\"])(() => [\n                Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"createTextVNode\"])(Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"toDisplayString\"])(_ctx.trans('Create page')), 1 /* TEXT */)\n              ]),\n              _: 1 /* STABLE */\n            })\n          ]),\n          _: 1 /* STABLE */\n        }, 8 /* PROPS */, [\"onDelete\"]),\n        Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"createVNode\"])(_component_KyoDatatable, {\n          class: \"col--flex-1-1\",\n          onRowDblclick: _ctx.gotoEdit,\n          group: ['page', 'transaction']\n        }, {\n          default: Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"withCtx\"])(() => [\n            Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"createVNode\"])(_component_NTableColumn, {\n              type: \"boolean\",\n              prop: \"state\",\n              label: _ctx.trans('State'),\n              sort: true,\n              filter: true\n            }, {\n              default: Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"withCtx\"])(() => [\n                Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"createCommentVNode\"])(\" Column \")\n              ]),\n              _: 1 /* STABLE */\n            }, 8 /* PROPS */, [\"label\"]),\n            Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"createVNode\"])(_component_NTableColumn, {\n              type: \"boolean\",\n              prop: \"hide\",\n              label: _ctx.trans('Hide'),\n              sort: true,\n              filter: true\n            }, {\n              default: Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"withCtx\"])(() => [\n                Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"createCommentVNode\"])(\" Column \")\n              ]),\n              _: 1 /* STABLE */\n            }, 8 /* PROPS */, [\"label\"]),\n            Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"createVNode\"])(_component_NTableColumn, {\n              type: \"string\",\n              prop: \"title\",\n              label: _ctx.trans('Title'),\n              fluid: true,\n              sort: true,\n              filter: true\n            }, {\n              default: Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"withCtx\"])(() => [\n                Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"createVNode\"])(_component_router_link, {\n                  to: { name: 'KyoPageEdit', params: _ctx.item }\n                }, {\n                  default: Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"withCtx\"])((item) => [\n                    Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"createTextVNode\"])(Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"toDisplayString\"])(item.title), 1 /* TEXT */)\n                  ]),\n                  _: 1 /* STABLE */\n                }, 8 /* PROPS */, [\"to\"])\n              ]),\n              _: 1 /* STABLE */\n            }, 8 /* PROPS */, [\"label\"]),\n            Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"createVNode\"])(_component_NTableColumn, {\n              type: \"datetime\",\n              prop: \"updated_at\",\n              label: _ctx.trans('Modified'),\n              sort: true,\n              filter: true\n            }, {\n              default: Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"withCtx\"])(() => [\n                Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"createCommentVNode\"])(\" Column \")\n              ]),\n              _: 1 /* STABLE */\n            }, 8 /* PROPS */, [\"label\"]),\n            Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"createVNode\"])(_component_NTableColumn, {\n              type: \"datetime\",\n              prop: \"created_at\",\n              label: _ctx.trans('Created'),\n              sort: true,\n              filter: true\n            }, {\n              default: Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"withCtx\"])(() => [\n                Object(vue__WEBPACK_IMPORTED_MODULE_0__[\"createCommentVNode\"])(\" Column \")\n              ]),\n              _: 1 /* STABLE */\n            }, 8 /* PROPS */, [\"label\"])\n          ]),\n          _: 1 /* STABLE */\n        }, 8 /* PROPS */, [\"onRowDblclick\"])\n      ])\n    ]),\n    _: 1 /* STABLE */\n  }, 8 /* PROPS */, [\"visible\"]))\n}\n\n//# sourceURL=webpack:///./resources/js/pages/KyoPages2.vue?./node_modules/vue-loader/dist/templateLoader.js??ref--5!./node_modules/vue-loader/dist??ref--8-0");

/***/ }),

/***/ "./resources/js/bootstrap.js":
/*!***********************************!*\
  !*** ./resources/js/bootstrap.js ***!
  \***********************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _pages_KyoPages2__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./pages/KyoPages2 */ \"./resources/js/pages/KyoPages2.vue\");\n// import KyoPageCreate from \"./pages/KyoPageCreate\";\n// App.component(KyoPageCreate.name, KyoPageCreate);\n// import KyoPageEdit from \"./pages/KyoPageEdit\";\n// App.component(KyoPageEdit.name, KyoPageEdit);\n// import KyoPageBuilder from \"./builder/KyoPageBuilder\";\n// App.component(KyoPageBuilder.name, KyoPageBuilder);\n// import KyoWidgetHeadline from \"./widgets/KyoWidgetHeadline\";\n// App.component(KyoWidgetHeadline.name, KyoWidgetHeadline);\n// require('./configs/page');\n\nKyoto.ready(function (App) {\n  App.component(_pages_KyoPages2__WEBPACK_IMPORTED_MODULE_0__[\"default\"].name, _pages_KyoPages2__WEBPACK_IMPORTED_MODULE_0__[\"default\"]);\n});\n\nif (console && console.log) {\n  console.log('kyoto/page ready.');\n}\n\n//# sourceURL=webpack:///./resources/js/bootstrap.js?");

/***/ }),

/***/ "./resources/js/pages/KyoPages2.vue":
/*!******************************************!*\
  !*** ./resources/js/pages/KyoPages2.vue ***!
  \******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _KyoPages2_vue_vue_type_template_id_7c630b54__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./KyoPages2.vue?vue&type=template&id=7c630b54 */ \"./resources/js/pages/KyoPages2.vue?vue&type=template&id=7c630b54\");\n/* harmony import */ var _KyoPages2_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./KyoPages2.vue?vue&type=script&lang=js */ \"./resources/js/pages/KyoPages2.vue?vue&type=script&lang=js\");\n/* empty/unused harmony star reexport */\n\n\n_KyoPages2_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__[\"default\"].render = _KyoPages2_vue_vue_type_template_id_7c630b54__WEBPACK_IMPORTED_MODULE_0__[\"render\"]\n/* hot reload */\nif (false) {}\n\n_KyoPages2_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__[\"default\"].__file = \"resources/js/pages/KyoPages2.vue\"\n\n/* harmony default export */ __webpack_exports__[\"default\"] = (_KyoPages2_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__[\"default\"]);\n\n//# sourceURL=webpack:///./resources/js/pages/KyoPages2.vue?");

/***/ }),

/***/ "./resources/js/pages/KyoPages2.vue?vue&type=script&lang=js":
/*!******************************************************************!*\
  !*** ./resources/js/pages/KyoPages2.vue?vue&type=script&lang=js ***!
  \******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_0_node_modules_vue_loader_dist_index_js_ref_8_0_KyoPages2_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--0!../../../node_modules/vue-loader/dist??ref--8-0!./KyoPages2.vue?vue&type=script&lang=js */ \"./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/dist/index.js?!./resources/js/pages/KyoPages2.vue?vue&type=script&lang=js\");\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, \"default\", function() { return _node_modules_babel_loader_lib_index_js_ref_0_node_modules_vue_loader_dist_index_js_ref_8_0_KyoPages2_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__[\"default\"]; });\n\n/* empty/unused harmony star reexport */ \n\n//# sourceURL=webpack:///./resources/js/pages/KyoPages2.vue?");

/***/ }),

/***/ "./resources/js/pages/KyoPages2.vue?vue&type=template&id=7c630b54":
/*!************************************************************************!*\
  !*** ./resources/js/pages/KyoPages2.vue?vue&type=template&id=7c630b54 ***!
  \************************************************************************/
/*! exports provided: render */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_vue_loader_dist_templateLoader_js_ref_5_node_modules_vue_loader_dist_index_js_ref_8_0_KyoPages2_vue_vue_type_template_id_7c630b54__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/dist/templateLoader.js??ref--5!../../../node_modules/vue-loader/dist??ref--8-0!./KyoPages2.vue?vue&type=template&id=7c630b54 */ \"./node_modules/vue-loader/dist/templateLoader.js?!./node_modules/vue-loader/dist/index.js?!./resources/js/pages/KyoPages2.vue?vue&type=template&id=7c630b54\");\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, \"render\", function() { return _node_modules_vue_loader_dist_templateLoader_js_ref_5_node_modules_vue_loader_dist_index_js_ref_8_0_KyoPages2_vue_vue_type_template_id_7c630b54__WEBPACK_IMPORTED_MODULE_0__[\"render\"]; });\n\n\n\n//# sourceURL=webpack:///./resources/js/pages/KyoPages2.vue?");

/***/ }),

/***/ 0:
/*!*****************************************!*\
  !*** multi ./resources/js/bootstrap.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("module.exports = __webpack_require__(/*! ./resources/js/bootstrap.js */\"./resources/js/bootstrap.js\");\n\n\n//# sourceURL=webpack:///multi_./resources/js/bootstrap.js?");

/***/ }),

/***/ "vue":
/*!**********************!*\
  !*** external "Vue" ***!
  \**********************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("module.exports = Vue;\n\n//# sourceURL=webpack:///external_%22Vue%22?");

/***/ })

/******/ });