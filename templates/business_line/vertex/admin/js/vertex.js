var VERTEX, VG, va = {fn:{}};
(function(){/*!
 * Knockout JavaScript library v3.2.0
 * (c) Steven Sanderson - http://knockoutjs.com/
 * License: MIT (http://www.opensource.org/licenses/mit-license.php)
 */

(function() {(function(p){var s=this||(0,eval)("this"),v=s.document,L=s.navigator,w=s.jQuery,D=s.JSON;(function(p){"function"===typeof require&&"object"===typeof exports&&"object"===typeof module?p(module.exports||exports,require):"function"===typeof define&&define.amd?define(["exports","require"],p):p(va.ko={})})(function(M,N){function H(a,d){return null===a||typeof a in R?a===d:!1}function S(a,d){var c;return function(){c||(c=setTimeout(function(){c=p;a()},d))}}function T(a,d){var c;return function(){clearTimeout(c);
c=setTimeout(a,d)}}function I(b,d,c,e){a.d[b]={init:function(b,h,k,f,m){var l,q;a.s(function(){var f=a.a.c(h()),k=!c!==!f,z=!q;if(z||d||k!==l)z&&a.Y.la()&&(q=a.a.ia(a.f.childNodes(b),!0)),k?(z||a.f.T(b,a.a.ia(q)),a.Ca(e?e(m,f):m,b)):a.f.ja(b),l=k},null,{o:b});return{controlsDescendantBindings:!0}}};a.h.ha[b]=!1;a.f.Q[b]=!0}var a="undefined"!==typeof M?M:{};a.b=function(b,d){for(var c=b.split("."),e=a,g=0;g<c.length-1;g++)e=e[c[g]];e[c[c.length-1]]=d};a.A=function(a,d,c){a[d]=c};a.version="3.2.0";
a.b("version",a.version);a.a=function(){function b(a,b){for(var c in a)a.hasOwnProperty(c)&&b(c,a[c])}function d(a,b){if(b)for(var c in b)b.hasOwnProperty(c)&&(a[c]=b[c]);return a}function c(a,b){a.__proto__=b;return a}var e={__proto__:[]}instanceof Array,g={},h={};g[L&&/Firefox\/2/i.test(L.userAgent)?"KeyboardEvent":"UIEvents"]=["keyup","keydown","keypress"];g.MouseEvents="click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave".split(" ");b(g,function(a,b){if(b.length)for(var c=
0,d=b.length;c<d;c++)h[b[c]]=a});var k={propertychange:!0},f=v&&function(){for(var a=3,b=v.createElement("div"),c=b.getElementsByTagName("i");b.innerHTML="\x3c!--[if gt IE "+ ++a+"]><i></i><![endif]--\x3e",c[0];);return 4<a?a:p}();return{vb:["authenticity_token",/^__RequestVerificationToken(_.*)?$/],u:function(a,b){for(var c=0,d=a.length;c<d;c++)b(a[c],c)},m:function(a,b){if("function"==typeof Array.prototype.indexOf)return Array.prototype.indexOf.call(a,b);for(var c=0,d=a.length;c<d;c++)if(a[c]===
b)return c;return-1},qb:function(a,b,c){for(var d=0,f=a.length;d<f;d++)if(b.call(c,a[d],d))return a[d];return null},ua:function(m,b){var c=a.a.m(m,b);0<c?m.splice(c,1):0===c&&m.shift()},rb:function(m){m=m||[];for(var b=[],c=0,d=m.length;c<d;c++)0>a.a.m(b,m[c])&&b.push(m[c]);return b},Da:function(a,b){a=a||[];for(var c=[],d=0,f=a.length;d<f;d++)c.push(b(a[d],d));return c},ta:function(a,b){a=a||[];for(var c=[],d=0,f=a.length;d<f;d++)b(a[d],d)&&c.push(a[d]);return c},ga:function(a,b){if(b instanceof
Array)a.push.apply(a,b);else for(var c=0,d=b.length;c<d;c++)a.push(b[c]);return a},ea:function(b,c,d){var f=a.a.m(a.a.Xa(b),c);0>f?d&&b.push(c):d||b.splice(f,1)},xa:e,extend:d,za:c,Aa:e?c:d,G:b,na:function(a,b){if(!a)return a;var c={},d;for(d in a)a.hasOwnProperty(d)&&(c[d]=b(a[d],d,a));return c},Ka:function(b){for(;b.firstChild;)a.removeNode(b.firstChild)},oc:function(b){b=a.a.S(b);for(var c=v.createElement("div"),d=0,f=b.length;d<f;d++)c.appendChild(a.R(b[d]));return c},ia:function(b,c){for(var d=
0,f=b.length,e=[];d<f;d++){var k=b[d].cloneNode(!0);e.push(c?a.R(k):k)}return e},T:function(b,c){a.a.Ka(b);if(c)for(var d=0,f=c.length;d<f;d++)b.appendChild(c[d])},Lb:function(b,c){var d=b.nodeType?[b]:b;if(0<d.length){for(var f=d[0],e=f.parentNode,k=0,g=c.length;k<g;k++)e.insertBefore(c[k],f);k=0;for(g=d.length;k<g;k++)a.removeNode(d[k])}},ka:function(a,b){if(a.length){for(b=8===b.nodeType&&b.parentNode||b;a.length&&a[0].parentNode!==b;)a.shift();if(1<a.length){var c=a[0],d=a[a.length-1];for(a.length=
0;c!==d;)if(a.push(c),c=c.nextSibling,!c)return;a.push(d)}}return a},Nb:function(a,b){7>f?a.setAttribute("selected",b):a.selected=b},cb:function(a){return null===a||a===p?"":a.trim?a.trim():a.toString().replace(/^[\s\xa0]+|[\s\xa0]+$/g,"")},vc:function(a,b){a=a||"";return b.length>a.length?!1:a.substring(0,b.length)===b},cc:function(a,b){if(a===b)return!0;if(11===a.nodeType)return!1;if(b.contains)return b.contains(3===a.nodeType?a.parentNode:a);if(b.compareDocumentPosition)return 16==(b.compareDocumentPosition(a)&
16);for(;a&&a!=b;)a=a.parentNode;return!!a},Ja:function(b){return a.a.cc(b,b.ownerDocument.documentElement)},ob:function(b){return!!a.a.qb(b,a.a.Ja)},t:function(a){return a&&a.tagName&&a.tagName.toLowerCase()},n:function(b,c,d){var e=f&&k[c];if(!e&&w)w(b).bind(c,d);else if(e||"function"!=typeof b.addEventListener)if("undefined"!=typeof b.attachEvent){var g=function(a){d.call(b,a)},h="on"+c;b.attachEvent(h,g);a.a.w.da(b,function(){b.detachEvent(h,g)})}else throw Error("Browser doesn't support addEventListener or attachEvent");
else b.addEventListener(c,d,!1)},oa:function(b,c){if(!b||!b.nodeType)throw Error("element must be a DOM node when calling triggerEvent");var d;"input"===a.a.t(b)&&b.type&&"click"==c.toLowerCase()?(d=b.type,d="checkbox"==d||"radio"==d):d=!1;if(w&&!d)w(b).trigger(c);else if("function"==typeof v.createEvent)if("function"==typeof b.dispatchEvent)d=v.createEvent(h[c]||"HTMLEvents"),d.initEvent(c,!0,!0,s,0,0,0,0,0,!1,!1,!1,!1,0,b),b.dispatchEvent(d);else throw Error("The supplied element doesn't support dispatchEvent");
else if(d&&b.click)b.click();else if("undefined"!=typeof b.fireEvent)b.fireEvent("on"+c);else throw Error("Browser doesn't support triggering events");},c:function(b){return a.C(b)?b():b},Xa:function(b){return a.C(b)?b.v():b},Ba:function(b,c,d){if(c){var f=/\S+/g,e=b.className.match(f)||[];a.a.u(c.match(f),function(b){a.a.ea(e,b,d)});b.className=e.join(" ")}},bb:function(b,c){var d=a.a.c(c);if(null===d||d===p)d="";var f=a.f.firstChild(b);!f||3!=f.nodeType||a.f.nextSibling(f)?a.f.T(b,[b.ownerDocument.createTextNode(d)]):
f.data=d;a.a.fc(b)},Mb:function(a,b){a.name=b;if(7>=f)try{a.mergeAttributes(v.createElement("<input name='"+a.name+"'/>"),!1)}catch(c){}},fc:function(a){9<=f&&(a=1==a.nodeType?a:a.parentNode,a.style&&(a.style.zoom=a.style.zoom))},dc:function(a){if(f){var b=a.style.width;a.style.width=0;a.style.width=b}},sc:function(b,c){b=a.a.c(b);c=a.a.c(c);for(var d=[],f=b;f<=c;f++)d.push(f);return d},S:function(a){for(var b=[],c=0,d=a.length;c<d;c++)b.push(a[c]);return b},yc:6===f,zc:7===f,L:f,xb:function(b,c){for(var d=
a.a.S(b.getElementsByTagName("input")).concat(a.a.S(b.getElementsByTagName("textarea"))),f="string"==typeof c?function(a){return a.name===c}:function(a){return c.test(a.name)},e=[],k=d.length-1;0<=k;k--)f(d[k])&&e.push(d[k]);return e},pc:function(b){return"string"==typeof b&&(b=a.a.cb(b))?D&&D.parse?D.parse(b):(new Function("return "+b))():null},eb:function(b,c,d){if(!D||!D.stringify)throw Error("Cannot find JSON.stringify(). Some browsers (e.g., IE < 8) don't support it natively, but you can overcome this by adding a script reference to json2.js, downloadable from http://www.json.org/json2.js");
return D.stringify(a.a.c(b),c,d)},qc:function(c,d,f){f=f||{};var e=f.params||{},k=f.includeFields||this.vb,g=c;if("object"==typeof c&&"form"===a.a.t(c))for(var g=c.action,h=k.length-1;0<=h;h--)for(var r=a.a.xb(c,k[h]),E=r.length-1;0<=E;E--)e[r[E].name]=r[E].value;d=a.a.c(d);var y=v.createElement("form");y.style.display="none";y.action=g;y.method="post";for(var p in d)c=v.createElement("input"),c.type="hidden",c.name=p,c.value=a.a.eb(a.a.c(d[p])),y.appendChild(c);b(e,function(a,b){var c=v.createElement("input");
c.type="hidden";c.name=a;c.value=b;y.appendChild(c)});v.body.appendChild(y);f.submitter?f.submitter(y):y.submit();setTimeout(function(){y.parentNode.removeChild(y)},0)}}}();a.b("utils",a.a);a.b("utils.arrayForEach",a.a.u);a.b("utils.arrayFirst",a.a.qb);a.b("utils.arrayFilter",a.a.ta);a.b("utils.arrayGetDistinctValues",a.a.rb);a.b("utils.arrayIndexOf",a.a.m);a.b("utils.arrayMap",a.a.Da);a.b("utils.arrayPushAll",a.a.ga);a.b("utils.arrayRemoveItem",a.a.ua);a.b("utils.extend",a.a.extend);a.b("utils.fieldsIncludedWithJsonPost",
a.a.vb);a.b("utils.getFormFields",a.a.xb);a.b("utils.peekObservable",a.a.Xa);a.b("utils.postJson",a.a.qc);a.b("utils.parseJson",a.a.pc);a.b("utils.registerEventHandler",a.a.n);a.b("utils.stringifyJson",a.a.eb);a.b("utils.range",a.a.sc);a.b("utils.toggleDomNodeCssClass",a.a.Ba);a.b("utils.triggerEvent",a.a.oa);a.b("utils.unwrapObservable",a.a.c);a.b("utils.objectForEach",a.a.G);a.b("utils.addOrRemoveItem",a.a.ea);a.b("unwrap",a.a.c);Function.prototype.bind||(Function.prototype.bind=function(a){var d=
this,c=Array.prototype.slice.call(arguments);a=c.shift();return function(){return d.apply(a,c.concat(Array.prototype.slice.call(arguments)))}});a.a.e=new function(){function a(b,h){var k=b[c];if(!k||"null"===k||!e[k]){if(!h)return p;k=b[c]="ko"+d++;e[k]={}}return e[k]}var d=0,c="__ko__"+(new Date).getTime(),e={};return{get:function(c,d){var e=a(c,!1);return e===p?p:e[d]},set:function(c,d,e){if(e!==p||a(c,!1)!==p)a(c,!0)[d]=e},clear:function(a){var b=a[c];return b?(delete e[b],a[c]=null,!0):!1},F:function(){return d++ +
c}}};a.b("utils.domData",a.a.e);a.b("utils.domData.clear",a.a.e.clear);a.a.w=new function(){function b(b,d){var f=a.a.e.get(b,c);f===p&&d&&(f=[],a.a.e.set(b,c,f));return f}function d(c){var e=b(c,!1);if(e)for(var e=e.slice(0),f=0;f<e.length;f++)e[f](c);a.a.e.clear(c);a.a.w.cleanExternalData(c);if(g[c.nodeType])for(e=c.firstChild;c=e;)e=c.nextSibling,8===c.nodeType&&d(c)}var c=a.a.e.F(),e={1:!0,8:!0,9:!0},g={1:!0,9:!0};return{da:function(a,c){if("function"!=typeof c)throw Error("Callback must be a function");
b(a,!0).push(c)},Kb:function(d,e){var f=b(d,!1);f&&(a.a.ua(f,e),0==f.length&&a.a.e.set(d,c,p))},R:function(b){if(e[b.nodeType]&&(d(b),g[b.nodeType])){var c=[];a.a.ga(c,b.getElementsByTagName("*"));for(var f=0,m=c.length;f<m;f++)d(c[f])}return b},removeNode:function(b){a.R(b);b.parentNode&&b.parentNode.removeChild(b)},cleanExternalData:function(a){w&&"function"==typeof w.cleanData&&w.cleanData([a])}}};a.R=a.a.w.R;a.removeNode=a.a.w.removeNode;a.b("cleanNode",a.R);a.b("removeNode",a.removeNode);a.b("utils.domNodeDisposal",
a.a.w);a.b("utils.domNodeDisposal.addDisposeCallback",a.a.w.da);a.b("utils.domNodeDisposal.removeDisposeCallback",a.a.w.Kb);(function(){a.a.ba=function(b){var d;if(w)if(w.parseHTML)d=w.parseHTML(b)||[];else{if((d=w.clean([b]))&&d[0]){for(b=d[0];b.parentNode&&11!==b.parentNode.nodeType;)b=b.parentNode;b.parentNode&&b.parentNode.removeChild(b)}}else{var c=a.a.cb(b).toLowerCase();d=v.createElement("div");c=c.match(/^<(thead|tbody|tfoot)/)&&[1,"<table>","</table>"]||!c.indexOf("<tr")&&[2,"<table><tbody>",
"</tbody></table>"]||(!c.indexOf("<td")||!c.indexOf("<th"))&&[3,"<table><tbody><tr>","</tr></tbody></table>"]||[0,"",""];b="ignored<div>"+c[1]+b+c[2]+"</div>";for("function"==typeof s.innerShiv?d.appendChild(s.innerShiv(b)):d.innerHTML=b;c[0]--;)d=d.lastChild;d=a.a.S(d.lastChild.childNodes)}return d};a.a.$a=function(b,d){a.a.Ka(b);d=a.a.c(d);if(null!==d&&d!==p)if("string"!=typeof d&&(d=d.toString()),w)w(b).html(d);else for(var c=a.a.ba(d),e=0;e<c.length;e++)b.appendChild(c[e])}})();a.b("utils.parseHtmlFragment",
a.a.ba);a.b("utils.setHtml",a.a.$a);a.D=function(){function b(c,d){if(c)if(8==c.nodeType){var g=a.D.Gb(c.nodeValue);null!=g&&d.push({bc:c,mc:g})}else if(1==c.nodeType)for(var g=0,h=c.childNodes,k=h.length;g<k;g++)b(h[g],d)}var d={};return{Ua:function(a){if("function"!=typeof a)throw Error("You can only pass a function to ko.memoization.memoize()");var b=(4294967296*(1+Math.random())|0).toString(16).substring(1)+(4294967296*(1+Math.random())|0).toString(16).substring(1);d[b]=a;return"\x3c!--[ko_memo:"+
b+"]--\x3e"},Rb:function(a,b){var g=d[a];if(g===p)throw Error("Couldn't find any memo with ID "+a+". Perhaps it's already been unmemoized.");try{return g.apply(null,b||[]),!0}finally{delete d[a]}},Sb:function(c,d){var g=[];b(c,g);for(var h=0,k=g.length;h<k;h++){var f=g[h].bc,m=[f];d&&a.a.ga(m,d);a.D.Rb(g[h].mc,m);f.nodeValue="";f.parentNode&&f.parentNode.removeChild(f)}},Gb:function(a){return(a=a.match(/^\[ko_memo\:(.*?)\]$/))?a[1]:null}}}();a.b("memoization",a.D);a.b("memoization.memoize",a.D.Ua);
a.b("memoization.unmemoize",a.D.Rb);a.b("memoization.parseMemoText",a.D.Gb);a.b("memoization.unmemoizeDomNodeAndDescendants",a.D.Sb);a.La={throttle:function(b,d){b.throttleEvaluation=d;var c=null;return a.j({read:b,write:function(a){clearTimeout(c);c=setTimeout(function(){b(a)},d)}})},rateLimit:function(a,d){var c,e,g;"number"==typeof d?c=d:(c=d.timeout,e=d.method);g="notifyWhenChangesStop"==e?T:S;a.Ta(function(a){return g(a,c)})},notify:function(a,d){a.equalityComparer="always"==d?null:H}};var R=
{undefined:1,"boolean":1,number:1,string:1};a.b("extenders",a.La);a.Pb=function(b,d,c){this.target=b;this.wa=d;this.ac=c;this.Cb=!1;a.A(this,"dispose",this.K)};a.Pb.prototype.K=function(){this.Cb=!0;this.ac()};a.P=function(){a.a.Aa(this,a.P.fn);this.M={}};var G="change",A={U:function(b,d,c){var e=this;c=c||G;var g=new a.Pb(e,d?b.bind(d):b,function(){a.a.ua(e.M[c],g);e.nb&&e.nb()});e.va&&e.va(c);e.M[c]||(e.M[c]=[]);e.M[c].push(g);return g},notifySubscribers:function(b,d){d=d||G;if(this.Ab(d))try{a.k.Ea();
for(var c=this.M[d].slice(0),e=0,g;g=c[e];++e)g.Cb||g.wa(b)}finally{a.k.end()}},Ta:function(b){var d=this,c=a.C(d),e,g,h;d.qa||(d.qa=d.notifySubscribers,d.notifySubscribers=function(a,b){b&&b!==G?"beforeChange"===b?d.kb(a):d.qa(a,b):d.lb(a)});var k=b(function(){c&&h===d&&(h=d());e=!1;d.Pa(g,h)&&d.qa(g=h)});d.lb=function(a){e=!0;h=a;k()};d.kb=function(a){e||(g=a,d.qa(a,"beforeChange"))}},Ab:function(a){return this.M[a]&&this.M[a].length},yb:function(){var b=0;a.a.G(this.M,function(a,c){b+=c.length});
return b},Pa:function(a,d){return!this.equalityComparer||!this.equalityComparer(a,d)},extend:function(b){var d=this;b&&a.a.G(b,function(b,e){var g=a.La[b];"function"==typeof g&&(d=g(d,e)||d)});return d}};a.A(A,"subscribe",A.U);a.A(A,"extend",A.extend);a.A(A,"getSubscriptionsCount",A.yb);a.a.xa&&a.a.za(A,Function.prototype);a.P.fn=A;a.Db=function(a){return null!=a&&"function"==typeof a.U&&"function"==typeof a.notifySubscribers};a.b("subscribable",a.P);a.b("isSubscribable",a.Db);a.Y=a.k=function(){function b(a){c.push(e);
e=a}function d(){e=c.pop()}var c=[],e,g=0;return{Ea:b,end:d,Jb:function(b){if(e){if(!a.Db(b))throw Error("Only subscribable things can act as dependencies");e.wa(b,b.Vb||(b.Vb=++g))}},B:function(a,c,f){try{return b(),a.apply(c,f||[])}finally{d()}},la:function(){if(e)return e.s.la()},ma:function(){if(e)return e.ma}}}();a.b("computedContext",a.Y);a.b("computedContext.getDependenciesCount",a.Y.la);a.b("computedContext.isInitial",a.Y.ma);a.b("computedContext.isSleeping",a.Y.Ac);a.p=function(b){function d(){if(0<
arguments.length)return d.Pa(c,arguments[0])&&(d.X(),c=arguments[0],d.W()),this;a.k.Jb(d);return c}var c=b;a.P.call(d);a.a.Aa(d,a.p.fn);d.v=function(){return c};d.W=function(){d.notifySubscribers(c)};d.X=function(){d.notifySubscribers(c,"beforeChange")};a.A(d,"peek",d.v);a.A(d,"valueHasMutated",d.W);a.A(d,"valueWillMutate",d.X);return d};a.p.fn={equalityComparer:H};var F=a.p.rc="__ko_proto__";a.p.fn[F]=a.p;a.a.xa&&a.a.za(a.p.fn,a.P.fn);a.Ma=function(b,d){return null===b||b===p||b[F]===p?!1:b[F]===
d?!0:a.Ma(b[F],d)};a.C=function(b){return a.Ma(b,a.p)};a.Ra=function(b){return"function"==typeof b&&b[F]===a.p||"function"==typeof b&&b[F]===a.j&&b.hc?!0:!1};a.b("observable",a.p);a.b("isObservable",a.C);a.b("isWriteableObservable",a.Ra);a.b("isWritableObservable",a.Ra);a.aa=function(b){b=b||[];if("object"!=typeof b||!("length"in b))throw Error("The argument passed when initializing an observable array must be an array, or null, or undefined.");b=a.p(b);a.a.Aa(b,a.aa.fn);return b.extend({trackArrayChanges:!0})};
a.aa.fn={remove:function(b){for(var d=this.v(),c=[],e="function"!=typeof b||a.C(b)?function(a){return a===b}:b,g=0;g<d.length;g++){var h=d[g];e(h)&&(0===c.length&&this.X(),c.push(h),d.splice(g,1),g--)}c.length&&this.W();return c},removeAll:function(b){if(b===p){var d=this.v(),c=d.slice(0);this.X();d.splice(0,d.length);this.W();return c}return b?this.remove(function(c){return 0<=a.a.m(b,c)}):[]},destroy:function(b){var d=this.v(),c="function"!=typeof b||a.C(b)?function(a){return a===b}:b;this.X();
for(var e=d.length-1;0<=e;e--)c(d[e])&&(d[e]._destroy=!0);this.W()},destroyAll:function(b){return b===p?this.destroy(function(){return!0}):b?this.destroy(function(d){return 0<=a.a.m(b,d)}):[]},indexOf:function(b){var d=this();return a.a.m(d,b)},replace:function(a,d){var c=this.indexOf(a);0<=c&&(this.X(),this.v()[c]=d,this.W())}};a.a.u("pop push reverse shift sort splice unshift".split(" "),function(b){a.aa.fn[b]=function(){var a=this.v();this.X();this.sb(a,b,arguments);a=a[b].apply(a,arguments);this.W();
return a}});a.a.u(["slice"],function(b){a.aa.fn[b]=function(){var a=this();return a[b].apply(a,arguments)}});a.a.xa&&a.a.za(a.aa.fn,a.p.fn);a.b("observableArray",a.aa);var J="arrayChange";a.La.trackArrayChanges=function(b){function d(){if(!c){c=!0;var d=b.notifySubscribers;b.notifySubscribers=function(a,b){b&&b!==G||++g;return d.apply(this,arguments)};var f=[].concat(b.v()||[]);e=null;b.U(function(c){c=[].concat(c||[]);if(b.Ab(J)){var d;if(!e||1<g)e=a.a.Fa(f,c,{sparse:!0});d=e;d.length&&b.notifySubscribers(d,
J)}f=c;e=null;g=0})}}if(!b.sb){var c=!1,e=null,g=0,h=b.U;b.U=b.subscribe=function(a,b,c){c===J&&d();return h.apply(this,arguments)};b.sb=function(b,d,m){function l(a,b,c){return q[q.length]={status:a,value:b,index:c}}if(c&&!g){var q=[],h=b.length,t=m.length,z=0;switch(d){case "push":z=h;case "unshift":for(d=0;d<t;d++)l("added",m[d],z+d);break;case "pop":z=h-1;case "shift":h&&l("deleted",b[z],z);break;case "splice":d=Math.min(Math.max(0,0>m[0]?h+m[0]:m[0]),h);for(var h=1===t?h:Math.min(d+(m[1]||0),
h),t=d+t-2,z=Math.max(h,t),u=[],r=[],E=2;d<z;++d,++E)d<h&&r.push(l("deleted",b[d],d)),d<t&&u.push(l("added",m[E],d));a.a.wb(r,u);break;default:return}e=q}}}};a.s=a.j=function(b,d,c){function e(){a.a.G(v,function(a,b){b.K()});v={}}function g(){e();C=0;u=!0;n=!1}function h(){var a=f.throttleEvaluation;a&&0<=a?(clearTimeout(P),P=setTimeout(k,a)):f.ib?f.ib():k()}function k(b){if(t){if(E)throw Error("A 'pure' computed must not be called recursively");}else if(!u){if(w&&w()){if(!z){s();return}}else z=!1;
t=!0;if(y)try{var c={};a.k.Ea({wa:function(a,b){c[b]||(c[b]=1,++C)},s:f,ma:p});C=0;q=r.call(d)}finally{a.k.end(),t=!1}else try{var e=v,m=C;a.k.Ea({wa:function(a,b){u||(m&&e[b]?(v[b]=e[b],++C,delete e[b],--m):v[b]||(v[b]=a.U(h),++C))},s:f,ma:E?p:!C});v={};C=0;try{var l=d?r.call(d):r()}finally{a.k.end(),m&&a.a.G(e,function(a,b){b.K()}),n=!1}f.Pa(q,l)&&(f.notifySubscribers(q,"beforeChange"),q=l,!0!==b&&f.notifySubscribers(q))}finally{t=!1}C||s()}}function f(){if(0<arguments.length){if("function"===typeof O)O.apply(d,
arguments);else throw Error("Cannot write a value to a ko.computed unless you specify a 'write' option. If you wish to read the current value, don't pass any parameters.");return this}a.k.Jb(f);n&&k(!0);return q}function m(){n&&!C&&k(!0);return q}function l(){return n||0<C}var q,n=!0,t=!1,z=!1,u=!1,r=b,E=!1,y=!1;r&&"object"==typeof r?(c=r,r=c.read):(c=c||{},r||(r=c.read));if("function"!=typeof r)throw Error("Pass a function that returns the value of the ko.computed");var O=c.write,x=c.disposeWhenNodeIsRemoved||
c.o||null,B=c.disposeWhen||c.Ia,w=B,s=g,v={},C=0,P=null;d||(d=c.owner);a.P.call(f);a.a.Aa(f,a.j.fn);f.v=m;f.la=function(){return C};f.hc="function"===typeof c.write;f.K=function(){s()};f.Z=l;var A=f.Ta;f.Ta=function(a){A.call(f,a);f.ib=function(){f.kb(q);n=!0;f.lb(f)}};c.pure?(y=E=!0,f.va=function(){y&&(y=!1,k(!0))},f.nb=function(){f.yb()||(e(),y=n=!0)}):c.deferEvaluation&&(f.va=function(){m();delete f.va});a.A(f,"peek",f.v);a.A(f,"dispose",f.K);a.A(f,"isActive",f.Z);a.A(f,"getDependenciesCount",
f.la);x&&(z=!0,x.nodeType&&(w=function(){return!a.a.Ja(x)||B&&B()}));y||c.deferEvaluation||k();x&&l()&&x.nodeType&&(s=function(){a.a.w.Kb(x,s);g()},a.a.w.da(x,s));return f};a.jc=function(b){return a.Ma(b,a.j)};A=a.p.rc;a.j[A]=a.p;a.j.fn={equalityComparer:H};a.j.fn[A]=a.j;a.a.xa&&a.a.za(a.j.fn,a.P.fn);a.b("dependentObservable",a.j);a.b("computed",a.j);a.b("isComputed",a.jc);a.Ib=function(b,d){if("function"===typeof b)return a.s(b,d,{pure:!0});b=a.a.extend({},b);b.pure=!0;return a.s(b,d)};a.b("pureComputed",
a.Ib);(function(){function b(a,g,h){h=h||new c;a=g(a);if("object"!=typeof a||null===a||a===p||a instanceof Date||a instanceof String||a instanceof Number||a instanceof Boolean)return a;var k=a instanceof Array?[]:{};h.save(a,k);d(a,function(c){var d=g(a[c]);switch(typeof d){case "boolean":case "number":case "string":case "function":k[c]=d;break;case "object":case "undefined":var l=h.get(d);k[c]=l!==p?l:b(d,g,h)}});return k}function d(a,b){if(a instanceof Array){for(var c=0;c<a.length;c++)b(c);"function"==
typeof a.toJSON&&b("toJSON")}else for(c in a)b(c)}function c(){this.keys=[];this.hb=[]}a.Qb=function(c){if(0==arguments.length)throw Error("When calling ko.toJS, pass the object you want to convert.");return b(c,function(b){for(var c=0;a.C(b)&&10>c;c++)b=b();return b})};a.toJSON=function(b,c,d){b=a.Qb(b);return a.a.eb(b,c,d)};c.prototype={save:function(b,c){var d=a.a.m(this.keys,b);0<=d?this.hb[d]=c:(this.keys.push(b),this.hb.push(c))},get:function(b){b=a.a.m(this.keys,b);return 0<=b?this.hb[b]:p}}})();
a.b("toJS",a.Qb);a.b("toJSON",a.toJSON);(function(){a.i={q:function(b){switch(a.a.t(b)){case "option":return!0===b.__ko__hasDomDataOptionValue__?a.a.e.get(b,a.d.options.Va):7>=a.a.L?b.getAttributeNode("value")&&b.getAttributeNode("value").specified?b.value:b.text:b.value;case "select":return 0<=b.selectedIndex?a.i.q(b.options[b.selectedIndex]):p;default:return b.value}},ca:function(b,d,c){switch(a.a.t(b)){case "option":switch(typeof d){case "string":a.a.e.set(b,a.d.options.Va,p);"__ko__hasDomDataOptionValue__"in
b&&delete b.__ko__hasDomDataOptionValue__;b.value=d;break;default:a.a.e.set(b,a.d.options.Va,d),b.__ko__hasDomDataOptionValue__=!0,b.value="number"===typeof d?d:""}break;case "select":if(""===d||null===d)d=p;for(var e=-1,g=0,h=b.options.length,k;g<h;++g)if(k=a.i.q(b.options[g]),k==d||""==k&&d===p){e=g;break}if(c||0<=e||d===p&&1<b.size)b.selectedIndex=e;break;default:if(null===d||d===p)d="";b.value=d}}}})();a.b("selectExtensions",a.i);a.b("selectExtensions.readValue",a.i.q);a.b("selectExtensions.writeValue",
a.i.ca);a.h=function(){function b(b){b=a.a.cb(b);123===b.charCodeAt(0)&&(b=b.slice(1,-1));var c=[],d=b.match(e),k,n,t=0;if(d){d.push(",");for(var z=0,u;u=d[z];++z){var r=u.charCodeAt(0);if(44===r){if(0>=t){k&&c.push(n?{key:k,value:n.join("")}:{unknown:k});k=n=t=0;continue}}else if(58===r){if(!n)continue}else if(47===r&&z&&1<u.length)(r=d[z-1].match(g))&&!h[r[0]]&&(b=b.substr(b.indexOf(u)+1),d=b.match(e),d.push(","),z=-1,u="/");else if(40===r||123===r||91===r)++t;else if(41===r||125===r||93===r)--t;
else if(!k&&!n){k=34===r||39===r?u.slice(1,-1):u;continue}n?n.push(u):n=[u]}}return c}var d=["true","false","null","undefined"],c=/^(?:[$_a-z][$\w]*|(.+)(\.\s*[$_a-z][$\w]*|\[.+\]))$/i,e=RegExp("\"(?:[^\"\\\\]|\\\\.)*\"|'(?:[^'\\\\]|\\\\.)*'|/(?:[^/\\\\]|\\\\.)*/w*|[^\\s:,/][^,\"'{}()/:[\\]]*[^\\s,\"'{}()/:[\\]]|[^\\s]","g"),g=/[\])"'A-Za-z0-9_$]+$/,h={"in":1,"return":1,"typeof":1},k={};return{ha:[],V:k,Wa:b,ya:function(f,m){function e(b,m){var f;if(!z){var u=a.getBindingHandler(b);if(u&&u.preprocess&&
!(m=u.preprocess(m,b,e)))return;if(u=k[b])f=m,0<=a.a.m(d,f)?f=!1:(u=f.match(c),f=null===u?!1:u[1]?"Object("+u[1]+")"+u[2]:f),u=f;u&&h.push("'"+b+"':function(_z){"+f+"=_z}")}t&&(m="function(){return "+m+" }");g.push("'"+b+"':"+m)}m=m||{};var g=[],h=[],t=m.valueAccessors,z=m.bindingParams,u="string"===typeof f?b(f):f;a.a.u(u,function(a){e(a.key||a.unknown,a.value)});h.length&&e("_ko_property_writers","{"+h.join(",")+" }");return g.join(",")},lc:function(a,b){for(var c=0;c<a.length;c++)if(a[c].key==
b)return!0;return!1},pa:function(b,c,d,e,k){if(b&&a.C(b))!a.Ra(b)||k&&b.v()===e||b(e);else if((b=c.get("_ko_property_writers"))&&b[d])b[d](e)}}}();a.b("expressionRewriting",a.h);a.b("expressionRewriting.bindingRewriteValidators",a.h.ha);a.b("expressionRewriting.parseObjectLiteral",a.h.Wa);a.b("expressionRewriting.preProcessBindings",a.h.ya);a.b("expressionRewriting._twoWayBindings",a.h.V);a.b("jsonExpressionRewriting",a.h);a.b("jsonExpressionRewriting.insertPropertyAccessorsIntoJson",a.h.ya);(function(){function b(a){return 8==
a.nodeType&&h.test(g?a.text:a.nodeValue)}function d(a){return 8==a.nodeType&&k.test(g?a.text:a.nodeValue)}function c(a,c){for(var f=a,e=1,k=[];f=f.nextSibling;){if(d(f)&&(e--,0===e))return k;k.push(f);b(f)&&e++}if(!c)throw Error("Cannot find closing comment tag to match: "+a.nodeValue);return null}function e(a,b){var d=c(a,b);return d?0<d.length?d[d.length-1].nextSibling:a.nextSibling:null}var g=v&&"\x3c!--test--\x3e"===v.createComment("test").text,h=g?/^\x3c!--\s*ko(?:\s+([\s\S]+))?\s*--\x3e$/:/^\s*ko(?:\s+([\s\S]+))?\s*$/,
k=g?/^\x3c!--\s*\/ko\s*--\x3e$/:/^\s*\/ko\s*$/,f={ul:!0,ol:!0};a.f={Q:{},childNodes:function(a){return b(a)?c(a):a.childNodes},ja:function(c){if(b(c)){c=a.f.childNodes(c);for(var d=0,f=c.length;d<f;d++)a.removeNode(c[d])}else a.a.Ka(c)},T:function(c,d){if(b(c)){a.f.ja(c);for(var f=c.nextSibling,e=0,k=d.length;e<k;e++)f.parentNode.insertBefore(d[e],f)}else a.a.T(c,d)},Hb:function(a,c){b(a)?a.parentNode.insertBefore(c,a.nextSibling):a.firstChild?a.insertBefore(c,a.firstChild):a.appendChild(c)},Bb:function(c,
d,f){f?b(c)?c.parentNode.insertBefore(d,f.nextSibling):f.nextSibling?c.insertBefore(d,f.nextSibling):c.appendChild(d):a.f.Hb(c,d)},firstChild:function(a){return b(a)?!a.nextSibling||d(a.nextSibling)?null:a.nextSibling:a.firstChild},nextSibling:function(a){b(a)&&(a=e(a));return a.nextSibling&&d(a.nextSibling)?null:a.nextSibling},gc:b,xc:function(a){return(a=(g?a.text:a.nodeValue).match(h))?a[1]:null},Fb:function(c){if(f[a.a.t(c)]){var k=c.firstChild;if(k){do if(1===k.nodeType){var g;g=k.firstChild;
var h=null;if(g){do if(h)h.push(g);else if(b(g)){var t=e(g,!0);t?g=t:h=[g]}else d(g)&&(h=[g]);while(g=g.nextSibling)}if(g=h)for(h=k.nextSibling,t=0;t<g.length;t++)h?c.insertBefore(g[t],h):c.appendChild(g[t])}while(k=k.nextSibling)}}}}})();a.b("virtualElements",a.f);a.b("virtualElements.allowedBindings",a.f.Q);a.b("virtualElements.emptyNode",a.f.ja);a.b("virtualElements.insertAfter",a.f.Bb);a.b("virtualElements.prepend",a.f.Hb);a.b("virtualElements.setDomNodeChildren",a.f.T);(function(){a.J=function(){this.Yb=
{}};a.a.extend(a.J.prototype,{nodeHasBindings:function(b){switch(b.nodeType){case 1:return null!=b.getAttribute("data-bind")||a.g.getComponentNameForNode(b);case 8:return a.f.gc(b);default:return!1}},getBindings:function(b,d){var c=this.getBindingsString(b,d),c=c?this.parseBindingsString(c,d,b):null;return a.g.mb(c,b,d,!1)},getBindingAccessors:function(b,d){var c=this.getBindingsString(b,d),c=c?this.parseBindingsString(c,d,b,{valueAccessors:!0}):null;return a.g.mb(c,b,d,!0)},getBindingsString:function(b){switch(b.nodeType){case 1:return b.getAttribute("data-bind");
case 8:return a.f.xc(b);default:return null}},parseBindingsString:function(b,d,c,e){try{var g=this.Yb,h=b+(e&&e.valueAccessors||""),k;if(!(k=g[h])){var f,m="with($context){with($data||{}){return{"+a.h.ya(b,e)+"}}}";f=new Function("$context","$element",m);k=g[h]=f}return k(d,c)}catch(l){throw l.message="Unable to parse bindings.\nBindings value: "+b+"\nMessage: "+l.message,l;}}});a.J.instance=new a.J})();a.b("bindingProvider",a.J);(function(){function b(a){return function(){return a}}function d(a){return a()}
function c(b){return a.a.na(a.k.B(b),function(a,c){return function(){return b()[c]}})}function e(a,b){return c(this.getBindings.bind(this,a,b))}function g(b,c,d){var f,e=a.f.firstChild(c),k=a.J.instance,g=k.preprocessNode;if(g){for(;f=e;)e=a.f.nextSibling(f),g.call(k,f);e=a.f.firstChild(c)}for(;f=e;)e=a.f.nextSibling(f),h(b,f,d)}function h(b,c,d){var e=!0,k=1===c.nodeType;k&&a.f.Fb(c);if(k&&d||a.J.instance.nodeHasBindings(c))e=f(c,null,b,d).shouldBindDescendants;e&&!l[a.a.t(c)]&&g(b,c,!k)}function k(b){var c=
[],d={},f=[];a.a.G(b,function y(e){if(!d[e]){var k=a.getBindingHandler(e);k&&(k.after&&(f.push(e),a.a.u(k.after,function(c){if(b[c]){if(-1!==a.a.m(f,c))throw Error("Cannot combine the following bindings, because they have a cyclic dependency: "+f.join(", "));y(c)}}),f.length--),c.push({key:e,zb:k}));d[e]=!0}});return c}function f(b,c,f,g){var m=a.a.e.get(b,q);if(!c){if(m)throw Error("You cannot apply bindings multiple times to the same element.");a.a.e.set(b,q,!0)}!m&&g&&a.Ob(b,f);var l;if(c&&"function"!==
typeof c)l=c;else{var h=a.J.instance,n=h.getBindingAccessors||e,s=a.j(function(){(l=c?c(f,b):n.call(h,b,f))&&f.I&&f.I();return l},null,{o:b});l&&s.Z()||(s=null)}var v;if(l){var w=s?function(a){return function(){return d(s()[a])}}:function(a){return l[a]},A=function(){return a.a.na(s?s():l,d)};A.get=function(a){return l[a]&&d(w(a))};A.has=function(a){return a in l};g=k(l);a.a.u(g,function(c){var d=c.zb.init,e=c.zb.update,k=c.key;if(8===b.nodeType&&!a.f.Q[k])throw Error("The binding '"+k+"' cannot be used with virtual elements");
try{"function"==typeof d&&a.k.B(function(){var a=d(b,w(k),A,f.$data,f);if(a&&a.controlsDescendantBindings){if(v!==p)throw Error("Multiple bindings ("+v+" and "+k+") are trying to control descendant bindings of the same element. You cannot use these bindings together on the same element.");v=k}}),"function"==typeof e&&a.j(function(){e(b,w(k),A,f.$data,f)},null,{o:b})}catch(g){throw new Error('Unable to process binding "'+k+": "+l[k]+'"\nMessage: '+g.message)}})}return{shouldBindDescendants:v===p}}
function m(b){return b&&b instanceof a.N?b:new a.N(b)}a.d={};var l={script:!0};a.getBindingHandler=function(b){return a.d[b]};a.N=function(b,c,d,f){var e=this,k="function"==typeof b&&!a.C(b),g,m=a.j(function(){var g=k?b():b,l=a.a.c(g);c?(c.I&&c.I(),a.a.extend(e,c),m&&(e.I=m)):(e.$parents=[],e.$root=l,e.ko=a);e.$rawData=g;e.$data=l;d&&(e[d]=l);f&&f(e,c,l);return e.$data},null,{Ia:function(){return g&&!a.a.ob(g)},o:!0});m.Z()&&(e.I=m,m.equalityComparer=null,g=[],m.Tb=function(b){g.push(b);a.a.w.da(b,
function(b){a.a.ua(g,b);g.length||(m.K(),e.I=m=p)})})};a.N.prototype.createChildContext=function(b,c,d){return new a.N(b,this,c,function(a,b){a.$parentContext=b;a.$parent=b.$data;a.$parents=(b.$parents||[]).slice(0);a.$parents.unshift(a.$parent);d&&d(a)})};a.N.prototype.extend=function(b){return new a.N(this.I||this.$data,this,null,function(c,d){c.$rawData=d.$rawData;a.a.extend(c,"function"==typeof b?b():b)})};var q=a.a.e.F(),n=a.a.e.F();a.Ob=function(b,c){if(2==arguments.length)a.a.e.set(b,n,c),
c.I&&c.I.Tb(b);else return a.a.e.get(b,n)};a.ra=function(b,c,d){1===b.nodeType&&a.f.Fb(b);return f(b,c,m(d),!0)};a.Wb=function(d,f,e){e=m(e);return a.ra(d,"function"===typeof f?c(f.bind(null,e,d)):a.a.na(f,b),e)};a.Ca=function(a,b){1!==b.nodeType&&8!==b.nodeType||g(m(a),b,!0)};a.pb=function(a,b){!w&&s.jQuery&&(w=s.jQuery);if(b&&1!==b.nodeType&&8!==b.nodeType)throw Error("ko.applyBindings: first parameter should be your view model; second parameter should be a DOM node");b=b||s.document.body;h(m(a),
b,!0)};a.Ha=function(b){switch(b.nodeType){case 1:case 8:var c=a.Ob(b);if(c)return c;if(b.parentNode)return a.Ha(b.parentNode)}return p};a.$b=function(b){return(b=a.Ha(b))?b.$data:p};a.b("bindingHandlers",a.d);a.b("applyBindings",a.pb);a.b("applyBindingsToDescendants",a.Ca);a.b("applyBindingAccessorsToNode",a.ra);a.b("applyBindingsToNode",a.Wb);a.b("contextFor",a.Ha);a.b("dataFor",a.$b)})();(function(b){function d(d,f){var e=g.hasOwnProperty(d)?g[d]:b,l;e||(e=g[d]=new a.P,c(d,function(a){h[d]=a;delete g[d];
l?e.notifySubscribers(a):setTimeout(function(){e.notifySubscribers(a)},0)}),l=!0);e.U(f)}function c(a,b){e("getConfig",[a],function(c){c?e("loadComponent",[a,c],function(a){b(a)}):b(null)})}function e(c,d,g,l){l||(l=a.g.loaders.slice(0));var h=l.shift();if(h){var n=h[c];if(n){var t=!1;if(n.apply(h,d.concat(function(a){t?g(null):null!==a?g(a):e(c,d,g,l)}))!==b&&(t=!0,!h.suppressLoaderExceptions))throw Error("Component loaders must supply values by invoking the callback, not by returning values synchronously.");
}else e(c,d,g,l)}else g(null)}var g={},h={};a.g={get:function(a,c){var e=h.hasOwnProperty(a)?h[a]:b;e?setTimeout(function(){c(e)},0):d(a,c)},tb:function(a){delete h[a]},jb:e};a.g.loaders=[];a.b("components",a.g);a.b("components.get",a.g.get);a.b("components.clearCachedDefinition",a.g.tb)})();(function(){function b(b,c,d,e){function k(){0===--u&&e(h)}var h={},u=2,r=d.template;d=d.viewModel;r?g(c,r,function(c){a.g.jb("loadTemplate",[b,c],function(a){h.template=a;k()})}):k();d?g(c,d,function(c){a.g.jb("loadViewModel",
[b,c],function(a){h[f]=a;k()})}):k()}function d(a,b,c){if("function"===typeof b)c(function(a){return new b(a)});else if("function"===typeof b[f])c(b[f]);else if("instance"in b){var e=b.instance;c(function(){return e})}else"viewModel"in b?d(a,b.viewModel,c):a("Unknown viewModel value: "+b)}function c(b){switch(a.a.t(b)){case "script":return a.a.ba(b.text);case "textarea":return a.a.ba(b.value);case "template":if(e(b.content))return a.a.ia(b.content.childNodes)}return a.a.ia(b.childNodes)}function e(a){return s.DocumentFragment?
a instanceof DocumentFragment:a&&11===a.nodeType}function g(a,b,c){"string"===typeof b.require?N||s.require?(N||s.require)([b.require],c):a("Uses require, but no AMD loader is present"):c(b)}function h(a){return function(b){throw Error("Component '"+a+"': "+b);}}var k={};a.g.tc=function(b,c){if(!c)throw Error("Invalid configuration for "+b);if(a.g.Qa(b))throw Error("Component "+b+" is already registered");k[b]=c};a.g.Qa=function(a){return a in k};a.g.wc=function(b){delete k[b];a.g.tb(b)};a.g.ub={getConfig:function(a,
b){b(k.hasOwnProperty(a)?k[a]:null)},loadComponent:function(a,c,d){var e=h(a);g(e,c,function(c){b(a,e,c,d)})},loadTemplate:function(b,d,f){b=h(b);if("string"===typeof d)f(a.a.ba(d));else if(d instanceof Array)f(d);else if(e(d))f(a.a.S(d.childNodes));else if(d.element)if(d=d.element,s.HTMLElement?d instanceof HTMLElement:d&&d.tagName&&1===d.nodeType)f(c(d));else if("string"===typeof d){var k=v.getElementById(d);k?f(c(k)):b("Cannot find element with ID "+d)}else b("Unknown element type: "+d);else b("Unknown template value: "+
d)},loadViewModel:function(a,b,c){d(h(a),b,c)}};var f="createViewModel";a.b("components.register",a.g.tc);a.b("components.isRegistered",a.g.Qa);a.b("components.unregister",a.g.wc);a.b("components.defaultLoader",a.g.ub);a.g.loaders.push(a.g.ub);a.g.Ub=k})();(function(){function b(b,e){var g=b.getAttribute("params");if(g){var g=d.parseBindingsString(g,e,b,{valueAccessors:!0,bindingParams:!0}),g=a.a.na(g,function(d){return a.s(d,null,{o:b})}),h=a.a.na(g,function(d){return d.Z()?a.s(function(){return a.a.c(d())},
null,{o:b}):d.v()});h.hasOwnProperty("$raw")||(h.$raw=g);return h}return{$raw:{}}}a.g.getComponentNameForNode=function(b){b=a.a.t(b);return a.g.Qa(b)&&b};a.g.mb=function(c,d,g,h){if(1===d.nodeType){var k=a.g.getComponentNameForNode(d);if(k){c=c||{};if(c.component)throw Error('Cannot use the "component" binding on a custom element matching a component');var f={name:k,params:b(d,g)};c.component=h?function(){return f}:f}}return c};var d=new a.J;9>a.a.L&&(a.g.register=function(a){return function(b){v.createElement(b);
return a.apply(this,arguments)}}(a.g.register),v.createDocumentFragment=function(b){return function(){var d=b(),g=a.g.Ub,h;for(h in g)g.hasOwnProperty(h)&&d.createElement(h);return d}}(v.createDocumentFragment))})();(function(){var b=0;a.d.component={init:function(d,c,e,g,h){function k(){var a=f&&f.dispose;"function"===typeof a&&a.call(f);m=null}var f,m;a.a.w.da(d,k);a.s(function(){var e=a.a.c(c()),g,n;"string"===typeof e?g=e:(g=a.a.c(e.name),n=a.a.c(e.params));if(!g)throw Error("No component name specified");
var t=m=++b;a.g.get(g,function(b){if(m===t){k();if(!b)throw Error("Unknown component '"+g+"'");var c=b.template;if(!c)throw Error("Component '"+g+"' has no template");c=a.a.ia(c);a.f.T(d,c);var c=n,e=b.createViewModel;b=e?e.call(b,c,{element:d}):c;c=h.createChildContext(b);f=b;a.Ca(c,d)}})},null,{o:d});return{controlsDescendantBindings:!0}}};a.f.Q.component=!0})();var Q={"class":"className","for":"htmlFor"};a.d.attr={update:function(b,d){var c=a.a.c(d())||{};a.a.G(c,function(c,d){d=a.a.c(d);var h=
!1===d||null===d||d===p;h&&b.removeAttribute(c);8>=a.a.L&&c in Q?(c=Q[c],h?b.removeAttribute(c):b[c]=d):h||b.setAttribute(c,d.toString());"name"===c&&a.a.Mb(b,h?"":d.toString())})}};(function(){a.d.checked={after:["value","attr"],init:function(b,d,c){function e(){var e=b.checked,k=q?h():e;if(!a.Y.ma()&&(!f||e)){var g=a.k.B(d);m?l!==k?(e&&(a.a.ea(g,k,!0),a.a.ea(g,l,!1)),l=k):a.a.ea(g,k,e):a.h.pa(g,c,"checked",k,!0)}}function g(){var c=a.a.c(d());b.checked=m?0<=a.a.m(c,h()):k?c:h()===c}var h=a.Ib(function(){return c.has("checkedValue")?
a.a.c(c.get("checkedValue")):c.has("value")?a.a.c(c.get("value")):b.value}),k="checkbox"==b.type,f="radio"==b.type;if(k||f){var m=k&&a.a.c(d())instanceof Array,l=m?h():p,q=f||m;f&&!b.name&&a.d.uniqueName.init(b,function(){return!0});a.s(e,null,{o:b});a.a.n(b,"click",e);a.s(g,null,{o:b})}}};a.h.V.checked=!0;a.d.checkedValue={update:function(b,d){b.value=a.a.c(d())}}})();a.d.css={update:function(b,d){var c=a.a.c(d());"object"==typeof c?a.a.G(c,function(c,d){d=a.a.c(d);a.a.Ba(b,c,d)}):(c=String(c||""),
a.a.Ba(b,b.__ko__cssValue,!1),b.__ko__cssValue=c,a.a.Ba(b,c,!0))}};a.d.enable={update:function(b,d){var c=a.a.c(d());c&&b.disabled?b.removeAttribute("disabled"):c||b.disabled||(b.disabled=!0)}};a.d.disable={update:function(b,d){a.d.enable.update(b,function(){return!a.a.c(d())})}};a.d.event={init:function(b,d,c,e,g){var h=d()||{};a.a.G(h,function(k){"string"==typeof k&&a.a.n(b,k,function(b){var h,l=d()[k];if(l){try{var q=a.a.S(arguments);e=g.$data;q.unshift(e);h=l.apply(e,q)}finally{!0!==h&&(b.preventDefault?
b.preventDefault():b.returnValue=!1)}!1===c.get(k+"Bubble")&&(b.cancelBubble=!0,b.stopPropagation&&b.stopPropagation())}})})}};a.d.foreach={Eb:function(b){return function(){var d=b(),c=a.a.Xa(d);if(!c||"number"==typeof c.length)return{foreach:d,templateEngine:a.O.Oa};a.a.c(d);return{foreach:c.data,as:c.as,includeDestroyed:c.includeDestroyed,afterAdd:c.afterAdd,beforeRemove:c.beforeRemove,afterRender:c.afterRender,beforeMove:c.beforeMove,afterMove:c.afterMove,templateEngine:a.O.Oa}}},init:function(b,
d){return a.d.template.init(b,a.d.foreach.Eb(d))},update:function(b,d,c,e,g){return a.d.template.update(b,a.d.foreach.Eb(d),c,e,g)}};a.h.ha.foreach=!1;a.f.Q.foreach=!0;a.d.hasfocus={init:function(b,d,c){function e(e){b.__ko_hasfocusUpdating=!0;var f=b.ownerDocument;if("activeElement"in f){var g;try{g=f.activeElement}catch(h){g=f.body}e=g===b}f=d();a.h.pa(f,c,"hasfocus",e,!0);b.__ko_hasfocusLastValue=e;b.__ko_hasfocusUpdating=!1}var g=e.bind(null,!0),h=e.bind(null,!1);a.a.n(b,"focus",g);a.a.n(b,"focusin",
g);a.a.n(b,"blur",h);a.a.n(b,"focusout",h)},update:function(b,d){var c=!!a.a.c(d());b.__ko_hasfocusUpdating||b.__ko_hasfocusLastValue===c||(c?b.focus():b.blur(),a.k.B(a.a.oa,null,[b,c?"focusin":"focusout"]))}};a.h.V.hasfocus=!0;a.d.hasFocus=a.d.hasfocus;a.h.V.hasFocus=!0;a.d.html={init:function(){return{controlsDescendantBindings:!0}},update:function(b,d){a.a.$a(b,d())}};I("if");I("ifnot",!1,!0);I("with",!0,!1,function(a,d){return a.createChildContext(d)});var K={};a.d.options={init:function(b){if("select"!==
a.a.t(b))throw Error("options binding applies only to SELECT elements");for(;0<b.length;)b.remove(0);return{controlsDescendantBindings:!0}},update:function(b,d,c){function e(){return a.a.ta(b.options,function(a){return a.selected})}function g(a,b,c){var d=typeof b;return"function"==d?b(a):"string"==d?a[b]:c}function h(c,d){if(q.length){var e=0<=a.a.m(q,a.i.q(d[0]));a.a.Nb(d[0],e);n&&!e&&a.k.B(a.a.oa,null,[b,"change"])}}var k=0!=b.length&&b.multiple?b.scrollTop:null,f=a.a.c(d()),m=c.get("optionsIncludeDestroyed");
d={};var l,q;q=b.multiple?a.a.Da(e(),a.i.q):0<=b.selectedIndex?[a.i.q(b.options[b.selectedIndex])]:[];f&&("undefined"==typeof f.length&&(f=[f]),l=a.a.ta(f,function(b){return m||b===p||null===b||!a.a.c(b._destroy)}),c.has("optionsCaption")&&(f=a.a.c(c.get("optionsCaption")),null!==f&&f!==p&&l.unshift(K)));var n=!1;d.beforeRemove=function(a){b.removeChild(a)};f=h;c.has("optionsAfterRender")&&(f=function(b,d){h(0,d);a.k.B(c.get("optionsAfterRender"),null,[d[0],b!==K?b:p])});a.a.Za(b,l,function(d,e,f){f.length&&
(q=f[0].selected?[a.i.q(f[0])]:[],n=!0);e=b.ownerDocument.createElement("option");d===K?(a.a.bb(e,c.get("optionsCaption")),a.i.ca(e,p)):(f=g(d,c.get("optionsValue"),d),a.i.ca(e,a.a.c(f)),d=g(d,c.get("optionsText"),f),a.a.bb(e,d));return[e]},d,f);a.k.B(function(){c.get("valueAllowUnset")&&c.has("value")?a.i.ca(b,a.a.c(c.get("value")),!0):(b.multiple?q.length&&e().length<q.length:q.length&&0<=b.selectedIndex?a.i.q(b.options[b.selectedIndex])!==q[0]:q.length||0<=b.selectedIndex)&&a.a.oa(b,"change")});
a.a.dc(b);k&&20<Math.abs(k-b.scrollTop)&&(b.scrollTop=k)}};a.d.options.Va=a.a.e.F();a.d.selectedOptions={after:["options","foreach"],init:function(b,d,c){a.a.n(b,"change",function(){var e=d(),g=[];a.a.u(b.getElementsByTagName("option"),function(b){b.selected&&g.push(a.i.q(b))});a.h.pa(e,c,"selectedOptions",g)})},update:function(b,d){if("select"!=a.a.t(b))throw Error("values binding applies only to SELECT elements");var c=a.a.c(d());c&&"number"==typeof c.length&&a.a.u(b.getElementsByTagName("option"),
function(b){var d=0<=a.a.m(c,a.i.q(b));a.a.Nb(b,d)})}};a.h.V.selectedOptions=!0;a.d.style={update:function(b,d){var c=a.a.c(d()||{});a.a.G(c,function(c,d){d=a.a.c(d);if(null===d||d===p||!1===d)d="";b.style[c]=d})}};a.d.submit={init:function(b,d,c,e,g){if("function"!=typeof d())throw Error("The value for a submit binding must be a function");a.a.n(b,"submit",function(a){var c,e=d();try{c=e.call(g.$data,b)}finally{!0!==c&&(a.preventDefault?a.preventDefault():a.returnValue=!1)}})}};a.d.text={init:function(){return{controlsDescendantBindings:!0}},
update:function(b,d){a.a.bb(b,d())}};a.f.Q.text=!0;(function(){if(s&&s.navigator)var b=function(a){if(a)return parseFloat(a[1])},d=s.opera&&s.opera.version&&parseInt(s.opera.version()),c=s.navigator.userAgent,e=b(c.match(/^(?:(?!chrome).)*version\/([^ ]*) safari/i)),g=b(c.match(/Firefox\/([^ ]*)/));if(10>a.a.L)var h=a.a.e.F(),k=a.a.e.F(),f=function(b){var c=this.activeElement;(c=c&&a.a.e.get(c,k))&&c(b)},m=function(b,c){var d=b.ownerDocument;a.a.e.get(d,h)||(a.a.e.set(d,h,!0),a.a.n(d,"selectionchange",
f));a.a.e.set(b,k,c)};a.d.textInput={init:function(b,c,f){function k(c,d){a.a.n(b,c,d)}function h(){var d=a.a.c(c());if(null===d||d===p)d="";v!==p&&d===v?setTimeout(h,4):b.value!==d&&(s=d,b.value=d)}function u(){y||(v=b.value,y=setTimeout(r,4))}function r(){clearTimeout(y);v=y=p;var d=b.value;s!==d&&(s=d,a.h.pa(c(),f,"textInput",d))}var s=b.value,y,v;10>a.a.L?(k("propertychange",function(a){"value"===a.propertyName&&r()}),8==a.a.L&&(k("keyup",r),k("keydown",r)),8<=a.a.L&&(m(b,r),k("dragend",u))):
(k("input",r),5>e&&"textarea"===a.a.t(b)?(k("keydown",u),k("paste",u),k("cut",u)):11>d?k("keydown",u):4>g&&(k("DOMAutoComplete",r),k("dragdrop",r),k("drop",r)));k("change",r);a.s(h,null,{o:b})}};a.h.V.textInput=!0;a.d.textinput={preprocess:function(a,b,c){c("textInput",a)}}})();a.d.uniqueName={init:function(b,d){if(d()){var c="ko_unique_"+ ++a.d.uniqueName.Zb;a.a.Mb(b,c)}}};a.d.uniqueName.Zb=0;a.d.value={after:["options","foreach"],init:function(b,d,c){if("input"!=b.tagName.toLowerCase()||"checkbox"!=
b.type&&"radio"!=b.type){var e=["change"],g=c.get("valueUpdate"),h=!1,k=null;g&&("string"==typeof g&&(g=[g]),a.a.ga(e,g),e=a.a.rb(e));var f=function(){k=null;h=!1;var e=d(),f=a.i.q(b);a.h.pa(e,c,"value",f)};!a.a.L||"input"!=b.tagName.toLowerCase()||"text"!=b.type||"off"==b.autocomplete||b.form&&"off"==b.form.autocomplete||-1!=a.a.m(e,"propertychange")||(a.a.n(b,"propertychange",function(){h=!0}),a.a.n(b,"focus",function(){h=!1}),a.a.n(b,"blur",function(){h&&f()}));a.a.u(e,function(c){var d=f;a.a.vc(c,
"after")&&(d=function(){k=a.i.q(b);setTimeout(f,0)},c=c.substring(5));a.a.n(b,c,d)});var m=function(){var e=a.a.c(d()),f=a.i.q(b);if(null!==k&&e===k)setTimeout(m,0);else if(e!==f)if("select"===a.a.t(b)){var g=c.get("valueAllowUnset"),f=function(){a.i.ca(b,e,g)};f();g||e===a.i.q(b)?setTimeout(f,0):a.k.B(a.a.oa,null,[b,"change"])}else a.i.ca(b,e)};a.s(m,null,{o:b})}else a.ra(b,{checkedValue:d})},update:function(){}};a.h.V.value=!0;a.d.visible={update:function(b,d){var c=a.a.c(d()),e="none"!=b.style.display;
c&&!e?b.style.display="":!c&&e&&(b.style.display="none")}};(function(b){a.d[b]={init:function(d,c,e,g,h){return a.d.event.init.call(this,d,function(){var a={};a[b]=c();return a},e,g,h)}}})("click");a.H=function(){};a.H.prototype.renderTemplateSource=function(){throw Error("Override renderTemplateSource");};a.H.prototype.createJavaScriptEvaluatorBlock=function(){throw Error("Override createJavaScriptEvaluatorBlock");};a.H.prototype.makeTemplateSource=function(b,d){if("string"==typeof b){d=d||v;var c=
d.getElementById(b);if(!c)throw Error("Cannot find template with ID "+b);return new a.r.l(c)}if(1==b.nodeType||8==b.nodeType)return new a.r.fa(b);throw Error("Unknown template type: "+b);};a.H.prototype.renderTemplate=function(a,d,c,e){a=this.makeTemplateSource(a,e);return this.renderTemplateSource(a,d,c)};a.H.prototype.isTemplateRewritten=function(a,d){return!1===this.allowTemplateRewriting?!0:this.makeTemplateSource(a,d).data("isRewritten")};a.H.prototype.rewriteTemplate=function(a,d,c){a=this.makeTemplateSource(a,
c);d=d(a.text());a.text(d);a.data("isRewritten",!0)};a.b("templateEngine",a.H);a.fb=function(){function b(b,c,d,k){b=a.h.Wa(b);for(var f=a.h.ha,m=0;m<b.length;m++){var l=b[m].key;if(f.hasOwnProperty(l)){var q=f[l];if("function"===typeof q){if(l=q(b[m].value))throw Error(l);}else if(!q)throw Error("This template engine does not support the '"+l+"' binding within its templates");}}d="ko.__tr_ambtns(function($context,$element){return(function(){return{ "+a.h.ya(b,{valueAccessors:!0})+" } })()},'"+d.toLowerCase()+
"')";return k.createJavaScriptEvaluatorBlock(d)+c}var d=/(<([a-z]+\d*)(?:\s+(?!data-bind\s*=\s*)[a-z0-9\-]+(?:=(?:\"[^\"]*\"|\'[^\']*\'))?)*\s+)data-bind\s*=\s*(["'])([\s\S]*?)\3/gi,c=/\x3c!--\s*ko\b\s*([\s\S]*?)\s*--\x3e/g;return{ec:function(b,c,d){c.isTemplateRewritten(b,d)||c.rewriteTemplate(b,function(b){return a.fb.nc(b,c)},d)},nc:function(a,g){return a.replace(d,function(a,c,d,e,l){return b(l,c,d,g)}).replace(c,function(a,c){return b(c,"\x3c!-- ko --\x3e","#comment",g)})},Xb:function(b,c){return a.D.Ua(function(d,
k){var f=d.nextSibling;f&&f.nodeName.toLowerCase()===c&&a.ra(f,b,k)})}}}();a.b("__tr_ambtns",a.fb.Xb);(function(){a.r={};a.r.l=function(a){this.l=a};a.r.l.prototype.text=function(){var b=a.a.t(this.l),b="script"===b?"text":"textarea"===b?"value":"innerHTML";if(0==arguments.length)return this.l[b];var d=arguments[0];"innerHTML"===b?a.a.$a(this.l,d):this.l[b]=d};var b=a.a.e.F()+"_";a.r.l.prototype.data=function(c){if(1===arguments.length)return a.a.e.get(this.l,b+c);a.a.e.set(this.l,b+c,arguments[1])};
var d=a.a.e.F();a.r.fa=function(a){this.l=a};a.r.fa.prototype=new a.r.l;a.r.fa.prototype.text=function(){if(0==arguments.length){var b=a.a.e.get(this.l,d)||{};b.gb===p&&b.Ga&&(b.gb=b.Ga.innerHTML);return b.gb}a.a.e.set(this.l,d,{gb:arguments[0]})};a.r.l.prototype.nodes=function(){if(0==arguments.length)return(a.a.e.get(this.l,d)||{}).Ga;a.a.e.set(this.l,d,{Ga:arguments[0]})};a.b("templateSources",a.r);a.b("templateSources.domElement",a.r.l);a.b("templateSources.anonymousTemplate",a.r.fa)})();(function(){function b(b,
c,d){var e;for(c=a.f.nextSibling(c);b&&(e=b)!==c;)b=a.f.nextSibling(e),d(e,b)}function d(c,d){if(c.length){var e=c[0],g=c[c.length-1],h=e.parentNode,n=a.J.instance,t=n.preprocessNode;if(t){b(e,g,function(a,b){var c=a.previousSibling,d=t.call(n,a);d&&(a===e&&(e=d[0]||b),a===g&&(g=d[d.length-1]||c))});c.length=0;if(!e)return;e===g?c.push(e):(c.push(e,g),a.a.ka(c,h))}b(e,g,function(b){1!==b.nodeType&&8!==b.nodeType||a.pb(d,b)});b(e,g,function(b){1!==b.nodeType&&8!==b.nodeType||a.D.Sb(b,[d])});a.a.ka(c,
h)}}function c(a){return a.nodeType?a:0<a.length?a[0]:null}function e(b,e,h,l,q){q=q||{};var n=b&&c(b),n=n&&n.ownerDocument,t=q.templateEngine||g;a.fb.ec(h,t,n);h=t.renderTemplate(h,l,q,n);if("number"!=typeof h.length||0<h.length&&"number"!=typeof h[0].nodeType)throw Error("Template engine must return an array of DOM nodes");n=!1;switch(e){case "replaceChildren":a.f.T(b,h);n=!0;break;case "replaceNode":a.a.Lb(b,h);n=!0;break;case "ignoreTargetNode":break;default:throw Error("Unknown renderMode: "+
e);}n&&(d(h,l),q.afterRender&&a.k.B(q.afterRender,null,[h,l.$data]));return h}var g;a.ab=function(b){if(b!=p&&!(b instanceof a.H))throw Error("templateEngine must inherit from ko.templateEngine");g=b};a.Ya=function(b,d,h,l,q){h=h||{};if((h.templateEngine||g)==p)throw Error("Set a template engine before calling renderTemplate");q=q||"replaceChildren";if(l){var n=c(l);return a.j(function(){var g=d&&d instanceof a.N?d:new a.N(a.a.c(d)),p=a.C(b)?b():"function"===typeof b?b(g.$data,g):b,g=e(l,q,p,g,h);
"replaceNode"==q&&(l=g,n=c(l))},null,{Ia:function(){return!n||!a.a.Ja(n)},o:n&&"replaceNode"==q?n.parentNode:n})}return a.D.Ua(function(c){a.Ya(b,d,h,c,"replaceNode")})};a.uc=function(b,c,g,h,q){function n(a,b){d(b,s);g.afterRender&&g.afterRender(b,a)}function t(c,d){s=q.createChildContext(c,g.as,function(a){a.$index=d});var f=a.C(b)?b():"function"===typeof b?b(c,s):b;return e(null,"ignoreTargetNode",f,s,g)}var s;return a.j(function(){var b=a.a.c(c)||[];"undefined"==typeof b.length&&(b=[b]);b=a.a.ta(b,
function(b){return g.includeDestroyed||b===p||null===b||!a.a.c(b._destroy)});a.k.B(a.a.Za,null,[h,b,t,g,n])},null,{o:h})};var h=a.a.e.F();a.d.template={init:function(b,c){var d=a.a.c(c());"string"==typeof d||d.name?a.f.ja(b):(d=a.f.childNodes(b),d=a.a.oc(d),(new a.r.fa(b)).nodes(d));return{controlsDescendantBindings:!0}},update:function(b,c,d,e,g){var n=c(),t;c=a.a.c(n);d=!0;e=null;"string"==typeof c?c={}:(n=c.name,"if"in c&&(d=a.a.c(c["if"])),d&&"ifnot"in c&&(d=!a.a.c(c.ifnot)),t=a.a.c(c.data));
"foreach"in c?e=a.uc(n||b,d&&c.foreach||[],c,b,g):d?(g="data"in c?g.createChildContext(t,c.as):g,e=a.Ya(n||b,g,c,b)):a.f.ja(b);g=e;(t=a.a.e.get(b,h))&&"function"==typeof t.K&&t.K();a.a.e.set(b,h,g&&g.Z()?g:p)}};a.h.ha.template=function(b){b=a.h.Wa(b);return 1==b.length&&b[0].unknown||a.h.lc(b,"name")?null:"This template engine does not support anonymous templates nested within its templates"};a.f.Q.template=!0})();a.b("setTemplateEngine",a.ab);a.b("renderTemplate",a.Ya);a.a.wb=function(a,d,c){if(a.length&&
d.length){var e,g,h,k,f;for(e=g=0;(!c||e<c)&&(k=a[g]);++g){for(h=0;f=d[h];++h)if(k.value===f.value){k.moved=f.index;f.moved=k.index;d.splice(h,1);e=h=0;break}e+=h}}};a.a.Fa=function(){function b(b,c,e,g,h){var k=Math.min,f=Math.max,m=[],l,q=b.length,n,p=c.length,s=p-q||1,u=q+p+1,r,v,w;for(l=0;l<=q;l++)for(v=r,m.push(r=[]),w=k(p,l+s),n=f(0,l-1);n<=w;n++)r[n]=n?l?b[l-1]===c[n-1]?v[n-1]:k(v[n]||u,r[n-1]||u)+1:n+1:l+1;k=[];f=[];s=[];l=q;for(n=p;l||n;)p=m[l][n]-1,n&&p===m[l][n-1]?f.push(k[k.length]={status:e,
value:c[--n],index:n}):l&&p===m[l-1][n]?s.push(k[k.length]={status:g,value:b[--l],index:l}):(--n,--l,h.sparse||k.push({status:"retained",value:c[n]}));a.a.wb(f,s,10*q);return k.reverse()}return function(a,c,e){e="boolean"===typeof e?{dontLimitMoves:e}:e||{};a=a||[];c=c||[];return a.length<=c.length?b(a,c,"added","deleted",e):b(c,a,"deleted","added",e)}}();a.b("utils.compareArrays",a.a.Fa);(function(){function b(b,d,g,h,k){var f=[],m=a.j(function(){var l=d(g,k,a.a.ka(f,b))||[];0<f.length&&(a.a.Lb(f,
l),h&&a.k.B(h,null,[g,l,k]));f.length=0;a.a.ga(f,l)},null,{o:b,Ia:function(){return!a.a.ob(f)}});return{$:f,j:m.Z()?m:p}}var d=a.a.e.F();a.a.Za=function(c,e,g,h,k){function f(b,d){x=q[d];r!==d&&(A[b]=x);x.Na(r++);a.a.ka(x.$,c);s.push(x);w.push(x)}function m(b,c){if(b)for(var d=0,e=c.length;d<e;d++)c[d]&&a.a.u(c[d].$,function(a){b(a,d,c[d].sa)})}e=e||[];h=h||{};var l=a.a.e.get(c,d)===p,q=a.a.e.get(c,d)||[],n=a.a.Da(q,function(a){return a.sa}),t=a.a.Fa(n,e,h.dontLimitMoves),s=[],u=0,r=0,v=[],w=[];e=
[];for(var A=[],n=[],x,B=0,D,F;D=t[B];B++)switch(F=D.moved,D.status){case "deleted":F===p&&(x=q[u],x.j&&x.j.K(),v.push.apply(v,a.a.ka(x.$,c)),h.beforeRemove&&(e[B]=x,w.push(x)));u++;break;case "retained":f(B,u++);break;case "added":F!==p?f(B,F):(x={sa:D.value,Na:a.p(r++)},s.push(x),w.push(x),l||(n[B]=x))}m(h.beforeMove,A);a.a.u(v,h.beforeRemove?a.R:a.removeNode);for(var B=0,l=a.f.firstChild(c),G;x=w[B];B++){x.$||a.a.extend(x,b(c,g,x.sa,k,x.Na));for(u=0;t=x.$[u];l=t.nextSibling,G=t,u++)t!==l&&a.f.Bb(c,
t,G);!x.ic&&k&&(k(x.sa,x.$,x.Na),x.ic=!0)}m(h.beforeRemove,e);m(h.afterMove,A);m(h.afterAdd,n);a.a.e.set(c,d,s)}})();a.b("utils.setDomNodeChildrenFromArrayMapping",a.a.Za);a.O=function(){this.allowTemplateRewriting=!1};a.O.prototype=new a.H;a.O.prototype.renderTemplateSource=function(b){var d=(9>a.a.L?0:b.nodes)?b.nodes():null;if(d)return a.a.S(d.cloneNode(!0).childNodes);b=b.text();return a.a.ba(b)};a.O.Oa=new a.O;a.ab(a.O.Oa);a.b("nativeTemplateEngine",a.O);(function(){a.Sa=function(){var a=this.kc=
function(){if(!w||!w.tmpl)return 0;try{if(0<=w.tmpl.tag.tmpl.open.toString().indexOf("__"))return 2}catch(a){}return 1}();this.renderTemplateSource=function(b,e,g){g=g||{};if(2>a)throw Error("Your version of jQuery.tmpl is too old. Please upgrade to jQuery.tmpl 1.0.0pre or later.");var h=b.data("precompiled");h||(h=b.text()||"",h=w.template(null,"{{ko_with $item.koBindingContext}}"+h+"{{/ko_with}}"),b.data("precompiled",h));b=[e.$data];e=w.extend({koBindingContext:e},g.templateOptions);e=w.tmpl(h,
b,e);e.appendTo(v.createElement("div"));w.fragments={};return e};this.createJavaScriptEvaluatorBlock=function(a){return"{{ko_code ((function() { return "+a+" })()) }}"};this.addTemplate=function(a,b){v.write("<script type='text/html' id='"+a+"'>"+b+"\x3c/script>")};0<a&&(w.tmpl.tag.ko_code={open:"__.push($1 || '');"},w.tmpl.tag.ko_with={open:"with($1) {",close:"} "})};a.Sa.prototype=new a.H;var b=new a.Sa;0<b.kc&&a.ab(b);a.b("jqueryTmplTemplateEngine",a.Sa)})()})})();})();function r(f){/in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}

