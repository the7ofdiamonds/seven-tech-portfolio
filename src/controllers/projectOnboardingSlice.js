import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';

const initialState = {
    onboardingLoading: false,
    onboardingError: '',
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

export const createProjectOnboarding = createAsyncThunk('projectOnboarding/createProjectOnboarding', async (formData, { getState }) => {
    try {
        const { client_id } = getState().client;

        const response = await fetch(`/wp-json/seven-tech/portfolio/v1/project/onboarding`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                client_id: client_id,
                project_id: formData?.project_id,
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

export const getProjectOnboarding = createAsyncThunk('projectOnboarding/getProjectOnboarding', async (project, { getState }) => {
    try {
        const { client_id } = getState().client;

        const response = await fetch(`/wp-json/seven-tech/portfolio/v1/project/problem/${project}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                client_id: client_id,
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

export const updateProjectOnboarding = createAsyncThunk('projectOnboarding/updateProjectOnboarding', async (formData, { getState }) => {
    try {
        const { client_id } = getState().client;

        const response = await fetch(`/wp-json/seven-tech/portfolio/v1/project/problem/${formData?.project}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                client_id: client_id,
                project_id: formData?.project_id,
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

export const projectOnboardingSlice = createSlice({
    name: 'projectOnboarding',
    initialState,
    extraReducers: (builder) => {
        builder
            .addCase(createProjectOnboarding.fulfilled, (state, action) => {
                state.onboardingLoading = false
                state.onboardingError = ''
                state.onboarding_id = action.payload
            })
            .addCase(getProjectOnboarding.fulfilled, (state, action) => {
                state.onboardingLoading = false
                state.onboardingError = ''
                state.project_id = action.payload.project_id
                state.deadline = action.payload.deadline
                state.deadline_date = action.payload.deadline_date
                state.where_business = action.payload.where_business
                state.website = action.payload.website
                state.website_url = action.payload.website_url
                state.hosting = action.payload.hosting
                state.satisfied = action.payload.satisfied
                state.signage = action.payload.signage
                state.signage_url = action.payload.signage_url
                state.social = action.payload.social
                state.social_facebook = action.payload.social_facebook
                state.social_x = action.payload.social_x
                state.social_linkedin = action.payload.social_linkedin
                state.social_instagram = action.payload.social_instagram
                state.logo = action.payload.logo
                state.logo_url = action.payload.logo_url
                state.colors = action.payload.colors
                state.colors_primary = action.payload.colors_primary
                state.colors_secondary = action.payload.colors_secondary
                state.colors_tertiary = action.payload.colors_tertiary
                state.summary = action.payload.summary
                state.summary_url = action.payload.summary_url
                state.plan = action.payload.plan
                state.plan_url = action.payload.plan_url
            })
            .addCase(updateProjectOnboarding.fulfilled, (state, action) => {
                state.onboardingLoading = false
                state.onboardingError = ''
                state.onboarding_id = action.payload
            })
            .addMatcher(isAnyOf(
                createProjectOnboarding.pending,
                getProjectOnboarding.pending,
                updateProjectOnboarding.pending,
            ), (state) => {
                state.onboardingLoading = true
                state.onboardingError = null
            })
            .addMatcher(isAnyOf(
                createProjectOnboarding.rejected,
                getProjectOnboarding.rejected,
                updateProjectOnboarding.rejected,
            ),
                (state, action) => {
                    state.onboardingLoading = false
                    state.onboardingError = action.error.message
                });
    }
})

export default projectOnboardingSlice;