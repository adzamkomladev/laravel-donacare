export default class Auth {
    static currentUser() {
        return window.authState.user || {};
    }
}
