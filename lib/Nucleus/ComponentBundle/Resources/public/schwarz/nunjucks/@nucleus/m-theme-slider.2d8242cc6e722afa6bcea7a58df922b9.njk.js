(window.nunjucksPrecompiled=window.nunjucksPrecompiled||{})["@nucleus/m-theme-slider.twig"]={root:function(e,t,r,n,a){var o=0,s=0,l="";try{var u=n.makeMacro(["data"],[],(function(l,u){var i=r;r=new n.Frame,u=u||{},Object.prototype.hasOwnProperty.call(u,"caller")&&r.set("caller",u.caller),r.set("data",l);var d="";return d+="\n    ",d+="\n    ",e.getTemplate("@nucleus/_core.twig",!1,"@nucleus/m-theme-slider.twig",!1,(function(u,i){u?a(u):i.getExported((function(u,i){u?a(u):(t.setVariable("core",i),d+="\n    ",e.getTemplate("@nucleus/a-button.twig",!1,"@nucleus/m-theme-slider.twig",!1,(function(u,m){u?a(u):m.getExported((function(u,m){u?a(u):(t.setVariable("aButton",m),d+="\n    ",e.getTemplate("@nucleus/a-icon.twig",!1,"@nucleus/m-theme-slider.twig",!1,(function(u,c){u?a(u):c.getExported((function(u,c){if(u)a(u);else{t.setVariable("aIcon",c),d+="\n\n    ",d+="\n    ",l=e.getFilter("validate_data").call(t,l,"nucleus/m-theme-slider"),r.set("data",l,!0),r.topLevel&&t.setVariable("data",l),r.topLevel&&t.addExport("data",l),d+="\n\n    ",d+="\n    ",l=e.getFilter("merge_data").call(t,l,{htmlAttributes:{classList:["nuc-m-theme-slider"],"data-aria-message-prev":n.memberLookup(l,"textPrevSlide"),"data-aria-message-next":n.memberLookup(l,"textNextSlide"),"data-aria-message-first":n.memberLookup(l,"textFirstSlide"),"data-aria-message-last":n.memberLookup(l,"textLastSlide")}}),r.set("data",l,!0),r.topLevel&&t.setVariable("data",l),r.topLevel&&t.addExport("data",l),d+="\n\n    ",d+="\n    <div ",d+=n.suppressValue((o=23,s=29,n.callWrap(n.contextOrFrameLookup(t,r,"render_attributes"),"render_attributes",t,[n.memberLookup(l,"htmlAttributes"),null,n.memberLookup(l,"extensions")])),e.opts.autoescape),d+='>\n        <div class="nuc-m-theme-slider__container">\n            ',d+=n.suppressValue((o=25,s=29,n.callWrap(n.memberLookup(m,"render"),'aButton["render"]',t,[{component:"nucleus/a-button",htmlAttributes:{class:"nuc-m-theme-slider__button-prev"},embedded:[(o=31,s=32,n.callWrap(n.memberLookup(c,"render"),'aIcon["render"]',t,[{component:"nucleus/a-icon",size:"16",id:"nucleus/left"}]))]}])),e.opts.autoescape),d+='\n            <div class="nuc-m-theme-slider__wrapper">\n                ',r=r.push();var p=n.memberLookup(l,"embedded");if(p)for(var b=(p=n.fromIterator(p)).length,v=0;v<p.length;v++){var g=p[v];r.set("_sliderItem",g),r.set("loop.index",v+1),r.set("loop.index0",v),r.set("loop.revindex",b-v),r.set("loop.revindex0",b-v-1),r.set("loop.first",0===v),r.set("loop.last",v===b-1),r.set("loop.length",b),d+='\n                    <div class="nuc-m-theme-slider__item nuc-m-theme-slider__item--visible">\n                        ',d+=n.suppressValue((o=41,s=47,n.callWrap(n.memberLookup(i,"renderComponent"),'core["renderComponent"]',t,[g])),e.opts.autoescape),d+="\n                    </div>\n                "}r=r.pop(),d+="\n            </div>\n            ",d+=n.suppressValue((o=45,s=29,n.callWrap(n.memberLookup(m,"render"),'aButton["render"]',t,[{component:"nucleus/a-button",htmlAttributes:{class:"nuc-m-theme-slider__button-next"},embedded:[(o=51,s=32,n.callWrap(n.memberLookup(c,"render"),'aIcon["render"]',t,[{component:"nucleus/a-icon",size:"16",id:"nucleus/right"}]))]}])),e.opts.autoescape),d+="\n        </div>\n    </div>\n"}}))})))}))})))}))})),r=i,new n.SafeString(d)}));t.addExport("render"),t.setVariable("render",u),a(null,l+="\n")}catch(e){a(n.handleError(e,o,s))}}};