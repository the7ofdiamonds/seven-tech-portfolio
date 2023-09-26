import axios from 'axios';
import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';

const initialState = {
    loading: false,
    error: '',
    deadline: '',
    deadline_date: '',
    where_business: '',
    website: '',
    website_url: '',
    hosting: '',
    satisfied: '',
    signage: '',
    signage_url: '',
    social: '',
    social_facebook: '',
    social_x: '',
    social_linkedin: '',
    social_instagram: '',
    logo: '',
    logo_url: '',
    colors: '',
    colors_primary: '#000000',
    colors_secondary: '#000000',
    colors_tertiary: '#000000',
    summary: '',
    summary_url: '',
    plan: '',
    plan_url: '',
    onboarding_id: '',
};

export const createOnboarding = createAsyncThunk('onboarding/createOnboarding', async (formData, { getState }) => {
    try {
        const { client_id } = getState().client;

        const response = await fetch('/wp-json/thfw/v1/users/client/onboarding', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                client_id: client_id,
                deadline: formData?.deadline,
                deadline_date: formData?.deadline_date,
                where_business: formData?.where_business,
                website: formData?.website,
                website_url: formData?.website_url,
                hosting: formData?.hosting,
                satisfied: formData?.satisfied,
                signage: formData?.signage,
                signage_url: formData?.signage_url,
                social: formData?.social,
                social_facebook: formData?.social_facebook,
                social_x: formData?.social_x,
                social_linkedin: formData?.social_linkedin,
                social_instagram: formData?.social_instagram,
                logo: formData?.logo,
                logo_url: formData?.logo_url,
                colors: formData?.colors,
                colors_primary: formData?.colors_primary,
                colors_secondary: formData?.colors_secondary,
                colors_tertiary: formData?.colors_tertiary,
                summary: formData?.summary,
                summary_url: formData?.summary_url,
                plan: formData?.plan,
                plan_url: formData?.plan_url,
            })
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