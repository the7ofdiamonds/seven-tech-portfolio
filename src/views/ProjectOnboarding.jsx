import { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { useSelector, useDispatch } from 'react-redux';

import { getClient } from '../controllers/clientSlice';
import { getProjectByClientID } from '../controllers/projectSlice';
import { createProjectOnboarding } from '../controllers/onboardingSlice';

import LoadingComponent from '../loading/LoadingComponent';
import ErrorComponent from '../error/ErrorComponent';

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
  const { projectLoading, projectError } = useSelector(
    (state) => state.project
  );
  const { onboarding_id } = useSelector((state) => state.onboarding);

  const [formData, setFormData] = useState({
    post_id: '',
    client_id: '',
    deadline: '',
    deadline_date: '',
    where_business: '',
    website: '',
    website_url: '',
    hosting: '',
    satisfied: '',
    signage: '',
    signage_url: '',
    social: '',
    social_facebook: '',
    social_x: '',
    social_linkedin: '',
    social_instagram: '',
    logo: '',
    logo_url: '',
    colors: '',
    colors_primary: '#000000',
    colors_secondary: '#000000',
    colors_tertiary: '#000000',
    plan: '',
    plan_url: '',
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
    if (project && client_id) {
      dispatch(getProjectByClientID(project, client_id)).then((response) => {
        if (response.error !== undefined) {
          console.error(response);
          setMessageType('error');
          setMessage(response.error.message);
        } else {
          setFormData((prevData) => ({
            ...prevData,
            post_id: response.payload.post_id,
          }));
        }
      });
    }
  }, [dispatch, project, client_id]);

  useEffect(() => {
    if (onboarding_id) {
      setDisplay('flex');
      setTimeout(() => {
        if (formData?.plan === 'no') {
          window.location.href = `/project/problem/${project}`;
        } else if (formData?.plan === 'yes' && formData?.plan_url !== '') {
          window.location.href = '/dashboard';
        }
      }, 5000);
    }
  }, [onboarding_id, dispatch]);

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value,
    });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    dispatch(createProjectOnboarding(formData)).then((response) => {
      if (response.error !== undefined) {
        console.error(response.error.message);
        setMessageType('error');
        setMessage(response.error.message);
      }
    });
  };

  if (projectLoading) {
    return <LoadingComponent />;
  }

  if (projectError) {
    return <ErrorComponent error={projectError} />;
  }

  return (
    <>
      <section>
        <h2 className="title">CLIENT ONBOARDING</h2>

        {message && (
          <div className={`status-bar card ${messageType}`}>
            <span>{message}</span>
          </div>
        )}

        <div className="card">
          <form className="on-boarding" action="">
            <table>
              <tbody>
                <tr>
                  <td>
                    <label htmlFor="">
                      Does (your company or organization) have a specific
                      deadline that it needs to meet? If Yes, provide it below.
                    </label>
                    <div className="options-column">
                      <span className="option">
                        <input
                          type="radio"
                          id="deadline_yes"
                          name="deadline"
                          value="yes"
                          className="input-radio"
                          onChange={handleInputChange}
                          checked={formData.deadline === 'yes'}
                        />
                        <label htmlFor="deadline_yes">Yes</label>
                        {formData.deadline === 'yes' && (
                          <input
                            type="date"
                            id="deadline_date"
                            name="deadline_date"
                            value={formData.deadline_date}
                            className="input-date"
                            onChange={handleInputChange}
                          />
                        )}
                      </span>
                      <span className="option">
                        <input
                          type="radio"
                          id="deadline_no"
                          name="deadline"
                          value="no"
                          className="input-radio"
                          onChange={handleInputChange}
                          checked={formData.deadline === 'no'}
                        />
                        <label htmlFor="deadline_no">No</label>
                      </span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label htmlFor="">
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
                        <label for="where_business_online">Online</label>
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
                        <label for="where_business_brick">Both</label>
                      </span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label htmlFor="">
                      Does (your company or organization) have a website? If
                      Yes, provide a link to it below.
                    </label>
                    <div className="options-column">
                      <span className="option">
                        <input
                          type="radio"
                          id="website_yes"
                          name="website"
                          value="yes"
                          className="input-radio"
                          onChange={handleInputChange}
                          checked={formData.website === 'yes'}
                        />
                        <label htmlFor="website_yes">Yes</label>
                        {formData.website === 'yes' && (
                          <input
                            type="url"
                            id="website_url"
                            name="website_url"
                            className="input-url"
                            value={formData.website_url}
                            onChange={handleInputChange}
                          />
                        )}
                      </span>
                      <span className="option">
                        <input
                          type="radio"
                          id="website_no"
                          name="website"
                          value="no"
                          className="input-radio"
                          onChange={handleInputChange}
                          checked={formData.website === 'no'}
                        />
                        <label for="website_no">No</label>
                      </span>
                    </div>
                  </td>
                </tr>

                {formData.website === 'yes' && (
                  <>
                    <tr>
                      <td>
                        <label htmlFor="">
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
                      <td>
                        <label htmlFor="">
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
                    <tr>
                      <td>
                        <label htmlFor="">
                          Does your brick & mortar location(s) of (your company
                          or organization) have signage? If Yes, provide a link
                          to a picture of them below.
                        </label>
                        <div className="options-column">
                          <span className="option">
                            <input
                              type="radio"
                              id="signage_yes"
                              name="signage"
                              value="yes"
                              className="input-radio"
                              onChange={handleInputChange}
                              checked={formData.signage === 'yes'}
                            />
                            <label for="signage_yes">Yes</label>
                            {formData.signage === 'yes' && (
                              <input
                                type="url"
                                id="signage_url"
                                name="signage_url"
                                className="input-url"
                                value={formData.signage_url}
                                onChange={handleInputChange}
                              />
                            )}
                          </span>
                          <span className="option">
                            <input
                              type="radio"
                              id="signage_no"
                              name="signage"
                              value="no"
                              className="input-radio"
                              onChange={handleInputChange}
                              checked={formData.signage === 'no'}
                            />
                            <label for="signage_no">No</label>
                          </span>
                        </div>
                      </td>
                    </tr>
                  ))}
                <tr>
                  <td>
                    <label htmlFor="">
                      Does (your company or organization) have social media
                      pages? If Yes, provide a link to them below.
                    </label>
                    <div className="options-column">
                      <span className="option">
                        <input
                          type="radio"
                          id="social_yes"
                          name="social"
                          value="yes"
                          className="input-radio"
                          onChange={handleInputChange}
                          checked={formData.social === 'yes'}
                        />
                        <label for="social_yes">Yes</label>
                      </span>
                      <span className="option">
                        <input
                          type="radio"
                          id="social_no"
                          name="social"
                          value="no"
                          className="input-radio"
                          onChange={handleInputChange}
                          checked={formData.social === 'no'}
                        />
                        <label for="social_no">No</label>
                      </span>
                    </div>
                    {formData.social === 'yes' && (
                      <div className="options-column">
                        <span className="option">
                          <label htmlFor="facebook">Facebook</label>
                          <input
                            type="url"
                            id="social_facebook"
                            name="social_facebook"
                            className="input-url"
                            onChange={handleInputChange}
                            checked={formData.social_facebook}
                          />
                        </span>
                        <span className="option">
                          <label htmlFor="xtwitter">X</label>
                          <input
                            type="url"
                            id="social_x"
                            name="social_x"
                            className="input-url"
                            onChange={handleInputChange}
                            checked={formData.social_x}
                          />
                        </span>
                        <span className="option">
                          <label htmlFor="linkedin">LinkedIn</label>
                          <input
                            type="url"
                            id="social_linkedin"
                            name="social_linkedin"
                            className="input-url"
                            onChange={handleInputChange}
                            checked={formData.social_linkedin}
                          />
                        </span>
                        <span className="option">
                          <label htmlFor="instagram">Instagram</label>
                          <input
                            type="url"
                            id="social_instagram"
                            name="social_instagram"
                            className="input-url"
                            onChange={handleInputChange}
                            checked={formData.social_instagram}
                          />
                        </span>
                      </div>
                    )}
                  </td>
                </tr>
                <tr>
                  <td>
                    <label htmlFor="">
                      Does (your company or organization) have a logo? If Yes,
                      provide a link to it below.
                    </label>
                    <div className="options-column">
                      <span className="option">
                        <input
                          type="radio"
                          id="logo_yes"
                          name="logo"
                          value="yes"
                          className="input-radio"
                          onChange={handleInputChange}
                          checked={formData.logo === 'yes'}
                        />
                        <label for="logo_yes">Yes</label>
                        {formData.logo === 'yes' && (
                          <input
                            type="url"
                            id="logo_url"
                            name="logo_url"
                            className="input-url"
                            value={formData.logo_url}
                            onChange={handleInputChange}
                          />
                        )}
                      </span>
                      <span className="option">
                        <input
                          type="radio"
                          id="logo_no"
                          name="logo"
                          value="no"
                          className="input-radio"
                          onChange={handleInputChange}
                          checked={formData.logo === 'no'}
                        />
                        <label for="logo_no">No</label>
                      </span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label htmlFor="">
                      Does (your company or organization) have colors? If Yes,
                      provide them below.
                    </label>
                    <div className="options-column">
                      <span className="option">
                        <input
                          type="radio"
                          id="colors_yes"
                          name="colors"
                          value="yes"
                          className="input-radio"
                          onChange={handleInputChange}
                          checked={formData.colors === 'yes'}
                        />
                        <label for="colors_yes">Yes</label>
                      </span>
                      <span className="option">
                        <input
                          type="radio"
                          id="colors_no"
                          name="colors"
                          value="no"
                          className="input-radio"
                          onChange={handleInputChange}
                          checked={formData.colors === 'no'}
                        />
                        <label for="colors_no">No</label>
                      </span>
                    </div>
                    {formData.colors === 'yes' && (
                      <table>
                        <tbody>
                          <tr>
                            <td>
                              <label htmlFor="colors_primary">Primary</label>
                              <input
                                type="color"
                                id="colors_primary"
                                name="colors_primary"
                                value={formData.colors_primary}
                                onChange={handleInputChange}
                              />
                            </td>
                            <td>
                              <label htmlFor="colors_secondary">
                                Secondary
                              </label>
                              <input
                                type="color"
                                id="colors_secondary"
                                name="colors_secondary"
                                value={formData.colors_secondary}
                                onChange={handleInputChange}
                              />
                            </td>
                            <td>
                              <label htmlFor="colors_tertiary">Tertiary</label>
                              <input
                                type="color"
                                id="colors_tertiary"
                                name="colors_tertiary"
                                value={formData.colors_tertiary}
                                onChange={handleInputChange}
                              />
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    )}
                  </td>
                </tr>
                <tr>
                  <td>
                    <label htmlFor="">
                      Does (your company or organization) have a one-page or
                      full business plan that can be provided to define the
                      problem? If Yes, provide a link to it below.
                    </label>
                    <div className="options-column">
                      <span className="option">
                        <input
                          type="radio"
                          id="plan_yes"
                          name="plan"
                          value="yes"
                          className="input-radio"
                          onChange={handleInputChange}
                          checked={formData.plan === 'yes'}
                        />
                        <label for="plan_yes">Yes</label>
                        {formData.plan === 'yes' && (
                          <input
                            type="url"
                            id="plan_url"
                            name="plan_url"
                            className="input-url"
                            value={formData.plan_url}
                            onChange={handleInputChange}
                          />
                        )}
                      </span>
                      <span className="option">
                        <input
                          type="radio"
                          id="plan_no"
                          name="plan"
                          value="no"
                          className="input-radio"
                          onChange={handleInputChange}
                          checked={formData.plan === 'no'}
                        />
                        <label for="plan_no">No</label>
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

        <button type="submit" onClick={handleSubmit}>
          <h3>SAVE</h3>
        </button>
      </section>
    </>
  );
}

export default OnBoardingComponent;