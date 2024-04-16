import { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';

import { getPortfolio } from '../controllers/portfolioSlice';
import { getProjectTypes, getProjectTags } from '../controllers/taxonomiesSlice';

import Projects from './components/Projects';
import ProjectTypes from './components/ProjectTypes';
import ProjectTags from './components/ProjectTags';

import LoadingComponent from '../views/components/global/LoadingComponent';

function Portfolio() {
  const { portfolioLoading, portfolioError, projects } = useSelector(
    (state) => state.portfolio
  );
  const { tags, types } = useSelector((state) => state.taxonomies);

  const dispatch = useDispatch();

  useEffect(() => {
    dispatch(getPortfolio());
  }, [dispatch]);

  useEffect(() => {
    dispatch(getProjectTypes());
  }, [dispatch]);

  useEffect(() => {
    dispatch(getProjectTags());
  }, [dispatch]);

  if (portfolioLoading) {
    return <LoadingComponent />;
  }

  return (
    <>
      <main className="portfolio">
        <h1 class="title">portfolio</h1>

        <Projects projects={projects} />

        <ProjectTypes project_types={types} />

        <ProjectTags project_tags={tags} />
      </main>
    </>
  );
}

export default Portfolio;
