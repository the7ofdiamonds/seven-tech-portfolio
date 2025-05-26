import React, { useEffect, useState } from 'react';

// import { User } from '@/model/User';
// import { Project } from '@/model/Project';
// import { Portfolio } from '@/model/Portfolio';

import { UpdatePortfolioProject } from '@the7ofdiamonds/github-portfolio';

export const PortfolioEditPage = ({ user }) => {
  const [portfolio, setPortfolio] =
    (useState < Portfolio) | (null > user.portfolio);
  const [projects, setProjects] =
    useState <
    Set <
    Project >>
      (portfolio && portfolio.projects ? portfolio.projects : new Set());

  useEffect(() => {
    if (user.portfolio) {
      setPortfolio(user.portfolio);
    }
  }, [user]);

  useEffect(() => {
    if (portfolio && portfolio.projects) {
      setProjects(portfolio.projects);
    }
  }, [portfolio]);

  return (
    <section>
      {projects.size > 0 &&
        Array.from(projects).map((project, index) => (
          <UpdatePortfolioProject key={index} project={project} />
        ))}
    </section>
  );
};
