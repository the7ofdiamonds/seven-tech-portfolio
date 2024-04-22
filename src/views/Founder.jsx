import { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { useParams } from 'react-router-dom';

import { getPortfolioProjectsByUser } from '../controllers/portfolioSlice';
import { getProjectTypes, getProjectTags } from '../controllers/taxonomiesSlice';

import Projects from './components/Projects';
import ProjectTypes from './components/ProjectTypes';
import ProjectTags from './components/ProjectTags';

import LoadingComponent from '../views/components/global/LoadingComponent';

function Portfolio() {
  const { founder } = useParams();

  const { portfolioLoading, portfolioErrorMessage, projects } = useSelector(
    (state) => state.portfolio
  );
  const { tags, types } = useSelector((state) => state.taxonomies);

  const dispatch = useDispatch();

  useEffect(() => {
    dispatch(getPortfolioProjectsByUser(founder));
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
      <main className="founder-projects">
        <h1 class="title">portfolio</h1>

        <Projects projects={projects} />

        <ProjectTypes project_types={types} />

        <ProjectTags project_tags={tags} />
      </main>
    </>
  );
}

export default Portfolio;
