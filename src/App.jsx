import { lazy, Suspense } from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';

const LoadingComponent = lazy(() =>
  import('./views/components/global/LoadingComponent.jsx')
);

const Portfolio = lazy(() => import('./views/Portfolio.jsx'));
const ProjectType = lazy(() => import('./views/ProjectType.jsx'));
const ProjectTypes = lazy(() => import('./views/ProjectTypes.jsx'));
const Project = lazy(() => import('./views/Project.jsx'));
const ProjectOnboarding = lazy(() => import('./views/ProjectOnboarding.jsx'));
const ProjectProblem = lazy(() => import('./views/ProjectProblem.jsx'));

const User = lazy(() => import('./views/User.jsx'));

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
            <Route path="portfolio" element={<Portfolio />} />
            <Route path="project-types/:projectType" element={<ProjectType />} />
            <Route path="project-types" element={<ProjectTypes />} />
            <Route path="portfolio/:project" element={<Project />} />
            <Route path="founders/:user/" element={<User />} />
            <Route path="managing-members/:user/" element={<User />} />
            <Route path="investors/:user/" element={<User />} />
            <Route path="executives/:user/" element={<User />} />
            <Route path="freelancers/:user/" element={<User />} />
            <Route path="employees/:user/" element={<User />} />
          </Routes>
        </Suspense>
      </Router>
    </>
  );
}

export default App;