(function(){
	if(!window.Element){window.Element=function(){};var __createElement=document.createElement;document.createElement=function(a){var b=__createElement(a);if(b==null){return null}for(var c in window.Element.prototype)b[c]=window.Element.prototype[c];return b};var __getElementById=document.getElementById;document.getElementById=function(a){var b=__getElementById(a);if(b==null){return null}for(var c in window.Element.prototype)b[c]=window.Element.prototype[c];return b}}
	if(!document.getElementsByClassName){var e=[].indexOf||function(a){for(var i=0;i<this.length;i++){if(this[i]===a)return i}return-1};getElementsByClassName=function(b,c){var d=document.querySelectorAll?c.querySelectorAll("."+b):(function(){var a=c.getElementsByTagName("*"),elements=[],i=0;for(;i<a.length;i++){if(a[i].className&&(" "+a[i].className+" ").indexOf(" "+b+" ")>-1&&e.call(elements,a[i])===-1)elements.push(a[i])}return elements})();return d};document.getElementsByClassName=function(a){return getElementsByClassName(a,document)};Element.prototype.getElementsByClassName=function(a){return getElementsByClassName(a,this)}}
	if(!document.querySelectorAll){document.querySelectorAll=function(a){var b=document,head=b.documentElement.firstChild,styleTag=b.createElement('STYLE');head.appendChild(styleTag);b.__qsaels=[];styleTag.styleSheet.cssText=a+"{x:expression(document.__qsaels.push(this))}";window.scrollBy(0,0);return b.__qsaels}}
	if(!Array.prototype.forEach){Array.prototype.forEach=function(a,b){var T,k;if(this==null){throw new TypeError(" this is null or not defined");}var O=Object(this);var c=O.length>>>0;if(typeof a!=="function"){throw new TypeError(a+" is not a function");}if(b){T=b}k=0;while(k<c){var d;if(k in O){d=O[k];a.call(T,d,k,O)}k++}}}
	if(!Array.prototype.indexOf){Array.prototype.indexOf=Array.prototype.indexOf||function(obj,start){for(var i=(start||0),j=this.length;i<j;i++){if(this[i]===obj){return i;}}return -1}}
	window.ELEMENT_NODE=document.ELEMENT_NODE||1,va.lmnt=function(){function a(a){if(a&&a.nextElementSibling)return a.nextElementSibling;if(!a)return null;do a=a.nextSibling;while(a&&a.nodeType!==ELEMENT_NODE);return a}function b(a){if(a&&a.previousElementSibling)return a.previousElementSibling;if(!a)return null;do a=a.previousSibling;while(a&&a.nodeType!==ELEMENT_NODE);return a}function c(b){return b&&b.firstElementChild?b.firstElementChild:(b=b?b.firstChild:null,b&&b.nodeType==ELEMENT_NODE?b:b.nextElementSibling||a(b))}function d(a){return a&&a.lastElementChild?a.lastElementChild:(a=a?a.lastChild:null,a&&a.nodeType==ELEMENT_NODE?a:a.previousElementSibling||b(a))}function e(a){if(a&&a.childElementCount)return a.childElementCount;if(a&&a.children)return a.children.length||0;var b=0;a=a?a.firstChild:null;do a&&a.nodeType==ELEMENT_NODE&&b++,a=a.nextSibling;while(a);return b}function f(a){if(a&&a.children)return a.children;var b=[];a=a?a.firstChild:null;while(a)a&&a.nodeType==ELEMENT_NODE&&b.push(a),a=a.nextSibling;return b}return{nextElementSibling:a,previousElementSibling:b,firstElementChild:c,lastElementChild:d,childElementCount:e,children:f}}();
	if(typeof String.prototype.capitalize!="function")String.prototype.capitalize=function(){return this.charAt(0).toUpperCase()+this.slice(1)};
	if(typeof String.prototype.startsWith!="function")String.prototype.startsWith=function(str){return this.indexOf(str)==0};
	var split;split=split||function(e){var f=String.prototype.split,compliantExecNpcg=/()??/.exec("")[1]===e,self;self=function(a,b,c){if(Object.prototype.toString.call(b)!=="[object RegExp]"){return f.call(a,b,c)}var d=[],flags=(b.ignoreCase?"i":"")+(b.multiline?"m":"")+(b.extended?"x":"")+(b.sticky?"y":""),lastLastIndex=0,b=new RegExp(b.source,flags+"g"),separator2,match,lastIndex,lastLength;a+="";if(!compliantExecNpcg){separator2=new RegExp("^"+b.source+"$(?!\\s)",flags)}c=c===e?-1>>>0:c>>>0;while(match=b.exec(a)){lastIndex=match.index+match[0].length;if(lastIndex>lastLastIndex){d.push(a.slice(lastLastIndex,match.index));if(!compliantExecNpcg&&match.length>1){match[0].replace(separator2,function(){for(var i=1;i<arguments.length-2;i++){if(arguments[i]===e){match[i]=e}}})}if(match.length>1&&match.index<a.length){Array.prototype.push.apply(d,match.slice(1))}lastLength=match[0].length;lastLastIndex=lastIndex;if(d.length>=c){break}}if(b.lastIndex===match.index){b.lastIndex++}}if(lastLastIndex===a.length){if(lastLength||!b.test("")){d.push("")}}else{d.push(a.slice(lastLastIndex))}return d.length>c?d.slice(0,c):d};String.prototype.split=function(a,b){return self(this,a,b)};return self}();
	if(!String.prototype.format){String.prototype.format=function(){var str=this.toString();if(!arguments.length)return str;var args=typeof arguments[0],args=(("string"==args||"number"==args)?arguments:arguments[0]);for(arg in args)str=str.replace(RegExp("\\{"+arg+"\\}","gi"),args[arg]);return str;}}
})();

