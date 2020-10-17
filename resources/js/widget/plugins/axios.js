import axios from 'axios';

let instance = axios.create({
  'baseURL': 'http://homestead.test/v1'
});

export default instance;
