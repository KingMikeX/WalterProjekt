(window.nunjucksPrecompiled=window.nunjucksPrecompiled||{})["@nucleus/m-link.twig"]={root:function(e,t,o,n,r){var a=0,l=0,i="";try{var u=n.makeMacro(["data"],[],(function(i,u){var s=o;o=new n.Frame,u=u||{},Object.prototype.hasOwnProperty.call(u,"caller")&&o.set("caller",u.caller),o.set("data",i);var m="";return m+="\n    ",m+="\n    ",e.getTemplate("@nucleus/_core.twig",!1,"@nucleus/m-link.twig",!1,(function(u,s){u?r(u):s.getExported((function(u,s){u?r(u):(t.setVariable("core",s),m+="\n    ",e.getTemplate("@nucleus/a-anchor.twig",!1,"@nucleus/m-link.twig",!1,(function(u,c){u?r(u):c.getExported((function(u,c){u?r(u):(t.setVariable("aAnchor",c),m+="\n    ",e.getTemplate("@nucleus/a-button.twig",!1,"@nucleus/m-link.twig",!1,(function(u,p){u?r(u):p.getExported((function(u,p){u?r(u):(t.setVariable("aButton",p),m+="\n    ",e.getTemplate("@nucleus/a-text.twig",!1,"@nucleus/m-link.twig",!1,(function(u,d){u?r(u):d.getExported((function(u,d){u?r(u):(t.setVariable("aText",d),m+="\n    ",e.getTemplate("@nucleus/a-icon.twig",!1,"@nucleus/m-link.twig",!1,(function(u,b){u?r(u):b.getExported((function(u,b){var k;u?r(u):(t.setVariable("aIcon",b),m+="\n\n    ",m+="\n    ",i=e.getFilter("validate_data").call(t,i,"nucleus/m-link",!1),o.set("data",i,!0),o.topLevel&&t.setVariable("data",i),o.topLevel&&t.addExport("data",i),m+="\n    ",(n.memberLookup(n.memberLookup(i,"_validation"),"hasErrors")||n.memberLookup(n.memberLookup(i,"_validation"),"hasWarnings"))&&(m+="\n        ",m+=n.suppressValue((a=11,l=39,n.callWrap(n.memberLookup(s,"renderValidationResults"),'core["renderValidationResults"]',t,[i])),e.opts.autoescape),m+="\n    "),m+="\n\n    ",n.memberLookup(n.memberLookup(i,"_validation"),"hasErrors")||(m+="\n        ",m+="\n        ",i=e.getFilter("merge_data").call(t,i,{htmlAttributes:{classList:["nuc-m-link",e.getFilter("get_modifier").call(t,n.memberLookup(i,"isNegative"),"nuc-m-link--negative"),e.getFilter("get_modifier").call(t,n.memberLookup(i,"iconPosition"),"nuc-m-link--icon-position",{additionalCondition:1==!e.getTest("empty").call(t,n.memberLookup(i,"icon"))&&1==!e.getTest("empty").call(t,n.memberLookup(i,"text")),property:"iconPosition",omitDefaultModifier:!0})]}}),o.set("data",i,!0),o.topLevel&&t.setVariable("data",i),o.topLevel&&t.addExport("data",i),m+="\n        ","basic"==n.memberLookup(i,"size")?(m+="\n            ",o.set("_iconSize","24",!0),o.topLevel&&t.setVariable("_iconSize","24"),m+="\n        "):"small"==n.memberLookup(i,"size")?(m+="\n            ",o.set("_iconSize","16",!0),o.topLevel&&t.setVariable("_iconSize","16"),m+="\n        "):"large"==n.memberLookup(i,"size")&&(m+="\n            ",o.set("_iconSize","32",!0),o.topLevel&&t.setVariable("_iconSize","32"),m+="\n        "),m+="\n\n        ",!0===e.getTest("empty").call(t,n.memberLookup(i,"text"))&&!0===e.getTest("empty").call(t,n.memberLookup(i,"icon"))&&(m+="\n            ",m+=n.suppressValue((a=38,l=30,n.callWrap(n.contextOrFrameLookup(t,o,"throw_exception"),"throw_exception",t,["You must provide either a text or an icon in nucleus/m-link."])),e.opts.autoescape),m+="\n        "),m+="\n\n        ",m+="\n        ",k=function(){var r="";return r+="\n            ",1==!e.getTest("empty").call(t,n.memberLookup(i,"icon"))&&(r+="\n                ",r+=n.suppressValue((a=44,l=31,n.callWrap(n.memberLookup(b,"render"),'aIcon["render"]',t,[{component:"nucleus/a-icon",htmlAttributes:{class:"nuc-m-link__icon"},id:n.memberLookup(i,"icon"),size:n.contextOrFrameLookup(t,o,"_iconSize")}])),e.opts.autoescape),r+="\n            "),r+="\n            ",1==!e.getTest("empty").call(t,n.memberLookup(i,"text"))&&(r+="\n                ",r+=n.suppressValue((a=54,l=31,n.callWrap(n.memberLookup(d,"render"),'aText["render"]',t,[{component:"nucleus/a-text",htmlAttributes:{class:"nuc-m-link__text"},content:n.memberLookup(i,"text"),type:n.memberLookup(i,"size")}])),e.opts.autoescape),r+="\n            "),r+="\n        "}(),o.set("embeddedContent",k,!0),o.topLevel&&t.setVariable("embeddedContent",k),o.topLevel&&t.addExport("embeddedContent",k),m+="\n\n        ",1==!e.getTest("empty").call(t,n.memberLookup(i,"objectAnchor"))?(m+="\n            ",m+=n.suppressValue((a=66,l=29,n.callWrap(n.memberLookup(c,"render"),'aAnchor["render"]',t,[e.getFilter("merge_data").call(t,n.memberLookup(i,"objectAnchor"),{component:"nucleus/a-anchor",htmlAttributes:n.memberLookup(i,"htmlAttributes"),styleAttributes:n.memberLookup(i,"styleAttributes"),extensions:n.memberLookup(i,"extensions"),embedded:[n.contextOrFrameLookup(t,o,"embeddedContent")]})])),e.opts.autoescape),m+="\n        "):1==!e.getTest("empty").call(t,n.memberLookup(i,"objectButton"))?(m+="\n            ",m+=n.suppressValue((a=76,l=29,n.callWrap(n.memberLookup(p,"render"),'aButton["render"]',t,[e.getFilter("merge_data").call(t,n.memberLookup(i,"objectButton"),{component:"nucleus/a-button",htmlAttributes:n.memberLookup(i,"htmlAttributes"),styleAttributes:n.memberLookup(i,"styleAttributes"),extensions:n.memberLookup(i,"extensions"),embedded:[n.contextOrFrameLookup(t,o,"embeddedContent")]})])),e.opts.autoescape),m+="\n        "):(m+="\n            ",m+=n.suppressValue((a=86,l=30,n.callWrap(n.contextOrFrameLookup(t,o,"throw_exception"),"throw_exception",t,["Either objectAnchor or objectButton must be provided in nucleus/m-link"])),e.opts.autoescape),m+="\n        "),m+="\n    "),m+="\n")}))})))}))})))}))})))}))})))}))})),o=s,new n.SafeString(m)}));t.addExport("render"),t.setVariable("render",u),r(null,i+="\n")}catch(e){r(n.handleError(e,a,l))}}};