import React, { useEffect, useState } from 'react';

import { Account, Portfolio, Project } from '@the7ofdiamonds/github-portfolio';

import { UpdatePortfolioProject } from '@the7ofdiamonds/github-portfolio';

import styles from '@/views/components/Edit.module.scss';

interface ProjectsEditProps {
  account: Account | null;
}

const ProjectsEdit: React.FC<ProjectsEditProps> = ({ account }) => {
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
          <UpdatePortfolioProject key={index} project={project} />
        ))
      )}
    </section>
  )
}

export default ProjectsEdit;