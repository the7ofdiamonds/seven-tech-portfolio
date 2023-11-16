import { configureStore } from '@reduxjs/toolkit';
import { portfolioClientSlice } from '../controllers/clientSlice';
import { projectOnboardingSlice } from '../controllers/projectOnboardingSlice';
import { projectProblemSlice } from '../controllers/projectProblemSlice';
import { portfolioProjectSlice } from '../controllers/projectSlice';
import { portfolioSlice } from '../controllers/portfolioSlice';

const store = configureStore({
    reducer: {
        client: portfolioClientSlice.reducer,
        project: portfolioProjectSlice.reducer,
        portfolio: portfolioSlice.reducer,
        onboarding: projectOnboardingSlice.reducer,
        problem: projectProblemSlice.reducer
    }
});

export default store;