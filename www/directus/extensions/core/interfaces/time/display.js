parcelRequire=function(e,r,t,n){var i,o="function"==typeof parcelRequire&&parcelRequire,u="function"==typeof require&&require;function f(t,n){if(!r[t]){if(!e[t]){var i="function"==typeof parcelRequire&&parcelRequire;if(!n&&i)return i(t,!0);if(o)return o(t,!0);if(u&&"string"==typeof t)return u(t);var c=new Error("Cannot find module '"+t+"'");throw c.code="MODULE_NOT_FOUND",c}p.resolve=function(r){return e[t][1][r]||r},p.cache={};var l=r[t]=new f.Module(t);e[t][0].call(l.exports,p,l,l.exports,this)}return r[t].exports;function p(e){return f(p.resolve(e))}}f.isParcelRequire=!0,f.Module=function(e){this.id=e,this.bundle=f,this.exports={}},f.modules=e,f.cache=r,f.parent=o,f.register=function(r,t){e[r]=[function(e,r){r.exports=t},{}]};for(var c=0;c<t.length;c++)try{f(t[c])}catch(e){i||(i=e)}if(t.length){var l=f(t[t.length-1]);"object"==typeof exports&&"undefined"!=typeof module?module.exports=l:"function"==typeof define&&define.amd?define(function(){return l}):n&&(this[n]=l)}if(parcelRequire=f,i)throw i;return f}({"QdEO":[function(require,module,exports) {
module.exports={props:{name:{type:String,required:!0},value:{type:null,default:null},type:{type:String,required:!0},length:{type:[String,Number],default:null},readonly:{type:Boolean,default:!1},required:{type:Boolean,default:!1},options:{type:Object,default:function(){return{}}},newItem:{type:Boolean,default:!1},relation:{type:Object,default:null},fields:{type:Object,default:null},values:{type:Object,default:null}}};
},{}],"hCJP":[function(require,module,exports) {
"use strict";Object.defineProperty(exports,"__esModule",{value:!0}),exports.default=void 0;var t=e(require("../../../mixins/interface"));function e(t){return t&&t.__esModule?t:{default:t}}var a={mixins:[t.default],computed:{displayValue:function(){if(this.value&&!1===this.options.display24HourClock){var t=this.value.split(":").map(function(t){return Number(t)}),e=t[0],a=t[1],u=t[2],c="AM";return e>=12&&(c="PM"),e="00"==(e=e>12?e-12:e)?12:e,u?"".concat(e,":").concat(a,":").concat(u," ").concat(c):"".concat(e,":").concat(a," ").concat(c)}return this.value}}};exports.default=a;
(function(){var t=exports.default||module.exports;"function"==typeof t&&(t=t.options),Object.assign(t,{render:function(){var t=this.$createElement,s=this._self._c||t;return this.options.showRelative?s("v-timeago",{staticClass:"no-wrap",attrs:{since:this.date,"auto-update":this.options.includeSeconds?1:60,locale:this.$i18n.locale}}):s("span",{staticClass:"no-wrap"},[this._v(this._s(this.displayValue))])},staticRenderFns:[],_compiled:!0,_scopeId:null,functional:void 0});})();
},{"../../../mixins/interface":"QdEO"}]},{},["hCJP"], "__DirectusExtension__")