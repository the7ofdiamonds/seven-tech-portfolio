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
    id,
    title,
    post_status,
    post_author,
    post_date,
    post_content,
    project_types,
    project_status,
    solution_gallery,
    versions,
    project_urls,
    social_networks,
    app_stores,
    design,
    design_gallery,
    design_check_list,
    colors,
    logos_icons_gallery,
    uml_diagrams_gallery,
    development,
    development_gallery,
    development_check_list,
    delivery,
    delivery_gallery,
    delivery_check_list,
    onboarding,
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
        <Gallery gallery={solution_gallery} />

        {/* Who -> Client */}
        <Client client={onboarding} />

        {/* What -> Github Read Me File */}
        <Github />

        {/* When -> Github -> Versions */}
        <Versions versions={versions} />

        {/* Urls */}
        <ProjectURLs project_urls={project_urls} />

        {/* Social Networks */}
        <SocialNetworks social_networks={social_networks} />

        {/* App Stores */}
        <AppStores app_stores={app_stores} />
      </div>

      <div className="project-process" id="project_process">
        <h3>THE PROCESS</h3>

        <div className="project-process-design" id="project_process_design">
          <h4>DESIGN</h4>

          {/* Design Gallery */}
          <Gallery gallery={design_gallery} />

          <CheckList checklist={design_check_list} />

          <Colors colors={colors} />

          {/* Logos & Icons Gallery*/}
          <Gallery gallery={logos_icons_gallery} />

          {/* UML Diagrams Gallery*/}
          <Gallery gallery={uml_diagrams_gallery} />
        </div>

        <div
          className="project-process-development"
          id="project_process_development">
          <h4>DEVELOPMENT</h4>

          <CheckList checklist={development_check_list} />
        </div>

        <div className="project-process-delivery" id="project_process_delivery">
          <h4>DELIVERY</h4>

          <CheckList checklist={delivery_check_list} />
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
