(window.nunjucksPrecompiled=window.nunjucksPrecompiled||{})["@nucleus/o-teaser.twig"]={root:function(e,t,a,r,o){var n=0,s=0;try{var l=r.makeMacro(["data"],[],(function(l,u){var c=a;a=new r.Frame,u=u||{},Object.prototype.hasOwnProperty.call(u,"caller")&&a.set("caller",u.caller),a.set("data",l);var p="";return p+="\n    ",p+="\n    ",e.getTemplate("@nucleus/_core.twig",!1,"@nucleus/o-teaser.twig",!1,(function(u,c){u?o(u):c.getExported((function(u,c){u?o(u):(t.setVariable("core",c),p+="\n    ",e.getTemplate("@nucleus/a-anchor.twig",!1,"@nucleus/o-teaser.twig",!1,(function(u,m){u?o(u):m.getExported((function(u,m){u?o(u):(t.setVariable("aAnchor",m),p+="\n    ",e.getTemplate("@nucleus/a-textbody.twig",!1,"@nucleus/o-teaser.twig",!1,(function(u,d){u?o(u):d.getExported((function(u,d){u?o(u):(t.setVariable("aTextbody",d),p+="\n    ",e.getTemplate("@nucleus/m-picture.twig",!1,"@nucleus/o-teaser.twig",!1,(function(u,i){u?o(u):i.getExported((function(u,i){var b;u?o(u):(t.setVariable("mPicture",i),p+="\n\n    ",p+="\n    ",l=e.getFilter("validate_data").call(t,l,"nucleus/o-teaser",!1),a.set("data",l,!0),a.topLevel&&t.setVariable("data",l),a.topLevel&&t.addExport("data",l),p+="\n    ",(r.memberLookup(r.memberLookup(l,"_validation"),"hasErrors")||r.memberLookup(r.memberLookup(l,"_validation"),"hasWarnings"))&&(p+="\n        ",p+=r.suppressValue((n=10,s=39,r.callWrap(r.memberLookup(c,"renderValidationResults"),'core["renderValidationResults"]',t,[l])),e.opts.autoescape),p+="\n    "),p+="\n\n    ",r.memberLookup(r.memberLookup(l,"_validation"),"hasErrors")||(p+="\n        ",p+="\n        ",l=e.getFilter("merge_data").call(t,l,{htmlAttributes:{classList:["nuc-o-teaser",e.getFilter("get_modifier").call(t,1==!e.getTest("empty").call(t,r.memberLookup(l,"objectTextbody")),"nuc-o-teaser--text")]}}),a.set("data",l,!0),a.topLevel&&t.setVariable("data",l),a.topLevel&&t.addExport("data",l),p+="\n\n        ",b=function(){var a="";return a+='\n            <div class="nuc-o-teaser__wrapper">\n                ',a+=r.suppressValue((n=26,s=35,r.callWrap(r.memberLookup(i,"render"),'mPicture["render"]',t,[e.getFilter("merge_data").call(t,r.memberLookup(l,"objectPicture"),{component:"nucleus/m-picture",htmlAttributes:{class:"nuc-o-teaser__picture"}})])),e.opts.autoescape),a+="\n                ",1==!e.getTest("empty").call(t,r.memberLookup(l,"textHeadline"))&&(a+='\n                    <div class="nuc-o-teaser__bar-wrapper">\n                        <header class="nuc-o-teaser__bar">\n                            <',a+=r.suppressValue(r.memberLookup(l,"headlineLevel"),e.opts.autoescape),a+=' class="nuc-o-teaser__headline">',a+=r.suppressValue(r.memberLookup(l,"textHeadline"),e.opts.autoescape),a+="</",a+=r.suppressValue(r.memberLookup(l,"headlineLevel"),e.opts.autoescape),a+=">\n                            ",1==!e.getTest("empty").call(t,r.memberLookup(l,"textSubHeadline"))&&(a+='\n                                <small class="nuc-o-teaser__subheadline">',a+=r.suppressValue(r.memberLookup(l,"textSubHeadline"),e.opts.autoescape),a+="</small>\n                            "),a+="\n                        </header>\n                    </div>\n                "),a+="\n                ",1==!e.getTest("empty").call(t,r.memberLookup(l,"embeddedOverlay"))&&(a+='\n                    <div class="nuc-o-teaser__overlay">\n                        ',a+=r.suppressValue((n=44,s=48,r.callWrap(r.memberLookup(c,"renderComponents"),'core["renderComponents"]',t,[r.memberLookup(l,"embeddedOverlay")])),e.opts.autoescape),a+="\n                    </div>\n                "),a+="\n            </div>\n            ",1==!e.getTest("empty").call(t,r.memberLookup(l,"objectTextbody"))&&(a+="\n                ",a+=r.suppressValue((n=49,s=35,r.callWrap(r.memberLookup(d,"render"),'aTextbody["render"]',t,[e.getFilter("merge_data").call(t,r.memberLookup(l,"objectTextbody"),{component:"nucleus/a-textbody",theme:"inherit",tag:"div",htmlAttributes:{class:"nuc-o-teaser__body"}})])),e.opts.autoescape),a+="\n            "),a+="\n        "}(),a.set("_embeddedAnchor",b,!0),a.topLevel&&t.setVariable("_embeddedAnchor",b),p+="\n\n        ",p+="\n        <article ",p+=r.suppressValue((n=61,s=37,r.callWrap(r.contextOrFrameLookup(t,a,"render_attributes"),"render_attributes",t,[r.memberLookup(l,"htmlAttributes"),r.memberLookup(l,"styleAttributes"),r.memberLookup(l,"extensions")])),e.opts.autoescape),p+=">\n            ",1==!e.getTest("empty").call(t,r.memberLookup(l,"objectAnchor"))?(p+="\n                ",p+=r.suppressValue((n=63,s=33,r.callWrap(r.memberLookup(m,"render"),'aAnchor["render"]',t,[e.getFilter("merge_data").call(t,r.memberLookup(l,"objectAnchor"),{component:"nucleus/a-anchor",htmlAttributes:{class:"nuc-o-teaser__anchor"},embedded:[r.contextOrFrameLookup(t,a,"_embeddedAnchor")]})])),e.opts.autoescape),p+="\n            "):(p+="\n                ",p+=r.suppressValue(e.getFilter("raw").call(t,r.contextOrFrameLookup(t,a,"_embeddedAnchor")),e.opts.autoescape),p+="\n            "),p+="\n        </article>\n    "),p+="\n")}))})))}))})))}))})))}))})),a=c,new r.SafeString(p)}));t.addExport("render"),t.setVariable("render",l),o(null,"")}catch(e){o(r.handleError(e,n,s))}}};