(window.nunjucksPrecompiled=window.nunjucksPrecompiled||{})["@schwarz-group/o-branch-badge.twig"]={root:function(e,a,r,t,o){var n=0,l=0;try{var s=t.makeMacro(["data"],[],(function(s,c){var i=r;r=new t.Frame,c=c||{},Object.prototype.hasOwnProperty.call(c,"caller")&&r.set("caller",c.caller),r.set("data",s);var p="";return p+="\n    ",p+="\n    ",e.getTemplate("@nucleus/_core.twig",!1,"@schwarz-group/o-branch-badge.twig",!1,(function(c,i){c?o(c):i.getExported((function(c,i){c?o(c):(a.setVariable("core",i),p+="\n    ",e.getTemplate("@schwarz/m-branch-logo.twig",!1,"@schwarz-group/o-branch-badge.twig",!1,(function(c,u){c?o(c):u.getExported((function(c,u){c?o(c):(a.setVariable("mBranchLogo",u),p+="\n\n    ",p+="\n    ",s=e.getFilter("validate_data").call(a,s,"schwarz-group/o-branch-badge",!1),r.set("data",s,!0),r.topLevel&&a.setVariable("data",s),r.topLevel&&a.addExport("data",s),p+="\n    ",(t.memberLookup(t.memberLookup(s,"_validation"),"hasErrors")||t.memberLookup(t.memberLookup(s,"_validation"),"hasWarnings"))&&(p+="\n        ",p+=t.suppressValue((n=8,l=39,t.callWrap(t.memberLookup(i,"renderValidationResults"),'core["renderValidationResults"]',a,[s])),e.opts.autoescape),p+="\n    "),p+="\n\n    ",t.memberLookup(t.memberLookup(s,"_validation"),"hasErrors")||(p+="\n        ",p+="\n        ",s=e.getFilter("merge_data").call(a,s,{htmlAttributes:{classList:["scgr-o-branch-badge"]}}),r.set("data",s,!0),r.topLevel&&a.setVariable("data",s),r.topLevel&&a.addExport("data",s),p+="\n\n        ",p+="\n        ",p+=t.suppressValue((n=22,l=29,t.callWrap(t.memberLookup(u,"render"),'mBranchLogo["render"]',a,[e.getFilter("merge_data").call(a,t.memberLookup(s,"objectBranchLogo"),{component:"schwarz/m-branch-logo",htmlAttributes:t.memberLookup(s,"htmlAttributes"),styleAttributes:t.memberLookup(s,"styleAttributes"),extensions:t.memberLookup(s,"extensions")})])),e.opts.autoescape),p+="\n    "),p+="\n")}))})))}))})),r=i,new t.SafeString(p)}));a.addExport("render"),a.setVariable("render",s),o(null,"")}catch(e){o(t.handleError(e,n,l))}}};