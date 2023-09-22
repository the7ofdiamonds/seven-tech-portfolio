import { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { useSelector, useDispatch } from 'react-redux';

function TheProblemComponent() {
  return (
    <>
      <h2 className="title">THE PROBLEM</h2>

      <div className="card">
        <form action="">
          <table>
            <tbody>
              <tr>
                <td>
                  <label htmlFor="">
                    How are customers or clients impacted by this problem?
                  </label>
                  <textarea></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    Who are the primary stakeholders in this issue?
                  </label>
                  <textarea></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    Who else is affected by this problem?
                  </label>
                  <textarea></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    What are the key challenges you're encountering?
                  </label>
                  <textarea></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    How has this problem affected your operations or outcomes?
                  </label>
                  <textarea></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    Has there been any significant change or event that
                    coincided with the problem's emergence?
                  </label>
                  <textarea></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    What factors contributed to this issue?
                  </label>
                  <textarea></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    Have you identified any patterns or trends related to this
                    problem?
                  </label>
                  <textarea></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    When did you first notice this problem?
                  </label>
                  <input type="date" />
                </td>
              </tr>
              <tr>
                <td>
                  <label for="recurringIssue">
                    Is this a recurring issue, or is it a one-time occurrence?
                  </label>
                  <input type="radio" name="affirmative" value="yes" />
                  <input type="radio" name="negative" value="no" />
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    Have you tried any solutions to address this issue? If so,
                    what were the results?
                  </label>
                  <textarea></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    What would an ideal resolution to this problem look like for
                    you?
                  </label>
                  <textarea></textarea>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </>
  );
}

export default TheProblemComponent;
