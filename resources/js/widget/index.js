import NeighborConnector from './components/NeighborConnector.vue';
import Subscribe from './components/Subscribe.vue';

export default {
    install(Vue) {
        Vue.component('neighbor-connector', NeighborConnector);
        Vue.component('subscribe', Subscribe);
    },
};

export { NeighborConnector, Subscribe };