const baseUrl = 'http://127.0.0.1:8080/v1/';

// Login
export const loginUrl = baseUrl.concat('login');
export const loggedUserUrl = baseUrl.concat('user');

// Register
export const registerUrl = baseUrl.concat('user');

// Trainings Schedule Events
export const createUrl = baseUrl.concat('training/activity');
export const removeUrl = baseUrl.concat('training/activity/');
