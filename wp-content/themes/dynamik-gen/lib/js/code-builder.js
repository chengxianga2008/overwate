// Clipboard Plugin - clipboard.js v1.5.15 - https://zenorocha.github.io/clipboard.js - Licensed MIT
!function(e){if("object"==typeof exports&&"undefined"!=typeof module)module.exports=e();else if("function"==typeof define&&define.amd)define([],e);else{var t;t="undefined"!=typeof window?window:"undefined"!=typeof global?global:"undefined"!=typeof self?self:this,t.Clipboard=e()}}(function(){var e,t,n;return function e(t,n,i){function o(a,c){if(!n[a]){if(!t[a]){var l="function"==typeof require&&require;if(!c&&l)return l(a,!0);if(r)return r(a,!0);var s=new Error("Cannot find module '"+a+"'");throw s.code="MODULE_NOT_FOUND",s}var u=n[a]={exports:{}};t[a][0].call(u.exports,function(e){var n=t[a][1][e];return o(n?n:e)},u,u.exports,e,t,n,i)}return n[a].exports}for(var r="function"==typeof require&&require,a=0;a<i.length;a++)o(i[a]);return o}({1:[function(e,t,n){function i(e,t){for(;e&&e!==document;){if(e.matches(t))return e;e=e.parentNode}}if(Element&&!Element.prototype.matches){var o=Element.prototype;o.matches=o.matchesSelector||o.mozMatchesSelector||o.msMatchesSelector||o.oMatchesSelector||o.webkitMatchesSelector}t.exports=i},{}],2:[function(e,t,n){function i(e,t,n,i,r){var a=o.apply(this,arguments);return e.addEventListener(n,a,r),{destroy:function(){e.removeEventListener(n,a,r)}}}function o(e,t,n,i){return function(n){n.delegateTarget=r(n.target,t),n.delegateTarget&&i.call(e,n)}}var r=e("./closest");t.exports=i},{"./closest":1}],3:[function(e,t,n){n.node=function(e){return void 0!==e&&e instanceof HTMLElement&&1===e.nodeType},n.nodeList=function(e){var t=Object.prototype.toString.call(e);return void 0!==e&&("[object NodeList]"===t||"[object HTMLCollection]"===t)&&"length"in e&&(0===e.length||n.node(e[0]))},n.string=function(e){return"string"==typeof e||e instanceof String},n.fn=function(e){var t=Object.prototype.toString.call(e);return"[object Function]"===t}},{}],4:[function(e,t,n){function i(e,t,n){if(!e&&!t&&!n)throw new Error("Missing required arguments");if(!c.string(t))throw new TypeError("Second argument must be a String");if(!c.fn(n))throw new TypeError("Third argument must be a Function");if(c.node(e))return o(e,t,n);if(c.nodeList(e))return r(e,t,n);if(c.string(e))return a(e,t,n);throw new TypeError("First argument must be a String, HTMLElement, HTMLCollection, or NodeList")}function o(e,t,n){return e.addEventListener(t,n),{destroy:function(){e.removeEventListener(t,n)}}}function r(e,t,n){return Array.prototype.forEach.call(e,function(e){e.addEventListener(t,n)}),{destroy:function(){Array.prototype.forEach.call(e,function(e){e.removeEventListener(t,n)})}}}function a(e,t,n){return l(document.body,e,t,n)}var c=e("./is"),l=e("delegate");t.exports=i},{"./is":3,delegate:2}],5:[function(e,t,n){function i(e){var t;if("SELECT"===e.nodeName)e.focus(),t=e.value;else if("INPUT"===e.nodeName||"TEXTAREA"===e.nodeName)e.focus(),e.setSelectionRange(0,e.value.length),t=e.value;else{e.hasAttribute("contenteditable")&&e.focus();var n=window.getSelection(),i=document.createRange();i.selectNodeContents(e),n.removeAllRanges(),n.addRange(i),t=n.toString()}return t}t.exports=i},{}],6:[function(e,t,n){function i(){}i.prototype={on:function(e,t,n){var i=this.e||(this.e={});return(i[e]||(i[e]=[])).push({fn:t,ctx:n}),this},once:function(e,t,n){function i(){o.off(e,i),t.apply(n,arguments)}var o=this;return i._=t,this.on(e,i,n)},emit:function(e){var t=[].slice.call(arguments,1),n=((this.e||(this.e={}))[e]||[]).slice(),i=0,o=n.length;for(i;i<o;i++)n[i].fn.apply(n[i].ctx,t);return this},off:function(e,t){var n=this.e||(this.e={}),i=n[e],o=[];if(i&&t)for(var r=0,a=i.length;r<a;r++)i[r].fn!==t&&i[r].fn._!==t&&o.push(i[r]);return o.length?n[e]=o:delete n[e],this}},t.exports=i},{}],7:[function(t,n,i){!function(o,r){if("function"==typeof e&&e.amd)e(["module","select"],r);else if("undefined"!=typeof i)r(n,t("select"));else{var a={exports:{}};r(a,o.select),o.clipboardAction=a.exports}}(this,function(e,t){"use strict";function n(e){return e&&e.__esModule?e:{default:e}}function i(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}var o=n(t),r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},a=function(){function e(e,t){for(var n=0;n<t.length;n++){var i=t[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}return function(t,n,i){return n&&e(t.prototype,n),i&&e(t,i),t}}(),c=function(){function e(t){i(this,e),this.resolveOptions(t),this.initSelection()}return a(e,[{key:"resolveOptions",value:function e(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};this.action=t.action,this.emitter=t.emitter,this.target=t.target,this.text=t.text,this.trigger=t.trigger,this.selectedText=""}},{key:"initSelection",value:function e(){this.text?this.selectFake():this.target&&this.selectTarget()}},{key:"selectFake",value:function e(){var t=this,n="rtl"==document.documentElement.getAttribute("dir");this.removeFake(),this.fakeHandlerCallback=function(){return t.removeFake()},this.fakeHandler=document.body.addEventListener("click",this.fakeHandlerCallback)||!0,this.fakeElem=document.createElement("textarea"),this.fakeElem.style.fontSize="12pt",this.fakeElem.style.border="0",this.fakeElem.style.padding="0",this.fakeElem.style.margin="0",this.fakeElem.style.position="absolute",this.fakeElem.style[n?"right":"left"]="-9999px";var i=window.pageYOffset||document.documentElement.scrollTop;this.fakeElem.addEventListener("focus",window.scrollTo(0,i)),this.fakeElem.style.top=i+"px",this.fakeElem.setAttribute("readonly",""),this.fakeElem.value=this.text,document.body.appendChild(this.fakeElem),this.selectedText=(0,o.default)(this.fakeElem),this.copyText()}},{key:"removeFake",value:function e(){this.fakeHandler&&(document.body.removeEventListener("click",this.fakeHandlerCallback),this.fakeHandler=null,this.fakeHandlerCallback=null),this.fakeElem&&(document.body.removeChild(this.fakeElem),this.fakeElem=null)}},{key:"selectTarget",value:function e(){this.selectedText=(0,o.default)(this.target),this.copyText()}},{key:"copyText",value:function e(){var t=void 0;try{t=document.execCommand(this.action)}catch(e){t=!1}this.handleResult(t)}},{key:"handleResult",value:function e(t){this.emitter.emit(t?"success":"error",{action:this.action,text:this.selectedText,trigger:this.trigger,clearSelection:this.clearSelection.bind(this)})}},{key:"clearSelection",value:function e(){this.target&&this.target.blur(),window.getSelection().removeAllRanges()}},{key:"destroy",value:function e(){this.removeFake()}},{key:"action",set:function e(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"copy";if(this._action=t,"copy"!==this._action&&"cut"!==this._action)throw new Error('Invalid "action" value, use either "copy" or "cut"')},get:function e(){return this._action}},{key:"target",set:function e(t){if(void 0!==t){if(!t||"object"!==("undefined"==typeof t?"undefined":r(t))||1!==t.nodeType)throw new Error('Invalid "target" value, use a valid Element');if("copy"===this.action&&t.hasAttribute("disabled"))throw new Error('Invalid "target" attribute. Please use "readonly" instead of "disabled" attribute');if("cut"===this.action&&(t.hasAttribute("readonly")||t.hasAttribute("disabled")))throw new Error('Invalid "target" attribute. You can\'t cut text from elements with "readonly" or "disabled" attributes');this._target=t}},get:function e(){return this._target}}]),e}();e.exports=c})},{select:5}],8:[function(t,n,i){!function(o,r){if("function"==typeof e&&e.amd)e(["module","./clipboard-action","tiny-emitter","good-listener"],r);else if("undefined"!=typeof i)r(n,t("./clipboard-action"),t("tiny-emitter"),t("good-listener"));else{var a={exports:{}};r(a,o.clipboardAction,o.tinyEmitter,o.goodListener),o.clipboard=a.exports}}(this,function(e,t,n,i){"use strict";function o(e){return e&&e.__esModule?e:{default:e}}function r(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function a(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!=typeof t&&"function"!=typeof t?e:t}function c(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}function l(e,t){var n="data-clipboard-"+e;if(t.hasAttribute(n))return t.getAttribute(n)}var s=o(t),u=o(n),f=o(i),d=function(){function e(e,t){for(var n=0;n<t.length;n++){var i=t[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}return function(t,n,i){return n&&e(t.prototype,n),i&&e(t,i),t}}(),h=function(e){function t(e,n){r(this,t);var i=a(this,(t.__proto__||Object.getPrototypeOf(t)).call(this));return i.resolveOptions(n),i.listenClick(e),i}return c(t,e),d(t,[{key:"resolveOptions",value:function e(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};this.action="function"==typeof t.action?t.action:this.defaultAction,this.target="function"==typeof t.target?t.target:this.defaultTarget,this.text="function"==typeof t.text?t.text:this.defaultText}},{key:"listenClick",value:function e(t){var n=this;this.listener=(0,f.default)(t,"click",function(e){return n.onClick(e)})}},{key:"onClick",value:function e(t){var n=t.delegateTarget||t.currentTarget;this.clipboardAction&&(this.clipboardAction=null),this.clipboardAction=new s.default({action:this.action(n),target:this.target(n),text:this.text(n),trigger:n,emitter:this})}},{key:"defaultAction",value:function e(t){return l("action",t)}},{key:"defaultTarget",value:function e(t){var n=l("target",t);if(n)return document.querySelector(n)}},{key:"defaultText",value:function e(t){return l("text",t)}},{key:"destroy",value:function e(){this.listener.destroy(),this.clipboardAction&&(this.clipboardAction.destroy(),this.clipboardAction=null)}}]),t}(u.default);e.exports=h})},{"./clipboard-action":7,"good-listener":4,"tiny-emitter":6}]},{},[8])(8)});

// Tabby Plugin
!function(t){function e(t,e,r){var g=t.scrollTop;t.setSelectionRange?n(t,e,r):document.selection&&a(t,e,r),t.scrollTop=g}function n(t,e,n){var a=t.selectionStart,r=t.selectionEnd;if(a===r)e?a-n.tabString===t.value.substring(a-n.tabString.length,a)?(t.value=t.value.substring(0,a-n.tabString.length)+t.value.substring(a),t.focus(),t.setSelectionRange(a-n.tabString.length,a-n.tabString.length)):a-n.tabString===t.value.substring(a,a+n.tabString.length)&&(t.value=t.value.substring(0,a)+t.value.substring(a+n.tabString.length),t.focus(),t.setSelectionRange(a,a)):(t.value=t.value.substring(0,a)+n.tabString+t.value.substring(a),t.focus(),t.setSelectionRange(a+n.tabString.length,a+n.tabString.length));else{for(;a<t.value.length&&t.value.charAt(a).match(/[ \t]/);)a++;var g=t.value.split("\n"),l=[],i=0,s=0,b=0;for(b in g)s=i+g[b].length,l.push({start:i,end:s,selected:a>=i&&s>a||s>=r&&r>i||i>a&&r>s}),i=s+1;var o=0;for(b in l)if(l[b].selected){var u=l[b].start+o;e&&n.tabString===t.value.substring(u,u+n.tabString.length)?(t.value=t.value.substring(0,u)+t.value.substring(u+n.tabString.length),o-=n.tabString.length):e||(t.value=t.value.substring(0,u)+n.tabString+t.value.substring(u),o+=n.tabString.length)}t.focus();var c=a+(o>0?n.tabString.length:0>o?-n.tabString.length:0),h=r+o;t.setSelectionRange(c,h)}}function a(e,n,a){var r=document.selection.createRange();if(e===r.parentElement())if(""===r.text)if(n){var g=r.getBookmark();r.moveStart("character",-a.tabString.length),a.tabString===r.text?r.text="":(r.moveToBookmark(g),r.moveEnd("character",a.tabString.length),a.tabString===r.text&&(r.text="")),r.collapse(!0),r.select()}else r.text=a.tabString,r.collapse(!1),r.select();else{var l=r.text,i=l.length,s=l.split("\r\n"),b=document.body.createTextRange();b.moveToElementText(e),b.setEndPoint("EndToStart",r);var o=b.text,u=o.split("\r\n"),c=o.length,h=document.body.createTextRange();h.moveToElementText(e),h.setEndPoint("StartToEnd",r);var S=h.text,f=document.body.createTextRange();f.moveToElementText(e),f.setEndPoint("StartToEnd",b);var d=f.text,v=t(e).html();t("#r3").text(c+" + "+i+" + "+S.length+" = "+v.length),c+d.length<v.length?(u.push(""),c+=2,n&&a.tabString===s[0].substring(0,a.tabString.length)?s[0]=s[0].substring(a.tabString.length):n||(s[0]=a.tabString+s[0])):n&&a.tabString===u[u.length-1].substring(0,a.tabString.length)?u[u.length-1]=u[u.length-1].substring(a.tabString.length):n||(u[u.length-1]=a.tabString+u[u.length-1]);for(var m=1;m<s.length;m++)n&&a.tabString===s[m].substring(0,a.tabString.length)?s[m]=s[m].substring(a.tabString.length):n||(s[m]=a.tabString+s[m]);1===u.length&&0===c&&(n&&a.tabString===s[0].substring(0,a.tabString.length)?s[0]=s[0].substring(a.tabString.length):n||(s[0]=a.tabString+s[0])),c+i+S.length<v.length&&(s.push(""),i+=2),b.text=u.join("\r\n"),r.text=s.join("\r\n");var T=document.body.createTextRange();T.moveToElementText(e),c>0?T.setEndPoint("StartToEnd",b):T.setEndPoint("StartToStart",b),T.setEndPoint("EndToEnd",r),T.select()}}t.fn.tabby=function(n){var a=t.extend({},t.fn.tabby.defaults,n),r=t.fn.tabby.pressed;return this.each(function(){var n=t(this),g=t.meta?t.extend({},a,n.data()):a;n.bind("keydown",function(n){var a=t.fn.tabby.catch_kc(n);return 16===a&&(r.shft=!0),17===a&&(r.ctrl=!0,setTimeout(function(){t.fn.tabby.pressed.ctrl=!1},1e3)),18===a&&(r.alt=!0,setTimeout(function(){t.fn.tabby.pressed.alt=!1},1e3)),9!==a||r.ctrl||r.alt?void 0:(n.preventDefault(),r.last=a,setTimeout(function(){t.fn.tabby.pressed.last=null},0),e(t(n.target).get(0),r.shft,g),!1)}).bind("keyup",function(e){16===t.fn.tabby.catch_kc(e)&&(r.shft=!1)}).bind("blur",function(e){9===r.last&&t(e.target).one("focus",function(){r.last=null}).get(0).focus()})})},t.fn.tabby.catch_kc=function(t){return t.keyCode?t.keyCode:t.charCode?t.charCode:t.which},t.fn.tabby.pressed={shft:!1,ctrl:!1,alt:!1,last:null},t.fn.tabby.defaults={tabString:String.fromCharCode(9)}}(jQuery);

// Caret Plugin
function insertAtCaret(a,b){if(document.selection){a.focus();var c=a.value.replace(/\r\n/g,"\n"),d=document.selection.createRange();if(d.parentElement()!=a)return!1;d.text=b;for(var e=tmp=a.value.replace(/\r\n/g,"\n"),f=0;f<c.length&&c.charAt(f)==e.charAt(f);f++);for(var g=0,h=0;tmp.match(b)&&(tmp=tmp.replace(b,""))&&g<=f;g=h+b.length)h=e.indexOf(b,g)}else if(a.selectionStart){var h=a.selectionStart,i=a.selectionEnd;a.value=a.value.substr(0,h)+b+a.value.substr(i,a.value.length)}null!=h?setCaretTo(a,h+b.length):a.value+=b}function setCaretTo(a,b){if(a.createTextRange){var c=a.createTextRange();c.move("character",b),c.select()}else a.selectionStart&&(a.focus(),a.setSelectionRange(b,b))}

jQuery(document).ready(function($) {
	
    /* Clipboard */
    var clipboard = new Clipboard('.code-builder-output-cut');
    clipboard.on('success', function(e) {
        console.log(e);
    });
    clipboard.on('error', function(e) {
        console.log(e);
    });
	$('#dynamik-fe-css-builder-output-cut-button').click(function() {
		var custom_css = $('#dynamik-fe-css-builder-output').val();
		var new_custom_css = custom_css.replace(/\n\n}/g,'\n}');
		$('#dynamik-fe-css-builder-output').val(new_custom_css);
	});
	$('#css-builder-output-cut-button').click(function() {
		var custom_css = $('#css-builder-output').val();
		var new_custom_css = custom_css.replace(/\n\n}/g,'\n}');
		$('#css-builder-output').val(new_custom_css);
	});
	$('#php-builder-output-cut-button').click(function() {
		var custom_php = $('#php-builder-output').val();
		var new_custom_php = custom_php.replace(/\n\n}/g,'\n}');
		$('#php-builder-output').val(new_custom_php);
	});
	$('.code-builder-output-cut').click(function(event) {
		var clickCounter = 1;
		$(event.target).data('clickCounter', clickCounter);
	});
	var code_builder_val_change = function() {
		var clickCounter = 0;
		var code_builder_id = $(this).attr('id');
		var code = $('#'+code_builder_id).val();
		if(code == '' && $('#'+code_builder_id+'-cut-button').data('clickCounter') == 1) {
			$('#'+code_builder_id+'-cut-button').hide();
			$('#'+code_builder_id+'-copied-button').show();
			$('.code-builder-output-cut').addClass('code-builder-output-cut-copied');	
			$('#'+code_builder_id+'-cut-button').data('clickCounter', 0);
		} else {
			$('#'+code_builder_id+'-cut-button').show();
			$('#'+code_builder_id+'-copied-button').hide();
			$('.code-builder-output-cut').removeClass('code-builder-output-cut-copied');			
		}
	}
	$('.code-builder-output').bind('input propertychange', code_builder_val_change);
    /* END Clipboard */
    
	$('.code-builder-output').tabby();
	
	$.fn.selectRange = function(start, end) {
		return this.each(function() {
			if (this.setSelectionRange) {
				this.focus();
				this.setSelectionRange(start, end);
			} else if (this.createTextRange) {
				var range = this.createTextRange();
				range.collapse(true);
				range.moveEnd('character', end);
				range.moveStart('character', start);
				range.select();
			}
		});
	};
	
	$.fn.insertAtCaret = function (tagName) {
		return this.each(function(){
			if (document.selection) {
				//IE support
				this.focus();
				sel = document.selection.createRange();
				sel.text = tagName;
				this.focus();
			} else if (this.selectionStart || this.selectionStart == '0') {
				//MOZILLA/NETSCAPE support
				startPos = this.selectionStart;
				endPos = this.selectionEnd;
				scrollTop = this.scrollTop;
				this.value = this.value.substring(0, startPos) + tagName + this.value.substring(endPos,this.value.length);
				this.focus();
				this.selectionStart = startPos + tagName.length;
				this.selectionEnd = startPos + tagName.length;
				this.scrollTop = scrollTop;
			} else {
				this.value += tagName;
				this.focus();
			}
		});
	};
	
});