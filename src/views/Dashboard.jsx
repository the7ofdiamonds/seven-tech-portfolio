import React, { useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
// import { useDispatch, useSelector } from 'react-redux';

// import { User } from '@/model/User';

// import { logout } from '@/controllers/authSlice';
// import {
//   setMessage,
//   setMessageType,
//   setShowStatusBar,
// } from '@/controllers/messageSlice';

// import { checkHeaders } from '@/utilities/Headers';
// import { AppDispatch, RootState } from '@the7ofdiamonds/github-portfolio';

function Dashboard() {
  const navigate = useNavigate();
  // const dispatch = useDispatch();

  // useEffect(() => {
  //   if (!checkHeaders()) {
  //     navigate('/login');
  //   }
  // }, []);

  const handleSkillAdd = () => {
    navigate('/dashboard/add/skill');
  };

  const handleUpdateProject = () => {
    navigate('/dashboard/update/portfolio');
  };

  // const handleLogout = async () => {
  //   try {
  //     dispatch(logout());

  //     window.location.href = '/';
  //   } catch (error) {
  //     // const err = error as Error;

  //     dispatch(setMessage(`Logout error: ${error.message}`));
  //     dispatch(setMessageType('error'));
  //     dispatch(setShowStatusBar(true));
  //   }
  // };

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

        {/* <button onClick={handleLogout}>
          <h3 className="title">logout</h3>
        </button> */}
      </main>
    </section>
  );
}

export default Dashboard;
