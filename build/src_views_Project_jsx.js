"use strict";
(self["webpackChunkthfw_portfolio"] = self["webpackChunkthfw_portfolio"] || []).push([["src_views_Project_jsx"],{

/***/ "./src/components/CheckList.jsx":
/*!**************************************!*\
  !*** ./src/components/CheckList.jsx ***!
  \**************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

function CheckList(props) {
  console.log(props);
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, "Check List"));
}
/* harmony default export */ __webpack_exports__["default"] = (CheckList);

/***/ }),

/***/ "./src/components/Colors.jsx":
/*!***********************************!*\
  !*** ./src/components/Colors.jsx ***!
  \***********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

function Colors(props) {
  console.log(props);
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: ""
  }, "COLORS"));
}
/* harmony default export */ __webpack_exports__["default"] = (Colors);

/***/ }),

/***/ "./src/components/Gallery.jsx":
/*!************************************!*\
  !*** ./src/components/Gallery.jsx ***!
  \************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

function Gallery(props) {
  console.log(props);
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: ""
  }, "Gallery"));
}
/* harmony default export */ __webpack_exports__["default"] = (Gallery);

/***/ }),

/***/ "./src/components/ProjectAuthor.jsx":
/*!******************************************!*\
  !*** ./src/components/ProjectAuthor.jsx ***!
  \******************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

function ProjectAuthor(props) {
  console.log(props);
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    class: "author-card card"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    class: "left"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    class: "author-pic"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
    href: author_url
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("img", {
    src: avatar_url,
    alt: ""
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    class: "author-name"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", null, first_name, " ", last_name)), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    class: "author-role"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", null, roles))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    class: "right"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    class: "author-bio"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, description)), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    class: "author-contact"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    onClick: "window.open('mailto:<?php echo get_the_author_meta('email', $post->post_author); ?>')"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", null, "Hire ", firstname))))));
}
/* harmony default export */ __webpack_exports__["default"] = (ProjectAuthor);

/***/ }),

/***/ "./src/components/ProjectStatus.jsx":
/*!******************************************!*\
  !*** ./src/components/ProjectStatus.jsx ***!
  \******************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

function ProjectStatus(props) {
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    class: "project-status"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", null, "STATUS"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("progress", {
    class: "status-bar",
    value: props.project_status,
    max: "100"
  })));
}
/* harmony default export */ __webpack_exports__["default"] = (ProjectStatus);

/***/ }),

/***/ "./src/components/ProjectTags.jsx":
/*!****************************************!*\
  !*** ./src/components/ProjectTags.jsx ***!
  \****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

function ProjectTags(props) {
  console.log(props);
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h1", null, "Project Tags"));
}
/* harmony default export */ __webpack_exports__["default"] = (ProjectTags);

/***/ }),

/***/ "./src/components/ProjectType.jsx":
/*!****************************************!*\
  !*** ./src/components/ProjectType.jsx ***!
  \****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

function ProjectType(props) {
  const handleClick = slug => {
    const url = window.location.origin;
    window.open(`${url}/portfolio/${slug}`, '_blank');
  };
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    class: "project-type"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", null, "TYPE"), Array.isArray(props.project_types) && props.project_types.map((project_type, index) => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    className: "category",
    onClick: () => handleClick(project_type.slug),
    key: index
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", null, project_type.name)))));
}
/* harmony default export */ __webpack_exports__["default"] = (ProjectType);

/***/ }),

/***/ "./src/components/ProjectURLs.jsx":
/*!****************************************!*\
  !*** ./src/components/ProjectURLs.jsx ***!
  \****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

function ProjectURLs(props) {
  console.log(props);
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: ""
  }, "Project URLs"));
}
/* harmony default export */ __webpack_exports__["default"] = (ProjectURLs);

/***/ }),

/***/ "./src/components/TheClient.jsx":
/*!**************************************!*\
  !*** ./src/components/TheClient.jsx ***!
  \**************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

function TheClient(props) {
  console.log(props);
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: ""
  }, "Client"));
}
/* harmony default export */ __webpack_exports__["default"] = (TheClient);

/***/ }),

/***/ "./src/components/TheProblem.jsx":
/*!***************************************!*\
  !*** ./src/components/TheProblem.jsx ***!
  \***************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

function TheProblem(props) {
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    class: "project-problem",
    id: "project_problem"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", null, "THE PROBLEM"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, props.the_problem.customers_impacted), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, props.the_problem.problem_affected), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, props.the_problem.challenges), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, props.the_problem.affected_operations), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, props.the_problem.change_event), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, props.the_problem.factors_contributed), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, props.the_problem.patterns_trends), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, props.the_problem.first_notice_date), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, props.the_problem.recurring_issue), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, props.the_problem.tried_solutions), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, props.the_problem.tried_solutions_results), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, props.the_problem.ideal_resolution)));
}
/* harmony default export */ __webpack_exports__["default"] = (TheProblem);

/***/ }),

/***/ "./src/components/TheSolution.jsx":
/*!****************************************!*\
  !*** ./src/components/TheSolution.jsx ***!
  \****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

function TheSolution(props) {
  console.log(props);
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "project-solution",
    id: "project_solution"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", null, "THE SOLUTION")));
}
/* harmony default export */ __webpack_exports__["default"] = (TheSolution);

/***/ }),

/***/ "./src/components/Versions.jsx":
/*!*************************************!*\
  !*** ./src/components/Versions.jsx ***!
  \*************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

function Versions(props) {
  console.log(props);
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: ""
  }, "Versions"));
}
/* harmony default export */ __webpack_exports__["default"] = (Versions);

