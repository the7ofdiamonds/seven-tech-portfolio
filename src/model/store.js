import { configureStore } from '@reduxjs/toolkit';
import { portfolioClientSlice } from '../controllers/clientSlice';
import { portfolioOnboardingSlice } from '../controllers/onboardingSlice';
import { portfolioProblemSlice } from '../controllers/problemSlice';
import { portfolioProjectSlice } from '../controllers/projectSlice';
import { portfolioSlice } from '../controllers/portfolioSlice';

const store = configureStore({
    reducer: {
        client: portfolioClientSlice.reducer,
        project: portfolioProjectSlice.reducer,
        portfolio: portfolioSlice.reducer,
        onboarding: portfolioOnboardingSlice.reducer,
        problem: portfolioProblemSlice.reducer
    }
});

export default store;