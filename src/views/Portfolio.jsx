import { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';

import {
  getPortfolio,
  getPortfolioTypes,
  getPortfolioTags,
} from '../controllers/portfolioSlice';

import Projects from './components/Projects';
import ProjectTypes from './components/ProjectTypes';
import ProjectTags from './components/ProjectTags';

import LoadingComponent from '../views/components/global/LoadingComponent';
import ErrorComponent from '../views/components/global/ErrorComponent';

function Portfolio() {
  const { portfolioLoading, portfolioError, projects, project_types, project_tags } = useSelector(
    (state) => state.portfolio
  );

  const dispatch = useDispatch();

  useEffect(() => {
    dispatch(getPortfolio());
  }, [dispatch]);

  useEffect(() => {
    dispatch(getPortfolioTypes());
  }, [dispatch]);

  useEffect(() => {
    dispatch(getPortfolioTags());
  }, [dispatch]);

  if (portfolioLoading) {
    return <LoadingComponent />;
  }

  return (
    <>
      <section className="portfolio">
        <h2 class="title">portfolio</h2>

        <Projects projects={projects} />

        <ProjectTypes project_types={project_types} />

        <ProjectTags project_tags={project_tags} />
      </section>
    </>
  );
}

export default Portfolio;
