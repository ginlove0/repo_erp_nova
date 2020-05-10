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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1);
module.exports = __webpack_require__(6);


/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

Nova.booting(function (Vue, router, store) {
  Vue.component('item-transfer-resource-tool', __webpack_require__(2));
});

/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(18)
}
var normalizeComponent = __webpack_require__(3)
/* script */
var __vue_script__ = __webpack_require__(4)
/* template */
var __vue_template__ = __webpack_require__(5)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/Tool.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-68ff5483", Component.options)
  } else {
    hotAPI.reload("data-v-68ff5483", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 3 */
/***/ (function(module, exports) {

/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file.
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

module.exports = function normalizeComponent (
  rawScriptExports,
  compiledTemplate,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier /* server only */
) {
  var esModule
  var scriptExports = rawScriptExports = rawScriptExports || {}

  // ES6 modules interop
  var type = typeof rawScriptExports.default
  if (type === 'object' || type === 'function') {
    esModule = rawScriptExports
    scriptExports = rawScriptExports.default
  }

  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (compiledTemplate) {
    options.render = compiledTemplate.render
    options.staticRenderFns = compiledTemplate.staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = scopeId
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
    hook = injectStyles
  }

  if (hook) {
    var functional = options.functional
    var existing = functional
      ? options.render
      : options.beforeCreate

    if (!functional) {
      // inject component registration as beforeCreate hook
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    } else {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return existing(h, context)
      }
    }
  }

  return {
    esModule: esModule,
    exports: scriptExports,
    options: options
  }
}


/***/ }),
/* 4 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__SearchDropdown__ = __webpack_require__(20);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__SearchDropdown___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__SearchDropdown__);
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
//
//
//
//
//


/* harmony default export */ __webpack_exports__["default"] = ({
    components: { Dropdown: __WEBPACK_IMPORTED_MODULE_0__SearchDropdown___default.a },
    props: ['resourceName', 'resourceId', 'panel'],

    data: function data() {
        return {
            orders: [{
                modelId: '',
                qty: 1,
                conditionId: '',
                note: ''
            }],
            models: [],
            conditions: []
        };
    },


    methods: {
        addLine: function addLine() {
            this.handleSubmit();
        },

        removeItem: function removeItem(key) {
            this.orders.splice(key, 1);
        },
        handleSubmit: function handleSubmit() {
            var _this = this;

            console.log(this.orders[0].conditionId, 'condition');
            console.log(this.orders[0].modelId, 'model');
            if (this.orders[0].conditionId != null && this.orders[0].modelId != null) {
                // for(let i = 0; i < this.orders.length; i++)
                // {
                axios.get('/nova-vendor/item-transfer-resource-tool/addProductToWhTransfer/' + this.resourceId + '/' + JSON.stringify(this.orders[0])).then(function (res) {
                    console.log(res);
                    _this.orders.push({ modelId: '', qty: 1, conditionId: '', note: '' });
                }).catch(function (err) {
                    console.log(err);
                });
                // }
            } else {
                return alert('Please fill name and condition');
            }
        },
        getAllModel: function getAllModel() {
            var _this2 = this;

            axios.get('/nova-vendor/item-transfer-resource-tool/findModel').then(function (res) {
                _this2.models = res.data;
            }).catch(function (err) {
                console.log(err.message);
            });
        },
        getAllCondition: function getAllCondition() {
            var _this3 = this;

            axios.get('/nova-vendor/item-transfer-resource-tool/findCondition').then(function (res) {
                console.log('hello', res);
                _this3.conditions = res.data;
            }).catch(function (err) {
                console.log(err.message);
            });
        },
        validateSelectionModel: function validateSelectionModel(selection) {
            this.orders[0].modelId = selection.id;
            console.log(selection.name + ' has been selected');
        },
        validateSelectionCondition: function validateSelectionCondition(selection) {
            this.orders[0].conditionId = selection.id;
            console.log(selection.name + ' has been selected');
        },
        getDropdownValues: function getDropdownValues(keyword) {
            console.log('You could refresh options by querying the API with ' + keyword);
        }
    },

    mounted: function mounted() {
        //
        this.getAllModel();
        this.getAllCondition();
    }
});

/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("h1", { staticClass: "flex-no-shrink text-90 font-normal text-2xl" }, [
      _vm._v("Items Prepare")
    ]),
    _vm._v(" "),
    _c("table", { staticClass: "table table-bordered table-form w-full" }, [
      _vm._m(0),
      _vm._v(" "),
      _c(
        "tbody",
        _vm._l(_vm.orders, function(order) {
          return _c("tr", [
            _c(
              "td",
              { staticClass: "table-name" },
              [
                _c("Dropdown", {
                  attrs: {
                    options: _vm.models,
                    disabled: false,
                    placeholder: "Please select model"
                  },
                  on: {
                    selected: _vm.validateSelectionModel,
                    filter: _vm.getDropdownValues
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c("td", { staticClass: "table-qty" }, [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: order.qty,
                    expression: "order.qty"
                  }
                ],
                staticClass: "table-input-qty",
                attrs: { type: "number" },
                domProps: { value: order.qty },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.$set(order, "qty", $event.target.value)
                  }
                }
              })
            ]),
            _vm._v(" "),
            _c(
              "td",
              { staticClass: "table-condition" },
              [
                _c("Dropdown", {
                  attrs: {
                    options: _vm.conditions,
                    disabled: false,
                    placeholder: "Please select condition"
                  },
                  on: {
                    selected: _vm.validateSelectionCondition,
                    filter: _vm.getDropdownValues
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c("td", { staticClass: "table-name" }, [
              _c("textarea", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: order.note,
                    expression: "order.note"
                  }
                ],
                staticClass: "table-input",
                domProps: { value: order.note },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.$set(order, "note", $event.target.value)
                  }
                }
              })
            ]),
            _vm._v(" "),
            _c("td", { staticClass: "table-remove" }, [
              _c(
                "button",
                {
                  staticClass:
                    "inline-flex appearance-none cursor-pointer text-70 hover:text-primary mr-3 has-tooltip",
                  on: {
                    click: function($event) {
                      return _vm.removeItem(_vm.key)
                    }
                  }
                },
                [
                  _c(
                    "svg",
                    {
                      staticClass: "fill-current",
                      attrs: {
                        xmlns: "http://www.w3.org/2000/svg",
                        width: "20",
                        height: "20",
                        viewBox: "0 0 20 20",
                        "aria-labelledby": "delete",
                        role: "presentation"
                      }
                    },
                    [
                      _c("path", {
                        attrs: {
                          "fill-rule": "nonzero",
                          d:
                            "M6 4V2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6H1a1 1 0 1 1 0-2h5zM4 6v12h12V6H4zm8-2V2H8v2h4zM8 8a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1z"
                        }
                      })
                    ]
                  )
                ]
              )
            ])
          ])
        }),
        0
      ),
      _vm._v(" "),
      _c("tfoot", [
        _c("tr", [
          _c("td", { staticClass: "table-empty", attrs: { colspan: "1" } }, [
            _c(
              "button",
              { staticClass: "table-add_line", on: { click: _vm.addLine } },
              [_vm._v("Add Line & Submit")]
            )
          ])
        ])
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("tr", [
        _c("th", [_vm._v("Name")]),
        _vm._v(" "),
        _c("th", [_vm._v("Qty")]),
        _vm._v(" "),
        _c("th", [_vm._v("Condition")]),
        _vm._v(" "),
        _c("th", [_vm._v("Note")]),
        _vm._v(" "),
        _c("th"),
        _vm._v(" "),
        _c("th")
      ])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-68ff5483", module.exports)
  }
}

/***/ }),
/* 6 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 7 */,
/* 8 */
/***/ (function(module, exports) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
module.exports = function(useSourceMap) {
	var list = [];

	// return the list of modules as css string
	list.toString = function toString() {
		return this.map(function (item) {
			var content = cssWithMappingToString(item, useSourceMap);
			if(item[2]) {
				return "@media " + item[2] + "{" + content + "}";
			} else {
				return content;
			}
		}).join("");
	};

	// import a list of modules into the list
	list.i = function(modules, mediaQuery) {
		if(typeof modules === "string")
			modules = [[null, modules, ""]];
		var alreadyImportedModules = {};
		for(var i = 0; i < this.length; i++) {
			var id = this[i][0];
			if(typeof id === "number")
				alreadyImportedModules[id] = true;
		}
		for(i = 0; i < modules.length; i++) {
			var item = modules[i];
			// skip already imported module
			// this implementation is not 100% perfect for weird media query combinations
			//  when a module is imported multiple times with different media queries.
			//  I hope this will never occur (Hey this way we have smaller bundles)
			if(typeof item[0] !== "number" || !alreadyImportedModules[item[0]]) {
				if(mediaQuery && !item[2]) {
					item[2] = mediaQuery;
				} else if(mediaQuery) {
					item[2] = "(" + item[2] + ") and (" + mediaQuery + ")";
				}
				list.push(item);
			}
		}
	};
	return list;
};

function cssWithMappingToString(item, useSourceMap) {
	var content = item[1] || '';
	var cssMapping = item[3];
	if (!cssMapping) {
		return content;
	}

	if (useSourceMap && typeof btoa === 'function') {
		var sourceMapping = toComment(cssMapping);
		var sourceURLs = cssMapping.sources.map(function (source) {
			return '/*# sourceURL=' + cssMapping.sourceRoot + source + ' */'
		});

		return [content].concat(sourceURLs).concat([sourceMapping]).join('\n');
	}

	return [content].join('\n');
}

// Adapted from convert-source-map (MIT)
function toComment(sourceMap) {
	// eslint-disable-next-line no-undef
	var base64 = btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap))));
	var data = 'sourceMappingURL=data:application/json;charset=utf-8;base64,' + base64;

	return '/*# ' + data + ' */';
}


