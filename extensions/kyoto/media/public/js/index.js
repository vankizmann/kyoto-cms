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

/***/ "./node_modules/@vue/babel-helper-vue-jsx-merge-props/dist/helper.js":
/*!***************************************************************************!*\
  !*** ./node_modules/@vue/babel-helper-vue-jsx-merge-props/dist/helper.js ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("function _extends(){return _extends=Object.assign||function(a){for(var b,c=1;c<arguments.length;c++)for(var d in b=arguments[c],b)Object.prototype.hasOwnProperty.call(b,d)&&(a[d]=b[d]);return a},_extends.apply(this,arguments)}var normalMerge=[\"attrs\",\"props\",\"domProps\"],toArrayMerge=[\"class\",\"style\",\"directives\"],functionalMerge=[\"on\",\"nativeOn\"],mergeJsxProps=function(a){return a.reduce(function(c,a){for(var b in a)if(!c[b])c[b]=a[b];else if(-1!==normalMerge.indexOf(b))c[b]=_extends({},c[b],a[b]);else if(-1!==toArrayMerge.indexOf(b)){var d=c[b]instanceof Array?c[b]:[c[b]],e=a[b]instanceof Array?a[b]:[a[b]];c[b]=d.concat(e)}else if(-1!==functionalMerge.indexOf(b)){for(var f in a[b])if(c[b][f]){var g=c[b][f]instanceof Array?c[b][f]:[c[b][f]],h=a[b][f]instanceof Array?a[b][f]:[a[b][f]];c[b][f]=g.concat(h)}else c[b][f]=a[b][f];}else if(\"hook\"==b)for(var i in a[b])c[b][i]=c[b][i]?mergeFn(c[b][i],a[b][i]):a[b][i];else c[b]=a[b];return c},{})},mergeFn=function(a,b){return function(){a&&a.apply(this,arguments),b&&b.apply(this,arguments)}};module.exports=mergeJsxProps;\n\n\n//# sourceURL=webpack:///./node_modules/@vue/babel-helper-vue-jsx-merge-props/dist/helper.js?");

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/medias/KyoMediaCreate.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/medias/KyoMediaCreate.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n/* harmony default export */ __webpack_exports__[\"default\"] = ({\n  name: 'KyoMediaCreate',\n  localized: true,\n  urls: {\n    show: '/{locale}/kyoto/media/http/controllers/media/show',\n    store: '/{locale}/kyoto/media/http/controllers/media/store'\n  },\n  mounted: function mounted() {\n    this.override.parent_id = window.location.hash.replace(/^#/, '');\n  },\n  methods: {\n    gotoIndex: function gotoIndex() {\n      this.$router.go(-1);\n    }\n  },\n  \"extends\": window.KyoForm\n});\n\n//# sourceURL=webpack:///./resources/js/medias/KyoMediaCreate.vue?./node_modules/babel-loader/lib??ref--0!./node_modules/vue-loader/lib??vue-loader-options");

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/medias/KyoMediaEdit.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/medias/KyoMediaEdit.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n/* harmony default export */ __webpack_exports__[\"default\"] = ({\n  name: 'KyoMediaEdit',\n  \"extends\": window.KyoForm,\n  localized: true,\n  urls: {\n    show: '/{locale}/kyoto/media/http/controllers/media/show',\n    update: '/{locale}/kyoto/media/http/controllers/media/update',\n    \"delete\": '/{locale}/kyoto/media/http/controllers/media/delete'\n  },\n  methods: {\n    gotoIndex: function gotoIndex() {\n      this.$router.go(-1);\n    }\n  }\n});\n\n//# sourceURL=webpack:///./resources/js/medias/KyoMediaEdit.vue?./node_modules/babel-loader/lib??ref--0!./node_modules/vue-loader/lib??vue-loader-options");

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/medias/KyoMediaCreate.vue?vue&type=template&id=66a5d670&":
/*!*************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/medias/KyoMediaCreate.vue?vue&type=template&id=66a5d670& ***!
  \*************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"render\", function() { return render; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"staticRenderFns\", function() { return staticRenderFns; });\nvar render = function () {var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;return _c('NLoader',{staticClass:\"full-height-child\",attrs:{\"visible\":_vm.load}},[_c('div',{staticClass:\"grid grid--col\"},[_c('KyoTitlebar',{staticClass:\"col--flex-0-0\",attrs:{\"back\":true,\"title\":_vm.trans('Create folder')}},[_c('template',{slot:\"action\"},[_c('NButtonGroup',[_c('NButton',{attrs:{\"type\":\"primary\"},on:{\"click\":_vm.storeItemClose}},[_vm._v(\"\\n                        \"+_vm._s(_vm.trans('Save'))+\"\\n                    \")])],1)],1)],2),_vm._v(\" \"),_c('NForm',{staticClass:\"kyo-dataform col--flex-1-0\",attrs:{\"form\":_vm.result,\"errors\":_vm.errors}},[_c('NFormGroup',{attrs:{\"icon\":\"fa fa-info\",\"legend\":_vm.trans('Info')}},[_c('div',{staticClass:\"grid grid-row grid--wrap grid--30\"},[_c('div',{staticClass:\"col--1-1\"},[_c('NFormItem',{attrs:{\"label\":_vm.trans('Title'),\"prop\":\"title\"}},[_c('NInput',{model:{value:(_vm.result.title),callback:function ($$v) {_vm.$set(_vm.result, \"title\", $$v)},expression:\"result.title\"}})],1)],1),_vm._v(\" \"),_c('div',{staticClass:\"col--1-1\"},[_c('NFormItem',{attrs:{\"label\":_vm.trans('Description'),\"prop\":\"description\"}},[_c('NTextarea',{model:{value:(_vm.result.description),callback:function ($$v) {_vm.$set(_vm.result, \"description\", $$v)},expression:\"result.description\"}})],1)],1)])])],1)],1)])}\nvar staticRenderFns = []\n\n\n\n//# sourceURL=webpack:///./resources/js/medias/KyoMediaCreate.vue?./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options");

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/medias/KyoMediaEdit.vue?vue&type=template&id=283ff37c&":
/*!***********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/medias/KyoMediaEdit.vue?vue&type=template&id=283ff37c& ***!
  \***********************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"render\", function() { return render; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"staticRenderFns\", function() { return staticRenderFns; });\nvar render = function () {var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;return _c('NLoader',{staticClass:\"full-height-child\",attrs:{\"visible\":_vm.load}},[_c('div',{staticClass:\"grid grid--col\"},[_c('KyoTitlebar',{staticClass:\"col--flex-0-0\",attrs:{\"back\":true},on:{\"delete\":_vm.deleteItem}},[_c('template',{slot:\"action\"},[_c('NButtonGroup',[_c('NButton',{attrs:{\"type\":\"primary\"},on:{\"click\":_vm.updateItem}},[_vm._v(\"\\n                        \"+_vm._s(_vm.trans('Apply'))+\"\\n                    \")]),_vm._v(\" \"),_c('NButton',{attrs:{\"type\":\"primary\"},on:{\"click\":_vm.updateCloseItem}},[_vm._v(\"\\n                        \"+_vm._s(_vm.trans('Save'))+\"\\n                    \")])],1)],1)],2),_vm._v(\" \"),_c('NForm',{staticClass:\"kyo-dataform col--flex-1-0\",attrs:{\"form\":_vm.result,\"errors\":_vm.errors}},[_c('NFormGroup',{attrs:{\"icon\":\"fa fa-info\",\"legend\":_vm.trans('Info')}},[_c('div',{staticClass:\"grid grid-row grid--wrap grid--30\"},[_c('div',{staticClass:\"col--1-1\"},[_c('NFormItem',{attrs:{\"label\":_vm.trans('Title'),\"prop\":\"title\"}},[_c('NInput',{model:{value:(_vm.result.title),callback:function ($$v) {_vm.$set(_vm.result, \"title\", $$v)},expression:\"result.title\"}})],1)],1),_vm._v(\" \"),_c('div',{staticClass:\"col--1-1 col--1-2@md\"},[_c('NFormItem',{attrs:{\"label\":_vm.trans('Description'),\"prop\":\"description\"}},[_c('NTextarea',{model:{value:(_vm.result.description),callback:function ($$v) {_vm.$set(_vm.result, \"description\", $$v)},expression:\"result.description\"}})],1)],1),_vm._v(\" \"),_c('div',{staticClass:\"col--1-1 col--1-2@md\"},[_c('NFormItem',{attrs:{\"label\":_vm.trans('Copyright'),\"prop\":\"copyright\"}},[_c('NTextarea',{model:{value:(_vm.result.copyright),callback:function ($$v) {_vm.$set(_vm.result, \"copyright\", $$v)},expression:\"result.copyright\"}})],1)],1)])])],1)],1)])}\nvar staticRenderFns = []\n\n\n\n//# sourceURL=webpack:///./resources/js/medias/KyoMediaEdit.vue?./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options");

/***/ }),

