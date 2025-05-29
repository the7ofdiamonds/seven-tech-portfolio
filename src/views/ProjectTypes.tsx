import React, { useEffect } from 'react';

import {
  useAppDispatch, useAppSelector
} from '@the7ofdiamonds/github-portfolio';
import { getProjectTypes } from '@the7ofdiamonds/github-portfolio';
import { LoadingComponent } from '@the7ofdiamonds/github-portfolio';

import { getPortfolioProjectsByTaxonomy } from '@/controllers/portfolioSlice';

import Projects from './components/Projects';
import TaxList from './components/TaxList';

import TaxTableComponent from '@/views/components/TaxTableComponent';

const ProjectTypes: React.FC = () => {
  const dispatch = useAppDispatch();

  const {
    taxonomiesLoading,
    taxonomiesErrorMessage,
    icon,
    title,
    projectTypes,
  } = useAppSelector((state) => state.taxonomies);
  const { portfolioLoading, portfolioErrorMessage, portfolio } = useAppSelector(
    (state) => state.portfolio
  );

  useEffect(() => {
    dispatch(getProjectTypes());
  }, []);

  useEffect(() => {
    dispatch(getPortfolioProjectsByTaxonomy('ProjectTypes'));
  }, []);

  if (taxonomiesLoading) {
    return <LoadingComponent />;
  }

  return (
    <>
      <main className="project-types">
        <h1 className="title">project types</h1>

        <TaxTableComponent terms={projectTypes} />
      </main>

      {portfolio && (
        <main className="portfolio">
          <h1 className="title">portfolio</h1>

          <Projects projects={portfolio} />
        </main>
      )}
    </>
  );
}

export default ProjectTypes;
