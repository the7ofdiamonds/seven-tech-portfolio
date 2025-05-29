import React from 'react';

import {
  AddFrameworks,
  AddLanguages,
  AddProjectTypes,
  AddTechnologies,
} from '@the7ofdiamonds/github-portfolio';

const AddSkill: React.FC = () => {
  return (
    <section className="add">
      <>
        <AddProjectTypes />

        <AddLanguages />

        <AddFrameworks />

        <AddTechnologies />
      </>
    </section>
  );
};

export default AddSkill;
