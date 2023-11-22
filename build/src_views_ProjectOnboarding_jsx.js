"use strict";
(self["webpackChunkseven_tech_portfolio"] = self["webpackChunkseven_tech_portfolio"] || []).push([["src_views_ProjectOnboarding_jsx"],{

/***/ "./src/views/ProjectOnboarding.jsx":
/*!*****************************************!*\
  !*** ./src/views/ProjectOnboarding.jsx ***!
  \*****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var react_router_dom__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! react-router-dom */ "./node_modules/react-router/dist/index.js");
/* harmony import */ var react_redux__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react-redux */ "./node_modules/react-redux/es/index.js");
/* harmony import */ var _controllers_clientSlice__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../controllers/clientSlice */ "./src/controllers/clientSlice.js");
/* harmony import */ var _controllers_projectOnboardingSlice__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../controllers/projectOnboardingSlice */ "./src/controllers/projectOnboardingSlice.js");
/* harmony import */ var _views_components_global_LoadingComponent__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../views/components/global/LoadingComponent */ "./src/views/components/global/LoadingComponent.jsx");
/* harmony import */ var _views_components_global_StatusBar__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../views/components/global/StatusBar */ "./src/views/components/global/StatusBar.jsx");
/* harmony import */ var _views_components_global_Modal__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../views/components/global/Modal */ "./src/views/components/global/Modal.jsx");