/***/ }),

/***/ "./src/views/Project.jsx":
/*!*******************************!*\
  !*** ./src/views/Project.jsx ***!
  \*******************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var react_router_dom__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! react-router-dom */ "./node_modules/react-router/dist/index.js");
/* harmony import */ var react_redux__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react-redux */ "./node_modules/react-redux/es/index.js");
/* harmony import */ var _controllers_clientSlice__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../controllers/clientSlice */ "./src/controllers/clientSlice.js");
/* harmony import */ var _controllers_projectSlice__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../controllers/projectSlice */ "./src/controllers/projectSlice.js");
/* harmony import */ var _components_ProjectType__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../components/ProjectType */ "./src/components/ProjectType.jsx");
/* harmony import */ var _components_ProjectStatus__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../components/ProjectStatus */ "./src/components/ProjectStatus.jsx");
/* harmony import */ var _components_Gallery__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../components/Gallery */ "./src/components/Gallery.jsx");
/* harmony import */ var _components_TheClient__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../components/TheClient */ "./src/components/TheClient.jsx");
/* harmony import */ var _components_TheSolution__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ../components/TheSolution */ "./src/components/TheSolution.jsx");
/* harmony import */ var _components_Versions__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ../components/Versions */ "./src/components/Versions.jsx");
/* harmony import */ var _components_ProjectURLs__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ../components/ProjectURLs */ "./src/components/ProjectURLs.jsx");
/* harmony import */ var _components_CheckList__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ../components/CheckList */ "./src/components/CheckList.jsx");
/* harmony import */ var _components_Colors__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! ../components/Colors */ "./src/components/Colors.jsx");
/* harmony import */ var _components_TheProblem__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! ../components/TheProblem */ "./src/components/TheProblem.jsx");
/* harmony import */ var _components_ProjectAuthor__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! ../components/ProjectAuthor */ "./src/components/ProjectAuthor.jsx");
/* harmony import */ var _components_ProjectTags__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! ../components/ProjectTags */ "./src/components/ProjectTags.jsx");


















function Project() {
  const location = (0,react_router_dom__WEBPACK_IMPORTED_MODULE_17__.useLocation)();
  const projectPath = location.pathname.split('/')[3];
  const {
    loading,
    error,
    id,
    title,
    post_status,
    post_author,
    post_date,
    project_types,
    project_status,
    solution_gallery,
    project_urls,
    the_client,
    the_solution,
    versions,
    design,
    design_gallery,
    design_check_list,
    colors,
    logos_icons_gallery,
    uml_diagrams_gallery,
    development,
    development_gallery,
    development_check_list,
    delivery,
    delivery_gallery,
    delivery_check_list,
    the_problem,
    project_author,
    project_tags
  } = (0,react_redux__WEBPACK_IMPORTED_MODULE_2__.useSelector)(state => state.project);
  const dispatch = (0,react_redux__WEBPACK_IMPORTED_MODULE_2__.useDispatch)();
  const navigate = (0,react_router_dom__WEBPACK_IMPORTED_MODULE_17__.useNavigate)();
  (0,react__WEBPACK_IMPORTED_MODULE_1__.useEffect)(() => {
    dispatch((0,_controllers_projectSlice__WEBPACK_IMPORTED_MODULE_4__.getProject)(projectPath));
  }, [dispatch, projectPath]);
  const handleClick = () => {};
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h2", {
    class: "title"
  }, title), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_Gallery__WEBPACK_IMPORTED_MODULE_7__["default"], {
    gallery: solution_gallery
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    class: "project-info"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_ProjectType__WEBPACK_IMPORTED_MODULE_5__["default"], {
    project_types: project_types
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_ProjectStatus__WEBPACK_IMPORTED_MODULE_6__["default"], {
    project_status: project_status
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_ProjectURLs__WEBPACK_IMPORTED_MODULE_11__["default"], {
    project_urls: project_urls
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_TheClient__WEBPACK_IMPORTED_MODULE_8__["default"], {
    the_client: the_client
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_TheSolution__WEBPACK_IMPORTED_MODULE_9__["default"], {
    the_solution: the_solution
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_Versions__WEBPACK_IMPORTED_MODULE_10__["default"], {
    versions: versions
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "project-process",
    id: "project_process"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", null, "THE PROCESS"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "project-process-design",
    id: "project_process_design"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", null, "DESIGN"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_Gallery__WEBPACK_IMPORTED_MODULE_7__["default"], {
    gallery: design_gallery
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_CheckList__WEBPACK_IMPORTED_MODULE_12__["default"], {
    checklist: design_check_list
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_Colors__WEBPACK_IMPORTED_MODULE_13__["default"], {
    colors: colors
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_Gallery__WEBPACK_IMPORTED_MODULE_7__["default"], {
    gallery: logos_icons_gallery
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_Gallery__WEBPACK_IMPORTED_MODULE_7__["default"], {
    gallery: uml_diagrams_gallery
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "project-process-development",
    id: "project_process_development"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", null, "DEVELOPMENT"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_CheckList__WEBPACK_IMPORTED_MODULE_12__["default"], {
    checklist: development_check_list
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "project-process-delivery",
    id: "project_process_delivery"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", null, "DELIVERY"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_CheckList__WEBPACK_IMPORTED_MODULE_12__["default"], {
    checklist: delivery_check_list
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_TheProblem__WEBPACK_IMPORTED_MODULE_14__["default"], {
    the_problem: the_problem
  }));
}
/* harmony default export */ __webpack_exports__["default"] = (Project);

/***/ })

}]);
//# sourceMappingURL=src_views_Project_jsx.js.map