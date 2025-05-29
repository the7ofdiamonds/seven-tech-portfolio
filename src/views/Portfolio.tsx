import React, { useEffect, useState } from 'react';

import { PortfolioComponent } from '@the7ofdiamonds/github-portfolio';

import { useAppDispatch, useAppSelector } from '@/model/hooks';
import { Account, Portfolio, Skills } from '@the7ofdiamonds/github-portfolio';

import { setMessage, setMessageType, setShowStatusBar } from '@the7ofdiamonds/github-portfolio';

interface PortfolioProps {
  account: Account;
}

const PortfolioPage: React.FC<PortfolioProps> = ({ account }) => {
  const dispatch = useAppDispatch();

  const [portfolio, setPortfolio] = useState<Portfolio | null>(null);
  const [skills, setSkills] = useState<Skills | null>(null);

  const {
    portfolioLoading,
    portfolioObject,
    portfolioErrorMessage
  } = useAppSelector((state) => state.portfolio);

  useEffect(() => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }, []);

  useEffect(() => {
    if (portfolioLoading) {
      dispatch(setMessage('Now Loading Portfolio'));
      dispatch(setShowStatusBar('show'));
    }
  }, [portfolioLoading]);

  useEffect(() => {
    if (portfolioLoading) {
      dispatch(setMessageType('info'));
      dispatch(setMessage('Now Loading Portfolio'));
    }
  }, [portfolioLoading]);

  useEffect(() => {
    if (portfolioErrorMessage) {
      dispatch(setMessage(portfolioErrorMessage));
      dispatch(setMessageType('error'));
      dispatch(setShowStatusBar(Date.now()));
    }
  }, [portfolioErrorMessage]);

  useEffect(() => {
    document.title = `Portfolio - ${account.name}`;
  }, []);

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

  return (
    <section className="portfolio">
      <>
        <PortfolioComponent portfolio={portfolio} skills={skills} />
      </>
    </section>
  );
}

export default PortfolioPage;
