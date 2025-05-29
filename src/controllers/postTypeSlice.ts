import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';

const initialState = {
    postTypeLoading: false,
    postTypeStatusCode: '',
    postTypeError: '',
    postTypeErrorMessage: '',
    employees: '',
    executives: '',
    founders: '',
    freelancers: '',
    investors: '',
    managingMembers: ''
};

export const getEmployeesWithTerm = createAsyncThunk('postType/getEmployeesWithTerm', async ({ taxonomy, term }) => {

    try {
        const response = await fetch(`/wp-json/seven-tech/v1/employees/taxonomies/${taxonomy}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                term: term
            })
        });

        const responseData = await response.json();

        return responseData;
    } catch (error) {
        console.error(error);
        throw new Error(error.message);
    }
});

export const getExecutivesWithTerm = createAsyncThunk('postType/getExecutivesWithTerm', async ({ taxonomy, term }) => {

    try {
        const response = await fetch(`/wp-json/seven-tech/v1/executives/taxonomies/${taxonomy}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                term: term
            })
        });

        const responseData = await response.json();

        return responseData;
    } catch (error) {
        console.error(error);
        throw new Error(error.message);
    }
});

export const getFoundersWithTerm = createAsyncThunk('postType/getFoundersWithTerm', async ({ taxonomy, term }) => {

    try {
        const response = await fetch(`/wp-json/seven-tech/v1/founders/taxonomies/${taxonomy}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                term: term
            })
        });

        const responseData = await response.json();

        return responseData;
    } catch (error) {
        console.error(error);
        throw new Error(error.message);
    }
});

export const getFreelancersWithTerm = createAsyncThunk('postType/getFreelancersWithTerm', async ({ taxonomy, term }) => {

    try {
        const response = await fetch(`/wp-json/seven-tech/v1/freelancers/taxonomies/${taxonomy}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                term: term
            })
        });

        const responseData = await response.json();

        return responseData;
    } catch (error) {
        console.error(error);
        throw new Error(error.message);
    }
});

export const getInvestorsWithTerm = createAsyncThunk('postType/getInvestorsWithTerm', async ({ taxonomy, term }) => {

    try {
        const response = await fetch(`/wp-json/seven-tech/v1/investors/taxonomies/${taxonomy}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                term: term
            })
        });

        const responseData = await response.json();

        return responseData;
    } catch (error) {
        console.error(error);
        throw new Error(error.message);
    }
});

export const getManagingMembersWithTerm = createAsyncThunk('postType/getManagingMembersWithTerm', async ({ taxonomy, term }) => {

    try {
        const response = await fetch(`/wp-json/seven-tech/v1/managing-members/taxonomies/${taxonomy}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                term: term
            })
        });

        const responseData = await response.json();

        return responseData;
    } catch (error) {
        console.error(error);
        throw new Error(error.message);
    }
});

export const postTypeSlice = createSlice({
    name: 'postType',
    initialState,
    extraReducers: (builder) => {
        builder
            .addCase(getEmployeesWithTerm.fulfilled, (state, action) => {
                state.postTypeLoading = false;
                state.postTypeError = null
                state.postTypeStatusCode = action.payload.statusCode
                state.postTypeErrorMessage = action.payload.errorMessage
                state.employees = action.payload.employees
            })
            .addCase(getExecutivesWithTerm.fulfilled, (state, action) => {
                state.postTypeLoading = false;
                state.postTypeError = null
                state.postTypeStatusCode = action.payload.statusCode
                state.postTypeErrorMessage = action.payload.errorMessage
                state.executives = action.payload.executives
            })
            .addCase(getFoundersWithTerm.fulfilled, (state, action) => {
                state.postTypeLoading = false;
                state.postTypeError = null
                state.postTypeStatusCode = action.payload.statusCode
                state.postTypeErrorMessage = action.payload.errorMessage
                state.founders = action.payload.founders
            })
            .addCase(getFreelancersWithTerm.fulfilled, (state, action) => {
                state.postTypeLoading = false;
                state.postTypeError = null
                state.postTypeStatusCode = action.payload.statusCode
                state.postTypeErrorMessage = action.payload.errorMessage
                state.freelancers = action.payload.freelancers
            })
            .addCase(getInvestorsWithTerm.fulfilled, (state, action) => {
                state.postTypeLoading = false;
                state.postTypeError = null
                state.postTypeStatusCode = action.payload.statusCode
                state.postTypeErrorMessage = action.payload.errorMessage
                state.investors = action.payload.investors
            })
            .addCase(getManagingMembersWithTerm.fulfilled, (state, action) => {
                state.postTypeLoading = false;
                state.postTypeError = null
                state.postTypeStatusCode = action.payload.statusCode
                state.postTypeErrorMessage = action.payload.errorMessage
                state.managingMembers = action.payload.managingMembers
            })
            .addMatcher(isAnyOf(
                getEmployeesWithTerm.pending,
                getExecutivesWithTerm.pending,
                getFoundersWithTerm.pending,
                getFreelancersWithTerm.pending,
                getInvestorsWithTerm.pending,
                getManagingMembersWithTerm.pending
            ), (state) => {
                state.postTypeLoading = true
                state.postTypeStatusCode = ''
                state.postTypeErrorMessage = ''
                state.postTypeError = ''
            })
            .addMatcher(isAnyOf(
                getEmployeesWithTerm.rejected,
                getExecutivesWithTerm.rejected,
                getFoundersWithTerm.rejected,
                getFreelancersWithTerm.rejected,
                getInvestorsWithTerm.rejected,
                getManagingMembersWithTerm.rejected
            ), (state, action) => {
                state.postTypeLoading = false
                state.postTypeStatusCode = action.error.code
                state.postTypeErrorMessage = action.error.message
                state.postTypeError = action.error
            })
    }
})

export default postTypeSlice;