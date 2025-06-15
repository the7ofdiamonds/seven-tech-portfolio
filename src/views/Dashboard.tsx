import React, { useEffect } from 'react';
import { useNavigate } from 'react-router-dom';

import { useAppDispatch, useAppSelector } from '@/model/hooks';

import { User } from '@the7ofdiamonds/github-portfolio';

import {
  logout,
  setMessage,
  setMessageType,
  setShowStatusBar,
  checkHeaders
} from '@the7ofdiamonds/github-portfolio';

import styles from '@/views/components/Dashboard.module.scss';

const Dashboard: React.FC = () => {
  const navigate = useNavigate();
  const dispatch = useAppDispatch();

  // useEffect(() => {
  //   if (!checkHeaders()) {
  //     navigate('/login');
  //   }
  // }, []);

  const handleSkillAdd = () => {
    navigate('/dashboard/add/skill');
  };

  const handleProjectAdd = () => {
    navigate('/dashboard/add/project');
  };

  const handleEditProject = () => {
    navigate('/dashboard/edit/projects');
  };

  const handleLogout = async () => {
    try {
      dispatch(logout());

      window.location.href = '/';
    } catch (error) {
      const err = error as Error;
      dispatch(setMessage(`Logout error: ${err.message}`));
      dispatch(setMessageType('error'));
      dispatch(setShowStatusBar(true));
    }
  };

  return (
    <section className={styles.section}>
      <main className={styles.main}>
        <h2 className={styles.title}>Dashboard</h2>

        <div className={styles.options}>
          <button className={styles.button} onClick={handleSkillAdd}>
            <h3 className={styles.title}>add skill</h3>
          </button>

          <button className={styles.button} onClick={handleProjectAdd}>
            <h3 className={styles.title}>add project</h3>
          </button>

          <button className={styles.button} onClick={handleEditProject}>
            <h3 className={styles.title}>edit projects</h3>
          </button>
        </div>

        <button className={styles.button} onClick={handleLogout}>
          <h3 className={styles.title}>logout</h3>
        </button>
      </main>
    </section>
  );
}

export default Dashboard;
