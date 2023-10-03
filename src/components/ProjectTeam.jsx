function ProjectTeam(props) {
  const { project_team } = props;

  return (
    <>
      <div className="project-team">
        <h4 className="title">Project Team</h4>
        {/* Add author of this page to top */}
        {Array.isArray(project_team) && project_team.length > 0
          ? project_team.map((team_member, index) => (
              <div key={index} class="author-card card">
                <div class="left">
                  <div class="author-pic">
                    <div className="author-pic">
                      <a href={team_member.author_url}>
                        <div
                          dangerouslySetInnerHTML={{
                            __html: team_member.avatar_url,
                          }}
                        />
                      </a>
                    </div>
                  </div>

                  <div class="author-name">
                    <h3>
                      {team_member.first_name} {team_member.last_name}
                    </h3>
                  </div>

                  <div class="author-role">
                    <h4>{team_member.roles}</h4>
                  </div>
                </div>

                <div class="right">
                  <div class="author-bio">
                    <p>{team_member.bio}</p>
                  </div>

                  <div class="author-contact">
                    <button
                      onClick={() =>
                        window.open(`mailto:${team_member.email}`)
                      }>
                      <h3>Hire {team_member.first_name}</h3>
                    </button>
                  </div>
                </div>
              </div>
            ))
          : 'No Team Members have been assigned to this project yet.'}
      </div>
    </>
  );
}

export default ProjectTeam;
