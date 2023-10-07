function ProjectTeam(props) {
  const { project_team } = props;
  console.log(project_team);
  return (
    <>
      <div className="project-team">
        <h4 className="title">Project Team</h4>
        {Array.isArray(project_team) && project_team.length > 0
          ? project_team.map((team_member, index) => (
              <div key={index} class="author-card card">
                <div className="author-pic">
                  <a href={team_member.author_url}>
                    <img src={team_member.avatar_url} alt="" />
                  </a>
                </div>

                <div class="author-name">
                  <h4 className="title">
                    {team_member.first_name} {team_member.last_name}
                  </h4>
                </div>

                <div class="author-role">
                  <h5>{team_member.role}</h5>
                </div>

                <div class="author-contact">
                  <a href={`mailto:${team_member.email}`}>
                    <i className="fa fa-envelope fa-fw"></i>
                  </a>
                </div>
              </div>
            ))
          : 'No Team Members have been assigned to this project yet.'}
      </div>
    </>
  );
}

export default ProjectTeam;
