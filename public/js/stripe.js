(window.webpackJsonp=window.webpackJsonp||[]).push([[3],{1:function(t,e,s){t.exports=s("r8oN")},F5S7:function(t,e,s){"use strict";s.r(e);var n=s("URgk"),a={props:{name:{type:String,default:""},stripeKey:{type:String,default:""},clientSecret:{type:String,default:""},plan:{type:String,default:""},amount:{type:String,default:""},wechatCallback:{type:String,default:""},alipayCallback:{type:String,default:""},callback:{type:String,default:""},confirm:{type:Boolean,default:!1},paymentSucceeded:{type:Boolean,default:!1},paymentCancelled:{type:Boolean,default:!1}},data:function(){return{stripe:null,zip:"",errors:"",successMessage:"",cardElement:null,paymentMethod:"",token:"",paymentQRUrl:"",wechatSource:"",rate:0,paymentProcessing:!1,paymentProcessed:!1}},mounted:function(){this.token=document.head.querySelector('meta[name="csrf-token"]').content,(this.paymentSucceeded||this.paymentCancelled)&&(this.paymentProcessed=!0),this.paymentProcessed||this.start()},methods:{start:function(){this.paymentQRUrl="","annual"===this.plan?this.rate=1039:"monthly"===this.plan&&(this.rate=113),this.stripe=Stripe(this.stripeKey)},handleError:function(t){"parameter_invalid_empty"===t.code&&"payment_method_data[billing_details][name]"===t.param?this.errors=this.$t("settings.subscriptions_payment_error_name"):this.errors=t.message},subscribe:function(){var t=this;this.errors="",this.paymentProcessing=!0,this.paymentProcessed=!1,this.stripe.handleCardSetup(t.clientSecret,t.cardElement,{payment_method_data:{billing_details:{name:t.name,address:{postal_code:t.zip}}}}).then((function(e){t.paymentProcessing=!1,e.error?t.handleError(e.error):(t.paymentProcessed=!0,t.paymentSucceeded=!0,t.successMessage=t.$t("settings.subscriptions_payment_success"),t.notify(t.successMessage,!0),t.processPayment(e.setupIntent))}))},processPayment:function(t){var e=this;this.paymentMethod=t.payment_method,Object(n.setTimeout)((function(){e.$refs.form.submit()}),10)},alipayPayment:function(){this.paymentProcessing=!0,this.paymentProcessed=!1,this.errorMessage="",this.stripe.createSource({type:"alipay",amount:this.rate,redirect:{return_url:this.alipayCallback},currency:"cad"}).then((function(t){console.log(t);var e=t.source;window.location.replace(e.redirect.url)}))},wechatPayment:function(){var t=this;this.paymentProcessing=!0,this.paymentProcessed=!1,this.errorMessage="",this.stripe.createSource({type:"wechat",amount:this.rate,currency:"cad"}).then((function(e){if(!e.source)throw new Error(e.e);var s=e.source;t.paymentQRUrl="http://qr.liantu.com/api.php?text="+s.wechat.qr_code_url,t.wechatSource=s.id}))},confirmPayment:function(){var t=this;this.paymentProcessing=!0,this.paymentProcessed=!1,this.errorMessage="",this.stripe.handleCardPayment(t.clientSecret,t.cardElement,{payment_method_data:{billing_details:{name:this.name}}}).then((function(e){t.paymentProcessing=!1,e.error?t.handleError(e.error):(t.paymentProcessed=!0,t.paymentSucceeded=!0,t.successMessage=t.$t("settings.subscriptions_payment_success"),t.notify(t.successMessage,!0),Object(n.setTimeout)((function(){window.location=t.callback}),3e3))}))},notify:function(t,e){this.$notify({group:"subscription",title:t,text:"",type:e?"success":"error"})}}},r=s("KHd+"),i=Object(r.a)(a,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("form",{ref:"form",staticClass:"mb4",attrs:{action:t.callback,method:"post"},on:{submit:function(t){t.preventDefault()}}},[s("notifications",{attrs:{group:"subscription",position:"top middle",duration:5e3,width:"400"}}),t._v(" "),s("div",{staticClass:"form-group"},[t.errors?s("div",{staticClass:"alert alert-danger w-100",attrs:{role:"alert"}},[t._v("\n      "+t._s(t.errors)+"\n    ")]):t._e(),t._v(" "),t.paymentSucceeded?s("div",[s("h1",{staticClass:"text-xl mt-2 mb-4 text-gray-700"},[t._v("\n        "+t._s(t.$t("settings.subscriptions_payment_succeeded_title"))+"\n      ")]),t._v(" "),t.successMessage?s("p",{staticClass:"mb-6"},[t._v("\n        "+t._s(t.successMessage)+"\n      ")]):s("p",{staticClass:"mb-6"},[t._v("\n        "+t._s(t.$t("settings.subscriptions_payment_succeeded"))+"\n      ")])]):t.paymentCancelled?s("div",[s("h1",{staticClass:"text-xl mt-2 mb-4 text-gray-700"},[t._v("\n        "+t._s(t.$t("settings.subscriptions_payment_cancelled_title"))+"\n      ")]),t._v(" "),s("p",{staticClass:"mb-6"},[t._v("\n        "+t._s(t.$t("settings.subscriptions_payment_cancelled"))+"\n      ")])]):t.paymentProcessed?t._e():s("div",{staticClass:"b--gray-monica ba pa4 br2 mb3 bg-black-05",attrs:{id:"payment-elements"}},[s("button",{staticClass:"btn btn-primary w-100 mt3",attrs:{id:"card-button",disabled:t.paymentProcessing},on:{click:function(e){return e.preventDefault(),t.wechatPayment()}}},[t._v("\n        微信支付\n      ")]),t._v(" "),s("button",{staticClass:"btn btn-primary w-100 mt3",attrs:{id:"card-button",disabled:t.paymentProcessing},on:{click:function(e){return e.preventDefault(),t.alipayPayment()}}},[t._v("\n        支付宝\n      ")])]),t._v(" "),t.paymentQRUrl?s("div",[s("p",[t._v("请使用微信扫码支付")]),t._v(" "),s("img",{staticClass:"mx-auto d-block",attrs:{src:t.paymentQRUrl}}),t._v(" "),s("a",{staticClass:"btn btn-primary w-100 mt3",attrs:{href:t.wechatCallback+"&source="+t.wechatSource}},[t._v("在微信上完成支付后点我")])]):t._e(),t._v(" "),t.paymentProcessed?s("a",{staticClass:"btn btn-secondary w-100 tc",attrs:{href:t.callback}},[t._v("\n      "+t._s(t.$t("app.go_back"))+"\n    ")]):t._e()]),t._v(" "),s("input",{attrs:{type:"hidden",name:"_token"},domProps:{value:t.token}}),t._v(" "),s("input",{attrs:{type:"hidden",name:"plan"},domProps:{value:t.plan}}),t._v(" "),s("input",{attrs:{type:"hidden",name:"payment_method"},domProps:{value:t.paymentMethod}})],1)}),[],!1,null,"c3596dd6",null);e.default=i.exports},r8oN:function(t,e,s){"use strict";s.r(e);var n=s("7pj7"),a=s.n(n);s("HijD"),window.Vue=s("XuX8"),Vue.use(a.a),Vue.component("stripe-subscription",s("F5S7").default),Vue.component("form-input",s("ck2m").default),Vue.component("contact-search",s("DaWx").default),s("C2KU").default.loadLanguage(window.Laravel.locale,!0).then((function(t){return new Vue({i18n:t,data:{htmldir:window.Laravel.htmldir,locale:t.locale}}).$mount("#app")})),$(document).ready((function(){}))}},[[1,0,1]]]);