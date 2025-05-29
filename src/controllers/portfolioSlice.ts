import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';

import {
  getProjectData,
  getRepo,
  getRepoLanguages,
} from '@the7ofdiamonds/github-portfolio';

import {
  GitHubRepoQuery,
  Portfolio,
  PortfolioObject,
  Project,
  ProjectObject,
  Repo,
  Repos,
} from '@the7ofdiamonds/github-portfolio';

export interface PortfolioState {
  portfolioLoading: boolean;
  portfolioError: Error | null;
  portfolioErrorMessage: string | null;
  portfolioObject: PortfolioObject | null;
  organizationPortfolioObject: PortfolioObject | null;
  projects: Array<ProjectObject> | null;
}

const initialState: PortfolioState = {
  portfolioLoading: false,
  portfolioError: null,
  portfolioErrorMessage: null,
  portfolioObject: null,
  organizationPortfolioObject: null,
  projects: null,
};

export const getPortfolio = createAsyncThunk(
  'portfolio/getPortfolio',
  async () => {
    try {
      const response = await fetch(
        `/wp-json/seven-tech/portfolio/v1/projects`,
        {
          method: 'GET',
          headers: {
            'Content-Type': 'application/json',
          },
        }
      );

      const responseData = await response.json();

      return responseData;
    } catch (error) {
      const err = error as Error;
      console.error(err);
      throw new Error(err.message);
    }
  }
);

export const getPortfolioProjectsByUser = createAsyncThunk(
  'portfolio/getPortfolioProjectsByUser',
  async (nicename) => {
    try {
      const response = await fetch(
        `/wp-json/seven-tech/portfolio/v1/projects/user/${nicename}`,
        {
          method: 'GET',
          headers: {
            'Content-Type': 'application/json',
          },
        }
      );

      const responseData = await response.json();

      return responseData;
    } catch (error) {
      const err = error as Error;
      console.error(err);
      throw new Error(err.message);
    }
  }
);

export const getPortfolioProjectsByTaxonomy = createAsyncThunk(
  'portfolio/getPortfolioProjectsByTaxonomy',
  async (taxonomy) => {
    try {
      const response = await fetch(
        `/wp-json/seven-tech/portfolio/v1/projects/taxonomies/${taxonomy}`,
        {
          method: 'GET',
          headers: {
            'Content-Type': 'application/json',
          },
        }
      );

      const responseData = await response.json();

      return responseData;
    } catch (error) {
      const err = error as Error;
      console.error(err);
      throw new Error(err.message);
    }
  }
);

export const getPortfolioProjectsWithTerm = createAsyncThunk(
  'portfolio/getPortfolioProjectsWithTerm',
  async ({ taxonomy, term }) => {
    try {
      const response = await fetch(
        `/wp-json/seven-tech/portfolio/v1/projects/taxonomies/${taxonomy}`,
        {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            term: term,
          }),
        }
      );

      const responseData = await response.json();

      return responseData;
    } catch (error) {
      const err = error as Error;
      console.error(err);
      throw new Error(err.message);
    }
  }
);

const portfolioSlice = createSlice({
  name: 'portfolio',
  initialState,
  reducers: {},
  extraReducers: (builder) => {
    builder
      .addMatcher(
        isAnyOf(
          getPortfolio.fulfilled,
          getPortfolioProjectsByUser.fulfilled,
          getPortfolioProjectsByTaxonomy.fulfilled,
          getPortfolioProjectsWithTerm.fulfilled
        ),
        (state, action) => {
          state.portfolioLoading = false;
          state.portfolioError = null;
          state.portfolioErrorMessage = action.payload.error_message;
          state.portfolioStatusCode = action.payload.status_code;
          state.portfolio = action.payload.portfolio;
        }
      )
      .addMatcher(
        isAnyOf(
          getPortfolio.pending,
          getPortfolioProjectsByUser.pending,
          getPortfolioProjectsByTaxonomy.pending,
          getPortfolioProjectsWithTerm.pending
        ),
        (state) => {
          state.portfolioLoading = true;
          state.portfolioError = null;
          state.portfolioErrorMessage = null;
          state.portfolioStatusCode = null;
        }
      )
      .addMatcher(
        isAnyOf(
          getPortfolio.rejected,
          getPortfolioProjectsByUser.rejected,
          getPortfolioProjectsByTaxonomy.rejected,
          getPortfolioProjectsWithTerm.rejected
        ),
        (state, action) => {
          state.portfolioLoading = false;
          state.portfolioError = action.error;
          state.portfolioErrorMessage = action.error.message;
          state.portfolioStatusCode = action.error.code;
        }
      );
  },
});

export default portfolioSlice;
