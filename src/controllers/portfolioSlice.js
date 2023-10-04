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

export const getProjectTypes = createAsyncThunk('portfolio/getProjectTypes', async () => {
  try {
    const response = await axios.get(`/wp-json/thfw/v1/project/types`);
    return response.data;
  } catch (error) {
    throw new Error(error.message);
  }
});

export const getProjectTags = createAsyncThunk('portfolio/getProjectTags', async () => {
  try {
    const response = await axios.get(`/wp-json/thfw/v1/project/tags`);
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
      .addCase(getProjectTypes.pending, (state) => {
        state.loading = true
        state.error = null
      })
      .addCase(getProjectTypes.fulfilled, (state, action) => {
        state.loading = false
        state.project_types = action.payload;
      })
      .addCase(getProjectTypes.rejected, (state, action) => {
        state.loading = false
        state.error = action.error.message
      })
      .addCase(getProjectTags.pending, (state) => {
        state.loading = true
        state.error = null
      })
      .addCase(getProjectTags.fulfilled, (state, action) => {
        state.loading = false
        state.project_tags = action.payload;
      })
      .addCase(getProjectTags.rejected, (state, action) => {
        state.loading = false
        state.error = action.error.message
      })
  }
})

export default portfolioSlice;