if(typeof JSON!=='object'){JSON={}}(function(){'use strict';function f(n){return n<10?'0'+n:n}if(typeof Date.prototype.toJSON!=='function'){Date.prototype.toJSON=function(){return isFinite(this.valueOf())?this.getUTCFullYear()+'-'+f(this.getUTCMonth()+1)+'-'+f(this.getUTCDate())+'T'+f(this.getUTCHours())+':'+f(this.getUTCMinutes())+':'+f(this.getUTCSeconds())+'Z':null};String.prototype.toJSON=Number.prototype.toJSON=Boolean.prototype.toJSON=function(){return this.valueOf()}}var e,escapable,gap,indent,meta,rep;function quote(b){escapable.lastIndex=0;return escapable.test(b)?'"'+b.replace(escapable,function(a){var c=meta[a];return typeof c==='string'?c:'\\u'+('0000'+a.charCodeAt(0).toString(16)).slice(-4)})+'"':'"'+b+'"'}function str(a,b){var i,k,v,length,mind=gap,partial,value=b[a];if(value&&typeof value==='object'&&typeof value.toJSON==='function'){value=value.toJSON(a)}if(typeof rep==='function'){value=rep.call(b,a,value)}switch(typeof value){case'string':return quote(value);case'number':return isFinite(value)?String(value):'null';case'boolean':case'null':return String(value);case'object':if(!value){return'null'}gap+=indent;partial=[];if(Object.prototype.toString.apply(value)==='[object Array]'){length=value.length;for(i=0;i<length;i+=1){partial[i]=str(i,value)||'null'}v=partial.length===0?'[]':gap?'[\n'+gap+partial.join(',\n'+gap)+'\n'+mind+']':'['+partial.join(',')+']';gap=mind;return v}if(rep&&typeof rep==='object'){length=rep.length;for(i=0;i<length;i+=1){if(typeof rep[i]==='string'){k=rep[i];v=str(k,value);if(v){partial.push(quote(k)+(gap?': ':':')+v)}}}}else{for(k in value){if(Object.prototype.hasOwnProperty.call(value,k)){v=str(k,value);if(v){partial.push(quote(k)+(gap?': ':':')+v)}}}}v=partial.length===0?'{}':gap?'{\n'+gap+partial.join(',\n'+gap)+'\n'+mind+'}':'{'+partial.join(',')+'}';gap=mind;return v}}if(typeof JSON.stringify!=='function'){escapable=/[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g;meta={'\b':'\\b','\t':'\\t','\n':'\\n','\f':'\\f','\r':'\\r','"':'\\"','\\':'\\\\'};JSON.stringify=function(a,b,c){var i;gap='';indent='';if(typeof c==='number'){for(i=0;i<c;i+=1){indent+=' '}}else if(typeof c==='string'){indent=c}rep=b;if(b&&typeof b!=='function'&&(typeof b!=='object'||typeof b.length!=='number')){throw new Error('JSON.stringify');}return str('',{'':a})}}if(typeof JSON.parse!=='function'){e=/[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g;JSON.parse=function(c,d){var j;function walk(a,b){var k,v,value=a[b];if(value&&typeof value==='object'){for(k in value){if(Object.prototype.hasOwnProperty.call(value,k)){v=walk(value,k);if(v!==undefined){value[k]=v}else{delete value[k]}}}}return d.call(a,b,value)}c=String(c);e.lastIndex=0;if(e.test(c)){c=c.replace(e,function(a){return'\\u'+('0000'+a.charCodeAt(0).toString(16)).slice(-4)})}if(/^[\],:{}\s]*$/.test(c.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,'@').replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,']').replace(/(?:^|:|,)(?:\s*\[)+/g,''))){j=eval('('+c+')');return typeof d==='function'?walk({'':j},''):j}throw new SyntaxError('JSON.parse');}}}());

//(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){var type;try{type=require("type-of")}catch(ex){var r=require;type=r("type")}var jsonpID=0,document=window.document,key,name,rscript=/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,scriptTypeRE=/^(?:text|application)\/javascript/i,xmlTypeRE=/^(?:text|application)\/xml/i,jsonType="application/json",htmlType="text/html",blankRE=/^\s*$/;window.ajax=module.exports=function(options){var settings=extend({},options||{});for(key in ajax.settings)if(settings[key]===undefined)settings[key]=ajax.settings[key];ajaxStart(settings);if(!settings.crossDomain)settings.crossDomain=/^([\w-]+:)?\/\/([^\/]+)/.test(settings.url)&&RegExp.$2!=window.location.host;var dataType=settings.dataType,hasPlaceholder=/=\?/.test(settings.url);if(dataType=="jsonp"||hasPlaceholder){if(!hasPlaceholder)settings.url=appendQuery(settings.url,"callback=?");return ajax.JSONP(settings)}if(!settings.url)settings.url=window.location.toString();serializeData(settings);var mime=settings.accepts[dataType],baseHeaders={},protocol=/^([\w-]+:)\/\//.test(settings.url)?RegExp.$1:window.location.protocol,xhr=ajax.settings.xhr(),abortTimeout;if(!settings.crossDomain)baseHeaders["X-Requested-With"]="XMLHttpRequest";if(mime){baseHeaders["Accept"]=mime;if(mime.indexOf(",")>-1)mime=mime.split(",",2)[0];xhr.overrideMimeType&&xhr.overrideMimeType(mime)}if(settings.contentType||settings.data&&settings.type.toUpperCase()!="GET")baseHeaders["Content-Type"]=settings.contentType||"application/x-www-form-urlencoded";settings.headers=extend(baseHeaders,settings.headers||{});xhr.onreadystatechange=function(){if(xhr.readyState==4){clearTimeout(abortTimeout);var result,error=false;if(xhr.status>=200&&xhr.status<300||xhr.status==304||xhr.status==0&&protocol=="file:"){dataType=dataType||mimeToDataType(xhr.getResponseHeader("content-type"));result=xhr.responseText;try{if(dataType=="script")(1,eval)(result);else if(dataType=="xml")result=xhr.responseXML;else if(dataType=="json")result=blankRE.test(result)?null:JSON.parse(result)}catch(e){error=e}if(error)ajaxError(error,"parsererror",xhr,settings);else ajaxSuccess(result,xhr,settings)}else{ajaxError(null,"error",xhr,settings)}}};var async="async"in settings?settings.async:true;xhr.open(settings.type,settings.url,async);for(name in settings.headers)xhr.setRequestHeader(name,settings.headers[name]);if(ajaxBeforeSend(xhr,settings)===false){xhr.abort();return false}if(settings.timeout>0)abortTimeout=setTimeout(function(){xhr.onreadystatechange=empty;xhr.abort();ajaxError(null,"timeout",xhr,settings)},settings.timeout);xhr.send(settings.data?settings.data:null);return xhr};function triggerAndReturn(context,eventName,data){return true}function triggerGlobal(settings,context,eventName,data){if(settings.global)return triggerAndReturn(context||document,eventName,data)}ajax.active=0;function ajaxStart(settings){if(settings.global&&ajax.active++===0)triggerGlobal(settings,null,"ajaxStart")}function ajaxStop(settings){if(settings.global&&!--ajax.active)triggerGlobal(settings,null,"ajaxStop")}function ajaxBeforeSend(xhr,settings){var context=settings.context;if(settings.beforeSend.call(context,xhr,settings)===false||triggerGlobal(settings,context,"ajaxBeforeSend",[xhr,settings])===false)return false;triggerGlobal(settings,context,"ajaxSend",[xhr,settings])}function ajaxSuccess(data,xhr,settings){var context=settings.context,status="success";settings.success.call(context,data,status,xhr);triggerGlobal(settings,context,"ajaxSuccess",[xhr,settings,data]);ajaxComplete(status,xhr,settings)}function ajaxError(error,type,xhr,settings){var context=settings.context;settings.error.call(context,xhr,type,error);triggerGlobal(settings,context,"ajaxError",[xhr,settings,error]);ajaxComplete(type,xhr,settings)}function ajaxComplete(status,xhr,settings){var context=settings.context;settings.complete.call(context,xhr,status);triggerGlobal(settings,context,"ajaxComplete",[xhr,settings]);ajaxStop(settings)}function empty(){}ajax.JSONP=function(options){if(!("type"in options))return ajax(options);var callbackName="jsonp"+ ++jsonpID,script=document.createElement("script"),abort=function(){if(callbackName in window)window[callbackName]=empty;ajaxComplete("abort",xhr,options)},xhr={abort:abort},abortTimeout,head=document.getElementsByTagName("head")[0]||document.documentElement;if(options.error)script.onerror=function(){xhr.abort();options.error()};window[callbackName]=function(data){clearTimeout(abortTimeout);delete window[callbackName];ajaxSuccess(data,xhr,options)};serializeData(options);script.src=options.url.replace(/=\?/,"="+callbackName);head.insertBefore(script,head.firstChild);if(options.timeout>0)abortTimeout=setTimeout(function(){xhr.abort();ajaxComplete("timeout",xhr,options)},options.timeout);return xhr};ajax.settings={type:"GET",beforeSend:empty,success:empty,error:empty,complete:empty,context:null,global:true,xhr:function(){return new window.XMLHttpRequest},accepts:{script:"text/javascript, application/javascript",json:jsonType,xml:"application/xml, text/xml",html:htmlType,text:"text/plain"},crossDomain:false,timeout:0};function mimeToDataType(mime){return mime&&(mime==htmlType?"html":mime==jsonType?"json":scriptTypeRE.test(mime)?"script":xmlTypeRE.test(mime)&&"xml")||"text"}function appendQuery(url,query){return(url+"&"+query).replace(/[&?]{1,2}/,"?")}function serializeData(options){if(type(options.data)==="object")options.data=param(options.data);if(options.data&&(!options.type||options.type.toUpperCase()=="GET"))options.url=appendQuery(options.url,options.data)}ajax.get=function(url,success){return ajax({url:url,success:success})};ajax.post=function(url,data,success,dataType){if(type(data)==="function")dataType=dataType||success,success=data,data=null;return ajax({type:"POST",url:url,data:data,success:success,dataType:dataType})};ajax.getJSON=function(url,success){return ajax({url:url,success:success,dataType:"json"})};var escape=encodeURIComponent;function serialize(params,obj,traditional,scope){var array=type(obj)==="array";for(var key in obj){var value=obj[key];if(scope)key=traditional?scope:scope+"["+(array?"":key)+"]";if(!scope&&array)params.add(value.name,value.value);else if(traditional?type(value)==="array":type(value)==="object")serialize(params,value,traditional,key);else params.add(key,value)}}function param(obj,traditional){var params=[];params.add=function(k,v){this.push(escape(k)+"="+escape(v))};serialize(params,obj,traditional);return params.join("&").replace("%20","+")}function extend(target){var slice=Array.prototype.slice;slice.call(arguments,1).forEach(function(source){for(key in source)if(source[key]!==undefined)target[key]=source[key]});return target}},{"type-of":2}],2:[function(require,module,exports){var toString=Object.prototype.toString;module.exports=function(val){switch(toString.call(val)){case"[object Function]":return"function";case"[object Date]":return"date";case"[object RegExp]":return"regexp";case"[object Arguments]":return"arguments";case"[object Array]":return"array";case"[object String]":return"string"}if(val===null)return"null";if(val===undefined)return"undefined";if(val&&val.nodeType===1)return"element";if(val===Object(val))return"object";return typeof val}},{}]},{},[1]);

/*
 * CM.JS
 * http://timseverien.nl
 * Copyright (c) 2013 Tim Severien
 * Released under the GPLv2 license.
 */
//!function(t){var e=new Date(0),n=t.JSON,r=n.stringify,i=encodeURI,o=decodeURI,c=function(t){try{return n.parse(t)}catch(e){}return t},u=function(t){return"object"==typeof t&&r?r(t):t},s={set:function(t,e,n,r,o){var c=i(t)+"="+i(u(e));n&&(n.constructor===Number?c+=";max-age="+n:n.constructor===String?c+=";expires="+n:n.constructor===Date&&(c+=";expires="+n.toUTCString())),c+=";path="+(r?r:"/"),o&&(c+=";domain="+o),document.cookie=c},setObject:function(t,e,n,r){for(var i in t)this.set(i,t[i],e,n,r)},get:function(t){return this.getObject()[t]},getObject:function(){var t,e=document.cookie.split(/;\s?/i),n={};for(var r in e)if(e.hasOwnProperty(r))t=e[r].split("="),t.length<=1||(n[o(t[0])]=c(o(t[1])));return n},unset:function(t){document.cookie=t+"=; expires="+e.toUTCString()},clear:function(){var t=this.getObject();for(var e in t)this.unset(e)}};"function"==typeof define&&define.amd?define(function(){return s}):va.CM=s}(this);

/* gator v1.2.2 craig.is/riding/gators */
(function(){function q(a,b,c){if("_root"==b)return c;if(a!==c){var d;k||(a.matches&&(k=a.matches),a.webkitMatchesSelector&&(k=a.webkitMatchesSelector),a.mozMatchesSelector&&(k=a.mozMatchesSelector),a.msMatchesSelector&&(k=a.msMatchesSelector),a.oMatchesSelector&&(k=a.oMatchesSelector),k||(k=e.matchesSelector));d=k;if(d.call(a,b))return a;if(a.parentNode)return m++,q(a.parentNode,b,c)}}function s(a,b,c,e){d[a.id]||(d[a.id]={});d[a.id][b]||(d[a.id][b]={});d[a.id][b][c]||(d[a.id][b][c]=[]);d[a.id][b][c].push(e)}function t(a,b,c,e){if(d[a.id])if(!b)for(var f in d[a.id])d[a.id].hasOwnProperty(f)&&(d[a.id][f]={});else if(!e&&!c)d[a.id][b]={};else if(!e)delete d[a.id][b][c];else if(d[a.id][b][c])for(f=0;f<d[a.id][b][c].length;f++)if(d[a.id][b][c][f]===e){d[a.id][b][c].splice(f,1);break}}function u(a,b,c){if(d[a][c]){var k=b.target||b.srcElement,f,g,h={},n=g=0;m=0;for(f in d[a][c])d[a][c].hasOwnProperty(f)&&(g=q(k,f,l[a].element))&&e.matchesEvent(c,l[a].element,g,"_root"==f,b)&&(m++,d[a][c][f].match=g,h[m]=d[a][c][f]);b.stopPropagation=function(){b.cancelBubble=!0};for(g=0;g<=m;g++)if(h[g])for(n=0;n<h[g].length;n++){if(!1===h[g][n].call(h[g].match,b)){e.cancel(b);return}if(b.cancelBubble)return}}}function r(a,b,c,k){function f(a){return function(b){u(g,b,a)}}if(this.element){a instanceof Array||(a=[a]);c||"function"!=typeof b||(c=b,b="_root");var g=this.id,h;for(h=0;h<a.length;h++)k?t(this,a[h],b,c):(d[g]&&d[g][a[h]]||e.addEvent(this,a[h],f(a[h])),s(this,a[h],b,c));return this}}function e(a,b){if(!(this instanceof e)){for(var c in l)if(l[c].element===a)return l[c];p++;l[p]=new e(a,p);return l[p]}this.element=a;this.id=b}var k,m=0,p=0,d={},l={};e.prototype.on=function(a,b,c){return r.call(this,a,b,c)};e.prototype.off=function(a,b,c){return r.call(this,a,b,c,!0)};e.matchesSelector=function(){};e.cancel=function(a){a.preventDefault();a.stopPropagation()};e.addEvent=function(a,b,c){a.element.addEventListener(b,c,"blur"==b||"focus"==b)};e.matchesEvent=function(){return!0};window.Gator=e})();
(function(d){var f=d.addEvent;d.addEvent=function(a,b,c){if(a.element.addEventListener){return f(a,b,c)}if(b=='focus'){b='focusin'}if(b=='blur'){b='focusout'}a.element.attachEvent('on'+b,c)};d.matchesSelector=function(a){if(a.charAt(0)==='.'){return(' '+this.className+' ').indexOf(' '+a.slice(1)+' ')>-1}if(a.charAt(0)==='#'){return this.id===a.slice(1)}return this.tagName===a.toUpperCase()};d.cancel=function(e){if(e.preventDefault){e.preventDefault()}if(e.stopPropagation){e.stopPropagation()}e.returnValue=false;e.cancelBubble=true}})(Gator);
(function(f){var g=f.addEvent;function _isMouseEnterOrLeave(a,b,c,e){var tt=(e.relatedTarget?e.relatedTarget:e.toElement?e.toElement:null);if(!tt){return true}if(c&&a!==b){return false}if(b===tt){return false}if(b.contains(tt)){return false}return true}f.addEvent=function(a,b,c){if(b=='mousewheel'){b=(/Firefox/i.test(navigator.userAgent))?'DOMMouseScroll':'mousewheel'}if(b=='mouseenter'){b='mouseover'}if(b=='mouseleave'){b='mouseout'}g(a,b,c)};f.matchesEvent=function(a,b,c,d,e){if(a=='mouseenter'||a=='mouseleave'){return _isMouseEnterOrLeave(b,c,d,e)}return true}})(Gator);

/**
 * Intro.js v1.0.0
 * https://github.com/usablica/intro.js
 * MIT licensed
 *
 * Copyright (C) 2013 usabli.ca - A weekend project by Afshin Mehrabani (@afshinmeh)
 */

