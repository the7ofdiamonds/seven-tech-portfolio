import axios from 'axios';
import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';

const initialState = {
  loading: false,
  error: '',
  title: '',
  projects: '',
  project_types: '',
  project_tags: '',
};

export const getPortfolio = createAsyncThunk('portfolio/getPortfolio', async () => {
  try {
    const response = await axios.get(`/wp-json/thfw/v1/portfolio`);
    return response.data;
  } catch (error) {
    throw new Error(error.message);
  }
});

export const getProjectsType = createAsyncThunk('portfolio/getProjectsType', async (projectType) => {
  try {
    const response = await axios.get(`/wp-json/thfw/v1/projects/type/${projectType}`);
   
    console.log(response.data);
    return response.data;
  } catch (error) {
    throw new Error(error.message);
  }
});

export const getProjectsTag = createAsyncThunk('portfolio/getProjectsTag', async (projectTag) => {
  try {
    const response = await axios.get(`/wp-json/thfw/v1/projects/tag/${projectTag}`);
    return response.data;
  } catch (error) {
    throw new Error(error.message);
  }
});

export const getPortfolioTypes = createAsyncThunk('portfolio/getPortfolioTypes', async () => {
  try {
    const response = await axios.get(`/wp-json/thfw/v1/portfolio/types`);
    return response.data;
  } catch (error) {
    throw new Error(error.message);
  }
});

export const getPortfolioTags = createAsyncThunk('portfolio/getPortfolioTags', async () => {
  try {
    const response = await axios.get(`/wp-json/thfw/v1/portfolio/tags`);
    return response.data;
  } catch (error) {
    throw new Error(error.message);
  }
});

export const portfolioSlice = createSlice({
  name: 'portfolio',
  initialState,
  extraReducers: (builder) => {
    builder
      .addCase(getPortfolio.pending, (state) => {
        state.loading = true
        state.error = null
      })
      .addCase(getPortfolio.fulfilled, (state, action) => {
        state.loading = false
        state.projects = action.payload;
      })
      .addCase(getPortfolio.rejected, (state, action) => {
        state.loading = false
        state.error = action.error.message
      })
      .addCase(getProjectsType.pending, (state) => {
        state.loading = true
        state.error = null
      })
      .addCase(getProjectsType.fulfilled, (state, action) => {
        state.loading = false
        state.projects = action.payload;
      })
      .addCase(getProjectsType.rejected, (state, action) => {
        state.loading = false
        state.error = action.error.message
      })
      .addCase(getProjectsTag.pending, (state) => {
        state.loading = true
        state.error = null
      })
      .addCase(getProjectsTag.fulfilled, (state, action) => {
        state.loading = false
        state.projects = action.payload;
      })
      .addCase(getProjectsTag.rejected, (state, action) => {
        state.loading = false
        state.error = action.error.message
      })
      .addCase(getPortfolioTypes.pending, (state) => {
        state.loading = true
        state.error = null
      })
      .addCase(getPortfolioTypes.fulfilled, (state, action) => {
        state.loading = false
        state.project_types = action.payload;
      })
      .addCase(getPortfolioTypes.rejected, (state, action) => {
        state.loading = false
        state.error = action.error.message
      })
      .addCase(getPortfolioTags.pending, (state) => {
        state.loading = true
        state.error = null
      })
      .addCase(getPortfolioTags.fulfilled, (state, action) => {
        state.loading = false
        state.project_tags = action.payload;
      })
      .addCase(getPortfolioTags.rejected, (state, action) => {
        state.loading = false
        state.error = action.error.message
      })
  }
})

export default portfolioSlice;
