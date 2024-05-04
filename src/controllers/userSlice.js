import { createSlice, createAsyncThunk, isAnyOf } from '@reduxjs/toolkit';

const initialState = {
  userLoading: false,
  userError: '',
  userErrorMessage: '',
  userStatusCode: '',
  projects: '',
  projectTypes: '',
  projectType: '',
  skills: '',
  skill: '',
  frameworks: '',
  framework: '',
  technologies: '',
  technology: ''
};

export const getProjectTypesByUser = createAsyncThunk('user/getProjectTypesByUser', async () => {
  try {
    const response = await fetch(`/wp-json/seven-tech/portfolio/v1/user/project-types`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json'
      }
    });

    const responseData = await response.json();

    return responseData;
  } catch (error) {
    console.error(error);
    throw new Error(error.message);
  }
});

export const getSkillsByUser = createAsyncThunk('user/getSkillsByUser', async () => {
  try {
    const response = await fetch(`/wp-json/seven-tech/portfolio/v1/user/skills`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json'
      }
    });

    const responseData = await response.json();

    return responseData;
  } catch (error) {
    console.error(error);
    throw new Error(error.message);
  }
});


export const getFrameworksByUser = createAsyncThunk('user/getFrameworksByUser', async () => {
  try {
    const response = await fetch(`/wp-json/seven-tech/portfolio/v1/user/frameworks`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json'
      }
    });

    const responseData = await response.json();

    return responseData;
  } catch (error) {
    console.error(error);
    throw new Error(error.message);
  }
});

export const getTechnologiesByUser = createAsyncThunk('user/getTechnologiesByUser', async () => {
  try {
    const response = await fetch(`/wp-json/seven-tech/portfolio/v1/user/technologies`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json'
      }
    });

    const responseData = await response.json();

    return responseData;
  } catch (error) {
    console.error(error);
    throw new Error(error.message);
  }
});

export const getProjectType = createAsyncThunk('user/getProjectType', async (projectType) => {
  try {
    const response = await fetch(`/wp-json/seven-tech/portfolio/v1/user/project-types/${projectType}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json'
      }
    });

    const responseData = await response.json();

    return responseData;
  } catch (error) {
    console.error(error);
    throw new Error(error.message);
  }
});

export const getSkill = createAsyncThunk('user/getSkill', async (skill) => {
  try {
    const response = await fetch(`/wp-json/seven-tech/portfolio/v1/user/skills/${skill}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json'
      }
    });

    const responseData = await response.json();

    return responseData;
  } catch (error) {
    console.error(error);
    throw new Error(error.message);
  }
});


export const getFramework = createAsyncThunk('user/getFramework', async (framework) => {
  try {
    const response = await fetch(`/wp-json/seven-tech/portfolio/v1/user/frameworks/${framework}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json'
      }
    });

    const responseData = await response.json();

    return responseData;
  } catch (error) {
    console.error(error);
    throw new Error(error.message);
  }
});

export const getTechnology = createAsyncThunk('user/getTechnology', async (technology) => {
  try {
    const response = await fetch(`/wp-json/seven-tech/portfolio/v1/user/technologies/${technology}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json'
      }
    });

    const responseData = await response.json();

    return responseData;
  } catch (error) {
    console.error(error);
    throw new Error(error.message);
  }
});

export const userSlice = createSlice({
  name: 'user',
  initialState,
  extraReducers: (builder) => {
    builder
      .addCase(getProjectTypesByUser.fulfilled, (state, action) => {
        state.userLoading = false;
        state.userError = '';
        state.userErrorMessage = action.payload.errorMessage;
        state.userStatusCode = action.payload.statusCode;
        state.projectTypes = action.payload.projectTypes;
      })
      .addCase(getSkillsByUser.fulfilled, (state, action) => {
        state.userLoading = false;
        state.userError = '';
        state.userErrorMessage = action.payload.errorMessage;
        state.userStatusCode = action.payload.statusCode;
        state.skills = action.payload.skills;
      })
      .addCase(getFrameworksByUser.fulfilled, (state, action) => {
        state.userLoading = false;
        state.userError = '';
        state.userErrorMessage = action.payload.errorMessage;
        state.userStatusCode = action.payload.statusCode;
        state.frameworks = action.payload.frameworks;
      })
      .addCase(getTechnologiesByUser.fulfilled, (state, action) => {
        state.userLoading = false;
        state.userError = '';
        state.userErrorMessage = action.payload.errorMessage;
        state.userStatusCode = action.payload.statusCode;
        state.technologies = action.payload.technologies;
      })
      .addMatcher(isAnyOf(
        getProjectType.fulfilled,
        getSkill.fulfilled,
        getFramework.fulfilled,
        getTechnology.fulfilled
      ), (state, action) => {
        state.userLoading = false;
        state.userError = '';
        state.userErrorMessage = action.payload.errorMessage;
        state.userStatusCode = action.payload.statusCode;
        state.icon = action.payload.icon
        state.title = action.payload.title;
        state.projects = action.payload.projects;
      })
      .addMatcher(isAnyOf(
        getProjectTypesByUser.pending,
        getSkillsByUser.pending,
        getFrameworksByUser.pending,
        getTechnologiesByUser.pending,
        getProjectType.pending,
        getSkill.pending,
        getFramework.pending,
        getTechnology.pending
      ), (state) => {
        state.userLoading = true;
        state.userError = '';
        state.userErrorMessage = '';
        state.userStatusCode = '';
      })
      .addMatcher(isAnyOf(
        getProjectTypesByUser.rejected,
        getSkillsByUser.rejected,
        getFrameworksByUser.rejected,
        getTechnologiesByUser.rejected,
        getProjectType.rejected,
        getSkill.rejected,
        getFramework.rejected,
        getTechnology.rejected
      ), (state, action) => {
        state.userLoading = false;
        state.userError = action.error;
        state.userErrorMessage = action.error.message;
        state.userStatusCode = action.error.code;
      })
  }
})

export default userSlice;