/***/ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js":
/*!********************************************************************!*\
  !*** ./node_modules/vue-loader/lib/runtime/componentNormalizer.js ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"default\", function() { return normalizeComponent; });\n/* globals __VUE_SSR_CONTEXT__ */\n\n// IMPORTANT: Do NOT use ES2015 features in this file (except for modules).\n// This module is a runtime utility for cleaner component module output and will\n// be included in the final webpack user bundle.\n\nfunction normalizeComponent (\n  scriptExports,\n  render,\n  staticRenderFns,\n  functionalTemplate,\n  injectStyles,\n  scopeId,\n  moduleIdentifier, /* server only */\n  shadowMode /* vue-cli only */\n) {\n  // Vue.extend constructor export interop\n  var options = typeof scriptExports === 'function'\n    ? scriptExports.options\n    : scriptExports\n\n  // render functions\n  if (render) {\n    options.render = render\n    options.staticRenderFns = staticRenderFns\n    options._compiled = true\n  }\n\n  // functional template\n  if (functionalTemplate) {\n    options.functional = true\n  }\n\n  // scopedId\n  if (scopeId) {\n    options._scopeId = 'data-v-' + scopeId\n  }\n\n  var hook\n  if (moduleIdentifier) { // server build\n    hook = function (context) {\n      // 2.3 injection\n      context =\n        context || // cached call\n        (this.$vnode && this.$vnode.ssrContext) || // stateful\n        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional\n      // 2.2 with runInNewContext: true\n      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {\n        context = __VUE_SSR_CONTEXT__\n      }\n      // inject component styles\n      if (injectStyles) {\n        injectStyles.call(this, context)\n      }\n      // register component module identifier for async chunk inferrence\n      if (context && context._registeredComponents) {\n        context._registeredComponents.add(moduleIdentifier)\n      }\n    }\n    // used by ssr in case component is cached and beforeCreate\n    // never gets called\n    options._ssrRegister = hook\n  } else if (injectStyles) {\n    hook = shadowMode\n      ? function () {\n        injectStyles.call(\n          this,\n          (options.functional ? this.parent : this).$root.$options.shadowRoot\n        )\n      }\n      : injectStyles\n  }\n\n  if (hook) {\n    if (options.functional) {\n      // for template-only hot-reload because in that case the render fn doesn't\n      // go through the normalizer\n      options._injectStyles = hook\n      // register for functional component in vue file\n      var originalRender = options.render\n      options.render = function renderWithStyleInjection (h, context) {\n        hook.call(context)\n        return originalRender(h, context)\n      }\n    } else {\n      // inject component registration as beforeCreate hook\n      var existing = options.beforeCreate\n      options.beforeCreate = existing\n        ? [].concat(existing, hook)\n        : [hook]\n    }\n  }\n\n  return {\n    exports: scriptExports,\n    options: options\n  }\n}\n\n\n//# sourceURL=webpack:///./node_modules/vue-loader/lib/runtime/componentNormalizer.js?");

