(window.nunjucksPrecompiled=window.nunjucksPrecompiled||{})["@schwarz/o-locations.twig"]={root:function(e,o,t,a,r){var s=0,n=0;try{var l=a.makeMacro(["data"],[],(function(l,p){var i=t;t=new a.Frame,p=p||{},Object.prototype.hasOwnProperty.call(p,"caller")&&t.set("caller",p.caller),t.set("data",l);var d="";return d+="\n    ",d+="\n    ",e.getTemplate("@nucleus/_core.twig",!1,"@schwarz/o-locations.twig",!1,(function(p,i){p?r(p):i.getExported((function(p,i){p?r(p):(o.setVariable("core",i),d+="\n    ",e.getTemplate("@nucleus/a-textbody.twig",!1,"@schwarz/o-locations.twig",!1,(function(p,u){p?r(p):u.getExported((function(p,u){if(p)r(p);else{if(o.setVariable("aTextbody",u),d+="\n\n    ",d+="\n    ",l=e.getFilter("validate_data").call(o,l,"schwarz/o-locations",!1),t.set("data",l,!0),t.topLevel&&o.setVariable("data",l),t.topLevel&&o.addExport("data",l),d+="\n    ",(a.memberLookup(a.memberLookup(l,"_validation"),"hasErrors")||a.memberLookup(a.memberLookup(l,"_validation"),"hasWarnings"))&&(d+="\n        ",d+=a.suppressValue((s=8,n=39,a.callWrap(a.memberLookup(i,"renderValidationResults"),'core["renderValidationResults"]',o,[l])),e.opts.autoescape),d+="\n    "),d+="\n\n    ",!a.memberLookup(a.memberLookup(l,"_validation"),"hasErrors")){if(d+="\n        ",d+="\n        ",l=e.getFilter("merge_data").call(o,l,{htmlAttributes:{classList:["swrz-o-locations"]}}),t.set("data",l,!0),t.topLevel&&o.setVariable("data",l),t.topLevel&&o.addExport("data",l),d+="\n\n        ",d+="\n        <div ",d+=a.suppressValue((s=22,n=33,a.callWrap(a.contextOrFrameLookup(o,t,"render_attributes"),"render_attributes",o,[a.memberLookup(l,"htmlAttributes"),a.memberLookup(l,"styleAttributes"),a.memberLookup(l,"extensions")])),e.opts.autoescape),d+=' style="visibility: hidden;">\n            <div class="swrz-o-locations__wrapper">\n                <div class="swrz-o-locations__content">\n                    <',d+=a.suppressValue(a.memberLookup(l,"headlineLevel"),e.opts.autoescape),d+=' class="swrz-o-locations__headline">\n                    ',d+=a.suppressValue(a.memberLookup(l,"textHeadline"),e.opts.autoescape),d+="\n                </",d+=a.suppressValue(a.memberLookup(l,"headlineLevel"),e.opts.autoescape),d+=">\n                ",d+=a.suppressValue((s=28,n=35,a.callWrap(a.memberLookup(u,"render"),'aTextbody["render"]',o,[e.getFilter("merge_data").call(o,a.memberLookup(l,"objectTextbody"),{component:"nucleus/a-textbody",htmlAttributes:{class:"swrz-o-locations__textbody"},tag:"div"})])),e.opts.autoescape),d+="\n            </div>\n            ",e.getFilter("length").call(o,a.memberLookup(l,"embeddedItems"))>1){d+='\n                <div class="swrz-o-locations__brand-nav">\n                    ',t=t.push();var c=a.memberLookup(l,"embeddedItems");if(c)for(var m=(c=a.fromIterator(c)).length,b=0;b<c.length;b++){var v=c[b];t.set("_item",v),t.set("loop.index",b+1),t.set("loop.index0",b),t.set("loop.revindex",m-b),t.set("loop.revindex0",m-b-1),t.set("loop.first",0===b),t.set("loop.last",b===m-1),t.set("loop.length",m),d+='\n                        <button class="swrz-o-locations__brand-nav-item" data-map-branch-trigger="',d+=a.suppressValue(e.getFilter("lower").call(o,a.memberLookup(v,"nameBrand")),e.opts.autoescape),d+='">\n                            <img role="img" class="swrz-o-locations__brand-nav-item-logo" src="',d+=a.suppressValue(a.memberLookup(v,"srcBrandLogo"),e.opts.autoescape),d+='" alt="',d+=a.suppressValue(a.memberLookup(v,"textAlternativeBrandLogo"),e.opts.autoescape),d+='">\n                        </button>\n                    '}t=t.pop(),d+="\n                </div>\n            "}d+='\n        </div>\n        <div class="swrz-o-locations__map">\n            ',d+=a.suppressValue((s=47,n=36,a.callWrap(a.memberLookup(i,"renderComponents"),'core["renderComponents"]',o,[a.memberLookup(l,"embeddedItems")])),e.opts.autoescape),d+="\n        </div>\n        </div>\n    "}d+="\n"}}))})))}))})),t=i,new a.SafeString(d)}));o.addExport("render"),o.setVariable("render",l),r(null,"")}catch(e){r(a.handleError(e,s,n))}}};