function OnBoardingComponent() {
  const {
    project
  } = (0,react_router_dom__WEBPACK_IMPORTED_MODULE_8__.useParams)();
  const dispatch = (0,react_redux__WEBPACK_IMPORTED_MODULE_2__.useDispatch)();
  const [messageType, setMessageType] = (0,react__WEBPACK_IMPORTED_MODULE_1__.useState)('info');
  const [message, setMessage] = (0,react__WEBPACK_IMPORTED_MODULE_1__.useState)('To better serve your needs and wants, please fill out the onboarding form.');
  const {
    user_email,
    first_name,
    client_id
  } = (0,react_redux__WEBPACK_IMPORTED_MODULE_2__.useSelector)(state => state.client);
  const {
    onboardingLoading,
    onboardingError,
    project_title,
    project_slug,
    deadline,
    where_business,
    website,
    hosting,
    satisfied,
    signage,
    social_networks,
    logo,
    colors,
    plan,
    onboardingID,
    onboardingMessage
  } = (0,react_redux__WEBPACK_IMPORTED_MODULE_2__.useSelector)(state => state.onboarding);
  const [formData, setFormData] = (0,react__WEBPACK_IMPORTED_MODULE_1__.useState)({
    client_id: client_id,
    project_slug: project !== null && project !== void 0 ? project : project_slug,
    project_title: project_title,
    deadline: deadline,
    where_business: where_business,
    website: website,
    hosting: hosting,
    satisfied: satisfied,
    signage: signage,
    social_networks: social_networks,
    logo: logo,
    colors: colors,
    plan: plan
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
      dispatch((0,_controllers_projectOnboardingSlice__WEBPACK_IMPORTED_MODULE_4__.getProjectOnboarding)(project));
    }
  }, [project, dispatch]);
  if (onboardingLoading) {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_views_components_global_LoadingComponent__WEBPACK_IMPORTED_MODULE_5__["default"], null);
  }
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
  const handleSocialLinkChange = (e, platform) => {
    const updatedSocialNetworks = formData.social_networks.map(social => {
      if (social.platform === platform) {
        return {
          ...social,
          link: e.target.value
        };
      }
      return social;
    });
    setFormData({
      ...formData,
      social_networks: updatedSocialNetworks
    });
  };
  const handleColorInputChange = (e, color_title) => {
    const updatedColorInputs = formData.colors.map(color => {
      if (color.title === color_title) {
        return {
          ...color,
          value: e.target.value
        };
      }
      return color;
    });
    setFormData({
      ...formData,
      colors: updatedColorInputs
    });
  };
  const scrollToQuestion = id => {
    const question = document.getElementById(`${id}`);
    if (question) {
      question.scrollIntoView({
        behavior: 'smooth'
      });
    }
  };
  const handleSubmit = e => {
    e.preventDefault();
    const unansweredQuestions = Object.keys(formData).filter(question => formData[question] === null || formData[question] === '');
    if (unansweredQuestions.length > 0) {
      scrollToQuestion(unansweredQuestions[0]);
    } else if (onboardingID) {
      dispatch((0,_controllers_projectOnboardingSlice__WEBPACK_IMPORTED_MODULE_4__.updateProjectOnboarding)(formData)).then(response => {
        if (response.payload && !isNaN(response.payload.results)) {
          setTimeout(() => {
            if (formData?.plan === '') {
              window.location.href = `/project/problem/${project_slug}`;
            } else if (formData?.plan !== '') {
              window.location.href = '/dashboard';
            }
          }, 5000);
        }
      });
    } else {
      dispatch((0,_controllers_projectOnboardingSlice__WEBPACK_IMPORTED_MODULE_4__.createProjectOnboarding)(formData)).then(response => {
        if (response.payload && !isNaN(response.payload.id)) {
          setTimeout(() => {
            if (formData?.plan === '') {
              window.location.href = `/project/problem/${project_slug}`;
            } else if (formData?.plan !== '') {
              window.location.href = '/dashboard';
            }
          }, 5000);
        }
      });
    }
  };
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("section", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h2", {
    className: "title"
  }, "CLIENT ONBOARDING"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_views_components_global_StatusBar__WEBPACK_IMPORTED_MODULE_6__["default"], {
    message: message,
    messageType: messageType
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "card"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("form", {
    className: "on-boarding",
    action: ""
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("table", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tbody", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", {
    id: "project_title"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "project_title"
  }, "Project title"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "options-column"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "option"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "text",
    id: "project_title",
    name: "project_title",
    value: formData.project_title,
    className: "input-radio",
    onChange: handleInputChange
  })))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", {
    id: "deadline"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "deadline"
  }, "Does (your company or organization) have a specific deadline that it needs to meet? If Yes, provide it below."), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "options-column"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "option"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "date",
    id: "deadline_date",
    name: "deadline",
    value: formData.deadline,
    className: "input-date",
    onChange: handleInputChange
  }))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", {
    id: "where_business_online"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "where_business_online"
  }, "How does (your company or organization) currently do business?"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "options-column"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "option"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "radio",
    id: "where_business_online",
    name: "where_business",
    value: "online",
    className: "input-radio",
    onChange: handleInputChange,
    checked: formData.where_business === 'online'
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "where_business_online"
  }, "Online")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "option"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "radio",
    id: "where_business_brick",
    name: "where_business",
    value: "brick and mortar",
    className: "input-radio",
    onChange: handleInputChange,
    checked: formData.where_business === 'brick and mortar'
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    for: "where_business_brick"
  }, "Brick & Mortar")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "option"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "radio",
    id: "where_business_both",
    name: "where_business",
    value: "both",
    className: "input-radio",
    onChange: handleInputChange,
    checked: formData.where_business === 'both'
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "where_business_brick"
  }, "Both"))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", {
    id: "website"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "website"
  }, "Does (your company or organization) have a website? If Yes, provide a link to it below."), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "options-column"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "option"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "url",
    id: "website",
    name: "website",
    className: "input-url",
    value: formData.website,
    onChange: handleInputChange
  }))))), formData.website !== '' && formData.website !== null && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", {
    id: "hosting"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "hosting"
  }, "What hosting service does (your company or organization) currently use?"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "options-column"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "option"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "radio",
    id: "hosting_aws",
    name: "hosting",
    value: "aws",
    className: "input-radio",
    onChange: handleInputChange,
    checked: formData.hosting === 'aws'
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    for: "hosting_aws"
  }, "AWS")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "option"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "radio",
    id: "hosting_azure",
    name: "hosting",
    value: "azure",
    className: "input-radio",
    onChange: handleInputChange,
    checked: formData.hosting === 'azure'
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    for: "hosting_azure"
  }, "Azure")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "option"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "radio",
    id: "hosting_google",
    name: "hosting",
    value: "google",
    className: "input-radio",
    onChange: handleInputChange,
    checked: formData.hosting === 'google'
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    for: "hosting_google"
  }, "Google")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "option"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "radio",
    id: "hosting_godaddy",
    name: "hosting",
    value: "godaddy",
    className: "input-radio",
    onChange: handleInputChange,
    checked: formData.hosting === 'godaddy'
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    for: "hosting_godaddy"
  }, "GoDaddy")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "option"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "radio",
    id: "hosting_other",
    name: "hosting",
    value: "other",
    className: "input-radio",
    onChange: handleInputChange,
    checked: formData.hosting === 'other'
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    for: "hosting_other"
  }, "Other"), formData.hosting === 'other' && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "text",
    id: "hosting_other",
    name: "hosting_other",
    className: "other",
    value: formData.hosting_other,
    onChange: handleInputChange
  }))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", {
    id: "satisfied"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "satisfied"
  }, "Is (your company or organization) satisfied with the hosting service?"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "options-column"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "option"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "radio",
    id: "satisfied_yes",
    name: "satisfied",
    value: "yes",
    className: "input-radio",
    onChange: handleInputChange,
    checked: formData.satisfied === 'yes'
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    for: "satisfied_yes"
  }, "Yes")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "option"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "radio",
    id: "satisfied_no",
    name: "satisfied",
    value: "no",
    className: "input-radio",
    onChange: handleInputChange,
    checked: formData.satisfied === 'no'
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    for: "satisfied_no"
  }, "No")))))), formData.where_business === 'brick and mortar' || formData.where_business === 'both' && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", {
    id: "signage"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "signage"
  }, "Does your brick & mortar location(s) of (your company or organization) have signage? If Yes, provide a link to a picture of them below."), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "options-column"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "option"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "url",
    id: "signage",
    name: "signage",
    className: "input-url",
    value: formData.signage,
    onChange: handleInputChange
  }))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", {
    id: "social_networks"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "social_networks"
  }, "Does (your company or organization) have social media pages? If Yes, provide a link to them below."), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "options-column"
  }, Object.keys(formData.social_networks).map(social_network => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "option",
    key: social_network
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: `social_networks_${formData.social_networks[social_network].platform}`
  }, formData.social_networks[social_network].platform), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "url",
    id: `social_networks_${social_network}_link`,
    name: `social_networks_${social_network}_link`,
    className: "input-url",
    value: formData.social_networks[social_network].link,
    onChange: e => handleSocialLinkChange(e, social_networks[social_network].platform)
  })))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", {
    id: "logo"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "logo"
  }, "Does (your company or organization) have a logo? If Yes, provide a link to it below."), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "options-column"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "option"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "url",
    id: "logo",
    name: "logo",
    className: "input-url",
    value: formData.logo,
    onChange: handleInputChange
  }))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", {
    id: "colors"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "colors"
  }, "Does (your company or organization) have colors? If Yes, provide them below."), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "options-column"
  }, formData.colors.map(color => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    key: color.title,
    className: "color-input"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: color.title
  }, color.title), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "color",
    id: color.title,
    name: color.title,
    value: color.value,
    onChange: e => handleColorInputChange(e, color.title)
  })))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", {
    id: "plan"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
    htmlFor: "plan"
  }, "Does (your company or organization) have a one-page or full business plan that can be provided to define the problem? If Yes, provide a link to it below."), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "options-column"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "option"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("input", {
    type: "url",
    id: "plan",
    name: "plan",
    className: "input-url",
    value: formData.plan,
    onChange: handleInputChange
  }))))))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_views_components_global_Modal__WEBPACK_IMPORTED_MODULE_7__["default"], {
    message: onboardingMessage
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_views_components_global_StatusBar__WEBPACK_IMPORTED_MODULE_6__["default"], {
    message: onboardingError,
    messageType: 'error'
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("button", {
    type: "submit",
    onClick: handleSubmit
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", null, onboardingID ? 'UPDATE' : 'SAVE'))));
}
/* harmony default export */ __webpack_exports__["default"] = (OnBoardingComponent);

/***/ }),

/***/ "./src/views/components/global/LoadingComponent.jsx":
/*!**********************************************************!*\
  !*** ./src/views/components/global/LoadingComponent.jsx ***!
  \**********************************************************/
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

/***/ "./src/views/components/global/Modal.jsx":
/*!***********************************************!*\
  !*** ./src/views/components/global/Modal.jsx ***!
  \***********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);


function Modal(props) {
  const {
    message
  } = props;
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, message && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "overlay"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "status-bar card success modal"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", null, message))));
}
/* harmony default export */ __webpack_exports__["default"] = (Modal);

/***/ }),

/***/ "./src/views/components/global/StatusBar.jsx":
/*!***************************************************!*\
  !*** ./src/views/components/global/StatusBar.jsx ***!
  \***************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_1__);


function StatusBar(props) {
  const {
    message,
    messageType
  } = props;
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, message && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: `status-bar card ${messageType}`
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, message)));
}
/* harmony default export */ __webpack_exports__["default"] = (StatusBar);

/***/ })

}]);
//# sourceMappingURL=src_views_ProjectOnboarding_jsx.js.map