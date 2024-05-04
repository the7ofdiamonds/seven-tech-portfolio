import { lazy, Suspense } from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';

const LoadingComponent = lazy(() =>
  import('./views/components/global/LoadingComponent.jsx')
);

const Portfolio = lazy(() => import('./views/Portfolio'));
const ProjectTypes = lazy(() => import('./views/ProjectTypes'));
const ProjectTags = lazy(() => import('./views/ProjectTags'));
const Project = lazy(() => import('./views/Project'));
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
            <Route path="project/type/:type" element={<ProjectTypes />} />
            <Route path="project/tag/:tag" element={<ProjectTags />} />
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
