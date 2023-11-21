import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';

const initialState = {
    onboardingLoading: false,
    onboardingError: '',
    project_title: '',
    deadline: '',
    where_business: '',
    website: '',
    hosting: '',
    satisfied: '',
    signage: '',
    social_networks: [
        { platform: 'facebook', link: '' },
        { platform: 'x', link: '' },
        { platform: 'linkedin', link: '' },
        { platform: 'instagram', link: '' },
    ],
    logo: '',
    colors: [
        { title: 'colors_primary', value: '#000000' },
        { title: 'colors_secondary', value: '#000000' },
        { title: 'colors_tertiary', value: '#000000' }
    ],
    plan: '',
    onboardingID: '',
    onboardingMessage: '',
    onboardingResults: ''
};

export const createProjectOnboarding = createAsyncThunk('projectOnboarding/createProjectOnboarding', async (formData, { getState }) => {
    try {
        const { client_id } = getState().client;

        const response = await fetch(`/wp-json/seven-tech/portfolio/v1/portfolio/onboarding`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                client_id: client_id,
                ...formData
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
        throw error;
    }
});

export const getProjectOnboarding = createAsyncThunk('projectOnboarding/getProjectOnboarding', async (project, { getState }) => {
    try {
        const { client_id } = getState().client;

        const response = await fetch(`/wp-json/seven-tech/portfolio/v1/project/onboarding/${project}`, {
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
        throw error;
    }
});

export const updateProjectOnboarding = createAsyncThunk('projectOnboarding/updateProjectOnboarding', async (formData, { getState }) => {
    try {
        const { client_id } = getState().client;

        const response = await fetch(`/wp-json/seven-tech/portfolio/v1/project/onboarding/${formData?.project_slug}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                client_id: client_id,
                project_title: formData?.project_title,
                deadline: formData?.deadline,
                where_business: formData?.where_business,
                website: formData?.website,
                hosting: formData?.hosting,
                satisfied: formData?.satisfied,
                signage: formData?.signage,
                social_networks: formData?.social_networks,
                logo: formData?.logo,
                colors: formData?.colors,
                plan: formData?.plan,
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
        throw error;
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
                state.onboardingID = action.payload.id
                state.onboardingMessage = action.payload.message
            })
            .addCase(getProjectOnboarding.fulfilled, (state, action) => {
                state.onboardingLoading = false
                state.onboardingError = ''
                state.project_title = action.payload.project_title
                state.deadline = action.payload.deadline
                state.where_business = action.payload.where_business
                state.website = action.payload.website
                state.hosting = action.payload.hosting
                state.satisfied = action.payload.satisfied
                state.signage = action.payload.signage
                state.social_networks = action.payload.social_networks
                state.logo = action.payload.logo
                state.colors = action.payload.colors
                state.plan = action.payload.plan
                state.onboardingID = action.payload.id
                state.onboardingMessage = action.payload.message
            })
            .addCase(updateProjectOnboarding.fulfilled, (state, action) => {
                state.onboardingLoading = false
                state.onboardingError = ''
                state.onboardingMessage = action.payload.message
                state.onboardingResults = action.payload.results
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