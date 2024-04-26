import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';

const initialState = {
  portfolioLoading: false,
  portfolioError: '',
  portfolioErrorMessage: '',
  portfolioStatusCode: '',
  projects: '',
};

export const getPortfolio = createAsyncThunk('portfolio/getPortfolio', async () => {
  try {
    const response = await fetch(`/wp-json/seven-tech/portfolio/v1/all`, {
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

export const getPortfolioProjectsByUser = createAsyncThunk('portfolio/getPortfolioProjectsByUser', async (nicename) => {
  try {
    const response = await fetch(`/wp-json/seven-tech/portfolio/v1/user/${nicename}`, {
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
      .addCase(getPortfolioProjectsByUser.fulfilled, (state, action) => {
        state.portfolioLoading = false;
        state.portfolioError = '';
        state.portfolioErrorMessage = action.payload.errorMessage;
        state.portfolioStatusCode = action.payload.statusCode;
        state.projects = action.payload.projects;
      })
      .addMatcher(isAnyOf(
        getPortfolio.pending), (state) => {
          state.portfolioLoading = true;
          state.portfolioError = '';
          state.portfolioErrorMessage = '';
          state.portfolioStatusCode = '';
        })
      .addMatcher(isAnyOf(
        getPortfolio.rejected), (state, action) => {
          state.portfolioLoading = false;
          state.portfolioError = action.error;
          state.portfolioErrorMessage = action.error.message;
          state.portfolioStatusCode = action.error.code;
        })
  }
})

export default portfolioSlice;
