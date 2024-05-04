import { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { useParams } from 'react-router-dom';

import { getPortfolio } from '../controllers/portfolioSlice';
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
  const { portfolioLoading, portfolioErrorMessage, projects } = useSelector(
    (state) => state.portfolio
  );
  const { project_types, skills, frameworks, technologies } = useSelector((state) => state.taxonomies);

  const dispatch = useDispatch();

  useEffect(() => {
    dispatch(getPortfolio());
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
      <main className="portfolio">
        <h1 class="title">portfolio</h1>

        <Projects projects={projects} />

        <TaxList tax={project_types} title={'project types'} />

        <TaxList tax={skills} title={'skills'} />

        <TaxList tax={frameworks} title={'frameworks'} />

        <TaxList tax={technologies} title={'technologies'} />
      </main>
    </>
  );
}

export default Portfolio;
