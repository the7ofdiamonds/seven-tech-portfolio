import {
  createSlice,
  createAsyncThunk,
  isAnyOf,
  CreateSliceOptions,
} from '@reduxjs/toolkit';

import {
  ProjectOnboarding,
  ProjectOnboardingObject,
} from '@the7ofdiamonds/github-portfolio';

export type ProjectOnboardingState = {
  onboardingLoading: boolean;
  onboardingSuccessMessage: string | null;
  onboardingErrorMessage: string | null;
  onboardingError: Error | null;
  projectOnboardingObject: ProjectOnboardingObject | null;
  onboardingID: string | null;
};

const initialState: ProjectOnboardingState = {
  onboardingLoading: false,
  onboardingSuccessMessage: null,
  onboardingErrorMessage: null,
  onboardingError: null,
  projectOnboardingObject: null,
  onboardingID: null,
};

export const createProjectOnboarding = createAsyncThunk(
  'projectOnboarding/createProjectOnboarding',
  async (projectOnboarding: ProjectOnboarding) => {
    try {
      const response = await fetch(
        `/wp-json/seven-tech/portfolio/v1/portfolio/onboarding`,
        {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(projectOnboarding.toProjectOnboardingObject()),
        }
      );

      if (!response.ok) {
        const errorData = await response.json();
        const errorMessage = errorData.message;
        throw new Error(errorMessage);
      }

      const responseData = await response.json();
      return responseData;
    } catch (error) {
      throw error;
    }
  }
);

export const getProjectOnboarding = createAsyncThunk(
  'projectOnboarding/getProjectOnboarding',
  async (onboardingID: string) => {
    try {
      const response = await fetch(
        `/wp-json/seven-tech/portfolio/v1/project/onboarding/${onboardingID}`,
        {
          method: 'GET',
          headers: {
            'Content-Type': 'application/json',
          },
        }
      );

      if (!response.ok) {
        const errorData = await response.json();
        const errorMessage = errorData.message;
        throw new Error(errorMessage);
      }

      const responseData = await response.json();
      return responseData;
    } catch (error) {
      throw error;
    }
  }
);

export const updateProjectOnboarding = createAsyncThunk(
  'projectOnboarding/updateProjectOnboarding',
  async (projectOnboarding: ProjectOnboarding) => {
    try {
      const response = await fetch(
        `/wp-json/seven-tech/portfolio/v1/project/onboarding/${projectOnboarding.id}`,
        {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(projectOnboarding.toProjectOnboardingObject()),
        }
      );

      if (!response.ok) {
        const errorData = await response.json();
        const errorMessage = errorData.message;
        throw new Error(errorMessage);
      }

      const responseData = await response.json();
      return responseData;
    } catch (error) {
      throw error;
    }
  }
);

const projectOnboardingOptions: CreateSliceOptions<ProjectOnboardingState> = {
  name: 'projectOnboarding',
  initialState,
  reducers: {},
  extraReducers: (builder) => {
    builder
      .addCase(createProjectOnboarding.fulfilled, (state, action) => {
        state.onboardingLoading = false;
        state.onboardingID = action.payload.id;
        state.onboardingSuccessMessage = action.payload.success_message;
      })
      .addCase(getProjectOnboarding.fulfilled, (state, action) => {
        state.onboardingLoading = false;
        state.projectOnboardingObject = action.payload;
      })
      .addCase(updateProjectOnboarding.fulfilled, (state, action) => {
        state.onboardingLoading = false;
        state.onboardingSuccessMessage = action.payload.success_message;
      })
      .addMatcher(
        isAnyOf(
          createProjectOnboarding.pending,
          getProjectOnboarding.pending,
          updateProjectOnboarding.pending
        ),
        (state) => {
          state.onboardingLoading = true;
          state.onboardingError = null;
        }
      )
      .addMatcher(
        isAnyOf(
          createProjectOnboarding.rejected,
          getProjectOnboarding.rejected,
          updateProjectOnboarding.rejected
        ),
        (state, action) => {
          state.onboardingLoading = false;
          state.onboardingError = action.error as Error;
        }
      );
  },
};

export const projectOnboardingSlice = createSlice(projectOnboardingOptions);

export default projectOnboardingSlice;
