(window.nunjucksPrecompiled=window.nunjucksPrecompiled||{})["@schwarz-group/m-data-facts.twig"]={root:function(e,a,t,r,s){var o=0,n=0;try{var p=r.makeMacro(["data"],[],(function(p,c){var l=t;t=new r.Frame,c=c||{},Object.prototype.hasOwnProperty.call(c,"caller")&&t.set("caller",c.caller),t.set("data",p);var u="";return u+="\n    ",u+="\n    ",e.getTemplate("@nucleus/_core.twig",!1,"@schwarz-group/m-data-facts.twig",!1,(function(c,l){c?s(c):l.getExported((function(c,l){c?s(c):(a.setVariable("core",l),u+="\n\n    ",u+="\n    ",p=e.getFilter("validate_data").call(a,p,"schwarz-group/m-data-facts",!1),t.set("data",p,!0),t.topLevel&&a.setVariable("data",p),t.topLevel&&a.addExport("data",p),u+="\n    ",(r.memberLookup(r.memberLookup(p,"_validation"),"hasErrors")||r.memberLookup(r.memberLookup(p,"_validation"),"hasWarnings"))&&(u+="\n        ",u+=r.suppressValue((o=7,n=39,r.callWrap(r.memberLookup(l,"renderValidationResults"),'core["renderValidationResults"]',a,[p])),e.opts.autoescape),u+="\n    "),u+="\n\n    ",r.memberLookup(r.memberLookup(p,"_validation"),"hasErrors")||(u+="\n        ",u+="\n        ",p=e.getFilter("merge_data").call(a,p,{htmlAttributes:{classList:["scgr-m-data-facts"]}}),t.set("data",p,!0),t.topLevel&&a.setVariable("data",p),t.topLevel&&a.addExport("data",p),u+="\n\n        ",u+="\n        <article ",u+=r.suppressValue((o=21,n=37,r.callWrap(r.contextOrFrameLookup(a,t,"render_attributes"),"render_attributes",a,[r.memberLookup(p,"htmlAttributes"),r.memberLookup(p,"styleAttributes"),r.memberLookup(p,"extensions")])),e.opts.autoescape),u+='>\n            <h3 class="scgr-m-data-facts__number">\n                ',u+=r.suppressValue(r.memberLookup(p,"textNumber"),e.opts.autoescape),u+='\n            </h3>\n            <div class="scgr-m-data-facts__description-wrapper">\n                <h4 class="scgr-m-data-facts__numberType">\n                    ',u+=r.suppressValue(r.memberLookup(p,"textNumberType"),e.opts.autoescape),u+='\n                </h4>\n                <p class="scgr-m-data-facts__description">\n                    ',u+=r.suppressValue(r.memberLookup(p,"textDescription"),e.opts.autoescape),u+="\n                </p>\n            </div>\n        </article>\n    "),u+="\n")}))})),t=l,new r.SafeString(u)}));a.addExport("render"),a.setVariable("render",p),s(null,"")}catch(e){s(r.handleError(e,o,n))}}};