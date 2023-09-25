import { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { useSelector, useDispatch } from 'react-redux';

function OnBoardingComponent() {
  return (
    <>
      <div className="card">
        <form className="on-boarding" action="">
          <table>
            <thead>
              <tr>
                <th>
                  <h3 className="title">Client Onboarding</h3>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <label htmlFor="">
                    Does (your company or organization) have a specific deadline
                    that it needs to meet? If Yes, provide it below.
                  </label>
                  <div className="options-column">
                    <span className="option">
                      <input
                        type="radio"
                        id="deadline_yes"
                        name="deadline"
                        value="YES"
                        className="input-radio"
                      />
                      <label for="deadline_yes">Yes</label>
                      <input type="date" />
                    </span>
                    <span className="option">
                      <input
                        type="radio"
                        id="deadline_no"
                        name="deadline"
                        value="NO"
                        className="input-radio"
                      />
                      <label for="deadline_yes">No</label>
                    </span>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    How does (your company or organization) currently do
                    business?
                  </label>
                  <div className="options-column">
                    <span className="option">
                      <input
                        type="radio"
                        id="where_business_online"
                        name="where_business"
                        value="online"
                        className="input-radio"
                      />
                      <label for="where_business_online">Online</label>
                    </span>
                    <span className="option">
                      <input
                        type="radio"
                        id="where_business_brick"
                        name="where_business"
                        value="brick/mortor"
                        className="input-radio"
                      />
                      <label for="where_business_brick">Brick & Mortar</label>
                    </span>
                    <span className="option">
                      <input
                        type="radio"
                        id="where_business_both"
                        name="where_business"
                        value="both"
                        className="input-radio"
                      />
                      <label for="where_business_brick">Both</label>
                    </span>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    Does (your company or organization) have a website? If Yes,
                    provide a link to it below.
                  </label>
                  <div className="options-column">
                    <span className="option">
                      <input
                        type="radio"
                        id="website_yes"
                        name="website"
                        value="yes"
                        className="input-radio"
                      />
                      <label for="website_yes">Yes</label>
                      <input type="url" />
                    </span>
                    <span className="option">
                      <input
                        type="radio"
                        id="website_no"
                        name="website"
                        value="no"
                        className="input-radio"
                      />
                      <label for="website_no">No</label>
                    </span>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    What hosting service does (your company or organization)
                    currently use?
                  </label>
                  <div className="options-column">
                    <span className="option">
                      <input
                        type="radio"
                        id="hosting_aws"
                        name="hosting"
                        value="aws"
                        className="input-radio"
                      />
                      <label for="hosting_aws">AWS</label>
                    </span>
                    <span className="option">
                      <input
                        type="radio"
                        id="hosting_azure"
                        name="hosting"
                        value="azure"
                        className="input-radio"
                      />
                      <label for="hosting_azure">Azure</label>
                    </span>
                    <span className="option">
                      <input
                        type="radio"
                        id="hosting_google"
                        name="hosting"
                        value="google"
                        className="input-radio"
                      />
                      <label for="hosting_google">Google</label>
                    </span>
                    <span className="option">
                      <input
                        type="radio"
                        id="hosting_godaddy"
                        name="hosting"
                        value="godaddy"
                        className="input-radio"
                      />
                      <label for="hosting_godaddy">GoDaddy</label>
                    </span>
                    <span className="option">
                      <input
                        type="radio"
                        id="hosting_other"
                        name="hosting"
                        value="other"
                        className="input-radio"
                      />
                      <label for="hosting_other">Other</label>
                      <input
                        type="text"
                        id="hosting_other"
                        name="hosting"
                        className="other"
                      />
                    </span>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    Is (your company or organization) satisfied with the
                    service?
                  </label>
                  <div className="options-column">
                    <span className="option">
                      <input
                        type="radio"
                        id="satisfied_yes"
                        name="satisfied"
                        value="yes"
                        className="input-radio"
                      />
                      <label for="satisfied_yes">Yes</label>
                    </span>
                    <span className="option">
                      <input
                        type="radio"
                        id="satisfied_no"
                        name="satisfied"
                        value="no"
                        className="input-radio"
                      />
                      <label for="satisfied_no">No</label>
                    </span>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    What is the address to the brick & mortar location(s) of
                    (your company or organization)?
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
                    Does your brick & mortar location(s) of (your company or
                    organization) have signage? If Yes, provide a link to a
                    picture of them below.
                  </label>
                  <div className="options-column">
                    <span className="option">
                      <input
                        type="radio"
                        id="signage_yes"
                        name="signage"
                        value="yes"
                        className="input-radio"
                      />
                      <label for="signage_yes">Yes</label>
                    </span>
                    <span className="option">
                      <input
                        type="radio"
                        id="signage_no"
                        name="signage"
                        value="no"
                        className="input-radio"
                      />
                      <label for="signage_no">No</label>
                    </span>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    Does (your company or organization) have social media pages?
                    If Yes, provide a link to them below.
                  </label>
                  <div className="options-column">
                    <span className="option">
                      <input
                        type="radio"
                        id="social_yes"
                        name="social"
                        value="yes"
                        className="input-radio"
                      />
                      <label for="social_yes">Yes</label>
                    </span>
                    <span className="option">
                      <input
                        type="radio"
                        id="social_no"
                        name="social"
                        value="no"
                        className="input-radio"
                      />
                      <label for="social_no">No</label>
                    </span>
                  </div>
                  <div className="options-column">
                    <span className="option">
                      <input type="checkbox" />
                      <label htmlFor="facebook">Facebook</label>
                      <input type="url" className="input-social" />
                    </span>
                    <span className="option">
                      <input type="checkbox" />
                      <label htmlFor="xtwitter">X</label>
                      <input type="url" className="input-social" />
                    </span>
                    <span className="option">
                      <input type="checkbox" />
                      <label htmlFor="linkedin">LinkedIn</label>
                      <input type="url" className="input-social" />
                    </span>
                    <span className="option">
                      <input type="checkbox" />
                      <label htmlFor="instagram">Instagram</label>
                      <input type="url" className="input-social" />
                    </span>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    Does (your company or organization) have a logo? If Yes,
                    provide a link to it below.
                  </label>
                  <div className="options-column">
                    <span className="option">
                      <input
                        type="radio"
                        id="logo_yes"
                        name="logo"
                        value="yes"
                        className="input-radio"
                      />
                      <label for="logo_yes">Yes</label>
                      <input type="url" />
                    </span>
                    <span className="option">
                      <input
                        type="radio"
                        id="logo_no"
                        name="logo"
                        value="no"
                        className="input-radio"
                      />
                      <label for="logo_no">No</label>
                    </span>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <label htmlFor="">
                    Does (your company or organization) have colors? If Yes,
                    provide them below.
                  </label>
                  <div className="options-column">
                    <span className="option">
                      <input
                        type="radio"
                        id="social_yes"
                        name="social"
                        value="yes"
                        className="input-radio"
                      />
                      <label for="social_yes">Yes</label>
                    </span>
                    <span className="option">
                      <input
                        type="radio"
                        id="social_no"
                        name="social"
                        value="no"
                        className="input-radio"
                      />
                      <label for="social_no">No</label>
                    </span>
                  </div>
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
                    Do you have a link to about page or executive summary of
                    (your company or organization)? If Yes, provide it below.
                  </label>
                  <div className="options-column">
                    <span className="option">
                      <input
                        type="radio"
                        id="summary_yes"
                        name="summary"
                        value="yes"
                        className="input-radio"
                      />
                      <label for="summary_yes">Yes</label>
                      <input type="url" />
                    </span>
                    <span className="option">
                      <input
                        type="radio"
                        id="summary_no"
                        name="summary"
                        value="no"
                        className="input-radio"
                      />
                      <label for="summary_no">No</label>
                    </span>
                  </div>
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
                    Does (your company or organization) have a one-page or full
                    business plan that can be provided to define the problem? If
                    Yes, provide a link to it below.
                  </label>
                  <div className="options-column">
                    <span className="option">
                      <input
                        type="radio"
                        id="plan_yes"
                        name="plan"
                        value="yes"
                        className="input-radio"
                      />
                      <label for="plan_yes">Yes</label>
                      <input type="url" />
                    </span>
                    <span className="option">
                      <input
                        type="radio"
                        id="plan_no"
                        name="plan"
                        value="no"
                        className="input-radio"
                      />
                      <label for="plan_no">No</label>
                    </span>
                  </div>
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
