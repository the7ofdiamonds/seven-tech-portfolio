import axios from 'axios';
import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';

const initialState = {
    loading: false,
    error: '',
    title: '',
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
        })
        .addCase(getProject.rejected, (state, action) => {
          state.loading = false
          state.error = action.error.message
        })
    }
  })
  
  
  export default projectSlice;