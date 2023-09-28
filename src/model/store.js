import { configureStore } from '@reduxjs/toolkit';
import { clientSlice } from '../controllers/clientSlice';
import { onboardingSlice } from '../controllers/onboardingSlice';
import { definingTheProblemSlice } from '../controllers/theProblemSlice';
import projectSlice from '../controllers/projectSlice';
import portfolioSlice from '../controllers/portfolio';

const store = configureStore({
    reducer: {
        client: clientSlice.reducer,
        project: projectSlice.reducer,
        portfolio: portfolioSlice.reducer,
        onboarding: onboardingSlice.reducer,
        theProblem: definingTheProblemSlice.reducer
    }
});

export default store;