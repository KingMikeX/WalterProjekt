(window.nunjucksPrecompiled=window.nunjucksPrecompiled||{})["@schwarz/a-logo-image.twig"]={root:function(e,a,t,r,o){var s=0,l=0,n="";try{var u=r.makeMacro(["data"],[],(function(n,u){var p=t;t=new r.Frame,u=u||{},Object.prototype.hasOwnProperty.call(u,"caller")&&t.set("caller",u.caller),t.set("data",n);var i="";return i+="\n    ",i+="\n    ",e.getTemplate("@nucleus/_core.twig",!1,"@schwarz/a-logo-image.twig",!1,(function(u,p){u?o(u):p.getExported((function(u,p){u?o(u):(a.setVariable("core",p),i+="\n\n    ",i+="\n    ",n=e.getFilter("validate_data").call(a,n,"schwarz/a-logo-image",!1),t.set("data",n,!0),t.topLevel&&a.setVariable("data",n),t.topLevel&&a.addExport("data",n),i+="\n    ",(r.memberLookup(r.memberLookup(n,"_validation"),"hasErrors")||r.memberLookup(r.memberLookup(n,"_validation"),"hasWarnings"))&&(i+="\n        ",i+=r.suppressValue((s=7,l=39,r.callWrap(r.memberLookup(p,"renderValidationResults"),'core["renderValidationResults"]',a,[n])),e.opts.autoescape),i+="\n    "),i+="\n\n    ",r.memberLookup(r.memberLookup(n,"_validation"),"hasErrors")||(i+="\n        ",i+="\n        ",n=e.getFilter("merge_data").call(a,n,{htmlAttributes:{classList:["scwz-a-logo-image"]}}),t.set("data",n,!0),t.topLevel&&a.setVariable("data",n),t.topLevel&&a.addExport("data",n),i+="\n\n        ",i+="\n        <img ",i+=r.suppressValue((s=21,l=33,r.callWrap(r.contextOrFrameLookup(a,t,"render_attributes"),"render_attributes",a,[r.memberLookup(n,"htmlAttributes"),r.memberLookup(n,"styleAttributes"),r.memberLookup(n,"extensions")])),e.opts.autoescape),i+=' role="img" src="',i+=r.suppressValue(r.memberLookup(n,"urlSource"),e.opts.autoescape),i+='" alt="',i+=r.suppressValue(r.memberLookup(n,"textAlternative"),e.opts.autoescape),i+='">\n    '),i+="\n")}))})),t=p,new r.SafeString(i)}));a.addExport("render"),a.setVariable("render",u),o(null,n+="\n")}catch(e){o(r.handleError(e,s,l))}}};