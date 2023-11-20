import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';

const initialState = {
    problemLoading: false,
    problemError: '',
    summary: '',
    summary_url: '',
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
    problem_id: '',
    problem_message: ''
};

export const createProjectProblem = createAsyncThunk('projectProblem/createProjectProblem', async (formData, { getState }) => {
    try {
        const { client_id } = getState().client;

        const response = await fetch(`/wp-json/seven-tech/portfolio/v1/portfolio/problem/${formData?.project_title}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                client_id: client_id,
                project_title: formData?.project_title,
                summary: formData?.summary,
                summary_url: formData?.summary_url,
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
        throw error;
    }
});

export const getProjectProblem = createAsyncThunk('projectProblem/getProjectProblem', async (project, { getState }) => {
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
        throw error;
    }
});

export const updateProjectProblem = createAsyncThunk('projectProblem/updateProjectProblem', async (formData, { getState }) => {
    try {
        const { client_id } = getState().client;

        const response = await fetch(`/wp-json/seven-tech/portfolio/v1/project/problem/${formData?.project}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                client_id: client_id,
                project_title: formData?.project_title,
                summary: formData?.summary,
                summary_url: formData?.summary_url,
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
        throw error;
    }
});

export const projectProblemSlice = createSlice({
    name: 'projectProblem',
    initialState,
    extraReducers: (builder) => {
        builder
            .addCase(createProjectProblem.fulfilled, (state, action) => {
                state.problemLoading = false
                state.problemError = ''
                state.problem_id = action.payload
            })
            .addCase(getProjectProblem.fulfilled, (state, action) => {
                state.problemLoading = false
                state.problemError = ''
                state.problem_id = action.payload
                state.project_title = action.payload.project_title
                state.summary = action.payload.summary
                state.summary_url = action.payload.summary_url
                state.customers_impacted = action.payload.customers_impacted
                state.problem_affected = action.payload.problem_affected
                state.challenges = action.payload.challenges
                state.affected_operations = action.payload.affected_operations
                state.change_event = action.payload.change_event
                state.factors_contributed = action.payload.factors_contributed
                state.patterns_trends = action.payload.patterns_trends
                state.first_notice_date = action.payload.first_notice_date
                state.recurring_issue = action.payload.recurring_issue
                state.tried_solutions = action.payload.tried_solutions
                state.tried_solutions_results = action.payload.tried_solutions_results
                state.ideal_resolution = action.payload.ideal_resolution
            })
            .addCase(updateProjectProblem.fulfilled, (state, action) => {
                state.problemLoading = false
                state.problemError = ''
                state.problem_message = action.payload
            })
            .addMatcher(isAnyOf(
                createProjectProblem.pending,
                getProjectProblem.pending,
                updateProjectProblem.pending,
            ), (state) => {
                state.problemLoading = true
                state.problemError = null
            })
            .addMatcher(isAnyOf(
                createProjectProblem.rejected,
                getProjectProblem.rejected,
                updateProjectProblem.rejected,
            ),
                (state, action) => {
                    state.problemLoading = false
                    state.problemError = action.error.message
                });
    }
})

export default projectProblemSlice;