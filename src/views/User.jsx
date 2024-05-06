import { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { useParams } from 'react-router-dom';

import { getPortfolioProjectsByUser } from '../controllers/portfolioSlice';
import {
  getProjectTypesByUser,
  getSkillsByUser,
  getFrameworksByUser,
  getTechnologiesByUser,
} from '../controllers/userSlice';

import LoadingComponent from './components/global/LoadingComponent';

import PortfolioComponent from './components/PortfolioComponent';

function User() {
  const { user } = useParams();

  const { portfolioLoading, portfolioErrorMessage, portfolio } = useSelector(
    (state) => state.portfolio
  );
  const { projectTypes, skills, frameworks, technologies } = useSelector(
    (state) => state.taxonomies
  );

  const dispatch = useDispatch();

  useEffect(() => {
    dispatch(getPortfolioProjectsByUser(user));
  }, [dispatch]);

  useEffect(() => {
    dispatch(getProjectTypesByUser(user));
  }, [dispatch]);

  useEffect(() => {
    dispatch(getSkillsByUser(user));
  }, [dispatch]);

  useEffect(() => {
    dispatch(getFrameworksByUser(user));
  }, [dispatch]);

  useEffect(() => {
    dispatch(getTechnologiesByUser(user));
  }, [dispatch]);

  if (portfolioLoading) {
    return <LoadingComponent />;
  }

  return (
    <>
      <PortfolioComponent
        projects={portfolio}
        projectTypes={projectTypes}
        skills={skills}
        frameworks={frameworks}
        technologies={technologies}
      />
    </>
  );
}

export default User;
