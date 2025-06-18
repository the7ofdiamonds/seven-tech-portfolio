import React from 'react';

import {
  AddFrameworks,
  AddLanguages,
  AddProjectTypes,
  AddTechnologies,
} from '@the7ofdiamonds/github-portfolio';

import styles from '@/views/components/Add.module.scss';

const AddSkill: React.FC = () => {
  return (
    <section className={styles.add}>
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
