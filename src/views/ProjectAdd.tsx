import React, { useEffect, useState, MouseEvent } from 'react';
import { useParams, useNavigate } from 'react-router-dom';

import {
    addProject,
    setMessage,
    setMessageType,
    setShowStatusBar,
    getProject,
} from '@the7ofdiamonds/github-portfolio';

import { useAppDispatch, useAppSelector } from '@the7ofdiamonds/github-portfolio';

import {
    EditProject,
} from '@the7ofdiamonds/github-portfolio';

import { Project, Owner, User, GitHubRepoQuery, Portfolio, RepoURL } from '@the7ofdiamonds/github-portfolio'

interface ProjectAddProps {
    user: User;
}

const ProjectAdd: React.FC<ProjectAddProps> = ({ user }) => {
    const dispatch = useAppDispatch();
    const navigate = useNavigate();

    const { login, projectID } = useParams();

    const { projectLoading, projectLoadingMessage, projectErrorMessage, projectObject } = useAppSelector(
        (state) => state.project
    );
    const { portfolioObject } = useAppSelector(
        (state) => state.portfolio
    );
    const { addLoading, addLoadingMessage, addErrorMessage, addSuccessMessage, addStatusCode } = useAppSelector(
        (state) => state.add
    );

    const [portfolio, setPortfolio] = useState<Portfolio | null>(user.portfolio);

    const [owner, setOwner] = useState<Owner>(new Owner());
    const [id, setId] = useState<string>();
    const [repoQuery, setRepoQuery] = useState<GitHubRepoQuery>();

    const [project, setProject] = useState<Project>(new Project());

    const [title, setTitle] = useState<string>(projectID ?? '');

    useEffect(() => {
        if (login) {
            setOwner(new Owner({ login: login }))
        }
    }, [login]);

    useEffect(() => {
        if (projectID) {
            setId(projectID);
        }
    }, [projectID]);

    useEffect(() => {
        if (user.portfolio) {
            setPortfolio(user.portfolio);
        }
    }, [user?.portfolio]);

    useEffect(() => {
        if (portfolio && portfolio.size > 0 && id) {
            const filteredProject = portfolio.filterProject(id);
            if (filteredProject) {
                setProject(filteredProject);
            }
        }
    }, [id, portfolio]);

    useEffect(() => {
        if (id && owner.login) {
            setRepoQuery(new GitHubRepoQuery(owner.login, id))
        }
    }, [owner, id]);

    useEffect(() => {
        if (repoQuery) {
            dispatch(getProject(repoQuery));
        }
    }, [repoQuery]);

    useEffect(() => {
        if (projectObject) {
            setProject(new Project(projectObject));
        }
    }, [projectObject]);

    useEffect(() => {
        if (projectLoading && projectLoadingMessage) {
            dispatch(setMessage(projectLoadingMessage));
            dispatch(setMessageType('info'));
            dispatch(setShowStatusBar(Date.now()));
        }
    }, [projectLoading, projectLoadingMessage]);

    useEffect(() => {
        if (projectErrorMessage) {
            dispatch(setMessage(projectErrorMessage));
            dispatch(setMessageType('info'));
            dispatch(setShowStatusBar(Date.now));
        }
    }, [projectErrorMessage]);

    useEffect(() => {
        if (addLoading && addLoadingMessage) {
            dispatch(setMessage(addLoadingMessage));
            dispatch(setMessageType('info'));
            dispatch(setShowStatusBar(Date.now()));
        }
    }, [addLoading, addLoadingMessage]);

    useEffect(() => {
        if (addErrorMessage) {
            dispatch(setMessage(addErrorMessage));
            dispatch(setMessageType('error'));
            dispatch(setShowStatusBar(Date.now()));
        }
    }, [addErrorMessage]);

    useEffect(() => {
        if (addSuccessMessage) {
            dispatch(setMessage(addSuccessMessage));
            dispatch(setMessageType('success'));
            dispatch(setShowStatusBar(Date.now()));
        }
    }, [addSuccessMessage]);

    useEffect(() => {
        if (addStatusCode === 403) {
            navigate('/login');
        }
    }, [addStatusCode]);

    useEffect(() => {
        if (project && project.title) {
            setTitle(project.title);
        }
    }, [project]);

    const handleAddProject = (project: Project) => (e: MouseEvent<HTMLButtonElement>) => {
        e.preventDefault();

        try {
            dispatch(addProject(project))
                .then((res) => {
                    console.log(res);
                    // if (res.meta.requestStatus === 'fulfilled') {
                    //     let id = res.payload.id;
                    //     let repoURL = new RepoURL(res.payload.repo_url);

                    //     dispatch(setMessageType('success'));
                    //     dispatch(setMessage(res.payload.success_message));
                    //     dispatch(setShowStatusBar(Date.now()));

                    //     if (repoURL.owner) {
                    //         const repoQuery = new GitHubRepoQuery(repoURL.owner, id);
                    //         dispatch(getProject(repoQuery));
                    //     }
                    // }
                });
        } catch (error) {
            const err = error as Error;
            dispatch(setMessageType('error'));
            dispatch(setMessage(err.message));
            dispatch(setShowStatusBar(Date.now()));
        }
    };

    return (
        <section className="update-project">
            <h1 className="title">update project</h1>
            <EditProject project={project} change={handleAddProject} />
        </section>
    );
};

export default ProjectAdd;