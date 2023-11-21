import { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { useSelector, useDispatch } from 'react-redux';

import { getClient } from '../controllers/clientSlice';
import {
  createProjectOnboarding,
  getProjectOnboarding,
  updateProjectOnboarding,
} from '../controllers/projectOnboardingSlice';

import LoadingComponent from '../views/components/global/LoadingComponent';
import StatusBar from '../views/components/global/StatusBar';
import Modal from '../views/components/global/Modal';

function OnBoardingComponent() {
  const { project } = useParams();

  const dispatch = useDispatch();

  const [messageType, setMessageType] = useState('info');
  const [message, setMessage] = useState(
    'To better serve your needs and wants, please fill out the form below.'
  );
  const [display, setDisplay] = useState('none');

  const { user_email, first_name, client_id } = useSelector(
    (state) => state.client
  );
  const {
    onboardingLoading,
    onboardingError,
    project_title,
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
    onboarding_id,
    onboardingMessage,
  } = useSelector((state) => state.onboarding);

  const [formData, setFormData] = useState({
    client_id: client_id,
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
    plan: plan,
  });

  useEffect(() => {
    if (user_email) {
      dispatch(getClient()).then((response) => {
        if (response.error !== undefined) {
          console.error(response.error.message);
          setMessageType('error');
          setMessage(response.error.message);
        } else {
          setFormData((prevData) => ({
            ...prevData,
            client_id: response.payload.id,
          }));
        }
      });
    }
  }, [user_email, dispatch]);

  useEffect(() => {
    if (project) {
      dispatch(getProjectOnboarding(project)).then((response) => {
        if (response.error) {
          console.error(response.error.message);
          setMessageType('error');
          setMessage(response.error.message);
        } else {
          setFormData((prevData) => ({
            ...prevData,
            ...response.payload,
          }));
        }
      });
    }
  }, [project, dispatch]);

  if (onboardingLoading) {
    return <LoadingComponent />;
  }

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value,
    });
  };

  const handleSocialLinkChange = (e, platform) => {
    const updatedSocialNetworks = formData.social_networks.map((social) => {
      if (social.platform === platform) {
        return {
          ...social,
          link: e.target.value,
        };
      }
      return social;
    });

    setFormData({
      ...formData,
      social_networks: updatedSocialNetworks,
    });
  };

  const handleColorInputChange = (e, color_title) => {
    const updatedColorInputs = formData.colors.map((color) => {
      if (color.title === color_title) {
        return {
          ...color,
          value: e.target.value,
        };
      }
      return color;
    });

    setFormData({
      ...formData,
      colors: updatedColorInputs,
    });
  };

  const scrollToQuestion = (id) => {
    const question = document.getElementById(`${id}`);

    if (question) {
      question.scrollIntoView({ behavior: 'smooth' });
    }
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    const unansweredQuestions = Object.keys(formData).filter(
      (question) => formData[question] === null || formData[question] === ''
    );

    if (unansweredQuestions.length > 0) {
      scrollToQuestion(unansweredQuestions[0]);
    } else {
      if (onboarding_id) {
        dispatch(updateProjectOnboarding(formData)).then((response) => {
          if (!isNaN(response.payload.id)) {
            setDisplay('flex');
            setTimeout(() => {
              window.location.href = '/dashboard';
            }, 5000);
          }
        });
      } else {
        dispatch(createProjectOnboarding(formData)).then((response) => {
          if (!isNaN(response.payload)) {
            setDisplay('flex');
            setTimeout(() => {
              if (formData?.plan === 'no') {
                window.location.href = `/project/problem/${project_title}`;
              } else if (
                formData?.plan === 'yes' &&
                formData?.plan_url !== ''
              ) {
                window.location.href = '/dashboard';
              }
            }, 5000);
          }
        });
      }
    }
  };

  return (
    <>
      <section>
        <h2 className="title">CLIENT ONBOARDING</h2>

        <StatusBar message={message} messageType={messageType} />

        <div className="card">
          <form className="on-boarding" action="">
            <table>
              <tbody>
                <tr id="project_title">
                  <label htmlFor="project_title">Project title</label>
                  <div className="options-column">
                    <span className="option">
                      <input
                        type="text"
                        id="project_title"
                        name="project_title"
                        value={formData.project_title}
                        className="input-radio"
                        onChange={handleInputChange}
                      />
                    </span>
                  </div>
                </tr>
                <tr id="deadline">
                  <td>
                    <label htmlFor="deadline">
                      Does (your company or organization) have a specific
                      deadline that it needs to meet? If Yes, provide it below.
                    </label>
                    <div className="options-column">
                      <span className="option">
                        <input
                          type="date"
                          id="deadline_date"
                          name="deadline"
                          value={formData.deadline}
                          className="input-date"
                          onChange={handleInputChange}
                        />
                      </span>
                    </div>
                  </td>
                </tr>
                <tr id="where_business_online">
                  <td>
                    <label htmlFor="where_business_online">
                      How does (your company or organization) currently do
                      business?
                    </label>
                    <div className="options-column">
                      <span className="option">
                        <input
                          type="radio"
                          id="where_business_online"
                          name="where_business"
                          value="online"
                          className="input-radio"
                          onChange={handleInputChange}
                          checked={formData.where_business === 'online'}
                        />
                        <label htmlFor="where_business_online">Online</label>
                      </span>
                      <span className="option">
                        <input
                          type="radio"
                          id="where_business_brick"
                          name="where_business"
                          value="brick and mortar"
                          className="input-radio"
                          onChange={handleInputChange}
                          checked={
                            formData.where_business === 'brick and mortar'
                          }
                        />
                        <label for="where_business_brick">Brick & Mortar</label>
                      </span>
                      <span className="option">
                        <input
                          type="radio"
                          id="where_business_both"
                          name="where_business"
                          value="both"
                          className="input-radio"
                          onChange={handleInputChange}
                          checked={formData.where_business === 'both'}
                        />
                        <label htmlFor="where_business_brick">Both</label>
                      </span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td id="website">
                    <label htmlFor="website">
                      Does (your company or organization) have a website? If
                      Yes, provide a link to it below.
                    </label>
                    <div className="options-column">
                      <span className="option">
                        <input
                          type="url"
                          id="website"
                          name="website"
                          className="input-url"
                          value={formData.website}
                          onChange={handleInputChange}
                        />
                      </span>
                    </div>
                  </td>
                </tr>

                {formData.website !== '' && formData.website !== null && (
                  <>
                    <tr id="hosting">
                      <td>
                        <label htmlFor="hosting">
                          What hosting service does (your company or
                          organization) currently use?
                        </label>
                        <div className="options-column">
                          <span className="option">
                            <input
                              type="radio"
                              id="hosting_aws"
                              name="hosting"
                              value="aws"
                              className="input-radio"
                              onChange={handleInputChange}
                              checked={formData.hosting === 'aws'}
                            />
                            <label for="hosting_aws">AWS</label>
                          </span>
                          <span className="option">
                            <input
                              type="radio"
                              id="hosting_azure"
                              name="hosting"
                              value="azure"
                              className="input-radio"
                              onChange={handleInputChange}
                              checked={formData.hosting === 'azure'}
                            />
                            <label for="hosting_azure">Azure</label>
                          </span>
                          <span className="option">
                            <input
                              type="radio"
                              id="hosting_google"
                              name="hosting"
                              value="google"
                              className="input-radio"
                              onChange={handleInputChange}
                              checked={formData.hosting === 'google'}
                            />
                            <label for="hosting_google">Google</label>
                          </span>
                          <span className="option">
                            <input
                              type="radio"
                              id="hosting_godaddy"
                              name="hosting"
                              value="godaddy"
                              className="input-radio"
                              onChange={handleInputChange}
                              checked={formData.hosting === 'godaddy'}
                            />
                            <label for="hosting_godaddy">GoDaddy</label>
                          </span>
                          <span className="option">
                            <input
                              type="radio"
                              id="hosting_other"
                              name="hosting"
                              value="other"
                              className="input-radio"
                              onChange={handleInputChange}
                              checked={formData.hosting === 'other'}
                            />
                            <label for="hosting_other">Other</label>
                            {formData.hosting === 'other' && (
                              <input
                                type="text"
                                id="hosting_other"
                                name="hosting_other"
                                className="other"
                                value={formData.hosting_other}
                                onChange={handleInputChange}
                              />
                            )}
                          </span>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td id="satisfied">
                        <label htmlFor="satisfied">
                          Is (your company or organization) satisfied with the
                          hosting service?
                        </label>
                        <div className="options-column">
                          <span className="option">
                            <input
                              type="radio"
                              id="satisfied_yes"
                              name="satisfied"
                              value="yes"
                              className="input-radio"
                              onChange={handleInputChange}
                              checked={formData.satisfied === 'yes'}
                            />
                            <label for="satisfied_yes">Yes</label>
                          </span>
                          <span className="option">
                            <input
                              type="radio"
                              id="satisfied_no"
                              name="satisfied"
                              value="no"
                              className="input-radio"
                              onChange={handleInputChange}
                              checked={formData.satisfied === 'no'}
                            />
                            <label for="satisfied_no">No</label>
                          </span>
                        </div>
                      </td>
                    </tr>
                  </>
                )}

                {formData.where_business === 'brick and mortar' ||
                  (formData.where_business === 'both' && (
                    <tr id="signage">
                      <td>
                        <label htmlFor="signage">
                          Does your brick & mortar location(s) of (your company
                          or organization) have signage? If Yes, provide a link
                          to a picture of them below.
                        </label>
                        <div className="options-column">
                          <span className="option">
                            <input
                              type="url"
                              id="signage"
                              name="signage"
                              className="input-url"
                              value={formData.signage}
                              onChange={handleInputChange}
                            />
                          </span>
                        </div>
                      </td>
                    </tr>
                  ))}
                <tr id="social_networks">
                  <td>
                    <label htmlFor="social_networks">
                      Does (your company or organization) have social media
                      pages? If Yes, provide a link to them below.
                    </label>
                    <div className="options-column">
                      {Object.keys(formData.social_networks).map(
                        (social_network) => (
                          <span className="option" key={social_network}>
                            <label
                              htmlFor={`social_networks_${formData.social_networks[social_network].platform}`}>
                              {
                                formData.social_networks[social_network]
                                  .platform
                              }
                            </label>
                            <input
                              type="url"
                              id={`social_networks_${social_network}_link`}
                              name={`social_networks_${social_network}_link`}
                              className="input-url"
                              value={
                                formData.social_networks[social_network].link
                              }
                              onChange={(e) =>
                                handleSocialLinkChange(
                                  e,
                                  social_networks[social_network].platform
                                )
                              }
                            />
                          </span>
                        )
                      )}
                    </div>
                  </td>
                </tr>
                <tr id="logo">
                  <td>
                    <label htmlFor="logo">
                      Does (your company or organization) have a logo? If Yes,
                      provide a link to it below.
                    </label>
                    <div className="options-column">
                      <span className="option">
                        <input
                          type="url"
                          id="logo"
                          name="logo"
                          className="input-url"
                          value={formData.logo}
                          onChange={handleInputChange}
                        />
                      </span>
                    </div>
                  </td>
                </tr>
                <tr id="colors">
                  <td>
                    <label htmlFor="colors">
                      Does (your company or organization) have colors? If Yes,
                      provide them below.
                    </label>
                    <div className="options-column">
                      {formData.colors.map((color) => (
                        <div key={color.title} className="color-input">
                          <label htmlFor={color.title}>{color.title}</label>
                          <input
                            type="color"
                            id={color.title}
                            name={color.title}
                            value={color.value}
                            onChange={(e) =>
                              handleColorInputChange(e, color.title)
                            }
                          />
                        </div>
                      ))}
                    </div>
                  </td>
                </tr>
                <tr id="plan">
                  <td>
                    <label htmlFor="plan">
                      Does (your company or organization) have a one-page or
                      full business plan that can be provided to define the
                      problem? If Yes, provide a link to it below.
                    </label>
                    <div className="options-column">
                      <span className="option">
                        <input
                          type="url"
                          id="plan"
                          name="plan"
                          className="input-url"
                          value={formData.plan}
                          onChange={handleInputChange}
                        />
                      </span>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>

        <span className="overlay" style={{ display: `${display}` }}>
          <div className="card modal">
            <h4>
              Thank you {first_name}, this information will be used to construct
              a solution.
            </h4>
          </div>
        </span>

        <Modal message={onboardingMessage} display={display} />

        <StatusBar message={onboardingError} messageType={'error'} />

        <button type="submit" onClick={handleSubmit}>
          <h3>{onboarding_id ? 'UPDATE' : 'SAVE'}</h3>
        </button>
      </section>
    </>
  );
}

export default OnBoardingComponent;
