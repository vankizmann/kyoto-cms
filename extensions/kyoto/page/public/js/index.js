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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/KyoPageCreate.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/KyoPageCreate.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'KyoPageCreate',
  localized: false,
  urls: {
    show: '/{locale}/kyoto/page/http/controllers/page/show',
    store: '/{locale}/kyoto/page/http/controllers/page/store'
  },
  methods: {
    gotoEdit: function gotoEdit(row) {
      this.$router.push({
        name: 'KyoPageEdit',
        params: row.data
      });
      console.log(row.data);
    },
    gotoIndex: function gotoIndex() {
      this.$router.push({
        name: 'KyoPages'
      });
    }
  },
  "extends": window.KyoForm
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/KyoPageEdit.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/KyoPageEdit.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'KyoPageEdit',
  localized: true,
  urls: {
    show: '/{locale}/kyoto/page/http/controllers/page/show',
    update: '/{locale}/kyoto/page/http/controllers/page/update',
    "delete": '/{locale}/kyoto/page/http/controllers/page/delete'
  },
  methods: {
    gotoIndex: function gotoIndex() {
      this.$router.push({
        name: 'KyoPages'
      });
    }
  },
  "extends": window.KyoForm
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/KyoPages.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/KyoPages.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'KyoPages',
  localized: true,
  urls: {
    index: '/{locale}/kyoto/page/http/controllers/page/index',
    "delete": '/{locale}/kyoto/page/http/controllers/page/delete'
  },
  defaults: function defaults() {
    var query = {
      page: 1,
      limit: 25,
      prop: 'updated_at',
      dir: 'asc',
      filter: [],
      search: '',
      columns: ['title', 'content']
    };
    return {
      query: query
    };
  },
  "extends": window.KyoIndex
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/KyoPageCreate.vue?vue&type=template&id=22f38b53&":
/*!***********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/KyoPageCreate.vue?vue&type=template&id=22f38b53& ***!
  \***********************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "NLoader",
    { staticClass: "full-height-child", attrs: { visible: _vm.load } },
    [
      _c(
        "div",
        { staticClass: "grid grid--col" },
        [
          _c(
            "KyoTitlebar",
            {
              staticClass: "col--flex-0-0",
              attrs: { link: { name: "KyoPages" } }
            },
            [
              _c(
                "template",
                { slot: "action" },
                [
                  _c(
                    "NButtonGroup",
                    [
                      _c(
                        "NButton",
                        {
                          attrs: { type: "primary" },
                          on: { click: _vm.storeItem }
                        },
                        [
                          _vm._v(
                            "\n                        " +
                              _vm._s(_vm.trans("Apply")) +
                              "\n                    "
                          )
                        ]
                      ),
                      _vm._v(" "),
                      _c(
                        "NButton",
                        {
                          attrs: { type: "primary" },
                          on: { click: _vm.storeItemClose }
                        },
                        [
                          _vm._v(
                            "\n                        " +
                              _vm._s(_vm.trans("Save")) +
                              "\n                    "
                          )
                        ]
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ],
            2
          ),
          _vm._v(" "),
          _c(
            "NForm",
            {
              staticClass: "kyo-dataform col--flex-1-0",
              attrs: { form: _vm.result, errors: _vm.errors }
            },
            [
              _c(
                "NFormGroup",
                { attrs: { icon: "fa fa-cog", legend: _vm.trans("Settings") } },
                [
                  _c(
                    "div",
                    { staticClass: "grid grid-row grid--wrap grid--30" },
                    [
                      _c(
                        "div",
                        { staticClass: "col--1-1 col--1-2@sm" },
                        [
                          _c(
                            "NFormItem",
                            {
                              attrs: {
                                label: _vm.trans("State"),
                                prop: "state"
                              }
                            },
                            [
                              _c(
                                "NSwitch",
                                {
                                  attrs: { "on-value": 1, "off-value": 0 },
                                  model: {
                                    value: _vm.result.state,
                                    callback: function($$v) {
                                      _vm.$set(_vm.result, "state", $$v)
                                    },
                                    expression: "result.state"
                                  }
                                },
                                [
                                  _vm._v(
                                    "\n                                " +
                                      _vm._s(_vm.trans("Page is enabled")) +
                                      "\n                            "
                                  )
                                ]
                              )
                            ],
                            1
                          )
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        { staticClass: "col--1-1 col--1-2@sm" },
                        [
                          _c(
                            "NFormItem",
                            {
                              attrs: { label: _vm.trans("Hide"), prop: "hide" }
                            },
                            [
                              _c(
                                "NSwitch",
                                {
                                  attrs: { "on-value": 1, "off-value": 0 },
                                  model: {
                                    value: _vm.result.hide,
                                    callback: function($$v) {
                                      _vm.$set(_vm.result, "hide", $$v)
                                    },
                                    expression: "result.hide"
                                  }
                                },
                                [
                                  _vm._v(
                                    "\n                                " +
                                      _vm._s(_vm.trans("Page is hidden")) +
                                      "\n                            "
                                  )
                                ]
                              )
                            ],
                            1
                          )
                        ],
                        1
                      )
                    ]
                  )
                ]
              ),
              _vm._v(" "),
              _c(
                "NFormGroup",
                { attrs: { icon: "fa fa-page", legend: _vm.trans("Page") } },
                [
                  _c(
                    "div",
                    { staticClass: "grid grid-row grid--wrap grid--30" },
                    [
                      _c(
                        "div",
                        { staticClass: "col--1-1" },
                        [
                          _c(
                            "NFormItem",
                            {
                              attrs: {
                                label: _vm.trans("Title"),
                                prop: "title"
                              }
                            },
                            [
                              _c("NInput", {
                                model: {
                                  value: _vm.result.title,
                                  callback: function($$v) {
                                    _vm.$set(_vm.result, "title", $$v)
                                  },
                                  expression: "result.title"
                                }
                              })
                            ],
                            1
                          )
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        { staticClass: "col--1-1" },
                        [
                          _c(
                            "NFormItem",
                            {
                              attrs: {
                                label: _vm.trans("Content"),
                                prop: "content"
                              }
                            },
                            [
                              _c("NTextarea", {
                                model: {
                                  value: _vm.result.content,
                                  callback: function($$v) {
                                    _vm.$set(_vm.result, "content", $$v)
                                  },
                                  expression: "result.content"
                                }
                              })
                            ],
                            1
                          )
                        ],
                        1
                      )
                    ]
                  )
                ]
              )
            ],
            1
          )
        ],
        1
      )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/KyoPageEdit.vue?vue&type=template&id=d1e6f5be&":
/*!*********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/KyoPageEdit.vue?vue&type=template&id=d1e6f5be& ***!
  \*********************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "NLoader",
    { staticClass: "full-height-child", attrs: { visible: _vm.load } },
    [
      _c(
        "div",
        { staticClass: "grid grid--col" },
        [
          _c(
            "KyoTitlebar",
            {
              staticClass: "col--flex-0-0",
              attrs: { link: { name: "KyoPages" } },
              on: { delete: _vm.deleteItem }
            },
            [
              _c(
                "template",
                { slot: "action" },
                [
                  _c(
                    "NButtonGroup",
                    [
                      _c(
                        "NButton",
                        {
                          attrs: { type: "primary" },
                          on: { click: _vm.updateItem }
                        },
                        [
                          _vm._v(
                            "\n                        " +
                              _vm._s(_vm.trans("Apply")) +
                              "\n                    "
                          )
                        ]
                      ),
                      _vm._v(" "),
                      _c(
                        "NButton",
                        {
                          attrs: { type: "primary" },
                          on: { click: _vm.updateCloseItem }
                        },
                        [
                          _vm._v(
                            "\n                        " +
                              _vm._s(_vm.trans("Save")) +
                              "\n                    "
                          )
                        ]
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ],
            2
          ),
          _vm._v(" "),
          _c(
            "NForm",
            {
              staticClass: "kyo-dataform col--flex-1-0",
              attrs: { form: _vm.result, errors: _vm.errors }
            },
            [
              _c(
                "NFormGroup",
                { attrs: { icon: "fa fa-cog", legend: _vm.trans("Settings") } },
                [
                  _c(
                    "div",
                    { staticClass: "grid grid-row grid--wrap grid--30" },
                    [
                      _c(
                        "div",
                        { staticClass: "col--1-1 col--1-2@sm" },
                        [
                          _c(
                            "NFormItem",
                            {
                              attrs: {
                                label: _vm.trans("State"),
                                prop: "state"
                              }
                            },
                            [
                              _c(
                                "NSwitch",
                                {
                                  attrs: { "on-value": 1, "off-value": 0 },
                                  model: {
                                    value: _vm.result.state,
                                    callback: function($$v) {
                                      _vm.$set(_vm.result, "state", $$v)
                                    },
                                    expression: "result.state"
                                  }
                                },
                                [
                                  _vm._v(
                                    "\n                                " +
                                      _vm._s(_vm.trans("Page is enabled")) +
                                      "\n                            "
                                  )
                                ]
                              )
                            ],
                            1
                          )
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        { staticClass: "col--1-1 col--1-2@sm" },
                        [
                          _c(
                            "NFormItem",
                            {
                              attrs: { label: _vm.trans("Hide"), prop: "hide" }
                            },
                            [
                              _c(
                                "NSwitch",
                                {
                                  attrs: { "on-value": 1, "off-value": 0 },
                                  model: {
                                    value: _vm.result.hide,
                                    callback: function($$v) {
                                      _vm.$set(_vm.result, "hide", $$v)
                                    },
                                    expression: "result.hide"
                                  }
                                },
                                [
                                  _vm._v(
                                    "\n                                " +
                                      _vm._s(_vm.trans("Page is hidden")) +
                                      "\n                            "
                                  )
                                ]
                              )
                            ],
                            1
                          )
                        ],
                        1
                      )
                    ]
                  )
                ]
              ),
              _vm._v(" "),
              _c(
                "NFormGroup",
                { attrs: { icon: "fa fa-page", legend: _vm.trans("Page") } },
                [
                  _c(
                    "div",
                    { staticClass: "grid grid-row grid--wrap grid--30" },
                    [
                      _c(
                        "div",
                        { staticClass: "col--1-1" },
                        [
                          _c(
                            "NFormItem",
                            {
                              attrs: {
                                label: _vm.trans("Title"),
                                prop: "title"
                              }
                            },
                            [
                              _c("NInput", {
                                model: {
                                  value: _vm.result.title,
                                  callback: function($$v) {
                                    _vm.$set(_vm.result, "title", $$v)
                                  },
                                  expression: "result.title"
                                }
                              })
                            ],
                            1
                          )
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        { staticClass: "col--1-1" },
                        [
                          _c(
                            "NFormItem",
                            {
                              attrs: {
                                label: _vm.trans("Content"),
                                prop: "content"
                              }
                            },
                            [
                              _c("NTextarea", {
                                model: {
                                  value: _vm.result.content,
                                  callback: function($$v) {
                                    _vm.$set(_vm.result, "content", $$v)
                                  },
                                  expression: "result.content"
                                }
                              })
                            ],
                            1
                          )
                        ],
                        1
                      )
                    ]
                  )
                ]
              )
            ],
            1
          )
        ],
        1
      )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/KyoPages.vue?vue&type=template&id=671d7ee8&":
/*!******************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/KyoPages.vue?vue&type=template&id=671d7ee8& ***!
  \******************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "NLoader",
    { staticClass: "full-height-child", attrs: { visible: _vm.load } },
    [
      _c(
        "div",
        { staticClass: "grid grid--col" },
        [
          _c(
            "KyoTitlebar",
            { staticClass: "col--flex-0-0", on: { delete: _vm.deleteItems } },
            [
              _c(
                "template",
                { slot: "search" },
                [
                  _c("KyoTitlebarSearch", {
                    model: {
                      value: _vm.query.search,
                      callback: function($$v) {
                        _vm.$set(_vm.query, "search", $$v)
                      },
                      expression: "query.search"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "template",
                { slot: "action" },
                [
                  _c(
                    "NButton",
                    {
                      attrs: { type: "primary" },
                      on: {
                        click: function($event) {
                          return _vm.$router.push({ name: "KyoPageCreate" })
                        }
                      }
                    },
                    [
                      _vm._v(
                        "\n                    " +
                          _vm._s(_vm.trans("Create page")) +
                          "\n                "
                      )
                    ]
                  )
                ],
                1
              )
            ],
            2
          ),
          _vm._v(" "),
          _c(
            "KyoDatatable",
            {
              staticClass: "col--flex-1-1",
              on: { "row-dblclick": _vm.gotoEdit }
            },
            [
              _c("NTableColumn", {
                attrs: {
                  type: "string",
                  prop: "title",
                  label: _vm.trans("Title"),
                  fluid: true,
                  sort: true,
                  filter: true
                },
                scopedSlots: _vm._u([
                  {
                    key: "default",
                    fn: function(ref) {
                      var value = ref.value
                      return _c(
                        "router-link",
                        {
                          attrs: { to: { name: "KyoPageEdit", params: value } }
                        },
                        [_vm._v(_vm._s(value.title))]
                      )
                    }
                  }
                ])
              }),
              _vm._v(" "),
              _c("NTableColumn", {
                attrs: {
                  type: "datetime",
                  prop: "updated_at",
                  label: _vm.trans("Modified"),
                  sort: true,
                  filter: true
                }
              }),
              _vm._v(" "),
              _c("NTableColumn", {
                attrs: {
                  type: "datetime",
                  prop: "created_at",
                  label: _vm.trans("Created"),
                  sort: true,
                  filter: true
                }
              })
            ],
            1
          )
        ],
        1
      )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js":
/*!********************************************************************!*\
  !*** ./node_modules/vue-loader/lib/runtime/componentNormalizer.js ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return normalizeComponent; });
/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file (except for modules).
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

function normalizeComponent (
  scriptExports,
  render,
  staticRenderFns,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier, /* server only */
  shadowMode /* vue-cli only */
) {
  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (render) {
    options.render = render
    options.staticRenderFns = staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = 'data-v-' + scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = shadowMode
      ? function () {
        injectStyles.call(
          this,
          (options.functional ? this.parent : this).$root.$options.shadowRoot
        )
      }
      : injectStyles
  }

  if (hook) {
    if (options.functional) {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functional component in vue file
      var originalRender = options.render
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return originalRender(h, context)
      }
    } else {
      // inject component registration as beforeCreate hook
      var existing = options.beforeCreate
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    }
  }

  return {
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ "./resources/js/bootstrap.js":
/*!***********************************!*\
  !*** ./resources/js/bootstrap.js ***!
  \***********************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "vue");
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _pages_KyoPages__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./pages/KyoPages */ "./resources/js/pages/KyoPages.vue");
/* harmony import */ var _pages_KyoPageCreate__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./pages/KyoPageCreate */ "./resources/js/pages/KyoPageCreate.vue");
/* harmony import */ var _pages_KyoPageEdit__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./pages/KyoPageEdit */ "./resources/js/pages/KyoPageEdit.vue");


