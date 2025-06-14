import React, { lazy, Suspense, useEffect, useState } from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';

import { useAppDispatch, useAppSelector } from '@/model/hooks';

import { getAuthenticatedUserAccount } from '@the7ofdiamonds/github-portfolio';

import { Account, User, Skills } from '@the7ofdiamonds/github-portfolio';

import { LoadingComponent } from '@the7ofdiamonds/github-portfolio';

const Dashboard = lazy(() => import('@/views/Dashboard'));
const OrganizationPage = lazy(() => import('@/views/OrganizationPage'));
const Portfolio = lazy(() => import('@/views/Portfolio'));
const ProjectAdd = lazy(() => import('@/views/ProjectAdd'));
const ProjectOnboarding = lazy(() => import('@/views/ProjectOnboarding'));
const ProjectPage = lazy(() => import('@/views/ProjectPage'));
const ProjectProblem = lazy(() => import('@/views/ProjectProblem'));
const ProjectsEdit = lazy(() => import('@/views/ProjectsEdit'));
const ProjectUpdate = lazy(() => import('@/views/ProjectUpdate'));
const Search = lazy(() => import('@/views/Search'));
const SkillAdd = lazy(() => import('@/views/SkillAdd'));
import skillsJson from '../skills.json';

const App: React.FC = () => {
  const dispatch = useAppDispatch();

  const { authenticatedUserObject } = useAppSelector((state) => state.user);
  const { skillsObject } = useAppSelector((state) => state.taxonomies);

  const [account, setAccount] = useState<Account | null>(null);
  const [user, setUser] = useState<User>(new User);
  const [avatarURL, setAvatarURL] = useState<string | null>(null);
  const [skills, setSkills] = useState<Skills | null>(null);

  useEffect(() => {
    if (authenticatedUserObject) {
      setAccount(new Account(authenticatedUserObject))
    }
  }, [authenticatedUserObject]);

  useEffect(() => {
    if (account) {
      setAvatarURL(account.avatarURL)
    }
  }, [account]);

  useEffect(() => {
    if (!authenticatedUserObject) {
      dispatch(getAuthenticatedUserAccount());
    }
  }, [authenticatedUserObject]);

  useEffect(() => {
    if (authenticatedUserObject) {
      setAccount(new Account(authenticatedUserObject));
    }
  }, [authenticatedUserObject]);

  // useEffect(() => {
  //   if (skillsObject) {
  //     setSkills(new Skills(skillsObject));
  //   }
  // }, [skillsObject]);

  useEffect(() => {
    if (avatarURL) {
      let favicon = document.getElementById("favicon");

      if (!favicon) {
        favicon = document.createElement("link");
        favicon.setAttribute("rel", "icon");
        favicon.setAttribute("type", "image/png");
        favicon.setAttribute("id", "favicon");
        document.head.appendChild(favicon);
      }

      if (avatarURL) {
        favicon.setAttribute("href", avatarURL);
      }
    }
  }, [avatarURL]);

  useEffect(() => {
    if (account && skillsJson) {
      setSkills(new Skills(skillsJson));
    }
  }, [account]);

  return (
    <>
      <Router basename="/">
        <Suspense fallback={<LoadingComponent />}>
          <Routes>
            <Route index path="/"
              element={<Portfolio account={account} />} />

            <Route path="dashboard"
              element={<Dashboard />} />
            <Route path="dashboard/add/project"
              element={<ProjectAdd user={user} />} />
            <Route path="dashboard/add/skill"
              element={<SkillAdd />} />
            <Route path="dashboard/edit/projects"
              element={<ProjectsEdit account={account} />} />
            <Route path="dashboard/edit/onboarding/project/:project"
              element={<ProjectOnboarding />} />
            <Route path="dashboard/edit/problem/project/:project"
              element={<ProjectProblem />} />
            <Route path="dashboard/update/project/:project"
              element={<ProjectUpdate account={account} />}
            />

            <Route path="/organization/:login" element={<OrganizationPage />} />

            <Route path="portfolio" element={<Portfolio account={account} />} />
            <Route path="portfolio/:owner/:projectID" element={<ProjectPage account={account} />} />

            <Route path="/projects/:taxonomy/:term" element={<Search account={account} skills={skills} />} />
          </Routes>
        </Suspense>
      </Router>
    </>
  );
};

export default App;
