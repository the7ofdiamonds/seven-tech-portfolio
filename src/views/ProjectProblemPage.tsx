import React, { useState, useEffect, MouseEvent, ChangeEvent } from 'react';
import { useParams } from 'react-router-dom';

import { useAppDispatch, useAppSelector } from '@/model/hooks';

import { getClient } from '../controllers/clientSlice';
import {
  createProjectProblem,
  getProjectProblem,
  updateProjectProblem,
} from '../controllers/projectProblemSlice';

import { LoadingComponent, StatusBar, Modal } from '@the7ofdiamonds/github-portfolio';

import { ProjectProblem } from '@the7ofdiamonds/github-portfolio';

import styles from '@/views/components/Problem.module.scss';

const ProjectProblemPage: React.FC = () => {
  const { projectID } = useParams();

  const dispatch = useAppDispatch();

  const [show, setShow] = useState<string>('');
  const [messageType, setMessageType] = useState<string>('info');
  const [message, setMessage] = useState<string>(
    'To come up with the best solution, we must first define the problem below.'
  );
  const [projectProblem, setProjectProblem] = useState<ProjectProblem>(new ProjectProblem);
  const [problemID, setProblemID] = useState<string | null>(null);

  const { user_email, first_name, client_id } = useAppSelector(
    (state) => state.client
  );
  const {
    problemLoading,
    problemSuccessMessage,
    problemErrorMessage,
    projectProblemObject
  } = useAppSelector((state) => state.problem);

  useEffect(() => {
    if (projectProblemObject) {
      setProjectProblem(new ProjectProblem(projectProblemObject))
    }
  }, [projectProblemObject]);

  useEffect(() => {
    if (projectProblem.id) {
      setProblemID(projectProblem.id);
    }
  }, [projectProblem?.id]);

  useEffect(() => {
    if (user_email) {
      dispatch(getClient());
    }
  }, [user_email]);

  useEffect(() => {
    if (projectID) {
      dispatch(getProjectProblem(projectID));
    }
  }, [projectID]);

  if (problemLoading) {
    return <LoadingComponent />;
  }

  const handleInputChange = (e: ChangeEvent<HTMLInputElement>) => {
    const { name, value } = e.target;

    setProjectProblem(projectProblem);
  };

  const handleTextAreaChange = (e: ChangeEvent<HTMLTextAreaElement>) => {
    const { name, value } = e.target;

    setProjectProblem(projectProblem);
  };

  const handleSubmit = (e: MouseEvent<HTMLButtonElement>) => {
    e.preventDefault();
    if (problemID) {
      dispatch(updateProjectProblem(projectProblem));
    } else {
      dispatch(createProjectProblem(projectProblem));
    }
  };

  return (
    <>
      <main className={styles['project-problem']}>
        <h2 className={styles.title}>THE PROBLEM</h2>

        <StatusBar show={show} message={message} messageType={messageType} />

        <div className={styles.card}>
          <form className={styles['the-problem']} action="">
            <table>
              <tbody>
                <tr>
                  <td>
                    <label htmlFor="">
                      How are the customers or clients of (your company or
                      organization) impacted by this problem?
                    </label>
                    <textarea
                      name="customers_impacted"
                      onChange={handleTextAreaChange}
                      value={projectProblem.customersImpacted ?? ''}></textarea>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label htmlFor="">
                      Who else is affected by this problem?
                    </label>
                    <textarea
                      name="problem_affected"
                      onChange={handleTextAreaChange}
                      value={projectProblem.problemAffected ?? ''}>
                      {projectProblem.problemAffected ?? ''}
                    </textarea>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label htmlFor="">
                      What are the key challenges (your company or organization)
                      is encountering?
                    </label>
                    <textarea
                      name="challenges"
                      onChange={handleTextAreaChange}
                      value={projectProblem.challenges ?? ''}></textarea>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label htmlFor="">
                      How has this problem affected (your company or
                      organization) operations or outcomes?
                    </label>
                    <textarea
                      name="affected_operations"
                      onChange={handleTextAreaChange}
                      value={projectProblem.affectedOperations ?? ''}></textarea>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label htmlFor="">
                      What factors contributed to this issue?
                    </label>
                    <textarea
                      name="factors_contributed"
                      onChange={handleTextAreaChange}
                      value={projectProblem.factorsContributed ?? ''}></textarea>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label htmlFor="">
                      Has there been any significant change or event that
                      coincided with the problem's emergence?
                    </label>
                    <textarea
                      name="change_event"
                      onChange={handleTextAreaChange}
                      value={projectProblem.changeEvent ?? ''}></textarea>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label htmlFor="">
                      When did you first notice this problem?
                    </label>
                    <input
                      type="date"
                      name="first_notice_date"
                      className={styles['input-date']}
                      onChange={handleInputChange}
                      value={projectProblem.firstNoticeDate ?? ''}
                    />
                  </td>
                </tr>
                <tr>
                  <td>
                    <label htmlFor="recurring_issue">
                      Is this a recurring issue, or is it a one-time occurrence?
                    </label>
                    <div className="options-column">
                      <span className="option">
                        <input
                          type="radio"
                          id="recurring_issue_yes"
                          name="recurring_issue"
                          className={styles['input-radio']}
                          value={'yes'}
                          onChange={handleInputChange}
                          checked={projectProblem.recurringIssue === 'yes'}
                        />
                        <label htmlFor="recurring_issue_yes">Yes</label>
                      </span>
                      <span className="option">
                        <input
                          type="radio"
                          id="recurring_issue_no"
                          name="recurring_issue"
                          className={styles['input-radio']}
                          value={'no'}
                          onChange={handleInputChange}
                          checked={projectProblem.recurringIssue === 'no'}
                        />
                        <label htmlFor="recurring_issue_no">No</label>
                      </span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label htmlFor="">
                      Have (your company or organization) identified any
                      patterns or trends related to this problem?
                    </label>
                    <textarea
                      name="patterns_trends"
                      onChange={handleTextAreaChange}
                      value={projectProblem.patternsTrends ?? ''}></textarea>{' '}
                  </td>
                </tr>
                <tr>
                  <td>
                    <label htmlFor="">
                      Have (your company or organization) tried any solutions to
                      address this issue?
                    </label>
                    <span className="option">
                      <input
                        type="radio"
                        id="tried_solutions_yes"
                        name="tried_solutions"
                        value="yes"
                        className={styles['input-radio']}
                        onChange={handleInputChange}
                        checked={projectProblem.triedSolutions === 'yes'}
                      />
                      <label htmlFor="tried_solutions_yes">Yes</label>
                    </span>
                    <span className="option">
                      <input
                        type="radio"
                        id="tried_solutions_no"
                        name="tried_solutions"
                        value="no"
                        className={styles['input-radio']}
                        onChange={handleInputChange}
                        checked={projectProblem.triedSolutions === 'no'}
                      />
                      <label htmlFor="tried_solutions_no">No</label>
                    </span>
                  </td>
                </tr>
                {projectProblem.triedSolutions === 'yes' && (
                  <tr>
                    <td>
                      <label htmlFor="">What were the results?</label>
                      <textarea
                        name="tried_solutions_results"
                        onChange={handleTextAreaChange}
                        value={projectProblem.triedSolutionsResults ?? ''}></textarea>
                    </td>
                  </tr>
                )}
                <tr>
                  <td>
                    <label htmlFor="">
                      What would an ideal resolution to this problem look like
                      for (your company or organization)?
                    </label>
                    <textarea
                      name="ideal_resolution"
                      onChange={handleTextAreaChange}
                      value={projectProblem.idealResolution ?? ''}></textarea>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>

        <StatusBar show={show} message={message} messageType={messageType} />

        <button type="submit" onClick={handleSubmit}>
          <h3>{problemID ? 'UPDATE' : 'SAVE'}</h3>
        </button>
      </main>
    </>
  );
}

export default ProjectProblemPage;