/***/ }),
/* 9 */,
/* 10 */,
/* 11 */,
/* 12 */,
/* 13 */,
/* 14 */
/***/ (function(module, exports, __webpack_require__) {

/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
  Modified by Evan You @yyx990803
*/

var hasDocument = typeof document !== 'undefined'

if (typeof DEBUG !== 'undefined' && DEBUG) {
  if (!hasDocument) {
    throw new Error(
    'vue-style-loader cannot be used in a non-browser environment. ' +
    "Use { target: 'node' } in your Webpack config to indicate a server-rendering environment."
  ) }
}

var listToStyles = __webpack_require__(15)

/*
type StyleObject = {
  id: number;
  parts: Array<StyleObjectPart>
}

type StyleObjectPart = {
  css: string;
  media: string;
  sourceMap: ?string
}
*/

var stylesInDom = {/*
  [id: number]: {
    id: number,
    refs: number,
    parts: Array<(obj?: StyleObjectPart) => void>
  }
*/}

var head = hasDocument && (document.head || document.getElementsByTagName('head')[0])
var singletonElement = null
var singletonCounter = 0
var isProduction = false
var noop = function () {}
var options = null
var ssrIdKey = 'data-vue-ssr-id'

// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
// tags it will allow on a page
var isOldIE = typeof navigator !== 'undefined' && /msie [6-9]\b/.test(navigator.userAgent.toLowerCase())

module.exports = function (parentId, list, _isProduction, _options) {
  isProduction = _isProduction

  options = _options || {}

  var styles = listToStyles(parentId, list)
  addStylesToDom(styles)

  return function update (newList) {
    var mayRemove = []
    for (var i = 0; i < styles.length; i++) {
      var item = styles[i]
      var domStyle = stylesInDom[item.id]
      domStyle.refs--
      mayRemove.push(domStyle)
    }
    if (newList) {
      styles = listToStyles(parentId, newList)
      addStylesToDom(styles)
    } else {
      styles = []
    }
    for (var i = 0; i < mayRemove.length; i++) {
      var domStyle = mayRemove[i]
      if (domStyle.refs === 0) {
        for (var j = 0; j < domStyle.parts.length; j++) {
          domStyle.parts[j]()
        }
        delete stylesInDom[domStyle.id]
      }
    }
  }
}

function addStylesToDom (styles /* Array<StyleObject> */) {
  for (var i = 0; i < styles.length; i++) {
    var item = styles[i]
    var domStyle = stylesInDom[item.id]
    if (domStyle) {
      domStyle.refs++
      for (var j = 0; j < domStyle.parts.length; j++) {
        domStyle.parts[j](item.parts[j])
      }
      for (; j < item.parts.length; j++) {
        domStyle.parts.push(addStyle(item.parts[j]))
      }
      if (domStyle.parts.length > item.parts.length) {
        domStyle.parts.length = item.parts.length
      }
    } else {
      var parts = []
      for (var j = 0; j < item.parts.length; j++) {
        parts.push(addStyle(item.parts[j]))
      }
      stylesInDom[item.id] = { id: item.id, refs: 1, parts: parts }
    }
  }
}

function createStyleElement () {
  var styleElement = document.createElement('style')
  styleElement.type = 'text/css'
  head.appendChild(styleElement)
  return styleElement
}

function addStyle (obj /* StyleObjectPart */) {
  var update, remove
  var styleElement = document.querySelector('style[' + ssrIdKey + '~="' + obj.id + '"]')

  if (styleElement) {
    if (isProduction) {
      // has SSR styles and in production mode.
      // simply do nothing.
      return noop
    } else {
      // has SSR styles but in dev mode.
      // for some reason Chrome can't handle source map in server-rendered
      // style tags - source maps in <style> only works if the style tag is
      // created and inserted dynamically. So we remove the server rendered
      // styles and inject new ones.
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  if (isOldIE) {
    // use singleton mode for IE9.
    var styleIndex = singletonCounter++
    styleElement = singletonElement || (singletonElement = createStyleElement())
    update = applyToSingletonTag.bind(null, styleElement, styleIndex, false)
    remove = applyToSingletonTag.bind(null, styleElement, styleIndex, true)
  } else {
    // use multi-style-tag mode in all other cases
    styleElement = createStyleElement()
    update = applyToTag.bind(null, styleElement)
    remove = function () {
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  update(obj)

  return function updateStyle (newObj /* StyleObjectPart */) {
    if (newObj) {
      if (newObj.css === obj.css &&
          newObj.media === obj.media &&
          newObj.sourceMap === obj.sourceMap) {
        return
      }
      update(obj = newObj)
    } else {
      remove()
    }
  }
}

var replaceText = (function () {
  var textStore = []

  return function (index, replacement) {
    textStore[index] = replacement
    return textStore.filter(Boolean).join('\n')
  }
})()

function applyToSingletonTag (styleElement, index, remove, obj) {
  var css = remove ? '' : obj.css

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = replaceText(index, css)
  } else {
    var cssNode = document.createTextNode(css)
    var childNodes = styleElement.childNodes
    if (childNodes[index]) styleElement.removeChild(childNodes[index])
    if (childNodes.length) {
      styleElement.insertBefore(cssNode, childNodes[index])
    } else {
      styleElement.appendChild(cssNode)
    }
  }
}

function applyToTag (styleElement, obj) {
  var css = obj.css
  var media = obj.media
  var sourceMap = obj.sourceMap

  if (media) {
    styleElement.setAttribute('media', media)
  }
  if (options.ssrId) {
    styleElement.setAttribute(ssrIdKey, obj.id)
  }

  if (sourceMap) {
    // https://developer.chrome.com/devtools/docs/javascript-debugging
    // this makes source maps inside style tags work properly in Chrome
    css += '\n/*# sourceURL=' + sourceMap.sources[0] + ' */'
    // http://stackoverflow.com/a/26603875
    css += '\n/*# sourceMappingURL=data:application/json;base64,' + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + ' */'
  }

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = css
  } else {
    while (styleElement.firstChild) {
      styleElement.removeChild(styleElement.firstChild)
    }
    styleElement.appendChild(document.createTextNode(css))
  }
}


/***/ }),
/* 15 */
/***/ (function(module, exports) {

/**
 * Translates the list format produced by css-loader into something
 * easier to manipulate.
 */
module.exports = function listToStyles (parentId, list) {
  var styles = []
  var newStyles = {}
  for (var i = 0; i < list.length; i++) {
    var item = list[i]
    var id = item[0]
    var css = item[1]
    var media = item[2]
    var sourceMap = item[3]
    var part = {
      id: parentId + ':' + i,
      css: css,
      media: media,
      sourceMap: sourceMap
    }
    if (!newStyles[id]) {
      styles.push(newStyles[id] = { id: id, parts: [part] })
    } else {
      newStyles[id].parts.push(part)
    }
  }
  return styles
}


/***/ }),
/* 16 */,
/* 17 */,
/* 18 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(19);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(14)("6e5db1d0", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-68ff5483\",\"scoped\":false,\"hasInlineConfig\":true}!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Tool.vue", function() {
     var newContent = require("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-68ff5483\",\"scoped\":false,\"hasInlineConfig\":true}!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Tool.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 19 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(8)(false);
// imports


// module
exports.push([module.i, "\n.table-input {\n    background: #fff;\n    cursor: pointer;\n    border: 1px solid #e7ecf5;\n    border-radius: 3px;\n    color: #333;\n    display: block;\n    font-size: .8em;\n    padding: 6px;\n    min-width: 250px;\n    max-width: 250px;\n}\n.table-input-qty {\n    background: #fff;\n    cursor: pointer;\n    border: 1px solid #e7ecf5;\n    border-radius: 3px;\n    color: #333;\n    display: block;\n    font-size: .8em;\n    padding: 6px;\n    min-width: 100px;\n    max-width: 100px;\n}\n", ""]);

// exports


/***/ }),
/* 20 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(21)
}
var normalizeComponent = __webpack_require__(3)
/* script */
var __vue_script__ = __webpack_require__(23)
/* template */
var __vue_template__ = __webpack_require__(24)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-7907bc84"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/SearchDropdown.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-7907bc84", Component.options)
  } else {
    hotAPI.reload("data-v-7907bc84", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 21 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(22);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(14)("70ddcc6f", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7907bc84\",\"scoped\":true,\"hasInlineConfig\":true}!../../../node_modules/sass-loader/lib/loader.js!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./SearchDropdown.vue", function() {
     var newContent = require("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7907bc84\",\"scoped\":true,\"hasInlineConfig\":true}!../../../node_modules/sass-loader/lib/loader.js!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./SearchDropdown.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 22 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(8)(false);
// imports


// module
exports.push([module.i, "\n.dropdown[data-v-7907bc84] {\n  position: relative;\n  display: block;\n  margin: auto;\n}\n.dropdown .dropdown-input[data-v-7907bc84] {\n    background: #fff;\n    cursor: pointer;\n    border: 1px solid #e7ecf5;\n    border-radius: 3px;\n    color: #333;\n    display: block;\n    font-size: .8em;\n    padding: 6px;\n    min-width: 250px;\n    max-width: 250px;\n}\n.dropdown .dropdown-input[data-v-7907bc84]:hover {\n      background: #f8f8fa;\n}\n.dropdown .dropdown-content[data-v-7907bc84] {\n    position: absolute;\n    background-color: #fff;\n    min-width: 248px;\n    max-width: 248px;\n    max-height: 248px;\n    border: 1px solid #e7ecf5;\n    -webkit-box-shadow: 0px -8px 34px 0px rgba(0, 0, 0, 0.05);\n            box-shadow: 0px -8px 34px 0px rgba(0, 0, 0, 0.05);\n    overflow: auto;\n    z-index: 1;\n}\n.dropdown .dropdown-content .dropdown-item[data-v-7907bc84] {\n      color: black;\n      font-size: .7em;\n      line-height: 1em;\n      padding: 8px;\n      text-decoration: none;\n      display: block;\n      cursor: pointer;\n}\n.dropdown .dropdown-content .dropdown-item[data-v-7907bc84]:hover {\n        background-color: #e7ecf5;\n}\n.dropdown .dropdown:hover .dropdowncontent[data-v-7907bc84] {\n    display: block;\n}\n.svg-icon[data-v-7907bc84] {\n  width: 2rem;\n  height: 1.5rem;\n  margin-left: 120px;\n}\n.svg-icon path[data-v-7907bc84],\n.svg-icon polygon[data-v-7907bc84],\n.svg-icon rect[data-v-7907bc84] {\n  fill: #4691f6;\n}\n.svg-icon circle[data-v-7907bc84] {\n  stroke: #4691f6;\n  stroke-width: 1;\n}\n", ""]);

// exports


/***/ }),
/* 23 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
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
    name: 'Dropdown',
    template: 'Dropdown',
    props: {
        name: {
            type: String,
            required: false,
            default: 'dropdown',
            note: 'Input name'
        },
        options: {
            type: Array,
            required: true,
            default: [],
            note: 'Options of dropdown. An array of options with id and name'
        },
        placeholder: {
            type: String,
            required: false,
            default: 'Please select an option',
            note: 'Placeholder of dropdown'
        },
        disabled: {
            type: Boolean,
            required: false,
            default: false,
            note: 'Disable the dropdown'
        },
        maxItem: {
            type: Number,
            required: false,
            default: 6,
            note: 'Max items showing'
        }
    },
    data: function data() {
        return {
            selected: {},
            optionsShown: false,
            searchFilter: ''
        };
    },
    created: function created() {
        this.$emit('selected', this.selected);
    },

    computed: {
        filteredOptions: function filteredOptions() {
            var filtered = [];
            var regOption = new RegExp(this.searchFilter, 'ig');
            var _iteratorNormalCompletion = true;
            var _didIteratorError = false;
            var _iteratorError = undefined;

            try {
                for (var _iterator = this.options[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
                    var option = _step.value;

                    if (this.searchFilter.length < 1 || option.name.match(regOption)) {
                        if (filtered.length < this.maxItem) filtered.push(option);
                    }
                }
            } catch (err) {
                _didIteratorError = true;
                _iteratorError = err;
            } finally {
                try {
                    if (!_iteratorNormalCompletion && _iterator.return) {
                        _iterator.return();
                    }
                } finally {
                    if (_didIteratorError) {
                        throw _iteratorError;
                    }
                }
            }

            return filtered;
        }
    },
    methods: {
        selectOption: function selectOption(option) {
            this.selected = option;
            this.optionsShown = false;
            this.searchFilter = this.selected.name;
            this.$emit('selected', this.selected);
        },
        showOptions: function showOptions() {
            if (!this.disabled) {
                this.searchFilter = '';
                this.optionsShown = true;
            }
        },

        // exit() {
        //     if (!this.selected.id) {
        //         this.selected = {};
        //         this.searchFilter = '';
        //     } else {
        //         this.searchFilter = this.selected.name;
        //     }
        //     this.$emit('selected', this.selected);
        //     this.optionsShown = false;
        // },
        // Selecting when pressing Enter
        keyMonitor: function keyMonitor(event) {
            if (event.key === "Enter" && this.filteredOptions[0]) this.selectOption(this.filteredOptions[0]);
        },

        onBlur: function onBlur() {
            this.optionsShown = false;
        }
    },
    watch: {
        searchFilter: function searchFilter() {
            if (this.filteredOptions.length === 0) {
                this.selected = {};
            } else {
                this.selected = this.filteredOptions[0];
            }
            this.$emit('filter', this.searchFilter);
        }
    }
});

/***/ }),
/* 24 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _vm.options
    ? _c("div", { staticClass: "dropdown" }, [
        _c("input", {
          directives: [
            {
              name: "model",
              rawName: "v-model",
              value: _vm.searchFilter,
              expression: "searchFilter"
            }
          ],
          staticClass: "dropdown-input",
          attrs: {
            name: _vm.name,
            disabled: _vm.disabled,
            placeholder: _vm.placeholder
          },
          domProps: { value: _vm.searchFilter },
          on: {
            focus: function($event) {
              return _vm.showOptions()
            },
            keyup: _vm.keyMonitor,
            blur: _vm.onBlur,
            input: function($event) {
              if ($event.target.composing) {
                return
              }
              _vm.searchFilter = $event.target.value
            }
          }
        }),
        _vm._v(" "),
        _c(
          "div",
          {
            directives: [
              {
                name: "show",
                rawName: "v-show",
                value: _vm.optionsShown,
                expression: "optionsShown"
              }
            ],
            staticClass: "dropdown-content"
          },
          [
            _vm._l(_vm.filteredOptions, function(option, index) {
              return _c(
                "div",
                {
                  key: index,
                  staticClass: "dropdown-item",
                  on: {
                    mousedown: function($event) {
                      return _vm.selectOption(option)
                    }
                  }
                },
                [
                  _vm._v(
                    "\n                " +
                      _vm._s(option.name || "-") +
                      "\n            "
                  )
                ]
              )
            }),
            _vm._v(" "),
            _c("div", [
              _c(
                "button",
                {
                  staticClass:
                    "inline-flex appearance-none cursor-pointer text-70 hover:text-primary mr-3 has-tooltip"
                },
                [
                  _c("svg", { staticClass: "svg-icon" }, [
                    _c("path", {
                      attrs: {
                        fill: "none",
                        d:
                          "M13.68,9.448h-3.128V6.319c0-0.304-0.248-0.551-0.552-0.551S9.448,6.015,9.448,6.319v3.129H6.319\n\t\t\t\t\t\t\t\tc-0.304,0-0.551,0.247-0.551,0.551s0.247,0.551,0.551,0.551h3.129v3.129c0,0.305,0.248,0.551,0.552,0.551s0.552-0.246,0.552-0.551\n\t\t\t\t\t\t\t\tv-3.129h3.128c0.305,0,0.552-0.247,0.552-0.551S13.984,9.448,13.68,9.448z M10,0.968c-4.987,0-9.031,4.043-9.031,9.031\n\t\t\t\t\t\t\t\tc0,4.989,4.044,9.032,9.031,9.032c4.988,0,9.031-4.043,9.031-9.032C19.031,5.012,14.988,0.968,10,0.968z M10,17.902\n\t\t\t\t\t\t\t\tc-4.364,0-7.902-3.539-7.902-7.903c0-4.365,3.538-7.902,7.902-7.902S17.902,5.635,17.902,10C17.902,14.363,14.364,17.902,10,17.902\n\t\t\t\t\t\t\t\tz"
                      }
                    })
                  ])
                ]
              )
            ])
          ],
          2
        )
      ])
    : _vm._e()
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-7907bc84", module.exports)
  }
}

/***/ })
/******/ ]);