import { useState, useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { useNavigate, useParams } from 'react-router-dom';

import { getClient } from '../controllers/clientSlice';
import {
  getPortfolioTypes,
  getPortfolioTags,
  getProjectsType,
} from '../controllers/portfolioSlice';

import Projects from './components/Projects';
import ProjectTypes from './components/ProjectTypes';
import ProjectTags from './components/ProjectTags';

function ProjectTypesPage() {
  const { type } = useParams();

  const { loading, error, projects, project_types, project_tags } = useSelector(
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
