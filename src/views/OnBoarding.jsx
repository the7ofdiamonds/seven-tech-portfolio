import { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { useSelector, useDispatch } from 'react-redux';

function OnBoardingComponent() {
  return (
    <>
      <h2 className="title">ON BOARDING</h2>

      <div className="card">
        <form action="">
          <table>
            <tbody>
              <tr>
                <td>
                  <label htmlFor="">
                    Does (your company or organization) have social media pages?
                  </label>
                  <input type="url" />
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    Does (your company or organization) have a logo?
                  </label>
                  <input type="url" />
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    Does (your company or organization) have colors?
                  </label>
                  <table>
                    <tbody>
                      <tr>
                        <td>
                          <label htmlFor="">Primary</label>
                          <input type="color" />
                        </td>
                        <td>
                          <label htmlFor="">Secondary</label>
                          <input type="color" />
                        </td>
                        <td>
                          <label htmlFor="">Tertiary</label>
                          <input type="color" />
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    How does (your company or organization) currently do
                    business?
                  </label>
                  <textarea />
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    What is the address to (your company or organization)
                    website?
                  </label>
                  <input type="url" />
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    What hosting service does (your company or organization)
                    currently use?
                  </label>
                  <input type="text" />
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    Is (your company or organization) satisfied with the
                    service?
                  </label>
                  <input type="text" />
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    What is the address to the brick & mortar location(s)?
                  </label>
                  <table>
                    <tr>
                      <td colSpan={2}>
                        <input type="text" placeholder="Street Adress" />
                      </td>
                      <td>
                        <input type="text" placeholder="Suite #" />
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <input type="text" placeholder="City" />
                      </td>
                      <td>
                        <input type="text" placeholder="State" />
                      </td>
                      <td>
                        <input type="text" placeholder="Zipcode" />
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    What does (your company or organization) do?
                  </label>
                  <textarea></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    Does (your company or organization) have a deadline it needs
                    to meet?
                  </label>
                  <input type="text" />
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    Does your company have a one-page or full business plan that
                    can be provided to define the problem?
                  </label>
                  <input type="url" />
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </>
  );
}

export default OnBoardingComponent;