/***/ }),

/***/ "./resources/js/bootstrap.js":
/*!***********************************!*\
  !*** ./resources/js/bootstrap.js ***!
  \***********************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ \"vue\");\n/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _medias_KyoMedias__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./medias/KyoMedias */ \"./resources/js/medias/KyoMedias.jsx\");\n/* harmony import */ var _medias_KyoMediaCreate__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./medias/KyoMediaCreate */ \"./resources/js/medias/KyoMediaCreate.vue\");\n/* harmony import */ var _medias_KyoMediaEdit__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./medias/KyoMediaEdit */ \"./resources/js/medias/KyoMediaEdit.vue\");\n/* harmony import */ var _modals_KyoVideos__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./modals/KyoVideos */ \"./resources/js/modals/KyoVideos.jsx\");\n/* harmony import */ var _modals_KyoUploads__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./modals/KyoUploads */ \"./resources/js/modals/KyoUploads.jsx\");\n\n\nvue__WEBPACK_IMPORTED_MODULE_0___default.a.component(_medias_KyoMedias__WEBPACK_IMPORTED_MODULE_1__[\"default\"].name, _medias_KyoMedias__WEBPACK_IMPORTED_MODULE_1__[\"default\"]);\n\nvue__WEBPACK_IMPORTED_MODULE_0___default.a.component(_medias_KyoMediaCreate__WEBPACK_IMPORTED_MODULE_2__[\"default\"].name, _medias_KyoMediaCreate__WEBPACK_IMPORTED_MODULE_2__[\"default\"]);\n\nvue__WEBPACK_IMPORTED_MODULE_0___default.a.component(_medias_KyoMediaEdit__WEBPACK_IMPORTED_MODULE_3__[\"default\"].name, _medias_KyoMediaEdit__WEBPACK_IMPORTED_MODULE_3__[\"default\"]);\n\nvue__WEBPACK_IMPORTED_MODULE_0___default.a.component(_modals_KyoVideos__WEBPACK_IMPORTED_MODULE_4__[\"default\"].name, _modals_KyoVideos__WEBPACK_IMPORTED_MODULE_4__[\"default\"]);\n\nvue__WEBPACK_IMPORTED_MODULE_0___default.a.component(_modals_KyoUploads__WEBPACK_IMPORTED_MODULE_5__[\"default\"].name, _modals_KyoUploads__WEBPACK_IMPORTED_MODULE_5__[\"default\"]);\n\nif (console && console.log) {\n  console.log('kyoto/media ready.');\n}\n\n//# sourceURL=webpack:///./resources/js/bootstrap.js?");

/***/ }),

/***/ "./resources/js/medias/KyoMediaCreate.vue":
/*!************************************************!*\
  !*** ./resources/js/medias/KyoMediaCreate.vue ***!
  \************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _KyoMediaCreate_vue_vue_type_template_id_66a5d670___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./KyoMediaCreate.vue?vue&type=template&id=66a5d670& */ \"./resources/js/medias/KyoMediaCreate.vue?vue&type=template&id=66a5d670&\");\n/* harmony import */ var _KyoMediaCreate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./KyoMediaCreate.vue?vue&type=script&lang=js& */ \"./resources/js/medias/KyoMediaCreate.vue?vue&type=script&lang=js&\");\n/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ \"./node_modules/vue-loader/lib/runtime/componentNormalizer.js\");\n\n\n\n\n\n/* normalize component */\n\nvar component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__[\"default\"])(\n  _KyoMediaCreate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__[\"default\"],\n  _KyoMediaCreate_vue_vue_type_template_id_66a5d670___WEBPACK_IMPORTED_MODULE_0__[\"render\"],\n  _KyoMediaCreate_vue_vue_type_template_id_66a5d670___WEBPACK_IMPORTED_MODULE_0__[\"staticRenderFns\"],\n  false,\n  null,\n  null,\n  null\n  \n)\n\n/* harmony default export */ __webpack_exports__[\"default\"] = (component.exports);\n\n//# sourceURL=webpack:///./resources/js/medias/KyoMediaCreate.vue?");

