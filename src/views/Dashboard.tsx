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

  useEffect(() => {
    if (!checkHeaders()) {
      navigate('/login');
    }
  }, []);

  const handleSkillAdd = () => {
    navigate('/dashboard/add/skill');
  };

  const handleUpdateProject = () => {
    navigate('/dashboard/update/portfolio');
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
          <button onClick={handleSkillAdd}>
            <h3 className={styles.title}>add skill</h3>
          </button>

          <button onClick={handleUpdateProject}>
            <h3 className={styles.title}>update projects</h3>
          </button>
        </div>

        <button onClick={handleLogout}>
          <h3 className={styles.title}>logout</h3>
        </button>
      </main>
    </section>
  );
}

export default Dashboard;
