import React, { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';

import { getPortfolioProjectsByTaxonomy } from '../controllers/portfolioSlice';

import LoadingComponent from './components/LoadingComponent';
import ErrorComponent from './components/ErrorComponent';
import Projects from './components/Projects';

function Taxonomy() {
  const url = new URL(window.location.href);
  const pageSlug = url.pathname;
  const pathnames = pageSlug.split('/');
  const taxonomy = (pathnames[1]).charAt(0).toUpperCase() + (pathnames[1]).slice(1);

  const dispatch = useDispatch();

  useEffect(() => {
    dispatch(getPortfolioProjectsByTaxonomy(taxonomy));
  }, [dispatch]);

  const { portfolioLoading, portfolioErrorMessage, portfolio } = useSelector(
    (state) => state.portfolio
  );

  if (portfolioLoading) {
    return <LoadingComponent />;
  }

  if (portfolioErrorMessage) {
    return <ErrorComponent message={portfolioErrorMessage} />;
  }

  return (
    <>
      {portfolio && (
        <main className="projects">
          <h1 class="title">projects</h1>

          <Projects projects={portfolio} />
        </main>
      )}
    </>
  );
}

export default Taxonomy;
