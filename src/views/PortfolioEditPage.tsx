import React, { useEffect, useState } from 'react';

import { Account, Portfolio, Project } from '@the7ofdiamonds/github-portfolio';

import { EditPortfolioProject } from '@the7ofdiamonds/github-portfolio';

import styles from '@/views/components/Edit.module.scss';

interface PortfolioEditPageProps {
  account: Account | null;
}

const PortfolioEditPage: React.FC<PortfolioEditPageProps> = ({ account }) => {
  const [portfolio, setPortfolio] = useState<Portfolio | null>(null);
  const [projects, setProjects] = useState<Set<Project>>(portfolio && portfolio.projects ? portfolio.projects : new Set);

  useEffect(() => {
    if (account && account.portfolio) {
      setPortfolio(account.portfolio);
    }
  }, [account]);

  useEffect(() => {
    if (portfolio && portfolio.projects) {
      setProjects(portfolio.projects);
    }
  }, [portfolio]);

  return (
    <section className={styles.section}>
      {projects.size > 0 && (
        Array.from(projects).map((project, index) => (
          <EditPortfolioProject key={index} project={project} />
        ))
      )}
    </section>
  )
}

export default PortfolioEditPage;