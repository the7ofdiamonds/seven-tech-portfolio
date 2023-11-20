"use strict";
(self["webpackChunkseven_tech_portfolio"] = self["webpackChunkseven_tech_portfolio"] || []).push([["src_views_ProjectProblem_jsx"],{

/***/ "./src/error/ErrorComponent.jsx":
/*!**************************************!*\
  !*** ./src/error/ErrorComponent.jsx ***!
  \**************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

function ErrorComponent(props) {
  const {
    error
  } = props;
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("main", {
    className: "error"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "status-bar card error"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, error)));
}
/* harmony default export */ __webpack_exports__["default"] = (ErrorComponent);

/***/ }),

/***/ "./src/loading/LoadingComponent.jsx":
/*!******************************************!*\
  !*** ./src/loading/LoadingComponent.jsx ***!
  \******************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

function LoadingComponent() {
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "loading"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h1", null, "Loading......"));
}
/* harmony default export */ __webpack_exports__["default"] = (LoadingComponent);

/***/ }),

/***/ "./src/views/ProjectProblem.jsx":
/*!**************************************!*\
  !*** ./src/views/ProjectProblem.jsx ***!
  \**************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var react_router_dom__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! react-router-dom */ "./node_modules/react-router/dist/index.js");
/* harmony import */ var react_redux__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react-redux */ "./node_modules/react-redux/es/index.js");
/* harmony import */ var _controllers_clientSlice__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../controllers/clientSlice */ "./src/controllers/clientSlice.js");
/* harmony import */ var _controllers_projectProblemSlice__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../controllers/projectProblemSlice */ "./src/controllers/projectProblemSlice.js");
/* harmony import */ var _loading_LoadingComponent__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../loading/LoadingComponent */ "./src/loading/LoadingComponent.jsx");
/* harmony import */ var _error_ErrorComponent__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../error/ErrorComponent */ "./src/error/ErrorComponent.jsx");