/***/ }),

/***/ "./resources/js/medias/KyoMediaCreate.vue?vue&type=script&lang=js&":
/*!*************************************************************************!*\
  !*** ./resources/js/medias/KyoMediaCreate.vue?vue&type=script&lang=js& ***!
  \*************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_0_node_modules_vue_loader_lib_index_js_vue_loader_options_KyoMediaCreate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--0!../../../node_modules/vue-loader/lib??vue-loader-options!./KyoMediaCreate.vue?vue&type=script&lang=js& */ \"./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/medias/KyoMediaCreate.vue?vue&type=script&lang=js&\");\n/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__[\"default\"] = (_node_modules_babel_loader_lib_index_js_ref_0_node_modules_vue_loader_lib_index_js_vue_loader_options_KyoMediaCreate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__[\"default\"]); \n\n//# sourceURL=webpack:///./resources/js/medias/KyoMediaCreate.vue?");

/***/ }),

/***/ "./resources/js/medias/KyoMediaCreate.vue?vue&type=template&id=66a5d670&":
/*!*******************************************************************************!*\
  !*** ./resources/js/medias/KyoMediaCreate.vue?vue&type=template&id=66a5d670& ***!
  \*******************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_KyoMediaCreate_vue_vue_type_template_id_66a5d670___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./KyoMediaCreate.vue?vue&type=template&id=66a5d670& */ \"./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/medias/KyoMediaCreate.vue?vue&type=template&id=66a5d670&\");\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, \"render\", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_KyoMediaCreate_vue_vue_type_template_id_66a5d670___WEBPACK_IMPORTED_MODULE_0__[\"render\"]; });\n\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, \"staticRenderFns\", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_KyoMediaCreate_vue_vue_type_template_id_66a5d670___WEBPACK_IMPORTED_MODULE_0__[\"staticRenderFns\"]; });\n\n\n\n//# sourceURL=webpack:///./resources/js/medias/KyoMediaCreate.vue?");

/***/ }),

/***/ "./resources/js/medias/KyoMediaEdit.vue":
/*!**********************************************!*\
  !*** ./resources/js/medias/KyoMediaEdit.vue ***!
  \**********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _KyoMediaEdit_vue_vue_type_template_id_283ff37c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./KyoMediaEdit.vue?vue&type=template&id=283ff37c& */ \"./resources/js/medias/KyoMediaEdit.vue?vue&type=template&id=283ff37c&\");\n/* harmony import */ var _KyoMediaEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./KyoMediaEdit.vue?vue&type=script&lang=js& */ \"./resources/js/medias/KyoMediaEdit.vue?vue&type=script&lang=js&\");\n/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ \"./node_modules/vue-loader/lib/runtime/componentNormalizer.js\");\n\n\n\n\n\n/* normalize component */\n\nvar component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__[\"default\"])(\n  _KyoMediaEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__[\"default\"],\n  _KyoMediaEdit_vue_vue_type_template_id_283ff37c___WEBPACK_IMPORTED_MODULE_0__[\"render\"],\n  _KyoMediaEdit_vue_vue_type_template_id_283ff37c___WEBPACK_IMPORTED_MODULE_0__[\"staticRenderFns\"],\n  false,\n  null,\n  null,\n  null\n  \n)\n\n/* harmony default export */ __webpack_exports__[\"default\"] = (component.exports);\n\n//# sourceURL=webpack:///./resources/js/medias/KyoMediaEdit.vue?");

/***/ }),

/***/ "./resources/js/medias/KyoMediaEdit.vue?vue&type=script&lang=js&":
/*!***********************************************************************!*\
  !*** ./resources/js/medias/KyoMediaEdit.vue?vue&type=script&lang=js& ***!
  \***********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_0_node_modules_vue_loader_lib_index_js_vue_loader_options_KyoMediaEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--0!../../../node_modules/vue-loader/lib??vue-loader-options!./KyoMediaEdit.vue?vue&type=script&lang=js& */ \"./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/medias/KyoMediaEdit.vue?vue&type=script&lang=js&\");\n/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__[\"default\"] = (_node_modules_babel_loader_lib_index_js_ref_0_node_modules_vue_loader_lib_index_js_vue_loader_options_KyoMediaEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__[\"default\"]); \n\n//# sourceURL=webpack:///./resources/js/medias/KyoMediaEdit.vue?");

/***/ }),

/***/ "./resources/js/medias/KyoMediaEdit.vue?vue&type=template&id=283ff37c&":
/*!*****************************************************************************!*\
  !*** ./resources/js/medias/KyoMediaEdit.vue?vue&type=template&id=283ff37c& ***!
  \*****************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_KyoMediaEdit_vue_vue_type_template_id_283ff37c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./KyoMediaEdit.vue?vue&type=template&id=283ff37c& */ \"./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/medias/KyoMediaEdit.vue?vue&type=template&id=283ff37c&\");\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, \"render\", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_KyoMediaEdit_vue_vue_type_template_id_283ff37c___WEBPACK_IMPORTED_MODULE_0__[\"render\"]; });\n\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, \"staticRenderFns\", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_KyoMediaEdit_vue_vue_type_template_id_283ff37c___WEBPACK_IMPORTED_MODULE_0__[\"staticRenderFns\"]; });\n\n\n\n//# sourceURL=webpack:///./resources/js/medias/KyoMediaEdit.vue?");

