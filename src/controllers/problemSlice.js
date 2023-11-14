import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';

const initialState = {
    loading: false,
    error: '',
    customers_impacted: '',
    problem_affected: '',
    challenges: '',
    affected_operations: '',
    change_event: '',
    factors_contributed: '',
    patterns_trends: '',
    first_notice_date: '',
    recurring_issue: '',
    tried_solutions: '',
    tried_solutions_results: '',
    ideal_resolution: '',
    the_problem_id: ''
};

export const createTheProblem = createAsyncThunk('portfolioProblem/createTheProblem', async (formData, { getState }) => {
    try {
        const { client_id } = getState().client;

        const response = await fetch('/wp-json/thfw/v1/users/client/problem', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                client_id: client_id,
                customers_impacted: formData?.customers_impacted,
                problem_affected: formData?.problem_affected,
                challenges: formData?.challenges,
                affected_operations: formData?.affected_operations,
                change_event: formData?.change_event,
                factors_contributed: formData?.factors_contributed,
                patterns_trends: formData?.patterns_trends,
                first_notice_date: formData?.first_notice_date,
                recurring_issue: formData?.recurring_issue,
                tried_solutions: formData?.tried_solutions,
                tried_solutions_results: formData?.tried_solutions_results,
                ideal_resolution: formData?.ideal_resolution,
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

export const portfolioProblemSlice = createSlice({
    name: 'portfolioProblem',
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
    }
})

export default portfolioProblemSlice;