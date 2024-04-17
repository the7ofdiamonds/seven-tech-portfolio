import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';

const initialState = {
  taxonomiesLoading: false,
  taxonomiesError: '',
  taxonomiesErrorMessage: '',
  taxonomiesStatusCode: '',
  projects: '',
  types: '',
  tags: '',
};

export const getProjectTypes = createAsyncThunk('taxonomies/getProjectTypes', async () => {
  try {
    const response = await fetch(`/wp-json/seven-tech/portfolio/v1/taxonomies/project/types`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json'
      }
    });

    const responseData = await response.json();
    
    return responseData;
  } catch (error) {
    console.error(error);
    throw new Error(error.message);
  }
});

export const getProjectTags = createAsyncThunk('taxonomies/getProjectTags', async () => {
  try {
    const response = await fetch(`/wp-json/seven-tech/portfolio/v1/taxonomies/project/tags`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json'
      }
    });

    const responseData = await response.json();

    return responseData;
  } catch (error) {
    console.error(error);
    throw new Error(error.message);
  }
});

export const getProjectType = createAsyncThunk('taxonomies/getProjectType', async (projectType) => {
  try {
    const response = await fetch(`/wp-json/seven-tech/portfolio/v1/taxonomies/project/type/${projectType}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json'
      }
    });

    const responseData = await response.json();
    
    return responseData;
  } catch (error) {
    console.error(error);
    throw new Error(error.message);
  }
});

export const getProjectTag = createAsyncThunk('taxonomies/getProjectTag', async (projectTag) => {
  try {
    const response = await fetch(`/wp-json/seven-tech/portfolio/v1/taxonomies/project/tag/${projectTag}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json'
      }
    });

    const responseData = await response.json();

    return responseData;
  } catch (error) {
    console.error(error);
    throw new Error(error.message);
  }
});

export const taxonomiesSlice = createSlice({
  name: 'taxonomies',
  initialState,
  extraReducers: (builder) => {
    builder
      .addCase(getProjectTypes.fulfilled, (state, action) => {
        state.taxonomiesLoading = false;
        state.taxonomiesError = '';
        state.taxonomiesErrorMessage = action.payload.errorMessage;
        state.taxonomiesStatusCode = action.payload.statusCode;
        state.types = action.payload;
      })
      .addCase(getProjectTags.fulfilled, (state, action) => {
        state.taxonomiesLoading = false;
        state.taxonomiesError = '';
        state.taxonomiesErrorMessage = action.payload.errorMessage;
        state.taxonomiesStatusCode = action.payload.statusCode;
        state.tags = action.payload;
      })
      .addCase(getProjectType.fulfilled, (state, action) => {
        state.taxonomiesLoading = false;
        state.taxonomiesError = '';
        state.taxonomiesErrorMessage = action.payload.errorMessage;
        state.taxonomiesStatusCode = action.payload.statusCode;
        state.icon = action.payload.icon
        state.title = action.payload.title;
        state.projects = action.payload.projects;
      })
      .addCase(getProjectTag.fulfilled, (state, action) => {
        state.taxonomiesLoading = false;
        state.taxonomiesError = '';
        state.taxonomiesErrorMessage = action.payload.errorMessage;
        state.taxonomiesStatusCode = action.payload.statusCode;
        state.icon = action.payload.icon
        state.title = action.payload.title;
        state.projects = action.payload.projects;
      })
      .addMatcher(isAnyOf(
        getProjectTypes.pending,
        getProjectTags.pending,
        getProjectType.pending,
        getProjectTag.pending), (state) => {
          state.taxonomiesLoading = true;
          state.taxonomiesError = '';
          state.taxonomiesErrorMessage = '';
          state.taxonomiesStatusCode = '';
        })
      .addMatcher(isAnyOf(
        getProjectTypes.rejected,
        getProjectTags.rejected,
        getProjectType.rejected,
        getProjectTag.rejected), (state, action) => {
          state.taxonomiesLoading = false;
          state.taxonomiesError = action.error;
          state.taxonomiesErrorMessage = action.error.message;
          state.taxonomiesStatusCode = action.error.code;
        })
  }
})

export default taxonomiesSlice;
