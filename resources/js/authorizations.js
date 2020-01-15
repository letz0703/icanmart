let user = window.App.user;

let authorizations = {
    owns (model, prop = 'user_id') {
        return model[prop] === user.id;
    },
    isAdmin() {
        return user.isAdmin;
    },
};

module.exports = authorizations;
