import React, { useEffect } from 'react';
import { useParams } from 'react-router-dom';

import { getProjectType } from '@the7ofdiamonds/github-portfolio';

import { getPortfolioProjectsWithTerm } from '@/controllers/portfolioSlice';
import {
  getFoundersWithTerm,
  getExecutivesWithTerm,
  getManagingMembersWithTerm,
  getFreelancersWithTerm,
  getEmployeesWithTerm,
} from '@/controllers/postTypeSlice';

import { LoadingComponent } from '@the7ofdiamonds/github-portfolio';

import HeaderIconComponent from './components/HeaderIconComponent';

import Projects from './components/Projects';
import GroupMembers from './components/GroupMembers';

import {useAppDispatch, useAppSelector} from '@/model/hooks';

const ProjectType: React.FC = () => {
  const { projectType } = useParams();

  const dispatch = useAppDispatch();

  useEffect(() => {
    dispatch(getProjectType(projectType));
  }, [dispatch]);

  useEffect(() => {
    dispatch(getPortfolioProjectsWithTerm({ taxonomy: 'ProjectTypes', term: projectType }));
  }, [dispatch]);

  useEffect(() => {
    dispatch(
      getFoundersWithTerm({ taxonomy: 'ProjectTypes', term: projectType })
    );
  }, [dispatch]);

  useEffect(() => {
    dispatch(
      getExecutivesWithTerm({ taxonomy: 'ProjectTypes', term: projectType })
    );
  }, [dispatch]);

  useEffect(() => {
    dispatch(
      getManagingMembersWithTerm({
        taxonomy: 'ProjectTypes',
        term: projectType,
      })
    );
  }, [dispatch]);

  useEffect(() => {
    dispatch(
      getFreelancersWithTerm({ taxonomy: 'ProjectTypes', term: projectType })
    );
  }, [dispatch]);

  useEffect(() => {
    dispatch(
      getEmployeesWithTerm({ taxonomy: 'ProjectTypes', term: projectType })
    );
  }, [dispatch]);

  const {
    taxonomiesLoading,
    taxonomiesErrorMessage,
    icon,
    title,
    description,
    url,
  } = useAppSelector((state) => state.taxonomies);
  const { portfolio } = useAppSelector((state) => state.portfolio);
  const { founders, executives, managingMembers, freelancers, employees } =
    useAppSelector((state) => state.postType);

  if (taxonomiesLoading) {
    return <LoadingComponent />;
  }

  return (
    <main className="project-type">
      <HeaderIconComponent icon={icon} title={title} url={url} />

      {description && (
        <div className="card">
          <p>{description}</p>
        </div>
      )}

      <Projects projects={portfolio} />

      <GroupMembers group={founders} />
      <GroupMembers group={executives} />
      <GroupMembers group={managingMembers} />
      <GroupMembers group={freelancers} />
      <GroupMembers group={employees} />
    </main>
  );
}

export default ProjectType;
