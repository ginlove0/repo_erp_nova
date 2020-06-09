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
module.exports = __webpack_require__(11);


/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

Nova.booting(function (Vue, router, store) {
  router.addRoutes([{
    name: 'search-multiple-items',
    path: '/search-multiple-items',
    component: __webpack_require__(2)
  }]);
});

/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(3)
}
var normalizeComponent = __webpack_require__(8)
/* script */
var __vue_script__ = __webpack_require__(9)
/* template */
var __vue_template__ = __webpack_require__(10)
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
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(4);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(6)("6e5db1d0", content, false, {});
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
/* 4 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n/* Scoped Styles */\n.btn-group-lg {\n    margin-left: 5px;\n    padding-top: 10px;\n    padding-bottom: 10px;\n    text-align: center;\n}\n.analytic-number {\n    font-weight: bold;\n    font-size: 1.5rem;\n    margin-top: 15px;\n    font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;\n}\n.table-div {\n    margin-top: 15px;\n}\nlabel {\n    font-size: 1.5rem;\n    font-weight: bold;\n    margin: auto;\n    font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;\n}\n.table-detail {\n    font-weight: bold;\n    font-size: 20px;\n}\n.table-header {\n    border: 1px solid;\n}\n.table-body {\n    margin-top: 5px;\n}\n.newtext {\n    border: 1px solid;\n}\n", ""]);

// exports


/***/ }),
/* 5 */
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
/* 6 */
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

var listToStyles = __webpack_require__(7)

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
/* 7 */
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
/* 8 */
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
/* 9 */
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
    props: ['resourceName', 'resourceId', 'field'],

    data: function data() {
        return {
            inputItems: [{
                serialNumber: '',
                note: '',
                conditionId: ''
            }],
            displayDatas: [],
            itemsNotInstock: [],
            arrayItem: [],
            ableToUpdateInStock: true,
            ableToUpdateOutStock: true,
            enableSerialInput: false,
            ableToCancel: true,
            enableSearch: false,
            itemNotInDatabase: [],
            countInput: [],
            testNotAva: []
        };
    },


    methods: {
        handleSerialInput: function handleSerialInput() {
            var replaced_space_sn = this.inputItems.serialNumber.replace(/\n/gi, " ");
            var replaced_comma_sn = replaced_space_sn.replace(/,/g, " ");
            var arr_sn = replaced_comma_sn.split(' ');
            this.arrayItem = _.uniq(arr_sn);
        },
        checkStockStatus: function checkStockStatus(res) {
            if (res.data.stockStatus === 1) {
                res.data.stockStatus = 'In stock';
            } else {
                res.data.stockStatus = 'Not in stock';
            }
            return res.data.stockStatus;
        },
        handleChange: function handleChange() {
            var _this = this;

            this.handleSerialInput();

            this.ableToUpdateInStock = false;
            this.ableToUpdateOutStock = false;
            this.enableSearch = true;
            this.enableSerialInput = true;
            this.ableToCancel = false;

            this.countInput = [];

            this.arrayItem.map(function (newitem) {
                if (newitem.length > 0) {
                    var serialNumber = newitem.trim();
                    _this.countInput.push(serialNumber);
                    if (serialNumber.length === 12 && serialNumber.charAt(0) === 'S') {
                        newitem = serialNumber.slice(0, 0) + serialNumber.slice(1);
                    }
                    _this.inputItems[0].serialNumber = newitem;

                    var self = _this;
                    axios.get('/nova-vendor/search-multiple-items/' + JSON.stringify(_this.inputItems[0])).then(function (res) {
                        if (res.data[0]) {
                            if (res.data[0].stockStatus === 1) {
                                res.data[0].stockStatus = 'In stock';
                            } else {
                                res.data[0].stockStatus = 'Not in stock';
                            }
                            self.displayDatas.push(res.data[0]);
                        } else {
                            self.testNotAva.push(newitem);
                        }
                    }).catch(function (err) {
                        console.log(err.message);
                    });
                }
            });
            this.displayDatas = [];
            this.testNotAva = [];
        },
        handleOutStock: function handleOutStock() {
            var _this2 = this;

            this.handleSerialInput();

            this.ableToUpdateOutStock = true;
            this.ableToUpdateInStock = true;
            this.enableSerialInput = false;
            this.enableSearch = false;
            this.ableToCancel = true;

            this.arrayItem.map(function (newitem) {
                if (newitem.length > 0) {
                    var serialNumber = newitem.trim();
                    if (serialNumber.length === 12 && serialNumber.charAt(0) === 'S') {
                        newitem = serialNumber.slice(0, 0) + serialNumber.slice(1);
                    }
                    _this2.inputItems[0].serialNumber = newitem;
                    var self = _this2;
                    axios.get('/nova-vendor/search-multiple-items/outStock/' + JSON.stringify(_this2.inputItems[0])).then(function (res) {

                        if (res && res.data) {
                            _this2.checkStockStatus(res);
                            self.displayDatas.push(res.data);
                        }
                    }).catch(function (err) {
                        console.log(err);
                    });
                }
            });
            this.displayDatas = [];
            // this.inputItems = [{note: '', conditionId: ''}];
        },
        handleInstock: function handleInstock() {
            var _this3 = this;

            this.handleSerialInput();

            this.ableToUpdateInStock = true;
            this.ableToUpdateOutStock = true;
            this.enableSerialInput = false;
            this.enableSearch = false;
            this.ableToCancel = true;

            this.arrayItem.map(function (newitem) {
                if (newitem.length > 0) {
                    var serialNumber = newitem.trim();
                    if (serialNumber.length === 12 && serialNumber.charAt(0) === 'S') {
                        newitem = serialNumber.slice(0, 0) + serialNumber.slice(1);
                    }
                    _this3.inputItems[0].serialNumber = newitem;
                    var self = _this3;
                    axios.get('/nova-vendor/search-multiple-items/inStock/' + JSON.stringify(_this3.inputItems[0])).then(function (res) {
                        if (res && res.data) {
                            _this3.checkStockStatus(res);
                            console.log(res);
                            self.displayDatas.push(res.data);
                        }
                    }).catch(function (err) {
                        console.log(err);
                    });
                }
            });
            this.displayDatas = [];
            // this.inputItems = [{note: '', conditionId: ''}];
        },
        handleCancel: function handleCancel() {
            this.ableToUpdateOutStock = true;
            this.ableToUpdateInStock = true;
            this.enableSerialInput = false;
            this.enableSearch = false;
            this.ableToCancel = true;
        },
        sortArrays: function sortArrays(items) {
            return _.orderBy(items, 'models.name', 'asc');
        }
    },

    watch: function watch() {
        console.log('watch');
    },
    mounted: function mounted() {
        //
    },


    computed: {
        styling: function styling() {
            return {
                height: '200px'
            };
        },
        stylingNote: function stylingNote() {
            return {
                height: '70px'
            };
        }
    }
});

