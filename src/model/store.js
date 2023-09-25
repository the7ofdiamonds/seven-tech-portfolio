import { configureStore } from '@reduxjs/toolkit';
import { onboardingSlice } from '../controllers/onboardingSlice';
import { definingTheProblemSlice } from '../controllers/definingTheProblemSlice';

const store = configureStore({
    reducer: {
        onboarding: onboardingSlice.reducer,
        definingTheProblem: definingTheProblemSlice.reducer
    }
});

export default store;