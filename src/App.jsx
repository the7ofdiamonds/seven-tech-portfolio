import { lazy, Suspense } from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';

const Portfolio = lazy(() => import('./views/Portfolio'));
const ProjectTypesPage = lazy(() => import('./views/ProjectTypes'));
const ProjectTagsPage = lazy(() => import('./views/ProjectTags'));
const Project = lazy(() => import('./views/Project'));
const OnBoardingComponent = lazy(() => import('./views/OnBoarding.jsx'));
const TheProblemComponent = lazy(() => import('./views/TheProblem.jsx'));

function LoadingFallback() {
  return <div>Loading...</div>;
}

function App() {
  return (
    <>
      <Router basename="/">
        <Suspense fallback={<LoadingFallback />}>
          <Routes>
            <Route
              path="services/service/on-boarding/the-problem"
              element={<TheProblemComponent />}
            />
            <Route
              index
              path="services/service/on-boarding"
              element={<OnBoardingComponent />}
            />
            <Route index path="/" element={<Portfolio />} />
            <Route path="portfolio" element={<Portfolio />} />
            <Route path="founder" element={<Portfolio />} />
            <Route path="projects/type/:type" element={<ProjectTypesPage />} />
            <Route path="projects/tag/:tag" element={<ProjectTagsPage />} />
            <Route path="portfolio/:project" element={<Project />} />
          </Routes>
        </Suspense>
      </Router>
    </>
  );
}

export default App;
