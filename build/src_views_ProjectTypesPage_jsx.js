"use strict";
(self["webpackChunkthfw_portfolio"] = self["webpackChunkthfw_portfolio"] || []).push([["src_views_ProjectTypesPage_jsx"],{

/***/ "./src/components/Gallery.jsx":
/*!************************************!*\
  !*** ./src/components/Gallery.jsx ***!
  \************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

function Gallery(props) {
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, props.gallery && props.gallery.length > 0 ? (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
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
  }))))) : '');
}
/* harmony default export */ __webpack_exports__["default"] = (Gallery);

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
  const {
    project_status
  } = props;
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "project-status"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", null, "STATUS"), project_status === '0' || project_status === undefined || project_status === null ? (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h5", null, "NOT STARTED") : project_status === 'ongoing' ? (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h5", null, "ONGOING") : (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("progress", {
    className: "status-bar",
    value: project_status,
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
  const handleClick = slug => {
    window.open(`${slug}`);
  };
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "project-tags"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", {
    className: "title"
  }, "Project Tags"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "tag-row"
  }, Array.isArray(project_tags) && project_tags.map((project_tag, index) => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    className: "tag",
    onClick: () => handleClick(project_tag.slug)
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", {
    key: index
  }, "#", project_tag.name))))));
}
/* harmony default export */ __webpack_exports__["default"] = (ProjectTags);

/***/ }),

/***/ "./src/components/ProjectTypes.jsx":
/*!*****************************************!*\
  !*** ./src/components/ProjectTypes.jsx ***!
  \*****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

function ProjectType(props) {
  const {
    project_types
  } = props;
  const handleClick = slug => {
    window.open(`${slug}`);
  };
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    class: "project-type"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", {
    className: "title"
  }, "Project Types"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "project-type-row"
  }, Array.isArray(project_types) && project_types.map((project_type, index) => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    onClick: () => handleClick(project_type.slug),
    key: index
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", {
    className: "title"
  }, project_type.name))))));
}
/* harmony default export */ __webpack_exports__["default"] = (ProjectType);

/***/ }),

/***/ "./src/components/Projects.jsx":
/*!*************************************!*\
  !*** ./src/components/Projects.jsx ***!
  \*************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _components_Gallery__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../components/Gallery */ "./src/components/Gallery.jsx");
/* harmony import */ var _components_ProjectStatus__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../components/ProjectStatus */ "./src/components/ProjectStatus.jsx");




function Projects(props) {
  const {
    projects
  } = props;
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, projects && projects.length > 0 ? projects.map((project, index) => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    key: index,
    className: "project card"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", null, project.title), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
    href: `/portfolio/${project.post_name}`
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_Gallery__WEBPACK_IMPORTED_MODULE_2__["default"], {
    gallery: project.solution_gallery
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_ProjectStatus__WEBPACK_IMPORTED_MODULE_3__["default"], {
    project_status: project.project_status
  }))) : 'There are no projects to display');
}
/* harmony default export */ __webpack_exports__["default"] = (Projects);

/***/ }),

/***/ "./src/views/ProjectTypesPage.jsx":
/*!****************************************!*\
  !*** ./src/views/ProjectTypesPage.jsx ***!
  \****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var react_redux__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react-redux */ "./node_modules/react-redux/es/index.js");
/* harmony import */ var react_router_dom__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! react-router-dom */ "./node_modules/react-router/dist/index.js");
/* harmony import */ var _controllers_clientSlice__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../controllers/clientSlice */ "./src/controllers/clientSlice.js");
/* harmony import */ var _controllers_portfolioSlice__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../controllers/portfolioSlice */ "./src/controllers/portfolioSlice.js");
/* harmony import */ var _components_Projects__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../components/Projects */ "./src/components/Projects.jsx");
/* harmony import */ var _components_ProjectTypes__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../components/ProjectTypes */ "./src/components/ProjectTypes.jsx");
/* harmony import */ var _components_ProjectTags__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../components/ProjectTags */ "./src/components/ProjectTags.jsx");









function ProjectTypesPage() {
  const location = (0,react_router_dom__WEBPACK_IMPORTED_MODULE_8__.useLocation)();
  const projectType = location.pathname.split('/')[3];
  const {
    loading,
    error,
    projects,
    project_types,
    project_tags
  } = (0,react_redux__WEBPACK_IMPORTED_MODULE_2__.useSelector)(state => state.portfolio);
  const dispatch = (0,react_redux__WEBPACK_IMPORTED_MODULE_2__.useDispatch)();
  (0,react__WEBPACK_IMPORTED_MODULE_1__.useEffect)(() => {
    dispatch((0,_controllers_portfolioSlice__WEBPACK_IMPORTED_MODULE_4__.getProjectsType)(projectType));
  }, [dispatch, projectType]);
  (0,react__WEBPACK_IMPORTED_MODULE_1__.useEffect)(() => {
    dispatch((0,_controllers_portfolioSlice__WEBPACK_IMPORTED_MODULE_4__.getPortfolioTypes)());
  }, [dispatch]);
  (0,react__WEBPACK_IMPORTED_MODULE_1__.useEffect)(() => {
    dispatch((0,_controllers_portfolioSlice__WEBPACK_IMPORTED_MODULE_4__.getPortfolioTags)());
  }, [dispatch]);
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_Projects__WEBPACK_IMPORTED_MODULE_5__["default"], {
    projects: projects
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_ProjectTypes__WEBPACK_IMPORTED_MODULE_6__["default"], {
    project_types: project_types
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_ProjectTags__WEBPACK_IMPORTED_MODULE_7__["default"], {
    project_tags: project_tags
  }));
}
/* harmony default export */ __webpack_exports__["default"] = (ProjectTypesPage);

/***/ })

}]);
//# sourceMappingURL=src_views_ProjectTypesPage_jsx.js.map