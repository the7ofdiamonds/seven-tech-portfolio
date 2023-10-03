import { useState, useEffect } from 'react';
import { useNavigate, useLocation } from 'react-router-dom';
import { useSelector, useDispatch } from 'react-redux';

import { getClient } from '../controllers/clientSlice';
import { getProject } from '../controllers/projectSlice';

import ProjectType from '../components/ProjectType';
import ProjectStatus from '../components/ProjectStatus';
import Gallery from '../components/Gallery';
import ProjectDetails from '../components/ProjectDetails';
import TheSolution from '../components/TheSolution';
import Versions from '../components/Versions';
import ProjectURLs from '../components/ProjectURLs';
import CheckList from '../components/CheckList';
import Colors from '../components/Colors';
import TheProblem from '../components/TheProblem';
import ProjectAuthor from '../components/ProjectTeam';
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
    project_details,
    the_solution,
    project_versions,
    design,
    design_gallery,
    design_check_list,
    colors,
    logos_gallery,
    icons_gallery,
    animations_gallery,
    uml_diagrams_gallery,
    development,
    development_gallery,
    development_check_list,
    delivery,
    delivery_gallery,
    delivery_check_list,
    the_problem,
    project_team,
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

      <ProjectURLs project_urls={project_urls} />

      <ProjectDetails project_details={project_details} />

      <TheSolution the_solution={the_solution} />

      <div className="project-process" id="project_process">
        <h3 class="title">THE PROCESS</h3>

        <ProjectStatus project_status={project_status} />
        <Versions versions={project_versions} />

        <div className="project-process-design" id="project_process_design">
          <h4 class="title">DESIGN</h4>

          <CheckList checklist={design_check_list} />
          <Gallery gallery={design_gallery} />
          <Colors colors={colors} />
          <h5 class="title">Logos</h5>
          <Gallery gallery={logos_gallery} />
          <h5 class="title">icons</h5>
          <Gallery gallery={icons_gallery} />
          <h5 class="title">Animations</h5>
          <Gallery gallery={animations_gallery} />
          <h5 class="title">uml diagrams</h5>
          <Gallery gallery={uml_diagrams_gallery} />
        </div>

        <div
          className="project-process-development"
          id="project_process_development">
          <h4 class="title">DEVELOPMENT</h4>

          <CheckList checklist={development_check_list} />
        </div>

        <div className="project-process-delivery" id="project_process_delivery">
          <h4 class="title">DELIVERY</h4>

          <CheckList checklist={delivery_check_list} />
        </div>
      </div>

      <TheProblem the_problem={the_problem} />

      <ProjectType project_types={project_types} />

      <ProjectTags project_tags={project_tags} />

      <ProjectAuthor project_team={project_team} />
    </>
  );
}

export default Project;
