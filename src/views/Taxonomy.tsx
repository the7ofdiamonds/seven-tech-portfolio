import React, { useEffect, useState } from 'react';

import { useAppDispatch, useAppSelector } from '@the7ofdiamonds/github-portfolio';

import { LoadingComponent, PortfolioComponent } from '@the7ofdiamonds/github-portfolio';

import { getPortfolioProjectsByTaxonomy } from '@/controllers/portfolioSlice';

import { Portfolio, Skills, Account } from '@the7ofdiamonds/github-portfolio';

interface TaxonomyProps {
  account: Account;
}

const Taxonomy: React.FC<TaxonomyProps> = ({ account }) => {
  const url = new URL(window.location.href);
  const pageSlug = url.pathname;
  const pathnames = pageSlug.split('/');
  const taxonomy = Array.isArray(pathnames) && pathnames.length > 0
    ? (pathnames[1]).charAt(0).toUpperCase() + (pathnames[1]).slice(1)
    : null;

  const [portfolio, setPortfolio] = useState<Portfolio | null>(null);
  const [skills, setSkills] = useState<Skills | null>(null);

  const dispatch = useAppDispatch();

  const { portfolioLoading, portfolioErrorMessage, portfolioObject } = useAppSelector(
    (state) => state.portfolio
  );

  useEffect(() => {
    if (taxonomy) {
      dispatch(getPortfolioProjectsByTaxonomy(taxonomy));
    }
  }, [taxonomy]);

  useEffect(() => {
    if (account.portfolio && account.portfolio.projects.size > 0) {
      setPortfolio(account.portfolio);
    }
  }, [account]);

  useEffect(() => {
    if (account.skills && account.skills) {
      setSkills(account.skills);
    }
  }, [account]);

  if (portfolioLoading) {
    return <LoadingComponent />;
  }

  return (
    <>
      <PortfolioComponent portfolio={portfolio} skills={skills} />
    </>
  );
}

export default Taxonomy;
