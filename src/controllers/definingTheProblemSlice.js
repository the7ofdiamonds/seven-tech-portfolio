import axios from 'axios';
import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';

const initialState = {
    loading: false,
    error: '',
    the_problem_id: ''
};

export const createTheProblem = createAsyncThunk('definingTheProblem/createTheProblem', async (formData) => {
    try {
        const response = await fetch('/wp-json/thfw/v1/users/client/problem', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        });

        if (!response.ok) {
            const errorData = await response.json();
            const errorMessage = errorData.message;
            throw new Error(errorMessage);
        }

        const responseData = await response.json();
        return responseData;
    } catch (error) {
        console.log(error)
        throw error.message;
    }
});

export const getClient = createAsyncThunk('client/getClient', async (_, { getState }) => {
    const { user_email } = getState().client;
    const encodedEmail = encodeURIComponent(user_email);

    try {
        const response = await fetch(`/wp-json/orb/v1/users/client/${encodedEmail}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        });

        if (!response.ok) {
            const errorData = await response.json();
            const errorMessage = errorData.message;
            throw new Error(errorMessage);
        }

        const responseData = await response.json();
        return responseData;
    } catch (error) {
        console.log(error)
        throw error.message;
    }
});

export const definingTheProblemSlice = createSlice({
    name: 'definingTheProblem',
    initialState,
    extraReducers: (builder) => {
        builder
            .addCase(createTheProblem.pending, (state) => {
                state.loading = true
                state.error = null
            })
            .addCase(createTheProblem.fulfilled, (state, action) => {
                state.loading = false
                state.the_problem_id = action.payload
            })
            .addCase(createTheProblem.rejected, (state, action) => {
                state.loading = false
                state.error = action.error.message
            })
            // .addCase(getClient.pending, (state) => {
            //     state.loading = true
            //     state.error = null
            // })
            // .addCase(getClient.fulfilled, (state, action) => {
            //     state.loading = false;
            //     state.error = null;
            //     state.client_id = action.payload.id
            //     state.first_name = action.payload.first_name
            //     state.last_name = action.payload.last_name
            //     state.stripe_customer_id = action.payload.stripe_customer_id
            // })
            // .addCase(getClient.rejected, (state, action) => {
            //     state.loading = false
            //     state.error = action.error.message
            // })
    }
})

export default definingTheProblemSlice;