import{r,j as e}from"./index.js";const o=({imageClass:s})=>{const[t,l]=r.useState(s);return r.useEffect(()=>{l(s)},[s,l]),e.jsx(e.Fragment,{children:t!=null&&t.url?e.jsx("img",{className:"icon",src:t.url,alt:t.title,title:t.title}):(t==null?void 0:t.className)&&e.jsx("i",{className:t.className,title:t.title})})};export{o as I};
//# sourceMappingURL=IconComponent.js.map
