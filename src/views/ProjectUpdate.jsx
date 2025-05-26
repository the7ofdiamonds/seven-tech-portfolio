import React, { useEffect, useState, MouseEvent, ChangeEvent } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import { useSelector, useDispatch } from 'react-redux';

import {
  updateProject,
  setMessage,
  setMessageType,
  setShowStatusBar,
  getProject,
} from '@the7ofdiamonds/github-portfolio';
import {
  UpdateDetails,
  UpdateProcess,
  UpdateSolution,
  UpdateProblem,
  StatusBarComponent,
} from '@the7ofdiamonds/github-portfolio';
// import { AppDispatch, RootState } from '@the7ofdiamonds/github-portfolio';

// import { Project, ProjectObject } from '@/model/Project'
// import { Owner } from '@/model/Owner';
// import { Portfolio } from '@/model/Portfolio';
// import { GitHubRepoQuery } from '@/model/GitHubRepoQuery';
// import { RepoURL } from '@/model/RepoURL';
// import { User } from '@/model/User';

// interface ProjectUpdateProps {
//     user: User;
// }

export const ProjectUpdate = ({ user }) => {
  const dispatch = useDispatch();
  const navigate = useNavigate();

  const { login, projectID } = useParams();

  const {
    projectLoading,
    projectLoadingMessage,
    projectErrorMessage,
    projectObject,
  } = useSelector((state) => state.project);
  const { portfolioObject } = useSelector((state) => state.portfolio);
  const {
    updateLoading,
    updateLoadingMessage,
    updateErrorMessage,
    updateSuccessMessage,
    updateStatusCode,
  } = useSelector((state) => state.update);

  const [portfolio, setPortfolio] = useState(user.portfolio);

  const [owner, setOwner] = useState(new Owner());
  const [id, setId] = useState();
  const [repoQuery, setRepoQuery] = useState();

  const [project, setProject] = useState(new Project());

  const [title, setTitle] = useState(projectID ?? '');

  useEffect(() => {
    if (login) {
      setOwner(new Owner({ login: login }));
    }
  }, [login]);

  useEffect(() => {
    if (projectID) {
      setId(projectID);
    }
  }, [projectID]);

  useEffect(() => {
    if (user.portfolio) {
      setPortfolio(user.portfolio);
    }
  }, [user?.portfolio]);

  useEffect(() => {
    if (portfolio && portfolio.size > 0 && id) {
      const filteredProject = portfolio.filterProject(id);
      if (filteredProject) {
        setProject(filteredProject);
      }
    }
  }, [id, portfolio]);

  useEffect(() => {
    if (id && owner.login) {
      setRepoQuery(new GitHubRepoQuery(owner.login, id));
    }
  }, [owner, id]);

  useEffect(() => {
    if (repoQuery) {
      dispatch(getProject(repoQuery));
    }
  }, [repoQuery]);

  useEffect(() => {
    if (projectObject) {
      setProject(new Project(projectObject));
    }
  }, [projectObject]);

  useEffect(() => {
    if (projectLoading && projectLoadingMessage) {
      dispatch(setMessage(projectLoadingMessage));
      dispatch(setMessageType('info'));
      dispatch(setShowStatusBar(Date.now()));
    }
  }, [projectLoading, projectLoadingMessage]);

  useEffect(() => {
    if (projectErrorMessage) {
      dispatch(setMessage(projectErrorMessage));
      dispatch(setMessageType('info'));
      dispatch(setShowStatusBar(Date.now));
    }
  }, [projectErrorMessage]);

  useEffect(() => {
    if (updateLoading && updateLoadingMessage) {
      dispatch(setMessage(updateLoadingMessage));
      dispatch(setMessageType('info'));
      dispatch(setShowStatusBar(Date.now()));
    }
  }, [updateLoading, updateLoadingMessage]);

  useEffect(() => {
    if (updateErrorMessage) {
      dispatch(setMessage(updateErrorMessage));
      dispatch(setMessageType('error'));
      dispatch(setShowStatusBar(Date.now()));
    }
  }, [updateErrorMessage]);

  useEffect(() => {
    if (updateSuccessMessage) {
      dispatch(setMessage(updateSuccessMessage));
      dispatch(setMessageType('success'));
      dispatch(setShowStatusBar(Date.now()));
    }
  }, [updateSuccessMessage]);

  useEffect(() => {
    if (updateStatusCode === 403) {
      navigate('/login');
    }
  }, [updateStatusCode]);

  useEffect(() => {
    if (project && project.title) {
      setTitle(project.title);
    }
  }, [project]);

  const handleChange = (e) => {
    try {
      const target = e.target;

      const { name, value } = target;

      if (name === 'title') {
        setTitle(value);

        const updatedProjectObject = {
          ...project.toProjectObject(),
          title: value,
        };

        setProject(new Project(updatedProjectObject));
      }
    } catch (error) {
      // const err = error as Error;
      dispatch(setMessage(error.message));
      dispatch(setMessageType('error'));
      dispatch(setShowStatusBar(Date.now()));
    }
  };

  const handleUpdateProject = async (e) => {
    e.preventDefault();

    try {
      dispatch(updateProject(project)).then((res) => {
        if (res.meta.requestStatus === 'fulfilled') {
          let id = res.payload.id;
          let repoURL = new RepoURL(res.payload.repo_url);

          if (repoURL.owner) {
            const repoQuery = new GitHubRepoQuery(repoURL.owner, id);
            dispatch(getProject(repoQuery));
          }
        }
      });
    } catch (error) {
      // const err = error as Error;
      dispatch(setMessageType('error'));
      dispatch(setMessage(error.message));
      dispatch(setShowStatusBar(Date.now()));
    }
  };
  console.log(project);
  return (
    <section className="update-project">
      <h1 className="title">update project</h1>

      <form action="" id="add_project">
        <div className="form-item-flex">
          <label htmlFor="title">Title:</label>
          <input
            type="text"
            name="title"
            placeholder="Title"
            value={title}
            onChange={handleChange}
          />
        </div>

        <button onClick={handleUpdateProject}>
          <h3>Update Title</h3>
        </button>
      </form>

      <hr />

      <UpdateSolution project={project} />

      <hr />

      <UpdateProcess project={project} />

      <hr />

      <UpdateProblem project={project} />

      <hr />

      <UpdateDetails project={project} />

      <br />

      <button onClick={handleUpdateProject}>
        <h3 className="title">Update Project</h3>
      </button>

      <StatusBarComponent />
    </section>
  );
};
