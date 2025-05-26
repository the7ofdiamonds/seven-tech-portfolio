import React from 'react';

import { AddFrameworks, AddLanguages, AddProjectTypes, AddTechnologies } from '@the7ofdiamonds/github-portfolio';

const AddSkill = () => {
  return (
    <section className="add">
      <>
        <AddLanguages />

        <AddFrameworks />

        <AddProjectTypes />

        <AddTechnologies />
      </>
    </section>
  );
}

export default AddSkill;