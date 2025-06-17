import {
  createSlice,
  createAsyncThunk,
  isAnyOf,
  CreateSliceOptions,
} from '@reduxjs/toolkit';

import {
  ProjectProblem,
  ProjectProblemObject,
} from '@the7ofdiamonds/github-portfolio';

export type ProjectProblemState = {
  problemLoading: boolean;
  problemSuccessMessage: string | null;
  problemErrorMessage: string | null;
  problemError: Error | null;
  projectProblemObject: ProjectProblemObject | null;
  problemID: string | null;
};

const initialState: ProjectProblemState = {
  problemLoading: false,
  problemSuccessMessage: null,
  problemErrorMessage: null,
  problemError: null,
  projectProblemObject: null,
  problemID: null,
};

export const createProjectProblem = createAsyncThunk(
  'projectProblem/createProjectProblem',
  async (projectProblem: ProjectProblem) => {
    try {
      const response = await fetch(
        `/wp-json/seven-tech/portfolio/v1/project/problem`,
        {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(projectProblem.toProjectProblemObject()),
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

export const getProjectProblem = createAsyncThunk(
  'projectProblem/getProjectProblem',
  async (problemID: string) => {
    try {
      const response = await fetch(
        `/wp-json/seven-tech/portfolio/v1/project/problem/${problemID}`,
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

export const updateProjectProblem = createAsyncThunk(
  'projectProblem/updateProjectProblem',
  async (projectProblem: ProjectProblem) => {
    try {
      const response = await fetch(
        `/wp-json/seven-tech/portfolio/v1/project/problem/${projectProblem.id}`,
        {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(projectProblem.toProjectProblemObject()),
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

const projectProblemOptions: CreateSliceOptions<ProjectProblemState> = {
  name: 'projectProblem',
  initialState,
  reducers: {},
  extraReducers: (builder) => {
    builder
      .addCase(createProjectProblem.fulfilled, (state, action) => {
        state.problemLoading = false;
        state.problemID = action.payload.id;
        state.problemSuccessMessage = action.payload.success_message;
      })
      .addCase(getProjectProblem.fulfilled, (state, action) => {
        state.problemLoading = false;
        state.projectProblemObject = action.payload;
      })
      .addCase(updateProjectProblem.fulfilled, (state, action) => {
        state.problemLoading = false;
        state.problemSuccessMessage = action.payload.success_message;
      })
      .addMatcher(
        isAnyOf(
          createProjectProblem.pending,
          getProjectProblem.pending,
          updateProjectProblem.pending
        ),
        (state) => {
          state.problemLoading = true;
          state.problemError = null;
        }
      )
      .addMatcher(
        isAnyOf(
          createProjectProblem.rejected,
          getProjectProblem.rejected,
          updateProjectProblem.rejected
        ),
        (state, action) => {
          state.problemLoading = false;
          state.problemError = action.error as Error;
        }
      );
  },
};

export const projectProblemSlice = createSlice(projectProblemOptions);

export default projectProblemSlice;
