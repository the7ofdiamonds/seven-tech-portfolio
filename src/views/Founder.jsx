import { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { useParams } from 'react-router-dom';

import { getPortfolioProjectsByUser } from '../controllers/portfolioSlice';
import {
  getProjectTypes,
  getSkills,
  getFrameworks,
  getTechnologies
} from '../controllers/taxonomiesSlice';

import Projects from './components/Projects';
import TaxList from './components/TaxList';

import LoadingComponent from '../views/components/global/LoadingComponent';

function Portfolio() {
  const { founder } = useParams();

  const { portfolioLoading, portfolioErrorMessage, projects } = useSelector(
    (state) => state.portfolio
  );
  const { projectTypes, skills, frameworks, technologies } = useSelector((state) => state.taxonomies);

  const dispatch = useDispatch();

  useEffect(() => {
    dispatch(getPortfolioProjectsByUser(founder));
  }, [dispatch]);

  useEffect(() => {
    dispatch(getProjectTypes());
  }, [dispatch]);

  useEffect(() => {
    dispatch(getSkills());
  }, [dispatch]);

  useEffect(() => {
    dispatch(getFrameworks());
  }, [dispatch]);

  useEffect(() => {
    dispatch(getTechnologies());
  }, [dispatch]);

  if (portfolioLoading) {
    return <LoadingComponent />;
  }

  return (
    <>
      {projects && (
        <main className="founder-projects">
          <h1 class="title">portfolio</h1>

          <Projects projects={projects} />

          <TaxList tax={projectTypes} title={'project types'} />

          <TaxList tax={skills} title={'Skills'} />

          <TaxList tax={frameworks} title={'frameworks'} />

          <TaxList tax={technologies} title={'technologies'} />
        </main>
      )}
    </>
  );
}

export default Portfolio;
