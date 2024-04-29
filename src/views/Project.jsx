import { useEffect } from 'react';
import { useNavigate, useParams } from 'react-router-dom';
import { useSelector, useDispatch } from 'react-redux';

import { getProject } from '../controllers/projectSlice';

import LoadingComponent from './components/global/LoadingComponent';

import Gallery from './components/Gallery';
import ProjectDetails from './components/ProjectDetails';
import TheSolution from './components/TheSolution';
import ProjectURLs from './components/ProjectURLs';
import TheProblem from './components/TheProblem';
import TaxList from './components/TaxList';
import ProjectTeam from './components/ProjectTeam';
import TheProcess from './components/TheProcess';

function Project() {
  const { project } = useParams();

  const {
    projectLoading,
    projectErrorMessage,
    projectStatusCode,
    title,
    project_types,
    solution_gallery,
    project_urls,
    project_details,
    the_solution,
    the_problem,
    project_team,
    project_tags,
  } = useSelector((state) => state.project);

  const dispatch = useDispatch();

  useEffect(() => {
    dispatch(getProject(project));
  }, [dispatch, project]);

  if (projectLoading) {
    return <LoadingComponent />;
  }

  return (
    <>
      <main className="project">
        <h2 class="title">{title}</h2>

        <Gallery gallery={solution_gallery} />

        <ProjectURLs project_urls={project_urls} />

        <ProjectDetails project_details={project_details} />

        <TheSolution the_solution={the_solution} />

        <TheProcess />

        <TheProblem the_problem={the_problem} />

        <TaxList tax={projectTypes} />

        <TaxList tax={skills} />

        <TaxList tax={frameworks} />

        <TaxList tax={technologies} />

        <ProjectTeam project_team={project_team} />
      </main>
    </>
  );
}

export default Project;
