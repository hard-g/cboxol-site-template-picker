(()=>{var t={228:t=>{t.exports=function(t,e){(null==e||e>t.length)&&(e=t.length);for(var r=0,n=new Array(e);r<e;r++)n[r]=t[r];return n}},858:t=>{t.exports=function(t){if(Array.isArray(t))return t}},926:t=>{function e(t,e,r,n,o,a,i){try{var c=t[a](i),u=c.value}catch(t){return void r(t)}c.done?e(u):Promise.resolve(u).then(n,o)}t.exports=function(t){return function(){var r=this,n=arguments;return new Promise((function(o,a){var i=t.apply(r,n);function c(t){e(i,o,a,c,u,"next",t)}function u(t){e(i,o,a,c,u,"throw",t)}c(void 0)}))}}},884:t=>{t.exports=function(t,e){if("undefined"!=typeof Symbol&&Symbol.iterator in Object(t)){var r=[],n=!0,o=!1,a=void 0;try{for(var i,c=t[Symbol.iterator]();!(n=(i=c.next()).done)&&(r.push(i.value),!e||r.length!==e);n=!0);}catch(t){o=!0,a=t}finally{try{n||null==c.return||c.return()}finally{if(o)throw a}}return r}}},521:t=>{t.exports=function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}},38:(t,e,r)=>{var n=r(858),o=r(884),a=r(379),i=r(521);t.exports=function(t,e){return n(t)||o(t,e)||a(t,e)||i()}},379:(t,e,r)=>{var n=r(228);t.exports=function(t,e){if(t){if("string"==typeof t)return n(t,e);var r=Object.prototype.toString.call(t).slice(8,-1);return"Object"===r&&t.constructor&&(r=t.constructor.name),"Map"===r||"Set"===r?Array.from(t):"Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r)?n(t,e):void 0}}},757:(t,e,r)=>{t.exports=r(666)},732:(t,e,r)=>{"use strict";var n=r(757),o=r.n(n),a=r(926),i=r.n(a),c=r(38),u=r.n(c);function l(t,e){var r;if("undefined"==typeof Symbol||null==t[Symbol.iterator]){if(Array.isArray(t)||(r=function(t,e){if(!t)return;if("string"==typeof t)return s(t,e);var r=Object.prototype.toString.call(t).slice(8,-1);"Object"===r&&t.constructor&&(r=t.constructor.name);if("Map"===r||"Set"===r)return Array.from(t);if("Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r))return s(t,e)}(t))||e&&t&&"number"==typeof t.length){r&&(t=r);var n=0,o=function(){};return{s:o,n:function(){return n>=t.length?{done:!0}:{done:!1,value:t[n++]}},e:function(t){throw t},f:o}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var a,i=!0,c=!1;return{s:function(){r=t[Symbol.iterator]()},n:function(){var t=r.next();return i=t.done,t},e:function(t){c=!0,a=t},f:function(){try{i||null==r.return||r.return()}finally{if(c)throw a}}}}function s(t,e){(null==e||e>t.length)&&(e=t.length);for(var r=0,n=new Array(e);r<e;r++)n[r]=t[r];return n}function f(t){for(var e,r="",n=Object.entries(t);e=n.shift();){var o=e,a=u()(o,2),i=a[0],c=a[1];if(Array.isArray(c)||c&&c.constructor===Object){var s,f=l(Object.entries(c).reverse());try{for(f.s();!(s=f.n()).done;){var p=u()(s.value,2),h=p[0],d=p[1];n.unshift(["".concat(i,"[").concat(h,"]"),d])}}catch(t){f.e(t)}finally{f.f()}}else void 0!==c&&(null===c&&(c=""),r+="&"+[i,c].map(encodeURIComponent).join("="))}return r.substr(1)}var p=window.SiteTemplatePicker.endpoint,h=window.SiteTemplatePicker.perPage;function d(t){return v.apply(this,arguments)}function v(){return(v=i()(o().mark((function t(e){var r,n,a,i,c,u,l=arguments;return o().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return r=l.length>1&&void 0!==l[1]?l[1]:1,n=f({_fields:["id","title","excerpt","featured_media","template_category","site_id","image","categories"],template_category:e,per_page:Number(h),page:r}),t.next=4,fetch(p+"?"+n);case 4:return a=t.sent,t.next=7,a.json();case 7:if(i=t.sent,a.ok){t.next=10;break}throw new Error(i.message);case 10:return c=Number(a.headers.get("X-WP-TotalPages")),u=i.map((function(t){return{id:t.site_id,title:t.title.rendered,excerpt:t.excerpt.rendered,image:t.image,categories:t.categories}})),t.abrupt("return",{templates:u,prev:r>1?r-1:null,next:c>r?r+1:null});case 13:case"end":return t.stop()}}),t)})))).apply(this,arguments)}var y=document.querySelector("#site-template-categories"),m=document.querySelector(".site-template-picker"),g=document.querySelector(".site-template-pagination"),w=document.querySelector("#template-to-clone"),b=window.SiteTemplatePicker.messages;function x(t){var e=t.id,r=t.title,n=t.excerpt,o=t.image,a=t.categories;return'\n\t<button type="button" class="site-template-component" data-template-id="'.concat(e,'">\n\t\t<div class="site-template-component__image">\n\t\t\t').concat(o?'<img src="'.concat(o,'" alt="').concat(r,'">'):'<svg fill="currentColor" width="24" height="24" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path></svg>',"\n\t\t\t").concat(n?'<div class="site-template-component__description">'.concat(n,"</div>"):"",'\n\t\t</div>\n\t\t<div class="site-template-component__meta">\n\t\t\t<span class="site-template-component__category">').concat(a.join(", "),'</span>\n\t\t\t<div class="site-template-component__name">').concat(r,"</div>\n\t\t</div>\n\t</button>\n\t")}function _(t,e){var r=g.querySelector(".prev"),n=g.querySelector(".next");r.disabled=!0,n.disabled=!0,t&&(r.dataset.page=t,r.disabled=!1),e&&(n.dataset.page=e,n.disabled=!1)}function L(t,e){m.innerHTML="<p>".concat(b.loading,"</p>"),d(t,e).then((function(t){var e=t.templates,r=t.prev,n=t.next;if(w.value="",e.length){var o=e.map((function(t){return x(t)})).join("");m.innerHTML=o,_(r,n)}else m.innerHTML="<p>".concat(b.noResults,"</p>")}))}y.addEventListener("blur",(function(t){var e="0"!==t.target.value?t.target.value:null;m.innerHTML="<p>".concat(b.loading,"</p>"),L(e)})),m.addEventListener("click",(function(t){var e=t.target.closest(".site-template-component");if(e){var r=this.querySelectorAll(".site-template-component"),n=e.dataset.templateId;r.forEach((function(t){return t.classList.remove("is-selected")})),e.classList.add("is-selected"),w.value=n}})),g.addEventListener("click",(function(t){var e=t.target.closest(".btn");e&&L("0"!==y.value?y.value:null,e.dataset.page?Number(e.dataset.page):null)})),d().then((function(t){var e=t.templates,r=t.prev,n=t.next,o=e.map((function(t){return x(t)})).join("");m.innerHTML=o,_(r,n)}))},267:()=>{},666:t=>{var e=function(t){"use strict";var e,r=Object.prototype,n=r.hasOwnProperty,o="function"==typeof Symbol?Symbol:{},a=o.iterator||"@@iterator",i=o.asyncIterator||"@@asyncIterator",c=o.toStringTag||"@@toStringTag";function u(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{u({},"")}catch(t){u=function(t,e,r){return t[e]=r}}function l(t,e,r,n){var o=e&&e.prototype instanceof y?e:y,a=Object.create(o.prototype),i=new O(n||[]);return a._invoke=function(t,e,r){var n=f;return function(o,a){if(n===h)throw new Error("Generator is already running");if(n===d){if("throw"===o)throw a;return P()}for(r.method=o,r.arg=a;;){var i=r.delegate;if(i){var c=j(i,r);if(c){if(c===v)continue;return c}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if(n===f)throw n=d,r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n=h;var u=s(t,e,r);if("normal"===u.type){if(n=r.done?d:p,u.arg===v)continue;return{value:u.arg,done:r.done}}"throw"===u.type&&(n=d,r.method="throw",r.arg=u.arg)}}}(t,r,i),a}function s(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=l;var f="suspendedStart",p="suspendedYield",h="executing",d="completed",v={};function y(){}function m(){}function g(){}var w={};w[a]=function(){return this};var b=Object.getPrototypeOf,x=b&&b(b(A([])));x&&x!==r&&n.call(x,a)&&(w=x);var _=g.prototype=y.prototype=Object.create(w);function L(t){["next","throw","return"].forEach((function(e){u(t,e,(function(t){return this._invoke(e,t)}))}))}function E(t,e){function r(o,a,i,c){var u=s(t[o],t,a);if("throw"!==u.type){var l=u.arg,f=l.value;return f&&"object"==typeof f&&n.call(f,"__await")?e.resolve(f.__await).then((function(t){r("next",t,i,c)}),(function(t){r("throw",t,i,c)})):e.resolve(f).then((function(t){l.value=t,i(l)}),(function(t){return r("throw",t,i,c)}))}c(u.arg)}var o;this._invoke=function(t,n){function a(){return new e((function(e,o){r(t,n,e,o)}))}return o=o?o.then(a,a):a()}}function j(t,r){var n=t.iterator[r.method];if(n===e){if(r.delegate=null,"throw"===r.method){if(t.iterator.return&&(r.method="return",r.arg=e,j(t,r),"throw"===r.method))return v;r.method="throw",r.arg=new TypeError("The iterator does not provide a 'throw' method")}return v}var o=s(n,t.iterator,r.arg);if("throw"===o.type)return r.method="throw",r.arg=o.arg,r.delegate=null,v;var a=o.arg;return a?a.done?(r[t.resultName]=a.value,r.next=t.nextLoc,"return"!==r.method&&(r.method="next",r.arg=e),r.delegate=null,v):a:(r.method="throw",r.arg=new TypeError("iterator result is not an object"),r.delegate=null,v)}function S(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function k(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function O(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(S,this),this.reset(!0)}function A(t){if(t){var r=t[a];if(r)return r.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var o=-1,i=function r(){for(;++o<t.length;)if(n.call(t,o))return r.value=t[o],r.done=!1,r;return r.value=e,r.done=!0,r};return i.next=i}}return{next:P}}function P(){return{value:e,done:!0}}return m.prototype=_.constructor=g,g.constructor=m,m.displayName=u(g,c,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===m||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,g):(t.__proto__=g,u(t,c,"GeneratorFunction")),t.prototype=Object.create(_),t},t.awrap=function(t){return{__await:t}},L(E.prototype),E.prototype[i]=function(){return this},t.AsyncIterator=E,t.async=function(e,r,n,o,a){void 0===a&&(a=Promise);var i=new E(l(e,r,n,o),a);return t.isGeneratorFunction(r)?i:i.next().then((function(t){return t.done?t.value:i.next()}))},L(_),u(_,c,"Generator"),_[a]=function(){return this},_.toString=function(){return"[object Generator]"},t.keys=function(t){var e=[];for(var r in t)e.push(r);return e.reverse(),function r(){for(;e.length;){var n=e.pop();if(n in t)return r.value=n,r.done=!1,r}return r.done=!0,r}},t.values=A,O.prototype={constructor:O,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=e,this.done=!1,this.delegate=null,this.method="next",this.arg=e,this.tryEntries.forEach(k),!t)for(var r in this)"t"===r.charAt(0)&&n.call(this,r)&&!isNaN(+r.slice(1))&&(this[r]=e)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var r=this;function o(n,o){return c.type="throw",c.arg=t,r.next=n,o&&(r.method="next",r.arg=e),!!o}for(var a=this.tryEntries.length-1;a>=0;--a){var i=this.tryEntries[a],c=i.completion;if("root"===i.tryLoc)return o("end");if(i.tryLoc<=this.prev){var u=n.call(i,"catchLoc"),l=n.call(i,"finallyLoc");if(u&&l){if(this.prev<i.catchLoc)return o(i.catchLoc,!0);if(this.prev<i.finallyLoc)return o(i.finallyLoc)}else if(u){if(this.prev<i.catchLoc)return o(i.catchLoc,!0)}else{if(!l)throw new Error("try statement without catch or finally");if(this.prev<i.finallyLoc)return o(i.finallyLoc)}}}},abrupt:function(t,e){for(var r=this.tryEntries.length-1;r>=0;--r){var o=this.tryEntries[r];if(o.tryLoc<=this.prev&&n.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var a=o;break}}a&&("break"===t||"continue"===t)&&a.tryLoc<=e&&e<=a.finallyLoc&&(a=null);var i=a?a.completion:{};return i.type=t,i.arg=e,a?(this.method="next",this.next=a.finallyLoc,v):this.complete(i)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),v},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),k(r),v}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var o=n.arg;k(r)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,r,n){return this.delegate={iterator:A(t),resultName:r,nextLoc:n},"next"===this.method&&(this.arg=e),v}},t}(t.exports);try{regeneratorRuntime=e}catch(t){Function("r","regeneratorRuntime = r")(e)}}},e={};function r(n){if(e[n])return e[n].exports;var o=e[n]={exports:{}};return t[n](o,o.exports,r),o.exports}r.m=t,r.x=t=>{},r.n=t=>{var e=t&&t.__esModule?()=>t.default:()=>t;return r.d(e,{a:e}),e},r.d=(t,e)=>{for(var n in e)r.o(e,n)&&!r.o(t,n)&&Object.defineProperty(t,n,{enumerable:!0,get:e[n]})},r.o=(t,e)=>Object.prototype.hasOwnProperty.call(t,e),(()=>{var t={953:0},e=[[732],[267]],n=t=>{},o=(o,a)=>{for(var i,c,[u,l,s,f]=a,p=0,h=[];p<u.length;p++)c=u[p],r.o(t,c)&&t[c]&&h.push(t[c][0]),t[c]=0;for(i in l)r.o(l,i)&&(r.m[i]=l[i]);for(s&&s(r),o&&o(a);h.length;)h.shift()();return f&&e.push.apply(e,f),n()},a=self.webpackChunkcboxol_site_template_picker=self.webpackChunkcboxol_site_template_picker||[];function i(){for(var n,o=0;o<e.length;o++){for(var a=e[o],i=!0,c=1;c<a.length;c++){var u=a[c];0!==t[u]&&(i=!1)}i&&(e.splice(o--,1),n=r(r.s=a[0]))}return 0===e.length&&(r.x(),r.x=t=>{}),n}a.forEach(o.bind(null,0)),a.push=o.bind(null,a.push.bind(a));var c=r.x;r.x=()=>(r.x=c||(t=>{}),(n=i)())})();r.x()})();