import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';

const initialState = {
    loading: false,
    error: '',
    client_id: '',
    stripe_customer_id: '',
    user_email: sessionStorage.getItem('user_email'),
    first_name: '',
    last_name: '',
};

export const getClient = createAsyncThunk('portfolioClient/getClient', async (_, { getState }) => {
    const { user_email } = getState().client;
    const encodedEmail = encodeURIComponent(user_email);
    console.log(user_email);
    try {
        const response = await fetch(`/wp-json/orb/services/v1/users/client/${encodedEmail}`, {
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
        throw error;
    }
});

export const portfolioClientSlice = createSlice({
    name: 'portfolioClient',
    initialState,
    extraReducers: (builder) => {
        builder
            .addCase(getClient.pending, (state) => {
                state.loading = true
                state.error = null
            })
            .addCase(getClient.fulfilled, (state, action) => {
                state.loading = false;
                state.error = null;
                state.client_id = action.payload.id
                state.first_name = action.payload.first_name
                state.last_name = action.payload.last_name
                state.stripe_customer_id = action.payload.stripe_customer_id
            })
            .addCase(getClient.rejected, (state, action) => {
                state.loading = false
                state.error = action.error.message
            })
    }
})

export default portfolioClientSlice;