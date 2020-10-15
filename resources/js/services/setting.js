export default class Setting {
    static create( data) {
        return axios.post("/api/v1/settings", data);
    }
}
