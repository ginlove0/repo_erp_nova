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
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
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
/* 1 */
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

var listToStyles = __webpack_require__(9)

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
/* 2 */
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
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(15)
}
var normalizeComponent = __webpack_require__(2)
/* script */
var __vue_script__ = __webpack_require__(17)
/* template */
var __vue_template__ = __webpack_require__(18)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-697bd052"
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
Component.options.__file = "resources/js/components/SearchCreation.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-697bd052", Component.options)
  } else {
    hotAPI.reload("data-v-697bd052", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 4 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(5);
module.exports = __webpack_require__(26);


/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

Nova.booting(function (Vue, router, store) {
  console.log('routerWhTransfer', router);
  router.addRoutes([{
    name: 'warehouse-transfer-tool',
    path: '/warehouse-transfer-tool',
    component: __webpack_require__(6)
  }]);
});

/***/ }),
/* 6 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(7)
}
var normalizeComponent = __webpack_require__(2)
/* script */
var __vue_script__ = __webpack_require__(10)
/* template */
var __vue_template__ = __webpack_require__(25)
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
/* 7 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(8);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(1)("6e5db1d0", content, false, {});
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
/* 8 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(0)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n/* Scoped Styles */\n#input-serialNumber {\n    height: 200px;\n    display: inline;\n    font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;\n    font-size: 18px;\n}\n#input-note {\n    height: 70px;\n    font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;\n    font-size: 18px;\n}\nlabel {\n    font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;\n    font-size: 20px;\n    font-weight: bold;\n}\n.submit-btn {\n    height: 50px;\n    font-size: 17px;\n    font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;\n}\n.table-detail {\n    margin-left: auto;\n    margin-right: auto;\n    width: 100%;\n    font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;\n}\n.class-select {\n    background: #fff;\n    cursor: pointer;\n    border: 1px solid;\n    border-radius: 3px;\n    color: #333;\n    display: block;\n    padding: 6px;\n    min-width: 350px;\n    max-width: 350px;\n    max-height: 35px;\n    min-height: 35px;\n    font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;\n    font-size: 18px;\n}\n.input-location {\n    background: #fff;\n    cursor: pointer;\n    border: 1px solid;\n    border-radius: 3px;\n    color: #333;\n    display: block;\n    padding: 6px;\n    min-width: 350px;\n    max-width: 350px;\n    max-height: 35px;\n    min-height: 35px;\n    font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;\n    font-size: 18px;\n}\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),
/* 9 */
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
/* 10 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__ModelModal__ = __webpack_require__(11);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__ModelModal___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__ModelModal__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__SearchCreation__ = __webpack_require__(3);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__SearchCreation___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__SearchCreation__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__SupplierModal__ = __webpack_require__(20);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__SupplierModal___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2__SupplierModal__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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

    components: { Dropdown: __WEBPACK_IMPORTED_MODULE_1__SearchCreation___default.a, ModelModal: __WEBPACK_IMPORTED_MODULE_0__ModelModal___default.a, SupplierModal: __WEBPACK_IMPORTED_MODULE_2__SupplierModal___default.a },

    data: function data() {
        return {
            items: [{
                serialNumber: '',
                aliasModel: '',
                whlocationId: '',
                location: '',
                modelId: '',
                supplierId: '',
                conditionId: 3000,
                note: ''
            }],
            models: [],
            suppliers: [],
            arrayItem: [],
            errors: [],
            success: [],
            countArray: [],
            isModalVisible: false,
            isSupplierModalVisible: false,
            fromModal: '',
            supplierToModal: '',
            nullValue: '',
            modelFromModal: '',
            supplierFromModal: ''

        };
    },


    methods: {
        handleSubmit: function handleSubmit() {
            var _this = this;

            this.errors = [];
            this.success = [];

            if (this.modelFromModal) {
                this.items[0].modelId = this.modelFromModal;
            }

            if (this.supplierFromModal) {
                this.items[0].supplierId = this.supplierFromModal;
            }

            if (!this.items[0].modelId) {
                this.errors.push('Model is required!');
            }
            if (!this.items[0].supplierId) {
                this.errors.push('Supplier is required!');
            }
            if (!this.items.serialNumber) {
                this.errors.push('Serial number is required!');
            }
            if (!this.items[0].whlocationId) {
                this.errors.push('Warehouse location is required!');
            }

            // console.log(this.items[0], 'hellooooooooooo');
            if (this.errors.length === 0) {
                var replaced_space_sn = this.items.serialNumber.replace(/\n/gi, " ");
                var replaced_comma_sn = replaced_space_sn.replace(/,/g, " ");
                var arr_sn = replaced_comma_sn.split(' ');
                this.arrayItem = _.uniq(arr_sn);
                this.countArray = [];

                this.arrayItem.map(function (newItem) {

                    if (newItem.length > 0) {
                        if (newItem.length === 12 && newItem.charAt(0) === 'S') {
                            newItem = newItem.slice(0, 0) + newItem.slice(1);
                        }
                        _this.items[0].serialNumber = newItem.trim().toUpperCase();

                        _this.countArray.push(newItem.trim());

                        console.log(JSON.stringify(_this.items[0]));
                        axios.get('/nova-vendor/warehouse-transfer-tool/addItemToStock/' + JSON.stringify(_this.items[0])).then(function (res) {
                            _this.success.push('Added ' + _this.countArray.length + ' items in stock');
                            _this.items = [{ serialNumber: '', aliasModel: '', modelId: '', supplierId: '', conditionId: 3000, note: '', whlocationId: '', location: '' }];
                        }).catch(function (err) {
                            console.log(err.message);
                        });
                    }
                });
            }
        },
        getAllSupplier: function getAllSupplier() {
            var _this2 = this;

            axios.get('/nova-vendor/warehouse-transfer-tool/timThuXemNhe/findAllSupplierInDB').then(function (res) {
                console.log(res);
                _this2.suppliers = res.data;
            }).catch(function (err) {
                console.log(err.message);
            });
        },


        //selected model
        validateSelectionSupplier: function validateSelectionSupplier(selection) {
            console.log(selection, 'selection');
            this.items[0].supplierId = selection.id;
            console.log(selection.name + ' has been selected');
        },
        getDropdownValuesInSupplier: function getDropdownValuesInSupplier(keyword) {

            console.log('You could refresh options by querying the API with ' + keyword);
            this.supplierToModal = keyword;
        },
        getAllModel: function getAllModel() {
            var _this3 = this;

            axios.get('/nova-vendor/warehouse-transfer-tool/findSomething/modelGetAll').then(function (res) {
                _this3.models = res.data;
            }).catch(function (err) {
                console.log(err.message);
            });
        },


        //selected model
        validateSelectionModel: function validateSelectionModel(selection) {
            this.items[0].modelId = selection.id;
            console.log(selection.name + ' has been selected');
        },
        getDropdownValuesInModel: function getDropdownValuesInModel(keyword) {

            console.log('You could refresh options by querying the API with ' + keyword);
            this.fromModal = keyword;
        },
        showModal: function showModal() {
            this.isModalVisible = true;
        },
        closeModal: function closeModal() {
            this.isModalVisible = false;
        },
        showModalSupplier: function showModalSupplier() {
            this.isSupplierModalVisible = true;
        },
        closeModalSupplier: function closeModalSupplier() {
            this.isSupplierModalVisible = false;
        },
        getModelNameFromModal: function getModelNameFromModal(value) {
            this.modelFromModal = value;
        },
        getSupplierNameFromModal: function getSupplierNameFromModal(value) {
            this.supplierFromModal = value;
        }
    },

    mounted: function mounted() {
        var _this4 = this;

        //
        this.getAllModel();
        this.getAllSupplier();
        Nova.$on('refetch-model-list', function () {
            _this4.getAllModel();
        });

        Nova.$on('refetch-supplier-list', function () {
            _this4.getAllSupplier();
        });

        Nova.$on('close', function () {
            _this4.closeModal();
            _this4.closeModalSupplier();
        });
    },


    computed: {}
});

/***/ }),
/* 11 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(12)
}
var normalizeComponent = __webpack_require__(2)
/* script */
var __vue_script__ = __webpack_require__(14)
/* template */
var __vue_template__ = __webpack_require__(19)
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
Component.options.__file = "resources/js/components/ModelModal.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-2d7ba8a2", Component.options)
  } else {
    hotAPI.reload("data-v-2d7ba8a2", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 12 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(13);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(1)("7234debe", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2d7ba8a2\",\"scoped\":false,\"hasInlineConfig\":true}!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ModelModal.vue", function() {
     var newContent = require("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2d7ba8a2\",\"scoped\":false,\"hasInlineConfig\":true}!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ModelModal.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 13 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(0)(false);
// imports


// module
exports.push([module.i, "\n.modal-backdrop {\n    position: fixed;\n    top: 0;\n    left:0;\n    right: 0;\n    bottom: 0;\n    background-color: rgba(0, 0, 0, 0.4);\n    display: -webkit-box;\n    display: -ms-flexbox;\n    display: flex;\n    -webkit-box-pack: center;\n        -ms-flex-pack: center;\n            justify-content: center;\n    -webkit-box-align: center;\n        -ms-flex-align: center;\n            align-items: center;\n    z-index: 100;\n    font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;\n}\n.modal {\n    background: #FFFFFF;\n    -webkit-box-shadow: 2px 2px 20px 1px;\n            box-shadow: 2px 2px 20px 1px;\n    overflow-x: auto;\n    display: -webkit-box;\n    display: -ms-flexbox;\n    display: flex;\n    -webkit-box-orient: vertical;\n    -webkit-box-direction: normal;\n        -ms-flex-direction: column;\n            flex-direction: column;\n}\n.modal-footer {\n    padding: 15px;\n    display: -webkit-box;\n    display: -ms-flexbox;\n    display: flex;\n}\n.modal-header {\n    border-bottom: 1px solid #eeeeee;\n    padding: 20px;\n    cursor: pointer;\n    font-weight: bold;\n    color: black;\n    background: transparent;\n    font-size: 40px;\n}\n.modal-footer {\n    border-top: 1px solid #eeeeee;\n    -webkit-box-pack: end;\n        -ms-flex-pack: end;\n            justify-content: flex-end;\n}\n.input-group {\n    background: #fff;\n    cursor: pointer;\n    border: 1px solid;\n    border-radius: 3px;\n    color: #333;\n    display: block;\n    font-size: 18px;\n    padding: 6px;\n    min-width: 350px;\n    max-width: 350px;\n    max-height: 35px;\n    min-height: 35px;\n}\n.textarea-group{\n    min-width: 350px;\n    max-width: 350px;\n    background: #fff;\n    cursor: pointer;\n    border: 1px solid;\n    border-radius: 3px;\n    color: #333;\n    display: block;\n    font-size: 18px;\n    padding: 6px;\n    min-height: 70px;\n}\n.btn-black{\n    border: none;\n    font-size: 20px;\n    padding: 20px;\n    cursor: pointer;\n    font-weight: bold;\n    color: black;\n    background: transparent;\n}\nlabel{\n    font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;\n    font-size: 20px;\n    font-weight: bold;\n}\n.table-modal {\n    display: contents;\n}\n.table-modal-row {\n    padding: 10px;\n    display: block;\n}\n\n", ""]);

// exports


/***/ }),
/* 14 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__SearchCreation__ = __webpack_require__(3);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__SearchCreation___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__SearchCreation__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
    components: { Dropdown: __WEBPACK_IMPORTED_MODULE_0__SearchCreation___default.a },
    name: 'ModelModal',
    props: ['inputName'],
    data: function data() {
        return {
            newModels: [{
                name: null,
                manufactorId: 1,
                categoryId: 1,
                shortDescription: '',
                longDescription: ''
            }],
            manufactors: [],
            categories: []
        };
    },

    methods: {
        close: function close() {
            this.$emit('close');
        },
        onSubmit: function onSubmit() {
            var _this = this;

            this.newModels[0].name = this.inputName.toUpperCase();
            if (this.newModels[0].name != null) {
                console.log(this.newModels[0], 'newmodel');
                axios.get('/nova-vendor/warehouse-transfer-tool/addNewModel/' + JSON.stringify(this.newModels[0])).then(function (res) {
                    console.log(res, 'resssssss');
                    Nova.$emit('close');
                    Nova.$emit('refetch-model-list');
                    _this.$emit('modelAdded', res.data.id);
                    alert('Create model success');
                }).catch(function (err) {
                    console.log('Khong pass dc data qua route o trong OnSubmit ModelModal');
                });
            } else {
                alert('Please fill up model field!!!');
            }
            this.newModels = [{ name: null, manufactorId: null, category: null, shortDescription: '', longDescription: '' }];
            Nova.$emit('refetch-model-list');
        },


        //get add model in DB
        getAllManufactor: function getAllManufactor() {
            var _this2 = this;

            axios.get('/nova-vendor/warehouse-transfer-tool/findManufactorInManuallyAdd/Manufactor').then(function (res) {
                _this2.manufactors = res.data;
            }).catch(function (err) {
                console.log(err.message);
            });
        },


        //get all condition in DB
        getAllCategory: function getAllCategory() {
            var _this3 = this;

            axios.get('/nova-vendor/warehouse-transfer-tool/findCategoryInManuallyAdd/Category').then(function (res) {
                _this3.categories = res.data;
            }).catch(function (err) {
                console.log(err.message);
            });
        },


        //selected manufactor
        validateSelectionManufactor: function validateSelectionManufactor(selection) {
            if (selection.id) {
                this.newModels[0].manufactorId = selection.id;
                console.log(selection.name + ' has been selected');
            } else {
                this.newModels[0].manufactorId = 1;
            }
        },


        //selected category
        validateSelectionCategory: function validateSelectionCategory(selection) {
            if (selection.id) {
                this.newModels[0].categoryId = selection.id;
                console.log(selection.name + ' has been selected');
            } else {
                this.newModels[0].categoryId = 1;
            }
        },
        getDropdownValues: function getDropdownValues(keyword) {
            console.log('You could refresh options by querying the API with ' + keyword);
        }
    },

    mounted: function mounted() {
        this.getAllCategory();
        this.getAllManufactor();
    },
    watch: function watch() {}
});

/***/ }),
/* 15 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(16);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(1)("99fc9404", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-697bd052\",\"scoped\":true,\"hasInlineConfig\":true}!../../../node_modules/sass-loader/lib/loader.js!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./SearchCreation.vue", function() {
     var newContent = require("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-697bd052\",\"scoped\":true,\"hasInlineConfig\":true}!../../../node_modules/sass-loader/lib/loader.js!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./SearchCreation.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 16 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(0)(false);
// imports


// module
exports.push([module.i, "\n.dropdown[data-v-697bd052] {\n  position: relative;\n  display: block;\n  margin: auto;\n}\n.dropdown .dropdown-input[data-v-697bd052] {\n    background: #fff;\n    cursor: pointer;\n    border: 1px solid;\n    border-radius: 3px;\n    color: #333;\n    display: block;\n    font-size: 18px;\n    padding: 6px;\n    min-width: 350px;\n    max-width: 350px;\n    max-height: 35px;\n    min-height: 35px;\n}\n.dropdown .dropdown-input[data-v-697bd052]:hover {\n      background: #f8f8fa;\n}\n.dropdown .dropdown-content[data-v-697bd052] {\n    position: absolute;\n    background-color: #fff;\n    min-width: 350px;\n    max-width: 350px;\n    max-height: 300px;\n    border: 1px solid;\n    -webkit-box-shadow: 0px -8px 34px 0px rgba(0, 0, 0, 0.05);\n            box-shadow: 0px -8px 34px 0px rgba(0, 0, 0, 0.05);\n    overflow: auto;\n    z-index: 1;\n}\n.dropdown .dropdown-content .dropdown-item[data-v-697bd052] {\n      color: black;\n      font-size: 15px;\n      line-height: 1em;\n      padding: 8px;\n      text-decoration: none;\n      display: block;\n      cursor: pointer;\n      font-weight: bold;\n}\n.dropdown .dropdown-content .dropdown-item[data-v-697bd052]:hover {\n        background-color: #e7ecf5;\n}\n.dropdown .dropdown:hover .dropdowncontent[data-v-697bd052] {\n    display: block;\n}\n.svg-icon[data-v-697bd052] {\n  width: 2rem;\n  height: 1.5rem;\n  /*padding-left: 10px;*/\n  margin-left: 100px;\n}\n.svg-icon path[data-v-697bd052],\n.svg-icon polygon[data-v-697bd052],\n.svg-icon rect[data-v-697bd052] {\n  fill: #4691f6;\n}\n.svg-icon circle[data-v-697bd052] {\n  stroke: #4691f6;\n  stroke-width: 1;\n}\n", ""]);

// exports


/***/ }),
/* 17 */
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
            default: 10,
            note: 'Max items showing'
        },
        clickCreate: {
            type: Function,
            required: false,
            default: false,
            note: 'Click to create modal'
        }
    },
    data: function data() {
        return {
            selected: {},
            optionsShown: false,
            searchFilter: '',
            chosed: {}
        };
    },
    created: function created() {
        this.$emit('selected', this.selected);
    },

    computed: {
        filteredOptions: function filteredOptions() {
            var filtered = [];
            var regOption = new RegExp(this.searchFilter.trim(), 'ig');
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
        exit: function exit() {
            if (!this.selected.id) {
                this.selected = {};
                this.searchFilter = '';
            } else {
                this.searchFilter = this.selected.name;
            }
            this.$emit('selected', this.selected);
            this.optionsShown = false;
        },

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
/* 18 */
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
          staticClass:
            "w-full form-control form-input form-input-bordered dropdown-input",
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
            blur: function($event) {
              return _vm.onBlur()
            },
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
            _vm.clickCreate
              ? _c(
                  "div",
                  {
                    staticClass: "dropdown-item",
                    on: { mousedown: _vm.clickCreate }
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
              : _vm._e()
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
    require("vue-hot-reload-api")      .rerender("data-v-697bd052", module.exports)
  }
}

/***/ }),
/* 19 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("transition", { attrs: { name: "modal-fade" } }, [
    _c("div", { staticClass: "modal-backdrop" }, [
      _c(
        "div",
        {
          staticClass: "modal",
          attrs: {
            role: "dialog",
            "aria-labelledby": "modalTitle",
            "aria-describedby": "modalDescription"
          }
        },
        [
          _c(
            "table",
            { staticClass: "table-modal" },
            [
              _c("thead", { staticClass: "modal-header" }, [
                _vm._v("Create new model")
              ]),
              _vm._v(" "),
              _vm._l(_vm.newModels, function(newModel) {
                return _c("tbody", [
                  _c("tr", { staticClass: "table-modal-row" }, [
                    _c("label", [_vm._v("Name:")]),
                    _vm._v(" "),
                    _c("td", [
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.inputName.toUpperCase(),
                            expression: "inputName.toUpperCase()"
                          }
                        ],
                        staticClass: "input-group",
                        attrs: {
                          readonly: "",
                          required: "",
                          type: "text",
                          placeholder: "Input model name"
                        },
                        domProps: { value: _vm.inputName.toUpperCase() },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(
                              _vm.inputName,
                              "toUpperCase()",
                              $event.target.value
                            )
                          }
                        }
                      })
                    ])
                  ]),
                  _vm._v(" "),
                  _c("tr", { staticClass: "table-modal-row" }, [
                    _c("label", [_vm._v("Manufactor:")]),
                    _vm._v(" "),
                    _c(
                      "td",
                      [
                        _c("Dropdown", {
                          attrs: {
                            options: _vm.manufactors,
                            disabled: false,
                            placeholder: "Please select manufactor"
                          },
                          on: {
                            selected: _vm.validateSelectionManufactor,
                            filter: _vm.getDropdownValues
                          }
                        })
                      ],
                      1
                    )
                  ]),
                  _vm._v(" "),
                  _c("tr", { staticClass: "table-modal-row" }, [
                    _c("label", [_vm._v("Category:")]),
                    _vm._v(" "),
                    _c(
                      "td",
                      [
                        _c("Dropdown", {
                          attrs: {
                            options: _vm.categories,
                            disabled: false,
                            placeholder: "Please select category"
                          },
                          on: {
                            selected: _vm.validateSelectionCategory,
                            filter: _vm.getDropdownValues
                          }
                        })
                      ],
                      1
                    )
                  ]),
                  _vm._v(" "),
                  _c("tr", { staticClass: "table-modal-row" }, [
                    _c("label", [_vm._v("Short Description:")]),
                    _vm._v(" "),
                    _c("td", [
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: newModel.shortDescription,
                            expression: "newModel.shortDescription"
                          }
                        ],
                        staticClass: "input-group",
                        attrs: {
                          type: "text",
                          placeholder: "Short description"
                        },
                        domProps: { value: newModel.shortDescription },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(
                              newModel,
                              "shortDescription",
                              $event.target.value
                            )
                          }
                        }
                      })
                    ])
                  ]),
                  _vm._v(" "),
                  _c("tr", { staticClass: "table-modal-row" }, [
                    _c("label", [_vm._v("Long Description:")]),
                    _vm._v(" "),
                    _c("td", [
                      _c("textarea", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: newModel.longDescription,
                            expression: "newModel.longDescription"
                          }
                        ],
                        staticClass: "textarea-group",
                        attrs: {
                          type: "text",
                          placeholder: "Long description"
                        },
                        domProps: { value: newModel.longDescription },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(
                              newModel,
                              "longDescription",
                              $event.target.value
                            )
                          }
                        }
                      })
                    ])
                  ])
                ])
              }),
              _vm._v(" "),
              _c("tfoot", { staticClass: "modal-footer" }, [
                _c("tr", { staticClass: "table-modal-row" }, [
                  _c("td", [
                    _c(
                      "button",
                      {
                        staticClass: "btn-black",
                        attrs: { type: "button", "aria-label": "Close modal" },
                        on: { click: _vm.close }
                      },
                      [
                        _vm._v(
                          "\n                            Close\n                        "
                        )
                      ]
                    )
                  ]),
                  _vm._v(" "),
                  _c("td", [
                    _c(
                      "button",
                      {
                        staticClass: "btn-black",
                        attrs: { "aria-label": "Submit modal" },
                        on: { click: _vm.onSubmit }
                      },
                      [
                        _vm._v(
                          "\n                            Submit\n                        "
                        )
                      ]
                    )
                  ])
                ])
              ])
            ],
            2
          )
        ]
      )
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-2d7ba8a2", module.exports)
  }
}

/***/ }),
/* 20 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(21)
}
var normalizeComponent = __webpack_require__(2)
/* script */
var __vue_script__ = __webpack_require__(23)
/* template */
var __vue_template__ = __webpack_require__(24)
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
Component.options.__file = "resources/js/components/SupplierModal.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-a6f93934", Component.options)
  } else {
    hotAPI.reload("data-v-a6f93934", Component.options)
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
var update = __webpack_require__(1)("2a9f80c2", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-a6f93934\",\"scoped\":false,\"hasInlineConfig\":true}!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./SupplierModal.vue", function() {
     var newContent = require("!!../../../node_modules/css-loader/index.js!../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-a6f93934\",\"scoped\":false,\"hasInlineConfig\":true}!../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./SupplierModal.vue");
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

exports = module.exports = __webpack_require__(0)(false);
// imports


// module
exports.push([module.i, "\n.modal-backdrop {\n    position: fixed;\n    top: 0;\n    left:0;\n    right: 0;\n    bottom: 0;\n    background-color: rgba(0, 0, 0, 0.4);\n    display: -webkit-box;\n    display: -ms-flexbox;\n    display: flex;\n    -webkit-box-pack: center;\n        -ms-flex-pack: center;\n            justify-content: center;\n    -webkit-box-align: center;\n        -ms-flex-align: center;\n            align-items: center;\n    z-index: 100;\n    font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;\n}\n.modal {\n    background: #FFFFFF;\n    -webkit-box-shadow: 2px 2px 20px 1px;\n            box-shadow: 2px 2px 20px 1px;\n    overflow-x: auto;\n    display: -webkit-box;\n    display: -ms-flexbox;\n    display: flex;\n    -webkit-box-orient: vertical;\n    -webkit-box-direction: normal;\n        -ms-flex-direction: column;\n            flex-direction: column;\n}\n.modal-footer {\n    padding: 15px;\n    display: -webkit-box;\n    display: -ms-flexbox;\n    display: flex;\n}\n.modal-header {\n    border-bottom: 1px solid #eeeeee;\n    padding: 20px;\n    cursor: pointer;\n    font-weight: bold;\n    color: black;\n    background: transparent;\n    font-size: 40px;\n}\n.modal-footer {\n    border-top: 1px solid #eeeeee;\n    -webkit-box-pack: end;\n        -ms-flex-pack: end;\n            justify-content: flex-end;\n}\n.input-group {\n    background: #fff;\n    cursor: pointer;\n    border: 1px solid;\n    border-radius: 3px;\n    color: #333;\n    display: block;\n    font-size: 18px;\n    padding: 6px;\n    min-width: 350px;\n    max-width: 350px;\n    max-height: 35px;\n    min-height: 35px;\n}\n.textarea-group{\n    min-width: 350px;\n    max-width: 350px;\n    background: #fff;\n    cursor: pointer;\n    border: 1px solid;\n    border-radius: 3px;\n    color: #333;\n    display: block;\n    font-size: 18px;\n    padding: 6px;\n    min-height: 70px;\n}\n.btn-black{\n    border: none;\n    font-size: 20px;\n    padding: 20px;\n    cursor: pointer;\n    font-weight: bold;\n    color: black;\n    background: transparent;\n}\nlabel{\n    font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;\n    font-size: 20px;\n    font-weight: bold;\n}\n.table-modal {\n    display: contents;\n}\n.table-modal-row {\n    padding: 10px;\n    display: block;\n}\n\n", ""]);

// exports


/***/ }),
/* 23 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__SearchCreation__ = __webpack_require__(3);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__SearchCreation___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__SearchCreation__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
    components: { Dropdown: __WEBPACK_IMPORTED_MODULE_0__SearchCreation___default.a },
    name: 'SupplierModal',
    props: ['inputName'],
    data: function data() {
        return {
            newSuppliers: [{
                name: null,
                contactType: 'Individual',
                pricingLevel: '5'
            }]
        };
    },

    methods: {
        close: function close() {
            this.$emit('close');
        },
        onSubmit: function onSubmit() {
            var _this = this;

            this.newSuppliers[0].name = this.inputName.toUpperCase();
            if (this.newSuppliers[0].name != null) {
                axios.get('/nova-vendor/warehouse-transfer-tool/addNewSupplier/' + JSON.stringify(this.newSuppliers[0])).then(function (res) {
                    Nova.$emit('close');
                    Nova.$emit('refetch-supplier-list');
                    _this.$emit('supplierAdded', res.data.id);
                    alert('Create supplier success');
                }).catch(function (err) {
                    console.log(err);
                });
            } else {
                alert('Please fill up supplier name field!!!');
            }
            this.newModels = [{ name: null, contactType: 'Individual', pricingLevel: '5' }];
            Nova.$emit('refetch-supplier-list');
        }
    },

    mounted: function mounted() {},
    watch: function watch() {}
});

/***/ }),
/* 24 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("transition", { attrs: { name: "modal-fade" } }, [
    _c("div", { staticClass: "modal-backdrop" }, [
      _c(
        "div",
        {
          staticClass: "modal",
          attrs: {
            role: "dialog",
            "aria-labelledby": "modalTitle",
            "aria-describedby": "modalDescription"
          }
        },
        [
          _c(
            "table",
            { staticClass: "table-modal" },
            [
              _c("thead", { staticClass: "modal-header" }, [
                _vm._v("Create new supplier")
              ]),
              _vm._v(" "),
              _vm._l(_vm.newSuppliers, function(newSupplier) {
                return _c("tbody", [
                  _c("tr", { staticClass: "table-modal-row" }, [
                    _c("label", [_vm._v("Name:")]),
                    _vm._v(" "),
                    _c("td", [
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.inputName.toUpperCase(),
                            expression: "inputName.toUpperCase()"
                          }
                        ],
                        staticClass: "input-group",
                        attrs: {
                          readonly: "",
                          required: "",
                          type: "text",
                          placeholder: "Input model name"
                        },
                        domProps: { value: _vm.inputName.toUpperCase() },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(
                              _vm.inputName,
                              "toUpperCase()",
                              $event.target.value
                            )
                          }
                        }
                      })
                    ])
                  ]),
                  _vm._v(" "),
                  _c("tr", { staticClass: "table-modal-row" }, [
                    _c("label", [_vm._v("Contact type:")]),
                    _vm._v(" "),
                    _c("td", [
                      _c(
                        "select",
                        {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: newSupplier.contactType,
                              expression: "newSupplier.contactType"
                            }
                          ],
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
                                newSupplier,
                                "contactType",
                                $event.target.multiple
                                  ? $$selectedVal
                                  : $$selectedVal[0]
                              )
                            }
                          }
                        },
                        [
                          _c("option", { attrs: { value: "Gov" } }, [
                            _vm._v("Gov")
                          ]),
                          _vm._v(" "),
                          _c("option", { attrs: { value: "Corp" } }, [
                            _vm._v("Corp")
                          ]),
                          _vm._v(" "),
                          _c("option", { attrs: { value: "Broker" } }, [
                            _vm._v("Broker")
                          ]),
                          _vm._v(" "),
                          _c(
                            "option",
                            { attrs: { selected: "", value: "Individual" } },
                            [_vm._v("Individual")]
                          )
                        ]
                      )
                    ])
                  ]),
                  _vm._v(" "),
                  _c("tr", { staticClass: "table-modal-row" }, [
                    _c("label", [_vm._v("Pricing level:")]),
                    _vm._v(" "),
                    _c("td", [
                      _c(
                        "select",
                        {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: newSupplier.pricingLevel,
                              expression: "newSupplier.pricingLevel"
                            }
                          ],
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
                                newSupplier,
                                "pricingLevel",
                                $event.target.multiple
                                  ? $$selectedVal
                                  : $$selectedVal[0]
                              )
                            }
                          }
                        },
                        [
                          _c("option", { attrs: { value: "1" } }, [
                            _vm._v("1")
                          ]),
                          _vm._v(" "),
                          _c("option", { attrs: { value: "2" } }, [
                            _vm._v("2")
                          ]),
                          _vm._v(" "),
                          _c("option", { attrs: { value: "3" } }, [
                            _vm._v("3")
                          ]),
                          _vm._v(" "),
                          _c("option", { attrs: { value: "4" } }, [
                            _vm._v("4")
                          ]),
                          _vm._v(" "),
                          _c(
                            "option",
                            { attrs: { selected: "", value: "5" } },
                            [_vm._v("5")]
                          )
                        ]
                      )
                    ])
                  ])
                ])
              }),
              _vm._v(" "),
              _c("tfoot", { staticClass: "modal-footer" }, [
                _c("tr", { staticClass: "table-modal-row" }, [
                  _c("td", [
                    _c(
                      "button",
                      {
                        staticClass: "btn-black",
                        attrs: { type: "button", "aria-label": "Close modal" },
                        on: { click: _vm.close }
                      },
                      [
                        _vm._v(
                          "\n                            Close\n                        "
                        )
                      ]
                    )
                  ]),
                  _vm._v(" "),
                  _c("td", [
                    _c(
                      "button",
                      {
                        staticClass: "btn-black",
                        attrs: { "aria-label": "Submit modal" },
                        on: { click: _vm.onSubmit }
                      },
                      [
                        _vm._v(
                          "\n                            Submit\n                        "
                        )
                      ]
                    )
                  ])
                ])
              ])
            ],
            2
          )
        ]
      )
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-a6f93934", module.exports)
  }
}

/***/ }),
/* 25 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c("heading", { staticClass: "mb-6" }, [_vm._v("Add item manualy")]),
      _vm._v(" "),
      _vm.errors.length
        ? _c("p", [
            _c("b", [_vm._v("Please correct the following error(s):")]),
            _vm._v(" "),
            _c(
              "ul",
              _vm._l(_vm.errors, function(error) {
                return _c("li", { staticStyle: { color: "red" } }, [
                  _vm._v(_vm._s(error))
                ])
              }),
              0
            )
          ])
        : _vm._e(),
      _vm._v(" "),
      _vm.success.length
        ? _c("p", [
            _c("b", [_vm._v("Please attending the notification:")]),
            _vm._v(" "),
            _c("ul", [
              _c("li", { staticStyle: { color: "green" } }, [
                _vm._v(_vm._s(_vm.success[0]))
              ])
            ])
          ])
        : _vm._e(),
      _vm._v(" "),
      _c("div", [
        _c("table", { staticClass: "table-detail" }, [
          _c("tbody", [
            _c("tr", [
              _c(
                "td",
                { attrs: { colspan: "4" } },
                [
                  _c("label", [_vm._v(" Model: ")]),
                  _vm._v(" "),
                  _c("Dropdown", {
                    attrs: {
                      id: "model-dropdown",
                      options: _vm.models,
                      "click-create": _vm.showModal,
                      disabled: false,
                      placeholder: "Please select model"
                    },
                    on: {
                      selected: _vm.validateSelectionModel,
                      filter: _vm.getDropdownValuesInModel
                    }
                  }),
                  _vm._v(" "),
                  _c("ModelModal", {
                    directives: [
                      {
                        name: "show",
                        rawName: "v-show",
                        value: _vm.isModalVisible,
                        expression: "isModalVisible"
                      }
                    ],
                    attrs: { "input-name": _vm.fromModal },
                    on: {
                      close: _vm.closeModal,
                      modelAdded: _vm.getModelNameFromModal
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c("td", { attrs: { colspan: "4" } }, [
                _c("label", [_vm._v(" Condition: ")]),
                _vm._v(" "),
                _c(
                  "select",
                  {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.items[0].conditionId,
                        expression: "items[0].conditionId"
                      }
                    ],
                    staticClass:
                      "w-full form-control form-input form-input-bordered class-select",
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
                          _vm.items[0],
                          "conditionId",
                          $event.target.multiple
                            ? $$selectedVal
                            : $$selectedVal[0]
                        )
                      }
                    }
                  },
                  [
                    _c("option", { attrs: { value: "1000" } }, [_vm._v("NIB")]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "1250" } }, [_vm._v("NOB")]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "1500" } }, [
                      _vm._v("USEA")
                    ]),
                    _vm._v(" "),
                    _c("option", { attrs: { selected: "", value: "3000" } }, [
                      _vm._v("USEB")
                    ]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "4000" } }, [
                      _vm._v("USEC")
                    ]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "5001" } }, [_vm._v("REF")]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "5000" } }, [_vm._v("PART")])
                  ]
                )
              ]),
              _vm._v(" "),
              _c("td", { attrs: { colspan: "4" } }, [
                _c("label", [_vm._v("Location: ")]),
                _vm._v(" "),
                _c("input", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.items[0].location,
                      expression: "items[0].location"
                    }
                  ],
                  staticClass:
                    "w-full form-control form-input form-input-bordered input-location",
                  attrs: { type: "text" },
                  domProps: { value: _vm.items[0].location },
                  on: {
                    input: function($event) {
                      if ($event.target.composing) {
                        return
                      }
                      _vm.$set(_vm.items[0], "location", $event.target.value)
                    }
                  }
                })
              ])
            ]),
            _vm._v(" "),
            _c("tr", [
              _c(
                "td",
                { attrs: { colspan: "4" } },
                [
                  _c("label", [_vm._v(" Supplier: ")]),
                  _vm._v(" "),
                  _c("Dropdown", {
                    attrs: {
                      id: "supplier-dropdown",
                      options: _vm.suppliers,
                      "click-create": _vm.showModalSupplier,
                      disabled: false,
                      placeholder: "Please select supplier"
                    },
                    on: {
                      selected: _vm.validateSelectionSupplier,
                      filter: _vm.getDropdownValuesInSupplier
                    }
                  }),
                  _vm._v(" "),
                  _c("SupplierModal", {
                    directives: [
                      {
                        name: "show",
                        rawName: "v-show",
                        value: _vm.isSupplierModalVisible,
                        expression: "isSupplierModalVisible"
                      }
                    ],
                    attrs: { "input-name": _vm.supplierToModal },
                    on: {
                      close: _vm.closeModalSupplier,
                      supplierAdded: _vm.getSupplierNameFromModal
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c("td", { attrs: { colspan: "4" } }, [
                _c("label", [_vm._v(" Warehouse:")]),
                _vm._v(" "),
                _c(
                  "select",
                  {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.items[0].whlocationId,
                        expression: "items[0].whlocationId"
                      }
                    ],
                    staticClass:
                      "w-full form-control form-input form-input-bordered class-select",
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
                          _vm.items[0],
                          "whlocationId",
                          $event.target.multiple
                            ? $$selectedVal
                            : $$selectedVal[0]
                        )
                      }
                    }
                  },
                  [
                    _c("option", { attrs: { value: "1" } }, [_vm._v("Sydney")]),
                    _vm._v(" "),
                    _c("option", { attrs: { value: "2" } }, [_vm._v("US")])
                  ]
                )
              ])
            ]),
            _vm._v(" "),
            _c("tr", [
              _c("td", { staticClass: "input-col", attrs: { colspan: "12" } }, [
                _c("label", [_vm._v("Serial Number:")]),
                _vm._v(" "),
                _c("textarea", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.items.serialNumber,
                      expression: "items.serialNumber"
                    }
                  ],
                  staticClass:
                    "w-full form-control form-input form-input-bordered",
                  class: _vm.errorClasses,
                  attrs: { id: "input-serialNumber", type: "text" },
                  domProps: { value: _vm.items.serialNumber },
                  on: {
                    input: function($event) {
                      if ($event.target.composing) {
                        return
                      }
                      _vm.$set(_vm.items, "serialNumber", $event.target.value)
                    }
                  }
                })
              ])
            ]),
            _vm._v(" "),
            _c("tr", [
              _c("td", { staticClass: "note-col", attrs: { colspan: "12" } }, [
                _c("label", [_vm._v("Note:")]),
                _vm._v(" "),
                _c("textarea", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.items[0].note,
                      expression: "items[0].note"
                    }
                  ],
                  staticClass:
                    "w-full form-control form-input form-input-bordered",
                  class: _vm.errorClasses,
                  attrs: { id: "input-note", type: "text" },
                  domProps: { value: _vm.items[0].note },
                  on: {
                    input: function($event) {
                      if ($event.target.composing) {
                        return
                      }
                      _vm.$set(_vm.items[0], "note", $event.target.value)
                    }
                  }
                })
              ])
            ])
          ])
        ])
      ]),
      _vm._v(" "),
      _c("div", [
        _c(
          "button",
          {
            staticClass: "w-full btn btn-group-lg btn-primary submit-btn",
            attrs: { type: "button" },
            on: { click: _vm.handleSubmit }
          },
          [_vm._v("\n            Submit\n        ")]
        )
      ])
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-68ff5483", module.exports)
  }
}

/***/ }),
/* 26 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);