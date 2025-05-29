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
    <section>
      <main>
        <h2 className="title">Dashboard</h2>

        <div className="options">
          <button onClick={handleSkillAdd}>
            <h3 className="title">add skill</h3>
          </button>

          <button onClick={handleUpdateProject}>
            <h3 className="title">update projects</h3>
          </button>
        </div>

        <button onClick={handleLogout}>
          <h3 className="title">logout</h3>
        </button>
      </main>
    </section>
  );
}

export default Dashboard;
