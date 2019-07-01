import axios from 'axios';

let instance = axios.create({
  'baseURL': process.env.APP_API_URL + '/' + process.env.APP_API_VERSION
});

export default instance;