function TheProblemComponent() {
  const {
    project
  } = (0,react_router_dom__WEBPACK_IMPORTED_MODULE_7__.useParams)();
  const dispatch = (0,react_redux__WEBPACK_IMPORTED_MODULE_2__.useDispatch)();
  const navigate = (0,react_router_dom__WEBPACK_IMPORTED_MODULE_7__.useNavigate)();
  const [messageType, setMessageType] = (0,react__WEBPACK_IMPORTED_MODULE_1__.useState)('info');
  const [message, setMessage] = (0,react__WEBPACK_IMPORTED_MODULE_1__.useState)('To come up with the best solution, we must first define the problem below.');
  const [display, setDisplay] = (0,react__WEBPACK_IMPORTED_MODULE_1__.useState)('none');
  const {
    user_email,
    first_name,
    client_id
  } = (0,react_redux__WEBPACK_IMPORTED_MODULE_2__.useSelector)(state => state.client);
  const {
    problemLoading,
    problemError,
    summary,
    summary_url,
    customers_impacted,
    problem_affected,
    challenges,
    affected_operations,
    change_event,
    factors_contributed,
    patterns_trends,
    first_notice_date,
    recurring_issue,
    tried_solutions,
    tried_solutions_results,
    ideal_resolution,
    problem_id,
    problem_message
  } = (0,react_redux__WEBPACK_IMPORTED_MODULE_2__.useSelector)(state => state.problem);
  const [formData, setFormData] = (0,react__WEBPACK_IMPORTED_MODULE_1__.useState)({
    client_id: client_id,
    summary: summary,
    summary_url: summary_url,
    customers_impacted: customers_impacted,
    problem_affected: problem_affected,
    challenges: challenges,
    affected_operations: affected_operations,
    change_event: change_event,
    factors_contributed: factors_contributed,
    patterns_trends: patterns_trends,
    first_notice_date: first_notice_date,
    recurring_issue: recurring_issue,
    tried_solutions: tried_solutions,
    tried_solutions_results: tried_solutions_results,
    ideal_resolution: ideal_resolution
  });
  (0,react__WEBPACK_IMPORTED_MODULE_1__.useEffect)(() => {
    if (user_email) {
      dispatch((0,_controllers_clientSlice__WEBPACK_IMPORTED_MODULE_3__.getClient)()).then(response => {
        if (response.error !== undefined) {
          console.error(response.error.message);
          setMessageType('error');
          setMessage(response.error.message);
        } else {
          setFormData(prevData => ({
            ...prevData,
            client_id: response.payload.id
          }));
        }
      });
    }
  }, [user_email, dispatch]);
  (0,react__WEBPACK_IMPORTED_MODULE_1__.useEffect)(() => {
    if (project) {
      dispatch((0,_controllers_projectProblemSlice__WEBPACK_IMPORTED_MODULE_4__.getProjectProblem)(project));
    }
  }, [project, dispatch]);
  const handleInputChange = e => {
    const {
      name,
      value
    } = e.target;
    setFormData({
      ...formData,
      [name]: value
    });
  };
  const handleSubmit = e => {
    e.preventDefault();
    if (problem_id) {
      dispatch((0,_controllers_projectProblemSlice__WEBPACK_IMPORTED_MODULE_4__.updateProjectProblem)(formData));
    } else {
      dispatch((0,_controllers_projectProblemSlice__WEBPACK_IMPORTED_MODULE_4__.createProjectProblem)(formData)).then(response => {
        if (response.payload) {
          setTimeout(() => {
            window.location.href = '/dashboard';
          }, 5000);
        }
      });
    }
  };
  if (problemLoading) {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_loading_LoadingComponent__WEBPACK_IMPORTED_MODULE_5__["default"], null);
  }

  // if (projectError) {
  //   return <ErrorComponent error={projectError} />;
  // }

  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("section", {
    className: "project-problem"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h2", {
    className: "title"
  }, "THE PROBLEM"), message && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: `status-bar card ${messageType}`
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, message)), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "card"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("form", {
    className: "the-problem",
    action: ""
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("table", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tbody", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: ""
  }, "How are the customers or clients of (your company or organization) impacted by this problem?"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("textarea", {
    name: "customers_impacted",
    onChange: handleInputChange,
    value: formData.customers_impacted
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: ""
  }, "Who else is affected by this problem?"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("textarea", {
    name: "problem_affected",
    onChange: handleInputChange,
    value: formData.problem_affected
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: ""
  }, "What are the key challenges (your company or organization) is encountering?"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("textarea", {
    name: "challenges",
    onChange: handleInputChange,
    value: formData.challenges
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: ""
  }, "How has this problem affected (your company or organization) operations or outcomes?"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("textarea", {
    name: "affected_operations",
    onChange: handleInputChange,
    value: formData.affected_operations
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: ""
  }, "What factors contributed to this issue?"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("textarea", {
    name: "factors_contributed",
    onChange: handleInputChange,
    value: formData.factors_contributed
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: ""
  }, "Has there been any significant change or event that coincided with the problem's emergence?"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("textarea", {
    name: "change_event",
    onChange: handleInputChange,
    value: formData.change_event
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: ""
  }, "When did you first notice this problem?"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "date",
    name: "first_notice_date",
    className: "input-date",
    onChange: handleInputChange,
    value: formData.first_notice_date
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    for: "recurring_issue"
  }, "Is this a recurring issue, or is it a one-time occurrence?"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "options-column"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "option"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "radio",
    id: "recurring_issue_yes",
    name: "recurring_issue",
    className: "input-radio",
    value: 'yes',
    onChange: handleInputChange,
    checked: formData.recurring_issue === 'yes'
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    for: "recurring_issue_yes"
  }, "Yes")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "option"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "radio",
    id: "recurring_issue_no",
    name: "recurring_issue",
    className: "input-radio",
    value: 'no',
    onChange: handleInputChange,
    checked: formData.recurring_issue === 'no'
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    for: "recurring_issue_no"
  }, "No"))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: ""
  }, "Have (your company or organization) identified any patterns or trends related to this problem?"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("textarea", {
    name: "patterns_trends",
    onChange: handleInputChange,
    value: formData.patterns_trends
  }), ' ')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: ""
  }, "Have (your company or organization) tried any solutions to address this issue?"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "option"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "radio",
    id: "tried_solutions_yes",
    name: "tried_solutions",
    value: "yes",
    className: "input-radio",
    onChange: handleInputChange,
    checked: formData.tried_solutions === 'yes'
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "tried_solutions_yes"
  }, "Yes")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "option"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "radio",
    id: "tried_solutions_no",
    name: "tried_solutions",
    value: "no",
    className: "input-radio",
    onChange: handleInputChange,
    checked: formData.tried_solutions === 'no'
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "tried_solutions_no"
  }, "No")))), formData.tried_solutions === 'yes' && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: ""
  }, "What were the results?"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("textarea", {
    name: "tried_solutions_results",
    onChange: handleInputChange,
    value: formData.tried_solutions_results
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: ""
  }, "What would an ideal resolution to this problem look like for (your company or organization)?"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("textarea", {
    name: "ideal_resolution",
    onChange: handleInputChange,
    value: formData.ideal_resolution
  }))))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "overlay",
    style: {
      display: `${display}`
    }
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "card modal"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", null, "Thank you ", first_name, ", this information will be used to construct the best solution for this problem."))), problemError && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: `status-bar card error`
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, problemError)), problem_message && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: `status-bar card success`
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, problem_message)), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    type: "submit",
    onClick: handleSubmit
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", null, problem_id ? 'UPDATE' : 'SAVE'))));
}
/* harmony default export */ __webpack_exports__["default"] = (TheProblemComponent);

/***/ })

}]);
//# sourceMappingURL=src_views_ProjectProblem_jsx.js.map