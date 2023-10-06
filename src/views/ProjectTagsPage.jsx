import { useState, useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { useNavigate, useLocation } from 'react-router-dom';

import { getClient } from '../controllers/clientSlice';
import {
  getPortfolioTypes,
  getPortfolioTags,
  getProjectsTag,
} from '../controllers/portfolioSlice';

import Projects from '../components/Projects';
import ProjectTypes from '../components/ProjectTypes';
import ProjectTags from '../components/ProjectTags';

function ProjectTagsPage() {
  const location = useLocation();
  const projectTag = location.pathname.split('/')[3];

  const { loading, error, projects, project_types, project_tags } = useSelector(
    (state) => state.portfolio
  );

  const dispatch = useDispatch();

  useEffect(() => {
    dispatch(getProjectsTag(projectTag));
  }, [dispatch, projectTag]);

  useEffect(() => {
    dispatch(getPortfolioTypes());
  }, [dispatch]);

  useEffect(() => {
    dispatch(getPortfolioTags());
  }, [dispatch]);

  return (
    <>
      <Projects projects={projects} />

      <ProjectTypes project_types={project_types} />

      <ProjectTags project_tags={project_tags} />
    </>
  );
}

export default ProjectTagsPage;
