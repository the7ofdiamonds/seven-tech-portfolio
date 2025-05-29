import { useEffect } from 'react';
import { useParams } from 'react-router-dom';

import { useAppDispatch, useAppSelector } from '@/model/hooks';

import { getPortfolioProjectsByUser } from '@/controllers/portfolioSlice';
import {
  getProjectTypesByUser,
  getSkillsByUser,
  getFrameworksByUser,
  getTechnologiesByUser,
} from '@/controllers/userSlice';

import { LoadingComponent, PortfolioComponent } from '@the7ofdiamonds/github-portfolio';

function User() {
  const dispatch = useAppDispatch();

  const { user } = useParams();

  const { portfolioLoading, portfolioErrorMessage, portfolioObject } = useAppSelector(
    (state) => state.portfolio
  );
  const { projectTypesObject, skillsObject, frameworksObject, technologiesObject } = useAppSelector(
    (state) => state.taxonomies
  );

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
        portfolio={portfolio}
        projectTypes={projectTypes}
        skills={skills}
        frameworks={frameworks}
        technologies={technologies}
      />
    </>
  );
}

export default User;
