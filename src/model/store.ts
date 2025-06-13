import { configureStore } from '@reduxjs/toolkit';

import {
  addSlice,
  messageSlice,
  projectSlice,
  portfolioSlice,
  taxonomiesSlice,
  userSlice,
  githubSlice,
  organizationSlice,
} from '@the7ofdiamonds/github-portfolio';

import { portfolioClientSlice } from '../controllers/clientSlice';
import { projectOnboardingSlice } from '../controllers/projectOnboardingSlice';
import { projectProblemSlice } from '../controllers/projectProblemSlice';
import { postTypeSlice } from '../controllers/postTypeSlice';

const store = configureStore({
  reducer: {
    add: addSlice.reducer,
    client: portfolioClientSlice.reducer,
    github: githubSlice.reducer,
    message: messageSlice.reducer,
    project: projectSlice.reducer,
    portfolio: portfolioSlice.reducer,
    onboarding: projectOnboardingSlice.reducer,
    problem: projectProblemSlice.reducer,
    taxonomies: taxonomiesSlice.reducer,
    user: userSlice.reducer,
    postType: postTypeSlice.reducer,
    organization: organizationSlice.reducer,
  },
});

export default store;

export type RootState = ReturnType<typeof store.getState>;
export type AppDispatch = typeof store.dispatch;