/***/ }),

/***/ "./resources/js/medias/KyoMedias.jsx":
/*!*******************************************!*\
  !*** ./resources/js/medias/KyoMedias.jsx ***!
  \*******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _vue_babel_helper_vue_jsx_merge_props__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @vue/babel-helper-vue-jsx-merge-props */ \"./node_modules/@vue/babel-helper-vue-jsx-merge-props/dist/helper.js\");\n/* harmony import */ var _vue_babel_helper_vue_jsx_merge_props__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_vue_babel_helper_vue_jsx_merge_props__WEBPACK_IMPORTED_MODULE_0__);\n\n\n/* harmony default export */ __webpack_exports__[\"default\"] = ({\n  name: 'KyoMedias',\n  \"extends\": window.KyoIndex,\n  localized: true,\n  urls: {\n    index: '/{locale}/kyoto/media/http/controllers/media/index',\n    move: '/{locale}/kyoto/media/http/controllers/media/move',\n    \"delete\": '/{locale}/kyoto/media/http/controllers/media/delete'\n  },\n  defaults: function defaults() {\n    var query = {\n      parent: '',\n      page: 1,\n      limit: 100,\n      prop: 'title',\n      dir: 'asc',\n      filter: [],\n      search: '',\n      columns: ['title', 'type']\n    };\n    return {\n      query: query\n    };\n  },\n  data: function data() {\n    return {\n      parent: null,\n      filelist: []\n    };\n  },\n  beforeMount: function beforeMount() {\n    this.getParent();\n  },\n  mounted: function mounted() {\n    this.$watch('query.parent', this.loadItems);\n    Nano.Event.bind('media:refresh', this.loadItems);\n  },\n  watch: {\n    '$route': function $route() {\n      this.getParent();\n    },\n    'result.breadcrumbs': function resultBreadcrumbs() {\n      this.setParent();\n    }\n  },\n  methods: {\n    addFile: function addFile(file) {\n      this.filelist.push({\n        id: this.UUID(),\n        file: file\n      });\n    },\n    setParent: function setParent() {\n      this.parent = Nano.Arr.last(this.result.breadcrumbs);\n    },\n    getParent: function getParent() {\n      this.query.parent = window.location.hash.replace(/^#/, '');\n    },\n    gotoHome: function gotoHome() {\n      this.$router.push({\n        name: 'KyoMedias'\n      });\n    },\n    gotoParent: function gotoParent() {\n      if (!Nano.Obj.get(this.parent, 'above.id')) {\n        return this.gotoHome();\n      }\n\n      this.$router.push({\n        name: 'KyoMedias',\n        hash: \"#\".concat(this.parent.above.id)\n      });\n    },\n    gotoFolder: function gotoFolder(row) {\n      if (!Nano.Obj.get(row, 'item.id')) {\n        return this.gotoHome();\n      }\n\n      this.$router.push({\n        name: 'KyoMedias',\n        hash: \"#\".concat(row.item.id)\n      });\n    },\n    gotoFile: function gotoFile(row) {\n      this.$router.push({\n        name: this.__self(null, 'Edit'),\n        params: row.item\n      });\n    },\n    gotoCreate: function gotoCreate() {\n      var options = {\n        name: this.__self(null, 'Create')\n      };\n\n      if (this.parent) {\n        options.hash = \"#\".concat(this.parent.id);\n      }\n\n      this.$router.push(options);\n    },\n    gotoEdit: function gotoEdit(row) {\n      Nano.Arr.has(['system/folder', 'system/above'], row.item.type) ? this.gotoFolder(row) : this.gotoFile(row);\n    },\n    allowSelect: function allowSelect(source) {\n      return source.veItem.type !== 'system/above';\n    },\n    allowDrag: function allowDrag(source) {\n      return source.veItem.type !== 'system/above';\n    },\n    allowDrop: function allowDrop(source, target) {\n      if (source.item.type === 'system/above') {\n        return false;\n      }\n\n      return Nano.Arr.has(['system/folder', 'system/above'], Nano.Obj.get(target, 'item.type'));\n    }\n  },\n  renderNode: function renderNode(_ref) {\n    var value = _ref.value;\n    var h = this.$createElement;\n    var renderImage = h(\"div\", {\n      \"class\": \"kyo-media-item__image\"\n    }, [h(\"img\", {\n      \"attrs\": {\n        \"src\": value.urls['square/sm'],\n        \"alt\": value.name\n      }\n    })]);\n    var renderIcon = h(\"div\", {\n      \"class\": \"kyo-media-item__icon\",\n      \"attrs\": {\n        \"data-type\": value.type\n      }\n    }, [h(\"span\", [value.type.match(/^system\\//) ? value.count : value.file.replace(/^(.*?)\\./, '')])]);\n    return h(\"div\", {\n      \"class\": \"kyo-media-item\"\n    }, [value.view ? renderImage : renderIcon, h(\"div\", {\n      \"class\": \"kyo-media-item__title\"\n    }, [value.title]), h(\"div\", {\n      \"class\": \"kyo-media-item__meta\"\n    }, [value.type])]);\n  },\n  render: function render() {\n    var _this = this;\n\n    var h = arguments[0];\n    var datagridProps = {\n      current: this.current,\n      selected: this.selected,\n      items: this.result.data,\n      uniqueProp: 'uid',\n      itemHeight: 215,\n      renderSelect: true,\n      insertNode: false,\n      removeNode: false,\n      moveItems: false,\n      allowSelect: this.allowSelect,\n      allowDrag: this.allowDrag,\n      allowDrop: this.allowDrop,\n      renderNode: this.ctor('renderNode')\n    };\n    var datagridEvents = {\n      'update:current': function updateCurrent(value) {\n        return _this.current = value;\n      },\n      'update:selected': function updateSelected(value) {\n        return _this.selected = value;\n      },\n      'move': this.onMove,\n      'row-dblclick': this.gotoEdit\n    };\n    var paginatorProps = {\n      page: this.query.page,\n      limit: this.query.limit,\n      total: this.result.total,\n      layout: ['limit', 'count', 'spacer', 'goto', 'pages']\n    };\n    var paginatorEvents = {\n      'update:page': function updatePage(value) {\n        return _this.query.page = value;\n      },\n      'update:limit': function updateLimit(value) {\n        return _this.query.limit = value;\n      }\n    };\n    return h(\"NLoader\", {\n      \"attrs\": {\n        \"visible\": this.load\n      },\n      \"class\": \"full-height-child\"\n    }, [h(\"div\", {\n      \"class\": \"grid grid--col\"\n    }, [h(\"KyoTitlebar\", {\n      \"class\": \"col--flex-0-0\",\n      \"on\": {\n        \"delete\": this.deleteItems\n      }\n    }, [h(\"template\", {\n      \"slot\": \"search\"\n    }, [h(\"KyoTitlebarSearch\", {\n      \"model\": {\n        value: _this.query.search,\n        callback: function callback($$v) {\n          _this.$set(_this.query, \"search\", $$v);\n        }\n      }\n    })])]), h(\"KyoFilterbar\", {\n      \"class\": \"col--flex-0-0\"\n    }, [h(\"div\", {\n      \"class\": \"grid grid--row grid--10\"\n    }, [h(\"div\", {\n      \"class\": \"col--auto\"\n    }, [h(\"NButton\", {\n      \"attrs\": {\n        \"icon\": \"fa fa-home\",\n        \"disabled\": !this.query.parent\n      },\n      \"on\": {\n        \"click\": this.gotoHome\n      }\n    }, [this.trans('Root')])]), h(\"div\", {\n      \"class\": \"col--auto\"\n    }, [h(\"NButton\", {\n      \"attrs\": {\n        \"icon\": \"fa fa-arrow-up\",\n        \"disabled\": !this.query.parent\n      },\n      \"on\": {\n        \"click\": this.gotoParent\n      }\n    }, [this.trans('Above')])]), h(\"div\", {\n      \"class\": \"col--auto\"\n    }, [h(\"div\", {\n      \"style\": \"width: 10px;\"\n    })]), h(\"div\", {\n      \"class\": \"col--auto \"\n    }, [h(\"NButton\", {\n      \"attrs\": {\n        \"type\": \"success\",\n        \"icon\": \"fa fa-folder\"\n      },\n      \"on\": {\n        \"click\": this.gotoCreate\n      }\n    }, [this.trans('New folder')])]), h(\"div\", {\n      \"class\": \"col--auto\"\n    }, [h(\"KyoVideos\")]), h(\"div\", {\n      \"class\": \"col--auto\"\n    }, [h(\"KyoUploads\")]), h(\"div\", {\n      \"class\": \"col--auto col--right\"\n    }, [h(\"NSelect\", {\n      \"style\": \"width: 200px;\"\n    }, [h(\"NSelectOption\", {\n      \"attrs\": {\n        \"value\": \"1\"\n      }\n    }, [\"Testitem\"]), h(\"NSelectOption\", {\n      \"attrs\": {\n        \"value\": \"2\"\n      }\n    }, [\"Testitem\"]), h(\"NSelectOption\", {\n      \"attrs\": {\n        \"value\": \"3\"\n      }\n    }, [\"Testitem\"]), h(\"NSelectOption\", {\n      \"attrs\": {\n        \"value\": \"4\"\n      }\n    }, [\"Testitem\"]), h(\"NSelectOption\", {\n      \"attrs\": {\n        \"value\": \"5\"\n      }\n    }, [\"Testitem\"])])])])]), h(\"div\", {\n      \"class\": \"kyo-datatable col--flex-1-0\"\n    }, [h(\"NDraggrid\", _vue_babel_helper_vue_jsx_merge_props__WEBPACK_IMPORTED_MODULE_0___default()([{\n      \"class\": \"kyo-medias\"\n    }, {\n      \"props\": datagridProps\n    }, {}, {\n      \"on\": datagridEvents\n    }])), h(\"NPaginator\", _vue_babel_helper_vue_jsx_merge_props__WEBPACK_IMPORTED_MODULE_0___default()([{}, {\n      \"props\": paginatorProps\n    }, {}, {\n      \"on\": paginatorEvents\n    }]))])])]);\n  }\n});\n\n//# sourceURL=webpack:///./resources/js/medias/KyoMedias.jsx?");

