function TheSolution(props) {
  const { the_solution } = props;
  
  return (
    <>
      <div className="project-solution" id="project_solution">
        <h3>THE SOLUTION</h3>

        <div className='card' dangerouslySetInnerHTML={{ __html: the_solution }}></div>
      </div>
    </>
  );
}

export default TheSolution;
