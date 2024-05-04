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
    solution_gallery,
    project_urls,
    project_details,
    the_solution,
    the_problem,
    project_team,
    project_types,
    skills,
    frameworks,
    technologies,
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

        <TaxList tax={project_types} title={'project types'} />

        <TaxList tax={skills} title={'skills'} />

        <TaxList tax={frameworks} title={'frameworks'} />

        <TaxList tax={technologies} title={'technologies'} />

        <ProjectTeam project_team={project_team} />
      </main>
    </>
  );
}

export default Project;
