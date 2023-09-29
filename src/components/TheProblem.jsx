function TheProblem(props) {
  return (
    <>
      <div class="project-problem" id="project_problem">
        <h3>THE PROBLEM</h3>

        <p>{props.the_problem.customers_impacted}</p>
        <p>{props.the_problem.problem_affected}</p>
        <p>{props.the_problem.challenges}</p>
        <p>{props.the_problem.affected_operations}</p>
        <p>{props.the_problem.change_event}</p>
        <p>{props.the_problem.factors_contributed}</p>
        <p>{props.the_problem.patterns_trends}</p>
        <p>{props.the_problem.first_notice_date}</p>
        <p>{props.the_problem.recurring_issue}</p>
        <p>{props.the_problem.tried_solutions}</p>
        <p>{props.the_problem.tried_solutions_results}</p>
        <p>{props.the_problem.ideal_resolution}</p>
      </div>
    </>
  );
}

export default TheProblem;
