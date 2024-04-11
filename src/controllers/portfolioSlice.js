import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';

const initialState = {
  portfolioLoading: false,
  portfolioError: '',
  portfolioErrorMessage: '',
  portfolioStatusCode: '',
  title: '',
  projects: '',
  project_types: '',
  project_tags: '',
};

export const getPortfolio = createAsyncThunk('portfolio/getPortfolio', async () => {
  try {
    const response = await fetch(`/wp-json/seven-tech/portfolio/v1/portfolio`, {
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

export const getProjectsType = createAsyncThunk('portfolio/getProjectsType', async (projectType) => {
  try {
    const response = await fetch(`/wp-json/seven-tech/portfolio/v1/projects/type/${projectType}`, {
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

export const getProjectsTag = createAsyncThunk('portfolio/getProjectsTag', async (projectTag) => {
  try {
    const response = await fetch(`/wp-json/seven-tech/portfolio/v1/projects/tag/${projectTag}`, {
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

export const getPortfolioTypes = createAsyncThunk('portfolio/getPortfolioTypes', async () => {
  try {
    const response = await fetch(`/wp-json/seven-tech/portfolio/v1/portfolio/types`, {
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

export const getPortfolioTags = createAsyncThunk('portfolio/getPortfolioTags', async () => {
  try {
    const response = await fetch(`/wp-json/seven-tech/portfolio/v1/portfolio/tags`, {
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

export const portfolioSlice = createSlice({
  name: 'portfolio',
  initialState,
  extraReducers: (builder) => {
    builder
      .addCase(getPortfolio.fulfilled, (state, action) => {
        state.portfolioLoading = false;
        state.portfolioError = '';
        state.portfolioErrorMessage = action.payload.errorMessage;
        state.portfolioStatusCode = action.payload.statusCode;
        state.projects = action.payload.projects;
      })
      .addCase(getProjectsType.fulfilled, (state, action) => {
        state.portfolioLoading = false;
        state.portfolioError = '';
        state.portfolioErrorMessage = action.payload.errorMessage;
        state.portfolioStatusCode = action.payload.statusCode;
        state.projects = action.payload;
      })
      .addCase(getProjectsTag.fulfilled, (state, action) => {
        state.portfolioLoading = false;
        state.portfolioError = '';
        state.portfolioErrorMessage = action.payload.errorMessage;
        state.portfolioStatusCode = action.payload.statusCode;
        state.projects = action.payload;
      })
      .addCase(getPortfolioTypes.fulfilled, (state, action) => {
        state.portfolioLoading = false;
        state.portfolioError = '';
        state.portfolioErrorMessage = action.payload.errorMessage;
        state.portfolioStatusCode = action.payload.statusCode;
        state.project_types = action.payload;
      })
      .addCase(getPortfolioTags.fulfilled, (state, action) => {
        state.portfolioLoading = false;
        state.portfolioError = '';
        state.portfolioErrorMessage = action.payload.errorMessage;
        state.portfolioStatusCode = action.payload.statusCode;
        state.project_tags = action.payload;
      })
      .addMatcher(isAnyOf(
        getPortfolio.pending,
        getProjectsType.pending,
        getProjectsTag.pending,
        getPortfolioTypes.pending,
        getPortfolioTags.pending), (state) => {
          state.portfolioLoading = true;
          state.portfolioError = '';
          state.portfolioErrorMessage = '';
          state.portfolioStatusCode = '';
        })
      .addMatcher(isAnyOf(
        getPortfolio.rejected,
        getProjectsType.rejected,
        getProjectsTag.rejected,
        getPortfolioTypes.rejected,
        getPortfolioTags.rejected), (state, action) => {
          state.portfolioLoading = false;
          state.portfolioError = action.error;
          state.portfolioErrorMessage = action.error.message;
          state.portfolioStatusCode = action.error.code;
        })
  }
})

export default portfolioSlice;
