import { useState, useEffect } from 'react';
import { useNavigate, useLocation } from 'react-router-dom';
import { useSelector, useDispatch } from 'react-redux';

import { getClient } from '../controllers/clientSlice';
import { getProject } from '../controllers/projectSlice';

import ProjectType from '../components/ProjectType';
import ProjectStatus from '../components/ProjectStatus';
import Gallery from '../components/Gallery';
import Client from '../components/Client';
import Github from '../components/Github';
import Versions from '../components/Versions';
import ProjectURLs from '../components/ProjectURLs';
import SocialNetworks from '../components/SocialNetworks';
import AppStores from '../components/AppStores';
import TheProblem from '../components/TheProblem';
import CheckList from '../components/CheckList';
import Colors from '../components/Colors';
import ProjectAuthor from '../components/ProjectAuthor';
import ProjectTags from '../components/ProjectTags';

function Project() {
  const location = useLocation();
  const projectPath = location.pathname.split('/')[3];

  const {
    loading,
    error,
    title,
    project_types,
    project_status,
    the_problem,
    project_author,
    project_tags,
  } = useSelector((state) => state.project);

  const dispatch = useDispatch();
  const navigate = useNavigate();

  useEffect(() => {
    dispatch(getProject(projectPath));
  }, [dispatch, projectPath]);

  const handleClick = () => {};
  return (
    <>
      <h2 class="title">{title}</h2>

      <div class="project-info">
        <ProjectType project_types={project_types} />
        <ProjectStatus project_status={project_status} />
      </div>

      <div className="project-solution" id="project_solution">
        <h3>THE SOLUTION</h3>
        {/* Solution Gallery */}
        <Gallery />

        {/* Who -> Client */}
        <Client />

        {/* What -> Github Read Me File */}
        <Github />

        {/* When -> Github -> Versions */}
        <Versions />

        {/* Urls */}
        <ProjectURLs />

        {/* Social Networks */}
        <SocialNetworks />

        {/* App Stores */}
        <AppStores />
      </div>

      <div className="project-process" id="project_process">
        <h3>THE PROCESS</h3>

        <div className="project-process-design" id="project_process_design">
          <h4>DESIGN</h4>

          {/* Design Gallery */}
          <Gallery />

          <CheckList />

          <Colors />

          {/* Logos & Icons Gallery*/}
          <Gallery />

          {/* UML Diagrams Gallery*/}
          <Gallery />
        </div>

        <div
          className="project-process-development"
          id="project_process_development">
          <h4>DEVELOPMENT</h4>

          <CheckList />
        </div>

        <div className="project-process-delivery" id="project_process_delivery">
          <h4>DELIVERY</h4>

          <CheckList />
        </div>
      </div>

      <div className="project-problem" id="project_problem">
        <h3>THE PROBLEM</h3>

        <TheProblem the_problem={the_problem} />
      </div>

      {/* <ProjectAuthor project_author={project_author} />

      <ProjectTags project_tags={project_tags} /> */}
    </>
  );
}

export default Project;
