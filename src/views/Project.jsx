import { useState, useEffect } from 'react';
import { useNavigate, useLocation } from 'react-router-dom';
import { useSelector, useDispatch } from 'react-redux';

import { getClient } from '../controllers/clientSlice';

import { getProject } from '../controllers/projectSlice';
import ProjectType from '../components/Project-Type';

function Project() {
  const location = useLocation();
  const projectPath = location.pathname.split('/')[3];

  const { loading, error, title } = useSelector((state) => state.project);

  const dispatch = useDispatch();
  const navigate = useNavigate();

  useEffect(() => {
    dispatch(getProject(projectPath));
  }, [dispatch, projectPath]);

  const handleClick = () => {};

  return (
    <>
      {/* The Solution */}
      {/* Gallery */}
      {/* Who -> Client */}
      <h2 class="title">{title}</h2>

      <div class="project-info">
        <ProjectType />
      </div>
      {/* What -> Github Read Me File */}
      {/* When -> Github -> Versions */}
      {/* The Process - How -> Check list */}
      {/* Design -> Gallery */}
      {/* Colors */}
      {/* Logos & Icons */}
      {/* UML Diagrams */}
      {/* Development -> Link to GitHub repo */}
      {/* Check List */}
      {/* Delivery —> Where ? */}
      {/* Websites */}
      {/* Social Networks */}
      {/* App Stores */}
      {/* The Problem - Why^ */}
    </>
  );
}

export default Project;