(function (root, factory) {
  if (typeof exports === 'object') {
    // CommonJS
    factory(exports);
  } else if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define(['exports'], factory);
  } else {
    // Browser globals
    factory(root);
  }
} (this, function (exports) {
  //Default config/variables
  var VERSION = '1.0.0';

  /**
   * IntroJs main class
   *
   * @class IntroJs
   */
  function IntroJs(obj) {
    this._targetElement = obj;

    this._options = {
      /* Next button label in tooltip box */
      nextLabel: 'Next &rarr;',
      /* Previous button label in tooltip box */
      prevLabel: '&larr; Back',
      /* Skip button label in tooltip box */
      skipLabel: 'Skip',
      /* Done button label in tooltip box */
      doneLabel: 'Done',
      /* Default tooltip box position */
      tooltipPosition: 'bottom',
      /* Next CSS class for tooltip boxes */
      tooltipClass: '',
      /* CSS class that is added to the helperLayer */
      highlightClass: '',
      /* Close introduction when pressing Escape button? */
      exitOnEsc: true,
      /* Close introduction when clicking on overlay layer? */
      exitOnOverlayClick: true,
      /* Show step numbers in introduction? */
      showStepNumbers: false,
      /* Let user use keyboard to navigate the tour? */
      keyboardNavigation: true,
      /* Show tour control buttons? */
      showButtons: true,
      /* Show tour bullets? */
      showBullets: false,
      /* Show tour progress? */
      showProgress: false,
      /* Scroll to highlighted element? */
      scrollToElement: true,
      /* Set the overlay opacity */
      overlayOpacity: 0.8,
      /* Precedence of positions, when auto is enabled */
      positionPrecedence: ["bottom", "top", "right", "left"],
      /* Disable an interaction with element? */
      disableInteraction: false
    };
  }

  /**
   * Initiate a new introduction/guide from an element in the page
   *
   * @api private
   * @method _introForElement
   * @param {Object} targetElm
   * @returns {Boolean} Success or not?
   */
  function _introForElement(targetElm) {
  	var introItems = [],
        self = this;

    if (this._options.steps) {
      //use steps passed programmatically
      var allIntroSteps = [];

      for (var i = 0, stepsLength = this._options.steps.length; i < stepsLength; i++) {
        var currentItem = _cloneObject(this._options.steps[i]);
        //set the step
        currentItem.step = introItems.length + 1;
        //use querySelector function only when developer used CSS selector
        if (typeof(currentItem.element) === 'string') {
          //grab the element with given selector from the page
          currentItem.element = document.querySelector(currentItem.element);
        }

        //intro without element
        if (typeof(currentItem.element) === 'undefined' || currentItem.element == null) {
          var floatingElementQuery = document.querySelector(".introjsFloatingElement");

          if (floatingElementQuery == null) {
            floatingElementQuery = document.createElement('div');
            floatingElementQuery.className = 'introjsFloatingElement';

            document.body.appendChild(floatingElementQuery);
          }

          currentItem.element  = floatingElementQuery;
          currentItem.position = 'floating';
        }

        if (currentItem.element != null) {
          introItems.push(currentItem);
        }
      }

    } else {
      //use steps from data-* annotations
      var allIntroSteps = targetElm.querySelectorAll('*[data-intro]');
      //if there's no element to intro
      if (allIntroSteps.length < 1) {
        return false;
      }

      //first add intro items with data-step
      for (var i = 0, elmsLength = allIntroSteps.length; i < elmsLength; i++) {
        var currentElement = allIntroSteps[i];
        var step = parseInt(currentElement.getAttribute('data-step'), 10);
        if (typeof (this._introFilterCallback) !== 'undefined') {
					if(!this._introFilterCallback.call(this, currentElement)) continue;
				}

        if (step > 0) {
          introItems[step - 1] = {
            element: currentElement,
            intro: currentElement.getAttribute('data-intro'),
            step: parseInt(currentElement.getAttribute('data-step'), 10),
            tooltipClass: currentElement.getAttribute('data-tooltipClass'),
            highlightClass: currentElement.getAttribute('data-highlightClass'),
            position: currentElement.getAttribute('data-position') || this._options.tooltipPosition
          };
        }
      }

      //next add intro items without data-step
      //todo: we need a cleanup here, two loops are redundant
      var nextStep = 0;
      for (var i = 0, elmsLength = allIntroSteps.length; i < elmsLength; i++) {
        var currentElement = allIntroSteps[i];

        if (currentElement.getAttribute('data-step') == null) {

          while (true) {
            if (typeof introItems[nextStep] == 'undefined') {
              break;
            } else {
              nextStep++;
            }
          }

          introItems[nextStep] = {
            element: currentElement,
            intro: currentElement.getAttribute('data-intro'),
            step: nextStep + 1,
            tooltipClass: currentElement.getAttribute('data-tooltipClass'),
            highlightClass: currentElement.getAttribute('data-highlightClass'),
            position: currentElement.getAttribute('data-position') || this._options.tooltipPosition
          };
        }
      }
    }

    //removing undefined/null elements
    var tempIntroItems = [];
    for (var z = 0; z < introItems.length; z++) {
    	var currentElement = allIntroSteps[z];
      introItems[z] && typeof (this._introFilterCallback) !== 'undefined' && this._introFilterCallback.call(this, currentElement) && tempIntroItems.push(introItems[z]);  // copy non-empty values to the end of the array
    }

    introItems = tempIntroItems;

    //Ok, sort all items with given steps
    introItems.sort(function (a, b) {
      return a.step - b.step;
    });

    //set it to the introJs object
    self._introItems = introItems;

    //add overlay layer to the page
    if(_addOverlayLayer.call(self, targetElm)) {
      //then, start the show
      _nextStep.call(self);

      var skipButton     = targetElm.querySelector('.introjs-skipbutton'),
          nextStepButton = targetElm.querySelector('.introjs-nextbutton');

      self._onKeyDown = function(e) {
        if (e.keyCode === 27 && self._options.exitOnEsc == true) {
          //escape key pressed, exit the intro
          _exitIntro.call(self, targetElm);
          //check if any callback is defined
          if (self._introExitCallback != undefined) {
            self._introExitCallback.call(self);
          }
        } else if(e.keyCode === 37) {
          //left arrow
          _previousStep.call(self);
        } else if (e.keyCode === 39) {
          //right arrow
          _nextStep.call(self);
        } else if (e.keyCode === 13) {
          //srcElement === ie
          var target = e.target || e.srcElement;
          if (target && target.className.indexOf('introjs-prevbutton') > 0) {
            //user hit enter while focusing on previous button
            _previousStep.call(self);
          } else if (target && target.className.indexOf('introjs-skipbutton') > 0) {
            //user hit enter while focusing on skip button
            _exitIntro.call(self, targetElm);
          } else {
            //default behavior for responding to enter
            _nextStep.call(self);
          }

          //prevent default behaviour on hitting Enter, to prevent steps being skipped in some browsers
          if(e.preventDefault) {
            e.preventDefault();
          } else {
            e.returnValue = false;
          }
        }
      };

      self._onResize = function(e) {
        _setHelperLayerPosition.call(self, document.querySelector('.introjs-helperLayer'));
        _setHelperLayerPosition.call(self, document.querySelector('.introjs-tooltipReferenceLayer'));
      };

      if (window.addEventListener) {
        if (this._options.keyboardNavigation) {
          window.addEventListener('keydown', self._onKeyDown, true);
        }
        //for window resize
        window.addEventListener('resize', self._onResize, true);
      } else if (document.attachEvent) { //IE
        if (this._options.keyboardNavigation) {
          document.attachEvent('onkeydown', self._onKeyDown);
        }
        //for window resize
        document.attachEvent('onresize', self._onResize);
      }
    }
    return false;
  }

 /*
   * makes a copy of the object
   * @api private
   * @method _cloneObject
  */
  function _cloneObject(object) {
      if (object == null || typeof (object) != 'object' || typeof (object.nodeType) != 'undefined') {
          return object;
      }
      var temp = {};
      for (var key in object) {
          temp[key] = _cloneObject(object[key]);
      }
      return temp;
  }
  /**
   * Go to specific step of introduction
   *
   * @api private
   * @method _goToStep
   */
  function _goToStep(step) {
    //because steps starts with zero
    this._currentStep = step - 2;
    if (typeof (this._introItems) !== 'undefined') {
      _nextStep.call(this);
    }
  }

  /**
   * Go to next step on intro
   *
   * @api private
   * @method _nextStep
   */
  function _nextStep() {
    this._direction = 'forward';
    if (typeof (this._currentStep) === 'undefined') {
      this._currentStep = 0;
    } else {
      ++this._currentStep;
    }
    if ((this._introItems.length) <= this._currentStep) {
      //end of the intro
      //check if any callback is defined
      if (typeof (this._introCompleteCallback) === 'function') {
        this._introCompleteCallback.call(this);
      }
      _exitIntro.call(this, this._targetElement);
      return;
    }
    var nextStep = this._introItems[this._currentStep], cancel;
    if (typeof (this._introBeforeChangeCallback) !== 'undefined') {
      cancel = this._introBeforeChangeCallback.call(this, nextStep.element);
    }
    if(cancel!==false) _showElement.call(this, nextStep);
  }

  /**
   * Go to previous step on intro
   *
   * @api private
   * @method _nextStep
   */
  function _previousStep() {
    this._direction = 'backward';
    if (this._currentStep === 0) {
      return false;
    }
    var nextStep = this._introItems[--this._currentStep], cancel;
    if (typeof (this._introBeforeChangeCallback) !== 'undefined') {
      cancel = this._introBeforeChangeCallback.call(this, nextStep.element);
    }
    if(cancel!==false) _showElement.call(this, nextStep);
  }

  /**
   * Exit from intro
   *
   * @api private
   * @method _exitIntro
   * @param {Object} targetElement
   */
  function _exitIntro(targetElement) {
    //remove overlay layer from the page
    var overlayLayer = targetElement.querySelector('.introjs-overlay');

    //return if intro already completed or skipped
    if (overlayLayer == null) {
      return;
    }

    //for fade-out animation
    overlayLayer.style.opacity = 0;
    setTimeout(function () {
      if (overlayLayer.parentNode) {
        overlayLayer.parentNode.removeChild(overlayLayer);
      }
    }, 500);

    //remove all helper layers
    var helperLayer = targetElement.querySelector('.introjs-helperLayer');
    if (helperLayer) {
      helperLayer.parentNode.removeChild(helperLayer);
    }

    var referenceLayer = targetElement.querySelector('.introjs-tooltipReferenceLayer');
    if (referenceLayer) {
      referenceLayer.parentNode.removeChild(referenceLayer);
	}
    //remove disableInteractionLayer
    var disableInteractionLayer = targetElement.querySelector('.introjs-disableInteraction');
    if (disableInteractionLayer) {
      disableInteractionLayer.parentNode.removeChild(disableInteractionLayer);
    }

    //remove intro floating element
    var floatingElement = document.querySelector('.introjsFloatingElement');
    if (floatingElement) {
      floatingElement.parentNode.removeChild(floatingElement);
    }

    //remove `introjs-showElement` class from the element
    var showElement = document.querySelector('.introjs-showElement');
    if (showElement) {
      showElement.className = showElement.className.replace(/introjs-[a-zA-Z]+/g, '').replace(/^\s+|\s+$/g, ''); // This is a manual trim.
    }

    //remove `introjs-fixParent` class from the elements
    var fixParents = document.querySelectorAll('.introjs-fixParent');
    if (fixParents && fixParents.length > 0) {
      for (var i = fixParents.length - 1; i >= 0; i--) {
        fixParents[i].className = fixParents[i].className.replace(/introjs-fixParent/g, '').replace(/^\s+|\s+$/g, '');
      };
    }

    //clean listeners
    if (window.removeEventListener) {
      window.removeEventListener('keydown', this._onKeyDown, true);
    } else if (document.detachEvent) { //IE
      document.detachEvent('onkeydown', this._onKeyDown);
    }

    //set the step to zero
    this._currentStep = undefined;
  }

  /**
   * Render tooltip box in the page
   *
   * @api private
   * @method _placeTooltip
   * @param {Object} targetElement
   * @param {Object} tooltipLayer
   * @param {Object} arrowLayer
   */
  function _placeTooltip(targetElement, tooltipLayer, arrowLayer, helperNumberLayer) {
    var tooltipCssClass = '',
        currentStepObj,
        tooltipOffset,
        targetElementOffset;

    //reset the old style
    tooltipLayer.style.top        = null;
    tooltipLayer.style.right      = null;
    tooltipLayer.style.bottom     = null;
    tooltipLayer.style.left       = null;
    tooltipLayer.style.marginLeft = null;
    tooltipLayer.style.marginTop  = null;

    arrowLayer.style.display = 'inherit';

    if (typeof(helperNumberLayer) != 'undefined' && helperNumberLayer != null) {
      helperNumberLayer.style.top  = null;
      helperNumberLayer.style.left = null;
    }

    //prevent error when `this._currentStep` is undefined
    if (!this._introItems[this._currentStep]) return;

    //if we have a custom css class for each step
    currentStepObj = this._introItems[this._currentStep];
    if (typeof (currentStepObj.tooltipClass) === 'string') {
      tooltipCssClass = currentStepObj.tooltipClass;
    } else {
      tooltipCssClass = this._options.tooltipClass;
    }

    tooltipLayer.className = ('introjs-tooltip ' + tooltipCssClass).replace(/^\s+|\s+$/g, '');

    //custom css class for tooltip boxes
    var tooltipCssClass = this._options.tooltipClass;

    currentTooltipPosition = this._introItems[this._currentStep].position;
    if ((currentTooltipPosition == "auto" || this._options.tooltipPosition == "auto")) {
      if (currentTooltipPosition != "floating") { // Floating is always valid, no point in calculating
        currentTooltipPosition = _determineAutoPosition.call(this, targetElement, tooltipLayer, currentTooltipPosition)
      }
    }
    var targetOffset = _getOffset(targetElement);
    var tooltipHeight = _getOffset(tooltipLayer).height;
    var windowSize = _getWinSize();
    switch (currentTooltipPosition) {
      case 'top':
        tooltipLayer.style.left = '15px';
        tooltipLayer.style.top = '-' + (tooltipHeight + 10) + 'px';
        arrowLayer.className = 'introjs-arrow bottom';
        break;
      case 'right':
        tooltipLayer.style.left = (_getOffset(targetElement).width + 20) + 'px';
        if (targetOffset.top + tooltipHeight > windowSize.height) {
          // In this case, right would have fallen below the bottom of the screen.
          // Modify so that the bottom of the tooltip connects with the target
          arrowLayer.className = "introjs-arrow left-bottom";
          tooltipLayer.style.top = "-" + (tooltipHeight - targetOffset.height - 20) + "px";
        }
        arrowLayer.className = 'introjs-arrow left';
        break;
      case 'left':
        if (this._options.showStepNumbers == true) {
          tooltipLayer.style.top = '15px';
        }

        if (targetOffset.top + tooltipHeight > windowSize.height) {
          // In this case, left would have fallen below the bottom of the screen.
          // Modify so that the bottom of the tooltip connects with the target
          tooltipLayer.style.top = "-" + (tooltipHeight - targetOffset.height - 20) + "px";
          arrowLayer.className = 'introjs-arrow right-bottom';
        } else {
          arrowLayer.className = 'introjs-arrow right';
        }
        tooltipLayer.style.right = (targetOffset.width + 20) + 'px';


        break;
      case 'floating':
        arrowLayer.style.display = 'none';

        //we have to adjust the top and left of layer manually for intro items without element
        tooltipOffset = _getOffset(tooltipLayer);

        tooltipLayer.style.left   = '50%';
        tooltipLayer.style.top    = '50%';
        tooltipLayer.style.marginLeft = '-' + (tooltipOffset.width / 2)  + 'px';
        tooltipLayer.style.marginTop  = '-' + (tooltipOffset.height / 2) + 'px';

        if (typeof(helperNumberLayer) != 'undefined' && helperNumberLayer != null) {
          helperNumberLayer.style.left = '-' + ((tooltipOffset.width / 2) + 18) + 'px';
          helperNumberLayer.style.top  = '-' + ((tooltipOffset.height / 2) + 18) + 'px';
        }

        break;
      case 'bottom-right-aligned':
        arrowLayer.className      = 'introjs-arrow top-right';
        tooltipLayer.style.right  = '0px';
        tooltipLayer.style.bottom = '-' + (_getOffset(tooltipLayer).height + 10) + 'px';
        break;
      case 'bottom-middle-aligned':
        targetElementOffset = _getOffset(targetElement);
        tooltipOffset       = _getOffset(tooltipLayer);

        arrowLayer.className      = 'introjs-arrow top-middle';
        tooltipLayer.style.left   = (targetElementOffset.width / 2 - tooltipOffset.width / 2) + 'px';
        tooltipLayer.style.bottom = '-' + (tooltipOffset.height + 10) + 'px';
        break;
      case 'bottom-left-aligned':
      // Bottom-left-aligned is the same as the default bottom
      case 'bottom':
      // Bottom going to follow the default behavior
      default:
        tooltipLayer.style.bottom = '-' + (_getOffset(tooltipLayer).height + 10) + 'px';
        tooltipLayer.style.left = (_getOffset(targetElement).width / 2 - _getOffset(tooltipLayer).width / 2) + 'px';

        arrowLayer.className = 'introjs-arrow top';
        break;
    }
  }

  /**
   * Determines the position of the tooltip based on the position precedence and availability
   * of screen space.
   *
   * @param {Object} targetElement
   * @param {Object} tooltipLayer
   * @param {Object} desiredTooltipPosition
   *
   */
  function _determineAutoPosition(targetElement, tooltipLayer, desiredTooltipPosition) {

    // Take a clone of position precedence. These will be the available
    var possiblePositions = this._options.positionPrecedence.slice();

    var windowSize = _getWinSize();
    var tooltipHeight = _getOffset(tooltipLayer).height + 10;
    var tooltipWidth = _getOffset(tooltipLayer).width + 20;
    var targetOffset = _getOffset(targetElement);

    // If we check all the possible areas, and there are no valid places for the tooltip, the element
    // must take up most of the screen real estate. Show the tooltip floating in the middle of the screen.
    var calculatedPosition = "floating";

    // Check if the width of the tooltip + the starting point would spill off the right side of the screen
    // If no, neither bottom or top are valid
    if (targetOffset.left + tooltipWidth > windowSize.width || ((targetOffset.left + (targetOffset.width / 2)) - tooltipWidth) < 0) {
      _removeEntry(possiblePositions, "bottom");
      _removeEntry(possiblePositions, "top");
    } else {
      // Check for space below
      if ((targetOffset.height + targetOffset.top + tooltipHeight) > windowSize.height) {
        _removeEntry(possiblePositions, "bottom");
      }

      // Check for space above
      if (targetOffset.top - tooltipHeight < 0) {
        _removeEntry(possiblePositions, "top");
      }
    }

    // Check for space to the right
    if (targetOffset.width + targetOffset.left + tooltipWidth > windowSize.width) {
      _removeEntry(possiblePositions, "right");
    }

    // Check for space to the left
    if (targetOffset.left - tooltipWidth < 0) {
      _removeEntry(possiblePositions, "left");
    }

    // At this point, our array only has positions that are valid. Pick the first one, as it remains in order
    if (possiblePositions.length > 0) {
      calculatedPosition = possiblePositions[0];
    }

    // If the requested position is in the list, replace our calculated choice with that
    if (desiredTooltipPosition && desiredTooltipPosition != "auto") {
      if (possiblePositions.indexOf(desiredTooltipPosition) > -1) {
        calculatedPosition = desiredTooltipPosition;
      }
    }

    return calculatedPosition
  }

  /**
   * Remove an entry from a string array if it's there, does nothing if it isn't there.
   *
   * @param {Array} stringArray
   * @param {String} stringToRemove
   */
  function _removeEntry(stringArray, stringToRemove) {
    if (stringArray.indexOf(stringToRemove) > -1) {
      stringArray.splice(stringArray.indexOf(stringToRemove), 1);
    }
  }

  /**
   * Update the position of the helper layer on the screen
   *
   * @api private
   * @method _setHelperLayerPosition
   * @param {Object} helperLayer
   */
  function _setHelperLayerPosition(helperLayer) {
    if (helperLayer) {
      //prevent error when `this._currentStep` in undefined
      if (!this._introItems[this._currentStep]) return;

      var currentElement  = this._introItems[this._currentStep],
          elementPosition = _getOffset(currentElement.element),
          widthHeightPadding = 10;

      if (currentElement.position == 'floating') {
        widthHeightPadding = 0;
      }
      //set new position to helper layer
      setTimeout(function(){
      	helperLayer.setAttribute('style', 'width: ' + ((currentElement.element.clientWidth?currentElement.element.clientWidth:elementPosition.width) + widthHeightPadding)  + 'px; ' +
                                        'height:' + (elementPosition.height + widthHeightPadding)  + 'px; ' +
                                        'top:'    + (elementPosition.top    - 5)   + 'px;' +
                                        'left: '  + (elementPosition.left   - 5)   + 'px;');
      }, 100);
    }
  }

  /**
   * Add disableinteraction layer and adjust the size and position of the layer
   *
   * @api private
   * @method _disableInteraction
   */
  function _disableInteraction() {
    var disableInteractionLayer = document.querySelector('.introjs-disableInteraction');
    if (disableInteractionLayer === null) {
      disableInteractionLayer = document.createElement('div');
      disableInteractionLayer.className = 'introjs-disableInteraction';
      this._targetElement.appendChild(disableInteractionLayer);
    }
    _setHelperLayerPosition.call(this, disableInteractionLayer);
  }

  /**
   * Show an element on the page
   *
   * @api private
   * @method _showElement
   * @param {Object} targetElement
   */
  function _showElement(targetElement) {

    if (typeof (this._introChangeCallback) !== 'undefined') {
      this._introChangeCallback.call(this, targetElement.element);
    }

    var self = this,
        oldHelperLayer = document.querySelector('.introjs-helperLayer'),
        oldReferenceLayer = document.querySelector('.introjs-tooltipReferenceLayer'),
        highlightClass = 'introjs-helperLayer',
        elementPosition = _getOffset(targetElement.element);

    //check for a current step highlight class
    if (typeof (targetElement.highlightClass) === 'string') {
      highlightClass += (' ' + targetElement.highlightClass);
    }
    //check for options highlight class
    if (typeof (this._options.highlightClass) === 'string') {
      highlightClass += (' ' + this._options.highlightClass);
    }

    if (oldHelperLayer != null) {
      var oldHelperNumberLayer = oldReferenceLayer.querySelector('.introjs-helperNumberLayer'),
          oldtooltipLayer      = oldReferenceLayer.querySelector('.introjs-tooltiptext'),
          oldArrowLayer        = oldReferenceLayer.querySelector('.introjs-arrow'),
          oldtooltipContainer  = oldReferenceLayer.querySelector('.introjs-tooltip'),
          skipTooltipButton    = oldReferenceLayer.querySelector('.introjs-skipbutton'),
          prevTooltipButton    = oldReferenceLayer.querySelector('.introjs-prevbutton'),
          nextTooltipButton    = oldReferenceLayer.querySelector('.introjs-nextbutton');

      //update or reset the helper highlight class
      oldHelperLayer.className = highlightClass;
      //hide the tooltip
      oldtooltipContainer.style.opacity = 0;
      oldtooltipContainer.style.display = "none";

      if (oldHelperNumberLayer != null) {
        var lastIntroItem = this._introItems[(targetElement.step - 2 >= 0 ? targetElement.step - 2 : 0)];

        if (lastIntroItem != null && (this._direction == 'forward' && lastIntroItem.position == 'floating') || (this._direction == 'backward' && targetElement.position == 'floating')) {
          oldHelperNumberLayer.style.opacity = 0;
        }
      }

      //set new position to helper layer
      _setHelperLayerPosition.call(self, oldHelperLayer);
      _setHelperLayerPosition.call(self, oldReferenceLayer);

      //remove `introjs-fixParent` class from the elements
      var fixParents = document.querySelectorAll('.introjs-fixParent');
      if (fixParents && fixParents.length > 0) {
        for (var i = fixParents.length - 1; i >= 0; i--) {
          fixParents[i].className = fixParents[i].className.replace(/introjs-fixParent/g, '').replace(/^\s+|\s+$/g, '');
        };
      }

      //remove old classes
      var oldShowElement = document.querySelector('.introjs-showElement');
      oldShowElement.className = oldShowElement.className.replace(/introjs-[a-zA-Z]+/g, '').replace(/^\s+|\s+$/g, '');

      //we should wait until the CSS3 transition is competed (it's 0.3 sec) to prevent incorrect `height` and `width` calculation
      if (self._lastShowElementTimer) {
        clearTimeout(self._lastShowElementTimer);
      }
      self._lastShowElementTimer = setTimeout(function() {
        //set current step to the label
        if (oldHelperNumberLayer != null) {
          oldHelperNumberLayer.innerHTML = targetElement.step;
        }
        //set current tooltip text
        oldtooltipLayer.innerHTML = targetElement.intro;
        //set the tooltip position
        oldtooltipContainer.style.display = "block";
        _placeTooltip.call(self, targetElement.element, oldtooltipContainer, oldArrowLayer, oldHelperNumberLayer);

        //change active bullet
        oldReferenceLayer.querySelector('.introjs-bullets li > a.active').className = '';
        oldReferenceLayer.querySelector('.introjs-bullets li > a[data-stepnumber="' + targetElement.step + '"]').className = 'active';

        oldReferenceLayer.querySelector('.introjs-progress .introjs-progressbar').setAttribute('style', 'width:' + _getProgress.call(self) + '%;');

        //show the tooltip
        oldtooltipContainer.style.opacity = 1;
        if (oldHelperNumberLayer) oldHelperNumberLayer.style.opacity = 1;

        //reset button focus
        if (nextTooltipButton.tabIndex === -1) {
          //tabindex of -1 means we are at the end of the tour - focus on skip / done
          skipTooltipButton.focus();
        } else {
          //still in the tour, focus on next
          nextTooltipButton.focus();
        }
      }, 350);

    } else {
      var helperLayer       = document.createElement('div'),
          referenceLayer    = document.createElement('div'),
          arrowLayer        = document.createElement('div'),
          tooltipLayer      = document.createElement('div'),
          tooltipTextLayer  = document.createElement('div'),
          bulletsLayer      = document.createElement('div'),
          progressLayer     = document.createElement('div'),
          buttonsLayer      = document.createElement('div');

      helperLayer.className = highlightClass;
      referenceLayer.className = 'introjs-tooltipReferenceLayer';

      //set new position to helper layer
      _setHelperLayerPosition.call(self, helperLayer);
      _setHelperLayerPosition.call(self, referenceLayer);

      //add helper layer to target element
      this._targetElement.appendChild(helperLayer);
      this._targetElement.appendChild(referenceLayer);

      arrowLayer.className = 'introjs-arrow';

      tooltipTextLayer.className = 'introjs-tooltiptext';
      tooltipTextLayer.innerHTML = targetElement.intro;

      bulletsLayer.className = 'introjs-bullets';

      if (this._options.showBullets === false) {
        bulletsLayer.style.display = 'none';
      }


      var ulContainer = document.createElement('ul');

      for (var i = 0, stepsLength = this._introItems.length; i < stepsLength; i++) {
        var innerLi    = document.createElement('li');
        var anchorLink = document.createElement('a');

        anchorLink.onclick = function() {
          self.goToStep(this.getAttribute('data-stepnumber'));
        };

        if (i === (targetElement.step-1)) anchorLink.className = 'active';

        anchorLink.href = 'javascript:void(0);';
        anchorLink.innerHTML = "&nbsp;";
        anchorLink.setAttribute('data-stepnumber', this._introItems[i].step);

        innerLi.appendChild(anchorLink);
        ulContainer.appendChild(innerLi);
      }

      bulletsLayer.appendChild(ulContainer);

      progressLayer.className = 'introjs-progress';

      if (this._options.showProgress === false) {
        progressLayer.style.display = 'none';
      }
      var progressBar = document.createElement('div');
      progressBar.className = 'introjs-progressbar';
      progressBar.setAttribute('style', 'width:' + _getProgress.call(this) + '%;');

      progressLayer.appendChild(progressBar);

      buttonsLayer.className = 'introjs-tooltipbuttons';
      if (this._options.showButtons === false) {
        buttonsLayer.style.display = 'none';
      }

      tooltipLayer.className = 'introjs-tooltip';
      tooltipLayer.appendChild(tooltipTextLayer);
      tooltipLayer.appendChild(bulletsLayer);
      tooltipLayer.appendChild(progressLayer);

      //add helper layer number
      if (this._options.showStepNumbers == true) {
        var helperNumberLayer = document.createElement('span');
        helperNumberLayer.className = 'introjs-helperNumberLayer';
        helperNumberLayer.innerHTML = targetElement.step;
        referenceLayer.appendChild(helperNumberLayer);
      }

      tooltipLayer.appendChild(arrowLayer);
      referenceLayer.appendChild(tooltipLayer);

      //next button
      var nextTooltipButton = document.createElement('a');

      nextTooltipButton.onclick = function() {
        if (self._introItems.length - 1 != self._currentStep) {
          _nextStep.call(self);
        }
      };

      nextTooltipButton.href = 'javascript:void(0);';
      nextTooltipButton.innerHTML = this._options.nextLabel;

      //previous button
      var prevTooltipButton = document.createElement('a');

      prevTooltipButton.onclick = function() {
        if (self._currentStep != 0) {
          _previousStep.call(self);
        }
      };

      prevTooltipButton.href = 'javascript:void(0);';
      prevTooltipButton.innerHTML = this._options.prevLabel;

      //skip button
      var skipTooltipButton = document.createElement('a');
      skipTooltipButton.className = 'introjs-button introjs-skipbutton';
      skipTooltipButton.href = 'javascript:void(0);';
      skipTooltipButton.innerHTML = this._options.skipLabel;

      skipTooltipButton.onclick = function() {
        if (self._introItems.length - 1 == self._currentStep && typeof (self._introCompleteCallback) === 'function') {
          self._introCompleteCallback.call(self);
        }

        if (self._introItems.length - 1 != self._currentStep && typeof (self._introExitCallback) === 'function') {
          self._introExitCallback.call(self);
        }

        _exitIntro.call(self, self._targetElement);
      };

      buttonsLayer.appendChild(skipTooltipButton);

      //in order to prevent displaying next/previous button always
      if (this._introItems.length > 1) {
        buttonsLayer.appendChild(prevTooltipButton);
        buttonsLayer.appendChild(nextTooltipButton);
      }

      tooltipLayer.appendChild(buttonsLayer);

      //set proper position
      _placeTooltip.call(self, targetElement.element, tooltipLayer, arrowLayer, helperNumberLayer);
    }

    //disable interaction
    if (this._options.disableInteraction === true) {
      _disableInteraction.call(self);
    }

    prevTooltipButton.removeAttribute('tabIndex');
    nextTooltipButton.removeAttribute('tabIndex');
    if (this._currentStep == 0 && this._introItems.length > 1) {
      prevTooltipButton.className = 'introjs-button introjs-prevbutton introjs-disabled';
      prevTooltipButton.tabIndex = '-1';
      nextTooltipButton.className = 'introjs-button introjs-nextbutton';
      skipTooltipButton.innerHTML = this._options.skipLabel;
    } else if (this._introItems.length - 1 == this._currentStep || this._introItems.length == 1) {
      skipTooltipButton.innerHTML = this._options.doneLabel;
      prevTooltipButton.className = 'introjs-button introjs-prevbutton';
      nextTooltipButton.className = 'introjs-button introjs-nextbutton introjs-disabled';
      nextTooltipButton.tabIndex = '-1';
    } else {
      prevTooltipButton.className = 'introjs-button introjs-prevbutton';
      nextTooltipButton.className = 'introjs-button introjs-nextbutton';
      skipTooltipButton.innerHTML = this._options.skipLabel;
    }

    //Set focus on "next" button, so that hitting Enter always moves you onto the next step
    nextTooltipButton.focus();

    _showOverlayLayer.call(this);

    //add target element position style
    targetElement.element.className += ' introjs-showElement';

    var currentElementPosition = _getPropValue(targetElement.element, 'position');
    if (currentElementPosition !== 'absolute' &&
        currentElementPosition !== 'relative') {
      //change to new intro item
      targetElement.element.className += ' introjs-relativePosition';
    }

    var parentElm = targetElement.element.parentNode;
    while (parentElm != null) {
      if (parentElm.tagName.toLowerCase() === 'body') break;

      //fix The Stacking Contenxt problem.
      //More detail: https://developer.mozilla.org/en-US/docs/Web/Guide/CSS/Understanding_z_index/The_stacking_context
      var zIndex = _getPropValue(parentElm, 'z-index');
      var opacity = parseFloat(_getPropValue(parentElm, 'opacity'));
      var transform = _getPropValue(parentElm, 'transform') || _getPropValue(parentElm, '-webkit-transform') || _getPropValue(parentElm, '-moz-transform') || _getPropValue(parentElm, '-ms-transform') || _getPropValue(parentElm, '-o-transform');
      if (/[0-9]+/.test(zIndex) || opacity < 1 || transform !== 'none') {
        parentElm.className += ' introjs-fixParent';
      }

      parentElm = parentElm.parentNode;
    }

    if (!_elementInViewport(targetElement.element) && this._options.scrollToElement === true) {
      var rect = targetElement.element.getBoundingClientRect(),
        winHeight = _getWinSize().height,
        top = rect.bottom - (rect.bottom - rect.top),
        bottom = rect.bottom - winHeight;

      //Scroll up
      if (top < 0 || targetElement.element.clientHeight > winHeight) {
        window.scrollBy(0, top - 30); // 30px padding from edge to look nice

      //Scroll down
      } else {
        window.scrollBy(0, bottom + 100); // 70px + 30px padding from edge to look nice
      }
    }

    if (typeof (this._introAfterChangeCallback) !== 'undefined') {
      this._introAfterChangeCallback.call(this, targetElement.element);
    }
  }

  /**
   * Get an element CSS property on the page
   * Thanks to JavaScript Kit: http://www.javascriptkit.com/dhtmltutors/dhtmlcascade4.shtml
   *
   * @api private
   * @method _getPropValue
   * @param {Object} element
   * @param {String} propName
   * @returns Element's property value
   */
  function _getPropValue (element, propName) {
    var propValue = '';
    if (element.currentStyle) { //IE
      propValue = element.currentStyle[propName];
    } else if (document.defaultView && document.defaultView.getComputedStyle) { //Others
      propValue = document.defaultView.getComputedStyle(element, null).getPropertyValue(propName);
    }

    //Prevent exception in IE
    if (propValue && propValue.toLowerCase) {
      return propValue.toLowerCase();
    } else {
      return propValue;
    }
  }

  /**
   * Provides a cross-browser way to get the screen dimensions
   * via: http://stackoverflow.com/questions/5864467/internet-explorer-innerheight
   *
   * @api private
   * @method _getWinSize
   * @returns {Object} width and height attributes
   */
  function _getWinSize() {
    if (window.innerWidth != undefined) {
      return { width: window.innerWidth, height: window.innerHeight };
    } else {
      var D = document.documentElement;
      return { width: D.clientWidth, height: D.clientHeight };
    }
  }

  /**
   * Add overlay layer to the page
   * http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport
   *
   * @api private
   * @method _elementInViewport
   * @param {Object} el
   */
  function _elementInViewport(el) {
    var rect = el.getBoundingClientRect();

    return (
      rect.top >= 0 &&
      rect.left >= 0 &&
      (rect.bottom+80) <= window.innerHeight && // add 80 to get the text right
      rect.right <= window.innerWidth
    );
  }

  /**
   * Add overlay layer to the page
   *
   * @api private
   * @method _addOverlayLayer
   * @param {Object} targetElm
   */
  function _addOverlayLayer(targetElm) {
    var overlayLayer = document.createElement('div'),
        styleText = '',
        self = this;

    //set css class name
    overlayLayer.className = 'introjs-overlay';

    //check if the target element is body, we should calculate the size of overlay layer in a better way
    if (targetElm.tagName.toLowerCase() === 'body') {
      styleText += 'top: 0;bottom: 0; left: 0;right: 0;position: fixed;';
      overlayLayer.setAttribute('style', styleText);
    } else {
      //set overlay layer position
      var elementPosition = _getOffset(targetElm);
      if (elementPosition) {
        styleText += 'width: ' + elementPosition.width + 'px; height:' + elementPosition.height + 'px; top:' + elementPosition.top + 'px;left: ' + elementPosition.left + 'px;';
        overlayLayer.setAttribute('style', styleText);
      }
    }

    targetElm.appendChild(overlayLayer);

    overlayLayer.onclick = function() {
      if (self._options.exitOnOverlayClick == true) {
        _exitIntro.call(self, targetElm);

        //check if any callback is defined
        if (self._introExitCallback != undefined) {
          self._introExitCallback.call(self);
        }
      }
    };

    return true;
  }
  function _showOverlayLayer() {
  	var overlayLayer = this._targetElement.querySelector('.introjs-overlay'), styleText = '', self = this;
    //check if the target element is body, we should calculate the size of overlay layer in a better way
    if (self._targetElement.tagName.toLowerCase() === 'body') {
      styleText += 'top: 0;bottom: 0; left: 0;right: 0;position: fixed;';
      overlayLayer.setAttribute('style', styleText);
    } else {
      //set overlay layer position
      var elementPosition = _getOffset(self._targetElement);
      if (elementPosition) {
        styleText += 'width: ' + elementPosition.width + 'px; height:' + elementPosition.height + 'px; top:' + elementPosition.top + 'px;left: ' + elementPosition.left + 'px;';
        overlayLayer.setAttribute('style', styleText);
      }
    }
		styleText += 'opacity: ' + self._options.overlayOpacity.toString()+';';
		overlayLayer.setAttribute('style', styleText);
    return true;
  }

  /**
   * Get an element position on the page
   * Thanks to `meouw`: http://stackoverflow.com/a/442474/375966
   *
   * @api private
   * @method _getOffset
   * @param {Object} element
   * @returns Element's position info
   */
  function _getOffset(element) {
    var elementPosition = {};

    //set width
    elementPosition.width = element.offsetWidth;

    //set height
    elementPosition.height = element.offsetHeight;

    //calculate element top and left
    var _x = 0;
    var _y = 0;
    while (element && !isNaN(element.offsetLeft) && !isNaN(element.offsetTop)) {
      _x += element.offsetLeft;
      _y += element.offsetTop;
      element = element.offsetParent;
    }
    //set top
    elementPosition.top = _y;
    //set left
    elementPosition.left = _x;

    return elementPosition;
  }

  /**
   * Gets the current progress percentage
   *
   * @api private
   * @method _getProgress
   * @returns current progress percentage
   */
  function _getProgress() {
    // Steps are 0 indexed
    var currentStep = parseInt((this._currentStep + 1), 10);
    return ((currentStep / this._introItems.length) * 100);
  }

  /**
   * Overwrites obj1's values with obj2's and adds obj2's if non existent in obj1
   * via: http://stackoverflow.com/questions/171251/how-can-i-merge-properties-of-two-javascript-objects-dynamically
   *
   * @param obj1
   * @param obj2
   * @returns obj3 a new object based on obj1 and obj2
   */
  function _mergeOptions(obj1,obj2) {
    var obj3 = {};
    for (var attrname in obj1) { obj3[attrname] = obj1[attrname]; }
    for (var attrname in obj2) { obj3[attrname] = obj2[attrname]; }
    return obj3;
  }

  var introJs = function (targetElm) {
    if (typeof targetElm === 'object') {
      //Ok, create a new instance
      return new IntroJs(targetElm);
    } else if (typeof targetElm === 'string') {
      //select the target element with query selector
      var targetElement = document.querySelector(targetElm);
      if (targetElement) {
        return new IntroJs(targetElement);
      } else {
        throw new Error('There is no element with given selector.');
      }
    } else {
      return new IntroJs(document.body);
    }
  };

  /**
   * Current IntroJs version
   *
   * @property version
   * @type String
   */
  introJs.version = VERSION;

  //Prototype
  introJs.fn = IntroJs.prototype = {
    clone: function () {
      return new IntroJs(this);
    },
    setOption: function(option, value) {
      this._options[option] = value;
      return this;
    },
    setOptions: function(options) {
      this._options = _mergeOptions(this._options, options);
      return this;
    },
    start: function () {
      _introForElement.call(this, this._targetElement);
      return this;
    },
    goToStep: function(step) {
      _goToStep.call(this, step);
      return this;
    },
    nextStep: function() {
      _nextStep.call(this);
      return this;
    },
    previousStep: function() {
      _previousStep.call(this);
      return this;
    },
    exit: function() {
      _exitIntro.call(this, this._targetElement);
      return this;
    },
    refresh: function() {
      _setHelperLayerPosition.call(this, document.querySelector('.introjs-helperLayer'));
      _setHelperLayerPosition.call(this, document.querySelector('.introjs-tooltipReferenceLayer'));
      return this;
    },
    onfilter: function(providedCallback) {
      if(typeof (providedCallback) === 'function') {
        this._introFilterCallback = providedCallback;
      } else {
        throw new Error('Provided callback for onfilter was not a function');
      }
      return this;
    },
    onbeforechange: function(providedCallback) {
      if (typeof (providedCallback) === 'function') {
        this._introBeforeChangeCallback = providedCallback;
      } else {
        throw new Error('Provided callback for onbeforechange was not a function');
      }
      return this;
    },
    onchange: function(providedCallback) {
      if (typeof (providedCallback) === 'function') {
        this._introChangeCallback = providedCallback;
      } else {
        throw new Error('Provided callback for onchange was not a function.');
      }
      return this;
    },
    onafterchange: function(providedCallback) {
      if (typeof (providedCallback) === 'function') {
        this._introAfterChangeCallback = providedCallback;
      } else {
        throw new Error('Provided callback for onafterchange was not a function');
      }
      return this;
    },
    oncomplete: function(providedCallback) {
      if (typeof (providedCallback) === 'function') {
        this._introCompleteCallback = providedCallback;
      } else {
        throw new Error('Provided callback for oncomplete was not a function.');
      }
      return this;
    },
    onexit: function(providedCallback) {
      if (typeof (providedCallback) === 'function') {
        this._introExitCallback = providedCallback;
      } else {
        throw new Error('Provided callback for onexit was not a function.');
      }
      return this;
    }
  };

  exports.introJs = introJs;
  return introJs;
}));


