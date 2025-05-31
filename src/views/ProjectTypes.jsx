import { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';

import { getProjectTypes } from '../controllers/taxonomiesSlice';
import { getPortfolioProjectsByTaxonomy } from '../controllers/portfolioSlice';

import Projects from './components/Projects';
import TaxList from './components/TaxList';

import LoadingComponent from '../views/components/global/LoadingComponent';
import TaxTableComponent from './components/TaxTableComponent';

function ProjectTypes() {
  const {
    taxonomiesLoading,
    taxonomiesErrorMessage,
    icon,
    title,
    projectTypes,
  } = useSelector((state) => state.taxonomies);
  const { portfolioLoading, portfolioErrorMessage, portfolio } = useSelector(
    (state) => state.portfolio
  );

  const dispatch = useDispatch();

  useEffect(() => {
    dispatch(getProjectTypes());
  }, [dispatch]);

  useEffect(() => {
    dispatch(getPortfolioProjectsByTaxonomy('ProjectTypes'));
  }, [dispatch]);

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
          <h1 class="title">portfolio</h1>

          <Projects projects={portfolio} />
        </main>
      )}
    </>
  );
}

export default ProjectTypes;