vue__WEBPACK_IMPORTED_MODULE_0___default.a.component(_pages_KyoPages__WEBPACK_IMPORTED_MODULE_1__["default"].name, _pages_KyoPages__WEBPACK_IMPORTED_MODULE_1__["default"]);

vue__WEBPACK_IMPORTED_MODULE_0___default.a.component(_pages_KyoPageCreate__WEBPACK_IMPORTED_MODULE_2__["default"].name, _pages_KyoPageCreate__WEBPACK_IMPORTED_MODULE_2__["default"]);

vue__WEBPACK_IMPORTED_MODULE_0___default.a.component(_pages_KyoPageEdit__WEBPACK_IMPORTED_MODULE_3__["default"].name, _pages_KyoPageEdit__WEBPACK_IMPORTED_MODULE_3__["default"]);

__webpack_require__(/*! ./configs/page */ "./resources/js/configs/page.js");

if (console && console.log) {
  console.log('kyoto/page ready.');
}

/***/ }),

/***/ "./resources/js/configs/page.js":
/*!**************************************!*\
  !*** ./resources/js/configs/page.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

Nano.Data.set('kyoto/page::page', {
  'NFormGroup:00': {
    props: {
      legend: Nano.Locale.trans('Page'),
      icon: 'fa fa-file'
    },
    content: {
      'div:00': {
        "class": 'grid grid--row grid--wrap grid--30',
        content: {
          'div:00': {
            "class": 'col--1-1 col--1-2@sm',
            content: {
              'NFormItem:00': {
                props: {
                  label: Nano.Locale.trans('Page')
                },
                content: {
                  'NInput:00': {
                    model: {
                      path: 'page_id'
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  }
});

/***/ }),

