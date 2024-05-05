import React, { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { useParams } from 'react-router-dom';

import { getProjectType } from '../controllers/taxonomiesSlice';
import {
  getFoundersWithTerm,
  getExecutivesWithTerm,
  getManagingMembersWithTerm,
  getFreelancersWithTerm,
  getEmployeesWithTerm,
} from '../controllers/postTypeSlice';

import LoadingComponent from './components/LoadingComponent';
import ErrorComponent from './components/ErrorComponent';
import HeaderIconComponent from './components/HeaderIconComponent';
import GroupMembers from './components/GroupMembers';

function ProjectType() {
  const { projectType } = useParams();

  const dispatch = useDispatch();

  useEffect(() => {
    dispatch(getProjectType(projectType));
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
  } = useSelector((state) => state.taxonomies);
  const { founders, executives, managingMembers, freelancers, employees } =
    useSelector((state) => state.postType);

  if (taxonomiesLoading) {
    return <LoadingComponent />;
  }

  if (taxonomiesErrorMessage) {
    return <ErrorComponent message={taxonomiesErrorMessage} />;
  }

  return (
    <main className="project-type">
      <HeaderIconComponent icon={icon} title={title} url={url} />

      {description && (
        <div className="card">
          <p>{description}</p>
        </div>
      )}

      <GroupMembers group={founders} />
      <GroupMembers group={executives} />
      <GroupMembers group={managingMembers} />
      <GroupMembers group={freelancers} />
      <GroupMembers group={employees} />
    </main>
  );
}

export default ProjectType;
