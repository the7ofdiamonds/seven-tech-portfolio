import React from 'react';

import Projects from './Projects';
import TaxList from './TaxList';

function PortfolioComponent(props) {
  const { portfolio, projectTypes, skills, frameworks, technologies } = props;

  return (
    <>
      {portfolio && (
        <main className="portfolio">
          <h1 class="title">portfolio</h1>

          <Projects projects={portfolio} />

          <TaxList tax={projectTypes} title={'Project Types'} />

          <TaxList tax={skills} title={'Skills'} />

          <TaxList tax={frameworks} title={'Frameworks'} />

          <TaxList tax={technologies} title={'Technologies'} />
        </main>
      )}
    </>
  );
}

export default PortfolioComponent;
