import { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { useParams } from 'react-router-dom';

import {
  getProjectTypes,
  getSkills,
  getFrameworks,
  getTechnologies
} from '../controllers/taxonomiesSlice';

import Projects from './components/Projects';
import TaxList from './components/TaxList';

import LoadingComponent from '../views/components/global/LoadingComponent';
import IconComponent from '../views/components/IconComponent';

function ProjectTypesPage() {
  const { type } = useParams();

  const {
    taxonomiesLoading,
    taxonomiesErrorMessage,
    icon,
    title,
    projects,
    projectTypes,
    skills,
    frameworks,
    technologies
  } = useSelector((state) => state.taxonomies);

  const dispatch = useDispatch();

  useEffect(() => {
    dispatch(getProjectType(type));
  }, [dispatch, type]);

  useEffect(() => {
    dispatch(getProjectTypes());
  }, [dispatch]);

  useEffect(() => {
    dispatch(getProjectTags());
  }, [dispatch]);

  if (taxonomiesLoading) {
    return <LoadingComponent />;
  }

  return (
    <>
      <main className="project-types">
        <h1 className="title">
          <IconComponent icon={icon} /> {title} projects
        </h1>

        <Projects projects={projects} />

        <TaxList tax={projectTypes} />

        <TaxList tax={skills} />

        <TaxList tax={frameworks} />

        <TaxList tax={technologies} />
      </main>
    </>
  );
}

export default ProjectTypesPage;
