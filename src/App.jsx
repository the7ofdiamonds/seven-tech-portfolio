import { lazy, Suspense } from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';

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
          </Routes>
        </Suspense>
      </Router>
    </>
  );
}

export default App;