/*! XXSPubSub | @tdecs | Released under MIT license */
(function(d){var e={};d.send=function(a,b){for(var c=e[a]||[],f=c.length;f--;)c[f].apply(d,b||[])};d.on=function(a,b){(e[a]=e[a]||[]).push(b);return[a,b]};d.off=function(a){for(var b=e[a[0]],c=b.length;c--;)b[c]===a[1]&&b.splice(c,1)}})(va.ev={});

function extend(target, source) {
	if(source) {
		for(var prop in source) {
			if(source.hasOwnProperty(prop)) {
				target[prop] = source[prop];
			}
		}
	}
	return target;
}

function hasclass(a,b) {
	return new RegExp('\\b'+b+'\\b').test(a.className);
}
function swapclass(a,b,c) {
	var cn=o.className;
	o.className=!hasclass(a,b)?cn.replace(c,b):cn.replace(b,c);
}
function addclass(a,b) {
	var cn=a.className;
	a.className=!hasclass(a,b)?cn+=" "+b:cn;
}
function removeclass(a,b) {
	if(hasclass(a, b)) {
		var reg = new RegExp('(\\s|^)' + b + '(\\s|$)');
		a.className = a.className.replace(reg, ' ');
	}
}
extend(window, {hasclass:hasclass,swapclass:swapclass,addclass:addclass,removeclass:removeclass});

function mAjax(B,A){this.bindFunction=function(E,D){return function(){return E.apply(D,[D])}};this.stateChange=function(D){if(this.request.readyState==4){this.callbackFunction(this.request.responseText)}};this.getRequest=function(){if(window.ActiveXObject){return new ActiveXObject("Microsoft.XMLHTTP")}else{if(window.XMLHttpRequest){return new XMLHttpRequest()}}return false};this.postBody=(arguments[2]||"");this.callbackFunction=A;this.url=B;this.request=this.getRequest();if(this.request){var C=this.request;C.onreadystatechange=this.bindFunction(this.stateChange,this);if(this.postBody!==""){C.open("POST",B,true);C.setRequestHeader("X-Requested-With","XMLHttpRequest");C.setRequestHeader("Content-type","application/x-www-form-urlencoded");C.setRequestHeader("Connection","close")}else{C.open("GET",B,true)}C.send(this.postBody)}};

function norm_rect(a) {
	return a["width"]?a:extend({bottom:a.bottom,left:a.left,right:a.right,top:a.top},{width:a.right-a.left,height:a.bottom-a.top});
}

function norm_delta(e) {
	var evt=window.event || e;
	return evt.detail ? evt.detail < 0 ? 1 : -1 : evt.wheelDelta < 0 ? 1 : -1;
}

function _getOffset(element) {
	var elementPosition = {}, pos;
  pos = element.getBoundingClientRect();
	elementPosition.width = element.offsetWidth;
	elementPosition.height = element.offsetHeight;
  elementPosition.top = element.getBoundingClientRect().y;
	elementPosition.left = element.getBoundingClientRect().x;
	/*var _x = 0, _y = 0;
	while(element && !isNaN(element.offsetLeft) && !isNaN(element.offsetTop)) {
		_x += element.offsetLeft;
		_y += element.offsetTop;
		element = element.offsetParent;
	}
	elementPosition.top = _y;
	elementPosition.left = _x;*/
	return elementPosition;
}

function ucwords(str) {
	return (str + '').replace(/^([a-z\u00E0-\u00FC])|\s+([a-z\u00E0-\u00FC])/g, function($1) {return $1.toUpperCase()});
}
String.prototype.stripSlashes = function(){return this.replace(/\\(.)/mg, "$1")};

function setgfont(font) {
	var family = font.replace(" ", "+");
	var style_sheet = '<link href="//fonts.googleapis.com/css?family=' + family + '&v2" rel="stylesheet" type="text/css" />';
	var style_inline = '<style type="text/css">#vertex_fprev{font-family:\'' + font + '\';font-size:18px;}</style>';
	var preview = document.getElementById("vertex_fprev");
	if(preview) {
		preview.innerHTML = "This is a preview of your chosen font.";
		preview.innerHTML += style_sheet+style_inline;
	}
}

function selectText(element) {
	var doc = document;
	var text = typeof element == "string" ? doc.getElementById(element) : element;
	if(doc.body.createTextRange) {
		// ms
		var range = doc.body.createTextRange();
		range.moveToElementText(text);
		range.select();
	} else if(window.getSelection) {
		// moz, opera, webkit
		var selection = window.getSelection();
		var range = doc.createRange();
		range.selectNodeContents(text);
		selection.removeAllRanges();
		selection.addRange(range);
	}
}

function compile(data) {
	if(!data || !typeof data == "object") return "";
	var h = "";
	switch(data.type) {
		case "ranger":
		var range = document.createElement("div");
		range.className = "slider-wrap bgcolor13";
		range.innerHTML = '<div class="slider" id="slider'+data.name+'"><div class="thumb"></div></div><div class="v2-sd-wrap ns"></div><div class="v2-sd-error ns"></div>';
		return range;
	}
	return h;
}

