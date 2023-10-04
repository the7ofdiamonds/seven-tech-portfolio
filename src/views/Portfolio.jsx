import { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { useSelector, useDispatch } from 'react-redux';

import { getClient } from '../controllers/clientSlice';
import {
  getPortfolio,
  getPortfolioTypes,
  getPortfolioTags,
} from '../controllers/portfolioSlice';

import Gallery from '../components/Gallery';
import ProjectStatus from '../components/ProjectStatus';
import ProjectTypes from '../components/ProjectTypes';
import ProjectTags from '../components/ProjectTags';

function Portfolio() {
  const { loading, error, projects, project_types, project_tags } = useSelector(
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

  return (
    <>
      <h2 class="title">portfolio</h2>

      {projects && projects.length > 0
        ? projects.map((project, index) => (
            <div key={index} className="project card">
              <h3>{project.title}</h3>
              <Gallery gallery={project.solution_gallery} />
              <ProjectStatus project_status={project.project_status} />
            </div>
          ))
        : 'There are no projects to display'}

      <ProjectTypes project_types={project_types} />

      <ProjectTags project_tags={project_tags} />
    </>
  );
}

export default Portfolio;
