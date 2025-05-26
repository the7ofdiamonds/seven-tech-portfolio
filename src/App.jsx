import { lazy, Suspense } from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';

const LoadingComponent = lazy(() =>
  import('./views/components/global/LoadingComponent.jsx')
);

const Dashboard = lazy(() => import('./views/Dashboard.jsx'));
const AddSkill = lazy(() => import('./views/SkillAdd.jsx'));
const ProjectsEdit = lazy(() => import('./views/ProjectsEdit.jsx'));
const ProjectUpdate = lazy(() => import('./views/ProjectUpdate.jsx'));

const Portfolio = lazy(() => import('./views/Portfolio.jsx'));
const Project = lazy(() => import('./views/Project.jsx'));

const ProjectOnboarding = lazy(() => import('./views/ProjectOnboarding.jsx'));
const ProjectProblem = lazy(() => import('./views/ProjectProblem.jsx'));

const User = lazy(() => import('./views/User.jsx'));

const ProjectType = lazy(() => import('./views/ProjectType.jsx'));
const ProjectTypes = lazy(() => import('./views/ProjectTypes.jsx'));
const Term = lazy(() => import('./views/Term.jsx'));
const Taxonomy = lazy(() => import('./views/Taxonomy.jsx'));

function App() {
  return (
    <>
      <Router basename="/">
        <Suspense fallback={<LoadingComponent />}>
          <Routes>
            <Route
              path="project/onboarding/:project/"
              element={<ProjectOnboarding />}
            />
            <Route path="project/onboarding/" element={<ProjectOnboarding />} />
            <Route
              path="project/problem/:project/"
              element={<ProjectProblem />}
            />
            <Route index path="/" element={<Portfolio />} />

            <Route path="dashboard" element={<Dashboard />} />
            <Route path="dashboard/add/skill" element={<AddSkill />} />
            <Route
              path="dashboard/projects/edit"
              element={<ProjectsEdit />}
            />
            <Route
              path="dashboard/update/project/:project"
              element={<ProjectUpdate />}
            />

            <Route path="portfolio" element={<Portfolio />} />
            <Route path="portfolio/:project" element={<Project />} />
            <Route path="founders/:user/" element={<User />} />
            <Route path="managing-members/:user/" element={<User />} />
            <Route path="investors/:user/" element={<User />} />
            <Route path="executives/:user/" element={<User />} />
            <Route path="freelancers/:user/" element={<User />} />
            <Route path="employees/:user/" element={<User />} />
            <Route
              path="project-types/:projectType"
              element={<ProjectType />}
            />
            <Route path="project-types" element={<ProjectTypes />} />
            <Route path="/frameworks/:term" element={<Term />} />
            <Route path="/frameworks" element={<Taxonomy />} />
            <Route path="/skills/:term" element={<Term />} />
            <Route path="/skills" element={<Taxonomy />} />
            <Route path="/technologies/:term" element={<Term />} />
            <Route path="/technologies" element={<Taxonomy />} />
          </Routes>
        </Suspense>
      </Router>
    </>
  );
}

export default App;
