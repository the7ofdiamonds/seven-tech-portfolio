import { configureStore } from '@reduxjs/toolkit';
import { clientSlice } from '../controllers/clientSlice';
import { onboardingSlice } from '../controllers/onboardingSlice';
import { definingTheProblemSlice } from '../controllers/theProblemSlice';

const store = configureStore({
    reducer: {
        client: clientSlice.reducer,
        onboarding: onboardingSlice.reducer,
        definingTheProblem: definingTheProblemSlice.reducer
    }
});

export default store;