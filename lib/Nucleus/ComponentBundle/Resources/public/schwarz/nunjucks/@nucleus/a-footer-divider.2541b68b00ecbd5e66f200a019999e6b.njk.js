(window.nunjucksPrecompiled=window.nunjucksPrecompiled||{})["@nucleus/a-footer-divider.twig"]={root:function(e,t,r,a,o){var n=0,l=0;try{var i=a.makeMacro(["data"],[],(function(i,s){var d=r;r=new a.Frame,s=s||{},Object.prototype.hasOwnProperty.call(s,"caller")&&r.set("caller",s.caller),r.set("data",i);var u="";return u+="\n    ",u+="\n    ",e.getTemplate("@nucleus/_core.twig",!1,"@nucleus/a-footer-divider.twig",!1,(function(s,d){s?o(s):d.getExported((function(s,d){s?o(s):(t.setVariable("core",d),u+="\n\n    ",u+="\n    ",i=e.getFilter("validate_data").call(t,i,"nucleus/a-footer-divider",!1),r.set("data",i,!0),r.topLevel&&t.setVariable("data",i),r.topLevel&&t.addExport("data",i),u+="\n    ",(a.memberLookup(a.memberLookup(i,"_validation"),"hasErrors")||a.memberLookup(a.memberLookup(i,"_validation"),"hasWarnings"))&&(u+="\n        ",u+=a.suppressValue((n=7,l=39,a.callWrap(a.memberLookup(d,"renderValidationResults"),'core["renderValidationResults"]',t,[i])),e.opts.autoescape),u+="\n    "),u+="\n\n    ",a.memberLookup(a.memberLookup(i,"_validation"),"hasErrors")||(u+="\n        ",u+="\n        ",i=e.getFilter("merge_data").call(t,i,{htmlAttributes:{class:"nuc-a-footer-divider"}}),r.set("data",i,!0),r.topLevel&&t.setVariable("data",i),r.topLevel&&t.addExport("data",i),u+="\n\n        ",u+="\n        <div ",u+=a.suppressValue((n=19,l=33,a.callWrap(a.contextOrFrameLookup(t,r,"render_attributes"),"render_attributes",t,[a.memberLookup(i,"htmlAttributes"),a.memberLookup(i,"styleAttributes"),a.memberLookup(i,"extensions")])),e.opts.autoescape),u+="></div>\n    "),u+="\n")}))})),r=d,new a.SafeString(u)}));t.addExport("render"),t.setVariable("render",i),o(null,"")}catch(e){o(a.handleError(e,n,l))}}};