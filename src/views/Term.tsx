import React, { useEffect } from 'react';
import { useParams } from 'react-router-dom';

import { useAppDispatch, useAppSelector } from '@/model/hooks';

import { getPortfolioProjectsWithTerm } from '@/controllers/portfolioSlice';

import {LoadingComponent} from '@the7ofdiamonds/github-portfolio';

import Projects from './components/Projects';

function Term() {
  const url = new URL(window.location.href);
  const pageSlug = url.pathname;
  const pathnames = pageSlug.split('/');
  const taxonomy = (pathnames[1]).charAt(0).toUpperCase() + (pathnames[1]).slice(1);

  const { term } = useParams();

  const dispatch = useAppDispatch();

  useEffect(() => {
    dispatch(
      getPortfolioProjectsWithTerm({ taxonomy: taxonomy, term: term })
    );
  }, [dispatch]);

  const { portfolioLoading, portfolioErrorMessage, portfolio } = useAppSelector(
    (state) => state.portfolio
  );

  if (portfolioLoading) {
    return <LoadingComponent />;
  }

  return (
    <>
      {portfolio && (
        <main className="projects">
          <h1 className="title">projects</h1>

          <Projects projects={portfolio} />
        </main>
      )}
    </>
  );
}

export default Term;
