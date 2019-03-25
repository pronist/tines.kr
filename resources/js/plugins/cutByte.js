export default {
    methods: {
        cutByte: function(str, len) {
            let l = 0;
            for (let i=0; i<str.length; i++) {
                l += (str.charCodeAt(i) > 128) ? 2 : 1;
                if (l > len) return str.substring(0,i);
            }
            return str;
        }
    }
}