(function() {
	function getIEVersion() {
		var ua = window.navigator.userAgent, msie = ua.indexOf('MSIE '), trident = ua.indexOf('Trident/');
		if(msie > 0) {
			// IE 10 or older => return version number
			return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
		} else if(trident > 0) {
			// IE 11 (or newer) => return version number
			var rv = ua.indexOf('rv:');
			return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
		} else {
			return NaN;
		}
	}
	var ieVersion = getIEVersion();
	if(!isNaN(ieVersion)) {
		// if it is IE
		var minVersion = 6, maxVersion = 13; // adjust this appropriately
		if(ieVersion >= minVersion && ieVersion <= maxVersion) {
			var htmlElem = document.getElementsByTagName('html').item(0), addHtmlClass = function(className) {
				// define function to add class to 'html' element
				htmlElem.className += ' ' + className;
			};
			addHtmlClass('ie' + ieVersion); // add current version
			addHtmlClass('lte-ie' + ieVersion);
		}
	}
})();//var va = {fn:{}};
VG = {
  openui: [],
  closeui: function() {
    for(var i = 0; i < this.openui.length; i++) {
      this.openui[i].hide();
    }
  },
  tour_core: null,
  tour: function() {
    //if(this.tour_core) return this.tour_core;
    this.tour_core = new introJs();
    this.tour_core.onfilter(function(n) {
      if(VG.model) {
        var ap = VG.model.activePage(), nd = va.ko.dataFor(n);
        if(ap.tabid == nd.tabid && ap.subNavOpen() && ap.subNavOpen() == nd.page) return true;
      }
      return false;
    });
    return this.tour_core;
  },
  tourStart: function() {
    VG.tour().start();
  },
  tourCount: function() {
    if(VG.model) {
      var ap = VG.model.activePage();
      if(ap&&ap.tabid) return VG.tc[ap.tabid][ap.subNavOpen()];
    }
    return 0;
  },
  tc: {},
  model: null,
  lang: {},
  current: {},
  bName: function(v) {
    return v.replace(/vertex\[(.*)\]/, "$1");
  },
  vName: function(v) {
    return "vertex["+v+"]";
  },
  setValueFor: function(k, v) {
    var f; //bn = this.bName(k);
    var f = this.findInner([k], this.model.modules());
    if(f) va.ko.utils.arrayForEach(f, function(a) {
      a.value(v);
    });
    f = null;
  },
  setValuesFor: function(k, v) {
    var li = [];
    var f = this.findInner(k, this.model.modules());
    if(f) va.ko.utils.arrayForEach(f, function(a) {
      a.value(v);
    });
    f = null;
  },
  getValueFor: function(k) {
    var f; //bn = this.bName(k);
    var f = this.findInner([k], this.model.modules());
    if(f&&f[0]) return f[0].value();
    f = null;
  },
  showField: function(k, v){
    var f = this.findInner([k], this.model.modules());
    if(f) va.ko.utils.arrayForEach(f, function(a) {
      a.visible(v);
    });
    f = null;
  },
  findInner: function(names, mods, clist) {
    var ins = this;
    clist = clist || [];
    va.ko.utils.arrayForEach(mods, function(a) {
      if(names.indexOf(a.name) > -1) clist.push(a);
      if(a.modules) {
        va.ko.utils.arrayForEach(a.modules(), function(b) {
          if(names.indexOf(b.name) > -1) clist.push(b);
          if(typeof b.modules == "function") clist = ins.findInner(names, b.modules(), clist);
          if(typeof b.widgets == "function") clist = ins.findInner(names, b.widgets(), clist);
        });
      }
      if(a.widgets) {
        va.ko.utils.arrayForEach(a.widgets(), function(b) {
          if(names.indexOf(b.name) > -1) clist.push(b);
          if(typeof b.modules == "function") clist = ins.findInner(names, b.modules(), clist);
          if(typeof b.widgets == "function") clist = ins.findInner(names, b.widgets(), clist);
        });
      }
      if(a.popup) {
        va.ko.utils.arrayForEach(a.popup.fields(), function(b) {
          if(names.indexOf(b.name) > -1) clist.push(b);
        });
      }
    });
    return clist;
  },
  Lang: function(a) {
    if(!a) return "";
    var args = null;
    if(a.match(":") && !a.match("style=")) {
      args = a.split(":")[1].split(",");
      a = a.split(":")[0];
    }
    return (a.match("TPL") && this.lang[a] ? this.lang[a].replace(/&lt;/g, "<").replace(/&gt;/g, ">") : a).replace(/[_]/g, " ").replace(/&amp;/g, "&").format(args);
  },
  img_path: ""
};(function() {
  var Colors = new function() {
    this.ColorFromHSV = function(hue, sat, val) {
      var color = new Color();
      color.SetHSV(hue, sat, val);
      return color;
    };
    this.ColorFromRGB = function(r, g, b) {
      var color = new Color();
      color.SetRGB(r, g, b);
      return color;
    };
    this.ColorFromHex = function(hexStr) {
      var color = new Color();
      color.SetHexString(hexStr);
      return color;
    };
    function Color() {
      //Stored as values between 0 and 1
      var red = 0;
      var green = 0;
      var blue = 0;
      //Stored as values between 0 and 360
      var hue = 0;
      //Strored as values between 0 and 1
      var saturation = 0;
      var value = 0;
      this.SetRGB = function(r, g, b) {
        if (isNaN(r) || isNaN(g) || isNaN(b)) return false;
        r = r / 255.0;
        red = r > 1 ? 1 : r < 0 ? 0 : r;
        g = g / 255.0;
        green = g > 1 ? 1 : g < 0 ? 0 : g;
        b = b / 255.0;
        blue = b > 1 ? 1 : b < 0 ? 0 : b;
        calculateHSV();
        return true;
      };
      this.Red = function() {
        return Math.round(red * 255);
      };
      this.Green = function() {
        return Math.round(green * 255);
      };
      this.Blue = function() {
        return Math.round(blue * 255);
      };
      this.SetHSV = function(h, s, v) {
        if (isNaN(h) || isNaN(s) || isNaN(v)) return false;
        hue = (h >= 360) ? 359.99 : (h < 0) ? 0 : h;
        saturation = (s > 1) ? 1 : (s < 0) ? 0 : s;
        value = (v > 1) ? 1 : (v < 0) ? 0 : v;
        calculateRGB();
        return true;
      };
      this.Hue = function() {
        return hue;
      };
      this.Saturation = function() {
        return saturation;
      };
      this.Value = function() {
        return value;
      };
      this.SetHexString = function(hexString) {
        if(hexString == null || typeof(hexString) != "string") return false;
        if(hexString.substr(0, 1) == '#') hexString = hexString.substr(1);
        if(hexString.length == 3) hexString = hexString+hexString;
				else if(hexString.length != 6) return false;
        var r = parseInt(hexString.substr(0, 2), 16);
        var g = parseInt(hexString.substr(2, 2), 16);
        var b = parseInt(hexString.substr(4, 2), 16);
        return this.SetRGB(r, g, b);
      };
      this.HexString = function() {
        var rStr = this.Red().toString(16);
        if (rStr.length == 1) rStr = '0' + rStr;
        var gStr = this.Green().toString(16);
        if (gStr.length == 1) gStr = '0' + gStr;
        var bStr = this.Blue().toString(16);
        if (bStr.length == 1) bStr = '0' + bStr;
        return ('#' + rStr + gStr + bStr).toUpperCase();
      };
      this.Complement = function() {
        var newHue = (hue >= 180) ? hue - 180 : hue + 180;
        var newVal = (value * (saturation - 1) + 1);
        var newSat = (value * saturation) / newVal;
        var newColor = new Color();
        newColor.SetHSV(newHue, newSat, newVal);
        return newColor;
      };
      function calculateHSV() {
        var max = Math.max(Math.max(red, green), blue);
        var min = Math.min(Math.min(red, green), blue);
        value = max;
        saturation = 0;
        if (max != 0) saturation = 1 - min / max;
        hue = 0;
        if (min == max) return;
        var delta = (max - min);
        if (red == max) hue = (green - blue) / delta;
        else if (green == max) hue = 2 + ((blue - red) / delta);
        else hue = 4 + ((red - green) / delta);
        hue = hue * 60;
        if (hue < 0) hue += 360;
      }
      function calculateRGB() {
        red = value;
        green = value;
        blue = value;
        if (value == 0 || saturation == 0) return;
        var tHue = (hue / 60);
        var i = Math.floor(tHue);
        var f = tHue - i;
        var p = value * (1 - saturation);
        var q = value * (1 - saturation * f);
        var t = value * (1 - saturation * (1 - f));
        switch (i) {
        case 0:
          red = value;
          green = t;
          blue = p;
          break;
        case 1:
          red = q;
          green = value;
          blue = p;
          break;
        case 2:
          red = p;
          green = value;
          blue = t;
          break;
        case 3:
          red = p;
          green = q;
          blue = value;
          break;
        case 4:
          red = t;
          green = p;
          blue = value;
          break;
        default:
          red = value;
          green = p;
          blue = q;
          break;
        }
      }
    }
  }();
  function Position(x, y) {
    this.X = x;
    this.Y = y;
    this.Add = function(val) {
      var newPos = new Position(this.X, this.Y);
      if(val != null) {
        if (!isNaN(val.X)) newPos.X += val.X;
        if (!isNaN(val.Y)) newPos.Y += val.Y
      }
      return newPos;
    };
    this.Subtract = function(val) {
      var newPos = new Position(this.X, this.Y);
      if (val != null) {
        if (!isNaN(val.X)) newPos.X -= val.X;
        if (!isNaN(val.Y)) newPos.Y -= val.Y
      }
      return newPos;
    };
    this.Min = function(val) {
      var newPos = new Position(this.X, this.Y);
      if (val == null) return newPos;
      if (!isNaN(val.X) && this.X > val.X) newPos.X = val.X;
      if (!isNaN(val.Y) && this.Y > val.Y) newPos.Y = val.Y;
      return newPos;
    };
    this.Max = function(val) {
      var newPos = new Position(this.X, this.Y);
      if (val == null) return newPos;
      if (!isNaN(val.X) && this.X < val.X) newPos.X = val.X;
      if (!isNaN(val.Y) && this.Y < val.Y) newPos.Y = val.Y;
      return newPos;
    };
    this.Bound = function(lower, upper) {
      var newPos = this.Max(lower);
      return newPos.Min(upper);
    };
    this.Check = function() {
      var newPos = new Position(this.X, this.Y);
      if (isNaN(newPos.X)) newPos.X = 0;
      if (isNaN(newPos.Y)) newPos.Y = 0;
      return newPos;
    };
    this.Apply = function(element) {
      if (typeof(element) == "string") element = document.getElementById(element);
      if (element == null) return;
      if (!isNaN(this.X)) element.style.left = this.X + 'px';
      if (!isNaN(this.Y)) element.style.top = this.Y + 'px';
    };
  }
  var pointerOffset = new Position(0, navigator.userAgent.indexOf("Firefox") >= 0 ? 1 : 0);
  var circleOffset = new Position(5, 5);
  var arrowsOffset = new Position(0, 4);
  var arrowsLowBounds = new Position(0, -5);
  var arrowsUpBounds = new Position(0, 130);
  var circleLowBounds = new Position(-5, -5);
  var circleUpBounds = new Position(129, 129);
  function correctOffset(pos, offset, neg) {
    if (neg) return pos.Subtract(offset);
    return pos.Add(offset);
  }
  function getMousePos(e) {
    e = e ? e : window.event;
    var pos;
    if(e.offsetX) pos = new Position(e.offsetX, e.offsetY);
    else pos = new Position(e.layerX, e.layerY);
    return correctOffset(pos, pointerOffset, true);
  }
  function getEventTarget(e) {
    e = e ? e : window.event;
    return e.target ? e.target : e.srcElement;
  }
  function getRelativeCoords(event) {
    if (event.offsetX !== undefined && event.offsetY !== undefined) { return { x: event.offsetX, y: event.offsetY }; }
    return { x: event.layerX, y: event.layerY };
  }
  function XY(o) {
    var z=o, x=0,y=0, c;
    while(z && !isNaN(z.offsetLeft) && !isNaN(z.offsetTop)) {
      c = isNaN(window.globalStorage)?0:window.getComputedStyle(z,null);
      x += z.offsetLeft-z.scrollLeft+(c?parseInt(c.getPropertyValue('border-left-width'),10):0);
      y += z.offsetTop-z.scrollTop+(c?parseInt(c.getPropertyValue('border-top-width'),10):0);
      z = z.offsetParent;
    }
    return {x:o.X=x,y:o.Y=y};
  }
  function absoluteCursorPostion(e) {
    e = e ? e : window.event, f = getRelativeCoords(e);
    return new Position(e.clientX, e.clientY);
  }
  function dragObject(element, attachElement, lowerBound, upperBound, startCallback, moveCallback, endCallback, attachLater) {
    if (typeof(element) == "string") element = document.getElementById(element);
    if (element == null) return;
    if (lowerBound != null && upperBound != null) {
      var temp = lowerBound.Min(upperBound);
      upperBound = lowerBound.Max(upperBound);
      lowerBound = temp;
    }
    var cursorStartPos = null;
    var elementStartPos = null;
    var dragging = false;
    var listening = false;
    var disposed = false;
    function dragStart(e) {
      if (dragging || !listening || disposed) return;
      dragging = true;
      if (startCallback != null) startCallback(e, element);
      cursorStartPos = absoluteCursorPostion(e);
      elementStartPos = new Position(parseInt(element.style.left), parseInt(element.style.top));
      elementStartPos = elementStartPos.Check();
      Gator(document).on("mousemove", dragGo);
      Gator(document).on("mouseup", dragStopHook);
      return false;
    }
    function dragGo(e) {
      if(!dragging || disposed) return;
      var newPos = absoluteCursorPostion(e);
      newPos = newPos.Add(elementStartPos).Subtract(cursorStartPos);
      newPos = newPos.Bound(lowerBound, upperBound);
      newPos.Apply(element);
      if (moveCallback != null) moveCallback(newPos, element);
      return false;
    }
    function dragStopHook(e) {
      dragStop();
      return false;
    }
    function dragStop() {
      if (!dragging || disposed) return;
      Gator(document).off("mousemove");
      Gator(document).off("mouseup");
      cursorStartPos = null;
      elementStartPos = null;
      if (endCallback != null) endCallback(element);
      dragging = false;
    }
    this.Dispose = function() {
      if (disposed) return;
      this.StopListening(true);
      element = null;
      attachElement = null;
      lowerBound = null;
      upperBound = null;
      startCallback = null;
      moveCallback = null;
      endCallback = null;
      disposed = true;
    };
    this.StartListening = function() {
      if (listening || disposed) return;
      listening = true;
      Gator(attachElement).on("mousedown", dragStart);
    };
    this.StopListening = function(stopCurrentDragging) {
      if (!listening || disposed) return;
      Gator(attachElement).off("mousedown");
      listening = false;
      if (stopCurrentDragging && dragging) dragStop();
    };
    this.IsDragging = function() {
      return dragging;
    };
    this.IsListening = function() {
      return listening;
    };
    this.IsDisposed = function() {
      return disposed;
    };
    if (typeof(attachElement) == "string") attachElement = document.getElementById(attachElement);
    if (attachElement == null) attachElement = element;
    if (!attachLater) this.StartListening();
  }
  function arrowsDown(e, arrows) {
    var pos = getMousePos(e);
    if (getEventTarget(e) == arrows) pos.Y += parseInt(arrows.style.top);
    pos = correctOffset(pos, arrowsOffset, true);
    pos = pos.Bound(arrowsLowBounds, arrowsUpBounds);
    pos.Apply(arrows);
    arrowsMoved(pos);
  }
  function circleDown(e, circle) {
    var pos = getMousePos(e);
    if (getEventTarget(e) == circle) {
      pos.X += parseInt(circle.style.left);
      pos.Y += parseInt(circle.style.top);
    }
    pos = correctOffset(pos, circleOffset, true);
    pos = pos.Bound(circleLowBounds, circleUpBounds);
    pos.Apply(circle);
    circleMoved(pos);
  }
  function arrowsMoved(pos, element) {
    pos = correctOffset(pos, arrowsOffset, false);
    currentColor.SetHSV((134 - pos.Y) * 359.99 / 134, currentColor.Saturation(), currentColor.Value());
    colorChanged("arrows");
  }
  function circleMoved(pos, element) {
    pos = correctOffset(pos, circleOffset, false);
    currentColor.SetHSV(currentColor.Hue(), 1 - pos.Y / 134.0, pos.X / 134.0);
    colorChanged("circle");
  }
  var main, box, arrows, circle, gradientImg, hex, red, green, blue, hue, sat, val, color, prevcolor, currentColor, changeCallback, ct;

  function colorChanged(source) {
    var cc = currentColor.HexString();
    if(cc.substr(0, 1) == '#') cc = cc.substr(1);
    if(source != "key") hex.value = cc;
    red.value = currentColor.Red();
    green.value = currentColor.Green();
    blue.value = currentColor.Blue();
    hue.value = Math.round(currentColor.Hue());
    var str = (currentColor.Saturation() * 100).toString();
    if (str.length > 4) str = str.substr(0, 4);
    sat.value = str;
    str = (currentColor.Value() * 100).toString();
    if (str.length > 4) str = str.substr(0, 4);
    val.value = str;
    if (source == "arrows" || source == "box") box.style.backgroundColor = Colors.ColorFromHSV(currentColor.Hue(), 1, 1).HexString();
    if (source == "box" || source == "key") {
      arrows.style.top = (134 - currentColor.Hue() * 134 / 359.99 - arrowsOffset.Y) + 'px';
      var pos = new Position(currentColor.Value() * 134, (1 - currentColor.Saturation()) * 134);
      pos = correctOffset(pos, circleOffset, true);
      pos.Apply(circle);
      endMovement();
    }
    color.style.backgroundColor = currentColor.HexString();
    if(changeCallback&&typeof changeCallback=="function") changeCallback(currentColor.HexString());
  }
  function endMovement() {
    prevcolor.style.backgroundColor = currentColor.HexString();
  }
  function fixHex(a) {
    var b = 6 - a.length;
    if (b > 0) {
      var o = [];
      for (var i = 0; i < b; i++) {
        o.push('0')
      }
      o.push(a);
      a = o.reverse().join('')
    }
    return a
  }
  function hexBoxChanged(e) {
    currentColor.SetHexString(fixHex(hex.value));
    if(e.type == "keyup") colorChanged("key");
    else colorChanged("box");
    return false;
  }
  function redBoxChanged(e) {
  	if(e.type=="change") {
  		currentColor.SetRGB(parseInt(this.value), currentColor.Green(), currentColor.Blue());
  		return false;
  	}
  	if(e.stopPropagation) e.stopPropagation();
  	if(e.preventDefault) e.preventDefault();
  	var delta = norm_delta(e);
  	delta = currentColor.Red() + delta;
    currentColor.SetRGB(delta, currentColor.Green(), currentColor.Blue());
    colorChanged("box");
    return false;
  }
  function greenBoxChanged(e) {
  	if(e.type=="change") {
  		currentColor.SetRGB(currentColor.Red(), parseInt(this.value), currentColor.Blue());
  		return false;
  	}
  	if(e.stopPropagation) e.stopPropagation();
  	if(e.preventDefault) e.preventDefault();
  	var delta = norm_delta(e);
  	delta = currentColor.Green() + delta;
    currentColor.SetRGB(currentColor.Red(), delta, currentColor.Blue());
    colorChanged("box");
    return false;
  }
  function blueBoxChanged(e) {
  	if(e.type=="change") {
  		currentColor.SetRGB(currentColor.Red(), currentColor.Green(), parseInt(this.value));
  		return false;
  	}
  	if(e.stopPropagation) e.stopPropagation();
  	if(e.preventDefault) e.preventDefault();
  	var delta = norm_delta(e);
  	delta = currentColor.Blue() + delta;
    currentColor.SetRGB(currentColor.Red(), currentColor.Green(), delta);
    colorChanged("box");
    return false;
  }
  function hueBoxChanged(e) {
  	if(e.type=="change") {
  		currentColor.SetHSV(parseInt(this.value),  currentColor.Saturation(), currentColor.Value());
  		return false;
  	}
  	if(e.stopPropagation) e.stopPropagation();
  	if(e.preventDefault) e.preventDefault();
  	var delta = norm_delta(e);
  	delta = currentColor.Hue() + delta;
    currentColor.SetHSV(delta, currentColor.Saturation(), currentColor.Value());
    colorChanged("box");
    return false;
  }
  function saturationBoxChanged(e) {
  	if(e.type=="change") {
  		currentColor.SetHSV(currentColor.Hue(),  parseInt(this.value), currentColor.Value());
  		return false;
  	}
  	if(e.stopPropagation) e.stopPropagation();
  	if(e.preventDefault) e.preventDefault();
  	var delta = norm_delta(e);
  	delta = currentColor.Saturation() + ((delta == 1 ? 0.5 : -0.5) / 100.0);
    currentColor.SetHSV(currentColor.Hue(), delta, currentColor.Value());
    colorChanged("box");
    return false;
  }
  function valueBoxChanged(e) {
  	if(e.type=="change") {
  		currentColor.SetHSV(currentColor.Hue(), currentColor.Saturation(), parseInt(this.value));
  		return false;
  	}
  	if(e.stopPropagation) e.stopPropagation();
  	if(e.preventDefault) e.preventDefault();
  	var delta = norm_delta(e);
  	delta = currentColor.Value() + ((delta == 1 ? 0.5 : -0.5) / 100.0);
    currentColor.SetHSV(currentColor.Hue(), currentColor.Saturation(), delta);
    colorChanged("box");
    return false;
  }
  function fixPNG(myImage) {
    if (!document.body.filters) return;
    var arVersion = navigator.appVersion.split("MSIE");
    var version = parseFloat(arVersion[1]);
    if (version < 5.5 || version >= 7) return;
    var imgID = (myImage.id) ? "id='" + myImage.id + "' " : "";
    var imgStyle = "display:inline-block;" + myImage.style.cssText;
    var strNewHTML = '<span ' + imgID + ' style="width:' + myImage.width + 'px; height:' + myImage.height + 'px;' + imgStyle + ';filter:progid:DXImageTransform.Microsoft.AlphaImageLoader' + '(src="' + myImage.src + '", sizingMethod=\'scale\');"></span>';
    myImage.outerHTML = strNewHTML
  }
  function fixGradientImg() {
    fixPNG(gradientImg);
  }
  function hideBox() {
  	if(ct) {
  		clearTimeout(ct);
  		ct=null;
  	}
  	main.className = "cp";
  	ct = setTimeout(function(){
  		document.body.appendChild(main);
  	},300);
  	changeCallback = null;
  }
	function attachPicker(e, trigger, input, rect, cb) {
		if(!main) setup(VG.img_path);
		if(ct) {
  		clearTimeout(ct);
  		ct=null;
  	}
		trigger.parentNode.appendChild(main);
		setTimeout(function(){
			main.className = "cp sh";
      currentColor.SetHexString(Colors.ColorFromHex(input.value).HexString());
      colorChanged("box");
		},100);
		if(cb) changeCallback = cb;
	}
	function setup(path) {
		var tmpl = '<div id="vcp" class="cp"><div class="grad"><img class="grad-img" src="PATH/cp_gradient.png" /><img class="grad-cur" src="PATH/cp_circle.gif" /></div><div class="hue" id="hueBarDiv"><img class="hue-img" src="PATH/cp_bar.png" /><img class="hue-cur" src="PATH/cp_arrows.gif" /></div><div class="data"><div class="pncolor"><div id="quickColor"></div><div id="staticColor"></div></div><table><tr><td colspan="3"><input style="" type="text" id="hexBox" /></td></tr><tr><td>R<input size="2" type="text" id="redBox" /></td><td>G<input size="2" type="text" id="greenBox"/></td><td>B<input size="2" type="text" id="blueBox"/></td></tr><tr><td>H<input size="2" type="text" id="hueBox" /></td><td>S<input size="2" type="text" id="saturationBox" /></td><td>V<input size="2" type="text" id="valueBox" /></td></tr></table></div></div>'.replace(/PATH/g, path);
		document.body.innerHTML += tmpl;
  	main = document.getElementById("vcp");
  	if(!main) return;
  	hideBox();
  	box = main.children[0],
  	gradientImg = box.children[0],
  	circle = box.children[1],
  	arrows = main.children[1].children[1],
  	hex = document.getElementById("hexBox"),
		red = document.getElementById("redBox"),
		green = document.getElementById("greenBox"),
		blue = document.getElementById("blueBox"),
		hue = document.getElementById("hueBox"),
		sat = document.getElementById("saturationBox"),
		val = document.getElementById("valueBox"),
		color = document.getElementById("quickColor"),
		prevcolor = document.getElementById("staticColor");

		Gator(main).on("mouseleave", hideBox);
  	Gator(hex).on("change", hexBoxChanged);
    Gator(hex).on("keyup", hexBoxChanged);
		Gator(red).on("mousewheel", redBoxChanged);
		Gator(green).on("mousewheel", greenBoxChanged);
		Gator(blue).on("mousewheel", blueBoxChanged);
		Gator(hue).on("mousewheel", hueBoxChanged);
		Gator(sat).on("mousewheel", saturationBoxChanged);
		Gator(val).on("mousewheel", valueBoxChanged);

  	fixGradientImg();
		currentColor = Colors.ColorFromRGB(0, 0, 0);
		new dragObject(arrows, "hueBarDiv", arrowsLowBounds, arrowsUpBounds, arrowsDown, arrowsMoved, endMovement);
		new dragObject(circle, box, circleLowBounds, circleUpBounds, circleDown, circleMoved, endMovement);
		colorChanged("box");
	}
	Gator(window).on("load", function(e) {
		if(!main) setup(VG.img_path);
	});
	va.ko.bindingHandlers.colorpicker = {
		init: function(element, valueAccessor, allBindings, viewModel, bindingContext) {
			var trigger = (element.previousElementSibling?element.previousElementSibling:va.lmnt.previousElementSibling(element));
			if(typeof trigger == "string") {
				trigger = trigger.toUpperCase();
				if(element.nodeName == trigger) {
					trigger = element;
				} else if(element.previousElementSibling.nodeName == trigger) {
					trigger = element.previousElementSibling;
				}
			}
			if(!trigger) return;
			var nh = (element.value.substr(0,1)=="#"?"#":null);
			if(trigger) trigger.style.backgroundColor = (nh?nh:"#")+(element.value?element.value:"fff");
			viewModel.value.subscribe(function(nv) {
				var tcb = changeCallback;
				changeCallback = null;
				if(nv.substr(0, 1) == "#") nv = nv.substr(1);
				nv = Colors.ColorFromHex(nv).HexString();
				currentColor.SetHexString(nv);
				if(trigger) trigger.style.backgroundColor = nv;
				colorChanged("key");
				changeCallback = tcb;
			});
			Gator(trigger).on("click", function(e) {
				attachPicker(e, this, element, norm_rect(this.getBoundingClientRect()), function(nc){
					element.value = (nh?nc:nc.substr(1));
          viewModel.value((nh?nc:nc.substr(1)));
					if(trigger) trigger.style.backgroundColor = nc;
				});
			});
			return { controlsDescendantBindings: false };
		}
	};
})();(function() {
	var Ranger = function(ele, opts) {
		var self = this, defaults = {
			onDragStart: new Function(),
			onDragEnd: new Function(),
			onDrag: new Function(),
			values: [0,0,0,0,0,0],
			hideLast: false,
			asFloat: false,
			onValues: new Function()
		}, defaults = extend(defaults, opts), load, zin = 1, count = 0, handles = [], edits = [], editing, handle, cx, width, thumb, thumbWidth, values, base, error, newVals;
		function RangerError(el) {
			return {el:el,show:function(m){
				if('textContent' in this.el) this.el.textContent = m;
				else this.el.innerText = m;
				this.el.className = "v2-sd-error ns on";
			},hide:function(){
				this.el.className = "v2-sd-error ns";
				if('textContent' in this.el) this.el.textContent = "";
				else this.el.innerText = "";
			}}
		}
		function Switch() {
			return {id:null,box:null,text:null,edit:null,add:function(id, change){
				var s = this, b = document.createElement('div');
				b.className = "v2-sd-wb ns";
				b.innerHTML = '<div class="ns"><span class="ns"></span><input class="re-in" /><div class="ns"></div></div>';
				b.style.width = defaults.values[id] + '%';
				b.style.display = "none";
				base.appendChild(b);
				s.id = id;
				s.box = b;
				s.text = b.children[0].children[0];
				s.edit = b.children[0].children[1];
				b.children[0].children[2].innerHTML = (defaults.prefix?defaults.prefix+(id+1):null)||"";
				if(defaults.hideLast && id > count) this.hide();
				else this.show();
				var up = function(e) {
					switch(e.type) {
						case "change":
						case "keydown":
						if(e.keyCode==13) return false;
						if(e.keyCode==9) {
							if(e.target.parentNode.parentNode.nextElementSibling) {
								e.target.parentNode.parentNode.nextElementSibling.children[0].children[1].focus();
								setTimeout(function(){
									selectText(e.target.parentNode.parentNode.nextElementSibling.children[0].children[1]);
								}, 50);
							} else {
								reload("edit");
							}
							return false;
						}
						if(parseFloat(e.target.value)) {
							defaults.values[s.id] = defaults.asFloat ? parseFloat(e.target.value) : parseInt(e.target.value);
							//return false;
						}
						break;
						/*case "mousewheel":
						case "DOMMouseScroll":
						//var delta = norm_delta(e);
						//console.log(e, delta);
						//e.target.value = parseInt(e.target.value) + delta;
						return false;
						break;*/
					}
				};
				var fun = function(e) {
					if(e.type=="focus") {
						Gator(s.edit).on("change", up);
						Gator(s.edit).on("keydown", up);
						//Gator(s.edit).on("keyup", up);
						gupdate(defaults.values);
						/*Gator(s.edit).on("mousewheel", up);*/
					} else {
						Gator(s.edit).off("change");
						Gator(s.edit).off("keydown");
						//Gator(s.edit).off("keyup");
						gupdate(defaults.values);
						/*unhookEvent(s.edit, "mousewheel", up);*/
					}
				};
				Gator(s.edit).on("focus", fun);
				Gator(s.edit).on("blur", fun);
				return s;
			},action:function(d){
				if(d) {
					this.edit.style.display = "none";
					this.text.style.display = "inline-block";
				} else {
					this.edit.style.display = "inline-block";
					this.text.style.display = "none";
				}
				return this;
			},set:function(d){
				this.box.style.width = (d!=0?d:0)+"%";
				if('textContent' in this.text) this.text.textContent = d + "%";
				else this.text.innerText = d + "%";
				this.edit.value = d;
				if(defaults.hideLast && this.id > count) this.hide();
				else {
					if(d==0) this.hide();
					else this.show();
				}
				return this;
			},hide:function(){
				this.box.style.display = "none";
				return this;
			},show:function(){
				this.box.style.display = "block";
				return this;
			}};
		}
		function Handle() {
			return {el:null,add:function(id) {
				var h = document.createElement('a');
				h.className = "thumb";
				ele.appendChild(h);
				h = ele.children[id];
				h.curX = values[id];
				Gator(h).on("mousedown", start);
				h.s_id = id;
				with(h.style) {
					left = (h.curX - (thumbWidth/2)) + "px";
					zIndex = zin++;
				}
				h.minX = 0;
				h.maxX = typeof ele != 'undefined' ? ele.offsetWidth : null;
				this.el = h;
				if(defaults.hideLast && (id + 1) > count) this.hide();
				else this.show();
				return this;
			},set:function(d) {
				this.el.curX = d;
				with(this.el.style) {
					left = (this.el.curX - (thumbWidth/2)) + "px";
				}
				this.el.minX = 0;
				this.el.maxX = typeof ele != 'undefined' ? ele.offsetWidth : null;
				if(defaults.hideLast && (this.el.s_id + 1) > count) this.hide();
				else this.show();
				return this;
			},hide:function(){
				this.el.style.display = "none";
				return this;
			},show:function(){
				this.el.style.display = "block";
				return this;
			}}
		}
		function start(e) {
			if(!e) e = window.event;
			var elem = handle = this;
			elem.style.zIndex = zin++;
			elem.className = "thumb hover";
			cx = parseFloat(elem.style.left);
			elem.lastMouseX = e.clientX;
			if(editing) reload("edit");
			if(elem.minX != null) elem.minMouseX = e.clientX - cx + elem.minX;
			if(elem.maxX != null) elem.maxMouseX = elem.minMouseX + elem.maxX - elem.minX;
			if(defaults.values.length > 1) {
				if(elem.s_id === 0) {
					var ch = ele.children[elem.s_id + 1];
					elem.maxMouseX = elem.minMouseX + parseFloat(ch.style.left);
					//elem.minMouseX -= offset;/
				} else if(elem.s_id == defaults.values.length - 1) {
					var ch = ele.children[elem.s_id - 1];
					elem.minMouseX = elem.minMouseX + parseFloat(ch.style.left);
				} else {
					var min = elem.minMouseX, ch = elem.previousSibling, ch2 = elem.nextSibling;
					elem.minMouseX = min + parseFloat(ch.style.left);
					elem.maxMouseX = min + parseFloat(ch2.style.left);
				}
			}
			defaults.onDragStart(calc());
			document.onmousemove = drag;
			document.onmouseup = end;
			return false;
		}
		function drag(e) {
			if(!e) e = window.event;
			var elem = handle;
			var ex = e.clientX;
			cx = parseFloat(elem.style.left);
			var nx, ny;
			if(elem.minX != null) ex = Math.max(ex, elem.minMouseX);
			if(elem.maxX != null) ex = Math.min(ex, elem.maxMouseX);
			nx = cx + (ex - elem.lastMouseX);
			handle.style.left = nx + "px";
			handle.lastMouseX = ex;
			update();
			defaults.onDrag(calc());
			return false;
		}
		function end() {
			document.onmousemove = null;
			document.onmouseup = null;
			defaults.onDragEnd(calc());
			handle.className = "thumb";
			handle = null;
		}
		function init(cb) {
			if(load) return;
			if(!ele.nextElementSibling) ele.nextElementSibling = va.lmnt.nextElementSibling(ele);
			thumb = ele.children[0],
			thumbWidth = thumb.offsetWidth,
			width = ele.parentNode.offsetWidth,
			base = ele.nextElementSibling;
			if(!base.nextElementSibling) base.nextElementSibling = va.lmnt.nextElementSibling(base);
			error = new RangerError(base.nextElementSibling),
			values = reverse(defaults.values),
			ele.removeChild(thumb);
			var i = 0;
			while(i < 6) {
				add(i);
				i++;
			}
			load = true;
			if(cb&&typeof cb=="function")cb();
		}
		function add(id) {
			var b = new Switch().add(id, reload);
			b.set(defaults.values[id]);
			edits.push(b);
			var h = new Handle().add(id);
			handles.push(h);
		}
		function calc(a) {
			if(!self || !ele) return 0;
			width = ele.offsetWidth;
			newVals = [];
			var c = ele.children, d = 0;
			for(var e = 0; e < count+1; e++) {
				if(!a && !defaults.asFloat) f = Math.round(100 * (parseFloat(c[e].style.left) + (thumbWidth/2)) / width) - d;
				else f = Math.ceil((100 * (parseFloat(c[e].style.left) + (thumbWidth/2)) / width - d)*10)/10;
				d += f;
				newVals[e] = parseFloat(f.toFixed(2));
			}
      if(d > 100.00) {
        while(d > 100.00) {
          d -= 0.1;
          newVals[newVals.length-1] -= 0.1;
        }
      }
			return newVals;
		}
		function reverse(a) {
			newVals = [];
			var c = 0, d = 0, e = width / 100;
			while(c < a.length) {
				d = (e * a[c]) + d;
				if(a[c]!=0) newVals[c] = d;
				else newVals[c] = 0;
				c++;
			}
			count = va.ko.utils.arrayFilter(newVals, function(i){return i!=0}).length-1;
			return newVals;
		}
		function update() {
			error.hide();
			var i = b = 0, c = calc();
			while(i < c.length) {
				if(!c[i]) c[i] = 0;
				edits[i].set(c[i]);
				b = b + c[i];
				i++;
			}
		}
		function allzero(a) {
			for(var i=0;i<a.length;i++)if(a[i]>0)return false;
			return true;
		}
		function gupdate(a) {
			width = ele.offsetWidth;
			defaults.values = a;
			values = reverse(a);
			var t = 0;
			for(var i=0;i<handles.length;i++) {
				t += a[i]?a[i]:0;
			}
			if(t>0&&Math.round(t)==100) {
				error.hide();
				for(var i=0;i<handles.length;i++) {
					handles[i].hide().set(values[i]);
					edits[i].hide().set(a[i]);
				}
			} else {
				if(t>0&&Math.round(t) < 100) {
					for(var i=0;i<handles.length;i++) {
						handles[i].hide().set(values[i]);
						edits[i].hide().set(a[i]);
					}
				}
				if(!allzero(a)) {
					disable(false);
					error.show("("+va.ko.utils.arrayMap(defaults.values, function(i){return i.toFixed(2)+"%"}).join(" + ")+") not eq 100%");
				} else {
					disable(true);
				}
			}
			defaults.onValues(calc(true));
		}
		function disable(a) {
			if(a) {
				ele.parentNode.style.display = "none";
				removeclass(ele.parentNode.parentNode.children[0], "active");
				addclass(ele.parentNode.parentNode.children[0], "noactive");
			} else {
				ele.parentNode.style.display = "block";
				removeclass(ele.parentNode.parentNode.children[0], "noactive");
				addclass(ele.parentNode.parentNode.children[0], "active");
			}
		}
		function reload(a) {
			if(typeof a == "string") {
				switch(a) {
					case "edit":
					for(var i=0;i<edits.length;i++) {
						edits[i].action(editing);
					}
					editing = editing?false:true;
					break;
					case "values":
					if(arguments[1]) {
						if(typeof arguments[1] == "string") {
							disable(true);
							gupdate([0,0,0,0,0,0]);
						} else if(arguments[1].length) {
							disable(false);
							gupdate(arguments[1]);
						}
					}
          va.ev.send("insetfix", []);
					break;
					case "refresh":
					thumb = ele.children[0],
					thumbWidth = thumb.offsetWidth,
					width = ele.offsetWidth,
					gupdate(defaults.values);
					break;
				}
			}
			return false;
		}
		function set(k,v) {
			if(defaults.hasOwnProperty(k)) defaults[k] = v;
		}
		function get(k) {
			if(defaults[k]) return defaults[k];
			return null;
		}
		init();
		return {reload:reload,set:set,get:get,init:init};
	};
  va.ko.bindingHandlers.ranger = {
    init: function(element, valueAccessor, allBindings, viewModel, bindingContext) {
      valueAccessor = valueAccessor();
      var el = compile(valueAccessor);
      element.parentNode.appendChild(el);
      addclass(element.parentNode, "mw alt");
      try {
      	var s = new Ranger(el.children[0], {
        values: valueAccessor.range,
        hideLast: true,
        prefix: ucwords(valueAccessor.name.replace(/vertex|manual_widths|s5_|calculation|\[|\]/g, "").replace(/_/g, " ").replace(/(\w+)(\d)/g, "$1 $2").replace(/(\d)\s(\d)/g, "$1-$2")),
        onDragEnd: function(val) {
        	element.value = val.join(",");
          VG.current[element.name.replace(/vertex|\[|\]/g, "")] = element.value;
        },
        onValues: function(val) {
          if(!val.length) return;
          //console.log("onValues", val);
          element.value = val.join(",");
          valueAccessor.value(val.join(","));
        }
      });
      } catch(e) {
      	console.log(e);
      }
			valueAccessor.ranger = s;
			valueAccessor.ranger.init(function(){
				if(valueAccessor.value()=="automatic"||valueAccessor.disabled()) {
					valueAccessor.disabled(true);
					valueAccessor.ranger.reload("values", "disable");
				}
			});
      var sb = va.ko.utils.arrayFirst(valueAccessor.modules(), function(m){return m.type=="options"});
			if(sb && sb.widget) {
      	var cnt = va.ko.utils.arrayFilter(s.get("values"), function(i){return i!=0}).length;
        //console.log(s.get("values"), cnt, valueAccessor.name);
				sb.widget.value(cnt ? cnt : "automatic");
      }
      return {controlsDescendantBindings: false};
    }
  };
})();(function(){
	function merge(set1, set2){
		for (var key in set2) {
			if (set2.hasOwnProperty(key)) set1[key] = set2[key]
		}
		return set1
	}
	function Select(model) {
		var support = (!("onwheel" in document || document.documentMode >= 9)) ? (document.onmousewheel !== undefined ? "mousewheel" : "DOMMouseScroll") : "wheel";
		var self = this, ismulti = null, fp;
		if(model.options) {
			if(!fp) fp = document.getElementById("vertex_fprev");
			if(!fp) {
				fp = document.createElement("div");
				fp.id = "vertex_fprev";
				document.body.appendChild(fp);
			}
			//if(typeof model.options == "string") model.options = va.ko.observableArray(vselects[model.options]||window[model.options]);
			if(model.attrs&&model.attrs.multiple) ismulti = true;
			model.count = model.des?model.options().length:50;
      model.morePrefix = "...";
			model.showSearch = va.ko.observable(model.attrs&&model.attrs.show_search?model.attrs.show_search:false);
			model.open = va.ko.observable(null);
			model.match = va.ko.observable("");
			model.multi = va.ko.observable(ismulti);
			if(ismulti) {
				model.current = va.ko.observable(model.value().split(","));
			} else {
				model.current = va.ko.observable(model.value());
			}
      model.isCurrent = function(d){
				if(ismulti) {
					return model.current().indexOf(d) > -1;
				}
				return d == model.current();
			};
			model.cloned_options = va.ko.observableArray([]);
			var all = model.options.slice(0), infc;
      model.label = va.ko.computed(function(){
				if(ismulti) {
					var a = va.ko.utils.arrayFilter(all, function(b) {
						return model.current().indexOf(b.value) > -1;
					});
					return a.length == all.length ? "All Selected" : a.length + " Selected";
				}
				var f = va.ko.utils.arrayFirst(all, function(o) {
					return o.value == model.current();
				});
				if(f&&f.label) return f.label;
				return null;
			});
			model.select = function(d){
			 if(d.value==null) {
					if(model.options().length==0) return;
					model.cloned_options.pop();
					var add = model.options.splice(0, model.count);
					add.forEach(function(i){
						model.cloned_options.push(i);
					});
					if(model.options().length>0) model.cloned_options.push({value:null,label:model.morePrefix});
					return;
				}
        if(ismulti) {
					if(d.value == "vg") return;
					var c = model.current();
					var e = c.indexOf(d.value);
					if(e>-1) {
						c.splice(e, 1);
					} else {
						c.push(d.value);
					}
					model.match("");
					//self.value = c.join(",");
					model.value(c.join(","));
					model.current(c);
				} else {
					model.open(null);
					model.match("");
					//self.value = d.value;
					model.value(d.value);
					model.current(d.value);
				}
				if(typeof model.callback == "function") model.callback(d.value);
			};
			model.focus = function(){
				infc = true;
				if(!model.open()) {
					model.show();
				} else {
				  VG.closeui();
				}
			};
			model.hide = function(){
				infc = false;
				if(!infc && model.open()) {
					model.open(null);
					model.match("");
				}
			};
			model.show = function(){
				VG.closeui();
				model.open(true);
				VG.openui.push(model);
			};
			model.optionsToShow = va.ko.computed(function(){
				var match = model.match();
				if(match=="") {
					return model.cloned_options();
				}
				var re = new RegExp(match, "i");
				return va.ko.utils.arrayFilter(all, function(opt) {
					return re.test(opt.label);
				});
			}, model);
			model.me = function(it, e){
				if(model.sfp&&fp&&it.value){
					setgfont(it.value);
					var pos = _getOffset(e.currentTarget.parentNode);
					fp.style.display = "block";
					fp.style.left = pos.left+e.currentTarget.parentNode.offsetWidth+10+"px";
					fp.style.top = pos.top+"px";
				}
			};
			model.ml = function(){
				if(model.sfp&&fp){
					fp.style.display = "none";
				}
			};
			model.cloned_options(model.options.splice(0, model.count));
			if(model.options().length) {
				//model.showSearch(true);
				model.cloned_options.push({value:null,label:model.morePrefix});
			}
      var el = self.previousElementSibling || va.lmnt.previousElementSibling(self);
			var el2 = self.nextElementSibling ? (self.nextElementSibling.nextElementSibling?self.nextElementSibling.nextElementSibling:self.nextElementSibling) : (va.lmnt.nextElementSibling(va.lmnt.nextElementSibling(self))?va.lmnt.nextElementSibling(va.lmnt.nextElementSibling(self)):va.lmnt.nextElementSibling(self));
			if(el2.lastElementChild) {
				el2.lastElementChild.scrollTop = 0;
				Gator(el2.lastElementChild).on(support, function(e){
					if(e.currentTarget.offsetHeight + e.currentTarget.scrollTop + 50 >= e.currentTarget.scrollHeight) {
						model.select({value:null});
					}
					e.bubbles = false;
					e.stopPropagation && e.stopPropagation();
				});
			}
		}
	}
	va.ko.bindingHandlers.select = {
    init: function(element, valueAccessor, allBindings, viewModel, bindingContext) {
      valueAccessor = valueAccessor();
      Select.call(element, valueAccessor);
      return {controlsDescendantBindings: true};
    }
  };
})();(function(){
	function Radio(model) {
		//IE8 friendly
		var ins = 'getElementsByClassName' in this.parentNode ? this.parentNode.getElementsByClassName("vh") : this.parentNode.getElementsByTagName("INPUT");
		var off = ins[0], on = ins[1];
		model.toggle = function() {
			if(on.checked) {
				removeclass(this, "active");
				on.removeAttribute("checked");
				off.checked = "checked";
				model.value(off.value);
				model.checked(off.value);
			} else {
				addclass(this, "active");
				off.removeAttribute("checked");
				on.checked = "checked";
				model.value(on.value);
				model.checked(on.value);
			}
      if(model.callback) model.callback.call(model);
		};
		model.checkedValue = va.ko.computed(function() {
			var inst = this;
			var res = va.ko.utils.arrayFirst(inst.options(), function(opt){
				return opt.value==inst.value()
			});
			if(!res) res = inst.options()[0];
			return res.label;
		}, model);
		if(model.value()==on.value) {
			addclass(this, "active");
		}
	}
	va.ko.bindingHandlers.radio = {
		init: function(element,valueAccessor){
			valueAccessor=valueAccessor();
			Radio.call(element,valueAccessor);
			return {controlsDescendantBindings:false}
		}
	}
})();var vselects={"responsive_row_widths":[{"value":"default","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION1"},{"value":"1:1100","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION2"},{"value":"2:1100","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION3"},{"value":"3:1100","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION4"},{"value":"4:1100","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION5"},{"value":"5:1100","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION6"},{"value":"6:1100","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION57"},{"value":"7:1100","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION58"},{"value":"1:1050","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION7"},{"value":"2:1050","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION8"},{"value":"3:1050","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION9"},{"value":"4:1050","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION10"},{"value":"5:1050","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION11"},{"value":"6:1050","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION59"},{"value":"7:1050","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION60"},{"value":"1:1000","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION12"},{"value":"2:1000","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION13"},{"value":"3:1000","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION14"},{"value":"4:1000","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION15"},{"value":"5:1000","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION16"},{"value":"6:1000","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION61"},{"value":"7:1000","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION62"},{"value":"1:950","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION17"},{"value":"2:950","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION18"},{"value":"3:950","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION19"},{"value":"4:950","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION20"},{"value":"5:950","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION21"},{"value":"6:950","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION63"},{"value":"7:950","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION64"},{"value":"1:900","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION22"},{"value":"2:900","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION23"},{"value":"3:900","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION24"},{"value":"4:900","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION25"},{"value":"5:900","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION26"},{"value":"6:900","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION65"},{"value":"7:900","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION66"},{"value":"1:850","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION27"},{"value":"2:850","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION28"},{"value":"3:850","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION29"},{"value":"4:850","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION30"},{"value":"5:850","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION31"},{"value":"6:850","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION67"},{"value":"7:850","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION68"},{"value":"1:800","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION32"},{"value":"2:800","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION33"},{"value":"3:800","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION34"},{"value":"4:800","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION35"},{"value":"5:800","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION36"},{"value":"6:800","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION69"},{"value":"7:800","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION70"},{"value":"1:750","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION37"},{"value":"2:750","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION38"},{"value":"3:750","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION39"},{"value":"4:750","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION40"},{"value":"5:750","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION41"},{"value":"6:750","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION71"},{"value":"7:750","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION72"},{"value":"1:700","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION42"},{"value":"2:700","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION43"},{"value":"3:700","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION44"},{"value":"4:700","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION45"},{"value":"5:700","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION46"},{"value":"6:700","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION73"},{"value":"7:700","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION74"},{"value":"1:650","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION47"},{"value":"2:650","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION48"},{"value":"3:650","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION49"},{"value":"4:650","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION50"},{"value":"5:650","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION51"},{"value":"6:650","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION75"},{"value":"7:650","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION76"},{"value":"1:600","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION52"},{"value":"2:600","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION53"},{"value":"3:600","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION54"},{"value":"4:600","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION55"},{"value":"5:600","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION56"},{"value":"6:600","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION77"},{"value":"7:600","label":"TPL_FIELD_RESPONSIVEROWWIDTHS_OPTION78"}],"row_calculation":[{"value":"2","label":"TPL_FIELD_ROWSIZE2_LABEL"},{"value":"3","label":"TPL_FIELD_ROWSIZE3_LABEL"},{"value":"4","label":"TPL_FIELD_ROWSIZE4_LABEL"},{"value":"5","label":"TPL_FIELD_ROWSIZE5_LABEL"},{"value":"6","label":"TPL_FIELD_ROWSIZE6_LABEL"},{"value":"automatic","label":"TPL_FIELD_AUTOMATICWIDTHS_01"}],"gfonts":[{"value":"ABeeZee","label":"ABeeZee"},{"value":"Abel","label":"Abel"},{"value":"Abril Fatface","label":"Abril Fatface"},{"value":"Aclonica","label":"Aclonica"},{"value":"Acme","label":"Acme"},{"value":"Actor","label":"Actor"},{"value":"Adamina","label":"Adamina"},{"value":"Advent Pro","label":"Advent Pro"},{"value":"Aguafina Script","label":"Aguafina Script"},{"value":"Akronim","label":"Akronim"},{"value":"Aladin","label":"Aladin"},{"value":"Aldrich","label":"Aldrich"},{"value":"Alef","label":"Alef"},{"value":"Alegreya","label":"Alegreya"},{"value":"Alegreya Sans","label":"Alegreya Sans"},{"value":"Alegreya Sans SC","label":"Alegreya Sans SC"},{"value":"Alegreya SC","label":"Alegreya SC"},{"value":"Alex Brush","label":"Alex Brush"},{"value":"Alfa Slab One","label":"Alfa Slab One"},{"value":"Alice","label":"Alice"},{"value":"Alike","label":"Alike"},{"value":"Alike Angular","label":"Alike Angular"},{"value":"Allan","label":"Allan"},{"value":"Allerta","label":"Allerta"},{"value":"Allerta Stencil","label":"Allerta Stencil"},{"value":"Allura","label":"Allura"},{"value":"Almendra","label":"Almendra"},{"value":"Almendra Display","label":"Almendra Display"},{"value":"Almendra SC","label":"Almendra SC"},{"value":"Amarante","label":"Amarante"},{"value":"Amaranth","label":"Amaranth"},{"value":"Amatic SC","label":"Amatic SC"},{"value":"Amethysta","label":"Amethysta"},{"value":"Anaheim","label":"Anaheim"},{"value":"Andada","label":"Andada"},{"value":"Andika","label":"Andika"},{"value":"Angkor","label":"Angkor"},{"value":"Annie Use Your Telescope","label":"Annie Use Your Telescope"},{"value":"Anonymous Pro","label":"Anonymous Pro"},{"value":"Antic","label":"Antic"},{"value":"Antic Didone","label":"Antic Didone"},{"value":"Antic Slab","label":"Antic Slab"},{"value":"Anton","label":"Anton"},{"value":"Arapey","label":"Arapey"},{"value":"Arbutus","label":"Arbutus"},{"value":"Arbutus Slab","label":"Arbutus Slab"},{"value":"Architects Daughter","label":"Architects Daughter"},{"value":"Archivo Black","label":"Archivo Black"},{"value":"Archivo Narrow","label":"Archivo Narrow"},{"value":"Arial","label":"Arial"},{"value":"Arimo","label":"Arimo"},{"value":"Arizonia","label":"Arizonia"},{"value":"Armata","label":"Armata"},{"value":"Artifika","label":"Artifika"},{"value":"Arvo","label":"Arvo"},{"value":"Asap","label":"Asap"},{"value":"Asset","label":"Asset"},{"value":"Astloch","label":"Astloch"},{"value":"Asul","label":"Asul"},{"value":"Atomic Age","label":"Atomic Age"},{"value":"Aubrey","label":"Aubrey"},{"value":"Audiowide","label":"Audiowide"},{"value":"Autour One","label":"Autour One"},{"value":"Average","label":"Average"},{"value":"Average Sans","label":"Average Sans"},{"value":"Averia Gruesa Libre","label":"Averia Gruesa Libre"},{"value":"Averia Libre","label":"Averia Libre"},{"value":"Averia Sans Libre","label":"Averia Sans Libre"},{"value":"Averia Serif Libre","label":"Averia Serif Libre"},{"value":"Bad Script","label":"Bad Script"},{"value":"Balthazar","label":"Balthazar"},{"value":"Bangers","label":"Bangers"},{"value":"Basic","label":"Basic"},{"value":"Battambang","label":"Battambang"},{"value":"Baumans","label":"Baumans"},{"value":"Bayon","label":"Bayon"},{"value":"Belgrano","label":"Belgrano"},{"value":"Belleza","label":"Belleza"},{"value":"BenchNine","label":"BenchNine"},{"value":"Bentham","label":"Bentham"},{"value":"Berkshire Swash","label":"Berkshire Swash"},{"value":"Bevan","label":"Bevan"},{"value":"Bigelow Rules","label":"Bigelow Rules"},{"value":"Bigshot One","label":"Bigshot One"},{"value":"Bilbo","label":"Bilbo"},{"value":"Bilbo Swash Caps","label":"Bilbo Swash Caps"},{"value":"Bitter","label":"Bitter"},{"value":"Black Ops One","label":"Black Ops One"},{"value":"Bokor","label":"Bokor"},{"value":"Bonbon","label":"Bonbon"},{"value":"Boogaloo","label":"Boogaloo"},{"value":"Bowlby One","label":"Bowlby One"},{"value":"Bowlby One SC","label":"Bowlby One SC"},{"value":"Brawler","label":"Brawler"},{"value":"Bree Serif","label":"Bree Serif"},{"value":"Bubblegum Sans","label":"Bubblegum Sans"},{"value":"Bubbler One","label":"Bubbler One"},{"value":"Buda","label":"Buda"},{"value":"Buenard","label":"Buenard"},{"value":"Butcherman","label":"Butcherman"},{"value":"Butterfly Kids","label":"Butterfly Kids"},{"value":"Cabin","label":"Cabin"},{"value":"Cabin Condensed","label":"Cabin Condensed"},{"value":"Cabin Sketch","label":"Cabin Sketch"},{"value":"Caesar Dressing","label":"Caesar Dressing"},{"value":"Cagliostro","label":"Cagliostro"},{"value":"Calligraffitti","label":"Calligraffitti"},{"value":"Cambo","label":"Cambo"},{"value":"Candal","label":"Candal"},{"value":"Cantarell","label":"Cantarell"},{"value":"Cantata One","label":"Cantata One"},{"value":"Cantora One","label":"Cantora One"},{"value":"Capriola","label":"Capriola"},{"value":"Cardo","label":"Cardo"},{"value":"Carme","label":"Carme"},{"value":"Carrois Gothic","label":"Carrois Gothic"},{"value":"Carrois Gothic SC","label":"Carrois Gothic SC"},{"value":"Carter One","label":"Carter One"},{"value":"Caudex","label":"Caudex"},{"value":"Cedarville Cursive","label":"Cedarville Cursive"},{"value":"Ceviche One","label":"Ceviche One"},{"value":"Changa One","label":"Changa One"},{"value":"Chango","label":"Chango"},{"value":"Chau Philomene One","label":"Chau Philomene One"},{"value":"Chela One","label":"Chela One"},{"value":"Chelsea Market","label":"Chelsea Market"},{"value":"Chenla","label":"Chenla"},{"value":"Cherry Cream Soda","label":"Cherry Cream Soda"},{"value":"Cherry Swash","label":"Cherry Swash"},{"value":"Chewy","label":"Chewy"},{"value":"Chicle","label":"Chicle"},{"value":"Chivo","label":"Chivo"},{"value":"Cinzel","label":"Cinzel"},{"value":"Cinzel Decorative","label":"Cinzel Decorative"},{"value":"Clicker Script","label":"Clicker Script"},{"value":"Coda","label":"Coda"},{"value":"Coda Caption","label":"Coda Caption"},{"value":"Codystar","label":"Codystar"},{"value":"Combo","label":"Combo"},{"value":"Comfortaa","label":"Comfortaa"},{"value":"Coming Soon","label":"Coming Soon"},{"value":"Concert One","label":"Concert One"},{"value":"Condiment","label":"Condiment"},{"value":"Content","label":"Content"},{"value":"Contrail One","label":"Contrail One"},{"value":"Convergence","label":"Convergence"},{"value":"Cookie","label":"Cookie"},{"value":"Copse","label":"Copse"},{"value":"Corben","label":"Corben"},{"value":"Courgette","label":"Courgette"},{"value":"Cousine","label":"Cousine"},{"value":"Coustard","label":"Coustard"},{"value":"Covered By Your Grace","label":"Covered By Your Grace"},{"value":"Crafty Girls","label":"Crafty Girls"},{"value":"Creepster","label":"Creepster"},{"value":"Crete Round","label":"Crete Round"},{"value":"Crimson Text","label":"Crimson Text"},{"value":"Croissant One","label":"Croissant One"},{"value":"Crushed","label":"Crushed"},{"value":"Cuprum","label":"Cuprum"},{"value":"Cutive","label":"Cutive"},{"value":"Cutive Mono","label":"Cutive Mono"},{"value":"Damion","label":"Damion"},{"value":"Dancing Script","label":"Dancing Script"},{"value":"Dangrek","label":"Dangrek"},{"value":"Dawning of a New Day","label":"Dawning of a New Day"},{"value":"Days One","label":"Days One"},{"value":"Delius","label":"Delius"},{"value":"Delius Swash Caps","label":"Delius Swash Caps"},{"value":"Delius Unicase","label":"Delius Unicase"},{"value":"Della Respira","label":"Della Respira"},{"value":"Denk One","label":"Denk One"},{"value":"Devonshire","label":"Devonshire"},{"value":"Dhurjati","label":"Dhurjati"},{"value":"Didact Gothic","label":"Didact Gothic"},{"value":"Diplomata","label":"Diplomata"},{"value":"Diplomata SC","label":"Diplomata SC"},{"value":"Domine","label":"Domine"},{"value":"Donegal One","label":"Donegal One"},{"value":"Doppio One","label":"Doppio One"},{"value":"Dorsa","label":"Dorsa"},{"value":"Dosis","label":"Dosis"},{"value":"Dr Sugiyama","label":"Dr Sugiyama"},{"value":"Droid Sans","label":"Droid Sans"},{"value":"Droid Sans Mono","label":"Droid Sans Mono"},{"value":"Droid Serif","label":"Droid Serif"},{"value":"Duru Sans","label":"Duru Sans"},{"value":"Dynalight","label":"Dynalight"},{"value":"Eagle Lake","label":"Eagle Lake"},{"value":"Eater","label":"Eater"},{"value":"EB Garamond","label":"EB Garamond"},{"value":"Economica","label":"Economica"},{"value":"Ek Mukta","label":"Ek Mukta"},{"value":"Electrolize","label":"Electrolize"},{"value":"Elsie","label":"Elsie"},{"value":"Elsie Swash Caps","label":"Elsie Swash Caps"},{"value":"Emblema One","label":"Emblema One"},{"value":"Emilys Candy","label":"Emilys Candy"},{"value":"Engagement","label":"Engagement"},{"value":"Englebert","label":"Englebert"},{"value":"Enriqueta","label":"Enriqueta"},{"value":"Erica One","label":"Erica One"},{"value":"Esteban","label":"Esteban"},{"value":"Euphoria Script","label":"Euphoria Script"},{"value":"Ewert","label":"Ewert"},{"value":"Exo","label":"Exo"},{"value":"Exo 2","label":"Exo 2"},{"value":"Expletus Sans","label":"Expletus Sans"},{"value":"Fanwood Text","label":"Fanwood Text"},{"value":"Fascinate","label":"Fascinate"},{"value":"Fascinate Inline","label":"Fascinate Inline"},{"value":"Faster One","label":"Faster One"},{"value":"Fasthand","label":"Fasthand"},{"value":"Fauna One","label":"Fauna One"},{"value":"Federant","label":"Federant"},{"value":"Federo","label":"Federo"},{"value":"Felipa","label":"Felipa"},{"value":"Fenix","label":"Fenix"},{"value":"Finger Paint","label":"Finger Paint"},{"value":"Fira Mono","label":"Fira Mono"},{"value":"Fira Sans","label":"Fira Sans"},{"value":"Fjalla One","label":"Fjalla One"},{"value":"Fjord One","label":"Fjord One"},{"value":"Flamenco","label":"Flamenco"},{"value":"Flavors","label":"Flavors"},{"value":"Fondamento","label":"Fondamento"},{"value":"Fontdiner Swanky","label":"Fontdiner Swanky"},{"value":"Forum","label":"Forum"},{"value":"Francois One","label":"Francois One"},{"value":"Freckle Face","label":"Freckle Face"},{"value":"Fredericka the Great","label":"Fredericka the Great"},{"value":"Fredoka One","label":"Fredoka One"},{"value":"Freehand","label":"Freehand"},{"value":"Fresca","label":"Fresca"},{"value":"Frijole","label":"Frijole"},{"value":"Fruktur","label":"Fruktur"},{"value":"Fugaz One","label":"Fugaz One"},{"value":"Gabriela","label":"Gabriela"},{"value":"Gafata","label":"Gafata"},{"value":"Galdeano","label":"Galdeano"},{"value":"Galindo","label":"Galindo"},{"value":"Gentium Basic","label":"Gentium Basic"},{"value":"Gentium Book Basic","label":"Gentium Book Basic"},{"value":"Geo","label":"Geo"},{"value":"Geostar","label":"Geostar"},{"value":"Geostar Fill","label":"Geostar Fill"},{"value":"Germania One","label":"Germania One"},{"value":"GFS Didot","label":"GFS Didot"},{"value":"GFS Neohellenic","label":"GFS Neohellenic"},{"value":"Gidugu","label":"Gidugu"},{"value":"Gilda Display","label":"Gilda Display"},{"value":"Give You Glory","label":"Give You Glory"},{"value":"Glass Antiqua","label":"Glass Antiqua"},{"value":"Glegoo","label":"Glegoo"},{"value":"Gloria Hallelujah","label":"Gloria Hallelujah"},{"value":"Goblin One","label":"Goblin One"},{"value":"Gochi Hand","label":"Gochi Hand"},{"value":"Gorditas","label":"Gorditas"},{"value":"Goudy Bookletter 1911","label":"Goudy Bookletter 1911"},{"value":"Graduate","label":"Graduate"},{"value":"Grand Hotel","label":"Grand Hotel"},{"value":"Gravitas One","label":"Gravitas One"},{"value":"Great Vibes","label":"Great Vibes"},{"value":"Griffy","label":"Griffy"},{"value":"Gruppo","label":"Gruppo"},{"value":"Gudea","label":"Gudea"},{"value":"Habibi","label":"Habibi"},{"value":"Halant","label":"Halant"},{"value":"Hammersmith One","label":"Hammersmith One"},{"value":"Hanalei","label":"Hanalei"},{"value":"Hanalei Fill","label":"Hanalei Fill"},{"value":"Handlee","label":"Handlee"},{"value":"Hanuman","label":"Hanuman"},{"value":"Happy Monkey","label":"Happy Monkey"},{"value":"Headland One","label":"Headland One"},{"value":"Helvetica","label":"Helvetica"},{"value":"Henny Penny","label":"Henny Penny"},{"value":"Herr Von Muellerhoff","label":"Herr Von Muellerhoff"},{"value":"Hind","label":"Hind"},{"value":"Holtwood One SC","label":"Holtwood One SC"},{"value":"Homemade Apple","label":"Homemade Apple"},{"value":"Homenaje","label":"Homenaje"},{"value":"Iceberg","label":"Iceberg"},{"value":"Iceland","label":"Iceland"},{"value":"IM Fell Double Pica","label":"IM Fell Double Pica"},{"value":"IM Fell Double Pica SC","label":"IM Fell Double Pica SC"},{"value":"IM Fell DW Pica","label":"IM Fell DW Pica"},{"value":"IM Fell DW Pica SC","label":"IM Fell DW Pica SC"},{"value":"IM Fell English","label":"IM Fell English"},{"value":"IM Fell English SC","label":"IM Fell English SC"},{"value":"IM Fell French Canon","label":"IM Fell French Canon"},{"value":"IM Fell French Canon SC","label":"IM Fell French Canon SC"},{"value":"IM Fell Great Primer","label":"IM Fell Great Primer"},{"value":"IM Fell Great Primer SC","label":"IM Fell Great Primer SC"},{"value":"Imprima","label":"Imprima"},{"value":"Inconsolata","label":"Inconsolata"},{"value":"Inder","label":"Inder"},{"value":"Indie Flower","label":"Indie Flower"},{"value":"Inika","label":"Inika"},{"value":"Irish Grover","label":"Irish Grover"},{"value":"Istok Web","label":"Istok Web"},{"value":"Italiana","label":"Italiana"},{"value":"Italianno","label":"Italianno"},{"value":"Jacques Francois","label":"Jacques Francois"},{"value":"Jacques Francois Shadow","label":"Jacques Francois Shadow"},{"value":"Jim Nightshade","label":"Jim Nightshade"},{"value":"Jockey One","label":"Jockey One"},{"value":"Jolly Lodger","label":"Jolly Lodger"},{"value":"Josefin Sans","label":"Josefin Sans"},{"value":"Josefin Slab","label":"Josefin Slab"},{"value":"Joti One","label":"Joti One"},{"value":"Judson","label":"Judson"},{"value":"Julee","label":"Julee"},{"value":"Julius Sans One","label":"Julius Sans One"},{"value":"Junge","label":"Junge"},{"value":"Jura","label":"Jura"},{"value":"Just Another Hand","label":"Just Another Hand"},{"value":"Just Me Again Down Here","label":"Just Me Again Down Here"},{"value":"Kalam","label":"Kalam"},{"value":"Kameron","label":"Kameron"},{"value":"Kantumruy","label":"Kantumruy"},{"value":"Karla","label":"Karla"},{"value":"Karma","label":"Karma"},{"value":"Kaushan Script","label":"Kaushan Script"},{"value":"Kavoon","label":"Kavoon"},{"value":"Kdam Thmor","label":"Kdam Thmor"},{"value":"Keania One","label":"Keania One"},{"value":"Kelly Slab","label":"Kelly Slab"},{"value":"Kenia","label":"Kenia"},{"value":"Khand","label":"Khand"},{"value":"Khmer","label":"Khmer"},{"value":"Kite One","label":"Kite One"},{"value":"Knewave","label":"Knewave"},{"value":"Kotta One","label":"Kotta One"},{"value":"Koulen","label":"Koulen"},{"value":"Kranky","label":"Kranky"},{"value":"Kreon","label":"Kreon"},{"value":"Kristi","label":"Kristi"},{"value":"Krona One","label":"Krona One"},{"value":"La Belle Aurore","label":"La Belle Aurore"},{"value":"Laila","label":"Laila"},{"value":"Lancelot","label":"Lancelot"},{"value":"Lato","label":"Lato"},{"value":"League Script","label":"League Script"},{"value":"Leckerli One","label":"Leckerli One"},{"value":"Ledger","label":"Ledger"},{"value":"Lekton","label":"Lekton"},{"value":"Lemon","label":"Lemon"},{"value":"Libre Baskerville","label":"Libre Baskerville"},{"value":"Life Savers","label":"Life Savers"},{"value":"Lilita One","label":"Lilita One"},{"value":"Lily Script One","label":"Lily Script One"},{"value":"Limelight","label":"Limelight"},{"value":"Linden Hill","label":"Linden Hill"},{"value":"Lobster","label":"Lobster"},{"value":"Lobster Two","label":"Lobster Two"},{"value":"Londrina Outline","label":"Londrina Outline"},{"value":"Londrina Shadow","label":"Londrina Shadow"},{"value":"Londrina Sketch","label":"Londrina Sketch"},{"value":"Londrina Solid","label":"Londrina Solid"},{"value":"Lora","label":"Lora"},{"value":"Love Ya Like A Sister","label":"Love Ya Like A Sister"},{"value":"Loved by the King","label":"Loved by the King"},{"value":"Lovers Quarrel","label":"Lovers Quarrel"},{"value":"Luckiest Guy","label":"Luckiest Guy"},{"value":"Lusitana","label":"Lusitana"},{"value":"Lustria","label":"Lustria"},{"value":"Macondo","label":"Macondo"},{"value":"Macondo Swash Caps","label":"Macondo Swash Caps"},{"value":"Magra","label":"Magra"},{"value":"Maiden Orange","label":"Maiden Orange"},{"value":"Mako","label":"Mako"},{"value":"Mallanna","label":"Mallanna"},{"value":"Mandali","label":"Mandali"},{"value":"Marcellus","label":"Marcellus"},{"value":"Marcellus SC","label":"Marcellus SC"},{"value":"Marck Script","label":"Marck Script"},{"value":"Margarine","label":"Margarine"},{"value":"Marko One","label":"Marko One"},{"value":"Marmelad","label":"Marmelad"},{"value":"Marvel","label":"Marvel"},{"value":"Mate","label":"Mate"},{"value":"Mate SC","label":"Mate SC"},{"value":"Maven Pro","label":"Maven Pro"},{"value":"McLaren","label":"McLaren"},{"value":"Meddon","label":"Meddon"},{"value":"MedievalSharp","label":"MedievalSharp"},{"value":"Medula One","label":"Medula One"},{"value":"Megrim","label":"Megrim"},{"value":"Meie Script","label":"Meie Script"},{"value":"Merienda","label":"Merienda"},{"value":"Merienda One","label":"Merienda One"},{"value":"Merriweather","label":"Merriweather"},{"value":"Merriweather Sans","label":"Merriweather Sans"},{"value":"Metal","label":"Metal"},{"value":"Metal Mania","label":"Metal Mania"},{"value":"Metamorphous","label":"Metamorphous"},{"value":"Metrophobic","label":"Metrophobic"},{"value":"Michroma","label":"Michroma"},{"value":"Milonga","label":"Milonga"},{"value":"Miltonian","label":"Miltonian"},{"value":"Miltonian Tattoo","label":"Miltonian Tattoo"},{"value":"Miniver","label":"Miniver"},{"value":"Miss Fajardose","label":"Miss Fajardose"},{"value":"Modern Antiqua","label":"Modern Antiqua"},{"value":"Molengo","label":"Molengo"},{"value":"Molle","label":"Molle"},{"value":"Monda","label":"Monda"},{"value":"Monofett","label":"Monofett"},{"value":"Monoton","label":"Monoton"},{"value":"Monsieur La Doulaise","label":"Monsieur La Doulaise"},{"value":"Montaga","label":"Montaga"},{"value":"Montez","label":"Montez"},{"value":"Montserrat","label":"Montserrat"},{"value":"Montserrat Alternates","label":"Montserrat Alternates"},{"value":"Montserrat Subrayada","label":"Montserrat Subrayada"},{"value":"Moul","label":"Moul"},{"value":"Moulpali","label":"Moulpali"},{"value":"Mountains of Christmas","label":"Mountains of Christmas"},{"value":"Mouse Memoirs","label":"Mouse Memoirs"},{"value":"Mr Bedfort","label":"Mr Bedfort"},{"value":"Mr Dafoe","label":"Mr Dafoe"},{"value":"Mr De Haviland","label":"Mr De Haviland"},{"value":"Mrs Saint Delafield","label":"Mrs Saint Delafield"},{"value":"Mrs Sheppards","label":"Mrs Sheppards"},{"value":"Muli","label":"Muli"},{"value":"Mystery Quest","label":"Mystery Quest"},{"value":"Neucha","label":"Neucha"},{"value":"Neuton","label":"Neuton"},{"value":"New Rocker","label":"New Rocker"},{"value":"News Cycle","label":"News Cycle"},{"value":"Niconne","label":"Niconne"},{"value":"Nixie One","label":"Nixie One"},{"value":"Nobile","label":"Nobile"},{"value":"Nokora","label":"Nokora"},{"value":"Norican","label":"Norican"},{"value":"Nosifer","label":"Nosifer"},{"value":"Nothing You Could Do","label":"Nothing You Could Do"},{"value":"Noticia Text","label":"Noticia Text"},{"value":"Noto Sans","label":"Noto Sans"},{"value":"Noto Serif","label":"Noto Serif"},{"value":"Nova Cut","label":"Nova Cut"},{"value":"Nova Flat","label":"Nova Flat"},{"value":"Nova Mono","label":"Nova Mono"},{"value":"Nova Oval","label":"Nova Oval"},{"value":"Nova Round","label":"Nova Round"},{"value":"Nova Script","label":"Nova Script"},{"value":"Nova Slim","label":"Nova Slim"},{"value":"Nova Square","label":"Nova Square"},{"value":"NTR","label":"NTR"},{"value":"Numans","label":"Numans"},{"value":"Nunito","label":"Nunito"},{"value":"Odor Mean Chey","label":"Odor Mean Chey"},{"value":"Offside","label":"Offside"},{"value":"Old Standard TT","label":"Old Standard TT"},{"value":"Oldenburg","label":"Oldenburg"},{"value":"Oleo Script","label":"Oleo Script"},{"value":"Oleo Script Swash Caps","label":"Oleo Script Swash Caps"},{"value":"Open Sans","label":"Open Sans"},{"value":"Open Sans Condensed","label":"Open Sans Condensed"},{"value":"Oranienbaum","label":"Oranienbaum"},{"value":"Orbitron","label":"Orbitron"},{"value":"Oregano","label":"Oregano"},{"value":"Orienta","label":"Orienta"},{"value":"Original Surfer","label":"Original Surfer"},{"value":"Oswald","label":"Oswald"},{"value":"Over the Rainbow","label":"Over the Rainbow"},{"value":"Overlock","label":"Overlock"},{"value":"Overlock SC","label":"Overlock SC"},{"value":"Ovo","label":"Ovo"},{"value":"Oxygen","label":"Oxygen"},{"value":"Oxygen Mono","label":"Oxygen Mono"},{"value":"Pacifico","label":"Pacifico"},{"value":"Paprika","label":"Paprika"},{"value":"Parisienne","label":"Parisienne"},{"value":"Passero One","label":"Passero One"},{"value":"Passion One","label":"Passion One"},{"value":"Pathway Gothic One","label":"Pathway Gothic One"},{"value":"Patrick Hand","label":"Patrick Hand"},{"value":"Patrick Hand SC","label":"Patrick Hand SC"},{"value":"Patua One","label":"Patua One"},{"value":"Paytone One","label":"Paytone One"},{"value":"Peralta","label":"Peralta"},{"value":"Permanent Marker","label":"Permanent Marker"},{"value":"Petit Formal Script","label":"Petit Formal Script"},{"value":"Petrona","label":"Petrona"},{"value":"Philosopher","label":"Philosopher"},{"value":"Piedra","label":"Piedra"},{"value":"Pinyon Script","label":"Pinyon Script"},{"value":"Pirata One","label":"Pirata One"},{"value":"Plaster","label":"Plaster"},{"value":"Play","label":"Play"},{"value":"Playball","label":"Playball"},{"value":"Playfair Display","label":"Playfair Display"},{"value":"Playfair Display SC","label":"Playfair Display SC"},{"value":"Podkova","label":"Podkova"},{"value":"Poiret One","label":"Poiret One"},{"value":"Poller One","label":"Poller One"},{"value":"Poly","label":"Poly"},{"value":"Pompiere","label":"Pompiere"},{"value":"Poppins","label":"Poppins"},{"value":"Pontano Sans","label":"Pontano Sans"},{"value":"Port Lligat Sans","label":"Port Lligat Sans"},{"value":"Port Lligat Slab","label":"Port Lligat Slab"},{"value":"Prata","label":"Prata"},{"value":"Preahvihear","label":"Preahvihear"},{"value":"Press Start 2P","label":"Press Start 2P"},{"value":"Princess Sofia","label":"Princess Sofia"},{"value":"Prociono","label":"Prociono"},{"value":"Prosto One","label":"Prosto One"},{"value":"PT Mono","label":"PT Mono"},{"value":"PT Sans","label":"PT Sans"},{"value":"PT Sans Caption","label":"PT Sans Caption"},{"value":"PT Sans Narrow","label":"PT Sans Narrow"},{"value":"PT Serif","label":"PT Serif"},{"value":"PT Serif Caption","label":"PT Serif Caption"},{"value":"Puritan","label":"Puritan"},{"value":"Purple Purse","label":"Purple Purse"},{"value":"Quando","label":"Quando"},{"value":"Quantico","label":"Quantico"},{"value":"Quattrocento","label":"Quattrocento"},{"value":"Quattrocento Sans","label":"Quattrocento Sans"},{"value":"Questrial","label":"Questrial"},{"value":"Quicksand","label":"Quicksand"},{"value":"Quintessential","label":"Quintessential"},{"value":"Qwigley","label":"Qwigley"},{"value":"Racing Sans One","label":"Racing Sans One"},{"value":"Radley","label":"Radley"},{"value":"Rajdhani","label":"Rajdhani"},{"value":"Raleway","label":"Raleway"},{"value":"Raleway Dots","label":"Raleway Dots"},{"value":"Ramabhadra","label":"Ramabhadra"},{"value":"Rambla","label":"Rambla"},{"value":"Rammetto One","label":"Rammetto One"},{"value":"Ranchers","label":"Ranchers"},{"value":"Rancho","label":"Rancho"},{"value":"Rationale","label":"Rationale"},{"value":"Redressed","label":"Redressed"},{"value":"Reenie Beanie","label":"Reenie Beanie"},{"value":"Revalia","label":"Revalia"},{"value":"Ribeye","label":"Ribeye"},{"value":"Ribeye Marrow","label":"Ribeye Marrow"},{"value":"Righteous","label":"Righteous"},{"value":"Risque","label":"Risque"},{"value":"Roboto","label":"Roboto"},{"value":"Roboto Condensed","label":"Roboto Condensed"},{"value":"Roboto Slab","label":"Roboto Slab"},{"value":"Rochester","label":"Rochester"},{"value":"Rock Salt","label":"Rock Salt"},{"value":"Rokkitt","label":"Rokkitt"},{"value":"Romanesco","label":"Romanesco"},{"value":"Ropa Sans","label":"Ropa Sans"},{"value":"Rosario","label":"Rosario"},{"value":"Rosarivo","label":"Rosarivo"},{"value":"Rouge Script","label":"Rouge Script"},{"value":"Rozha One","label":"Rozha One"},{"value":"Rubik Mono One","label":"Rubik Mono One"},{"value":"Rubik One","label":"Rubik One"},{"value":"Ruda","label":"Ruda"},{"value":"Rufina","label":"Rufina"},{"value":"Ruge Boogie","label":"Ruge Boogie"},{"value":"Ruluko","label":"Ruluko"},{"value":"Rum Raisin","label":"Rum Raisin"},{"value":"Ruslan Display","label":"Ruslan Display"},{"value":"Russo One","label":"Russo One"},{"value":"Ruthie","label":"Ruthie"},{"value":"Rye","label":"Rye"},{"value":"Sacramento","label":"Sacramento"},{"value":"Sail","label":"Sail"},{"value":"Salsa","label":"Salsa"},{"value":"Sanchez","label":"Sanchez"},{"value":"Sancreek","label":"Sancreek"},{"value":"Sans Serif","label":"Sans Serif"},{"value":"Sansita One","label":"Sansita One"},{"value":"Sarina","label":"Sarina"},{"value":"Sarpanch","label":"Sarpanch"},{"value":"Satisfy","label":"Satisfy"},{"value":"Scada","label":"Scada"},{"value":"Schoolbell","label":"Schoolbell"},{"value":"Seaweed Script","label":"Seaweed Script"},{"value":"Sevillana","label":"Sevillana"},{"value":"Seymour One","label":"Seymour One"},{"value":"Shadows Into Light","label":"Shadows Into Light"},{"value":"Shadows Into Light Two","label":"Shadows Into Light Two"},{"value":"Shanti","label":"Shanti"},{"value":"Share","label":"Share"},{"value":"Share Tech","label":"Share Tech"},{"value":"Share Tech Mono","label":"Share Tech Mono"},{"value":"Shojumaru","label":"Shojumaru"},{"value":"Short Stack","label":"Short Stack"},{"value":"Siemreap","label":"Siemreap"},{"value":"Sigmar One","label":"Sigmar One"},{"value":"Signika","label":"Signika"},{"value":"Signika Negative","label":"Signika Negative"},{"value":"Simonetta","label":"Simonetta"},{"value":"Sintony","label":"Sintony"},{"value":"Sirin Stencil","label":"Sirin Stencil"},{"value":"Six Caps","label":"Six Caps"},{"value":"Skranji","label":"Skranji"},{"value":"Slabo 13px","label":"Slabo 13px"},{"value":"Slabo 27px","label":"Slabo 27px"},{"value":"Slackey","label":"Slackey"},{"value":"Smokum","label":"Smokum"},{"value":"Smythe","label":"Smythe"},{"value":"Sniglet","label":"Sniglet"},{"value":"Snippet","label":"Snippet"},{"value":"Snowburst One","label":"Snowburst One"},{"value":"Sofadi One","label":"Sofadi One"},{"value":"Sofia","label":"Sofia"},{"value":"Sonsie One","label":"Sonsie One"},{"value":"Sorts Mill Goudy","label":"Sorts Mill Goudy"},{"value":"Source Code Pro","label":"Source Code Pro"},{"value":"Source Sans Pro","label":"Source Sans Pro"},{"value":"Source Serif Pro","label":"Source Serif Pro"},{"value":"Special Elite","label":"Special Elite"},{"value":"Spicy Rice","label":"Spicy Rice"},{"value":"Spinnaker","label":"Spinnaker"},{"value":"Spirax","label":"Spirax"},{"value":"Squada One","label":"Squada One"},{"value":"Stalemate","label":"Stalemate"},{"value":"Stalinist One","label":"Stalinist One"},{"value":"Stardos Stencil","label":"Stardos Stencil"},{"value":"Stint Ultra Condensed","label":"Stint Ultra Condensed"},{"value":"Stint Ultra Expanded","label":"Stint Ultra Expanded"},{"value":"Stoke","label":"Stoke"},{"value":"Strait","label":"Strait"},{"value":"Sue Ellen Francisco","label":"Sue Ellen Francisco"},{"value":"Sunshiney","label":"Sunshiney"},{"value":"Supermercado One","label":"Supermercado One"},{"value":"Suwannaphum","label":"Suwannaphum"},{"value":"Swanky and Moo Moo","label":"Swanky and Moo Moo"},{"value":"Syncopate","label":"Syncopate"},{"value":"Tahoma","label":"Tahoma"},{"value":"Tangerine","label":"Tangerine"},{"value":"Taprom","label":"Taprom"},{"value":"Tauri","label":"Tauri"},{"value":"Teko","label":"Teko"},{"value":"Telex","label":"Telex"},{"value":"Tenor Sans","label":"Tenor Sans"},{"value":"Text Me One","label":"Text Me One"},{"value":"The Girl Next Door","label":"The Girl Next Door"},{"value":"Tienne","label":"Tienne"},{"value":"Tinos","label":"Tinos"},{"value":"Titan One","label":"Titan One"},{"value":"Titillium Web","label":"Titillium Web"},{"value":"Trade Winds","label":"Trade Winds"},{"value":"Trocchi","label":"Trocchi"},{"value":"Trochut","label":"Trochut"},{"value":"Trykker","label":"Trykker"},{"value":"Tulpen One","label":"Tulpen One"},{"value":"Ubuntu","label":"Ubuntu"},{"value":"Ubuntu Condensed","label":"Ubuntu Condensed"},{"value":"Ubuntu Mono","label":"Ubuntu Mono"},{"value":"Ultra","label":"Ultra"},{"value":"Uncial Antiqua","label":"Uncial Antiqua"},{"value":"Underdog","label":"Underdog"},{"value":"Unica One","label":"Unica One"},{"value":"UnifrakturCook","label":"UnifrakturCook"},{"value":"UnifrakturMaguntia","label":"UnifrakturMaguntia"},{"value":"Unkempt","label":"Unkempt"},{"value":"Unlock","label":"Unlock"},{"value":"Unna","label":"Unna"},{"value":"Vampiro One","label":"Vampiro One"},{"value":"Varela","label":"Varela"},{"value":"Varela Round","label":"Varela Round"},{"value":"Vast Shadow","label":"Vast Shadow"},{"value":"Verdana","label":"Verdana"},{"value":"Vesper Libre","label":"Vesper Libre"},{"value":"Vibur","label":"Vibur"},{"value":"Vidaloka","label":"Vidaloka"},{"value":"Viga","label":"Viga"},{"value":"Voces","label":"Voces"},{"value":"Volkhov","label":"Volkhov"},{"value":"Vollkorn","label":"Vollkorn"},{"value":"Voltaire","label":"Voltaire"},{"value":"VT323","label":"VT323"},{"value":"Waiting for the Sunrise","label":"Waiting for the Sunrise"},{"value":"Wallpoet","label":"Wallpoet"},{"value":"Walter Turncoat","label":"Walter Turncoat"},{"value":"Warnes","label":"Warnes"},{"value":"Wellfleet","label":"Wellfleet"},{"value":"Wendy One","label":"Wendy One"},{"value":"Wire One","label":"Wire One"},{"value":"Yanone Kaffeesatz","label":"Yanone Kaffeesatz"},{"value":"Yellowtail","label":"Yellowtail"},{"value":"Yeseva One","label":"Yeseva One"},{"value":"Yesteryear","label":"Yesteryear"},{"value":"Zeyada","label":"Zeyada"}],"ft_size":[{"value":"0.1","label":"0.1"},{"value":"0.2","label":"0.2"},{"value":"0.3","label":"0.3"},{"value":"0.4","label":"0.4"},{"value":"0.5","label":"0.5"},{"value":"0.6","label":"0.6"},{"value":"0.7","label":"0.7"},{"value":"0.8","label":"0.8"},{"value":"0.9","label":"0.9"},{"value":"1.0","label":"1.0"},{"value":"1.1","label":"1.1"},{"value":"1.2","label":"1.2"},{"value":"1.3","label":"1.3"},{"value":"1.4","label":"1.4"},{"value":"1.5","label":"1.5"},{"value":"1.6","label":"1.6"},{"value":"1.7","label":"1.7"},{"value":"1.8","label":"1.8"},{"value":"1.9","label":"1.9"},{"value":"2.0","label":"2.0"},{"value":"default","label":"Default"}],"bg_position":[{"value":"top left","label":"TPL_FIELD_IMAGE_POSITION_01"},{"value":"center left","label":"TPL_FIELD_IMAGE_POSITION_02"},{"value":"bottom left","label":"TPL_FIELD_IMAGE_POSITION_03"},{"value":"bottom center","label":"TPL_FIELD_IMAGE_POSITION_04"},{"value":"center center","label":"TPL_FIELD_IMAGE_POSITION_05"},{"value":"top center","label":"TPL_FIELD_IMAGE_POSITION_06"},{"value":"top right","label":"TPL_FIELD_IMAGE_POSITION_07"},{"value":"center right","label":"TPL_FIELD_IMAGE_POSITION_08"},{"value":"bottom right","label":"TPL_FIELD_IMAGE_POSITION_09"}],"image_size":[{"value":"none","label":"TPL_FIELD_IMAGE_SIZE_01"},{"value":"100% auto","label":"TPL_FIELD_IMAGE_SIZE_02"},{"value":"auto 100%","label":"TPL_FIELD_IMAGE_SIZE_03"},{"value":"100% 100%","label":"TPL_FIELD_IMAGE_SIZE_04"},{"value":"auto auto","label":"TPL_FIELD_IMAGE_SIZE_05"},{"value":"contain","label":"TPL_FIELD_IMAGE_SIZE_06"},{"value":"cover","label":"TPL_FIELD_IMAGE_SIZE_07"},{"value":"custom","label":"TPL_FIELD_IMAGE_SIZE_08"}],"image_repeat":[{"value":"repeat","label":"TPL_FIELD_IMAGE_REPEAT_01"},{"value":"no-repeat","label":"TPL_FIELD_IMAGE_REPEAT_02"},{"value":"repeat-x","label":"TPL_FIELD_IMAGE_REPEAT_03"},{"value":"repeat-y","label":"TPL_FIELD_IMAGE_REPEAT_04"}],"image_attachment":[{"value":"scroll","label":"TPL_FIELD_IMAGE_ATTACHMENT_01"},{"value":"fixed","label":"TPL_FIELD_IMAGE_ATTACHMENT_02"},{"value":"local","label":"TPL_FIELD_IMAGE_ATTACHMENT_03"}],"single_column":[{"value":"default","label":"TPL_FIELD_RESPONSIVECENTERSINGLECOLUMN_OPTION1"},{"value":"1050","label":"TPL_FIELD_RESPONSIVECENTERSINGLECOLUMN_OPTION11"},{"value":"1000","label":"TPL_FIELD_RESPONSIVECENTERSINGLECOLUMN_OPTION10"},{"value":"950","label":"TPL_FIELD_RESPONSIVECENTERSINGLECOLUMN_OPTION2"},{"value":"900","label":"TPL_FIELD_RESPONSIVECENTERSINGLECOLUMN_OPTION3"},{"value":"850","label":"TPL_FIELD_RESPONSIVECENTERSINGLECOLUMN_OPTION4"},{"value":"800","label":"TPL_FIELD_RESPONSIVECENTERSINGLECOLUMN_OPTION5"},{"value":"750","label":"TPL_FIELD_RESPONSIVECENTERSINGLECOLUMN_OPTION6"},{"value":"700","label":"TPL_FIELD_RESPONSIVECENTERSINGLECOLUMN_OPTION7"},{"value":"650","label":"TPL_FIELD_RESPONSIVECENTERSINGLECOLUMN_OPTION8"},{"value":"600","label":"TPL_FIELD_RESPONSIVECENTERSINGLECOLUMN_OPTION9"}]};va.ffadjuster = function(d) {
  if(d.name == 'vertex[s5_fixed_fluid]') {
    var current_body_width = VG.current["s5_body_width"]?parseInt(VG.current["s5_body_width"]):100;
    if(d.value() == "%") {
      if(current_body_width > 100) VG.setValueFor('vertex[s5_body_width]',100);
    } else if(current_body_width < 200) {
      VG.setValueFor('vertex[s5_body_width]',960);
    } else VG.setValueFor('vertex[s5_body_width]',current_body_width);
  }
  if(d.name == 'vertex[s5_columns_fixed_fluid]') {
    if(d.value() == "%") {
      VG.setValuesFor(['vertex[s5_left_width]','vertex[s5_right_width]','vertex[s5_left_inset_width]','vertex[s5_right_inset_width]'],20);
    } else {
      VG.setValuesFor(['vertex[s5_left_width]','vertex[s5_right_width]','vertex[s5_left_inset_width]','vertex[s5_right_inset_width]'],240);
    }
  }
  VERTEX.onPage();
};

