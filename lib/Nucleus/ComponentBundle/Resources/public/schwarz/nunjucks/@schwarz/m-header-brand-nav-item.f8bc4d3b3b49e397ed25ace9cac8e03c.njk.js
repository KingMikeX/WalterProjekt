(window.nunjucksPrecompiled=window.nunjucksPrecompiled||{})["@schwarz/m-header-brand-nav-item.twig"]={root:function(e,a,r,t,n){var o=0,l=0;try{var s=t.makeMacro(["data"],[],(function(s,d){var m=r;r=new t.Frame,d=d||{},Object.prototype.hasOwnProperty.call(d,"caller")&&r.set("caller",d.caller),r.set("data",s);var i="";return i+="\n    ",i+="\n    ",e.getTemplate("@nucleus/_core.twig",!1,"@schwarz/m-header-brand-nav-item.twig",!1,(function(d,m){d?n(d):m.getExported((function(d,m){d?n(d):(a.setVariable("core",m),i+="\n    ",e.getTemplate("@nucleus/a-anchor.twig",!1,"@schwarz/m-header-brand-nav-item.twig",!1,(function(d,c){d?n(d):c.getExported((function(d,c){d?n(d):(a.setVariable("aAnchor",c),i+="\n\n    ",i+="\n    ",s=e.getFilter("validate_data").call(a,s,"schwarz/m-header-brand-nav-item",!1),r.set("data",s,!0),r.topLevel&&a.setVariable("data",s),r.topLevel&&a.addExport("data",s),i+="\n    ",(t.memberLookup(t.memberLookup(s,"_validation"),"hasErrors")||t.memberLookup(t.memberLookup(s,"_validation"),"hasWarnings"))&&(i+="\n        ",i+=t.suppressValue((o=8,l=39,t.callWrap(t.memberLookup(m,"renderValidationResults"),'core["renderValidationResults"]',a,[s])),e.opts.autoescape),i+="\n    "),i+="\n\n    ",t.memberLookup(t.memberLookup(s,"_validation"),"hasErrors")||(i+="\n        ",i+="\n        ",s=e.getFilter("merge_data").call(a,s,{htmlAttributes:{class:"scwz-m-header-brand-nav-item"}}),r.set("data",s,!0),r.topLevel&&a.setVariable("data",s),r.topLevel&&a.addExport("data",s),i+="\n\n        ",i+="\n        <li ",i+=t.suppressValue((o=20,l=32,t.callWrap(t.contextOrFrameLookup(a,r,"render_attributes"),"render_attributes",a,[t.memberLookup(s,"htmlAttributes"),t.memberLookup(s,"styleAttributes"),t.memberLookup(s,"extensions")])),e.opts.autoescape),i+=">\n            ",i+=t.suppressValue((o=21,l=29,t.callWrap(t.memberLookup(c,"render"),'aAnchor["render"]',a,[e.getFilter("merge_data").call(a,t.memberLookup(s,"objectAnchor"),{component:"nucleus/a-anchor",htmlAttributes:{class:"scwz-m-header-brand-nav-item__anchor"},target:"blank",embedded:[t.memberLookup(s,"text")]})])),e.opts.autoescape),i+="\n        </li>\n    "),i+="\n")}))})))}))})),r=m,new t.SafeString(i)}));a.addExport("render"),a.setVariable("render",s),n(null,"")}catch(e){n(t.handleError(e,o,l))}}};