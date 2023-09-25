import axios from 'axios';
import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';

const initialState = {
    loading: false,
    error: '',
    onboarding_id: '',
};

export const createOnboarding = createAsyncThunk('onboarding/createOnboarding', async (formData) => {
    try {
        const response = await fetch('/wp-json/thfw/v1/users/client/onboarding', {
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

export const onboardingSlice = createSlice({
    name: 'onboarding',
    initialState,
    extraReducers: (builder) => {
        builder
            .addCase(createOnboarding.pending, (state) => {
                state.loading = true
                state.error = null
            })
            .addCase(createOnboarding.fulfilled, (state, action) => {
                state.loading = false
                state.onboarding_id = action.payload
            })
            .addCase(createOnboarding.rejected, (state, action) => {
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

export default onboardingSlice;