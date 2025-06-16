import React from 'react';

import {
  AddFrameworks,
  AddLanguages,
  AddProjectTypes,
  AddTechnologies,
} from '@the7ofdiamonds/github-portfolio';

import styles from '@/views/components/add/Add.module.scss';

const SkillAddPage: React.FC = () => {
  return (
    <section className={styles.section}>
      <>
        <AddProjectTypes />

        <AddLanguages />

        <AddFrameworks />

        <AddTechnologies />
      </>
    </section>
  );
};

export default SkillAddPage;
