import { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { useSelector, useDispatch } from 'react-redux';

import { getClient } from '../controllers/clientSlice';
import {
  getPortfolio,
  getPortfolioTypes,
  getPortfolioTags,
} from '../controllers/portfolioSlice';

import Projects from './components/Projects';
import ProjectTypes from './components/ProjectTypes';
import ProjectTags from './components/ProjectTags';

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