/***/ "./resources/js/pages/KyoPageCreate.vue":
/*!**********************************************!*\
  !*** ./resources/js/pages/KyoPageCreate.vue ***!
  \**********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _KyoPageCreate_vue_vue_type_template_id_22f38b53___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./KyoPageCreate.vue?vue&type=template&id=22f38b53& */ "./resources/js/pages/KyoPageCreate.vue?vue&type=template&id=22f38b53&");
/* harmony import */ var _KyoPageCreate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./KyoPageCreate.vue?vue&type=script&lang=js& */ "./resources/js/pages/KyoPageCreate.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _KyoPageCreate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _KyoPageCreate_vue_vue_type_template_id_22f38b53___WEBPACK_IMPORTED_MODULE_0__["render"],
  _KyoPageCreate_vue_vue_type_template_id_22f38b53___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/pages/KyoPageCreate.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/pages/KyoPageCreate.vue?vue&type=script&lang=js&":
/*!***********************************************************************!*\
  !*** ./resources/js/pages/KyoPageCreate.vue?vue&type=script&lang=js& ***!
  \***********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_KyoPageCreate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./KyoPageCreate.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/KyoPageCreate.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_KyoPageCreate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/pages/KyoPageCreate.vue?vue&type=template&id=22f38b53&":
/*!*****************************************************************************!*\
  !*** ./resources/js/pages/KyoPageCreate.vue?vue&type=template&id=22f38b53& ***!
  \*****************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_KyoPageCreate_vue_vue_type_template_id_22f38b53___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./KyoPageCreate.vue?vue&type=template&id=22f38b53& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/KyoPageCreate.vue?vue&type=template&id=22f38b53&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_KyoPageCreate_vue_vue_type_template_id_22f38b53___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_KyoPageCreate_vue_vue_type_template_id_22f38b53___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/pages/KyoPageEdit.vue":
/*!********************************************!*\
  !*** ./resources/js/pages/KyoPageEdit.vue ***!
  \********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _KyoPageEdit_vue_vue_type_template_id_d1e6f5be___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./KyoPageEdit.vue?vue&type=template&id=d1e6f5be& */ "./resources/js/pages/KyoPageEdit.vue?vue&type=template&id=d1e6f5be&");