function resizeInsets() {
  var cols112 = jQuery(".col_1_of_12");
  var cols212 =  jQuery(".col_2_of_12");
  cols112.height(jQuery(cols112[0]).parent().find('.col_8_of_12').height());
  cols212.each(function(){
    jQuery(this).height(jQuery(this).parent().find('.col_8_of_12').height());
  });
}

function setMultiple(a,b){if(!b)return;for(var i=0;i<a.options.length;i++){if(b.indexOf(a.options[i].value)>-1){a.options[i].selected=true;a.options[i].setAttribute('selected','selected')}}}

function render_ranger(model) {
	var title = model.title, name = /*"vertex["+*/model.name/*+"]"*/;
	model.title = null;
	if(model.value == "automatic") {
		model.range = [0,0,0,0,0,0];
	}
  var mods = model.modules||[];
  return [
		{type: "title", title: title.capitalize(), css: "tool-title left"},
		{type: "options", icon:"adddacog", title: "Options", widget: {
			type: "select", title: "Block sizing", name: model.dn, value: model.cs, fr: true, dsort: true, options: [
				{value:"automatic",label:"Automatic Widths"},
				{value:"2",label:"2 Positions"},
				{value:"3",label:"3 Positions"},
				{value:"4",label:"4 Positions"},
				{value:"5",label:"5 Positions"},
				{value:"6",label:"6 Positions"}
			],
			callback: function(nv){
				if(nv=="automatic") {
					model.ranger.reload("values", "disable");
					model.disabled(true);
					va.ko.utils.arrayForEach(model.modules(),function(m){if(m.type=="tool"){m.visible(false);if(m.check&&typeof m.check=="function")m.check()}});
					return;
				}
				model.disabled(false);
				va.ko.utils.arrayForEach(model.modules(),function(m){if(m.type=="tool"){m.visible(true);if(m.check&&typeof m.check=="function")m.check()}});
				if(nv=="2") {
					model.ranger.reload("values", [50,50,0,0,0,0]);
				} else if(nv=="3") {
					model.ranger.reload("values", [33.3,33.3,33.3,0,0,0]);
				} else if(nv=="4") {
					model.ranger.reload("values", [25,25,25,25,0,0]);
				} else if(nv=="5") {
					model.ranger.reload("values", [20,20,20,20,20,0]);
				} else if(nv=="6") {
					model.ranger.reload("values", [16.6,16.6,16.6,16.6,16.6,16.6]);
				}
			},
			data: "vertex["+name+"]"
		}, css: "tool right last"},
		{type: "tool", icon:"picture", title: "<strong>Row Backgrounds</strong><br/>Set the background colors and image for this area of your site. NOTE: Does not work with every template.", widget: {type: "popup", title: "Config", modules: mods}, visible: mods.length > 0, callback: function(){this.popup.open()}, check: function(){if(mods.length>0){this.visible(true)}else{this.visible(false)}}, css: "tool right"},
		{type: "tool", icon:"edit", title: "Manual", data: "vertex["+name+"]", visible: model.value=="automatic"?false:true, callback: function(){model.ranger.reload("edit")}, css: "tool right"},
		{type: "tool", icon:"check-empty", title: "Use Decimal", css: "tool right", data: "vertex["+name+"]", visible: model.value=="automatic"?false:true, callback: function() {
			if(this.icon() == "check") this.icon("check-empty");
			else this.icon("check");
			model.ranger.set("asFloat", model.ranger.get("asFloat")?false:true);
		}}
	];
}

