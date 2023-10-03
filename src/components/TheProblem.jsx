import React from 'react';

function TheProblem(props) {
  const { the_problem } = props;

  return (
    <>
      {the_problem ? (
        <div className="project-problem" id="project_problem">
          <h3>THE PROBLEM</h3>

          <p>{the_problem.customers_impacted}</p>
          <p>{the_problem.problem_affected}</p>
          <p>{the_problem.challenges}</p>
          <p>{the_problem.affected_operations}</p>
          <p>{the_problem.change_event}</p>
          <p>{the_problem.factors_contributed}</p>
          <p>{the_problem.patterns_trends}</p>
          <p>{the_problem.first_notice_date}</p>
          <p>{the_problem.recurring_issue}</p>
          <p>{the_problem.tried_solutions}</p>
          <p>{the_problem.tried_solutions_results}</p>
          <p>{the_problem.ideal_resolution}</p>
        </div>
      ) : (
        ''
      )}
    </>
  );
}

export default TheProblem;
