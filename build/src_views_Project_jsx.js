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
  const {
    checklist
  } = props;
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "checklist"
  }, Array.isArray(checklist) && checklist.map((item, index) => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    key: index,
    type: "checkbox",
    name: "",
    id: ""
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", null, item)))));
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
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);


function Colors(props) {
  const {
    colors
  } = props;
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "colors"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h5", {
    class: "title"
  }, "Colors (", colors.length, ")"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "color-row"
  }, Array.isArray(colors) && colors.map((color, index) => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "color",
    key: index
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "color-square",
    style: {
      backgroundColor: color
    }
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h5", null, color)))));
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
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "gallery"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "gallery-row"
  }, Array.isArray(props.gallery) && props.gallery.map((photo, index) => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "gallery-photo"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("img", {
    key: index,
    className: "photo",
    src: photo,
    alt: ""
  }))))));
}
/* harmony default export */ __webpack_exports__["default"] = (Gallery);

/***/ }),

/***/ "./src/components/ProjectDetails.jsx":
/*!*******************************************!*\
  !*** ./src/components/ProjectDetails.jsx ***!
  \*******************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);


function ProjectDetails(props) {
  console.log(props);
  const {
    project_details
  } = props;
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "project-details"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("table", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tbody", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "client_name"
  }, "Client Name:")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", {
    className: "company-name"
  }, project_details.client_name))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "start_date"
  }, "Start Date:")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, project_details.start_date)), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "end_date"
  }, "End Date:")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, project_details.end_date))))));
}
/* harmony default export */ __webpack_exports__["default"] = (ProjectDetails);

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
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", null, "STATUS"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("progress", {
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
  const {
    project_tags
  } = props;
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "project-tags"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", {
    className: "title"
  }, "Project Tags"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "tag-row"
  }, Array.isArray(project_tags) && project_tags.map((tag, index) => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", {
    className: "tag",
    key: index
  }, "#", tag.name)))));
}
/* harmony default export */ __webpack_exports__["default"] = (ProjectTags);

/***/ }),

/***/ "./src/components/ProjectTeam.jsx":
/*!****************************************!*\
  !*** ./src/components/ProjectTeam.jsx ***!
  \****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

function ProjectTeam(props) {
  const {
    project_team
  } = props;
  console.log(project_team);
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", {
    className: "title"
  }, "Project Team"));
}
/* harmony default export */ __webpack_exports__["default"] = (ProjectTeam);

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
  console.log(props);
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    class: "project-type"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", {
    className: "title"
  }, "Project Type"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "project-type-row"
  }, Array.isArray(props.project_types) && props.project_types.map((project_type, index) => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    className: "category",
    onClick: () => handleClick(project_type.slug),
    key: index
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", null, project_type.name))))));
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
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);


