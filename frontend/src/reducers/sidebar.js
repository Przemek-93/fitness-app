export const sidebar = (state, action) => {
    switch (action.type) {
        case 'TOGGLE_SIDEBAR':
            return {
             ...state,
             showMenu: true
            };
        default:
            return state
    }
};
