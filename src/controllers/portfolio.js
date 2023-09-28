import axios from 'axios';
import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';

const initialState = {
    loading: false,
    error: '',
    title: '',
};

export const getPortfolio = createAsyncThunk('portfolio/portfolioSlice', async () => {
    try {
      const response = await axios.get(`/wp-json/thfw/v1/portfolio`);
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
          state.title = action.payload.title;
        })
        .addCase(getPortfolio.rejected, (state, action) => {
          state.loading = false
          state.error = action.error.message
        })
    }
  })
  
  
  export default portfolioSlice;