/* harmony import */ var _KyoPageEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./KyoPageEdit.vue?vue&type=script&lang=js& */ "./resources/js/pages/KyoPageEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _KyoPageEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _KyoPageEdit_vue_vue_type_template_id_d1e6f5be___WEBPACK_IMPORTED_MODULE_0__["render"],
  _KyoPageEdit_vue_vue_type_template_id_d1e6f5be___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/pages/KyoPageEdit.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/pages/KyoPageEdit.vue?vue&type=script&lang=js&":
/*!*********************************************************************!*\
  !*** ./resources/js/pages/KyoPageEdit.vue?vue&type=script&lang=js& ***!
  \*********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_KyoPageEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./KyoPageEdit.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/KyoPageEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_KyoPageEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/pages/KyoPageEdit.vue?vue&type=template&id=d1e6f5be&":
/*!***************************************************************************!*\
  !*** ./resources/js/pages/KyoPageEdit.vue?vue&type=template&id=d1e6f5be& ***!
  \***************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_KyoPageEdit_vue_vue_type_template_id_d1e6f5be___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./KyoPageEdit.vue?vue&type=template&id=d1e6f5be& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/KyoPageEdit.vue?vue&type=template&id=d1e6f5be&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_KyoPageEdit_vue_vue_type_template_id_d1e6f5be___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_KyoPageEdit_vue_vue_type_template_id_d1e6f5be___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/pages/KyoPages.vue":
/*!*****************************************!*\
  !*** ./resources/js/pages/KyoPages.vue ***!
  \*****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _KyoPages_vue_vue_type_template_id_671d7ee8___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./KyoPages.vue?vue&type=template&id=671d7ee8& */ "./resources/js/pages/KyoPages.vue?vue&type=template&id=671d7ee8&");
