// authProvider.js
import { Auth } from 'aws-amplify';

export default {
  // called when the user navigates to a new location, to check for authentication
  checkAuth: async () => {
    try {
      await Auth.currentAuthenticatedUser();
      return Promise.resolve();
    } catch (error) {
      return Promise.reject();
    }
  },

  // called when the user clicks on the logout button
  logout: async () => {
    if (!Auth.currentSession()) {
      // If no user is logged in, redirect to login page
      return "/login";
    }
    console.log("logging out");
    await Auth.signOut();
    return ""; // Return an empty string to allow redirectTo to be used
  },

  // called when the API returns an unauthorized error
  checkError: async (error) => {
    if (error.status === 401) {
      return Promise.reject();
    }
    return Promise.resolve();
  },

  // called when the user navigates to a new location, to get the authentication data
  getIdentity: async () => {
    try {
      const user = await Auth.currentAuthenticatedUser();
      return Promise.resolve({
        id: user.username,
        fullName: user.attributes.name,
        avatar: user.attributes.picture,
      });
    } catch (error) {
      return Promise.reject();
    }
  },

  // called when the user is authenticated, to get the authentication data
  getPermissions: async () => {
    const user = await Auth.currentAuthenticatedUser();
    return Promise.resolve(['admin']); // or return the actual permissions
  },
};