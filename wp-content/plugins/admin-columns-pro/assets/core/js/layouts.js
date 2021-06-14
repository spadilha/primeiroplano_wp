!function(e){var t={};function n(i){if(t[i])return t[i].exports;var s=t[i]={i:i,l:!1,exports:{}};return e[i].call(s.exports,s,s.exports,n),s.l=!0,s.exports}n.m=e,n.c=t,n.d=function(e,t,i){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:i})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var i=Object.create(null);if(n.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var s in e)n.d(i,s,function(t){return e[t]}.bind(null,s));return i},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=41)}({1:function(e,t){function n(e,t){if(!e)throw new Error(t||"AssertionError")}n.notEqual=function(e,t,i){n(e!=t,i)},n.notOk=function(e,t){n(!e,t)},n.equal=function(e,t,i){n(e==t,i)},n.ok=n,e.exports=n},15:function(e,t){function n(e,t){if(!e)throw new Error(t||"AssertionError")}n.notEqual=function(e,t,i){n(e!=t,i)},n.notOk=function(e,t){n(!e,t)},n.equal=function(e,t,i){n(e==t,i)},n.ok=n,e.exports=n},2:function(e,t,n){"use strict";n.d(t,"a",(function(){return r}));var i=n(3),s=n.n(i),o=function(){function e(){this.services={},this.events=new s.a}return e.prototype.registerService=function(e,t){return this.services[e]=t,this},e.prototype.getService=function(e){return this.hasService(e)?this.services[e]:null},e.prototype.hasService=function(e){return this.services.hasOwnProperty(e)},e.prototype.addListener=function(e,t){this.events.addListener(e,t)},e.prototype.emitEvent=function(e,t){this.events.emit(e,t)},e}(),r=function(){return window.AC_SERVICES||(window.AC_SERVICES=new o),window.AC_SERVICES}},3:function(e,t,n){var i=n(4),s=n(5),o=n(1);function r(e){if(!(this instanceof r))return new r(e);this._name=e||"nanobus",this._starListeners=[],this._listeners={}}e.exports=r,r.prototype.emit=function(e){o.ok("string"==typeof e||"symbol"==typeof e,"nanobus.emit: eventName should be type string or symbol");for(var t=[],n=1,i=arguments.length;n<i;n++)t.push(arguments[n]);var r=s(this._name+"('"+e.toString()+"')"),u=this._listeners[e];return u&&u.length>0&&this._emit(this._listeners[e],t),this._starListeners.length>0&&this._emit(this._starListeners,e,t,r.uuid),r(),this},r.prototype.on=r.prototype.addListener=function(e,t){return o.ok("string"==typeof e||"symbol"==typeof e,"nanobus.on: eventName should be type string or symbol"),o.equal(typeof t,"function","nanobus.on: listener should be type function"),"*"===e?this._starListeners.push(t):(this._listeners[e]||(this._listeners[e]=[]),this._listeners[e].push(t)),this},r.prototype.prependListener=function(e,t){return o.ok("string"==typeof e||"symbol"==typeof e,"nanobus.prependListener: eventName should be type string or symbol"),o.equal(typeof t,"function","nanobus.prependListener: listener should be type function"),"*"===e?this._starListeners.unshift(t):(this._listeners[e]||(this._listeners[e]=[]),this._listeners[e].unshift(t)),this},r.prototype.once=function(e,t){o.ok("string"==typeof e||"symbol"==typeof e,"nanobus.once: eventName should be type string or symbol"),o.equal(typeof t,"function","nanobus.once: listener should be type function");var n=this;return this.on(e,(function i(){t.apply(n,arguments),n.removeListener(e,i)})),this},r.prototype.prependOnceListener=function(e,t){o.ok("string"==typeof e||"symbol"==typeof e,"nanobus.prependOnceListener: eventName should be type string or symbol"),o.equal(typeof t,"function","nanobus.prependOnceListener: listener should be type function");var n=this;return this.prependListener(e,(function i(){t.apply(n,arguments),n.removeListener(e,i)})),this},r.prototype.removeListener=function(e,t){return o.ok("string"==typeof e||"symbol"==typeof e,"nanobus.removeListener: eventName should be type string or symbol"),o.equal(typeof t,"function","nanobus.removeListener: listener should be type function"),"*"===e?(this._starListeners=this._starListeners.slice(),n(this._starListeners,t)):(void 0!==this._listeners[e]&&(this._listeners[e]=this._listeners[e].slice()),n(this._listeners[e],t));function n(e,t){if(e){var n=e.indexOf(t);return-1!==n?(i(e,n,1),!0):void 0}}},r.prototype.removeAllListeners=function(e){return e?"*"===e?this._starListeners=[]:this._listeners[e]=[]:(this._starListeners=[],this._listeners={}),this},r.prototype.listeners=function(e){var t="*"!==e?this._listeners[e]:this._starListeners,n=[];if(t)for(var i=t.length,s=0;s<i;s++)n.push(t[s]);return n},r.prototype._emit=function(e,t,n,i){if(void 0!==e&&0!==e.length){void 0===n&&(n=t,t=null),t&&(n=void 0!==i?[t].concat(n,i):[t].concat(n));for(var s=e.length,o=0;o<s;o++){var r=e[o];r.apply(r,n)}}}},35:function(e,t,n){var i=n(37),s=n(38),o=n(15);function r(e){if(!(this instanceof r))return new r(e);this._name=e||"nanobus",this._starListeners=[],this._listeners={}}e.exports=r,r.prototype.emit=function(e){o.ok("string"==typeof e||"symbol"==typeof e,"nanobus.emit: eventName should be type string or symbol");for(var t=[],n=1,i=arguments.length;n<i;n++)t.push(arguments[n]);var r=s(this._name+"('"+e.toString()+"')"),u=this._listeners[e];return u&&u.length>0&&this._emit(this._listeners[e],t),this._starListeners.length>0&&this._emit(this._starListeners,e,t,r.uuid),r(),this},r.prototype.on=r.prototype.addListener=function(e,t){return o.ok("string"==typeof e||"symbol"==typeof e,"nanobus.on: eventName should be type string or symbol"),o.equal(typeof t,"function","nanobus.on: listener should be type function"),"*"===e?this._starListeners.push(t):(this._listeners[e]||(this._listeners[e]=[]),this._listeners[e].push(t)),this},r.prototype.prependListener=function(e,t){return o.ok("string"==typeof e||"symbol"==typeof e,"nanobus.prependListener: eventName should be type string or symbol"),o.equal(typeof t,"function","nanobus.prependListener: listener should be type function"),"*"===e?this._starListeners.unshift(t):(this._listeners[e]||(this._listeners[e]=[]),this._listeners[e].unshift(t)),this},r.prototype.once=function(e,t){o.ok("string"==typeof e||"symbol"==typeof e,"nanobus.once: eventName should be type string or symbol"),o.equal(typeof t,"function","nanobus.once: listener should be type function");var n=this;return this.on(e,(function i(){t.apply(n,arguments),n.removeListener(e,i)})),this},r.prototype.prependOnceListener=function(e,t){o.ok("string"==typeof e||"symbol"==typeof e,"nanobus.prependOnceListener: eventName should be type string or symbol"),o.equal(typeof t,"function","nanobus.prependOnceListener: listener should be type function");var n=this;return this.prependListener(e,(function i(){t.apply(n,arguments),n.removeListener(e,i)})),this},r.prototype.removeListener=function(e,t){return o.ok("string"==typeof e||"symbol"==typeof e,"nanobus.removeListener: eventName should be type string or symbol"),o.equal(typeof t,"function","nanobus.removeListener: listener should be type function"),"*"===e?(this._starListeners=this._starListeners.slice(),n(this._starListeners,t)):(void 0!==this._listeners[e]&&(this._listeners[e]=this._listeners[e].slice()),n(this._listeners[e],t));function n(e,t){if(e){var n=e.indexOf(t);return-1!==n?(i(e,n,1),!0):void 0}}},r.prototype.removeAllListeners=function(e){return e?"*"===e?this._starListeners=[]:this._listeners[e]=[]:(this._starListeners=[],this._listeners={}),this},r.prototype.listeners=function(e){var t="*"!==e?this._listeners[e]:this._starListeners,n=[];if(t)for(var i=t.length,s=0;s<i;s++)n.push(t[s]);return n},r.prototype._emit=function(e,t,n,i){if(void 0!==e&&0!==e.length){void 0===n&&(n=t,t=null),t&&(n=void 0!==i?[t].concat(n,i):[t].concat(n));for(var s=e.length,o=0;o<s;o++){var r=e[o];r.apply(r,n)}}}},37:function(e,t,n){"use strict";e.exports=function(e,t,n){var i,s=e.length;if(!(t>=s||0===n)){var o=s-(n=t+n>s?s-t:n);for(i=t;i<o;++i)e[i]=e[i+n];e.length=o}}},38:function(e,t,n){var i,s=n(39)(),o=n(15);r.disabled=!0;try{i=window.performance,r.disabled="true"===window.localStorage.DISABLE_NANOTIMING||!i.mark}catch(e){}function r(e){if(o.equal(typeof e,"string","nanotiming: name should be type string"),r.disabled)return u;var t=(1e4*i.now()).toFixed()%Number.MAX_SAFE_INTEGER,n="start-"+t+"-"+e;function c(o){var r="end-"+t+"-"+e;i.mark(r),s.push((function(){var s=null;try{var u=e+" ["+t+"]";i.measure(u,n,r),i.clearMarks(n),i.clearMarks(r)}catch(e){s=e}o&&o(s,e)}))}return i.mark(n),c.uuid=t,c}function u(e){e&&s.push((function(){e(new Error("nanotiming: performance API unavailable"))}))}e.exports=r},39:function(e,t,n){var i=n(15),s="undefined"!=typeof window;function o(e){this.hasWindow=e,this.hasIdle=this.hasWindow&&window.requestIdleCallback,this.method=this.hasIdle?window.requestIdleCallback.bind(window):this.setTimeout,this.scheduled=!1,this.queue=[]}o.prototype.push=function(e){i.equal(typeof e,"function","nanoscheduler.push: cb should be type function"),this.queue.push(e),this.schedule()},o.prototype.schedule=function(){if(!this.scheduled){this.scheduled=!0;var e=this;this.method((function(t){for(;e.queue.length&&t.timeRemaining()>0;)e.queue.shift()(t);e.scheduled=!1,e.queue.length&&e.schedule()}))}},o.prototype.setTimeout=function(e){setTimeout(e,0,{timeRemaining:function(){return 1}})},e.exports=function(){var e;return s?(window._nanoScheduler||(window._nanoScheduler=new o(!0)),e=window._nanoScheduler):e=new o,e}},4:function(e,t,n){"use strict";e.exports=function(e,t,n){var i,s=e.length;if(!(t>=s||0===n)){var o=s-(n=t+n>s?s-t:n);for(i=t;i<o;++i)e[i]=e[i+n];e.length=o}}},41:function(e,t,n){"use strict";n.r(t);var i=n(35),s=n.n(i),o=function(){function e(e){this.el=e,this.events=new s.a,this.Form=new r(e.querySelector(".new")),this.initEvents()}return e.prototype.onOrdered=function(e){this.events.addListener("ordered",e)},e.prototype.getListScreen=function(){return this.el.dataset.type},e.prototype.initEvents=function(){var e=this,t=this.getButton();t&&t.addEventListener("click",(function(n){n.preventDefault(),t.classList.contains("open")?e.cancelNewLayout():e.addNewLayout()})),jQuery(this.el).find(".layouts__items").sortable({items:".layouts__item",axis:"y",containment:jQuery(this.el).find(".layouts__items"),handle:".cpacicon-move",stop:function(){e.setNewOrder()}})},e.prototype.setNewOrder=function(){var e=this;this.storeLayoutOrder(this.getOrder()).done((function(){e.events.emit("ordered",e.getOrder())}))},e.prototype.getOrder=function(){var e=[];return this.el.querySelectorAll(".layouts__item").forEach((function(t){e.push(t.dataset.screen)})),e},e.prototype.storeLayoutOrder=function(e){return jQuery.ajax({url:ajaxurl,method:"POST",data:{_ajax_nonce:AC._ajax_nonce,action:"acp_update_layout_order",list_screen:this.getListScreen(),order:e}})},e.prototype.getButton=function(){return this.el.querySelector("a.add-new")},e.prototype.addNewLayout=function(){this.getButton().classList.add("open"),this.Form.open()},e.prototype.cancelNewLayout=function(){this.getButton().classList.remove("open"),this.Form.close()},e}(),r=function(){function e(e){this.el=e,this.initEvents()}return e.prototype.open=function(){jQuery(this.el).slideDown()},e.prototype.close=function(){jQuery(this.el).slideUp()},e.prototype.initEvents=function(){var e=this;this.el.querySelector(".new form").addEventListener("submit",(function(t){e.el.querySelector(".row.name input").value.trim()||(t.preventDefault(),e.el.querySelector(".row.name").classList.add("save-error"))}))},e}(),u=function(){function e(e){this.form=e,this.columns=e.getColumns(),this.setting=e.getElement().querySelector('[data-setting="sorting-preference"]'),this.selectElement=this.setting?this.setting.querySelector('[name="sorting"]'):null,this.setting&&this.init()}return e.prototype.init=function(){var e=this;this.columns.forEach((function(t){if(e.isSortable(t)){var n=document.createElement("option");n.value=t.getName(),n.text=(i=t.getJson().label)?i.replace(/(<([^>]+)>)/gi,""):"",n.text||(n.text=t.getElement().querySelector(".column_type .inner").innerText),e.selectElement.appendChild(n)}var i}));var t=this.selectElement.dataset.sorting;this.selectElement.querySelectorAll('[value="'+t+'"]').forEach((function(e){return e.selected=!0}))},e.prototype.isSortable=function(e){return e.getElement().querySelectorAll('table[data-setting="sort"] input[value="on"]:checked').length>0},e}(),c=function(){function e(e){this.Form=e,this.init()}return e.prototype.init=function(){jQuery(this.Form.querySelector("select.roles")).ac_select2({placeholder:acp_layouts.roles,theme:"acs2"}).on("select2:select",(function(){jQuery(this).ac_select2("open")})).on("select2:open",(function(){setTimeout((function(){jQuery(".select2-container.select2-container--open .select2-dropdown li[role=group]").each((function(){jQuery(this).find("li[aria-selected=false]").length>0?jQuery(this).show():jQuery(this).hide()}))}),1)}))},e}(),a=function(){function e(e){this.Form=e,this.init()}return e.prototype.init=function(){jQuery(this.Form.querySelector("select.users")).ac_select2({placeholder:acp_layouts.users,multiple:!0,theme:"acs2",minimumInputLength:0,escapeMarkup:function(e){return jQuery("<div>"+e+"</div>").text()},ajax:{type:"POST",url:ajaxurl,dataType:"json",delay:350,data:function(e){return{action:"acp_layout_get_users",_ajax_nonce:AC._ajax_nonce,search:e.term,page:e.page}},processResults:function(e){return e&&e.success&&e.data?e.data:{results:[]}},cache:!0}})},e}(),l=n(35),h=function(){function e(e){this.element=e,this.settings=[],this.init()}return e.prototype.init=function(){var e=this;document.querySelector(".ac-boxes.disabled")||(this.element.querySelectorAll("[data-setting]").forEach((function(t){var n=new p(t);n.events.on("change",(function(){e.checkDependent(n)})),e.settings.push(n)})),this.settings.forEach((function(e){return e.events.emit("change")})))},e.prototype.checkDependent=function(e){var t=e.isChecked();this.settings.forEach((function(n){n.isDependentOn(e.getName())&&(t?n.disable():n.enable())}))},e}(),p=function(){function e(e){this.element=e,this.name=e.dataset.setting,this.checkbox=e.querySelector("input[type=checkbox]"),this.dependentOn=e.dataset.dependent.split(","),this.events=l(),this.initEvents()}return e.prototype.initEvents=function(){var e=this;this.checkbox.addEventListener("change",(function(){e.events.emit("change")}))},e.prototype.disable=function(){this.element.classList.add("-disabled"),this.setChecked(!0),this.checkbox.setAttribute("disabled","true"),this.events.emit("change")},e.prototype.enable=function(){this.element.classList.remove("-disabled"),this.checkbox.removeAttribute("disabled"),this.events.emit("change")},e.prototype.setChecked=function(e){this.checkbox.checked=e,this.events.emit("change")},e.prototype.getName=function(){return this.name},e.prototype.isChecked=function(){return this.checkbox.checked},e.prototype.isDependentOn=function(e){return this.dependentOn.includes(e)},e}(),d=function(){function e(e,t){this.element=e,this.form=t,this.settings={},this.init()}return e.prototype.addSetting=function(e,t){this.settings[e]=t},e.prototype.init=function(){var e=this;this.addSetting("sorting",new u(this.form)),this.addSetting("roles",new c(this.element)),this.addSetting("users",new a(this.element)),this.element.querySelectorAll("#hide-on-screen").forEach((function(t){return e.addSetting("hideonscreen",new h(t))}))},e}(),f=n(2),y=Object(f.a)();y.addListener("Settings.Form.Ready",(function(e){var t=document.querySelector(".sidebox.layouts");if(t){var n=new o(t);y.registerService("OrderSidebox",n);var i=document.querySelector(".layout-selector ul");i&&n.onOrdered((function(e){var t=document.createElement("div");e.forEach((function(e){var n=i.querySelector('[data-screen="'+e+'"]');n&&t.appendChild(n)})),t.querySelectorAll("li").forEach((function(e){i.appendChild(e)}))}))}document.querySelector(".ac-setbox")&&y.registerService("ListScreenSettings",new d(document.querySelector(".ac-setbox"),e));var s=document.querySelector('#listscreen_settings input[name="title"]');s&&s.addEventListener("keyup",(function(){document.querySelectorAll('.layout-selector [data-screen="'+AC.layout+'"] a').forEach((function(e){e.innerHTML=s.value})),document.querySelectorAll('.layouts__items [data-screen="'+AC.layout+'"] [data-label]').forEach((function(e){e.innerHTML=s.value}))}))}))},5:function(e,t,n){var i,s=n(6)(),o=n(1);r.disabled=!0;try{i=window.performance,r.disabled="true"===window.localStorage.DISABLE_NANOTIMING||!i.mark}catch(e){}function r(e){if(o.equal(typeof e,"string","nanotiming: name should be type string"),r.disabled)return u;var t=(1e4*i.now()).toFixed()%Number.MAX_SAFE_INTEGER,n="start-"+t+"-"+e;function c(o){var r="end-"+t+"-"+e;i.mark(r),s.push((function(){var s=null;try{var u=e+" ["+t+"]";i.measure(u,n,r),i.clearMarks(n),i.clearMarks(r)}catch(e){s=e}o&&o(s,e)}))}return i.mark(n),c.uuid=t,c}function u(e){e&&s.push((function(){e(new Error("nanotiming: performance API unavailable"))}))}e.exports=r},6:function(e,t,n){var i=n(1),s="undefined"!=typeof window;function o(e){this.hasWindow=e,this.hasIdle=this.hasWindow&&window.requestIdleCallback,this.method=this.hasIdle?window.requestIdleCallback.bind(window):this.setTimeout,this.scheduled=!1,this.queue=[]}o.prototype.push=function(e){i.equal(typeof e,"function","nanoscheduler.push: cb should be type function"),this.queue.push(e),this.schedule()},o.prototype.schedule=function(){if(!this.scheduled){this.scheduled=!0;var e=this;this.method((function(t){for(;e.queue.length&&t.timeRemaining()>0;)e.queue.shift()(t);e.scheduled=!1,e.queue.length&&e.schedule()}))}},o.prototype.setTimeout=function(e){setTimeout(e,0,{timeRemaining:function(){return 1}})},e.exports=function(){var e;return s?(window._nanoScheduler||(window._nanoScheduler=new o(!0)),e=window._nanoScheduler):e=new o,e}}});