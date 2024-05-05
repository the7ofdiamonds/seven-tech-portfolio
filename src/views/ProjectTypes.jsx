import { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { useParams } from 'react-router-dom';

import { getProjectTypes } from '../controllers/taxonomiesSlice';
import { getPortfolioProjectsByTaxonomy } from '../controllers/portfolioSlice';

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
    project_types,
  } = useSelector((state) => state.taxonomies);
  const { portfolioLoading, portfolioErrorMessage, projects } = useSelector(
    (state) => state.portfolio
  );

  const dispatch = useDispatch();

  useEffect(() => {
    dispatch(getProjectTypes());
  }, [dispatch]);

  useEffect(() => {
    dispatch(getPortfolioProjectsByTaxonomy('ProjectTypes'));
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
      </main>
    </>
  );
}

export default ProjectTypesPage;