/***/ }),

/***/ "./resources/js/modals/KyoUploads.jsx":
/*!********************************************!*\
  !*** ./resources/js/modals/KyoUploads.jsx ***!
  \********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony default export */ __webpack_exports__[\"default\"] = ({\n  name: 'KyoUploads',\n  inject: {\n    KyoIndex: {\n      fallback: undefined\n    }\n  },\n  computed: {\n    parent: function parent() {\n      return this.KyoIndex.query.parent || null;\n    }\n  },\n  data: function data() {\n    return {\n      visible: false,\n      text: null,\n      filelist: []\n    };\n  },\n  beforeMount: function beforeMount() {\n    this.text = this.changeText();\n  },\n  mounted: function mounted() {\n    this.Dom.find(document.body).on('drop', this.eventDrop, this._uid);\n    this.Dom.find(document.body).on('dragenter', this.eventDragenter, this._uid);\n    this.Dom.find(document.body).on('dragend', this.eventDragend, this._uid);\n    this.Dom.find(document.body).on('dragover', this.eventDragover, this._uid);\n  },\n  beforeDestroy: function beforeDestroy() {\n    this.Dom.find(document.body).off('drop', null, this._uid);\n    this.Dom.find(document.body).off('dragenter', null, this._uid);\n    this.Dom.find(document.body).off('dragend', null, this._uid);\n    this.Dom.find(document.body).off('dragover', null, this._uid);\n  },\n  methods: {\n    eventDragenter: function eventDragenter(event) {\n      if (!event.dataTransfer.files.length && !event.dataTransfer.items.length) {\n        return;\n      }\n\n      event.preventDefault();\n    },\n    eventDragover: function eventDragover(event) {\n      if (!this.visible) {\n        return;\n      }\n\n      event.preventDefault();\n    },\n    eventDragend: function eventDragend(event) {\n      if (!this.visible) {\n        return;\n      }\n\n      event.preventDefault();\n    },\n    eventDrop: function eventDrop(event) {\n      if (!event.dataTransfer.files.length && !event.dataTransfer.items.length) {\n        return;\n      }\n\n      event.preventDefault();\n\n      if (this.visible) {\n        return;\n      }\n\n      Nano.Obj.each(event.dataTransfer.files, this.addFile);\n\n      if (!this.filelist.length) {\n        return;\n      }\n\n      this.visible = true;\n      Nano.Any.delay(this.storeItem, 150);\n    },\n    addLegacy: function addLegacy() {\n      Nano.Obj.each(this.$refs.legacy.files, this.addFile);\n\n      if (!this.filelist.length) {\n        return;\n      }\n\n      this.visible = true;\n      Nano.Any.delay(this.storeItem, 150);\n    },\n    addFile: function addFile(file) {\n      this.filelist.push({\n        id: Nano.UUID(),\n        parent_id: this.parent,\n        file: file\n      });\n    },\n    changeText: function changeText() {\n      var callback = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;\n\n      if (Nano.Any.isFunction(callback)) {\n        callback.call(this);\n      }\n\n      if (Math.round(Math.random() * 4) === 1) {\n        return 'Flashing :count files into the cloud ...';\n      }\n\n      if (Math.round(Math.random() * 4) === 1) {\n        return 'Pushing bits on the server ... :count files remaining';\n      }\n\n      if (Math.round(Math.random() * 4) === 1) {\n        return 'Only a few seconds remaining ... :count files';\n      }\n\n      return 'Flying in the cloud ... :count files are done';\n    },\n    storeItem: function storeItem() {\n      if (Nano.Any.isEmpty(this.filelist)) {\n        return;\n      }\n\n      var route = this.Route.get('/{locale}/kyoto/media/http/controllers/media/upload', this.$root.$data);\n      this.cancelToken = this.$http.CancelToken.source();\n      var options = {\n        cancelToken: this.cancelToken.token\n      };\n      this.$http.post(route, Nano.Ajax.form(this.filelist[0]), options).then(this.fetchDone, this.fetchDone);\n    },\n    fetchDone: function fetchDone() {\n      var _this = this;\n\n      this.text = this.changeText(function () {\n        Nano.Arr.removeIndex(_this.filelist, 0);\n      });\n\n      if (!Nano.Any.isEmpty(this.filelist)) {\n        return Nano.Any.delay(this.storeItem, 100);\n      }\n\n      this.visible = false;\n      Nano.Event.fire('media:refresh');\n    }\n  },\n  render: function render() {\n    var _this2 = this;\n\n    var h = arguments[0];\n    return h(\"div\", {\n      \"class\": \"kyo-media__uploads\"\n    }, [h(\"NButton\", {\n      \"attrs\": {\n        \"icon\": \"fa fa-cloud-upload-alt\"\n      },\n      \"on\": {\n        \"click\": function click() {\n          return _this2.$refs.legacy.click();\n        }\n      }\n    }, [this.trans('Upload')]), h(\"NModal\", {\n      \"attrs\": {\n        \"type\": \"upload\",\n        \"visible\": this.visible,\n        \"selector\": false,\n        \"closable\": false,\n        \"width\": \"360px\"\n      }\n    }, [h(\"div\", {\n      \"class\": \"kyo-upload-animation\"\n    }), h(\"div\", {\n      \"class\": \"kyo-upload-text\"\n    }, [this.trans(this.text, {\n      count: this.filelist.length\n    })])]), h(\"input\", {\n      \"ref\": \"legacy\",\n      \"attrs\": {\n        \"type\": \"file\",\n        \"multiple\": true\n      },\n      \"style\": \"display: none !important;\",\n      \"on\": {\n        \"change\": this.addLegacy\n      }\n    })]);\n  }\n});\n\n//# sourceURL=webpack:///./resources/js/modals/KyoUploads.jsx?");

