import { lazy, Suspense } from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';

const LoadingComponent = lazy(() => import('./loading/LoadingComponent.jsx'));

const Portfolio = lazy(() => import('./views/Portfolio'));
const ProjectTypes = lazy(() => import('./views/ProjectTypes'));
const ProjectTags = lazy(() => import('./views/ProjectTags'));
const Project = lazy(() => import('./views/Project'));
const ProjectOnboarding = lazy(() => import('./views/ProjectOnboarding.jsx'));
const ProjectProblem = lazy(() => import('./views/ProjectProblem.jsx'));

function App() {
  return (
    <>
      <Router basename="/">
        <Suspense fallback={<LoadingComponent />}>
          <Routes>
            <Route
              path="project/problem/:project/"
              element={<ProjectProblem />}
            />
            <Route
              path="project/onboarding/"
              element={<ProjectOnboarding />}
            />
            <Route index path="/" element={<Portfolio />} />
            <Route path="portfolio" element={<Portfolio />} />
            <Route path="founder" element={<Portfolio />} />
            <Route path="projects/type/:type" element={<ProjectTypes />} />
            <Route path="projects/tag/:tag" element={<ProjectTags />} />
            <Route path="portfolio/:project" element={<Project />} />
          </Routes>
        </Suspense>
      </Router>
    </>
  );
}

export default App;
