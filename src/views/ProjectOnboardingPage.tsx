import React, { useState, useEffect, ChangeEvent, MouseEvent } from 'react';
import { useParams } from 'react-router-dom';

import { useAppDispatch, useAppSelector } from '@/model/hooks';

import { getClient } from '../controllers/clientSlice';
import {
  createProjectOnboarding,
  getProjectOnboarding,
  updateProjectOnboarding,
} from '../controllers/projectOnboardingSlice';

import SocialNetworks from './components/onboarding/SocialNetworks';
import Logos from './components/onboarding/Logos';
import Colors from './components/onboarding/Colors';

import { LoadingComponent, StatusBar, Modal } from '@the7ofdiamonds/github-portfolio';

import { ProjectOnboarding } from '@the7ofdiamonds/github-portfolio';

import styles from '@/views/components/onboarding/Onboarding.module.scss';


const ProjectOnBoardingPage: React.FC = () => {
  const { projectID } = useParams();

  const dispatch = useAppDispatch();

  const [show, setShow] = useState<string>('hide');
  const [messageType, setMessageType] = useState<string>('info');
  const [message, setMessage] = useState<string>(
    'To better serve your needs and wants, please fill out the onboarding form.'
  );
  const [projectOnboarding, setProjectOnboarding] = useState<ProjectOnboarding>(new ProjectOnboarding());
  const [onboardingID, setOnboardingID] = useState<string | null>(null);

  const { user_email, first_name, client_id } = useAppSelector(
    (state) => state.client
  );
  const {
    onboardingLoading,
    onboardingSuccessMessage,
    onboardingErrorMessage,
    projectOnboardingObject,
  } = useAppSelector((state) => state.onboarding);

  useEffect(() => {
    if (projectOnboardingObject) {
      setProjectOnboarding(new ProjectOnboarding(projectOnboardingObject))
    }
  }, [projectOnboardingObject]);

  useEffect(() => {
    if (projectOnboarding.id) {
      setOnboardingID(projectOnboarding.id)
    }
  }, [projectOnboarding]);

  useEffect(() => {
    if (user_email) {
      dispatch(getClient());
    }
  }, [user_email, dispatch]);

  useEffect(() => {
    if (onboardingID) {
      dispatch(getProjectOnboarding(onboardingID));
    }
  }, [onboardingID]);

  if (onboardingLoading) {
    return <LoadingComponent />;
  }

  const handleInputChange = (e: ChangeEvent<HTMLInputElement>) => {
    const { name, value } = e.target;
    setProjectOnboarding(projectOnboarding)
  };

  const scrollToQuestion = (id: string) => {
    const question = document.getElementById(`${id}`);

    if (question) {
      question.scrollIntoView({ behavior: 'smooth' });
    }
  };

  // const handleSubmit = (e: MouseEvent<HTMLButtonElement>) => {
  //   e.preventDefault();

  //   const unansweredQuestions = Object.keys(projectOnboarding).filter(
  //     (question) => projectOnboarding[question] === null || projectOnboarding[question] === ''
  //   );

  //   if (unansweredQuestions.length > 0) {
  //     return scrollToQuestion(unansweredQuestions[0]);
  //   }

  //   if (onboardingID) {
  //     dispatch(updateProjectOnboarding(projectOnboarding)).then((response) => {
  //       if (response.payload && !isNaN(response.payload.results)) {
  //         setTimeout(() => {
  //           if (projectOnboarding?.plan === '') {
  //             window.location.href = `/project/problem/${projectID}`;
  //           } else if (projectOnboarding?.plan !== '') {
  //             window.location.href = '/dashboard';
  //           }
  //         }, 5000);
  //       }
  //     });
  //   } else {
  //     dispatch(createProjectOnboarding(projectOnboarding)).then((response) => {
  //       if (response.payload && !isNaN(response.payload.id)) {
  //         setTimeout(() => {
  //           if (projectOnboarding?.plan === '') {
  //             window.location.href = `/project/problem/${projectID}`;
  //           } else if (projectOnboarding?.plan !== '') {
  //             window.location.href = '/dashboard';
  //           }
  //         }, 5000);
  //       }
  //     });
  //   }
  // };

  return (
    <>
    <section className={styles.section}>
      <main className={styles.main}>
        <h2 className={styles.title}>CLIENT ONBOARDING</h2>

        <StatusBar show={show} message={message} messageType={messageType} />

        <div className={styles.card}>
          <form className={styles.form} action="">
            <table>
              <tbody>
                <tr id="project_title">
                  <label htmlFor="project_title">Project title</label>
                  <div className={styles['options-column']}>
                    <span className={styles.option}>
                      <input
                        type="text"
                        id="project_title"
                        name="project_title"
                        value={projectOnboarding.projectTitle ?? ''}
                        className={styles['input-radio']}
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
                    <div className={styles['options-column']}>
                      <span className={styles.option}>
                        <input
                          type="date"
                          id="deadline_date"
                          name="deadline"
                          value={projectOnboarding.deadline ?? ''}
                          className={styles['input-date']}
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
                          className={styles['input-radio']}
                          onChange={handleInputChange}
                          checked={projectOnboarding.location === 'online'}
                        />
                        <label htmlFor="where_business_online">Online</label>
                      </span>
                      <span className="option">
                        <input
                          type="radio"
                          id="where_business_brick"
                          name="where_business"
                          value="brick and mortar"
                          className={styles['input-radio']}
                          onChange={handleInputChange}
                          checked={
                            projectOnboarding.location === 'brick and mortar'
                          }
                        />
                        <label htmlFor="where_business_brick">Brick & Mortar</label>
                      </span>
                      <span className="option">
                        <input
                          type="radio"
                          id="where_business_both"
                          name="where_business"
                          value="both"
                          className={styles['input-radio']}
                          onChange={handleInputChange}
                          checked={projectOnboarding.location === 'both'}
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
                          className={styles['input-url']}
                          value={projectOnboarding.website ?? ''}
                          onChange={handleInputChange}
                        />
                      </span>
                    </div>
                  </td>
                </tr>

                {projectOnboarding.website !== '' && projectOnboarding.website !== null && (
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
                              className={styles['input-radio']}
                              onChange={handleInputChange}
                              checked={projectOnboarding.hosting === 'aws'}
                            />
                            <label htmlFor="hosting_aws">AWS</label>
                          </span>
                          <span className="option">
                            <input
                              type="radio"
                              id="hosting_azure"
                              name="hosting"
                              value="azure"
                              className={styles['input-radio']}
                              onChange={handleInputChange}
                              checked={projectOnboarding.hosting === 'azure'}
                            />
                            <label htmlFor="hosting_azure">Azure</label>
                          </span>
                          <span className="option">
                            <input
                              type="radio"
                              id="hosting_google"
                              name="hosting"
                              value="google"
                              className={styles['input-radio']}
                              onChange={handleInputChange}
                              checked={projectOnboarding.hosting === 'google'}
                            />
                            <label htmlFor="hosting_google">Google</label>
                          </span>
                          <span className="option">
                            <input
                              type="radio"
                              id="hosting_godaddy"
                              name="hosting"
                              value="godaddy"
                              className={styles['input-radio']}
                              onChange={handleInputChange}
                              checked={projectOnboarding.hosting === 'godaddy'}
                            />
                            <label htmlFor="hosting_godaddy">GoDaddy</label>
                          </span>
                          <span className="option">
                            <input
                              type="radio"
                              id="hosting_other"
                              name="hosting"
                              value="other"
                              className={styles['input-radio']}
                              onChange={handleInputChange}
                              checked={projectOnboarding.hosting === 'other'}
                            />
                            <label htmlFor="hosting_other">Other</label>
                            {projectOnboarding.hosting === 'other' && (
                              <input
                                type="text"
                                id="hosting_other"
                                name="hosting_other"
                                className={styles.other}
                                value={projectOnboarding.hosting}
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
                              className={styles['input-radio']}
                              onChange={handleInputChange}
                              checked={projectOnboarding.satisfied === 'yes'}
                            />
                            <label htmlFor="satisfied_yes">Yes</label>
                          </span>
                          <span className="option">
                            <input
                              type="radio"
                              id="satisfied_no"
                              name="satisfied"
                              value="no"
                              className="input-radio"
                              onChange={handleInputChange}
                              checked={projectOnboarding.satisfied === 'no'}
                            />
                            <label htmlFor="satisfied_no">No</label>
                          </span>
                        </div>
                      </td>
                    </tr>
                  </>
                )}

                {projectOnboarding.location === 'brick and mortar' ||
                  (projectOnboarding.location === 'both' && (
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
                              className={styles['input-url']}
                              value={projectOnboarding.signage ?? ''}
                              onChange={handleInputChange}
                            />
                          </span>
                        </div>
                      </td>
                    </tr>
                  ))}

                <SocialNetworks socialNetworks={projectOnboarding.socialNetworks} />

                <Logos projectOnboarding={projectOnboarding} setVal={setProjectOnboarding} />

                <Colors projectOnboarding={projectOnboarding} setVal={setProjectOnboarding} />

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
                          className={styles['input-url']}
                          value={projectOnboarding.plan ?? ''}
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

        <StatusBar show={show} message={message} messageType={messageType} />

        <button type="submit">
          <h3>{onboardingID ? 'UPDATE' : 'SAVE'}</h3>
        </button>
      </main>
    </section>
    </>
  );
}

export default ProjectOnBoardingPage;