VERTEX = (function(){
	var isMob = false, chs = [], olcbs = [];
  (function(a,b){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))isMob=true})(navigator.userAgent||navigator.vendor||window.opera);
  var model, tabid = 1, func = function(){/*console.log('fake', this)*/}, tp, tpt, vf;
	function slug(str) {
		return str.toLowerCase().replace(/ /g,"-").replace(/[^\w-]+/g,"");
	}
	var lof;
	function tip(e, el, msg) {
		if(!tp) {
			tp = document.createElement("div");
			tp.innerHTML = '<div></div><div class="varrow bottom dark"></div>';
			tp.className = "vf-tip dark";
			document.body.appendChild(tp);
			Gator(tp).on("mouseenter", function(e){
				tip(true);
			}).on("mouseleave", function(e){
				tip();
			}).on("mousemove", function(e){
				tip(true);
			});
		}
		if(tpt) {
			clearTimeout(tpt);
			tpt = null;
		}
		if(!e) {
			tpt = setTimeout(function(){
				tp.className = "vf-tip dark";
				tp.removeAttribute("style");
			}, 200);
			return;
		}
		if(e === true) {
			tp.style.left = (lof.left - 20)+"px";
			tpt = setTimeout(function(){
				tp.style.top = lof.top-tp.offsetHeight-15+"px";
			},50);
			return;
		}
		msg = VG.Lang(msg);
		tp.children[0].innerHTML = msg;
		el = (el ? el : e.currentTarget?e.currentTarget:e.srcElement);
		lof = _getOffset((el.className == "icon" ? el.parentNode : el));
		tpt = setTimeout(function(){
			tp.style.left = (lof.left - 20)+"px";
			setTimeout(function(){
				tp.style.top = lof.top-tp.offsetHeight-15+"px";
				setTimeout(function(){
					tp.className = "vf-tip dark open";
				}, 50);
			}, 50);
		}, 50);
	}
	function drop_list(data, element, trigger) {
		if(!data.widget) return;
		var ul = document.createElement('ul');
		ul.className = "dropd closed";
		switch(data.widget.type) {
			case "select":
				for(var i=0;i<data.widget.options.length;i++) {
					var li = document.createElement('li');
					var a = document.createElement('a');
					li.v = data.widget.options[i].value;
					a.href = '#';
					a.appendChild(document.createTextNode(data.widget.options[i].label));
					li.onclick=function(){
						element.value = this.v;
						data.widget.value = this.v;
						swapclass(this.parentNode, "open", "closed");
						if(data.widget.callback) data.widget.callback.call(data.widget, this.v);
						return false;
					};
					li.appendChild(a);
					ul.appendChild(li);
					element.parentNode.appendChild(ul);
					trigger.onclick = function() {
						swapclass(ul, "closed", "open");
						for(var i=0;i<ul.children.length;i++) {
							var val = isNaN(element.value) ? element.value : parseInt(element.value);
							if(ul.children[i].v == val) {
								ul.children[i].className = 'act';
							} else {
								ul.children[i].className = '';
							}
						}
					};
				}
				break;
			case "color":
				var li = document.createElement('li');
				ul.appendChild(li);
				element.parentNode.appendChild(ul);
				trigger.onclick = function() {
					swapclass(ul, "closed", "open");
				};
				break;
		}
	}
	va.ko.bindingHandlers.icon = {
		update: function(element, valueAccessor, allBindings, viewModel) {
			valueAccessor = va.ko.unwrap(valueAccessor());
			if(valueAccessor) {
				var addda, addua, appnd;
				if(valueAccessor.match(/addda/)) {
					valueAccessor = valueAccessor.substr(5);
					addda = true;
					element.className += " ofsl";
				}
				if(valueAccessor.match(/addua/)) {
					valueAccessor = valueAccessor.substr(5);
					addua = true;
				}
				if(valueAccessor.match(/appnd/)) {
					valueAccessor = valueAccessor.substr(5);
					appnd = true;
				}
				if(appnd) element.innerHTML += "<i class=\"vertex-icon-"+valueAccessor+"\"></i>";
				else element.innerHTML = "<i class=\"vertex-icon-"+valueAccessor+"\"></i>"+(addda?"<span class=\"dar\">&#x25BC;</span>":(addua?"<span class=\"dar\">&#x25B2;</span>":""));
			}
			if(viewModel.name) {
				element.innerHTML += "<span>"+viewModel.name+"</span>";
			}
		}
	};
	va.ko.bindingHandlers.tooltip = {
		init: function(element, valueAccessor) {
			valueAccessor = valueAccessor();
			if(valueAccessor && typeof valueAccessor == "string") {
				Gator(element).on("mouseenter", function(e){
					tip(e, element, valueAccessor);
				}).on("mouseleave", function(e){
					tip();
				});
			}
		}
	};
	va.ko.bindingHandlers.lang = {
		init: function(element, valueAccessor) {
			valueAccessor = valueAccessor();
			if(valueAccessor && typeof valueAccessor == "string") {
				element.innerHTML = VG.Lang(valueAccessor);
			}
		}
	};
	va.ko.bindingHandlers.dropdown = {
		init: function(element, valueAccessor, allBindings, viewModel, bindingContext) {
			valueAccessor = valueAccessor();
			//return { controlsDescendantBindings: true };
		}
	};
	va.ko.bindingHandlers.custom = {
		init: function(element, valueAccessor, allBindings, viewModel, bindingContext) {
			valueAccessor = valueAccessor();
			if(typeof valueAccessor.content == "function") {
				valueAccessor.content.apply(element, [valueAccessor, bindingContext]);
			} else {
				element.innerHTML = valueAccessor.content?valueAccessor.content:"";
			}
			return {controlsDescendantBindings: false};
		}
	};
  va.ko.bindingHandlers.debug = {
		init: function(element, valueAccessor) {
			valueAccessor = typeof valueAccessor == "function" ? valueAccessor() : valueAccessor;
			if(valueAccessor) {
				console.log(valueAccessor);
			}
		}
	};
	va.ko.bindingHandlers.callback = {
		init: function(element, valueAccessor) {
			valueAccessor = valueAccessor();
			if(valueAccessor && typeof valueAccessor == "function") {
				valueAccessor.call(element);
			}
		}
	};
  va.ko.bindingHandlers.callback2 = {
		init: function(element, valueAccessor) {
			valueAccessor = valueAccessor();
			if(valueAccessor.callback && typeof valueAccessor.callback == "function") {
				setTimeout(function(){
				  valueAccessor.callback.call(valueAccessor, element);
				}, 800);
			}
		}
	};
	va.ko.bindingHandlers.expander = {
		init: function(element, valueAccessor, allBindings, viewModel, bindingContext) {
			valueAccessor = valueAccessor();
			valueAccessor.expand = function() {
				this.ex((this.ex()?null:true));
				if(this.ex()) this.icon("minus");
				else this.icon("plus");
				va.ev.send("ranger_update", []);
        resizeInsets();
			};
			valueAccessor.ex = va.ko.observable(null);
			valueAccessor.icon = va.ko.observable("plus");
			return {controlsDescendantBindings: false};
		}
	};
  va.ko.extenders.update = function(target, option) {
    target.subscribe(function(n) {
      //console.log(option, n);
      if(typeof n == "object" && n.length) {}//VG.current[option] = n.join(",");
      else VG.current[option] = n;
    });
    VERTEX.customUpdate(target, option);
    return target;
  };
  function Popup(d) {
    return {
      tmp: d,
      fields: va.ko.observableArray([]),
      isOpen: va.ko.observable(null),
      loaded: va.ko.observable(null),
      load: function() {
        this.fields(this.tmp());
        model.popups.push(this);
        this.loaded(true);
      },
      open: function() {
        if(!this.loaded()) {
          this.load();
        }
        //VG.openui.push(this);
        this.isOpen(true);
        va.onPage(VG.model.activePage());
      },
      hide: function(){
        this.isOpen(false);
      }
    }
  }
	function row_class(a, sw) {
		if(!a) return a;
		return va.ko.utils.arrayFilter(a.split(" "),function(b){if(!b)return false;return sw?!/dark/.test(b):!/bgcolor1|area/.test(b)}).join(" ");
	}
	function Module(data, tab, hom) {
		if(!data || typeof data.modules == "function") return;
		data.modules = data.modules||[];
    var n = data.name;
    data.value = (VG.current[data.name]?VG.current[data.name]:data.value||"");
		if(data.type == "ranger") {
		  //var sv = data.value;
      data.dn = data.name.replace("_manual_widths", "_calculation");
      data.cs = VG.current[data.dn];
			if(data.value == "automatic") data.value = "automatic";
			else if(data.value == "2") data.value = "50,50,0,0,0,0";
			else if(data.value == "3") data.value = "33.33,33.33,33.33,0,0,0";
			else if(data.value == "4") data.value = "25,25,25,25,0,0";
			else if(data.value == "5") data.value = "20,20,20,20,20,0";
			else if(data.value == "6") data.value = "16.66,16.66,16.66,16.66,16.66,16.66";
      if(data.cs == "automatic") data.value = "automatic";
      //else data.value = "0,0,0,0,0,0";
			data.range = va.ko.utils.arrayMap(data.value.split(","),function(v){return parseFloat(v)});
			data.css = "dark";
      //data.sv = sv;
			data.modules = render_ranger.call(this, data);
		}
		if(data.type == "widget") {
			data.css = "dark";
		}
		if(data.type == "area") {
			data.widgets = va.ko.utils.arrayFirst(data.modules,function(o){return o.type=="area"});
			data.css = data.widgets && data.widgets.css;
			if(data.widgets) {
				data.widgets = va.ko.observableArray(va.ko.utils.arrayMap(data.widgets.modules,function(mod){return new Module(mod, tab)}));
			}
		}
		if(data.type == "spacer") {
			data.content = VG.Lang(data.content);
			data.css += " well";
		}
		if(data.name&&data.name.match("color_")) data.type = "color";
		this.tabid = tab||null;
		this.title = VG.Lang(data.title);
		this.help = data.help||null;
		this.type = data.type||null;
		this.icon = va.ko.observable(data.icon||null);
		this.name = data.name?"vertex["+data.name+"]":null;
    if(data.type == "textarea") data.value = data.value.stripSlashes();
		this.value = va.ko.observable(data.value).extend({update:data.name});
		this.css = (data.css?data.css+" ":"") + (data.attrs&&data.attrs.css?data.attrs.css:"");
		if(data.css) delete data.css;
		if(data.attrs&&data.attrs) delete data.attrs.css;
		this.modules = va.ko.observableArray(va.ko.utils.arrayMap(data.modules,function(mod){return new Module(mod, tab)}));
		this.widget = data.widget?new Module(data.widget):null;
		this.widgets = data.widgets||null;
    this.callback = data.callback || null;
		this.disabled = va.ko.observable(null);
    this.hom = va.ko.observable(hom);
		this.visible = typeof data.visible == "function" ? va.ko.computed(data.visible,this) : va.ko.observable(typeof data.visible!="undefined"?data.visible:true);
		this.style = (data.attrs&&data.attrs.style?data.attrs.style:data.style||null);
		this.data = data.data||null;
    this.selected = va.ko.observable([]).extend({update:data.name});
    this.hi = data.intro?true:false;
		if(data.attrs) delete data.attrs.style;
		this.attrs = data.attrs||{};
    if(this.attrs.intro) VG.tc[tab][data.page]++;
		this.openWidget = function(d,e){
			if(this.widget.focus) this.widget.focus();
      else this.widget.show();
		};
    if(data.type == "select" && data.attrs && data.attrs.multiple) {
			this.type = "multiple";
      this.name += "[]";
      //console.log(data.value);
      this.selected(data.value?typeof data.value=="string"?data.value.split(","):data.value:[]);
      this.isCurrent = function(d){
        return this.value().indexOf(d) > -1;
			};
      this.mulChange = function(_, e) {
        var nv = [];
        for(var i=0;i<e.target.options.length;i++) {
          if(e.target.options[i].selected) {
            nv.push(e.target.options[i].value);
					}
        }
        this.value(nv);
      };
		}
		if(data.options) {
			if(typeof data.options=="string"&&data.options=="gfonts") data.sfp = data.des = true;
			if(typeof data.options=="string") data.options = window[data.options] || vselects[data.options];
      this.options = va.ko.observableArray(va.ko.utils.arrayMap(data.options, function(o){o.label=VG.Lang(o.label);return o}));
			if(!data.dsort) this.options.sort(function(a,b){return a.value<b.value?-1:1});
		}
		if(data.type == "checkbox") {
			var c = null;
			this.checked = va.ko.observable((c==data.value?true:false));
		}
		if(data.type == "radio") {
			var c = null;
			va.ko.utils.arrayForEach(this.options(),function(o){
				if(data.value==o.value) c = o.value;
			});
			this.checked = va.ko.observable(c);
		}
		this.oon = function(index, sw) {
		  return (index == model.currentPanel() || index == "all") && model.activePage().tabid == this.tabid ? row_class(this.css, sw) + " open" + (this.visible() ? "" : " hide") + (this.hom() ? " hom sod" : " ") : row_class(this.css, sw);
		};
		if(this.type == "tool" || this.type == "fixed") {
		  this.popup = new Popup(this.modules);
		}
    if(this.widget && this.widget.type == "popup") {
		  this.popup = new Popup(this.widget.modules);
		}
		data = extend(data, this);
		if(data.type == "ranger") {
			va.ev.on("ranger_update", function(){
				if(data.ranger) data.ranger.reload("refresh");
				va.ko.utils.arrayForEach(data.modules(),function(m){if(m.type=="tool"){m.visible(data.disabled()?false:true);if(m.check&&typeof m.check=="function")m.check()}});
			});
		}
    //console.log(data.name, data.type);
    if(data.onload) olcbs.push(data);
		return data;
	}
	va.Module = Module;
	function Page(page) {
		var id = tabid++;
		this.tabid = id;
    VG.tc[id] = {};
		this.name = VG.Lang(page.name);
		this.icon = page.icon;
		this.type = page.type||"modules";
		//this.lding = va.ko.observable(null);
		this.page = page;
		this.subNav = va.ko.observableArray([]);
		this.subNavOpen = va.ko.observable(null);
		this.loaded = va.ko.observable(null);
		this.csublen = (page.csublen?page.csublen:null);
    this.csubs = (page.csubs?page.csubs:null);
    this.customPage = (page.iscustom?true:false);
		this.hom = va.ko.observable(page.hom?page.hom:[]);
		var subs = [], count = 0;
		va.ko.utils.arrayForEach(page.modules, function(item) {
		  if(item.page && subs.indexOf(item.page)==-1) {
		    subs.push(item.page);
        VG.tc[id][item.page] = 0;
        count++;
      }
		});
		this.mcount = va.ko.observable(page.type=="custom"?1:count);
		this.subs = subs;
		this.open = function() {
			var t = this;
			if(!t.subNav().length) {
			 var subs = [];
				va.ko.utils.arrayForEach(this.page.modules, function(item) {
				  if(item.page=="all") return;
					if(subs.indexOf(item.page)==-1) subs.push(item.page);
				});
				t.subNav(subs);
				if(!t.loaded()) {
					t.load(true);
				}
				if(!t.subNavOpen()) {
					t.subNavOpen(t.subNav()[0]);
				}
			}
			return this;
		};
		this.load = function(st) {
			var mods = [],s = this;
      if(st) {
        this.page.modules = va.ko.utils.arrayMap(this.page.modules,function(mod){if(mod.type){return new Module(mod, id, s.hom()[s.subs.indexOf(mod.page)])}return null});
        if(this.hom()) {
          va.ko.utils.arrayForEach(this.hom(),function(hm, i){
            if(hm && s.subNav()[i]) s.page.modules.push(new Module({type:"spacer",content:"This page can only be viewed on a desktop.",page:s.subNav()[i],css:"hod som"}, id, false));
          });
        }
        this.loaded(true);
        return;
      }
      var ap = this.subNavOpen();
      if(!ap && this.page.type != "custom") return;
      for(var i=0;i<this.page.modules.length;i++) {
        if(this.page.modules[i] && (this.page.modules[i].page == ap || this.page.modules[i].page == "all" || this.page.type == "custom")) {
				  if(this.page.modules[i].type == "ranger") {
						if(this.page.modules[i].range && this.page.modules[i].range[0] == 0) {
							this.page.modules[i].disabled(true);
						}
					}
					model.modules.push(this.page.modules[i]);
          delete this.page.modules[i];
				}
			}
      for(var i=0;i<olcbs.length;i++) {
        olcbs[i].callback.call(olcbs[i]);
      }
		};
	}
	function vertexModel(conf) {
		if(conf.lang) VG.lang = conf.lang;
		if(conf.current) VG.current = conf.current;
    VG.getMultiVals = function(from) {
      var nv=[];
      for(var i=0;i<from.options.length;i++) {
        if(from.options[i].selected)
          nv.push(from.options[i].value)
      }
      return nv;
    };
    VG.setMultiVals = function(from, to) {
      for(var i=0;i<from.options.length;i++) {
        if(to.indexOf(from.options[i].value) > -1) {
          from.options[i].selected = true;
          from.options[i].setAttribute('selected','selected')
        }
      }
    };
		var self = this;
		self.isLoaded = va.ko.observable(null);
    self.notPageCenter = va.ko.observable(true);
    self.wrapLayout = va.ko.observable(false);
		self.activePage = va.ko.observable(null);
		self.pages = va.ko.observableArray([]);
		self.modules = va.ko.observableArray([]);
		self.popups = va.ko.observableArray([]);
		//self.popupOpen = va.ko.observable(null);
		self.subMenu = va.ko.observableArray([]);
		self.currentPanel = va.ko.observable(null);
		self.currentPage = function(index) {
			if(!self.activePage()) return false;
			return index == self.activePage().name;
		};
		self.currentVisible = function(index) {
			return index == self.currentPanel();
		};
		self.loadPage = function(index, pindex) {
			if(typeof index === "number") {
				if(index > 0 && self.pages()[index]) self.activePage(self.pages()[index].open());
				else self.activePage(self.pages()[0].open());
			} else {
				if(self.pages.indexOf(index)>-1) self.activePage(index.open());
				else {
					index = va.ko.utils.arrayFirst(self.pages(),function(page){return "#"+slug(page.name) == index});
					if(self.activePage()!=index) {
						if(index) self.activePage(index);
						else self.activePage(self.pages()[0].open());
					}
				}
			}
			self.loadPanel(typeof pindex=="string"?pindex:0);
			va.ko.utils.arrayForEach(self.modules(),function(mod){
				if(mod.ranger){
					mod.ranger.reload("refresh");
				}
			});
			/*if(self.activePage()) {
				window.location.hash = "#"+slug(self.activePage().name);
				document.cookie = "vlp="+self.activePage().tabid+":"+self.currentPanel()||0;
        setTimeout(resizeInsets, 1000);
			}*/
		};
		self.loadPanel = function(index) {
			var active = self.activePage();
			if(active) {
				var nav = active.subNav();
				if(typeof index === "number") {
					if(index < 0 || !nav[index]) index = 0;//active.subNavOpen(nav[0]);
				} else {
				  index = nav.indexOf(index);
					if(index==-1) index = 0;
				}
        if(index == -1) {
          index = 0;
        }
        active.subNavOpen(nav[index]);
        active.load();
        if(active.csubs&&active.csubs.length&&active.csubs[index]) self.notPageCenter(!active.customPage);
        else self.notPageCenter(true);
        self.currentPanel(active.subNavOpen());
        window.location.hash = "#"+slug(self.activePage().name);
        document.cookie = "vlp="+self.activePage().tabid+":"+self.currentPanel()||0;
        setTimeout(resizeInsets, 1000);
        va.ev.send("ranger_update", []);
        va.onPage(active);
			}
		};
		self.trigger = function(a) {
			if(a.type) {
				if(a.type=="tool") {
					if(this.nextElementSibling.nodeName=="UL") {
						if(this.nextElementSibling.className == "dropd open") {
							this.nextElementSibling.className = "dropd";
						} else {
							this.nextElementSibling.className = "dropd open";
						}
					}
				}
			}
		};
		self.tourStart = VG.tourStart;
    self.tourCount = va.ko.pureComputed(VG.tourCount, this);
		self.equal = function(j,k) {
			return j == k;
		};
	}
  function urlencode(str) {
    return encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').replace(/\)/g, '%29').replace(/\*/g, '%2A').replace(/%20/g, '+');
  }
	function load(conf, id, saved, ver, as, iwp) {
		if(!id) return;
    iwp = iwp?"WP":"";
		var a=(typeof id=="string"?document.getElementById(id):id),b=document.getElementById("vfo"),c=document.getElementById("vfw");
		vf = document.createElement("form"), e = document.createElement("div");
		vf.method = "POST";
		vf.action = window.location.href;
		e.appendChild(c);
		vf.appendChild(e);
    if(as) {
      var sa = document.createElement('div');
      sa.innerHTML = '<button class="more-btn v4-wp-save">Save</button>';
      a.appendChild(sa);
      sa.children[0].onclick = function() {
        //console.log(this);
        save("title="+urlencode(as));
      };
      a.appendChild(vf);
    } else {
      a.parentNode.appendChild(vf);
    }
		var fp = document.getElementById("vertex_fprev");
		if(!fp) {
			fp = document.createElement("div");
			fp.id = "vertex_fprev";
			fp.style.display = "none";
			fp.innerHTML = "Preview";
			document.body.appendChild(fp);
		}
		va.ko.applyBindings(model = new vertexModel(conf), c);
		VG.model = model;
		va.onSave = saved;
    mAjax("//shape5.com/vertex/current_version/vertexVersion"+iwp+".php?version="+ver, function(res){
      try {
        res = JSON.parse(res);
        if(res) chs = res.changes;
        var vc = document.getElementById("ver_cur");
        var vl = document.getElementById("ver_latest");
        var mc = document.getElementById("ver_msg");
        var ch = document.getElementById("vertex_changes");
        var ncn = "rlabel red";
        if(res && res.version > ver) {
          if(vc) {
            ncn = "rlabel red";
          }
        } else if(res.version < ver) {
          if(vc) {
            ncn = "rlabel green";
          }
        } else {
          ncn = "rlabel green";
        }
        vc.className = ncn;
        vl.innerHTML = res.version;
        mc.innerHTML = res.update_link;
      } catch(e) {
        var mc = document.getElementById("ver_msg");
        if(mc) {
          mc.innerHTML = 'Error getting update info';
        }
      }
		});
		return vf;
	}
  function save(ex) {
    if(typeof va.preSave == "function") va.preSave();
    var fsd = serialize_object(VG.current), fss = "";
    //console.log("one", fsd['s5_bottom_row3_manual_widths']);
    Array.prototype.push.apply(fsd, serialize_form(vf));
    if(typeof va.beforeSave == "function") fsd = va.beforeSave(fsd);
    //fsd = extend(fsd, serialize_form(vf));
    console.log("two", fsd);
		//for(var f in fsd) if(fsd.hasOwnProperty(f)) fss += "vertex["+f+"]"+"="+fsd[f]+"&";
    for(var f=0;f<fsd.length;f++) fss += fsd[f].name+"="+fsd[f].value+"&";
		fss = fss.substr(0, fss.length-1);
    if(ex) fss += "&"+ex;
    //console.log(fsd, fss);
		if(!fss) return;
		mAjax(vf.action, function(res) {
			if(va.onSave&&typeof va.onSave=="function") va.onSave();
		}, fss);
	}
	function inject(data) {
		var ovpage = {name:"Overview",icon:"info-circled",type:"custom",iscustom:false,csubs:[1],modules:[
			{type: "custom", title: null, css: "well", content: function(){
				var ov = document.getElementById("vfo");
				this.appendChild(ov);
				ov.style.display = "block";
			}}
		]};
		data.unshift(ovpage);

    //This does all the work can take a while but not too long :)
		model.pages(va.ko.utils.arrayMap(data,function(page){return new Page(page)}));

    var cp = document.cookie.replace(/(?:(?:^|.*;\s*)vlp\s*\=\s*([^;]*).*$)|^.*$/, "$1");
		if(cp) cp = cp.split(":");
    if(cp&&cp.length) {
      cp[0]=parseInt(cp[0])-1;
      cp[1]=cp[1]?cp[1]:"Main";
    }
    Gator(window).on("hashchange", function(e){
			model.loadPage(this.location.hash, cp[1]);
		});
    if(window.location.hash) {
			var t = va.ko.utils.arrayFirst(model.pages(),function(page){return "#"+slug(page.name) == window.location.hash});
			if(t&&t.tabid) {
				model.loadPage(t.tabid-1, cp[1]);
			} else {
				if(cp&&model.pages()[cp[0]]) {
					model.loadPage(cp[0], cp[1]);
				} else {
					model.loadPage(0);
				}
			}
		} else {
			if(cp&&model.pages()[cp[0]]) {
				model.loadPage(cp[0], cp[1]);
			} else {
				model.loadPage(0);
			}
		}
    if(cp) {
      model.loadPanel(cp[1]);
    }
		model.isLoaded(true);
    Gator(window).on("resize", function(){
			va.ko.utils.arrayForEach(model.modules(),function(mod){
				if(mod.ranger){
					mod.ranger.reload("refresh");
				}
			});
		});
		//delete window.VDATA;
		/*var cdt = document.getElementById("udate_couter");
		if(cdt) {
			var tleft = parseInt(cdt.getAttribute("data-time"));
			setInterval(function(){
				tleft--;
				if(tleft==0) window.location.reload();
				cdt.setAttribute("data-time", tleft);
			}, 1000);
		}*/
    va.ev.on("insetfix", resizeInsets);
	}
	va.load = load;
	va.save = save.bind(vf);
	va.inject = inject;
  va.preSave = null;
	va.beforeSave = null;
	va.onSave = null;
  va.onPage = func;
  va.customUpdate = func;
	return va;
})();

function serialize_form(form) {
	'use strict';
	var i, j, len, jLen, formElement, q = [];
	function urlencode(str) {
		// http://kevin.vanzonneveld.net
		// Tilde should be allowed unescaped in future versions of PHP (as reflected below), but if you want to reflect current
		// PHP behavior, you would need to add ".replace(/~/g, '%7E');" to the following.
		return encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').replace(/\)/g, '%29').replace(/\*/g, '%2A').replace(/%20/g, '+');
	}
  function addNameValue(name, value) {
    //console.log(name, value);
    name = name.match(/(vertex|jform)\[([^\]]*)\](\[\])?/);
    //console.log(name);
    var n = urlencode(name[2]?"vertex["+name[2]+"]"+(name[3]?name[3]:''):"vertex["+name[0]+"]");
    q/*[n]=urlencode(value);//*/.push({name:n,value:urlencode(value)});
	}
	if(!form || !form.nodeName || form.nodeName.toLowerCase() !== 'form') {
		throw 'You must supply a form element';
	}
	for(i = 0, len = form.elements.length; i < len; i++) {
		formElement = form.elements[i];
		if(formElement.name === '' || formElement.disabled) {
			continue;
		}
		switch(formElement.nodeName.toLowerCase()) {
			case 'input':
			switch (formElement.type) {
				case 'text':
				case 'hidden':
				case 'password':
				addNameValue(formElement.name, formElement.value);
				break;
				case 'checkbox':
				case 'radio':
				if(formElement.checked) {
					addNameValue(formElement.name, formElement.value);
				}// else {
					//addNameValue(formElement.name, null);
				//}
				break;
				case 'file':
				case 'reset':
				break;
			}
			break;
			case 'textarea':
			addNameValue(formElement.name, formElement.value);
			break;
			case 'select':
			switch(formElement.type) {
				case 'select-one':
				addNameValue(formElement.name, formElement.value);
				break;
				case 'select-multiple':
        //var v=[];
				for(j = 0, jLen = formElement.options.length; j < jLen; j++) {
					if(formElement.options[j].selected) {
					 //v.push(formElement.options[j].value);
           //console.log(formElement.name, formElement.options[j].value);
           addNameValue(formElement.name, formElement.options[j].value);
					}
				}
				break;
			}
			break;
		}
	}
	return q;
}
function serialize_object(ob) {
  'use strict';
  var el, q = [];
  function urlencode(str) {
    // http://kevin.vanzonneveld.net
    // Tilde should be allowed unescaped in future versions of PHP (as reflected below), but if you want to reflect current
    // PHP behavior, you would need to add ".replace(/~/g, '%7E');" to the following.
    return encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').replace(/\)/g, '%29').replace(/\*/g, '%2A').replace(/%20/g, '+');
  }
  function addNameValue(name, value) {
    var n = urlencode(name);
    q/*[n]=urlencode(value);//*/.push({name:"vertex["+n+"]",value:urlencode(value)});
  }
  if(!ob || typeof ob != "object") {
    throw 'You must supply a form element';
  }
  for(el in ob) {
    if(ob.hasOwnProperty(el)) {
      addNameValue(el, ob[el]);
    }
  }
	return q;
}
})();