(window.nunjucksPrecompiled=window.nunjucksPrecompiled||{})["@nucleus/m-accordion-item.twig"]={root:function(e,t,o,r,n){var a=0,c=0,s="";try{var i=r.makeMacro(["data"],[],(function(s,i){var u=o;o=new r.Frame,i=i||{},Object.prototype.hasOwnProperty.call(i,"caller")&&o.set("caller",i.caller),o.set("data",s);var m="";return m+="\n    ",e.getTemplate("@nucleus/_core.twig",!1,"@nucleus/m-accordion-item.twig",!1,(function(i,u){i?n(i):u.getExported((function(i,u){i?n(i):(t.setVariable("core",u),m+="\n    ",e.getTemplate("@nucleus/a-button.twig",!1,"@nucleus/m-accordion-item.twig",!1,(function(i,p){i?n(i):p.getExported((function(i,p){i?n(i):(t.setVariable("aButton",p),m+="\n    ",e.getTemplate("@nucleus/a-icon.twig",!1,"@nucleus/m-accordion-item.twig",!1,(function(i,l){i?n(i):l.getExported((function(i,l){var d,b,L,k;i?n(i):(t.setVariable("aIcon",l),m+="\n\n    ",m+="\n    ",s=e.getFilter("validate_data").call(t,s,"nucleus/m-accordion-item",!1),o.set("data",s,!0),o.topLevel&&t.setVariable("data",s),o.topLevel&&t.addExport("data",s),m+="\n    ",(r.memberLookup(r.memberLookup(s,"_validation"),"hasErrors")||r.memberLookup(r.memberLookup(s,"_validation"),"hasWarnings"))&&(m+="\n        ",m+=r.suppressValue((a=8,c=39,r.callWrap(r.memberLookup(u,"renderValidationResults"),'core["renderValidationResults"]',t,[s])),e.opts.autoescape),m+="\n    "),m+="\n\n    ",r.memberLookup(r.memberLookup(s,"_validation"),"hasErrors")||(m+="\n        ",m+="\n        ",s=e.getFilter("merge_data").call(t,s,{htmlAttributes:{classList:["nuc-m-accordion-item",e.getFilter("get_modifier").call(t,r.memberLookup(s,"isOpen"),"nuc-m-accordion-item--open"),e.getFilter("get_modifier").call(t,r.memberLookup(s,"isDisabled"),"nuc-m-accordion-item--disabled")]}}),o.set("data",s,!0),o.topLevel&&t.setVariable("data",s),o.topLevel&&t.addExport("data",s),m+="\n\n        ",d="nuc-m-accordion-item-"+(a=23,c=57,r.callWrap(r.contextOrFrameLookup(t,o,"random"),"random",t,[])),o.set("_itemID",d,!0),o.topLevel&&t.setVariable("_itemID",d),m+="\n        ",b="nuc-m-accordion-item__content-"+(a=24,c=69,r.callWrap(r.contextOrFrameLookup(t,o,"random"),"random",t,[])),o.set("_contentID",b,!0),o.topLevel&&t.setVariable("_contentID",b),m+="\n\n        ",L={htmlAttributes:{role:"region",id:r.contextOrFrameLookup(t,o,"_contentID"),"aria-labelledby":r.contextOrFrameLookup(t,o,"_itemID")}},o.set("contentAttributes",L,!0),o.topLevel&&t.setVariable("contentAttributes",L),o.topLevel&&t.addExport("contentAttributes",L),m+="\n\n        ",k=function(){var o="";return o+="\n            ",1==!e.getTest("empty").call(t,r.memberLookup(s,"icon"))&&(o+="\n                ",o+=r.suppressValue((a=36,c=31,r.callWrap(r.memberLookup(l,"render"),'aIcon["render"]',t,[{component:"nucleus/a-icon",htmlAttributes:{class:"nuc-m-accordion-item__icon"},id:r.memberLookup(s,"icon"),size:"inherit",textTitle:r.memberLookup(s,"textIconTitle")}])),e.opts.autoescape),o+="\n            "),o+="\n\n            <",o+=r.suppressValue(r.memberLookup(s,"tag"),e.opts.autoescape),o+=' class="nuc-m-accordion-item__heading">',o+=r.suppressValue(r.memberLookup(s,"textHeadline"),e.opts.autoescape),o+="</",o+=r.suppressValue(r.memberLookup(s,"tag"),e.opts.autoescape),o+=">\n\n            ",o+=r.suppressValue((a=49,c=27,r.callWrap(r.memberLookup(l,"render"),'aIcon["render"]',t,[{component:"nucleus/a-icon",htmlAttributes:{class:"nuc-m-accordion-item__state-icon"},size:"inherit",id:"nucleus/down"}])),e.opts.autoescape),o+="\n        "}(),o.set("_embeddedTrigger",k,!0),o.topLevel&&t.setVariable("_embeddedTrigger",k),m+="\n\n        ",m+="\n        <div ",m+=r.suppressValue((a=60,c=33,r.callWrap(r.contextOrFrameLookup(t,o,"render_attributes"),"render_attributes",t,[r.memberLookup(s,"htmlAttributes"),r.memberLookup(s,"styleAttributes"),r.memberLookup(s,"extensions")])),e.opts.autoescape),m+=">\n            ",m+=r.suppressValue((a=61,c=29,r.callWrap(r.memberLookup(p,"render"),'aButton["render"]',t,[{component:"nucleus/a-button",htmlAttributes:{class:"nuc-m-accordion-item__trigger",id:r.contextOrFrameLookup(t,o,"_itemID"),"aria-controls":r.contextOrFrameLookup(t,o,"_contentID")},isDisabled:r.memberLookup(s,"isDisabled"),embedded:[r.contextOrFrameLookup(t,o,"_embeddedTrigger")]}])),e.opts.autoescape),m+='\n            <div class="nuc-m-accordion-item__content" ',m+=r.suppressValue((a=73,c=75,r.callWrap(r.contextOrFrameLookup(t,o,"render_attributes"),"render_attributes",t,[r.memberLookup(r.contextOrFrameLookup(t,o,"contentAttributes"),"htmlAttributes")])),e.opts.autoescape),m+=">\n                ",1==!e.getTest("empty").call(t,r.memberLookup(s,"embedded"))?(m+="\n                    ",m+=r.suppressValue((a=75,c=44,r.callWrap(r.memberLookup(u,"renderComponents"),'core["renderComponents"]',t,[r.memberLookup(s,"embedded")])),e.opts.autoescape),m+="\n                "):1==!e.getTest("empty").call(t,r.memberLookup(s,"content"))?(m+="\n                    ",m+=r.suppressValue((a=77,c=41,r.callWrap(r.memberLookup(u,"renderContent"),'core["renderContent"]',t,[r.memberLookup(s,"content"),r.memberLookup(s,"isRawContent")])),e.opts.autoescape),m+="\n                "):(m+="\n                    ",m+=r.suppressValue((a=79,c=38,r.callWrap(r.contextOrFrameLookup(t,o,"throw_exception"),"throw_exception",t,["Either embedded or content must be privided in nucleus/m-accordion-item"])),e.opts.autoescape),m+="\n                "),m+="\n            </div>\n        </div>\n    "),m+="\n")}))})))}))})))}))})),o=u,new r.SafeString(m)}));t.addExport("render"),t.setVariable("render",i),n(null,s+="\n")}catch(e){n(r.handleError(e,a,c))}}};