function ProjectURLs(props) {
  console.log(props);
  const {
    project_urls
  } = props;
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "project-urls"
  }, Object.keys(project_urls).map((key, index) => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    key: index,
    onClick: () => window.open(project_urls[key].url, '_blank')
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("i", {
    className: `${project_urls[key].icon}`
  })))));
}
/* harmony default export */ __webpack_exports__["default"] = (ProjectURLs);

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
  const {
    the_solution
  } = props;
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "project-solution",
    id: "project_solution"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", null, "THE SOLUTION"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    dangerouslySetInnerHTML: {
      __html: the_solution
    }
  })));
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
  const {
    versions
  } = props;
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "versions"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "current-version"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", null, "Current Version"), versions.current), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "upcoming-versions"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", null, "Upcoming Versions"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("table", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tbody", null, Array.isArray(versions.upcoming) && versions.upcoming.map((version, index) => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", {
    key: index
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", {
    className: "feature"
  }, version.feature), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, "-"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, version.version_number))))))));
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
/* harmony import */ var _components_ProjectDetails__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../components/ProjectDetails */ "./src/components/ProjectDetails.jsx");
/* harmony import */ var _components_TheSolution__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ../components/TheSolution */ "./src/components/TheSolution.jsx");
/* harmony import */ var _components_Versions__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ../components/Versions */ "./src/components/Versions.jsx");
/* harmony import */ var _components_ProjectURLs__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ../components/ProjectURLs */ "./src/components/ProjectURLs.jsx");
/* harmony import */ var _components_CheckList__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ../components/CheckList */ "./src/components/CheckList.jsx");
/* harmony import */ var _components_Colors__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! ../components/Colors */ "./src/components/Colors.jsx");
/* harmony import */ var _components_TheProblem__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! ../components/TheProblem */ "./src/components/TheProblem.jsx");
/* harmony import */ var _components_ProjectTeam__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! ../components/ProjectTeam */ "./src/components/ProjectTeam.jsx");
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
    project_details,
    the_solution,
    versions,
    design,
    design_gallery,
    design_check_list,
    colors,
    logos_gallery,
    icons_gallery,
    animations_gallery,
    uml_diagrams_gallery,
    development,
    development_gallery,
    development_check_list,
    delivery,
    delivery_gallery,
    delivery_check_list,
    the_problem,
    project_team,
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
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_ProjectURLs__WEBPACK_IMPORTED_MODULE_11__["default"], {
    project_urls: project_urls
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_ProjectDetails__WEBPACK_IMPORTED_MODULE_8__["default"], {
    project_details: project_details
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_TheSolution__WEBPACK_IMPORTED_MODULE_9__["default"], {
    the_solution: the_solution
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "project-process",
    id: "project_process"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", {
    class: "title"
  }, "THE PROCESS"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_ProjectStatus__WEBPACK_IMPORTED_MODULE_6__["default"], {
    project_status: project_status
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_Versions__WEBPACK_IMPORTED_MODULE_10__["default"], {
    versions: versions
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "project-process-design",
    id: "project_process_design"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", {
    class: "title"
  }, "DESIGN"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_CheckList__WEBPACK_IMPORTED_MODULE_12__["default"], {
    checklist: design_check_list
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_Gallery__WEBPACK_IMPORTED_MODULE_7__["default"], {
    gallery: design_gallery
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_Colors__WEBPACK_IMPORTED_MODULE_13__["default"], {
    colors: colors
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h5", {
    class: "title"
  }, "Logos"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_Gallery__WEBPACK_IMPORTED_MODULE_7__["default"], {
    gallery: logos_gallery
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h5", {
    class: "title"
  }, "icons"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_Gallery__WEBPACK_IMPORTED_MODULE_7__["default"], {
    gallery: icons_gallery
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h5", {
    class: "title"
  }, "Animations"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_Gallery__WEBPACK_IMPORTED_MODULE_7__["default"], {
    gallery: animations_gallery
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h5", {
    class: "title"
  }, "uml diagrams"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_Gallery__WEBPACK_IMPORTED_MODULE_7__["default"], {
    gallery: uml_diagrams_gallery
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "project-process-development",
    id: "project_process_development"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", {
    class: "title"
  }, "DEVELOPMENT"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_CheckList__WEBPACK_IMPORTED_MODULE_12__["default"], {
    checklist: development_check_list
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "project-process-delivery",
    id: "project_process_delivery"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", {
    class: "title"
  }, "DELIVERY"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_CheckList__WEBPACK_IMPORTED_MODULE_12__["default"], {
    checklist: delivery_check_list
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_TheProblem__WEBPACK_IMPORTED_MODULE_14__["default"], {
    the_problem: the_problem
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_ProjectType__WEBPACK_IMPORTED_MODULE_5__["default"], {
    project_types: project_types
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_ProjectTags__WEBPACK_IMPORTED_MODULE_16__["default"], {
    project_tags: project_tags
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_ProjectTeam__WEBPACK_IMPORTED_MODULE_15__["default"], {
    project_team: project_team
  }));
}
/* harmony default export */ __webpack_exports__["default"] = (Project);

/***/ })

}]);
//# sourceMappingURL=src_views_Project_jsx.js.map