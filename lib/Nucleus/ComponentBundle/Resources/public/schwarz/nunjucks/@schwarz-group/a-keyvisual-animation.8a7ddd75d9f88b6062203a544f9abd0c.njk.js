(window.nunjucksPrecompiled=window.nunjucksPrecompiled||{})["@schwarz-group/a-keyvisual-animation.twig"]={root:function(e,a,t,r,o){var i=0,s=0;try{var n=r.makeMacro(["data"],[],(function(n,l){var u=t;t=new r.Frame,l=l||{},Object.prototype.hasOwnProperty.call(l,"caller")&&t.set("caller",l.caller),t.set("data",n);var p="";return p+="\n    ",p+="\n    ",e.getTemplate("@nucleus/_core.twig",!1,"@schwarz-group/a-keyvisual-animation.twig",!1,(function(l,u){l?o(l):u.getExported((function(l,u){l?o(l):(a.setVariable("core",u),p+="\n    ",e.getTemplate("@nucleus/a-svg-use.twig",!1,"@schwarz-group/a-keyvisual-animation.twig",!1,(function(l,m){l?o(l):m.getExported((function(l,m){l?o(l):(a.setVariable("aSvgUse",m),p+="\n\n    ",p+="\n    ",n=e.getFilter("validate_data").call(a,n,"schwarz-group/a-keyvisual-animation",!1),t.set("data",n,!0),t.topLevel&&a.setVariable("data",n),t.topLevel&&a.addExport("data",n),p+="\n    ",(r.memberLookup(r.memberLookup(n,"_validation"),"hasErrors")||r.memberLookup(r.memberLookup(n,"_validation"),"hasWarnings"))&&(p+="\n        ",p+=r.suppressValue((i=8,s=39,r.callWrap(r.memberLookup(u,"renderValidationResults"),'core["renderValidationResults"]',a,[n])),e.opts.autoescape),p+="\n    "),p+="\n\n    ",r.memberLookup(r.memberLookup(n,"_validation"),"hasErrors")||(p+="\n        ",p+="\n        ",n=e.getFilter("merge_data").call(a,n,{htmlAttributes:{classList:["scgr-a-keyvisual-animation",e.getFilter("get_modifier").call(a,r.memberLookup(n,"size"),"scgr-a-keyvisual-animation--size",{property:"size",omitDefaultModifier:!0}),e.getFilter("get_modifier").call(a,r.memberLookup(n,"position"),"scgr-a-keyvisual-animation--position",{property:"position",omitDefaultModifier:!0}),e.getFilter("get_modifier").call(a,r.memberLookup(n,"theme"),"scgr-a-keyvisual-animation--theme",{property:"theme",omitDefaultModifier:!0})]}}),t.set("data",n,!0),t.topLevel&&a.setVariable("data",n),t.topLevel&&a.addExport("data",n),p+="\n\n        ",p+="\n        <div ",p+=r.suppressValue((i=25,s=33,r.callWrap(r.contextOrFrameLookup(a,t,"render_attributes"),"render_attributes",a,[r.memberLookup(n,"htmlAttributes"),r.memberLookup(n,"styleAttributes"),r.memberLookup(n,"extensions")])),e.opts.autoescape),p+=">\n            ",p+=r.suppressValue((i=26,s=29,r.callWrap(r.memberLookup(m,"render"),'aSvgUse["render"]',a,[{component:"nucleus/a-svg-use",htmlAttributes:{class:"scgr-a-keyvisual-animation__svg"},urlSource:(i=31,s=32,r.callWrap(r.contextOrFrameLookup(a,t,"asset"),"asset",a,["assets/@schwarz-group/a-keyvisual-animation/schwarz-key-visual.svg",(i=31,s=122,r.callWrap(r.contextOrFrameLookup(a,t,"get_asset_namespace"),"get_asset_namespace",a,[]))])+"#svg"),viewBox:"0 0 623 816"}])),e.opts.autoescape),p+="\n        </div>\n    "),p+="\n")}))})))}))})),t=u,new r.SafeString(p)}));a.addExport("render"),a.setVariable("render",n),o(null,"")}catch(e){o(r.handleError(e,i,s))}}};