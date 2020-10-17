import axios from 'axios';

export default axios.create({
    'baseURL': process.env.APP_API_URL + '/' + process.env.APP_API_VERSION
});
