import axios from 'axios';
import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';

const initialState = {
  loading: false,
  error: '',
  id: '',
  title: '',
  post_status: '',
  post_author: '',
  post_date: '',
  post_content: '',
  project_types: '',
  project_status: 'not start yet',
  solution_gallery: '',
  project_versions: '',
  project_urls: '',
  project_details: '',
  the_solution: '',
  social_networks: '',
  app_stores: '',
  design: '',
  design_gallery: '',
  design_check_list: '',
  colors: '',
  logos_gallery: '',
  icons_gallery: '',
  animations_gallery: '',
  uml_diagrams_gallery: '',
  development: '',
  development_gallery: '',
  development_check_list: '',
  delivery: '',
  delivery_gallery: '',
  delivery_check_list: '',
  onboarding: '',
  the_problem: '',
  project_team: '',
  project_tags: '',
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
        state.id = action.payload.id;
        state.title = action.payload.title;
        state.post_status = action.payload.post_status;
        state.post_author = action.payload.post_author;
        state.post_date = action.payload.post_date;
        state.post_content = action.payload.post_date;
        state.project_types = action.payload.project_types;
        state.project_status = action.payload.project_status;
        state.solution_gallery = action.payload.solution_gallery;
        state.project_versions = action.payload.project_versions;
        state.project_urls = action.payload.project_urls;
        state.project_details = action.payload.project_details;
        state.the_solution = action.payload.the_solution;
        state.social_networks = action.payload.social_networks;
        state.app_stores = action.payload.app_stores;
        state.design = action.payload.design;
        state.design_gallery = action.payload.design_gallery;
        state.design_check_list = action.payload.design_check_list;
        state.colors = action.payload.colors;
        state.logos_gallery = action.payload.logos_gallery;
        state.icons_gallery = action.payload.icons_gallery;
        state.animations_gallery = action.payload.animations_gallery;
        state.uml_diagrams_gallery = action.payload.uml_diagrams_gallery;
        state.development = action.payload.development;
        state.development_gallery = action.payload.development_gallery;
        state.development_check_list = action.payload.development_check_list;
        state.delivery = action.payload.delivery;
        state.delivery_gallery = action.payload.delivery_gallery;
        state.delivery_check_list = action.payload.delivery_check_list;
        state.onboarding = action.payload.onboarding;
        state.the_problem = action.payload.the_problem;
        state.project_team = action.payload.project_team;
        state.project_tags = action.payload.project_tags;
      })
      .addCase(getProject.rejected, (state, action) => {
        state.loading = false
        state.error = action.error.message
      })
  }
})


export default projectSlice;