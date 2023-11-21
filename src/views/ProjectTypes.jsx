import { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { useParams } from 'react-router-dom';

import {
  getPortfolioTypes,
  getPortfolioTags,
  getProjectsType,
} from '../controllers/portfolioSlice';

import Projects from './components/Projects';
import ProjectTypes from './components/ProjectTypes';
import ProjectTags from './components/ProjectTags';

import LoadingComponent from '../views/components/global/LoadingComponent';
import ErrorComponent from '../views/components/global/ErrorComponent';

function ProjectTypesPage() {
  const { type } = useParams();

  const { portfolioLoading, portfolioError, projects, project_types, project_tags } = useSelector(
    (state) => state.portfolio
  );

  const dispatch = useDispatch();

  useEffect(() => {
    dispatch(getProjectsType(type));
  }, [dispatch, type]);

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
      <section className="project-types">
        <h2 className="title">{type} projects</h2>

        <Projects projects={projects} />

        <ProjectTypes project_types={project_types} />

        <ProjectTags project_tags={project_tags} />
      </section>
    </>
  );
}

export default ProjectTypesPage;
