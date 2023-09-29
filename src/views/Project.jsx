import { useState, useEffect } from 'react';
import { useNavigate, useLocation } from 'react-router-dom';
import { useSelector, useDispatch } from 'react-redux';

import { getClient } from '../controllers/clientSlice';
import { getProject } from '../controllers/projectSlice';

import ProjectType from '../components/ProjectType';
import ProjectStatus from '../components/ProjectStatus';
import Gallery from '../components/Gallery';
import TheClient from '../components/TheClient';
import TheSolution from '../components/TheSolution';
import Versions from '../components/Versions';
import ProjectURLs from '../components/ProjectURLs';
import CheckList from '../components/CheckList';
import Colors from '../components/Colors';
import TheProblem from '../components/TheProblem';
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
    project_types,
    project_status,
    solution_gallery,
    project_urls,
    the_client,
    the_solution,
    versions,
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

      <Gallery gallery={solution_gallery} />

      <div class="project-info">
        <ProjectType project_types={project_types} />
        <ProjectStatus project_status={project_status} />
        <ProjectURLs project_urls={project_urls} />
      </div>

      <TheClient the_client={the_client} />

      <TheSolution the_solution={the_solution} />

      <Versions versions={versions} />

      <div className="project-process" id="project_process">
        <h3>THE PROCESS</h3>

        <div className="project-process-design" id="project_process_design">
          <h4>DESIGN</h4>

          <Gallery gallery={design_gallery} />
          <CheckList checklist={design_check_list} />
          <Colors colors={colors} />
          <Gallery gallery={logos_icons_gallery} />
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

      <TheProblem the_problem={the_problem} />

      {/* <ProjectAuthor project_author={project_author} />

      <ProjectTags project_tags={project_tags} /> */}
    </>
  );
}

export default Project;
