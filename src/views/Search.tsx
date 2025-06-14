import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';

import { useAppDispatch, useAppSelector } from '@/model/hooks';
import { Portfolio, Skills, Project, Account } from '@the7ofdiamonds/github-portfolio';

import { getPortfolioDetails } from '@the7ofdiamonds/github-portfolio';

import { ProjectsComponent, SkillsComponent } from '@the7ofdiamonds/github-portfolio';

import { HeaderTaxonomyComponent } from '@the7ofdiamonds/github-portfolio';

import styles from '@/views/components/Search.module.scss';

interface SearchProps {
  account: Account | null;
  skills: Skills | null;
}

const Search: React.FC<SearchProps> = ({ account, skills }) => {
  const dispatch = useAppDispatch();

  const { taxonomy, term } = useParams<string>();

  const { portfolioLoading, portfolioErrorMessage, portfolioObject } = useAppSelector(
    (state) => state.portfolio
  );

  const [portfolio, setPortfolio] = useState<Portfolio | null>(null);
  const [projects, setProjects] = useState<Set<Project>>(new Set);

  useEffect(() => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }, [taxonomy, term]);

  useEffect(() => {
    if (term) {
      const skill = term.toUpperCase();

      document.title = skill;
    }
  }, [term]);

  useEffect(() => {
    if (account && account.repos) {
      dispatch(getPortfolioDetails(account.repos))
    }
  }, [account?.repos]);

  useEffect(() => {
    if (account && account.portfolio) {
      setPortfolio(account.portfolio)
    }
  }, [account?.portfolio]);

  useEffect(() => {
    if (portfolioObject) {
      setPortfolio(new Portfolio(portfolioObject))
    }
  }, [portfolioObject]);

  useEffect(() => {
    if (portfolio && taxonomy && term) {
      setProjects(portfolio.filterProjects(taxonomy, term));
    }
  }, [portfolio, taxonomy, term]);

  return (
    <section className={styles.section} id="top">
      <>
        {skills && taxonomy && term &&
          <HeaderTaxonomyComponent skill={skills.filter(taxonomy, term)} />}

        {portfolio &&
          projects &&
          (taxonomy && term) &&
          <ProjectsComponent projects={projects} />
        }

        <SkillsComponent skills={skills} />
      </>
    </section>
  );
}

export default Search;