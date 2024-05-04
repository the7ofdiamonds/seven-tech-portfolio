import { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { useParams } from 'react-router-dom';

import {
  getProjectTypes,
  getSkills,
  getFrameworks,
  getTechnologies,
} from '../controllers/taxonomiesSlice';

import Projects from './components/Projects';
import TaxList from './components/TaxList';

import LoadingComponent from '../views/components/global/LoadingComponent';
import IconComponent from '../views/components/IconComponent';

function ProjectTagsPage() {
  const { tag } = useParams();

  const {
    taxonomiesLoading,
    taxonomiesErrorMessage,
    icon,
    title,
    projects,
    project_types,
    skills,
    frameworks,
    technologies,
    tags,
  } = useSelector((state) => state.taxonomies);

  const dispatch = useDispatch();

  useEffect(() => {
    dispatch(getProjectTag(tag));
  }, [dispatch, tag]);

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
      <main className="project-tags">
        <h1 className="title">
          <IconComponent icon={icon} /> {title} projects
        </h1>

        <Projects projects={projects} />

        <TaxList tax={project_types} title={'project types'} />

        <TaxList tax={skills} title={'skills'} />

        <TaxList tax={frameworks} title={'frameworks'} />

        <TaxList tax={technologies} title={'technologies'} />
      </main>
    </>
  );
}

export default ProjectTagsPage;
