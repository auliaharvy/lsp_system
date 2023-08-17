import '@/bootstrap';
import { MessageBox } from 'element-ui';
// import { isLogged, setLogged } from '@/utils/auth';

// Create axios instance
const service = window.axios.create({
  baseURL: process.env.MIX_BASE_API,
  timeout: 30000, // Request timeout
});

// Request intercepter
service.interceptors.request.use(
  config => {
    // const token = isLogged();
    // if (token) {
    //   config.headers['Authorization'] = 'Bearer ' + isLogged(); // Set JWT token
    // }
    return config;
  },
  error => {
    // Do something with request error
    MessageBox.confirm(error,
      error,
      {
        confirmButtonText: 'OK',
        type: '"warning"',
      }
    );
    console.log(error); // for debug
    // console.log('error anjay'); // for debug
    Promise.reject(error);
  }
);

// response pre-processing
service.interceptors.response.use(
  response => {
    // if (response.headers.authorization) {
    //   setLogged(response.headers.authorization);
    //   response.data.token = response.headers.authorization;
    // }

    return response.data;
  },
  error => {
    let message = error.message;
    if (error.response.data && error.response.data.errors) {
      message = error.response.data.errors;
    } else if (error.response.data && error.response.data.error) {
      message = error.response.data.error;
    } else if (error.errors) {
      message = error.errors;
    }

    MessageBox.confirm(error.response.data.message,
      message,
      {
        confirmButtonText: 'OK',
        type: '"warning"',
        callback: action => {
          if (error.response.data.message === 'Unauthenticated.') {
            console.log(error.response.data.message);
          } else {
            null;
          }
        },
      }
    );
    // Message({
    //   message: message,
    //   type: 'error',
    //   duration: 5 * 1000,
    // });
    return Promise.reject(error);
  }
);

export default service;
