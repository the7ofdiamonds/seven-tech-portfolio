import { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { useSelector, useDispatch } from 'react-redux';

import { getClient } from '../controllers/clientSlice';
import { createTheProblem } from '../controllers/theProblemSlice';

function TheProblemComponent() {
  const dispatch = useDispatch();
  const navigate = useNavigate();

  const [messageType, setMessageType] = useState('info');
  const [message, setMessage] = useState(
    'To come up with the best solution, we must first define the problem below.'
  );

  const { user_email, client_id } = useSelector((state) => state.client);

  const [formData, setFormData] = useState({
    customers_impacted: '',
    problem_affected: '',
    challenges: '',
    affected_operations: '',
    change_event: '',
    factors_contributed: '',
    patterns_trends: '',
    first_notice_date: '',
    recurring_issue: '',
    tried_solutions: '',
    tried_solutions_results: '',
    ideal_resolution: '',
  });

  useEffect(() => {
    if (user_email) {
      console.log(user_email);

      dispatch(getClient());
    }
  }, [user_email, dispatch]);

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value,
    });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    dispatch(createTheProblem(formData));
  };

  return (
    <>
      <h2 className="title">THE PROBLEM</h2>

      {message && (
        <div className={`status-bar card ${messageType}`}>
          <span>{message}</span>
        </div>
      )}

      <div className="card">
        <form className="the-problem" action="">
          <table>
            <tbody>
              <tr>
                <td>
                  <label htmlFor="">
                    How are the customers or clients of (your company or organization) impacted by this problem?
                  </label>
                  <textarea
                    name="customers_impacted"
                    onChange={handleInputChange}
                    value={formData.customers_impacted}></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    Who else is affected by this problem?
                  </label>
                  <textarea
                    name="problem_affected"
                    onChange={handleInputChange}
                    value={formData.problem_affected}></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    What are the key challenges (your company or organization) is encountering?
                  </label>
                  <textarea
                    name="challenges"
                    onChange={handleInputChange}
                    value={formData.challenges}></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    How has this problem affected (your company or organization) operations or outcomes?
                  </label>
                  <textarea
                    name="affected_operations"
                    onChange={handleInputChange}
                    value={formData.affected_operations}></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    What factors contributed to this issue?
                  </label>
                  <textarea
                    name="factors_contributed"
                    onChange={handleInputChange}
                    value={formData.factors_contributed}></textarea>
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
                    onChange={handleInputChange}
                    value={formData.change_event}></textarea>
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
                    className='input-date'
                    onChange={handleInputChange}
                    value={formData.first_notice_date}
                  />
                </td>
              </tr>
              <tr>
                <td>
                  <label for="recurring_issue">
                    Is this a recurring issue, or is it a one-time occurrence?
                  </label>
                  <div className="options-column">
                    <span className="option">
                      <input
                        type="radio"
                        id="recurring_issue_yes"
                        name="recurring_issue"
                        className="input-radio"
                        value={'yes'}
                        onChange={handleInputChange}
                        checked={formData.recurring_issue === 'yes'}
                      />
                      <label for="recurring_issue_yes">Yes</label>
                    </span>
                    <span className="option">
                      <input
                        type="radio"
                        id="recurring_issue_no"
                        name="recurring_issue"
                        className="input-radio"
                        value={'no'}
                        onChange={handleInputChange}
                        checked={formData.recurring_issue === 'no'}
                      />
                      <label for="recurring_issue_no">No</label>
                    </span>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    Have (your company or organization) identified any patterns or trends related to this
                    problem?
                  </label>
                  <textarea
                    name="patterns_trends"
                    onChange={handleInputChange}
                    value={formData.patterns_trends}></textarea>{' '}
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    Have (your company or organization) tried any solutions to address this issue?
                  </label>
                  <span className="option">
                    <input
                      type="radio"
                      id="tried_solutions_yes"
                      name="tried_solutions"
                      value="yes"
                      className="input-radio"
                      onChange={handleInputChange}
                      checked={formData.tried_solutions === 'yes'}
                    />
                    <label htmlFor="tried_solutions_yes">Yes</label>
                  </span>
                  <span className="option">
                    <input
                      type="radio"
                      id="tried_solutions_no"
                      name="tried_solutions"
                      value="no"
                      className="input-radio"
                      onChange={handleInputChange}
                      checked={formData.tried_solutions === 'no'}
                    />
                    <label htmlFor="tried_solutions_no">No</label>
                  </span>
                </td>
              </tr>
              {formData.tried_solutions === 'yes' && (
                <tr>
                  <td>
                    <label htmlFor="">What were the results?</label>
                    <textarea
                      name="tried_solutions_results"
                      onChange={handleInputChange}
                      value={formData.tried_solutions_results}></textarea>
                  </td>
                </tr>
              )}
              <tr>
                <td>
                  <label htmlFor="">
                    What would an ideal resolution to this problem look like for
                    (your company or organization)?
                  </label>
                  <textarea
                    name="ideal_resolution"
                    onChange={handleInputChange}
                    value={formData.ideal_resolution}></textarea>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>

      <button type="submit" onClick={handleSubmit}>
        <h3>SAVE</h3>
      </button>
    </>
  );
}

export default TheProblemComponent;