/* harmony import */ var _KyoPages_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./KyoPages.vue?vue&type=script&lang=js& */ "./resources/js/pages/KyoPages.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _KyoPages_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _KyoPages_vue_vue_type_template_id_671d7ee8___WEBPACK_IMPORTED_MODULE_0__["render"],
  _KyoPages_vue_vue_type_template_id_671d7ee8___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/pages/KyoPages.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/pages/KyoPages.vue?vue&type=script&lang=js&":
/*!******************************************************************!*\
  !*** ./resources/js/pages/KyoPages.vue?vue&type=script&lang=js& ***!
  \******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_KyoPages_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./KyoPages.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/KyoPages.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_KyoPages_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/pages/KyoPages.vue?vue&type=template&id=671d7ee8&":
/*!************************************************************************!*\
  !*** ./resources/js/pages/KyoPages.vue?vue&type=template&id=671d7ee8& ***!
  \************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_KyoPages_vue_vue_type_template_id_671d7ee8___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./KyoPages.vue?vue&type=template&id=671d7ee8& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/KyoPages.vue?vue&type=template&id=671d7ee8&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_KyoPages_vue_vue_type_template_id_671d7ee8___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_KyoPages_vue_vue_type_template_id_671d7ee8___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/sass/bootstrap.scss":
/*!***************************************!*\
  !*** ./resources/sass/bootstrap.scss ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************************!*\
  !*** multi ./resources/js/bootstrap.js ./resources/sass/bootstrap.scss ***!
  \*************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/eddy/Sites/kyoto-cms/extensions/kyoto/page/resources/js/bootstrap.js */"./resources/js/bootstrap.js");
module.exports = __webpack_require__(/*! /Users/eddy/Sites/kyoto-cms/extensions/kyoto/page/resources/sass/bootstrap.scss */"./resources/sass/bootstrap.scss");


/***/ }),

/***/ "vue":
/*!**********************!*\
  !*** external "Vue" ***!
  \**********************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = Vue;

/***/ })

/******/ });