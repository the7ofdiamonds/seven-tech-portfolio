import { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { useParams } from 'react-router-dom';

import {
  getProjectTag,
  getProjectTypes,
  getProjectTags,
} from '../controllers/taxonomiesSlice';

import Projects from './components/Projects';
import ProjectTypes from './components/ProjectTypes';
import ProjectTags from './components/ProjectTags';

import LoadingComponent from '../views/components/global/LoadingComponent';

function ProjectTagsPage() {
  const { tag } = useParams();

  const {
    taxonomiesLoading,
    taxonomiesErrorMessage,
    icon,
    title,
    projects,
    types,
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
          <i className={`fa-brands fa-${icon}`}></i> {title} projects
        </h1>

        <Projects projects={projects} />

        <ProjectTypes project_types={types} />

        <ProjectTags project_tags={tags} />
      </main>
    </>
  );
}

export default ProjectTagsPage;
