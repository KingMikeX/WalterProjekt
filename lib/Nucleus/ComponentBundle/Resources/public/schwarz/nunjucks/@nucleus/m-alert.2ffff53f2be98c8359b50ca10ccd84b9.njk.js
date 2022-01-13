(window.nunjucksPrecompiled=window.nunjucksPrecompiled||{})["@nucleus/m-alert.twig"]={root:function(e,t,o,n,r){var a=0,l=0,s="";try{var u=n.makeMacro(["data"],[],(function(s,u){var c=o;o=new n.Frame,u=u||{},Object.prototype.hasOwnProperty.call(u,"caller")&&o.set("caller",u.caller),o.set("data",s);var m="";return m+="\n    ",e.getTemplate("@nucleus/_core.twig",!1,"@nucleus/m-alert.twig",!1,(function(u,c){u?r(u):c.getExported((function(u,c){u?r(u):(t.setVariable("core",c),m+="\n    ",e.getTemplate("@nucleus/a-icon.twig",!1,"@nucleus/m-alert.twig",!1,(function(u,p){u?r(u):p.getExported((function(u,p){u?r(u):(t.setVariable("aIcon",p),m+="\n    ",e.getTemplate("@nucleus/a-button.twig",!1,"@nucleus/m-alert.twig",!1,(function(u,i){u?r(u):i.getExported((function(u,i){u?r(u):(t.setVariable("aButton",i),m+="\n    ",e.getTemplate("@nucleus/a-textbody.twig",!1,"@nucleus/m-alert.twig",!1,(function(u,d){u?r(u):d.getExported((function(u,d){if(u)r(u);else{var b,L,k,g,_;if(t.setVariable("aTextbody",d),m+="\n\n    ",m+="\n    ",s=e.getFilter("validate_data").call(t,s,"nucleus/m-alert",!1),o.set("data",s,!0),o.topLevel&&t.setVariable("data",s),o.topLevel&&t.addExport("data",s),m+="\n    ",(n.memberLookup(n.memberLookup(s,"_validation"),"hasErrors")||n.memberLookup(n.memberLookup(s,"_validation"),"hasWarnings"))&&(m+="\n        ",m+=n.suppressValue((a=9,l=39,n.callWrap(n.memberLookup(c,"renderValidationResults"),'core["renderValidationResults"]',t,[s])),e.opts.autoescape),m+="\n    "),m+="\n\n    ",!n.memberLookup(n.memberLookup(s,"_validation"),"hasErrors"))m+="\n        ",m+="\n        ",b=n.memberLookup(s,"icon"),o.set("_icon",b,!0),o.topLevel&&t.setVariable("_icon",b),m+="\n        ",!0===e.getTest("empty").call(t,n.contextOrFrameLookup(t,o,"_icon"))&&(m+="\n            ","danger"==n.memberLookup(s,"theme")?(m+=" ",L="nucleus/danger",o.set("_icon",L,!0),o.topLevel&&t.setVariable("_icon",L),m+="\n            "):"success"==n.memberLookup(s,"theme")?(m+=" ",k="nucleus/success",o.set("_icon",k,!0),o.topLevel&&t.setVariable("_icon",k),m+="\n            "):"warning"==n.memberLookup(s,"theme")?(m+=" ",g="nucleus/warning",o.set("_icon",g,!0),o.topLevel&&t.setVariable("_icon",g),m+="\n            "):(m+=" ",_="nucleus/info",o.set("_icon",_,!0),o.topLevel&&t.setVariable("_icon",_),m+=" "),m+="\n        "),m+="\n\n        ",s=e.getFilter("merge_data").call(t,s,{htmlAttributes:{classList:["nuc-m-alert",e.getFilter("get_modifier").call(t,n.memberLookup(s,"theme"),"nuc-m-alert--theme",{property:"theme",omitDefaultModifier:!0})],role:n.inOperator(n.memberLookup(s,"theme"),["danger","warning"])?"alert":null}}),o.set("data",s,!0),o.topLevel&&t.setVariable("data",s),o.topLevel&&t.addExport("data",s),m+="\n\n        ",m+="\n        <div ",m+=n.suppressValue((a=33,l=33,n.callWrap(n.contextOrFrameLookup(t,o,"render_attributes"),"render_attributes",t,[n.memberLookup(s,"htmlAttributes"),n.memberLookup(s,"styleAttributes"),n.memberLookup(s,"extensions")])),e.opts.autoescape),m+=">\n            ",!0===e.getTest("empty").call(t,n.memberLookup(s,"hasNoIcon"))&&(m+="\n                ",m+=n.suppressValue((a=35,l=31,n.callWrap(n.memberLookup(p,"render"),'aIcon["render"]',t,[{component:"nucleus/a-icon",htmlAttributes:{class:"nuc-m-alert__icon","aria-hidden":"true"},id:n.contextOrFrameLookup(t,o,"_icon"),size:"inherit"}])),e.opts.autoescape),m+="\n            "),m+='\n            <div class="nuc-m-alert__body">\n                ',1==!e.getTest("empty").call(t,n.memberLookup(s,"headline"))&&(m+='\n                    <div class="nuc-m-alert__heading">',m+=n.suppressValue(n.memberLookup(s,"headline"),e.opts.autoescape),m+="</div>\n                "),m+="\n                ",1==!e.getTest("empty").call(t,n.memberLookup(s,"content"))?(m+='\n                    <p class="nuc-m-alert__content">',m+=n.suppressValue((a=50,l=73,n.callWrap(n.memberLookup(c,"renderContent"),'core["renderContent"]',t,[n.memberLookup(s,"content"),n.memberLookup(s,"isRawContent")])),e.opts.autoescape),m+="</p>\n                "):1==!e.getTest("empty").call(t,n.memberLookup(s,"objectTextbody"))?(m+="\n                    ",m+=n.suppressValue((a=52,l=39,n.callWrap(n.memberLookup(d,"render"),'aTextbody["render"]',t,[e.getFilter("merge_data").call(t,n.memberLookup(s,"objectTextbody"),{component:"nucleus/a-textbody",theme:"inherit"})])),e.opts.autoescape),m+="\n                "):1==!e.getTest("empty").call(t,n.memberLookup(s,"embedded"))?(m+="\n                    ",m+=n.suppressValue((a=57,l=44,n.callWrap(n.memberLookup(c,"renderComponents"),'core["renderComponents"]',t,[n.memberLookup(s,"embedded")])),e.opts.autoescape),m+="\n                "):(m+="\n                    ",m+=n.suppressValue((a=59,l=38,n.callWrap(n.contextOrFrameLookup(t,o,"throw_exception"),"throw_exception",t,["Either content, objectTextbody or embedded must be privided in nucleus/m-alert"])),e.opts.autoescape),m+="\n                "),m+="\n            </div>\n            ",n.memberLookup(s,"isClosable")&&(m+="\n                ",m+=n.suppressValue((a=63,l=33,n.callWrap(n.memberLookup(i,"render"),'aButton["render"]',t,[{component:"nucleus/a-button",htmlAttributes:{class:"nuc-m-alert__close-button"},embedded:[{component:"nucleus/a-icon",htmlAttributes:{class:"nuc-m-alert__close-icon"},id:"nucleus/close",size:"inherit"}],textTitle:n.memberLookup(s,"textCloseButtonTitle")}])),e.opts.autoescape),m+="\n            "),m+="\n        </div>\n    ";m+="\n"}}))})))}))})))}))})))}))})),o=c,new n.SafeString(m)}));t.addExport("render"),t.setVariable("render",u),r(null,s+="\n")}catch(e){r(n.handleError(e,a,l))}}};