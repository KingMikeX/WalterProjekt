(window.nunjucksPrecompiled=window.nunjucksPrecompiled||{})["@nucleus/m-tab-item.twig"]={root:function(e,t,a,n,o){var r=0,u=0;try{var l=n.makeMacro(["data"],[],(function(l,s){var i=a;a=new n.Frame,s=s||{},Object.prototype.hasOwnProperty.call(s,"caller")&&a.set("caller",s.caller),a.set("data",l);var m="";return m+="\n    ",m+="\n    ",e.getTemplate("@nucleus/_core.twig",!1,"@nucleus/m-tab-item.twig",!1,(function(s,i){s?o(s):i.getExported((function(s,i){s?o(s):(t.setVariable("core",i),m+="\n    ",e.getTemplate("@nucleus/a-button.twig",!1,"@nucleus/m-tab-item.twig",!1,(function(s,c){s?o(s):c.getExported((function(s,c){s?o(s):(t.setVariable("aButton",c),m+="\n    ",e.getTemplate("@nucleus/a-icon.twig",!1,"@nucleus/m-tab-item.twig",!1,(function(s,p){s?o(s):p.getExported((function(s,p){var d;s?o(s):(t.setVariable("aIcon",p),m+="\n\n    ",m+="\n    ",l=e.getFilter("validate_data").call(t,l,"nucleus/m-tab-item",!1),a.set("data",l,!0),a.topLevel&&t.setVariable("data",l),a.topLevel&&t.addExport("data",l),m+="\n    ",(n.memberLookup(n.memberLookup(l,"_validation"),"hasErrors")||n.memberLookup(n.memberLookup(l,"_validation"),"hasWarnings"))&&(m+="\n        ",m+=n.suppressValue((r=9,u=39,n.callWrap(n.memberLookup(i,"renderValidationResults"),'core["renderValidationResults"]',t,[l])),e.opts.autoescape),m+="\n    "),m+="\n\n    ",n.memberLookup(n.memberLookup(l,"_validation"),"hasErrors")||(m+="\n        ",m+="\n        ",l=e.getFilter("merge_data").call(t,l,{htmlAttributes:{classList:["nuc-m-tab-item",e.getFilter("get_modifier").call(t,n.memberLookup(l,"isSelected"),"nuc-m-tab-item--selected")],role:"tab"}}),a.set("data",l,!0),a.topLevel&&t.setVariable("data",l),a.topLevel&&t.addExport("data",l),m+="\n\n        ",d=function(){var a="";return a+="\n            ",a+=n.suppressValue(n.memberLookup(l,"text"),e.opts.autoescape),a+="\n            ",a+=n.suppressValue((r=26,u=27,n.callWrap(n.memberLookup(p,"render"),'aIcon["render"]',t,[{component:"nucleus/a-icon",htmlAttributes:{classList:["nuc-m-tab-item__icon-left"]},id:"nucleus/left",size:"inherit"}])),e.opts.autoescape),a+="\n            ",a+=n.suppressValue((r=36,u=27,n.callWrap(n.memberLookup(p,"render"),'aIcon["render"]',t,[{component:"nucleus/a-icon",htmlAttributes:{classList:["nuc-m-tab-item__icon-right"]},id:"nucleus/right",size:"inherit"}])),e.opts.autoescape),a+="\n        "}(),a.set("embeddedButton",d,!0),a.topLevel&&t.setVariable("embeddedButton",d),a.topLevel&&t.addExport("embeddedButton",d),m+="\n\n        ",m+="\n        ",m+=n.suppressValue((r=49,u=25,n.callWrap(n.memberLookup(c,"render"),'aButton["render"]',t,[e.getFilter("merge_data").call(t,n.memberLookup(l,"objectButton"),{component:"nucleus/a-button",htmlAttributes:n.memberLookup(l,"htmlAttributes"),styleAttributes:n.memberLookup(l,"styleAttributes"),extensions:n.memberLookup(l,"extensions"),embedded:[n.contextOrFrameLookup(t,a,"embeddedButton")]})])),e.opts.autoescape),m+="\n    "),m+="\n")}))})))}))})))}))})),a=i,new n.SafeString(m)}));t.addExport("render"),t.setVariable("render",l),o(null,"")}catch(e){o(n.handleError(e,r,u))}}};