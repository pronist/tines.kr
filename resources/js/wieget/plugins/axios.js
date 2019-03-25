import axios from 'axios';

let instance = axios.create({
    baseURL: 'https://api.tines.kr/v1'
});

export default instance;