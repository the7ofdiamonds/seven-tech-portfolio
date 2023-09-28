import axios from 'axios';
import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';

const initialState = {
  loading: false,
  error: '',
  title: '',
  project_types: [],
  project_status: 25,
  the_problem: {},
  app_stores: [],
  project_author: '',
  project_tags: []
};

export const getProject = createAsyncThunk('project/projectSlice', async (projectSlug) => {
  try {
    const response = await axios.get(`/wp-json/thfw/v1/portfolio/${projectSlug}`);
    return response.data;
  } catch (error) {
    throw new Error(error.message);
  }
});

export const projectSlice = createSlice({
  name: 'project',
  initialState,
  extraReducers: (builder) => {
    builder
      .addCase(getProject.pending, (state) => {
        state.loading = true
        state.error = null
      })
      .addCase(getProject.fulfilled, (state, action) => {
        state.loading = false
        state.title = action.payload.title;
        state.post_status = action.payload.post_status;
        state.post_author = action.payload.post_author;
        state.post_date = action.payload.post_date;
        state.post_content = action.payload.post_date;
        state.project_types = action.payload.categories;
        state.project_status = action.payload.project_status;
        state.urls = action.payload.urls;
        state.app_stores = action.payload.app_stores;
        state.the_problem = action.payload.the_problem;
        state.design = action.payload.design;
        state.design_check_list = action.payload.design_check_list;
        state.colors = action.payload.colors;
        state.logos = action.payload.logos;
        state.icons = action.payload.icons;
        state.diagrams = action.payload.diagrams;
        state.development = action.payload.development;
        state.development_check_list = action.payload.development_check_list;
        state.delivery = action.payload.delivery;
        state.delivery_check_list = action.payload.delivery_check_list;
        state.social_networks = action.payload.social_networks;
        
        state.project_author = action.payload.project_author;
        state.project_tags = action.payload.project_tags;
      })
      .addCase(getProject.rejected, (state, action) => {
        state.loading = false
        state.error = action.error.message
      })
  }
})


export default projectSlice;