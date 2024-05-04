import React from 'react';

import Projects from './Projects';
import TaxList from './TaxList';

function PortfolioComponent(props) {
  const { projects, project_types, skills, frameworks, technologies } = props;

  return (
    <>
      {projects && (
        <main className="portfolio">
          <h1 class="title">portfolio</h1>

          <Projects projects={projects} />

          <TaxList tax={project_types} title={'Project Types'} />

          <TaxList tax={skills} title={'Skills'} />

          <TaxList tax={frameworks} title={'Frameworks'} />

          <TaxList tax={technologies} title={'Technologies'} />
        </main>
      )}
    </>
  );
}

export default PortfolioComponent;
