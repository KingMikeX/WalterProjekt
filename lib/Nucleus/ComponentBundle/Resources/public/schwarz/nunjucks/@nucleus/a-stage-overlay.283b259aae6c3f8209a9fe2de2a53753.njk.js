(window.nunjucksPrecompiled=window.nunjucksPrecompiled||{})["@nucleus/a-stage-overlay.twig"]={root:function(e,a,t,r,o){var n=0,l=0;try{var s=r.makeMacro(["data"],[],(function(s,u){var i=t;t=new r.Frame,u=u||{},Object.prototype.hasOwnProperty.call(u,"caller")&&t.set("caller",u.caller),t.set("data",s);var p="";return p+="\n    ",p+="\n    ",e.getTemplate("@nucleus/_core.twig",!1,"@nucleus/a-stage-overlay.twig",!1,(function(u,i){u?o(u):i.getExported((function(u,i){u?o(u):(a.setVariable("core",i),p+="\n\n    ",p+="\n    ",s=e.getFilter("validate_data").call(a,s,"nucleus/a-stage-overlay",!1),t.set("data",s,!0),t.topLevel&&a.setVariable("data",s),t.topLevel&&a.addExport("data",s),p+="\n    ",(r.memberLookup(r.memberLookup(s,"_validation"),"hasErrors")||r.memberLookup(r.memberLookup(s,"_validation"),"hasWarnings"))&&(p+="\n        ",p+=r.suppressValue((n=7,l=39,r.callWrap(r.memberLookup(i,"renderValidationResults"),'core["renderValidationResults"]',a,[s])),e.opts.autoescape),p+="\n    "),p+="\n\n    ",r.memberLookup(r.memberLookup(s,"_validation"),"hasErrors")||(p+="\n        ",p+="\n        ",s=e.getFilter("merge_data").call(a,s,{htmlAttributes:{classList:["nuc-a-stage-overlay",e.getFilter("get_modifier").call(a,r.memberLookup(s,"belowStageTo"),"nuc-a-stage-overlay--below-stage"),e.getFilter("get_modifier").call(a,r.memberLookup(s,"limitToSaveZoneFrom"),"nuc-a-stage-overlay--limit-to-save-zone"),"hidden@all"]}}),t.set("data",s,!0),t.topLevel&&a.setVariable("data",s),t.topLevel&&a.addExport("data",s),p+="\n\n        ",p+="\n        <div ",p+=r.suppressValue((n=24,l=33,r.callWrap(r.contextOrFrameLookup(a,t,"render_attributes"),"render_attributes",a,[r.memberLookup(s,"htmlAttributes"),r.memberLookup(s,"styleAttributes"),r.memberLookup(s,"extensions")])),e.opts.autoescape),p+=">\n            ",p+=r.suppressValue((n=25,l=36,r.callWrap(r.memberLookup(i,"renderComponents"),'core["renderComponents"]',a,[r.memberLookup(s,"embedded")])),e.opts.autoescape),p+="\n        </div>\n    "),p+="\n")}))})),t=i,new r.SafeString(p)}));a.addExport("render"),a.setVariable("render",s),o(null,"")}catch(e){o(r.handleError(e,n,l))}}};