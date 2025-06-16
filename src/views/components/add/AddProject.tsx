import React, { useEffect, useState, ChangeEvent } from 'react';

import { useAppDispatch } from '@/model/hooks';
import { Project } from '@the7ofdiamonds/github-portfolio';

import {
    setMessage,
    setMessageType,
    setShowStatusBar,
} from '@the7ofdiamonds/github-portfolio';

import { EditDetails, EditProcess, EditSolution, EditProblem } from '@the7ofdiamonds/github-portfolio';

import { StatusBarComponent } from '@the7ofdiamonds/github-portfolio';

import styles from './Add.module.scss';

interface AddProjectProps {
    change: (project: Project) => (e: React.MouseEvent<HTMLButtonElement>) => void;
}

export const AddProject: React.FC<AddProjectProps> = ({ change }) => {
    const dispatch = useAppDispatch();

    const [project, setProject] = useState<Project>(new Project);
    const [title, setTitle] = useState<string>('');

    useEffect(() => {
        if (project && project.title) {
            setTitle(project.title);
        }
    }, [project]);

    const handleChange = (e: ChangeEvent<HTMLInputElement>) => {
        try {
            const target = e.target as HTMLInputElement;

            const { name, value } = target;

            if (name === 'title') {
                project.setTitle(value);
                setProject(project)
            }
        } catch (error) {
            const err = error as Error;
            dispatch(setMessage(err.message));
            dispatch(setMessageType('error'));
            dispatch(setShowStatusBar(Date.now()));
        }
    };

    return (
        <>
            <form className={styles.form} action="" id="add_project">
                <div className={styles['form-item-flex']}>
                    <label className={styles.label} htmlFor="title">Title:</label>
                    <input
                        className={styles.input}
                        type="text"
                        name="title"
                        placeholder="Title"
                        value={title}
                        onChange={handleChange}
                    />
                </div>

                <button className={styles.button} onClick={change(project)}>
                    <h3>SAVE TITLE</h3>
                </button>
            </form>

            <hr />

            <EditSolution project={project} change={change} />

            <hr />

            <EditProcess project={project} change={change} />

            <hr />

            <EditProblem project={project} change={change} />

            <hr />

            <EditDetails project={project} change={change} />

            <br />

            <button className={styles.button} onClick={change(project)}>
                <h3>SAVE PROJECT</h3>
            </button>

            <StatusBarComponent />
        </>
    )
}