/***/ }),

/***/ "./resources/js/modals/KyoVideos.jsx":
/*!*******************************************!*\
  !*** ./resources/js/modals/KyoVideos.jsx ***!
  \*******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony default export */ __webpack_exports__[\"default\"] = ({\n  name: 'KyoVideos',\n  inject: {\n    KyoIndex: {\n      fallback: undefined\n    }\n  },\n  computed: {\n    parent: function parent() {\n      return this.KyoIndex.query.parent || null;\n    }\n  },\n  data: function data() {\n    return {\n      visible: false,\n      clipboard: null,\n      video: null,\n      filelist: []\n    };\n  },\n  watch: {\n    'clipboard': function clipboard() {\n      this.resolveVideo();\n    }\n  },\n  mounted: function mounted() {\n    this.Dom.find(window).on('focus', this.eventFocus, this._uid);\n  },\n  beforeDestroy: function beforeDestroy() {\n    this.Dom.find(window).off('focus', null, this._uid);\n  },\n  methods: {\n    eventFocus: function eventFocus(event) {\n      var _this = this;\n\n      navigator.clipboard.readText().then(function (data) {\n        if (data.match(/^https?:\\/\\//)) {\n          _this.clipboard = data;\n        }\n      });\n    },\n    resolveVideo: function resolveVideo() {\n      this.video = null;\n      var youtube = this.clipboard.match(/^https?:\\/\\/(www\\.)?youtube\\.[a-z]{2,3}\\/watch\\?v=([^\\&]+)/);\n\n      if (youtube) {\n        this.video = {\n          file: Nano.Arr.last(youtube),\n          type: 'video/youtube'\n        };\n      }\n\n      var vimeo = this.clipboard.match(/^https?:\\/\\/(www\\.)?vimeo\\.[a-z]{2,3}\\/([^\\&\\?]+)/);\n\n      if (vimeo) {\n        this.video = {\n          file: Nano.Arr.last(vimeo),\n          type: 'video/vimeo'\n        };\n      }\n    },\n    storeItem: function storeItem() {\n      if (Nano.Any.isEmpty(this.video)) {\n        return;\n      }\n\n      var route = this.Route.get('/{locale}/kyoto/media/http/controllers/media/store', this.$root.$data);\n      var data = Nano.Obj.assign({}, this.video, {\n        id: Nano.UUID(),\n        parent_id: this.parent\n      });\n      this.$http.post(route, data).then(this.fetchDone, this.fetchDone);\n    },\n    fetchDone: function fetchDone() {\n      this.visible = false;\n      Nano.Event.fire('media:refresh');\n    }\n  },\n  renderPreview: function renderPreview() {\n    var h = this.$createElement;\n\n    if (this.video && this.video.type === 'video/youtube') {\n      return h(\"iframe\", {\n        \"attrs\": {\n          \"src\": \"https://www.youtube.com/embed/\".concat(this.video.file),\n          \"frameborder\": \"0\"\n        }\n      });\n    }\n\n    if (this.video && this.video.type === 'video/vimeo') {\n      return h(\"iframe\", {\n        \"attrs\": {\n          \"src\": \"https://player.vimeo.com/video/\".concat(this.video.file),\n          \"frameborder\": \"0\"\n        }\n      });\n    }\n\n    return null;\n  },\n  render: function render() {\n    var _this2 = this;\n\n    var h = arguments[0];\n    return h(\"div\", {\n      \"class\": \"kyo-media__videos\"\n    }, [h(\"NButton\", {\n      \"attrs\": {\n        \"icon\": \"fa fa-photo-video\"\n      },\n      \"on\": {\n        \"click\": function click() {\n          return _this2.visible = true;\n        }\n      }\n    }, [this.trans('Webvideo')]), h(\"NModal\", {\n      \"attrs\": {\n        \"type\": \"video\",\n        \"selector\": false,\n        \"closable\": true,\n        \"width\": \"800px\"\n      },\n      \"model\": {\n        value: _this2.visible,\n        callback: function callback($$v) {\n          _this2.visible = $$v;\n        }\n      }\n    }, [h(\"div\", {\n      \"class\": \"kyo-video-preview\"\n    }, [this.ctor('renderPreview')()]), h(\"div\", {\n      \"class\": \"kyo-video-text\"\n    }, [h(\"div\", {\n      \"class\": \"grid grid--row grid--10\"\n    }, [h(\"div\", {\n      \"class\": \"col--flex-1-1\"\n    }, [h(\"NInput\", {\n      \"model\": {\n        value: _this2.clipboard,\n        callback: function callback($$v) {\n          _this2.clipboard = $$v;\n        }\n      }\n    })]), h(\"div\", {\n      \"class\": \"col--flex-0-0\"\n    }, [h(\"NButton\", {\n      \"attrs\": {\n        \"disabled\": !this.video\n      },\n      \"on\": {\n        \"click\": this.storeItem\n      }\n    }, [this.trans('Save video')])])])])])]);\n  }\n});\n\n//# sourceURL=webpack:///./resources/js/modals/KyoVideos.jsx?");

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