import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';

const initialState = {
  projectLoading: false,
  projectError: '',
  projectErrorMessage: '',
  projectStatusCode: '',
  id: '',
  title: '',
  description: '',
  currency: '',
  price: '',
  client_id: '',
  post_id: '',
  post_status: '',
  post_author: '',
  post_date: '',
  post_content: '',
  project_types: '',
  project_status: '',
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
  git_repo: '',
  delivery: '',
  delivery_gallery: '',
  delivery_check_list: '',
  onboarding: '',
  the_problem: '',
  project_team: '',
  project_types: '',
  skills: '',
  frameworks: '',
  technologies: ''
};

export const getProject = createAsyncThunk('portfolioProject/getProject', async (projectSlug) => {
  try {
    const response = await fetch(`/wp-json/seven-tech/portfolio/v1/projects/${projectSlug}`, {
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

export const getProjectByClientID = createAsyncThunk('portfolioProject/getProjectByClientID', async (client_id) => {
  try {

    const response = await fetch(`/wp-json/seven-tech/portfolio/v1/projects/client/${client_id}`, {
      method: 'POST',
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

export const portfolioProjectSlice = createSlice({
  name: 'portfolioProject',
  initialState,
  extraReducers: (builder) => {
    builder
      .addMatcher(isAnyOf(
        getProject.fulfilled,
        getProjectByClientID.fulfilled), (state, action) => {
          state.projectLoading = false
          state.projectErrorMessage = action.payload.errorMessage;
          state.projectStatusCode = action.payload.statusCode;
          state.id = action.payload.id;
          state.title = action.payload.title;
          state.description = action.payload.description;
          state.currency = action.payload.currency;
          state.price = action.payload.price;
          state.post_id = action.payload.post_id;
          state.client_id = action.payload.client_id;
          state.post_status = action.payload.post_status;
          state.post_author = action.payload.post_author;
          state.post_date = action.payload.post_date;
          state.post_content = action.payload.post_date;
          state.project_types = action.payload.project_types;
          state.project_status = action.payload.project_status;
          state.solution_gallery = action.payload.solution_gallery;
          state.project_versions = action.payload.project_versions_list;
          state.project_urls = action.payload.project_urls_list;
          state.project_details = action.payload.project_details_list;
          state.the_solution = action.payload.the_solution;
          state.social_networks = action.payload.social_networks;
          state.app_stores = action.payload.app_stores;
          state.design = action.payload.design;
          state.design_gallery = action.payload.design_gallery;
          state.design_check_list = action.payload.design_check_list;
          state.colors = action.payload.colors_list;
          state.logos_gallery = action.payload.logos_gallery;
          state.icons_gallery = action.payload.icons_gallery;
          state.animations_gallery = action.payload.animations_gallery;
          state.uml_diagrams_gallery = action.payload.uml_diagrams_gallery;
          state.development = action.payload.development;
          state.development_gallery = action.payload.development_gallery;
          state.development_check_list = action.payload.development_check_list;
          state.git_repo = action.payload.git_repo;
          state.delivery = action.payload.delivery;
          state.delivery_gallery = action.payload.delivery_gallery;
          state.delivery_check_list = action.payload.delivery_check_list;
          state.onboarding = action.payload.onboarding;
          state.the_problem = action.payload.the_problem;
          state.project_team = action.payload.project_team_list;
          state.project_types = action.payload.project_types;
          state.skills = action.payload.skills;
          state.frameworks = action.payload.frameworks;
          state.technologies = action.payload.technologies;

        })
      .addMatcher(isAnyOf(
        getProject.pending,
        getProjectByClientID.pending), (state) => {
          state.projectLoading = true;
          state.projectError = '';
          state.projectErrorMessage = '';
          state.projectStatusCode = '';
        })
      .addMatcher(isAnyOf(
        getProject.rejected,
        getProjectByClientID.rejected), (state, action) => {
          state.projectLoading = false;
          state.projectError = action.error;
          state.projectErrorMessage = action.error.message;
          state.projectStatusCode = action.error.code;
        })
  }
})


export default portfolioProjectSlice;