/***/ }),
/* 10 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c(
      "div",
      [
        _c("heading", { staticClass: "mb-6" }, [
          _vm._v("Search & Update Multiple Items")
        ]),
        _vm._v(" "),
        _c("label", [_vm._v("Serial Number:")]),
        _vm._v(" "),
        _c("textarea", {
          directives: [
            {
              name: "model",
              rawName: "v-model",
              value: _vm.inputItems.serialNumber,
              expression: "inputItems.serialNumber"
            }
          ],
          staticClass: "w-full form-control form-input form-input-bordered",
          class: _vm.errorClasses,
          style: _vm.styling,
          attrs: { type: "text", disabled: _vm.enableSerialInput },
          domProps: { value: _vm.inputItems.serialNumber },
          on: {
            input: function($event) {
              if ($event.target.composing) {
                return
              }
              _vm.$set(_vm.inputItems, "serialNumber", $event.target.value)
            }
          }
        }),
        _vm._v(" "),
        _c("label", [_vm._v("Condition:")]),
        _vm._v(" "),
        _c(
          "select",
          {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.inputItems[0].conditionId,
                expression: "inputItems[0].conditionId"
              }
            ],
            staticClass: "w-full form-control form-input form-input-bordered",
            on: {
              change: function($event) {
                var $$selectedVal = Array.prototype.filter
                  .call($event.target.options, function(o) {
                    return o.selected
                  })
                  .map(function(o) {
                    var val = "_value" in o ? o._value : o.value
                    return val
                  })
                _vm.$set(
                  _vm.inputItems[0],
                  "conditionId",
                  $event.target.multiple ? $$selectedVal : $$selectedVal[0]
                )
              }
            }
          },
          [
            _c("option", { attrs: { selected: "", value: "" } }, [
              _vm._v("NO CHANGE CONDITION")
            ]),
            _vm._v(" "),
            _c("option", { attrs: { value: "1000" } }, [_vm._v("NIB")]),
            _vm._v(" "),
            _c("option", { attrs: { value: "1250" } }, [_vm._v("N0B")]),
            _vm._v(" "),
            _c("option", { attrs: { value: "1500" } }, [_vm._v("USEA")]),
            _vm._v(" "),
            _c("option", { attrs: { value: "3000" } }, [_vm._v("USEB")]),
            _vm._v(" "),
            _c("option", { attrs: { value: "4000" } }, [_vm._v("USEC")]),
            _vm._v(" "),
            _c("option", { attrs: { value: "5000" } }, [_vm._v("PART")]),
            _vm._v(" "),
            _c("option", { attrs: { value: "5001" } }, [_vm._v("REF")])
          ]
        ),
        _vm._v(" "),
        _c("label", [_vm._v("Note:")]),
        _vm._v(" "),
        _c("textarea", {
          directives: [
            {
              name: "model",
              rawName: "v-model",
              value: _vm.inputItems[0].note,
              expression: "inputItems[0].note"
            }
          ],
          staticClass: "w-full form-control form-input form-input-bordered",
          class: _vm.errorClasses,
          style: _vm.stylingNote,
          attrs: { type: "text" },
          domProps: { value: _vm.inputItems[0].note },
          on: {
            input: function($event) {
              if ($event.target.composing) {
                return
              }
              _vm.$set(_vm.inputItems[0], "note", $event.target.value)
            }
          }
        }),
        _vm._v(" "),
        _c(
          "button",
          {
            staticClass: "btn btn-block border-2 btn-group-lg",
            attrs: { disabled: _vm.enableSearch },
            on: {
              click: function($event) {
                return _vm.handleChange()
              }
            }
          },
          [_vm._v("\n            Search\n        ")]
        ),
        _vm._v(" "),
        _c(
          "button",
          {
            staticClass: "btn btn-block border-2 btn-group-lg",
            attrs: {
              id: _vm.UpdateOutStock,
              disabled: _vm.ableToUpdateOutStock
            },
            on: {
              click: function($event) {
                return _vm.handleOutStock()
              }
            }
          },
          [_vm._v("\n            Update To Out Stock\n        ")]
        ),
        _vm._v(" "),
        _c(
          "button",
          {
            staticClass: "btn btn-block border-2 btn-group-lg",
            attrs: { id: _vm.UpdateInStock, disabled: _vm.ableToUpdateInStock },
            on: {
              click: function($event) {
                return _vm.handleInstock()
              }
            }
          },
          [_vm._v("\n            Update To In Stock\n        ")]
        ),
        _vm._v(" "),
        _c(
          "button",
          {
            staticClass: "btn btn-block border-2 btn-group-lg",
            attrs: { id: _vm.Cancel, disabled: _vm.ableToCancel },
            on: {
              click: function($event) {
                return _vm.handleCancel()
              }
            }
          },
          [_vm._v("\n            Cancel\n        ")]
        ),
        _vm._v(" "),
        _c("div", { staticClass: "analytic-number" }, [
          _vm._v(
            "\n            Total input: " +
              _vm._s(_vm.countInput.length) +
              "\n            "
          ),
          _c("br"),
          _vm._v(
            "\n            Total found and able to update: " +
              _vm._s(_vm.displayDatas.length) +
              "\n        "
          )
        ])
      ],
      1
    ),
    _vm._v(" "),
    _c("div", { staticClass: "label-div" }, [
      _c("label", [
        _vm._v("Item not available: " + _vm._s(_vm.testNotAva.length))
      ]),
      _vm._v(" "),
      _c("table", [
        _c(
          "tbody",
          _vm._l(_vm.testNotAva, function(item) {
            return _c("tr", [_c("td", [_vm._v(_vm._s(item))])])
          }),
          0
        )
      ])
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "table-div" }, [
      _c("label", [_vm._v("Table Details:")]),
      _vm._v(" "),
      _c("table", { staticClass: "table-detail w-full font-bold" }, [
        _vm._m(0),
        _vm._v(" "),
        _c(
          "tbody",
          { staticClass: "table-body" },
          _vm._l(_vm.sortArrays(_vm.displayDatas), function(item) {
            return _c("tr", [
              _c("td", { staticClass: "newtext" }, [
                _vm._v(_vm._s(item.models.name))
              ]),
              _vm._v(" "),
              _c("td", { staticClass: "newtext" }, [
                _vm._v(_vm._s(item.aliasModel))
              ]),
              _vm._v(" "),
              _c("td", { staticClass: "newtext" }, [
                _vm._v(_vm._s(item.serialNumber))
              ]),
              _vm._v(" "),
              _c("td", { staticClass: "newtext" }, [
                _vm._v(_vm._s(item.conditions.name))
              ]),
              _vm._v(" "),
              _c("td", { staticClass: "newtext" }, [
                _vm._v(_vm._s(item.stockStatus))
              ]),
              _vm._v(" "),
              _c("td", { staticClass: "newtext" }, [
                _vm._v(_vm._s(item.whlocations.name))
              ]),
              _vm._v(" "),
              _c("td", { staticClass: "newtext" }, [
                _vm._v(_vm._s(item.transfer_pack))
              ]),
              _vm._v(" "),
              _c("td", { staticClass: "newtext" }, [_vm._v(_vm._s(item.note))])
            ])
          }),
          0
        )
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", { staticClass: "table-header" }, [
      _c("tr", [
        _c("th", { staticClass: "newtext" }, [_vm._v("Name")]),
        _vm._v(" "),
        _c("th", { staticClass: "newtext" }, [_vm._v("Alias Model")]),
        _vm._v(" "),
        _c("th", { staticClass: "newtext" }, [_vm._v("SN")]),
        _vm._v(" "),
        _c("th", { staticClass: "newtext" }, [_vm._v("Condition")]),
        _vm._v(" "),
        _c("th", { staticClass: "newtext" }, [_vm._v("Status")]),
        _vm._v(" "),
        _c("th", { staticClass: "newtext" }, [_vm._v("Warehouse")]),
        _vm._v(" "),
        _c("th", { staticClass: "newtext" }, [_vm._v("PackJV")]),
        _vm._v(" "),
        _c("th", { staticClass: "newtext" }, [_vm._v("Note")])
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
/* 11 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);