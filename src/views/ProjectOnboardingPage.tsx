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
import ColorSelection from './components/onboarding/ColorSelection';

import { LoadingComponent, StatusBar, ContactMethods } from '@the7ofdiamonds/github-portfolio';

import { ProjectOnboarding } from '@the7ofdiamonds/github-portfolio';

import styles from '@/views/components/onboarding/Onboarding.module.scss';
import OptionInput from './components/OptionInput';


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
  const [contacts, setContacts] = useState<ContactMethods>(new ContactMethods);
  const [email, setEmail] = useState<string>(contacts.email.value);
  const [phone, setPhone] = useState<string>(contacts.phone.value);
  const [projectTitle, setProjectTitle] = useState<string>('');
  const [deadline, setDeadline] = useState<string>('');
  const [location, setLocation] = useState<string>('online');
  const [website, setWebsite] = useState<string>('');
  const [hosting, setHosting] = useState<string>('');
  const [satisfied, setSatisfied] = useState<boolean>(false);
  const [signage, setSignage] = useState<string>('');
  const [plan, setPlan] = useState<string>('');

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
    if (projectOnboarding?.id) {
      setOnboardingID(projectOnboarding.id)
    }
  }, [projectOnboarding?.id]);

  useEffect(() => {
    if (projectOnboarding?.contacts) {
      setContacts(projectOnboarding.contacts);
    }
  }, [projectOnboarding?.contacts]);

  useEffect(() => {
    if (projectOnboarding?.projectTitle) {
      setProjectTitle(projectOnboarding.projectTitle)
    }
  }, [projectOnboarding?.projectTitle]);

  useEffect(() => {
    if (projectOnboarding?.deadline) {
      setDeadline(projectOnboarding.deadline)
    }
  }, [projectOnboarding?.deadline]);

  useEffect(() => {
    if (projectOnboarding?.location) {
      setLocation(projectOnboarding.location)
    }
  }, [projectOnboarding?.location]);

  useEffect(() => {
    if (projectOnboarding?.contacts?.website?.url) {
      setWebsite(projectOnboarding.contacts.website.url)
    }
  }, [projectOnboarding?.contacts?.website]);

  useEffect(() => {
    if (projectOnboarding?.hosting) {
      setHosting(projectOnboarding.hosting)
    }
  }, [projectOnboarding?.hosting]);

  useEffect(() => {
    if (projectOnboarding?.satisfied) {
      setSatisfied(projectOnboarding.satisfied)
    }
  }, [projectOnboarding?.satisfied]);

  useEffect(() => {
    if (projectOnboarding?.signage) {
      setSignage(projectOnboarding.signage)
    }
  }, [projectOnboarding?.signage]);

  useEffect(() => {
    if (projectOnboarding?.plan) {
      setPlan(projectOnboarding.plan)
    }
  }, [projectOnboarding?.plan]);

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

    if (name === `${contacts.email.id}`) {
      setEmail(value)
      contacts.setContactEmail(value)
      projectOnboarding.setContacts(contacts)
    }

    if (name === `${contacts.phone.id}`) {
      setPhone(value)
      contacts.setContactPhone(value)
      projectOnboarding.setContacts(contacts)
    }

    if (name === 'project_title') {
      setProjectTitle(value)
      projectOnboarding.setProjectTitle(value)
    }

    if (name === 'deadline_date') {
      setDeadline(value)
      projectOnboarding.setDeadline(value)
    }

    if (name === 'where_business') {
      setLocation(value)
      projectOnboarding.setLocation(value)
    }

    if (name === 'website') {
      setWebsite(value)
      if (projectOnboarding.contacts) {
        if (projectOnboarding.contacts.website) {
          projectOnboarding.contacts.website.setURL(value);
        } else {
          projectOnboarding.contacts.setContactWebsite(website);
        }
      }
    }



    // if (name === 'plan') {
    //   setSatisfied(value)
    //   projectOnboarding.setSatisfied(value)
    // }

    if (name === 'signage') {
      setSignage(value)
      projectOnboarding.setSignage(value)
    }

    if (name === 'plan') {
      setPlan(value)
      projectOnboarding.setPlans(value)
    }
    console.log(projectOnboarding)
    setProjectOnboarding(projectOnboarding)
  };

  type KnownHostingProvider = 'aws' | 'google' | 'azure' | 'godaddy';

  const isKnownHostingProvider = (value: string): value is KnownHostingProvider => {
    return ['aws', 'google', 'azure', 'godaddy'].includes(value);
  };

  const handleHostingChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
    const { value } = e.target;

    setHosting(value)
    projectOnboarding.setHosting(value)
  };

  const handleLocationChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
    const { value } = e.target;

    setLocation(value)
    projectOnboarding.setLocation(value)
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
                  <tr>
                    <OptionInput
                      id={`${contacts.email.id}`}
                      label={contacts.email.title}
                      type={contacts.email.type}
                      value={email}
                      changeFunc={handleInputChange}
                    />
                  </tr>
                  <tr>
                    <OptionInput
                      id={`${contacts.phone.id}`}
                      label={contacts.phone.title}
                      type={contacts.phone.type}
                      value={phone}
                      changeFunc={handleInputChange}
                    />
                  </tr>
                  <tr>
                    <OptionInput
                      id={`project_title`}
                      label={'Project Title'}
                      type={'text'}
                      value={projectTitle}
                      changeFunc={handleInputChange}
                    />
                  </tr>
                  <tr>
                    <OptionInput
                      id={`deadline_date`}
                      label="Does (your company or organization) have a specific
                        deadline that it needs to meet? If Yes, provide it below."
                      type={'date'}
                      value={deadline}
                      changeFunc={handleInputChange}
                    />
                  </tr>
                  <tr>
                    <label htmlFor="where_business">
                      How does (your company or organization) currently do
                      business?
                    </label>
                    <div className="options">
                      <select
                        id='where_business'
                        name='where_business'
                        value={location}
                        onChange={handleLocationChange}>
                        <option value="online">Online</option>
                        <option value="brick and mortar">Brick & Mortar</option>
                        <option value="both">Both</option>
                      </select>
                    </div>
                  </tr>

                  <tr>
                    <OptionInput
                      id={`website`}
                      label="Does (your company or organization) have a website? If
                        Yes, provide a link to it below."
                      type={'url'}
                      value={website}
                      changeFunc={handleInputChange}
                    />
                  </tr>

                  {website && website !== '' && (
                    <>
                      <tr>
                        <label htmlFor="hosting">
                          What hosting service does (your company or
                          organization) currently use?
                        </label>
                        <div className="options">
                          <select
                            id='hosting'
                            name='hosting'
                            value={isKnownHostingProvider(hosting) ? hosting : ''}
                            onChange={handleHostingChange}
                          >
                            <option value="aws">AWS</option>
                            <option value="google">Google Cloud</option>
                            <option value="azure">Azure</option>
                            <option value="godaddy">GoDaddy</option>
                            <option value=''>Custom</option>
                          </select>

                          {!isKnownHostingProvider(hosting) && (
                            <input
                              type="text"
                              id="hosting"
                              name="hosting"
                              className={styles.input}
                              value={hosting}
                              onChange={(e) => setHosting(e.target.value)}
                              placeholder="Enter hosting provider"
                            />
                          )}
                        </div>
                      </tr>

                      <tr>
                        <label htmlFor="satisfied">
                          Is (your company or organization) satisfied with the
                          hosting service?
                        </label>
                        <div className="options">
                          <select
                            id='satisfied'
                            name='satisfied'
                            value={String(satisfied)}
                            onChange={(e) => setSatisfied(e.target.value === 'true')}
                          >
                            <option value="true">Yes</option>
                            <option value="false">No</option>
                          </select>
                        </div>
                      </tr>
                    </>
                  )}

                  {location === 'brick and mortar' ||
                    (location === 'both' && (
                      <tr>
                        <OptionInput
                          id={`signage`}
                          label="Does your brick & mortar location(s) of (your company
                            or organization) have signage? If Yes, provide a link
                            to a picture of them below."
                          type={'url'}
                          value={signage}
                          changeFunc={handleInputChange}
                        />
                      </tr>
                    ))}

                  <SocialNetworks projectOnboarding={projectOnboarding} setVal={setProjectOnboarding} />

                  <Logos projectOnboarding={projectOnboarding} setVal={setProjectOnboarding} />

                  <ColorSelection projectOnboarding={projectOnboarding} setVal={setProjectOnboarding} />

                  <tr>
                    <OptionInput
                      id={`plan`}
                      label="Does (your company or organization) have a one-page or
                        full business plan that can be provided to define the
                        problem? If Yes, provide a link to it below."
                      type={'url'}
                      value={plan}
                      changeFunc={handleInputChange}
                    />
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
      </section >
    </>
  );
}

export default ProjectOnBoardingPage;
