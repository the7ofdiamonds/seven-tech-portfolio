import React, { lazy, Suspense, useEffect, useState } from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';

import { useAppDispatch, useAppSelector } from '@/model/hooks';

import { getAuthenticatedUserAccount } from '@the7ofdiamonds/github-portfolio';

import { Account, Skills } from '@the7ofdiamonds/github-portfolio';

const LoadingComponent = lazy(() =>
  import('@the7ofdiamonds/github-portfolio')
    .then(mod => ({ default: mod.LoadingComponent }))
);

const Dashboard = lazy(() => import('@/views/Dashboard'));
const AddSkill = lazy(() => import('@/views/SkillAdd'));
const ProjectsEdit = lazy(() => import('@/views/ProjectsEdit'));
const ProjectUpdate = lazy(() => import('@/views/ProjectUpdate'));

const Portfolio = lazy(() => import('@/views/Portfolio'));
const Project = lazy(() => import('@/views/ProjectPage'));

const ProjectOnboarding = lazy(() => import('@/views/ProjectOnboarding'));
const ProjectProblem = lazy(() => import('@/views/ProjectProblem'));

const User = lazy(() => import('@/views/User'));

const ProjectType = lazy(() => import('@/views/ProjectType'));
const ProjectTypes = lazy(() => import('@/views/ProjectTypes'));
const Term = lazy(() => import('@/views/Term'));
const Taxonomy = lazy(() => import('@/views/Taxonomy'));

const App: React.FC = () => {
  const dispatch = useAppDispatch();

  const { authenticatedUserObject } = useAppSelector((state) => state.user);
  const { skillsObject } = useAppSelector((state) => state.taxonomies);

  const [account, setAccount] = useState<Account>(new Account);
  const [avatarURL, setAvatarURL] = useState<string | null>(null);
  const [skills, setSkills] = useState<Skills>(new Skills());

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

  useEffect(() => {
    if (skillsObject) {
      setSkills(new Skills(skillsObject));
    }
  }, [skillsObject]);

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

  return (
    <>
      <Router basename="/">
        <Suspense fallback={<LoadingComponent />}>
          <Routes>
            <Route
              path="project/onboarding/:project/"
              element={<ProjectOnboarding />}
            />
            <Route path="project/onboarding/" element={<ProjectOnboarding />} />
            <Route
              path="project/problem/:project/"
              element={<ProjectProblem />}
            />
            <Route index path="/" element={<Portfolio account={account} />} />

            <Route path="dashboard" element={<Dashboard />} />
            <Route path="dashboard/add/skill" element={<AddSkill />} />
            <Route path="dashboard/projects/edit" element={<ProjectsEdit account={account} />} />
            <Route
              path="dashboard/update/project/:project"
              element={<ProjectUpdate account={account} />}
            />

            <Route path="portfolio" element={<Portfolio account={account} />} />
            <Route path="portfolio/:project" element={<Project account={account} />} />

            <Route path="founders/:user/" element={<User />} />
            <Route path="managing-members/:user/" element={<User />} />
            <Route path="investors/:user/" element={<User />} />
            <Route path="executives/:user/" element={<User />} />
            <Route path="freelancers/:user/" element={<User />} />
            <Route path="employees/:user/" element={<User />} />

            <Route
              path="project-types/:projectType"
              element={<ProjectType />}
            />
            <Route path="project-types" element={<ProjectTypes />} />
            <Route path="/frameworks/:term" element={<Term />} />
            <Route path="/frameworks" element={<Taxonomy account={account} />} />
            <Route path="/skills/:term" element={<Term />} />
            <Route path="/skills" element={<Taxonomy account={account} />} />
            <Route path="/technologies/:term" element={<Term />} />
            <Route path="/technologies" element={<Taxonomy account={account} />} />
          </Routes>
        </Suspense>
      </Router>
    </>
  );
};

export default App;
