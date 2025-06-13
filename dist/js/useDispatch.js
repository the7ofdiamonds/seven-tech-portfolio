import{aq as e,ar as u,as as c}from"./index.js";function r(t=e){const o=t===e?u:c(t);return function(){const{store:s}=o();return s}}const a=r();function i(t=e){const o=t===e?a:r(t);return function(){return o().dispatch}}const p=i();export{p as u};
//# sourceMappingURL=useDispatch.js.map
