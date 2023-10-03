function TheProblem(props) {
  const { the_problem } = props;

  return (
    <>
      <div className="project-problem" id="project_problem">
        <h3>THE PROBLEM</h3>

        {the_problem.length > 0 ? (
          <div className="card">
            {the_problem.customers_impacted ? (
              <p>{the_problem.customers_impacted}</p>
            ) : (
              ''
            )}

            {the_problem.problem_affected ? (
              <p>{the_problem.problem_affected}</p>
            ) : (
              ''
            )}

            {the_problem.challenges ? <p>{the_problem.challenges}</p> : ''}

            {the_problem.affected_operations ? (
              <p>{the_problem.affected_operations}</p>
            ) : (
              ''
            )}

            {the_problem.change_event ? <p>{the_problem.change_event}</p> : ''}

            {the_problem.factors_contributed ? (
              <p>{the_problem.factors_contributed}</p>
            ) : (
              ''
            )}

            {the_problem.patterns_trends ? (
              <p>{the_problem.patterns_trends}</p>
            ) : (
              ''
            )}

            {the_problem.first_notice_date ? (
              <p>{the_problem.first_notice_date}</p>
            ) : (
              ''
            )}

            {the_problem.recurring_issue ? (
              <p>{the_problem.recurring_issue}</p>
            ) : (
              ''
            )}

            {the_problem.tried_solutions ? (
              <p>{the_problem.tried_solutions}</p>
            ) : (
              ''
            )}

            {the_problem.tried_solutions_results ? (
              <p>{the_problem.tried_solutions_results}</p>
            ) : (
              ''
            )}

            {the_problem.ideal_resolution ? (
              <p>{the_problem.ideal_resolution}</p>
            ) : (
              ''
            )}
          </div>
        ) : (
          ''
        )}
      </div>
    </>
  );
}

export default TheProblem;
